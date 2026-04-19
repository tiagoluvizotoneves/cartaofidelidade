# AGENTS.md

Guidance for AI coding agents (Cursor, Codex, Claude, etc.) working in this repository.

## Project overview

**Cartão Fidelidade** is a SaaS loyalty-card platform built with **Laravel 12** + **Laravel Breeze (Blade)** + **Tailwind CSS**, deployed on Hostinger alongside a WordPress installation. The Laravel app lives at `public_html/adm` in production and powers the admin panel at `/admin`.

Core domain entities:

- `Company` — tenant/business that issues loyalty cards.
- `Card` — loyalty card template (title, description, total stamps, reward).
- `Stamp` — individual stamp granted to a customer for a card.
- `Reward` — reward earned/redeemed by a customer.
- `UserMetaSaas` — SaaS plan metadata for users (plan, status, subscription dates).
- `User` / `WpUser` — Laravel users and WordPress user mirror (sync planned).

## Tech stack

- PHP **8.2+**, Laravel **12.x**, Tinker, Pail.
- MySQL **8.0** in production; SQLite supported locally.
- Frontend: Blade, Tailwind CSS 3.x, Alpine.js, Vite 6.
- Auth: Laravel Breeze (Blade stack) with email verification + password reset.
- Tests: PHPUnit 11 (`tests/Feature`, `tests/Unit`).
- Lint/format: Laravel Pint.

## Repository layout

```
app/
  Http/Controllers/
    Admin/        # CompanyController, CardController, StampController,
                  # RewardController, UserMetaSaasController, DashboardController
    Auth/         # Breeze controllers
    ProfileController.php
  Models/         # Card, Company, Reward, Stamp, User, UserMetaSaas, WpUser
  Providers/
  View/
database/
  migrations/     # companies, cards, stamps, rewards, user_meta_saas
  seeders/        # DatabaseSeeder, RealDataSeeder
  factories/
resources/
  views/admin/    # cards/, companies/, rewards/, stamps/, user-meta-saas/
routes/
  web.php         # public + admin (prefix: /admin, name: admin.*)
  auth.php        # Breeze auth routes
  console.php
tests/            # Feature + Unit (PHPUnit)
```

## Local setup

```bash
cp .env.example .env
composer install
npm install
php artisan key:generate
php artisan migrate --seed     # seeds RealDataSeeder
npm run dev                    # Vite dev server
php artisan serve              # http://127.0.0.1:8000
```

Admin panel: http://127.0.0.1:8000/admin

One-shot dev runner (server + queue + logs + vite via concurrently):

```bash
composer run dev
```

Reset the database with sample data at any time:

```bash
php artisan migrate:fresh --seed
```

## Common commands

| Task                | Command                                  |
| ------------------- | ---------------------------------------- |
| Run tests           | `composer test` (or `php artisan test`)  |
| Format code         | `./vendor/bin/pint`                      |
| Check formatting    | `./vendor/bin/pint --test`               |
| Tail logs           | `php artisan pail`                       |
| Build frontend      | `npm run build`                          |
| Dev frontend        | `npm run dev`                            |
| Clear caches        | `php artisan optimize:clear`             |

Always run `php artisan test` and `./vendor/bin/pint --test` before committing.

## Conventions for agents

### Code style

- Follow **Laravel Pint** defaults (PSR-12 with Laravel preset). Run Pint on any PHP file you change.
- Prefer **typed properties**, **return types**, and **constructor property promotion** where it improves clarity.
- Keep controllers thin; put domain logic in models, actions, or services under `app/`.
- Use **Eloquent relationships** instead of manual joins where reasonable.
- Use **form requests** for non-trivial validation rather than inline `$request->validate()`.
- Prefer **route model binding** and resourceful routes (already used under `/admin`).

### Blade & frontend

- Blade views for the admin panel live in `resources/views/admin/<resource>/`.
- Use Tailwind utility classes; avoid inline `<style>` blocks.
- Reuse Breeze components in `resources/views/components/` (e.g. `<x-input-label>`, `<x-primary-button>`).
- New JS goes through Vite (`resources/js/app.js`); do not add `<script src>` to a CDN.

### Database

- New schema changes require a **migration** in `database/migrations/`. Never edit an existing migration that is in `main`; create a new one.
- Update or add a **seeder** when introducing a new entity that is needed for local development.
- Update related **factories** so feature tests can use them.

### Routes

- Admin routes belong inside the `auth` middleware + `admin.` name group in `routes/web.php`.
- Keep route names consistent: `admin.<resource>.<action>` (Laravel resource defaults).

### Localization

- The product UI is in **Brazilian Portuguese (pt-BR)**. Keep user-facing strings in pt-BR. Match the existing tone in views and README.
- Code identifiers (classes, methods, variables, table/column names) stay in English.

### Tests

- Add or update tests under `tests/Feature` for HTTP/route/controller behavior and `tests/Unit` for isolated logic.
- Prefer `RefreshDatabase` for feature tests that touch the DB.
- Run `php artisan test` and ensure the full suite passes before declaring a task done.

## Things NOT to do

- Do **not** commit secrets. `.env` is git-ignored; never replace `.env.example` with real values.
- Do **not** edit files under `vendor/`, `node_modules/`, `public/build/`, `storage/`, or `bootstrap/cache/` by hand.
- Do **not** modify existing migrations that have already been merged; add a new migration instead.
- Do **not** change auth scaffolding (Breeze) lightly — the production users depend on it.
- Do **not** add new top-level dependencies without a clear reason; prefer what Laravel/Breeze already provides.
- Do **not** disable or skip tests to make CI pass.

## Production notes (Hostinger)

- Laravel served from `public_html/adm`, WordPress from `public_html/`.
- Production env must have `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://adm.cartaofidelidade.app.br`.
- After deploy:

  ```bash
  composer install --no-dev --optimize-autoloader
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  npm install
  npm run build
  ```

## Roadmap (context for planning)

Implemented: auth, CRUDs for companies/cards/stamps/rewards, real-data seed.

Planned: WooCommerce Subscriptions integration, `wp_users` ↔ Laravel sync, customer-facing area, QR code stamping, public API with tokens, dashboard & reports.

When adding code in these areas, align with the existing admin module patterns (controller in `app/Http/Controllers/Admin/`, model in `app/Models/`, views in `resources/views/admin/<resource>/`, resourceful route in `routes/web.php`).
