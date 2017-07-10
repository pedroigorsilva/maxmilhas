<?php
namespace Tests;

define('WWW_PUBLIC', dirname(__FILE__));
define('WWW_ROOT', dirname(__FILE__).'/..');

require_once 'config/Autoload.php';

use PHPUnit_Framework_TestCase;
use Config\Autoload;
use Service\UploadImagemGaleria;

class UploadTest extends PHPUnit_Framework_TestCase
{
    protected $upload;

    protected $arquivo = 'teste.png';

    public function __construct()
    {
        new Autoload();
        $this->upload = new UploadImagemGaleria();

        $_FILES = array(
            'imagem' => array(
                'name' => 'test.png',
                'tmp_name' => 'web/img/'. $this->arquivo,
                'type' => 'image/png',
                'size' => 3202,
                'error' => 0
            )
        );
    }
    /*
    * @test
    */
    public function testUpload()
    {
        $arquivo = $this->upload->uploadImagem($_FILES, '../web/upload');
        $this->assertEquals($arquivo, $this->arquivo);
    }
}
