<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Repository\UserRepository;
use App\Providers\Dto\CreateUserDto;

final class UserService implements UserServiceInterface
{
    protected $repository;


    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function find($id): User
    {
        return $this->repository->find($id);
    }


    public function createOrUpdate(array $user): User
    {
        return $this->repository->store($user);
    }

    public function delete($id)
    {
        return $this->repository->destroy($id);
    }

    public function makeUserDto($data): array {
        $createUserDto = (array) new CreateUserDto($data);
        return $createUserDto;
    }
}