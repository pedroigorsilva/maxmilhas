<?php

namespace Entity;

use Service\SqliteService;
use Helpers\FiltroString;

abstract class EntidadeBase
{
    private $tabela;

    public function __construct()
    {
        $this->tabela = $this->getTabela();
    }

    public function save()
    {
        $inserts = array();
        $attributos = get_object_vars($this);

        foreach ($attributos as $attributo => $valor) {
            $metodo = 'set'.ucfirst($attributo);
            if (method_exists($this, $metodo)) {
                $inserts[$attributo] = $valor;
            }
        }
        return $this->insert($inserts);
    }

    private function insert($inserts)
    {
        $sql = $this->formataSqlInsert($inserts);
        return SqliteService::executaOperacao($sql, $this->formataParametros($inserts));
    }

    private function formataSqlInsert($inserts)
    {
        $sql = "INSERT INTO {$this->tabela} (%s) VALUES (%s)";
        $campos = null;
        $camposStatament = null;

        foreach ($inserts as $campo => $valor) {
            $campoQueryString = ':'.$campo;
            $camposStatament .= (is_null($campos))? $campoQueryString : ','.$campoQueryString;
            $campos .= (is_null($campos))? $campo : ','.$campo;
        }
        $sql = sprintf($sql, $campos, $camposStatament);

        return $sql;
    }

    private function formataParametros($inserts)
    {
        $valores = array();

        foreach ($inserts as $campo => $valor) {
            $campoQueryString = ':'.$campo;
            $valores[$campoQueryString] = $valor;
        }

        return $valores;
    }

    private function getTabela()
    {
        $class = explode('\\', get_class($this));
        return FiltroString::lower($class[1]);
    }
}
