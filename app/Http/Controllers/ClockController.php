<?php

namespace App\Http\Controllers;

use App\Http\Services\ClocksService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Facades\JWTAuth;


class ClockController extends Controller
{
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
