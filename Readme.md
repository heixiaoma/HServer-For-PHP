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

    重启
    4，php start.php restart

    平滑重启
    5，php start.php reload

#### 配置文件
    关于redis和mysql在Hserver/config/config.php
    配置好后开启就可以在控制器中使用了

#### 编写代码
    全在app文件夹里面
    静态文件在static文件夹里面


访问：
    http://127.0.0.1:8800/index/main
    http://127.0.0.1:8800/index/html
    
#### 2019-9-20
    对文件进行优化，
    正在处理定时器任务工具的封装
    定时任务文件存放在app
    拦截器存放在App
    静态文件存在在App
    action存在App
    view模板文件存在App里面
    Task任务继承，HServerTask，父类封装了DB和Redis相关的操作
    
    由于Task是单独woker，所以启动方式Linux不变，win请点击start_for_win.bat
    
    下次预计更新，错误日志定位监控
 
#### 2019-8-4
    对Req和Resp优化
    对自动加载目录优化

#### 2019-7-31 
     添加实例容器，不用每次再去反射
     第一次反射进容器，第二次走容器拿数据
     相比以前每次反射，调用性能提高58%

#### 2019-5-20
     添加文件上传功能
     $file=$this->Request->file("file");
     $file->save("路径");
     $file->save("路径","别名");
     

#### 2019-4-12
     修复自动加载加载机制


#### 2019-4-10
     修改，HActionView 添加req，和resp
     添加拦截器：HServerFilter,继承并实现auth方法，重写Level属性，设置优先级，越大，越先

#### 2019-7-30
     ab压测截图如下，吞吐率 7w+ 测试机:Centos event扩展 4核,2G, 
![AB测试](https://gitee.com/heixiaomas/HServer/raw/master/app/static/img/d.png)

![运行截图](https://gitee.com/heixiaomas/HServer/raw/master/app/static/img/b.png)