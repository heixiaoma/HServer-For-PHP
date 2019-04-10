<?php
/**
 * Created by PhpStorm.
 * User: hxm
 * Date: 2019/4/10
 * Time: 14:52
 */

use \HServer\core\HServerFilter;
class FilterTest extends HServerFilter
{
    protected $level=3;

    public function auth()
    {
       echo "我是拦截器3\n";
    }
}