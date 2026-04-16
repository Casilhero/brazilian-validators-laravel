<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Validators\Chassi as CoreChassi;

final class Chassi extends AbstractBrazilianRule
{
    protected function passes(string $value): bool
    {
        return CoreChassi::isValid($value);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.chassi';
    }
}
