<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return response()->json('Validation Error.', 402);    
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $data['token'] =  $user->createToken('MyApp')->accessToken;
        $data['name'] =  $user->name;

        $response = [
            'success' => true,
            'data'    => $data,
            'message' => 'User register successfully.',
        ];

        return response()->json($response, 200);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $data['token'] =  $user->createToken('MyApp')-> accessToken; 
            $data['name'] =  $user->name;

            $response = [
                'success' => true,
                'data'    => $data,
                'message' => 'User login successfully.',
            ];
    
            return response()->json($response, 200);

        } 
        else{ 
            $response = [
                'success' => false,
                'message' => 'Unauthorised',
            ];

            return response()->json($response, 404);
        } 
    }
}
