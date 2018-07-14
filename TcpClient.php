<?php
$client = new swoole_client(SWOOLE_SOCK_TCP);

$client->connect('192.168.1.31', 8080, 5) or die('连接失败');

//发送数据
$client->send('hello,world') or die('发送失败');

//从服务器接收数据
$data = $client->recv();

if ($data) {
	var_dump($data);
} else {
	die('接收失败');
}

$client->close();