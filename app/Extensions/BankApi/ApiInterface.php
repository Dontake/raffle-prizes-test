<?php

namespace App\Extensions\BankApi;

interface ApiInterface
{
    public function send(string $url, ?array $data);
}
