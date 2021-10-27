<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index() {
        return User::latest()->get();
    }

    public function register(Request $request){
        // $request->validate([
        //     'password' => 'required|confirmed'
        // ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        $token = $user->createToken('MyToken')->plainTextToken;

        return response()->json([
            'Message' => 'Created',
            'data' => $user,
            'token' => $token
        ], 201);
    }

    public function logout( Request $request){
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>'Log Out']);
    }

    // public function login(Request $request)
    // {
        
    //     $user = User::where('email', $request->email)->first();
    //     if (!$user || !Hash::check($request->password, $user->password)){
    //         return response()->json(['massage'=> 'Bad Login'], 404);
    //     }

    //     $token = $user->createToken('MyToken')->plainTextToken;

    //     return response()->json([
    //         'Message' => 'Created',
    //         'data' => $user,
    //         'token' => $token
    //     ], 201);
    // }
}
