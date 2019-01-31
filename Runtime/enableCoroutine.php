<?php
Swoole\Runtime::enableCoroutine();
$http = new swoole_http_server("0.0.0.0", 9501);

$http->on('start', function($server){
        swoole_set_process_name('test_master');
});

$http->on('request', function ($request, $response) {
    echo co::getuid();
    go(function() use ($request, $response){
        sleep(10); # 当调用睡眠函数时会自动切换为协程定时器调度,不会阻塞进程。
        $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
    });
});

$http->start();
