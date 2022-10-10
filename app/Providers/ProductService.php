<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Repository\ProductRepository;
use App\Providers\Dto\CreateProductDto;

class ProductService implements ProductServiceInterface
{
    protected $repository;


    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function find($id): Product
    {
        return $this->repository->find($id);
    }

    public function create(array $product): Product
    {
        return $this->repository->store($product);
    }

    public function update(int $id, array $product): bool
    {
        return $this->repository->update($id, $product);
    }

    public function delete($id)
    {
        return $this->repository->destroy($id);
    }

    public function makeProductDto($data): array {
        $createProductDto = (array) new CreateProductDto($data);
        return $createProductDto;
    }

}
