# AGENTS.md

This file provides guidance for AI coding agents working on this repository.

## Project Overview

**Cartão Fidelidade** is a Laravel 12 SaaS platform for customer loyalty via stamps (selos) and rewards (recompensas). It is a multi-tenant system where each business (company) can define loyalty cards, issue stamps to customers, and grant rewards upon completion.

- **Backend:** PHP 8.2, Laravel 12, Laravel Breeze (Blade)
- **Frontend:** Blade templates, TailwindCSS 3.x, Alpine.js, Vite
- **Database:** MySQL 8.0 in production; SQLite in-memory for tests
- **Deploy target:** Hostinger shared hosting (`public_html/adm`)

## Repository Structure

```
app/
├── Http/
│   └── Controllers/
│       └── Admin/         # Admin panel controllers (Card, Company, Reward, Stamp, UserMetaSaas, Dashboard)
├── Models/                # Eloquent models (Card, Company, Reward, Stamp, User, UserMetaSaas, WpUser)
├── Providers/
config/
database/
├── factories/
├── migrations/
└── seeders/
resources/
└── views/
    └── admin/             # Blade views for each admin module
routes/
├── web.php                # Main web routes (admin panel at /admin)
├── auth.php               # Breeze auth routes
└── console.php
tests/
├── Feature/
└── Unit/
```

## Development Setup

```bash
git clone https://github.com/tiagoluvizotoneves/cartaofidelidade.git
cd cartaofidelidade
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install && npm run dev
php artisan serve
```

Access the admin panel at: http://127.0.0.1:8000/admin

To run the full development stack (server + queue + logs + Vite) in one command:

```bash
composer run dev
```

## Running Tests

Tests use SQLite in-memory and require no external services:

```bash
composer test
# or directly:
php artisan test
```

- Unit tests: `tests/Unit/`
- Feature tests: `tests/Feature/`
- PHPUnit config: `phpunit.xml`

Always run `php artisan config:clear` before tests if you change `.env`.

## Code Style

This project uses **Laravel Pint** for PHP code formatting:

```bash
./vendor/bin/pint
```

Run Pint before committing any PHP changes. There is no separate ESLint/Prettier config; follow standard Blade/Alpine conventions.

## Key Conventions

- **Admin routes** are all prefixed `/admin` and protected by the `auth` middleware.
- **Controllers** live in `app/Http/Controllers/Admin/` and follow resource conventions (`index`, `create`, `store`, `edit`, `update`, `destroy`).
- **Models** use standard Eloquent relationships. Slugs are generated automatically on the `Company` model.
- **Seeders** create a demo owner (`Tiago Luvizoto Neves`) and a sample company (`Queijadinhas da Taty`) with stamps and rewards.
- **WpUser** model exists for future WordPress/WooCommerce synchronization — treat it as read-only for now.
- **UserMetaSaas** stores SaaS plan metadata (plan name, active status, subscription and expiry dates) per user.

## Database

- Run fresh migrations with seed data:
  ```bash
  php artisan migrate:fresh --seed
  ```
- Migrations live in `database/migrations/`.
- Do not modify existing migrations; always create new ones.

## Frontend Assets

Built with Vite:

```bash
npm run dev    # development with HMR
npm run build  # production build
```

TailwindCSS configuration: `tailwind.config.js`  
Vite configuration: `vite.config.js`

## Production Deployment (Hostinger)

The app is deployed to `public_html/adm` on Hostinger. After pushing changes:

```bash
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm install
npm run build
```

Ensure the production `.env` contains:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://adm.cartaofidelidade.app.br
```

## Roadmap Context

When working on new features, be aware of upcoming integrations:

- **WooCommerce Subscriptions API** — sync subscription plans from WordPress to Laravel
- **wp_users sync** — mirror WordPress user accounts into the Laravel users table
- **Customer management area** — frontend for end-customers to view their cards/stamps
- **QR Code stamping** — generate scannable codes for physical stamp events
- **Public API with tokens** — external REST API for third-party integrations
- **Dashboard & reports** — analytics for companies and the platform owner
