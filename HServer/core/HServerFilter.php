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
    private function setResponse($Response)
    {
        $this->Response = $Response;
    }

    /**
     * @param Request $Request
     */
    private function setRequest($Request)
    {
        $this->Request = $Request;
    }





}