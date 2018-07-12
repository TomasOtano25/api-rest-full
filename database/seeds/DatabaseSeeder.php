<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Transaction;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // EL fin de esta linea es que no se verifiquen las claves foreign
        User::truncate(); // Eliminar los elementos de las tablas
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        $quantityUsers = 1000;
        $quantityCategories = 30;
        $quantityProducts = 1000;
        $quantityTransactions =  1000;

        factory(User::class, $quantityUsers)->create();
        factory(Category::class, $quantityCategories)->create();

        factory(Product::class, $quantityProducts)->create()->each(
            function ($product) {
                $categories = Category::all()->random(mt_rand(1, 5))->pluck('id');
                $product->categories()->attach($categories);
            }
        );  

        factory(Transaction::class, $quantityTransactions)->create();   


    }
}
