## About

This is a PoC for for the [Peated](https://peated.com) project.

The intent is to prove out if Laravel is the right solution for the core application, and if so, we'd break apart the web app into two separate apps:

1. The core application, primarily the whisky database and its web views (not 1:1 with the current project)
2. A react-based SPA based on the existing project, but entirely focused on the social/personal features.

## Dev

Install PHP:

https://laravel.com/docs/11.x/installation#installing-php

Run required services (e.g. Postgres):

```
# use `peated` for compat w/ pre-existing repo
docker-compose -p peated up -d
```

Install dependencies:

```
npm install && npm run build
composer install
```

Run the app:

```
composer run dev
```

## References

https://github.com/clickbar/laravel-magellan

https://github.com/devNoiseConsulting/laravel-scout-postgres-tsvector

https://avenirer.medium.com/laravel-11-using-phps-8-enumerations-enums-for-database-migrations-seeding-etc-2af86bdbd1f2
