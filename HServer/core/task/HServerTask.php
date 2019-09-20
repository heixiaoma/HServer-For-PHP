<?php
/**
 * Created by PhpStorm.
 * User: hxm
 * Date: 2019/4/10
 * Time: 13:25
 */

namespace HServer\core\task;

use HServer\core\db\HDb;
use HServer\core\db\HRedis;

/**
 * Class HServerTask
 * @package HServer\core\task
 */
abstract class HServerTask
{
    protected $db;
    protected $redis;
    protected $time;

    public function __construct()
    {
        $this->db = HDb::getInstance();
        $this->redis = HRedis::getInstance();

    }

    public abstract function run();

}