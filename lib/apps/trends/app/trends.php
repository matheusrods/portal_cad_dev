<?php

if(!isset($_SESSION)){
    session_start();
}

ini_set("display_errors", E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/trends/class/class_trends.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Trends', $_SESSION['ip']);

$funcoes = new funcoes();
$consultaTrends = $funcoes->consultaTrends();

//echo $consultaTrends;

//die;
echo '<link href="/lib/apps/trends/css/trends.css" rel="stylesheet">';
echo '<!-- JS especifico do app --><script type="text/javascript" src="lib/apps/trends/js/trends.js"></script>';
echo '<div id = "paginaTrends">
        <div class ="cabecalho">
            <img src ="/lib/apps/trends/img/imagemAmbiencia.png" style= "width: 100%;">
            <div class="textoFotoTrends">Notícias do Mercado</div>
        </div>
    
        <div class="campoPesquisaTrends">
            <div class="barraPesquisa">
                <div style="align-self: stretch; height: 40px; padding: 8px 16px; background: #F0F2F4; border-top-left-radius: 4px; border-top-right-radius: 4px; justify-content: flex-start; align-items: center; gap: 8px; display: inline-flex">
                    <div style="position: relative">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </div>
                    <div style = "flex: 1 1 0; height: 20px; justify-content: flex-start; align-itens: center; display: flex">                         
                        <input class="inputCampoPesquisa" placeholder="O que gostaria de pesquisar">                        
                    </div>
                </div>
            </div>
            <div class="botoesPesquisaLimpaTrends">
                <div class="botaoCampoPesquisa Clicar">
                    <div class="textoBotoesCampoPesquisa">Pesquisar</div>
                </div>   
                <div class="botaoLimpaPesquisa Clicar">
                    <div class="textoBotoesCampoPesquisa">Limpar</div>
                </div>                
            </div>              
        </div>';

    echo'<div class="containerDeTrends">
            '.$consultaTrends['mensagem'].'
        </div>
    
        <div class="botaoVerMaisTrends Clicar" attr-sequencia="1" style="padding-left: 32px; padding-right: 32px; padding-top: 15px; padding-bottom: 15px; background: #FDF429; border-radius: 4px; justify-content: center; align-items: center; gap: 10px; display: inline-flex">
            <div style="text-align: center; color:#3354FD; font-size: 16px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 18px; letter-spacing: 0.08px; word-wrap: break-word">Ver mais</div>     
        </div>
    </div>';
    
           
    include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";

