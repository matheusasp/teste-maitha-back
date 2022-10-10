<?php

namespace App\Providers\Dto;
use Validator;
use Illuminate\Support\Str;

class CreateProductDto extends AbstractDto implements DtoInterface
{
    public $name;

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'name' => 'required'
        ];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    {
      try{
        $this->name  = $data['name'];

        return true;
      } catch(Exception $e){
        return false;
      }

    }
}