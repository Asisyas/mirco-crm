<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security;

use Micro\Framework\Kernel\Configuration\PluginConfiguration;
use MicroCRM\Frontend\Security\Configuration\SecurityPluginConfigurationInterface;

class SecurityPluginConfiguration extends PluginConfiguration implements SecurityPluginConfigurationInterface
{
    public function getAuthHeaderName(): string
    {
        return self::HEADER_NAME_DEFAULT;
    }
}
