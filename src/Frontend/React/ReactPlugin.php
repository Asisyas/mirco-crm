<?php
declare(strict_types=1);

namespace MicroCRM\Frontend\React;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\ConfigurableInterface;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginConfigurationTrait;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
use Micro\Plugin\Twig\Plugin\TwigTemplatePluginInterface;
use Micro\Plugin\Twig\TwigFacadeInterface;
use MicroCRM\Common\Twig\TwigTemplatePluginTrait;
use MicroCRM\Frontend\React\Facade\ReactFacade;
use MicroCRM\Frontend\React\Facade\ReactFacadeInterface;
use OleksiiBulba\WebpackEncorePlugin\WebpackEncorePlugin;

/**
 * @method ReactPluginConfiguration configuration()
 */
class ReactPlugin implements
    DependencyProviderInterface,
    ConfigurableInterface,
    TwigTemplatePluginInterface,
    PluginDependedInterface
{
    use PluginConfigurationTrait;
    use TwigTemplatePluginTrait;

    /**
     * {@inheritdoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(ReactFacadeInterface::class, function (
            TwigFacadeInterface $twigFacade
        ) {
            return $this->createFacade($twigFacade);
        });
    }

    protected function createFacade(TwigFacadeInterface $twigFacade): ReactFacadeInterface
    {
        return new ReactFacade($twigFacade, $this->configuration());
    }

    public function getDependedPlugins(): iterable
    {
        yield WebpackEncorePlugin::class;
    }
}
