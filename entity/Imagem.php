<?php

namespace Entity;

class Imagem extends EntidadeBase
{
    /**
     * Id da imagem
     * @var imagemId
     */
    protected $imagemId;

    /**
     * Caminho da imagem
     * @var $caminho
     */
    protected $caminho;

    /**
     * getImagemId
     * @return Int
     */
    public function getImagemId()
    {
        return $this->imagemId;
    }

    /**
     * setCaminho
     * @param String $caminho
     */
    public function setCaminho($caminho)
    {
        $this->caminho = $caminho;
        return $this;
    }

    /**
     * getCaminho
     * @return String
     */
    public function getCaminho()
    {
        return $this->caminho;
    }
}
