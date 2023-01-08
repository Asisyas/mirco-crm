<?php

namespace MicroCRM\Frontend\React\Facade;

use Micro\Plugin\Twig\TwigFacadeInterface;
use MicroCRM\Frontend\React\ReactPluginConfigurationInterface;

readonly class ReactFacade implements ReactFacadeInterface
{
    /**
     * @param TwigFacadeInterface               $twigFacade
     * @param ReactPluginConfigurationInterface $pluginConfiguration
     */
    public function __construct(
        private TwigFacadeInterface $twigFacade,
        private ReactPluginConfigurationInterface $pluginConfiguration
    ) {
    }

    public function renderReact(): string
    {
        return $this->twigFacade->render(
            $this->pluginConfiguration->getTemplate(),
            ['env' => $this->pluginConfiguration->getEnv()]
        );
    }
}
