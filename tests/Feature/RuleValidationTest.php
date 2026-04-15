<?php

declare(strict_types=1);

use Casilhero\BrazilianValidatorsLaravel\Rules\Cnh;
use Casilhero\BrazilianValidatorsLaravel\Rules\Cnpj;
use Casilhero\BrazilianValidatorsLaravel\Rules\Cns;
use Casilhero\BrazilianValidatorsLaravel\Rules\Cpf;
use Casilhero\BrazilianValidatorsLaravel\Rules\CpfCnpj;
use Casilhero\BrazilianValidatorsLaravel\Rules\NisPis;
use Casilhero\BrazilianValidatorsLaravel\Rules\Phone;
use Casilhero\BrazilianValidatorsLaravel\Rules\PhoneDdi;
use Casilhero\BrazilianValidatorsLaravel\Rules\Suframa;
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
]);
