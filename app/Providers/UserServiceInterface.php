<?php

namespace App\Providers;

use App\Http\Dto\CreateUserDto;
use App\Models\User;
use Illuminate\Http\Request;

interface UserServiceInterface
{
    public function find($id);

    public function createOrUpdate(array $user): User;

    public function delete($id);


}