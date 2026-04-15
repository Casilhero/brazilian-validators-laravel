<?php

declare(strict_types=1);

use Casilhero\BrazilianValidatorsLaravel\Rules\Cnpj;
use Casilhero\BrazilianValidatorsLaravel\Rules\Suframa;
use Illuminate\Support\Facades\Validator;

it('loads english translation messages', function (): void {
    app()->setLocale('en');

    $validator = Validator::make(
        ['cnpj' => '04252011000111'],
        ['cnpj' => [new Cnpj]]
    );

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('cnpj'))->toBe('The cnpj field must be a valid CNPJ.');
});

it('loads portuguese translation messages', function (): void {
    app()->setLocale('pt_BR');

    $validator = Validator::make(
        ['cnpj' => '04252011000111'],
        ['cnpj' => [new Cnpj]]
    );

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('cnpj'))->toBe('O campo cnpj deve ser um CNPJ valido.');
});

it('allows application translation override', function (): void {
    app()->setLocale('en');
    app('translator')->addNamespace('brazilian-validators', __DIR__.'/../Fixtures/lang');

    $validator = Validator::make(
        ['cnpj' => '04252011000111'],
        ['cnpj' => [new Cnpj]]
    );

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('cnpj'))->toBe('Custom app message for cnpj.');
});

it('resolves suframa message from package namespace for invalid 00 prefix', function (): void {
    app()->setLocale('pt_BR');

    $validator = Validator::make(
        ['suframa' => '001234567'],
        ['suframa' => [new Suframa]]
    );

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('suframa'))->toBe('O campo suframa deve ser um SUFRAMA valido.');
});
