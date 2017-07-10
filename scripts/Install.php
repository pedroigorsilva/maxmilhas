<?php

define('WWW_ROOT', dirname(__FILE__).'/..');
include_once('config/Sqlite.php');

$db = new Config\Sqlite();

dropaTabelaGaleria($db);
criaTabelaGaleria($db);

echo "Tabela criada com sucesso!\n\n";

function dropaTabelaGaleria($db)
{
    echo "Dropando a tabela imagem\n\n";
    $db->exec("
        drop table if exists imagem;
    ");
    return true;
}

function criaTabelaGaleria($db)
{
    echo "Criando a tabela imagem\n\n";
    $db->exec("
        create table imagem
        (
            imagemId INTEGER PRIMARY KEY AUTOINCREMENT,
            caminho varchar(200) NOT NULL
        );
    ");
    return true;
}
