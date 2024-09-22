<?php

namespace App\Providers;

use App\Services\Queue\QueueServiceInterface;
use App\Services\Queue\RabbitMQService;
use Illuminate\Support\ServiceProvider;

class QueueServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(QueueServiceInterface::class, RabbitMQService::class);
    }
}
