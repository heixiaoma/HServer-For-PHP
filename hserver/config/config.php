<?php
/**
 * Created by PhpStorm.
 * User: hxm
 * Date: 2019/2/21
 * Time: 13:56
 */


namespace HServer\config;

class config{

    public static function getRedis(){
        $redis = array();
        $redis["host"] = "47.99.211.65";
        $redis["port"] = 6379;
        //无密码留空
        $redis["password"] = "123456a.";
        //是否开启redis
        $redis['flag'] = false;
        return $redis;
    }

    public static function getDB(){
        $db = array();
        $db["host"] = "10.10.11.171";
        $db["user"] = "root";
        $db["password"] = "root";
        $db["db"] = "demo";
        $db["port"] = 3306;
        //是否开启db
        $db['flag'] = false;
        return $db;
    }

}