$(document).ready(function(){
    /* APLICAÇÕES DO DATATABLE NAS TABELAS DE ACOMPANHAMENTO DA VISÃO CAD E GESTOR */
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

    $("#tabelaConsultaSolicitacao").DataTable({
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
        alert("Acessar para visualizar solicitação nº"+idSolicitacao);
        $('.divInicialConsultaSolicitacoesGestor').css('display', 'none');
        

    });

    // Chamada para fechar a div de sucesso na gravação
    $('#fechaDivAlerCadastroSucesso').on('click', function(){
        $('#alertaSucessoCadastroSolicitacao').css('display', 'none');
    });

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
                
                for (var pair of formData.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]); 
                }

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
                

                for (var pair of formData.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]); 
                }

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
                    $('.bodyTabelaSolicitacoesVisaoGestor').html('');
                    $('.bodyTabelaSolicitacoesVisaoGestor').html(retorno.mensagem);
                }
                else{
                    alert("Não foi possível consultar a lista de solicitações. L852 - solicitacoes.js");
                }
            },
            error: function(erro) {
                alert("Não foi possível consultar a lista de solicitações. L856 - solicitacoes.js");
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
                    $('.bodyTabelaSolicitacoesVisaoGestor').html('');
                    $('.bodyTabelaSolicitacoesVisaoGestor').html(retorno.mensagem);
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
});