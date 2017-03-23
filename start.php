<?php
use Workerman\Worker;
require_once './Workerman/Autoloader.php';

// 创建一个Worker监听2345端口，使用http协议通讯
$worker = new Worker("websocket://10.0.0.76:8080");
// $worker = new Worker("websocket://10.0.0.76:8080");
// $worker = new Worker("websocket://192.168.0.112:8080");

// 启动 1 个进程对外提供服务
$worker->count = 1;

// $worker->transport = 'ssl';
// 接收到浏览器发送的数据时回复hello world给浏览器
$worker->onMessage = function($connection, $data)
{
    global $worker;
    $data = json_decode($data, true);
    $url = 'http://workerman.cc/api/getUserInfo?token='.$data['token'];
    $info = send_curl($url);

    // 判断是否登录
    if(!isset($connection->uid)) {
        // $url = 'http://workerman.cc/api/getUserInfo?token='.$data['token'];
        // $info = send_curl($url);
        $connection->uid = $info['id'];

        $worker->uidConnections[$connection->uid] = $connection;

        $send = ['type' => 'login', 'message' => '登录成功'];

        return $connection->send(json_encode($send));
    }

    $uid = $data['uid'];
    $content = htmlspecialchars($data['content']);

    $send = ['type' => 'chat', 'message' => $content];
    $content = json_encode($send);
    // // 全局广播
    if($uid == 'all') {
        sendMessageByAll($content);
    } else {
        sendMessageByUid($uid, $content);
    }
};

// 向所有验证的用户推送数据
function sendMessageByAll($message) {
    global $worker;
    foreach($worker->uidConnections as $connection) {
        $connection->send($message);
    }
}

// 针对uid推送数据
function sendMessageByUid($uid, $message)
{
    global $worker;
    if(isset($worker->uidConnections[$uid])) {
        $connection = $worker->uidConnections[$uid];
        $connection->send($message);
    }
}


function send_curl ($url = '', $data = [], $type = 'get')
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    if ($type == 'post') {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    $output = curl_exec($ch);
    curl_close($ch);
    return json_decode($output, true);
}


// 运行worker
Worker::runAll();




