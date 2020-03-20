<?php


namespace Framework\Renderer;


interface RenderEngineInterface
{
    /**
     * @param $name
     * @param array $context
     *
     * @return string
     */
    public function render($name, array $context = []): string;
}
