<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Validators\Passaporte as CorePassaporte;

final class Passaporte extends AbstractBrazilianRule
{
    protected function passes(string $value): bool
    {
        return CorePassaporte::isValid($value);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.passaporte';
    }
}
