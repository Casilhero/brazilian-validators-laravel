<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Validators\NisPis as CoreNisPis;

final class NisPis extends AbstractBrazilianRule
{
    protected function passes(string $value): bool
    {
        return CoreNisPis::isValid($value);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.nis_pis';
    }
}
