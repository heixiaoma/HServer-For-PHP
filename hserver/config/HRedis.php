<?php
/**
 * Created by PhpStorm.
 * User: hxm
 * Date: 2019/2/21
 * Time: 13:52
 */

namespace HServer\config;

class HRedis
{
    /**
     * 静态成品变量 保存全局实例
     */
    private static $_instance;

    /**
     * 单例模式
     */
    public static function getInstance()
    {
        $re = config::getRedis();
        if ($re['flag']) {
            if (!isset(self::$_instance)) {
                $redis = new \Redis();
                $redis->connect($re["host"], $re["port"]);
                if (count($re["password"]) > 0) {
                    $redis->auth($re["password"]);
                }
                self::$_instance = $redis;
            }
            return self::$_instance;
        }
    }


}