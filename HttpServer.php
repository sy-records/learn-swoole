<?php
/**
 * @authors ShenYan (52o@qq52o.cn)
 * @date    2018-07-09 09:39:53
 * @boke    https://qq52o.me
 */
# 创建http服务
$http = new swoole_http_server("0.0.0.0", 9501);
# 监听服务器请求
$http->on('request', function ($request, $response) {
	$response->end("<h1>Hello Swoole. #" . rand(1000, 9999) . "</h1>");
});
# 启动服务
$http->start();