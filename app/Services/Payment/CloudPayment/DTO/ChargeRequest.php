<?php

declare(strict_types=1);

namespace App\Services\Payment\CloudPayment\DTO;

final class ChargeRequest extends DTO
{
    public function __construct(
        public readonly float $amount,
        public readonly string $ipAddress,
        public readonly string $cardCryptogramPacket,
    )
    {
    }
}
