<?php

namespace App\Services\Queue;

use PhpAmqpLib\Message\AMQPMessage;
use App\Core\Connections\RabbitMQConnection;

class RabbitMQService implements QueueServiceInterface
{
    public function sendToQueue(array $data): void
    {
        $connection = RabbitMQConnection::getConnection();
        $channel = $connection->channel();
        $channel->queue_declare('source_data_queue', false, true, false, false);

        $msg = new AMQPMessage(json_encode($data));
        $channel->basic_publish($msg, '', 'source_data_queue');

        $channel->close();
    }
}
