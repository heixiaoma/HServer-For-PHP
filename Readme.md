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

- 源代码全在 app 文件夹里面
- 静态文件在 static 文件夹里面
- 访问地址：  
    http://127.0.0.1:8800/index/main  
    http://127.0.0.1:8800/index/html

#### 更新日志

请查看 [CHANGELOG.md](CHANGELOG.md) 了解近期更新情况。
