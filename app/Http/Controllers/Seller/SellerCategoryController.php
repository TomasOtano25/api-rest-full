<?php

namespace App\Http\Controllers\Seller;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class SellerCategoryController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        
        $this->middleware('scope:read-general')->only('index');

        $this->middleware('can:view,seller')->only('index');

        $this->middleware('client_credentials');
    }

    public function index(Seller $seller)
    {
        $categories = $seller->products()
            ->with('categories')
            ->get()
            ->pluck('categories')
            ->collapse()
            ->unique('id')
            ->values();

        return $this->showAll($categories);

    }
}
