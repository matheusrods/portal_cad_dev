$(document).ready(function(){


    /*início do formulário*/
    /*PF*/


    /*Vai para a pagina de Informações básicas das Jornadas*/    
    $('#btnProximo1NovaJornadaPF').on('click', function(){
        
        if($('#radioMensagemAtivaPf').is(':checked')){
            $('.nestBreadcrumbsMsgeAtiva').css('display', 'block');
            proximaPagina();

        } else if($('#radioJornadaInformacionalPF').is(':checked')){

            $('.nestBreadcrumbsJornadaInformacional').css('display', 'block');
            $('#formPagina0').css('display', 'none');
            $('#formPaginaJorInf1').css('display', 'block');
        
        } else if($('#radioTransacaoPF').is(':checked')){

            $('.nestBreadcrumbsJornadaTransacaoPf').css('display', 'block');
            $('#formPagina0').css('display', 'none');
            $('#formPaginaTransPf1').css('display', 'block');

        } else if($('#radioCriacaoLinkQRCode').is(':checked')){

            $('.nestBreadcrumbsJornadaCriacaoLinkQrCodePf').css('display', 'block');
            $('#formPagina0').css('display', 'none');
            $('#formPaginaCriaLinkPf1').css('display', 'block');
        }
    });

    /* Navegação da Mensagem Ativa*/

    //Função para voltar para a pagina anterior do formulário na Jornada de mensagem Ativa
    
    function voltaPagina(){
        var atual = $(".divPaginaFormMsgeAtivaPf:visible");
        $('.divPaginaFormMsgeAtivaPf').hide();
        var numPagina = parseInt(atual.attr("attr-numPagForm"), 10);
        var proxPagina = numPagina-1;

        if(proxPagina ==0){                
            $('.nestBreadcrumbsMsgeAtiva').css('display', 'none');
        }
        $(`div[attr-numPagForm="${proxPagina}"]`).show();
        
    }
    
    //Função para ir para a próxima página do formulário de Mensagem Ativa
    function proximaPagina(){

        var atual = $(".divPaginaFormMsgeAtivaPf:visible");
        $('.divPaginaFormMsgeAtivaPf').hide();
        var numPagina = parseInt(atual.attr("attr-numPagForm"), 10);
        var proxPagina = numPagina+1;
        $(`div[attr-numPagForm="${proxPagina}"]`).show();
        

    }

    //Volta para a pagina inicial do formulário PF
    $('#setaVoltaJornadaPFMsgeAtivaPag').on('click', function(){        
        voltaPagina();

    })


    $('#btnProximo2NovaJornadaPF').on('click', function(){
        proximaPagina();
    });
     $('#btnProximo3NovaJornadaPF').on('click', function(){
        proximaPagina();
    });

    $('#btnProximo4NovaJornadaPF').on('click', function(){
        proximaPagina();
        
    });

    $('#btnProximo5NovaJornadaPF').on('click', function(){
        proximaPagina();        
    });

     $('#btnProximo6NovaJornadaPF').on('click', function(){
        proximaPagina();        
    });

     $('#btnProximo7NovaJornadaPF').on('click', function(){
        proximaPagina();        
    });


     $('#btnVoltar0NovaJornadaPF').on('click', function(){
        voltaPagina();        
    });
     $('#btnVoltar1NovaJornadaPF').on('click', function(){
        voltaPagina();        
    });

    $('#btnVoltar2NovaJornadaPF').on('click', function(){
        voltaPagina();        
    });

    $('#btnVoltar3NovaJornadaPF').on('click', function(){
        voltaPagina();        
    });
    $('#btnVoltar4NovaJornadaPF').on('click', function(){
        voltaPagina();        
    });
    $('#btnVoltar5NovaJornadaPF').on('click', function(){
        voltaPagina();        
    });
    $('#btnVoltar6NovaJornadaPF').on('click', function(){
        voltaPagina();        
    });
  

    /*Navegação Jornada Informacional*/


   function proximaPaginaJornInfPf(){

        var atual = $(".divPaginaFormJornInfPf:visible");
        $('.divPaginaFormJornInfPf').hide();
        var numPagina = parseInt(atual.attr("attr-numPagFormJornInf"), 10);
        var proxPagina = numPagina+1;
        $(`div[attr-numPagFormJornInf="${proxPagina}"]`).show();
        console.log('pagina atual:', numPagina);
        console.log('proxima pagina :', proxPagina);
        

    }

    function voltaPaginaJornInf(){
        var atual = $(".divPaginaFormJornInfPf:visible");
        $('.divPaginaFormJornInfPf').hide();
        var numPagina = parseInt(atual.attr("attr-numPagFormJornInf"), 10);
        var proxPagina = numPagina-1;

        if(numPagina == 1){
            $('#formPagina0').css('display', 'block');
            $('.nestBreadcrumbsJornadaInformacional').css('display', 'none');
            return;
        }
        else if(proxPagina == 0){                
            $('.nestBreadcrumbsJornadaInformacional').css('display', 'none');
        }
        console.log('pagina atual:', numPagina);
        console.log('proxima pagina :', proxPagina);

        $(`div[attr-numPagFormJornInf="${proxPagina}"]`).show();
      
    }

    $('#setaVoltaJornadaPFJornadaInfPag').on('click', function(){
        voltaPaginaJornInf();
    });

    $('#btnProximo2NovaJornadaInfPF').on('click', function(){
        proximaPaginaJornInfPf();
    });
     $('#btnProximo3NovaJornadaInfPF').on('click', function(){
        proximaPaginaJornInfPf();
    });

    $('#btnProximo4NovaJornadaInfPF').on('click', function(){
        proximaPaginaJornInfPf();
        
    });

    $('#btnProximo5NovaJornadaInfPF').on('click', function(){
        proximaPaginaJornInfPf();        
    });

     $('#btnProximo6NovaJornadaInfPF').on('click', function(){
        proximaPaginaJornInfPf();        
    });

    
    $('#btnVoltar0NovaJornadaInfPF').on('click', function(){
        voltaPaginaJornInf();
    });

     $('#btnVoltar1NovaJornadaInfPF').on('click', function(){
        voltaPaginaJornInf();        
    });

    $('#btnVoltar2NovaJornadaInfPF').on('click', function(){
        voltaPaginaJornInf();        
    });

    $('#btnVoltar3NovaJornadaInfPF').on('click', function(){
        voltaPaginaJornInf();        
    });
    $('#btnVoltar4NovaJornadaInfPF').on('click', function(){
        voltaPaginaJornInf();        
    });
    $('#btnVoltar5NovaJornadaInfPF').on('click', function(){
        voltaPaginaJornInf();        
    });

    /*Navegação Jornada de transação Pf*/


    function proximaPaginaTransPf(){

        var atual = $(".divPaginaFormTransPf:visible");
        $('.divPaginaFormTransPf').hide();
        var numPagina = parseInt(atual.attr("attr-numPagFormTransPf"), 10);
        var proxPagina = numPagina+1;
        $(`div[attr-numPagFormTransPf="${proxPagina}"]`).show();
      
        

    }

    function voltaPaginaTransPf(){
        var atual = $(".divPaginaFormTransPf:visible");
        $('.divPaginaFormTransPf').hide();
        var numPagina = parseInt(atual.attr("attr-numPagFormTransPf"), 10);
        var proxPagina = numPagina-1;

        if(numPagina == 1){
            $('#formPagina0').css('display', 'block');
            $('.nestBreadcrumbsJornadaTransacaoPf').css('display', 'none');
            return;
        }
        else if(proxPagina == 0){                
            $('.nestBreadcrumbsJornadaTransacaoPf').css('display', 'none');
        }
        console.log('pagina atual:', numPagina);
        console.log('proxima pagina :', proxPagina);

        $(`div[attr-numPagFormTransPf="${proxPagina}"]`).show();
      
    }

    $('#setaVoltaJornadaPFTransPag').on('click', function(){
        voltaPaginaTransPf();   
    });

   $('#btnProximo2NovaTransacaoPF').on('click', function(){
        proximaPaginaTransPf();
    });

    $('#btnProximo3NovaTransacaoPF').on('click', function(){
        proximaPaginaTransPf();
    });

    $('#btnProximo4NovaTransacaoPF').on('click', function(){
        proximaPaginaTransPf();
        
    });

    $('#btnProximo5NovaTransacaoPF').on('click', function(){
        proximaPaginaTransPf();
    });

     $('#btnProximo6NovaTransacaoPF').on('click', function(){
        proximaPaginaTransPf();
    });

    $('#btnVoltar0NovaTransacaoPF').on('click', function(){
        voltaPaginaTransPf();
    });

     $('#btnVoltar1NovaTransacaoPF').on('click', function(){
        voltaPaginaTransPf();        
    });

    $('#btnVoltar2NovaTransacaoPF').on('click', function(){
        voltaPaginaTransPf();        
    });

    $('#btnVoltar3NovaTransacaoPF').on('click', function(){
        voltaPaginaTransPf();        
    });
    $('#btnVoltar4NovaTransacaoPF').on('click', function(){
        voltaPaginaTransPf();        
    });
        
    $('#btnVoltar5NovaTransacaoPF').on('click', function(){
        voltaPaginaTransPf();        
    });
    

    /**Navegação Jornada de Criação de Link/QR Code */


 function proximaPaginaCriaLinkPf(){

        var atual = $(".divPaginaFormLinkPf:visible");
        $('.divPaginaFormLinkPf').hide();
        var numPagina = parseInt(atual.attr("attr-numPagFormCriaLinkPf"), 10);
        var proxPagina = numPagina+1;
        $(`div[attr-numPagFormCriaLinkPf="${proxPagina}"]`).show();
      
        

    }

    function voltaPaginaCriaLinkPf(){
        var atual = $(".divPaginaFormLinkPf:visible");
        $('.divPaginaFormLinkPf').hide();
        var numPagina = parseInt(atual.attr("attr-numPagFormCriaLinkPf"), 10);
        var proxPagina = numPagina-1;

        if(numPagina == 1){
            $('#formPagina0').css('display', 'block');
            $('.nestBreadcrumbsJornadaCriacaoLinkQrCodePf').css('display', 'none');
            console.log("Pagina=1"+ numPagina);
            return;
        }
        else if(proxPagina == 0){      
            console.log("Se a proxima Pagina=0"+ numPagina);
            console.log(proxPagina);   
            alert       
            $('.nestBreadcrumbsJornadaCriacaoLinkQrCodePf').css('display', 'none');
        }
        
        $(`div[attr-numPagFormCriaLinkPf="${proxPagina}"]`).show();
      
    }

    $('#setaVoltaJornadaPFCriaLink').on('click', function(){
        voltaPaginaCriaLinkPf();   
    });

   $('#btnProximo2NovoLinkQrCodePF').on('click', function(){
        proximaPaginaCriaLinkPf();
    });

    $('#btnProximo3NovoLinkQrCodePF').on('click', function(){
        proximaPaginaCriaLinkPf();
    });

    $('#btnProximo4NovoLinkQrCodePF').on('click', function(){
        proximaPaginaCriaLinkPf();
        
    });

    $('#btnProximo5NovoLinkQrCodePF').on('click', function(){
        proximaPaginaCriaLinkPf();
    });

     $('#btnProximo6NovoLinkQrCodePF').on('click', function(){
        proximaPaginaCriaLinkPf();
    });

    $('#btnVoltar0NovoLinkQrCodePF').on('click', function(){
        voltaPaginaCriaLinkPf();
    });

     $('#btnVoltar1NovoLinkQrCodePF').on('click', function(){
        voltaPaginaCriaLinkPf();        
    });

    $('#btnVoltar2NovoLinkQrCodePF').on('click', function(){
        voltaPaginaCriaLinkPf();        
    });

    $('#btnVoltar3NovoLinkQrCodePF').on('click', function(){
        voltaPaginaCriaLinkPf();        
    });
    $('#btnVoltar4NovoLinkQrCodePF').on('click', function(){
        voltaPaginaCriaLinkPf();        
    });
        
    $('#btnVoltar5NovoLinkQrCodePF').on('click', function(){
        voltaPaginaCriaLinkPf();        
    });
    



        
    //    insereDadosIniciais();


     /*    const respostas = [];
     // 1. Captura inputs de texto
        $('#formPagina0 input[type="text"]').each(function() {
            respostas.push({
            id_pergunta: $(this).attr('attr-perguntasInfIniciais'),
            resposta: $(this).val()
            });
         
        });
       
        // 2. Captura selects
        $('#formPagina0 select').each(function() {
            respostas.push({
            id_pergunta: $(this).attr('attr-perguntasInfIniciais'),
            resposta: $(this).val()
            });
        });

        // 3. Captura radio buttons selecionados
        $('#formPagina0  input[type="radio"]:checked').each(function() {
            respostas.push({
            id_pergunta: $(this).attr('attr-perguntasInfIniciais'),
            resposta: $(this).val()
            });
        });
    
        // 4. Captura textareas (se houver)
        $('#formPagina0  textarea').each(function() {
            respostas.push({
            id_pergunta: $(this).attr('attr-perguntasInfIniciais'),
            resposta: $(this).val()
            });
        });
  console.log(respostas)      ;


        var caminhoController = "https://cad.desenv.bb.com.br/lib/apps/refinamentoTecnico/controller/controller_refinamentoTecnico.php";

         
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'gravaInicioForm',
                respostas: respostas

                
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno){
                if (retorno.status==1){
                    alert("entrou no primeiro If");                    
                } else {
                    alert("entrou no else");
                }
            },
            error: function(erro){
                alert("Não foi possível efetuar a operação, por favor tente novamente. L74 - newRefinamentoTecnico.js");
            }

        });

    });*/
        

    // function insereDadosIniciais() {
    //     var caminhoController = "https://cad.desenv.bb.com.br/lib/apps/refinamentoTecnico/controller/controller_refinamentoTecnico.php";

    //     var nomeSolicitante = $('#nomeSolicitante').val();
    //     var matriculaSolicitante = $('#matriculaSolicitante').val();
    //     var emailSolicitante = $('#emailSolicitante').val();
    //     var dependenciaSolicitante = $('#dependenciaSolicitante').val();

    //     $.ajax({
    //         async: true,
    //         url: caminhoController,
    //         type: "POST",
    //         data: {
    //             request: 'gravaInicioForm',
    //             nomeSolicitante: nomeSolicitante,
    //             matriculaSolicitante: matriculaSolicitante,
    //             emailSolicitante: emailSolicitante,
    //             dependenciaSolicitante: dependenciaSolicitante
    //         },
    //         success: function(response) {
    //             try {
    //                 var retorno = JSON.parse(response);
    //                 console.log("Retorno parseado:", retorno);
    //                 idInserido = retorno.idInserido;
    //                 inicializaForm(idInserido);

    //                 // if (retorno.status == "1") {
    //                 //     alert("gravou");
    //                 // } else {
    //                 //     alert("não gravou");
    //                 // }
    //             } catch (e) {
    //                 console.error("Erro ao fazer parse do JSON:", e);
    //                 console.error("Resposta bruta:", response);
    //                 // alert("Erro ao interpretar a resposta do servidor.");
    //             }
    //         },
    //         error: function(erro) {
    //             console.error("Erro AJAX:", erro);
    //             alert("Não foi possível efetuar a operação, por favor tente novamente. L162 - newRefinamentoTecnico.js");
    //         }
    //     });
    // }


    // $('#btnProximo1NovaJornadaPF').on('click', function(){
    //     inicializaFormulario();
    // });


    function inicializaForm(idInserido){
        idFormulario = idInserido;
        var caminhoController = "https://cad.desenv.bb.com.br/lib/apps/refinamentoTecnico/controller/controller_refinamentoTecnico.php";

        const respostas = [];
     // 1. Captura inputs de texto
        $('input[type="text"][attr-perguntasInfFormPf]').each(function() {
            respostas.push({
            id_pergunta: $(this).attr('attr-perguntasInfFormPf'),
            resposta: $(this).val()
            });
         
        });
       
        // 2. Captura selects
        $('select[attr-perguntasInfFormPf]').each(function() {
            respostas.push({
            id_pergunta: $(this).attr('attr-perguntasInfFormPf'),
            resposta: $(this).val()
            });
        });

        // 3. Captura radio buttons selecionados
        $('input[type="radio"][attr-perguntasInfFormPf]:checked').each(function() {
            respostas.push({
            id_pergunta: $(this).attr('attr-perguntasInfFormPf'),
            resposta: $(this).val()
            });
        });
    
        // 4. Captura textareas (se houver)
        $('textarea[attr-perguntasInfFormPf]').each(function() {
            respostas.push({
            id_pergunta: $(this).attr('attr-perguntasInfFormPf'),
            resposta: $(this).val()
            });
        });
        
        console.log(respostas);


        $.ajax({
            async: true,
            url: caminhoController,
            type: "POST",
            data: {
                request: 'inicializaForm',
                respostas: JSON.stringify(respostas),
                idFormulario: idFormulario
                
            },
            success: function(response) {
                try {
                    var retorno = JSON.parse(response);
                    if (retorno.status == "1") {
                        // alert("entrou no primeiro If");
                        // alert(retorno.status);
                    } else {
                        // alert("entrou no segundo else");
                        // alert(retorno.status);
                    }
                } catch (e) {
                    console.error("Erro ao fazer parse do JSON:", e);
                    console.error("Resposta bruta:", response);
                    
                    
                }
            },
            error: function(erro) {
                console.error("Erro AJAX:", erro);
                alert("Não foi possível efetuar a operação, por favor tente novamente. L241 - newRefinamentoTecnico.js");
            }
        });
        

    }


    

/* Alertas/Avisos/disclaimers dos ícones de interrogação*/


    $('#radioClientePF').on('click', function(){
        $('.divSolicitacaoJornadaPF').slideToggle();
    });
    

    $('#divIconeInterrogaTransacaoPf').on('mouseenter', function(){
        $('#divAvisoTransacaoPf').css('display', 'block');
        
    });


    $('#divIconeInterrogaTransacaoPf').on('mouseleave', function(){
        $('#divAvisoTransacaoPf').css('display', 'none');

    });

    $('#divIconeInterrogaJornadaInformacionalPf').on('mouseenter', function(){
        $('#divAvisoJornadaInformacionalPf').css('display', 'block');
    });


    $('#divIconeInterrogaJornadaInformacionalPf').on('mouseleave', function(){
        $('#divAvisoJornadaInformacionalPf').css('display', 'none');
    });

    $('#divIconeInterrogaMensagemAtivaPf').on('mouseenter', function(){
        $('#divAvisoMensagemAtivaPf').css('display', 'block');
    });

   
    $('#divIconeInterrogaMensagemAtivaPf').on('mouseleave', function(){
        $('#divAvisoMensagemAtivaPf').css('display', 'none');
    });

    $('#divIconeInterrogaCriacaoLinkQRCodePf').on('mouseenter', function(){             
        $('#divAvisoCriacaoLinkQRCodePf').css('display', 'block');
    
    });
    
    $('#divIconeInterrogaCriacaoLinkQRCodePf').on('mouseleave', function(){
        $('#divAvisoCriacaoLinkQRCodePf').css('display', 'none');
    });

     $('#divIconeInterrogacaoDeeplink').on('mouseenter', function(){
        
        $('#divAvisoDeeplink').css('display', 'block');
        
    });
    
    $('#divIconeInterrogacaoDeeplink').on('mouseleave', function(){
        $('#divAvisoDeeplink').css('display', 'none');
        
    });


     $('#incluirNovaJornada').on('click', function(){
        $('.formNovaJornada').css('display', 'block');
        $('.divAvisosBotNovo').css('display', 'none');
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



    /*Alert na jornada informacional*/
    $('#divIconeInterrogacaoDeeplinkJornInfPf').on('mouseenter', function(){
        
        $('#divAvisoDeeplinkJornInfPf').css('display', 'block');
        
    });
    
    $('#divIconeInterrogacaoDeeplinkJornInfPf').on('mouseleave', function(){
        $('#divAvisoDeeplinkJornInfPf').css('display', 'none');
        
    });

    /**Alert na jornada de transação PF*/
    

    $('#divIconeInterrogacaoHDLTransPf').on('mouseenter', function(){
        
        $('#divAvisoHDLTransPf').css('display', 'block');
        
    });
    
    $('#divIconeInterrogacaoHDLTransPf').on('mouseleave', function(){
        $('#divAvisoHDLTransPf').css('display', 'none');
        
    });

    /*Alert na jornada de criação de link/Qrcode */
    $('#divIconeInterrogacaoDeeplinkCriaLinkPf').on('mouseenter', function(){
        
        $('#divAvisoDeeplinkCriaLinkPf').css('display', 'block');
        
    });
    
    $('#divIconeInterrogacaoDeeplinkCriaLinkPf').on('mouseleave', function(){
        $('#divAvisoDeeplinkCriaLinkPf').css('display', 'none');
        
    });


    /*Regras para as perguntas*/
    //Os selects são tratados de forma a parte na seção de 'Selects do formulário' do código


   /*Lida com a interação dos radio button*/
    $('input[type="radio"]').change(function () {
        //Mensagem Ativa Pf
        handleCRMGroup();
        handleFaleComGroup();
        handleRMEGroup();
        handleDirecionamentoAppGroup();
        handleDeeplinkGroup();
        handleOutrosDirecionamentosGroup() ;
        handleMidiaGroup();
        handleTransbordoGroup();
        handleBotWhatsAppPf();

        /*Radio buttons Jornada informacional Pf */
        handlePeriodoJornadaInfPf();
        handleDirecionaAppJornInfPf();
        handleDeeplinkGroupJornInfPf();
        handleOutrosDirecionamentosJornInfPf();
        handleTransbordoGroupJornInfPf();
        handleMidiaGroupJornInfPf();

        /*Radio buttons Transação Pf */
        handleRARegulatorioTransPf();
        handleLinkprototipoTransPf();
        handleTransbordoGroupTransPf();
        handleMidiaGroupTransPf();
        handleHDLTransPf();
        handlePlanoRequisitosTranPf();
        handleMassaTestesTransPf();
    
        /**Radio buttons Criação de Link/QR Code Pf */
        handleQtdeLinksCriaLinkPf();
        handlePeriodoCriaLinkPf();
        handleDirecionamentoAppGroupCriaLinkPf();
        handleDeeplinkGroupCriaLinkPf();
        handleOutrosDirecionamentosGroupCriaLinkPf();
        handleTransbordoGroupCriaLinkPf();
        handleMidiaGroupCriaLinkPf();
    });


    /*Criação de Link/ QR Code*/

    function handleQtdeLinksCriaLinkPf(){
        if($('#radioMaisdeUmLinkCriaLinkPf').is(':checked')){
            
            $('#divQtdeLinkPQrCodePf').css('display', 'block');

        } else if($('#radioSoUmLinkCriaLinkPf').is(':checked')){
            
            $('#divQtdeLinkPQrCodePf').css('display', 'none');
            $('#numQtdeLink').val('');
        }
    }


    function handlePeriodoCriaLinkPf(){
        if ($('#radioPeriodoSimCriaLinkPf').is(':checked')){

            $('#divDataInicioFimCriaLinkPf').css('display','flex');
            

        } else if  ($('#radioPeriodoNaoCriaLinkPf').not(':checked')){

            $('#divDataInicioFimCriaLinkPf').css('display','none');
            $('#dataInicioCriaLinkPf, #dataFimCriaLinkPf').val('');
            
        }
    }



    //Validação de data usada em uma das questões da jornada de  criação de link/Qr Code Pf
    function validaDataCriaLinkPf() {
        var dataInicio = $('#dataInicioCriaLinkPf').val();
        var dataFim = $('#dataFimCriaLinkPf').val();

        if (dataInicio && dataFim) {
            var inicio = new Date(dataInicio);
            var fim = new Date(dataFim);

            if (fim <= inicio) {
                bootbox.dialog({
                    backdrop: true,
                    onEscape: function() {},
                    closeButton: true,
                    size: "medium",
                    message: "<div>A data final deve ser maior que a data de início</div>",
                    buttons: {
                        confirm: {
                        label: "OK",
                        className: "btn-warning"
                        }
                    },
                });
                $('#dataInicioCriaLinkPf').val('');    
                $('#dataFimCriaLinkPf').val('');  
            }
              
        }
    }

    // Garante que o alert não se repita
    $('#dataInicioCriaLinkPf').off('change').on('change', validaDataCriaLinkPf);
    $('#dataFimCriaLinkPf').off('change').on('change', validaDataCriaLinkPf);
    /**=================================== */


    function handleDeeplinkGroupCriaLinkPf() {
            if ($('#radioCriaLinkPfTemDeeplinkNao').is(':checked')) {
                
                $('#divCriaLinkPfAlertDeeplink').css('display', 'inline-flex');
                $('#divCriaLinkPfTxtDeeplink').css('display', 'none');
                $('#msgeCriaLinkPfDeeplink').val('');

            } else if ($('#radioCriaLinkPfTemDeeplinkSim').is(':checked')) {
                
                $('#divCriaLinkPfAlertDeeplink').css('display', 'none');
                $('#divCriaLinkPfTxtDeeplink').css('display', 'block');
            }
        }

        // Função para lidar com direcionamento App
    function handleDirecionamentoAppGroupCriaLinkPf() {
        if ($('#radioCriaLinkDirecionamentoAppPfSim').is(':checked')) {

            $('#divCriaLinkPfTxtDirecionamentoAppCaminho').css('display', 'block');

        } else if ($('#radioCriaLinkDirecionamentoAppPfNao').is(':checked')) {
            $('#divCriaLinkPfTxtDirecionamentoAppCaminho').css('display', 'none');
            $('#caminhoAppCriaLinkPf').val('');
        }
    }

      function handleOutrosDirecionamentosGroupCriaLinkPf() {
        if ($('#radioCriaLinkOutrosDirecionamentosPfNao').is(':checked')) {

            $('#divCriaLinkPfTxtCaminhoOutrosDirecionamentos').css('display', 'none');
            $('#criaLinkPfTxtCaminhoOutrosDirecionamentos').val('');
            

        } else if ($('#radioCriaLinkOutrosDirecionamentosPfSim').is(':checked')) {

            $('#divCriaLinkPfTxtCaminhoOutrosDirecionamentos').css('display', 'block');
            
        }
    }



    function handleTransbordoGroupCriaLinkPf(){
        
        if($('#radioCriaLinkPfHatransbordoHumanoSim').is(':checked')){
            
            $('#divPerguntaCriaLinkPfTransbordoNegociaUAC').css('display','block');
            
            if($('#radioCriaLinkPfTransbordoNegociaUACNao').is(':checked')){

                $('#idAlertaNegociaTransbordoUACCriaLinkPf').css('display','inline-flex');
                $('#divPerguntaCriaLinkPfCategoriaFormaAtendimento').css('display','none');  
                $('#idCampoCategoriaFormaAtendimentoCriaLinkPf').val(''); 
                $('#divPerguntaCriaLinkPfNumSalaDebate').css('display','none');
                $('#numSalaDebateAtendimentoCriaLinkPf').val('');
                $('#divPerguntaCriaLinkPfDataHorarioSalaDebate').css('display','none');
                $('#diaHorarioAtendimentoCelulaCriaLinkPf').val('');
            

            }else if($('#radioCriaLinkPfTransbordoNegociaUACSim').is(':checked')){
                
                $('#idAlertaNegociaTransbordoUACCriaLinkPf').css('display','none');
                $('#divPerguntaCriaLinkPfCategoriaFormaAtendimento').css('display','block');
            }
        

        } else if ($('#radioCriaLinkPfHatransbordoHumanoNao').is(':checked')){
            
            $('#divPerguntaCriaLinkPfTransbordoNegociaUAC').css('display','none');
            $('#idAlertaNegociaTransbordoUACCriaLinkPf').css('display','none');
            $('#radioCriaLinkPfTransbordoNegociaUACNao').prop('checked', false);
            $('#radioCriaLinkPfTransbordoNegociaUACSim').prop('checked', false);
            $('#divPerguntaCriaLinkPfCategoriaFormaAtendimento').css('display','none'); 
            $('#idCampoCategoriaFormaAtendimentoCriaLinkPf').val('');   
            $('#divPerguntaCriaLinkPfNumSalaDebate').css('display','none');
            $('#numSalaDebateAtendimentoCriaLinkPf').val('');
            $('#divPerguntaCriaLinkPfDataHorarioSalaDebate').css('display','none');
            $('#diaHorarioAtendimentoCelulaCriaLinkPf').val('');
                        
        }
    }


     function handleMidiaGroupCriaLinkPf() {
        if ($('#radioHaMidiaCriaLinkPfSim').is(':checked')) {

            $('#diVNestUploadCriaLinkPf').css('display', 'block');
            
        } else if ($('#radioHaMidiaCriaLinkPfNao').is(':checked')) {
            $('#diVNestUploadCriaLinkPf').css('display', 'none');

        }
    }
    

/*Mensagem ativa Pf */
 

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


   




    //Funções controle de perguntas - Mensagem Ativa

    // Função para lidar com o grupo CRM e Martech
    function handleCRMGroup() {
        if ($('#radioDisparoCampanha').is(':checked') || $('#radioDisparoMotor').is(':checked') || $('#radioDisparoLegado').is(':checked')) {
            
            $('#numSalaCeluladispTemplate').val('');
            // $('#divNumSalaTemplatePf').fadeOut(500);
            // $('#divPerguntaAlinhamentoCRM').fadeIn(500);
            $('#divNumSalaTemplatePf').css('display','none');   
            $('#divPerguntaAlinhamentoCRM').css('display', 'block');

            //A pergunta sobre o atendimento humano está na sessão 5 e só aparece se o disparo for campanha, motor de interação, ou sistema legado
            $('#divPerguntaMsgeAtivaPfTransbordoHumano').css('display', 'block');

            if($('#radioDisparoLegado').is(':checked')){
                $('#divSistemaLegadoResponsavel').css('display','block'); 
                $('#numSalaCeluladispTemplate').val('');
            } else{
                $('#divSistemaLegadoResponsavel').css('display','none');  
                $('#sistemaLegadoResponsavel').val('');
            }

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
            $('#divPerguntaAlinhamentoCRM, #idDivAvisoCrm, #divPerguntaFormMartech, .avisoFormMartechMsgeAtivaPf, #divNumFormularioMartech, #divSistemaLegadoResponsavel').css('display', 'none');
            $('#radioAlinhaCRMNao, #radioAlinhaCRMSim, #radioRadioFormMartechSim, #radioRadioFormMartechNao').prop('checked', false);
            $('#numFormularioMartech').val('');
            $('#sistemaLegadoResponsavel').val('');
            // Se a opção selecionada for faleCom a pergunta sobre transbordo humano na sessão 5  não aparece
            $('#divPerguntaMsgeAtivaPfTransbordoHumano').css('display', 'none');
            $('#divNumSalaTemplatePf').css('display','flex');
            $('#sistemaLegadoResponsavel').val('');
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

                $('#idAlertaNegociaTransbordoUAC').css('display','inline-flex');
                $('#divPerguntaMsgeAtivaPfCategoriaFormaAtendimento').css('display','none');  
                $('#idCampoCategoriaFormaAtendimentoMsgeAtiva').val(''); 
                $('#divPerguntaMsgeAtivaPfNumSalaDebate').css('display','none');
                $('#numSalaDebateAtendimentoMsgeAtivaPf').val('');
                $('#divPerguntaMsgeAtivaPfDataHorarioSalaDebate').css('display','none');
                $('#diaHorarioAtendimentoCelulaMsgeAtivaPf').val('');
            

            }else if($('#radioTransbordoNegociaUACSim').is(':checked')){
                
                $('#idAlertaNegociaTransbordoUAC').css('display','none');
                $('#divPerguntaMsgeAtivaPfCategoriaFormaAtendimento').css('display','block');
            }
        

        } else if ($('#radioHaTransbordoHumanoNao').is(':checked')){
            
            $('#divPerguntaMsgeAtivaPfTransbordoNegociaUAC').css('display','none');
            $('#idAlertaNegociaTransbordoUAC').css('display','none');
            $('#radioTransbordoNegociaUACNao').prop('checked', false);
            $('#radioTransbordoNegociaUACSim').prop('checked', false);
            $('#divPerguntaMsgeAtivaPfCategoriaFormaAtendimento').css('display','none'); 
            $('#idCampoCategoriaFormaAtendimentoMsgeAtiva').val('');   
            $('#divPerguntaMsgeAtivaPfNumSalaDebate').css('display','none');
            $('#numSalaDebateAtendimentoMsgeAtivaPf').val('');
            $('#divPerguntaMsgeAtivaPfDataHorarioSalaDebate').css('display','none');
            $('#diaHorarioAtendimentoCelulaMsgeAtivaPf').val('');
                        
        }
    }
    
    //Funções controle de perguntas  - Jornada Informacional

    function handleBotWhatsAppPf(){
        if($('#radioBotWhatsappPfJorInf').is(':checked')){
            $('#divRadioAtendeRAJorInfPf').css('display', 'block');
            
            if($('#radioTransacaoRaRegSimJornInfPf').is(':checked')){
                $('#divRadioRADisponibilizaWhatsAppJorInfPf').css('display','block');

            } else if($('#radioTransacaoRaRegNaoJornInfPf').is(':checked')){

                $('#divRadioRADisponibilizaWhatsAppJorInfPf').css('display','none');
                $('#radioTransacaoRaRegDisponibilizaWhatsAppSimJornInfPf, #radioTransacaoRaRegDisponibilizaWhatsAppNaoJornInfPf').prop('checked', false);
            }
        }else if($('#radioBotWhatsappPfJorInf').not(':checked')){

            $('#divRadioAtendeRAJorInfPf').css('display', 'none');
            $('#radioTransacaoRaRegSimJornInfPf, #radioTransacaoRaRegNaoJornInfPf').prop('checked', false);
            $('#divRadioRADisponibilizaWhatsAppJorInfPf').css('display','none');
            $('#radioTransacaoRaRegDisponibilizaWhatsAppSimJornInfPf, #radioTransacaoRaRegDisponibilizaWhatsAppNaoJornInfPf').prop('checked', false);

        }
    }
    

    function handlePeriodoJornadaInfPf(){
        if ($('#radioPeriodoSimJornInfPf').is(':checked')){

            $('#divDataInicioFimJornadaInfPf').css('display','flex');
            

        } else if  ($('#radioPeriodoSimJornInfPf').not(':checked')){

            $('#divDataInicioFimJornadaInfPf').css('display','none');
            $('#dataInicioJornInfPf, #dataFimJornInfPf').val('');
            
        }
    }
    
    function handleDirecionaAppJornInfPf(){
        if($('#radioJornInfDirecionamentoAppPfSim').is(':checked')){

            $('#divJornInfPfTxtDirecionamentoAppCaminho').css('display', 'block');

        } else if($('#radioJornInfDirecionamentoAppPfNao').is(':checked')){
            
            $('#divJornInfPfTxtDirecionamentoAppCaminho').css('display', 'none');
            $('#caminhoAppJornInfPf').val('');
        }
    
    }

     function handleDeeplinkGroupJornInfPf() {
        if ($('#radioJornInfPfTemDeeplinkNao').is(':checked')) {

            $('#divJornInfPfAlertDeeplink').css('display', 'inline-flex');
            $('#divJornInfPfPfTxtDeeplink').css('display', 'none');
            $('#msgeJornInfPfDeeplink').val('');

        } else if ($('#radioJornInfPfTemDeeplinkSim').is(':checked')) {

            $('#divJornInfPfAlertDeeplink').css('display', 'none');
            $('#divJornInfPfPfTxtDeeplink').css('display', 'block');
        }
    }


    function handleOutrosDirecionamentosJornInfPf(){
        if($('#radioJornInfOutrosDirecionamentosPfSim').is(':checked')){

            $('#divJornInfPfTxtCaminhoOutrosDirecionamentos').css('display', 'block');

        } else if($('#radioJornInfOutrosDirecionamentosPfNao').is(':checked')){
            
            $('#divJornInfPfTxtCaminhoOutrosDirecionamentos').css('display', 'none');
            $('#jornInfPfTxtCaminhoOutrosDirecionamentos').val('');
        }
    
    }



    function handleTransbordoGroupJornInfPf(){
        
        if($('#radioHatransbordoHumanoJornInfPfSim').is(':checked')){
            
            $('#divPerguntaJornInfPfTransbordoNegociaUAC').css('display','block');
            
            if($('#radioTransbordoNegociaUACJornInfPfNao').is(':checked')){

                $('#idAlertaNegociaTransbordoUACJornInfPf').css('display','inline-flex');
                $('#divPerguntaJornInfPfCategoriaFormaAtendimento').css('display','none');  
                $('#idCampoCategoriaFormaAtendimentoJornInfPf').val(''); 
                $('#divPerguntaNumSalaDebateJornInfPf').css('display','none');
                $('#numSalaDebateAtendimentoJornInfPf').val('');
                $('#divPerguntaJornInfPfDataHorarioSalaDebate').css('display','none');
                $('#diaHorarioAtendimentoCelulaJornInfPf').val('');
            

            }else if($('#radioTransbordoNegociaUACJornInfPfSim').is(':checked')){
                
                $('#idAlertaNegociaTransbordoUACJornInfPf').css('display','none');
                $('#divPerguntaJornInfPfCategoriaFormaAtendimento').css('display','block');
            }
        

        } else if ($('#radioHatransbordoHumanoJornInfPfNao').is(':checked')){
            
            $('#divPerguntaJornInfPfTransbordoNegociaUAC').css('display','none');
            $('#idAlertaNegociaTransbordoUACJornInfPf').css('display','none');
            $('#radioTransbordoNegociaUACJornInfPfNao').prop('checked', false);
            $('#radioTransbordoNegociaUACJornInfPfSim').prop('checked', false);
            $('#divPerguntaJornInfPfCategoriaFormaAtendimento').css('display','none'); 
            $('#idCampoCategoriaFormaAtendimentoJornInfPf').val('');   
            $('#divPerguntaNumSalaDebateJornInfPf').css('display','none');
            $('#numSalaDebateAtendimentoJornInfPf').val('');
            $('#divPerguntaJornInfPfDataHorarioSalaDebate').css('display','none');
            $('#diaHorarioAtendimentoCelulaJornInfPf').val('');
                        
        }
    }

//Funções controle de perguntas - Transação Pf

    function handleRARegulatorioTransPf(){
        if($('#radioTransacaoRaRegSimTransPf').is(':checked')){

            $('#divRadioRADisponibilizaWhatsAppTransPf').css('display','block');
        
        } else if ($('#radioTransacaoRaRegNaoTransPf').is(':checked')){

            $('#divRadioRADisponibilizaWhatsAppTransPf').css('display','none');
            $('#radioTransacaoRaRegDisponibilizaWhatsAppSimTransPf, #radioTransacaoRaRegDisponibilizaWhatsAppNaoTransPf').prop('checked', false);

        }
    }

    function handleLinkprototipoTransPf(){
        if($('#radioExisteEmOutroCanalSimTransPf').is(':checked')){
            $('#divLinkPrototipoTransPf').css('display','block');

        } else if($('#radioExisteEmOutroCanalNaoTransPf').is(':checked')){
            $('#divLinkPrototipoTransPf').css('display','none');
            $('#idLinkPrototipoExistenteTransPf').val('');
        }
        
    }
     
    function handleTransbordoGroupTransPf(){
        
        if($('#radioHatransbordoHumanoSimTransPf').is(':checked')){
            
            $('#divPerguntaTransPfTransbordoNegociaUAC').css('display','block');
            
            if($('#radioTransbordoNegociaUACNaoTransPf').is(':checked')){

                $('#idAlertaNegociaTransbordoUACTransPf').css('display','inline-flex');
                $('#divPerguntaTransPfCategoriaFormaAtendimento').css('display','none');  
                $('#radioAtendimentoCelulaEspecificaTransPf, #radioAtendimentoGeralTransPf').prop('checked', false);
                $('#divPerguntaTransPfNumSalaDebate').css('display','none');
                $('#numSalaDebateAtendimentoTransPf').val('');
                $('#divPerguntaTransPfDataHorarioSalaDebate').css('display','none');
                $('#diaHorarioAtendimentoCelulaTransPf').val('');
            

            }else if($('#radioTransbordoNegociaUACSimTransPf').is(':checked')){
                
                $('#idAlertaNegociaTransbordoUACTransPf').css('display','none');
                $('#divPerguntaTransPfCategoriaFormaAtendimento').css('display','block');

                if($('#radioAtendimentoCelulaEspecificaTransPf').is(':checked')){
                    
                    $('#divPerguntaTransPfNumSalaDebate').css('display','block');
                    $('#divPerguntaTransPfDataHorarioSalaDebate').css('display','block');
                    
                } else if($('#radioAtendimentoGeralTransPf').is(':checked')){

                    $('#divPerguntaTransPfNumSalaDebate').css('display','none');
                    $('#numSalaDebateAtendimentoTransPf').val('');
                    $('#divPerguntaTransPfDataHorarioSalaDebate').css('display','none');
                    $('#diaHorarioAtendimentoCelulaTransPf').val('');
                    

                }
            }
        

        } else if ($('#radioHatransbordoHumanoNaoTransPf').is(':checked')){
            
            $('#divPerguntaTransPfTransbordoNegociaUAC').css('display','none');
            $('#idAlertaNegociaTransbordoUACTransPf').css('display','none');
            $('#radioTransbordoNegociaUACSimTransPf, #radioTransbordoNegociaUACNaoTransPf').prop('checked', false);
            $('#divPerguntaTransPfCategoriaFormaAtendimento').css('display','none'); 
            $('#radioAtendimentoCelulaEspecificaTransPf, #radioAtendimentoGeralTransPf').prop('checked', false);
            $('#divPerguntaTransPfNumSalaDebate').css('display','none');
            $('#numSalaDebateAtendimentoTransPf').val('');
            $('#divPerguntaTransPfDataHorarioSalaDebate').css('display','none');
            $('#diaHorarioAtendimentoCelulaTransPf').val('');
                        
        }
    }


    function handleMidiaGroupTransPf() {
        if ($('#radioHaMidiaSimTransPf').is(':checked')) {

            $('#divNestUploadTransPf').css('display', 'block');
            
        } else if ($('#radioHaMidiaNaoTransPf').is(':checked')) {
            $('#divNestUploadTransPf').css('display', 'none');

        }
    }
    
    function handleHDLTransPf(){
        if ($('#radioHLDSimTransPf').is(':checked')) {
                $('#divNestHDLUploadTransPf').css('display', 'block');
                $('#idDivAvisoHDFTransPf').css('display', 'none');
                
            } else if ($('#radioHLDNaoTransPf').is(':checked')) {
                $('#divNestHDLUploadTransPf').css('display', 'none');
                $('#idDivAvisoHDFTransPf').css('display', 'inline-flex');
                

            }    
    }

    function handlePlanoRequisitosTranPf(){
        if ($('#radioPlanoRequisitosSimTransPf').is(':checked')) {
                $('#divNestPlanoRequisitosUploadTransPf').css('display', 'block');
                $('#idDivAvisoBoasPraticasTransPf').css('display', 'none');
                
            } else if ($('#radioPlanoRequisitosNaoTransPf').is(':checked')) {
                $('#divNestPlanoRequisitosUploadTransPf').css('display', 'none');
                $('#idDivAvisoBoasPraticasTransPf').css('display', 'block');
                

            }    
        
    }

    function handleMassaTestesTransPf(){
        if ($('#radioMassaTestesSimTransPf').is(':checked')) {
            
                $('#divPerguntaDadosMassaTestes').css('display', 'block');
                $('#idDivAvisoMassaTestesTransPf').css('display', 'none');
                
            } else if ($('#radioMassaTestesNaoTransPf').is(':checked')) {
                
                $('#divPerguntaDadosMassaTestes').css('display', 'none');
                $('#idDivAvisoMassaTestesTransPf').css('display', 'block');
                

            }  
    }
   
    //Validação de data usada em uma das questões na jornada informacional
    function validaDataJornInfPf() {
        var dataInicio = $('#dataInicioJornInfPf').val();
        var dataFim = $('#dataFimJornInfPf').val();

        if (dataInicio && dataFim) {
            var inicio = new Date(dataInicio);
            var fim = new Date(dataFim);

            if (fim <= inicio) {
                bootbox.dialog({
                    backdrop: true,
                    onEscape: function() {},
                    closeButton: true,
                    size: "medium",
                    message: "<div>A data final deve ser maior que a data de início</div>",
                    buttons: {
                        confirm: {
                        label: "OK",
                        className: "btn-warning"
                        }
                    },
                });
                $('#dataInicioJornInfPf').val('');    
                $('#dataFimJornInfPf').val('');  
            }
              
        }
    }

    // Garante que o alert não se repita
    $('#dataInicioJornInfPf').off('change').on('change', validaDataJornInfPf);
    $('#dataFimJornInfPf').off('change').on('change', validaDataJornInfPf);

    /*Fim da validação de data*/


    function handleMidiaGroupJornInfPf() {
        if ($('#radioHaMidiaJornInfPfSim').is(':checked')) {

            $('#diVNestUploadJornInfPf').css('display', 'block');
            $('#divAlertaMidiaJornInfPf').css('display', 'none');

        } else if ($('#radioHaMidiaJornInfPfNao').is(':checked')) {
            
            $('#diVNestUploadJornInfPf').css('display', 'none');
            //$('#divAlertaMidiaJornInfPf').css('display', 'block');
            $('#fileInputMidiaMetaJornInfPf').val('');            
        }
    }


    // Selects do formulário

    $('#idCampoCategoriaMensagemAtiva').change(function(){
    var categoriaMensagemAtiva = $('#idCampoCategoriaMensagemAtiva').val();
    
    if (categoriaMensagemAtiva === "Mercadológica" || categoriaMensagemAtiva === "Relacional Negocial" ){
        
        $('#codProdutoJornadaMsgeAtivaPf').show();

    } else{
        
        $('#codProdutoJornadaMsgeAtivaPf').hide();
        $('#inputCodProduto').val('');

    }

    });

    $('#idCampoCategoriaFormaAtendimentoMsgeAtiva').change(function(){
        var categoriaFormaAtendimentoMensagemAtiva = $('#idCampoCategoriaFormaAtendimentoMsgeAtiva').val();
    
        if (categoriaFormaAtendimentoMensagemAtiva == "Célula específica") {
            
        $('#divPerguntaMsgeAtivaPfNumSalaDebate').css('display','block');
        $('#divPerguntaMsgeAtivaPfDataHorarioSalaDebate').css('display','block');

    } else {

        $('#divPerguntaMsgeAtivaPfNumSalaDebate').css('display','none');
        $('#numSalaDebateAtendimentoMsgeAtivaPf').val('');
        $('#divPerguntaMsgeAtivaPfDataHorarioSalaDebate').css('display','none');
        $('#diaHorarioAtendimentoCelulaMsgeAtivaPf').val('');


    }

    });
    

    /*select da jornada informacional Pf*/

    $('#idCampoCategoriaFormaAtendimentoJornInfPf').change(function(){
        var categoriaFormaAtendimentoJornInfPf = $('#idCampoCategoriaFormaAtendimentoJornInfPf').val();
    
        if (categoriaFormaAtendimentoJornInfPf == "Célula específica") {
            
            $('#divPerguntaNumSalaDebateJornInfPf').css('display','block');
            $('#divPerguntaJornInfPfDataHorarioSalaDebate').css('display','block');
        

        } else {

            $('#divPerguntaMsgeAtivaPfNumSalaDebate').css('display','none');
            $('#numSalaDebateAtendimentoMsgeAtivaPf').val('');
            $('#divPerguntaJornInfPfDataHorarioSalaDebate').css('display','none');
            $('#diaHorarioAtendimentoCelulaJornInfPf').val('');


        }

    });
    
    /* Select Transação Pf */
    $('#idCampoCanalTransacaoPf').change(function(){
        
        var canalAtendimentoTransPf = $('#idCampoCanalTransacaoPf').val();

        if (canalAtendimentoTransPf == "Bot no WhatsApp PF") {
            
            $('#divRadioAtendeRATransPf').css('display','block');
        

        } else {
            $('#divRadioAtendeRATransPf').css('display','none');
            $('#radioTransacaoRaRegSimTransPf, #radioTransacaoRaRegNaoTransPf').prop('checked', false);
            $('#divRadioRADisponibilizaWhatsAppTransPf').css('display','none');
            $('#radioTransacaoRaRegDisponibilizaWhatsAppSimTransPf, #radioTransacaoRaRegDisponibilizaWhatsAppNaoTransPf').prop('checked', false);

        }
        

    });
    
     $('#idCampoPublicoTransPf').change(function(){
        
        var publicoTransacaoPf = $('#idCampoPublicoTransPf').val();


        if (publicoTransacaoPf == "Clientes não correntistas" ||publicoTransacaoPf == "Não clientes BB" ) {
            
            $('#divFormaLoginTransPf').css('display','block');
        

        } else {
            $('#divFormaLoginTransPf').css('display','none');
            $('#idCampoformaLoginTransPf').val('');
             $('#divPontoFocalUsdTransPf').css('display','none');
            $('#pontoFocalUsdTransacaoPf').val('');
        }
        

    });

    $('#idCampoformaLoginTransPf').change(function(){
        
        var formaLoginTransPf = $('#idCampoformaLoginTransPf').val();


        if (formaLoginTransPf == "Identificação positiva já alinhada com a USD") {
            
            $('#divPontoFocalUsdTransPf').css('display','block');
        

        } else {
            $('#divPontoFocalUsdTransPf').css('display','none');
            $('#pontoFocalUsdTransacaoPf').val('');
        }
        

    });


    /*Cria link/QR Code */

     

    $('#idCampoCategoriaFormaAtendimentoCriaLinkPf').change(function(){
        
        var categoriaFormaAtendimentoCriaLinkPf = $('#idCampoCategoriaFormaAtendimentoCriaLinkPf').val();
    
        if (categoriaFormaAtendimentoCriaLinkPf == "Célula específica") {
            
            $('#divPerguntaCriaLinkPfNumSalaDebate').css('display','block');
            $('#divPerguntaCriaLinkPfDataHorarioSalaDebate').css('display','block');
        

        } else {

            $('#divPerguntaCriaLinkPfNumSalaDebate').css('display','none');
            $('#numSalaDebateAtendimentoCriaLinkPf').val('');
            $('#divPerguntaCriaLinkPfDataHorarioSalaDebate').css('display','none');
            $('#diaHorarioAtendimentoCelulaCriaLinkPf').val('');

        }

    });


/**Bootboxes  */


    $('.btnEspecificacoesMidiaMeta').on('click', function(){
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


    

    $('.btnAvisoHDL').on('click', function() {
        bootbox.dialog({
            backdrop: true,
            onEscape: function() {},
            closeButton: true,
            size: "large",
            className: 'bootboxHDLCustom',
            message: `
                <div>
                    <span class='txtBootboxExemploHDL'>
                        O HLD (High Level Design) é uma representação da arquitetura da jornada. Dá uma olhada neste exemplo:
                    </span>
                    <br><br>
                    <div class="divExplicacaoHDL" data-toggle="tooltip" data-placement="top" title="Clique para ver em tela cheia">
                        <a href= "https://cad.desenv.bb.com.br/lib/img/apps/solicitacoes/exemploHDL.png" target="_blank" style="text-decoration: none;">
                            <img src="https://cad.desenv.bb.com.br/lib/img/apps/solicitacoes/exemploHDL.png" style='width: 100%;'>
                        </a>    
                        <div class='divTxtExplicacaoHDL'>
                            <span class='explicacaoExemploHDL'>
                                <br>Esse exemplo foi feito no FigJam mas você pode fazê-lo no Word, Power Point ou até a mão.<br><br>
                                O importante é que ele contemple as regras negociais da sua jornada (precisa de login?, dispositivo precisa estar liberado?, a transação estará disponível para quais modalidades?, qual público alvo?).<br><br>
                                Ah, não precisa se preocupar com a fraseologia, o time do CAD que vai realizar a implementação da jornada também vai cuidar da UX para que ela fique adequada ao tom e voz do bot 😉
                            </span>
                        </div>
                    </div>
                </div>
            `,
        });
    });

    $('#btnBoasPraticasPlanoResquisitosTransPf').on('click', function(){
            bootbox.dialog({
                                backdrop: true,
                                onEscape: function() {},
                                closeButton: true,
                                size: "large",
                                className: 'bootboxBoasPraticasCustom',
                                message: `
                                        <div>
                                            <span class='txtTituloBootboxBoasPraticasPlanoResquisitos'> Boas práticas para a integração de transações nos fluxos conversacionais:</span>
                                        </div>
                                        <div class="divNestConteudoBootboxBoasPraticas">
                                            <span class="txtBootboxBoasPraticas">
                                                1. Caso a transação necessite de parâmetros do diálogo para sua execução,<br>
                                                os mesmos devem ser acessados via contexto <span class="txtDestaqueAzulBootbox">(responseNia.data.context);</span><br>
                                                <br>
                                                2. Os inputs de retorno para o NIA (pushNewFlow) para cenários de sucesso devem seguir o padrão <span class="txtDestaqueAzulBootbox">“{NOME_DA_TRANSACAO}_SUCESSO”;</span><br><br>

                                                3. Para os casos de sucesso que retorna contexto ao NIA, o objeto principal deve ser nomeado como response{NomeDaTransacao}.<br><br>
                                                <span class="txtDestaqueAzulBootbox">
                                                Ex: Nome TRN: DETALHAR_FUNDO<br>
                                                Contexto: responseDetalharFundo;</span><br><br>

                                                4. Em casos de transações de consulta que tragam uma lista de produtos/serviços para o cliente, caso não localize nenhum produto/serviço, o retorno para o NIA (pushNewFlow) deve ser <br><br>
                                                <span class="txtDestaqueAzulBootbox">
                                                “{NOME_DA_TRANSACAO}_EMPTY” <br>
                                                Ex.: Nome TRN: LISTAR_ACORDO_RAO <br>
                                                pushNewFlow: LISTAR_ACORDO_RAO_EMPTY</span> <br><br>

                                                5. Não deve ser enviada mensageria oriunda do Grafeno diretamente para o cliente. As informações podem ser passadas via contexto para que a mensagem adequada <br>
                                                seja encaminhada exclusivamente a partir do NIA (jornada conversacional NIA é quem conversa com o cliente/usuário final);<br><br>

                                                6. O input de retorno para o NIA (pushNewFlow) para cenário de erro deve ser <span class="txtDestaqueAzulBootbox">“CANCELAR_TRANSACAO_{NOME_DA_TRANSACAO}”</span> e as informações específicas do erro devem ser incluídas no contexto da conversa no objeto: <br><br>
                                                <span class="txtDestaqueAzulBootbox">
                                                "responseErrorGrafeno": {<br>
                                                "trn": "NOME_DA_TRANSACAO",<br>
                                                "error": "erro ocorrido",<br>
                                                "message": "Mensagem de erro"<br>
                                                }</span><br>
                                                Propriedades complementares também podem ser incluídas nesse objeto, caso seja adequado.<br><br>

                                                7. Prever a identificação do canal WhatsApp para levantamento das Métricas de sucesso e benefícios que as transações e soluções irão trazer para o canal e clientes
                                                que o utilizam: receitas geradas, valores financeiros negociados, investidos, contratados; incremento de satisfação; redução de custos com diminuição de acionamento
                                                de outros canais físicos ou remotos de atendimento humano, como ampliação do horário de atendimento, etc.
                                            </span>
                                        </div>`,
                                buttons: {
                                    confirm: {
                                        label: "Entendi",
                                        className: "btn-warning"
                                    }
                                },
                });
        });





    /**Fornulário PJ */    
    $('#divIconeInterrogaTransacaoPJ').on('mouseenter', function(){
        $('#divAvisoJornadaTransacaoPJ').css('display', 'block');
        
    });


    $('#divIconeInterrogaTransacaoPJ').on('mouseleave', function(){
        $('#divAvisoJornadaTransacaoPJ').css('display', 'none');

    });

    $('#divIconeInterrogaJornadaInformacionalPJ').on('mouseenter', function(){
        $('#divAvisoJornadaInformacionalPJ').css('display', 'block');
    });


    $('#divIconeInterrogaJornadaInformacionalPJ').on('mouseleave', function(){
        $('#divAvisoJornadaInformacionalPJ').css('display', 'none');
    });

    $('#divIconeInterrogaMensagemAtivaPJ').on('mouseenter', function(){
        $('#divAvisoJornadaMensagemAtivaPJ').css('display', 'block');
    });

   
    $('#divIconeInterrogaMensagemAtivaPJ').on('mouseleave', function(){
        $('#divAvisoJornadaMensagemAtivaPJ').css('display', 'none');
    });

    $('#divIconeInterrogaCriacaoLinkQRCodePJ').on('mouseenter', function(){    
        $('#divAvisoCriacaoLinkQRCodePJ').css('display', 'block');
        
        
    });
    
    $('#divIconeInterrogaCriacaoLinkQRCodePJ').on('mouseleave', function(){
        $('#divAvisoCriacaoLinkQRCodePJ').css('display', 'none');
    });    

    $('#divIconeInterrogaCampanhaMsgeAtivaPJ').on('mouseenter', function(){
        $('#divAvisoDisparoCampanhaMensagemAtivaPJ').css('display', 'block');
        
    });

    $('#divIconeInterrogaCampanhaMsgeAtivaPJ').on('mouseleave', function(){
        $('#divAvisoDisparoCampanhaMensagemAtivaPJ').css('display', 'none');
    });
    
    $('#divIconeInterrogaMotorMsgeAtivaPJ').on('mouseenter', function(){
        $('#divAvisoDisparoMotorMensagemAtivaPJ').css('display', 'block');
        
    });

    $('#divIconeInterrogaMotorMsgeAtivaPJ').on('mouseleave', function(){
        $('#divAvisoDisparoMotorMensagemAtivaPJ').css('display', 'none');
        
    });

     $('#divIconeInterrogaSistemaLegadoMsgeAtivaPJ').on('mouseenter', function(){
        $('#divAvisoDisparoSistemaLegadoMensagemAtivaPJ').css('display', 'block');
        
    });

    $('#divIconeInterrogaSistemaLegadoMsgeAtivaPJ').on('mouseleave', function(){
        $('#divAvisoDisparoSistemaLegadoMensagemAtivaPJ').css('display', 'none');
        
    });



    $('#divIconeInterrogaFaleComMsgeAtivaPJ').on('mouseenter', function(){
        $('#divAvisoDisparoFaleComMensagemAtivaPJ').css('display', 'block');
        
    });
    
    $('#divIconeInterrogaFaleComMsgeAtivaPJ').on('mouseleave', function(){
        $('#divAvisoDisparoFaleComMensagemAtivaPJ').css('display', 'none');
        
    });
    
    /**Paginação*/
    $('#btnProximo1NovaJornadaPJ').on('click', function(){
        alert("hello.");
    });







});


