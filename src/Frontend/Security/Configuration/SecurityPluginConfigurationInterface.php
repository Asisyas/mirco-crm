<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\Configuration;

interface SecurityPluginConfigurationInterface
{
    const HEADER_NAME_DEFAULT = 'Authorization';

    public function getAuthHeaderName(): string;
}
