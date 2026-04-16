<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Validators\TituloEleitor as CoreTituloEleitor;

final class TituloEleitor extends AbstractBrazilianRule
{
    protected function passes(string $value): bool
    {
        return CoreTituloEleitor::isValid($value);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.titulo_eleitor';
    }
}
