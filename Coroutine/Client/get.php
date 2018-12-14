<?php
go(function(){
	$cli = new Swoole\Coroutine\Http\Client('compiler.qq52o.cn', 80);
	$cli->get('/swoole-compiler-loader.php');
	echo $cli->body;	
	$cli->close();
});
