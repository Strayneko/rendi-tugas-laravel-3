# Laravel

#### Copy .env.example to .env and Edit .env file

```bash
DB_CONNECTION=pgsql/mysql
DB_HOST=hostname
DB_PORT=port
DB_DATABASE=database
DB_USERNAME=username
DB_PASSWORD=password
```

#### install composer package

```bash
composer install
```

#### Do migration

```bash
php artisan artisan migrate
```

#### Link storage folder to public folder

```bash
php artisan artisan storage:link
```

#### Generate application key

```bash
php artisan key:generate
```

#### Start local development server

```bash
php artisan serve
```
