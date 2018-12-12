<?php
// 协程读取文件
// 打开文件
$fp = fopen(__DIR__."/test.txt","r");
// 创建协程
co::create(function() use ($fp){
	$r = co::fread($fp);
	var_dump($r);
});
