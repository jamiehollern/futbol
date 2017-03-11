<?php

namespace jamiehollern\futbol\Serializer;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

final class LeagueTableSerializer
{

    private $encoders;

    private $normalizers;

    private $serializer;

    public function __construct(
      $encoders = [],
      $normalizers = [],
      SerializerInterface $serializer = null
    ) {
        $this->encoders = $encoders ?? [new JsonEncoder()];
        $this->normalizers = $normalizers ?? [new ObjectNormalizer()];
        $this->serializer = $serializer ?? new Serializer($normalizers,
            $encoders);
    }

    public function serialize($data)
    {
        return $this->serializer->serialize($data, 'json');
    }

    public function output()
    {
        //$this->serializer->
    }

}
