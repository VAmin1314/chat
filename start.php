<?php
use Workerman\Worker;
require_once './Workerman/Autoloader.php';
require_once './Workerman/function.php';

// 创建一个Worker监听2345端口，使用http协议通讯
$worker = new Worker("websocket://0.0.0.0:8080");

// 启动 1 个进程对外提供服务
$worker->count = 1;

$worker->onMessage = function($connection, $data)
{
    global $worker;

    $api = 'http://chat-demo.cc/api/getUserInfo';
    $data = json_decode($data, true);
    $url = $api.'?token='.$data['token'];

    $info = send_curl($url);
    $uid = $info['id'];

    if (empty($uid)) {
        $send = ['type' => 'login', 'message' => '链接失败'];
        return $connection->send(json_encode($send));
    }

    // 判断是否登录
    if (!isset($connection->uid) && !$worker->uidConnections[$uid]) {
        $connection->uid = $uid;
        $worker->uidConnections[$connection->uid] = $connection;
        $send = ['type' => 'login', 'message' => '登录成功'];

        return $connection->send(json_encode($send));
    }

    $send = [
        'type' => 'chat',
        'message' => htmlspecialchars($data['content']),
        'id' => $uid,
        'uid' => $data['uid'],
        'name' => $info['name']
    ];
    $message = json_encode($send);

    sendMessage($message, $data['uid']);
};

// 运行worker
Worker::runAll();




