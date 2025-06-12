$(document).ready(function(){
    /* APLICAÇÕES DO DATATABLE NAS TABELAS DE ACOMPANHAMENTO DA VISÃO CAD E GESTOR */
    // $("#tabelaDadosSolicitacoes").DataTable({
    //     dom: "Brtip",
    //     buttons: [ "excelHtml5" ],
    //     // order: [[0, "desc"]],
    //     language: {
    //         url:"https://cad.bb.com.br/lib/datatables/pt_br.json"
    //     },
    //     "initComplete": function(){ 
    //         $("#tabelaDadosSolicitacoes").show(); 
    //     }
    // });

    // $("#tabelaConsultaSolicitacao").DataTable({
    //     dom: "Brtip",
    //     buttons: [ "excelHtml5" ],
    //     // order: [[0, "desc"]],
    //     language: {
    //         url:"https://cad.bb.com.br/lib/datatables/pt_br.json"
    //     },
    //     "initComplete": function(){ 
    //         $("#tabelaConsultaSolicitacao").show(); 
    //     }
    // });


    $('#visaoSelect').on('change', function(){
        var visao = $(this).val();
        
        if(visao) {
            $("#paginaSolicitacoes").html('');
            $("#paginaSolicitacoes").load("https://cad.bb.com.br/lib/apps/solicitacoes/app/"+visao+".php");
        }
    });

    /* INTERAÇÃO DO BOTÃO DE LIMPAR FILTROS DA TABELA NA VISÃO CAD */
    $('.divBtnLimparFiltrosSolicitacoes').on('click', function(){
        limparCamposPesquisaSolicitacoes();
    });

    /* INTERAÇÃO DO BOTÃO DE LIMPAR FILTROS DA TABELA NA VISÃO GESTOR */
    $('.divBtnPesquisaVisaoGestor .limparFiltros').on('click', function(){
        limparCamposPesquisaVisaoGestor();
    });

    /* FUNÇÕES PARA EXIBIÇÃO DO TOOLTIP DO TIPO DE JORNADA */
    $('.divDireitaFormularioSolicitacaoSolicitacoes').on('mouseenter', '#divIconeInterrogaTransacao', function(){
        $('#divAvisoJornadaTransacaoPF').show("slide", { direction: "right" });
    });

    $('.divDireitaFormularioSolicitacaoSolicitacoes').on('mouseleave', '#divIconeInterrogaTransacao', function(){
        $('#divAvisoJornadaTransacaoPF').hide("slide", { direction: "left" });
    });

    $('.divDireitaFormularioSolicitacaoSolicitacoes').on('mouseenter', '#divIconeInterrogaJornadaInformacional', function(){
        $('#divAvisoJornadaInformacionalPF').show("slide", { direction: "right" });
    });

    $('.divDireitaFormularioSolicitacaoSolicitacoes').on('mouseleave', '#divIconeInterrogaJornadaInformacional', function(){
        $('#divAvisoJornadaInformacionalPF').hide("slide", { direction: "left" });
    });

    $('.divDireitaFormularioSolicitacaoSolicitacoes').on('mouseenter', '#divIconeInterrogaMensagemAtiva', function(){
        $('#divAvisoJornadaMensagemAtivaPF').show("slide", { direction: "right" });
    });

    $('.divDireitaFormularioSolicitacaoSolicitacoes').on('mouseleave', '#divIconeInterrogaMensagemAtiva', function(){
        $('#divAvisoJornadaMensagemAtivaPF').hide("slide", { direction: "left" });
    });

    /* OBJETO JS RESPONSÁVEL PELO FUNCIONAMENTO DOS FILTROS NA VISÃO CAD*/
    var camposSelecionados = {};
    
    /* INTERAÇÃO DO FILTRO DE NÚMERO DE ID DA TABELA NA VISÃO CAD */
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

    /* INTERAÇÃO DO FILTRO DE TEMA/PRODUTO DA TABELA NA VISÃO CAD */
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

    /* INTERAÇÃO DO FILTRO DE DEPENDÊNCIA DA TABELA NA VISÃO CAD */
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
    
    /* INTERAÇÃO DO FILTRO DE STATUS DA TABELA NA VISÃO CAD */
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

    /* OBJETO JS RESPONSÁVEL PELO FUNCIONAMENTO DOS FILTROS NA VISÃO GESTOR*/
    var camposSelecionadosVisaoGestor = {};

    /* INTERAÇÃO DO FILTRO DE NÚMERO DE ID DA TABELA NA VISÃO GESTOR */
    $('#campoID').on('change', function(){
        var conteudo;
        var conteudo = $(this).val();
        conteudo = conteudo.replace(/^0+/, '');
        var idElemento = $(this).attr('attr-nomeCampoBd');
        
        if(conteudo.length > 0){
            $(this).attr('attr-campoalterado', '1');
            camposSelecionadosVisaoGestor[idElemento] = conteudo;
        } else {
            $(this).attr('attr-campoalterado', '0');
            delete camposSelecionadosVisaoGestor[idElemento];
        }
        filtrarSolicitacoesVisaoGestor(camposSelecionadosVisaoGestor);
    });

    /* INTERAÇÃO DO FILTRO DE DATA DA TABELA NA VISÃO GESTOR */
    $('#dataAberturaSolicitacao').on('change', function(){
        var conteudo;
        var conteudo = $(this).val();
        var idElemento = $(this).attr('attr-nomeCampoBd');
        
        if(conteudo.length > 0){
            $(this).attr('attr-campoalterado', '1');
            camposSelecionadosVisaoGestor[idElemento] = conteudo;
        } else {
            $(this).attr('attr-campoalterado', '0');
            delete camposSelecionadosVisaoGestor[idElemento];
        }
        filtrarSolicitacoesVisaoGestor(camposSelecionadosVisaoGestor);
    });

    /* INTERAÇÃO DO FILTRO DE DEPENDÊNCIA DA TABELA NA VISÃO GESTOR */
    $('#pesquisaDependenciaSolicitacao').on('change', function(){
        var conteudo;
        var conteudo = $(this).val();
        var idElemento = $(this).attr('attr-nomeCampoBd');

        if(conteudo.length > 0){
            $(this).attr('attr-campoalterado', '1');
            camposSelecionadosVisaoGestor[idElemento] = conteudo;
        } else {
            $(this).attr('attr-campoalterado', '0');
            delete camposSelecionadosVisaoGestor[idElemento];
        }
        filtrarSolicitacoesVisaoGestor(camposSelecionadosVisaoGestor);
    });
    
    /* INTERAÇÃO DO FILTRO DE STATUS DA TABELA NA VISÃO GESTOR */
    $('#campoStatusSolicitacaoVisaoGestor').on('change', function(){
        var conteudo;
        var conteudo = $('select[name=campoStatusSolicitacaoVisaoGestor] option').filter(':selected').attr('value');
        var idElemento = $(this).attr('attr-nomeCampoBd');

        if(conteudo == 0){
            conteudo = '';
        }

        if(conteudo.length > 0){
            $(this).attr('attr-campoalterado', '1');
            camposSelecionadosVisaoGestor[idElemento] = conteudo;
        } else {
            $(this).attr('attr-campoalterado', '0');
            delete camposSelecionadosVisaoGestor[idElemento];
        }
        filtrarSolicitacoesVisaoGestor(camposSelecionadosVisaoGestor);
    });

    /* INTERAÇÃO DO FILTRO DA TABELA NA VISÃO CAD */
    /* VERIFICA QUE SE TODOS OS CAMPOS ESTÃO VAZIOS E, EM CASO POSITIVO, CHAMA UMA CONSULTA QUE TRARÁ TODAS SOLICITAÇÕES, SEM FILTRAR NENHUMA INFORMAÇÃO */
    $('.itemPesquisaSolicitacao').on('change', function(){
        var valorIdSolicitacao = $('#pesquisaNumeroSolicitacao').val();
        var valorProduto = $('#pesquisaProdutoSolicitacao').val();
        var valorDependnecia = $('#pesquisaDependenciaSolicitacao').val();
        var valorStatus = $('#campoStatusSolicitacao').val();

        if((valorIdSolicitacao == '') && (valorProduto == '') && (valorDependnecia == '') && (valorStatus == '0')){
            limparCamposPesquisaSolicitacoes();
        }
    });

    /* INTERAÇÕES DE TODOS RADIO BUTTON QUE DETERMINARÁ UMA MENSAGEM TERMINAL OU ABERTURA DO QUESTIONÁRIO */
    $(document).on('change', '.radio-container', function(event){
        event.stopPropagation();
        event.stopImmediatePropagation();

        var idElementoClicado = $(this).find('.radioSpan').attr('id');
        var proximaEtapa = $('#'+idElementoClicado).attr("attr-proximoFormulario");
        var ordemExibicao = $('#'+idElementoClicado).attr("attr-ordemExibicao");
        var totalElementos = $('.formFormularioSolicitacoes').length;
        var diferencaEntreElemento = totalElementos-ordemExibicao;
        var divNotificacoesEhExibida = $('.divInferiorSolicitacoes').css('display');
        
        target_offset = $("#"+idElementoClicado).offset();
        target_top = target_offset.top;
        
        if(ordemExibicao < totalElementos){
            if(divNotificacoesEhExibida == 'block'){
                $('.divInferiorSolicitacoes').hide('fast');
                $('.divInferiorSolicitacoes').html('');

                for(var i = (totalElementos-1); i > ordemExibicao; i--){
                    // $('.divDireitaFormularioSolicitacaoSolicitacoes').children().last().remove();
                    $('.divDireitaFormularioSolicitacaoSolicitacoes').children().last().hide('fast').promise().done(function(){
                        var idUltimoElemento = $('.divDireitaFormularioSolicitacaoSolicitacoes').children().last().attr('id');
                        $('#'+idUltimoElemento).remove();
                    });
                }
                setTimeout(function(){
                    montaFormulario(proximaEtapa);

                    $('html,body').animate({
                        scrollTop: target_top-50
                    }, 250);

                    return false;
                }, 300);
                return false;
            } else {
                for(var i = totalElementos; i > ordemExibicao; i--){
                    $('.divDireitaFormularioSolicitacaoSolicitacoes').children().last().hide('fast').promise().done(function(){
                        var idUltimoElemento = $('.divDireitaFormularioSolicitacaoSolicitacoes').children().last().attr('id');
                        $('#'+idUltimoElemento).remove();
                    });
                }
            }
            
            setTimeout(function(){
                montaFormulario(proximaEtapa);

                $('html,body').animate({
                    scrollTop: target_top-50
                }, 250);

                return false;
            }, 300);
        } else {
            montaFormulario(proximaEtapa);

            $('html,body').animate({
                scrollTop: target_top-50
            }, 250);
        }
    });
    /* FIM DAS INTERAÇÕES DE TODOS RADIO BUTTON QUE DETERMINARÁ UMA MENSAGEM TERMINAL OU ABERTURA DO QUESTIONÁRIO */

    /* INTERAÇÕES DAS ABAS "REGISTRAR" E "ACOMPANHAR" */
    $('.abaAdicionarSolicitacoes').on('click', function(){
        $('.abaAdicionarSolicitacoes').css('z-index', '2');
        $('.abaConsultarSolicitacoes').css('z-index', '1');
        $('#abaNovaSolicitacao').css('background-color','#2C3FBF');
        $('.conteudoSolicitacoes').css('background-color','#2C3FBF');
        $('#abaNovaSolicitacao').css('display', 'inline-flex');
        $('#abaAcompanharSolicitacao').css('display', 'none');
    });

    $('.abaConsultarSolicitacoes').on('click', function(){
        $('.abaAdicionarSolicitacoes').css('z-index', '1');
        $('.abaConsultarSolicitacoes').css('z-index', '2');
        // $('#abaAcompanharSolicitacao').css('background-color','#62BEE7');
        $('.conteudoSolicitacoes').css('background-color','#FFF ');
        $('#abaAcompanharSolicitacao').css('display', 'inline-flex');
        $('#abaNovaSolicitacao').css('display', 'none');
        montaTabelaAcompanhamentoVisaoGestor();
    });
    /* FIM DAS INTERAÇÕES DAS ABAS "REGISTRAR" E "ACOMPANHAR" */

    /* BLOCO DE INTERAÇÕES DO RADIO BUTTON DE RECOMENDAÇÃO DE AUDITORIA + SE A RECOMENDAÇÃO DE AUDITORIA ESPECIFICA ATENDIMENTO VIA WHATSAPP*/
    
    $('.divInferiorSolicitacoes').on('change', 'input[name="informacionalRaPJ"]', function(){
        if($('input[name="informacionalRaPJ"]:checked').attr('value') == 'sim'){
            $('#divJornadaInformacionalDisponivelWhatsPJ').show('fast');
        }

        if($('input[name="informacionalRaPJ"]:checked').attr('value') == 'nao'){
            $('#divJornadaInformacionalDisponivelWhatsPJ').hide('fast');
            $('input[name="informacionalDisponivelNoWhatsPJ"]').prop('checked', false);
        }
    });

    $('.divInferiorSolicitacoes').on('change', 'input[name="informacionalRaPF"]', function(){
        if($('input[name="informacionalRaPF"]:checked').attr('value') == 'sim'){
            $('#divJornadaInformacionalDisponivelWhatsPF').show('fast');
        }

        if($('input[name="informacionalRaPF"]:checked').attr('value') == 'nao'){
            $('#divJornadaInformacionalDisponivelWhatsPF').hide('fast');
            $('input[name="informacionalDisponivelNoWhatsPF"]').prop('checked', false);
        }
    });

    $('.divInferiorSolicitacoes').on('change', 'input[name="RARegulatorio"]', function(){
        if($('input[name="RARegulatorio"]:checked').attr('value') == 'sim'){
            $('#divJornadaTransacionalDisponivelWhatsPF').show('fast');
        }

        if($('input[name="RARegulatorio"]:checked').attr('value') == 'nao'){
            $('#divJornadaTransacionalDisponivelWhatsPF').hide('fast');
            $('input[name="disponivelNoWhats"]').prop('checked', false);
        }
    });

    $('.divInferiorSolicitacoes').on('change', 'input[name="RARegulatorio"]', function(){
        if($('input[name="RARegulatorio"]:checked').attr('value') == 'sim'){
            $('#divJornadaTransacionalDisponivelWhatsPJ').show('fast');
        }

        if($('input[name="RARegulatorio"]:checked').attr('value') == 'nao'){
            $('#divJornadaTransacionalDisponivelWhatsPJ').hide('fast');
            $('input[name="disponivelNoWhats"]').prop('checked', false);
        }
    });

    /* FIM DO BLOCO DE INTERAÇÕES DO RADIO BUTTON DE RECOMENDAÇÃO DE AUDITORIA */

    // Limpar todos os campos de questionário na visão gestor
    $('.divInferiorSolicitacoes').on('click', '.btnLimpar', function(){
        var idQuestionario = $(this).attr('id');
        montaFormulario(idQuestionario);
    });

    // Chamada para a edição de solicitações no status "nova" na visão gestor
    $(document).on('click', '#iconeEditar', function(e){
        e.stopPropagation();
        e.stopImmediatePropagation();
        var idSolicitacao = $(this).attr('attr-idSolicitacao');
        alert("Editar solicitação nº"+idSolicitacao);
    });

    // Chamada para a visualização de solicitações na visão gestor
    $(document).on('click', '#iconeNavega', function(e){
        e.stopPropagation();
        e.stopImmediatePropagation();
        
        var idSolicitacao = $(this).attr('attr-idSolicitacao');
        
        acessaDetalheSolicitacao(idSolicitacao);
    });

    /*Visão CAD*/

    $(document).on('click', '#iconeNavegaCAD', function(e){
        e.stopPropagation();
        e.stopImmediatePropagation();
        var idSolicitacao = $(this).attr('attr-idsolicitacao');
        acessaDetalheSolicitacaoVisaoCad(idSolicitacao);
        
    });


    $(document).on('click', '.btnVoltaParaTabelaSolicitacoesCad', function(e){
        $('.divConsultaDetalheSolicitacao').css('display', 'none');
        $('.divTabelaSolicitacoes').css('display', 'block');
        $('.divConsultaDetalheSolicitacao').remove();
    });

    $(document).on('click', '.divTituloSecaoComentariosDaSolicitacao', function(e){
       /*Acordeon */ 
       $(".divAreaComentariosVisaoCadSolicitacaoNova").slideToggle();
       if ($('.iconeSetaComentariosVisaoCadSolicitacaoNova').hasClass('fa-chevron-down')) {
            $('.iconeSetaComentariosVisaoCadSolicitacaoNova').removeClass('fa-chevron-down').addClass('fa-chevron-up');
        } else if ($('.iconeSetaComentariosVisaoCadSolicitacaoNova').hasClass('fa-chevron-up')) {
            $('.iconeSetaComentariosVisaoCadSolicitacaoNova').removeClass('fa-chevron-up').addClass('fa-chevron-down');
        }
       //.divAreaComentariosVisaoCad
    });


    $(document).on('click', '.divTituloSecaoDadosDaSolicitacao', function(e){
        /*Acordeon */ 
        $(".divDadosdaSolicitacao").slideToggle();
        if ($('.iconeSetaDadosSolicitacao').hasClass('fa-chevron-down')) {
            $('.iconeSetaDadosSolicitacao').removeClass('fa-chevron-down').addClass('fa-chevron-up');
        } else if ($('.iconeSetaDadosSolicitacao').hasClass('fa-chevron-up')) {
            $('.iconeSetaDadosSolicitacao').removeClass('fa-chevron-up').addClass('fa-chevron-down');
        }
        
     });

     $(document).on('click', '.divCabecalhoComentariosVisaoCadStatusAnalise', function(e){
        /*Acordeon */ 
        $(".divAreaComentariosVisaoCadSolicitacaoAnalise").slideToggle();
        //.divAreaComentariosVisaoCad
     });

    //
    /*##########*/

    //Voltar para a tabela de consulta das solicitações
    $(document).on('click', '.btnVoltaParaTabelaSolicitacoes', function(e){
        $('.divConsultaDetalheSolicitacao').css('display', 'none');
        $('.divInicialConsultaSolicitacoesGestor').css('display', 'block');
        $('.divConsultaDetalheSolicitacao').remove();
    });

    // Gravar comentário na solicitação - Visão CAD
    $(document).on('click', '.btnAdicionarComentarioVisaoCad', function(event){
        event.stopImmediatePropagation();

        var comentario = $('#novoComentarioVisaoCad').val();
        if(comentario.length) {
            var idsolicitacao = $(this).attr('attr-idsolicitacao');
            gravarComentario(idsolicitacao, comentario);
        } else {
            bootbox.dialog({
                backdrop: true,
                onEscape: function() {},
                // closeButton: true,
                size: "medium",
                title: "Atenção",
                message: "<div>Digite algo no campo de comentário.</div>",
                buttons: {
                    confirm: {
                        label: "Fechar",
                        className: "btn-warning",
                    }
                }
            });
            return false;
        }
        
    });


    //========= Contadores de caracteres ========

    
    $(document).on('input', '#novoComentarioVisaoCad', function(e){
        
        e.stopPropagation();
        e.stopImmediatePropagation();
        var length = $(this).val().length;
        var restante = 500 - length;
        $('#contador').text(restante + ' caracteres restantes');
        if (restante < 0) {
            $(this).val($(this).val().substring(0, maxLength));
            $('#contador').text('0 caracteres restantes');
        }
    
    });

    $(document).on('input', '#parecerFinalVisaoCad', function(e){
        
        e.stopPropagation();
        e.stopImmediatePropagation();
        var length = $(this).val().length;
        var restante = 500 - length;
        $('#contadorParecerFinal').text(restante + ' caracteres restantes');
        if (restante < 0) {
            $(this).val($(this).val().substring(0, maxLength));
            $('#contadorParecerFinal').text('0 caracteres restantes');
        }
    
    });

    $(document).on('change', '#selectStatusSolicitacao', function(){
        var statusSelecionado = $("#selectStatusSolicitacao").val();

        if(statusSelecionado == 3 || statusSelecionado == 4){
            // $('.divParecerFinalVisaoCad').css('display', 'block');
            $('.divParecerFinalVisaoCad').slideDown();
        } else {
            $('.divParecerFinalVisaoCad').slideUp();
        }
    });


    // $(document).on('input', '#estimuloConsumoJornadaTransacaoPF', function(e){
        
    //     e.stopPropagation();
    //     e.stopImmediatePropagation();
    //     var length = $(this).val().length;
    //     var restante = 500 - length;
    //     $('#contadorEstimuloConsumoTransPF').text(restante + ' caracteres restantes');
    //     if (restante < 0) {
    //         $(this).val($(this).val().substring(0, maxLength));
    //         $('#contadorEstimuloConsumoTransPF').text('0 caracteres restantes');
    //     }
    
    // });

    
    // Define o limite de caracteres
    var limiteCaracteres = 500;

    // Função para atualizar o contador de caracteres
    function atualizarContador(textarea) {
        var length = $(textarea).val().length;
        var restante = limiteCaracteres - length;
        $(textarea).next('.contador').text(restante + ' caracteres restantes');
        if (restante < 0) {
            $(textarea).val($(textarea).val().substring(0, limiteCaracteres));
            $(textarea).next('.contador').text('0 caracteres restantes');
        }
    }


// Jornadas Transacionais PF e PJ    
    // Aplica a função a todos os campos textarea do form em questão
    $('.txtAreaMedioTransacao').each(function() {
        $(this).after('<span class="contador">500 caracteres restantes</span>');
        atualizarContador(this);
    });

    // Evento de digitação para atualizar o contador e limitar os caracteres
    $(document).on('input', '.txtAreaMedioTransacao', function(e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        atualizarContador(this);
    });


 // Jornadas informacionais PF e PJ
    $('.txtAreaMedioInformacional').each(function() {
        $(this).after('<span class="contador">500 caracteres restantes</span>');
        atualizarContador(this);
    });


    $(document).on('input', '.txtAreaMedioInformacional', function(e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        atualizarContador(this);
    });


//==Funções de copiar textos dentro das divs==

//sugestão de descrição
    function copiarConteudoDescricao() {
        var $temp = $("<textarea>");
        $("body").append($temp);
        $temp.val($("#conteudosugestaoDescricaoIa").text()).select();
        document.execCommand("copy");
        $temp.remove();
        
        bootbox.dialog({
            backdrop: true,
            // onEscape: function() {},
            closeButton: true,
            size: "small",
            
            message: "<div> Descrição copiada</div>",
            buttons: {
                confirm: {
                    label: "OK",
                    className: "btn-success"
                }
            },
        });
        
        
    }

// Evento de clique para copiar o conteúdo da div

    $(document).on('click', '#btnCopiaConteudo', function(e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        copiarConteudoDescricao();
        
        
    });


//sugestão de critério de aceitação
    function copiarConteudoCriterioAceitacao() {
        var $temp = $("<textarea>");
        $("body").append($temp);
        $temp.val($("#conteudoSugestaoAceitacaoIA").text()).select();
        document.execCommand("copy");
        $temp.remove();
        bootbox.dialog({
            backdrop: true,
            // onEscape: function() {},
            closeButton: true,
            size: "small",
            
            message: "<div> Critério de aceitação copiado</div>",
            buttons: {
                confirm: {
                    label: "OK",
                    className: "btn-success"
                }
            },
        });
    }

    $(document).on('click', '#btnCopiaCriterioAceitacao', function(e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        copiarConteudoCriterioAceitacao();
        
        
    });

//sugestão de cenário de teste

   function copiarConteudoCenarioTeste() {
        var $temp = $("<textarea>");
        $("body").append($temp);
        $temp.val($("#conteudoSugestaoCenarioTesteIA").text()).select();
        document.execCommand("copy");
        $temp.remove();
        bootbox.dialog({
            backdrop: true,
            // onEscape: function() {},
            closeButton: true,
            size: "small",
            
            message: "<div> Cenário de teste copiado</div>",
            buttons: {
                confirm: {
                    label: "OK",
                    className: "btn-success"
                }
            },
        });
        
    }

    $(document).on('click', '#btnCopiarCenarioTeste', function(e) {
        e.stopPropagation();
        e.stopImmediatePropagation();
        copiarConteudoCenarioTeste();
        
        
    });



//*=======================================================================*


    // Chamada para fechar a div de sucesso na gravação
    $('#fechaDivAlerCadastroSucesso').on('click', function(){
        $('#alertaSucessoCadastroSolicitacao').css('display', 'none');
    });

    // Interação do botão de solicitação manual de análise pela IA
    // $(document).on('click', '.btnSolicitaNovaAnaliseIa', function(event){
    //     event.stopPropagation();
    //     event.stopImmediatePropagation();

    //     var idSolicitacao = $(this).attr('attr-idSolicitacao');
    //     bootbox.dialog({
    //         backdrop: true,
    //         onEscape: function() {},
    //         // closeButton: true,
    //         size: "large",
    //         title: "Atenção",
    //         message: "<div>Perguntas reenviadas para análise da IA.<br><br>Por gentileza, aguarde de 30 segundos a 1 minuto e retorne à esta tela para verificar a resposta.</div>",
    //         buttons: {
    //             confirm: {
    //                 label: "Fechar",
    //                 className: "btn-warning",
    //                 callback: function(){
    //                     enviaPerguntasIa(idSolicitacao);
    //                 }
    //             }
    //         }
    //     });
    //     return false;
    // });

    $(document).on('click', '.btnSolicitaNovaAnaliseIa', function(event){
        event.stopPropagation();
        event.stopImmediatePropagation();

        var idSolicitacao = $(this).attr('attr-idSolicitacao');
        enviaPerguntasIa(idSolicitacao);

        $('.areaResumoDemanda .itemFormulario').html('Aguarde a análise da IA. Pode levar até 1 minuto.');
        $(this).remove();
        $('.areaResumoDemanda').append('<img src="https://cad.bb.com.br/lib/apps/solicitacoes/img/aguarde.gif" style="width: 250; height: 250;">');

        function consultarFuncao() {
            return consultaAnaliseManualIa(idSolicitacao);
        }

        var contador = 0; // Inicializa o contador

        var intervalId = setInterval(function() {
            contador++; // Incrementa o contador
            if (contador >= 10) { // Verifica se o contador chegou a 10
                clearInterval(intervalId); // Para a consulta
                bootbox.dialog({
                    backdrop: true,
                    // onEscape: function() {},
                    closeButton: true,
                    size: "medium",
                    title: "Erro!",
                    message: "<div>A Inteligência Artificial não está respondendo no momento. Tente novamente mais tarde ou informe a equipe responsável informando o nº da solicitação: "+idSolicitacao+"</div>",
                    buttons: {
                        confirm: {
                            label: "OK",
                            className: "btn-warning",
                            callback: function(){
                                setTimeout(function(){
                                    $('.divConsultaDetalheSolicitacao').remove();
                                    acessaDetalheSolicitacaoVisaoCad(idSolicitacao);
                                }, 200);
                            }
                        }
                    },
                });
            } else {
                consultarFuncao().then(function(resultado) {
                    if (resultado == 1) {
                        
                        $('.divConsultaDetalheSolicitacao').remove();
                        clearInterval(intervalId); // Para a consulta quando o resultado for 1
                        limparCamposPesquisaSolicitacoes();
                        acessaDetalheSolicitacaoVisaoCad(idSolicitacao);
                    } else {
                        console.log("Função retornou 0, continuando a consulta...");
                        if (contador >= 10) { // Verifica se o contador chegou a 10
                            clearInterval(intervalId); // Para a consulta
                            bootbox.dialog({
                                backdrop: true,
                                // onEscape: function() {},
                                closeButton: true,
                                size: "medium",
                                title: "Erro!",
                                message: "<div>A Inteligência Artificial não está respondendo no momento. Erro: "+error.message+". Status: "+error.status+"</div>",
                                buttons: {
                                    confirm: {
                                        label: "OK",
                                        className: "btn-warning"
                                    }
                                },
                            });
                        }
                    }
                });
            } // executa a consulta se a IA respondeu no tempo estipulado abaixo
        }, 3000); // tempo de disparo de cada consulta em milissegundos

        return false;
    });


    //Interação do botão de alterar status
    $(document).on('click', '.btnAlteraStatusVisaoCad', function(event){
        event.stopPropagation();
        event.stopImmediatePropagation();

        var idSolicitacao = $(this).attr('attr-idSolicitacao');
        var novoStatus = $('select[id=selectStatusSolicitacao] option').filter(':selected').attr('value');
        if(novoStatus > 0){
            var textoParecerFinal = '';
            
            if(novoStatus == 2){
                alteraStatusSolicitacao(idSolicitacao, novoStatus);
            }
            
            if(novoStatus == 3 || novoStatus == 4){
                var textoParecerFinal = $('#parecerFinalVisaoCad').val();
                if(textoParecerFinal.length > 0){
                    alteraStatusSolicitacao(idSolicitacao, novoStatus, textoParecerFinal);
                } else {
                    bootbox.dialog({
                        backdrop: true,
                        onEscape: function() {},
                        // closeButton: true,
                        size: "medium",
                        title: "Atenção",
                        message: "<div>Para alterar o status para Aprovada ou Encerrada, é necessário preencher o parecer final</div>",
                        buttons: {
                            confirm: {
                                label: "Fechar",
                                className: "btn-warning",
                                callback: function(){
                                    setTimeout(function() {
                                        $('#parecerFinalVisaoCad').focus();
                                    }, 200);
                                }
                            }
                        }
                    });
                    return false;
                }
            }
        } else {
            bootbox.dialog({
                backdrop: true,
                onEscape: function() {},
                // closeButton: true,
                size: "medium",
                title: "Atenção",
                message: "<div>Selecione o novo status da solicitação.</div>",
                buttons: {
                    confirm: {
                        label: "Fechar",
                        className: "btn-warning"
                    }
                }
            });
            return false;
        }
    });

    // Gravação de solicitações
    $('.divInferiorSolicitacoes').on('click', '.btnCadastrar', function(){
        var tipoRespostas = $(this).attr('id');
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';
        
        if(tipoRespostas == 'cadastrarInformativaPf' || tipoRespostas == 'cadastrarInformativaPj'){
            if(tipoRespostas == 'cadastrarInformativaPf'){
                var tipoFormulario = 'PF';
                var tipoSolicitacao = "Jornada Informacional PF"
            } else {
                var tipoFormulario = 'PJ';
                var tipoSolicitacao = "Jornada Informacional PJ"
            }
            
            var canalTransacao = $('#canalJornadaInformacional'+tipoFormulario).find(":selected").val();
            var atendeRa = $('input[name="informacionalRa'+tipoFormulario+'"]:checked').val();
            var especificoWhatsapp = $('input[name="informacionalDisponivelNoWhats'+tipoFormulario+'"]:checked').val();
            var assuntoJornada = $('#assuntoJornadaInformacional'+tipoFormulario).val();
            var objetivoTransacao = $('#objetivoJornadaInformacional'+tipoFormulario).val();
            var metricaSucesso = $('#metricadeSucessoJornadaInformacional'+tipoFormulario).val();
            var resultadoProjetado = $('#resultadoProjetadoJornadaInformacional'+tipoFormulario).val();
            var acompanhamentoMetrica = $('#acompanhamentoMetricasJornadaInformacional'+tipoFormulario).val();
            var estimuloConsumoTransacao = $('#estimuloPublicoJornadaInformacional'+tipoFormulario).val();
            
            canalTransacao = canalTransacao.trim();
            // atendeRa = atendeRa.trim();
            // especificoWhatsapp = especificoWhatsapp.trim();
            assuntoJornada = assuntoJornada.trim();
            objetivoTransacao = objetivoTransacao.trim();
            metricaSucesso = metricaSucesso.trim();
            resultadoProjetado = resultadoProjetado.trim();
            acompanhamentoMetrica = acompanhamentoMetrica.trim();
            estimuloConsumoTransacao = estimuloConsumoTransacao.trim();
            
            var mensagemErro = "Atenção: <br><br>";
            var contaErros = 0;

            if(canalTransacao == 0){
                mensagemErro = mensagemErro+"-Informar o canal em que a jornada será incluída;<br>";
                contaErros = ++contaErros;
            }

            if(atendeRa == undefined){
                mensagemErro = mensagemErro+"-Informar se a transação visa atender Recomendação de Auditoria;<br>";
                contaErros = ++contaErros;
            }

            if(atendeRa == 'sim' && especificoWhatsapp == undefined){
                mensagemErro = mensagemErro+"-Informar se a Recomendação de Auditoria especifica que transação deve ser disponibilizada no WhatsApp;<br>";
                contaErros = ++contaErros;
            }

            if(assuntoJornada.length == 0){
                mensagemErro = mensagemErro+"-Informar o assunto principal da jornada;<br>";
                contaErros = ++contaErros;
            }

            if(objetivoTransacao.length == 0){
                mensagemErro = mensagemErro+"-Informar o objetivo da jornada;<br>";
                contaErros = ++contaErros;
            }

            if(metricaSucesso.length == 0){
                mensagemErro = mensagemErro+"-Informar a métrica de sucesso da jornada no canal;<br>";
                contaErros = ++contaErros;
            }

            if(resultadoProjetado.length == 0){
                mensagemErro = mensagemErro+"-Informar o resultado projetado da jornada;<br>";
                contaErros = ++contaErros;
            }

            if(acompanhamentoMetrica.length == 0){
                mensagemErro = mensagemErro+"-Informar como será o acompanhamento das métricas da jornada;<br>";
                contaErros = ++contaErros;
            }

            if(estimuloConsumoTransacao.length == 0){
                mensagemErro = mensagemErro+"-Informar qual será o estímulo para o público-alvo consumir a jornada;<br>";
                contaErros = ++contaErros;
            }

            mensagemErro = mensagemErro.substring(0, mensagemErro.length-5)+".";

            var formData = new FormData();
            
            if(contaErros > 0){
                var mensagemErroEditada = mensagemErro;
                
                bootbox.dialog({
                    backdrop: true,
                    onEscape: function() {},
                    // closeButton: true,
                    size: "medium",
                    title: "Atenção",
                    message: "<div>"+mensagemErroEditada+"</div>",
                    buttons: {
                        confirm: {
                            label: "Fechar",
                            className: "btn-warning",
                        }
                    }
                });
                return false;
            } else {
                formData.append("request","gravaJornadaInformacional");
                formData.append("canalTransacao", canalTransacao);
                formData.append("atendeRa", atendeRa);
                formData.append("especificoWhatsapp", especificoWhatsapp);
                formData.append("assuntoJornada", assuntoJornada.replace(/[\\']/g, '"'));
                formData.append("objetivoTransacao", objetivoTransacao.replace(/[\\']/g, '"'));
                formData.append("metricaSucesso", metricaSucesso.replace(/[\\']/g, '"'));
                formData.append("resultadoProjetado", resultadoProjetado.replace(/[\\']/g, '"'));
                formData.append("acompanhamentoMetrica", acompanhamentoMetrica.replace(/[\\']/g, '"'));
                formData.append("estimuloConsumoTransacao", estimuloConsumoTransacao.replace(/[\\']/g, '"'));
                formData.append("tipoSolicitacao", tipoSolicitacao);
                
                // for (var pair of formData.entries()) {
                //     console.log(pair[0]+ ', ' + pair[1]); 
                // }

                $.ajax({
                    url: caminhoController,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(retorno) {
                        bootbox.hideAll();
                        var retornoJson = JSON.parse(retorno);
                        if (retornoJson.status == 1) {
                            bootbox.dialog({
                                backdrop: true,
                                onEscape: function() {},
                                closeButton: true,
                                size: "medium",
                                title: "Sucesso!",
                                message: "<div>"+retornoJson.mensagem+"</div>",
                                buttons: {
                                    confirm: {
                                        label: "Fechar",
                                        className: "btn-success",
                                    }
                                },
                            });
                            $('#radio1').prop('checked', false);
                            $('#radio2').prop('checked', false);
                            $('.divDadosSolicitante').hide('fast');
                            $('.divInferiorSolicitacoes').hide('fast');
                            $('.divInferiorSolicitacoes').html('');
                            $('.divDireitaFormularioSolicitacaoSolicitacoes').hide('fast');
                            $('.divDireitaFormularioSolicitacaoSolicitacoes').html('');
                            $('.abaConsultarSolicitacoes').click();
                            $('#alertaSucessoCadastroSolicitacao').css('display', 'block');
                            $('html, body').animate({
                                scrollTop: $('#abaAcompanharSolicitacao').offset().top-200
                            }, 'smooth');
                            $('.divConsultaDetalheSolicitacao').remove();
                            montaTabelaAcompanhamentoVisaoGestor();
                            enviaPerguntasIa(retornoJson.solicitacaoIncluida);
                        } else {
                            // Se não conseguir pesquisar, exibe a mensagem de erro
                            bootbox.hideAll();
                            bootbox.dialog({
                                backdrop: true,
                                onEscape: function() {},
                                closeButton: true,
                                size: "medium",
                                title: "Erro!",
                                message: "<div>"+retornoJson.mensagem+"</div>",
                                buttons: {
                                    confirm: {
                                        label: "Fechar",
                                        className: "btn-danger",
                                    }
                                }
                            });
                        }
                    },
                    error: function (retorno) {
                        bootbox.dialog({
                            backdrop: true,
                            onEscape: function() {},
                            closeButton: true,
                            size: "medium",
                            title: "Erro!",
                            message: "<div><p>"+retorno.mensagem+"<br><br> Erro: L580 - solicitacoes.js</p></div>",
                            buttons: {
                                confirm: {
                                    label: "Fechar",
                                    className: "btn-danger",
                                }
                            }
                        });
                    }
                });
            }
        }
        
        if(tipoRespostas == 'cadastrarTransacaoPf' || tipoRespostas == 'cadastrarTransacaoPj'){
            if(tipoRespostas == 'cadastrarTransacaoPf'){
                var tipoFormulario = 'PF';
                var tipoSolicitacao = "Jornada Transacional PF"
            } else {
                var tipoFormulario = 'PJ';
                var tipoSolicitacao = "Jornada Transacional PJ"
            }

            var temaProduto = $('#temaProdutoTransacao'+tipoFormulario).val();
            var assuntoTransacao = $('#assuntoTransacao'+tipoFormulario).val();
            var objetivoTransacao = $('#objetivoTransacao'+tipoFormulario).val();
            var canaisExistentes = $('#canaisJaExistentes').val();
            var publicoAlvo = $('#publicoJornadaTransacao'+tipoFormulario).val();
            var metricaSucesso = $('#metricaSucessoJornadaTransacao'+tipoFormulario).val();
            var acompanhamentoMetrica = $('#acompanhamentoMetricaSucessoJornadaTransacao'+tipoFormulario).val();
            var resultadoProjetado = $('#resultadoProjetadoJornadaTransacao'+tipoFormulario).val();
            var estimuloConsumoTransacao = $('#estimuloConsumoJornadaTransacao'+tipoFormulario).val();
            var raOuRegulatorio = $('input[name="RARegulatorio"]:checked').val();
            var especificoWhatsapp = $('input[name="disponivelNoWhats"]:checked').val();
            var canalTransacao = $('#canalTransacao'+tipoFormulario).find(":selected").val();
            
            temaProduto = temaProduto.trim();
            assuntoTransacao = assuntoTransacao.trim();
            objetivoTransacao = objetivoTransacao.trim();
            canaisExistentes = canaisExistentes.trim();
            publicoAlvo = publicoAlvo.trim();
            metricaSucesso = metricaSucesso.trim();
            acompanhamentoMetrica = acompanhamentoMetrica.trim();
            resultadoProjetado = resultadoProjetado.trim();
            estimuloConsumoTransacao = estimuloConsumoTransacao.trim();
            // raOuRegulatorio = raOuRegulatorio.trim();
            // especificoWhatsapp = especificoWhatsapp.trim();
            // canalTransacao = canalTransacao.trim();
            
            var mensagemErro = "Atenção: <br><br>";
            var contaErros = 0;

            if(temaProduto == 0){
                mensagemErro = mensagemErro+"-Informar o tema/produto;<br>";
                contaErros = ++contaErros;
            }
            
            if(canalTransacao == 0){
                mensagemErro = mensagemErro+"-Informar o canal em que a jornada será incluída;<br>";
                contaErros = ++contaErros;
            }
            
            if(raOuRegulatorio == undefined){
                mensagemErro = mensagemErro+"-Informar se a transação visa atender Recomendação de Auditoria;<br>";
                contaErros = ++contaErros;
            }
            
            if(raOuRegulatorio == 'sim' && especificoWhatsapp == undefined){
                mensagemErro = mensagemErro+"-Informar se a Recomendação de Auditoria especifica que transação deve ser disponibilizada no WhatsApp;<br>";
                contaErros = ++contaErros;
            }
            
            if(assuntoTransacao.length == 0){
                mensagemErro = mensagemErro+"-Informar o assunto principal da jornada;<br>";
                contaErros = ++contaErros;
            }
            
            if(objetivoTransacao.length == 0){
                mensagemErro = mensagemErro+"-Informar o objetivo da jornada;<br>";
                contaErros = ++contaErros;
            }
            
            if(canaisExistentes == 0){
                mensagemErro = mensagemErro+"-Informar em quais canais a transação já existe;<br>";
                contaErros = ++contaErros;
            }
            
            if(publicoAlvo == 0){
                mensagemErro = mensagemErro+"-Informar o público da jornada;<br>";
                contaErros = ++contaErros;
            }
            
            if(metricaSucesso.length == 0){
                mensagemErro = mensagemErro+"-Informar a métrica de sucesso da jornada no canal;<br>";
                contaErros = ++contaErros;
            }
            
            if(resultadoProjetado.length == 0){
                mensagemErro = mensagemErro+"-Informar o resultado projetado da jornada;<br>";
                contaErros = ++contaErros;
            }
            
            if(acompanhamentoMetrica.length == 0){
                mensagemErro = mensagemErro+"-Informar como será o acompanhamento das métricas da jornada;<br>";
                contaErros = ++contaErros;
            }
            
            if(estimuloConsumoTransacao.length == 0){
                mensagemErro = mensagemErro+"-Informar qual será o estímulo para o público-alvo consumir a jornada;<br>";
                contaErros = ++contaErros;
            }

            mensagemErro = mensagemErro.substring(0, mensagemErro.length-5)+".";

            var formData = new FormData();
            
            if(contaErros > 0){
                var mensagemErroEditada = mensagemErro;
                bootbox.dialog({
                    backdrop: true,
                    onEscape: function() {},
                    // closeButton: true,
                    size: "medium",
                    title: "Atenção",
                    message: "<div>"+mensagemErroEditada+"</div>",
                    buttons: {
                        confirm: {
                            label: "Fechar",
                            className: "btn-warning",
                        }
                    }
                });
                return false;
            } else {
                formData.append("request","gravaJornadaTranascional");
                formData.append("temaProduto", temaProduto.replace(/[\\']/g, '"'));
                formData.append("assuntoTransacao", assuntoTransacao.replace(/[\\']/g, '"'));
                formData.append("objetivoTransacao", objetivoTransacao.replace(/[\\']/g, '"'));
                formData.append("canaisExistentes", canaisExistentes.replace(/[\\']/g, '"'));
                formData.append("publicoAlvo", publicoAlvo.replace(/[\\']/g, '"'));
                formData.append("metricaSucesso", metricaSucesso.replace(/[\\']/g, '"'));
                formData.append("acompanhamentoMetrica", acompanhamentoMetrica.replace(/[\\']/g, '"'));
                formData.append("resultadoProjetado", resultadoProjetado.replace(/[\\']/g, '"'));
                formData.append("estimuloConsumoTransacao", estimuloConsumoTransacao.replace(/[\\']/g, '"'));
                formData.append("raOuRegulatorio", raOuRegulatorio);
                formData.append("especificoWhatsapp", especificoWhatsapp);
                formData.append("canalTransacao", canalTransacao);
                formData.append("tipoSolicitacao", tipoSolicitacao);
                

                // for (var pair of formData.entries()) {
                //     console.log(pair[0]+ ', ' + pair[1]); 
                // }

                $.ajax({
                    url: caminhoController,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(retorno) {
                        bootbox.hideAll();
                        var retornoJson = JSON.parse(retorno);
                        if (retornoJson.status == 1) {
                            bootbox.dialog({
                                backdrop: true,
                                onEscape: function() {},
                                closeButton: true,
                                size: "medium",
                                title: "Sucesso!",
                                message: "<div>"+retornoJson.mensagem+"</div>",
                                buttons: {
                                    confirm: {
                                        label: "Fechar",
                                        className: "btn-success",
                                    }
                                },
                            });
                            
                            $('#radio1').prop('checked', false);
                            $('#radio2').prop('checked', false);
                            $('.divDadosSolicitante').hide('fast');
                            $('.divInferiorSolicitacoes').hide('fast');
                            $('.divInferiorSolicitacoes').html('');
                            $('.divDireitaFormularioSolicitacaoSolicitacoes').hide('fast');
                            $('.divDireitaFormularioSolicitacaoSolicitacoes').html('');
                            $('.abaConsultarSolicitacoes').click();
                            $('#alertaSucessoCadastroSolicitacao').css('display', 'block');
                            $('html, body').animate({
                                scrollTop: $('#abaAcompanharSolicitacao').offset().top-200
                            }, 'smooth');
                            enviaPerguntasIa(retornoJson.solicitacaoIncluida);
                        } else {
                            // Se não conseguir pesquisar, exibe a mensagem de erro
                            bootbox.hideAll();
                            bootbox.dialog({
                                backdrop: true,
                                onEscape: function() {},
                                closeButton: true,
                                size: "medium",
                                title: "Erro!",
                                message: "<div>"+retornoJson.mensagem+"</div>",
                                buttons: {
                                    confirm: {
                                        label: "Fechar",
                                        className: "btn-danger",
                                    }
                                }
                            });
                        }
                    },
                    error: function (retorno) {
                        bootbox.dialog({
                            backdrop: true,
                            onEscape: function() {},
                            closeButton: true,
                            size: "medium",
                            title: "Erro!",
                            message: "<div><p>"+retorno.mensagem+"<br><br> Erro: L580 - solicitacoes.js</p></div>",
                            buttons: {
                                confirm: {
                                    label: "Fechar",
                                    className: "btn-danger",
                                }
                            }
                        });
                    }
                });
            }
        }
    });

    // Gravação da edição de solicitação enquanto o status é "nova"
    $(document).on('click', '.confirmarEdicaoGestor', function(e){
        e.stopPropagation();
        e.stopImmediatePropagation();
        
        var idSolicitacao = $(this).attr('attr-idSolicitacao');
        var tipoJornada = $(this).attr('attr-tipoJornada');
        var canalTransacao = $('.editarCanalTransacao').val();
        // var atendeRa = $('.editarAtendeRa').val();
        // var especificoWhatsapp = $('.editarEspecificoWhatsapp').val();
        var atendeRa = $('input.editarAtendeRa:checked').val(); 
        var especificoWhatsapp = $('input.editarEspecificoWhatsapp:checked').val(); 

        var assuntoJornada = $('.editarAssuntoJornada').val();
        var objetivoJornada = $('.editarObjetivoJornada').val();
        var metricaSucesso = $('.editarMetricaSucesso').val();
        var resultadoProjetado = $('.editarResultadoProjetado').val();
        var acompanhamentoMetrica = $('.editarAcompanhamentoMetrica').val();
        var estimuloConsumoTransacao = $('.editarEstimuloConsumoTransacao').val();
        var publicoAlvo = $('.editarPublicoAlvo').val();
        var canaisTransacoesExiste = $('.editarCanaisTransacoesExiste').val();

        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';
        
        var formDataEditar = new FormData();

        formDataEditar.append("request","editaRespostasVisaoGestor");
        formDataEditar.append("idSolicitacao", idSolicitacao);
        formDataEditar.append("canalTransacao", canalTransacao.replace(/[\\']/g, '"'));
        formDataEditar.append("atendeRa", atendeRa);
        formDataEditar.append("especificoWhatsapp", especificoWhatsapp);
        formDataEditar.append("assuntoJornada", assuntoJornada.replace(/[\\']/g, '"'));
        formDataEditar.append("objetivoJornada", objetivoJornada.replace(/[\\']/g, '"'));
        formDataEditar.append("metricaSucesso", metricaSucesso.replace(/[\\']/g, '"'));
        formDataEditar.append("resultadoProjetado", resultadoProjetado.replace(/[\\']/g, '"'));
        formDataEditar.append("acompanhamentoMetrica", acompanhamentoMetrica.replace(/[\\']/g, '"'));
        formDataEditar.append("estimuloConsumoTransacao", estimuloConsumoTransacao.replace(/[\\']/g, '"'));
        if(tipoJornada == "Jornada Transacional PF" || tipoJornada == "Jornada Transacional PJ"){
            formDataEditar.append("publicoAlvo", publicoAlvo.replace(/[\\']/g, '"'));
            formDataEditar.append("canaisTransacoesExiste", canaisTransacoesExiste.replace(/[\\']/g, '"'));
        }
        formDataEditar.append("tipoJornada", tipoJornada);

        $.ajax({
            url: caminhoController,
            type: "POST",
            data: formDataEditar,
            contentType: false,
            processData: false,
            success: function(retorno) {
                bootbox.hideAll();
                var retornoJson = JSON.parse(retorno);
                if (retornoJson.status == 1) {
                    formDataEditar = new FormData();
                    bootbox.dialog({
                        backdrop: true,
                        onEscape: function() {},
                        closeButton: true,
                        size: "medium",
                        title: "Sucesso!",
                        message: "<div>"+retornoJson.mensagem+"</div>",
                        buttons: {
                            confirm: {
                                label: "Fechar",
                                className: "btn-success",
                            }
                        },
                    });
                    enviaPerguntasIa(idSolicitacao);
                    $('.divConsultaDetalheSolicitacao').remove();
                    acessaDetalheSolicitacao(idSolicitacao);
                } else if (retornoJson.status == 2) {
                    formDataEditar = new FormData();
                    bootbox.dialog({
                        backdrop: true,
                        onEscape: function() {},
                        closeButton: true,
                        size: "medium",
                        title: "Atenção!",
                        message: "<div>"+retornoJson.mensagem+"</div>",
                        buttons: {
                            confirm: {
                                label: "Fechar",
                                className: "btn-warning",
                                callback: function(){
                                    $('.divConsultaDetalheSolicitacao').remove();
                                    acessaDetalheSolicitacao(idSolicitacao);
                                    limparCamposPesquisaVisaoGestor();
                                }
                            }
                        },
                    });
                } else {
                    // Se não conseguir pesquisar, exibe a mensagem de erro
                    formDataEditar = new FormData();
                    bootbox.hideAll();
                    bootbox.dialog({
                        backdrop: true,
                        onEscape: function() {},
                        closeButton: true,
                        size: "medium",
                        title: "Erro!",
                        message: "<div>"+retornoJson.mensagem+"</div>",
                        buttons: {
                            confirm: {
                                label: "Fechar",
                                className: "btn-danger",
                            }
                        }
                    });
                }
            },
            error: function (retorno) {
                bootbox.dialog({
                    backdrop: true,
                    onEscape: function() {},
                    closeButton: true,
                    size: "medium",
                    title: "Erro!",
                    message: "<div><p>"+retorno.mensagem+"<br><br> Erro: L580 - solicitacoes.js</p></div>",
                    buttons: {
                        confirm: {
                            label: "Fechar",
                            className: "btn-danger",
                        }
                    }
                });
            }
        });
    });

    /* FUNÇÃO PARA LIMPEZA DOS CAMPOS DOS FILTROS NA VISÃO CAD */
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

    function contaNovasSolicitacoes(){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'contaNovasSolicitacoes' 
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if(retorno.status == 1){
                    if(retorno.mensagem > 0){
                        $('.totalSolicitacoesStatusNovaVisaoCad').html('');
                        $('.totalSolicitacoesStatusNovaVisaoCad').html(retorno.mensagem);
                    } else if(retorno.mensagem == 0){
                        $('.notificacoesInteracoesSolicitacoes').html('');
                    }
                } if(retorno.status == 0){
                    $('.totalSolicitacoesStatusNovaVisaoCad').html('');
                    $('.totalSolicitacoesStatusNovaVisaoCad').html('<div class="notificacoesInteracoesSolicitacoesErro" style="flex-direction: column; justify-content: flex-start; align-items: flex-start; display: inline-flex"><div style="width: 36px; height: 36px; background: #FBD40B; border-radius: 999px; flex-direction: column; justify-content: center; align-items: center; display: flex"><div style="text-align: center; color: #111214; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 700; line-height: 18px; word-wrap: break-word">?</div><span class="tooltipErroConsultaNovasSolicitacoes">'+retorno.mensagem+'</span></div></div>');
                }
            }
        });
    }
    

    /* FUNÇÃO PARA LIMPEZA DOS CAMPOS DOS FILTROS NA VISÃO GESTOR */
    function limparCamposPesquisaVisaoGestor(){
        camposSelecionadosVisaoGestor = {};

        $("#campoID").val('');
        $("#campoID").attr('attr-campoalterado', '0');
        
        $("#dataAberturaSolicitacao").val('');
        $("#dataAberturaSolicitacao").attr('attr-campoalterado', '0');
        
        // $("#pesquisaDependenciaSolicitacao").val('');
        // $("#pesquisaDependenciaSolicitacao").attr('attr-campoalterado', '0');

        $("#campoStatusSolicitacaoVisaoGestor option[value=0]").prop('selected', 'selected');
        $("#campoStatusSolicitacaoVisaoGestor").attr('attr-campoalterado', '0');
        
        montaTabelaAcompanhamentoVisaoGestor();
        contaNovasSolicitacoes();
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
                    // $('.bodyTabelaSolicitacoes').html('');
                    // $('.bodyTabelaSolicitacoes').html(retorno.mensagem);

                    $('.divTabelaDadosSolicitacoes').html('');
                    $('.divTabelaDadosSolicitacoes').html(retorno.mensagem);
                    $('.divTabelaDadosSolicitacoes').append('<img src="https://cad.bb.com.br/lib/apps/solicitacoes/img/iconeRobo.png" onload="datatableVisaoGestor();" style="display:none;" />');
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

    function montaTabelaAcompanhamentoVisaoGestor(){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';

        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'montaTabelaAcompanhamentoVisaoGestor'
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1){                 
                    // $('.bodyTabelaSolicitacoesVisaoGestor').html('');
                    // $('.bodyTabelaSolicitacoesVisaoGestor').html(retorno.mensagem);

                    $('.areaTabelaConsultaSolicitacoes').html('');
                    $('.areaTabelaConsultaSolicitacoes').html(retorno.mensagem);
                    $('.areaTabelaConsultaSolicitacoes').append('<img src="https://cad.bb.com.br/lib/apps/solicitacoes/img/iconeRobo.png" onload="datatableVisaoGestor();" style="display:none;" />');

                    // $("#tabelaConsultaSolicitacao").DataTable();
                }
                else{
                    alert("Não foi possível consultar a lista de solicitações. L1335 - solicitacoes.js");
                }
            },
            error: function(erro) {
                alert("Não foi possível consultar a lista de solicitações. L856 - solicitacoes.js");
            }
        });
    }

    function filtrarSolicitacoes(camposSelecionados){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';
        
        if(camposSelecionados == null){
            consultaSolicitacoes();
            return false;
        } else {
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
                        $('.divTabelaDadosSolicitacoes').append('<img src="https://cad.bb.com.br/lib/apps/solicitacoes/img/iconeRobo.png" onload="datatableVisaoGestor();" style="display:none;" />');
                        // alert(retorno.mensagem);
                    } else {
                        bootbox.dialog({
                            backdrop: true,
                            // onEscape: function() {},
                            closeButton: true,
                            size: "large",
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
                    alert("Não foi possível consultar a lista de solicitações. L973 - solicitacoes.js");
                }
            });
        }
        
    }
    
    function filtrarSolicitacoesVisaoGestor(camposSelecionados){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';

        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'filtrarSolicitacoesVisaoGestor' ,
                camposSelecionados: camposSelecionados
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1){                 
                    // $('.bodyTabelaSolicitacoesVisaoGestor').html('');
                    // $('.bodyTabelaSolicitacoesVisaoGestor').html(retorno.mensagem);
                    // alert(retorno.mensagem);
                    $('.areaTabelaConsultaSolicitacoes').slideUp();
                    $('.areaTabelaConsultaSolicitacoes').html('');
                    $('.areaTabelaConsultaSolicitacoes').html(retorno.mensagem);
                    $('.areaTabelaConsultaSolicitacoes').slideDown();
                    $('.areaTabelaConsultaSolicitacoes').append('<img src="https://cad.bb.com.br/lib/apps/solicitacoes/img/iconeRobo.png" onload="datatableVisaoGestor();" style="display:none;" />');
                } else {
                    bootbox.dialog({
                        backdrop: true,
                        // onEscape: function() {},
                        closeButton: true,
                        size: "large",
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
                alert("Não foi possível consultar a lista de solicitações. L915 - solicitacoes.js");
            }
        });
    }

    function montaFormulario(opcaoSelecionada){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';
        
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'montaFormulario' ,
                opcaoSelecionada: opcaoSelecionada
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1){                 
                    // $('.divDireitaFormularioSolicitacaoSolicitacoes').append(retorno.mensagem);
                    $('.divDireitaFormularioSolicitacaoSolicitacoes').css('display', 'block');
                    $(retorno.mensagem).appendTo('.divDireitaFormularioSolicitacaoSolicitacoes').show('fast');
                    $('.divDadosSolicitante').show('fast');
                    $('.divInferiorSolicitacoes').hide('fast');
                    $('.divInferiorSolicitacoes').html('');
                    // alert(retorno.mensagem);
                } else if(retorno.status == 2){
                    $(retorno.mensagem).appendTo('.divInferiorSolicitacoes').hide('fast');
                    $('.divInferiorSolicitacoes').html('');
                    $('.divInferiorSolicitacoes').css('display', 'block');
                    $(retorno.mensagem).appendTo('.divInferiorSolicitacoes').show('fast');
                } else {
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
                alert("Não foi possível consultar a lista de solicitações. L966 - solicitacoes.js");
            }
        });        
    }

    //Acessa detalhe Solicitação visão gestor
    function acessaDetalheSolicitacao(idSolicitacao){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';

        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'acessaDetalheSolicitacao',
                idSolicitacao: idSolicitacao 
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno){
                if (retorno.status == 1){
                    
                    $('.divInicialConsultaSolicitacoesGestor').css('display', 'none');
                    
                    
                    $(retorno.mensagem).appendTo('#abaAcompanharSolicitacao').show('fast');
                    setTimeout(function(){
                        $('html, body').animate({ scrollTop: 1200 }, 'slow');
                    },200);

                    limpaNotificacaoVisaoGestor(idSolicitacao);

                    if(retorno.statusSolicitacao == 1){
                        $('.itemFormulario').each(function() {
                            var text = $(this).text().trim();
                            var nextDiv = $(this).next('.divInputRespostaFormulario').find('.inputRespostaFormulario');
                            var divAtendeWhatsExibida = "";
                            // var prevDiv = $(this).prev('.itemFormulario').find('.tituloInputFormulario');
                            
                         
                        
                            if (text == 'Tipo de jornada:'){
                               
                                nextDiv.attr('id','campoConsultaTipoJornada');
                               $('#campoConsultaTipoJornada').prop('disabled', true);
                               $('#campoConsultaTipoJornada').css('color', '#B4B9C1');

                            } else if (text === 'Em qual canal deseja incluir a transação?') {
                                nextDiv.addClass('editarCanalTransacao');
                                nextDiv.attr('id', 'idEditarCanalTransacao');
                                $('#idEditarCanalTransacao').prop('disabled', true);
                                $('#idEditarCanalTransacao').css('color', '#B4B9C1');
 

                            } else if (text === 'A transação visa atender RA (Recomendação de auditoria) e/ou Regulatório?') {
                               
                                $(this).addClass('DivAtendeRa');
                                nextDiv.addClass('editarAtendeRa');
                                valResposta = $('.editarAtendeRa').val();

                                $(".editarAtendeRa").each(function(){
                                    var parentDiv = $(this).closest('.tituloInputFormulario');
                                    parentDiv.addClass('nestDivAtendeRa');
                                    });
    
                                if (valResposta =="nao"){
                                    valRespostaAlternativa ="sim"; 
                                    valTxtTela = "Não";
                                    valTxtTelaAlternativo = "Sim";
                                    //campoRaDisponibilizaWhats = " ";
                                } else if (valResposta =="sim"){
                                    valRespostaAlternativa ="nao";
                                    valTxtTela = "Sim";
                                    valTxtTelaAlternativo = "Não";
                                }


                                $('.editarAtendeRa').replaceWith(` <div class="divRadioBtnEditarRa"> 
                                                                        <input type="radio" class="editarAtendeRa" id=" `+ valResposta +`" name="editarAtendeRa" value="` + valResposta +`" checked> ` + valTxtTela + ` 
                                                                        <input type="radio" class="editarAtendeRa" id="` + valRespostaAlternativa + `" name="editarAtendeRa" value=" ` + valRespostaAlternativa + ` "> ` + valTxtTelaAlternativo + `
                                                                    </div>
                                                                    </div>
                                                                `);
                                

                                campoRaDisponibilizaWhats = `<div class="divInputRadioEspecificoWhatsapp" style="margin-top:10px;">
                                <br>
                                    <div class="itemFormulario divDisponibilizadeRa"> A RA, regulamento ou lei especifica que a transação deve ser disponibilizada no WhatsApp?</div> 
                                    <div class="divInputRespostaFormulario divDisponibilizadeRa" style="display: flex; height: 39px; padding: 8px 16px 7px 16px; align-items: center; gap: 8px;  align-self: stretch; border-radius: 4px 4px 0px 0px; background: var(--background-neutral-default, #F0F2F4); border-bottom: 1px solid #B4B9C1;">                                                                      
                                    
                                        <input type="radio" class="editarEspecificoWhatsapp" id="sim" name="especificoWhats" value="sim"> Sim 
                                        <input type="radio" class="editarEspecificoWhatsapp" id="nao" name="especificoWhats" value="nao"> Não
                                </div>`;

                               $('.editarAtendeRa').on('change', function(){

                                    var valorSelecionado = $("input[name='editarAtendeRa']:checked").val();
                                    valorSelecionado =  valorSelecionado.trim();
                                    
                                    if( valorSelecionado == "sim"){
                                        divAtendeWhatsExibida = "sim";
                                            
                                        setTimeout(function() {

                                            $('.nestDivAtendeRa').after(campoRaDisponibilizaWhats);
                                            $(campoRaDisponibilizaWhats).show('slow');
                                            
                                        }, 250);
                                    } else if(valorSelecionado =="nao"){
                                        campoRaDisponibilizaWhats
                                        $('.divDisponibilizadeRa').hide('slow');
                                        $('.divInputRadioEspecificoWhatsapp').remove();
                                      
                                        
                                        
                                    }
                               })
                            } else if (text === 'A RA, regulamento ou lei especifica que a transação deve ser disponibilizada no WhatsApp?') {
                                
                                nextDiv.addClass('editarEspecificoWhatsapp editarEspecificoWhatsappPrimario');
                            
                                $(".editarEspecificoWhatsapp").each(function(){
                                    var parentDiv = $(this).closest('.tituloInputFormulario');
                                    parentDiv.addClass('nestDivdisponibilizaWhats');
                                    });

                                    valRespostaEspecificaWhats = $('.editarEspecificoWhatsapp').val();

                                    if (valRespostaEspecificaWhats =="nao"){
                                        valRespostaEspecificaWhatsAlternativa ="sim"; 
                                        valWhatsTxtTela = "Não";
                                        valWhatsTxtTelaAlternativo = "Sim";
                                        
                                    } else if (valRespostaEspecificaWhats =="sim"){
                                        valRespostaEspecificaWhatsAlternativa ="nao";
                                        valWhatsTxtTela = "Sim";
                                        valWhatsTxtTelaAlternativo = "Não";
                                    }


                                    $('.editarEspecificoWhatsapp').replaceWith(` <div class="divRadioBtnEditarRa"> 
                                        <input type="radio" class="editarEspecificoWhatsapp" id=" `+ valRespostaEspecificaWhats +`" name="RadioeditarEspecificoWhatsapp" value="` + valRespostaEspecificaWhats +`" checked> ` + valWhatsTxtTela + ` 
                                        <input type="radio" class="editarEspecificoWhatsapp" id="` + valRespostaEspecificaWhatsAlternativa + `" name="RadioeditarEspecificoWhatsapp" value=" ` + valRespostaEspecificaWhatsAlternativa + ` "> ` + valWhatsTxtTelaAlternativo + `
                                    </div>
                                    </div>
                                `);
    

                                $('.editarAtendeRa').on('change', function(){
                                    var valorSelecionadoEditaAtendeRa = $("input[name='editarAtendeRa']:checked").val();
                                    valorSelecionadoEditaAtendeRa =  valorSelecionadoEditaAtendeRa.trim();
                                    
                                    if(valorSelecionadoEditaAtendeRa == "sim"){
                                        $('.nestDivdisponibilizaWhats').css('display', 'none');
                                    } else  if(valorSelecionadoEditaAtendeRa == "nao"){
                                         $('.nestDivdisponibilizaWhats').css('display', 'none');
                                         $('.divInputRadioEspecificoWhatsapp').css('display', 'none');
                                                                               
                                    }
                                })

                               
                            } else if (text === 'Qual o assunto principal da transação?') {
                                nextDiv.addClass('editarAssuntoJornada');
                            } else if (text === 'Qual o objetivo da transação?') {
                                nextDiv.addClass('editarObjetivoJornada');
                            } else if (text === 'Qual será a métrica de sucesso da transação no canal?') {
                                nextDiv.addClass('editarMetricaSucesso');
                            } else if (text === 'Qual o resultado projetado nos primeiros 6 meses com a implementação?') {
                                nextDiv.addClass('editarResultadoProjetado');
                            } else if (text === 'Como será feito o acompanhamento dessa(s) métrica(s) de sucesso?') {
                                nextDiv.addClass('editarAcompanhamentoMetrica');
                            } else if (text === 'Como o público-alvo será estimulado a consumir essa transação no canal?') {
                                nextDiv.addClass('editarEstimuloConsumoTransacao');
                            } else if (text === 'Qual o público-alvo da transação?'){
                                nextDiv.addClass('editarPublicoAlvo');
                            } else if (text === 'Em quais canais a transação já existe?'){
                                nextDiv.addClass('editarCanaisTransacoesExiste');
                            }
                        });
                    }

                } else if (retorno.status == 2){

                    alert (" não deu sucesso");

                } else {
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
                alert("Não foi possível consultar a lista de solicitações. L966 - solicitacoes.js");
            }    

        });
    }

    function acessaDetalheSolicitacaoVisaoCad(idSolicitacao){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';

        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'acessaDetalheSolicitacaoVisaoCad',
                idSolicitacao: idSolicitacao 
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno){
                if (retorno.status == 1){
                    
                    $('.divTabelaSolicitacoes').css('display', 'none');
                    $(retorno.mensagem).appendTo('.conteudoSolicitacoes').show('fast');
                    setTimeout(function(){
                        $('html, body').animate({ scrollTop: 600 }, 'slow');
                    },300);

                } else if (retorno.status == 2){

                    alert (" não deu sucesso");

                } else {
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
                alert("Não foi possível consultar a lista de solicitações. L966 - solicitacoes.js");
            }    

        });
    }

    function enviaPerguntasIa(solicitacaoIncluida){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';

        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'enviaPerguntasIa',
                solicitacaoIncluida: solicitacaoIncluida 
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno){
                if (retorno.status == 1){
                    
                    const jsonBody = '{"data":{"input": "'+retorno.mensagem+'", "intents": [{}], "entities": [{}], "context": {} }}';
                    // console.log('jsonBody: '+jsonBody);
                    const jsonString = JSON.stringify(jsonBody);
                    const jsonBodyParsed = JSON.parse(jsonString);
                    // console.log('jsonBodyParsed >> '+jsonBodyParsed);
                    
                    // Enviar a mensagem para a API Produção
                    // fetch('https://acs-assist-bot-cad-dev.nia.servicos.bb.com.br/acs/llms/agent', {
        
                    // Enviar a mensagem para a API Homologação
                    fetch('https://acs-assist-bot-cad-entde.nia.hm.bb.com.br/acs/llms/agent', {
                        
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        mode: 'cors',
                        body: jsonBodyParsed
                    })
                    .then(response => response.json())
                    .then(data => {
                        // console.log('Resposta do servidor:', data);
                        
                        const jsonString = (JSON.stringify(data));
                        const jsonObject = JSON.parse(jsonString);
                        // console.log('JSON.stringify(jsonObject): ',JSON.stringify(jsonObject));
                        
                        // const respBot = (jsonObject.data.context.messages.content[1]);
                        const respBot = jsonObject.data.context.messages.filter(message => message.role === "assistant");
                        gravarRespostaIa(solicitacaoIncluida, JSON.stringify(respBot), "informacional");
                    })
                    .catch(error => {
                        // bootbox.dialog({
                        //     backdrop: true,
                        //     // onEscape: function() {},
                        //     closeButton: true,
                        //     size: "small",
                        //     title: "Erro!",
                        //     message: "<div>A Inteligência Artificial não está respondendo no momento. Erro: "+error.message+". Status: "+error.status+"</div>",
                        //     buttons: {
                        //         confirm: {
                        //             label: "OK",
                        //             className: "btn-warning"
                        //         }
                        //     },
                        // });
                        console.error('Erro:', error);
                    });
                    retorno = null;
                } else {
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
                alert("Não foi possível enviar a solicitação para análise da IA. L1696 - solicitacoes.js");
            }    
        });
    }

    function gravarRespostaIa(solicitacaoIncluida, respostaIa, tipoJornada){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';
        // alert('tipoJornada > '+tipoJornada);

        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'gravarRespostaIa',
                solicitacaoIncluida: solicitacaoIncluida,
                respostaIa: respostaIa,
                tipoJornada: tipoJornada
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno){
                if (retorno.status == 1){
                    enviarEmail(solicitacaoIncluida);
                } else {
                    bootbox.dialog({
                        backdrop: true,
                        // onEscape: function() {},
                        closeButton: true,
                        size: "medium",
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
                alert("Não foi possível consultar a lista de solicitações. L966 - solicitacoes.js");
            }    

        });

    }

    /*======== Escolha de pagina Gestor X CAD====*/
    $('#visaoGestor').on('click', function(){
        var paginaEscolhida = "visaoGestor";
    });

    $('#visaoCad').on('click', function(){
        var paginaEscolhida = "visaoCad";
    });

    function escolhePagina(paginaEscolhida){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';

        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'escolhePaginaGestorOuCad',
                paginaEscolhida: paginaEscolhida 
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno){
                if (retorno.status == 1){
                    
                    alert("deu certo");

                } else if (retorno.status == 2){

                    alert (" não deu sucesso");

                } else {
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
                alert("Não foi possível consultar a lista de solicitações. L966 - solicitacoes.js");
            }    

        });
    }

    function gravarComentario(idSolicitacao, comentario) {
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';

        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'gravarComentario',
                idSolicitacao: idSolicitacao,
                comentario: comentario 
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno){
                if (retorno.status == 1){
                    bootbox.dialog({
                        backdrop: true,
                        // onEscape: function() {},
                        closeButton: true,
                        size: "medium",
                        title: "Sucesso!",
                        message: "<div>"+retorno.mensagem+"</div>",
                        buttons: {
                            confirm: {
                                label: "OK",
                                className: "btn-success",
                                callback: function() {
                                    consultaComentarios(idSolicitacao);
    
                                }
                            }
                        },
                    });
                } else {
                    bootbox.dialog({
                        backdrop: true,
                        // onEscape: function() {},
                        closeButton: true,
                        size: "medium",
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
                alert("Não foi possível gravar o comentário. L1441 - solicitacoes.js");
            }    
        });
    }

    function consultaComentarios(idSolicitacao){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';

        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'consultaComentarios',
                idSolicitacao: idSolicitacao
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno){
                if (retorno.status == 1){
                    // $('#novoComentarioVisaoCad').val('');
                    $('#novoComentarioVisaoCad.txtareamedio').val('');
                    $('.divAreaComentariosVisaoCadSolicitacaoAnalise').html('');
                    $('.divAreaComentariosVisaoCadSolicitacaoNova').html('');
                    $('.divAreaComentariosVisaoCadSolicitacaoAnalise').html(retorno.mensagem);
                    $('.divAreaComentariosVisaoCadSolicitacaoNova').html(retorno.mensagem);
                } else {
                    bootbox.dialog({
                        backdrop: true,
                        // onEscape: function() {},
                        closeButton: true,
                        size: "medium",
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
                alert("Não foi possível gravar o comentário. L1441 - solicitacoes.js");
            }    
        });
    }

    function alteraStatusSolicitacao(idSolicitacao, novoStatus, textoParecerFinal){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';

        if(novoStatus == 3 || novoStatus == 4){
            $.ajax({
                aSync: true,
                url: caminhoController,
                data: {
                    request: 'gravaParecerFinal',
                    idSolicitacao: idSolicitacao,
                    textoParecerFinal: textoParecerFinal
                },
                type: "POST",
                dataType: "JSON",
                dataSrc: "",
                success: function(retorno){
                    if (retorno.status == 1){
                        $.ajax({
                            aSync: true,
                            url: caminhoController,
                            data: {
                                request: 'alteraStatusSolicitacao',
                                idSolicitacao: idSolicitacao,
                                novoStatus: novoStatus
                            },
                            type: "POST",
                            dataType: "JSON",
                            dataSrc: "",
                            success: function(retorno){
                                if (retorno.status == 1){
                                    // $('.divConsultaDetalheSolicitacao').css('display', 'none');
                                    // $('.divConsultaDetalheSolicitacao').remove();
                
                                    $('.divConsultaDetalheSolicitacao').fadeOut('fast', function() {
                                        $(this).remove();
                                    });
                
                                    acessaDetalheSolicitacaoVisaoCad(idSolicitacao);
                                    limparCamposPesquisaSolicitacoes();
                                    contaNovasSolicitacoes();
                                    disparaEmailDemandante(idSolicitacao);
                                } else {
                                    bootbox.dialog({
                                        backdrop: true,
                                        // onEscape: function() {},
                                        closeButton: true,
                                        size: "medium",
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
                                alert("Não foi possível alterar o status da solicitação. L1814 - solicitacoes.js");
                            }    
                        });
                    } else {
                        bootbox.dialog({
                            backdrop: true,
                            // onEscape: function() {},
                            closeButton: true,
                            size: "medium",
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
                    alert("Não foi possível alterar o status da solicitação. L1837 - solicitacoes.js");
                }    
            });
        } else {
            $.ajax({
                aSync: true,
                url: caminhoController,
                data: {
                    request: 'alteraStatusSolicitacao',
                    idSolicitacao: idSolicitacao,
                    novoStatus: novoStatus
                },
                type: "POST",
                dataType: "JSON",
                dataSrc: "",
                success: function(retorno){
                    if (retorno.status == 1){
                        // $('.divConsultaDetalheSolicitacao').css('display', 'none');
                        // $('.divConsultaDetalheSolicitacao').remove();
    
                        $('.divConsultaDetalheSolicitacao').fadeOut('fast', function() {
                            $(this).remove();
                        });
    
                        acessaDetalheSolicitacaoVisaoCad(idSolicitacao);
                    } else {
                        bootbox.dialog({
                            backdrop: true,
                            // onEscape: function() {},
                            closeButton: true,
                            size: "medium",
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
                    alert("Não foi possível alterar o status da solicitação. L1802 - solicitacoes.js");
                }    
            });
        }
    }

    function limpaNotificacaoVisaoGestor(idSolicitacao) {
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';

        var $tr = $('tr[attr-idsolicitacao="' + idSolicitacao + '"]');
        if ($tr.hasClass('linhaEmNegrito')) {
            $tr.removeClass('linhaEmNegrito');
        }

        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'limpaNotificacaoVisaoGestor',
                idSolicitacao: idSolicitacao
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno){
                // if (retorno.status == 1){
                    $('.notificaQtdeSolicitacoes').html('');
                    $('.notificaQtdeSolicitacoes').html(retorno.mensagem);
                // } else {
                    // bootbox.dialog({
                    //     backdrop: true,
                    //     // onEscape: function() {},
                    //     closeButton: true,
                    //     size: "medium",
                    //     title: "Erro!",
                    //     message: "<div>"+retorno.mensagem+"</div>",
                    //     buttons: {
                    //         confirm: {
                    //             label: "OK",
                    //             className: "btn-warning"
                    //         }
                    //     },
                    // });
                    // $('.notificaQtdeSolicitacoes').html('');
                    // $('.notificaQtdeSolicitacoes').html(retorno.mensagem);
                // }
            },
            error: function(erro) {
                console.log("Não foi possível consultar o total de notificações. L1788 - solicitacoes.js");
            }    
        });
    }

    function consultaAnaliseManualIa(idSolicitacao){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';

        return new Promise(function(resolve, reject) {
            $.ajax({
                async: true,
                url: caminhoController,
                data: {
                    request: 'consultaAnaliseManualIa',
                    idSolicitacao: idSolicitacao
                },
                type: "POST",
                dataType: "JSON",
                success: function(retorno) {
                    if (retorno.status == 1) {
                        var resposta = retorno.mensagem;
                        console.log('tamanho resposta: ' + resposta.length);
                        if (resposta.length > 0 || !resposta) {
                            resolve(1);
                        } else {
                            resolve(0);
                        }
                    } else {
                        resolve(0);
                    }
                },
                error: function(erro) {
                    alert("Não foi possível verificar a resposta da IA para a solicitação " + idSolicitacao + " neste momento. L1788 - solicitacoes.js Erro: " + erro);
                    reject(erro);
                }
            });
        });
    }

    function enviarEmail(idSolicitacao){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';
        $.ajax({
            async: true,
            url: caminhoController,
            data: {
                request: 'enviarEmail',
                idSolicitacao: idSolicitacao
            },
            type: "POST",
            dataType: "JSON"
        });
    }

    function disparaEmailDemandante(idSolicitacao){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/solicitacoes/controller/controller_solicitacoes.php';
        $.ajax({
            async: true,
            url: caminhoController,
            data: {
                request: 'disparaEmailDemandante',
                idSolicitacao: idSolicitacao
            },
            type: "POST",
            dataType: "JSON"
        });
    }
});