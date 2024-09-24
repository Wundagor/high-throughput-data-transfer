<?php

namespace App\Services\Queue;

interface QueueServiceInterface
{
    public function sendToQueue(mixed $channel, array $data): void;
}
