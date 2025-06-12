<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/solicitacoes/class/class_solicitacoes.php";

$class = new funcoes();

?>

<div class="cabecalhoSolicitacoes" style="width: 100%; height: auto; background-color: #735CC6; display: inline-flex; flex-direction: row;">
    <div class="textoCabecalhoSolicitacoes" style="width: 50%; align-content: center; margin-left: 10%;">
        <div class="tituloTextoCabecalhoSolicitacoes" style="position: relative; width: 769px; height: 218px; font-family:Bancodobrasil titulos; font-weight: 700; color: #ffffff; font-size: 96px; letter-spacing: -9.60px; line-height: normal;">
            Visão<br>Desenvolvedor
        </div>
        <div class="subtituloTextoCabecalhoSolicitacoes">
            <p class="text-wrapper" style="position: relative; width: 80%; height: 90px; font-family: Bancodobrasil textos; font-weight: 300; color: #ffffff; font-size: 32px;">
                Selecione abaixo a visão desejada
            </p>
        </div>
    </div>
    <div class="imagemCabecalhoSolicitacoes" style="width: 40%; align-content: center; margin-right: 10%;">
        <img src="/lib/img/apps/solicitacoes/capaSolicitacoesBot.png" style="width: 100%;">
    </div>
</div>
<div class= "conteudoSolicitacoes">
    <select id="visaoSelect">
        <option value="">Selecione uma visão</option>
        <option value="solicitacoes_visaoCad">Visão CAD</option>
        <option value="solicitacoes_visaoGestor">Visão Gestor</option>
    </select>
</div>


<script>
    $(document).ready(function() {
        $("#visaoSelect").change(function() {
            var visao = $(this).val();
            if (visao) {
                $("#conteudo").load(visao + ".php");
            }
        });
    });
</script>