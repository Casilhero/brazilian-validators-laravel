<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

abstract class AbstractBrazilianRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || ! $this->passes($value)) {
            $fail($this->messageKey())->translate();
        }
    }

    abstract protected function passes(string $value): bool;

    abstract protected function messageKey(): string;
}
