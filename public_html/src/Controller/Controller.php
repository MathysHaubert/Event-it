<?php

namespace App\Controller;

use App\Event\KernelEvent;
use App\Kernel\Kernel;
use App\Trait\dd;
use App\TwigExtention\PathFunction;
use App\TwigExtention\Translator;
use Doctrine\Common\EventManager;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TemplateWrapper;


abstract class Controller
{
    use dd;

    protected const INDEX = 'index.html.twig';
    private FilesystemLoader $loader;

    protected Environment $twig;


    protected Translator $translator;

    protected TemplateWrapper $template;

    protected EventManager $eventManager;

    public function __construct()
    {
        $this ->eventManager = new EventManager();
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
    $this->eventManager->dispatchEvent(KernelEvent::PRE_RESPONSE);
    try {
        // ajout des données de traduction en plus des données passées
        $data = $this->addDataToArray($data, ['translator' => $this->translator->getInstance()]);

        $this->eventManager->dispatchEvent(KernelEvent::PRE_RESPONSE);
        // Chargement et affichage du template avec les données
        $this->twig->load($template)->display($data);

        $this->eventManager->dispatchEvent(KernelEvent::POST_RESPONSE);
    } catch (\Twig\Error\LoaderError | \Twig\Error\RuntimeError | \Twig\Error\SyntaxError $e) {

        // Log de l'erreur ou gestion selon le besoin
        Kernel::logger($e->getMessage() . sprintf(' in file %s at line %s', $e->getFile(), $e->getLine()));
    }
    $this->eventManager->dispatchEvent(KernelEvent::POST_RESPONSE);

}

    private function addDataToArray(array $data, array $newData): array
    {
        return array_merge($data, $newData);
    }
}
