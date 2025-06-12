<?php
// ini_set('display_startup_errors', 1);
session_start();
include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
include $_SERVER["DOCUMENT_ROOT"]."/pages/montaCabecalho.php";

$class = new cabecalho();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <!-- aqui -->
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
</head>

<?php

$cabecalho = $class->montaCabecalho();
$subMenus = $class->montaSubMenus();


?>

<body>

    <header class="header">
        <?php include $_SERVER["DOCUMENT_ROOT"]."/pages/cabecalho.php"; ?>
    </header>
    <div id="submenuCabecalho" attr-id="0">
        <?php echo $subMenus; ?>
    </div>
    <main>
        <div id="container">
            <?php
                include_once $_SERVER["DOCUMENT_ROOT"]."/lib/apps/noticias/app/noticias.php";
            ?>
        </div>
    </main>
</body>