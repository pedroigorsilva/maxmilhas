<?php
namespace Service;

class UploadService
{
    protected function upload($tmpName, $pastaDestino, $arquivo)
    {
        $arquivoDir = $this->formataArquivoDestino($pastaDestino, $arquivo);

        if (!move_uploaded_file($tmpName, $arquivoDir)) {
            throw new \Exception("Ocorreu um erro ao fazer o upload do arquivo.");
        }

        return $arquivo;
    }

    protected function remove($pastaDestino, $arquivo)
    {
        $remove = unlink($this->formataArquivoDestino($pastaDestino, $arquivo));
        if ($remove === false) {
            throw new \Exception("Ocorreu um erro ao fazer o upload do arquivo.");
        }

        return true;
    }

    private function formataArquivoDestino($pasta, $arquivo)
    {
        return sprintf(
            '%s%s%s%s%s',
            WWW_PUBLIC,
            DIRECTORY_SEPARATOR,
            $pasta,
            DIRECTORY_SEPARATOR,
            $arquivo
        );
    }
}
