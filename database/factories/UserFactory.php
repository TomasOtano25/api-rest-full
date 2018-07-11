<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'verified' => User::USUARIO_VERIFICADO,
        'veridicattion_token' => (new User)->generateToken(),
        'remember_token' => str_random(10),
        'admin' => User::USUARIO_ADMINISTRADOR
    ];
});

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'quantity' => $faker->randomNumber(),
        'status' => ,
        'image' => $faker->imageUrl(),
        'seller_id' => 
    ];
});
