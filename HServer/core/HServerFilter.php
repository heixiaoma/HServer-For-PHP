<?php
/**
 * Created by PhpStorm.
 * User: hxm
 * Date: 2019/4/10
 * Time: 12:01
 */

namespace HServer\core;


abstract class HServerFilter extends HServerDB
{
    protected $level = 1;

    public abstract function auth();

    /**
     * @var Response
     */
    protected $Response;

    /**
     * @var Request
     */
    protected $Request;


    /**
     * @param Response $Response
     */
    public function setResponse($Response)
    {
        $this->Response = $Response;
    }

    /**
     * @param Request $Request
     */
    public function setRequest($Request)
    {
        $this->Request = $Request;
    }





}