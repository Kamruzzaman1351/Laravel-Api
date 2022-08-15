<?php
namespace App\Repositories\Repository;


  use App\Models\Product;
  use App\Repositories\Interfaces\ProductInterface;
  use App\Http\Resources\ProductResource;
  use App\Http\Resources\ProductResourceCollection;

  class ProductRepository implements ProductInterface 
  {
    
    protected Product $product;

    public function __construct(Product $product) {
      $this->product = $product;
    }
    
    public function getAllProduct() {
      return new ProductResourceCollection($this->product::latest()->get());
    }


    public function paginate($page = 15) {
      return new ProductResourceCollection($this->product->latest()->paginate($page));
    }


    public function getProductById($id) {
      return new ProductResource($this->product::findOrFail($id));
    }


    public function storeProduct($product) {
      return response()->json([
        'status' => 'success',
        'message' => 'Product created successfully',
        'data' => new ProductResource($this->product::create($product)),
      ]);      
    }

    public function deleteProduct($id) {
      $product = $this->product::where('id', $id)->first();
      abort_if(!$product, 404);
      $product->delete();
      return response()->json([
          'status' => 'success',
          'message' => 'Product deleted successfully',
          'data' => new ProductResource($product),
      ]);
    }

    public function updateProduct($productId, $newProductInfo)
    {
      $product = $this->product::where('id', $productId)->first();
      abort_if(!$product, 404);
      $product->forceFill($newProductInfo);
      if(!$product->isDirty()) {
        return response()->json([
          'status' => 'Fail',
          'message' => 'You did not change the product'
        ]);
      }
      $product->save();
      return response()->json([
        'status' => 'success',
          'message' => 'Product updated successfully',
          'data' => new ProductResource($product),
      ]);
    }
  }