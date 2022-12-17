<?php

namespace Itworks\core;

class Controller
{
    /**
     * Carregar a View
     * @param string $view tela
     * @param array @params Parametros para serem impressos na tela
     * return HTML
     */
    protected function load(string $view, $params = [])
    {
        //DEFINE URL
        $twig = new \Twig\Environment(
            new \Twig\Loader\FilesystemLoader('../app/src/view/')
        );
        //IMPRIME A RENDERIZAÇÃO
        $twig->addGlobal('BASE', BASE);
        echo $twig->render($view . '.twig.php', $params);
    }

    public function showMessage(
        string $titulo,
        string $descricao,
        string $link = null,
        int $httpCode = 200
    ) {
        http_response_code($httpCode);
        $this->load('partials/massage', [
            'titulo' => $titulo,
            'descricao' => $descricao,
            'link' => $link,
        ]);
    }
}
