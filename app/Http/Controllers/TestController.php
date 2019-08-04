<?php

namespace App\Http\Controllers;


use App\Facades\rpcClient;

class TestController extends Controller
{
    //
    public function index(){
        rpcClient::rpcCall(1,2);
    }

}
