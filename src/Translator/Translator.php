<?php

declare(strict_types=1);

namespace App\Translator;

use Symfony\Component\Yaml\Yaml;
use App\Kernel\Kernel;

class Translator
{
    private string $locale;

    private CONST TRANSLATION_FILE = 'translations/translation.%s.yaml';

    public function __construct(string $locale)
    {
        $this->locale = $locale;
    }

    //create a function who will read in the translations/translation.$locale.yaml
    public function translate(string $key): string
    {
        try {
        $translations = Yaml::parseFile(sprintf(self::TRANSLATION_FILE,$this->locale));
        } catch (\Exception $e) {
            Kernel::logger($e->getMessage() . sprintf(' in file %s at line %s', $e->getFile(), $e->getLine()));
        } finally {
            return $this->foundTranslate($key, $translations);;
        }
    }

    public function foundTranslate(string $key, array $translations): string
    {
        $parts = explode('.', $key);

        $value = $translations;
        foreach ($parts as $part) {
            if (isset($value[$part])) {
                $value = $value[$part];
            } else {
                $value = null;
                break;
            }
        }
        return $value;
    }

    public function getInstance(): Translator
    {
        return $this;
    }
}