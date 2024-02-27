<?php

namespace App\Controller;

use Twig\Environment;
use \Twig\Loader\FilesystemLoader;
use Twig\TemplateWrapper;
use App\Kernel\Kernel;
use App\TwigExtention\Translator;

abstract class Controller
{
    protected const INDEX = 'index.html.twig';
    private $loader;

    protected $twig;


    protected Translator $translator;

    protected TemplateWrapper $template;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(ROOT.'/templates');

        $this->twig = new Environment($this->loader);

        $this->twig->addExtension(new Translator('en'));

        $this->translator = new Translator('en');
    }

    public function __toString(): string
    {
        return self::class;
    }

    /**
     * Render a template file
     * 
     * @param string $template path of the template file
     * @param array $data data to be passed to the template
     */
    public function webRender(string $template, array $data = []): void
{
    try {
        // ajout des données de traduction en plus des données passées
        $data = $this->addDataToArray($data, ['translator' => $this->translator->getInstance()]);

        // Chargement et affichage du template avec les données
        $this->twig->load($template)->display($data);
    } catch (\Twig\Error\LoaderError | \Twig\Error\RuntimeError | \Twig\Error\SyntaxError $e) {

        // Log de l'erreur ou gestion selon le besoin
        Kernel::logger($e->getMessage() . sprintf(' in file %s at line %s', $e->getFile(), $e->getLine()));
    }
}

    private function addDataToArray(array $data, array $newData): array
    {
        return array_merge($data, $newData);
    }
}