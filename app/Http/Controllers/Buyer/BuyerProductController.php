<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Repositories\Buyer\BuyerRepository;

class BuyerProductController extends ApiController
{
    protected $buyer;

    public function __construct(BuyerRepository $buyer)
    {
        parent::__construct();
        
        $this->middleware('scope:read-general')->only('index');
        $this->buyer = $buyer;
    }

    public function index(Buyer $buyer)
    {
        //$products = $buyer->transactions()->with('product')->get();
        $products = $this->buyer->getBuyerProducts($buyer);

        return $this->showAll($products);
    }
}
