<?php

declare(strict_types=1);

namespace App\Services\Payment\CloudPayment\DTO;

final class ChargeResponse extends DTO
{
    public function __construct(
        public readonly bool $success = false,
        public readonly ?string $message = null,
    )
    {
    }
}
