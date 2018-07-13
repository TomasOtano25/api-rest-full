<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

class ProductBuyerTransactionController extends ApiController
{
    public function store(Request $request, Product $product, User $buyer) 
    {
        $rules = [
            'quantity' => 'required|integer|min:1'
        ];

        $this->validate($request, $rules);

        if($buyer->id == $product->seller_id) {
            return $this->errorResponse('El comprador debe ser diferente al vendedor.', 409);
        }

        if(!$buyer->isVerified()) {
            return $this->errorResponse('El comprador debe ser un usuario verificado.', 409);  
        }

        if(!$product->seller->isVerified()) {
            return $this->errorResponse('El vendedor debe ser un usuario verificado.', 409);
        }

        if(!$product->isAvaible()) {
            return $this->errorResponse('El producto para esta transaccion no esta disponible', 409); 
        }

        if($product->quantity < $request->quantity) {
            return $this->errorResponse('El producto no tiene la cantidad disponible para esta transaccion.', 409);
        }

        // Asegura que las operaciones se realizen
        // Devuelve los cambios en caso de la presencia de errores
        // Es para asegurar que las transaccion se realizen con seguridad
        return DB::transaction(function () use($request, $product, $buyer) {
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id
            ]);

        return $this->showOne($transaction, 201);
        });

    }
}
