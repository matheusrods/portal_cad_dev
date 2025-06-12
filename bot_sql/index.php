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
    <link rel="icon" type="image/x-icon" href="themes/interno/images/favicon-bb-32x32.png">
    <link rel="shortcut icon" type="image/x-icon" href="themes/interno/images/favicon-bb-32x32.png">
    <title>Fale Com DADO</title>
        
    <link rel="stylesheet" type="text/css" href="css/chatbot.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sql-formatter/4.0.2/sql-formatter.min.js"></script>

    <!-- jQuery -->
    <script type="text/javascript" src="../../lib/js/jquery.3.7.1.js"></script>
    <script type="text/javascript" src="../../lib/js/jquery.3.7.1.min.js"></script>
    <script type="text/javascript" src="../../lib/js/jquery-ui.1.13.3.js"></script>
</head>
<body>
    <div id="chatbot-container">
        <div id="img-bot-sql" style="max-width: 100%; max-height: 100%;">
            <img src="<?php echo $caminhoImgCapa; ?>" style="max-width: 40%; margin-left: 2%;">
        </div>
        <div id="chat-window" class="hidden" <?php echo $estiloJanelaChat; ?>>
            <div id="chat-header">
                <img src="https://cad.bb.com.br/bot_sql/img/pLogoBotSql.png" alt="Imagem da mascote Bot ao lado do cabeçalho" style="width: 50px; height: 50px;">
                <h2>Assistente Virtual do CAD</h2>
            </div>
            <div class="message bot"> 
                    Olá, <?php echo trim(strtok(ucfirst(strtolower($_SESSION['nome']))," ")); ?>! Eu sou o Dado, seu assistente virtual que auxilia na criação de códigos do CAD BB. Como posso te ajudar?
            </div>
            <div class="chat-input-container" > 
                <textarea id="inputField" placeholder="Digite sua mensagem aqui" rows="3"></textarea>
                <div class="button-container">
                    <button id="sendButton">Enviar</button>
                    <button id="limparButoon">Limpar</button>
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
                <a href="https://hue.big.intranet.bb.com.br/" target="_blank" title="É recomendado abrir este link em uma aba anônima para melhor funcionamento.">Teste o código SQL aqui! Hue-Hive</a>
            </footer>

        </div>
    </div>   
</body>
</html>
