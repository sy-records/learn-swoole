<?php
/**
 * @authors ShenYan (52o@qq52o.cn)
 * @date    2018-07-09 09:52:20
 * @boke    https://qq52o.me
 */
# 定义clientFds数组 保存所有websocket连接
$clientFds = [];

# 创建websocket服务
$server = new swoole_websocket_server("0.0.0.0", 9501);
# 握手成功 触发回调函数
$server->on('open', function (swoole_websocket_server $server, $request) use (&$clientFds) {
	# echo "server: handshake success with fd{$request->fd}\n";
	# 将所有客户端连接标识，握手成功后保存到数组中
	$clientFds[] = $request->fd;
});
# 收到消息 触发回调函数
$server->on('message', function (swoole_websocket_server $server, $frame) use (&$clientFds) {
	# echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
	# $server->push($frame->fd, "this is server");
	# 当有用户发送信息，发送广播通知所有用户
	foreach ($clientFds as $fd) {
		$server->push($fd, $frame->data);
	}
});
# 关闭连接 触发回调函数
$server->on('close', function ($ser, $fd) use (&$clientFds) {
	# echo "client {$fd} closed\n";
	# 关闭会话 销毁标识fd
	# 根据value 去数组中找对应的key
	$res = array_search($fd, $clientFds, true);
	unset($clientFds[$res]);
});
# 启动websocket服务
$server->start();