<?php

namespace App\Controller;

use Twig\Environment;
use \Twig\Loader\FilesystemLoader;
use Twig\TemplateWrapper;
use App\Kernel\Kernel;

abstract class Controller
{
    protected const INDEX = 'index.html.twig';
    private $loader;

    protected $twig;

    protected TemplateWrapper $template;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(ROOT.'/templates');

        $this->twig = new Environment($this->loader);
    }

    public function __toString(): string
    {
        return self::class;
    }

    public function webRender(string $template, array $data = []): void
{
    try {       
        // Chargement et affichage du template avec les données
        $this->twig->load($template)->display($data);
    } catch (\Twig\Error\LoaderError | \Twig\Error\RuntimeError | \Twig\Error\SyntaxError $e) {
        // Log de l'erreur ou gestion selon le besoin
        Kernel::logger($e->getMessage());
    }
}

}