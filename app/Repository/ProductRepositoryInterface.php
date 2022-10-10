<?php

namespace App\Repository;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

interface ProductRepositoryInterface
{
    public function all();
    public function find($id): Product;
    public function store($data): Product;
    public function update($id, $data): bool;
    public function destroy($id);
}