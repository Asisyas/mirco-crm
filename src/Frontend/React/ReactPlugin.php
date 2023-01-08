<?php
declare(strict_types=1);

namespace MicroCRM\Frontend\React;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\ConfigurableInterface;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginConfigurationTrait;
use Micro\Plugin\Twig\Plugin\TwigTemplatePluginInterface;
use Micro\Plugin\Twig\TwigFacadeInterface;
use MicroCRM\Common\Twig\TwigTemplatePluginTrait;
use MicroCRM\Frontend\React\Facade\ReactFacade;
use MicroCRM\Frontend\React\Facade\ReactFacadeInterface;

/**
 * @method ReactPluginConfiguration configuration()
 */
class ReactPlugin implements DependencyProviderInterface, ConfigurableInterface, TwigTemplatePluginInterface
{
    use PluginConfigurationTrait;
    use TwigTemplatePluginTrait;

    private readonly TwigFacadeInterface $twigFacade;

    /**
     * {@inheritdoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(ReactFacadeInterface::class, function (
            TwigFacadeInterface $twigFacade
        ) {
            $this->twigFacade = $twigFacade;

            return $this->createFacade();
        });
    }

    protected function createFacade(): ReactFacadeInterface
    {
        return new ReactFacade($this->twigFacade, $this->configuration());
    }
}
