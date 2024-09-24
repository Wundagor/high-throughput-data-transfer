<?php

namespace App\Services\Queue;

use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Channel\AMQPChannel;

class RabbitMQService implements QueueServiceInterface
{
    public function sendToQueue(mixed $channel, array $data): void
    {
        $queue = env('RABBITMQ_QUEUE');

        $channel->queue_declare($queue, false, true, false, false, false, []);
        $channel->basic_publish(new AMQPMessage(json_encode($data)), '', $queue);
    }
}

