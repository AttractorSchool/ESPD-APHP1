<?php

declare(strict_types=1);

namespace App\Services\Payment\CloudPayment;

use App\Services\Payment\CloudPayment\DTO\ChargeRequest;
use App\Services\Payment\CloudPayment\DTO\ChargeResponse;
use Illuminate\Support\Facades\Http;

final class CloudPaymentProvider
{
    private const HOST = 'https://api.cloudpayments.ru';
    private const CHARGE_URL = '/payments/cards/charge';

    public function __construct(
        private readonly CloudPaymentCredentials $credentials
    )
    {
    }

    public function pay(Payment $payment): bool
    {

        $curl = curl_init($this->charge());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERPWD, $this->credentials->login.":".$this->credentials->password);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-type: application/json"]);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(new ChargeRequest(
            $payment->amount,
            '127.0.0.1',
            $payment->encodedCardData
        )));

        $httpResponse  = json_decode(curl_exec($curl), true);
        $response = ChargeResponse::fromArray($httpResponse);

//        dd($httpResponse, $response);
        return $response->success;
    }

    private function charge(): string
    {
        return self::HOST . self::CHARGE_URL;
    }
}
