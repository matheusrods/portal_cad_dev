$(document).ready(function() {
    
    // A class abreDivNestPainel contém 4 painéis lado a lado. A linha abaixo faz com que apareça apenas uma linha com 4 painéis ao carregar a página
    $(".abreDivNestPainel").slice(0, 1).show();
    
    // Funções ao clicar no botão "Ver Mais"
    $(".botaoVerMaisPaineis").on('click', function (event) {
        var qtasDivsOcultas = ($(".abreDivNestPainel:hidden").length);
        if(qtasDivsOcultas == 1){
            $(".botaoVerMaisPaineis").fadeOut('fast');
        }
        // Verifica o atributo "Número Sequencial" do botão, que é utilizado para fazer mostrar a próxima linha de painéis (cada linha possui um atributo que é sua sequência)
        var numeroSequencial = Number($(this).attr('attr-sequencia'));
        var novoSequencial = numeroSequencial + 1;
        
        $(this).attr('attr-sequencia', novoSequencial);
        $("div.abreDivNestPainel:hidden").slice(0, 1).show();
        $(".abreDivNestPainel[attr-sequencia="+novoSequencial+"]").css('display', 'inline-flex');
        
        target_offset = $(".abreDivNestPainel[attr-sequencia="+novoSequencial+"]").offset(),
        target_top = target_offset.top;
        
        $('html,body').animate({
            scrollTop: target_top-80
        }, 250);
    });

    // Interações dos botões de filtros de tema dos painéis
    $('.divbotoesFiltroTag').click(function(e){ 
        $('.inputCampoPesquisa').val('');
        var idTag = $(this).attr('attr-id');
        var filtroAtivo = $(this).attr('attr-filtroAtivo');
        
       if($('.botaoVerMaisPaineis:hidden')){
            $(".botaoVerMaisPaineis").fadeIn('fast');
        }
    
        if(filtroAtivo == '0'){
            $('#tagPaineis'+idTag+'').css('background', '#FDF429');
            $('#tagPaineis'+idTag+'').attr('attr-filtroAtivo', '1');
            $('.botaoVerMaisPaineis').attr('attr-sequencia', '1');
            
            
        } else{
            $('#tagPaineis'+idTag+'').css('background', '#E4ECFF');
            $('#tagPaineis'+idTag+'').attr('attr-filtroAtivo', '0');
            $('.botaoVerMaisPaineis').attr('attr-sequencia', '1');
            
        }
        var arr=[];
       
        $("div[attr-filtroAtivo='1']").each(function(){
 	    	arr.push($(this).attr('attr-id'));
    	});
        if(arr.length > 0){
            consultaPaineis(arr);
            
        } else {
            var idTag = [];
            consultaPaineis(idTag);
            if($('.botaoVerMaisPaineis').css('display') == 'none'){
                 $(".botaoVerMaisPaineis").fadeIn('fast');
                 
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
        
        if($('.botaoVerMaisPaineis:hidden')){
            $(".botaoVerMaisPaineis").fadeIn('fast');
        }
        
        pesquisaPaineis(textoDigitado);

    });

    // Limpeza dos campo de pesquisa e reset da página, ocultando eventuais painéis além da primeira linha que estejam aparecendo
    $('.botaoLimpaPesquisa').on('click', function(){
        if($('.botaoVerMaisPaineis:hidden')){
            $(".botaoVerMaisPaineis").fadeIn('fast');
            
        }
        $('.divBotoesFiltroTag').css('background', '#E4ECFF');
        $('.divBotoesFiltroTag').attr('attr-filtroativo', '0');
        $('.botaoVerMaisPaineis').attr('attr-sequencia', '1');
        $('.inputCampoPesquisa').val('');
        
        var idTag = [];
        consultaPaineis(idTag);
        
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
            
            if($('.botaoVerMaisPaineis:hidden')){
                $(".botaoVerMaisPaineis").fadeIn('fast');
            }
            pesquisaPaineis(textoDigitado);
        }
    });

    // Função ajax que consulta os painéis. A mesma função é utilizada para carregar os painéis tanto sem filtro como os filtrados pelas tags
    function consultaPaineis(idTag){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/analytics/controller/controller_analytics_V2.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'consultaPaineis',
                idTag: idTag
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    $(".containerPaineis").html('');
                    $("div.containerPaineis").html(retorno.mensagem);
                 
                    var qtasDivsOcultas = ($(".abreDivNestPainel:hidden").length);
                    
                    if(qtasDivsOcultas == 0){
                        
                       $(".botaoVerMaisPaineis").fadeOut('fast');
                       
                        
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L133 - analytics_V2.js");
            }
        });
    }

    // Função ajax que pesquisa os paineis baseada nos termos digitados na barra de pesquisa
    function pesquisaPaineis(textoDigitado){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/analytics/controller/controller_analytics_V2.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'pesquisaPaineis',
                textoDigitado: textoDigitado
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    $(".containerPaineis").html('');
                    $('.botaoVerMaisPaineis').attr('attr-sequencia', '1');
                    $("div.containerPaineis").html(retorno.mensagem);
                    var qtasDivsOcultas = ($(".abreDivNestPainel:hidden").length);
                    if(qtasDivsOcultas == 0){
                        $(".botaoVerMaisPaineis").fadeOut('fast');
                    }
                    // $('.abrirPainel').css('margin-top', '0.25rem');
                    // $('.abrirPainel').css('margin-left', '1.8rem');
                    $('.abrirPainel').css('margin-bottom', '1.8rem');
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L178 - analytics_V2.js");
            }
        });
    }
});