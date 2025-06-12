$(document).ready(function() {
    
    // A class abreDivNestRecurso contém 4 notícias lado a lado. A linha abaixo faz com que apareça apenas uma linha com 4 notícias ao carregar a página
    $(".abreDivNestRecurso").slice(0, 1).show();
    
    // Funções ao clicar no botão "Ver Mais"
    $(".botaoVerMaisRecursos").on('click', function (event) {
        var qtasDivsOcultas = ($(".abreDivNestRecurso:hidden").length);
        if(qtasDivsOcultas == 1){
            $(".botaoVerMaisRecursos").fadeOut('fast');
        }
        // Verifica o atributo "Número Sequencial" do botão, que é utilizado para fazer mostrar a próxima linha de notícias (cada linha possui um atributo que é sua sequência)
        var numeroSequencial = Number($(this).attr('attr-sequencia'));
        var novoSequencial = numeroSequencial + 1;
        
        $(this).attr('attr-sequencia', novoSequencial);
        $("div.abreDivNestRecurso:hidden").slice(0, 1).show();
        $(".abreDivNestRecurso[attr-sequencia="+novoSequencial+"]").css('display', 'inline-flex');
        
        target_offset = $(".abreDivNestRecurso[attr-sequencia="+novoSequencial+"]").offset(),
        target_top = target_offset.top;
        
        $('html,body').animate({
            scrollTop: target_top-80
        }, 250);
    });

    // Interações dos botões de filtros
    // $('.botoesFiltroTema').on('click', function(e){
    //     $('.inputCampoPesquisa').val('');
    //     var idTema = $(this).attr('attr-id');
    //     var filtroAtivo = $(this).attr('attr-filtroAtivo');
    //     if($('.botaoVerMaisRecursos:hidden')){
    //         $(".botaoVerMaisRecursos").fadeIn('fast');
    //     }
        
    //     if(filtroAtivo == '0'){
    //         $('#temaRecursos'+idTema+'').css('background', '#FDF429');
    //         $('#temaRecursos'+idTema+'').attr('attr-filtroAtivo', '1');
    //         $('.botaoVerMaisRecursos').attr('attr-sequencia', '1');
    //     } else{
    //         $('#temaRecursos'+idTema+'').css('background', '#E4ECFF');
    //         $('#temaRecursos'+idTema+'').attr('attr-filtroAtivo', '0');
    //         $('.botaoVerMaisRecursos').attr('attr-sequencia', '1');
    //     }
    //     var arr=[];
    //     $("div[attr-filtroAtivo='1']").each(function(){
 	//     	arr.push($(this).attr('attr-id'));
    // 	});
    //     if(arr.length > 0){
    //         // filtraRecursosTema(arr);
    //         consultaRecursos(arr);
    //     } else {
    //         var idTema = [];
    //         consultaRecursos(idTema);
    //         if($('.botaoVerMaisRecursos').css('display') == 'none'){
    //             $(".botaoVerMaisRecursos").fadeIn('fast');
    //         }
    //     }
    // });


    $(document).unbind().on('click', '.botoesFiltroTema', function() {
        $('.inputCampoPesquisa').val('');
        var idTema = $(this).attr('attr-id');
        var filtroAtivo = $(this).attr('attr-filtroAtivo');
        if($('.botaoVerMaisRecursos:hidden')){
            $(".botaoVerMaisRecursos").fadeIn('fast');
        }
        
        if(filtroAtivo == '0'){
            $('#temaRecursos'+idTema+'').css('background', '#FDF429');
            $('#temaRecursos'+idTema+'').attr('attr-filtroAtivo', '1');
            $('.botaoVerMaisRecursos').attr('attr-sequencia', '1');
        } else{
            $('#temaRecursos'+idTema+'').css('background', '#E4ECFF');
            $('#temaRecursos'+idTema+'').attr('attr-filtroAtivo', '0');
            $('.botaoVerMaisRecursos').attr('attr-sequencia', '1');
        }
        var arr=[];
        $("div[attr-filtroAtivo='1']").each(function(){
 	    	arr.push($(this).attr('attr-id'));
    	});
        if(arr.length > 0){
            // filtraRecursosTema(arr);
            consultaRecursos(arr);
        } else {
            var idTema = [];
            consultaRecursos(idTema);
            if($('.botaoVerMaisRecursos').css('display') == 'none'){
                $(".botaoVerMaisRecursos").fadeIn('fast');
            }
        }
    });

    // Executa a pesquisa para o termo digitado clicando no botão "pesquisar"
    $('.botaoCampoPesquisa').on('click', function(){
        var textoDigitado = $('.inputCampoPesquisa').val();
        if(textoDigitado.length == 0){
            bootbox.dialog({
                backdrop: true,
                onEscape: function() {},
                // closeButton: true,
                size: 'small',
                title: "Atenção",
                message: 'Digite um texto válido.',
                buttons: {
                    confirm: {
                        label: 'OK',
                        className: 'btn-success',
                    }
                }
            });
            return false;
        }
        
        if($('.botaoVerMaisRecursos:hidden')){
            $(".botaoVerMaisRecursos").fadeIn('fast');
        }
        
        pesquisaRecursos(textoDigitado);
    });

    $('.botaoAdicionaRecurso').unbind().on('click', function(){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/recursos/controller/controller_recursos.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'paginaAdicionaRecurso'
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    bootbox.dialog({
                        className: 'limitaAltura',
                        backdrop: true,
                        onEscape: function() {},
                        // closeButton: true,
                        size: 'large',
                        title: "Adicionar novo recurso",
                        message: retorno.mensagem
                    });

                } else {
                    // Se não conseguir pesquisar, exibe a mensagem de erro
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L166 - recursos.js");
            }
        });
    });

    // Limpeza dos campos de pesquisa e reset da página, ocultando eventuais notícias além da primeira linha que estejam aparecendo
    $('.botaoLimpaPesquisa').on('click', function(){
        if($('.botaoVerMaisRecursos:hidden')){
            $(".botaoVerMaisRecursos").fadeIn('fast');
        }
        $('.botoesFiltroTema').css('background', '#E4ECFF');
        $('.botaoVerMaisRecursos').attr('attr-sequencia', '1');
        $('.inputCampoPesquisa').val('');
        $('.botoesFiltroTema').attr('attr-filtroativo', '0');
        var idTema = [];
        consultaRecursos(idTema);
        consultaTemas();
    });

    // Executa a pesquisa para o termo digitado apertando o enter no teclado
    $('.inputCampoPesquisa').keydown(function (e) {
        if (e.keyCode == 13) {
            var textoDigitado = $('.inputCampoPesquisa').val();
            if(textoDigitado.length == 0){
                bootbox.dialog({
                    backdrop: true,
                    onEscape: function() {},
                    // closeButton: true,
                    size: 'small',
                    title: "Atenção",
                    message: 'Digite um texto válido.',
                    buttons: {
                        confirm: {
                            label: 'OK',
                            className: 'btn-success',
                        }
                    }
                });
                return false;
            }
            
            if($('.botaoVerMaisRecursos:hidden')){
                $(".botaoVerMaisRecursos").fadeIn('fast');
            }
            pesquisaRecursos(textoDigitado);
        }
    });

    $(document).on('click', '.editarRecurso', function(){
        var idRecurso = $(this).attr('attr-idRecursoEditar');
        editaRecurso(idRecurso);
    });

    // Função ajax que consulta as notícias. A mesma função é utilizada para carregar as notícias tanto sem filtro como as filtradas por tema
    function consultaRecursos(idTema){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/recursos/controller/controller_recursos.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'consultaRecursos',
                idTema: idTema
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    $(".containerRecursos").html('');
                    $("div.containerRecursos").html(retorno.mensagem);
                    var qtasDivsOcultas = ($(".abreDivNestRecurso:hidden").length);
                    if(qtasDivsOcultas == 0){
                        $(".botaoVerMaisRecursos").fadeOut('fast');
                    }
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L172 - recursos.js");
            }
        });
    }

    // Função ajax que pesquisa as notícias baseada nos termos digitados na barra de pesquisa
    function pesquisaRecursos(textoDigitado){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/recursos/controller/controller_recursos.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'pesquisaRecursos',
                textoDigitado: textoDigitado
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    $(".containerRecursos").html('');
                    $('.botaoVerMaisRecursos').attr('attr-sequencia', '1');
                    $("div.containerRecursos").html(retorno.mensagem);
                    var qtasDivsOcultas = ($(".abreDivNestRecurso:hidden").length);
                    if(qtasDivsOcultas == 0){
                        $(".botaoVerMaisRecursos").fadeOut('fast');
                    }
                    $('.botoesFiltroTema').css('background', '#E4ECFF');
                    $('.botoesFiltroTema').attr('attr-filtroativo', '0');
                } else {
                    // Se não conseguir pesquisar, exibe a mensagem de erro
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L222 - recursos.js");
            }
        });
    }

    // Função ajax que consulta as notícias. A mesma função é utilizada para carregar as notícias tanto sem filtro como as filtradas por tema
    function consultaTemas(){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/recursos/controller/controller_recursos.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'consultaTemas'
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    $(".divBotoesFiltroTema").html('');
                    $(".divBotoesFiltroTema").html(retorno.mensagem);
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L266 - recursos.js");
            }
        });
    }
    
    // Função ajax que chama a janela de edição de recurso (título, descrição, arquivo do recurso, capa e tema)
    function editaRecurso(idRecurso){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/recursos/controller/controller_recursos.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'editaRecurso',
                idRecurso: idRecurso
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
                        title: "Editar recurso",
                        message: "<div>"+retorno.mensagem+"</div>",
                        buttons: {
                            cancel: {
                                label: 'Fechar',
                                className: 'btn-danger',
                            },
                            confirm: {
                                label: 'Gravar',
                                className: 'btn-success btnGravaEdicaoRecurso'
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L285 - recursos.js");
            }
        });
    }

    function gravaEdicaoRecurso(idRecurso){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/recursos/controller/controller_recursos.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'gravaEdicaoRecurso',
                idRecurso: idRecurso
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    
                } else {
                    // Se não conseguir pesquisar, exibe a mensagem de erro
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L332 - recursos.js");
            }
        });
    }
});