<p align="center">
  <a href="https://github.com/andrisan/mobe">
    <img src="mobe.svg" alt="HSTU-OBE logo" width="220" />
  </a>
</p>

# HSTU-OBE

HSTU-OBE is a web application for managing student grades using Outcome Based Education (OBE) principles.

## Table of contents

- [Prerequisites](#prerequisites)
- [Quick Setup (Development)](#quick-setup-development)
- [Running the App](#running-the-app)
- [Desktop Mode (NativePHP)](#desktop-mode-nativephp)
- [Migrations & Important Notes](#migrations--important-notes)
- [Testing](#testing)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)

## Prerequisites

- PHP >= 8.1
- Composer
- Node.js (LTS recommended)
- npm (or yarn)
- A supported database server: MySQL, MariaDB, PostgreSQL, or SQLite

## Quick Setup (Development)

1. Clone the repository and change into the project directory:

```bash
git clone https://github.com/andrisan/mobe.git
cd HSTU-OBE
```

2. Install PHP dependencies:

```bash
composer install
```

3. Install frontend dependencies:

```bash
npm install
```

4. Copy environment example and set database credentials:

```bash
cp .env.example .env
# edit .env: DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
php artisan key:generate
```

5. Run database migrations (and seed on a new database):

```bash
# New database
php artisan migrate --seed

# If connecting to an existing database
php artisan migrate
```

6. Create a public storage link:

```bash
php artisan storage:link
```

## Running the App

Development (browser + asset hot-reload):

```bash
# Terminal 1: start backend
php artisan serve --host=127.0.0.1 --port=8000

# Terminal 2: start frontend dev server (Vite)
npm run dev

# Open http://localhost:8000
```

If you prefer a production-like build for frontend assets:

```bash
npm run build
```

## Desktop Mode (NativePHP)

This project supports a desktop runtime via NativePHP.

```bash
# Ensure your DB is running and .env is configured
composer native:dev
```

Notes:
- Desktop mode uses the same MySQL database configured in `.env`.
- Stop the desktop app with `Ctrl+C` in the terminal.

## Migrations & Important Notes

After moving the project to another machine, make sure these migrations have run. If they are pending, seeded-data deletes can fail due to foreign key constraints.

- `2026_03_15_000001_add_cascade_deletes`
- `2026_03_15_000002_add_cascade_deletes_faculty_department_studyprogram`
- `2026_03_15_000003_add_cascade_deletes_user_references`

Check migration status with:

```bash
php artisan migrate:status
```

If migrations are pending, run `php artisan migrate` or `php artisan migrate --seed` for a fresh DB.

## Testing

Run PHP unit tests with:

```bash
./vendor/bin/phpunit
```

Or using the `php` helper:

```bash
php artisan test
```

## Troubleshooting

- Vite manifest errors: ensure `npm run dev` is running during development, or run `npm run build` for a production-like test.
- On some Windows setups `php artisan serve` may have reload/listen issues — try:

```bash
php artisan serve --no-reload --host=127.0.0.1 --port=8000
```

- If you encounter foreign-key errors when deleting seeded data, confirm the cascade-delete migrations listed above have been applied.

## Contributing

Contributions are welcome. Please read the contributing guidelines before opening issues or pull requests: [CONTRIBUTING.md](CONTRIBUTING.md)

---

If you'd like, I can also:

- add a small `DEV_NOTES.md` with platform-specific tips
- run `composer install` / `npm install` here and verify a dev run

Tell me which you'd like next.
