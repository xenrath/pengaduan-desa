<?php

namespace App\Http\Controllers\Restful;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Events\NotificationNewUser;
use App\Person;

class UserController extends Controller
{
    public function loginMobile(Request $request){
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            if($user->in_active == true){
                $user['token'] = $user->createToken('BanjarAnyar')->accessToken;

                return response()->json([
                    'message' => 'Success Login',
                    'status' => 200,
                    'data' => $user
                ],200);
            }else{
                return response()->json([
                    'message'=>'Error Login',
                    'status' => 403,
                    'error' => 'Account is not active, contact admin for activation'
                ],403);
            }
        }else{ 
            return response()->json([
                'message'=>'Error Login',
                'status' => 401,
                'error' => 'Email or Password is invalid'
            ], 401); 
        }
    }

    public function registerMobile(Request $request){
        $validator = Validator::make($request->all(), [
            'NIK' => 'required',
            'email' => 'required | email',
            'password' => 'required | min: 6',
            'confirm_password' => 'required | same:password',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Error',
                'status' => 401,
                'error' => $validator->errors()
            ], 401);
        }

        $findPerson = Person::where('NIK', $request->NIK)->first();

        if(!$findPerson){
            return response()->json([
                'message' => 'Error',
                'status' => 403,
                'error' => 'NIK invalid'
            ], 403);
        }

        $findUser = User::where('email', $request->email)->first();
        $findNik = User::where('NIK', $request->NIK)->first();

        if($findNik != null){
            return response()->json([
                'message' => 'Error',
                'status' => 422,
                'error' => 'NIK is already exists',
            ], 409);
        }

        if($findUser !== null){
            return response()->json([
                'message' => 'Error',
                'status' => 422,
                'error' => 'Email is already exists'
            ], 422);
        }
        $user = User::create([
            'NIK' => $findPerson->NIK,
            'name' => $findPerson->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'NIK' => $request->NIK
        ]);

        $responseObject = [
            'name' => $user['name'],
            'email' => $user['email'],
            'token' => $user->createToken('BanjarAnyar')->accessToken
        ];

        event(new NotificationNewUser($user));

        return response()->json([
            'message' => 'Register is successful',
            'status' => 200,
            'data' => $responseObject
        ], 200);
    }

    public function details (){
        $user = Auth::user();
        
        return response()->json([
            'message' => 'Success get detail user',
            'status' => 200,
            'data' => $user
        ],200);
    }

    public function saveDeviceToken(Request $request){
        Auth::user()->update(['device_token' => $request->device_token]);
        return response()->json([
            'message'=>'Berhasil menyimpan token',
            'status' => 200,
        ], 200);
    }
}
