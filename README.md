# casilhero/brazilian-validators-laravel

Integração oficial com Laravel do pacote [casilhero/brazilian-validators](https://github.com/Casilhero/brazilian-validators). Fornece Rules prontas para `FormRequest`, mensagens de validação traduzíveis e uma Facade para uso programático.

## Requisitos

- PHP `^8.1`
- Laravel `^12.0 || ^13.0`

## Instalação

```bash
composer require casilhero/brazilian-validators-laravel
```

O Service Provider é registrado automaticamente via auto-discovery.

## Rules

Use as Rules diretamente no array `rules()` de um `FormRequest`:

```php
use Casilhero\BrazilianValidatorsLaravel\Rules\Cnpj;
use Casilhero\BrazilianValidatorsLaravel\Rules\Cpf;
use Casilhero\BrazilianValidatorsLaravel\Rules\InscricaoEstadual;
use Casilhero\BrazilianValidatorsLaravel\Rules\ProcessoJudicial;
use Casilhero\BrazilianValidatorsLaravel\Rules\Renavam;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'cpf'                 => ['required', 'string', new Cpf()],
            'cnpj'                => ['required', 'string', new Cnpj()],
            'renavam'             => ['required', 'string', new Renavam()],
            'inscricao_estadual'  => ['required', 'string', new InscricaoEstadual('SP')],
            'processo_judicial'   => ['required', 'string', new ProcessoJudicial()],
        ];
    }
}
```

### Rules disponíveis

| Campo               | Classe                    | Observação                                              |
| ------------------- | ------------------------- | ------------------------------------------------------- |
| CPF                 | `Rules\Cpf`               |                                                         |
| CNPJ                | `Rules\Cnpj`              |                                                         |
| CPF ou CNPJ         | `Rules\CpfCnpj`           |                                                         |
| SUFRAMA             | `Rules\Suframa`           |                                                         |
| NIS/PIS             | `Rules\NisPis`            |                                                         |
| Telefone BR         | `Rules\Phone`             |                                                         |
| Telefone BR com DDI | `Rules\PhoneDdi`          |                                                         |
| CNH                 | `Rules\Cnh`               |                                                         |
| CNS                 | `Rules\Cns`               |                                                         |
| RENAVAM             | `Rules\Renavam`           |                                                         |
| Título de Eleitor   | `Rules\TituloEleitor`     |                                                         |
| Chassi (VIN)        | `Rules\Chassi`            |                                                         |
| Inscrição Estadual  | `Rules\InscricaoEstadual` | Recebe `string $uf` no construtor (ex.: `'SP'`)         |
| Certidão            | `Rules\Certidao`          | Aceita formato com ou sem espaços/hífens                |
| Passaporte          | `Rules\Passaporte`        | 2 letras + 6 dígitos (ex.: `AB123456`)                  |
| CAEPF               | `Rules\Caepf`             |                                                         |
| Processo Judicial   | `Rules\ProcessoJudicial`  | Formato CNJ: `NNNNNNN-DD.AAAA.J.TR.OOOO`                |
| Boleto              | `Rules\Boleto`            | Aceita bancário (47 dígitos) e arrecadação (48 dígitos) |

## Facade

A Facade `BrazilianValidator` é útil fora do contexto de Request, como em serviços, jobs ou artisan commands:

```php
use Casilhero\BrazilianValidatorsLaravel\Facades\BrazilianValidator;

// Retorno bool
BrazilianValidator::cpf('529.982.247-25');
BrazilianValidator::cnpj('04.252.011/0001-10');
BrazilianValidator::phone('(11) 98765-4321');
BrazilianValidator::renavam('77077411168');
BrazilianValidator::chassi('9BWZZZ377VT004251');
BrazilianValidator::tituloEleitor('123456789012');
BrazilianValidator::inscricaoEstadual('110042490114', 'SP');
BrazilianValidator::certidao('10514 01 55 2024 1 00001 092 0000250-28');
BrazilianValidator::passaporte('AB123456');
BrazilianValidator::caepf('132.574.492/00-1');
BrazilianValidator::processoJudicial('0000001-41.2024.8.01.0001');
BrazilianValidator::boleto('34191.79001 01043.510047 91020.150008 2 85480000000000');

// Retorno ValidationResult (sufixo Result)
$result = BrazilianValidator::cnpjResult('11.111.111/1111-11');

if (! $result->isValid()) {
    echo $result->code(); // ex: invalid_checksum
}

// Geração de dados de teste
$cpf    = BrazilianValidator::cpfGenerate();
$cnpj   = BrazilianValidator::cnpjGenerate();
$phone  = BrazilianValidator::phoneGenerate();
$cnh    = BrazilianValidator::cnhGenerate();
$proc   = BrazilianValidator::processoJudicialGenerate();
$boleto = BrazilianValidator::boletoGenerate();
// demais: cpfCnpjGenerate, suframaGenerate, nisPisGenerate, phoneDdiGenerate,
//         cnsGenerate, renavamGenerate, chassiGenerate, tituloEleitorGenerate,
//         certidaoGenerate, passaporteGenerate, caepfGenerate

// Aplicação de máscara
$maskedCpf    = BrazilianValidator::cpfMask('52998224725');    // '529.982.247-25'
$maskedCnpj   = BrazilianValidator::cnpjMask('04252011000110'); // '04.252.011/0001-10'
$maskedBoleto = BrazilianValidator::boletoMask('34191790010104351004791020150008285480000000000');
//   '34191.79001 01043.510047 91020.150008 2 85480000000000'
$maskedProc   = BrazilianValidator::processoJudicialMask('00000014120248010001');
//   '0000001-41.2024.8.01.0001'
// demais: cpfCnpjMask, suframaMask, nisPisMask, phoneMask, phoneDdiMask, cnhMask,
//         renavamMask, chassiMask, tituloEleitorMask, certidaoMask,
//         passaporteMask, caepfMask

// Parse (extrai campos estruturados)
$certidaoInfo = BrazilianValidator::certidaoParse('10514 01 55 2024 1 00001 092 0000250-28');
$certidaoInfo?->codigoServentia;  // '10514'
$certidaoInfo?->descricaoLivro(); // 'Livro A (Nascimento)'

$boletoInfo = BrazilianValidator::boletoParse('00190000090114971860168524522114675860000102656');
$boletoInfo?->type;            // 'bancario'
$boletoInfo?->bankCode;        // '001'
$boletoInfo?->amount;          // 102656
$boletoInfo?->amountInReals(); // 1026.56
$boletoInfo?->expirationDate;  // \DateTimeImmutable
```

Métodos `bool` disponíveis: `cpf`, `cnpj`, `cpfCnpj`, `suframa`, `nisPis`, `phone`, `phoneDdi`, `cnh`, `cns`, `renavam`, `chassi`, `tituloEleitor`, `inscricaoEstadual`, `certidao`, `passaporte`, `caepf`, `processoJudicial`, `boleto` — e suas variantes `*Result()` que retornam `ValidationResult`.

> `inscricaoEstadual` e `inscricaoEstadualResult` recebem um segundo argumento `string $uf` (ex.: `'SP'`, `'RJ'`).

## Mensagens de validação

Os idiomas `pt_BR` e `en` estão inclusos no pacote. As mensagens seguem o namespace `brazilian-validators::validation.<regra>`.

Para customizar as mensagens no seu projeto, publique os arquivos de idioma:

```bash
php artisan vendor:publish --tag=brazilian-validators-translations
```

Os arquivos serão publicados em:

```
lang/vendor/brazilian-validators/{locale}/validation.php
```

## Compatibilidade

| Componente   | Versão suportada                      |
| ------------ | ------------------------------------- |
| PHP          | `^8.1` (inclui 8.2, 8.3, 8.4 e 8.5)   |
| Laravel      | `^12.0 \|\| ^13.0`                    |
| Core package | `casilhero/brazilian-validators ^1.0` |

## Testes

```bash
composer test          # executa a suíte Pest
composer format        # aplica Laravel Pint
composer format:check  # verifica formatação sem alterar arquivos
```

A CI valida o pacote em matriz com Laravel 12 e 13.

## Licença

MIT
