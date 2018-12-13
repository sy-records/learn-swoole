<?php
go(function(){
        $swoole_mysql = new Swoole\Coroutine\MySQL();
        // 建立Mysql连接
        $swoole_mysql->connect([
            'host' => '127.0.0.1',
            'port' => 3306,
            'user' => 'root',
            'password' => 'root',
            'database' => 'swoole_qq52o_me',
        ]);
        // 执行sql
        $res = $swoole_mysql->query('select * from user_login');
        if($res === false) {
            return;
        }
        foreach ($res as $value) {
            echo $value['id']."\n";
        }
});
