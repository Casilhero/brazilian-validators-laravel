<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Validators\Boleto as CoreBoleto;

final class Boleto extends AbstractBrazilianRule
{
    protected function passes(string $value): bool
    {
        return CoreBoleto::isValid($value);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.boleto';
    }
}
