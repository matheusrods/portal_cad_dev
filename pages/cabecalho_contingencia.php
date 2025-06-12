<?php

include $_SERVER["DOCUMENT_ROOT"]."/pages/montaCabecalhoNovo.php";

$class = new cabecalho();

?>

<div class="divElementosCabecalho">
    <div class="logoCadCabecalho">
        <a href="https://cad.bb.com.br">
            <img src="/lib/img/cabecalho/imgCabecalho.svg" style="height: auto; width: 7rem; padding-bottom: 0.5rem;">
        </a>
    </div>

    <div class="atalhosCabecalho">
        <ul class="fa-ul" style="display: flex; flex-direction: row; gap: 1rem; list-style-type: none; align-items: center;">
            <li>
                <a id="atalhoPontoEletronico" href="https://ponto.bb.com.br/" target="_blank" title="Ponto Eletrônico">
                    <img class="iconeAtalhoCabecalho" src="/lib/img/cabecalho/logoPonto.svg" style="color: #FFFFFF;">
                </a>
            </li>
            <li>
                <a id="atalhoHumanograma" href="https://humanograma.intranet.bb.com.br/" target="_blank" title="Humanograma">
                    <!-- <img class="iconeAtalhoCabecalho" src="/lib/img/cabecalho/logoHumanograma.svg" style="color: #FFFFFF;"> -->
                    <i class="fas fa-users iconeAtalhoCabecalho" style="line-height: 1;color: rgb(255, 255, 255);" aria-hidden="true"></i>
                </a>
            </li>
            <li>
                <a id="atalhoEmail" href="https://outlook.office.com/mail/" target="_blank" title="E-mail corporativo">
                    <img class="iconeAtalhoCabecalho" src="/lib/img/cabecalho/logoEmail.svg" style="color: #FFFFFF;">
                </a>
            </li>
            <li>
                <a id="atalhoPlataforma" href="https://plataforma.atendimento.bb.com.br:49286/gaw/v3" target="_blank" title="Plataforma">
                    <img class="iconeAtalhoCabecalho" src="/lib/img/cabecalho/logoPlataforma.svg" style="color: #FFFFFF;">
                </a>
            </li>
            <div class="divLogoBancoCabecalho" style="width: 32px; height: 0px; transform: rotate(270deg); border: 1px rgba(250.75, 251.30, 255, 0.50) solid;"></div>
            <li class="logoBancoCabecalho">
                <a id="atalhoSiteBb" href="https://www.bb.com.br" target="_blank" title="Portal BB">
                    <img src="/lib/img/cabecalho/logoBB.svg" style="color: #FFFFFF;">
                </a>
            </li>

            <div class="divNomeFunciCabecalho" style="width: 32px; height: 0px; transform: rotate(270deg); border: 1px rgba(250.75, 251.30, 255, 0.50) solid;"></div>

            <li class="nomeFunciCabecalho" style="font-size: 0;">
                <span style="color: white; font-size: 9px; font-family: BancoDoBrasil Textos; font-weight: lighter; line-height: 9.27px; word-wrap: break-word">
                    Olá,<br>
                </span>
                <span style="color: white; font-size: 20px; font-family: BancoDoBrasil Textos; font-weight: 700; line-height: 20.60px; word-wrap: break-word">
                    <?php echo trim(strtok(ucfirst(strtolower($_SESSION['nome']))," ")); ?>
                </span>
            </li>
        </ul>
    </div>
</div>