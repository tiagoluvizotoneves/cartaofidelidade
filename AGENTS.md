# Agent instructions — Cartão Fidelidade

This repository is **Cartão Fidelidade**, a Laravel SaaS for loyalty stamps and rewards (admin UI under `/admin`). Agents should treat this file as project-specific guidance alongside general Cursor/agent rules.

## Stack

- **Backend:** Laravel 12, PHP 8.2+
- **Frontend assets:** Vite 6, Tailwind CSS 3.x, Alpine.js (see `package.json`)
- **Auth:** Laravel Breeze (Blade), session-based
- **Database:** MySQL in production; PHPUnit uses SQLite in-memory (see `phpunit.xml`)

## Layout that matters

- **`app/Http/Controllers/Admin/`** — CRUD for companies, cards, stamps, rewards, SaaS user meta
- **`routes/web.php`** — web routes (admin grouped with `auth`)
- **`resources/views/admin/`** — Blade templates for admin modules
- **`database/migrations/`**, **`database/seeders/`** — schema and seeds (`RealDataSeeder` for realistic demo data)

Optional WordPress-related code exists (for example `WpUserAuthServiceProvider`, `WpUser` model); prefer extending existing patterns when touching that area.

## Setup (local)

From the repo root:

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
npm install
```

Run the app (pick one):

- **`composer run dev`** — serves Laravel, queue listener, logs (`pail`), and Vite together
- **`php artisan serve`** plus **`npm run dev`** in another terminal

Admin entrypoint (after login): **`/admin`** (see README).

## Testing and quality

- **Tests:** `composer run test` or `php artisan test` — uses SQLite `:memory:`; do not assume MySQL-specific SQL in tests unless configured otherwise.
- **PHP style:** Laravel Pint is available (`./vendor/bin/pint`) — match existing style when editing PHP.

## Security and configuration

- Never commit secrets; **`.env`** stays local (see `.gitignore`).
- For production deploy notes (caching, `APP_DEBUG`, etc.), follow **`README.md`**.
- Prefer **`config/`** and **`env()`** boundaries consistent with Laravel conventions; avoid hardcoding tenant or production URLs in application code.

## Change discipline

- Keep edits focused on the requested behavior; mirror existing naming, Blade structure, and controller patterns in `Admin/`.
- When adding routes, policies, or middleware, wire them the same way similar features already do.
