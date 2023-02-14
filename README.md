# ddev Commands
After cloning the repository copy .env.example and rename this copy to .env
To start the docker containers use:
```
ddev start
```
After starting you should run 
```
ddev composer install
```
To get a detailed description of a running ddev project use:
```
ddev describe
```
# Composer Commands
To analyse use:
```
ddev composer analyse
```

# Laravel Commands
To seed data use:
```
ddev php artisan seed
```

To test the database connection and get database name use:
```
ddev php artisan system:test-db-connection
```
