<?php
/**
 * Created by PhpStorm.
 * User: hxm
 * Date: 2019/2/20
 * Time: 17:10
 */

namespace HServer\core;

require_once __DIR__ . "/../config/HDb.php";
require_once __DIR__ . "/../config/HRedis.php";
require_once __DIR__ . '/../../vendor/smarty/Smarty.class.php';

use HServer\config\HDb;
use HServer\config\HRedis;
use Kafka\Exception;

class HActionView
{
    protected $db;
    protected $redis;
    protected $view;
    /**
     * HAction constructor.
     * @param $db
     * @param $redis
     */
    public function __construct()
    {
        $this->db = HDb::getInstance();
        $this->redis = HRedis::getInstance();
        $this->view=new \Smarty();

    }



    protected function assign($key,$value){
        $this->view->assign($key,$value);
    }

    protected function fetch($tpl,$path="app/view"){
            if ($path != "app/view") {
                $path = "app/view" . $path;
            }
            $this->view->setTemplateDir($path);
        return $this->view->fetch($tpl);

    }

}