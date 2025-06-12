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

    $('#incluirNovosConteudos').on('click', function(){
        $('.formNovoConteudoBot').css('display', 'block');
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


    $('#radioJornadaInformacionalPFEditar').on('click', function(){
        $('.divSolicitacaoJornadaInformacionalPF').css('display', 'block');
    });




/*###########################*/



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

    $('#divIconeInterrogaTransacao').on('click', function(){
        $('#divAvisoJornadaTransacaoPF').css('display', 'block');
    });

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