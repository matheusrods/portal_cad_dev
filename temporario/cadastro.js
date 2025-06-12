$(document).ready(function() {
    $('#tableEditarIndisp').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
        ]
    });
    $('#tableHistIndisp').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
        ]
    });
    $('#tableHistNoticias').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
        ]
    });
    $('#tableHistDestaque').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
        ]
    });

    //controle dos campos que serão disponibilizados quando se altera a seleção do select box de tipo de informação a ser gravada no report
    $("#tipoReport").change(function() {
        var opcaoSelecionada = $("#tipoReport option:selected").attr('val');
        if (opcaoSelecionada == 'destaques'){
            $("#divTableEditarIndisp").css('display','none');
            $("#divTableHistIndisp").css('display','none');
            $("#divTableHistDestaque").css('display','none');
            $("#divTableHistNoticias").css('display','none');
            $("#squad").removeAttr("disabled");
            $("#divUrl").css('display','block');
            $("#divSquad").css('display','block');
            $("#divDataFim").css('display','none');
            $("#divVigente").css('display','none');
            $("#mesa").css('display', 'block');
            $("#labelDataIni").text("Data");
            $("#divFalhaCad").css('display','none');
            $("#divNumeroTicket").css('display','none');
            $("#divTitulo").css('display','none');
        } else if (opcaoSelecionada == 'noticias'){
            $("#divTableEditarIndisp").css('display','none');
            $("#divTableHistIndisp").css('display','none');
            $("#divTableHistDestaque").css('display','none');
            $("#divTableHistNoticias").css('display','none');
            $("#divUrl").css('display','block');
            $("#divSquad").css('display','none');
            $("#divDataFim").css('display','none');
            $("#divVigente").css('display','none');
            $("#mesa").css('display', 'block');
            $("#labelDataIni").text("Data");
            $("#divFalhaCad").css('display','none');
            $("#divNumeroTicket").css('display','none');
            $("#divTitulo").css('display','none');
        } else if (opcaoSelecionada == 'indisponibilidades') {
            
            veAi = $.ajax({
                    aSync: true,
                    url: 'https://cad.bb.com.br/temporario/controllerCadastro.php',
                    data: {
                        request: 'verificaIndisponibilidade7dias'
                    },
                    type: "GET",
                    dataType: "JSON",
                    dataSrc: "",
                    
                    success: function(retorno) {
                        if(retorno == 1){
                            bootbox.dialog({
                                backdrop: true,
                                onEscape: function() {},
                                closeButton: true,
                                size: 'medium',
                                title: "Atenção!",
                                message: "<div><h3>Existem indisponibilidades cadastradas há mais de 7 dias.</h3><br><p>Deseja verificar agora?</p></div>",
                                buttons: {
                                    confirm: {
                                        label: 'Consultar',
                                        className: 'btn-success',
                                        callback: function(){$("#tipoReport").val("Editar Indisponibilidade").trigger('change')}
                                    },
                                    cancel: {
                                        label: 'Cancelar',
                                        className: 'btn-danger',
                                        callback: function(){
                                            $("#divTableEditarIndisp").css('display','none');
                                            $("#divTableHistIndisp").css('display','none');
                                            $("#divTableHistDestaque").css('display','none');
                                            $("#divTableHistNoticias").css('display','none');
                                            $("#vigente").removeAttr("disabled");
                                            $("#divUrl").css('display','none');
                                            $("#divSquad").css('display','none');
                                            $("#divDataFim").css('display','block');
                                            $("#divFalhaCad").css('display','block');
                                            // $("#divNumeroTicket").css('display','none');
                                            $("#divVigente").css('display','block');
                                            $("#mesa").css('display', 'block');
                                            $("#divTitulo").css('display','block');
                                            $("#labelDataIni").text ("Data Início");
                                        }
                                    }
                                }
                            });
                        } else{
                            $("#divTableEditarIndisp").css('display','none');
                            $("#divTableHistIndisp").css('display','none');
                            $("#divTableHistDestaque").css('display','none');
                            $("#divTableHistNoticias").css('display','none');
                            $("#vigente").removeAttr("disabled");
                            $("#divUrl").css('display','none');
                            $("#divSquad").css('display','none');
                            $("#divDataFim").css('display','block');
                            $("#divFalhaCad").css('display','block');
                            // $("#divNumeroTicket").css('display','block');
                            $("#divVigente").css('display','block');
                            $("#mesa").css('display', 'block');
                            $("#labelDataIni").text ("Data Início");
                            $("#divTitulo").css('display','block');
                        }
                        
                    },
                    error: function(erro) {
                        alert("Não foi possível efetuar a operação, por favor tente novamente. L321 - temporario\cadastro.js");
                    }
                });
            ;
            
        } else if (opcaoSelecionada == 'editIndisp') {
            consultaIndispAtivas();
            $("#mesa").css('display','none');
            $("#divTableEditarIndisp").css('display','block');
            $("#divTableHistIndisp").css('display','none');
            $("#divTableHistDestaque").css('display','none');
            $("#divTableHistNoticias").css('display','none');
            $("#divFalhaCad").css('display','none');
            $("#divNumeroTicket").css('display','none');
            $("#divTitulo").css('display','none');
        } else if (opcaoSelecionada == 'histIndisp') {
            consultaHistIndisp();
            $("#mesa").css('display','none');
            $("#divTableEditarIndisp").css('display','none');
            $("#divTableHistIndisp").css('display','block');
            $("#divTableHistDestaque").css('display','none');
            $("#divTableHistNoticias").css('display','none');
            $("#divFalhaCad").css('display','none');
            $("#divNumeroTicket").css('display','none');
            $("#divTitulo").css('display','none');
        } else if (opcaoSelecionada == 'histDestaques') {
            $("#mesa").css('display','none');
            $("#divTableEditarIndisp").css('display','none');
            $("#divTableHistIndisp").css('display','none');
            $("#divTableHistDestaque").css('display','block');
            $("#divTableHistNoticias").css('display','none');
            $("#divFalhaCad").css('display','none');
            $("#divNumeroTicket").css('display','none');
            $("#divTitulo").css('display','none');
            consultaHistDestaques();
        } else if (opcaoSelecionada == 'histNoticias') {
            consultaHistNoticias();
            $("#mesa").css('display','none');
            $("#divTableEditarIndisp").css('display','none');
            $("#divTableHistIndisp").css('display','none');
            $("#divTableHistDestaque").css('display','none');
            $("#divTableHistNoticias").css('display','block');
            $("#divFalhaCad").css('display','none');
            $("#divNumeroTicket").css('display','none');
            $("#divTitulo").css('display','none');
        } else {
            $("#mesa").css('display','none');
            $("#divTableEditarIndisp").css('display','none');
            $("#divTableHistIndisp").css('display','none');
            $("#divTableHistDestaque").css('display','none');
            $("#divTableHistNoticias").css('display','none');
            $("#divFalhaCad").css('display','none');
            $("#divNumeroTicket").css('display','none');
            $("#divTitulo").css('display','none');
        }
    }).trigger('change');

    //salva o último valor diferente de nulo preenchido no campo "Data Fim" para preencher automaticamente caso se altere o select "Vigente" de "Sim" para "Não"
    $("#dataFim").change(function(){
        var dataPreenchida = $("#dataFim").val();
        if((dataPreenchida.length) > 0) {
            var dataPreenchida = $("#dataFim").val();
            $("#vigente").attr("attr-dataPreenchida", dataPreenchida);
        }
    });

    // controle do campo "vigente"
    $("#vigente").change(function() {
        
        var vigenteSelecionada = $("#vigente option:selected").attr('val');

        if (vigenteSelecionada == 0){
            var dataPreenchida = $("#vigente").attr("attr-dataPreenchida");
            $("#dataFim").val(dataPreenchida);
            $("#dataFim").removeAttr("disabled");
        } else {
            $("#dataFim").attr("disabled", "disabled");
            $("#dataFim").val(null);
        }
    }).trigger('change');

    // controle do campo "nº ticket"
    $("#falhaCad").change(function() {
        var falhaCad = $("#falhaCad option:selected").attr('val');
        if (falhaCad == 1){
            $("#divNumeroTicket").css('display','block');
            $("#numeroTicket").removeAttr("disabled");
            $(".radioTipoTicket").removeAttr("disabled");
        } else {
            $("#divNumeroTicket").css('display','none');
            $("#numeroTicket").attr("disabled", "disabled");
            $(".radioTipoTicket").attr("disabled", "disabled");
        }
    }).trigger('change');

    // $(".editaIndisp").click(function(){
    //     var idIndisp = $(this).attr('val');
    //     editarIndisponibilidade(idIndisp);
    // });

    $("#tableEditarIndisp").on('click', ".editaIndisp", function(){
        var idIndisp = $(this).attr('val');
        editarIndisponibilidade(idIndisp);
    });

    // controle dos valores de variáveis e que dispara a gravação das mesmas em BD
    $('#gravar').click(function(){
        var titulo = $("#tituloIndisponibilidade").val();
        var texto = $("#indisponibilidade").val();
        var url = $("#url").val();
        var dataIni = $("#dataIni").val();
        var dataFim = $("#dataFim").val();
        var vigente = $("#vigente option:selected").attr("val");
        var falhaCad = $("#falhaCad option:selected").attr("val");
        var ferramentaTicket = $('input[name=ferramentaTicket]:checked', '#divNumeroTicket').val();
        var numeroTicket = $("#numeroTicket").val();
        var tipoReport = $("#tipoReport option:selected").attr("val");
        var squad = $("#squad option:selected").attr("val");

        // tratamento de data para não gravar uma data posterior à atual
        var d = new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var dataHoje = d.getFullYear() + '-' +
            ((''+month).length<2 ? '0' : '') + month + '-' +
            ((''+day).length<2 ? '0' : '') + day;
        
        if(dataHoje < dataIni){
            if(tipoReport == 'indisponibilidades'){
                alert('Data de início maior que a atual!');
            } else {
                alert('Data digitada maior que a atual!');
            }
            
            return false;
        }

        if(dataHoje < dataFim){
            alert('Data de fim da indisponibilidade maior que a atual!');
            return false;
        }
        
        if(tipoReport == 'destaques'){
            vigente = null;
            dataFim = null;
            falhaCad = null;
            ferramentaTicket = null;
            numeroTicket = null;
            titulo = null;

            if(texto == '' || dataIni == '' || squad === undefined){
                alert('Preencher todos os dados!');
                return false;
            }
        }

        if(tipoReport == 'noticias'){
            vigente = null;
            dataFim = null;
            squad = null;
            falhaCad = null;
            ferramentaTicket = null;
            numeroTicket = null;
            titulo = null;

            if(texto == '' || dataIni == '' || url == ''){
                alert('Preencher todos os dados!');
                return false;
            }
        }

        if(tipoReport == 'indisponibilidades'){
            squad = null;
            if(
                (texto == '' || dataIni == '' || vigente === undefined || titulo == '') || 
                (vigente == '0' && dataFim == '') || 
                (falhaCad === undefined) || 
                (falhaCad == '1' && (numeroTicket == '' || ferramentaTicket === undefined))){
                    alert('Preencher todos os dados!');
                    return false;
            }
            if(dataFim.length > 0 && dataIni > dataFim){
                alert("Data de início maior que data fim!");
                return false;                
            }
            titulo = titulo.replace(/'/g, "\\'");
        }
        
        texto = texto.replace(/'/g, "\\'");

        gravaTexto(titulo, texto, url, squad, falhaCad, ferramentaTicket, numeroTicket, dataIni, dataFim, vigente, tipoReport);
    });

    // botão que limpa o formulário
    $("#container #reset").click(function() {
        $("#container :text").val("");
        $("#container :input").val("");
        $("#container select").removeAttr('selected');
        $("#contaCaracteres").text('200');
        $("#contaCaracteresTitulo").text('50');
        $("#mesa").css('display','none');
        $('input[name=ferramentaTicket]:checked').prop('checked',false);
        $("#divNumeroTicket").css('display','none');
    });
});

// função de gravação das informações do formulário
function gravaTexto(titulo, texto, url, squad, falhaCad, ferramentaTicket, numeroTicket, dataIni, dataFim, vigente, tipoReport){
    
    var caminhoController = 'https://cad.bb.com.br/temporario/controllerCadastro.php';
    var titulo = titulo;
    var texto = texto;
    var url = url;
    var squad = squad;
    var falhaCad = falhaCad;
    var ferramentaTicket = ferramentaTicket;
    var numeroTicket = numeroTicket;
    var dataIni = dataIni;
    var dataFim = dataFim;
    var vigente = vigente;
    var tipoReport = tipoReport;
    
    $.ajax({
        url: caminhoController,
        data: {
            request: 'gravaTexto',
            titulo:titulo,
            texto:texto,
            url:url,
            squad:squad,
            falhaCad:falhaCad,
            ferramentaTicket:ferramentaTicket,
            numeroTicket:numeroTicket,
            dataIni:dataIni,
            dataFim:dataFim,
            vigente:vigente,
            tipoReport:tipoReport
        },
        type: 'POST',
        dataType:'json',
        success: function(retorno) {
            
            if (retorno.status == 1) {
                // Se conseguir incluir com sucesso, exibe a mensagem de aviso
                bootbox.dialog({
                    backdrop: true,
                    onEscape: function() {},
                    closeButton: true,
                    size: 'medium',
                    title: "Sucesso!",
                    message: "<div>"+retorno.mensagem+"</div>",
                    buttons: {
                        confirm: {
                            label: 'OK',
                            className: 'btn-success',
                            callback: $('#reset').trigger('click')
                        }
                    }
                    
                });
            } else {
                // Se não conseguir gravar, exibe a mensagem de erro
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
            alert("Não foi possível efetuar a operação, por favor tente novamente. L183 - temporario/cadastro.js");
        }
    });
}

function consultaIndispAtivas(){
    var caminhoController = 'https://cad.bb.com.br/temporario/controllerCadastro.php';
    $.ajax({
        aSync: true,
        url: caminhoController,
        data: {
            request: 'consultaIndispAtivas'
        },
        type: "GET",
        dataType: "JSON",
        dataSrc: ""
    });
};

// function verificaIndisponibilidade7dias(){
//     var caminhoController = 'https://cad.bb.com.br/temporario/controllerCadastro.php';
//     $.ajax({
//         aSync: false,
//         url: caminhoController,
//         data: {
//             request: 'verificaIndisponibilidade7dias'
//         },
//         type: "GET",
//         dataType: "text",
        
//         success: function(retorno) {
//             if (retorno == 1) {
//                 return "Sim";
//             } else {
//                 return "Não";
//             }
//         },
//         error: function(erro) {
//             alert("Não foi possível efetuar a operação, por favor tente novamente. L321 - temporario\cadastro.js");
//         }
//     });
// };

function consultaHistIndisp(){
    var caminhoController = 'https://cad.bb.com.br/temporario/controllerCadastro.php';
    $.ajax({
        aSync: true,
        url: caminhoController,
        data: {
            request: 'consultaHistIndisp'
        },
        type: "POST",
        dataType: "JSON",
        dataSrc: "",
        success: function(data) {                    
            $("#tableHistIndisp tbody").html(data);
        }
    });
};

function consultaHistNoticias(){
    var caminhoController = 'https://cad.bb.com.br/temporario/controllerCadastro.php';
    $.ajax({
        aSync: true,
        url: caminhoController,
        data: {
            request: 'consultaHistNoticias'
        },
        type: "POST",
        dataType: "JSON",
        dataSrc: "",
        success: function(data) {
            $("#tableHistNoticias tbody").html(data);
        }
    });
};

function consultaHistDestaques(){
    var caminhoController = 'https://cad.bb.com.br/temporario/controllerCadastro.php'; 
    
    $.ajax({
        aSync: true,
        url: caminhoController,
        data: {
            request: 'consultaHistDestaques'
        },
        type: "POST",
        dataType: "JSON",
        dataSrc: "",
        success: function(data) {                    
            $("#tableHistDestaque tbody").html(data);
        }
    });
};

function editarIndisponibilidade(idIndisp){
    var caminhoController = 'https://cad.bb.com.br/temporario/controllerCadastro.php';
    
    // var dataFimEdit = $('#idDataFimEdit').val();
    $.ajax({
        url: caminhoController,
        data: {
            request: 'editarIndisponibilidade',
            idIndisp: idIndisp
        },
        type: "POST",
        dataType: "JSON",
        success: function(retorno) {
            
            if (retorno.status == 1) {
                // Se conseguir incluir com sucesso, exibe a mensagem de aviso
                bootbox.dialog({
                    aSync: true,
                    backdrop: true,
                    onEscape: function() {},
                    closeButton: true,
                    size: 'large',
                    title: "Sucesso!",
                    message: "<div style='display:flex;justify-content:center;align-items:center;'>"+retorno.mensagem+"</div>",
                    buttons: {
                        confirm: {
                            label: 'Gravar',
                            className: 'btn-success',
                            callback: function(){
                                var dataIni = $('#tableEditIndisp #dataIni').attr('attr-dataini');
                                var dataFimEdit = $('#dataFimEdit').val();
                                var textoTituloEditaIndisp = $('#textoTituloEditaIndisp').val();
                                var textoDescricaoEditaIndisp = $('#textoDescricaoEditaIndisp').val();
                                // if(dataFimEdit == ''){
                                //     alert('Preencha a data de fim da indisponibildiade!');
                                //     return false;
                                // }

                                if(dataFimEdit.length > 0 && (dataFimEdit < dataIni)){
                                    alert('Data de fim menor que a data de início!');
                                    return false;
                                }
                                
                                gravaDataFimIndisp(textoTituloEditaIndisp, textoDescricaoEditaIndisp, idIndisp, dataFimEdit);
                            }
                        }, cancel: {
                            label: 'Cancelar',
                            className: 'btn-danger'
                        }
                    }
                });
            } else {
                // Se não conseguir gravar, exibe a mensagem de erro
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
            alert("Não foi possível efetuar a operação, por favor tente novamente. L277 - temporario\cadastro.js");
        }
    });
};

function gravaDataFimIndisp(textoTituloEditaIndisp, textoDescricaoEditaIndisp, idIndisp, dataFim){
    var caminhoController = 'https://cad.bb.com.br/temporario/controllerCadastro.php';
    $.ajax({
        url: caminhoController,
        data: {
            request: 'gravaDataFimIndisp',
            idIndisp: idIndisp,
            textoTituloEditaIndisp: textoTituloEditaIndisp,
            textoDescricaoEditaIndisp: textoDescricaoEditaIndisp,
            dataFim: dataFim
        },
        type: "POST",
        dataType: "JSON",
        success: function(retorno) {
            
            if (retorno.status == 1) {
                // Se conseguir incluir com sucesso, exibe a mensagem de aviso
                bootbox.dialog({
                    aSync: true,
                    backdrop: true,
                    onEscape: function() {},
                    closeButton: true,
                    size: 'large',
                    title: "Sucesso!",
                    message: "<div style='display:flex;justify-content:center;align-items:center;'>"+retorno.mensagem+"</div>",
                    buttons: {
                        confirm: {
                            label: 'Gravar',
                            className: 'btn-success',
                            callback: function(){
                                // $('#tableIndisp').DataTable().ajax.reload(null, false);
                                $('#tituloEditado_'+idIndisp).text(textoTituloEditaIndisp);
                                $('#textoEditado_'+idIndisp).text(textoDescricaoEditaIndisp);
                                $('#tdDataFim_'+idIndisp).text(dataFim);
                            }
                        }
                    }
                });
            } else {
                // Se não conseguir gravar, exibe a mensagem de erro
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
            alert("Não foi possível efetuar a operação, por favor tente novamente. L277 - temporario\cadastro.js");
        }
    });
};

//Função de contagem de caracteres no campo Descrição
function countChar(val) {
    var len = val.value.length;
    if (len > 200) {
        val.value = val.value.substring(-1, 200);
    } else {
        $('#contaCaracteres').text(200 - len);
    }
};

function countChar2(val) {
    var len = val.value.length;
    if (len > 100) {
        val.value = val.value.substring(-1, 100);
    } else {
        $('#contaCaracteresTitulo').text(100 - len);
    }
};
