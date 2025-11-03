<?php 
    // ini_set("display_errors", E_ALL);
    session_start();

    require_once '../controller.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . "/Utils/Ambiente.php";

    $class = New funcoes();
    $idConversa = $class->consultaIdConversa();

    $nomeUsuario = trim(strtok(ucfirst(strtolower($_SESSION['nome']))," "));

    $caminhoImgCapa = "' . getBaseUrl() . '/tom/img/logoBotTomSombra.png";
    $estiloJanelaChat = '';

    if((date("Y-m-d")) <= "2024-12-31"){
        $caminhoImgCapa = "' . getBaseUrl() . '/tom/img/tomNatal.png";
        $estiloJanelaChat = "style = 'height: 94vh !important; top: 4% !important;'";
    }
?>

<div id="chatbot-container">
    <!-- <img src="<?php //echo getBaseUrl(); ?>/tom/img/BackgroundTom.png" alt="Imagem da mascote Bot ao lado do cabeçalho"> -->
    
    <div id="chat-window" class="hidden" <?php echo $estiloJanelaChat; ?>>
        <div id="chat-header">
            <img src="<?php echo getBaseUrl(); ?>/tom/img/gatoTomChat.png" alt="Imagem da mascote Bot ao lado do cabeçalho" style="width: 50px; height: 50px;">
            <h2>Assistente Virtual do CAD</h2>
            <button id="btnLimparContexto" attr-idConversa="<?php echo $idConversa;?>" attr-nomeUsuario="<?php echo $nomeUsuario; ?>">
                Deixe seu feedback 🌟
            </button>
            <button id="btnLimparContexto" attr-idConversa="<?php echo $idConversa;?>" attr-nomeUsuario="<?php echo $nomeUsuario; ?>">
                Limpar conversa
            </button>
        </div>
        <div id="chat-content">
            <div id="chat-messages"></div>
            <div class="message bot">
                <strong></strong> 
                Olá, <?php echo trim(strtok(ucfirst(strtolower($_SESSION['nome']))," ")); ?>! Eu sou o Tom, seu assistente virtual revisor e criador de textos do CAD BB. Como posso te ajudar?
            </div>                             
        </div>
        <div id="chat-windowInferior">
            <div class="botaoSugestao"> 
                <button class="sugestao">Resumir texto</button>
                <button class="sugestao">Criar texto</button>
                <button class="sugestao">Revisar texto</button>
                <button class="sugestao">Criar Jornada</button>
            </div>                         
            <div id="chat-input-container">
                <div class="input" style="width: 100%; display: inline-flex">                    
                    <textarea type="text" id="chat-input" style="min-height: 88px !important;" placeholder="Digite sua mensagem..." attr-conteudoTexto="0"></textarea>                    
                    <div class ="botaoAnexarEnviar">    
                        <button class="anexarArquivo"><img src="<?php echo getBaseUrl(); ?>/tom/img/monotone.png"> Anexar</button>       
                        <input type="file" id="file-input" accept=".jpg, .jpeg, .png, .gif" attr-conteudoImagem="0"/>
                        <img id="preview" src="/lib/apps/estudosPesquisas/arquivos/capaPreview.png" alt="Preview da capa">
                        <button id="send-message"><span>Enviar</span><img src="<?php echo getBaseUrl(); ?>/tom/img/iconeButton.png"></button>
                    </div>
                </div>
            </div>
            
            <div id="chat-disclaimer">
                <p id="contadorInputTom">2000 caracteres restantes</P>
                <p id="pDisclaimerTom">OBS: O Tom é um assistente virtual do CAD BB (Centro de Assistentes Digitais). Ele está aqui pra te ajudar na revisão e criação de conteúdos para o WhatsApp BB. Caso sua dúvida não seja resolvida, reformule seu pedido.</p>
            </div>
        </div>
    </div>
</div>