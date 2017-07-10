<?php
namespace Tests;

define('WWW_ROOT', dirname(__FILE__).'/..');

require_once 'config/Autoload.php';

use PHPUnit_Framework_TestCase;
use Entity\Imagem;
use Config\Autoload;

class ImagemTest extends PHPUnit_Framework_TestCase
{
    protected $imagem;

    public function __construct()
    {
        new Autoload();
        $this->imagem = new Imagem();
    }
    /*
    * @test
    */
    public function testGetId()
    {
        $this->assertNull($this->imagem->getImagemId());
    }

    public function testGetCaminho()
    {
        $caminho = 'teste.jpg';
        $this->imagem->setCaminho($caminho);

        $this->assertEquals($caminho, $this->imagem->getCaminho());
    }
}
