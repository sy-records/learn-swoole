<?php
// 挂起协程，让出当前协程执行权
$cid = go(function(){
    echo "co 1 start\n";
    co::yield();
    echo "co 1 end\n";
});

go(function () use ($cid) {
    echo "co 2 start\n";
    co::sleep(3);
    co::resume($cid);
    echo "co 2 end\n";
});
