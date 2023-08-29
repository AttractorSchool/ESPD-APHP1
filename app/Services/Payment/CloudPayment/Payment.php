<?php

declare(strict_types=1);

namespace App\Services\Payment\CloudPayment;

final class Payment
{
    public function __construct(
        public readonly float $amount,
        public readonly string $encodedCardData
    )
    {
    }
}
