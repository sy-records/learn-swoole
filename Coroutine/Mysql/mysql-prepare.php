<?php
go(function(){
	$db = new co\Mysql();
	// 建立连接
	$db->connect([
    		'host' => '127.0.0.1',
    		'port' => 3306,
    		'user' => 'root',
    		'password' => 'root',
    		'database' => 'swoole_qq52o_me',
	]);
	// 预处理
	$stmt = $db->prepare('select * from user_login where id = ?');
	if($stmt == false) {
		var_dump($db->error,$db->error);
	}else {
		// 发送预处理数据参数
		$ret = $stmt->execute(array(1));
		var_dump($ret);
	}
});
