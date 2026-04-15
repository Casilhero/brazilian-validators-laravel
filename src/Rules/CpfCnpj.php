<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Validators\CpfCnpj as CoreCpfCnpj;

final class CpfCnpj extends AbstractBrazilianRule
{
    protected function passes(string $value): bool
    {
        return CoreCpfCnpj::isValid($value);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.cpf_cnpj';
    }
}
