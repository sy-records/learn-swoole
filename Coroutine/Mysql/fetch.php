<?php
// 从结果集中获取下一行
go(function(){
	$db = new co\Mysql();
	// 建立连接
	$db->connect([
    		'host' => '127.0.0.1',
    		'port' => 3306,
    		'user' => 'root',
    		'password' => 'root',
    		'database' => 'swoole_qq52o_me',
		    // Ver >= 4.0-rc1 , 需在connect时加入 fetch_mode => true 选项
		    'fetch_mode' => true
	]);
	$stmt = $db->prepare('select * from user_login limit 1');
	$stmt->execute();
	while($ret = $stmt->fetch()){
		var_dump($ret);	
	}
});

