<?php

namespace App\Http\Controllers;

use App\Http\Services\ClocksService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class UserController extends Controller
{
    public function register (Request $request): JsonResponse {
        $validator = Validator::make($request->json()->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->json()->get('name'),
            'email' => $request->json()->get('email'),
            'password' => Hash::make($request->json()->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'), 201);

    }

    public function login (Request $request): JsonResponse {
        $credentials = $request->json()->all();

        try {
            if (!$token = JWTAuth::attempt($credentials)){
                return response()->json(['error'=>'Invalid Credentials'], 400);
            }
        } catch (JWTException $e){
            return response()->json(['error'=>'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));

    }

    public function isAuthenticated(): JsonResponse
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['token_invalid'], 400);
            }
        } catch (\Throwable $t){
            return response()->json(['token_is_invalid'], 400);
        }

        return response()->json();
    }

    public function getClock(): JsonResponse {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['token_invalid'], 400);
            }
        } catch (\Throwable $t) {
            return response()->json(['token_is_invalid'], 400);
        }

        $clock = ClocksService::getClock($user->id);

        return response()->json(compact('clock'));
    }

    public function updateClock(Request $request): JsonResponse {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['token_invalid'], 400);
            }
        } catch (\Throwable $t) {
            return response()->json(['token_is_invalid'], 400);
        }

        $time = $request->get('time');
        $clock = ClocksService::updateClock($user->id, $time);

        return response()->json(compact('clock'));
    }
}
