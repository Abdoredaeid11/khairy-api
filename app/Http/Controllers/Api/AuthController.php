<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\Auth\AuthService;
class AuthController extends Controller
{
protected $authService;
public function __construct(AuthService $authService)
{
    $this->authService = $authService;
}

public function login(Request $request){
    $data = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    $result = $this->authService->login($data);
    if($result === null) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    return response()->json($result);
}
public function register(Request $request){

    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $result = $this->authService->register($data);
    return response()->json($result, 201);
}
public function logout(Request $request){
    $user = $request->user();
    $this->authService->logout($user);
    return response()->json(['message' => 'Logged out successfully']);
}
}
