docker-compose run --rm app composer install
docker-compose run --rm app php artisan key:generate


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
First start the mongodb server with `docker-compose up mongo`

Then you can run migrations to setup the database schema
```
docker-compose run --rm app php artisan migrate
```

> Ask one of the project leads to give you access to a mongodb dump
> then you can restore the database with a previous snapshot using `mongorestore`

```
docker-compose exec mongo mongorestore --username=budgetgame --password=budgetgamepass /tmp/neworleans/
```


### other 
```
# to view the app logs
docker-compose exec  app tail -f /var/www/storage/logs/laravel.log
```

You can set the `APP_DEBUG` environment variable to see error messages in development (or change the `app/config/app.php` to set it to true by default).

Update your /etc/hosts file to contain an entry for `neworleans`
```
...
127.0.0.1       neworleans
...
```

Then you should be able to visit http://neworleans:8000/ and see the site load
