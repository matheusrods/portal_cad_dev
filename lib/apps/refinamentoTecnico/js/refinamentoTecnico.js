$(document).ready(function(){
    $("#tabelaDadosSolicitacoes").DataTable({
        dom: "Brtip",
        buttons: [ "excelHtml5" ],
        // order: [[0, "desc"]],
        language: {
            url:"https://cad.bb.com.br/lib/datatables/pt_br.json"
        },
        "initComplete": function(){ 
            $("#tabelaDadosSolicitacoes").show(); 
        }
    });

    $('.divBtnLimparFiltrosSolicitacoes').on('click', function(){
        limparCamposPesquisaSolicitacoes();
    });

    var camposSelecionados = {};
    
    $('#pesquisaNumeroSolicitacao').on('change', function(){
        var conteudo;
        var conteudo = $(this).val();
        var idElemento = $(this).attr('attr-nomeCampoBd');
        
        if(conteudo.length > 0){
            $(this).attr('attr-campoalterado', '1');
            camposSelecionados[idElemento] = conteudo;
        } else {
            $(this).attr('attr-campoalterado', '0');
            delete camposSelecionados[idElemento];
        }
        filtrarSolicitacoes(camposSelecionados);
    });

    $('#pesquisaProdutoSolicitacao').on('change', function(){
        var conteudo;
        var conteudo = $(this).val();
        var idElemento = $(this).attr('attr-nomeCampoBd');
        
        if(conteudo.length > 0){
            $(this).attr('attr-campoalterado', '1');
            camposSelecionados[idElemento] = conteudo;
        } else {
            $(this).attr('attr-campoalterado', '0');
            delete camposSelecionados[idElemento];
        }
        filtrarSolicitacoes(camposSelecionados);
    });
    
    $('#pesquisaDependenciaSolicitacao').on('change', function(){
        var conteudo;
        var conteudo = $(this).val();
        var idElemento = $(this).attr('attr-nomeCampoBd');

        if(conteudo.length > 0){
            $(this).attr('attr-campoalterado', '1');
            camposSelecionados[idElemento] = conteudo;
        } else {
            $(this).attr('attr-campoalterado', '0');
            delete camposSelecionados[idElemento];
        }
        filtrarSolicitacoes(camposSelecionados);
    });
    
    $('#campoStatusSolicitacao').on('change', function(){
        var conteudo;
        var conteudo = $('select[name=selectStatusSolicitacao] option').filter(':selected').attr('value');
        var idElemento = $(this).attr('attr-nomeCampoBd');

        if(conteudo == 0){
            conteudo = '';
        }

        if(conteudo.length > 0){
            $(this).attr('attr-campoalterado', '1');
            camposSelecionados[idElemento] = conteudo;
        } else {
            $(this).attr('attr-campoalterado', '0');
            delete camposSelecionados[idElemento];
        }
        filtrarSolicitacoes(camposSelecionados);
    });

    $('.itemPesquisaSolicitacao').on('change', function(){
        var valorIdSolicitacao = $('#pesquisaNumeroSolicitacao').val();
        var valorProduto = $('#pesquisaProdutoSolicitacao').val();
        var valorDependnecia = $('#pesquisaDependenciaSolicitacao').val();
        var valorStatus = $('#campoStatusSolicitacao').val();

        if((valorIdSolicitacao == '') && (valorProduto == '') && (valorDependnecia == '') && (valorStatus == '0')){
            limparCamposPesquisaSolicitacoes();
        }
    });
    // $('.itemPesquisaSolicitacao').on('change', function(){
    //     var conteudo;
    //     if($(this).attr("id") == "campoStatusSolicitacao"){
    //         var conteudo = $('select[name=selectStatusSolicitacao] option').filter(':selected').attr('value');
            
    //         if(conteudo == 0){
    //             conteudo = '';
    //         }
    //     } else {
    //         var conteudo = $(this).val();
    //     }
        
    //     if(conteudo.length > 0){
    //         $(this).attr('attr-campoalterado', '1');
    //     } else {
    //         $(this).attr('attr-campoalterado', '0');
    //     }

    //     var camposSelecionados = {};
        
    //     if(camposSelecionados.length == 0){
    //         alert('consultaSolicitacoes');
    //         consultaSolicitacoes();
    //     } else {
    //         $(".itemPesquisaSolicitacao[attr-campoalterado='1']").each(function(){
    //             var idElemento = $(this).attr('attr-nomeCampoBd');
                
    //             if($(this).attr("id") == "campoStatusSolicitacao"){
    //                 var conteudo = $('select[name=selectStatusSolicitacao] option').filter(':selected').attr('value');
                    
    //                 if(conteudo == 0){
    //                     conteudo = '';
    //                 }
    //             } else {
    //                 var conteudo = $(this).val();
    //             }
    
    //             camposSelecionados[idElemento] = conteudo;
    //             // camposSelecionados.push($(this).attr('id'));
    //             filtrarSolicitacoes(camposSelecionados);
    //         });
    //     }
    // });

    $('.abaAdicionarSolicitacoes').on('click', function(){
        $('.abaAdicionarSolicitacoes').css('z-index', '2');
        $('.abaConsultarSolicitacoes').css('z-index', '1');
        $('#abaNovaSolicitacao').css('background-color','#2C3FBF ');
        $('#abaNovaSolicitacao').css('display', 'inline-flex');
        $('#abaAcompanharSolicitacao').css('display', 'none');
    });

    $('.abaConsultarSolicitacoes').on('click', function(){
        $('.abaAdicionarSolicitacoes').css('z-index', '1');
        $('.abaConsultarSolicitacoes').css('z-index', '2');
        $('#abaAcompanharSolicitacao').css('background-color','#E6E6E6');
        $('#abaAcompanharSolicitacao').css('display', 'inline-flex');
        $('#abaNovaSolicitacao').css('display', 'none');
    });
    

    function limparCamposPesquisaSolicitacoes(){
        camposSelecionados = {};

        $("#pesquisaNumeroSolicitacao").val('');
        $("#pesquisaNumeroSolicitacao").attr('attr-campoalterado', '0');
        
        $("#pesquisaProdutoSolicitacao").val('');
        $("#pesquisaProdutoSolicitacao").attr('attr-campoalterado', '0');
        
        $("#pesquisaDependenciaSolicitacao").val('');
        $("#pesquisaDependenciaSolicitacao").attr('attr-campoalterado', '0');

        $("#campoStatusSolicitacao option[value=0]").prop('selected', 'selected');
        $("#campoStatusSolicitacao").attr('attr-campoalterado', '0');
        
        consultaSolicitacoes();
    }

    function consultaSolicitacoes(){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';

        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'consultaSolicitacoes' 
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1){                 
                    $('.bodyTabelaSolicitacoes').html('');
                    $('.bodyTabelaSolicitacoes').html(retorno.mensagem);
                }
                else{
                    alert("Não foi possível consultar a lista de solicitações. L114 - solicitacoes.js");
                }
            },
            error: function(erro) {
                alert("Não foi possível consultar a lista de solicitações. L118 - solicitacoes.js");
            }
        });
    }

    function filtrarSolicitacoes(camposSelecionados){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';

        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'filtrarSolicitacoes' ,
                camposSelecionados: camposSelecionados
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1){                 
                    $('.bodyTabelaSolicitacoes').html('');
                    $('.bodyTabelaSolicitacoes').html(retorno.mensagem);
                    // alert(retorno.mensagem);
                }
                else{
                    bootbox.dialog({
                        backdrop: true,
                        // onEscape: function() {},
                        closeButton: true,
                        size: "small",
                        title: "Erro!",
                        message: "<div>"+retorno.mensagem+"</div>",
                        buttons: {
                            confirm: {
                                label: "OK",
                                className: "btn-warning"
                            }
                        },
                    });
                    return false;
                }
            },
            error: function(erro) {
                alert("Não foi possível consultar a lista de solicitações. L147 - solicitacoes.js");
            }
        });
    }

    $('#incluirNovaJornada').on('click', function(){
        $('.formNovaJornada').css('display', 'block');
        $('.divAvisosBotNovo').css('display', 'none');
    });
    
    /*## Seção dos itens de editar #####*/
    $('#incluirNovosConteudosEditar').on('click', function(){
        $('.formNovoConteudoBotEditar').css('display', 'block');
        $('.divAvisosBotNovoEditar').css('display', 'none');
    });

    $('#desenvolverBotEditar').on('click', function(){
        $('.divAvisosBotNovoEditar').css('display', 'block');
        $('.formNovoConteudoBot').css('display', 'none');
        $('#idAvisoBotFunciEditar').css('display', 'none');
        $('#idAvisoBotSuporteEditar').css('display', 'none');
    });


    $('#radioClientePFEditar').on('click', function(){
        $('.divSolicitacaoJornadaPFEditar').css('display', 'block');
    });

    $('#radioClientePJEditar').on('click', function(){
        $('.divSolicitacaoJornadaPJ').css('display', 'block');
    });
    

    $('#radioFunciBBEditar').on('click', function(){
        $('#idAvisoBotFunciEditar').css('display', 'inline-flex');
        $('#idAvisoBotSuporteEditar').css('display', 'none');


    });


    $("#radioSuporteTecnicoEditar").on('click', function(){
        $('#idAvisoBotSuporteEditar').css('display', 'inline-flex');
        $('#idAvisoBotFunciEditar').css('display', 'none');

    });


    $('#divIconeInterrogaTransacaoEditar').on('mouseenter', function(){
        $('#divAvisoJornadaTransacaoPFEditar').css('display', 'block');
    });

    $('#divIconeInterrogaTransacaoEditar').on('click', function(){
        $('#divAvisoJornadaTransacaoPFEditar').css('display', 'block');
    });

    $('#divIconeInterrogaTransacaoEditar').on('mouseleave', function(){
        $('#divAvisoJornadaTransacaoPFEditar').css('display', 'none');
    });

    $('#radioTransacaoPFEditar').on('click', function(){
        $('.divSolicitacaoJornadaTransacaoPF').css('display', 'block');
        
    });

    $('#divIconeceInterrogaJornadaInf').on('mouseenter', function(){
        $('#divAvisoJornadaInformacionalPFEditar').css('display', 'block');
    });

    $('#divIconeceInterrogaJornadaInf').on('click', function(){
        $('#divAvisoJornadaInformacionalPFEditar').css('display', 'block');
    });

    $('#divIconeceInterrogaJornadaInf').on('mouseleave', function(){
        $('#divAvisoJornadaInformacionalPFEditar').css('display', 'none');
    });

    $('#divIconeInterrogaCampanhaMsgeAtivaPf').on('mouseenter', function(){
        $('#divAvisoDisparoCampanhaMensagemAtivaPF').css('display', 'block');
        
    });

    $('#divIconeInterrogaCampanhaMsgeAtivaPf').on('mouseleave', function(){
        $('#divAvisoDisparoCampanhaMensagemAtivaPF').css('display', 'none');
    });

     $('#divIconeInterrogaMotorMsgeAtivaPf').on('mouseenter', function(){
        $('#divAvisoDisparoMotorMensagemAtivaPF').css('display', 'block');
        
    });

    $('#divIconeInterrogaMotorMsgeAtivaPf').on('mouseleave', function(){
        $('#divAvisoDisparoMotorMensagemAtivaPF').css('display', 'none');
        
    });

    $('#divIconeInterrogaSistemaLegadoMsgeAtivaPf').on('mouseenter', function(){
        $('#divAvisoDisparoSistemaLegadoMensagemAtivaPF').css('display', 'block');
        
    });

    $('#divIconeInterrogaSistemaLegadoMsgeAtivaPf').on('mouseleave', function(){
        $('#divAvisoDisparoSistemaLegadoMensagemAtivaPF').css('display', 'none');
        
    });

     $('#divIconeInterrogaFaleComMsgeAtivaPf').on('mouseenter', function(){
        $('#divAvisoDisparoFaleComMensagemAtivaPF').css('display', 'block');
        
    });
    
    $('#divIconeInterrogaFaleComMsgeAtivaPf').on('mouseleave', function(){
        $('#divAvisoDisparoFaleComMensagemAtivaPF').css('display', 'none');
        
    });

    

    $('#iconeInterrogacaoNumSalaDebateTemplatePf').on('mouseenter', function(){
        $('#divAvisoNumSalaDebateTemplate').css('display','block');
    });

     $('#iconeInterrogacaoNumSalaDebateTemplatePf').on('mouseleave', function(){
        $('#divAvisoNumSalaDebateTemplate').css('display','none');
    });

    $('#divIconeInterrogacaoCamposVariaveisMsgeAtivaPf').on('mouseenter', function(){
        $('#divAvisoCamposVariaveisMsgeAtiva').css('display', 'block');
    });

    $('#divIconeInterrogacaoCamposVariaveisMsgeAtivaPf').on('mouseleave', function(){
        $('#divAvisoCamposVariaveisMsgeAtiva').css('display', 'none');
    });
    // $('#radioJornadaInformacionalPFEditar').on('click', function(){
    //     $('.divSolicitacaoJornadaInformacionalPF').css('display', 'block');
    // });




    /*###########################*/
    /*início do formulário*/
    /*PF*/

    /*Botão para voltar para a primeira pagina do formulario PF*/
    function voltaPagina(){
        var atual = $(".divPaginaForm:visible");
        $('.divPaginaForm').hide();
        var numPagina = parseInt(atual.attr("attr-numPagForm"), 10);
        var proxPagina = numPagina-1;
        $(`div[attr-numPagForm="${proxPagina}"]`).show();
        
    }
    
    function proximaPagina(){

        var atual = $(".divPaginaForm:visible");
        $('.divPaginaForm').hide();
        var numPagina = parseInt(atual.attr("attr-numPagForm"), 10);
        var proxPagina = numPagina+1;
        $(`div[attr-numPagForm="${proxPagina}"]`).show();


    }

    $('#btnVoltar0NovaJornadaPF').on('click', function(){
            // $('#formPagina1').css('display', 'none');
            // $('.nestBreadcrumbs').css('display', 'none');
            // $('#formPagina0').css('display', 'block');
            voltaPagina();
    
    });

    /*Vai para a pagina de Informações básicas da Mensagem ativa*/    
        $('#btnProximo0NovaJornadaPF').on('click', function(){
            
            if($('#radioMensagemAtivaPF').is(':checked')){
                $('.nestBreadcrumbs').css('display', 'block');
               proximaPagina();
            } 

        });

    //Vai para a pagina de detalhes do disparo       
        $('#btnProximo1NovaJornadaPF').on('click', function(){
            // $('#formPagina1').css('display', 'none');
            // $('#formPagina2').css('display', 'block');
            proximaPagina();
            //     return $(this).css("display") == "block";
            

        });

        $('#btnVoltar1NovaJornadaPF').on('click', function(){
           voltaPagina();
        });


        $('#btnVoltar2NovaJornadaPF').on('click', function(){
            voltaPagina();

        });
        $('#btnProximo2NovaJornadaPF').on('click', function(){
            proximaPagina();

        });

        $('#btnProximo3NovaJornadaPF').on('click', function(){
            proximaPagina();
        });

        $('#btnVoltar3NovaJornadaPF').on('click', function(){
           voltaPagina();
        });

         $('#btnProximo4NovaJornadaPF').on('click', function(){
           proximaPagina();
             
        });

         $('#btnVoltar4NovaJornadaPF').on('click', function(){
            voltaPagina();
        });

         $('#btnProximo7NovaJornadaPF').on('click', function(){
            proximaPagina();
             

        });




    //Volta para a pagina inicial do formulário PF
        $('#setaVoltaJornadaPFMsgeAtivaPag').on('click', function(){
            var atual = $(".divPaginaForm:visible");
            var numPagina = parseInt(atual.attr("attr-numPagForm"), 10);
            paginaAnterior = numPagina-1;
            
            if(paginaAnterior ==0){                
                $('.nestBreadcrumbs').css('display', 'none');
            }
            voltaPagina();

        })

        

    $('#desenvolverBot').on('click', function(){
        $('.divAvisosBotNovo').css('display', 'block');
        $('.formNovoConteudoBot').css('display', 'none');
        $('#idAvisoBotFunci').css('display', 'none');
        $('#idAvisoBotSuporte').css('display', 'none');
    });

    $('#radioFunciBB').on('click', function(){
        $('#idAvisoBotFunci').css('display', 'inline-flex');
        $('#idAvisoBotSuporte').css('display', 'none');


    });

    $("#radioSuporteTecnico").on('click', function(){
        $('#idAvisoBotSuporte').css('display', 'inline-flex');
        $('#idAvisoBotFunci').css('display', 'none');

    });

    $('#radioClientePF').on('click', function(){
        $('.divSolicitacaoJornadaPF').css('display', 'block');
    });
    

    $('#divIconeInterrogaTransacao').on('mouseenter', function(){
        $('#divAvisoJornadaTransacaoPF').css('display', 'block');

    });

    // $('#divIconeInterrogaTransacao').on('click', function(){
    //     $('#divAvisoJornadaTransacaoPF').css('display', 'block');
    //      alert("block2");
    // });

    $('#divIconeInterrogaTransacao').on('mouseleave', function(){
        $('#divAvisoJornadaTransacaoPF').css('display', 'none');

    });

    $('#divIconeceInterrogaJornadaInf').on('mouseenter', function(){
        $('#divAvisoJornadaInformacionalPF').css('display', 'block');
    });

    $('#divIconeceInterrogaJornadaInf').on('click', function(){
        $('#divAvisoJornadaInformacionalPF').css('display', 'block');
    });

    $('#divIconeceInterrogaJornadaInf').on('mouseleave', function(){
        $('#divAvisoJornadaInformacionalPF').css('display', 'none');
    });

    $('#divIconeInterrogaMensagemAtiva').on('mouseenter', function(){
        $('#divAvisoJornadaMensagemAtivaPF').css('display', 'block');
    });

    $('#divIconeInterrogaMensagemAtiva').on('click', function(){
        $('#divAvisoJornadaMensagemAtivaPF').css('display', 'block');
    });


    $('#divIconeInterrogaMensagemAtiva').on('mouseleave', function(){
        $('#divAvisoJornadaMensagemAtivaPF').css('display', 'none');
    });

    $('#divIconeInterrogaCriaLink').on('mouseenter', function(){
        $('#divAvisoJornadaQRCodePF').css('display', 'block');
    });
    
    $('#divIconeInterrogaCriaLink').on('mouseleave', function(){
        $('#divAvisoJornadaQRCodePF').css('display', 'none');
    });

     $('#divIconeInterrogacaoDeeplink').on('mouseenter', function(){
        
        $('#divAvisoDeeplink').css('display', 'block');
        
    });
    
    $('#divIconeInterrogacaoDeeplink').on('mouseleave', function(){
        $('#divAvisoDeeplink').css('display', 'none');
        
    });

    $('#radioTransacaoPF').on('click', function(){
        $('.divSolicitacaoJornadaTransacaoPF').css('display', 'block');
    });
    
   
    $('#radioClientePJ').on('click', function(){
        $('.divSolicitacaoJornadaPJ').css('display', 'block');
    }); 

    $('#radioTransacaoPJ').on('click', function(){
        $('.divSolicitacaoJornadaTransacaoPJ').css('display', 'block');
    });

    $('#radioJornadaInformacionalPF').on('click', function(){
        $('.divSolicitacaoJornadaInformacionalPF').css('display', 'block');
    });

    $('#radioInformacionalRaSim').on('click', function(){
        $('#divJornadaInformacionalDisponivelWhatsPF').css('display', 'block');
    });

    $('#radioJornadaInformacionalPJ').on('click', function(){
        $('.divSolicitacaoJornadaInformacionalPJ').css('display', 'block');
    });

    $('#radioInformacionalRaSimPJ').on('click', function(){
        $('#divJornadaInformacionalDisponivelWhatsPJ').css('display', 'block');
    });

    $('#fechaDivAlerCadastroSucesso').on('click', function(){
        $('#alertaSucessoCadastroSolicitacao').css('display', 'none');
    });
    
});

/*Pergunta sobre o FaleCom*/

$('input[type="radio"]').change(function(){
    if($('#radioTemplateFaleCom').is(':checked')){
        $('#divNumSalaTemplatePf').css('display','flex');    
    } else{
        $('#divNumSalaTemplatePf').css('display','none');    
    }

});

$('#numSalaCeluladispTemplate').on('change', function(){
    var numSala = $('#numSalaCeluladispTemplate').val();
   if(!$.isNumeric(numSala)){
        // alert("Digite um valor numérico");
         bootbox.dialog({
                        backdrop: true,
                        onEscape: function() {},
                        closeButton: true,
                        size: "small",
                        message: "<div> Informe um valor numérico</div>",
                        buttons: {
                            confirm: {
                                label: "OK",
                                className: "btn-warning"
                            }
                        },
        });
    }
});


/**Sistema legado*/

$('input[type="radio"]').change(function(){
    if($('#radioDisparoLegado').is(':checked')){
        $('#divSistemaLegadoResponsavel').css('display','block');    
    } else{
        $('#divSistemaLegadoResponsavel').css('display','none');    
    }

});

/*Alinhamento CRM*/ 

/*$('input[type="radio"]').change(function(){
    if( $('#radioDisparoCampanha').is(':checked') || $('#radioDisparoMotor').is(':checked')    ||    $('#radioDisparoLegado').is(':checked')) {
        $('#divPerguntaAlinhamentoCRM').css('display','block'); 

        if ($('#radioAlinhaCRMNao').is(':checked')) {
            
            $('#idDivAvisoCrm').css('display','flex');
            $('#divPerguntaFormMartech').css('display', 'none');
            $('#radioRadioFormMartechSim').prop('checked', false);
            $('#radioRadioFormMartechNao').prop('checked', false);
            $('.avisoFormMartechMsgeAtivaPf').css('display', 'none');
            $('#divNumFormularioMartech').css('display', 'none');
            $('#numFormularioMartech').val('');   


        } else if($('#radioAlinhaCRMSim').is(':checked')){
            
            $('#idDivAvisoCrm').css('display','none');
            $('#divPerguntaFormMartech').css('display', 'block');

            if($('#radioRadioFormMartechNao').is(':checked')){

                $('.avisoFormMartechMsgeAtivaPf').css('display', 'inline-flex');   
                $('#divNumFormularioMartech').css('display', 'none');   
                $('#numFormularioMartech').val('');

            } else if($('#radioRadioFormMartechSim').is(':checked')){

                $('#divNumFormularioMartech').css('display', 'block');
                $('.avisoFormMartechMsgeAtivaPf').css('display', 'none');   
            }

        }
    } 
    
    else if ($('#radioTemplateFaleCom').is(':checked')){

        $('#divPerguntaAlinhamentoCRM').css('display','none');
        $('#idDivAvisoCrm').css('display','none');   
        $('#radioAlinhaCRMNao').prop('checked', false);
        $('#radioAlinhaCRMSim').prop('checked', false);
        $('#divPerguntaFormMartech').css('display', 'none');
        $('#radioRadioFormMartechSim').prop('checked', false);
        $('#radioRadioFormMartechNao').prop('checked', false);
        $('.avisoFormMartechMsgeAtivaPf').css('display', 'none');   
        $('#divNumFormularioMartech').css('display', 'none');   
        $('#numFormularioMartech').val('');

    } 
    
    else if ($('#radioMaisdeUmRME').is(':checked')){
        
        $('#divQtdeRme').css('display', 'block');
        console.log("radiomaisde um rme");

    } 
    
    else if ($('#radioSoUmRME').is(':checked')){
        
        $('#numQtdeRme').val('');
        $('#divQtdeRme').css('display', 'none');
        console.log("só  um rme");
        
    } 
    else if ($('#radioMsgeAtivaDirecionamentoAppPfSim').is(':checked')){
        $('#msgeAtivaPfDivTxtDirecionamentoAppCaminho').css('display','block');

        console.log("direcionamento app");

    } 
    
    else if ($('#radioMsgeAtivaTemDeeplinkNao').is(':checked')){

        console.log("não tem deeplink");
        $('.divMsgeAtivaPfAlertDeeplink').css('display', 'inline-flex');
        

    } 
    else if ($('#radioMsgeAtivaTemDeeplinkSim').is(':checked')){
        
        $('.divMsgeAtivaPfAlertDeeplink').css('display', 'none');
        $('#divMsgeAtivaPfTxtDeeplink').css('display', 'block');
        console.log('tem deeplink');

    } 
    
    else if ($('#radioHaMidiaSim').is(':checked')){
    
        $('.divNestUpload').css('display', 'block');
        $('.divAlertaMidia').css('display', 'none');

    }
    else if ($('#radioHaMidiaNao').is(':checked')){
        
        $('.divNestUpload').css('display', 'none');
        $('.divAlertaMidia').css('display', 'block');
    }


});*/




$('input[type="radio"]').change(function () {
    handleCRMGroup();
    handleFaleComGroup();
    handleRMEGroup();
    handleDirecionamentoAppGroup();
    handleDeeplinkGroup();
    handleOutrosDirecionamentosGroup() ;
    handleMidiaGroup();
    handleTransbordoGroup()
});

// Função para lidar com o grupo CRM e Martech
function handleCRMGroup() {
    if ($('#radioDisparoCampanha').is(':checked') || $('#radioDisparoMotor').is(':checked') || $('#radioDisparoLegado').is(':checked')) {
        $('#divPerguntaAlinhamentoCRM').css('display', 'block');
        //A pergunta sobre o atendimento humano está na sessão 5 e só aparece se o disparo for campanha, motor de interação, ou sistema legado
        $('#divPerguntaMsgeAtivaPfTransbordoHumano').css('display', 'block');

        if ($('#radioAlinhaCRMNao').is(':checked')) {
            $('#idDivAvisoCrm').css('display', 'flex');
            $('#divPerguntaFormMartech').css('display', 'none');
            $('#radioRadioFormMartechSim, #radioRadioFormMartechNao').prop('checked', false);
            $('.avisoFormMartechMsgeAtivaPf').css('display', 'none');
            $('#divNumFormularioMartech').css('display', 'none');
            $('#numFormularioMartech').val('');
        } else if ($('#radioAlinhaCRMSim').is(':checked')) {
            $('#idDivAvisoCrm').css('display', 'none');
            $('#divPerguntaFormMartech').css('display', 'block');

            if ($('#radioRadioFormMartechNao').is(':checked')) {
                $('.avisoFormMartechMsgeAtivaPf').css('display', 'inline-flex');
                $('#divNumFormularioMartech').css('display', 'none');
                $('#numFormularioMartech').val('');
            } else if ($('#radioRadioFormMartechSim').is(':checked')) {
                $('#divNumFormularioMartech').css('display', 'block');
                $('.avisoFormMartechMsgeAtivaPf').css('display', 'none');
            }
        }
    }
}

// Função para lidar com o grupo "Fale Com"
function handleFaleComGroup() {
    if ($('#radioTemplateFaleCom').is(':checked')) {
        $('#divPerguntaAlinhamentoCRM, #idDivAvisoCrm, #divPerguntaFormMartech, .avisoFormMartechMsgeAtivaPf, #divNumFormularioMartech').css('display', 'none');
        $('#radioAlinhaCRMNao, #radioAlinhaCRMSim, #radioRadioFormMartechSim, #radioRadioFormMartechNao').prop('checked', false);
        $('#numFormularioMartech').val('');
        // Se a opção selecionada for faleCom a pergunta sobre transbordo humano na sessão 5  não aparece
        $('#divPerguntaMsgeAtivaPfTransbordoHumano').css('display', 'none');
    }
}

// Função para lidar com o grupo RME
function handleRMEGroup() {
    if ($('#radioMaisdeUmRME').is(':checked')) {
        $('#divQtdeRme').css('display', 'block');
    } else if ($('#radioSoUmRME').is(':checked')) {
        $('#numQtdeRme').val('');
        $('#divQtdeRme').css('display', 'none');
    }
}

// Função para lidar com direcionamento App
function handleDirecionamentoAppGroup() {
    if ($('#radioMsgeAtivaDirecionamentoAppPfSim').is(':checked')) {

        $('#msgeAtivaPfDivTxtDirecionamentoAppCaminho').css('display', 'block');

    } else if ($('#radioMsgeAtivaDirecionamentoAppPfNao').is(':checked')) {
        $('#msgeAtivaPfDivTxtDirecionamentoAppCaminho').css('display', 'none');
        $('#caminhoAppMsgeAtivaPf').val('');
    }
}

// Função para lidar com Deeplink
function handleDeeplinkGroup() {
    if ($('#radioMsgeAtivaTemDeeplinkNao').is(':checked')) {

        $('.divMsgeAtivaPfAlertDeeplink').css('display', 'inline-flex');
        $('#divMsgeAtivaPfTxtDeeplink').css('display', 'none');
        $('#msgeAtivaPfDeeplink').val('');

    } else if ($('#radioMsgeAtivaTemDeeplinkSim').is(':checked')) {

        $('.divMsgeAtivaPfAlertDeeplink').css('display', 'none');
        $('#divMsgeAtivaPfTxtDeeplink').css('display', 'block');
    }
}


function handleOutrosDirecionamentosGroup() {
    if ($('#radioMsgeAtivaOutrosDirecionamentosPfNao').is(':checked')) {

        $('#divMsgeAtivaPfTxtCaminhoOutrosDirecionamentos').css('display', 'none');
        $('#msgeAtivaPfTxtCaminhoOutrosDirecionamentos').val('');
        

    } else if ($('#radioMsgeAtivaOutrosDirecionamentosPfSim').is(':checked')) {

        $('#divMsgeAtivaPfTxtCaminhoOutrosDirecionamentos').css('display', 'block');
        
    }
}



// Função para lidar com Mídia
function handleMidiaGroup() {
    if ($('#radioHaMidiaSim').is(':checked')) {
        $('.divNestUpload').css('display', 'block');
        $('.divAlertaMidia').css('display', 'none');
    } else if ($('#radioHaMidiaNao').is(':checked')) {
        $('.divNestUpload').css('display', 'none');
        $('.divAlertaMidia').css('display', 'block');
    }
}

function handleTransbordoGroup(){
    
    if($('#radioHatransbordoHumanoSim').is(':checked')){
        
        $('#divPerguntaMsgeAtivaPfTransbordoNegociaUAC').css('display','block');
        
        if($('#radioTransbordoNegociaUACNao').is(':checked')){

            $('#idAlertaNegociaTransbordoUAC').css('display','block');

        } else if($('#radioTransbordoNegociaUACSim').is(':checked')){}
    

    } else if ($('#radioHaTransbordoHumanoNao').is(':checked')){
        
        $('#divPerguntaMsgeAtivaPfTransbordoNegociaUAC').css('display','none');
        $('#radioTransbordoNegociaUACNao').prop('checked', false);
        $('#radioTransbordoNegociaUACSim').prop('checked', false);


    }

}

$('#idCampoCategoriaMensagemAtiva').change(function(){
  var categoriaMensagemAtiva = $('#idCampoCategoriaMensagemAtiva').val();
  
  if (categoriaMensagemAtiva === "Mercadológica" || categoriaMensagemAtiva === "Relacional Negocial" ){
    
    $('#codProdutoJornadaMsgeAtivaPf').show();

  } else{
    
    $('#codProdutoJornadaMsgeAtivaPf').hide();
    $('#inputCodProduto').val('');

  }

});


$('#btnEspecificacoesMetaMsgeAtivaPf').on('click', function(){

    bootbox.dialog({
                        backdrop: true,
                        onEscape: function() {},
                        closeButton: true,
                        size: "large",
                        message: "<div><span class='txtBootboxEspecificaMeta'> Especificações de envio de mídia permitidos pela Meta/Whatsapp:</span> <br><br> <img src='https://cad.desenv.bb.com.br/lib/img/apps/solicitacoes/especificacoesMeta.png' style='width: 100%;'></div>",
                        buttons: {
                            confirm: {
                                label: "OK",
                                className: "btn-warning"
                            }
                        },
        });
});




