# Contacts SPA

## Installation

**Clone the repository**
```
git https://github.com/nevadskiy/contacts-spa.git
cd contacts-spa
```

**Run the installation script**
```
make install
```

**Open http://localhost:8080 in your browser.**

### Manual installation
If you do not have the make utility available or you just want to install the project manually, you can go through the installation process running the following commands:

Build and up containers 
```
docker-compose up -d --build
```

Install the dependencies 
```
docker-compose exec php-cli composer install
docker-compose exec node yarn
```

Create the config and the app key
```
cp ./.env.example ./.env
docker-compose exec php-cli php artisan key:generate
```

Set up laravel permissions
```
sudo chmod -R 777 bootstrap/cache
sudo chmod -R 777 storage
```

Run the database migrations
```
docker-compose exec php-cli php artisan migrate
```

Build assets
```
docker-compose exec node yarn dev
```
