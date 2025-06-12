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
        <div class="tituloTextoCabecalhoSolicitacoes" id = "maiorTituloTextoCabecalhoSolicitacoes">
            Alguma<br>Solicitação?
        </div>
        <div class="subtituloTextoCabecalhoSolicitacoes">
            <p class="text-wrapper">
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
            <div class="divAdicionarSolicitacoes">
                <div class="divTextoAdicionarSolicitacoes">
                    <img src="https://cad.bb.com.br/lib/apps/solicitacoes_Yasmin/img/iconeArquivo.png"> Registrar
                </div>
            </div>
        </div>
        <div class="abaConsultarSolicitacoes Clicar" style="z-index: 1;">
            <div class="divConsultarSolicitacoes">
                <div class="divTextoConsultarSolicitacoes">
                    🔎 Acompanhar <div class="notificaQtdeSolicitacoes">1</div>
                </div>
            </div>
        </div>
    </div>
    <!--Aba Nova Solicitação -->
    <div id="abaNovaSolicitacao">
        <div class="divTituloNovaSolicitacaoSolicitacoes">
            <div style="align-self: stretch; height: auto; color: white; font-size: 36px; font-family: BancoDoBrasil Textos; font-weight: 400; word-wrap: break-word;">
                Abra sua solicitação! 🤩
            </div>
            <div style="width: 100%; height: 30px; color: #F9F9F9; font-size: 14px; font-family: BancoDoBrasil Textos; font-weight: 400; line-height: 15.75px; letter-spacing: 0.20px; word-wrap: break-word">
                Siga o formulário abaixo para abrir sua solicitação de demandas. Preencha o mais detalhado possível para que seja analisada pelo CAD
            </div>
        </div>
        <div class="divFormularioNovaSolicitacaoSolicitacoes">
         <form>    
            <div class="nestFormularioNovasSolicitacoes">
                <div class="divEsquerdaFormularioSolicitacaoSolicitacoes">
                    <p>Qual é a sua necessidade atual?</p>
                    <!-- <input type="radio" id="html" name="fav_language" value="conteudo">
                    <label for="html">Incluir novos conteúdos em um bot existente (WhatsApp PF/PJ, etc.)</label><br>
                    <input type="radio" id="css" name="fav_language" value="novoBot">
                    <label for="css">Desenvolver um bot novo</label><br> -->

                    <div class="radio-container">
                        <label for="incluirNovosConteudos">
                            <input type="radio" id="incluirNovosConteudos" name="necessidadeGestor" />
                            <div class="custom-radio">
                                <span></span>
                            </div>
                            <span style="font-color=#646464;">Incluir novos conteúdos em um bot<br>existente (WhatsApp PF/PJ, etc.)</span>
                        </label>
                    </div>

                    <div class="radio-container">
                        <label for="desenvolverBot">
                            <input type="radio" id="desenvolverBot" name="necessidadeGestor" />
                            <div class="custom-radio">
                                <span></span>
                            </div>
                            <span>Desenvolver um bot novo</span>
                        </label>
                    </div>
                </div>
                <div class="divDireitaFormularioSolicitacaoSolicitacoes">
                    <div class="formNovoConteudoBot">
                        <p>Qual o público da jornada ?</p>
                        
                            <div class="radio-container">
                                <label for="radioClientePF">
                                    <input type="radio" id="radioClientePF" name="publicoJornada" value="clientePF" />
                                    <div class="custom-radio">
                                    <span></span>
                                    </div>
                                    <span style="font-color=#646464;">Cliente PF</span>
                                </label>
                            </div>

                            <div class="radio-container">
                                <label for="radioClientePJ">
                                    <input type="radio" id="radioClientePJ" name="publicoJornada" value="clientePJ"  />
                                    <div class="custom-radio">
                                    <span></span>
                                    </div>
                                    <span style="font-color=#646464;">Cliente PJ</span>
                                </label>
                            </div>


                            <div class="radio-container">
                                <label for="radioFunciBB">
                                    <input type="radio" id="radioFunciBB" name="publicoJornada" value="funciBB" />
                                    <div class="custom-radio">
                                        <span></span>
                                    </div>
                                    <span>Funci BB</span>
                                </label>
                            </div>

                            <div class="radio-container">
                                <label for="radioSuporteTecnico">
                                    <input type="radio" id="radioSuporteTecnico" name="publicoJornada" value="suporteTecnico" />
                                    <div class="custom-radio">
                                        <span></span>
                                    </div>
                                    <span>Suporte técnico</span>
                                </label>
                            </div>
                        
                        
                    </div>
                    <div class="divAvisosBotNovo">
                        <div class="avisoNovoBot">  
                            <span class="textoAvisoNovoBot">Você precisará de um workspace no NIA. Solicite a criação via issue, utilizando o template “criacao_corpus_nia”</span>
                            <button type="button" class="btnAvisoNovoBot" >ABRIR ISSUE</button>
                        </div>
                        <div class="avisoNovoBot">  
                            <span class="textoAvisoNovoBot">Caso precise de apoio para a criação do seu bot, nós podemos te ajudar. Conheça a nossa “Imersão Chatbot”</span>
                            <button type="button" class="btnAvisoNovoBot">SABER MAIS</button>
                        </div>        
                    </div> 
                </div>
                
            </div>
            <div class = "avisoJornadaFuncieSuporte" id = "idAvisoBotFunci">
                        <span class="textoAvisoJornadaFuncieSuporte">Para incluir conteúdos no Bot Funci BB, entre em contato com o time da Gepes</span>
                        <button type="button" class="btnAvisoNovoBot">VER EQUIPE</button> 
            </div>
            <div class = "avisoJornadaFuncieSuporte" id= "idAvisoBotSuporte">
                        <span class="textoAvisoJornadaFuncieSuporte">Para incluir conteúdos no Bot Suporte técnico, entre em contato com o time da Gesec</span>
                        <button type="button" class="btnAvisoNovoBot">VER EQUIPE</button> 
            </div>
            <div class = "avisoVerificarChecklistMensagemAtivaPF">
                <div class="conteudoAvisoChecklistPF">
                    <div class= "imgSvgChecklistMensagemAtivaPF">
                        <svg xmlns="http://www.w3.org/2000/svg" width="57" height="58" viewBox="0 0 57 58" fill="none">
                            <g clip-path="url(#clip0_7635_1989)">
                                <path d="M57 29C57 45.0163 44.2396 58 28.5 58C12.7593 58 -3.93545e-06 45.0163 -2.53526e-06 29C-1.13507e-06 12.9837 12.7593 1.11545e-06 28.5 2.49155e-06C44.2396 3.86755e-06 57 12.9837 57 29Z" fill="#FC6E51"/>
                                <path d="M33.1331 16.4268L39.3108 16.4268C39.8796 16.4268 40.3405 16.8963 40.3405 17.4746L40.3405 44.1919C40.3405 44.7708 39.8796 45.2398 39.3108 45.2398L17.6875 45.2398C17.1186 45.2398 16.6577 44.7708 16.6577 44.192L16.6577 17.4746C16.6577 16.8963 17.1186 16.4268 17.6875 16.4268L23.8662 16.4268" fill="white"/>
                                <path d="M39.3109 45.82L17.6877 45.82C16.8057 45.82 16.0879 45.0893 16.0879 44.1922L16.0879 17.4748C16.0879 16.5776 16.8058 15.8469 17.6877 15.8469L23.8664 15.8469L23.8664 17.0069L17.6877 17.0069C17.4342 17.0069 17.2279 17.2165 17.2279 17.4748L17.2279 44.1921C17.2279 44.4505 17.4342 44.66 17.6877 44.66L39.311 44.66C39.5643 44.66 39.7708 44.4504 39.7708 44.1922L39.7708 17.4748C39.7708 17.2165 39.5642 17.0069 39.3109 17.0069L33.1333 17.0069L33.1333 15.8469L39.3109 15.8469C40.1932 15.8469 40.9108 16.5776 40.9108 17.4748L40.9108 44.1921C40.9108 45.0893 40.1932 45.82 39.3109 45.82Z" fill="#454545"/>
                                <path d="M32.1034 15.3791C32.1034 15.3791 30.5593 15.0381 30.5593 14.8557C30.5593 13.6974 29.6364 12.76 28.4997 12.76C27.3619 12.76 26.4401 13.6974 26.4401 14.8557C26.4401 15.0381 24.896 15.3791 24.896 15.3791C24.3271 15.3791 23.8662 15.8486 23.8662 16.4269L23.8662 18.5226C23.8662 19.1009 24.3271 19.5705 24.896 19.5705L32.1034 19.5705C32.6711 19.5705 33.1332 19.1009 33.1332 18.5226L33.1332 16.4269C33.1332 15.8487 32.6711 15.3791 32.1034 15.3791Z" fill="#FFB933"/>
                                <path d="M32.1036 20.1504L24.8962 20.1504C24.0142 20.1504 23.2964 19.4197 23.2964 18.5225L23.2964 16.4269C23.2964 15.5523 23.9772 14.837 24.8277 14.8002C25.2321 14.7095 25.6501 14.5945 25.892 14.5113C26.0585 13.1983 27.1645 12.1799 28.4999 12.1799C29.8352 12.1799 30.9413 13.1983 31.1078 14.5112C31.3496 14.5945 31.7676 14.7095 32.172 14.8001C33.0225 14.837 33.7033 15.5524 33.7033 16.4269L33.7033 18.5225C33.7033 19.4197 32.9855 20.1504 32.1036 20.1504ZM28.4999 13.3399C27.6786 13.3399 27.0103 14.0196 27.0103 14.8556C27.0103 15.3354 26.7092 15.5721 25.017 15.9454C24.9774 15.9545 24.9369 15.959 24.8962 15.959C24.6426 15.959 24.4364 16.1686 24.4364 16.4269L24.4364 18.5225C24.4364 18.7808 24.6426 18.9904 24.8962 18.9904L32.1036 18.9904C32.3571 18.9904 32.5633 18.7808 32.5633 18.5225L32.5633 16.4269C32.5633 16.1686 32.3571 15.959 32.1036 15.959C32.0629 15.959 32.0223 15.9545 31.9828 15.9454C30.2906 15.5721 29.9895 15.3354 29.9895 14.8556C29.9895 14.0196 29.3212 13.3399 28.4999 13.3399Z" fill="#454545"/>
                                <path d="M21.0901 27.964C22.3493 27.964 23.3701 26.9253 23.3701 25.644C23.3701 24.3627 22.3493 23.324 21.0901 23.324C19.8309 23.324 18.8101 24.3627 18.8101 25.644C18.8101 26.9253 19.8309 27.964 21.0901 27.964Z" fill="#ACAF48"/>
                                <path d="M21.0898 27.0441L19.5469 25.4741L20.3528 24.6539L21.0899 25.4038L22.9668 23.4939L23.7728 24.3141L21.0898 27.0441Z" fill="#454545"/>
                                <path d="M21.0901 34.9239C22.3493 34.9239 23.3701 33.8852 23.3701 32.6039C23.3701 31.3226 22.3493 30.2839 21.0901 30.2839C19.8309 30.2839 18.8101 31.3226 18.8101 32.6039C18.8101 33.8852 19.8309 34.9239 21.0901 34.9239Z" fill="#ACAF48"/>
                                <path d="M21.0898 34.0042L19.5469 32.434L20.3528 31.6139L21.0899 32.3638L22.9668 30.4539L23.7728 31.2741L21.0899 34.0041L21.0898 34.0042Z" fill="#454545"/>
                                <path d="M21.0901 41.8839C22.3493 41.8839 23.3701 40.8452 23.3701 39.5639C23.3701 38.2826 22.3493 37.2439 21.0901 37.2439C19.8309 37.2439 18.8101 38.2826 18.8101 39.5639C18.8101 40.8452 19.8309 41.8839 21.0901 41.8839Z" fill="#ACAF48"/>
                                <path d="M21.0898 40.9642L19.5469 39.3941L20.3528 38.5739L21.0899 39.3238L22.9668 37.4139L23.7728 38.2341L21.0899 40.9641L21.0898 40.9642ZM38.1898 25.0641L26.7898 25.0641L26.7898 23.9041L38.1898 23.9041L38.1898 25.0641ZM33.6298 27.3841L26.7898 27.3841L26.7898 26.2241L33.6298 26.2241L33.6298 27.3841ZM30.2098 32.0241L26.7898 32.0241L26.7898 30.8641L30.2098 30.8641L30.2098 32.0241ZM38.1898 32.0241L31.3498 32.0241L31.3498 30.8641L38.1898 30.8641L38.1898 32.0241ZM35.9098 34.3441L26.7898 34.3441L26.7898 33.1841L35.9098 33.1841L35.9098 34.3441Z" fill="#454545"/>
                                <path d="M38.19 38.984L26.79 38.984L26.79 37.824L38.19 37.824L38.19 38.984Z" fill="#454545"/>
                                <path d="M30.21 41.304L26.79 41.304L26.79 40.144L30.21 40.144L30.21 41.304Z" fill="#454545"/>
                                <path d="M34.7701 41.304L31.3501 41.304L31.3501 40.144L34.7701 40.144L34.7701 41.304Z" fill="#454545"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_7635_1989">
                                <rect width="57" height="58" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <span class="textoAvisoChecklistMensagemAtivaPF">Antes de abrir a história confira o checklist:</br><span><span class="negritotextoAvisoChecklistMensagemAtivaPF">Checklist Jornada Mensagem Ativa</span>
                </div> 
                <button type="button" class="btnAvisoNovoBot btnAvisoCheckList">ABRIR HISTÓRIA</button>    
            </div>
            <div class = "divSolicitacaoJornadaPF setorJornadaPF">
            <div class="linhaDivisoria"></div>
                <div class="nestFormularioJornadaPF">
                    <div class="divEsquerdaFormularioSolicitacaoClientePF">
                        <div class="divItemFormularioSolicitacaoClientePF">
                            <span class="itemFormulario">Nome do Solicitante</span>
                            <div class="divInputFormJornadaPF">
                                <input type="text" class="inputFormJornadaPF" id="nomeSolicitanteJornadaPF" />
                            </div>
                        </div>
                        <div class="divItemFormularioSolicitacaoClientePF">    
                            <span class="itemFormulario">Matrícula</span>
                            <div class="divInputFormJornadaPF">
                                <input type="text" class="inputFormJornadaPF" id="matriculaSolicitanteJornadaPF" />
                            </div>
                        </div>
                        <div class="divItemFormularioSolicitacaoClientePF">    
                            <span class="itemFormulario">E-mail</span>
                            <div class="divInputFormJornadaPF">
                                <input type="text" class="inputFormJornadaPF" id="emailSolicitanteJornadaPF" />
                            </div>
                        </div>    
                        <div class="divItemFormularioSolicitacaoClientePF">
                            <span class="itemFormulario">Dependência</span>
                            <div class="divInputFormJornadaPF">
                                <input type="text" class="inputFormJornadaPF" id="matriculaSolicitanteJornadaPF" />
                            </div>
                        </div>    
                    </div>
                    <div class="divDireitaFormularioSolicitacaoSolicitacoes">
                        <div>
                            <p>Qual o tipo de jornada será incluída?</p>
                            <form >
                                <div class="radio-container containerInputEAvisoPF">
                                    <div class="nestAvisoTipoJornadaPF" id="divAvisoJornadaTransacaoPF">
                                        <div class="divAvisoTipoJornadaPF" >
                                            <span class="textoAvisoTipoJornadaPF"><strong>Transação:</strong> São as consultas e contratações que o bot consegue realizar desde que haja integração com outros sistemas</span>
                                        </div>    
                                        <div class="setaBaixo"></div>
                                    </div>
                                    <label for="radioTransacaoPF">
                                        <input type="radio" id="radioTransacaoPF" name="tipoJornadaPFEditar" value="transacaoPF" />
                                        <div class="custom-radio">
                                        <span></span>
                                        </div>
                                        <span style="font-color=#646464;">Transação</span>
                                        <div class="svgInterrogacao" id= "divIconeInterrogaTransacao">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="28" viewBox="0 0 31 28" fill="none">
                                            <path d="M30.4556 14.001C30.4556 21.7335 23.6379 28.002 15.2278 28.002C6.81772 28.002 0 21.7335 0 14.001C0 6.26845 6.81772 0 15.2278 0C23.6379 0 30.4556 6.26845 30.4556 14.001Z" fill="#E0E9FF"/>
                                            <path d="M17.563 16.1768L13.8253 15.7221L15.9077 13.3527C16.6908 12.4273 17.207 11.7731 17.4562 11.3902C17.7232 10.9913 17.8566 10.5765 17.8566 10.1457C17.8566 9.60317 17.6609 9.17237 17.2693 8.85326C16.8777 8.53415 16.3349 8.3746 15.6407 8.3746C13.9143 8.3746 12.4993 9.17237 11.3958 10.7679L8.45898 9.04473C9.36671 7.67255 10.4257 6.65938 11.636 6.0052C12.8641 5.33507 14.2791 5 15.881 5C17.0557 5 18.1058 5.18349 19.0314 5.55047C19.9747 5.91744 20.7044 6.436 21.2206 7.10613C21.7367 7.76031 21.9948 8.51022 21.9948 9.35586C21.9948 10.1696 21.7723 10.9355 21.3274 11.6535C20.9002 12.3715 20.2328 13.2251 19.325 14.2143L17.563 16.1768ZM15.614 22.1123C14.8843 22.1123 14.2791 21.8969 13.7986 21.4661C13.318 21.0353 13.0777 20.5008 13.0777 19.8626C13.0777 19.2084 13.318 18.6579 13.7986 18.2112C14.2791 17.7485 14.8843 17.5171 15.614 17.5171C16.3438 17.5171 16.9489 17.7405 17.4295 18.1872C17.91 18.618 18.1503 19.1526 18.1503 19.7908C18.1503 20.429 17.91 20.9795 17.4295 21.4422C16.9489 21.8889 16.3438 22.1123 15.614 22.1123Z" fill="#465EFF"/>
                                            </svg>
                                        </div>
                                    </label>
                                </div>

                                <div class="radio-container containerInputEAvisoPF">
                                    <div class="nestAvisoTipoJornadaPF" id="divAvisoJornadaInformacionalPFEditar">
                                        <div class="divAvisoTipoJornadaPF" >
                                            <span class="textoAvisoTipoJornadaPF" id="informacionalTextoAvisoJornadaPFEditar"><strong>Informacional:</strong>  É todo o conteúdo armazenado no corpo de conhecimento do bot que fica disponível para consulta a partir da interação do cliente. São dados que não dependem da identificação do cliente nem da consulta a outro sistema</span>
                                        </div>    
                                        <div class="setaBaixo"></div>
                                    </div>
                                    <label for="radioJornadaInformacionalPFEditar">
                                        <input type="radio" id="radioJornadaInformacionalPFEditar" name="tipoJornadaPFEditar" value="jornadaInformacionalPF"  />
                                        <div class="custom-radio">
                                        <span></span>
                                        </div>
                                        <span style="font-color=#646464;">Jornada Informacional</span>
                                        <div class="svgInterrogacao" id= "divIconeceInterrogaJornadaInf">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="28" viewBox="0 0 31 28" fill="none">
                                            <path d="M30.4556 14.001C30.4556 21.7335 23.6379 28.002 15.2278 28.002C6.81772 28.002 0 21.7335 0 14.001C0 6.26845 6.81772 0 15.2278 0C23.6379 0 30.4556 6.26845 30.4556 14.001Z" fill="#E0E9FF"/>
                                            <path d="M17.563 16.1768L13.8253 15.7221L15.9077 13.3527C16.6908 12.4273 17.207 11.7731 17.4562 11.3902C17.7232 10.9913 17.8566 10.5765 17.8566 10.1457C17.8566 9.60317 17.6609 9.17237 17.2693 8.85326C16.8777 8.53415 16.3349 8.3746 15.6407 8.3746C13.9143 8.3746 12.4993 9.17237 11.3958 10.7679L8.45898 9.04473C9.36671 7.67255 10.4257 6.65938 11.636 6.0052C12.8641 5.33507 14.2791 5 15.881 5C17.0557 5 18.1058 5.18349 19.0314 5.55047C19.9747 5.91744 20.7044 6.436 21.2206 7.10613C21.7367 7.76031 21.9948 8.51022 21.9948 9.35586C21.9948 10.1696 21.7723 10.9355 21.3274 11.6535C20.9002 12.3715 20.2328 13.2251 19.325 14.2143L17.563 16.1768ZM15.614 22.1123C14.8843 22.1123 14.2791 21.8969 13.7986 21.4661C13.318 21.0353 13.0777 20.5008 13.0777 19.8626C13.0777 19.2084 13.318 18.6579 13.7986 18.2112C14.2791 17.7485 14.8843 17.5171 15.614 17.5171C16.3438 17.5171 16.9489 17.7405 17.4295 18.1872C17.91 18.618 18.1503 19.1526 18.1503 19.7908C18.1503 20.429 17.91 20.9795 17.4295 21.4422C16.9489 21.8889 16.3438 22.1123 15.614 22.1123Z" fill="#465EFF"/>
                                            </svg>
                                        </div>
                                    </label>
                                </div>


                                <div class="radio-container containerInputEAvisoPF">
                                    <div class="nestAvisoTipoJornadaPF" id="divAvisoJornadaMensagemAtivaPF">
                                        <div class="divAvisoTipoJornadaPF" >
                                            <span class="textoAvisoTipoJornadaPF" id="mensagemAtivaTextoAvisoJornadaPF" ><strong>Mensagem Ativa:</strong> Mensagens ativas são aquelas que enviamos para os clientes. Essas mensagens podem ter o intuito de divulgar algum produto ou serviço, enviar alertas ou notificações ou de relacionamento com o cliente</span>
                                        </div>    
                                        <div class="setaBaixo"></div>
                                    </div>
                                    <label for="radioMensagemAtivaPF">
                                        <input type="radio" id="radioMensagemAtivaPF" name="tipoJornadaPF" value="mensagemAtivaPF" />
                                        <div class="custom-radio">
                                            <span></span>
                                        </div>
                                        <span>Mensagem Ativa</span>
                                        <div class="svgInterrogacao" id= "divIconeInterrogaMensagemAtiva">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="28" viewBox="0 0 31 28" fill="none">
                                            <path d="M30.4556 14.001C30.4556 21.7335 23.6379 28.002 15.2278 28.002C6.81772 28.002 0 21.7335 0 14.001C0 6.26845 6.81772 0 15.2278 0C23.6379 0 30.4556 6.26845 30.4556 14.001Z" fill="#E0E9FF"/>
                                            <path d="M17.563 16.1768L13.8253 15.7221L15.9077 13.3527C16.6908 12.4273 17.207 11.7731 17.4562 11.3902C17.7232 10.9913 17.8566 10.5765 17.8566 10.1457C17.8566 9.60317 17.6609 9.17237 17.2693 8.85326C16.8777 8.53415 16.3349 8.3746 15.6407 8.3746C13.9143 8.3746 12.4993 9.17237 11.3958 10.7679L8.45898 9.04473C9.36671 7.67255 10.4257 6.65938 11.636 6.0052C12.8641 5.33507 14.2791 5 15.881 5C17.0557 5 18.1058 5.18349 19.0314 5.55047C19.9747 5.91744 20.7044 6.436 21.2206 7.10613C21.7367 7.76031 21.9948 8.51022 21.9948 9.35586C21.9948 10.1696 21.7723 10.9355 21.3274 11.6535C20.9002 12.3715 20.2328 13.2251 19.325 14.2143L17.563 16.1768ZM15.614 22.1123C14.8843 22.1123 14.2791 21.8969 13.7986 21.4661C13.318 21.0353 13.0777 20.5008 13.0777 19.8626C13.0777 19.2084 13.318 18.6579 13.7986 18.2112C14.2791 17.7485 14.8843 17.5171 15.614 17.5171C16.3438 17.5171 16.9489 17.7405 17.4295 18.1872C17.91 18.618 18.1503 19.1526 18.1503 19.7908C18.1503 20.429 17.91 20.9795 17.4295 21.4422C16.9489 21.8889 16.3438 22.1123 15.614 22.1123Z" fill="#465EFF"/>
                                            </svg>
                                        </div>
                                    </label>
                                </div>
                        </div>
                    </div>
                    
                </div>

            </div>
            <div class = "divSolicitacaoJornadaTransacaoPF setorJornadaPF">
                <div class="linhaDivisoria"></div>
                <div class="nestFormularioJornadaTransacaoPFDuasColunas">
                    <div class="divEsquerdaFormularioSolicitacaoClientePF" id="divJornadaTransacaoPF">
                        <div class="divItemFormularioSolicitacaoClientePF">
                            <span class="itemFormulario">Qual o tema/produto?</span>
                            <div class="divInputFormJornadaPF">
                                <input type="text" class="inputFormJornadaPF" id="temaProdutoTransacaoPF" />
                            </div>
                        </div>
                        <div class="divItemFormularioSolicitacaoClientePF">    
                            <span class="itemFormulario">Em qual canal deseja incluir a transação?</span>
                            <div class="divInputFormJornadaPF">
                                <select class="inputFormJornadaPF" id="canalTransacaoPF"></select>
                            </div>
                        </div>
                        <div class="radioComTitulo">
                            <span class="itemFormulario tituloRadioBtnFormulario">A transação visa atender RA (Recomendação de auditoria) ou Regulatório (Regulamento ou lei específica)?</span>
                            <div class="radio-container">
                                <label for="radioTransacaoRaRegSim">
                                    <input type="radio" id="radioTransacaoRaRegSim" name="RARegulatorio" value="sim" />
                                    <div class="custom-radio">
                                        <span></span>
                                    </div>
                                    <span>Sim</span>
                                </label>
                            </div>   
                            <div class="radio-container">
                                <label for="radioTransacaoRaRegNao">
                                    <input type="radio" id="radioTransacaoRaRegNao" name="RARegulatorio" value="nao" />
                                    <div class="custom-radio">
                                        <span></span>
                                    </div>
                                    <span>Não</span>
                                </label>
                            </div>   
                        </div>
                        <div class="radioComTitulo">
                            <span class="itemFormulario tituloRadioBtnFormulario">A RA ou Regulatório especifica que a transação deve ser disponibilizada no WhatsApp?</span>
                            <div class="radio-container">
                                <label for="radioTransacaoWhatsSim">
                                    <input type="radio" id="radioTransacaoWhatsSim" name="disponivelNoWhats" value="sim" />
                                    <div class="custom-radio">
                                        <span></span>
                                    </div>
                                    <span>Sim</span>
                                </label>
                            </div>   
                            <div class="radio-container">
                                <label for="radioTransacaoWhatsNao">
                                    <input type="radio" id="radioTransacaoWhatsNao" name="disponivelNoWhats" value="nao" />
                                    <div class="custom-radio">
                                        <span></span>
                                    </div>
                                    <span>Não</span>
                                </label>
                            </div>   
                        </div>  
                        
                    </div>
                    <div class="divDireitaFormularioSolicitacaoSolicitacoes">
                        <div>
                            <div class="divItemFormularioSolicitacaoClientePF">
                                <span class="itemFormulario">Qual o assunto principal da transação?</span>
                                <div class="divInputFormJornadaPF">
                                    <input type="text" class="inputFormJornadaPF" id="assuntoTransacaoPF" placeholder= "Escreva o nome" />
                                </div>
                            </div>
                            <div class="divItemFormularioSolicitacaoClientePF">
                                <span class="itemFormulario">Qual o objetivo da transação? (o que é esperado que o cliente consiga fazer ao utilizar a transação)</span>
                                <div>
                                <textarea class="txtAreaMedioTransacao" name="objetivoTransacaoPF" rows="7" cols="55" maxlength="200" placeholder= "Mensagem"></textarea>
                                </div>
                            </div>
                            <div class="divItemFormularioSolicitacaoClientePF">
                                <span class="itemFormulario">Em quais canais a transação já existe?</span>
                                <div>
                                    <textarea class="txtAreaMedioTransacao" name="canaisJaExistentes" rows="7" cols="55" maxlength="200" placeholder= "Mensagem"></textarea>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="nestFormularioJornadaTransacaoPFUmaColuna">
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Qual o público da jornada?</span>
                        <div>
                            <textarea class="txtAreaMedioTransacao" name="publicoJornadaTransacaoPF" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Qual será a métrica de sucesso da transação no canal? (Exemplos: Satisfação - nota de avaliação WhatsApp, Volume de negócios digitais, etc)?</span>
                        <div>
                            <textarea class="txtAreaMedioTransacao" name="metricaSucessoJornadaTransacaoPF" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Qual o resultado projetado nos primeiros 6 meses com a implementação da transação no canal?</span>
                        <div>
                            <textarea class="txtAreaMedioTransacao" name="resultadoProjetadoJornadaTransacaoPF" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Como será feito o acompanhamento dessa(s) métrica(s) de sucesso?</span>
                        <div>
                            <textarea class="txtAreaMedioTransacao" name="acompanhamentoMetricaSucessoJornadaTransacaoPF" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Como o público-alvo será estimulado a consumir essa transação no canal?</span>
                        <div>
                            <textarea class="txtAreaMedioTransacao" name="estimuloConsumoJornadaTransacaoPF" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                        
                </div>
                <div class="fimFormularioTransacao">
                    <button type="button" class="btnLimpar" >LIMPAR</button>
                    <button type="button" class="btnCadastrar" >CADASTRAR</button>
                    <button type="button" class="btnCadastrarDesabilitado" >CADASTRAR</button>
                </div>
            </div>
            <!--Formulario Transação PJ-->
            <div class = "divSolicitacaoJornadaPJ setorJornadaPJ">
                <div class="linhaDivisoria"></div>
                <div class="nestFormularioJornadaPJ">
                    <div class="divEsquerdaFormularioSolicitacaoClientePJ">
                        <div class="divItemFormularioSolicitacaoClientePJ">
                            <span class="itemFormulario">Nome do Solicitante</span>
                            <div class="divInputFormJornadaPJ">
                                <input type="text" class="inputFormJornadaPJ" id="nomeSolicitanteJornadaPJ" />
                            </div>
                        </div>
                        <div class="divItemFormularioSolicitacaoClientePJ">    
                            <span class="itemFormulario">Matrícula</span>
                            <div class="divInputFormJornadaPJ">
                                <input type="text" class="inputFormJornadaPJ" id="matriculaSolicitanteJornadaPJ" />
                            </div>
                        </div>
                        <div class="divItemFormularioSolicitacaoClientePJ">    
                            <span class="itemFormulario">E-mail</span>
                            <div class="divInputFormJornadaPJ">
                                <input type="text" class="inputFormJornadaPF" id="emailSolicitanteJornadaPJ" />
                            </div>
                        </div>    
                        <div class="divItemFormularioSolicitacaoClientePF">
                            <span class="itemFormulario">Dependência</span>
                            <div class="divInputFormJornadaPJ">
                                <input type="text" class="inputFormJornadaPJ" id="matriculaSolicitanteJornadaPJ" />
                            </div>
                        </div>    
                    </div>
                    <div class="divDireitaFormularioSolicitacaoSolicitacoes">
                        <div>
                            <p>Qual o tipo de jornada será incluída?</p>
                            <form >
                                <div class="radio-container containerInputEAvisoPJ">
                                    <div class="nestAvisoTipoJornadaPJ" id="divAvisoJornadaTransacaoPJ">
                                        <div class="divAvisoTipoJornadaPJ" >
                                            <span class="textoAvisoTipoJornadaPJ"><strong>Transação:</strong> São as consultas e contratações que o bot consegue realizar desde que haja integração com outros sistemas</span>
                                        </div>    
                                        <div class="setaBaixo"></div>
                                    </div>
                                    <label for="radioTransacaoPJ">
                                        <input type="radio" id="radioTransacaoPJ" name="tipoJornadaPJ" value="transacaoPJ" />
                                        <div class="custom-radio">
                                        <span></span>
                                        </div>
                                        <span style="font-color=#646464;">Transação</span>
                                        <div class="svgInterrogacao" id= "divIconeInterrogaTransacao">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="28" viewBox="0 0 31 28" fill="none">
                                            <path d="M30.4556 14.001C30.4556 21.7335 23.6379 28.002 15.2278 28.002C6.81772 28.002 0 21.7335 0 14.001C0 6.26845 6.81772 0 15.2278 0C23.6379 0 30.4556 6.26845 30.4556 14.001Z" fill="#E0E9FF"/>
                                            <path d="M17.563 16.1768L13.8253 15.7221L15.9077 13.3527C16.6908 12.4273 17.207 11.7731 17.4562 11.3902C17.7232 10.9913 17.8566 10.5765 17.8566 10.1457C17.8566 9.60317 17.6609 9.17237 17.2693 8.85326C16.8777 8.53415 16.3349 8.3746 15.6407 8.3746C13.9143 8.3746 12.4993 9.17237 11.3958 10.7679L8.45898 9.04473C9.36671 7.67255 10.4257 6.65938 11.636 6.0052C12.8641 5.33507 14.2791 5 15.881 5C17.0557 5 18.1058 5.18349 19.0314 5.55047C19.9747 5.91744 20.7044 6.436 21.2206 7.10613C21.7367 7.76031 21.9948 8.51022 21.9948 9.35586C21.9948 10.1696 21.7723 10.9355 21.3274 11.6535C20.9002 12.3715 20.2328 13.2251 19.325 14.2143L17.563 16.1768ZM15.614 22.1123C14.8843 22.1123 14.2791 21.8969 13.7986 21.4661C13.318 21.0353 13.0777 20.5008 13.0777 19.8626C13.0777 19.2084 13.318 18.6579 13.7986 18.2112C14.2791 17.7485 14.8843 17.5171 15.614 17.5171C16.3438 17.5171 16.9489 17.7405 17.4295 18.1872C17.91 18.618 18.1503 19.1526 18.1503 19.7908C18.1503 20.429 17.91 20.9795 17.4295 21.4422C16.9489 21.8889 16.3438 22.1123 15.614 22.1123Z" fill="#465EFF"/>
                                            </svg>
                                        </div>
                                    </label>
                                </div>

                                <div class="radio-container containerInputEAvisoPJ">
                                    <div class="nestAvisoTipoJornadaPJ" id="divAvisoJornadaInformacionalPJ">
                                        <div class="divAvisoTipoJornadaPJ" >
                                            <span class="textoAvisoTipoJornadaPJ" id="informacionalTextoAvisoJornadaPJ"><strong>Informacional:</strong>  É todo o conteúdo armazenado no corpo de conhecimento do bot que fica disponível para consulta a partir da interação do cliente. São dados que não dependem da identificação do cliente nem da consulta a outro sistema</span>
                                        </div>    
                                        <div class="setaBaixo"></div>
                                    </div>
                                    <label for="radioJornadaInformacionalPJ">
                                        <input type="radio" id="radioJornadaInformacionalPJ" name="tipoJornadaPJ" value="jornadaInformacionaPJ"  />
                                        <div class="custom-radio">
                                        <span></span>
                                        </div>
                                        <span style="font-color=#646464;">Jornada Informacional</span>
                                        <div class="svgInterrogacao" id= "divIconeceInterrogaJornadaInf">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="28" viewBox="0 0 31 28" fill="none">
                                            <path d="M30.4556 14.001C30.4556 21.7335 23.6379 28.002 15.2278 28.002C6.81772 28.002 0 21.7335 0 14.001C0 6.26845 6.81772 0 15.2278 0C23.6379 0 30.4556 6.26845 30.4556 14.001Z" fill="#E0E9FF"/>
                                            <path d="M17.563 16.1768L13.8253 15.7221L15.9077 13.3527C16.6908 12.4273 17.207 11.7731 17.4562 11.3902C17.7232 10.9913 17.8566 10.5765 17.8566 10.1457C17.8566 9.60317 17.6609 9.17237 17.2693 8.85326C16.8777 8.53415 16.3349 8.3746 15.6407 8.3746C13.9143 8.3746 12.4993 9.17237 11.3958 10.7679L8.45898 9.04473C9.36671 7.67255 10.4257 6.65938 11.636 6.0052C12.8641 5.33507 14.2791 5 15.881 5C17.0557 5 18.1058 5.18349 19.0314 5.55047C19.9747 5.91744 20.7044 6.436 21.2206 7.10613C21.7367 7.76031 21.9948 8.51022 21.9948 9.35586C21.9948 10.1696 21.7723 10.9355 21.3274 11.6535C20.9002 12.3715 20.2328 13.2251 19.325 14.2143L17.563 16.1768ZM15.614 22.1123C14.8843 22.1123 14.2791 21.8969 13.7986 21.4661C13.318 21.0353 13.0777 20.5008 13.0777 19.8626C13.0777 19.2084 13.318 18.6579 13.7986 18.2112C14.2791 17.7485 14.8843 17.5171 15.614 17.5171C16.3438 17.5171 16.9489 17.7405 17.4295 18.1872C17.91 18.618 18.1503 19.1526 18.1503 19.7908C18.1503 20.429 17.91 20.9795 17.4295 21.4422C16.9489 21.8889 16.3438 22.1123 15.614 22.1123Z" fill="#465EFF"/>
                                            </svg>
                                        </div>
                                    </label>
                                </div>


                                <div class="radio-container containerInputEAvisoPJ">
                                    <div class="nestAvisoTipoJornadaPJ" id="divAvisoJornadaMensagemAtivaPJ">
                                        <div class="divAvisoTipoJornadaPJ" >
                                            <span class="textoAvisoTipoJornadaPJ" id="mensagemAtivaTextoAvisoJornadaPJ" ><strong>Mensagem Ativa:</strong> Mensagens ativas são aquelas que enviamos para os clientes. Essas mensagens podem ter o intuito de divulgar algum produto ou serviço, enviar alertas ou notificações ou de relacionamento com o cliente</span>
                                        </div>    
                                        <div class="setaBaixo"></div>
                                    </div>
                                    <label for="radioMensagemAtivaPJ">
                                        <input type="radio" id="radioMensagemAtivaPJ" name="tipoJornadaPJ" value="mensagemAtivaPJ" />
                                        <div class="custom-radio">
                                            <span></span>
                                        </div>
                                        <span>Mensagem Ativa</span>
                                        <div class="svgInterrogacao" id= "divIconeInterrogaMensagemAtiva">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="28" viewBox="0 0 31 28" fill="none">
                                            <path d="M30.4556 14.001C30.4556 21.7335 23.6379 28.002 15.2278 28.002C6.81772 28.002 0 21.7335 0 14.001C0 6.26845 6.81772 0 15.2278 0C23.6379 0 30.4556 6.26845 30.4556 14.001Z" fill="#E0E9FF"/>
                                            <path d="M17.563 16.1768L13.8253 15.7221L15.9077 13.3527C16.6908 12.4273 17.207 11.7731 17.4562 11.3902C17.7232 10.9913 17.8566 10.5765 17.8566 10.1457C17.8566 9.60317 17.6609 9.17237 17.2693 8.85326C16.8777 8.53415 16.3349 8.3746 15.6407 8.3746C13.9143 8.3746 12.4993 9.17237 11.3958 10.7679L8.45898 9.04473C9.36671 7.67255 10.4257 6.65938 11.636 6.0052C12.8641 5.33507 14.2791 5 15.881 5C17.0557 5 18.1058 5.18349 19.0314 5.55047C19.9747 5.91744 20.7044 6.436 21.2206 7.10613C21.7367 7.76031 21.9948 8.51022 21.9948 9.35586C21.9948 10.1696 21.7723 10.9355 21.3274 11.6535C20.9002 12.3715 20.2328 13.2251 19.325 14.2143L17.563 16.1768ZM15.614 22.1123C14.8843 22.1123 14.2791 21.8969 13.7986 21.4661C13.318 21.0353 13.0777 20.5008 13.0777 19.8626C13.0777 19.2084 13.318 18.6579 13.7986 18.2112C14.2791 17.7485 14.8843 17.5171 15.614 17.5171C16.3438 17.5171 16.9489 17.7405 17.4295 18.1872C17.91 18.618 18.1503 19.1526 18.1503 19.7908C18.1503 20.429 17.91 20.9795 17.4295 21.4422C16.9489 21.8889 16.3438 22.1123 15.614 22.1123Z" fill="#465EFF"/>
                                            </svg>
                                        </div>
                                    </label>
                                </div>
                        </div>
                    </div>
                    
                </div>

            </div>
            <div class = "divSolicitacaoJornadaTransacaoPJ setorJornadaPJ">
                <div class="linhaDivisoria"></div>
                <div class="nestFormularioJornadaTransacaoPFDuasColunas">
                    <div class="divEsquerdaFormularioSolicitacaoClientePJ" id="divJornadaTransacaoPJ">
                        <div class="divItemFormularioSolicitacaoClientePJ">
                            <span class="itemFormulario">Qual o tema/produto?</span>
                            <div class="divInputFormJornadaPJ">
                                <input type="text" class="inputFormJornadaPJ" id="temaProdutoTransacaoPJ" />
                            </div>
                        </div>
                        <div class="divItemFormularioSolicitacaoClientePF">    
                            <span class="itemFormulario">Em qual canal deseja incluir a transação?</span>
                            <div class="divInputFormJornadaPJ">
                                <select class="inputFormJornadaPJ" id="canalTransacaoPJ"></select>
                            </div>
                        </div>
                        <div class="radioComTitulo">
                            <span class="itemFormulario tituloRadioBtnFormulario">A transação visa atender RA (Recomendação de auditoria) ou Regulatório (Regulamento ou lei específica)?</span>
                            <div class="radio-container">
                                <label for="radioTransacaoRaRegSimPJ">
                                    <input type="radio" id="radioTransacaoRaRegSimPJ" name="RARegulatorio" value="sim" />
                                    <div class="custom-radio">
                                        <span></span>
                                    </div>
                                    <span>Sim</span>
                                </label>
                            </div>   
                            <div class="radio-container">
                                <label for="radioTransacaoRaRegNaoPJ">
                                    <input type="radio" id="radioTransacaoRaRegNaoPJ" name="RARegulatorio" value="nao" />
                                    <div class="custom-radio">
                                        <span></span>
                                    </div>
                                    <span>Não</span>
                                </label>
                            </div>   
                        </div>
                        <div class="radioComTitulo">
                            <span class="itemFormulario tituloRadioBtnFormulario">A RA ou Regulatório especifica que a transação deve ser disponibilizada no WhatsApp?</span>
                            <div class="radio-container">
                                <label for="radioTransacaoWhatsSimPJ">
                                    <input type="radio" id="radioTransacaoWhatsSimPJ" name="disponivelNoWhats" value="sim" />
                                    <div class="custom-radio">
                                        <span></span>
                                    </div>
                                    <span>Sim</span>
                                </label>
                            </div>   
                            <div class="radio-container">
                                <label for="radioTransacaoWhatsNaoPJ">
                                    <input type="radio" id="radioTransacaoWhatsNaoPJ" name="disponivelNoWhats" value="nao" />
                                    <div class="custom-radio">
                                        <span></span>
                                    </div>
                                    <span>Não</span>
                                </label>
                            </div>   
                        </div>  
                        
                    </div>
                    <div class="divDireitaFormularioSolicitacaoSolicitacoes">
                        <div>
                            <div class="divItemFormularioSolicitacaoClientePJ">
                                <span class="itemFormulario">Qual o assunto principal da transação?</span>
                                <div class="divInputFormJornadaPJ">
                                    <input type="text" class="inputFormJornadaPJ" id="assuntoTransacaoPJ" placeholder= "Escreva o nome" />
                                </div>
                            </div>
                            <div class="divItemFormularioSolicitacaoClientePJ">
                                <span class="itemFormulario">Qual o objetivo da transação? (o que é esperado que o cliente consiga fazer ao utilizar a transação)</span>
                                <div>
                                <textarea class="txtAreaMedioTransacao" name="objetivoTransacaoPJ" rows="7" cols="55" maxlength="200" placeholder= "Mensagem"></textarea>
                                </div>
                            </div>
                            <div class="divItemFormularioSolicitacaoClientePJ">
                                <span class="itemFormulario">Em quais canais a transação já existe?</span>
                                <div>
                                    <textarea class="txtAreaMedioTransacao" name="canaisJaExistentes" rows="7" cols="55" maxlength="200" placeholder= "Mensagem"></textarea>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="nestFormularioJornadaTransacaoPJUmaColuna">
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Qual o público da jornada?</span>
                        <div>
                            <textarea class="txtAreaMedioTransacao" name="publicoJornadaTransacaoPJ" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Qual será a métrica de sucesso da transação no canal? (Exemplos: Satisfação - nota de avaliação WhatsApp, Volume de negócios digitais, etc)?</span>
                        <div>
                            <textarea class="txtAreaMedioTransacao" name="metricaSucessoJornadaTransacaoPJ" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Qual o resultado projetado nos primeiros 6 meses com a implementação da transação no canal?</span>
                        <div>
                            <textarea class="txtAreaMedioTransacao" name="resultadoProjetadoJornadaTransacaoPJ" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Como será feito o acompanhamento dessa(s) métrica(s) de sucesso?</span>
                        <div>
                            <textarea class="txtAreaMedioTransacao" name="acompanhamentoMetricaSucessoJornadaTransacaoPJ" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Como o público-alvo será estimulado a consumir essa transação no canal?</span>
                        <div>
                            <textarea class="txtAreaMedioTransacao" name="estimuloConsumoJornadaTransacaoPJ" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                        
                </div>
                <div class="fimFormularioTransacao">
                    <button type="button" class="btnLimpar" >LIMPAR</button>
                    <button type="button" class="btnCadastrar" >CADASTRAR</button>
                    <button type="button" class="btnCadastrarDesabilitado" >CADASTRAR</button>
                </div>
            </div>
            <!--JORNADA INFORMACIONAL-->
            
            <!--Público PF-->

            <div class = "divSolicitacaoJornadaInformacionalPF setorJornadaPF">
                <div class="linhaDivisoria"></div>
                <div class="nestFormularioJornadaInformacionalPFDuasColunas">
                    <div class="divEsquerdaFormularioSolicitacaoClientePF" id="divJornadaInformacionalPF">
                        <div class="divItemFormularioSolicitacaoClientePF">    
                            <span class="itemFormulario">PJEm qual canal deseja incluir a jornada?PJ</span>
                            <div class="divInputFormJornadaPF">
                                <select class="inputFormJornadaPF" id="canalJornadaInformacionalPF"></select>
                            </div>
                        </div>
                        <div class="radioComTitulo">
                            <span class="itemFormulario tituloRadioBtnFormulario">A transação visa atender RA (Recomendação de auditoria)?</span>
                            <div class="radio-container">
                                <label for="radioInformacionalRaSim">
                                    <input type="radio" id="radioInformacionalRaSim" name="informacionalRA" value="sim" />
                                    <div class="custom-radio">
                                        <span></span>
                                    </div>
                                    <span>Sim</span>
                                </label>
                            </div>   
                            <div class="radio-container">
                                <label for="radioInformacionalRaNao">
                                    <input type="radio" id="radioInformacionalRaNao" name="informacionalRA" value="nao" />
                                    <div class="custom-radio">
                                        <span></span>
                                    </div>
                                    <span>Não</span>
                                </label>
                            </div>   
                        </div>
                        
                    </div>
                    <div class="divDireitaFormularioSolicitacaoSolicitacoes">
                        <div>
                            <div class="radioComTitulo" id ="divJornadaInformacionalDisponivelWhatsPF">
                                <span class="itemFormulario tituloRadioBtnFormulario">A RA especifica que a jornada deve ser disponibilizada no WhatsApp?</span>
                                <div class="radio-container">
                                    <label for="radioInformacionalWhatsSim">
                                        <input type="radio" id="radioInformacionalWhatsSim" name="informacionalDisponivelNoWhats" value="sim" />
                                        <div class="custom-radio">
                                            <span></span>
                                        </div>
                                        <span>Sim</span>
                                    </label>
                                </div>   
                                <div class="radio-container">
                                    <label for="radioInformacionalWhatsNao">
                                        <input type="radio" id="radioInformacionalWhatsNao" name="informacionalDisponivelNoWhats" value="nao" />
                                        <div class="custom-radio">
                                            <span></span>
                                        </div>
                                        <span>Não</span>
                                    </label>
                                </div>   
                            </div>  
                        </div>
                    </div>
                </div>
                <div class="nestFormularioJornadaInformacionalUmaColuna">
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Qual o assunto principal da jornada?</span>
                        <div>
                            <textarea class="txtAreaMedioInformacional" name="publicoJornadaInformacionalPF" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Qual o objetivo da jornada?</span>
                        <div>
                            <textarea class="txtAreaMedioInformacional" name="objetivoJornadaInformacionalPF" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Qual será a métrica de sucesso da jornada no canal? (Exemplos: Satisfação - nota de avaliação WhatsApp, Volume de negócios digitais, etc)</span>
                        <div>
                            <textarea class="txtAreaMedioInformacional" name="metricadeSucessoJornadaInformacionalPF" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Qual o resultado projetado nos primeiros 6 meses com a implementação da jornada no canal?</span>
                        <div>
                            <textarea class="txtAreaMedioInformacional" name="resultadoProjetadoJornadaInformacionalPF" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Como será feito o acompanhamento dessa(s) métrica(s) de sucesso?</span>
                        <div>
                            <textarea class="txtAreaMedioInformacional" name="acompanhamentoMetricasJornadaInformacionalPF" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Como o público-alvo será estimulado a consumir essa jornada no canal?</span>
                        <div>
                            <textarea class="txtAreaMedioInformacional" name="estimuloPublicoJornadaInformacionalPF" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                        
                </div>
                <div class="fimFormularioTransacao">
                    <button type="button" class="btnLimpar" >LIMPAR</button>
                    <button type="button" class="btnCadastrar" >CADASTRAR</button>
                    <button type="button" class="btnCadastrarDesabilitado" >CADASTRAR</button>
                </div>
            </div>

            <!--Publico PJ-->
            <div class = "divSolicitacaoJornadaInformacionalPJ setorJornadaPJ">
                <div class="linhaDivisoria"></div>
                <div class="nestFormularioJornadaInformacionalPJDuasColunas">
                    <div class="divEsquerdaFormularioSolicitacaoClientePJ" id="divJornadaInformacionalPJ">
                        <div class="divItemFormularioSolicitacaoClientePJ">    
                            <span class="itemFormulario">PJPJPJEm qual canal deseja incluir a jornada?</span>
                            <div class="divInputFormJornadaPJ">
                                <select class="inputFormJornadaPJ" id="canalJornadaInformacionalPJ"></select>
                            </div>
                        </div>
                        <div class="radioComTitulo">
                            <span class="itemFormulario tituloRadioBtnFormulario">A transação visa atender RA (Recomendação de auditoria)?</span>
                            <div class="radio-container">
                                <label for="radioInformacionalRaSimPJ">
                                    <input type="radio" id="radioInformacionalRaSimPJ" name="informacionalRaPJ" value="sim" />
                                    <div class="custom-radio">
                                        <span></span>
                                    </div>
                                    <span>Sim</span>
                                </label>
                            </div>   
                            <div class="radio-container">
                                <label for="radioInformacionalRaNaoPJ">
                                    <input type="radio" id="radioInformacionalRaNaoPJ" name="informacionalRaPJ" value="nao" />
                                    <div class="custom-radio">
                                        <span></span>
                                    </div>
                                    <span>Não</span>
                                </label>
                            </div>   
                        </div>
                        
                    </div>
                    <div class="divDireitaFormularioSolicitacaoSolicitacoes">
                        <div>
                            <div class="radioComTitulo" id ="divJornadaInformacionalDisponivelWhatsPJ">
                                <span class="itemFormulario tituloRadioBtnFormulario">A RA especifica que a jornada deve ser disponibilizada no WhatsApp?</span>
                                <div class="radio-container">
                                    <label for="radioInformacionalWhatsSimPJ">
                                        <input type="radio" id="radioInformacionalWhatsSimPJ" name="informacionalDisponivelNoWhatsPJ" value="sim" />
                                        <div class="custom-radio">
                                            <span></span>
                                        </div>
                                        <span>Sim</span>
                                    </label>
                                </div>   
                                <div class="radio-container">
                                    <label for="radioInformacionalWhatsNaoPJ">
                                        <input type="radio" id="radioInformacionalWhatsNaoPJ" name="informacionalDisponivelNoWhatsPJ" value="nao" />
                                        <div class="custom-radio">
                                            <span></span>
                                        </div>
                                        <span>Não</span>
                                    </label>
                                </div>   
                            </div>  
                        </div>
                    </div>
                </div>
                <div class="nestFormularioJornadaInformacionalUmaColuna">
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Qual o assunto principal da jornada?</span>
                        <div>
                            <textarea class="txtAreaMedioInformacional" name="publicoJornadaInformacionalPJ" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Qual o objetivo da jornada?</span>
                        <div>
                            <textarea class="txtAreaMedioInformacional" name="objetivoJornadaInformacionalPJ" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Qual será a métrica de sucesso da jornada no canal? (Exemplos: Satisfação - nota de avaliação WhatsApp, Volume de negócios digitais, etc)</span>
                        <div>
                            <textarea class="txtAreaMedioInformacional" name="metricadeSucessoJornadaInformacionalPJ" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Qual o resultado projetado nos primeiros 6 meses com a implementação da jornada no canal?</span>
                        <div>
                            <textarea class="txtAreaMedioInformacional" name="resultadoProjetadoJornadaInformacionalPJ" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Como será feito o acompanhamento dessa(s) métrica(s) de sucesso?</span>
                        <div>
                            <textarea class="txtAreaMedioInformacional" name="acompanhamentoMetricasJornadaInformacionalPJ" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                    <div class="itemFormularioTextAreaGrande">
                        <span class="itemFormulario">Como o público-alvo será estimulado a consumir essa jornada no canal?</span>
                        <div>
                            <textarea class="txtAreaMedioInformacional" name="estimuloPublicoJornadaInformacionalPJ" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                        </div>
                    </div>
                        
                </div>
                <div class="fimFormularioTransacao">
                    <button type="button" class="btnLimpar" >LIMPAR</button>
                    <button type="button" class="btnCadastrar" >CADASTRAR</button>
                    <button type="button" class="btnCadastrarDesabilitado" >CADASTRAR</button>
                </div>
            </div>
         </form>    
        </div>
        
    </div>
    <!--Fim da Aba de Nova Solicitação-->
    
    <div id="abaAcompanharSolicitacao">
        <div class="divInicialConsultaSolicitacoesGestor">
            <div class= "alert success" id="alertaSucessoCadastroSolicitacao">
                <!-- X fechar alert-->
                <span class="alertClose" id="fechaDivAlerCadastroSucesso">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <g id="close">
                            <path id="Vector" d="M13.3337 12.3933L12.3937 13.3333L8.00033 8.93996L3.60699 13.3333L2.66699 12.3933L7.06033 7.99996L2.66699 3.60663L3.60699 2.66663L8.00033 7.05996L12.3937 2.66663L13.3337 3.60663L8.94033 7.99996L13.3337 12.3933Z" fill="#313338"/>
                        </g>
                    </svg>
                </span>
                <!--check ícone do alert-->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <g id="Icon">
                        <path id="Vector" d="M12 2C6.477 2 2 6.477 2 12C2 17.523 6.477 22 12 22C17.523 22 22 17.523 22 12C22 6.477 17.522 2 12 2ZM11.25 17.75L6.25 14L7.75 12L10.75 14.25L16 7.25L18 8.75L11.25 17.75Z" fill="#0C8A00"/>
                    </g>
                </svg>
                <span class="alertText">Sua Solicitação foi cadastrada com sucesso! Acompanhe a sua solicitação e aguarde a análise pelo CAD</span>
            </div>
            <div class= "nestAreaTabelaFiltrosConsultaSolicitacoesGestor">
                <div class ="divTituloTabela"> Solicitações cadastradas</div>
                <div class= "areaPesquisaFiltros">
                    <div class= "filtrosPesquisa">
                        <div class="campoPesquisaID">
                            <div style="position: relative">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                            </div>
                            <div class= "interiorCampoPesquisa">
                                <input type="text" class="inputCampoPesquisa" attr-campoalterado="0" id="campoID" placeholder="Procure pelo ID">
                            </div>
                        </div>
                        <div class="campoFiltroPesquisa">
                            <input type="text" 
                                onfocus="this.type='date';" 
                                onblur="this.type='text';" 
                                class="inputCampoPesquisa" 
                                attr-campoalterado="0" 
                                id="dataAberturaSolicitacao" 
                                placeholder="Data Abertura">
                        </div>
                        <div class= "campoFiltroPesquisa">
                            <select name="campoStatusSolicitacao" id="campoStatusSolicitacao" class="selectFiltroPesquisa" attr-campoalterado="0" style="width: 90%;">
                                    <option>Status</option>
                            </select>

                        </div>
                        <div class="divBtnPesquisa divBtnMaisFiltros">
                            <input type="button" class="btnPersonalizar maisFiltros" value="Mais filtros" id=""> 
                        </div>
                        <div class="divBtnPesquisa divBtnMaisFiltros">
                            <input type="button" class="btnPersonalizar limparFiltros" value="Limpar" id=""> 
                        </div>

                    </div>    
                </div>
               <div class="areaTabelaConsultaSolicitacoes">
                <div class="dataTables_wrapper dt-bootstrap5 no-footer" style="width: 100%;">
                    <table class="table dataTable no-footer" id="tabelaConsultaSolicitacao">
                        <thead>
                            <th id="cabecalhoTabela" class="sorting cabecalhoTabela" tabindex="0" aria-controls="tabelaConsultaSolicitacao" rowspan= "1" colspan= "1" aria-label="ID" style="width: 13%;">ID</th> 
                            <th id="cabecalhoTabela" class="sorting cabecalhoTabela" tabindex="0" aria-controls="tabelaConsultaSolicitacao" rowspan= "1" colspan= "1" aria-label="ID" style="width: 25%;">Tema/Produto</th> 
                            <th id="cabecalhoTabela" class="sorting cabecalhoTabela" tabindex="0" aria-controls="tabelaConsultaSolicitacao" rowspan= "1" colspan= "1" aria-label="ID" style="width: 25%;">Data Abertura</th> 
                            <th id="cabecalhoTabela" class="sorting cabecalhoTabela" tabindex="0" aria-controls="tabelaConsultaSolicitacao" rowspan= "1" colspan= "1" aria-label="ID" style="width: 25%;">Status</th> 
                            <th id="cabecalhoTabela" class="cabecalhoTabela" tabindex="0" aria-controls="tabelaConsultaSolicitacao" rowspan= "1" colspan= "1" aria-label="ID" style="width: 5%;"></th> 
                            <th id="cabecalhoTabela" class="cabecalhoTabela" tabindex="0" aria-controls="tabelaConsultaSolicitacao" rowspan= "1" colspan= "1" aria-label="ID" style="width: 5%;"></th> 
                        </thead>
                        <tbody>  
                            <tr>
                                <td>#01</td>  
                                <td>PIX</td>
                                <td>16/01/2025</td>
                                <td>
                                    <div class="statusSolicitacao"><img src="https://cad.bb.com.br/lib/apps/solicitacoes_Yasmin/img/novaTagStatus.png"></div>
                                </td>    
                                <td id=" iconeEditar" class="Clicar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                        <path d="M16.8177 10.5099L9.78741 17.5422L14.4586 22.212L21.4888 15.1797L16.8177 10.5099Z" fill="#AEAEAE"/>
                                        <path d="M22.6494 14.0226L23.2402 13.4326C24.5276 12.1452 24.5276 10.0496 23.2402 8.76144C21.9528 7.47405 19.8564 7.47405 18.569 8.76144L17.9791 9.35221L22.6494 14.0226Z" fill="#AEAEAE"/>
                                        <path d="M13.0462 23.1221L8.8156 24.1789C8.5358 24.2478 8.2396 24.1666 8.03611 23.9631C7.83262 23.7596 7.75057 23.4634 7.82031 23.1844L8.87795 18.9538L13.0462 23.1221Z" fill="#AEAEAE"/>
                                        <path d="M28.4444 3.55556V28.4444H3.55556V3.55556H28.4444ZM28.4444 0H3.55556C1.6 0 0 1.6 0 3.55556V28.4444C0 30.4 1.6 32 3.55556 32H28.4444C30.4 32 32 30.4 32 28.4444V3.55556C32 1.6 30.4 0 28.4444 0Z" fill="#AEAEAE"/>
                                    </svg>
                                </td>
                                <td id="iconeNavega" class="Clicar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M8.99984 3L7.58984 4.41L15.1698 12L7.58984 19.59L8.99984 21L17.9998 12L8.99984 3Z" fill="#888D95"/>
                                    </svg>
                                </td>

                            </tr>  
                            <tr>
                                <td>#02</td>  
                                <td>PIX</td>
                                <td>16/02/2025</td>
                                <td>
                                    <div class="statusSolicitacao"><img src="https://cad.bb.com.br/lib/apps/solicitacoes_Yasmin/img/emAnaliseTagStatus.png"></div>
                                </td>
                                <td></td>
                                <td id="iconeNavega" class="Clicar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M8.99984 3L7.58984 4.41L15.1698 12L7.58984 19.59L8.99984 21L17.9998 12L8.99984 3Z" fill="#888D95"/>
                                    </svg>
                                </td>

                            </tr>
                            <tr>
                                <td>#03</td>  
                                <td>PIX</td>
                                <td>16/03/2025</td>
                                <td>
                                    <div class="statusSolicitacao"><img src="https://cad.bb.com.br/lib/apps/solicitacoes_Yasmin/img/encerradaTagStatus.png"></div>
                                </td>
                                <td></td>
                                <td id="iconeNavega" class="Clicar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M8.99984 3L7.58984 4.41L15.1698 12L7.58984 19.59L8.99984 21L17.9998 12L8.99984 3Z" fill="#888D95"/>
                                    </svg>
                                </td>
                            </tr>          
                            <tr>
                                <td>#04</td>  
                                <td>PIX</td>
                                <td>16/04/2025</td>
                                <td>
                                    <div class="statusNova"><img src="https://cad.bb.com.br/lib/apps/solicitacoes_Yasmin/img/aprovadaTagStatus.png"></div>
                                </td>
                                <td></td>
                                <td id="iconeNavega" class="Clicar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M8.99984 3L7.58984 4.41L15.1698 12L7.58984 19.59L8.99984 21L17.9998 12L8.99984 3Z" fill="#888D95"/>
                                    </svg>
                                </td>

                            </tr>  
                        </tbody>    
                    </table>
               </div> 

            </div>
        </div> 
    </div>
    <div class="divConsultaDetalheSolicitacao">
        <div class= "cabecalhoAbaConsultaSolicitacao">
            <div class="voltaIDCabecalho">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M8.707 7.29309L4 12.0001L8.707 16.7071L10.121 15.2931L7.828 13.0001H19.414V11.0001L7.828 11.0001L10.121 8.70709L8.707 7.29309Z" fill="#2D37F5"/>
                </svg>
                <span class = "textoVoltarDetalheSolicitacao">Voltar</span> <span class ="idCabecalhoDetalheSolicitacao"> / #ID01 </span >
            </div>
            <span class="temaProdutoDetalheSolicitacao">PIX </span>
            <div class="detalheStatusConsultaSolicitacao">
                <img src="https://cad.bb.com.br/lib/apps/solicitacoes_Yasmin/img/novaTagStatus.png">
                <span class="mensagemStatusNova"> Sua solicitação foi aberta e está aguardando ser analisada pelo CAD, altere as informações se necessário</span>
            </div>
            <div class="detalheStatusConsultaSolicitacao">
                <img src="https://cad.bb.com.br/lib/apps/solicitacoes_Yasmin/img/emAnaliseTagStatus.png">
                <span class="mensagemStatusAnalise"> Sua Solicitação está sendo avaliada pelo CAD</span>
            </div>
            <div class="detalheStatusConsultaSolicitacao">
                <img src="https://cad.bb.com.br/lib/apps/solicitacoes_Yasmin/img/encerradaTagStatus.png">
                <span class="mensagemStatusEncerrada"> Sua solicitação foi encerrada</span>
            </div>
        </div>
        <div class= "linhaDivisoria" style = "margin-top:5%;"></div>
        <div class="divComentarioCadSolicitacaoEncerrada">
            <div class = "iconeComentarioCAD" >
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="26" viewBox="0 0 25 26" fill="none">
                <path d="M20.3128 10.0209H21.9611V12.007H20.6308L17.0663 14.7875C16.8973 14.9186 16.6958 14.9862 16.4934 14.9862C16.2401 14.9862 15.9973 14.8815 15.8182 14.6953C15.6391 14.5091 15.5385 14.2565 15.5385 13.9931V12.007H14.5837V10.0209H16.4934C16.7466 10.0209 16.9895 10.1255 17.1686 10.3117C17.3476 10.498 17.4482 10.7506 17.4482 11.0139V12.007L19.7399 10.2195C19.9052 10.0906 20.1062 10.0209 20.3128 10.0209Z" fill="#646464"/>
                <path d="M20.8337 10.0209H22.05V3.06949H12.5014V6.04865H10.5916V3.06949C10.5916 1.97414 11.4482 1.08337 12.5014 1.08337H22.05C23.1032 1.08337 23.9597 1.97414 23.9597 3.06949V10.0209C23.9597 11.1152 23.1032 12.007 22.05 12.007H20.8337V10.0209Z" fill="#646464"/>
                <path d="M10.5941 6.6445V5.52504H12.5038V6.6445H10.5941Z" fill="#646464"/>
                <path d="M9.37533 16.25C11.6722 16.25 13.542 14.3055 13.542 11.9167C13.542 9.52796 11.6722 7.58337 9.37533 7.58337C7.07845 7.58337 5.20866 9.52796 5.20866 11.9167C5.20866 14.3055 7.07845 16.25 9.37533 16.25Z" fill="#646464"/>
                <path d="M9.37533 17.3334C4.46803 17.3334 1.04199 20.006 1.04199 23.8334V24.9167H17.7087V23.8334C17.7087 20.006 14.2826 17.3334 9.37533 17.3334Z" fill="#646464"/>
            </svg>
            </div>
            <div class = "textoComentarioCAD" >
                <span class="tituloComentarioCAD">Comentário do CAD: </span><br>
                <span class= "textoComentarioCAD"> Solicitação não está alinhada aos direcionadores estratégicos definidos para o trimestre</span>
            </div>

        </div>
            <div class="divDadosdaSolicitacao">
                <div class="divTituloSecaoDadosDaSolicitacao">
                    Dados da solicitação
                    <!--Icon chevron up-->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M7.41 15.41L12 10.83L16.59 15.41L18 14L12 8L6 14L7.41 15.41Z" fill="#2D37F5"/>
                    </svg>
                </div>   

            </div>
    </div>
    <!-- Layout da página de solicitação aprovada -->
    <div class="divConsultaDetalheSolicitacao">
        <div class= "cabecalhoAbaConsultaSolicitacao">
            <div class="voltaIDCabecalho">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M8.707 7.29309L4 12.0001L8.707 16.7071L10.121 15.2931L7.828 13.0001H19.414V11.0001L7.828 11.0001L10.121 8.70709L8.707 7.29309Z" fill="#2D37F5"/>
                </svg>
                <span class = "textoVoltarDetalheSolicitacao">Voltar</span> <span class ="idCabecalhoDetalheSolicitacao"> / #ID01 </span >
            </div>
            <span class="temaProdutoDetalheSolicitacao">PIX </span>
            <div class="detalheStatusConsultaSolicitacao">
                <img src="https://cad.bb.com.br/lib/apps/solicitacoes_Yasmin/img/aprovadaTagStatus.png">
                <span class="mensagemStatusAprovada"> Sua solicitação foi aprovada</span>
            </div>
        </div>
        <div class= "linhaDivisoria" style = "margin-top:5%;"></div>
        <div class="divComentarioCadSolicitacaoEncerrada">
            <div class = "iconeComentarioCAD" >
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="26" viewBox="0 0 25 26" fill="none">
                <path d="M20.3128 10.0209H21.9611V12.007H20.6308L17.0663 14.7875C16.8973 14.9186 16.6958 14.9862 16.4934 14.9862C16.2401 14.9862 15.9973 14.8815 15.8182 14.6953C15.6391 14.5091 15.5385 14.2565 15.5385 13.9931V12.007H14.5837V10.0209H16.4934C16.7466 10.0209 16.9895 10.1255 17.1686 10.3117C17.3476 10.498 17.4482 10.7506 17.4482 11.0139V12.007L19.7399 10.2195C19.9052 10.0906 20.1062 10.0209 20.3128 10.0209Z" fill="#646464"/>
                <path d="M20.8337 10.0209H22.05V3.06949H12.5014V6.04865H10.5916V3.06949C10.5916 1.97414 11.4482 1.08337 12.5014 1.08337H22.05C23.1032 1.08337 23.9597 1.97414 23.9597 3.06949V10.0209C23.9597 11.1152 23.1032 12.007 22.05 12.007H20.8337V10.0209Z" fill="#646464"/>
                <path d="M10.5941 6.6445V5.52504H12.5038V6.6445H10.5941Z" fill="#646464"/>
                <path d="M9.37533 16.25C11.6722 16.25 13.542 14.3055 13.542 11.9167C13.542 9.52796 11.6722 7.58337 9.37533 7.58337C7.07845 7.58337 5.20866 9.52796 5.20866 11.9167C5.20866 14.3055 7.07845 16.25 9.37533 16.25Z" fill="#646464"/>
                <path d="M9.37533 17.3334C4.46803 17.3334 1.04199 20.006 1.04199 23.8334V24.9167H17.7087V23.8334C17.7087 20.006 14.2826 17.3334 9.37533 17.3334Z" fill="#646464"/>
            </svg>
            </div>
            <div class = "textoComentarioCAD" >
                <span class="tituloComentarioCAD">Comentário do CAD: </span><br>
                <span class= "textoComentarioCAD"> Sua solicitação está alinhada aos direcionadores estratégicos</span>
            </div>
        </div>
        <div class="secaoSugestaodaIA">
            <div class= "tituloSugestaoIA">
                <img src="https://cad.bb.com.br/lib/apps/solicitacoes_Yasmin/img/iconeRobo.png">
                    Sugestão da IA para abrir a História
            </div>
            <div class="sugestaoDescricaoIA">
                <div class="conteudoTextoDescricaoIA">
                    <span class= "tituloCaixaSugestaoIA">Descrição</span><br><br>
                        SENDO UM Analista do CAD QUERO QUE seja desenvolvida a página "Nova solicitação" > "Incluir solicitação" e "Acompanhar solicitação" PARA QUE os Gestores possam incluir e consultar novas solicitações de jornadas nos assistentes virtuais. 
                        
                        Ganhos esperados: Na V.1: Padronização da esteira de entradas de demandas no CAD antes da abertura de histórias para avaliação negocial. 
                        
                        Posteriormente será aberta história para a V.2, com utilização de IA generativa para análise das demandas e pontuação.
                </div>
                <!--Icone para copiar-->
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" class = "Clicar">
                    <g id="Group">
                    <g id="Group_2">
                        <path id="Vector" d="M15.75 0H5.625C4.38244 0 3.375 1.00744 3.375 2.25H4.5C4.5 1.62928 5.00484 1.125 5.625 1.125H15.75C16.3707 1.125 16.875 1.62928 16.875 2.25V12.375C16.875 12.9957 16.3707 13.5 15.75 13.5V14.625C16.9926 14.625 18 13.6176 18 12.375V2.25C18 1.00744 16.9926 0 15.75 0ZM12.375 3.375H2.25C1.00744 3.375 0 4.38244 0 5.625V15.75C0 16.9926 1.00744 18 2.25 18H12.375C13.6176 18 14.625 16.9926 14.625 15.75V5.625C14.625 4.38244 13.6176 3.375 12.375 3.375ZM13.5 15.75C13.5 16.3707 12.9957 16.875 12.375 16.875H2.25C1.62984 16.875 1.125 16.3707 1.125 15.75V5.625C1.125 5.00428 1.62984 4.5 2.25 4.5H12.375C12.9957 4.5 13.5 5.00428 13.5 5.625V15.75ZM3.375 7.875H11.25V6.75H3.375V7.875ZM3.375 10.125H11.25V9H3.375V10.125ZM3.375 12.375H11.25V11.25H3.375V12.375ZM3.375 14.625H7.875V13.5H3.375V14.625Z" fill="#646464"/>
                    </g>
                    </g>
                </svg>    

            </div>
            <div class="sugestaoDescricaoIA">
                <div class="conteudoTextoDescricaoIA">
                    <span class= "tituloCaixaSugestaoIA">Critério de aceitação</span><br><br>
                        <p>
                            Desenvolvimento: - inclusão de formulários contendo as perguntas do anexo 1160090 - salvar as respostas dos formulários Para Gestores (outros Dependências): 
                                a) Tela de inclusão de novas demandas (formulário em anexo) Obs: algumas informações devem estar pré-preenchidas com os dados da sessão (matrícula, Dependência, nome, e-mail), com possibilidade do usuário alterar Ao finalizar, modal para quem estiver preenchendo o formulário conferir antes de enviar e, ao confirmar, exibir oferecer a consulta da demanda. 
                                Tela de consulta de demandas abertas pelo Dependência: id da demanda, título da demanda, demandante, tipo de demanda, status Obs: Cada Dependência pode ter até 3 demandas com status "nova" e/ou "em análise" Obs 2:  Acompanhamento do status das demandas: "nova", "em análise", "análise concluída - abrir história", "análise concluída - Encerrada" Obs 3: Gestor poderá consultar somente as demandas do Dependência dele Obs 4: Gestor poderá editar e/ou excluir a demanda somente com status "nova"
                        </p>
                </div>
                <!--Icone para copiar-->
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" class = "Clicar">
                    <g id="Group">
                    <g id="Group_2">
                        <path id="Vector" d="M15.75 0H5.625C4.38244 0 3.375 1.00744 3.375 2.25H4.5C4.5 1.62928 5.00484 1.125 5.625 1.125H15.75C16.3707 1.125 16.875 1.62928 16.875 2.25V12.375C16.875 12.9957 16.3707 13.5 15.75 13.5V14.625C16.9926 14.625 18 13.6176 18 12.375V2.25C18 1.00744 16.9926 0 15.75 0ZM12.375 3.375H2.25C1.00744 3.375 0 4.38244 0 5.625V15.75C0 16.9926 1.00744 18 2.25 18H12.375C13.6176 18 14.625 16.9926 14.625 15.75V5.625C14.625 4.38244 13.6176 3.375 12.375 3.375ZM13.5 15.75C13.5 16.3707 12.9957 16.875 12.375 16.875H2.25C1.62984 16.875 1.125 16.3707 1.125 15.75V5.625C1.125 5.00428 1.62984 4.5 2.25 4.5H12.375C12.9957 4.5 13.5 5.00428 13.5 5.625V15.75ZM3.375 7.875H11.25V6.75H3.375V7.875ZM3.375 10.125H11.25V9H3.375V10.125ZM3.375 12.375H11.25V11.25H3.375V12.375ZM3.375 14.625H7.875V13.5H3.375V14.625Z" fill="#646464"/>
                    </g>
                    </g>
                </svg>    

            </div>
            <div class="sugestaoDescricaoIA">
                <div class="conteudoTextoDescricaoIA">
                    <span class= "tituloCaixaSugestaoIA">Cenário de teste</span><br><br>
                    Página com as informações e funcionalidades disponíveis em prod.
                </div>
                <!--Icone para copiar-->
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" class = "Clicar">
                    <g id="Group">
                    <g id="Group_2">
                        <path id="Vector" d="M15.75 0H5.625C4.38244 0 3.375 1.00744 3.375 2.25H4.5C4.5 1.62928 5.00484 1.125 5.625 1.125H15.75C16.3707 1.125 16.875 1.62928 16.875 2.25V12.375C16.875 12.9957 16.3707 13.5 15.75 13.5V14.625C16.9926 14.625 18 13.6176 18 12.375V2.25C18 1.00744 16.9926 0 15.75 0ZM12.375 3.375H2.25C1.00744 3.375 0 4.38244 0 5.625V15.75C0 16.9926 1.00744 18 2.25 18H12.375C13.6176 18 14.625 16.9926 14.625 15.75V5.625C14.625 4.38244 13.6176 3.375 12.375 3.375ZM13.5 15.75C13.5 16.3707 12.9957 16.875 12.375 16.875H2.25C1.62984 16.875 1.125 16.3707 1.125 15.75V5.625C1.125 5.00428 1.62984 4.5 2.25 4.5H12.375C12.9957 4.5 13.5 5.00428 13.5 5.625V15.75ZM3.375 7.875H11.25V6.75H3.375V7.875ZM3.375 10.125H11.25V9H3.375V10.125ZM3.375 12.375H11.25V11.25H3.375V12.375ZM3.375 14.625H7.875V13.5H3.375V14.625Z" fill="#646464"/>
                    </g>
                    </g>
                </svg>    
            </div>
        </div>
        <div class= "secaoAbrirHistoria">
            <div class="divConfiraChecklist">
                <div class="imgTextoConfiraChecklist">
                    <svg xmlns="http://www.w3.org/2000/svg" width="57" height="58" viewBox="0 0 57 58" fill="none">
                        <g clip-path="url(#clip0_6896_35888)">
                            <path d="M57 29C57 45.0163 44.2396 58 28.5 58C12.7593 58 -3.93545e-06 45.0163 -2.53526e-06 29C-1.13507e-06 12.9837 12.7593 1.11545e-06 28.5 2.49155e-06C44.2396 3.86755e-06 57 12.9837 57 29Z" fill="#FC6E51"/>
                            <path d="M33.1331 16.4269L39.3108 16.4269C39.8796 16.4269 40.3405 16.8965 40.3405 17.4748L40.3405 44.1921C40.3405 44.771 39.8796 45.24 39.3108 45.24L17.6875 45.24C17.1186 45.24 16.6577 44.771 16.6577 44.1922L16.6577 17.4748C16.6577 16.8965 17.1186 16.4269 17.6875 16.4269L23.8662 16.4269" fill="white"/>
                            <path d="M39.3109 45.82L17.6877 45.82C16.8057 45.82 16.0879 45.0893 16.0879 44.1922L16.0879 17.4748C16.0879 16.5776 16.8058 15.8469 17.6877 15.8469L23.8664 15.8469L23.8664 17.0069L17.6877 17.0069C17.4342 17.0069 17.2279 17.2165 17.2279 17.4748L17.2279 44.1921C17.2279 44.4505 17.4342 44.66 17.6877 44.66L39.311 44.66C39.5643 44.66 39.7708 44.4504 39.7708 44.1922L39.7708 17.4748C39.7708 17.2165 39.5642 17.0069 39.3109 17.0069L33.1333 17.0069L33.1333 15.8469L39.3109 15.8469C40.1932 15.8469 40.9108 16.5776 40.9108 17.4748L40.9108 44.1921C40.9108 45.0893 40.1932 45.82 39.3109 45.82Z" fill="#454545"/>
                            <path d="M32.1034 15.3791C32.1034 15.3791 30.5593 15.0381 30.5593 14.8557C30.5593 13.6974 29.6364 12.76 28.4997 12.76C27.3619 12.76 26.4401 13.6974 26.4401 14.8557C26.4401 15.0381 24.896 15.3791 24.896 15.3791C24.3271 15.3791 23.8662 15.8486 23.8662 16.4269L23.8662 18.5226C23.8662 19.1009 24.3271 19.5705 24.896 19.5705L32.1034 19.5705C32.6711 19.5705 33.1332 19.1009 33.1332 18.5226L33.1332 16.4269C33.1332 15.8487 32.6711 15.3791 32.1034 15.3791Z" fill="#FFB933"/>
                            <path d="M32.1036 20.1505L24.8962 20.1505C24.0142 20.1505 23.2964 19.4198 23.2964 18.5226L23.2964 16.4269C23.2964 15.5524 23.9772 14.837 24.8277 14.8002C25.2321 14.7095 25.6501 14.5946 25.892 14.5114C26.0585 13.1983 27.1645 12.18 28.4999 12.18C29.8352 12.18 30.9413 13.1984 31.1078 14.5113C31.3496 14.5946 31.7676 14.7095 32.172 14.8002C33.0225 14.837 33.7033 15.5524 33.7033 16.4269L33.7033 18.5226C33.7033 19.4198 32.9855 20.1505 32.1036 20.1505ZM28.4999 13.34C27.6786 13.34 27.0103 14.0197 27.0103 14.8557C27.0103 15.3354 26.7092 15.5722 25.017 15.9455C24.9774 15.9545 24.9369 15.9591 24.8962 15.9591C24.6426 15.9591 24.4364 16.1687 24.4364 16.4269L24.4364 18.5226C24.4364 18.7809 24.6426 18.9905 24.8962 18.9905L32.1036 18.9905C32.3571 18.9905 32.5633 18.7809 32.5633 18.5226L32.5633 16.4269C32.5633 16.1686 32.3571 15.9591 32.1036 15.9591C32.0629 15.9591 32.0223 15.9545 31.9828 15.9455C30.2906 15.5722 29.9895 15.3354 29.9895 14.8557C29.9895 14.0197 29.3212 13.34 28.4999 13.34Z" fill="#454545"/>
                            <path d="M21.0901 27.964C22.3493 27.964 23.3701 26.9253 23.3701 25.644C23.3701 24.3627 22.3493 23.324 21.0901 23.324C19.8309 23.324 18.8101 24.3627 18.8101 25.644C18.8101 26.9253 19.8309 27.964 21.0901 27.964Z" fill="#ACAF48"/>
                            <path d="M21.0898 27.0441L19.5469 25.4741L20.3528 24.654L21.0899 25.4039L22.9668 23.494L23.7728 24.3141L21.0898 27.0441Z" fill="#454545"/>
                            <path d="M21.0901 34.9241C22.3493 34.9241 23.3701 33.8854 23.3701 32.6041C23.3701 31.3228 22.3493 30.2841 21.0901 30.2841C19.8309 30.2841 18.8101 31.3228 18.8101 32.6041C18.8101 33.8854 19.8309 34.9241 21.0901 34.9241Z" fill="#ACAF48"/>
                            <path d="M21.0898 34.0043L19.5469 32.4341L20.3528 31.6139L21.0899 32.3639L22.9668 30.4539L23.7728 31.2741L21.0899 34.0042L21.0898 34.0043Z" fill="#454545"/>
                            <path d="M21.0901 41.884C22.3493 41.884 23.3701 40.8453 23.3701 39.564C23.3701 38.2827 22.3493 37.244 21.0901 37.244C19.8309 37.244 18.8101 38.2827 18.8101 39.564C18.8101 40.8453 19.8309 41.884 21.0901 41.884Z" fill="#ACAF48"/>
                            <path d="M21.0898 40.9642L19.5469 39.3941L20.3528 38.5739L21.0899 39.3238L22.9668 37.4139L23.7728 38.2341L21.0899 40.9641L21.0898 40.9642ZM38.1898 25.0641L26.7898 25.0641L26.7898 23.9041L38.1898 23.9041L38.1898 25.0641ZM33.6298 27.3841L26.7898 27.3841L26.7898 26.2241L33.6298 26.2241L33.6298 27.3841ZM30.2098 32.0241L26.7898 32.0241L26.7898 30.8641L30.2098 30.8641L30.2098 32.0241ZM38.1898 32.0241L31.3498 32.0241L31.3498 30.8641L38.1898 30.8641L38.1898 32.0241ZM35.9098 34.3441L26.7898 34.3441L26.7898 33.1841L35.9098 33.1841L35.9098 34.3441Z" fill="#454545"/>
                            <path d="M38.19 38.984L26.79 38.984L26.79 37.824L38.19 37.824L38.19 38.984Z" fill="#454545"/>
                            <path d="M30.21 41.304L26.79 41.304L26.79 40.144L30.21 40.144L30.21 41.304Z" fill="#454545"/>
                            <path d="M34.7701 41.304L31.3501 41.304L31.3501 40.144L34.7701 40.144L34.7701 41.304Z" fill="#454545"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_6896_35888">
                            <rect width="57" height="58" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                    <div class="textoConfiraCheckist">
                        Antes de abrir a história confira o checklist:<br> <span class="linkConfiraChecklistBold">Checklist jornada informacional</span>
                    </div>    
                </div>
                <div class="divBtnPesquisa divBtnMaisFiltros" id="btnAbrirHistoria">
                            <input type="button" class="btnPersonalizar maisFiltros" value="Abrir história" id=""> 
                </div>
              <!--aqui vai o botão-->
            </div>                        
        </div>    
            <div class="divDadosdaSolicitacao">
                <div class="divTituloSecaoDadosDaSolicitacao">
                    Dados da solicitação
                    <!--Icon chevron up-->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M7.41 15.41L12 10.83L16.59 15.41L18 14L12 8L6 14L7.41 15.41Z" fill="#2D37F5"/>
                    </svg>
                </div>
                 <form style = "width:100%;">  
                 
                    <div class="nestFormularioNovasSolicitacoes">
                        <div class="divEsquerdaFormularioSolicitacaoSolicitacoes">
                            <p>Qual é a sua necessidade atual?</p>
                            
                            <div class="radio-container">
                                <label for="incluirNovosConteudosEditar">
                                    <input type="radio" id="incluirNovosConteudosEditar" name="necessidadeGestorEditar" />
                                    <div class="custom-radio">
                                        <span></span>
                                    </div>
                                    <span style="font-color=#646464;">Incluir novos conteúdos em um bot<br>existente (WhatsApp PF/PJ, etc.)</span>
                                </label>
                            </div>

                            <div class="radio-container">
                                <label for="desenvolverBotEditar">
                                    <input type="radio" id="desenvolverBotEditar" name="necessidadeGestorEditar" />
                                    <div class="custom-radio">
                                        <span></span>
                                    </div>
                                    <span>Desenvolver um bot novo</span>
                                </label>
                            </div>
                        </div>
                        <div class="divDireitaFormularioSolicitacaoSolicitacoes">
                            <div class="formNovoConteudoBotEditar">
                                <p>Qual o público da jornada ?</p>
                                
                                    <div class="radio-container">
                                        <label for="radioClientePFEditar">
                                            <input type="radio" id="radioClientePFEditar" name="publicoJornadaEditar" value="clientePF" />
                                            <div class="custom-radio">
                                            <span></span>
                                            </div>
                                            <span style="font-color=#646464;">Cliente PF</span>
                                        </label>
                                    </div>

                                    <div class="radio-container">
                                        <label for="radioClientePJEditar">
                                            <input type="radio" id="radioClientePJEditar" name="publicoJornadaEditar" value="clientePJ"  />
                                            <div class="custom-radio">
                                            <span></span>
                                            </div>
                                            <span style="font-color=#646464;">Cliente PJ</span>
                                        </label>
                                    </div>


                                    <div class="radio-container">
                                        <label for="radioFunciBBEditar">
                                            <input type="radio" id="radioFunciBBEditar" name="publicoJornadaEditar" value="funciBB" />
                                            <div class="custom-radio">
                                                <span></span>
                                            </div>
                                            <span>Funci BB</span>
                                        </label>
                                    </div>

                                    <div class="radio-container">
                                        <label for="radioSuporteTecnicoEditar">
                                            <input type="radio" id="radioSuporteTecnicoEditar" name="publicoJornadaEditar" value="suporteTecnico" />
                                            <div class="custom-radio">
                                                <span></span>
                                            </div>
                                            <span>Suporte técnico</span>
                                        </label>
                                    </div>
                            </div>
                            <div class="divAvisosBotNovoEditar">
                                <div class="avisoNovoBot">  
                                    <span class="textoAvisoNovoBot">Você precisará de um workspace no NIA. Solicite a criação via issue, utilizando o template “criacao_corpus_nia”</span>
                                    <button type="button" class="btnAvisoNovoBot" >ABRIR ISSUE</button>
                                </div>
                                <div class="avisoNovoBot">  
                                    <span class="textoAvisoNovoBot">Caso precise de apoio para a criação do seu bot, nós podemos te ajudar. Conheça a nossa “Imersão Chatbot”</span>
                                    <button type="button" class="btnAvisoNovoBot">SABER MAIS</button>
                                </div>        
                            </div> 
                        </div>
                    
                </div>
                <div class = "avisoJornadaFuncieSuporte" id = "idAvisoBotFunciEditar">
                            <span class="textoAvisoJornadaFuncieSuporte">Para incluir conteúdos no Bot Funci BB, entre em contato com o time da Gepes</span>
                            <button type="button" class="btnAvisoNovoBot">VER EQUIPE</button> 
                </div>
                <div class = "avisoJornadaFuncieSuporte" id= "idAvisoBotSuporteEditar">
                            <span class="textoAvisoJornadaFuncieSuporte">Para incluir conteúdos no Bot Suporte técnico, entre em contato com o time da Gesec</span>
                            <button type="button" class="btnAvisoNovoBot">VER EQUIPE</button> 
                </div>
                <div class = "avisoVerificarChecklistMensagemAtivaPF">
                    <div class="conteudoAvisoChecklistPF">
                        <div class= "imgSvgChecklistMensagemAtivaPF">
                            <svg xmlns="http://www.w3.org/2000/svg" width="57" height="58" viewBox="0 0 57 58" fill="none">
                                <g clip-path="url(#clip0_7635_1989)">
                                    <path d="M57 29C57 45.0163 44.2396 58 28.5 58C12.7593 58 -3.93545e-06 45.0163 -2.53526e-06 29C-1.13507e-06 12.9837 12.7593 1.11545e-06 28.5 2.49155e-06C44.2396 3.86755e-06 57 12.9837 57 29Z" fill="#FC6E51"/>
                                    <path d="M33.1331 16.4268L39.3108 16.4268C39.8796 16.4268 40.3405 16.8963 40.3405 17.4746L40.3405 44.1919C40.3405 44.7708 39.8796 45.2398 39.3108 45.2398L17.6875 45.2398C17.1186 45.2398 16.6577 44.7708 16.6577 44.192L16.6577 17.4746C16.6577 16.8963 17.1186 16.4268 17.6875 16.4268L23.8662 16.4268" fill="white"/>
                                    <path d="M39.3109 45.82L17.6877 45.82C16.8057 45.82 16.0879 45.0893 16.0879 44.1922L16.0879 17.4748C16.0879 16.5776 16.8058 15.8469 17.6877 15.8469L23.8664 15.8469L23.8664 17.0069L17.6877 17.0069C17.4342 17.0069 17.2279 17.2165 17.2279 17.4748L17.2279 44.1921C17.2279 44.4505 17.4342 44.66 17.6877 44.66L39.311 44.66C39.5643 44.66 39.7708 44.4504 39.7708 44.1922L39.7708 17.4748C39.7708 17.2165 39.5642 17.0069 39.3109 17.0069L33.1333 17.0069L33.1333 15.8469L39.3109 15.8469C40.1932 15.8469 40.9108 16.5776 40.9108 17.4748L40.9108 44.1921C40.9108 45.0893 40.1932 45.82 39.3109 45.82Z" fill="#454545"/>
                                    <path d="M32.1034 15.3791C32.1034 15.3791 30.5593 15.0381 30.5593 14.8557C30.5593 13.6974 29.6364 12.76 28.4997 12.76C27.3619 12.76 26.4401 13.6974 26.4401 14.8557C26.4401 15.0381 24.896 15.3791 24.896 15.3791C24.3271 15.3791 23.8662 15.8486 23.8662 16.4269L23.8662 18.5226C23.8662 19.1009 24.3271 19.5705 24.896 19.5705L32.1034 19.5705C32.6711 19.5705 33.1332 19.1009 33.1332 18.5226L33.1332 16.4269C33.1332 15.8487 32.6711 15.3791 32.1034 15.3791Z" fill="#FFB933"/>
                                    <path d="M32.1036 20.1504L24.8962 20.1504C24.0142 20.1504 23.2964 19.4197 23.2964 18.5225L23.2964 16.4269C23.2964 15.5523 23.9772 14.837 24.8277 14.8002C25.2321 14.7095 25.6501 14.5945 25.892 14.5113C26.0585 13.1983 27.1645 12.1799 28.4999 12.1799C29.8352 12.1799 30.9413 13.1983 31.1078 14.5112C31.3496 14.5945 31.7676 14.7095 32.172 14.8001C33.0225 14.837 33.7033 15.5524 33.7033 16.4269L33.7033 18.5225C33.7033 19.4197 32.9855 20.1504 32.1036 20.1504ZM28.4999 13.3399C27.6786 13.3399 27.0103 14.0196 27.0103 14.8556C27.0103 15.3354 26.7092 15.5721 25.017 15.9454C24.9774 15.9545 24.9369 15.959 24.8962 15.959C24.6426 15.959 24.4364 16.1686 24.4364 16.4269L24.4364 18.5225C24.4364 18.7808 24.6426 18.9904 24.8962 18.9904L32.1036 18.9904C32.3571 18.9904 32.5633 18.7808 32.5633 18.5225L32.5633 16.4269C32.5633 16.1686 32.3571 15.959 32.1036 15.959C32.0629 15.959 32.0223 15.9545 31.9828 15.9454C30.2906 15.5721 29.9895 15.3354 29.9895 14.8556C29.9895 14.0196 29.3212 13.3399 28.4999 13.3399Z" fill="#454545"/>
                                    <path d="M21.0901 27.964C22.3493 27.964 23.3701 26.9253 23.3701 25.644C23.3701 24.3627 22.3493 23.324 21.0901 23.324C19.8309 23.324 18.8101 24.3627 18.8101 25.644C18.8101 26.9253 19.8309 27.964 21.0901 27.964Z" fill="#ACAF48"/>
                                    <path d="M21.0898 27.0441L19.5469 25.4741L20.3528 24.6539L21.0899 25.4038L22.9668 23.4939L23.7728 24.3141L21.0898 27.0441Z" fill="#454545"/>
                                    <path d="M21.0901 34.9239C22.3493 34.9239 23.3701 33.8852 23.3701 32.6039C23.3701 31.3226 22.3493 30.2839 21.0901 30.2839C19.8309 30.2839 18.8101 31.3226 18.8101 32.6039C18.8101 33.8852 19.8309 34.9239 21.0901 34.9239Z" fill="#ACAF48"/>
                                    <path d="M21.0898 34.0042L19.5469 32.434L20.3528 31.6139L21.0899 32.3638L22.9668 30.4539L23.7728 31.2741L21.0899 34.0041L21.0898 34.0042Z" fill="#454545"/>
                                    <path d="M21.0901 41.8839C22.3493 41.8839 23.3701 40.8452 23.3701 39.5639C23.3701 38.2826 22.3493 37.2439 21.0901 37.2439C19.8309 37.2439 18.8101 38.2826 18.8101 39.5639C18.8101 40.8452 19.8309 41.8839 21.0901 41.8839Z" fill="#ACAF48"/>
                                    <path d="M21.0898 40.9642L19.5469 39.3941L20.3528 38.5739L21.0899 39.3238L22.9668 37.4139L23.7728 38.2341L21.0899 40.9641L21.0898 40.9642ZM38.1898 25.0641L26.7898 25.0641L26.7898 23.9041L38.1898 23.9041L38.1898 25.0641ZM33.6298 27.3841L26.7898 27.3841L26.7898 26.2241L33.6298 26.2241L33.6298 27.3841ZM30.2098 32.0241L26.7898 32.0241L26.7898 30.8641L30.2098 30.8641L30.2098 32.0241ZM38.1898 32.0241L31.3498 32.0241L31.3498 30.8641L38.1898 30.8641L38.1898 32.0241ZM35.9098 34.3441L26.7898 34.3441L26.7898 33.1841L35.9098 33.1841L35.9098 34.3441Z" fill="#454545"/>
                                    <path d="M38.19 38.984L26.79 38.984L26.79 37.824L38.19 37.824L38.19 38.984Z" fill="#454545"/>
                                    <path d="M30.21 41.304L26.79 41.304L26.79 40.144L30.21 40.144L30.21 41.304Z" fill="#454545"/>
                                    <path d="M34.7701 41.304L31.3501 41.304L31.3501 40.144L34.7701 40.144L34.7701 41.304Z" fill="#454545"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_7635_1989">
                                    <rect width="57" height="58" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <span class="textoAvisoChecklistMensagemAtivaPF">Antes de abrir a história confira o checklist:</br><span><span class="negritotextoAvisoChecklistMensagemAtivaPF">Checklist Jornada Mensagem Ativa</span>
                    </div> 
                    <button type="button" class="btnAvisoNovoBot btnAvisoCheckList">ABRIR HISTÓRIA</button>    
                </div>
                <div class = "divSolicitacaoJornadaPFEditar setorJornadaPFEditar">
                <div class="linhaDivisoria"></div>
                    <div class="nestFormularioJornadaPF">
                        <div class="divEsquerdaFormularioSolicitacaoClientePF">
                            <div class="divItemFormularioSolicitacaoClientePF">
                                <span class="itemFormulario">Nome do Solicitante</span>
                                <div class="divInputFormJornadaPF">
                                    <input type="text" class="inputFormJornadaPF" id="nomeSolicitanteJornadaPFEditar" />
                                </div>
                            </div>
                            <div class="divItemFormularioSolicitacaoClientePF">    
                                <span class="itemFormulario">Matrícula</span>
                                <div class="divInputFormJornadaPF">
                                    <input type="text" class="inputFormJornadaPF" id="matriculaSolicitanteJornadaPFEditar" />
                                </div>
                            </div>
                            <div class="divItemFormularioSolicitacaoClientePF">    
                                <span class="itemFormulario">E-mail</span>
                                <div class="divInputFormJornadaPF">
                                    <input type="text" class="inputFormJornadaPF" id="emailSolicitanteJornadaPFEditar" />
                                </div>
                            </div>    
                            <div class="divItemFormularioSolicitacaoClientePF">
                                <span class="itemFormulario">Dependência</span>
                                <div class="divInputFormJornadaPF">
                                    <input type="text" class="inputFormJornadaPF" id="matriculaSolicitanteJornadaPFEditar" />
                                </div>
                            </div>    
                        </div>
                        <div class="divDireitaFormularioSolicitacaoSolicitacoes">
                            <div>
                                <p>Qual o tipo de jornada será incluída?</p>
                                <form >
                                    <div class="radio-container containerInputEAvisoPF">
                                        <div class="nestAvisoTipoJornadaPF" id="divAvisoJornadaTransacaoPFEditar">
                                            <div class="divAvisoTipoJornadaPF" >
                                                <span class="textoAvisoTipoJornadaPF"><strong>Transação:</strong> São as consultas e contratações que o bot consegue realizar desde que haja integração com outros sistemas</span>
                                            </div>    
                                            <div class="setaBaixo"></div>
                                        </div>
                                        <label for="radioTransacaoPFEditar">
                                            <input type="radio" id="radioTransacaoPFEditar" name="tipoJornadaPFEditar" value="transacaoPF" />
                                            <div class="custom-radio">
                                            <span></span>
                                            </div>
                                            <span style="font-color=#646464;">Transação</span>
                                            <div class="svgInterrogacao" id= "divIconeInterrogaTransacaoEditar">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="28" viewBox="0 0 31 28" fill="none">
                                                <path d="M30.4556 14.001C30.4556 21.7335 23.6379 28.002 15.2278 28.002C6.81772 28.002 0 21.7335 0 14.001C0 6.26845 6.81772 0 15.2278 0C23.6379 0 30.4556 6.26845 30.4556 14.001Z" fill="#E0E9FF"/>
                                                <path d="M17.563 16.1768L13.8253 15.7221L15.9077 13.3527C16.6908 12.4273 17.207 11.7731 17.4562 11.3902C17.7232 10.9913 17.8566 10.5765 17.8566 10.1457C17.8566 9.60317 17.6609 9.17237 17.2693 8.85326C16.8777 8.53415 16.3349 8.3746 15.6407 8.3746C13.9143 8.3746 12.4993 9.17237 11.3958 10.7679L8.45898 9.04473C9.36671 7.67255 10.4257 6.65938 11.636 6.0052C12.8641 5.33507 14.2791 5 15.881 5C17.0557 5 18.1058 5.18349 19.0314 5.55047C19.9747 5.91744 20.7044 6.436 21.2206 7.10613C21.7367 7.76031 21.9948 8.51022 21.9948 9.35586C21.9948 10.1696 21.7723 10.9355 21.3274 11.6535C20.9002 12.3715 20.2328 13.2251 19.325 14.2143L17.563 16.1768ZM15.614 22.1123C14.8843 22.1123 14.2791 21.8969 13.7986 21.4661C13.318 21.0353 13.0777 20.5008 13.0777 19.8626C13.0777 19.2084 13.318 18.6579 13.7986 18.2112C14.2791 17.7485 14.8843 17.5171 15.614 17.5171C16.3438 17.5171 16.9489 17.7405 17.4295 18.1872C17.91 18.618 18.1503 19.1526 18.1503 19.7908C18.1503 20.429 17.91 20.9795 17.4295 21.4422C16.9489 21.8889 16.3438 22.1123 15.614 22.1123Z" fill="#465EFF"/>
                                                </svg>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="radio-container containerInputEAvisoPF">
                                        <div class="nestAvisoTipoJornadaPF" id="divAvisoJornadaInformacionalPFEditar">
                                            <div class="divAvisoTipoJornadaPF" >
                                                <span class="textoAvisoTipoJornadaPF" id="informacionalTextoAvisoJornadaPF"><strong>Informacional:</strong>  É todo o conteúdo armazenado no corpo de conhecimento do bot que fica disponível para consulta a partir da interação do cliente. São dados que não dependem da identificação do cliente nem da consulta a outro sistema</span>
                                            </div>    
                                            <div class="setaBaixo"></div>
                                        </div>
                                        <label for="radioJornadaInformacionalPFEditar">
                                            <input type="radio" id="radioJornadaInformacionalPFEditar" name="tipoJornadaPF" value="jornadaInformacionalPF"  />
                                            <div class="custom-radio">
                                            <span></span>
                                            </div>
                                            <span style="font-color=#646464;">Jornada Informacional</span>
                                            <div class="svgInterrogacao" id= "divIconeceInterrogaJornadaInf">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="28" viewBox="0 0 31 28" fill="none">
                                                <path d="M30.4556 14.001C30.4556 21.7335 23.6379 28.002 15.2278 28.002C6.81772 28.002 0 21.7335 0 14.001C0 6.26845 6.81772 0 15.2278 0C23.6379 0 30.4556 6.26845 30.4556 14.001Z" fill="#E0E9FF"/>
                                                <path d="M17.563 16.1768L13.8253 15.7221L15.9077 13.3527C16.6908 12.4273 17.207 11.7731 17.4562 11.3902C17.7232 10.9913 17.8566 10.5765 17.8566 10.1457C17.8566 9.60317 17.6609 9.17237 17.2693 8.85326C16.8777 8.53415 16.3349 8.3746 15.6407 8.3746C13.9143 8.3746 12.4993 9.17237 11.3958 10.7679L8.45898 9.04473C9.36671 7.67255 10.4257 6.65938 11.636 6.0052C12.8641 5.33507 14.2791 5 15.881 5C17.0557 5 18.1058 5.18349 19.0314 5.55047C19.9747 5.91744 20.7044 6.436 21.2206 7.10613C21.7367 7.76031 21.9948 8.51022 21.9948 9.35586C21.9948 10.1696 21.7723 10.9355 21.3274 11.6535C20.9002 12.3715 20.2328 13.2251 19.325 14.2143L17.563 16.1768ZM15.614 22.1123C14.8843 22.1123 14.2791 21.8969 13.7986 21.4661C13.318 21.0353 13.0777 20.5008 13.0777 19.8626C13.0777 19.2084 13.318 18.6579 13.7986 18.2112C14.2791 17.7485 14.8843 17.5171 15.614 17.5171C16.3438 17.5171 16.9489 17.7405 17.4295 18.1872C17.91 18.618 18.1503 19.1526 18.1503 19.7908C18.1503 20.429 17.91 20.9795 17.4295 21.4422C16.9489 21.8889 16.3438 22.1123 15.614 22.1123Z" fill="#465EFF"/>
                                                </svg>
                                            </div>
                                        </label>
                                    </div>


                                    <div class="radio-container containerInputEAvisoPF">
                                        <div class="nestAvisoTipoJornadaPF" id="divAvisoJornadaMensagemAtivaPF">
                                            <div class="divAvisoTipoJornadaPF" >
                                                <span class="textoAvisoTipoJornadaPF" id="mensagemAtivaTextoAvisoJornadaPF" ><strong>Mensagem Ativa:</strong> Mensagens ativas são aquelas que enviamos para os clientes. Essas mensagens podem ter o intuito de divulgar algum produto ou serviço, enviar alertas ou notificações ou de relacionamento com o cliente</span>
                                            </div>    
                                            <div class="setaBaixo"></div>
                                        </div>
                                        <label for="radioMensagemAtivaPF">
                                            <input type="radio" id="radioMensagemAtivaPF" name="tipoJornadaPF" value="mensagemAtivaPF" />
                                            <div class="custom-radio">
                                                <span></span>
                                            </div>
                                            <span>Mensagem Ativa</span>
                                            <div class="svgInterrogacao" id= "divIconeInterrogaMensagemAtiva">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="28" viewBox="0 0 31 28" fill="none">
                                                <path d="M30.4556 14.001C30.4556 21.7335 23.6379 28.002 15.2278 28.002C6.81772 28.002 0 21.7335 0 14.001C0 6.26845 6.81772 0 15.2278 0C23.6379 0 30.4556 6.26845 30.4556 14.001Z" fill="#E0E9FF"/>
                                                <path d="M17.563 16.1768L13.8253 15.7221L15.9077 13.3527C16.6908 12.4273 17.207 11.7731 17.4562 11.3902C17.7232 10.9913 17.8566 10.5765 17.8566 10.1457C17.8566 9.60317 17.6609 9.17237 17.2693 8.85326C16.8777 8.53415 16.3349 8.3746 15.6407 8.3746C13.9143 8.3746 12.4993 9.17237 11.3958 10.7679L8.45898 9.04473C9.36671 7.67255 10.4257 6.65938 11.636 6.0052C12.8641 5.33507 14.2791 5 15.881 5C17.0557 5 18.1058 5.18349 19.0314 5.55047C19.9747 5.91744 20.7044 6.436 21.2206 7.10613C21.7367 7.76031 21.9948 8.51022 21.9948 9.35586C21.9948 10.1696 21.7723 10.9355 21.3274 11.6535C20.9002 12.3715 20.2328 13.2251 19.325 14.2143L17.563 16.1768ZM15.614 22.1123C14.8843 22.1123 14.2791 21.8969 13.7986 21.4661C13.318 21.0353 13.0777 20.5008 13.0777 19.8626C13.0777 19.2084 13.318 18.6579 13.7986 18.2112C14.2791 17.7485 14.8843 17.5171 15.614 17.5171C16.3438 17.5171 16.9489 17.7405 17.4295 18.1872C17.91 18.618 18.1503 19.1526 18.1503 19.7908C18.1503 20.429 17.91 20.9795 17.4295 21.4422C16.9489 21.8889 16.3438 22.1123 15.614 22.1123Z" fill="#465EFF"/>
                                                </svg>
                                            </div>
                                        </label>
                                    </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
                <div class = "divSolicitacaoJornadaTransacaoPF setorJornadaPF">
                    <div class="linhaDivisoria"></div>
                    <div class="nestFormularioJornadaTransacaoPFDuasColunas">
                        <div class="divEsquerdaFormularioSolicitacaoClientePF" id="divJornadaTransacaoPF">
                            <div class="divItemFormularioSolicitacaoClientePF">
                                <span class="itemFormulario">Qual o tema/produto?</span>
                                <div class="divInputFormJornadaPF">
                                    <input type="text" class="inputFormJornadaPF" id="temaProdutoTransacaoPF" />
                                </div>
                            </div>
                            <div class="divItemFormularioSolicitacaoClientePF">    
                                <span class="itemFormulario">Em qual canal deseja incluir a transação?</span>
                                <div class="divInputFormJornadaPF">
                                    <select class="inputFormJornadaPF" id="canalTransacaoPF"></select>
                                </div>
                            </div>
                            <div class="radioComTitulo">
                                <span class="itemFormulario tituloRadioBtnFormulario">A transação visa atender RA (Recomendação de auditoria) ou Regulatório (Regulamento ou lei específica)?</span>
                                <div class="radio-container">
                                    <label for="radioTransacaoRaRegSim">
                                        <input type="radio" id="radioTransacaoRaRegSim" name="RARegulatorio" value="sim" />
                                        <div class="custom-radio">
                                            <span></span>
                                        </div>
                                        <span>Sim</span>
                                    </label>
                                </div>   
                                <div class="radio-container">
                                    <label for="radioTransacaoRaRegNao">
                                        <input type="radio" id="radioTransacaoRaRegNao" name="RARegulatorio" value="nao" />
                                        <div class="custom-radio">
                                            <span></span>
                                        </div>
                                        <span>Não</span>
                                    </label>
                                </div>   
                            </div>
                            <div class="radioComTitulo">
                                <span class="itemFormulario tituloRadioBtnFormulario">A RA ou Regulatório especifica que a transação deve ser disponibilizada no WhatsApp?</span>
                                <div class="radio-container">
                                    <label for="radioTransacaoWhatsSim">
                                        <input type="radio" id="radioTransacaoWhatsSim" name="disponivelNoWhats" value="sim" />
                                        <div class="custom-radio">
                                            <span></span>
                                        </div>
                                        <span>Sim</span>
                                    </label>
                                </div>   
                                <div class="radio-container">
                                    <label for="radioTransacaoWhatsNao">
                                        <input type="radio" id="radioTransacaoWhatsNao" name="disponivelNoWhats" value="nao" />
                                        <div class="custom-radio">
                                            <span></span>
                                        </div>
                                        <span>Não</span>
                                    </label>
                                </div>   
                            </div>  
                            
                        </div>
                        <div class="divDireitaFormularioSolicitacaoSolicitacoes">
                            <div>
                                <div class="divItemFormularioSolicitacaoClientePF">
                                    <span class="itemFormulario">Qual o assunto principal da transação?</span>
                                    <div class="divInputFormJornadaPF">
                                        <input type="text" class="inputFormJornadaPF" id="assuntoTransacaoPF" placeholder= "Escreva o nome" />
                                    </div>
                                </div>
                                <div class="divItemFormularioSolicitacaoClientePF">
                                    <span class="itemFormulario">Qual o objetivo da transação? (o que é esperado que o cliente consiga fazer ao utilizar a transação)</span>
                                    <div>
                                    <textarea class="txtAreaMedioTransacao" name="objetivoTransacaoPF" rows="7" cols="55" maxlength="200" placeholder= "Mensagem"></textarea>
                                    </div>
                                </div>
                                <div class="divItemFormularioSolicitacaoClientePF">
                                    <span class="itemFormulario">Em quais canais a transação já existe?</span>
                                    <div>
                                        <textarea class="txtAreaMedioTransacao" name="canaisJaExistentes" rows="7" cols="55" maxlength="200" placeholder= "Mensagem"></textarea>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="nestFormularioJornadaTransacaoPFUmaColuna">
                        <div class="itemFormularioTextAreaGrande">
                            <span class="itemFormulario">Qual o público da jornada?</span>
                            <div>
                                <textarea class="txtAreaMedioTransacao" name="publicoJornadaTransacaoPF" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                            </div>
                        </div>
                        <div class="itemFormularioTextAreaGrande">
                            <span class="itemFormulario">Qual será a métrica de sucesso da transação no canal? (Exemplos: Satisfação - nota de avaliação WhatsApp, Volume de negócios digitais, etc)?</span>
                            <div>
                                <textarea class="txtAreaMedioTransacao" name="metricaSucessoJornadaTransacaoPF" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                            </div>
                        </div>
                        <div class="itemFormularioTextAreaGrande">
                            <span class="itemFormulario">Qual o resultado projetado nos primeiros 6 meses com a implementação da transação no canal?</span>
                            <div>
                                <textarea class="txtAreaMedioTransacao" name="resultadoProjetadoJornadaTransacaoPF" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                            </div>
                        </div>
                        <div class="itemFormularioTextAreaGrande">
                            <span class="itemFormulario">Como será feito o acompanhamento dessa(s) métrica(s) de sucesso?</span>
                            <div>
                                <textarea class="txtAreaMedioTransacao" name="acompanhamentoMetricaSucessoJornadaTransacaoPF" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                            </div>
                        </div>
                        <div class="itemFormularioTextAreaGrande">
                            <span class="itemFormulario">Como o público-alvo será estimulado a consumir essa transação no canal?</span>
                            <div>
                                <textarea class="txtAreaMedioTransacao" name="estimuloConsumoJornadaTransacaoPF" rows="7" cols="150" maxlength="200" placeholder= "Mensagem"></textarea>
                            </div>
                        </div>
                            
                    </div>
                    <div class="fimFormularioTransacao">
                        <button type="button" class="btnLimpar" >LIMPAR</button>
                        <button type="button" class="btnCadastrar" >CADASTRAR</button>
                        <button type="button" class="btnCadastrarDesabilitado" >CADASTRAR</button>
                    </div>
                </div>
                            </fieldset>
                </form>     
            </div>
    </div> 
       
      
</div>