<?php

namespace App\Providers\Dto;
use Validator;
use Illuminate\Support\Facades\Hash;

class CreateUserDto extends AbstractDto implements DtoInterface
{
    public $name;
    public $email;
    public $password;

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    {
      try{
        $this->name  = $data['name'];
        $this->email = $data['email'];
        $this->password =  $this->hashPassword($data['password']);
        $this->active = true;

        return true;
      } catch(Exception $e){
        return false;
      }

    }

    protected function hashPassword(string $password): string
    {
        $hashPassword = Hash::make($password);
        return $hashPassword;
    }
}