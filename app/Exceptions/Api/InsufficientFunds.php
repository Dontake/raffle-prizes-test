<?php

namespace App\Exceptions\Api;

class InsufficientFunds extends BaseException
{
    public function __construct(?string $message = null)
    {
        parent::__construct(
            __($message ?? 'Insufficient funds'),
            400
        );
    }
}
