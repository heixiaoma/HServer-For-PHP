# HServer

#### 介绍
基于Workerman而做的一个高并发Webserver


#### 运行方式

    启动
    1，php start.php start

    停止
    2，php start.php stop

    状态查询
    3，php start.php status


#### 配置文件
    关于redis和mysql在Hserver/config/config.php
    配置好后开启就可以在控制器中使用了

#### 编写代码
    全在app文件夹里面
    静态文件在static文件夹里面


访问：
    http://127.0.0.1:8800/index/main
    http://127.0.0.1:8800/index/indexa



注意：控制器，各部分都需要优化，目前没有时间搞，有时间想重新设计一次

![AB测试](https://gitee.com/heixiaomas/HServer/raw/master/static/img/c.jpg"未命名拼图 (1).jpg")

![运行截图](https://gitee.com/heixiaomas/HServer/raw/master/static/img/b.jpg"未命名拼图 (1).jpg")