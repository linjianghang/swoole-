<?php
/**
 * Created by PhpStorm.
 * User: ethan
 * Date: 2018/7/12
 * Time: 16:01
 */
$server = new swoole_websocket_server("0.0.0.0",9666);

$server->on('message',function(swoole_websocket_server $ser,$frame){
    echo "接收到消息:";
    var_dump($frame->data);
    foreach($ser->connection_list() as $fd){
        $ser->push($fd, $frame->data);
    }
});
$server->on('open',function(swoole_websocket_server $ser,$request){
    echo "——开启服务——".PHP_EOL;
});
$server->on('close',function(swoole_websocket_server $ser,$fd){
    echo "关闭进程：{$fd}".PHP_EOL;
});

$server->start();
