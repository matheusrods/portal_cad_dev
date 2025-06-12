<?php

if(!isset($_SESSION)){
    session_start();
}

// ini_set("display_errors", E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/paineis/class/class_paineis.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();

$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Analytics', $_SESSION['ip']);

$class = new funcoes();
$tags = $class->consultaTags();
$paineis = $class->consultaPaineis();



echo '<!-- CSS específico do app --><link href="/lib/apps/paineis/css/paineis.css" rel="stylesheet">';
echo '<!-- JS específico do app --><script type="text/javascript" src="/lib/apps/paineis/js/paineis.js"></script>';



echo preg_replace('/\>\s+\</m', '><', '

<div class="containerAreaPaineis">

    <div style="width: 100%; text-align: center; color: #49494F; font-size: 48px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word; padding-top: 1.8%;">
        Painéis
    </div>
    <a href="https://cad.bb.com.br/bot_sql/" target="_blank">
        <img id="divChamaBotSql" src="https://cad.bb.com.br/lib/img/apps/paineis/bolhaChatDado.png"">
    </a>
    <div class="campoPesquisaAnalytics">
        <div class="barraPesquisa">
            <div style="align-self: stretch; height: 39px; width:100%; padding: 8px 16px; background: #F0F2F4; border-top-left-radius: 4px; border-top-right-radius: 4px;  border-bottom: 1px solid #B4B9C1;justify-content: flex-start; align-items: center; gap: 8px; display: inline-flex">
                <div style="position: relative">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
            <div style="flex: 1 1 0; height: 20px; justify-content: flex-start; align-items: center; display: flex">
                <input class="inputCampoPesquisa" placeholder="Digite aqui para pesquisar">
            </div>
        </div>
     </div>   
        <div class="botoesPesquisaLimpaPaineis">
            <div class="botaoCampoPesquisa Clicar">
                <div class="textoBotoesCampoPesquisa">Pesquisar</div>
            </div>
            <div class="botaoLimpaPesquisa Clicar">
                <div class="textoBotoesCampoPesquisa">limpar</div>
            </div>
        </div>
    </div>
  
    <div class="BotoesFiltroTag" style="display: contents;">
            '.$tags['mensagem'].'
    </div>
    <div class="containerPaineis">
            '.$paineis['mensagem'].'
    </div>
    <div class="botaoVerMaisPaineis Clicar" attr-sequencia="1" style="padding-left: 32px; padding-right: 32px; padding-top: 15px; padding-bottom: 15px; background: #FDF429; border-radius: 4px; justify-content: center; margin: 1.75rem; align-items: center; gap: 10px; display: inline-flex">
        <div style="text-align: center; color: #3354FD; font-size: 16px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 18px; letter-spacing: 0.08px; word-wrap: break-word">Ver mais</div>
    </div>


  
</div>


');


include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";
?>