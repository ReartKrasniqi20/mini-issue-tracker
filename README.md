# Mini Issue Tracker

A Laravel app for tracking projects and their issues. Users can create projects, add issues, assign members, manage tags, leave comments, and filter issues by status, priority, tag, or search text.

## Stack

- Laravel 13
- PHP 8.3+
- Laravel Breeze auth
- Blade, Tailwind CSS, Alpine.js
- Vite
- MySQL by default

## Setup

Install dependencies:

```bash
composer install
npm install
```

Create the environment file:

```bash
cp .env.example .env
php artisan key:generate
```

Update the database values in `.env`, then run:

```bash
php artisan migrate --seed
```

## Run

Start Laravel:

```bash
php artisan serve
```

Start Vite in another terminal:

```bash
npm run dev
```

Open:

```text
http://127.0.0.1:8000
```

## Demo Login

Seeded login:

```text
Email: test@example.com
Password: password
```

## Useful Commands

```bash
composer test
npm run build
./vendor/bin/pint
```

## Main Files

- `routes/web.php`
- `app/Models/Project.php`
- `app/Models/Issue.php`
- `app/Models/Tag.php`
- `app/Models/Comment.php`
- `app/Http/Controllers/ProjectController.php`
- `app/Http/Controllers/IssueController.php`
- `resources/views/projects/`
- `resources/views/issues/`
- `database/migrations/`
- `database/seeders/`

## License

MIT
