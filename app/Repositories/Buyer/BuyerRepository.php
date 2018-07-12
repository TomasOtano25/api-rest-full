<?php

namespace App\Repositories\Buyer;

use App\Buyer;

class BuyerRepository 
{
    public function getAll() {
       return Buyer::has('transactions')->get();
    }

    // public function getBuyer($id) {
    //     return Buyer::has('transactions')->findOrFail($id);
    // }
}
