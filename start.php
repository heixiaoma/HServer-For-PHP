<?php
/**
 * Created by PhpStorm.
 * User: hxm
 * Date: 2019/2/20
 * Time: 15:40
 */
require_once __DIR__ . '/HServer/Autoloader.php';

/**
 * 核心自动加载
 */
Autoloader::RegisterPsr4("HServer", __DIR__ . "/HServer");

/**
 * Filter app自动加载
 */
Autoloader::RegisterDir([__DIR__ . '/filter', __DIR__ . '/app/action']);

use HServer\HWebServer;

$web = new HWebServer("http://0.0.0.0:8800");
$web->name = "HServer";
$web->count = 4;
$web::runAll();