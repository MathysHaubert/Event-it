<?php

namespace App\Controller;

use App\Kernel\Kernel;
use App\Trait\ApiTrait;
use App\Trait\dd;
use App\TwigExtention\PathFunction;
use App\TwigExtention\Translator;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TemplateWrapper;

abstract class Controller
{
    use dd;

    use ApiTrait;

    protected const INDEX = 'index.html.twig';
    protected const MANAGE = 'manage.html.twig';
    private FilesystemLoader $loader;

    protected Environment $twig;


    protected Translator $translator;

    protected TemplateWrapper $template;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(ROOT.'/templates');

        $this->twig = new Environment($this->loader);

        $this->translator = new Translator($_SESSION['locale'] ?? 'en');

        $this->twig->addExtension($this->translator);
        $this->twig->addExtension(new PathFunction());

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
        if (isset($_SESSION['user'])) {
            $data['user'] = $_SESSION['user'];
        }
        // ajout des données de traduction en plus des données passées
        $data = $this->addDataToArray($data, ['translator' => $this->translator->getInstance()]);

        $this->twig->addGlobal('session', $_SESSION);
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
