<?php
// 进程事件
$workers = []; //创建进程数组
$worker_num = 3; //创建进程的数据量

// 创建启动进程
for ($i = 0; $i < $worker_num; $i++) {
	$process = new swoole_process('doProcess'); // 创建单独的新进程
	$pid = $process->start(); // 启动进程 并获取进程ID
	$workers[$pid] = $process; // 存入进程数组
}

// 创建进程执行函数
function doProcess(swoole_process $process) {
	$process->write("PID：$process->pid"); //子进程写入信息
	echo "写入信息：$process->pid $process->callback";
}

// 添加进程时间 向每一个子进程添加需要执行的动作
foreach ($workers as $process) {
	# 添加
	swoole_event_add($process->pipe, function ($pipe) use ($process) {
		$data = $process->read(); //能否读取数据
		echo "接收到：$data \n";
	});
}