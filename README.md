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

# then start the prerequisite services 
docker-compose up -d mongo php-fpm
```


## Development

First you should login to the "workspace" container because that is where you will want to run all of the following steps
```
# run this from the laradock folder
docker-compose exec workspace bash
```

### install dependencies 
```
# from the /var/www directory, you should see a composer.json and all of the other code
# mounted inside the container.  then you can install the app dependencies
composer install

# now install front end assets 
# for some reason you need python to install javascript libraries to transpile javascript/saas?
apt-get install python2.7
npm config set python /usr/bin/python2.7
npm i

# possibly need to install gulp globally?
npm i -g gulp@3.2.1

# run all gulp tasks for app assets
gulp

# then change the gulpfile.js to comment out the tasks for app assets
# and uncomment the ones for the www assets and run gulp again
gulp
```

### setup database
```
# run migrations to setup the database schema
php artisan migrate
```

> Ask one of the project leads to give you access to a mongodb dump
> then you can restore the database with a previous snapshot using `mongorestore`


You can open the mongo cli to inspect the database
```
# run this from the laradock folder
docker exec -it laradock_mongo_1 mongo
```



### run server
```
# from inside the workspace you can run this
php artisan serve --port 8080 --host 0.0.0.0

# you can also use laradock to run apache
docker-compose up -d apache2
```

### other 
```
# to view the logs (while inside the container)
tail /var/www/storage/logs/laravel.log
```

You can set the `APP_DEBUG` environment variable to see error messages in development (or change the `app/config/app.php` to set it to true by default).

Update your /etc/hosts file to contain an entry for `neworleans`
```
...
127.0.0.1       neworleans
...
```

Then you should be able to visit http://neworleans/ and see the site load
