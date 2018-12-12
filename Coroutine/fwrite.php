<?php
// 协程写文件
$fp = fopen('test.txt','a+');
go(function() use ($fp){
	$r = co::fwrite($fp,"hello,swoole!\n");
	var_dump($r);
});
