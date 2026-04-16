<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Validators\ProcessoJudicial as CoreProcessoJudicial;

final class ProcessoJudicial extends AbstractBrazilianRule
{
    protected function passes(string $value): bool
    {
        return CoreProcessoJudicial::isValid($value);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.processo_judicial';
    }
}
