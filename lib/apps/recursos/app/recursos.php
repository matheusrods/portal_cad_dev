<?php

if(!isset($_SESSION)){
    session_start();
}

// ini_set("display_errors", E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/recursos/class/class_recursos.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Recursos', $_SESSION['ip']);

$class = new funcoes();
$temas = $class->consultaTemas();

$recursos = $class->consultaRecursos();

$displayBotaoAdiciona = '';
$uorDep = $_SESSION['cod_uor'];

if($uorDep == '486362' || $uorDep == '486361'){
    $botaoAdicionarRecurso = '
        <div class="botaoAdicionaRecurso Clicar">
            <div class="textoBotoesCampoPesquisa">+ Adicionar Recurso</div>
        </div>';
}

echo '<!-- CSS específico do app --><link href="/lib/apps/recursos/css/recursos.css" rel="stylesheet">';
echo '<!-- JS específico do app --><script type="text/javascript" src="/lib/apps/recursos/js/recursos.js"></script>';
echo '
    <div id="paginaRecursos">
        <img src="/lib/img/apps/recursos/capa.png" style="width: 100%;">
        
        <div class="campoPesquisaRecursos">
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
            <div class="botoesPesquisaLimpaRecursos">
                <div class="botaoCampoPesquisa Clicar">
                    <div class="textoBotoesCampoPesquisa">Pesquisar</div>
                </div>
                <div class="botaoLimpaPesquisa Clicar">
                    <div class="textoBotoesCampoPesquisa">limpar</div>
                </div>
                '.$botaoAdicionarRecurso.'
            </div>
        </div>

        <div class="divBotoesFiltroTema" style="display: contents;">
            '.$temas['mensagem'].'
        </div>
        <div class="containerRecursos">
            '.$recursos['mensagem'].'
        </div>
        <div class="botaoVerMaisRecursos Clicar" attr-sequencia="1" style="padding-left: 32px; padding-right: 32px; padding-top: 15px; padding-bottom: 15px; background: #FDF429; border-radius: 4px; justify-content: center; align-items: center; gap: 10px; display: inline-flex">
            <div style="text-align: center; color: #3354FD; font-size: 16px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 18px; letter-spacing: 0.08px; word-wrap: break-word">Ver mais</div>
        </div>
    </div>
';

include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";