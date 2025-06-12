<?php
    header('Access-Control-Allow-Origin: https://cad.bb.com.br');
    session_start();
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
        <!-- <h1>Página do programa de formação</h1> -->

        <div id="chatbot-container-master" style="position: relative; z-index: 5;"></div>
        <script>
            fetch('chatbot.php')
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