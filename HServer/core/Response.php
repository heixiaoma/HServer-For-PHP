<?php
/**
 *  ThinkWorker - THINK AND WORK FAST
 *  Copyright (c) 2017 http://thinkworker.cn All Rights Reserved.
 *  Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 *  Author: Dizy <derzart@gmail.com>
 */

namespace HServer\core;

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
        $path = __DIR__ . "/../../app/action/" . $paths[1] . ".php";
        if (count($paths) > 2 && is_file($path)) {
            require_once $path;
            $class = new \ReflectionClass($paths[1]);
            $controller = $class->newInstanceArgs();
            if ($class->hasMethod($paths[2])) {
                $method = $class->getMethod($paths[2]);
                $data = $method->invoke($controller);
                if (!empty($data)) {
                    if (gettype($data) === "string") {
                        $this->send($data);
                    } else {
                        $this->json($data);
                    }
                }
            } else {
                $this->send("404");
            }
        } else {
            $this->send("无法访问控制器--->首页路径");
        }
        $this->json("老铁，无数据输出！");
    }


}