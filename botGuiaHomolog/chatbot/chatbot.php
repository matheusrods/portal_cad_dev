<?php 
    session_start();
    $nomeUsuario = trim(strtok(ucfirst(strtolower($_SESSION['nome']))," ")); 
?>

<div id="chatbot-container">
    <div id="img-bot-tom" style="max-width: 100%; max-height: 100%;">
        <img src="https://cad.bb.com.br/botGuia/img/logoBotTomSombra.png" style="max-width: 70%; margin-left: 5%;">
    </div>
    <div id="chat-window" class="hidden">
        <div id="chat-header">
            <img src="https://cad.bb.com.br/botGuia/img/gatoTomChat.png" alt="Imagem da mascote Bot ao lado do cabeçalho" style="width: 50px; height: 50px;">
            <h2>Assistente Virtual do CAD - Versão de Testes</h2>
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
            <textarea type="text" id="chat-input"></textarea>
            <button id="send-message">Enviar</button>
        </div>
        <div id="chat-disclaimer">
            <!-- <p>OBS: O assistente virtual do CAD te auxilia na criação de conteúdos para o Bot. Caso sua dúvida não seja resolvida, reformule seu pedido.</p> -->
            <p>OBS: O Assistente Virtual do CAD BB está aqui para auxiliar você na revisão e criação de conteúdos. Ele não armazena o contexto de conversas anteriores. Para solicitar a revisão de um texto, escreva 'Revise o texto: [seu texto aqui]'. Se desejar iniciar uma nova conversa, clique no botão 'Limpar Conversa'.</p>
        </div>
    </div>
</div>