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

    public function __construct()
    {
        $this->db = HDb::getInstance();
        $this->redis = HRedis::getInstance();
    }

}