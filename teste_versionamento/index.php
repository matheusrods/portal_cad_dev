<?php

session_start();

if($_SESSION["nome"] == ""){
    header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https://cad.bb.com.br/teste_versionamento/#login/");
}

include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Teste Versionamento', $_SESSION['ip']);


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testes Automatizados de Versionamento</title>
    <link href="../lib/img/img_bot/bot.ico" mce_href="../lib/img/img_bot/bot.ico" rel="icon">
    <link href="../lib/img/img_bot/bot.ico" mce_href="../lib/img/img_bot/bot.ico" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    
    <!-- JS da página -->
    <script type="text/javascript" src="index.js"></script>

    <!-- CSS da página -->
    <link href="index.css" rel="stylesheet">
</head>
<body>
<h1 style="text-align: center;">
  <img src="/lib/img/cabecalho/imgCabecalho.svg" style="height: auto; width: 7rem; display: block; margin: 0 auto; padding-bottom: 0.5rem;">
  <span>Testes Automatizados de Versionamento</span>
</h1>

    <div id="mensagem-temporaria" style="display: none; background-color: #28a745; color: white; padding: 10px; border-radius: 5px; position: fixed; top: 20px; right: 20px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
        Teste finalizado com sucesso!
    </div>
    <div id="input-section">
        <label for="tx-type">Escolha o tipo de resposta para comparar:</label>
        <select id="tx-type">
            <option value="tx_padrao">Padrão</option>
            <option value="tx_whatsapp">WhatsApp</option>
        </select>
        <p>Caso necessário, inclua inputs adicionais ao teste padrão:</p>
        <input type="text" id="custom-inputs" placeholder="Digite os inputs separados por ;">
        <button id="analyze-button" onclick="compararResultados()">Avaliar Nova Candidata</button>
    </div>
    <div id="analysis-result">
        <h2>Resultado da Análise</h2>
        <p id="id-log"></p>
        <p id="total-diferencas"></p>
        <p id="total-erros"></p>
        <div id="error-details-section"></div>
    </div>

    <div id="result-section">
        <div class="results">
            <h2>Respostas da Versão Candidata (Rascunho)</h2>
            <div id="resultado-teste"></div>
        </div>
        <div class="results">
            <h2>Respostas da Versão Atual (Produção)</h2>
            <div id="resultado-prod"></div>
        </div>
    </div>
    
</body>
</html>
