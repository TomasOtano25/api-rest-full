<?php 

namespace App\Repositories\Seller;

use App\Seller;


class SellerRepository
{
    public function getAll() {
        return Seller::has('products')->get();
    }

    // public function getSeller($id) {
    //     return Seller::has('products')->findOrFail($id);
    // }
}
