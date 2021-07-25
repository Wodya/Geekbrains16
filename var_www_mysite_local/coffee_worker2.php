<?php
require_once('vendor/autoload.php');
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exception\AMQPProtocolChannelException;
use PhpAmqpLib\Message\AMQPMessage;
try {
// соединяемся с RabbitMQ
    $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
// Создаем канал общения с очередью
    $channel = $connection->channel();

    $callback = function ($msg) {
        echo ' [x] Received ', $msg->body, "\n";
    };
    $channel->basic_consume('Coffee2', '', false, true, false, false, $callback);
    $channel->wait();
}
catch (AMQPProtocolChannelException $e){
    echo $e->getMessage();
}
catch (AMQPException $e){
    echo $e->getMessage();
}
