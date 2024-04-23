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
            $game->keyword = $request->keyword;
            $game->url = $request->url;
            $game->description = $request->description;
            $game->save();

            flash()->addSuccess('Game created successfully');
            return redirect()->route('game.index');
        } catch (\Throwable $th) {
            flash()->error($th->getMessage());
            return redirect()->back();
        }
    }
}
