<?php

namespace CupCake2\Core;

class CupRequestDispatcher {

    const sulfixo_controle = 'control_';

    public $paginaSolicitada;
    public $paginaAtual;
    public $request;

    function __construct() {
        $this->request = $_GET;
        if (empty($this->request['a'])) {
            $this->request['a'] = 'home';
        }
        $this->paginaSolicitada = str_replace('-', '_', $_GET['a']);
        if (empty($this->paginaSolicitada)) {
            $this->paginaSolicitada = 'home';
        }
        $this->paginaAtual = $this->request['a'];
        $acao = self::sulfixo_controle . $this->paginaSolicitada;
        if (method_exists($this, $acao)) {
            $reflection = new ReflectionMethod($this, $acao);
            $qtdArgumentos = $reflection->getNumberOfParameters();
            $parametros = array();
            $i = 0;
            foreach ($_GET as $key => $value) {
                if (!empty($value) && $key != 'a' && $i <= $qtdArgumentos)
                    $parametros[$i] = $value;
                $i++;
            }

            if (count($parametros) < $qtdArgumentos) {
                $i = $qtdArgumentos - count($parametros);
                for ($index = 0; $index < $i; $index++) {
                    $parametros[$index + count($parametros) + 1] = '';
                }
            }

            call_user_func_array(array($this, $acao), $parametros);
        } else {
            $this->erro_404();
        }
    }

    public function erro_404() {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        header("Status: 404 Not Found");
        $_SERVER['REDIRECT_STATUS'] = 404;
        $this->renderizar('nao_existe');
    }

}
