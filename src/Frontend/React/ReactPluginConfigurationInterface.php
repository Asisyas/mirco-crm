<?php

declare(strict_types=1);

namespace MicroCRM\Frontend\React;

interface ReactPluginConfigurationInterface
{
    const TEMPLATE_DEFAULT = '@ReactPlugin/index.html.twig';

    public function getEnv(): string;

    public function getTemplate(): string;
}
