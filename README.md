# HServer

#### 介绍

基于 Workerman 而做的一个高并发 WebServer。

#### 运行方式

```shell
# 启动
php start.php start

# 停止
php start.php stop

# 状态查询
php start.php status

# 重启
php start.php restart

# 平滑重启
php start.php reload
```

#### 配置文件

关于 redis 和 mysql 在 [Hserver/config/config.php](HServer/config/Config.php)，配置好后开启就可以在控制器中使用了。

#### 编写代码

#####目录介绍和启动测试
```
├─app               #app是我们开发用最多的文件夹
│  ├─action         #控制器编写目录
│  ├─filter         #拦截器目录    
│  ├─static         #静态文件目录
│  ├─task           #定时任务目录
│  └─view           #smart模板目录    
├─HServer           #HServer核心逻辑
├─log               #程序跑飞时产生的日志文件
├─templates_c       #模板生成的缓存目录
└─vendor            #框架库

```
- 更具平台对应启动HServer
- 访问测试地址：  
    http://127.0.0.1:8800/index/main  
    http://127.0.0.1:8800/index/html
- 你将看到最基本的HelloWord

#####项目架构
    
![AB测试](https://gitee.com/heixiaomas/HServer/raw/master/app/static/img/f.png)

#####路由规则


#### 更新日志

请查看 [CHANGELOG.md](CHANGELOG.md) 了解近期更新情况。
