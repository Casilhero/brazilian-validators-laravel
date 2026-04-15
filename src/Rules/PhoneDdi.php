<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Validators\PhoneDdi as CorePhoneDdi;

final class PhoneDdi extends AbstractBrazilianRule
{
    protected function passes(string $value): bool
    {
        return CorePhoneDdi::isValid($value);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.phone_ddi';
    }
}
