<?php

declare(strict_types=1);

namespace MicroCRM\Common\Serializer;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use MicroCRM\Common\Serializer\Facade\SerializerFacade;
use MicroCRM\Common\Serializer\Facade\SerializerFacadeInterface;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializerPlugin implements DependencyProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(SerializerFacadeInterface::class, function () {
            return new SerializerFacade(
                $this->createSerializer()
            );
        });
    }

    protected function createSerializer(): Serializer
    {
        return new Serializer(
            iterator_to_array($this->createNormalizers()),
            iterator_to_array($this->createEncoders())
        );
    }

    protected function createNormalizers(): iterable
    {
        yield new ObjectNormalizer();
    }

    protected function createEncoders(): iterable
    {
        yield new JsonEncoder();
        yield new JsonDecode();
    }
}
