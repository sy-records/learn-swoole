<?php

// 执行dns查询
swoole_async_dns_lookup('qq52o.me', function ($host, $ip) {
	echo "$host $ip";
});