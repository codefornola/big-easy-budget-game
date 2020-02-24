here's some steps i've used to get started

https://laradock.io/documentation/#use-mongo

```
docker-compose build workspace php-fpm
docker-compose up -d mongo php-fpm
```


```
docker-compose exec workspace bash
cd app; composer install
php artisan migrate
```

migrations are currently failing with this
```
  [Symfony\Component\Debug\Exception\FatalThrowableError]
  Class 'MongoClient' not found
```

maybe we need to update the dependency?
https://github.com/jenssegers/laravel-mongodb#upgrading-from-version-2-to-3
