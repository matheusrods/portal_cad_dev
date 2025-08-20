<?php 
    session_start();
    $nomeUsuario = trim(strtok(ucfirst(strtolower($_SESSION['nome']))," "));

    $caminhoImgCapa = "https://cad.desenv.bb.com.br/tom_v2/img/logoBotTomSombra.png";
    $estiloJanelaChat = '';

    if((date("Y-m-d")) <= "2024-12-31"){
        $caminhoImgCapa = "https://cad.desenv.bb.com.br/tom/img/tomNatal.png";
        $estiloJanelaChat = "style = 'height: 94vh !important; top: 4% !important;'";
    }
?>

<div id="chatbot-container">
    <img src="https://cad.desenv.bb.com.br/tom_v2/img/BackgroundTom.png" alt="Imagem da mascote Bot ao lado do cabeçalho">
    
    <div id="chat-window" class="hidden" <?php echo $estiloJanelaChat; ?>>
        <div id="chat-header">
            <img src="https://cad.desenv.bb.com.br/tom/img/gatoTomChat.png" alt="Imagem da mascote Bot ao lado do cabeçalho" style="width: 50px; height: 50px;">
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
        <div class="botaoSugestao"> 
            <button class="sugestao">Resumir texto</button>
            <button class="sugestao">Criar texto</button>
            <button class="sugestao">Revisar texto</button>
            <button class="sugestao">Criar Jornada</button>
        </div>                         
        <div id="chat-input-container">
            <div class="input" style="width: 100%; display: inline-flex">                    
                <textarea type="text" id="chat-input" placeholder="Digite sua mensagem..." attr-conteudoTexto="0"></textarea>                    
                <div class ="botaoAnexarEnviar">    
                    <button class="anexarArquivo"><img src="https://cad.desenv.bb.com.br/tom_v2/img/monotone.png"> Anexar</button>       
                    <input type="file" id="file-input" accept=".jpg, .jpeg, .png, .gif" attr-conteudoImagem="0"/>
                    <img id="preview" src="/lib/apps/estudosPesquisas/arquivos/capaPreview.png" alt="Preview da capa" style="display: none ;max-width: 8rem;min-width: 8rem;max-height: 4.5rem;margin: -1rem 0 0 -32rem; background-color: black;">
                    <button id="send-message"><span>Enviar</span><img src="https://cad.desenv.bb.com.br/tom_v2/img/iconeButton.png"></button>
                </div>
            </div>
        </div>
        
        <div id="chat-disclaimer">
            <p id="contadorInputTom">2000 caracteres restantes</P>
            <p id="pDisclaimerTom">OBS: O assistente virtual do CAD te auxilia na criação de conteúdos para o Bot. Caso sua dúvida não seja resolvida, reformule seu pedido.</p>
        </div>
    </div>
</div>