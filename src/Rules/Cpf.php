<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Validators\Cpf as CoreCpf;

final class Cpf extends AbstractBrazilianRule
{
    protected function passes(string $value): bool
    {
        return CoreCpf::isValid($value);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.cpf';
    }
}
