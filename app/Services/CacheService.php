<?php
namespace App\Services;

class CacheService
{
    static public $arr = array();

    public function set($key,$value)
    {
        self::$arr[$key] =$value;
    }

    public function get($key)
    {
        return self::$arr[$key];
    }
}
