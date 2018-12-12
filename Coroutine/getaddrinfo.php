<?php
// DNS解析
go(function(){
	$data = co::getaddrinfo("qq52o.me");
	var_dump($data);
});

