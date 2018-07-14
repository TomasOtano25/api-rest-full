<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Product;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'identifier' => (int)$product->id,
            'title' => (string)$product->name,
            'details' => (string)$product->description,
            'available' => (int)$product->quantity,
            'status' =>  (string)$product->status,
            'image' => url("img/".$product->image),
            'seller' => (int)$product->seller_id, 
            'created_at' => (string)$product->created_at,
            'updated_at' => (string)$product->updated_at,
            'deleted_at' => isset($product->deleted_at) ? (string)$product->deleted_at : null
        ];
    }
}