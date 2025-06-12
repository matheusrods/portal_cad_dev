
$(document).ready(function() {
    
    // $('#tabelaIncidentes').DataTable({
    //     dom: 'Brtip',
    //     buttons: [
    //         'copy', 'csv', 'excel', 'pdf'
    //     ],
    //     language: {
    //         url:"https://cad.bb.com.br/lib/datatables/pt_br.json"
    //     }
    // });

    $('#myModal').modal('show');
    
    $('.maisFiltros').on('click', function(){
        $('.divFiltrosSegundaLinha').css('display', 'inline-flex').show();
        $('.divBtnMaisFiltros').hide();
        $('.divBtnLimparFiltrosPrimeiraLinha').hide();
        $('.divOcultaBtnFiltros').css('display', 'inline-flex').show();
    });

    $('.menosFiltros').on('click', function(){
        $('.divFiltrosSegundaLinha').hide();
        $('.divOcultaBtnFiltros').hide();
        $('.divBtnMaisFiltros').show();
        $('.divBtnLimparFiltrosPrimeiraLinha').show();
    });

    $('.divBtnLimparFiltrosPrimeiraLinha').on('click', function(){
        consultaIncidentes();
        limparCampos();
    });

    $('.divBtnLimparFiltrosSegundaLinha').on('click', function(){
        consultaIncidentes();
        limparCampos();
    });

    // var linhasPorPagina = 5;
    // var linhaTabela = $('table tbody tr');
    // var qtdeLinhasTabela = linhaTabela.length;
    // var paginaCount = Math.ceil(qtdeLinhasTabela/linhasPorPagina);
    //  for (var i = 0; i < paginaCount; i++){
    //     numbers.append('<li>' + (i + 1) + '</li>');   
    //  }

    //  linhaTabela.hide();
    //  linhaTabela.slice(0, linhasPorPagina).show;

    var dicionarioPesquisa = {};
    $('.itemPesquisa').on('change', function(){
        // var montaQuery="";
        // $( "#campoNumIntIssue" ).on( "change", function() {
            var numDigitado = $('#campoNumIntIssue').val();
            const verificaEspacoVazio = str => !/\S/.test(numDigitado);            
             
            if (!verificaEspacoVazio(numDigitado)) {
                $('#campoNumIntIssue').attr('attr-campoAlterado', '1');
                dicionarioPesquisa["numIntIssue"] = numDigitado;
            } 
            else {
                $('#campoNumIntIssue').attr('attr-campoAlterado', '0');                
                delete dicionarioPesquisa["numIntIssue"]; 
                var campoIntIssueVazio = true;
            }
        // } );

        // $("#campoTipoIncidente").on("change", function(){
            
            var incidenteSelecionado = $('#campoTipoIncidente').val();
        
            if(incidenteSelecionado!== "Tipo de incidente" ){
                $('#campoTipoIncidente').attr('attr-campoAlterado', '1');
                dicionarioPesquisa["tipo"] = incidenteSelecionado;
                // var montaQuery="tipo like %" + incidenteSelecionado +"%";
                // consultaIncidentes(numDigitado);
            } 
            else {
                $('#campoTipoIncidente').attr('attr-campoAlterado', '0');
                delete dicionarioPesquisa["tipo"]; 
                var campoTipoVazio = true;
            }  

        // });

        // $("#campoStatusIncidente").on("change", function(){
            
            var statusSelecionado = $('#campoStatusIncidente').val();

            if(statusSelecionado!== "Status" ) {
                $('#campoStatusIncidente').attr('attr-campoAlterado', '1');
                dicionarioPesquisa["status"] = statusSelecionado;
                // consultaIncidentes(numDigitado);
                // var montaQuery="status like %" + statusSelecionado +"%";
            } else {
                $('#campoStatusIncidente').attr('attr-campoAlterado', '0');
                delete dicionarioPesquisa["status"]; 
                var campoStatusVazio = true;
            }

        // });

        // $("#campoAmbiente").on("change", function(){
            
            var ambienteSelecionado = $('#campoAmbiente').val();
  
            if(ambienteSelecionado!== "Ambiente" ){
                $('#campoAmbiente').attr('attr-campoAlterado', '1');
                dicionarioPesquisa["ambiente"] = ambienteSelecionado;
                // var montaQuery="ambiente like %" + ambienteSelecionado +"%";
                // consultaIncidentes(numDigitado);
            } else {
                $('#campoAmbiente').attr('attr-campoAlterado', '0');
                delete dicionarioPesquisa["ambiente"]; 
                var campoAmbienteVazio = true;
            }
        // });

        // $("#campoDependencia").on("change", function(){
            
            var dependenciaSelecionada = $('#campoDependencia').val();
            
            if(dependenciaSelecionada!== "Dependência Abertura" ){
                $('#campoDependencia').attr('attr-campoAlterado', '1');
                dicionarioPesquisa["dependencia"] = dependenciaSelecionada;
                // var montaQuery="dependencia like %" + dependenciaSelecionada +"%";
                // consultaIncidentes(numDigitado);
            } else {
                $('#campoDependencia').attr('attr-campoAlterado', '0');
                delete dicionarioPesquisa["dependencia"]; 
                var campoDependenciaVazio = true;
            }
        // });
        
        // $("#dataAbertura").on("change", function(){
            
            var dataAbertura = $('#dataAbertura').val();
            
            if(dataAbertura){
                $('#dataAbertura').attr('attr-campoAlterado', '1');
                dicionarioPesquisa["dataHoraAbertura"] = dataAbertura;
                // var montaQuery="dataHoraAbertura like %" + dataAbertura +"%";
                // consultaIncidentes(numDigitado);        
            } else {
                $('#dataAbertura').attr('attr-campoAlterado', '0');
                delete dicionarioPesquisa["dataHoraAbertura"];
                var campoDataAberturaVazio = true;
            }
            
        // });

        // $("#dataEncerramento").on("change", function(){
            
            var dataEncerramento = $('#dataEncerramento').val();

            if(dataEncerramento){
                $('#dataEncerramento').attr('attr-campoAlterado', '1');
                dicionarioPesquisa["dataHoraEncerramento"] = dataEncerramento;
                // var montaQuery="dataHoraEncerramento like %" + dataEncerramento +"%";
                // consultaIncidentes(numDigitado);
                if (dataEncerramento < dataAbertura){
                    alert("A data de encerramento deve ser maior do que a data de abertura");
                }
            } else {
                $('#dataEncerramento').attr('attr-campoAlterado', '0');
                delete dicionarioPesquisa["dataHoraEncerramento"];
                var campoDataEncerramentoVazio = true;
            }

        // });
        
         if(campoIntIssueVazio == true && campoTipoVazio && campoStatusVazio == true && campoDependenciaVazio == true && campoAmbienteVazio == true && campoDataAberturaVazio == true && campoDataEncerramentoVazio == true ){
            consultaIncidentes();
            limparCampos();
         } else {
        //transforma o object dicionário em uma string
            var dadosPesquisa = JSON.stringify(dicionarioPesquisa);
            pesquisaIncidentes(dadosPesquisa);
        }
    });   
    
    function pesquisaIncidentes(dadosPesquisa){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/incidentes/controller/controller_incidentes.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'pesquisaIncidentes' ,
                dadosPesquisa: dadosPesquisa
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1){
                    $('.areaTabelaIncidentes').html('');
                    $('.areaTabelaIncidentes').html(retorno.mensagem);

                    $('.acessaIncidente').on('click', function(){
                            var idIncidente = $(this).attr('attr-idIntIssue');
                            acessaIncidente(idIncidente);
                    });

                    $('.editaIncidente').on('click', function(){
                        var numIntIssue = $(this).attr('attr-idintissue');
                        editaIncidente(numIntIssue);
                    });

                    $('.deletaIncidente').on('click', function(){
                        var numIntIssue = $(this).attr('attr-idintissue');
                        deletaIncidente(numIntIssue);
                    });
                }
                else{
                    alert("não deu certo");
                }
            },
            error: function(erro) {
                alert("deu erro");
            }
        });
    }

    function consultaIncidentes(){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/incidentes/controller/controller_incidentes.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'consultaIncidentes' 
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1){
                    $('.areaTabelaIncidentes').html('');
                    $('.areaTabelaIncidentes').html(retorno.mensagem);

                    $('.acessaIncidente').on('click', function(){
                        var idIncidente = $(this).attr('attr-idIntIssue');
                        acessaIncidente(idIncidente);
                    });
                    
                    $('.editaIncidente').on('click', function(){
                        var numIntIssue = $(this).attr('attr-idintissue');
                        editaIncidente(numIntIssue);
                    });
                
                    $('.deletaIncidente').on('click', function(){
                        var numIntIssue = $(this).attr('attr-idintissue');
                        deletaIncidente(numIntIssue);
                    });
                }
                else{
                    alert("não deu certo");
                }
            },
            error: function(erro) {
                alert("deu erro");
            }
        });
    }

    
    // console.log(dicionarioPesquisa);
       
    /* TRECHO INCLUÍDO POR ALBERT PARA FUNÇÕES DA INCLUSÃO DE INCIDENTES */

    // $('#numIntIssueRegistraIncidente').on('focusout', function(){
    $(document).on('focusout', '#numIntIssueRegistraIncidente', function(){
        var numIntIssue = $('#numIntIssueRegistraIncidente').val();
        consultaIncidentesCadastrados(numIntIssue).then(result => {
            if(result == '1'){
                $('#numIntIssueRegistraIncidente').val('');
                bootbox.dialog({
                    backdrop: true,
                    // onEscape: function() {},
                    closeButton: true,
                    size: "small",
                    title: "Aviso!",
                    message: "<div>INT/Issue "+numIntIssue+" já cadastrado.<br>Deseja consultar?</div>",
                    buttons: {
                        confirm: {
                            label: "Sim",
                            className: "btn-success",
                            callback: function() {
                                acessaIncidente(numIntIssue);

                            }
                        },
                        cancel: {
                            label: "Não",
                            className: "btn-danger",
                        }
                    },
                });
                return false;
            }
        })
        .catch(error => {
            console.error("Erro ao consultar incidentes:", error);
        });
    });

    $(document).on('change', '.camposObrigatorios', function(){
        $(this).attr('attr-campoObrigatorioPreenchido', '1');
        desabilitaGravar();
    });

    $(document).ready('.modal-content', function(){
        $('.modal-footer').prepend('<div style="margin-right: auto;"><p>* Campos Obrigatórios</p></div>');
    });

    function desabilitaGravar(){
        
        var btnTipoIncidente = $("#tipoIncidenteCadastraIncidente").attr('attr-campoObrigatorioPreenchido');
        var inputIntIssue = $("#numIntIssueRegistraIncidente").attr('attr-campoObrigatorioPreenchido');
        var inputDataAbertura = $("#dataAberturaRegistraIncidente").attr('attr-campoObrigatorioPreenchido');
        var inputHoraAbertura = $("#horarioAberturaRegistraIncidente").attr('attr-campoObrigatorioPreenchido');
        var btnAmbiente = $("#selectAmbienteCadastraIncidente").attr('attr-campoObrigatorioPreenchido');
        var btnStatus = $("#selectStatusCadastraIncidente").attr('attr-campoObrigatorioPreenchido');
        var inputDependencia = $('#numDependenciaRegistraIncidente').attr('attr-campoObrigatorioPreenchido');
        
        if(btnTipoIncidente == 1 && inputIntIssue == 1 && inputDataAbertura == 1 && inputHoraAbertura == 1 && btnAmbiente == 1 && btnStatus == 1 && inputDependencia == 1) {
            $(".btnGravaIncidenteRegistraIncidente").removeAttr("disabled");
        } else {
            $(".btnGravaIncidenteRegistraIncidente").attr("disabled", "disabled");
        }

        if ($('#divCamposObrigatorios').length == 0){
            $('.modal-footer').prepend('<div id="divCamposObrigatorios" style="margin-right: auto;"><p>* Campos Obrigatórios. Ao preenchê-los, o botão de gravação é habilitado.</p></div>');
        }
    }
    

    $('.botaoCadastraIncidente').on('click', function(){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/incidentes/controller/controller_incidentes.php';

        $.ajax({
            aSync: false,
            url: caminhoController,
            data: {
                request: 'montaTelaCadastraIncidente'
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                jQuery(function($){
                    desabilitaGravar();
                });
                if (retorno.status == 1) {
                    bootbox.dialog({
                        backdrop: true,
                        onEscape: function() {},
                        closeButton: true,
                        size: 'large',
                        title: 'Cadastrar incidente',
                        message: "<div>"+retorno.mensagem+"</div>",
                        buttons: {
                            cancel: {
                                label: 'Fechar',
                                className: 'btn-danger',
                            },
                            confirm: {
                                label: 'Gravar',
                                className: 'btn-success btnGravaIncidenteRegistraIncidente',
                                callback: function() {
                                    jQuery(function($){
                                        desabilitaGravar();
                                    });
                                    var tipoIncidente = $("#tipoIncidenteCadastraIncidente").val();
                                    var numIntIssue = $('#numIntIssueRegistraIncidente').val();
                                    var dataAbertura = $('#dataAberturaRegistraIncidente').val();
                                    var horaAbertura = $('#horarioAberturaRegistraIncidente').val();
                                    var motivo = $('#motivoRegistraIncidente').val();
                                    var ambiente = $('#selectAmbienteCadastraIncidente').val();
                                    
                                    // var status = $('#selectStatusCadastraIncidente').val();
                                    var status = $("#selectStatusCadastraIncidente option:selected").text();
                                    var dependencia = $('#numDependenciaRegistraIncidente').val();
                                    var dataEncerramento = $('#dataEncerramentoRegistraIncidente').val();
                                    var horaEncerramento = $('#horarioEncerramentoRegistraIncidente').val();
                                    var observacao = $('#observacaoRegistraIncidente').val();
                                    var responsavel = $('#inputResponsavelRegistraIncidente').val();

                                    var formData = new FormData();
                                    var mensagemErro = "Atenção: <br><br>";
                                    var contaErros = 0;

                                    var dataAgora = new Date();
                                    var ano = dataAgora.getFullYear();
                                    var mes = (dataAgora.getMonth())+1;
                                    var dia = dataAgora.getDate();
                                    var hora = dataAgora.getHours();
                                    var minutos = dataAgora.getMinutes();

                                    if(mes > 8){
                                        mes = '1'+mes;
                                    } else {
                                        mes = '0'+mes;
                                    }

                                    if(dia > 9){
                                        dia = dia;
                                    } else {
                                        dia = '0'+dia;
                                    }

                                    if (hora < 10) {
                                        hora = '0'+hora;
                                    }

                                    if (minutos < 10) {
                                        minutos = '0'+minutos;
                                    }

                                    var dataEditada = ano+"-"+mes+"-"+dia+" "+hora+":"+minutos;
                                    var dataEditadaExibicao = dia+"/"+mes+"/"+ano+" "+hora+":"+minutos;

                                    if(tipoIncidente == 0){
                                        mensagemErro = mensagemErro+"-Selecionar o tipo de incidente;<br>";
                                        contaErros = ++contaErros;
                                        $("#tipoIncidenteCadastraIncidente").attr('attr-campoObrigatorioPreenchido', '0');
                                    }
                                    
                                    if(numIntIssue.length == 0){
                                        mensagemErro = mensagemErro+"-Informar nº válido de INT/Issue;<br>";
                                        contaErros = ++contaErros;
                                        $("#numIntIssueRegistraIncidente").attr('attr-campoObrigatorioPreenchido', '0');
                                    }

                                    if(dataAbertura.length == 0){
                                        mensagemErro = mensagemErro+"-Informar data de abertura;<br>";
                                        contaErros = ++contaErros;
                                        $("#dataAberturaRegistraIncidente").attr('attr-campoObrigatorioPreenchido', '0');
                                    }

                                    if(horaAbertura.length == 0){
                                        mensagemErro = mensagemErro+"-Informar hora de abertura;<br>";
                                        contaErros = ++contaErros;
                                        $("#horarioAberturaRegistraIncidente").attr('attr-campoObrigatorioPreenchido', '0');
                                    }

                                    if(((dataAbertura.length > 0 && horaAbertura.length > 0) && (dataAbertura+' '+horaAbertura)) > dataEditada){
                                        mensagemErro = mensagemErro+"-Data e hora de abertura do incidente maior que o horário atual ("+dataEditadaExibicao+");<br>";
                                        contaErros = ++contaErros;
                                    }

                                    if(((dataEncerramento.length > 0 && horaEncerramento.length > 0) && (dataEncerramento+' '+horaEncerramento)) > dataEditada){
                                        mensagemErro = mensagemErro+"-Data e hora de encerramento do incidente maior que o horário atual ("+dataEditadaExibicao+");<br>";
                                        contaErros = ++contaErros;
                                    }

                                    if(ambiente == 0){
                                        mensagemErro = mensagemErro+"-Selecionar o ambiente;<br>";
                                        contaErros = ++contaErros;
                                        $("#selectAmbienteCadastraIncidente").attr('attr-campoObrigatorioPreenchido', '0');
                                    }
                                    
                                    if(status == "Status") {
                                        mensagemErro = mensagemErro+"-Informar o status do incidente;<br>";
                                        contaErros = ++contaErros;
                                        $("#selectStatusCadastraIncidente").attr('attr-campoObrigatorioPreenchido', '0');
                                    }

                                    if(dependencia.length == 0){
                                        mensagemErro = mensagemErro+"-Informar a dependência responsável;<br>";
                                        contaErros = ++contaErros;
                                        $('#numDependenciaRegistraIncidente').attr('attr-campoObrigatorioPreenchido', '0');
                                    }

                                    if(status == "ENCERRADA" && (dataEncerramento.length == 0 || horaEncerramento.length == 0)){
                                        mensagemErro = mensagemErro+"-Para gravar o incidente com status 'Encerrada', é necessário informar a data e hora de encerramento;<br>";
                                        contaErros = ++contaErros;
                                    }

                                    if((dataEncerramento.length > 0 || horaEncerramento.length > 0) && status != "ENCERRADA"){
                                        mensagemErro = mensagemErro+"-Para informar a data e hora de encerramento é necessário alterar o status do incidente para 'Encerrada';<br>";
                                        contaErros = ++contaErros;
                                    }

                                    if((dataEncerramento.length > 0 && horaEncerramento.length > 0) && (dataEncerramento < dataAbertura) || ((dataEncerramento <= dataAbertura && horaEncerramento < horaAbertura)) && status == "ENCERRADA"){
                                        mensagemErro = mensagemErro+"-A data e hora de encerramento devem ser maiores que a data e hora de abertura;<br>";
                                        contaErros = ++contaErros;
                                    }

                                    consultaIncidentesCadastrados(numIntIssue).then(result => {
                                        if(result == '1'){
                                            $('#numIntIssueRegistraIncidente').val('');
                                            mensagemErro = mensagemErro+"INT/Issue "+numIntIssue+" já cadastrado;<br>";
                                            return mensagemErro;
                                        }
                                    })
                                    .catch(error => {
                                        console.error("Erro ao consultar incidentes:", error);
                                    });

                                    mensagemErro = mensagemErro.substring(0, mensagemErro.length-5)+".";

                                    var formData = new FormData();
                                    
                                    if(contaErros == 0){
                                        formData.append("request","gravaIncidente");
                                        formData.append("tipoIncidente", tipoIncidente);
                                        formData.append("numIntIssue", numIntIssue.replace(/[\\']/g, '"'));
                                        formData.append("dataAbertura", dataAbertura);
                                        formData.append("horaAbertura", horaAbertura);
                                        formData.append("motivo", motivo.replace(/[\\']/g, '"'));
                                        formData.append("ambiente", ambiente);
                                        formData.append("status", status);
                                        formData.append("dependencia", dependencia.replace(/[\\']/g, '"'));
                                        formData.append("dataEncerramento", dataEncerramento);
                                        formData.append("horaEncerramento", horaEncerramento);
                                        formData.append("observacao", observacao.replace(/[\\']/g, '"'));
                                        formData.append("responsavel", responsavel.replace(/[\\']/g, '"'));

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
                                                    limparCampos();
                                                    consultaIncidentes();
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
                                                    message: "<div><p>"+retorno.mensagem+"<br><br> Erro: L494 - incidentes.js</p></div>",
                                                    buttons: {
                                                        confirm: {
                                                            label: "Fechar",
                                                            className: "btn-danger",
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    } else {
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
                                    }
                                }
                            }
                        }
                    });
                } else {
                    // Se não conseguir executar, exibe a mensagem de erro
                    bootbox.dialog({
                        backdrop: true,
                        onEscape: function() {},
                        closeButton: true,
                        size: 'medium',
                        title: "Erro!",
                        message: "<div>"+retorno.mensagem+"</div>",
                        buttons: {
                            confirm: {
                                label: 'Fechar',
                                className: 'btn-danger',
                            }
                        }
                    });
                }
            },
            error: function(erro) {
                alert("Não foi possível efetuar a operação, por favor tente novamente. L500 - incidentes.js");
            }
        });
    });

    $('.acessaIncidente').on('click', function(){
        var idIncidente = $(this).attr('attr-idIntIssue');
        acessaIncidente(idIncidente);
    });
    
    $('.editaIncidente').on('click', function(){
        var numIntIssue = $(this).attr('attr-idintissue');
        editaIncidente(numIntIssue);
    });

    $('.deletaIncidente').on('click', function(){
        var numIntIssue = $(this).attr('attr-idintissue');
        deletaIncidente(numIntIssue);
    });

    //ajax para acessar os incidentes
    function acessaIncidente(idIncidente){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/incidentes/controller/controller_incidentes.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'acessaIncidente', 
                idIncidente: idIncidente
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1){                 
                    bootbox.dialog({
                        backdrop: true,
                        className: "modalAcessaIncidente",
                        onEscape: function() {},
                        closeButton: true,
                        size: 'large',
                        title: "Incidente " + idIncidente,
                        message: retorno.mensagem,
                        buttons: {
                            confirm: {
                                label: "Fechar",
                                className: "btn-primary",
                            }
                        }
                    });
                }
                else{
                    alert("Incidente "+idIncidente+" não localizado. Erro L597 - incidente.js");
                }
            },
            error: function(erro) {
                alert("Incidente "+idIncidente+" não localizado. Erro L601 - incidente.js");
            }
        });
    }

    function editaIncidente(numIntIssue){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/incidentes/controller/controller_incidentes.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'montaTelaEditaIncidente',
                numIntIssue: numIntIssue
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    bootbox.dialog({
                        backdrop: true,
                        onEscape: function() {},
                        closeButton: true,
                        size: 'large',
                        title: "Editar incidente",
                        message: "<div>"+retorno.mensagem+"</div>",
                        buttons: {
                            cancel: {
                                label: 'Fechar',
                                className: 'btn-danger',
                            },
                            confirm: {
                                label: 'Gravar',
                                className: 'btn-success btnEditaIncidente',
                                callback: function() {
                                    var idIncidenteBd = $('#numIntIssueEditaIncidente').attr('attr-idincidente');
                                    var tipoIncidente = $("#tipoIncidenteEditaIncidente").val();
                                    var numIntIssue = $('#numIntIssueEditaIncidente').val();
                                    var dataAbertura = $('#dataAberturaEditaIncidente').val();
                                    var horaAbertura = $('#horarioAberturaEditaIncidente').val();
                                    var motivo = $('#motivoEditaIncidente').val();
                                    var ambiente = $('#selectAmbienteEditaIncidente').val();
                                    
                                    // var status = $('#selectStatusEditaIncidente').val();
                                    var status = $("#selectStatusEditaIncidente option:selected").text();
                                    var dependencia = $('#numDependenciaEditaIncidente').val();
                                    var dataEncerramento = $('#dataEncerramentoEditaIncidente').val();
                                    var horaEncerramento = $('#horarioEncerramentoEditaIncidente').val();
                                    var observacao = $('#observacaoEditaIncidente').val();
                                    var responsavel = $('#inputResponsavelEditaIncidente').val();

                                    var dataAgora = new Date();
                                    var ano = dataAgora.getFullYear();
                                    var mes = (dataAgora.getMonth())+1;
                                    var dia = dataAgora.getDate();
                                    var hora = dataAgora.getHours();
                                    var minutos = dataAgora.getMinutes();

                                    if(mes > 8){
                                        mes = '1'+mes;
                                    } else {
                                        mes = '0'+mes;
                                    }

                                    if(dia > 9){
                                        dia = dia;
                                    } else {
                                        dia = '0'+dia;
                                    }

                                    if (hora < 10) {
                                        hora = '0'+hora;
                                    }

                                    if (minutos < 10) {
                                        minutos = '0'+minutos;
                                    }

                                    var dataEditada = ano+"-"+mes+"-"+dia+" "+hora+":"+minutos;
                                    var dataEditadaExibicao = dia+"/"+mes+"/"+ano+" "+hora+":"+minutos;

                                    var formData = new FormData();
                                    var mensagemErro = "Atenção: <br><br>";
                                    var contaErros = 0;

                                    if(tipoIncidente == 0){
                                        mensagemErro = mensagemErro+"-Selecionar o tipo de incidente;<br>";
                                        contaErros = ++contaErros;
                                    }
                                    
                                    if(numIntIssue.length == 0){
                                        mensagemErro = mensagemErro+"-Informar nº INT/Issue;<br>";
                                        contaErros = ++contaErros;
                                    }
                                    
                                    if(dataAbertura.length == 0){
                                        mensagemErro = mensagemErro+"-Informar data de abertura;<br>";
                                        contaErros = ++contaErros;
                                    }

                                    if(horaAbertura.length == 0){
                                        mensagemErro = mensagemErro+"-Informar hora de abertura;<br>";
                                        contaErros = ++contaErros;
                                    }

                                    if(((dataAbertura.length > 0 && horaAbertura.length > 0) && (dataAbertura+' '+horaAbertura)) > dataEditada){
                                        mensagemErro = mensagemErro+"-Data e hora de abertura do incidente maior que o horário atual ("+dataEditadaExibicao+");<br>";
                                        contaErros = ++contaErros;
                                    }

                                    if(((dataEncerramento.length > 0 && horaEncerramento.length > 0) && (dataEncerramento+' '+horaEncerramento)) > dataEditada){
                                        mensagemErro = mensagemErro+"-Data e hora de encerramento do incidente maior que o horário atual ("+dataEditadaExibicao+");<br>";
                                        contaErros = ++contaErros;
                                    }

                                    if(ambiente == 0){
                                        mensagemErro = mensagemErro+"-Selecionar o ambiente;<br>";
                                        contaErros = ++contaErros;
                                    }
                                    
                                    if(status == "Status") {
                                        mensagemErro = mensagemErro+"-Informar o status do incidente;<br>";
                                        contaErros = ++contaErros;
                                    }

                                    if(dependencia.length == 0){
                                        mensagemErro = mensagemErro+"-Informar a dependência responsável;<br>";
                                        contaErros = ++contaErros;
                                    }

                                    if(status == "ENCERRADA" && (dataEncerramento.length == 0 || horaEncerramento.length == 0)){
                                        mensagemErro = mensagemErro+"-Para gravar o incidente com status 'Encerrada', é necessário informar a data e hora de encerramento;<br>";
                                        contaErros = ++contaErros;
                                    }

                                    if((dataEncerramento.length > 0 || horaEncerramento.length > 0) && status != "ENCERRADA"){
                                        mensagemErro = mensagemErro+"-Para informar a data e hora de encerramento é necessário alterar o status do incidente para 'Encerrada';<br>";
                                        contaErros = ++contaErros;
                                    }

                                    if((dataEncerramento.length > 0 && horaEncerramento.length > 0) && (dataEncerramento < dataAbertura) || ((dataEncerramento <= dataAbertura && horaEncerramento < horaAbertura)) && status == "ENCERRADA"){
                                        mensagemErro = mensagemErro+"-A data e hora de encerramento devem ser maiores que a data e hora de abertura;<br>";
                                        contaErros = ++contaErros;
                                    }

                                    mensagemErro = mensagemErro.substring(0, mensagemErro.length-5)+".";

                                    if(contaErros == 0){
                                        formData.append("request","editaIncidente");
                                        formData.append("idIncidenteBd", idIncidenteBd);
                                        formData.append("tipoIncidente", tipoIncidente);
                                        formData.append("numIntIssue", numIntIssue.replace(/[\\']/g, '"'));
                                        formData.append("dataAbertura", dataAbertura);
                                        formData.append("horaAbertura", horaAbertura);
                                        if(motivo == null){
                                            formData.append("motivo", '');
                                        } else {
                                            formData.append("motivo", motivo.replace(/[\\']/g, '"'));
                                        }
                                        formData.append("ambiente", ambiente);
                                        formData.append("status", status);
                                        formData.append("dependencia", dependencia.replace(/[\\']/g, '"'));
                                        formData.append("dataEncerramento", dataEncerramento);
                                        formData.append("horaEncerramento", horaEncerramento);
                                        if(observacao.length == null){
                                            formData.append("observacao", '');
                                        } else {
                                            formData.append("observacao", observacao.replace(/[\\']/g, '"'));
                                        }
                                        if(responsavel.length == null){
                                            formData.append("responsavel", '');
                                        } else {
                                            formData.append("responsavel", responsavel.replace(/[\\']/g, '"'));
                                        }

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
                                                                className: "btn-success"
                                                            }
                                                        },
                                                    });
                                                    // consultaIncidentes();
                                                    pesquisaIncidentes(JSON.stringify(dicionarioPesquisa));
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
                                                    message: "<div><p>"+retorno.mensagem+"<br><br> Erro: L494 - incidentes.js</p></div>",
                                                    buttons: {
                                                        confirm: {
                                                            label: "Fechar",
                                                            className: "btn-danger",
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    } else {
                                        bootbox.dialog({
                                            backdrop: true,
                                            onEscape: function() {},
                                            // closeButton: true,
                                            size: "medium",
                                            title: "Atenção",
                                            message: "<div>"+mensagemErro+"</div>",
                                            buttons: {
                                                confirm: {
                                                    label: "Fechar",
                                                    className: "btn-warning",
                                                }
                                            }
                                        });
                                        return false;
                                    }
                                }
                            }
                        }
                    });
                } else {
                    // Se não conseguir executar, exibe a mensagem de erro
                    bootbox.dialog({
                        backdrop: true,
                        onEscape: function() {},
                        closeButton: true,
                        size: 'medium',
                        title: "Erro!",
                        message: "<div>"+retorno.mensagem+"</div>",
                        buttons: {
                            confirm: {
                                label: 'Fechar',
                                className: 'btn-danger',
                            }
                        }
                    });
                }
            },
            error: function(erro) {
                alert("Não foi possível efetuar a operação, por favor tente novamente. L726 - incidentes.js");
            }
        });
    }

    function deletaIncidente(numIntIssue){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/incidentes/controller/controller_incidentes.php';
        bootbox.dialog({
            backdrop: true,
            onEscape: function() {},
            closeButton: true,
            size: 'medium',
            title: "Deletar incidente",
            message: "<div>Deseja deletar o incidente "+numIntIssue+"?</div>",
            buttons: {
                confirm: {
                    label: 'Sim',
                    className: 'btn-success',
                    callback: function() {
                        var formData = new FormData();
                        formData.append("request","deletaIncidente");
                        formData.append("numIntIssue", numIntIssue);

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
                                    consultaIncidentes();
                                    limparCampos();
                                } else {
                                    // Se não conseguir deletar, exibe a mensagem de erro
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
                                    message: "<div><p>"+retorno.mensagem+"<br><br> Erro: L590 - incidentes.js</p></div>",
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
                },
                cancel: {
                    label: 'Não',
                    className: 'btn-danger',
                }
            }
        });
    }

    function limparCampos() {
        $("#campoNumIntIssue").val('');
        $("#campoNumIntIssue").attr('attr-campoalterado', '0');

        $("#campoTipoIncidente").val('Tipo de incidente');
        $("#campoTipoIncidente").attr('attr-campoalterado', '0');

        $("#campoStatusIncidente").val('Status');
        $("#campoStatusIncidente").attr('attr-campoalterado', '0');

        $("#campoAmbiente").val('Ambiente');
        $("#campoAmbiente").attr('attr-campoalterado', '0');

        $("#campoDependencia").val('Dependência Abertura');
        $("#campoDependencia").attr('attr-campoalterado', '0');

        $("#dataAbertura").val('');
        $("#dataAbertura").attr('attr-campoalterado', '0');

        $("#dataEncerramento").val('');
        $("#dataEncerramento").attr('attr-campoalterado', '0');
    }

    // function consultaIncidentesCadastrados(numIntIssue){
    //     var caminhoController = 'https://cad.bb.com.br/lib/apps/incidentes/controller/controller_incidentes.php';
    //     var result;
    //     $.ajax({
    //         aSync: false,
    //         url: caminhoController,
    //         data: {
    //             request: 'consultaIncidentesCadastrados', 
    //             numIntIssue: numIntIssue
    //         },
    //         type: "POST",
    //         dataType: "JSON",
    //         dataSrc: "",
    //         success: function(retorno) {
    //             result = retorno.status;
    //             return(result);
    //         },
    //         error: function(erro) {
    //             alert("Não foi possível consultar os incidentes registrados para validação do número informado - L1043 - incidentes.js");
    //         }
    //     });
    // }

    function consultaIncidentesCadastrados(numIntIssue) {
        var caminhoController = 'https://cad.bb.com.br/lib/apps/incidentes/controller/controller_incidentes.php';
        
        return new Promise((resolve, reject) => {
            $.ajax({
                async: true,
                url: caminhoController,
                data: {
                    request: 'consultaIncidentesCadastrados',
                    numIntIssue: numIntIssue
                },
                type: "POST",
                dataType: "JSON",
                success: function(retorno) {
                    resolve(retorno.status);
                },
                error: function(erro) {
                    alert("Não foi possível consultar os incidentes registrados para validação do número informado - L1043 - incidentes.js");
                    reject(erro);
                }
            });
        });
    }
    
});