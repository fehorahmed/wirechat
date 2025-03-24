<?php

namespace App\Modules\AppUser\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class AppUserController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("AppUser::welcome");
    }
    public function appLogin(Request $request)
    {

        $rules = [
            'token'=>'required|string'
        ];
        $validation = Validator::make($request->all(),$rules);
        if($validation->fails()){
            return response()->json([
                'status'=>false,
                'message'=>$validation->errors()->first()
            ]);
        }

        $accessToken = PersonalAccessToken::findToken($request->token);

        if ($accessToken) {
            $user = $accessToken->tokenable; // Get the associated user
            Auth::login($user);
            return redirect()->route('chats');
        } else {
            return response()->json([
                'status'=>false,
                'message'=>"You don't have the permission to access."
            ]);
        }
    }
}
