<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Casilhero\BrazilianValidators\Support\Uf;
use Casilhero\BrazilianValidators\Validators\InscricaoEstadual as CoreInscricaoEstadual;

final class InscricaoEstadual extends AbstractBrazilianRule
{
    public function __construct(private readonly string|Uf $uf)
    {
    }

    protected function passes(string $value): bool
    {
        return CoreInscricaoEstadual::isValid($value, $this->uf);
    }

    protected function messageKey(): string
    {
        return 'brazilian-validators::validation.inscricao_estadual';
    }
}
