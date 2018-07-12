<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Repositories\Buyer\BuyerRepository;
use App\Http\Controllers\ApiController;
use App\Models\Buyer;

class BuyerController extends ApiController
{
    protected $buyer;
    public function __construct(BuyerRepository $buyer) 
    {
        $this->buyer = $buyer;
    }

    public function index()
    {
        $buyers = $this->buyer->getAll();

        //return response()->json(['data' => $buyers], 200);
        return $this->showAll($buyers, 200);
    }

    //public function show($id)
    public function show(Buyer $buyer)
    {
        //$buyer = $this->buyer->getBuyer($id);
        //return response()->json(['data' => $buyer], 200);
        return $this->showOne($buyer);
    }
}
