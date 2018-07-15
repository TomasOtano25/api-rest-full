<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Repositories\Buyer\BuyerRepository;

class BuyerSellerController extends ApiController
{
    protected $buyer;

    public function __construct(BuyerRepository $buyer)
    {
        $this->buyer = $buyer;
    }

    public function index(Buyer $buyer)
    {
        $sellers = $this->buyer->getBuyerSellers($buyer);
            
        return $this->showAll($sellers);
    }
}
