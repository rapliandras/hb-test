<?php

namespace App\Service;

class SimpsonsQuoteFetcherService implements SimpsonsQuoteFetcherServiceInterface
{
    public function fetch(int $count): array
    {
        $rawJson = file_get_contents($_ENV['SIMPSONS_API_DOMAIN'] . '/quotes?count=' . $count);
        return json_decode($rawJson, true);
    }
}