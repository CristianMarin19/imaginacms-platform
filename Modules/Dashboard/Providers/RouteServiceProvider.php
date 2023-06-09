<?php

namespace Modules\Dashboard\Providers;

use Modules\Core\Providers\RoutingServiceProvider as CoreRoutingServiceProvider;

class RouteServiceProvider extends CoreRoutingServiceProvider
{
    /**
     * The root namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $namespace = 'Modules\Dashboard\Http\Controllers';

    /**
     * @return string
     */
    protected function getFrontendRoute(): string
    {
        return false;
    }

    /**
     * @return string
     */
    protected function getBackendRoute(): string
    {
        return __DIR__.'/../Http/backendRoutes.php';
    }

    /**
     * @return string
     */
    protected function getApiRoute(): string
    {
        return false;
    }
}
