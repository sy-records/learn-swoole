<?php
// 异步读取文件
swoole_async_readfile(__DIR__ . "/1.txt", function ($filename, $content) {
	echo "$filename $content";
});