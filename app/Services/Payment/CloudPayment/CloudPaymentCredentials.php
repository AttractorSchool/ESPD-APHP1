<?php

declare(strict_types=1);

namespace App\Services\Payment\CloudPayment;

final class CloudPaymentCredentials
{
    public function __construct(
        public readonly string $login,
        public readonly string $password
    )
    {
    }
}

