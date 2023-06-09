<?php

namespace Modules\Icommercepricelist\Events;

use Illuminate\Queue\SerializesModels;

class ProductWasCreated
{
    use SerializesModels;

    public $entity;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($entity)
    {
        $this->entity = $entity;
        //
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn(): array
    {
        return [];
    }
}
