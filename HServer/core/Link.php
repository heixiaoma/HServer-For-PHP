<?php
/**
 * Created by PhpStorm.
 * User: hxm
 * Date: 2019/4/10
 * Time: 12:51
 */

namespace HServer\core;


use function PHPSTORM_META\map;

class Link
{

    private static $map=array();


    public static function invoke($req,$resp)
    {

        $map=array();

        /**
         * 扫描Filter文件路径
         */
        $path = __DIR__ . "/../../filter/";
        $filterFile = scandir($path);
        foreach ($filterFile as $filename) {
            if ($filename != '.' && $filename != '..' && $filename . strpos($filename, 'php') !== false) {
                $classpath = $path . $filename;
                $classname = substr($filename, 0, -4);
                require_once($classpath);
                $class = new \ReflectionClass($classname);
                $filter = $class->newInstanceArgs();
                if ($class->hasMethod("auth")) {

                    $setRequest = $class->getMethod("setRequest");
                    $setRequest->setAccessible(true);
                    $setRequest->invoke($filter, $req);

                    $setResponse = $class->getMethod("setResponse");
                    $setResponse->setAccessible(true);
                    $setResponse->invoke($filter, $resp);

                    $level = $class->getProperty('level');
                    $level->setAccessible(true);
                    $index=$level->getValue($filter);

                    $a=array("level"=>$index,"filter"=>$filter,"class"=>$class);
                    $map[]=$a;
                    array_multisort(array_column($map,'level'),SORT_DESC,$map);

                } else {
                    echo "无拦截器";
                }
            }
        }
        foreach ($map as $m){

            $setResponse = $m['class']->getMethod("auth");
            $setResponse->setAccessible(true);
            $setResponse->invoke($m['filter']);


        }


    }


}