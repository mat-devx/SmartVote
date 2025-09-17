# 🎯 SmartVote — Setup & Quickstart  

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+"/>
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12"/>
  <img src="https://img.shields.io/badge/Vite-7-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite 7"/>
   <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL"/>
  <img src="https://img.shields.io/badge/Node.js-18+-339933?style=for-the-badge&logo=nodedotjs&logoColor=white" alt="Node.js"/>
  <img src="https://img.shields.io/badge/Composer-2.0+-885630?style=for-the-badge&logo=composer&logoColor=white" alt="Composer"/>
  <img src="https://img.shields.io/badge/Git-2+-F05032?style=for-the-badge&logo=git&logoColor=white" alt="Git"/>
  <img src="https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white" alt="GitHub"/>
  </p>

<p align="center">
  <b>SmartVote</b> is a Laravel 12 + Vite powered voting system designed for simplicity and speed.<br>
  This guide helps you set it up locally (Windows, macOS, Linux). 🚀
</p>

---

## 📑 Table of Contents
- [⚙️ Prerequisites](#️-prerequisites)
- [⚡ Quick Start (PowerShell)](#-quick-start-powershell)
- [🛠 Detailed Steps](#-detailed-steps)
- [👥 Default Accounts](#-default-accounts)
- [🐞 Troubleshooting](#-troubleshooting)
- [🔒 Security Notes](#-security-notes)
- [✨ Optional Improvements](#-optional-improvements)

---

## ⚙️ Prerequisites

- ![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)  
- ![Composer](https://img.shields.io/badge/Composer-2.0+-885630?style=for-the-badge&logo=composer&logoColor=white)  
- ![Node.js](https://img.shields.io/badge/Node.js-18+-339933?style=for-the-badge&logo=nodedotjs&logoColor=white)  
- ![Git](https://img.shields.io/badge/Git-2+-F05032?style=for-the-badge&logo=git&logoColor=white)  
- ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white) 

 
---

## ⚡ Quick Start (PowerShell)

Copy-paste these commands into **PowerShell** from the project root:

```powershell
git clone <repo-url> SmartVote
cd SmartVote
composer install --no-interaction --prefer-dist
if (-Not (Test-Path .env)) { copy .env.example .env }
php artisan key:generate
if (-Not (Test-Path database/database.sqlite)) { New-Item -ItemType File database/database.sqlite }
php artisan migrate --force
php artisan db:seed --class=AdminStudentSeeder
npm install
npm run dev
php artisan serve
```

- Open [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser.

> **Tip:** For a single command that runs Laravel + Vite + Queue:
>
> ```powershell
> composer run dev
> ```

---
## 🛠 Detailed Steps

### 1️⃣ Clone the repository

```powershell
git clone <repo-url> SmartVote
cd SmartVote
```

### 2️⃣ Install backend dependencies

```powershell
composer install --no-interaction --prefer-dist
```

### 3️⃣ Copy environment & generate key

```powershell
if (-Not (Test-Path .env)) { copy .env.example .env }
# Update your .env for MySQL connection before proceeding!
php artisan key:generate
```

### 4️⃣ Setup database (MySQL recommended)

Edit your `.env` file and set the following (adjust credentials as needed):

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smartvote
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

### 5️⃣ Run migrations & seeders

```powershell
php artisan migrate --force
php artisan db:seed --class=AdminStudentSeeder
```

### 6️⃣ Frontend

```powershell
npm install
npm run dev
```

---

## 👥 Default Accounts

| Role    | Email              | Password |
| ------- | ------------------ | -------- |
| Admin   | admin@gmail.com    | qweqwe   |
| Student | student@gmail.com  | qweqwe   |

---

## 🐞 Troubleshooting

- **Composer memory issues** → Increase `memory_limit` in `php.ini`.
- **Missing PHP extensions** → Enable `pdo_mysql`, `pdo_sqlite`, or `pdo_pgsql`.
- **MySQL connection issues** → Ensure MySQL is running and credentials in `.env` are correct.
- **File permission errors** → Ensure appropriate permissions for storage and bootstrap/cache.
- **Node/npm issues** → Remove `node_modules` and `package-lock.json`, then reinstall:

    ```powershell
    rm -r node_modules; rm package-lock.json; npm install
    ```

- **Clear Laravel caches:**

    ```powershell
    php artisan view:clear
    php artisan route:clear
    php artisan config:clear
    php artisan cache:clear
    ```

---

## 🔒 Security Notes

- ❌ Never commit `.env` to source control.
- ✅ For production, set:

    ```ini
    APP_ENV=production
    APP_DEBUG=false
    ```
 
