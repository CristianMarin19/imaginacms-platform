<?php

namespace Modules\Icommerce\Tests;

use Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider;
use Modules\Icommerce\Providers\IcommerceServiceProvider;
use Orchestra\Testbench\TestCase;

abstract class BaseIcommerceTestCase extends TestCase
{
    protected $category;

    protected $product;

    protected $option;

    public function setUp()
    {
        parent::setUp();
        $this->resetDatabase();
        $this->category = app('Modules\Icommerce\Repositories\CategoryRepository');
        $this->product = app('Modules\Icommerce\Repositories\ProductRepository');
        $this->option = app('Modules\Icommerce\Repositories\OptionRepository');
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelLocalizationServiceProvider::class,
            IcommerceServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['path.base'] = __DIR__.'/..';
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        $app['config']->set('translatable.locales', ['en', 'es']);
    }

    private function resetDatabase()
    {
        // Makes sure the migrations table is created
        $this->artisan('migrate', [
            '--database' => 'sqlite',
        ]);
        // We empty all tables
        $this->artisan('migrate:reset', [
            '--database' => 'sqlite',
        ]);
        // Migrate
        $this->artisan('migrate', [
            '--database' => 'sqlite',
        ]);
        $this->artisan('migrate', [
            '--database' => 'sqlite',
            '--path' => 'Modules/Media/Database/Migrations',
        ]);
    }

    public function createCategory()
    {
        $data = [
            'en' => [
                'title' => 'Imagina Colombia',
                'slug' => 'imagina-colombia',
                'description' => 'Category test',
                'meta_title' => null,
                'meta_description' => null,
                'translatable_options' => null,
            ],
            'es' => [
                'title' => 'Imagina Colombia',
                'slug' => 'imagina-colombia',
                'description' => 'Category test',
                'meta_title' => null,
                'meta_description' => null,
                'translatable_options' => null,
            ],
            'parent_id' => 0,
            'options' => '',
            'show_menu' => true,
            'store_id' => null,
        ];

        return $this->category->create($data);
    }

    public function createOption()
    {
        $data = [
            'type' => 'select',
            'sort_order' => 0,
            'options' => null,
            'es' => [
                'description' => 'Select size',
            ],
        ];

        return $this->option->create($data);
    }
}
