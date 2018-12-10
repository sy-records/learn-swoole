<?php
// 创建协程
co::create(function(){
	// 获取协程id
	echo co::getuid();
});

// 2.1.0+版本支持使用 go 关键词创建协程
go(function(){
	// 获取协程id
	echo co::getuid();
});
