<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Repositories\Repository\ProductRepository;

class ProductsApiController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }
   
    public function index()
    {
        // $products = Product::latest()->paginate(10);
        return $this->productRepository->paginate(30);
    }

    
    public function store(ProductStoreRequest $request)
    {
        $formData = $request->validated();
        $formData['is_active'] = $request->boolean('is_active');
        return $this->productRepository->storeProduct($formData);        
    }

    
    public function show($id)
    {
        return $this->productRepository->getProductById($id);
    }

    
    public function update(ProductUpdateRequest $request, $id)
    {   
        $formData = $request->validated();
        $formData['is_active'] = $request->boolean('is_active');
        
        return $this->productRepository->updateProduct($id, $formData);
    }

    
    public function destroy($id)
    {
       return $this->productRepository->deleteProduct($id);
    }
}
