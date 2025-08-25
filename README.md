# The Tech Blog

This project was created for **Curotec's technical assessment**.
It is a simple resource listing platform built with **Laravel 10** (backend) and **Vue.js** (frontend).

---

## 🚀 Features

- (STORY-001) Resource listing with pagination with 10 items per page, filtering and sorting with immediate UI feedback
- (STORY-002) Resource creation in a multi-step form, with proper validation.
---

## 🛠️ Tech Stack

- [Laravel 10](https://laravel.com/) — PHP framework for the backend (v.10)
- [Vue.js 3](https://vuejs.org/) — Progressive frontend framework
- [Vue3 Toastify](https://vue3-toastify.js-bridge.com/) - For displaying the application's errors in the UI.
- [Eloquent ORM](https://laravel.com/docs/eloquent) — Laravel database abstraction
- [Bulma CSS](https://bulma.io/) — For styling, frontend.
- [PostgreSQL 15](https://www.postgresql.org/) — DBMS

---

## 📦 Requirements

Make sure you have the following installed on your machine:

- PHP >= 8.2
- Composer
- Node.js >= 20 & npm (or yarn/pnpm)
- PostgreSQL 15 (or another supported database)

---

## ⚙️ Installation

Clone the repository and set up the environment:

```bash
git clone https://github.com/petrusnog/thetechblog.git
cd thetechblog

# Install backend dependencies
composer install

# Install frontend dependencies
npm install

# Setup PostgreSQL database from this script I've built. (YOU MUST HAVE POSTGRESQL INSTALLED IN YOUR LOCAL MACHINE)
chmod +x setup_database.sh
./setup_database.sh

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations and seed database
php artisan migrate --seed

# Start the dev servers
npm run dev
php artisan serve
