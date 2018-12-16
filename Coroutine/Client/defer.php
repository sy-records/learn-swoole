<?php
// 用于 foreach 或者 for 循环请求时，直接使用并发请求
go(function(){
        foreach ($array as $key => $item) {
            $cli = new Swoole\Coroutine\Http\Client('127.0.0.1', 80);
            $cli->set(['timeout' => 2]);
            $cli->setDefer(); // 需要一个setDefer()方法声明延迟收包，然后通过recv()方法收包
            $cli->post('/test.php', array("id" => $item));
            $clients[] = $cli;
        }
        $n = count($clients);
        for ($i = 0; $i < $n; $i++) {
            $clients[$i]->recv();
            $result[] = $clients[$i]->body;
        }
        var_dump($result);
});
