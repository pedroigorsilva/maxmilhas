<?php
namespace Service;

use Helpers\FiltroString;

class UploadImagemGaleria extends UploadService
{
    const PASTA_UPLOAD = 'upload';

    public function uploadImagem($arquivo, $pastaUpload = null)
    {
        if (!$this->validaExtensao($arquivo['imagem']['type'])) {
            throw new \Exception("Arquivo não é uma imagem válida.");
        }

        if (is_null($pastaUpload)) {
            $pastaUpload = self::PASTA_UPLOAD;
        }

        return $this->upload(
            $arquivo['imagem']['tmp_name'],
            $pastaUpload,
            $this->formataNomeImagem($arquivo['imagem']['name'])
        );
    }

    public function removeImagem($arquivo)
    {
        return $this->remove(
            self::PASTA_UPLOAD,
            $arquivo
        );
    }

    /**
     * Valida se o arquivo possui uma extensão válida
     * @param  String   $type
     */
    private function validaExtensao($type)
    {
        switch ($type) {
            case 'image/gif':
            case 'image/jpeg':
            case 'image/png':
                return true;
                break;
            default:
                return false;
                break;
        }
    }

    private function formataNomeImagem($nome)
    {
        return FiltroString::substituiEspacos($nome);
    }
}
