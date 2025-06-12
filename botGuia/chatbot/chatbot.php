<?php 
    session_start();
    $nomeUsuario = trim(strtok(ucfirst(strtolower($_SESSION['nome']))," "));

    $caminhoImgCapa = "https://cad.bb.com.br/botGuia/img/logoBotTomSombra.png";
    $estiloJanelaChat = '';

    if((date("Y-m-d")) <= "2024-12-31"){
        $caminhoImgCapa = "https://cad.bb.com.br/botGuia/img/tomNatal.png";
        $estiloJanelaChat = "style = 'height: 94vh !important; top: 4% !important;'";
    }
?>

<div id="chatbot-container">
    <div id="img-bot-tom" style="max-width: 100%; max-height: 100%;">
        <img src="<?php echo $caminhoImgCapa; ?>" style="max-width: 70%; margin-left: 5%;">
    </div>
    <div id="chat-window" class="hidden" <?php echo $estiloJanelaChat; ?>>
        <div id="chat-header">
            <img src="https://cad.bb.com.br/botGuia/img/gatoTomChat.png" alt="Imagem da mascote Bot ao lado do cabeçalho" style="width: 50px; height: 50px;">
            <h2>Assistente Virtual do CAD</h2>
            <button id="btnLimparContexto" attr-idConversa="" attr-nomeUsuario="<?php echo $nomeUsuario; ?>">
                Limpar conversa
            </button>
        </div>
        <div id="chat-content">
            <div id="chat-messages"></div>
            <div class="message bot">
                <strong>Assistente:</strong> 
                Olá, <?php echo trim(strtok(ucfirst(strtolower($_SESSION['nome']))," ")); ?>! Eu sou o Tom, seu assistente virtual revisor e criador de textos do CAD BB. Como posso te ajudar?
            </div>
        </div>
        <div id="chat-input-container">
            <textarea type="text" id="chat-input" placeholder="Digite sua mensagem..."></textarea>
            <button id="send-message">Enviar</button>
        </div>
        <div id="chat-disclaimer">
            <p>OBS: O assistente virtual do CAD te auxilia na criação de conteúdos para o Bot. Caso sua dúvida não seja resolvida, reformule seu pedido.</p>
        </div>
    </div>
</div>