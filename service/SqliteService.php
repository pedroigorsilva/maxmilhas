<?php
namespace Service;

use Config\Sqlite;

class SqliteService
{
    public static function executaOperacao($sql, $parametros = array())
    {
        $stmt = self::executa($sql, $parametros);

        $stmt->rowCount();
    }

    public static function executaSql($sql, $parametros = array())
    {
        $stmt = self::executa($sql, $parametros);

        return $stmt->fetchAll();
    }

    public static function executa($sql, $parametros = array())
    {
        $db = new Sqlite();
        $stmt = $db->prepare($sql);

        if (!$stmt) {
            throw new \Exception($db->errorinfo());
        }

        if (!empty($parametros)) {
            $stmt->execute($parametros);
        } else {
            $stmt->execute();
        }

        return $stmt;
    }
}
