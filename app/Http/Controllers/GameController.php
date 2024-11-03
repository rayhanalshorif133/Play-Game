<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class GameController extends Controller
{
    public function index()
    {
        $game = Game::select()->first();
        return view('game.index', compact('game'));
    }




    public function fetch($id)
    {
        $game = Game::select()->where('id', $id)->first();
        return $this->respondWithSuccess('Successfully fetched', $game);
    }

    public function update(Request $request)
    {
        try {
            $game = Game::select()->first();
            $game->title = $request->title;
            $game->description = $request->description;
            $game->keyword = $request->keyword;
            $game->url = $request->game_url;
            if ($request->hasFile('banner')) {
                $file = $request->file('banner');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('banners');
                $file->move($destinationPath, $fileName);
                $filePath = 'banners/' . $fileName;
                $game->banner = $filePath;
            }
            $game->status = $request->status;
            $game->save();
            Session::flash('success', 'Game updated successfully');
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect()->back();
        }
    }
}
