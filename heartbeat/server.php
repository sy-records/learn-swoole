<?php

$serv = new Swoole\Server("127.0.0.1", 9501);
$serv->set(array(
    'heartbeat_idle_time' => 9, // 一个连接如果9秒内未向服务器发送任何数据，此连接将被强制关闭
    'heartbeat_check_interval' => 5, // 每5秒遍历一次
));
$serv->on('connect', function ($serv, $fd) {
    echo "fd:{$fd} Client:Connect.\n";
});
$serv->on('receive', function ($serv, $fd, $reactor_id, $data) {
    echo "fd:{$fd} Client:receive:{$data}.\n";
    $serv->send($fd, 'Server send');
});
$serv->on('close', function ($serv, $fd) {
    echo "fd:{$fd}\n";
    echo "Client: Close.\n";
});
$serv->start();
