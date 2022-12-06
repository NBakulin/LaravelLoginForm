# A simple registration and login form with Laravel, MySQL and Vue
## Backend

### Install composer dependencies

```
composer install
```

### Install composer dependencies

```
copy `.env.example` to the same folder and name it `.env`
```

### Running the MySQL in Docker

```
docker-compose up -d
``` 

### Stopping the MySQL in Docker
```
docker-compose down
``` 

### Migrate migrations

```
php artisan migrate
```

### Run the server

```
php artisan serve
```

## Client

### Project setup (inside `client` folder)
```
npm install
```

### Compiles and hot-reloads for development
```
npm run serve
```

### Compiles and minifies for production
```
npm run build
```

### Lints and fixes files
```
npm run lint
```

### Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).
