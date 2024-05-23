<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class GameController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Game::orderBy('created_at', 'desc')
                ->get();
             return DataTables::of($query)
             ->addIndexColumn()
             ->rawColumns(['action'])
             ->toJson();
        }
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


    public function fetch($id){
        $game = Game::select()->where('id', $id)->first();
        return $this->respondWithSuccess('Successfully fetched', $game);
    }

    public function update(Request $request){
        try {
            $game = Game::select()->where('id', $request->id)->first();
            $game->title = $request->title;
            $game->keyword = $request->keyword;
            $game->url = $request->url;
            $game->status = $request->status;
            $game->description = $request->description;
            $game->save();
            flash()->addSuccess('Game updated successfully');
            return redirect()->back();
        } catch (\Throwable $th) {
            flash()->addError($th->getMessage());
            return redirect()->back();
        }
    }
}
