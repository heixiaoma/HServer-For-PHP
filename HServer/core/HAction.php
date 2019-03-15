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

use HServer\config\HDb;
use HServer\config\HRedis;

class HAction
{
    protected $db;
    protected $redis;

    /**
     * HAction constructor.
     * @param $db
     * @param $redis
     */
    public function __construct()
    {
        $this->db = HDb::getInstance();
        $this->redis = HRedis::getInstance();
    }


}