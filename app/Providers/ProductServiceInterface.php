<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Http\Request;

interface ProductServiceInterface
{
    public function find($id);

    public function create(array $product): Product;

    public function update(int $id, array $product): bool;

    public function delete($id);


}