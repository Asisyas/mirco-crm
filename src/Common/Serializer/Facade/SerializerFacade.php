<?php

declare(strict_types=1);

namespace MicroCRM\Common\Serializer\Facade;

use Symfony\Component\Serializer\Serializer;

readonly class SerializerFacade implements SerializerFacadeInterface
{
    public function __construct(
        private Serializer $serializer
    ) {
    }

    public function serialize(mixed $data, string $format, $context = []): string
    {
        return $this->serializer->serialize($data, $format, $context);
    }

    public function deserialize(mixed $data, string $type, string $format, array $context = []): mixed
    {
        return $this->serializer->deserialize($data, $type, $format, $context);
    }

    public function decode(string $data, string $format, array $context = []): array
    {
        return $this->serializer->decode($data, $format, $context);
    }

    public function supportsDecoding(string $format): bool
    {
        return $this->serializer->supportsDecoding($format);
    }

    public function encode(mixed $data, string $format, array $context = []): string
    {
        return $this->serializer->encode($data, $format, $context);
    }

    public function supportsEncoding(string $format): bool
    {
        return $this->serializer->supportsEncoding($format);
    }

    public function normalize(mixed $object, string $format = null, array $context = []): array
    {
        return $this->serializer->normalize($object, $format, $context);
    }

    public function supportsNormalization(mixed $data, string $format = null)
    {
        $this->serializer->supportsNormalization($data, $format);
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
    {
        return $this->serializer->denormalize($data, $type, $format, $context);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null)
    {
        $this->serializer->supportsDenormalization($data, $type, $format);
    }
}
