<?php
// 创建锁对象
$lock = new swoole_lock(SWOOLE_MUTEX); //互斥锁

echo "创建互斥锁\n";

$lock->lock(); // 开始锁定 主进程
if (pcntl_fork() > 0) {
	sleep(1);
	$lock->unlock(); //解锁
} else {
	echo "子进程 等待锁\n";
	$lock->lock(); //上锁
	echo "子进程 获取锁";
	$lock->unlock(); //释放
	exit("子进程退出");
}
echo "主进程 释放锁";
unset($lock);
sleep(1);
echo "子进程退出";