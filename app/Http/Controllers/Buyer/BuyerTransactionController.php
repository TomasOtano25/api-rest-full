<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Repositories\Buyer\BuyerRepository;

class BuyerTransactionController extends ApiController
{
    protected $buyer;

    public function __construct(BuyerRepository $buyer)
    {
        $this->middleware('scope:read-general')->only('index');

        $this->middleware('can:view,buyer')->only('index');

        $this->buyer = $buyer;
    }

    public function index(Buyer $buyer)
    {
        $transactions = $this->buyer->getBuyerTransactions($buyer);
        return $this->showAll($transactions);
    }
}
