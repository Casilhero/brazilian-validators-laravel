<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Validators\Certidao as CoreCertidao;

final class Certidao extends AbstractBrazilianRule
{
    protected function passes(string $value): bool
    {
        return CoreCertidao::isValid($value);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.certidao';
    }
}
