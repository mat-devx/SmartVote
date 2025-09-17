git clone <repo-url> SmartVote
<!-- prettier-ignore -->
# 🚀 SmartVote — Setup & Quickstart

![PHP](https://img.shields.io/badge/PHP-8.2%2B-%237F8C8D) ![Laravel](https://img.shields.io/badge/Laravel-12-orange) ![Vite](https://img.shields.io/badge/Vite-7-blue) ![SQLite](https://img.shields.io/badge/DB-SQLite-lightgrey)

This guide helps you get SmartVote running locally (Windows / PowerShell). It also includes cross-platform notes for macOS/Linux.

Table of contents
- [Prerequisites](#-prerequisites)
- [Quick start (copy-paste)](#-quick-start-copy-paste)
- [Detailed steps](#-detailed-steps)
- [Default accounts](#-default-accounts)
- [Troubleshooting](#-troubleshooting)
- [Optional improvements](#-optional-improvements)

---

## ⚙️ Prerequisites

- PHP 8.2+
- Composer
- Node.js 18+ and npm
- Git
- PHP SQLite extension (recommended) or MySQL/Postgres if preferred

Note: Laravel 12 + Vite are used for the app and assets.

---

## ✨ Quick start (PowerShell)

Copy-paste these commands into PowerShell from the project root.

```powershell
git clone <repo-url> SmartVote; cd SmartVote
composer install --no-interaction --prefer-dist
if (-Not (Test-Path .env)) { copy .env.example .env }
php artisan key:generate
if (-Not (Test-Path database/database.sqlite)) { New-Item -ItemType File database/database.sqlite }
php artisan migrate --force
php artisan db:seed --class=AdminStudentSeeder
npm install
npm run dev
php artisan serve

# Open http://127.0.0.1:8000
```

For a single command that runs server + queue + vite (dev): `composer run dev` (uses `concurrently`).

---

## 🧭 Detailed steps

### 1) Clone the repository

```powershell
git clone <repo-url> SmartVote
cd SmartVote
```

### 2) Install backend dependencies

```powershell
composer install --no-interaction --prefer-dist
```

Composer's post-create scripts usually copy `.env.example` to `.env`. If not:

```powershell
if (-Not (Test-Path .env)) { copy .env.example .env }
```

### 3) Generate an app key

```powershell
php artisan key:generate
```

### 4) Database — use SQLite by default

Create the SQLite file if missing:

```powershell
if (-Not (Test-Path database/database.sqlite)) { New-Item -ItemType File database/database.sqlite }
```

Check `.env` values (defaults are set for SQLite):

```
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

If you prefer MySQL/Postgres, update `.env` with credentials and ensure the DB server is running.

### 5) Run migrations & seeders

```powershell
php artisan migrate --force
php artisan db:seed --class=AdminStudentSeeder
```

### 6) Frontend

Install dependencies and run the dev server:

```powershell
npm install
npm run dev
```

You can also run the combined dev environment (server + queue + vite):

```powershell
composer run dev
```

### 7) Start the Laravel server (if not using `composer run dev`)

```powershell
php artisan serve
```

Visit http://127.0.0.1:8000

---

## 👥 Default accounts (seeded)

- Admin: `admin@gmail.com` / `qweqwe`
- Student: `student@gmail.com` / `qweqwe`

---

## 🛠️ Troubleshooting & tips

- Composer memory issues: increase `memory_limit` in your `php.ini`.
- Missing PHP extensions: enable `pdo_sqlite` for SQLite or `pdo_mysql`/`pdo_pgsql` for other DBs.
- File permission errors (SQLite): grant write access to `database/`.
- Node/npm issues: remove `node_modules` and `package-lock.json`, then `npm install`.
- Assets not updating: run `npm run dev` and clear Laravel caches:

```powershell
php artisan view:clear; php artisan route:clear; php artisan config:clear; php artisan cache:clear
```

---

## 🔒 Security notes

- Do not commit `.env` to source control.
- For production, use secure DB credentials and `APP_ENV=production`.

---

## ⚡ Optional improvements I can implement

- Add a dedicated `IsAdmin` middleware and register it in `app/Http/Kernel.php`.
- Add a GitHub Actions workflow to run tests on push.
- Create a polished `README.md` with badges, screenshots, and contribution notes.

---

If you'd like, I will commit this updated `SETUP.md` to the repository and implement one of the optional improvements — which one should I do next?
