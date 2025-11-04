<?php

session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Utils/Ambiente.php";

// header('Access-Control-Allow-Origin: ' . getBaseUrl());
// ini_set("display_errors", E_ALL);


$_SESSION['matricula'] ='F0285739';
$_SESSION['nome'] = 'Albert Ferreira Rosa';
$_SESSION['cargo'] = 'Analista Tec Pleno';
$_SESSION['MAIL'] = 'albert.rosa@bb.com.br';
$_SESSION['dependencia'] = '1901';
$_SESSION['ip'] = '10.10.10.10';

// if($_SESSION["nome"] == ""){
//     header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=" . getBaseUrl() . "/tom/#login/");
// }


// include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'botGuia', $_SESSION['ip']);

$mudaCssPagina = '';
if((date("Y-m-d")) <= "2024-12-31"){
    $mudaCssPagina = "
        $('#chat-window').css('height', '94vh');
        $('#chat-window').css('top', '3%');
    ";
}
?>

<!DOCTYPE html>

<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tom</title>
        <link href="../lib/img/img_bot/bot.ico" mce_href="../lib/img/img_bot/bot.ico" rel="icon">
        <link href="../lib/img/img_bot/bot.ico" mce_href="../lib/img/img_bot/bot.ico" rel="shortcut icon">

        <!-- jQuery -->
        <script type="text/javascript" src="../lib/js/jquery.3.7.1.js"></script>
        <script type="text/javascript" src="../lib/js/jquery.3.7.1.min.js"></script>
        <script type="text/javascript" src="../lib/js/jquery-ui.1.13.3.js"></script>
        <script type="text/javascript" src="../lib/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../lib/js/bootstrap.bundle.js"></script>
        <script type="text/javascript" src="../lib/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="../lib/js/bootstrap.esm.js"></script>
        <script type="text/javascript" src="../lib/js/bootstrap.esm.min.js"></script>
        <script type="text/javascript" src="../lib/js/bootstrap.js"></script>
        <script type="text/javascript" src="../lib/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="/Utils//modal-feedback/css/modal-feedback.css">
        
        <!-- JS da página -->
        <script type="text/javascript" src="index.js"></script>

        <!-- JS Font Awesome -->
        <script src="../lib/js/fontawesome.js"></script>

        <!-- CSS da página -->
        <link href="index.css" rel="stylesheet">
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v7.0.0/css/all.css"/>
    </head>

    <body style="background-image: url('img/BackgroundTom.png'); background-size: 100%; max-width: 100%; overflow-x: hidden;">
        <main>
            <div id="container" style="width: 100%; height: auto; position: relative;">
                <?php include_once "bot.php"; ?>
            </div>
        </main>
        <script>
            function scrollToSection(sectionId) {
                document.getElementById(sectionId).scrollIntoView({ behavior: 'smooth' });
            }

            let mybutton = document.getElementById("toTop");
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }

            <?php echo $mudaCssPagina; ?>
            
        </script>
    </body>
</html>