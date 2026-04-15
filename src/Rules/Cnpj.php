<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Validators\Cnpj as CoreCnpj;

final class Cnpj extends AbstractBrazilianRule
{
    protected function passes(string $value): bool
    {
        return CoreCnpj::isValid($value);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.cnpj';
    }
}
