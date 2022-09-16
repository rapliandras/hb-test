<?php

namespace App\Service;

use App\Entity\Quote;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class QuoteNormalizerService implements NormalizerInterface
{

    public function normalize(mixed $object, string $format = null, array $context = [])
    {
        return [
            "quote" => $object->getQuote()
        ];
    }

    public function supportsNormalization(mixed $data, string $format = null)
    {
        return $data instanceof Quote;
    }
}