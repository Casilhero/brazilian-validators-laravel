<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Facades;

use Casilhero\BrazilianValidators\Support\ValidationResult;
use Illuminate\Support\Facades\Facade;

/**
 * @method static bool cpf(string $value)
 * @method static ValidationResult cpfResult(string $value)
 * @method static bool cnpj(string $value)
 * @method static ValidationResult cnpjResult(string $value)
 * @method static bool cpfCnpj(string $value)
 * @method static ValidationResult cpfCnpjResult(string $value)
 * @method static bool suframa(string $value)
 * @method static ValidationResult suframaResult(string $value)
 * @method static bool nisPis(string $value)
 * @method static ValidationResult nisPisResult(string $value)
 * @method static bool phone(string $value)
 * @method static ValidationResult phoneResult(string $value)
 * @method static bool phoneDdi(string $value)
 * @method static ValidationResult phoneDdiResult(string $value)
 * @method static bool cnh(string $value)
 * @method static ValidationResult cnhResult(string $value)
 * @method static bool cns(string $value)
 * @method static ValidationResult cnsResult(string $value)
 */
final class BrazilianValidator extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'brazilian-validator';
    }
}
