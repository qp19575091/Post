Installation
------------


```
composer install
```

Then create .env file and edit database credentials there

```
cp .env.example .env
```
After run command you can find .env has copy from .env.example

Then generate APP_KEY
```
php artisan key:generate
```
After run command you can find APP_KEY in .env file has created

Create JWT key
```
php artisan jwt:secret
```

Final migrate database table. if want to seed some data you can add "--seed" after the command line
```
php artisan migrate
```
