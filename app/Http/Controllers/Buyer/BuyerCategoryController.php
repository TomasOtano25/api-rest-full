<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Repositories\Buyer\BuyerRepository;

class BuyerCategoryController extends ApiController
{
    protected $buyer;

    public function __construct(BuyerRepository $buyer) 
    {
        parent::__construct();
        
        $this->middleware('scope:read-general')->only('index');
        // function, recurso(modelo) | instancia de buyer
        $this->middleware('can:view,buyer')->only('index');

        $this->buyer = $buyer;
    }

    public function index(Buyer $buyer)
    {
        $categories = $this->buyer->getBuyerCategories();

        return $this->showAll($categories);
    }
}
