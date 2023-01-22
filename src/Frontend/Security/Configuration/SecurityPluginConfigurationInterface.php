<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\Security\Configuration;

interface SecurityPluginConfigurationInterface
{
    const HEADER_NAME_DEFAULT = 'Authorization';

    const COOKIE_NAME_DEFAULT = 'token';

    public function getAuthHeaderName(): string;

    public function getAuthCookieName(): string;
}
