<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Validators\Cnh as CoreCnh;

final class Cnh extends AbstractBrazilianRule
{
    protected function passes(string $value): bool
    {
        return CoreCnh::isValid($value);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.cnh';
    }
}
