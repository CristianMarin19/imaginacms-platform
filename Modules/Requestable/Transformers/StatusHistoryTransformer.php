<?php

namespace Modules\Requestable\Transformers;

use Modules\Core\Icrud\Transformers\CrudResource;

class StatusHistoryTransformer extends CrudResource
{
    /**
     * Method to merge values with response
     */
    public function modelAttributes($request): array
    {
        return [];
    }
}
