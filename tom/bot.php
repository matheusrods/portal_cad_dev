<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/Utils/Ambiente.php";

    // header('Access-Control-Allow-Origin: ' . getBaseUrl());

    $divLuzesNatal = '';

    if((date("Y-m-d")) <= "2024-12-31"){
        $divLuzesNatal = '<div class="natal" style="background-image: url(' . getBaseUrl() . '/lib/img/cabecalho/natal2.gif); background-repeat: repeat-x; width: 140%; height: 10vh; background-size: 500px; position: absolute; margin: -1rem -5rem;"></div>';
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Minha Página</title> -->
    <link rel="stylesheet" href="chatbot/css/chatbot.css">
    <link rel="stylesheet" href="chatbot/css/modal-chatbot.css">
    <!-- jQuery -->
    <script type="text/javascript" src="../../lib/js/jquery.3.7.1.js"></script>
    <script type="text/javascript" src="../../lib/js/jquery.3.7.1.min.js"></script>
    <script type="text/javascript" src="../../lib/js/jquery-ui.1.13.3.js"></script>
    <script type="text/javascript" src="/Utils/js/toastFeedback.js"></script>
</head>
<body>
    
    <?php echo $divLuzesNatal; ?>
    <div id="chatbot-container-master" style="position: relative; z-index: 5;"></div>

    <script>
        const BASE_URL = "<?= getBaseUrl(); ?>";
        const AMBIENTE = "<?= getAmbiente(); ?>";
    </script>
    
    <script>
        fetch('chatbot/chatbot.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('chatbot-container-master').innerHTML = data;
            })
            .then(() => {
                const script = document.createElement('script');
                script.src = 'chatbot/js/chatbot.js';
                document.body.appendChild(script);
            });
    </script>

    <!-- Modal de Feedback (Dislike) -->
    <div id="modal-feedback" class="modal-feedback hidden">
        <div class="modal-content-feedback">
            <button class="close-modal-feedback">&times;</button>
            <h2>Como podemos melhorar ?</h2>
            <p>Pra melhorar sua experiência, conte porque esta resposta não te ajudou?</p>

            <label for="feedback-text">Comentários adicionais (opcional):</label>
            <textarea id="feedback-text" maxlength="500" placeholder="Descreva o que poderia ser melhor na resposta..."></textarea>
            <div class="char-count">500 caracteres restantes</div>

            <div class="modal-actions">
            <button class="btn-skip">PULAR</button>
            <button class="btn-send">ENVIAR FEEDBACK</button>
            </div>
        </div>
    </div>

</body>
</html>
