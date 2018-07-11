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

## Mutadores y accesores

Son los estados que se encuentran entre las bases de datos y la salida de la API

Los Mutadores se encargan cuando llega un dato y necesitamos modificar. (Ejemplo: 
Un cambio de formato de una fecha, el analisis de una imagen, etc ...)

Los Accesores

Se encuentran el momento antes de que mostremos un dato extraido de una base de datos.


```sql
    use api-rest-full;
    select name, email from users;
```