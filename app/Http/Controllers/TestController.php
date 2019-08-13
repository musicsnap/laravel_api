<?php

namespace App\Http\Controllers;


use App\Facades\rpcClient;

class TestController extends Controller
{
    public function index(){
        $param = array(
            'service'=>'cache',
            'method'=>'hello',
            'param'=>array(
                'name'=>'xx',
                'age'=>'12',
            ),
        );
        $data = rpcClient::rpcCall('cache','hello',[$param]);
        return response()->json(['res'=>$data]);
    }

}
