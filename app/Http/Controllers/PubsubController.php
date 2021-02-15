<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;


class PubsubController extends Controller
{
    
    /**
     * create a channel
     * @param string $topic 
     */
    public function store(Request $request, $topic)
    {

        Redis::publish($topic, json_encode([
            $request->all(),
            ]));

            return response()->json([
                'topic' => $topic,
                'status' => true,
                'time' => now(),
                'data' => [
                    $request->all(),
                ]
                ], 200);
    }

    /**
     * subscribe to a channel
     * @param string $topic 
     */
    public function subscribe($topic)
    {

         Redis::subscribe([$topic], function ($message) {
            print($message);
        });
    }

}
