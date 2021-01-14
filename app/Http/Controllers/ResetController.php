<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;

class ResetController extends Controller
{
    public function __invoke()
    {
        $vehicles = Redis::smembers("vehicles");

        Redis::pipeline(function ($redis) use ($vehicles) {
            foreach ($vehicles as $vehicle) {
                $redis->del("readings/{$vehicle}");
            }
            $redis->del("vehicles");
        });

        \DB::collection('simple_collection')->delete();
        \DB::collection('enhanced_collection')->delete();

        return response()->json(['status' => 'ok']);
    }
}
