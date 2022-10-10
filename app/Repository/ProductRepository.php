<?php

namespace App\Repository;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;


class ProductRepository extends AbstractRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $Product)
    {
        $this->model = $Product;
    }


    public function all()
    {
        return $this->model->orderBy('name')->get();
    }
    public function find($id): Product
    {

    return $this->model->whereId($id)->firstOrFail();

    }

    public function store($data): Product
    {
        return $this->model->create($data);
    }

    public function update($id, $data): bool
    {
        $this->model = $this->find($id);
        return $this->model->update($data);
    }

    public function destroy($id): bool
    {
        return $this->model->destroy($id);
    }
}