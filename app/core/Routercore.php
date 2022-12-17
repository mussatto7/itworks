<?php
// CHAMANDO O NAMESPACE
namespace Itworks\core;
// ABERTURA DA CLASSE ROUTERCORE
class RouterCore
{
    // DECLARANDO AS VARIÁVEIS
    private $uri;
    private $method;
    private $getArr = [];
    // FUNÇÃO __construct()
    public function __construct()
    {
        // VARIAVEL "$this" ACESSANDO A FUNÇÃO "initial()"
        $this->initial();
        // INCLUINDO O CAMINHO INTEIRO ATÉ O ARQUIVO "router.php"
        require_once('../app/config/router.php');
        // VARIAVEL "$this" ACESSANDO A FUNÇÃO "execute()"
        $this->execute();
    }
    // FUNÇÃO initial()
    private function initial()
    {
        // VÁRIAVEL "$this" ACESSADO METHOD, RECEBENDO A VÁRIAVEL "$_SERVER['REQUEST_METHOD']"
        $this->method = $_SERVER['REQUEST_METHOD'];
        // VARIAVEL "$uri_initial" RECEBENDO "$_SERVER['REQUEST_METHOD']"
        $uri_initial = $_SERVER['REQUEST_URI'];

        // SE A PRIMEIRA OCORRÊNCIA TIVER A VÁRIAVEL "uri_initial" ou '?'
        if (strpos($uri_initial, '?'))
            // VÁRIAVEL "$uri_initial" RECEBE A FUNÇÃO "mb_substr" COM OS PARÂMETROS
            $uri_initial = mb_substr($uri_initial, 0, strpos($uri_initial, '?'));
        // VÁRIAVEL "$ex" RECEBE a FUNÇÃO "explode" QUE ESTÁ ENCONTRANDO SÍMBOLOS
        $ex = explode('/', $uri_initial);

        // VÁRIAVEL "uri" RECEBE "array_values" TENDO COMO PARÂMETRO O "array_filter" DA VÁRIAVEL "$ex"
        $uri = array_values(array_filter($ex));

        // CRIANDO UM LAÇO DE REPETIÇÃO
        // PARA $i = 0; $i SENDO MENOR QUE "UNSET_URI_COUNT"; $i ACRESCENTA +1
        for ($i = 0; $i < UNSET_URI_COUNT; $i++) {
            // DESTRÓI A VÁRIAVEL "$uri[$i]"
            unset($uri[$i]);
        }

        // VÁRIAVEL "$this" ACESSA "$uri" RECEBENDO UM IMPLODE (RETORNA UMA STRING CONTENDO OS ELEMENTOS DA MATRIZ NA MESMA ORDEM)
        $this->uri = implode('/', $this->normalizeURI($uri));

        // SE "DEBUG_URI"
        if (DEBUG_URI) {
            // PRINTANDO '<pre>'
            echo '<pre>';
            // PRINTANTDO A VÁRIAVEL "$this" ACESSANDO "uri"
            print_r($this->uri);
            // PRINTANDO '<pre>'         
            echo '</pre>';
        }
    }
    // FUNÇÃO normalizeURI COM COM O PARÂMETRO "$arr"
    private function normalizeURI($arr)
    {
        // RETORNANDO UM "array_values" COM UM "array_filter($arr)"
        return array_values(array_filter($arr));
    }
    // FUNÇÃO excute()
    private function execute()
    {
        // CASO A VARIÁVEL "$this" ACESSAR "method"
        switch ($this->method) {
                // CASO "GET"
            case 'GET':
                // VARIÁVEL $this ACESSA A FUNÇÃO executeGet()
                $this->executeGet();
                // PAUSA
                break;
                // CASO "POST"
            case 'POST':
                // VARIÁVEL $this ACESSA A FUNÇÃO executePost()
                $this->executePost();
                // PAUSA
                break;
        }
    }
    // FUNÇÃO executeGet()
    private function executeGet()
    {
        //PARA CADA VARIÁVEL "$this" ACESSA "getArr" as "$get"
        foreach ($this->getArr as $get) {
            // DECLARA "$r" AONDE RECEBE A PARTE DA STRING COM OS PARÂMETROS ($get['router'], 1)
            $r = substr($get['router'], 1);
            // SE A PARTE DA STRING $r OU -1 VAI SER IGUAL '/'
            if (substr($r, -1) == '/') {
                // "$r" RECEBE A PARTE DA STRING DE ($r,0,-1)
                $r = substr($r, 0, -1);
            }
            // SE "$r" FOR IGUAL A VARIÁVEL "$this" ACESSANDO "uri"
            if ($r == $this->uri) {
                // SE A VARIÀVEL FOR FUNÇÃO $get['call'] 
                if (is_callable($get['call'])) {
                    // RETORNA $get['call']()
                    $get['call']();
                    // PAUSA
                    break;
                    // SE NÃO
                } else {
                    // VARIÁVEL $this ACESSA A FUNÇÃO executeController($get['call']);
                    $this->executeController($get['call']);
                }
            }
        }
    }
    // FUNÇÃO executePost()
    private function executePost()
    {
        //PARA CADA VARIÁVEL "$this" ACESSA "getArr" as "$get"
        foreach ($this->getArr as $get) {
            // DECLARA "$r" AONDE RECEBE A PARTE DA STRING COM OS PARÂMETROS ($get['router'], 1)
            $r = substr($get['router'], 1);
            // SE A PARTE DA STRING $r OU -1 VAI SER IGUAL '/'
            if (substr($r, -1) == '/') {
                // "$r" RECEBE A PARTE DA STRING DE ($r,0,-1)
                $r = substr($r, 0, -1);
            }
            // SE "$r" FOR IGUAL A VARIÁVEL "$this" ACESSANDO "uri"
            if ($r == $this->uri) {
                // SE A VARIÀVEL FOR FUNÇÃO $get['call'] 
                if (is_callable($get['call'])) {
                    // RETORNA $get['call']()
                    $get['call']();
                    // RETORNA
                    return;
                }
                // VARIÁVEL $this ACESSA A FUNÇÃO executeController($get['call']);
                $this->executeController($get['call']);
            }
        }
    }
    // FUNÇÃO executeControlleR TENDO COMO PARÂMETRO A VÁRIAVEL GET($get)
    private function executeController($get)
    {
        // VÁRIAVEL $ex RECEBE O RETORNO DE VÁRIAS STRINGS DA VÁRIAVEL GET SEPARADO POR @
        $ex = explode('@', $get);
        // SE A VÁRIAVEL $ex NA POSIÇÃO 0 NÃO FOR INICIADA OU VÁRIAVEL $ex NA POSIÇÃO 1 NÃO FOR INICIADA
        if (!isset($ex[0]) || !isset($ex[1])) {
            // RETORNA UMA MENSAGEM DE ERRO CONCATENANDO COM A VÁRIAVEL GET
            (new \Itworks\core\Controller)->showMessage('Dados inválidos', 'Controller ou método não encontrado: ' . $get, null, 404);
            return;
        }

        // VARIAVEL $cont RECEBE O CAMINHO CONCATENADO COM A VÁRIAVEL $get
        $cont = 'Itworks\\src\\controller\\' . $ex[0];
        // SE A CLASSE NÃO FOR DEFINIDA PELA VÁRIAVEL $cont
        if (!class_exists($cont)) {
            // RETORNA UMA MENSAGEM DE ERRO CONCATENANDO COM A VÁRIAVEL GET
            (new \Itworks\core\Controller)->showMessage('Dados inválidos', 'Controller não encontrada: ' . $get, null, 404);
            return;
        }

        // SE O MÉTODO DA CLASSE NÃO EXITIR PARA $cont e $ex[1]
        if (!method_exists($cont, $ex[1])) {
            // RETORNA UMA MENSAGEM DE ERRO CONCATENANDO COM A VÁRIAVEL GET
            (new \Itworks\core\Controller)->showMessage('Dados inválidos', 'Método não encontrado: ' . $get, null, 404);
            return;
        }

        // CHAMA A FUNÇÃO call_user_func_array([
        call_user_func_array([
            // DECLARANDO UMA NOVA VÁRIAVEL $cont
            new $cont,
            // CONTA OS USUÁRIOS A PARTIR DA POSIÇÃO $ex[1] 
            $ex[1]
            // COLOCANDO-AS NO ARRAY
        ], []);
    }

    // FUNÇÃO GET TENDO COMO PARÂMETROS A VÁRIAVEL $router e $call
    private function get($router, $call)
    {
        // VARIÁVEL $this ACESSA O ARRAY $getarr[]
        $this->getArr[] = [
            // ATRIBUI VALORES AS VÁRIAVEIS ABAIXO CITADAS
            'router' => $router,
            'call' => $call
        ];
    }
    // FUNÇÃO POST TENDO COMO PARÂMETROS A VÁRIAVEL $router e $call
    private function post($router, $call)
    {
        // VARIÁVEL $this ACESSA O ARRAY $getarr[]
        $this->getArr[] = [
            // ATRIBUI VALORES AS VÁRIAVEIS ABAIXO CITADAS
            'router' => $router,
            'call' => $call
        ];
    }
}
