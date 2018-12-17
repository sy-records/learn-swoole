<?php
go(function () {
    $redis = new Swoole\Coroutine\Redis();
    $redis->connect('127.0.0.1', 6379);
     while (true) {
        $msgs = $redis->brpop('packs');
        var_dump($msgs);
     }
}
