<?php

namespace App\Services\Queue;

use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Channel\AMQPChannel;

class RabbitMQService implements QueueServiceInterface
{
    public function __construct(protected AMQPChannel $channel) {}

    public function sendToQueue(array $data): void
    {
        $queue = env('RABBITMQ_QUEUE');

        $this->channel->queue_declare($queue, false, true, false, false, false);
        $this->channel->basic_publish(new AMQPMessage(json_encode($data)), '', $queue);
    }
}

