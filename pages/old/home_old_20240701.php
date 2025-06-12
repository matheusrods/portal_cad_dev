<?php

// ini_set('display_errors', 1);

if($_SESSION['matricula'] == 'F0285739'){
    include $_SERVER["DOCUMENT_ROOT"]."/pages/montaCabecalhoNovo.php";
} else {
    include $_SERVER["DOCUMENT_ROOT"]."/pages/montaCabecalho.php";
}

$class = new cabecalho();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <meta name="description" content="Central de Atendimento Digital Banco do Brasil"/>

    <title>Portal CAD</title>
    <link href="../lib/img/img_bot/bot.ico" mce_href="../lib/img/img_bot/bot.ico" rel="icon">
    <link href="../lib/img/img_bot/bot.ico" mce_href="../lib/img/img_bot/bot.ico" rel="shortcut icon">

    <!-- CSS Bootstrap -->
    <link href="../lib/css/bootstrap-grid.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-grid.rtl.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-grid.rtl.min.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-reboot.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-reboot.min.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-reboot.rtl.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-reboot.rtl.min.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-utilities.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-utilities.min.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-utilities.rtl.css" rel="stylesheet">
    <link href="../lib/css/bootstrap-utilities.rtl.min.css" rel="stylesheet">
    <link href="../lib/css/bootstrap.css" rel="stylesheet">
    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/css/bootstrap.rtl.css" rel="stylesheet">
    <link href="../lib/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- CSS Datatables -->
    <link href="../lib/datatables/datatables.min.css" rel="stylesheet">

    <!-- CSS da página -->
    <link href="../lib/css/index.css" rel="stylesheet">

    <!-- jQuery -->
    <script type="text/javascript" src="../lib/js/jquery.3.7.1.js"></script>
    <script type="text/javascript" src="../lib/js/jquery.3.7.1.min.js"></script>
    <script type="text/javascript" src="../lib/js/jquery-ui.1.13.3.js"></script>
    <script type="text/javascript" src="../lib/js/datepicker-pt-BR.js"></script>
    

    <!-- CSS Jquery Datepicker-->
    <link href="../lib/css/jquery-ui.css" rel="stylesheet">
    
    <!-- JS Bootstrap -->
    <script src="../lib/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/js/bootstrap.bundle.js"></script>
    <script src="../lib/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/js/bootstrap.esm.js"></script>
    <script src="../lib/js/bootstrap.esm.min.js"></script>
    <script src="../lib/js/bootstrap.js"></script>
    <script src="../lib/js/bootstrap.min.js"></script>

    <!-- JS Font Awesome -->
    <script src="../lib/js/fontawesome.js"></script>

    <!-- JS Bootbox -->
    <script src="../lib/js/bootbox.all.min.js"></script>

    <!-- JS Datatables -->
    <script type="text/javascript" src="../lib/datatables/datatables.min.js"></script>

    <!-- JS da Intranet -->
    <script type="text/javascript" src="../lib/js/index.js"></script>
    
    <!-- <script type="text/javascript">
        window.onload = function() {
            $('html,body').animate({
                scrollTop: 0
            }, 1250);
        }
    </script> -->
</head>

<?php

$cabecalho = $class->montaCabecalho();
$subMenus = $class->montaSubMenus();


?>

<body style="display:flex;">

    <header class="header">
        <div id="logoHome" >
            <a class="botaoHome" href="https://cad.bb.com.br/">
                <img src="/lib/img/img_bot/2.png" style="height: auto; width: 7rem; padding-bottom: 0.5rem;">
                <span class="textoPortalDoCad">Portal do CAD</span>
            </a>
        </div>
        <div id="menuHeader">
            <!-- <div id="navCabecalho"> -->
                <?php echo $cabecalho;?>
            <!-- </div> -->
        </div>
        <div id="perfilHeader">
            <a class="botaoPerfil" href="https://humanograma.intranet.bb.com.br/<?php echo $_SESSION["matricula"];?>" target="_blank" title="Humanograma">
                <img class="fotoPerfil" src="https://humanograma.intranet.bb.com.br/avatar/<?php echo $_SESSION["matricula"];?>">
            </a>
        </div>
    </header>
    <div id="submenuCabecalho" attr-id="0">
        <?php echo $subMenus; ?>
    </div>
    <main>
        <div id="container">
            <?php
                include_once $_SERVER["DOCUMENT_ROOT"]."/lib/apps/quemSomos/app/quemSomos.php";
            ?>
        </div>
    </main>
</body>