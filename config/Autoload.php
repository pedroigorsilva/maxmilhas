<?php

namespace Config;

class Autoload
{
    public function __construct()
    {
        spl_autoload_register(array($this, 'carregaClasse'));
    }

    /**
     * Carrega o classNamespace
     * @param  String $classNamespace
     */
    private function carregaClasse($classNamespace)
    {
        $arquivo = $this->formataCaminhoClasse($classNamespace);

        if (file_exists($arquivo)) {
            require_once $arquivo;
        }
    }

    private function formataCaminhoClasse($classNamespace)
    {
        $namespaceClasse = lcfirst(str_replace("\\", DIRECTORY_SEPARATOR, $classNamespace));

        return sprintf(
            '%s%s%s',
            WWW_ROOT,
            DIRECTORY_SEPARATOR,
            "{$namespaceClasse}.php"
        );
    }
}
