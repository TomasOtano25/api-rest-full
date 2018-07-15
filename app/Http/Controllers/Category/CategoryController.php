<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepository;
use App\Http\Controllers\ApiController;
use App\Transformers\CategoryTransformer;

class CategoryController extends ApiController
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->middleware('transform.input:' . CategoryTransformer::class)->only(['store', 'update']);
        $this->category = $category;
    }
    
    public function index()
    {
        $categories = $this->category->getAll();

        return $this->showAll($categories);
    }

    
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required'
        ];

        $this->validate($request, $rules);

        $category = $this->category->create($request);

        return $this->showOne($category, 201);

    }

    public function show(Category $category)
    {
        return $this->showOne($category);
    }

    public function update(Request $request, Category $category)
    {

        $category = $this->category->update($request, $category);
        
        // isDirty Si la instancia cambio
        // isClean Si la instancia no cambio
        if($category->isClean()) {
            return $this->errorResponse('Debe de especificar al menos un valor diferente para actualizar', 422);
        }

        $this->category->save($category);

        return $this->showOne($category);
    }

    public function destroy(Category $category)
    {
        $category = $this->category->delete($category);

        return $this->showOne($category);;
    }
}
