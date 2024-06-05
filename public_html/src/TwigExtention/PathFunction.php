<?php

namespace App\TwigExtention;

use App\Kernel\Kernel;
use Symfony\Component\Yaml\Yaml;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class PathFunction extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('path',[$this,'getPath'])
        ];
    }

    public function getPath(string $routeName): string
    {
        $routes = Yaml::parseFile("php-routing/routes.yaml");

        foreach ($routes as $name => $data) {
            if ($name === $routeName) {
                return $data['path'];
            }
        }
        return $routeName;
    }
}
