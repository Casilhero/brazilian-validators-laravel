<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Validators\Caepf as CoreCaepf;

final class Caepf extends AbstractBrazilianRule
{
    protected function passes(string $value): bool
    {
        return CoreCaepf::isValid($value);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.caepf';
    }
}
