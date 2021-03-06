<?php

declare(strict_types=1);

namespace Codedge\HereMaps\Tests;

use Codedge\HereMaps\ServiceProvider;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Statamic\Extend\Manifest;
use Statamic\Providers\StatamicServiceProvider;
use Statamic\Statamic;

class TestCase extends OrchestraTestCase
{
    protected $shouldFakeVersion = true;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        if ($this->shouldFakeVersion) {
            \Facades\Statamic\Version::shouldReceive('get')->andReturn('3.0.10');
            $this->addToAssertionCount(-1); // Dont want to assert this
        }
    }

    /**
     * Load package service provider.
     *
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            StatamicServiceProvider::class,
            ServiceProvider::class,
        ];
    }

    /**
     * Load package alias.
     *
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Statamic' => Statamic::class,
        ];
    }

    /**
     * Load Environment.
     *
     * @param Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app->make(Manifest::class)->manifest = [
            'codedge/statamic-here-maps' => [
                'id'        => 'codedge/statamic-here-maps',
                'namespace' => 'Codedge\\HereMaps\\',
            ],
        ];
    }
}
