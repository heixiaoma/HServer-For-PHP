<?php
/**
 * Created by PhpStorm.
 * User: hxm
 * Date: 2019/2/20
 * Time: 15:40
 */
require_once __DIR__ . '/hserver/Autoloader.php';

use HServer\HWebServer;

$web = new HWebServer("http://0.0.0.0:8800");
$web->name = "HServer";
$web->count = 4;
$web::runAll();