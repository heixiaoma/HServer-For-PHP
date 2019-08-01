<?php
/**
 *  ThinkWorker - THINK AND WORK FAST
 *  Copyright (c) 2017 http://thinkworker.cn All Rights Reserved.
 *  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 *  Author: Dizy <derzart@gmail.com>
 */

namespace HServer\core;

use HServer\core\ioc\Container;
use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http;

class Response
{
    /**
     * @var TcpConnection
     */
    protected $connection;

    /**
     * @var Request
     */
    protected $req;

    /**
     * @var bool
     */
    private $sent;

    /**
     * Response constructor.
     * @param $connection
     */
    public function __construct($connection, $req)
    {
        $this->connection = $connection;

        $this->req = $req;
        $this->sent = false;
    }

    public function setHeader($content, $replace = true, $statusCode = 0)
    {
        return Http::header($content, $replace, $statusCode);
    }


    public function rmHeader($name)
    {
        Http::headerRemove($name);
        return true;
    }

    public function setContentType($type, $charset = "utf-8")
    {
        return Http::header("Content-Type: " . $type . ";charset=" . $charset);
    }

    /**
     * 发送静态文件
     * @param $data
     */
    public function sendStaticFile($head, $data)
    {

        $this->setContentType($head);
        $this->send($data);
    }


    public function send($body = "")
    {
        $this->connection->send($body);
        $this->sent = true;
    }


    public function json($data)
    {
        $this->setContentType("application/json");
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->send($data);
    }

    public function redirect($url, $statusCode = 302)
    {
        $this->setHeader("HTTP", true, $statusCode);
        $this->setHeader("Location: " . $url);
        $this->send();
    }


    public function invoke()
    {
        $paths = explode("/", $this->req->getFullUri());
        $path = null;
        $size = count($paths);
        if ($size > 2) {
            $boo = strpos($paths[$size - 1], "?");
            if ($boo > 0) {
                $paths[$size - 1] = substr($paths[$size - 1], 0, $boo);
            }
        }
        $classname = $paths[$size - 2];
        for ($i = 0; $i < $size - 1; $i++) {
            if (strlen($paths[$i]) > 0) {
                $path .= "/" . $paths[$i];
            }
        }

        $path = __DIR__ . "/../../app/action" . $path . ".php";
        if (count($paths) > 2 && is_file($path)) {
            /**
             * 判断容器，
             */
            if (Container::exist($classname)) {
                try {
                    $Obj = Container::getBean($classname);
                    $setResponse = "setResponse";
                    $setRequest = "setRequest";
                    $method = $paths[$size - 1];
                    $Obj->$setRequest($this->req);
                    $Obj->$setResponse($this);
                    $Obj->$method();
                } catch (\Throwable $exception) {
                    $this->send("404->" . $exception->getMessage());
                }
                return;
            }

            /**
             * 首次加载
             */
            $class = new \ReflectionClass($classname);
            $controller = $class->newInstanceArgs();
            Container::addBean($classname, $controller);
            if ($class->hasMethod($paths[$size - 1])) {
                $setResponse = $class->getMethod("setResponse");
                $setRequest = $class->getMethod("setRequest");
                /**
                 * 反射传入request和response
                 */
                $setRequest->setAccessible(true);
                $setRequest->invoke($controller, $this->req);
                $setResponse->setAccessible(true);
                $setResponse->invoke($controller, $this);

                $method = $class->getMethod($paths[$size - 1]);
                $method->invoke($controller);
            } else {
                $this->send("404");
            }
        } else {
            $this->send("无法访问控制器--->首页路径");
        }
    }
}