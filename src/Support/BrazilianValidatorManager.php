<?php

declare(strict_types=1);

namespace Casilhero\BrazilianValidatorsLaravel\Support;

use Casilhero\BrazilianValidators\Support\ValidationResult;
use Casilhero\BrazilianValidators\Validators\Caepf;
use Casilhero\BrazilianValidators\Validators\Chassi;
use Casilhero\BrazilianValidators\Validators\Cnh;
use Casilhero\BrazilianValidators\Validators\Cnpj;
use Casilhero\BrazilianValidators\Validators\Cns;
use Casilhero\BrazilianValidators\Validators\Cpf;
use Casilhero\BrazilianValidators\Validators\CpfCnpj;
use Casilhero\BrazilianValidators\Validators\InscricaoEstadual;
use Casilhero\BrazilianValidators\Validators\NisPis;
use Casilhero\BrazilianValidators\Validators\Phone;
use Casilhero\BrazilianValidators\Validators\PhoneDdi;
use Casilhero\BrazilianValidators\Validators\Renavam;
use Casilhero\BrazilianValidators\Support\CertidaoInfo;
use Casilhero\BrazilianValidators\Validators\Certidao;
use Casilhero\BrazilianValidators\Validators\Passaporte;
use Casilhero\BrazilianValidators\Validators\ProcessoJudicial;
use Casilhero\BrazilianValidators\Validators\Suframa;
use Casilhero\BrazilianValidators\Validators\TituloEleitor;

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

    public function renavam(string $value): bool
    {
        return Renavam::isValid($value);
    }

    public function renavamResult(string $value): ValidationResult
    {
        return Renavam::validate($value);
    }

    public function chassi(string $value): bool
    {
        return Chassi::isValid($value);
    }

    public function chassiResult(string $value): ValidationResult
    {
        return Chassi::validate($value);
    }

    public function tituloEleitor(string $value): bool
    {
        return TituloEleitor::isValid($value);
    }

    public function tituloEleitorResult(string $value): ValidationResult
    {
        return TituloEleitor::validate($value);
    }

    public function inscricaoEstadual(string $value, string $uf): bool
    {
        return InscricaoEstadual::isValid($value, $uf);
    }

    public function inscricaoEstadualResult(string $value, string $uf): ValidationResult
    {
        return InscricaoEstadual::validate($value, $uf);
    }

    public function certidao(string $value): bool
    {
        return Certidao::isValid($value);
    }

    public function certidaoResult(string $value): ValidationResult
    {
        return Certidao::validate($value);
    }

    public function certidaoParse(string $value): ?CertidaoInfo
    {
        return Certidao::parse($value);
    }

    public function passaporte(string $value): bool
    {
        return Passaporte::isValid($value);
    }

    public function passaporteResult(string $value): ValidationResult
    {
        return Passaporte::validate($value);
    }

    public function caepf(string $value): bool
    {
        return Caepf::isValid($value);
    }

    public function caepfResult(string $value): ValidationResult
    {
        return Caepf::validate($value);
    }

    public function processoJudicial(string $value): bool
    {
        return ProcessoJudicial::isValid($value);
    }

    public function processoJudicialResult(string $value): ValidationResult
    {
        return ProcessoJudicial::validate($value);
    }

    // ─── generate ────────────────────────────────────────────────────────────

    public function cpfGenerate(): string
    {
        return Cpf::generate();
    }

    public function cnpjGenerate(): string
    {
        return Cnpj::generate();
    }

    public function cpfCnpjGenerate(): string
    {
        return CpfCnpj::generate();
    }

    public function cnhGenerate(): string
    {
        return Cnh::generate();
    }

    public function cnsGenerate(): string
    {
        return Cns::generate();
    }

    public function nisPisGenerate(): string
    {
        return NisPis::generate();
    }

    public function phoneGenerate(): string
    {
        return Phone::generate();
    }

    public function phoneDdiGenerate(): string
    {
        return PhoneDdi::generate();
    }

    public function renavamGenerate(): string
    {
        return Renavam::generate();
    }

    public function suframaGenerate(): string
    {
        return Suframa::generate();
    }

    public function certidaoGenerate(): string
    {
        return Certidao::generate();
    }

    public function passaporteGenerate(): string
    {
        return Passaporte::generate();
    }

    public function caepfGenerate(): string
    {
        return Caepf::generate();
    }

    public function chassiGenerate(): string
    {
        return Chassi::generate();
    }

    public function tituloEleitorGenerate(): string
    {
        return TituloEleitor::generate();
    }

    public function processoJudicialGenerate(): string
    {
        return ProcessoJudicial::generate();
    }

    // ─── mask ────────────────────────────────────────────────────────────────

    public function cpfMask(string $value): string
    {
        return Cpf::mask($value);
    }

    public function cnpjMask(string $value): string
    {
        return Cnpj::mask($value);
    }

    public function cpfCnpjMask(string $value): string
    {
        return CpfCnpj::mask($value);
    }

    public function cnhMask(string $value): string
    {
        return Cnh::mask($value);
    }

    public function cnsMask(string $value): string
    {
        return Cns::mask($value);
    }

    public function nisPisMask(string $value): string
    {
        return NisPis::mask($value);
    }

    public function phoneMask(string $value): string
    {
        return Phone::mask($value);
    }

    public function phoneDdiMask(string $value): string
    {
        return PhoneDdi::mask($value);
    }

    public function renavamMask(string $value): string
    {
        return Renavam::mask($value);
    }

    public function suframaMask(string $value): string
    {
        return Suframa::mask($value);
    }

    public function certidaoMask(string $value): string
    {
        return Certidao::mask($value);
    }

    public function passaporteMask(string $value): string
    {
        return Passaporte::mask($value);
    }

    public function caepfMask(string $value): string
    {
        return Caepf::mask($value);
    }

    public function chassiMask(string $value): string
    {
        return Chassi::mask($value);
    }

    public function tituloEleitorMask(string $value): string
    {
        return TituloEleitor::mask($value);
    }

    public function processoJudicialMask(string $value): string
    {
        return ProcessoJudicial::mask($value);
    }
}
