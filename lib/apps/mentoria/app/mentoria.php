<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/mentoria/class/class_mentoria.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Utils/Ambiente.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Mentoria', $_SESSION['ip']);

$class = new funcoes();

$consultaDepoimentosMentoria = $class->consultaDepoimentosMentoria();
$consultaProfessoresMentoria = $class->consultaProfessoresMentoria();

?>

<style>
    :root {
        --bg-fundo: url('<?= getBaseUrl(); ?>/lib/img/apps/mentoria/fundoMentoria.png');
        --bg-fundo-trilha-aprendizado: url('<?= getBaseUrl(); ?>/lib/apps/mentoria/img/background_mentoria_final.png');
    }
</style>

<!-- CSS específico do app -->
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v7.0.0/css/all.css"/>
<link href="/lib/apps/mentoria/css/mentoria.css" rel="stylesheet">
<link href="/lib/apps/mentoria/css/trilha-aprendizado.css" rel="stylesheet">
<link href="/lib/apps/mentoria/css/passaram_por_aqui.css" rel="stylesheet">
<link href="/lib/apps/mentoria/css/oque-dizem.css" rel="stylesheet">

<!-- JS específico do app -->
<script src="/lib/apps/mentoria/js/mentoria.js" defer></script>

<div class="Mentoria" style="width: 100%; height: 100%; position: relative;">
    <?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/mentoria/app/components/header.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/mentoria/app/components/trilha-aprendizado.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/mentoria/app/components/prova-social.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/mentoria/app/components/dizem-sobre-mentoria.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/mentoria/app/components/professores-mentoria.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/mentoria/app/components/fim-pagina.php";
    ?>
</div>

<style>
    <?php echo $cssBotoesTratado ?>
</style>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/pages/rodape.php";
?>
