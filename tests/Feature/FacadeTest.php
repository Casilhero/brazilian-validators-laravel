<?php

declare(strict_types=1);

use Casilhero\BrazilianValidatorsLaravel\Facades\BrazilianValidator;

it('validates through facade helper', function (): void {
    expect(BrazilianValidator::cnpj('04.252.011/0001-10'))->toBeTrue();
    expect(BrazilianValidator::cpf('11111111111'))->toBeFalse();
});
