# Brazilian Validators Laravel Bridge

Integração oficial para Laravel do pacote `casilhero/brazilian-validators`, com Rules prontas para `FormRequest`, mensagens traduzíveis e suporte a personalização de idioma por projeto.

## Sumário

- [Visão geral](#visão-geral)
- [Requisitos](#requisitos)
- [Instalação](#instalação)
- [Uso rápido em FormRequest](#uso-rápido-em-formrequest)
- [Rules disponíveis](#rules-disponíveis)
- [Helper via Facade](#helper-via-facade)
- [Internacionalização (i18n)](#internacionalização-i18n)
- [Compatibilidade](#compatibilidade)
- [Compatibilidade com regras legadas](#compatibilidade-com-regras-legadas)
- [Qualidade e testes](#qualidade-e-testes)
- [Licença](#licença)

## Visão geral

O pacote `casilhero/brazilian-validators-laravel` fornece uma camada Laravel sobre o core:

- Rules por classe (`new Cnpj()`, `new Cpf()`, etc.)
- Integração com sistema de tradução do Laravel
- Publicação de arquivos de idioma para customização local
- Facade para uso programático fora da camada de Request

## Requisitos

- PHP `^8.1`
- Laravel `^12.0 || ^13.0`
- `casilhero/brazilian-validators` `^1.0`

## Instalação

```bash
composer require casilhero/brazilian-validators-laravel
```

## Uso rápido em FormRequest

```php
<?php

namespace App\Http\Requests;

use Casilhero\BrazilianValidatorsLaravel\Rules\Cnpj;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cnpj' => ['required', 'string', new Cnpj(), Rule::unique('customers', 'cnpj')],
        ];
    }
}
```

## Rules disponíveis

| Campo | Rule |
|---|---|
| CPF | `Rules\\Cpf` |
| CNPJ | `Rules\\Cnpj` |
| CPF/CNPJ | `Rules\\CpfCnpj` |
| SUFRAMA | `Rules\\Suframa` |
| NIS/PIS | `Rules\\NisPis` |
| Telefone BR | `Rules\\Phone` |
| Telefone BR com DDI | `Rules\\PhoneDdi` |
| CNH | `Rules\\Cnh` |
| CNS | `Rules\\Cns` |

As mensagens seguem o namespace do pacote:

- `brazilian-validators::validation.<regra>`

## Helper via Facade

Exemplo de uso fora do array de rules:

```php
<?php

use Casilhero\BrazilianValidatorsLaravel\Facades\BrazilianValidator;

$okCnpj = BrazilianValidator::cnpj('04.252.011/0001-10');
$okPhone = BrazilianValidator::phone('(11) 98765-4321');

// Retorno detalhado com código de erro
$result = BrazilianValidator::cpfResult('11111111111');

if (! $result->isValid()) {
    echo $result->code(); // invalid_format
}
```

## Internacionalização (i18n)

Idiomas embarcados no pacote:

- `pt_BR`
- `en`

Publicar traduções para customizar no projeto:

```bash
php artisan vendor:publish --tag=brazilian-validators-translations
```

Arquivos publicados em:

- `lang/vendor/brazilian-validators/{locale}/validation.php`

### Importante

- Não há fallback para chaves legadas `my_validation.*`.
- O contrato oficial é `brazilian-validators::validation.*`.

## Compatibilidade

| Componente | Versão suportada |
|---|---|
| PHP | `^8.1` (inclui 8.5) |
| Laravel | `^12.0 \|\| ^13.0` |
| Core package | `casilhero/brazilian-validators:^1.0` |

## Compatibilidade com regras legadas

| Regra legada | Rule no pacote | Status |
|---|---|---|
| `App\\Rules\\Cpf` | `Rules\\Cpf` | Comportamento equivalente |
| `App\\Rules\\Cnpj` | `Rules\\Cnpj` | Comportamento equivalente |
| `App\\Rules\\CpfCnpj` | `Rules\\CpfCnpj` | Comportamento equivalente |
| `App\\Rules\\Nis` | `Rules\\NisPis` | Comportamento equivalente |
| `App\\Rules\\Suframa` | `Rules\\Suframa` | Equivalente, com regra explícita de prefixo `00` inválido |
| `my_validation.*` | `brazilian-validators::validation.*` | Legado não suportado por design |

## Qualidade e testes

Comando local:

```bash
composer test
```

CI do pacote:

- Matriz de execução para Laravel 12 e Laravel 13.
- Validação de integração das Rules e traduções.

## Licença

MIT
