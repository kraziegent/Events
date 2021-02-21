<?php

namespace Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use TypiCMS\Modules\Events\Providers\ModuleServiceProvider;

class TestCase extends Orchestra
{

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        //Need this to put Laravel built-in authentication routes in place for testing package isolated
        //Auth::routes();

        //$this->withFactories(__DIR__ . '/../database/factories');
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return ['TypiCMS\Modules\Events\Providers\ModuleServiceProvider'];
    }

    protected function getPackageAliases($app)
    {
        return ['Events' => 'TypiCMS\Modules\Events\Facades\Events'];
    }
}