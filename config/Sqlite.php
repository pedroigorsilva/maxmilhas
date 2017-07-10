<?php

namespace Config;

class Sqlite extends \PDO
{
    private $db;

    public function __construct($filename = 'database.db')
    {
        try {
            $filename = $this->fomataCaminhoDatabase($filename);
            $this->db = parent::__construct("sqlite:".$filename);
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function getDb()
    {
        return $this->db;
    }

    private function fomataCaminhoDatabase($filename)
    {
        return sprintf(
            '%s%s%s%s%s',
            WWW_ROOT,
            DIRECTORY_SEPARATOR,
            'config',
            DIRECTORY_SEPARATOR,
            $filename
        );
    }
}
