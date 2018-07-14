<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Category;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'identifier' => (int)$category->id,
            'title' => (string)$category->name,
            'details' => (string)$category->description,
            'created_at' => (string)$category->created_at,
            'updated_at' => (string)$category->updated_at,
            'deleted_at' => isset($category->deleted_at) ? (string)$category->deleted_at : null
        ];
    }
}
