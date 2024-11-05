<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // store
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'role' => 'required',
                'status' => 'required',
                'password' => 'required|min:6|max:25|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back();
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->status = $request->status;
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('admin.user.index');
        }catch(\Exception $e){
            return redirect()->route('admin.user.index');
        }
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
                'password'=> 'nullable|min:6|max:25|confirmed'
            ]);

            if ($validator->fails()) {
                return redirect()->back();
            }

            $user = User::find($id);
            if($user){
                $user->name = $request->name;
                $user->email = $request->email;
                $user->role = $request->role;
                $user->status = $request->status;
                $user->save();
                return redirect()->route('admin.user.index');
            }else{
                return redirect()->route('admin.user.index');
            }
        }catch(\Exception $e){
            return redirect()->route('admin.user.index');
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
