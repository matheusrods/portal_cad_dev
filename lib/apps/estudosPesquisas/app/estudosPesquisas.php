<?php
    if(!isset($_SESSION)){
        session_start();
    }

    // ini_set("display_errors", E_ALL);
    require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/estudosPesquisas/class/class_estudosPesquisas.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

    $classLog = new gravaLogAcesso();
    $gravaLogAcesso = $classLog->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Estudos e Pesquisas', $_SESSION['ip']);

    $class = new funcoes();
    $consultaEstudos = $class->consultaEstudos();
    $consultaPesquisas = $class->consultaPesquisas();
    $consultaTemasEstudos = $class->consultaTemas('estudos');
    $consultaTemasPesquisas = $class->consultaTemas('pesquisas');

    $displayBotaoAdiciona = '';

    if($_SESSION['dependencia'] <> '1901'){
        $displayBotaoAdiciona = 'style="display: none;"';
    }
?>


<link rel="stylesheet" href="/lib/apps/estudosPesquisas/css/styleguide.css" rel="stylesheet" />

<!-- CSS específico do app -->
<link href="/lib/apps/estudosPesquisas/css/estudosPesquisas.css" rel="stylesheet">
<!-- JS específico do app -->
<script type="text/javascript" src="/lib/apps/estudosPesquisas/js/estudosPesquisas.js"></script>

<div id="paginaEstudosPesquisas">

    <img src="/lib/img/apps/estudosPesquisas/capa.png" style="width: 100%;">

    <div class="paginaPrincipalEstudos" style="margin-top: -0.2%; position: relative;">
        <div class="cabecalhoEstudos">
            <div class="estudos" style="background-color: #00ffe0; color: #465eff; border-top-right-radius: 99px; border-top-left-radius: 99px;">
                📚 Estudos
            </div>    
            <div class="pesquisas Clicar" style="background-color: #465eff; color: #00ffe0; border-top-right-radius: 99px; border-top-left-radius: 99px; ">
                🔎 Pesquisas
            </div>
        </div>

        <div class="conteudoEstudos">
            <div class="campoPesquisaNoticias">
                <div class="barraPesquisa">
                    <div style="align-self: stretch; height: 39px; padding: 8px 16px; background: #F0F2F4; border-top-left-radius: 4px; border-top-right-radius: 4px; justify-content: flex-start; align-items: center; gap: 8px; display: inline-flex">
                        <div style="position: relative">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </div>
                        <div style="flex: 1 1 0; height: 20px; justify-content: flex-start; align-items: center; display: flex">
                            <input class="inputCampoPesquisaEstudos" placeholder="Digite aqui para pesquisar">
                        </div>
                    </div>
                </div>
                <div class="botoesPesquisaLimpaEstudoPesquisas">
                    <div class="botaoCampoPesquisaEstudo Clicar">
                        <div class="textoBotoesCampoPesquisa">Pesquisar</div>
                    </div>
                    <div class="botaoLimpaPesquisaEstudo Clicar">
                        <div class="textoBotoesCampoPesquisa">limpar</div>
                    </div>
                    <div class="botaoAdicionaEstudo Clicar" <?php echo $displayBotaoAdiciona?> >
                        <div class="textoBotoesCampoPesquisa">+ Adicionar Estudo</div>
                    </div>
                </div>
            </div>

            <div class="temasEstudos" style="display: contents; gap: 8px;">
                <?php
                    echo $consultaTemasEstudos['mensagem'];  
                ?>
            </div>

            <div class="quadroConteudoEstudos">
                <div class="quadroConteudos">
                    <?php
                        echo $consultaEstudos['mensagem'];
                    ?>
                </div>
                <div class="botaoVerMaisEstudosPesquisas Clicar botaoEstudos" attr-sequencia="1" attr-qualBotao="Estudos" style="padding-left: 32px; padding-right: 32px; padding-top: 15px; padding-bottom: 15px; background: #FDF429; border-radius: 4px; justify-content: center; align-items: center; gap: 10px; display: inline-flex">
                    <div style="text-align: center; color: #3354FD; font-size: 16px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 18px; letter-spacing: 0.08px; word-wrap: break-word">
                        Ver mais
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="paginaPrincipalPesquisas" style="display: none; margin-top: -0.2%; position: relative;">
        <div class="cabecalhoPesquisas">
            <div class="estudos Clicar" style="background-color: #00ffe0; color: #465eff; border-top-right-radius: 99px; border-top-left-radius: 99px;">
                📚 Estudos
            </div>    
            <div class="pesquisas" style="background-color: #465eff; color: #00ffe0; border-top-right-radius: 99px; border-top-left-radius: 99px;">
                🔎 Pesquisas
            </div>
        </div>

        <div class="conteudoPesquisas">
            <div class="campoPesquisaNoticias">
                <div class="barraPesquisa">
                    <div style="align-self: stretch; height: 39px; padding: 8px 16px; background: #F0F2F4; border-top-left-radius: 4px; border-top-right-radius: 4px; justify-content: flex-start; align-items: center; gap: 8px; display: inline-flex">
                        <div style="position: relative">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </div>
                        <div style="flex: 1 1 0; height: 20px; justify-content: flex-start; align-items: center; display: flex">
                            <input class="inputCampoPesquisaPesquisas" placeholder="Digite aqui para pesquisar">
                        </div>
                    </div>
                </div>
                <div class="botoesPesquisaLimpaPesquisaPesquisas">
                    <div class="botaoCampoPesquisaPesquisa Clicar">
                        <div class="textoBotoesCampoPesquisa">Pesquisar</div>
                    </div>
                    <div class="botaoLimpaPesquisaPesquisa Clicar">
                        <div class="textoBotoesCampoPesquisa">limpar</div>
                    </div>
                    <div class="botaoAdicionaPesquisa Clicar" <?php echo $displayBotaoAdiciona?> >
                        <div class="textoBotoesCampoPesquisa">+ Adicionar Pesquisa</div>
                    </div>
                </div>
            </div>

            <div class="temasPesquisas" style="display: contents; gap: 8px;">
                <?php
                    echo $consultaTemasPesquisas['mensagem'];
                ?>
            </div>

            <div class="quadroConteudoPesquisas">
                <div class="quadroConteudos">
                    <?php
                        echo $consultaPesquisas['mensagem'];
                    ?>
                </div>
                <div class="botaoVerMaisEstudosPesquisas Clicar botaoPesquisas" attr-sequencia="1" attr-qualBotao="Pesquisas" style="padding-left: 32px; padding-right: 32px; padding-top: 15px; padding-bottom: 15px; background: #FDF429; border-radius: 4px; justify-content: center; align-items: center; gap: 10px; display: inline-flex">
                    <div style="text-align: center; color: #3354FD; font-size: 16px; font-family: BancoDoBrasil Titulos; font-weight: 700; text-transform: uppercase; line-height: 18px; letter-spacing: 0.08px; word-wrap: break-word">
                        Ver mais
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
    include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";
?>