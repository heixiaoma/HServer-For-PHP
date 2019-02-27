<?php
/**
 * Created by PhpStorm.
 * User: hxm
 * Date: 2019/2/20
 * Time: 15:20
 */

namespace HServer;

require_once __DIR__ . '/../vendor/wokerman/workerman/Autoloader.php';

use HServer\core\Request;
use HServer\core\Response;
use Workerman\Worker;
use HServer\core\StaticFiles;

class HWebServer extends Worker
{
    public function __construct($socket_name = '', array $context_option = array())
    {
        parent::__construct($socket_name, $context_option);

    }

    public function onClientMessage($connection, $data)
    {
        $temp = new StaticFiles($connection);
        if ($temp->invoke()) {
            return false;
        }
        $req = new  Request($data);
        $resp = new Response($connection, $req);
        $resp->invoke();
    }

    public function run()
    {
        Worker::$logFile = __DIR__ . '/../log/workerman.log';
        Worker::$stdoutFile = __DIR__ . '/../log/stdout.log';
        $this->reusePort = true;
        $this->onMessage = array($this, 'onClientMessage');
        parent::run();
    }

}