<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = User::orderBy('created_at', 'desc')->get();
             return DataTables::of($query)
             ->addIndexColumn()
             ->rawColumns(['action'])
             ->toJson();
        }
        return view('user.index');
    }

    // fetch user info
    public function fetchUser($id)
    {
        try{
            $user = User::find($id);
            if($user){
                return $this->respondWithSuccess('User fetched successfully.', $user);
            }else{
                return $this->respondWithError('User not found.');
            }
        }catch(\Exception $e){
            return $this->respondWithError($e->getMessage());
        }
    }
    // update
    public function update(Request $request)
    {
        try{
            $id = $request->user_id;

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
                'role' => 'required',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                toastr()->addError($validator->errors()->first());
                return redirect()->back();
            }

            $user = User::find($id);
            if($user){
                $user->name = $request->name;
                $user->email = $request->email;
                $user->role = $request->role;
                $user->status = $request->status;
                $user->save();
                toastr()->addSuccess('User updated successfully.');
                return redirect()->route('user.index');
            }else{
                toastr()->addError('User not found.');
                return redirect()->route('user.index');
            }
        }catch(\Exception $e){
            toastr()->addError($e->getMessage());
            return redirect()->route('user.index');
        }
    }

    // delete
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['success' => 'Data deleted successfully.']);
    }
}
