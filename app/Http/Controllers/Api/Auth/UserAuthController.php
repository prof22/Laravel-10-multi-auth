<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    public function register(Request $request){
        //Let validate the data
        $validator =  Validator::Make($request->all(),[
            'name' => 'required|string|max:50',
            'email'=> 'required|string|email|unique:users|max:200',
            'password' => 'required|string|min:8'
        ]);
        //if validation fails
        if($validator->fails()){
            return response()->json([
                'error' =>$validator->error()
            ], 422);
        }
        //This will create the user and hash the password..
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password'))
        ]);
        // Now lets create Token
        $token = $user->createToken('userToken')->accessToken;
        return response()->json([
            'access_token' => $token
        ], 200);
    }

    //Lets just create login and test both same time

    public function Login(Request $request){
        $credentails = request(['email', 'password']);
        //if auth attempt fails.. 
        if(!auth()->attempt($credentails)){
            return response()->json([
                'Message' => 'Invalid Credentails'
            ]);
        }
        //else
        $accessToken = auth()->user()->createToken('userToken')->accessToken;
        return response()->json([
            'Message' => 'Login Successful',
            'user' => auth()->user(),
            'access_token'=>$accessToken
        ]);
    }
}
