<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool cpf(string $value)
 * @method static bool cnpj(string $value)
 * @method static bool cpfCnpj(string $value)
 * @method static bool suframa(string $value)
 * @method static bool nisPis(string $value)
 * @method static bool phone(string $value)
 * @method static bool phoneDdi(string $value)
 * @method static bool cnh(string $value)
 * @method static bool cns(string $value)
 */
final class BrazilianValidator extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'brazilian-validator';
    }
}
