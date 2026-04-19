# AGENTS.md

This file gives coding agents a reliable playbook for working in this repository.

## Project summary

- Product: Cartao Fidelidade (SaaS for stamp cards and rewards)
- Backend: Laravel 12 + PHP 8.2
- Frontend: Blade + TailwindCSS + Vite + Alpine.js
- Database: MySQL 8

## Primary areas in the codebase

- `app/Http/Controllers/Admin/`: admin CRUD controllers (companies, cards, stamps, rewards, SaaS metadata)
- `app/Models/`: Eloquent models
- `resources/views/admin/`: Blade views for admin panel
- `routes/web.php`: web routes (including `/admin`)
- `database/seeders/`: seed data used for local validation

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
```

## Useful commands

- Full local development (recommended):

```bash
composer dev
```

- Backend only:

```bash
php artisan serve
```

- Frontend only:

```bash
npm run dev
```

- Test suite:

```bash
php artisan test
```

- Build frontend assets:

```bash
npm run build
```

## Coding expectations for agents

1. Keep changes scoped to the requested task.
2. Follow existing Laravel conventions (controllers, models, migrations, Blade structure).
3. Prefer clear, explicit validation and avoid hidden side effects.
4. Preserve Portuguese product terminology used by the project.
5. Do not introduce breaking route or database changes unless explicitly requested.

## Verification checklist before handoff

1. Run `php artisan test` for backend-impacting changes.
2. Run `npm run build` if frontend assets or Tailwind/Blade markup changed.
3. Update docs when behavior or setup changes.
4. Keep commits focused and descriptive.
