<?php 
// conexao pagina
session_start();
$nomeUsuario = trim(strtok(ucfirst(strtolower($_SESSION['nome']))," "));
    // imagem bot
    $caminhoImgCapa = "https://cad.bb.com.br/bot_sql/img/logoBotSql.png";
    $estiloJanelaChat = '';

if($_SESSION["nome"] == ""){
    header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https://cad.bb.com.br/bot_sql/#login/");
}

include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'bot_sql', $_SESSION['ip']);

$mudaCssPagina = '';
if((date("Y-m-d")) <= "2024-12-31"){
    $mudaCssPagina = "
        $('#chat-window').css('height', '94vh');
        $('#chat-window').css('top', '3%');
    ";
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/BotSql.ico">
    <title>Fale Com DADO</title>
        
    <link rel="stylesheet" type="text/css" href="css/chatbot.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sql-formatter/4.0.2/sql-formatter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.14.0/beautify-html.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.14.0/beautify-css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.14.0/beautify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/php.js/1.3.2/php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.14.0/beautify.min.js"></script>

    <!-- jQuery -->
    <script type="text/javascript" src="../../lib/js/jquery.3.7.1.js"></script>
    <script type="text/javascript" src="../../lib/js/jquery.3.7.1.min.js"></script>
    <script type="text/javascript" src="../../lib/js/jquery-ui.1.13.3.js"></script>
</head>
<body style="background: #465EFE repeat center center; overflow-y: hidden">
    <div id="chatbot-container">
        <img src="https://cad.desenv.bb.com.br/bot_sql_v2/img/backgroundDado.png" style="max-width: 100%; max-height: 100%;">
        <div id="chat-window" class="hidden" <?php echo $estiloJanelaChat; ?>>
            <div id="chat-header">
                <img src="https://cad.bb.com.br/bot_sql/img/pLogoBotSql.png" alt="Imagem da mascote Bot ao lado do cabeçalho" style="width: 50px; height: 50px;">
                <h2>Assistente Virtual do CAD</h2>
            </div>
            <div class="message bot"> 
                    Olá, <?php echo trim(strtok(ucfirst(strtolower($_SESSION['nome']))," ")); ?>! Eu sou o Dado, seu assistente virtual que auxilia na criação de códigos do CAD BB. Como posso te ajudar?
            </div>
            <div class="botaoSugestao"> 
            <button class="sugestao">Criar códigos</button>
            <button class="sugestao">O que é SQL</button>
            <button class="sugestao">Quais tabelas você conhece</button>
            <button class="sugestao">Como utilizar</button>
            </div>
            <div class="chat-input-container" > 
                <textarea id="inputField" placeholder="Digite sua mensagem aqui" rows="3"></textarea>
                <div class="button-container">
                    <button id="sendButton" title="Alt + Enter">Enviar</button>
                    <button id="limparButoon" title="Alt + L">Limpar</button>
                </div>
            </div>
            <div id="loadingIndicator" style="display: none;">
                <div class="spinner"></div>
            </div>
            <div class="resposta"> 
                <div id="outputAntes"></div>
                <div class="code-container">
                    <pre id="outputEntre"></pre>
                    <button id="copyButton">Copiar</button>
                </div>
                <div id="outputDepois"></div>
            </div>
            <script src="js/chatbot.js"></script>
            
            <footer>
                <p>OBS: As mensagem são geradas automaticamente por um sistema de inteligência artificial. 
                    <br>O conteúdo apresentado pode não representar a versão final do código e está sujeito a revisões e ajustes. 
                    <br>Recomenda-se sempre validar antes de utilizar.
                </p>
                <a href="https://hue.big.intranet.bb.com.br/hue/editor/?type=hive" target="_blank" title="É recomendado abrir este link em uma aba anônima para melhor funcionamento.">Teste o código SQL aqui! Hue-Hive</a>
            </footer>
            <div class="botao-flutuante">
                <a href="https://banco365-my.sharepoint.com/:v:/g/personal/rgenuino_bb_com_br/Eb980vjNT_dBk2UTVM4gJDEBGgUKzKIOr_oVqHbLdGPV3A" target="_blank">
                <img src="https://cad.bb.com.br/bot_sql/img/videoTutorial.png" alt="Assista ao vídeo" title="Conheça o Dado" style="max-width: 80px;">
                </a>
            </div> 
        </div>
    </div>  
</body>
</html>
