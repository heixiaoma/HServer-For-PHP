<?php
/**
 * Created by PhpStorm.
 * User: hxm
 * Date: 2019/2/21
 * Time: 16:59
 */


use HServer\core\HActionView;

class index extends HActionView
{

    public function main()
    {
        return array("我是Main方法");
    }

    public function indexa()
    {
        $this->assign("content","HServer");
        $a=$this->fetch("index.html");
        return $a;
    }

}