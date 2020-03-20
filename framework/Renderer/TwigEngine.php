<?php

namespace Framework\Renderer;

use Twig\Environment;


class TwigEngine implements RenderEngineInterface
{
    private Environment $environment;

    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @inheritDoc
     */
    public function render($name, array $context = []): string
    {
        return $this->environment->render($name, $context);
    }
}
