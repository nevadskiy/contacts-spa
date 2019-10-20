# Contacts SPA

## Installation

Clone the repository
```
git https://github.com/nevadskiy/contacts-spa.git
cd contacts-spa
```

Build and up containers 
```
# Classic way
docker-compose up -d --build

# Make command
make build
```


Install the dependencies 
```
# Classic way
docker-compose exec php-cli composer install
docker-compose exec node yarn

# Make command
make dependencies
```


Create the config and the app key
```
# Classic way
cp ./.env.example ./.env
docker-compose exec php-cli php artisan key:generate

# Make command
make config
make key
```


Set up laravel permissions
```
# Classic way
sudo chmod -R 777 api/bootstrap/cache
sudo chmod -R 777 api/storage

# Make command
make permissions
```


Run the database migrations
```
# Classic way
docker-compose exec php-cli php artisan migrate

# Make command
make migrate
```

Build assets
```
# Classic way
docker-compose exec node yarn dev

# Make command
make assets
```

Open http://localhost:8080 in your browser.
