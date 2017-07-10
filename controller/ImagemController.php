<?php
namespace Controller;

use Service\ImagemService;

class ImagemController extends BaseController
{
    public function cadastrarAction()
    {
        $imagemService = new ImagemService();
        $imagemService->cadastrarImagem($_FILES);

        $this->render(
            array(
                'mensagem' => 'A imagem foi salva com sucesso!'
            )
        );
    }

    public function buscarAction()
    {
        $imagemService = new ImagemService();
        $imagens = $imagemService->buscarImagens();

        $this->render(
            array(
                'galeria' => $imagens
            )
        );
    }

    public function deletarAction()
    {
        $imagemService = new ImagemService();
        $imagemService->deletarImagem($_POST);

        $this->render(
            array(
                'mensagem' => 'A imagem foi deletada com sucesso!'
            )
        );
    }
}
