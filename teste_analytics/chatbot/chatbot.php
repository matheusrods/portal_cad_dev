<?php 
    session_start();
    $nomeUsuario = trim(strtok(ucfirst(strtolower($_SESSION['nome']))," ")); 
?>

<div id="chatbot-container">
    <!-- <button id="chat-open-button">Chat</button> -->
    <div id="chat-window" class="hidden">
        <div id="chat-header">
            <img src="img/iconeBotCabecalhoChat.png" alt="Imagem da mascote Bot ao lado do cabeçalho" style="width: 50px; height: 50px;">
            <h2>Assistente Virtual do CAD</h2>
            <button id="close-chat">&times;</button>
        </div>
        <div id="chat-content">
            <div id="chat-messages"></div>
            <div class="message bot"><strong>Assistente:</strong> Olá, <?php echo trim(strtok(ucfirst(strtolower($_SESSION['nome']))," ")); ?>! Como posso te ajudar sobre o Programa de Formação?</div>
        </div>
        <div id="chat-input-container">
            <input type="text" id="chat-input" placeholder="Digite sua mensagem...">
            <button id="send-message">Enviar</button>
        </div>
        <div id="chat-disclaimer">
            <p>OBS: O assistente virtual do CAD responde somente perguntas sobre o Programa de Formação e pode cometer erros. Caso sua dúvida não seja resolvida, reformule sua pergunta ou consulte diretamente o regulamento.</p>    
        </div>
    </div>
</div>