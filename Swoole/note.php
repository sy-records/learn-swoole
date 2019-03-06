<?php

// 获取当前 php 进程ID
echo getmypid();

// 设置进程名称
// swoole_set_process_name兼容性比cli_set_process_title要差，如果存在cli_set_process_title函数则优先使用cli_set_process_title。
cli_set_process_title('swoole_server');

// php kill进程
$pid = ’‘；
// 其他信号见http://php.net/manual/zh/pcntl.constants.php
posix_kill($pid, SIGKILL);

// 获取fpm进程id
ps -ef|grep php-fpm|grep -v grep|awk '{print $2}'

// 获取fpm进程个数
ps -ef|grep php-fpm|grep -v grep|wc -l
