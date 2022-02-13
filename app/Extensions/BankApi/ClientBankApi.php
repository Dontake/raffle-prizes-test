<?php

namespace App\Extensions\BankApi;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class ClientBankApi implements ApiInterface
{
    public function send(string $url, ?array $data): PromiseInterface|Response
    {
        return Http::withToken(config('services.bank_api.token'))
            ->post(config('services.bank_api.url') . $url, $data);
    }
}
