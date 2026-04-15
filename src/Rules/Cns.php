<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Validators\Cns as CoreCns;

final class Cns extends AbstractBrazilianRule
{
    protected function passes(string $value): bool
    {
        return CoreCns::isValid($value);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.cns';
    }
}
