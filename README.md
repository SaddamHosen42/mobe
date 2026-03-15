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
