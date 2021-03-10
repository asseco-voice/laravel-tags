<?php

namespace Asseco\Tags\Tests;

use Asseco\Tags\TagsServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->runLaravelMigrations();
    }

    protected function getPackageProviders($app): array
    {
        return [TagsServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
