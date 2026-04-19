# AGENTS.md

## Visao geral

Este repositorio e uma aplicacao Laravel 12 com Laravel Breeze (Blade), Vite e Tailwind CSS para um sistema SaaS de cartao fidelidade. A maior parte do produto vive na area administrativa em `/admin`, com CRUDs para:

- empresas (`companies`)
- cartoes (`cards`)
- selos (`stamps`)
- recompensas (`rewards`)
- plano/metadados SaaS (`user-meta-saas`)

## Stack e arquitetura

- Backend: PHP 8.2 + Laravel 12
- Auth/UI base: Laravel Breeze com Blade
- Frontend: Vite + Tailwind CSS + Alpine.js
- Testes: PHPUnit com SQLite em memoria
- Seed principal: `Database\\Seeders\\RealDataSeeder`

O roteamento principal esta em `routes/web.php`. As rotas administrativas usam prefixo `admin` e nomes `admin.*`.

## Estrutura importante

- `app/Http/Controllers/Admin/` - controllers do painel administrativo
- `app/Models/` - modelos de dominio (`Company`, `Card`, `Stamp`, `Reward`, `UserMetaSaas`)
- `resources/views/admin/` - views Blade da area administrativa
- `resources/views/components/` - componentes Blade reutilizaveis do Breeze
- `database/migrations/` - schema principal do sistema
- `database/seeders/` - seeds, incluindo dados de demonstracao
- `resources/js/` e `resources/css/` - assets compilados via Vite

## Comandos uteis

### Setup inicial

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
```

> Observacao: `.env.example` usa SQLite por padrao no ambiente local.

### Desenvolvimento

```bash
composer dev
```

Esse comando sobe servidor Laravel, fila, logs e Vite em paralelo.

### Testes

```bash
composer test
```

Para rodar um arquivo especifico:

```bash
php artisan test tests/Feature/...
```

### Qualidade e build

```bash
vendor/bin/pint
npm run build
```

## Convencoes para mudancas

### Ao alterar uma funcionalidade administrativa

Normalmente voce vai precisar revisar em conjunto:

1. `routes/web.php`
2. controller em `app/Http/Controllers/Admin/`
3. model em `app/Models/`
4. views Blade em `resources/views/admin/<modulo>/`
5. migration ou seeder, quando a mudanca tocar dados

### Views e frontend

- Prefira manter o padrao Blade + Tailwind ja existente.
- Reaproveite componentes de `resources/views/components/` antes de criar markup novo.
- Se mudar assets JS/CSS, valide com `npm run build`.

### Backend

- Siga convencoes do Laravel para validacao, relacoes e mass assignment.
- Prefira validacao no controller/request em vez de logica solta na view.
- Preserve nomes e fluxos ja expostos nas rotas `admin.*`, a menos que a tarefa peca uma mudanca de contrato.

### Idioma e texto

- O produto e a documentacao do repositorio estao majoritariamente em portugues.
- Ao adicionar labels, mensagens e textos de interface, prefira portugues para manter consistencia.

## Testes esperados por tipo de mudanca

- Mudanca de regra de negocio, rota ou formulario: rode pelo menos `composer test`.
- Mudanca visual com assets: rode `npm run build`.
- Mudanca pequena de markdown ou docs: normalmente nao exige testes automatizados.

## Cuidados especificos deste repositorio

- Existe um modelo `App\\Models\\WpUser` apontando para a tabela `wp_users`. Ele parece representar uma integracao com WordPress; confirme impacto antes de alterar autenticacao ou tabelas relacionadas.
- O README tem algumas informacoes de deploy/estrutura que nao refletem exatamente todo o estado atual do codigo. Em caso de conflito, priorize `composer.json`, `routes/web.php`, as migrations e os arquivos realmente presentes no repositorio.
- Seeds incluem dados de demonstracao. Evite acoplar testes a credenciais ou valores literais desses seeds, a menos que a tarefa seja explicitamente sobre seed/demo data.

## Regra pratica para agentes

Antes de editar, descubra onde a funcionalidade esta implementada de fato. Neste projeto, a resposta quase sempre estara na combinacao de rotas + controller admin + model + Blade view correspondente.
