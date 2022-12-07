<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use stdClass;

class ClocksService
{
    public static function getClock(string $userId): stdClass
    {
        $clock = DB::table('clocks')->where('user_id', $userId)->first();
        if ($clock === null) {
            DB::table('clocks')->insert(
                [
                    'user_id' => $userId,
                    'last_update_timestamp' => time(),
                    'time' => time(),
                ]
            );
            $clock = DB::table('clocks')->where('user_id', $userId)->first();
        }

        return $clock;
    }

    public static function updateClock(string $userId, int $time): stdClass
    {
        DB::table('clocks')
            ->where('user_id', $userId)
            ->update([
                'last_update_timestamp' => time(),
                'time' => $time,
            ]
        );

        return DB::table('clocks')->where('user_id', $userId)->first();
    }
}
