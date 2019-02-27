<?php

namespace HServer\core;
class Request
{
    /**
     * @var array
     */
    protected $headers;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $post;

    /**
     * @var array
     */
    protected $get;

    /**
     * @var array
     */
    protected $payload;

    /**
     * @var array
     */
    protected $cookie;

    /**
     * @var array|null
     */
    protected $session;

    /**
     * @var array
     */
    protected $files;

    /**
     * @var string
     */
    protected $hostname;

    /**
     * @var string
     */
    protected $requestUri;

    /**
     * @var string
     */
    protected $fullRequestUri;

    /**
     * @var string
     */
    protected $ip;

    //Unstable
    /**
     * @var null|Lang
     */
    protected $lang = null;

    /**
     * @var null|object
     */
    protected $controllerInfo = null;


    public function __construct($data)
    {
        $this->headers = $data['server'];
        $this->method = strtoupper($this->headers['REQUEST_METHOD']);
        // Parsing get parameters
        foreach ($data['get'] as $key => $value) {
            $this->get[$key] = $value;
        }
        // Parsing post parameters
        foreach ($data['post'] as $key => $value) {

            $this->post[$key] = $value;
        }

        $this->hostname = $this->headers['HTTP_HOST'];
        $this->fullRequestUri = $this->headers['REQUEST_URI'];
        $this->requestUri = $this->headers['REQUEST_URI'];
        if (!!strpos($this->requestUri, "?")) {
            $this->requestUri = strtolower(substr($this->requestUri, 0, strpos($this->requestUri, "?")));
        }
        $this->ip = $this->headers['REMOTE_ADDR'];
    }

    public function get($key = null, $value = null)
    {
        if (is_null($key)) {
            return (object)$this->get;
        }
        if (is_null($value)) {
            return isset($this->get[$key]) ? $this->get[$key] : null;
        } else {
            $this->get[$key] = $value;
        }
    }

    public function post($key = null, $value = null)
    {
        if (is_null($key)) {
            return (object)$this->post;
        }
        if (is_null($value)) {
            return isset($this->post[$key]) ? $this->post[$key] : null;
        } else {
            $this->post[$key] = $value;
        }
    }


    public function rawPost($data = null)
    {
        if (is_null($data)) {
            return filter($GLOBALS['HTTP_RAW_POST_DATA']);
        } else {
            $GLOBALS['HTTP_RAW_POST_DATA'] = $data;
        }
    }

    public function payload($data = null)
    {
        if (is_array($data)) {
            $this->payload = $data;
        } else if (is_null($data)) {
            return (object)$this->payload;
        } else if (is_string($data)) {
            return isset($this->payload[$data]) ? $this->payload[$data] : null;
        }
    }


    public function cookie($key = null)
    {
        if (is_null($key)) {
            return (object)$this->cookie;
        } else {
            return isset($this->cookie[$key]) ? $this->cookie[$key] : null;
        }
    }

    public function session($key = null)
    {
        if (is_null($key)) {
            return (object)$this->session;
        } else {
            return isset($this->session[$key]) ? $this->session[$key] : null;
        }
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getHostname()
    {
        return $this->hostname;
    }

    public function getUri()
    {
        return $this->requestUri;
    }

    public function getFullUri()
    {
        return $this->fullRequestUri;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getMethod()
    {
        return $this->method;
    }

}