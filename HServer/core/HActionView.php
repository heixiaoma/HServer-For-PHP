<?php
/**
 * Created by PhpStorm.
 * User: hxm
 * Date: 2019/2/20
 * Time: 17:10
 */

namespace HServer\core;



class HActionView extends HServerDB
{


    /**
     * @var Response
     */
    protected $Response;

    /**
     * @var Request
     */
    protected $Request;



    /**
     * @param mixed $Response
     */
    public function setResponse($Response)
    {
        $this->Response = $Response;
    }

    /**
     * @param mixed $Request
     */
    public function setRequest(Request $Request)
    {
        $this->Request = $Request;
    }




}