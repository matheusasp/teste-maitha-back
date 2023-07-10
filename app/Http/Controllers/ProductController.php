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

    public function getProduct(Request $request): Product {

        try{
            return $this->productService->find($request->route('id'));
        }
        catch(Exception $e){
            return $e;
        }
    }

    public function getAllProduct() {
        try{
            return $this->productService->all();
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
            $this->productService->update($request->route('idProduct'), $request->all());
            return response()->json([
                'Atualizado!'
            ]);
        } catch(Exception $e) {
            return $e;
        }

     }

    public function deleteProduct(Request $request) {

       $this->productService->delete($request->route('idProduct'));

        return response()->json([
            'id' => $request->route('idProduct')
        ]);
    }
}
