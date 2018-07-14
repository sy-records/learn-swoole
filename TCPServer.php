<?php

//创建服务器
$host = '0.0.0.0';
$port = 9501;
/**
 * $mode 多进程模式（默认）
 * $sock_type 指定Socket的类型，支持TCP、UDP、TCP6、UDP6、UnixSocket Stream/Dgram 6种
 */
$serv = new swoole_server($host, $port);

/**
 * connet 当建立连接的时候 $serv 服务器信息 $fd 客户端信息 标识
 * receive 当接收到数据 $serv 服务器信息 $fd 客户端 $from_id ID $data 数据
 * close 关闭连接
 */
$serv->on('connect', function ($serv, $fd) {
	echo "建立连接\n";
});

$serv->on('receive', function ($serv, $fd, $from_id, $data) {
	echo "接收到数据\n";
	var_dump($data);
});

$serv->on('close', function ($serv, $fd) {
	echo "连接关闭\n";
});

$serv->start();