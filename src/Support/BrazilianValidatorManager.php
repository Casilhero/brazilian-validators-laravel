<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Support;

use Casilhero\BrazilianValidators\Support\ValidationResult;
use Casilhero\BrazilianValidators\Validators\Cnh;
use Casilhero\BrazilianValidators\Validators\Cnpj;
use Casilhero\BrazilianValidators\Validators\Cns;
use Casilhero\BrazilianValidators\Validators\Cpf;
use Casilhero\BrazilianValidators\Validators\CpfCnpj;
use Casilhero\BrazilianValidators\Validators\NisPis;
use Casilhero\BrazilianValidators\Validators\Phone;
use Casilhero\BrazilianValidators\Validators\PhoneDdi;
use Casilhero\BrazilianValidators\Validators\Suframa;

final class BrazilianValidatorManager
{
    public function cpf(string $value): bool
    {
        return Cpf::isValid($value);
    }

    public function cpfResult(string $value): ValidationResult
    {
        return Cpf::validate($value);
    }

    public function cnpj(string $value): bool
    {
        return Cnpj::isValid($value);
    }

    public function cnpjResult(string $value): ValidationResult
    {
        return Cnpj::validate($value);
    }

    public function cpfCnpj(string $value): bool
    {
        return CpfCnpj::isValid($value);
    }

    public function cpfCnpjResult(string $value): ValidationResult
    {
        return CpfCnpj::validate($value);
    }

    public function suframa(string $value): bool
    {
        return Suframa::isValid($value);
    }

    public function suframaResult(string $value): ValidationResult
    {
        return Suframa::validate($value);
    }

    public function nisPis(string $value): bool
    {
        return NisPis::isValid($value);
    }

    public function nisPisResult(string $value): ValidationResult
    {
        return NisPis::validate($value);
    }

    public function phone(string $value): bool
    {
        return Phone::isValid($value);
    }

    public function phoneResult(string $value): ValidationResult
    {
        return Phone::validate($value);
    }

    public function phoneDdi(string $value): bool
    {
        return PhoneDdi::isValid($value);
    }

    public function phoneDdiResult(string $value): ValidationResult
    {
        return PhoneDdi::validate($value);
    }

    public function cnh(string $value): bool
    {
        return Cnh::isValid($value);
    }

    public function cnhResult(string $value): ValidationResult
    {
        return Cnh::validate($value);
    }

    public function cns(string $value): bool
    {
        return Cns::isValid($value);
    }

    public function cnsResult(string $value): ValidationResult
    {
        return Cns::validate($value);
    }
}
