<head>
    <meta charset="UTF-8">
    <meta name="viewport">

    <title>Portal CAD</title>

    <!-- CSS Bootstrap -->
    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Datatables -->
    <link href="../lib/datatables/datatables.min.css" rel="stylesheet">

    <!-- CSS da página -->
    <link href="../lib/css/index.css" rel="stylesheet">

    <!-- jQuery -->
    <script type="text/javascript" src="../lib/js/jquery.3.7.1.js"></script>
    <script type="text/javascript" src="../lib/js/jquery.3.7.1.min.js"></script>
    
    <!-- JS Bootstrap -->
    <script src="../lib/js/bootstrap.bundle.min.js"></script>

    <!-- JS Bootbox -->
    <script src="../lib/js/bootbox.all.min.js"></script>

    <!-- JS Datatables -->
    <script type="text/javascript" src="../lib/datatables/datatables.min.js"></script>
    

</head>

<?php
$nome = $_SESSION['nome'];

$nomeArray = explode(' ', $nome);
$primeiroNome = strtolower($nomeArray[0]);
$primeiroNomeTratado = ucfirst($primeiroNome);

?>

<body style="background-color:#002D4B;">
    <div class="divExterna">
        <div class="divInterna">
            <!-- <img src="/lib/img/pagina_construcao.png" alt="Página em Construção" class="imagem"> -->
            <img src="../lib/img/img_bot/<?php echo(rand(1,12)); ?>.png" alt="Página em Construção" class="imagem">
            <span style="font-family: BancoDoBrasilTitulos; font-weight: bold; font-size: 35px; color:white;">Olá, <?php echo $primeiroNomeTratado ?>!</span><br>
            <span style="font-family: BancoDoBrasilTitulos; font-weight: bold; font-size: 35px; color:white;">Aguarde, página em construção!</span><br>
            <?php
                // if($mat == 'F0285739'){
                //     echo '<span style="font-family: BancoDoBrasilTitulos; font-weight: bold; font-size: 35px; color:white;">Mas olha só, <a href="https://cad.bb.com.br/pages/home.php">clique aqui</a> para dar uma espiada no que já temos pronto!</span>';
                // }
            ?>
        </div>
    </div>
</body>