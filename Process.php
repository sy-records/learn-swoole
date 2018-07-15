<?php
//创建进程

//进程对应的执行函数
function doProcess(swoole_process $worker) {
	echo "PID", $worker->pid, "\n";
	sleep(10);
}
//创建进程1
$process = new swoole_process("doProcess");
$pid = $process->start();
$process = new swoole_process("doProcess");
$pid = $process->start();
$process = new swoole_process("doProcess");
$pid = $process->start();

//等待结束
swoole_process::wait();