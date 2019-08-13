<?php
namespace App\Services;

class CacheService
{
    static public $arr = array();

    public function set($params)
    {
        self::$arr[$params['key']] =$params['value'];
    }

    public function get($params)
    {
        return self::$arr[$params['key']];
    }

    public function hello($params)
    {
        $service = $params['service'];
        $method = $params['method'];
        $params = json_encode($params['param'],true);
        return "this is {$service} 服务;$method 方法;参数 {$params}";
    }
}
