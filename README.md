# Description

A simple Multi-Tenancy SASS project for e-commerce.

## Development

To get this project up and running, please follow:

1. Create a copy of the `.env.example` to `.env`
```shell
cp .env.example .env
```

2. Update `.env` file with central database credentials

3. Install dependencies
```shell
composer install
```

3. Get the project started
```shell
php artisan serve
```

## Migration

To run migrations for tenants:
```shell
php artisan tenants:migrate
php artisan make:migration create_users_table --path=database/migrations/tenant
```

To run migrations for central database:
```shell
php artisan migrate
php artisan make:migration create_users_table
```

## API Postman collection

Please check the [Postman collection](https://documenter.getpostman.com/view/25728032/2s9YRFTUb5) to have an idea about the registered endpoints.
