<?php

namespace App\Providers;

use App\Http\Dto\CreateUserDto;
use App\Models\User;
use Illuminate\Http\Request;

interface UserServiceInterface
{
    public function find($id);

    public function create(array $user): User;

    public function update(int $id, array $user): bool;

    public function delete($id);


}