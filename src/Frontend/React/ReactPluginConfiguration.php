<?php

namespace MicroCRM\Frontend\React;

use Micro\Framework\Kernel\Configuration\PluginConfiguration;

class ReactPluginConfiguration extends PluginConfiguration implements ReactPluginConfigurationInterface
{
    const CFG_ENV = 'APP_ENV';
    const CFG_TEMPLATE = 'REACT_PLUGIN_TEMPLATE';

    public function getEnv(): string
    {
        return $this->configuration->get(self::CFG_ENV);
    }

    public function getTemplate(): string
    {
        return $this->configuration->get(self::CFG_TEMPLATE, self::TEMPLATE_DEFAULT);
    }
}
