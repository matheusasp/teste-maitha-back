<?php

namespace App\Providers\Dto;

use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
abstract class AbstractDto
{
    /**
     * AbstractRequestDto constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $validator = Validator::make(
            $data,
            $this->configureValidatorRules()
        );

        if (!$validator->validate()) {
            throw new InvalidArgumentException(
                'Error: ' . $validator->errors()->first()
            );
        }

        if (!$this->map($data)) {
            throw new InvalidArgumentException('The mapping failed');
        }
    }

    /* @return array */
    abstract protected function configureValidatorRules(): array;

    /**
     * @param array $data
     * @return bool
     */
    abstract protected function map(array $data): bool;
}