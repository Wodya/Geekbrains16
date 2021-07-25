<?php
require_once('vendor/autoload.php');
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exception\AMQPProtocolChannelException;
use PhpAmqpLib\Message\AMQPMessage;
try {
    $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
    $channel = $connection->channel();
    $msg = new AMQPMessage('Приготовить кофе');
    $channel->basic_publish($msg, '', 'Coffee');
    $channel->close();
    $connection->close();
}
catch (AMQPProtocolChannelException $e){
    echo $e->getMessage();
}
catch (AMQPException $e){
    echo $e->getMessage();
}
