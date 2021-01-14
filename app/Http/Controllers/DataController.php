<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class DataController extends Controller
{
    public function __invoke(Request $request)
    {
        $num_points = $request->numPoints ?? 128;

        $vehicles = Redis::smembers("vehicles");

        $data = Redis::transaction(function ($redis) use ($vehicles, $num_points) {
            foreach ($vehicles as $vehicle) {
                $redis->zcount("readings/{$vehicle}", "-inf", "+inf");
            }
            foreach ($vehicles as $vehicle) {
                $redis->zrevrangebyscore("readings/{$vehicle}", "+inf", "-inf", "limit", 0, $num_points);
            }
        });

        $res = [];

        foreach ($vehicles as $i => $vehicle) {
            foreach ($data[$i+sizeof($vehicles)] as &$datum) {
                $datum = json_decode($datum);
            }
            $full_dataset = $data[$i+sizeof($vehicles)];
            $full_dataset = array_reverse(array_values(array_filter($full_dataset, function($item) {
                return $item->lat != -1 and $item->lon != -1;
            })));
            $set = [
                'count' => sizeof($full_dataset),
                'items' => ($full_dataset)//array_slice($full_dataset, max(0, sizeof($full_dataset)-13), sizeof($full_dataset)-1)
            ];

            $res[$vehicle] = $set;
        }
//        $data = array_combine($vehicles, array_slice($data, 0, sizeof($vehicles)));
//        $data2 = array_combine($vehicles, array_slice($data, 0, sizeof($vehicles)));

        return response()->json($res);

    }
}
