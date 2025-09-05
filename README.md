# LARAVEL LEARNING:

## Project Creation & Setup
### Create New Laravel Project
```bash
composer create-project laravel/laravel project-name
laravel new project-name
```
### Install Dependencies
```bash
composer install
```
### Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```
### Server Management
```bash
php artisan serve
php artisan serve --port=9000
php artisan serve --host=0.0.0.0 --port=8000
```

### Database & Migrations & run migrations.
```bash
php artisan make:migration create_table_name_table
php artisan migrate
```
### Rollback Last Migration & Rollback All Migrations
```bash
php artisan migrate:rollback
php artisan migrate:reset
```
### Rollback and Re-run Migrations & Check Migration Status
```bash
php artisan migrate:refresh
php artisan migrate:status
```
### Create Migration with Schema
```bash
php artisan make:migration create_users_table --create=users
```

### Create Basic Model  & Create Model with Migration
```bash
php artisan make:model ModelName
php artisan make:model ModelName -m
```
### Create Model with Migration and Controller
```bash
php artisan make:model ModelName -mc
```
### Create Model with All Components (API) [ MAIN ]
```bash
php artisan make:model ModelName -a --api
```

### Create Basic Controller
```bash
php artisan make:controller ControllerName
```
### Create API Resource Controller
```bash
php artisan make:controller ControllerName --api
```
### Create Controller with Model
```bash
php artisan make:controller ControllerName --model=ModelName
```

## API Resource Commands
### Create API Resource
```bash
php artisan make:resource ResourceName
```
### Create API Resource Collection
```bash
php artisan make:resource ResourceName --collection
```
### Create Form Request
```bash
php artisan make:request RequestName
```

### Route Commands: List All Routes
```bash
php artisan route:list
```
### List API Routes Only
```bash
php artisan route:list --path=api
```
### Cache Routes
```bash
php artisan route:cache
```
### Clear Route Cache
```bash
php artisan route:clear
```
<!-- ### Environment Setup
```bash
cp .env.example .env
php artisan key:generate
``` -->
