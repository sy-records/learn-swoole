<?php
// 异步写入文件
$content = "Hello,Swoole!";
swoole_async_writefile('2.txt', $content, function ($filename) {
	echo $filename;
}, 0);