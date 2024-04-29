<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function register(request $req){
        $user = new User;
        $user->email=$req->input('email');
        $user->name=$req->input('name');
        $user->role=$req->input('role');
        $user->password = Hash::make($req->input('password'));
        $user->save();
        return $user;
    }

    function login(request $request){
      
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:kasir,owner'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 422);
        }
    
        $credentials = $request->only('email', 'password' );
        $role = $request->role; 
    
        if (Auth::attempt($credentials)) {
            $user = $request->user();
            
            if ($user->role !== $role) {
                return response()->json(['status' => 'error', 'message' => 'Invalid credentials'], 401);
            }
            
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['status' => 'success', 'token' => $token]);
        }
    
        return response()->json(['status' => 'error', 'message' => 'Invalid credentials'], 401);
    
    }
    

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['status' => 'success', 'message' => 'Logged out']);
    }
    
}