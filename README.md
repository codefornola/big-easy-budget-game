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

# view view the logs (while inside the container)
tail /var/www/storage/logs/laravel.log
```

After the migrations are run, you can open the mongo cli to inspect the database with 
```
docker exec -it laradock_mongo_1 mongo
```


### install assets (from workspace)
```
# for some reason you need python to install javascript libraries to transpile javascript/saas?
apt-get install python2.7
npm config set python /usr/bin/python2.7
npm i

# possibly need to install gulp globally?
npm i -g gulp@3.2.1

# run all gulp tasks
gulp
```


### run server
```
php artisan serve --port 8080 --host 0.0.0.0
```

