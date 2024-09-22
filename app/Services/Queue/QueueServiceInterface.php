<?php

namespace App\Services\Queue;

interface QueueServiceInterface
{
    public function sendToQueue(array $data): void;
}
