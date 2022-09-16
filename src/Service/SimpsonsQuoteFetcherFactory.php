<?php

namespace App\Service;

class SimpsonsQuoteFetcherFactory
{
    public function create(string $type)
    {
        return match ($type) {
            'real' => new SimpsonsQuoteFetcherService(),
            'fake' => new FakeSimpsonsQuoteFetcherService()
        };
    }
}