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
        $this->middleware('scope:read-general')->only('show');

        $this->middleware('can:view,transaction')->only('show');
        
        $this->transaction = $transaction;
    }

    public function index()
    {
        $this->allowedAdminAction();

        $transactions = $this->transaction->getAll();

        return $this->showAll($transactions);
    }

    public function show(Transaction $transaction)
    {
        return $this->showOne($transaction);
    }

}
