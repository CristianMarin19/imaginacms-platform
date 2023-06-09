<?php

namespace Modules\Core\Repositories\Eloquent;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Modules\Isite\Entities\Module as ModuleEntity;
use Nwidart\Modules\Collection;
use Nwidart\Modules\Contracts\RepositoryInterface;
use Nwidart\Modules\Exceptions\ModuleNotFoundException;

class LaravelEloquentRepository implements RepositoryInterface
{
    /**
     * @var ModuleEntity
     */
    private $moduleEntity;

    /**
     * @var Container
     */
    private $app;

    public function __construct(Container $app, ModuleEntity $moduleEntity)
    {
        $this->app = $app;
        $this->moduleEntity = $moduleEntity;
    }

    /**
     * Get all modules.
     */
    public function all(): array
    {
        return $this->convertToCollection($this->moduleEntity->get())->toArray();
    }

    /**
     * Get cached modules.
     */
    public function getCached(): array
    {
        return $this->app['cache']->remember($this->config('cache.key'), $this->config('cache.lifetime'), function () {
            return $this->toCollection()->toArray();
        });
    }

    /**
     * Scan & get all available modules.
     */
    public function scan(): array
    {
        return $this->toCollection()->toArray();
    }

    /**
     * Get modules as modules collection instance.
     */
    public function toCollection(): Collection
    {
        return $this->convertToCollection($this->moduleEntity->get());
    }

    protected function createModule(...$args)
    {
        return new Module(...$args);
    }

    /**
     * Get scanned paths.
     */
    public function getScanPaths(): array
    {
        return [];
    }

    /**
     * Get list of enabled modules.
     */
    public function allEnabled(): array
    {
        $results = $this->moduleEntity->newQuery()->where('enabled', 1)->get();

        return $this->convertToCollection($results)->toArray();
    }

    /**
     * Get list of disabled modules.
     *
     * @return mixed
     */
    public function allDisabled()
    {
        $results = $this->moduleEntity->newQuery()->where('enabled', 0)->get();

        return $this->convertToCollection($results)->toArray();
    }

    /**
     * Get count from all modules.
     */
    public function count(): int
    {
        return $this->moduleEntity->count();
    }

    /**
     * Get all ordered modules.
     */
    public function getOrdered(string $direction = 'asc'): array
    {
        $results = $this->moduleEntity
          ->newQuery()
          ->where('enabled', 1)
          ->orderBy('priority', $direction)
          ->get();

        return $this->convertToCollection($results)->toArray();
    }

    /**
     * Get modules by the given status.
     */
    public function getByStatus(int $status): array
    {
        $results = $this->moduleEntity
          ->newQuery()
          ->where('enabled', $status)
          ->get();

        return $this->convertToCollection($results)->toArray();
    }

    /**
     * Find a specific module.
     */
    public function find($name): ?\Nwidart\Modules\Contracts\ModuleInterface
    {
        $module = $this->moduleEntity
          ->newQuery()
          ->where('alias', $name)
          ->first();

        if ($module === null) {
            return null;
        }

        return $module;
    }

    /**
     * Find a specific module. If there return that, otherwise throw exception.
     *
     * @throws ModuleNotFoundException
     */
    public function findOrFail($name): \Nwidart\Modules\Contracts\ModuleInterface
    {
        $module = $this->find($name);

        if ($module === null) {
            throw new ModuleNotFoundException();
        }

        return $module;
    }

    public function getModulePath($moduleName)
    {
        $module = $this->findOrFail($moduleName);

        return $module->getPath();
    }

    public function getFiles(): Filesystem
    {
        return $this->app['files'];
    }

    public function config($key, $default = null)
    {
        return $this->app['config']->get('modules.'.$key, $default);
    }

    public function exists(string $name): bool
    {
        return (bool) $this->moduleEntity
          ->newQuery()
          ->where('alias', $name)
          ->count();
    }

    /**
     * Delete a specific module.
     *
     *
     * @throws \Nwidart\Modules\Exceptions\ModuleNotFoundException
     */
    public function delete(string $name): bool
    {
        return $this->findOrFail($name)->delete();
    }

    private function convertToCollection(EloquentCollection $eloquentCollection): Collection
    {
        $collection = new Collection();
        $eloquentCollection->map(function ($module) use ($collection) {
            $collection->push($this->createModule($this->app, $module->name, $module->path));
        });

        return $collection;
    }
}
