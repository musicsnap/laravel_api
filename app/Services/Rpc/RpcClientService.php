<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\5\8 0008
 * Time: 23:07
 */
namespace App\Services\Rpc;

use Hprose\Socket\Client;

class RpcClientService
{

    public function call($method ,$params = [])
    {

    }

    /**
     * distribute
     * @Author:Yume777
     * @Date:2019\8\4 0004 16:20
     * @Description:
     */
    public function distribute()
    {

    }

    /**
     * callOut
     * @Author:Yume777
     * @Date:2019\8\4 0004 16:20
     * @Description:外部调用
     */
    public function callOut()
    {

    }

    /**
     * callIn
     * @Author:Yume777
     * @Date:2019\8\4 0004 16:20
     * @Description:内部调用
     */
    public function callIn($method ,$params = [])
    {
        $class_name = '';

        $obj = new $class_name;

        try{
            $result = call_user_func([$obj,$method],$params);
            var_dump($result);
        }catch (\Exception $exception) {

        }
    }

    public function rpcCall($service,$method ,$params = [])
    {
        $conf = config('rpc');
        $client = new Client($conf['uri'],false);

        $service_method = $service.'_'.$method;
        $res = $client->invoke("$service_method",$params);
//        $res = $client->$service_method($params);
        return $res;
    }

    public function __call($name, $arguments)
    {
        //
        $data = array(
            'service'=>$arguments['0'],
            'method'=>$name,
            'params'=>$arguments
        );

    }
}
