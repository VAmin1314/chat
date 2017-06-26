<?php
// 消息发送
function sendMessage($message, $uid = 'all')
{
    global $worker;

    if ($uid == 'all') {
        foreach($worker->uidConnections as $connection) {
            $connection->send($message);
        }
    } else {
        if (isset($worker->uidConnections[$uid])) {
            $connection = $worker->uidConnections[$uid];

            $connection->send($message);
        }
    }
}

// curl 请求
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
