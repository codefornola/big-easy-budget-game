First `cd app`

### install dependencies 
```
docker-compose run --rm app composer install
```

### generate new app key 
```
docker-compose run --rm app php artisan key:generate
```

### setup database
First start the mongodb server with `docker-compose up mongo`

Then you can run migrations to setup the database schema
```
docker-compose run --rm app php artisan migrate
```

#### optional
> If you are setting up the production site, ask one of the project leads to give you access to a mongodb dump
> so you can restore the database with a previous snapshot using `mongorestore`

```
docker-compose exec mongo mongorestore --username=budgetgame --password=budgetgamepass /tmp/neworleans/
```


### Start the app
```
docker-compose up -d
```

Update your /etc/hosts file to contain an entry for `neworleans`
```
...
127.0.0.1       neworleans
...
```

Then you should be able to visit http://neworleans:8000/ and see the site load


### useful commands for development 
```
# to tail the app logs
docker-compose exec  app tail -f /var/www/storage/logs/laravel.log

# open a mongodb console
docker-compose exec mongo mongo -u budgetgame -p budgetgamepass budgetgame_dev
```

Useful mongo commands to run in the console:
```
show dbs;
use peoplesbudget_develop;
show collections;
db.users.find({"email": {$regex: /^myemail/}});
db.users.updateOne({"email": "myemail+test1@gmail.com"}, {$set: {roles: ["user", "admin"] }})
```

You can set the `APP_DEBUG` environment variable to see error messages in development (or change the `app/config/app.php` to set it to true by default).
