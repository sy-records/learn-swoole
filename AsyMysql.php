<?php
// 异步操作mysql
$db = new swoole_mysql();

$config = [
	'host' => '127.0.0.1',
	'user' => 'root',
	'password' => 'root',
	'database' => 'mysql',
	'charset' => 'utf8',
];

// 连接数据
$db->connect($config, function ($db, $r) {
	if ($r === false) {
		var_dump($db->connect_errno, $db->connect_error);
		die("失败");
	}
	// 成功
	$sql = 'show tables';
	$db->query($sql, function (swoole_mysql $db, $r) {
		if ($r === false) {
			var_dump($db->error);
			die("操作失败");
		} elseif ($r === true) {
			var_dump($db->affected_rows, $db->insert_id);
		}
		var_dump($r);
		$db->close();
	});
});