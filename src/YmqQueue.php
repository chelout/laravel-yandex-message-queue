<?php

namespace Chelout\Ymq;

use Illuminate\Queue\SqsQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

class YmqQueue extends SqsQueue
{
    /**
     * Get the queue or return the default.
     *
     * @param string|null $queue
     *
     * @return string
     */
    public function getQueue($queue)
    {
        return parent::getQueue(
            $this->getMappedQueueName($queue ?: $this->default)
        );
    }

    /**
     * @param  string  $queue
     *
     * @return array|\ArrayAccess|mixed
     */
    protected function getMappedQueueName(string $queue)
    {
        return Arr::get(
            Config::get('queue.connections.ymq.queue_map', []),
            $queue,
            $queue
        );
    }
}
