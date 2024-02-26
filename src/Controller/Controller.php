<?php

namespace App\Controller;

use Twig\Environment;
use \Twig\Loader\FilesystemLoader;

abstract class Controller
{
    private $loader;

    protected $twig;

    public function __construct()
    {
        echo ('Controller construct' . PHP_EOL);
        $this->loader = new FilesystemLoader(ROOT.'/templates');

        $this->twig = new Environment($this->loader);
    }
}