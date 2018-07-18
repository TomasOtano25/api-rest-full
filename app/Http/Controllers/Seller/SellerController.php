<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Seller;
use App\Repositories\Seller\SellerRepository;

class SellerController extends ApiController
{
    protected $seller;

    public function __construct(SellerRepository $seller)
    {
        parent::__construct();
        
        $this->middleware('client_credentials');
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
