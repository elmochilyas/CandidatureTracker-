# CandidatureTracker

A personal Laravel application for tracking job applications. Centralize your entire job search: log applications by company, attach interview stages, track every opportunity's status, and archive completed records without losing history.

## Prerequisites

- **PHP** ^8.3
- **Composer**
- **Node.js** & **npm**
- **SQLite** (default database — no external DB server required)

## Installation

```bash
# 1. Clone the repository
git clone <repository-url>
cd candidaturetracker

# 2. Install PHP dependencies
composer install

# 3. Install and build frontend assets
npm install && npm run build

# 4. Copy environment file and generate app key
cp .env.example .env
php artisan key:generate

# 5. Run database migrations
php artisan migrate

# 6. Create the storage symlink (for file attachments)
php artisan storage:link

# 7. Start the development server
php artisan serve
```

Visit `http://127.0.0.1:8000` and register a new account to begin.

## Environment Variables

The `.env` file is pre-configured for local development with SQLite. The key variables:

| Variable | Default | Description |
|---|---|---|
| `APP_NAME` | `CandidatureTracker` | Application name |
| `APP_ENV` | `local` | Environment (`local`, `production`) |
| `APP_KEY` | *(empty)* | Application key (run `php artisan key:generate`) |
| `APP_DEBUG` | `true` | Enable detailed error output |
| `APP_URL` | `http://candidaturetracker.test` | Application base URL |
| `DB_CONNECTION` | `sqlite` | Database driver |
| `SESSION_DRIVER` | `database` | Session storage driver |
| `QUEUE_CONNECTION` | `database` | Queue driver |
| `CACHE_STORE` | `database` | Cache driver |
| `FILESYSTEM_DISK` | `local` | File storage disk |
| `MAIL_MAILER` | `log` | Mail driver (logs to file in dev) |

For email, configure `MAIL_*` variables with your SMTP credentials.

## Running Tests

```bash
php artisan test
```

## Features

- **Dashboard** — overview stats and recent applications
- **Candidatures** — full CRUD with company, role, status, priority, and notes
- **Interviews** — track interview stages per candidature
- **Attachments** — upload and download files (CVs, cover letters)
- **Archive/Restore** — soft-delete and restore candidatures
- **Authentication** — registration, login, email verification, password reset
- **Authorization** — users can only access their own candidatures

## Tech Stack

- **Laravel 13.x** — backend framework
- **Laravel Breeze** — authentication scaffolding
- **Pest PHP** — testing
- **TailwindCSS v4** + **Vite** — frontend build
- **Alpine.js** — interactivity
- **SQLite** — database
