<?php
// header('Access-Control-Allow-Origin: https://cad.bb.com.br');
// ini_set("display_errors", E_ALL);
session_start();

if($_SESSION["nome"] == ""){
    header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https://cad.bb.com.br/bot_dev/#login/");
}


include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'bot_dev', $_SESSION['ip']);

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
        <title>Chatbot Dev</title>

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
        
        <!-- JS da página -->
        <script type="text/javascript" src="index.js"></script>

        <!-- CSS da página -->
        <link href="index.css" rel="stylesheet">
    </head>

    <body style="background: #465EFE repeat center center; background-image: url('img/fundo fullzap.png'); background-size: 100%; max-width: 100%; overflow-x: hidden;">
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