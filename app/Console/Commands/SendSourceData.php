<?php

namespace App\Console\Commands;

use App\Core\Connections\RabbitMQConnection;
use App\Models\SourceData;
use App\Services\Queue\QueueServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class SendSourceData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-source-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending source data to the queue';

    /**
     * Execute the console command.
     */
    public function handle(QueueServiceInterface $queueService): void
    {
        $connection = RabbitMQConnection::getConnection();
        $channel = $connection->channel();

        try {
            SourceData::chunk(100, function (Collection $records) use ($queueService) {
                foreach ($records as $record) {
                    $queueService->sendToQueue($record->toArray());
                }
            });
        } finally {
            $channel->close();
            RabbitMQConnection::closeConnection();
        }
    }
}
