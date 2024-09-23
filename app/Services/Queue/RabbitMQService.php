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
        $channel->queue_declare('source_data_queue', false, true, false, false, false, config('rabbitmq.queue.arguments'));
        $channel->basic_publish(new AMQPMessage(json_encode($data)), '', 'source_data_queue');

        $channel->close();
    }
}
