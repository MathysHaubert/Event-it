<?php

namespace App\Controller;

use Twig\Environment;
use \Twig\Loader\FilesystemLoader;

abstract class Controller
{
    protected const INDEX = 'index.html.twig';
    private $loader;

    protected $twig;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(ROOT.'/templates');

        $this->twig = new Environment($this->loader);
    }

    public function __toString(): string
    {
        return self::class;
    }
}