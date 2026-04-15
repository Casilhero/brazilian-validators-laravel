# Brazilian Validators Laravel Bridge

Integracao oficial para Laravel do pacote `casilhero/brazilian-validators`, com Rules prontas para `FormRequest`, mensagens traduziveis e suporte a personalizacao de idioma por projeto.

## Sumario

- [Visao geral](#visao-geral)
- [Requisitos](#requisitos)
- [Instalacao](#instalacao)
- [Uso rapido em FormRequest](#uso-rapido-em-formrequest)
- [Rules disponiveis](#rules-disponiveis)
- [Helper via Facade](#helper-via-facade)
- [Internacionalizacao (i18n)](#internacionalizacao-i18n)
- [Compatibilidade](#compatibilidade)
- [Compatibilidade com regras legadas](#compatibilidade-com-regras-legadas)
- [Qualidade e testes](#qualidade-e-testes)
- [Licenca](#licenca)

## Visao geral

O pacote `casilhero/brazilian-validators-laravel` fornece uma camada Laravel sobre o core:

- Rules por classe (`new Cnpj()`, `new Cpf()`, etc.)
- Integracao com sistema de traducao do Laravel
- Publicacao de arquivos de idioma para customizacao local
- Facade para uso programatico fora da camada de Request

## Requisitos

- PHP `^8.1`
- Laravel `^12.0 || ^13.0`
- `casilhero/brazilian-validators` `^1.0`

## Instalacao

```bash
composer require casilhero/brazilian-validators-laravel
```

## Uso rapido em FormRequest

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

## Rules disponiveis

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
```

## Internacionalizacao (i18n)

Idiomas embarcados no pacote:

- `pt_BR`
- `en`

Publicar traducoes para customizar no projeto:

```bash
php artisan vendor:publish --tag=brazilian-validators-translations
```

Arquivos publicados em:

- `lang/vendor/brazilian-validators/{locale}/validation.php`

### Importante

- Nao ha fallback para chaves legadas `my_validation.*`.
- O contrato oficial e `brazilian-validators::validation.*`.

## Compatibilidade

| Componente | Versao suportada |
|---|---|
| PHP | `^8.1` |
| Laravel | `^12.0 || ^13.0` |
| Core package | `casilhero/brazilian-validators:^1.0` |

## Compatibilidade com regras legadas

| Regra legada | Rule no pacote | Status |
|---|---|---|
| `App\\Rules\\Cpf` | `Rules\\Cpf` | Comportamento equivalente |
| `App\\Rules\\Cnpj` | `Rules\\Cnpj` | Comportamento equivalente |
| `App\\Rules\\CpfCnpj` | `Rules\\CpfCnpj` | Comportamento equivalente |
| `App\\Rules\\Nis` | `Rules\\NisPis` | Comportamento equivalente |
| `App\\Rules\\Suframa` | `Rules\\Suframa` | Equivalente, com regra explicita de prefixo `00` invalido |
| `my_validation.*` | `brazilian-validators::validation.*` | Legado nao suportado por design |

## Qualidade e testes

Comando local:

```bash
composer test
```

CI do pacote:

- Matriz de execucao para Laravel 12 e Laravel 13.
- Validacao de integracao das Rules e traducoes.

## Licenca

MIT
