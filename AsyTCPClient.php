<?php
// 创建异步TCP客户端
$client = new swoole_client(SWOOLE_COCK_TCP, SWOOLE_SOCK_ASYNC);

// 注册连接成功的回调
$client->on('connect', function ($cli) {
	$cli->send('hello \n');
});

// 注册数据接收 $cli 服务端信息 $data 数据
$client->on('receive', function ($cli, $data) {
	echo "data: $data";
});

// 注册连接失败
$client->on('error', function ($cli) {
	echo '失败';
});

// 注册关闭函数
$client->on('close', function ($cli) {
	echo '关闭\n';
});

//发起连接
$client->connect('192.168.1.31', 8080, 10);