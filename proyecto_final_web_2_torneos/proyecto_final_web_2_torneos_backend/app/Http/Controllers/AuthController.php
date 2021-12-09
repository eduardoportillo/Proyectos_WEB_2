<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        if (!User::where('email', $request->json("email"))->exists()) {
            $user = User::create([
                "name"=>$request->json("name"),
                "last_name"=>$request->json("last_name"),
                "email"=>$request->json("email"),
                "password"=>bcrypt($request->json("password")),
            ]);
            $user->assignRole("common_user");
            return response()->json([$user], 201);
        }else{
            return response()->json( ["message" =>  "registered user."]);
        }

    }

    public function login(Request $request){
        $credentials = request(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            return response()->json([
                "access_token" => $tokenResult->plainTextToken
            ]);
        } else {
            return response()->json([
                "Error" => "Not Found."
            ], 404);
        }
    }
}
