<p align="center">
  <a href="https://github.com/andrisan/mobe">
    <img src="mobe.svg" width="400" alt="Logo" width="80" height="80">
  </a>
  <h1 align="center" style="color: rgb(129, 140, 248">mobe</h1>
  <p align="center">
    mobe is web-based application for the management of student grades based on the OBE (Outcome Based Education) system.
  </p>
</p>

# Getting Started

## Prerequisites
You will need the following to run mobe:
- PHP >= 8.1
- Composer
- Node.js
- NPM
- Database server (MySQL, MariaDB, PostgreSQL, or SQLite)

## Installation

The following steps will guide you through the installation process of mobe for running in a development environment locally on your machine:
1. Clone the latest version of mobe from the repository 
2. Run `composer install` to install the required PHP dependencies
3. Copy the .env.example file to .env and edit the database credentials according to your database server
4. Run `php artisan key:generate` to generate a new application key
5. Run `php artisan migrate --seed` to create and seed the database
6. Run `php artisan storage:link` to expose uploaded files at `/storage`

## Running on Another Device (Important)

When you move this project to another laptop/PC, use this checklist to get the same behavior (including successful delete of seeded data from admin).

1. Pull the latest project code.
2. Install backend dependencies:
  - `composer install`
3. Install frontend dependencies:
  - `npm install`
4. Create and configure environment file:
  - Copy `.env.example` to `.env`
  - Set DB connection values (`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)
5. Generate app key:
  - `php artisan key:generate`
6. Apply all migrations (this is required for the delete fix):
  - New database: `php artisan migrate --seed`
  - Existing database: `php artisan migrate`
7. Verify migration status:
  - `php artisan migrate:status`
  - Make sure these migrations are `Ran`:
    - `2026_03_15_000001_add_cascade_deletes`
    - `2026_03_15_000002_add_cascade_deletes_faculty_department_studyprogram`
    - `2026_03_15_000003_add_cascade_deletes_user_references`

If those migrations are pending, delete operations can fail with foreign key errors on seeded data.

### Optional checks (if app does not load correctly)
- If you see Vite manifest errors, run:
  - `npm run dev` (development) or `npm run build` (production-like test)
- On some Windows setups, if `php artisan serve` has listen/reload issues, use:
  - `php artisan serve --no-reload --host=127.0.0.1 --port=8000`

## Run as Web App

1. Open terminal 1 and run:
  - `php artisan serve`
2. Open terminal 2 and run:
  - `npm install`
  - `npm run dev`
3. Open your browser at:
  - `http://localhost:8000`

## Run as Desktop App (NativePHP)

1. Make sure MySQL is running and your `.env` database credentials are correct.
2. Run:
  - `composer native:dev`
3. The desktop window should open automatically.

### Notes for Desktop Mode
- Desktop mode is configured to use the project MySQL database.
- Stop the desktop app with `Ctrl + C` in the terminal.
- If dependencies were updated and desktop runtime breaks, run `composer install` again and retry `composer native:dev`.

# Contributing

mobe is an open-source project and contributions are welcome. If you would like to contribute, please read the [contributing guidelines](CONTRIBUTING.md) first.

# License

mobe is open-sourced software licensed under the [MIT license](LICENSE).
