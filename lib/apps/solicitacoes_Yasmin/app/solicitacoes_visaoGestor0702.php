<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/solicitacoes/class/class_solicitacoes.php";

$class = new funcoesYasmin();
// $contaNovasSolicitacoes = $class->contaNovasSolicitacoes();

$notificacoesNovasSolicitacoes = '';

$contaNovasSolicitacoes = $class->contaNovasSolicitacoes();
$consultaSolicitacoes = $class->consultaSolicitacoes();

// if($contaNovasSolicitacoes['status'] == 1 && $contaNovasSolicitacoes['mensagem'] > '0'){
//     $notificacoesNovasSolicitacoes = '<div class="notificacoesInteracoesSolicitacoes" style="flex-direction: column; justify-content: flex-start; align-items: flex-start; display: inline-flex">
//                     <div style="width: 36px; height: 36px; background: #FBD40B; border-radius: 999px; flex-direction: column; justify-content: center; align-items: center; display: flex">
//                         <div style="text-align: center; color: #111214; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 700; line-height: 18px; word-wrap: break-word">'.$contaNovasSolicitacoes['mensagem'].'</div>
//                     </div>
//                 </div>';
// } else if($contaNovasSolicitacoes['status'] == 0) {
//     $notificacoesNovasSolicitacoes = '<div class="notificacoesInteracoesSolicitacoesErro" style="flex-direction: column; justify-content: flex-start; align-items: flex-start; display: inline-flex">
//                     <div style="width: 36px; height: 36px; background: #FBD40B; border-radius: 999px; flex-direction: column; justify-content: center; align-items: center; display: flex">
//                         <div style="text-align: center; color: #111214; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 700; line-height: 18px; word-wrap: break-word">?</div>
//                         <span class="tooltipErroConsultaNovasSolicitacoes">'.$contaNovasSolicitacoes['mensagem'].'</span>
//                     </div>
//                 </div>';
// } else if($contaNovasSolicitacoes['status'] == 1 && $contaNovasSolicitacoes['mensagem'] == '0'){
//     $notificacoesNovasSolicitacoes = '';
// }

?>
<div class="cabecalhoSolicitacoes" style="width: 100%; height: auto; background-color: #735CC6; display: inline-flex; flex-direction: row;">
    <div class="textoCabecalhoSolicitacoes" style="width: 50%; align-content: center; margin-left: 10%;">
        <div class="tituloTextoCabecalhoSolicitacoes" style="position: relative; width: 769px; height: 218px; font-family:Bancodobrasil titulos; font-weight: 700; color: #ffffff; font-size: 96px; letter-spacing: -9.60px; line-height: normal;">
            Alguma<br>Solicitação?
        </div>
        <div class="subtituloTextoCabecalhoSolicitacoes">
            <p class="text-wrapper" style="position: relative; width: 80%; height: 90px; font-family: Bancodobrasil textos; font-weight: 300; color: #ffffff; font-size: 32px;">
                Registre e acompanhe suas solicitações de demandas para o CAD 👇
            </p>
        </div>
    </div>
    <div class="imagemCabecalhoSolicitacoes" style="width: 40%; align-content: center; margin-right: 10%;">
        <img src="/lib/img/apps/solicitacoes/capaSolicitacoesBot.png" style="width: 100%;">
    </div>
</div>
<div class="conteudoSolicitacoes">
    <div class="abasCabecalhoSolicitacoes">
        <div class="abaAdicionarSolicitacoes Clicar" style="z-index: 2;">
            <div class="divConsultarSolicitacoes">
                <div class="divTextoConsultarSolicitacoes">
                    🗃 Nova Solicitação
                </div>
            </div>
        </div>
        <div class="abaConsultarSolicitacoes Clicar" style="z-index: 1;">
            <div class="divAdicionarSolicitacoes">
                <div class="divTextoAdicionarSolicitacoes">
                    🔎 Acompanhar Solicitação
                </div>
            </div>
        </div>
    </div>
    <div id="abaNovaSolicitacao">
        <div class="divTituloNovaSolicitacaoSolicitacoes">
            <div style="align-self: stretch; height: auto; color: white; font-size: 36px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word;">
                Abra sua solicitação Yasmin! 🤩
            </div>
            <div style="width: 100%; height: 30px; color: #F9F9F9; font-size: 14px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 15.75px; letter-spacing: 0.20px; word-wrap: break-word">
                Siga o formulário abaixo para abrir sua solicitação de demandas. Preencha o mais detalhado possível para que seja analisada pelo CAD
            </div>
        </div>
        <div class="divFormularioNovaSolicitacaoSolicitacoes">
            <div class="divEsquerdaFormularioSolicitacaoSolicitacoes">
                <div class="divPrimeiraEtapaFormularioSolicitacoes">
                    <!-- <p>Qual é a sua necessidade atual?</p>
                    <div class="radio-container">
                        <label for="radio">
                            <input type="radio" id="radio" name="radio" />
                            <div class="custom-radio">
                            <span></span>
                            </div>
                            <span style="font-color=#646464;">Incluir novos conteúdos em um bot<br>existente (WhatsApp PF/PJ, etc.)</span>
                        </label>
                    </div>

                    <div class="radio-container">
                        <label for="radio1">
                            <input type="radio" id="radio1" name="radio" />
                            <div class="custom-radio">
                            <span></span>
                            </div>
                            <span>Desenvolver um bot novo</span>
                        </label>
                    </div> -->
                    <form id="formFormularioId1" class="formFormularioSolicitacoes" attr-formordemexibicao="1" attr-chamadopor=""><p>Qual é sua necessidade atual?</p>
                            <div class="radio-container">
                                
                                <label for="radio1">
                                    <div style="width: 100%; display: flex; align-items: center;">
                                        <input type="radio" id="radio1" name="radio">
                                        <div class="custom-radio">
                                            <span class="radioSpan Clicar" id="radioSpan1" attr-ordemexibicao="1" attr-formularioatual="1" attr-proximoformulario="2"></span>
                                        </div>
                                        <span style="width: 75%; margin-left: 2%; font-color=#646464;">
                                            Incluir novos conteúdos em um bot<br>existente (WhatsApp PF/PJ, etc.)
                                        </span>
                                        
                                    </div>
                                </label>
                            </div>
                        
                            <div class="radio-container">
                                
                                <label for="radio2">
                                    <div style="width: 100%; display: flex; align-items: center;">
                                        <input type="radio" id="radio2" name="radio">
                                        <div class="custom-radio">
                                            <span class="radioSpan Clicar" id="radioSpan2" attr-ordemexibicao="1" attr-formularioatual="1" attr-proximoformulario="101"></span>
                                        </div>
                                        <span style="width: 75%; margin-left: 2%; font-color=#646464;">
                                            Desenvolver um bot novo
                                        </span>
                                        
                                    </div>
                                </label>
                            </div>
                        </form>                </div>
                

                <div class="dadosSolicitanteSolicitacoes" style="margin-top: 3rem;">
                    
                </div>
            </div>
            <div class="divDireitaFormularioSolicitacaoSolicitacoes" style="display: block;">
                
            <form id="formFormularioId2" class="formFormularioSolicitacoes" attr-formordemexibicao="2" attr-chamadopor="1" style=""><p>Qual o público da jornada?</p>
                            <div class="radio-container">
                                
                                <label for="radio3">
                                    <div style="width: 100%; display: flex; align-items: center;">
                                        <input type="radio" id="radio3" name="radio">
                                        <div class="custom-radio">
                                            <span class="radioSpan Clicar" id="radioSpan3" attr-ordemexibicao="2" attr-formularioatual="2" attr-proximoformulario="3"></span>
                                        </div>
                                        <span style="width: 75%; margin-left: 2%; font-color=#646464;">
                                            Cliente PF
                                        </span>
                                        
                                    </div>
                                </label>
                            </div>
                        
                            <div class="radio-container">
                                
                                <label for="radio4">
                                    <div style="width: 100%; display: flex; align-items: center;">
                                        <input type="radio" id="radio4" name="radio">
                                        <div class="custom-radio">
                                            <span class="radioSpan Clicar" id="radioSpan4" attr-ordemexibicao="2" attr-formularioatual="2" attr-proximoformulario="4"></span>
                                        </div>
                                        <span style="width: 75%; margin-left: 2%; font-color=#646464;">
                                            Cliente PJ
                                        </span>
                                        
                                    </div>
                                </label>
                            </div>
                        
                            <div class="radio-container">
                                
                                <label for="radio5">
                                    <div style="width: 100%; display: flex; align-items: center;">
                                        <input type="radio" id="radio5" name="radio">
                                        <div class="custom-radio">
                                            <span class="radioSpan Clicar" id="radioSpan5" attr-ordemexibicao="2" attr-formularioatual="2" attr-proximoformulario="102"></span>
                                        </div>
                                        <span style="width: 75%; margin-left: 2%; font-color=#646464;">
                                            Funci BB
                                        </span>
                                        
                                    </div>
                                </label>
                            </div>
                        
                            <div class="radio-container">
                                
                                <label for="radio6">
                                    <div style="width: 100%; display: flex; align-items: center;">
                                        <input type="radio" id="radio6" name="radio">
                                        <div class="custom-radio">
                                            <span class="radioSpan Clicar" id="radioSpan6" attr-ordemexibicao="2" attr-formularioatual="2" attr-proximoformulario="103"></span>
                                        </div>
                                        <span style="width: 75%; margin-left: 2%; font-color=#646464;">
                                            Suporte Técnico
                                        </span>
                                        
                                    </div>
                                </label>
                            </div>
                        </form><form id="formFormularioId3" class="formFormularioSolicitacoes" attr-formordemexibicao="3" attr-chamadopor="2" style=""><p>Qual o tipo de jornada será incluída? (PF)</p>
                            <div class="radio-container">
                                <div class="nestAvisoTipoJornadaPF" id="divAvisoJornadaTransacaoPF" style="display: none;">
    <div class="divAvisoTipoJornadaPF">
        <span class="textoAvisoTipoJornadaPF"><strong>Transação:</strong> São as consultas e contratações que o bot consegue realizar desde que haja integração com outros sistemas</span>
    </div>    
    <div class="setaBaixo"></div>
</div>
                                <label for="radio7">
                                    <div style="width: 100%; display: flex; align-items: center;">
                                        <input type="radio" id="radio7" name="radio">
                                        <div class="custom-radio">
                                            <span class="radioSpan Clicar" id="radioSpan7" attr-ordemexibicao="3" attr-formularioatual="3" attr-proximoformulario="0"></span>
                                        </div>
                                        <span style="width: 75%; margin-left: 2%; font-color=#646464;">
                                            Transação
                                        </span>
                                        <div class="svgInterrogacao" id="divIconeInterrogaTransacao">
    <svg xmlns="http://www.w3.org/2000/svg" width="31" height="28" viewBox="0 0 31 28" fill="none">
    <path d="M30.4556 14.001C30.4556 21.7335 23.6379 28.002 15.2278 28.002C6.81772 28.002 0 21.7335 0 14.001C0 6.26845 6.81772 0 15.2278 0C23.6379 0 30.4556 6.26845 30.4556 14.001Z" fill="#E0E9FF"></path>
    <path d="M17.563 16.1768L13.8253 15.7221L15.9077 13.3527C16.6908 12.4273 17.207 11.7731 17.4562 11.3902C17.7232 10.9913 17.8566 10.5765 17.8566 10.1457C17.8566 9.60317 17.6609 9.17237 17.2693 8.85326C16.8777 8.53415 16.3349 8.3746 15.6407 8.3746C13.9143 8.3746 12.4993 9.17237 11.3958 10.7679L8.45898 9.04473C9.36671 7.67255 10.4257 6.65938 11.636 6.0052C12.8641 5.33507 14.2791 5 15.881 5C17.0557 5 18.1058 5.18349 19.0314 5.55047C19.9747 5.91744 20.7044 6.436 21.2206 7.10613C21.7367 7.76031 21.9948 8.51022 21.9948 9.35586C21.9948 10.1696 21.7723 10.9355 21.3274 11.6535C20.9002 12.3715 20.2328 13.2251 19.325 14.2143L17.563 16.1768ZM15.614 22.1123C14.8843 22.1123 14.2791 21.8969 13.7986 21.4661C13.318 21.0353 13.0777 20.5008 13.0777 19.8626C13.0777 19.2084 13.318 18.6579 13.7986 18.2112C14.2791 17.7485 14.8843 17.5171 15.614 17.5171C16.3438 17.5171 16.9489 17.7405 17.4295 18.1872C17.91 18.618 18.1503 19.1526 18.1503 19.7908C18.1503 20.429 17.91 20.9795 17.4295 21.4422C16.9489 21.8889 16.3438 22.1123 15.614 22.1123Z" fill="#465EFF"></path>
    </svg>
</div>
                                    </div>
                                </label>
                            </div>
                        
                            <div class="radio-container">
                                <div class="nestAvisoTipoJornadaPF" id="divAvisoJornadaInformacionalPF" style="display: none;">
    <div class="divAvisoTipoJornadaPF">
        <span class="textoAvisoTipoJornadaPF" id="informacionalTextoAvisoJornadaPF"><strong>Informacional:</strong>  É todo o conteúdo armazenado no corpo de conhecimento do bot que fica disponível para consulta a partir da interação do cliente. São dados que não dependem da identificação do cliente nem da consulta a outro sistema</span>
    </div>    
    <div class="setaBaixo"></div>
</div>
                                <label for="radio8">
                                    <div style="width: 100%; display: flex; align-items: center;">
                                        <input type="radio" id="radio8" name="radio">
                                        <div class="custom-radio">
                                            <span class="radioSpan Clicar" id="radioSpan8" attr-ordemexibicao="3" attr-formularioatual="3" attr-proximoformulario="0"></span>
                                        </div>
                                        <span style="width: 75%; margin-left: 2%; font-color=#646464;">
                                            Jornada Informacional
                                        </span>
                                        <div class="svgInterrogacao" id="divIconeInterrogaJornadaInformacional">
    <svg xmlns="http://www.w3.org/2000/svg" width="31" height="28" viewBox="0 0 31 28" fill="none">
    <path d="M30.4556 14.001C30.4556 21.7335 23.6379 28.002 15.2278 28.002C6.81772 28.002 0 21.7335 0 14.001C0 6.26845 6.81772 0 15.2278 0C23.6379 0 30.4556 6.26845 30.4556 14.001Z" fill="#E0E9FF"></path>
    <path d="M17.563 16.1768L13.8253 15.7221L15.9077 13.3527C16.6908 12.4273 17.207 11.7731 17.4562 11.3902C17.7232 10.9913 17.8566 10.5765 17.8566 10.1457C17.8566 9.60317 17.6609 9.17237 17.2693 8.85326C16.8777 8.53415 16.3349 8.3746 15.6407 8.3746C13.9143 8.3746 12.4993 9.17237 11.3958 10.7679L8.45898 9.04473C9.36671 7.67255 10.4257 6.65938 11.636 6.0052C12.8641 5.33507 14.2791 5 15.881 5C17.0557 5 18.1058 5.18349 19.0314 5.55047C19.9747 5.91744 20.7044 6.436 21.2206 7.10613C21.7367 7.76031 21.9948 8.51022 21.9948 9.35586C21.9948 10.1696 21.7723 10.9355 21.3274 11.6535C20.9002 12.3715 20.2328 13.2251 19.325 14.2143L17.563 16.1768ZM15.614 22.1123C14.8843 22.1123 14.2791 21.8969 13.7986 21.4661C13.318 21.0353 13.0777 20.5008 13.0777 19.8626C13.0777 19.2084 13.318 18.6579 13.7986 18.2112C14.2791 17.7485 14.8843 17.5171 15.614 17.5171C16.3438 17.5171 16.9489 17.7405 17.4295 18.1872C17.91 18.618 18.1503 19.1526 18.1503 19.7908C18.1503 20.429 17.91 20.9795 17.4295 21.4422C16.9489 21.8889 16.3438 22.1123 15.614 22.1123Z" fill="#465EFF"></path>
    </svg>
</div>
                                    </div>
                                </label>
                            </div>
                        
                            <div class="radio-container">
                                <div class="nestAvisoTipoJornadaPF" id="divAvisoJornadaMensagemAtivaPF" style="display: none;">
    <div class="divAvisoTipoJornadaPF">
        <span class="textoAvisoTipoJornadaPF" id="mensagemAtivaTextoAvisoJornadaPF"><strong>Mensagem Ativa:</strong> Mensagens ativas são aquelas que enviamos para os clientes. Essas mensagens podem ter o intuito de divulgar algum produto ou serviço, enviar alertas ou notificações ou de relacionamento com o cliente</span>
    </div>    
    <div class="setaBaixo"></div>
</div>
                                <label for="radio9">
                                    <div style="width: 100%; display: flex; align-items: center;">
                                        <input type="radio" id="radio9" name="radio">
                                        <div class="custom-radio">
                                            <span class="radioSpan Clicar" id="radioSpan9" attr-ordemexibicao="3" attr-formularioatual="3" attr-proximoformulario="5"></span>
                                        </div>
                                        <span style="width: 75%; margin-left: 2%; font-color=#646464;">
                                            Mensagem Ativa
                                        </span>
                                        <div class="svgInterrogacao" id="divIconeInterrogaMensagemAtiva">
    <svg xmlns="http://www.w3.org/2000/svg" width="31" height="28" viewBox="0 0 31 28" fill="none">
    <path d="M30.4556 14.001C30.4556 21.7335 23.6379 28.002 15.2278 28.002C6.81772 28.002 0 21.7335 0 14.001C0 6.26845 6.81772 0 15.2278 0C23.6379 0 30.4556 6.26845 30.4556 14.001Z" fill="#E0E9FF"></path>
    <path d="M17.563 16.1768L13.8253 15.7221L15.9077 13.3527C16.6908 12.4273 17.207 11.7731 17.4562 11.3902C17.7232 10.9913 17.8566 10.5765 17.8566 10.1457C17.8566 9.60317 17.6609 9.17237 17.2693 8.85326C16.8777 8.53415 16.3349 8.3746 15.6407 8.3746C13.9143 8.3746 12.4993 9.17237 11.3958 10.7679L8.45898 9.04473C9.36671 7.67255 10.4257 6.65938 11.636 6.0052C12.8641 5.33507 14.2791 5 15.881 5C17.0557 5 18.1058 5.18349 19.0314 5.55047C19.9747 5.91744 20.7044 6.436 21.2206 7.10613C21.7367 7.76031 21.9948 8.51022 21.9948 9.35586C21.9948 10.1696 21.7723 10.9355 21.3274 11.6535C20.9002 12.3715 20.2328 13.2251 19.325 14.2143L17.563 16.1768ZM15.614 22.1123C14.8843 22.1123 14.2791 21.8969 13.7986 21.4661C13.318 21.0353 13.0777 20.5008 13.0777 19.8626C13.0777 19.2084 13.318 18.6579 13.7986 18.2112C14.2791 17.7485 14.8843 17.5171 15.614 17.5171C16.3438 17.5171 16.9489 17.7405 17.4295 18.1872C17.91 18.618 18.1503 19.1526 18.1503 19.7908C18.1503 20.429 17.91 20.9795 17.4295 21.4422C16.9489 21.8889 16.3438 22.1123 15.614 22.1123Z" fill="#465EFF"></path>
    </svg>
</div>
                                    </div>
                                </label>
                            </div>
                        </form><form id="formFormularioId5" class="formFormularioSolicitacoes" attr-formordemexibicao="4" attr-chamadopor="3" style=""><p>Você já alinhou com o CRM? (PF)</p>
                            <div class="radio-container">
                                
                                <label for="radio13">
                                    <div style="width: 100%; display: flex; align-items: center;">
                                        <input type="radio" id="radio13" name="radio">
                                        <div class="custom-radio">
                                            <span class="radioSpan Clicar" id="radioSpan13" attr-ordemexibicao="4" attr-formularioatual="5" attr-proximoformulario="7"></span>
                                        </div>
                                        <span style="width: 75%; margin-left: 2%; font-color=#646464;">
                                            Sim
                                        </span>
                                        
                                    </div>
                                </label>
                            </div>
                        
                            <div class="radio-container">
                                
                                <label for="radio14">
                                    <div style="width: 100%; display: flex; align-items: center;">
                                        <input type="radio" id="radio14" name="radio">
                                        <div class="custom-radio">
                                            <span class="radioSpan Clicar" id="radioSpan14" attr-ordemexibicao="4" attr-formularioatual="5" attr-proximoformulario="104"></span>
                                        </div>
                                        <span style="width: 75%; margin-left: 2%; font-color=#646464;">
                                            Não
                                        </span>
                                        
                                    </div>
                                </label>
                            </div>
                        </form><form id="formFormularioId7" class="formFormularioSolicitacoes" attr-formordemexibicao="5" attr-chamadopor="5" style=""><p>Você tem o número do localizador do formulário Martech?</p>
                            <div class="radio-container">
                                
                                <label for="radio15">
                                    <div style="width: 100%; display: flex; align-items: center;">
                                        <input type="radio" id="radio15" name="radio">
                                        <div class="custom-radio">
                                            <span class="radioSpan Clicar" id="radioSpan15" attr-ordemexibicao="5" attr-formularioatual="7" attr-proximoformulario="105"></span>
                                        </div>
                                        <span style="width: 75%; margin-left: 2%; font-color=#646464;">
                                            Sim
                                        </span>
                                        
                                    </div>
                                </label>
                            </div>
                        
                            <div class="radio-container">
                                
                                <label for="radio16">
                                    <div style="width: 100%; display: flex; align-items: center;">
                                        <input type="radio" id="radio16" name="radio">
                                        <div class="custom-radio">
                                            <span class="radioSpan Clicar" id="radioSpan16" attr-ordemexibicao="5" attr-formularioatual="7" attr-proximoformulario="106"></span>
                                        </div>
                                        <span style="width: 75%; margin-left: 2%; font-color=#646464;">
                                            Não
                                        </span>
                                        
                                    </div>
                                </label>
                            </div>
                        </form></div>
        </div>
        <div class="divInferiorSolicitacoes" style="display: none;"></div>
    </div>
    <div id="abaAcompanharSolicitacao">

    </div>
</div>