<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/solicitacoes/class/class_solicitacoes.php";

$class = new funcoes();
// $contaNovasSolicitacoes = $class->contaNovasSolicitacoes();

$notificacoesNovasSolicitacoes = '';

$montaFormulario = $class->montaFormulario(1);
$montaTabelaAcompanhamentoVisaoGestor = $class->montaTabelaAcompanhamentoVisaoGestor($_SESSION['dependencia']);
$contaQtdeNotificacoesGestor = $class->contaQtdeNotificacoesGestor($_SESSION['dependencia']);

$divQtdeNotificacoesGestor = '';

if($contaQtdeNotificacoesGestor['mensagem'] > 0){
    $divQtdeNotificacoesGestor = '<div class="notificaQtdeSolicitacoes">'.$contaQtdeNotificacoesGestor['mensagem'].'</div>';
}

?>

<div class="cabecalhoSolicitacoes" style="width: 100%; height: auto; background-color: #735CC6; display: inline-flex; flex-direction: row;">
    <div class="textoCabecalhoSolicitacoes" style="width: 50%; align-content: center; margin-left: 10%;">
        <div class="tituloTextoCabecalhoSolicitacoes" id ="maiorTituloTextoCabecalhoSolicitacoes">
            Alguma<br>Solicitação?
        </div>
        <div class="subtituloTextoCabecalhoSolicitacoes">
            <p class="text-wrapper">
                Registre e acompanhe suas solicitações de demandas para o CAD 👇
            </p>
        </div>
    </div>
    <div class="imagemCabecalhoSolicitacoes" style="width: 40%; align-content: center; margin-right: 10%;">
        <img src="/lib/img/apps/solicitacoes/capaSolicitacoesBot.png" style="width: 100%;" >
    </div>
</div>
<div class="conteudoSolicitacoesGestor">
    <div class="abasCabecalhoSolicitacoes">
        <div class="abaAdicionarSolicitacoes Clicar" style="z-index: 2;">
            <div class="divAdicionarSolicitacoes">
                <div class="divTextoAdicionarSolicitacoes">
                    <img src="https://cad.bb.com.br/lib/apps/solicitacoes/img/iconeArquivo.png"> Registrar
                </div>
            </div>
        </div>
        <div class="abaConsultarSolicitacoes Clicar" style="z-index: 1;">
            <div class="divConsultarSolicitacoes">
                <div class="divTextoConsultarSolicitacoes">
                    🔎 Acompanhar <?php echo $divQtdeNotificacoesGestor; ?>
                </div>
            </div>
        </div>
    </div>
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
            <div id="divIconeInterrogaTransacao" style="display: none;"></div>
            <div class="divEsquerdaFormularioSolicitacaoSolicitacoes">
                <div class="divPrimeiraEtapaFormularioSolicitacoes">
                    <?php echo $montaFormulario['mensagem'];?>
                </div>

                <div class="divDadosSolicitante" style="display: none;">
                    <div class="divItemFormularioSolicitacaoClientePF">
                        <span class="itemFormulario">Nome do Solicitante</span>
                        <div class="divInputFormJornadaPF">
                            <input type="text" class="inputFormJornadaPF" id="nomeSolicitanteJornadaPF" value="<?php echo $_SESSION['nome']?>">
                        </div>
                    </div>
                    <div class="divItemFormularioSolicitacaoClientePF">    
                        <span class="itemFormulario">Matrícula</span>
                        <div class="divInputFormJornadaPF">
                            <input type="text" class="inputFormJornadaPF" id="matriculaSolicitanteJornadaPF" value="<?php echo $_SESSION['matricula']?>">
                        </div>
                    </div>
                    <div class="divItemFormularioSolicitacaoClientePF">    
                        <span class="itemFormulario">E-mail</span>
                        <div class="divInputFormJornadaPF">
                            <input type="text" class="inputFormJornadaPF" id="emailSolicitanteJornadaPF" value="<?php echo $_SESSION['email']?>">
                        </div>
                    </div>    
                    <div class="divItemFormularioSolicitacaoClientePF">
                        <span class="itemFormulario">Dependência</span>
                        <div class="divInputFormJornadaPF">
                            <input type="text" class="inputFormJornadaPF" id="matriculaSolicitanteJornadaPF" value="<?php echo $_SESSION['dependencia']?>">
                        </div>
                    </div>    
                </div>
                

                <div class="dadosSolicitanteSolicitacoes" style="margin-top: 3rem;">
                    
                </div>
            </div>
            <div class="divDireitaFormularioSolicitacaoSolicitacoes">
                
            </div>
        </div>
        <div class="divInferiorSolicitacoes" style="display: none;">
            
        </div>
    </div>
    <div id="abaAcompanharSolicitacao">
        <!-- <pre><?php print_r($montaTabelaAcompanhamentoVisaoGestor['mensagem']) ?></pre> -->
        <div class="divInicialConsultaSolicitacoesGestor">
            <div class= "alert success" id="alertaSucessoCadastroSolicitacao" style="display: none;">
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
                                <input type="text" class="inputCampoPesquisa" attr-campoalterado="0" id="campoID" placeholder="Procure pelo ID" attr-nomeCampoBd = "a.idSolicitacao">
                            </div>
                        </div>
                        <div class="campoFiltroPesquisa">
                            <input type="date" 
                                class="inputCampoPesquisa" 
                                attr-campoalterado="0" 
                                id="dataAberturaSolicitacao" 
                                placeholder="Data Abertura"
                                attr-nomeCampoBd = "a.timestamp">
                                <!-- <input type="date" class="inputCampoPesquisa" attr-campoalterado="1" id="dataAberturaSolicitacao" placeholder="Data Abertura" attr-nomecampobd="a.timestamp" onblur="formatDate(this)"> -->
                        </div>
                        <div class= "campoFiltroPesquisa">
                            <select name="campoStatusSolicitacaoVisaoGestor" id="campoStatusSolicitacaoVisaoGestor" class="selectFiltroPesquisa" attr-campoalterado="0" style="width: 90%;" attr-nomeCampoBd = "a.status">
                                <option value="0">Status</option>
                                <option value="1">Nova</option>
                                <option value="2">Em análise</option>
                                <option value="3">Aprovada</option>
                                <option value="4">Encerrada</option>
                            </select>
                        </div>
                        <div class="divBtnPesquisaVisaoGestor divBtnMaisFiltros">
                            <input type="button" class="btnPersonalizarVisaoGestor limparFiltros" value="Limpar" attr-prefixo="<?php echo $_SESSION['dependencia']?>"> 
                        </div>
                    </div>
                </div>
                <div class="areaTabelaConsultaSolicitacoes">
                    <!-- <div style="width: 100%;">
                        <table id="tabelaConsultaSolicitacao">
                            <thead style="background-color: #F0F2F4; line-height: 3rem;">
                                <th>ID</th> 
                                <th>Tema/Produto</th> 
                                <th>Data Abertura</th> 
                                <th>Status</th> 
                                <th></th> 
                                <th></th> 
                            </thead>
                            <tbody  class="bodyTabelaSolicitacoesVisaoGestor" style="line-height: 3rem;"> -->
                                <?php echo $montaTabelaAcompanhamentoVisaoGestor['mensagem']; ?>
                                <!-- <img src="https://cad.bb.com.br/lib/apps/solicitacoes/img/iconeRobo.png" onload="datatableVisaoGestor();" style="display:none;" />
                            </tbody>
                        </table>
                    </div> -->
                </div>
            </div>
        </div> 
    </div>
</div>
<script>
    
    /* FUNÇÕES PARA EXIBIÇÃO DO TOOLTIP DO TIPO DE JORNADA */
    function tooltip(){
        $('#divIconeInterrogaTransacao').on('mouseenter', function(){
            $('#divAvisoJornadaTransacaoPF').css('display', 'block');
        });

        $('#divIconeInterrogaTransacao').on('mouseleave', function(){
            $('#divAvisoJornadaTransacaoPF').css('display', 'none');
        });

        $('#divIconeInterrogaJornadaInformacional').on('mouseenter', function(){
            $('#divAvisoJornadaInformacionalPF').css('display', 'block');
        });

        $('#divIconeInterrogaJornadaInformacional').on('mouseleave', function(){
            $('#divAvisoJornadaInformacionalPF').css('display', 'none');
        });

        $('#divIconeInterrogaMensagemAtiva').on('mouseenter', function(){
            $('#divAvisoJornadaMensagemAtivaPF').css('display', 'block');
        });

        $('#divIconeInterrogaMensagemAtiva').on('mouseleave', function(){
            $('#divAvisoJornadaMensagemAtivaPF').css('display', 'none');
        });
    }

    function formatDate(input) {
        const date = new Date(input.value);
        if (!isNaN(date)) {
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            input.value = `${day}/${month}/${year}`;
        }
        input.type = 'text';
    }
</script>