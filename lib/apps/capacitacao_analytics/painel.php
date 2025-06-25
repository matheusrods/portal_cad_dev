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
                    <button class="tab active" data-tab="painel-metricas">1. Painéis & Métricas</button>
                    <button class="tab"        data-tab="explorando-dados">2. Explorando Dados</button>
                    <button class="tab"        data-tab="visualizacao-dados">3. Visualização de Dados</button>
                    <button class="tab"        data-tab="engenharia-dados">4. Engenharia de dados</button>
                </div>
            </div>
            <div class="hero-image">
                <img src="img/robo.png" alt="Robô CAD">
            </div>
        </div>
    </section>

    <div id="tab-content"></div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
        const tabs    = document.querySelectorAll('.tabs .tab');
        const content = document.getElementById('tab-content');

        function activateTab(name) {
            // visual
            tabs.forEach(t => t.classList.toggle('active', t.dataset.tab === name));
            // fetch da seção
            const url = `/lib/apps/capacitacao_analytics/sections/${name}.php`;
            fetch(url)
            .then(r => {
                if(!r.ok) throw new Error(`Falha ao carregar ${url}`);
                return r.text();
            })
            .then(html => content.innerHTML = html)
            .catch(e => content.innerHTML = `<p class="error">${e.message}</p>`);
        }

        // clique nas tabs originais
        tabs.forEach(btn =>
            btn.addEventListener('click', () => {
            activateTab(btn.dataset.tab);
            // sincroniza hash no URL
            history.replaceState(null, '', `#${btn.dataset.tab}`);
            })
        );

        // quando a hash muda (exemplo: clicou no link “Próximo Módulo”)
        window.addEventListener('hashchange', () => {
            const name = location.hash.slice(1);
            if(name) activateTab(name);
        });

        // inicialização: se tiver hash use ela, senão use a aba que já vem com .active
        const initial = location.hash.slice(1) ||
                        document.querySelector('.tabs .tab.active').dataset.tab;
        activateTab(initial);
        });
    </script>

</body>
</html>


    <?php
        include_once $_SERVER["DOCUMENT_ROOT"]."/pages/rodape.php";
    ?>
</body>
</html>