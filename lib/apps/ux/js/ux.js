$(document).ready(function() {
    
    // A class abreDivNestVideoUx contém 4 vídeos lado a lado. A linha abaixo faz com que apareça apenas uma linha com 4 notícias ao carregar a página
    $(".abreDivNestVideoUx").slice(0, 1).show();

    $('.carousel').carousel();

    // Funções ao clicar no botão "Ver Mais"
    $(".botaoVerMaisVideosUx").on('click', function (event) {
        var qtasDivsOcultas = ($(".abreDivNestVideoUx:hidden").length);
        
        if(qtasDivsOcultas == 1){
            $(".botaoVerMaisVideosUx").fadeOut('fast');
        }
        // Verifica o atributo "Número Sequencial" do botão, que é utilizado para fazer mostrar a próxima linha de notícias (cada linha possui um atributo que é sua sequência)
        var numeroSequencial = Number($(this).attr('attr-sequencia'));
        var novoSequencial = numeroSequencial + 1;
        
        $(this).attr('attr-sequencia', novoSequencial);
        $("div.abreDivNestVideoUx:hidden").slice(0, 1).show();
        $(".abreDivNestVideoUx[attr-sequencia="+novoSequencial+"]").css('display', 'inline-flex');
        
        target_offset = $(".abreDivNestVideoUx[attr-sequencia="+novoSequencial+"]").offset(),
        target_top = target_offset.top;
        
        $('html,body').animate({
            scrollTop: target_top-80
        }, 250);
    });

    $('.botoesFiltroAssuntoUx').click(function(e){
        $('.inputCampoPesquisaVideosUx').val('');
        var idTema = $(this).attr('attr-id');
        var filtroAtivo = $(this).attr('attr-filtroAtivo');
        var corFundo = $(this).attr('attr-corFundo');
        
        if($('.botaoVerMaisVideosUx:hidden')){
            $(".botaoVerMaisVideosUx").fadeIn('fast');
        }
        
        if(filtroAtivo == '0'){
            // $('#assuntoUx'+idTema+'').css('background', '#FDF429');
            $('#assuntoUx'+idTema+'').css('background', corFundo);
            $('.textoBotaoUx'+idTema+'').css('color', '#FFFFFF');
            $('#assuntoUx'+idTema+'').attr('attr-filtroAtivo', '1');
            $('.botaoVerMaisVideosUx').attr('attr-sequencia', '1');
        } else{
            $('#assuntoUx'+idTema+'').css('background', '#E4ECFF');
            $('.textoBotaoUx'+idTema+'').css('color', '#3354FD');
            $('#assuntoUx'+idTema+'').attr('attr-filtroAtivo', '0');
            $('.botaoVerMaisVideosUx').attr('attr-sequencia', '1');
        }
        var arr=[];
        $("div[attr-filtroAtivo='1']").each(function(){
 	    	arr.push($(this).attr('attr-id'));
    	});
        
        if(arr.length > 0){
            consultaVideosUx(arr);
        } else {
            var idTema = [];
            consultaVideosUx(idTema);
            if($('.botaoVerMaisVideosUx').css('display') == 'none'){
                $(".botaoVerMaisVideosUx").fadeIn('fast');
            }
        }
    });

    // Executa a pesquisa para o termo digitado clicando no botão "pesquisar"
    $('.botaoPesquisarVideosUx').on('click', function(){
        var textoDigitado = $('.inputCampoPesquisaVideosUx').val();
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
        
        $('.botoesFiltroAssuntoUx').css('background', '#E4ECFF');
        
        if($('.botaoVerMaisVideosUx:hidden')){
            $(".botaoVerMaisVideosUx").fadeIn('fast');
        }
        
        pesquisaVideosUx(textoDigitado);
    });

    // Executa a pesquisa para o termo digitado apertando o enter no teclado
    $('.inputCampoPesquisaVideosUx').keydown(function (e) {
        if (e.keyCode == 13) {
            var textoDigitado = $('.inputCampoPesquisaVideosUx').val();
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
            
            $('.botoesFiltroAssuntoUx').css('background', '#E4ECFF');

            if($('.botaoVerMaisVideosUx:hidden')){
                $(".botaoVerMaisVideosUx").fadeIn('fast');
            }
            
            pesquisaVideosUx(textoDigitado);
        }
    });

    // Limpeza dos campo de pesquisa e reset da página, ocultando eventuais vídeos além da primeira linha que estejam aparecendo
    $('.botaoLimparVideosUx').on('click', function(){
        if($('.botaoVerMaisVideosUx:hidden')){
            $(".botaoVerMaisVideosUx").fadeIn('fast');
        }
        $('.botoesFiltroAssuntoUx').css('background', '#E4ECFF');
        $('.botaoVerMaisVideosUx').attr('attr-sequencia', '1');
        $('.inputCampoPesquisaVideosUx').val('');
        $('.botoesFiltroAssuntoUx').attr('attr-filtroativo', '0');
        var idTema = [];
        consultaVideosUx(idTema);
    });

    // Função ajax que consulta as notícias. A mesma função é utilizada para carregar as notícias tanto sem filtro como as filtradas por tema
    function consultaVideosUx(idTema){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/ux/controller/controller_ux.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'consultaVideosUx',
                idTema: idTema
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    $(".containerVideosUx").html('');
                    $("div.containerVideosUx").html(retorno.mensagem);
                    var qtasDivsOcultas = ($(".abreDivNestVideoUx:hidden").length);
                    if(qtasDivsOcultas == 0){
                        $(".botaoVerMaisVideosUx").fadeOut('fast');
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L175 - ux.js");
            }
        });
    }

    function pesquisaVideosUx(textoDigitado){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/ux/controller/controller_ux.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'pesquisaVideosUx',
                textoDigitado: textoDigitado
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    $(".containerVideosUx").html('');
                    $('.botaoVerMaisVideosUx').attr('attr-sequencia', '1');
                    $("div.containerVideosUx").html(retorno.mensagem);
                    var qtasDivsOcultas = ($(".abreDivNestVideoUx:hidden").length);
                    if(qtasDivsOcultas == 0){
                        $(".botaoVerMaisVideosUx").fadeOut('fast');
                    }
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L220 - noticias.js > "+JSON.stringify(erro));
            }
        });
    }

    
});