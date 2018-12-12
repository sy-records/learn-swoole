<?php
// 将域名解析为IP
go(function(){
	$data = co::gethostbyname("qq52o.me");
	var_dump($data);
});
