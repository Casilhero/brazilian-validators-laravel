<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Validators\Renavam as CoreRenavam;

final class Renavam extends AbstractBrazilianRule
{
    protected function passes(string $value): bool
    {
        return CoreRenavam::isValid($value);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.renavam';
    }
}
