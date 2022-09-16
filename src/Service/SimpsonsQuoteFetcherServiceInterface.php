<?php

namespace App\Service;

interface SimpsonsQuoteFetcherServiceInterface
{
    public function fetch(int $count): array;
}