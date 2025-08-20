<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

    include $_SERVER["DOCUMENT_ROOT"]."/pages/montaCabecalho.php";
    $class = new cabecalho();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel & Métricas – CAD</title>
    <!-- Fonte sugerida (opcional) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- CSS principal da página -->
    <link rel="stylesheet" href="css/painel.css">

    <link href="../lib/img/img_bot/bot.ico" mce_href="../lib/img/img_bot/bot.ico" rel="icon">
    <link href="../lib/img/img_bot/bot.ico" mce_href="../lib/img/img_bot/bot.ico" rel="shortcut icon">

    <!-- CSS Bootstrap -->
    <link href="/lib/css/bootstrap-grid.css" rel="stylesheet">
    <link href="/lib/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="/lib/css/bootstrap-grid.rtl.css" rel="stylesheet">
    <link href="/lib/css/bootstrap-grid.rtl.min.css" rel="stylesheet">
    <link href="/lib/css/bootstrap-reboot.css" rel="stylesheet">
    <link href="/lib/css/bootstrap-reboot.min.css" rel="stylesheet">
    <link href="/lib/css/bootstrap-reboot.rtl.css" rel="stylesheet">
    <link href="/lib/css/bootstrap-reboot.rtl.min.css" rel="stylesheet">
    <link href="/lib/css/bootstrap-utilities.css" rel="stylesheet">
    <link href="/lib/css/bootstrap-utilities.min.css" rel="stylesheet">
    <link href="/lib/css/bootstrap-utilities.rtl.css" rel="stylesheet">
    <link href="/lib/css/bootstrap-utilities.rtl.min.css" rel="stylesheet">
    <link href="/lib/css/bootstrap.css" rel="stylesheet">
    <link href="/lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="/lib/css/bootstrap.rtl.css" rel="stylesheet">
    <link href="/lib/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- CSS Datatables -->
    <link href="/lib/datatables/datatables.min.css" rel="stylesheet">

    <!-- CSS da página -->
    <!-- <link href="/lib/apps/home/css/home.css" rel="stylesheet"> -->
    <link href="/lib/css/index.css" rel="stylesheet">

    <!-- jQuery -->
    <script type="text/javascript" src="/lib/js/jquery.3.7.1.js"></script>
    <script type="text/javascript" src="/lib/js/jquery.3.7.1.min.js"></script>
    <script type="text/javascript" src="/lib/js/jquery-ui.1.13.3.js"></script>
    <script type="text/javascript" src="/lib/js/datepicker-pt-BR.js"></script>
    

    <!-- CSS Jquery Datepicker-->
    <link href="/lib/css/jquery-ui.css" rel="stylesheet">
    
    <!-- JS Bootstrap -->
    <script src="/lib/js/bootstrap.bundle.min.js"></script>
    <script src="/lib/js/bootstrap.bundle.js"></script>
    <script src="/lib/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="/lib/js/bootstrap.esm.js"></script>
    <script src="/lib/js/bootstrap.esm.min.js"></script> -->
    <script src="/lib/js/bootstrap.js"></script>
    <script src="/lib/js/bootstrap.min.js"></script>

    <!-- JS Font Awesome -->
    <script src="/lib/js/fontawesome.js"></script>

    <!-- JS Bootbox -->
    <script src="/lib/js/bootbox.all.min.js"></script>

    <!-- JS Datatables -->
    <script type="text/javascript" src="/lib/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="/lib/datatables/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="/lib/datatables/pdfmake.min.js"></script>
    <script type="text/javascript" src="/lib/datatables/buttons.html5.min.js"></script>

    <!-- JS do Portal -->
    <script type="text/javascript" src="/lib/js/index.js"></script>
    <!-- <script type="text/javascript" src="/lib/apps/home/js/home.js"></script> -->
</head>
<body>

    <header class="header">
        <?php include $_SERVER["DOCUMENT_ROOT"]."/pages/cabecalho.php"; ?>
    </header>

    <!-- HERO / BANNER PRINCIPAL -->
    <section class="hero">
        <div class="container hero-container">
            <div class="hero-text">
                <h1>Conheça tudo sobre<br>Inteligência Analítica</h1>
                <p>Agora vou te mostrar um pouco de <strong>como a nossa dependência funciona</strong> e tudo o que você precisa saber nesse primeiro contato!</p>
                <p class="navegue-label">Navegue aqui 👇</p>
                <div class="tabs">
                    <button class="tab active">1. Painéis & Métricas</button>
                    <button class="tab">2. Explorando Dados</button>
                    <button class="tab">3. Visualização de Dados</button>
                    <button class="tab">4. Engenharia de dados</button>
                </div>
            </div>
            <div class="hero-image">
                <img src="<?php echo $_SERVER["http_host"].'/lib/apps/capacitacao_analytics/';?>img/robo.png" alt="Robô CAD">
            </div>
        </div>
    </section>

    <!-- SESSÃO: CONCEITOS BÁSICOS -->
    <section class="section conceitos">
        <!-- Tornamos todo o “container” relativo para posicionar elementos absolutos dentro dele -->
        <div class="container conceitos-wrapper">
            <!-- Título e texto -->
            <h2>Conceitos Básicos</h2>
            <p>
            Nessa sessão você vai encontrar conceitos básicos sobre canais de atendimento,
            usuário, input, interação, conversa, nó/hash, feedback e timeout/abandono e
            os painéis mais usados na Análise dos dados
            </p>

            <!-- IMAGEM 3D: Gráfico (à esquerda do vídeo) -->
            <div class="icon-chart">
            <!-- <img src="img/grafico.png" alt="Ícone Gráfico 3D"> -->
            <img src="<?php echo $_SERVER["http_host"].'/lib/apps/capacitacao_analytics/';?>img/grafico.png" alt="Ícone Gráfico 3D">
            </div>

            <!-- IMAGEM 3D: Foguete (à direita do vídeo) -->
            <div class="icon-rocket">
            <!-- <img src="img/icone-rocket.png" alt="Ícone Foguete"> -->
            <img src="<?php echo $_SERVER["http_host"].'/lib/apps/capacitacao_analytics/';?>img/icone-rocket.png" alt="Ícone Foguete">
            </div>

            <!-- VÍDEO -->
            <div class="video-card">
            <div class="video-wrapper">
                <video controls poster="img/thumbnail-padrao.png">
                <source src="" type="video/mp4">
                Seu navegador não suporta a tag de vídeo.
                </video>
                <div class="play-overlay">
                <svg viewBox="0 0 100 100">
                    <polygon points="40,30 70,50 40,70" fill="#fff"/>
                </svg>
                </div>
            </div>
            </div>

            <!-- ======================================
            GLOSSÁRIO – HTML ATUALIZADO
            ====================================== -->
            <div class="glossario-box">
                <input type="checkbox" id="toggle-glossario" hidden>
                <label for="toggle-glossario" class="glossario-header">
                    <span>Glossário</span>
                    <svg class="icon-arrow" …>…</svg>
                </label>
                <div class="glossario-content">
                    <dl class="col-esquerda">…</dl>
                    <dl class="col-direita">…</dl>
                </div>
            </div>
        </div>
    </section>


    <!-- SESSÃO: PRINCIPAIS MÉTRICAS -->
    <section class="section metricas">
        <div class="container">
            <h2>Principais Métricas</h2>
            <p>É muito importante entender os dados e transformá-los em informação, para isso nosso equipe de dados utiliza o Power BI e o Spotfire para criar os painéis. Vamos encontrar painéis para custos, qualidade, evolução do Chat, acompanhamento de acesso, panel de finanças, etc. para negociação e muito mais.</p>
            <!-- GLOSSÁRIO EXPANDÍVEL ADICIONAL (se necessário) -->
            <div class="glossario-box small">
                <input type="checkbox" id="toggle-glossario-2" hidden>
                <label for="toggle-glossario-2" class="glossario-header">
                    <span>Glossário</span>
                    <svg class="icon-arrow" viewBox="0 0 24 24">
                        <path d="M7 10l5 5 5-5H7z" fill="#fff"/>
                    </svg>
                </label>
                <div class="glossario-content">
                    <!-- Se quiser repetir ou adicionar termos, basta copiar o <dl> -->
                    <p>Aqui você pode colocar qualquer definição extra de termos relacionados às métricas.</p>
                </div>
            </div>

            <p class="subtitulo-grid">Abaixo vamos conhecer os painéis e suas métricas:</p>

            <!-- GRID DE THUMBNAILS COM PLAY -->
            <div class="grid-cards">
                <?php 
                    // Exemplo estático; caso queira popular dinamicamente, basta iterar PHP/BD:
                    $cards = [
                        "Quantidade de acessos WA",
                        "Quantidade de usuários WA",
                        "Análise Timeout",
                        "Feedback",
                        "Negociações"
                    ];
                    foreach ($cards as $titulo): 
                ?>
                <div class="card-painel">
                    <div class="thumb-wrapper">
                        <!-- <img src="img/thumb_paineis.png" alt="<?= $titulo ?>">     -->
                        <img src="https://<?php echo $_SERVER["http_host"].'/lib/apps/capacitacao_analytics/';?>img/thumb_paineis.png" alt="<?= $titulo ?>">
                        
                        <div class="play-icon">
                            <svg viewBox="0 0 100 100">
                                <polygon points="40,30 70,50 40,70" fill="#fff"/>
                            </svg>
                        </div>
                    </div>
                    <p class="card-title"><?= $titulo ?></p>
                </div>
                <?php endforeach; ?>
                <!-- ÍCONE DECORATIVO (gráfico 3D) -->
                <div class="card-icon-decorativo">
                    <!-- <img src="img/icone-grafico-3d.png" alt="Gráfico 3D"> -->
                    <img src="<?php echo $_SERVER["http_host"].'/lib/apps/capacitacao_analytics/';?>img/icone-grafico-3d.png" alt="Gráfico 3D">
                    
                </div>
            </div>
        </div>
    </section>

    <!-- SESSÃO: RECURSOS -->
    <section class="section recursos">
        <div class="container">
            <h2>Recursos</h2>
            <p>Aqui você vai encontrar todos os painéis vistos nesse módulo.</p>
            <div class="grid-recursos">
                <?php 
                    // Exemplo estático; se tiver URLs reais, acrescente href:
                    $recursos = [
                        "Quantidade de acessos WA",
                        "Quantidade de usuários WA",
                        "Análise Timeout",
                        "Feedback",
                        "Negociações",
                        "Todos os Painéis"
                    ];
                    foreach ($recursos as $nome): 
                ?>
                <div class="card-recurso">
                    <div class="recurso-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2zm7 14l4-4H8l4 4zm0-6l-4 4h8l-4-4z" fill="#fff"/>
                        </svg>
                    </div>
                    <p class="recurso-title"><?= $nome ?></p>
                    <a href="#" class="btn-acessar">ACESSAR</a>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- BOTÃO PARA O PRÓXIMO MÓDULO -->
            <div class="proximo-modulo">
                <a href="#" class="btn-proximo">
                    Ir para o Próximo Módulo<br>
                    <span>Explorando Dados</span>
                    <svg viewBox="0 0 24 24" class="icon-arrow-next">
                        <path d="M8 5l7 7-7 7" stroke="#fff" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <?php
        // Se você tiver um footer global, pode incluí-lo aqui. Senão, pule esta linha:
        include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";
    ?>
</body>
</html>
