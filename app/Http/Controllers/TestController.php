<?php

namespace App\Http\Controllers;


use App\Facades\rpcClient;

class TestController extends Controller
{
    public function index(){

        $data = rpcClient::rpcCall('cache','hello');
        return response()->json([$data]);
    }

}
