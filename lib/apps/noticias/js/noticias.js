$(document).ready(function() {
    
    // A class abreDivNestNoticia contém 4 notícias lado a lado. A linha abaixo faz com que apareça apenas uma linha com 4 notícias ao carregar a página
    $(".abreDivNestNoticia").slice(0, 1).show();
    
    // Funções ao clicar no botão "Ver Mais"
    $(".botaoVerMaisNoticias").on('click', function (event) {
        var qtasDivsOcultas = ($(".abreDivNestNoticia:hidden").length);
        if(qtasDivsOcultas == 1){
            $(".botaoVerMaisNoticias").fadeOut('fast');
        }
        // Verifica o atributo "Número Sequencial" do botão, que é utilizado para fazer mostrar a próxima linha de notícias (cada linha possui um atributo que é sua sequência)
        var numeroSequencial = Number($(this).attr('attr-sequencia'));
        var novoSequencial = numeroSequencial + 1;
        
        $(this).attr('attr-sequencia', novoSequencial);
        $("div.abreDivNestNoticia:hidden").slice(0, 1).show();
        $(".abreDivNestNoticia[attr-sequencia="+novoSequencial+"]").css('display', 'inline-flex');
        
        target_offset = $(".abreDivNestNoticia[attr-sequencia="+novoSequencial+"]").offset(),
        target_top = target_offset.top;
        
        $('html,body').animate({
            scrollTop: target_top-80
        }, 250);
    });

    // Interações dos botões de filtros de tema das notícias
    $('.botoesFiltroTema').click(function(e){
        $('.inputCampoPesquisa').val('');
        var idTema = $(this).attr('attr-id');
        var filtroAtivo = $(this).attr('attr-filtroAtivo');
        if($('.botaoVerMaisNoticias:hidden')){
            $(".botaoVerMaisNoticias").fadeIn('fast');
        }
        
        if(filtroAtivo == '0'){
            $('#temaNoticias'+idTema+'').css('background', '#FDF429');
            $('#temaNoticias'+idTema+'').attr('attr-filtroAtivo', '1');
            $('.botaoVerMaisNoticias').attr('attr-sequencia', '1');
        } else{
            $('#temaNoticias'+idTema+'').css('background', '#E4ECFF');
            $('#temaNoticias'+idTema+'').attr('attr-filtroAtivo', '0');
            $('.botaoVerMaisNoticias').attr('attr-sequencia', '1');
        }
        var arr=[];
        $("div[attr-filtroAtivo='1']").each(function(){
 	    	arr.push($(this).attr('attr-id'));
    	});
        if(arr.length > 0){
            // filtraNoticiasTema(arr);
            consultaNoticias(arr);
        } else {
            var idTema = [];
            consultaNoticias(idTema);
            if($('.botaoVerMaisNoticias').css('display') == 'none'){
                $(".botaoVerMaisNoticias").fadeIn('fast');
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
        
        if($('.botaoVerMaisNoticias:hidden')){
            $(".botaoVerMaisNoticias").fadeIn('fast');
        }
        
        pesquisaNoticias(textoDigitado);
    });

    // Limpeza dos campos de pesquisa e reset da página, ocultando eventuais notícias além da primeira linha que estejam aparecendo
    $('.botaoLimpaPesquisa').on('click', function(){
        if($('.botaoVerMaisNoticias:hidden')){
            $(".botaoVerMaisNoticias").fadeIn('fast');
        }
        $('.botoesFiltroTema').css('background', '#E4ECFF');
        $('.botaoVerMaisNoticias').attr('attr-sequencia', '1');
        $('.inputCampoPesquisa').val('');
        $('.botoesFiltroTema').attr('attr-filtroativo', '0');
        var idTema = [];
        consultaNoticias(idTema);
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
            
            if($('.botaoVerMaisNoticias:hidden')){
                $(".botaoVerMaisNoticias").fadeIn('fast');
            }
            pesquisaNoticias(textoDigitado);
        }
    });

    // Função ajax que consulta as notícias. A mesma função é utilizada para carregar as notícias tanto sem filtro como as filtradas por tema
    function consultaNoticias(idTema){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/noticias/controller/controller_noticias.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'consultaNoticias',
                idTema: idTema
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    $(".containerNoticias").html('');
                    $("div.containerNoticias").html(retorno.mensagem);
                    var qtasDivsOcultas = ($(".abreDivNestNoticia:hidden").length);
                    if(qtasDivsOcultas == 0){
                        $(".botaoVerMaisNoticias").fadeOut('fast');
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L172 - noticias.js");
            }
        });
    }

    // Função ajax que pesquisa as notícias baseada nos termos digitados na barra de pesquisa
    function pesquisaNoticias(textoDigitado){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/noticias/controller/controller_noticias.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'pesquisaNoticias',
                textoDigitado: textoDigitado
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    $(".containerNoticias").html('');
                    $('.botaoVerMaisNoticias').attr('attr-sequencia', '1');
                    $("div.containerNoticias").html(retorno.mensagem);
                    var qtasDivsOcultas = ($(".abreDivNestNoticia:hidden").length);
                    if(qtasDivsOcultas == 0){
                        $(".botaoVerMaisNoticias").fadeOut('fast');
                    }
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L222 - noticias.js");
            }
        });
    }
});