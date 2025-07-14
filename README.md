# 🧠 Cartão Fidelidade – Plataforma SaaS de Selos e Recompensas

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red?logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2-blue?logo=php)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-orange?logo=mysql)](https://www.mysql.com/)
[![Tailwind](https://img.shields.io/badge/TailwindCSS-3.x-38bdf8?logo=tailwindcss)](https://tailwindcss.com/)
[![Deployment: Hostinger](https://img.shields.io/badge/Deploy-Hostinger-purple)](https://www.hostinger.com/)

> Sistema SaaS desenvolvido com Laravel + Breeze + Tailwind, focado em fidelização de clientes com selos e recompensas.

---

## ✅ Funcionalidades Implementadas

### 🔐 Autenticação

-   Laravel Breeze com Blade
-   Login, registro, verificação de email e recuperação de senha

### 🛠️ Painel Administrativo `/admin`

Gerenciado com middleware `auth`, com CRUDs separados por módulo:

#### 1. Empresas (`companies`)

-   Slug automático, email, telefone, logo, status

#### 2. Cartões de Fidelidade (`cards`)

-   Título, descrição, total de selos, recompensa

#### 3. Selos (`stamps`)

-   Associados ao cartão e cliente
-   Marcações com data e flag `used`

#### 4. Recompensas (`rewards`)

-   Associadas ao cartão e cliente
-   Status: pending, redeemed

#### 5. Planos SaaS (`user_meta_saas`)

-   Plano do cliente, status ativo, data de assinatura e expiração

---

## 🧪 Seed de Dados

Inclui seed com:

-   Dono da plataforma: **Tiago Luvizoto Neves**
-   Primeira empresa cliente: **Queijadinhas da Taty**
-   Clientes com selos e recompensas para testes

Rodar:

```bash
php artisan migrate:fresh --seed
```

---

## ⚙️ Instalação Local

```bash
git clone https://github.com/tiagoluvizotoneves/cartaofidelidade.git
cd cartaofidelidade
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install && npm run dev
php artisan serve
```

Acesse: http://127.0.0.1:8000/admin

---

## 🚀 Deploy na Hostinger

Requisitos: Laravel 12, PHP 8.2+, MySQL 8, Composer 2, Node 18+

---

## 📁 Estrutura

Laravel: public_html/adm

WordPress: public_html/

---

## 📦 Comandos em produção

```bash
# dentro de /adm
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm install
npm run build
```

Verifique se o .env está com:

```bash
APP_ENV=production
APP_DEBUG=false
APP_URL=https://adm.cartaofidelidade.app.br
```

---

## 📂 Organização

```swift
app/
├── Http/
│   └── Controllers/
│       └── Admin/ → CompanyController, CardController, etc.
├── Models/
├── Providers/
resources/
└── views/
    └── admin/
        └── cards/, companies/, rewards/, stamps/
routes/
└── web.php
```

---

## 📌 Roadmap

✅ Autenticação
✅ CRUD Empresas
✅ CRUD Cartões
✅ CRUD Selos
✅ CRUD Recompensas
✅ Seed com dados reais
🔄 Integração com WooCommerce Subscriptions via API
🔄 Sincronização de wp_users com Laravel
🔄 Área de gestão do cliente
⏳ Geração de QR Code para carimbo
⏳ API externa pública com tokens
⏳ Dashboard e relatórios

---

## 👨‍💻 Autor

Tiago Luvizoto Neves
Desenvolvedor fullstack e fundador da plataforma
📧 contato@tlndesign.com.br
📱 (17) 99123-2211

---

## 📃 Licença

Projeto fechado sob licença comercial.
Para licenciamento, entre em contato.
