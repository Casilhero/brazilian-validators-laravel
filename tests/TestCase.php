<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Tests;

use Casilhero\BrazilianValidatorsLaravel\BrazilianValidatorsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            BrazilianValidatorsServiceProvider::class,
        ];
    }
}
