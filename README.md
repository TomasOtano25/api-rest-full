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