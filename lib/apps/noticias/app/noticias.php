<?php

if(!isset($_SESSION)){
    session_start();
}

// ini_set("display_errors", E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/noticias/class/class_noticias.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Notícias', $_SESSION['ip']);

$class = new funcoes();
$temas = $class->consultaTemas();

$noticias = $class->consultaNoticias();

echo '<!-- CSS específico do app --><link href="/lib/apps/noticias/css/noticias.css" rel="stylesheet">';
echo '<!-- JS específico do app --><script type="text/javascript" src="/lib/apps/noticias/js/noticias.js"></script>';
echo '
    <div id="paginaNoticias">
        <img src="/lib/img/apps/noticias/capa.png" style="width: 100%;">
        <div class="textoFotoNoticias">Saiu na AGN</div>
        
        <div class="campoPesquisaNoticias">
            <div class="barraPesquisa">
                <div style="align-self: stretch; height: 39px; padding: 8px 16px; background: #F0F2F4; border-top-left-radius: 4px; border-top-right-radius: 4px; justify-content: flex-start; align-items: center; gap: 8px; display: inline-flex">
                    <div style="position: relative">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </div>
                    <div style="flex: 1 1 0; height: 20px; justify-content: flex-start; align-items: center; display: flex">
                        <input class="inputCampoPesquisa" placeholder="Digite aqui para pesquisar">
                    </div>
                </div>
            </div>
            <div class="botoesPesquisaLimpaNoticias">
                <div class="botaoCampoPesquisa Clicar">
                    <div class="textoBotoesCampoPesquisa">Pesquisar</div>
                </div>
                <div class="botaoLimpaPesquisa Clicar">
                    <div class="textoBotoesCampoPesquisa">limpar</div>
                </div>
            </div>
        </div>

        <div class="divBotoesFiltroTema" style="display: contents;">
            '.$temas['mensagem'].'
        </div>
        <div class="containerNoticias">
            '.$noticias['mensagem'].'
        </div>
        <div class="botaoVerMaisNoticias Clicar" attr-sequencia="1" style="padding-left: 32px; padding-right: 32px; padding-top: 15px; padding-bottom: 15px; background: #FDF429; border-radius: 4px; justify-content: center; align-items: center; gap: 10px; display: inline-flex">
            <div style="text-align: center; color: #3354FD; font-size: 16px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 18px; letter-spacing: 0.08px; word-wrap: break-word">Ver mais</div>
        </div>
    </div>
';

include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";