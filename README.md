# A simple registration and login forms and a dashboard with clocks

What I was using (prerequisites)
```
npm - 8.3.1
php - 7.4.28
Docker Desktop for Mac
```

## Backend

1. Install composer dependencies

```
composer install
```

2. Run MySQL in Docker

```
docker-compose up -d
``` 
to stop MySQL run
```
docker-compose down
``` 

3. Migrate migrations

```
php artisan migrate
```

4. Run the server

```
php artisan serve
```

## Client

5. Create a new terminal tab

6. Go to `client` directory
```
cd client
```

7. Install dependencies

```
npm install
```

8. Build assets and run dev server

```
npm run build && npm run serve
```
