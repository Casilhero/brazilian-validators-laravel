<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Validators\Phone as CorePhone;

final class Phone extends AbstractBrazilianRule
{
    protected function passes(string $value): bool
    {
        return CorePhone::isValid($value);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.phone';
    }
}
