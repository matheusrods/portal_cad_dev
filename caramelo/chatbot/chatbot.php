<?php 
    session_start();
    $nomeUsuario = trim(strtok(ucfirst(strtolower($_SESSION['nome']))," "));

    $caminhoImgCapa = "https://cad.bb.com.br/bot_dev/img/carameloDev.png";
    $estiloJanelaChat = '';

    if((date("Y-m-d")) <= "2024-12-31"){
        $caminhoImgCapa = "https://cad.bb.com.br/bot_dev/img/carameloDevNatal.png";
        $estiloJanelaChat = "style = 'top: 4% !important;'";
    }
?>

<div id="chatbot-container">
    <div id="img-bot-tom" style="max-width: 100%; max-height: 100%;">
        <img src="<?php echo $caminhoImgCapa; ?>" style="max-width: 70%; margin-left: 5%;">
    </div>
    <div id="chat-window" class="hidden" <?php echo $estiloJanelaChat; ?>>
        <div id="chat-header">
            <img src="https://cad.bb.com.br/bot_dev/img/carameloCabecalho.png" alt="Imagem da mascote Caramelo ao lado do cabeçalho" style="width: 50px; height: 50px;">
            <h2>Assistente Virtual do CAD</h2>
            <button id="btnLimparContexto" attr-idConversa="" attr-nomeUsuario="<?php echo $nomeUsuario; ?>">
                Limpar conversa
            </button>
        </div>
        <div id="chat-content">
            <div id="chat-messages"></div>
            <div class="message bot">
                <strong>CarameloDEV:</strong> 
                Olá, <?php echo trim(strtok(ucfirst(strtolower($_SESSION['nome']))," ")); ?>, aqui eu tento ajudar na construção dos bots da escola de robôs.<br><br>
                Pode me perguntar sobre:<br>
                -<b>regras e lógica</b> do Watson Assistant;<br>
                -métodos de linguagem pra <b>tratamento de informações</b> no formato JSON.<br><br>
                Também pode pedir que eu:<br>
                -<b>verifique</b> uma condição de entrada de nó de diálogo;<br>
                -<b>sugira</b> alguma entidade ou intenção pra algum tipo de input.
            </div>
        </div>
        <div id="chat-input-container">
            <textarea type="text" id="chat-input" placeholder="Digite sua mensagem..."></textarea>
            <button id="send-message">Enviar</button>
        </div>
        <!-- <div id="chat-disclaimer">
            <p>OBS: O assistente virtual do CAD te auxilia na criação de conteúdos para o Bot. Caso sua dúvida não seja resolvida, reformule seu pedido.</p>
        </div> -->
    </div>
</div>