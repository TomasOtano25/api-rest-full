<?php

namespace App\Repositories\Transaction;

use App\Models\Transaction;


class TransactionRepository 
{
    public function getAll() {
        return Transaction::all();
    }
}
