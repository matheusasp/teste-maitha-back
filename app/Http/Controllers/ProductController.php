<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\ProductService;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct(productService $productService){
        $this->productService =  $productService;
    }

    public function getProduct(int $id): Product {
        try{
            return $this->productService->find($id);
        }
        catch(Exception $e){
            return $e;
        }
    }

    public function insertProduct(Request $request): Product {
       $productDto = $this->productService->makeProductDto($request->all());
       return $this->productService->create($productDto);
    }

    public function updateProduct(Request $request) {
        try {
            $this->productService->update($request->id, $request->all());
            return response()->json([
                'Atualizado!'
            ]);
        } catch(Exception $e) {
            return $e;
        }

     }

    public function deleteProduct(int $id) {

       $this->productService->delete($id);

        return response()->json([
            'id' => $id
        ]);
    }
}
