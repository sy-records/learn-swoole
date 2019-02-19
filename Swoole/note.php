<?php

// 获取当前 php 进程ID
echo getmypid();

// 设置进程名称
// swoole_set_process_name兼容性比cli_set_process_title要差，如果存在cli_set_process_title函数则优先使用cli_set_process_title。
cli_set_process_title('swoole_server');
