here's some steps i've used to get started

https://laradock.io/documentation/#use-mongo

## Initial setup
```
# to initialize, fetch and checkout any nested submodules
git submodule update --init --recursive

cd laradock/
# create a file named .env in the laradock folder with this contents https://gist.github.com/mrcnc/c764a3270e86c039494ef6159908d2b0

# then run the following (it will take several minutes):
docker-compose build workspace php-fpm

# then startup the app with this
docker-compose up -d mongo php-fpm
```


## Development
```
docker-compose exec workspace bash
# you should be in the /var/www dir with all the code under the app/
# folder of the project, including the composer.json
composer install

php artisan migrate
```

migrations are currently failing with this
```
  [Symfony\Component\Debug\Exception\FatalThrowableError]
  Class 'MongoClient' not found
```

maybe we need to update the dependency?
https://github.com/jenssegers/laravel-mongodb#upgrading-from-version-2-to-3
