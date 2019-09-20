<?php
/**
 * Created by PhpStorm.
 * User: hxm
 * Date: 2019/4/10
 * Time: 13:25
 */

namespace HServer\core\db;

require_once __DIR__ . '/../../../vendor/smarty/Smarty.class.php';

class HServerDB
{
    protected $db;
    protected $redis;
    protected $view;

    public function __construct()
    {
        $this->db = HDb::getInstance();
        $this->redis = HRedis::getInstance();
        $this->view = new \Smarty();

    }

    protected function assign($key, $value)
    {
        $this->view->assign($key, $value);
    }

    protected function fetch($tpl, $path = "app/view")
    {
        if ($path != "app/view") {
            $path = "app/view" . $path;
        }
        $this->view->setTemplateDir($path);
        return $this->view->fetch($tpl);

    }

}