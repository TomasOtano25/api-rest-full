<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Repositories\Seller\SellerRepository;
use App\Http\Controllers\ApiController;
use App\Models\Seller;

class SellerController extends ApiController
{
    protected $seller;

    public function __construct(SellerRepository $seller)
    {
        $this->seller = $seller;
    }
    
    public function index()
    {
        $sellers = $this->seller->getAll();

        return response()->json(['data' => $sellers], 200); 
    }

    // public function show($id)
    public function show(Seller $seller)
    {
        // $seller = $this->seller->getSeller($id);
        return $this->showOne($seller);
        // return response()->json(['data' => $seller], 200);
    }

}
