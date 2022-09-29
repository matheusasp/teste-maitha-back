<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $User)
    {
        $this->model = $User;
    }


    public function all()
    {
        return $this->model->orderBy('name')->get();
    }
    public function find($id): User
    {

    return $this->model->whereId($id)->firstOrFail();

    }

    public function store($data): User
    {
        return $this->model->updateOrCreate($data);
    }

    public function destroy($id): bool
    {
        return $this->model->destroy($id);
    }
}