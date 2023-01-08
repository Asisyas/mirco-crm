<?php

declare(strict_types=1);

namespace MicroCRM\Common\Serializer\Facade;

use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

interface SerializerFacadeInterface extends
    SerializerInterface,
    DecoderInterface,
    EncoderInterface,
    NormalizerInterface,
    DenormalizerInterface
{
}
