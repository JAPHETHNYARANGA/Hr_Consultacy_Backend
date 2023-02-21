<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' =>'required|email',
            'password'=>'required'
        ]);
        $email = $request['email'];
        $user = User::where('email', $email)->firstOrFail();

        $token = $user->createToken('API Token')->accessToken;
        // $token = auth()->user()->createToken('API Token')->accessToken;

        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            return response(
                [
                    'success'=>true,
                    'user'=>$user,
                    'token'=>$token
                ],200);
        }
        return response(
            [   'success' =>false,
                'message'=>'Login Failed'
        ],201);
        
    }


    public function register(Request $request){
        $request->validate([
            'email' =>'required|email|unique:users', 
            // 'password'=>'required'
        ]);
        

        $user = new User();
        $uuid = Str::uuid()->toString();
        $user ->user_id = $uuid;
        $user -> email = $request->email;
        // $user -> password =Hash::make($request->password);
        $user-> active = "0"; 

        $res = $user->save();
        if($res){
            return response(
                [
                    'success' =>true,
                    'message'=>'Register User success',
                    'user' => $user,
                ] ,200);
        }else{
            return response(
                [
                    'success' =>false,
                'message'=>'Register User Failed', 
            ],201);
        }
    }


    public function activate(Request $request){
        $request->validate([
            'email' =>'required|email',
            'password'=>'required'
        ]);
        $user = new User();
        
        $email = $request['email'];
        $user = User::where('email', $email)->where('active', 0)->firstOrFail();
        $user ->password =Hash::make($request->password);
        $user->active = 1;
        $res = $user->save();
        if($res){
            return response(
                [               
                    'success' =>true,
                    'message'=>'Activate User success',
                'user' => $user,
            ],200);
        }else{
            return response(
                [
                    'success' =>false,
                'message'=>'Activate User Failed', 
            ],201);
        }
    }


    public function logout(Request $request){
        $token = $request->user()->token();
        $res = $token->revoke();
        if($res){
            return response([
                'success' => true,
                'message'=>'logged out'
            ],200);
        }else{
            return response([
                'success' => false,
                'message'=>'failed'
            ],500);
        }
        
    }

    public function users(){
        $users = User::all();
        
            return response([
                "users" =>$users
            ]);
        
    }

    public function delete($id){
        $user= User::find($id);

        $res = $user->delete();

        if($res){
            return response(
                [
                'success' =>true,
                'message'=>'User deleted successfully',
            ],200);
        } else {
            return response(
                [
                'success' =>false,
                'message'=>'User delete failed',
            ],201);
        }
    }
}