<?php
    header('Access-Control-Allow-Origin: https://cad.bb.com.br');

    $divLuzesNatal = '';

    if((date("Y-m-d")) <= "2024-12-31"){
        $divLuzesNatal = '<div class="natal" style="background-image: url(https://cad.bb.com.br/lib/img/cabecalho/natal2.gif); background-repeat: repeat-x; width: 140%; height: 10vh; background-size: 500px; position: absolute; margin: -1rem -5rem;"></div>';
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Minha Página</title> -->
    <link rel="stylesheet" href="chatbot/css/chatbot.css">
    <!-- jQuery -->
    <script type="text/javascript" src="../../lib/js/jquery.3.7.1.js"></script>
    <script type="text/javascript" src="../../lib/js/jquery.3.7.1.min.js"></script>
    <script type="text/javascript" src="../../lib/js/jquery-ui.1.13.3.js"></script>
</head>
<body>
    
    <?php echo $divLuzesNatal; ?>
    <div id="chatbot-container-master" style="position: relative; z-index: 5;"></div>
    
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
</body>
</html>
