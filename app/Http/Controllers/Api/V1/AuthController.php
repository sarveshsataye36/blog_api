<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\{UserRequest, LoginUserRequest};
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Models\User;
use Exceptions;
use Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function register(UserRequest $request) 
    {

        try
        {
            // Create or register new user
            $user = User::create([
                'fname' => $request['fname'],
                'lname' => $request['lname'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            // created data send to server
            $data = [
                'user' => $user,
                'token' => $user->createToken('ApiUserToken')->plainTextToken 
            ];

            // return response to back to user
            return $this->success(true, $data, 'User register successfully', 200);

        }catch(\Throwable $e)
        {
            return $this->fails(false,'Something went wrong', 500);
        }
    }
    
    public function login(LoginUserRequest $request) {


        try
        {   
            // trying to login if fail return fail msg
            if(!Auth::attempt($request->only(['email', 'password'])))
            {
                return $this->fails(false, 'Invalid credentails', 401);
            }
            
            // finding user via email
            $user = User::where('email',$request->email)->first();

            // login data send to user
            $data = [
                'user' => $user,
                'token' => $user->createToken('ApiUserToken')->plainTextToken 
            ];

            // return response to server
            return $this->success(true, $data, 'User login successfully', 200);
            
        }catch(\Throwable $e)
        {
            return $this->fails(false,'Something went wrong', 500);
        }
        
    }
}
