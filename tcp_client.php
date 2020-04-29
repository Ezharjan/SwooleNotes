<?php

//连接Swoole TCP服务
$client = new swoole_client(SWOOLE_SOCK_TCP);

if (!$client->connect("127.0.0.1",9501)) {
    echo "connection failed!";
    exit;
}

fwrite(STDOUT, "Please enter your message:");
$msg = trim(fgets(STDIN));

//发送消息给TCP服务器
$client->send($msg);

//接收来自服务端的消息
$result = $client->recv();
echo $result;
