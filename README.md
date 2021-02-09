## Installation

You are free to install this repository however you want, but if you use docker I have created a local deployment environment

- Run the following command to create the network where the containers will be connected
```
docker network create app
```

- Now you can start the containers using docker-compose
```
docker-compose up -d
```

- To finish running the installation commands, you can connect to the docker container with the following command:
```
docker exec -it test_app bash
```

- Install packages
```
composer install
```

- If you do not have permissions on the `storage` folder you can assign them to work correctly
```
chmod -R 777 storage/
```

- Now you can copy the environment variables and generate the key
```
cp .env.example .env
php artisan key:generate
```

- As a last step you must execute the migrations
```
php artisan migrate
```

- And now if you want you can run the tests
```
php artisan test
```

- If you want to feed the posts you are able to execute the next command to import some posts the times that you want
```
php artisan import:posts
```

- To exit the docker container you can run:
```
exit
```

-I have configured in the file `.env.example` automatically connecting to the database to work with the docker container, so when you run `cp .env.example .env` no configuration is necessary. But you are free to do so.

- The following environment variables are additional settings for the operation of the application. I recommend that you change the variable: `MINUTES_TO_IMPORT_POSTS` to 1 minute so that you can check the operation of the crontab, since currently the default value is: `60`

```
# Number of posts to be displayed on each page
POSTS_PER_PAGE=25

# Url to import posts automatically
URL_IMPORT_POSTS=https://sq1-api-test.herokuapp.com/posts

# Time period in which the crontab will be executed to import the posts
MINUTES_TO_IMPORT_POSTS=60
```

The application will be exposed at the port: `91` so you can access to: `http://localhost:91/` on your browser

## Requirements
- MySQL Version: 8.0
- PHP ^7.3