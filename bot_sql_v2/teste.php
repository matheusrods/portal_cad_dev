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
  <title>Dashboards Power BI</title>
  <style>
    * {
      box-sizing: border-box;
    }

    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: Arial, sans-serif;
    }

    .container {
      display: flex;
      height: 100vh;
    }

    .sidebar {
      width: 220px;
      background-color: #004481;
      color: white;
      padding-top: 20px;
      display: flex;
      flex-direction: column;
    }

    .sidebar.minimizada {
      width: 60px;
    }

    .sidebar button {
      background: none;
      border: none;
      color: white;
      padding: 15px 20px;
      text-align: left;
      cursor: pointer;
      transition: background 0.3s;
      white-space: nowrap;
      overflow: hidden;
    }

    .sidebar button:hover {
      background-color: #0066b3;
    }

    .toggle-btn {
      background-color: #003366;
      font-weight: bold;
    }

    .content {
      flex-grow: 1;
      position: relative;
    }

    .painel {
      display: none;
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
    }

    .painel.ativo {
      display: block;
    }

    iframe {
      width: 100%;
      height: 100%;
      border: none;
    }

  </style>
</head>
<body>

  <div class="container">
    <div class="sidebar" id="sidebar">
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        <button onclick="mostrarPainel('painel1')">Priorização Curadoria</button>
        <button onclick="mostrarPainel('painel4')">Erros Watson</button>
        <button onclick="mostrarPainel('painel2')">Análise Timeout</button>
        <button onclick="mostrarPainel('painel3')">Atipiciade das Notas</button>
        <button onclick="mostrarPainel('painel5')">Atipiciade de Transbordo</button>
    </div>

    <div class="content">
      <div id="painel1" class="painel ativo">
            <iframe src="https://pwbi.intranet.bb.com.br/REPORTS/powerbi/PAINEL%20DE%20METRICAS/CAD/Prioriza%C3%A7%C3%A3o_Curadoria?rs:embed=true" title="Dashboard Power BI" frameborder="0">
            </iframe>
        </div>
        <div id="painel2" class="painel">
            <iframe src="https://pwbi.intranet.bb.com.br/reports/powerbi/PAINEL%20DE%20METRICAS/CAD/Analise_Timeout?rs:embed=true" title="Dashboard Power BI" frameborder="0">
            </iframe>
        </div>
        <div id="painel3" class="painel">
            <iframe src="https://pwbi.intranet.bb.com.br/reports/powerbi/PAINEL%20DE%20METRICAS/CAD/acompanhamentoAtipicidadeNotas?rs:embed=true" title="Dashboard Power BI" frameborder="0">
            </iframe>
        </div>
        <div id="painel4" class="painel">
            <iframe src="https://pwbi.intranet.bb.com.br/reports/powerbi/PAINEL%20DE%20METRICAS/CAD/acompanhamentoErrosWatsonGrafeno?rs:embed=true" title="Dashboard Power BI" frameborder="0">
            </iframe>
        </div>
        <div id="painel5" class="painel">
            <iframe src="https://pwbi.intranet.bb.com.br/reports/powerbi/PAINEL%20DE%20METRICAS/CAD/acompanhamentoAtipicidadeTransbordo?rs:embed=true" title="Dashboard Power BI" frameborder="0">
            </iframe>
        </div>	
    </div>
  </div>

  
    <script>
        function mostrarPainel(id) {
        const paineis = document.querySelectorAll('.painel');
        paineis.forEach(p => p.classList.remove('ativo'));
        document.getElementById(id).classList.add('ativo');
        }

        function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('minimizada');
        }
    </script>


</body>
</html>


