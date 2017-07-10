<?php
define('WWW_PUBLIC', dirname(__FILE__));
define('WWW_ROOT', dirname(__FILE__).'/..');
$loader = require_once '../vendor/autoload.php';
require_once '../config/Autoload.php';
use Config\Autoload;
use Config\Route;

$autoload = new Autoload();

$route = new Route($_SERVER['QUERY_STRING']);

Route::add('/', function () {
    return Route::view('home');
});

Route::add('cadastrar-imagem', function () {
    return Route::view('cadastrar-imagem');
});

Route::add('gerenciar-galeria', function () {
    return Route::view('gerenciar-galeria');
});

Route::add('visualizar-galeria', function () {
    return Route::view('visualizar-galeria');
});

Route::addController('imagem', function () {
    return Route::controller('imagem', 'imagem', 'cadastrar');
});

Route::addController('buscar', function () {
    return Route::controller('buscar', 'imagem', 'buscar');
});

Route::addController('deletar', function () {
    return Route::controller('deletar', 'imagem', 'deletar');
});
