Hello There

I have created a container to have my dependencies and run and easy to access. Also, a query builder and other classes to easily handle the app.
There are three routes which are defined in the [public/index.php](public%2Findex.php) file.

In order to run this project consider these steps:

- Import the [db_exported.sql](db_exported.sql) file to your db.
- Please use [.env.example](.env.example) to create a new env file and add your specific variables.
- Run `composer install` to generate the autoload files.
- Serve the project using the following command:
```shell 
php -S localhost:80
```

Best Regards, Ali.
