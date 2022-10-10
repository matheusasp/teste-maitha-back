<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Repository\UserRepository;
use App\Providers\Dto\CreateUserDto;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Validation\ValidationException;

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

    public function findByEmail($email): User
    {
        return $this->repository->findByEmail($email);
    }

    public function create(array $user): User
    {
        return $this->repository->store($user);
    }

    public function update(int $id, array $user): bool
    {
        return $this->repository->update($id, $user);
    }

    public function delete($id)
    {
        return $this->repository->destroy($id);
    }

    public function makeUserDto($data): array {
        $data['password'] = $this->hashPassword($data['password']);
        $createUserDto = (array) new CreateUserDto($data);
        return $createUserDto;
    }

    public function findByToken(array $tokenData) {
        $getToken = $this->repository->findByToken($tokenData);
        if($getToken){
            return  $getToken->getAttributes()['token'];
        } else {
            return false;
        }   
     }

     public function hashPassword(string $password): string
     {
         $hashPassword = Hash::make($password);
         return $hashPassword;
     }
}