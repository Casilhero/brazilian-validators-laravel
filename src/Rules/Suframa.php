<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Validators\Suframa as CoreSuframa;

final class Suframa extends AbstractBrazilianRule
{
    protected function passes(string $value): bool
    {
        return CoreSuframa::isValid($value);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.suframa';
    }
}
