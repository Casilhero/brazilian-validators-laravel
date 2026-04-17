<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Facades;

use Casilhero\BrazilianValidators\Support\BoletoInfo;
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
 * @method static bool renavam(string $value)
 * @method static ValidationResult renavamResult(string $value)
 * @method static bool tituloEleitor(string $value)
 * @method static ValidationResult tituloEleitorResult(string $value)
 * @method static bool chassi(string $value)
 * @method static ValidationResult chassiResult(string $value)
 * @method static bool inscricaoEstadual(string $value, string|\Casilhero\BrazilianValidators\Support\Uf $uf)
 * @method static ValidationResult inscricaoEstadualResult(string $value, string|\Casilhero\BrazilianValidators\Support\Uf $uf)
 * @method static bool boleto(string $value)
 * @method static ValidationResult boletoResult(string $value)
 * @method static BoletoInfo|null boletoParse(string $value)
 * @method static string boletoGenerate()
 * @method static string boletoMask(string $value)
 */
final class BrazilianValidator extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'brazilian-validator';
    }
}
