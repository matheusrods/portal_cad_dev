<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/Utils/Ambiente.php";
$nomeUsuario = trim(strtok(ucfirst(strtolower($_SESSION['nome'])), " "));

$baseUrl = getBaseUrl();
$background = $baseUrl . "/caramelo_v2/img/backgroundCar.png";
$imgCabecalho = $baseUrl . "/caramelo_v2/img/carameloTitulo.png";
$estiloImgCabecalho = 'style="width: 50px; height: 50px;"';
$caminhoImgCapa = $baseUrl . "/bot_dev/img/carameloDev.png";
$estiloJanelaChat = '';

if ((date("Y-m-d")) <= "2024-12-31") {
    $background = $baseUrl . "/caramelo_v2/img/backgroundCarNatal.png";
    $imgCabecalho = $baseUrl . "/caramelo_v2/img/carameloTituloNatal.png";
    $estiloImgCabecalho = 'style="width: 50px; height: 60px;"';
    $caminhoImgCapa = $baseUrl . "/bot_dev/img/carameloDevNatal.png";
    $estiloJanelaChat = "style = 'top: 4% !important;'";
}
?>

<div id="chatbot-container">
    <img src="<?php echo $background; ?>" style="width: 100%">
    <div id="chat-window" class="hidden" <?php echo $estiloJanelaChat; ?>>
        <div id="chat-header">
            <img src="<?php echo $imgCabecalho; ?>"
                 alt="Imagem da mascote Caramelo ao lado do cabeçalho" <?php echo $estiloImgCabecalho; ?> >
            <h2>Assistente Virtual do CAD</h2>
            <button id="btnFeedback" class="btn-feedback">Deixe seu feedback ✨</button>
            <button id="btnLimparContexto" attr-idConversa="" attr-nomeUsuario="<?php echo $nomeUsuario; ?>">Limpar
                conversa
            </button>
        </div>
        <div id="chat-content">
            <div id="chat-messages"></div>
            <div class="message bot">
                <strong>CarameloDEV:</strong>
                Olá, <?php echo trim(strtok(ucfirst(strtolower($_SESSION['nome'])), " ")); ?>, aqui eu tento ajudar na
                construção dos bots da escola de robôs.<br><br>
                Pode me perguntar sobre:<br>
                -<b>regras e lógica</b> do Watson Assistant;<br>
                -métodos de linguagem pra <b>tratamento de informações</b> no formato JSON.<br><br>
                Também pode pedir que eu:<br>
                -<b>verifique</b> uma condição de entrada de nó de diálogo;<br>
                -<b>sugira</b> alguma entidade ou intenção pra algum tipo de input.
            </div>
        </div>
        <div class="botaoSugestao">
            <button class="sugestao">Revisar condição de entrada</button>
            <button class="sugestao">Explicar erro</button>
            <button class="sugestao">Revisar código</button>
            <button class="sugestao">Como utilizar</button>
            <button class="sugestao">Como construir uma mensagem ativa</button>
        </div>
        <div id="chat-input-container">
            <div class="input" style="width: 100%; display: inline-flex; flex-direction: column">
                <textarea type="text" id="chat-input" placeholder="Digite sua mensagem..."></textarea>
                <div class="botaoEnviar">
                    <button id="send-message"><span>Enviar</span><img
                                src="<?php echo $baseUrl; ?>/tom_v2/img/iconeButton.png"></button>
                </div>
            </div>
        </div>
        <div id="chat-disclaimer">
            <p id="contadorInputCaramelo">2000 caracteres restantes</P>
        </div>
    </div>
</div>