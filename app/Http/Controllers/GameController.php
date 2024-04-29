<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    public function index()
    {
        return view('game.index');
    }

    public function store(Request $request)
    {
        

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'keyword' => 'required|unique:games,keyword',
            'url' => 'required',
        ]);




        if ($validator->fails()) {
            flash()->addError($validator->errors()->first());
            return redirect()->back();
        }
        try {
            
            $game = new Game();
            $game->title = $request->title;
            if ($request->banner) {
                $banner = $request->file('banner');
                $image_name = time() . '_' . $banner->getClientOriginalName();
                $banner->move(public_path('/images/game'), $image_name);
                $game->banner = '/images/game/' . $image_name;
            }else{
                $game->banner = null;
            }
            $game->keyword = $request->keyword;
            $game->url = $request->url;
            $game->description = $request->description;
            $game->status = 0;
            $game->save();

            flash()->addSuccess('Game created successfully');
            return redirect()->back();
        } catch (\Throwable $th) {
            flash()->addError($th->getMessage());
            return redirect()->back();
        }
    }
}
