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
        sleep(substr_count($msg->body, '.'));

        $connection1 = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel1 = $connection1->channel();
        $msg = new AMQPMessage('Канал 2. Приготовить кофе');
        $channel1->basic_publish($msg, '', 'Coffee2');
        echo " [x] Done\n";
        $channel1->close();
        $connection1->close();
    };
    $channel->basic_consume('Coffee', '', false, true, false, false, $callback);
    $channel->wait();
}
catch (AMQPProtocolChannelException $e){
    echo $e->getMessage();
}
catch (AMQPException $e){
    echo $e->getMessage();
}

