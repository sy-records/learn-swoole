<?php

$client = new swoole_client(SWOOLE_SOCK_TCP | SWOOLE_ASYNC);

$client->on("connect", function(swoole_client $cli) {
	$data="hello server";
	$cli->send($data);
});

$client->on("receive", function(swoole_client $cli, $data) {
	echo "received: $data\n";
});

$client->on("close", function(swoole_client $cli){
	echo "close\n";
	$cli->close();
});

$client->on("error", function(swoole_client $cli){
	echo "error\n";
	$cli->close();
});

$client->connect('127.0.0.1', 9501);

Swoole\Timer::tick(3000, function () use ($client) {
	$data = "heartbeat";
	$client->send($data);
});
