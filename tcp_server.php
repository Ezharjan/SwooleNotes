<?php

//创建Server对象，监听本地9501端口
$serv = new Swoole\Server("127.0.0.1", 9501);

$serv->set([
    'worker_num'    => 2,    // worker process num
    'max_request'   => 15,
    ]);

//监听连接进入事件
/**
 * $fd：客户端连接的唯一标识
 * $reactor_id：线程id
 */
$serv->on('Connect', function ($serv, $fd) {
    echo "Client: (with fd: {$fd}); Connect.\n";
});

//监听数据接收事件
$serv->on('Receive', function ($serv, $fd, $from_id, $data) {
    $serv->send($fd, "Server:(with fd: {$fd});".$data);
});

//监听连接关闭事件
$serv->on('Close', function ($serv, $fd) {
    echo "Client: Close.\n";
});

//启动服务器
$serv->start();
