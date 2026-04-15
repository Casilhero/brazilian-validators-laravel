<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel;

use Casilhero\BrazilianValidatorsLaravel\Support\BrazilianValidatorManager;
use Illuminate\Support\ServiceProvider;

final class BrazilianValidatorsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('brazilian-validator', static fn (): BrazilianValidatorManager => new BrazilianValidatorManager());
    }

    public function boot(): void
    {
        $langPath = __DIR__ . '/../resources/lang';

        $this->loadTranslationsFrom($langPath, 'brazilian-validators');

        $publishPath = function_exists('lang_path')
            ? lang_path('vendor/brazilian-validators')
            : resource_path('lang/vendor/brazilian-validators');

        $this->publishes([
            $langPath => $publishPath,
        ], 'brazilian-validators-translations');
    }
}
