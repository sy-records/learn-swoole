<?php
go(function(){
  $cli = new Swoole\Coroutine\Http\Client('127.0.0.1');
  $cli->post('/index.php',array('a' => 1));
  echo $cli->body;
  $cli->close();
});
