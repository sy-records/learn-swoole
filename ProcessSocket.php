<?php
// 进程队列通信
$workers = []; //创建进程数组
$worker_num = 3; //创建进程的数据量

// 创建启动进程
for ($i = 0; $i < $worker_num; $i++) {
	$process = new swoole_process('doProcess', false, false); // 创建子进程
	$process->useQueue(); //开启队列
	$pid = $process->start(); // 启动进程 并获取进程ID
	$workers[$pid] = $process; // 存入进程数组
}

// 进程执行函数
function doProcess(swoole_process $process) {
	$recv = $process->pop(); //8192
	echo "从主进程获取到数据： $recv \n";
	sleep(5);
	$process->exit(0);
}

// 主进程 向子进程添加数据
foreach ($workers as $pid => $process) {
	$process->push("hello 子进程 $pid \n");
}

// 等待子进程结束 回收资源
for ($i = 0; $i < $worker_num; $i++) {
	$ret = swoole_process::wait(); //等待执行完成
	$pid = $ret['pid'];
	unset($workers[$pid]);
	echo "子进程退出 $pid \n";
}