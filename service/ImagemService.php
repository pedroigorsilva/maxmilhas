<?php
namespace Service;

use Service\UploadImagemGaleria;
use Service\SqliteService;
use Entity\Imagem;

class ImagemService
{
    public function cadastrarImagem($arquivo)
    {
        $uploadImagemGaleriaService = new UploadImagemGaleria();
        $arquivo = $uploadImagemGaleriaService->uploadImagem($arquivo);

        return $this->populaImagem($arquivo);
    }

    private function populaImagem($arquivo)
    {
        $imagem = new Imagem();
        $imagem->setCaminho($arquivo);

        $save = $imagem->save();

        return $imagem;
    }

    public function buscarImagens()
    {
        $sql = "SELECT imagemId, caminho FROM imagem";
        return SqliteService::executaSql($sql);
    }

    public function buscarImagemPorId($imagemId)
    {
        $sql = "SELECT imagemId, caminho FROM imagem WHERE imagemId = ?";
        return SqliteService::executaSql($sql, array($imagemId));
    }

    public function deletarImagem($post)
    {
        $imagem = $this->buscarImagemPorId($post['imagemId']);

        if (empty($imagem)) {
            throw new \Exception("A imagem não foi localizada");
        }

        $uploadImagemGaleriaService = new UploadImagemGaleria();
        $uploadImagemGaleriaService->removeImagem($imagem[0]['caminho']);

        $sql = "DELETE FROM imagem WHERE imagemId = ? ;";
        return SqliteService::executaOperacao($sql, array($post['imagemId']));
    }
}
