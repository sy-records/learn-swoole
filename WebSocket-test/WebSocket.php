<?php
/**
 * @authors ShenYan (52o@qq52o.cn)
 * @date    2018-07-09 09:52:20
 * @boke    https://qq52o.me
 */
# 创建websocket服务
$server = new swoole_websocket_server("0.0.0.0", 9501);
# 握手成功 触发回调函数
$server->on('open', function (swoole_websocket_server $server, $request) {
	echo "server: handshake success with fd{$request->fd}\n";
});
# 收到消息 触发回调函数
$server->on('message', function (swoole_websocket_server $server, $frame) {
	echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
	$server->push($frame->fd, "this is server");
});
# 关闭连接 触发回调函数
$server->on('close', function ($ser, $fd) {
	echo "client {$fd} closed\n";
});
# 启动websocket服务
$server->start();