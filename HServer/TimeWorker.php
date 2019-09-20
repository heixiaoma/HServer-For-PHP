<?php
/**
 * Created by PhpStorm.
 * User: hxm
 * Date: 2019/9/12
 * Time: 17:46
 */

namespace HServer;

require_once __DIR__ . '/../vendor/wokerman/workerman/Autoloader.php';

use Workerman\Worker;
use \Workerman\Lib\Timer;

class TimeWorker extends Worker
{
    public function __construct($socket_name = '', array $context_option = array())
    {
        parent::__construct($socket_name, $context_option);
    }


    public function onClientStart($worker)
    {
        $time_interval = 2.5;
        Timer::add($time_interval, function () {
            echo "task run\n";
        });
        echo "定时器启动";
    }


    public function run()
    {
        Worker::$logFile = __DIR__ . '/../log/task.log';
        Worker::$stdoutFile = __DIR__ . '/../log/task_stdout.log';
        $this->onWorkerStart = array($this, 'onClientStart');
        parent::run();
    }


}