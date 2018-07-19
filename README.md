## Preparacion del entorno

php artisan make:model Seller -mc

### Comando que me permite leer las urls de mi api
php artisan route:list

php artisan make:migration create_category_product_table --create=category_product

> Cada modelo es un recurso

## Estructura del proyecto 

- User
- Seller (Vendedor)
- Buyer (Comprador) 
- Product
- Transaction
- Category

## Creacion del archivo DatabaseSeeder

> El fin de este archivo es insertar datos en mis tablas de forma aleatoria para la realizacion de pruebas

php artisan db:seed

php artisan migrate:refresh --seed


## Tipos de respuestas

- 200 Mostrar
- 404 Error en la busqueda
- 201 Creado 
- 409 Error al actualizar
- 422 No hubo cambios en el intento de actualizacion
- 409 Conflicto
- 500 Error interno del servidor

## Mutadores y accesores

Son los estados que se encuentran entre las bases de datos y la salida de la API

Los Mutadores se encargan cuando llega un dato y necesitamos modificar. (Ejemplo: 
Un cambio de formato de una fecha, el analisis de una imagen, etc ...)

Los Accesores

Se encuentran el momento antes de que mostremos un dato extraido de una base de datos.


```sql
    use api-rest-full;
    select name, email from users;

    describe nombreTable;
```

## Establer un controllador padre que maneje los demas controller

> El nombre de este controlador es `ApiController` y se encarga de establecer una capaca de abstraccion en la que 
establezco la diferencie entre los controlladores de la Api y los controladores genericos

## Uso de global Scope


## Utilizacion de soft deleting (eliminacion suave)

> Nos permite ocultar elementos de la tabla en lugar de eliminarlos correctamentes 

## Creacion de controller con recursos e inyeccion de modelos

 php artisan make:controller Category/CategoryController -r -m Models/Category


 ## Obtener las categorias de una transaccion especifica
 ## Operaciones complejas

 php artisan make:controller Transaction/TransactionCategoryController -r -m Models/Transaction


 ## Manejo de email

 - Install

 ```
 - mailgun
 - sparkpost
 ```

 > composer require guzzlehttp/guzzle

 ## Mailable

 php artisan make:mail UserCreated

 Establecer eventos

 ## Middleware

 Se encarga de la authentication

 - php artisan make:middleware SignatureMiddlware

 X-RateLimit-Limit →60 (cantidad de peticiones en un minuto)
 X-RateLimit-Remaining →59 (cuantas peticiones me quedan en un minuto)

 Formato Unit

 ## Transformaciones

 `composer require spatie/laraver-fractal`

 php artisan make:transformer

 ## Ordenando la informacion 

 - Parametro `sort_by`

 ## Establecer cache


## Creaccion del middleware TransformInput

php artisan make:middleware TransfomrInput

## Añadiendo authenticacion

php artisan make:auth

## OAuth2

composer require laravel/passport
install provider
php artisan migrate --seed
php artisan passport:install

php artisan route:list

> Agregando las client_credentials: se encargara de todos los usuarios de la aplicacion tengan acceso a la informacion

php artisan passport:client

Crear cliente (obligatorio)

php artisan passport:client --Password


php artisan vendor:publish --tag=passport-components

npm install

php artisan passport:client --personal

http://homestead.test/oauth/authorize?client_id=3&redirect_url=http://homestead.test&response_type=code

** https://meyerweb.com/eric/tools/dencoder/ **


http://homestead.test/oauth/authorize?client_id=3&redirect_uri=http://localhost/auth/callback&response_type=token


## Realizacion de los scope

El `*` lo puedo utilizar en las llamas scope para solicitar todos los scope (permisos).

## Policies y Gates (Ultima capa de seguridad) (se encarga de los usuarios)

authentication laravel

php artisan make:policy SellerPolicy --model=Models/Seller