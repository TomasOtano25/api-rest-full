<?php

namespace App\Http\Controllers\Seller;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\User;
use App\Models\Product;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Storage;

class SellerProductController extends ApiController
{
    public function index(Seller $seller)
    {
        $products = $seller->products;

        return $this->showAll($products);
    }

    public function store(Request $request, User $seller)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer|min:1',
            // 'image' => 'required|image'
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['status'] = Product::PRODUCTO_NO_DISPONIBLE;
        // $data['image'] = '1.jpg';
        // ubicacion , sistema de archivos
        // estblece el nombre de la imagen solo
        $data['image'] = $request->image->store('');
        $data['seller_id'] = $seller->id;
        
        $product = Product::create($data);

        return $this->showOne($product, 201);

    }

    // public function show(Seller $seller)
    // {
        
    // }   

    public function update(Request $request, Seller $seller, Product $product)
    {
        $rules = [
            'quantity' => 'integer|min:1',
            'status' => 'in:' . Product::PRODUCTO_DISPONIBLE . ',' . Product::PRODUCTO_NO_DISPONIBLE,
            'image' => 'image'
        ];

        $this->validate($request, $rules);

        $this->verifySeller($seller, $product);

        $product->fill($request->only([
            'name',
            'description',
            'quantity'
        ]));

        if($request->has('status')) {
            $product->status = $request->status;

            if($product->isAvaible() && $product->categories()->count() == 0) {
                return $this->errorResponse('Un producto activo debe de tener al menos una categoria.', 409);
            }
        }
        if($request->hasFile('image')) {
            Storage::delete($product->image);
            $product->image = $request->image->store('');
        }

        if($product->isClean()) {
            return $this->errorResponse('Se debe de especificar por lo menos un valor diferente para actualizar.', 422);
        }

        $product->save();

        return $this->showOne($product);

    }

    public function destroy(Seller $seller, Product $product)
    {
        $this->verifySeller($seller, $product);

        Storage::delete($product->image);

        $product->delete();

        return $this->showOne($product);
    }

    protected function verifySeller(Seller $seller, Product $product) {
        if($seller->id != $product->seller_id) {
            throw new HttpException(422, 'El vendedor especificado no es el vendedor real del producto.');
        }
    }
}
