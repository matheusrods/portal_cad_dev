<?php
echo '
<div class="toTheTop" style="position:fixed; right:0; bottom:0;">
    <a href="#" class="back-to-top">
      <span class="fa-stack">
        <i class="fas fa-square fa-stack-2x"></i>
        <i class="fas fa-arrow-up fa-stack-1x fa-inverse"></i>
      </span>
    </a>
</div>
<div class="bannerPitaco">
    <div class="pitacoContent">
        <img class="pitacoImg" src="/lib/img/sr_pitaco.png">

        <div class="pitacoTexto">
            <div class="pitacoEstrelas">
                <img src="/lib/img/msg-pitaco.svg" class="msg-pitaco">
                <img src="/lib/img/estrela.svg" class="estrela">
                <img src="/lib/img/estrela.svg" class="estrela">
                <img src="/lib/img/estrela.svg" class="estrela">
                <img src="/lib/img/estrela.svg" class="estrela">
                <img src="/lib/img/estrela.svg" class="estrela">
            </div>

            <h2>O que achou do Portal ?</h2>
            <p>Conte para o <span class="pitacoAzul">Sr. Pitaco</span></p>
        </div>

        <a class="pitacoBotao" onclick="abrirModalSrPitaco(true)">
            AVALIE AQUI
        </a>
    </div>
    <div class="pitacoBolinhas">
      <img src="/lib/img/bolinha_azul.svg" class="bolinha bolinha-azul">
      <img src="/lib/img/bolinha_roxa.svg" class="bolinha bolinha-roxa">
    </div>
</div>
<footer id="rodapeFooter">
    <div class="rodape">
        <div class="topFooter">
            <img class="imgQrCode" src="/lib/img/contatos.svg"></img>
            <!-- <img class="imgQrCode" src="/lib/img/qrCode.png"></img>
            <div class="textoRodape"><p>Converse com o nosso contatinho <br> (61) 4004-0001</p></div> -->
        </div>
        <div class="bottomFooter"><p>© Banco do Brasil S/A</p></div>
    </div>
</footer>
';