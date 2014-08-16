<?php

namespace CupCake2\Core;

class CupRenderer {

    private $pastaTemplates = 'App/Views/Templates/';
    private $pastaViews = 'App/Views/';
    public $template;

    public function renderizar($nomeView, $variaveis = array(), $retornar = false) {
        if (!is_array($variaveis)) {
            throw new Exception("Variável ''$variaveis'' não é um array.");
        }

        $view = $this->pastaViews . $nomeView . '.php';
        if (!file_exists($view)) {
            $view = 'app/content/sys_views/' . $nomeView . '.php';
            if (!file_exists($view)) {
                die('Erro interno no componente renderizador !');
            }
        }
        $template = $this->pastaTemplates . $this->template . '.php';

        $conteudo = $this->render($view, $variaveis, true);
        $variaveis['conteudo'] = $conteudo;

        return $this->render($template, $variaveis, $retornar);
    }

    public function renderizarParcial($nomeView, $variaveis = array(), $retornar = false) {
        if (!is_array($variaveis)) {
            throw new Exception('Variável "$variaveis" não é um array.');
        }
        $view = $this->pastaViews . $nomeView . '.php';
        if (!file_exists($view)) {
            $view = $this->pastaTemplates . $nomeView . '.php';
            if (!file_exists($view)) {
                die('Erro interno no componente renderizador !');
            }
        }
        return $this->render($view, $variaveis, $retornar);
    }

    public function render($arquivoParaRenderizar, $variaveis = array(), $retornar = false) {
        ob_start();
        if (!empty($variaveis) && is_array($variaveis)) {
            extract($variaveis);
        }
        include($arquivoParaRenderizar);
        $retorno = ob_get_contents();
        ob_end_clean();
        if ($retornar) {
            return $retorno;
        } else {
            print $retorno;
        }
    }

}