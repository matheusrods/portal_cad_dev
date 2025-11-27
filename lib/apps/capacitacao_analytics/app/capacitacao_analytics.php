<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/Utils/Ambiente.php";

    include $_SERVER["DOCUMENT_ROOT"]."/pages/montaCabecalho.php";
    $class = new cabecalho();

    $host = $_SERVER['HTTP_HOST'];
?>
    <style>
        :root {
            --bg-fundo-capacitacao: url('<?= getBaseUrl(); ?>/lib/apps/capacitacao_analytics/img/fundo_pagina.png');
        }
    </style>
    <link rel="stylesheet" href="<?php echo getBaseUrl(); ?>/lib/apps/capacitacao_analytics/css/painel.css">

    <script>
        window.BASE_URL = "<?= getBaseUrl(); ?>";
        window.AMBIENTE = "<?= getAmbiente(); ?>";
    </script>
    
    <!-- JS específico do app -->
    <script type="text/javascript" src="<?php echo getBaseUrl(); ?>/lib/apps/capacitacao_analytics/js/capacitacao_analytics.js"></script>

    <script>
        var host = "<?php echo $_SERVER['HTTP_HOST']?>";
    </script>

    <!-- HERO / BANNER PRINCIPAL -->
    <section class="hero">
        <div class="container hero-container">
            <div class="hero-text">
                <h1>Conheça tudo sobre<br>Inteligência Analítica</h1>
                <p>Agora vou te mostrar um pouco de <strong>como a nossa dependência funciona</strong> e tudo o que você precisa saber nesse primeiro contato!</p>
            </div>
            <div class="hero-image">
                    <img src="<?php echo getBaseUrl(); ?>/lib/apps/capacitacao_analytics/img/robo.png" alt="Robô CAD">
                </div>
            </div>
        </div>
        <div class="tabs">
            <p class="navegue-label">Navegue aqui 👇</p>
            <button class="tab active" data-tab="painel-metricas">1. Painéis &amp; Métricas</button>
            <button class="tab" data-tab="explorando-dados">2. Explorando Dados</button>
            <button class="tab" data-tab="visualizacao-dados">3. Visualização de Dados</button>
            <button class="tab" data-tab="engenharia-dados">4. Engenharia de dados</button>
        </div>
    </section>

    <div id="tab-content"></div>

    
<?php
    include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";
?>


