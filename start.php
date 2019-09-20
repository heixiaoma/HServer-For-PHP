<?php
/**
 * Created by PhpStorm.
 * User: hxm
 * Date: 2019/2/20
 * Time: 15:40
 */
require_once __DIR__ . '/HServer/Autoloader.php';

use Workerman\Worker;

/**
 * 核心自动加载
 */
Autoloader::RegisterPsr4("HServer", __DIR__ . "/HServer");

/**
 * Filter 自动加载
 */
Autoloader::RegisterDir(__DIR__ . '/filter');

/**
 * 自动加载APP
 */
function load($path)
{
    //1、首先先读取文件夹
    $temp = scandir($path);
    //遍历文件夹
    foreach ($temp as $v) {
        $a = $path . '/' . $v;
        if (is_dir($a)) {//如果是文件夹则执行

            if ($v == '.' || $v == '..') {//判断是否为系统隐藏的文件.和..  如果是则跳过否则就继续往下走，防止无限循环再这里。
                continue;
            }
            Autoloader::RegisterDir($a);
            load($a);//因为是文件夹所以再次调用自己这个函数，把这个文件夹下的文件遍历出来
        }
    }
}

load(__DIR__ . "/app");
//
// 检查扩展
if (!extension_loaded('pcntl')) {
    exit("Please install pcntl extension. See http://doc3.workerman.net/install/install.html\n");
}

if (!extension_loaded('posix')) {
    exit("Please install posix extension. See http://doc3.workerman.net/install/install.html\n");
}

// 标记是全局启动
define('GLOBAL_START', 1);

require_once __DIR__ . '/vendor/autoload.php';

// 加载所有Applications/*/start.php，以便启动所有服务
foreach (glob(__DIR__ . '/HServer/init/start*.php') as $start_file) {
    require_once $start_file;
}
// 运行所有服务
Worker::runAll();
