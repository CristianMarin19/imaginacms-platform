<?php

namespace Modules\Iappointment\Events;

class AppointmentWasUpdated
{
    public $model;

    /**
     * Create a new event instance.
     */
    public function __construct($model)
    {
        $this->model = $model;
    }
}