<?php
    if(!isset($_SESSION)){
        session_start();
    }

    $_SESSION['matricula'] ='F0285739';
    $_SESSION['nome'] = 'Matheus Rodrigues';
    $_SESSION['cargo'] = 'Analista Tec Pleno';
    $_SESSION['MAIL'] = 'albert.rosa@bb.com.br';
    $_SESSION['dependencia'] = '1901';
    $_SESSION['ip'] = '10.10.10.10';

    // ini_set("display_errors", E_ALL);
    require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/estudosPesquisas/class/class_estudosPesquisas.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

    // $classLog = new gravaLogAcesso();
    // $gravaLogAcesso = $classLog->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Estudos e Pesquisas', $_SESSION['ip']);

    $class = new funcoes();
    $consultaEstudos = $class->consultaEstudos(1000);
    $consultaPesquisas = $class->consultaPesquisas(1000);
    $consultaTemasEstudos = $class->consultaTemas('estudos');
    $consultaTemasPesquisas = $class->consultaTemas('pesquisas');

    $displayBotaoAdiciona = '';

    if($_SESSION['dependencia'] <> '1901'){
        $displayBotaoAdiciona = 'style="display: none;"';
    }
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include $_SERVER["DOCUMENT_ROOT"]."/lib/apps/estudosPesquisas/app/header.html"; ?>
</head>
<body>

    <header class="header">
        <?php include $_SERVER["DOCUMENT_ROOT"]."/pages/cabecalho.php"; ?>
    </header>

    <div id="paginaEstudosPesquisas">
        <div class="container-central-fundo">
             <!-- Banner (pode centralizar ou manter como está) -->
            <img src="/lib/img/apps/estudosPesquisas/capa.png" class="banner-capa" style="width: 100%;">

            <!-- Abas Customizadas -->
            <div class="cabecalhoTabs">
                <div id="tabEstudos" class="tab-custom selected">
                    <span class="emoji">📚</span>Estudos
                </div>
                <div id="tabPesquisas" class="tab-custom">
                    <span class="emoji">🔎</span>Pesquisas
                </div>
            </div>

            <!-- Campo de busca, filtro e botão de adicionar -->
            <div class="area-superior-filtros">
                <input type="text" class="inputCampoPesquisa" placeholder="Digite aqui para pesquisar" />
                <select class="select-ordenar">
                    <option value="recentes">Mais Recentes</option>
                    <option value="antigos">Mais Antigos</option>
                </select>
                <button class="botaoAdicionaEstudo" <?php echo $displayBotaoAdiciona?> >
                    + ADICIONAR ESTUDO
                </button>

                <button style="display:none;" class="botaoAdicionaPesquisa" <?php echo $displayBotaoAdiciona?> >
                    + ADICIONAR PESQUISA
                </button>
            </div>
            
            <div class="area-cards-bg">
                <!-- Abas de conteúdo -->
                <div class="paginaPrincipalEstudos" id="abaEstudos" style="display:block;">
                    <div class="temasEstudos">
                        <?php echo $consultaTemasEstudos['mensagem']; ?>
                    </div>
                    <div class="quadroConteudoEstudos">
                        <div class="quadroConteudos">
                            <?php echo $consultaEstudos['mensagem']; ?>
                        </div>
                        <button class="botaoVerMaisEstudosPesquisas">Ver mais</button>
                    </div>
                </div>
    
                <div class="paginaPrincipalPesquisas" id="abaPesquisas" style="display:none;">
                    <div class="temasPesquisas">
                        <?php echo $consultaTemasPesquisas['mensagem']; ?>
                    </div>
                    <div class="quadroConteudoPesquisas">
                        <div class="quadroConteudos">
                            <?php echo $consultaPesquisas['mensagem']; ?>
                        </div>
                        <button class="botaoVerMaisEstudosPesquisas">Ver mais</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php"; ?>

<script>
// Alternância entre abas (tabs)
document.getElementById('tabEstudos').onclick = function() {
    document.getElementById('abaEstudos').style.display = 'block';
    document.getElementById('abaPesquisas').style.display = 'none';
    this.classList.add('selected');
    document.getElementById('tabPesquisas').classList.remove('selected');
    $('.botaoAdicionaEstudo').show();
    $('.botaoAdicionaPesquisa').hide();
};
document.getElementById('tabPesquisas').onclick = function() {
    document.getElementById('abaEstudos').style.display = 'none';
    document.getElementById('abaPesquisas').style.display = 'block';
    this.classList.add('selected');
    document.getElementById('tabEstudos').classList.remove('selected');
    $('.botaoAdicionaEstudo').hide();
    $('.botaoAdicionaPesquisa').show();
    
};
</script>

</body>
</html>


    <?php
        include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";
    ?>
</body>
</html>

