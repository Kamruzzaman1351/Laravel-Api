<?php
  namespace App\Repositories\Interfaces;

  interface ProductInterface 
  {
    public function getAllProduct();
    public function paginate($page);
    public function getProductById($id);
    public function storeProduct($product);
    public function updateProduct($productId, $newProductInfo);
    public function deleteProduct($id);
  }