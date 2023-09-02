<?php

namespace Modules\Icredit\Entities;

/**
 * Class Status
 */
class Status
{
    const PENDING = 1;

    const APPROVED = 2;

    const CANCELED = 3;

    /**
     * @var array
     */
    private $statuses = [];

    public function __construct()
    {
        $this->statuses = [
            self::PENDING => trans('icredit::credits.status.pending'),
            self::APPROVED => trans('icredit::credits.status.approved'),
            self::CANCELED => trans('icredit::credits.status.canceled'),
        ];
    }

    /**
     * Get the available statuses
     */
    public function lists()
    {
        return $this->statuses;
    }

    /**
     * Get the post status
     */
    public function get($statusId)
    {
        if (isset($this->statuses[$statusId])) {
            return $this->statuses[$statusId];
        }

        return $this->statuses[self::AVAILABLE];
    }
}
