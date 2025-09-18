<?php

session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$_SESSION['matricula'] ='F0285739';
$_SESSION['nome'] = 'Albert Ferreira Rosa';
$_SESSION['cargo'] = 'Analista Tec Pleno';
$_SESSION['MAIL'] = 'albert.rosa@bb.com.br';
$_SESSION['dependencia'] = '1901';
$_SESSION['ip'] = '10.10.10.10';


// if($_SESSION["nome"] == ""){
//     header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https://cad.bb.com.br/ferramentas/versionamento/#login/");
// }

// include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
// require_once $_SERVER["DOCUMENT_ROOT"]."/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Teste Versionamento', $_SESSION['ip']);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Versionamento</title>
    <link href="../../lib/img/img_bot/bot.ico" mce_href="../../lib/img/img_bot/bot.ico" rel="icon">
    <link href="../../lib/img/img_bot/bot.ico" mce_href="../../lib/img/img_bot/bot.ico" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;900&display=swap" rel="stylesheet">

    <!-- CSS da página -->
    <link href="./css/index.css" rel="stylesheet">
    <link href="./css/hero-cad.css" rel="stylesheet">
    <link href="./css/tabs.css" rel="stylesheet">
    <link href="./css/checklist.css" rel="stylesheet">
    <link href="./css/condicao.css" rel="stylesheet">
    <link href="./css/versionamento.css" rel="stylesheet">
    <link href="./css/gerar-versao.css" rel="stylesheet">

    <!-- JS da página -->
    <script type="text/javascript" src="index.js"></script>

    <?php include $_SERVER["DOCUMENT_ROOT"] . "/pages/partials/dependencies.php"; ?>
</head>
<body>

<header class="header">
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/pages/cabecalho.php"; ?>
</header>

<section class="hero-cad">
    <div class="hero-cad-content">
        <div class="hero-cad-text">
            <h2 class="hero-cad-title">Versionamento</h2>
            <p class="hero-cad-subtitle">
                Registre versões e faça o <br/>
                acompanhamento
            </p>
        </div>
        <div class="hero-cad-img">
            <img src="./imagens/bot.png" alt="Robô versão"/>
        </div>
    </div>
</section>

<div class="main-card">
    <nav class="tab-buttons">
        <div class="tab-button active" onclick="selectTab('checklist')">Checklist</div>
        <div class="tab-button" onclick="selectTab('condicao')">Teste de Condição</div>
        <div class="tab-button" onclick="selectTab('versionamento')">Teste de Versionamento</div>
        <div class="tab-button" onclick="selectTab('gerar')">Gerar Versão</div>
        <div class="tab-button" onclick="selectTab('historico')">Histórico</div>

        <div class="conteudoTipoCanal">
            <span class="canal-titulo">Tipo de Canal:</span>

            <div style="display: flex; margin-left: 3%; align-items: center; gap: 8px;">
                <div class="canal-label canal-pf">PF</div>

                <label class="switch">
                <input id="chavePfPj" type="checkbox">
                <span class="slider round"></span>
                </label>

                <div class="canal-label canal-pj">PJ</div>
            </div>
        </div>
    </nav>
    <main>
        <section class="tab active" id="checklist">
            <?php include "tabs/checklist.php"; ?>
        </section>
        <section class="tab" id="condicao">
            <?php include "tabs/condicao.php"; ?>
        </section>
        <section class="tab" id="versionamento">
            <?php include "tabs/versionamento.php"; ?>
        </section>
        <section class="tab" id="gerar">
            <?php include "tabs/gerar.php"; ?>
        </section>
        <section class="tab" id="historico">
            <?php include "tabs/historico.php"; ?>
        </section>
        <section class="tab" id="detalhes">
            <?php include "tabs/detalhes.php"; ?>
            <link rel="stylesheet" href="./css/detalhes.css">
        </section>
    </main>
</div>

<script>

    function selectTab(id, el = null) {
        // limpa tudo
        document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
        document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));

        // ativa a aba clicada
        const tab = document.getElementById(id);
        if (tab) tab.classList.add('active');

        if (el) {
            el.classList.add('active');
        }

        // se for detalhes → adiciona classe no body
        if (id === "detalhes") {
            document.body.classList.add("detalhes-ativo");
        } else {
            document.body.classList.remove("detalhes-ativo");
        }
    }

    function toggleContent(element) {
        const content = element.nextElementSibling;
        const icon = element.querySelector(".botao-detalhar");
        if (content.classList.contains("open")) {
            content.classList.remove("open");
            icon.textContent = "▶";
        } else {
            content.classList.add("open");
            icon.textContent = "▼";
        }
    }

    function selectDetalhesTab(id, el) {
        document.querySelectorAll('.detalhes-tab-button').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.detalhes-tab-content').forEach(tab => tab.classList.remove('active'));

        el.classList.add('active');
        document.getElementById(`tab-${id}`).classList.add('active');
    }
</script>
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/pages/rodape.php";
?>
</body>
</html>