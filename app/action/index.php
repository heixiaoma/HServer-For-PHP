<?php
/**
 * Created by PhpStorm.
 * User: hxm
 * Date: 2019/2/21
 * Time: 16:59
 */


use HServer\core\view\HActionView;

class index extends HActionView
{

    public function main()
    {
        $this->Response->json(array("a" => 1));
    }

    public function html()
    {
        $this->assign("content", "HServer");
        $html = $this->fetch("index.html");
        $this->Response->send($html);
    }


//    /**
//     * db操作，记得开启配置
//     * @return string
//     */
//    public function db()
//    {
//        $this->redis->get("user");
//        $this->db->query("select * from user");
//    }


}