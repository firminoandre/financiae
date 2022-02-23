![Logo of the project](https://github.com/firminoandre/financiae/blob/front-end/public/readme/logobanner.png)


## Financiaê
This is a project that aims to create a dashboard for the user to be able to organize their inputs and outputs. 📈

## Links
  - Repository: https://github.com/firminoandre/financiae/tree/back-end

## Technologies 

Here are the technologies used in the front-end of the project

* Laravel API 
* VueJS (branch front-end)
* PHP 8

## Used services

* Github

## Laravel Libs

* Sanctum


## Starting

* Dependency
  - Laravel 

* Migration.
  - php artisan migrate
  
* Project execution.
  - php artisan serve
  
 

## ⚙️ How to use

### OBS: - All routes must have the bearer token, except login and registration

### 1 - Routes for categories

 - Get all category of the logged user

```
 - 📌 http://127.0.0.1:8000/api/categorias/{id}
``` 

 - Get all information of the logged user

```
 - 📌 http://127.0.0.1:8000/api/profile
```

 - Category register

```
 - 📌 http://127.0.0.1:8000/api/categoria
```

 - Delete category 

```
 - 📌 http://127.0.0.1:8000/api/categoriadelete/{id}
```

 - Update category 
 

```
 - 📌 http://localhost:8000/api/categoria/{id}
```

### 2 - Routes for transaction

 - Get all transactions of the logged user

```
 - 📌 http://127.0.0.1:8000/api/transacoes/{id}
```


 - Transaction register

```
 - 📌 http://127.0.0.1:8000/api/transacoes
```


  ## Version

  1.0.0.0
  - The project is still **-NOT-** completed as an MVP (there are basic functions not yet implemented)


  ## Author

  * **Firmino Andre** 

  Please follow me on github and join us!
  Thanks for your visit and good coding!