<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Repositories\Transaction\TransactionRepository;
use App\Models\Transaction;

class TransactionController extends ApiController
{
    protected $transaction;

    public function __construct(TransactionRepository $transaction)
    {  
        parent::__construct();
        // $this->middleware('auth:api')->only(['index', 'show']);
        $this->transaction = $transaction;
    }

    public function index()
    {
        $transactions = $this->transaction->getAll();

        return $this->showAll($transactions);
    }

    public function show(Transaction $transaction)
    {
        return $this->showOne($transaction);
    }

}
