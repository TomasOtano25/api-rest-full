<?php

use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Seller;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'verified' => $verified = $faker->randomElement([User::USUARIO_VERIFICADO, User::USUARIO_NO_VERIFICADO]),
        'verification_token' => $verified == User::USUARIO_VERIFICADO ? null : User::generateVerificationToken(),
        'remember_token' => str_random(10),
        'admin' => $faker->randomElement([User::USUARIO_ADMINISTRADOR, User::USUARIO_REGULAR])
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'description' => $faker->paragraph
    ];
});

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'quantity' => $faker->numberBetween(1, 10), // randomNumber(),
        'status' => $faker->randomElement([Product::PRODUCTO_DISPONIBLE, Product::PRODUCTO_NO_DISPONIBLE]),
        'image' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg']),
        'seller_id' => User::all()->random()->id // User::inRandomOrder()->first()->id
    ];
});

$factory->define(Transaction::class, function (Faker $faker) {

    $seller = Seller::has('products')->get()->random();
    $buyer  = User::all()->except($seller->id)->random();

    return [
        'quantity' => $faker->numberBetween(1,3),
        'buyer_id' => $buyer->id,
        'product_id' => $seller->products->random()
    ];
});

