<?php

declare(strict_types=1);

use Casilhero\BrazilianValidatorsLaravel\Rules\Boleto;
use Casilhero\BrazilianValidatorsLaravel\Rules\Cnh;
use Casilhero\BrazilianValidatorsLaravel\Rules\Chassi;
use Casilhero\BrazilianValidatorsLaravel\Rules\InscricaoEstadual;
use Casilhero\BrazilianValidatorsLaravel\Rules\Cnpj;
use Casilhero\BrazilianValidatorsLaravel\Rules\Cns;
use Casilhero\BrazilianValidatorsLaravel\Rules\Cpf;
use Casilhero\BrazilianValidatorsLaravel\Rules\CpfCnpj;
use Casilhero\BrazilianValidatorsLaravel\Rules\NisPis;
use Casilhero\BrazilianValidatorsLaravel\Rules\Phone;
use Casilhero\BrazilianValidatorsLaravel\Rules\PhoneDdi;
use Casilhero\BrazilianValidatorsLaravel\Rules\Renavam;
use Casilhero\BrazilianValidatorsLaravel\Rules\ProcessoJudicial;
use Casilhero\BrazilianValidatorsLaravel\Rules\Suframa;
use Casilhero\BrazilianValidatorsLaravel\Rules\TituloEleitor;
use Illuminate\Support\Facades\Validator;

function makeNisPisForBridge(string $base): string
{
    $weights = [3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    $sum = 0;

    for ($i = 0; $i < 10; $i++) {
        $sum += (int) $base[$i] * $weights[$i];
    }

    $remainder = 11 - ($sum % 11);

    return $base.(string) ($remainder >= 10 ? 0 : $remainder);
}

function makeSuframaForBridge(string $base): string
{
    $sum = 0;
    $weight = 9;

    for ($i = 0; $i < 8; $i++) {
        $sum += (int) $base[$i] * $weight;
        $weight--;
    }

    $digit = 11 - ($sum % 11);

    return $base.(string) ($digit >= 10 ? 0 : $digit);
}

function makeCnhForBridge(string $base): string
{
    $sum = 0;

    for ($i = 0, $weight = 9; $i < 9; $i++, $weight--) {
        $sum += (int) $base[$i] * $weight;
    }

    $first = $sum % 11;
    $discount = 0;

    if ($first >= 10) {
        $first = 0;
        $discount = 2;
    }

    $sum = 0;

    for ($i = 0, $weight = 1; $i < 9; $i++, $weight++) {
        $sum += (int) $base[$i] * $weight;
    }

    $second = ($sum % 11) - $discount;

    if ($second < 0) {
        $second += 11;
    }

    if ($second >= 10) {
        $second = 0;
    }

    return $base.(string) $first.(string) $second;
}

function makeCnsForBridge(string $base): string
{
    for ($digit = 0; $digit <= 9; $digit++) {
        $candidate = $base.(string) $digit;
        $sum = 0;

        for ($i = 0; $i < 15; $i++) {
            $sum += (int) $candidate[$i] * (15 - $i);
        }

        if ($sum % 11 === 0) {
            return $candidate;
        }
    }

    throw new RuntimeException('Cannot generate valid CNS for tests.');
}

function makeRenavamForBridge(string $base): string
{
    $weights = [3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    $sum = 0;

    for ($i = 0; $i < 10; $i++) {
        $sum += (int) $base[$i] * $weights[$i];
    }

    $digit = ($sum * 10) % 11;

    if ($digit === 10) {
        $digit = 0;
    }

    return $base.(string) $digit;
}

function makeTituloEleitorForBridge(string $base): string
{
    $sumA = 0;

    for ($i = 0; $i < 8; $i++) {
        $sumA += (int) $base[$i] * ($i + 2);
    }

    $mod = $sumA % 11;
    $dv1 = ($mod === 10 || $mod === 11) ? 0 : $mod;

    $sumB = (int) $base[8] * 7 + (int) $base[9] * 8 + $dv1 * 9;

    $mod = $sumB % 11;
    $dv2 = ($mod === 10 || $mod === 11) ? 0 : $mod;

    return $base.(string) $dv1.(string) $dv2;
}

function makeChassiForBridge(string $base16): string
{
    $charValues = [
        'A' => 1, 'J' => 1,
        'B' => 2, 'K' => 2, 'S' => 2,
        'C' => 3, 'L' => 3, 'T' => 3,
        'D' => 4, 'M' => 4, 'U' => 4,
        'E' => 5, 'N' => 5, 'V' => 5,
        'F' => 6, 'W' => 6,
        'G' => 7, 'P' => 7, 'X' => 7,
        'H' => 8, 'Y' => 8,
        'R' => 9, 'Z' => 9,
    ];

    $weights = [8, 7, 6, 5, 4, 3, 2, 10, 0, 9, 8, 7, 6, 5, 4, 3, 2];
    $vin = strtoupper(substr($base16, 0, 8).'0'.substr($base16, 8, 8));
    $sum = 0;

    for ($i = 0; $i < 17; $i++) {
        $char = $vin[$i];
        $charValue = is_numeric($char) ? (int) $char : ($charValues[$char] ?? 0);
        $sum += $charValue * $weights[$i];
    }

    $mod = $sum % 11;
    $checkDigit = $mod === 10 ? 'X' : (string) $mod;

    return substr($vin, 0, 8).$checkDigit.substr($vin, 9, 8);
}

it('validates all package rule classes', function (string $field, object $rule, string $valid, string $invalid): void {
    $validResult = Validator::make([$field => $valid], [$field => [$rule]]);
    $invalidResult = Validator::make([$field => $invalid], [$field => [$rule]]);

    expect($validResult->passes())->toBeTrue();
    expect($invalidResult->fails())->toBeTrue();
})->with([
    ['cpf', new Cpf, '529.982.247-25', '11111111111'],
    ['cnpj', new Cnpj, '04.252.011/0001-10', '04252011000111'],
    ['cpf_cnpj', new CpfCnpj, '529.982.247-25', '12345'],
    ['suframa', new Suframa, makeSuframaForBridge('12345678'), '001234567'],
    ['nis_pis', new NisPis, makeNisPisForBridge('1234567890'), '12345678901'],
    ['phone', new Phone, '(11) 98765-4321', '11876543210'],
    ['phone_ddi', new PhoneDdi, '+55 (11) 98765-4321', '5511876543210'],
    ['cnh', new Cnh, makeCnhForBridge('123456789'), '12345678901'],
    ['cns', new Cns, makeCnsForBridge('71234567890123'), '712345678901234'],
    ['renavam', new Renavam, makeRenavamForBridge('1234567890'), '12345678901'],
    ['titulo_eleitor', new TituloEleitor, makeTituloEleitorForBridge('1234567801'), '123456789100'],
    ['chassi', new Chassi, makeChassiForBridge('1HGCM8263A004352'), '1HGCM82639A004352'],
    ['inscricao_estadual', new InscricaoEstadual('SP'), '110042490114', '110042490115'],
    ['processo_judicial', new ProcessoJudicial, '00000014120248010001', '1234'],
    ['boleto', new Boleto, '34191790010104351004791020150008285480000000000', '12345'],
]);
