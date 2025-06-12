$(document).ready(function() {

    $('.abaConsultarExperimentos').on('click', function(){
        $('.abaAdicionarExperimentos').css('z-index', '1');
        $('.abaConsultarExperimentos').css('z-index', '2');
        $('#paginaExperimentos').css('background','#465EFF');
        $('.abaExperimentos').css('display', 'inline-flex');
        $('.abaAdicionarExperimento').css('display', 'none');
    });

    $('.abaAdicionarExperimentos').on('click', function(){
        $('.abaConsultarExperimentos').css('z-index', '1');
        $('.abaAdicionarExperimentos').css('z-index', '2');
        $('#paginaExperimentos').css('background','#62bee7');
        $('.abaAdicionarExperimento').css('display', 'inline-flex');
        $('.abaExperimentos').css('display', 'none');
    });
    
    // A class abreDivNestExperimento contém 4 notícias lado a lado. A linha abaixo faz com que apareça apenas uma linha com 4 notícias ao carregar a página
    $(".abreDivNestExperimento").slice(0, 1).show();
    
    // Funções ao clicar no botão "Ver Mais"
    $(".botaoVerMaisExperimentos").on('click', function (event) {
        var qtasDivsOcultas = ($(".abreDivNestExperimento:hidden").length);
        if(qtasDivsOcultas == 1){
            $(".botaoVerMaisExperimentos").fadeOut('fast');
        }
        // Verifica o atributo "Número Sequencial" do botão, que é utilizado para fazer mostrar a próxima linha de notícias (cada linha possui um atributo que é sua sequência)
        var numeroSequencial = Number($(this).attr('attr-sequencia'));
        var novoSequencial = numeroSequencial + 1;
        
        $(this).attr('attr-sequencia', novoSequencial);
        $("div.abreDivNestExperimento:hidden").slice(0, 1).show();
        $(".abreDivNestExperimento[attr-sequencia="+novoSequencial+"]").css('display', 'inline-flex');
        
        target_offset = $(".abreDivNestExperimento[attr-sequencia="+novoSequencial+"]").offset(),
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
        if($('.botaoVerMaisExperimentos:hidden')){
            $(".botaoVerMaisExperimentos").fadeIn('fast');
        }
        
        if(filtroAtivo == '0'){
            $('#temaExperimentos'+idTema+'').css('background', '#FDF429');
            $('#temaExperimentos'+idTema+'').attr('attr-filtroAtivo', '1');
            $('.botaoVerMaisExperimentos').attr('attr-sequencia', '1');
        } else{
            $('#temaExperimentos'+idTema+'').css('background', '#E4ECFF');
            $('#temaExperimentos'+idTema+'').attr('attr-filtroAtivo', '0');
            $('.botaoVerMaisExperimentos').attr('attr-sequencia', '1');
        }
        var arr=[];
        $("div[attr-filtroAtivo='1']").each(function(){
 	    	arr.push($(this).attr('attr-id'));
    	});
        if(arr.length > 0){
            // filtraExperimentosTema(arr);
            consultaExperimentos(arr);
        } else {
            var idTema = [];
            consultaExperimentos(idTema);
            if($('.botaoVerMaisExperimentos').css('display') == 'none'){
                $(".botaoVerMaisExperimentos").fadeIn('fast');
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
        
        if($('.botaoVerMaisExperimentos:hidden')){
            $(".botaoVerMaisExperimentos").fadeIn('fast');
        }
        
        pesquisaExperimentos(textoDigitado);
    });

    // Limpeza dos campos de pesquisa e reset da página, ocultando eventuais notícias além da primeira linha que estejam aparecendo
    $('.botaoLimpaPesquisa').on('click', function(){
        if($('.botaoVerMaisExperimentos:hidden')){
            $(".botaoVerMaisExperimentos").fadeIn('fast');
        }
        $('.botoesFiltroTema').css('background', '#E4ECFF');
        $('.botaoVerMaisExperimentos').attr('attr-sequencia', '1');
        $('.inputCampoPesquisa').val('');
        $('.botoesFiltroTema').attr('attr-filtroativo', '0');
        var idTema = [];
        consultaExperimentos(idTema);
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
            $('.botoesFiltroTema').css('background', '#E4ECFF');
            $('.botaoVerMaisExperimentos').attr('attr-sequencia', '1');
            $('.botoesFiltroTema').attr('attr-filtroativo', '0');
            
            if($('.botaoVerMaisExperimentos:hidden')){
                $(".botaoVerMaisExperimentos").fadeIn('fast');
            }
            
            pesquisaExperimentos(textoDigitado);
        }
    });

    function abrirPaginaUpload(){
        console.log('Abrir página de upload com JS externo');
        alert('Abrir página de upload com JS externo');
    }

    // Função ajax que consulta as notícias. A mesma função é utilizada para carregar as notícias tanto sem filtro como as filtradas por tema
    function consultaExperimentos(idTema){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/experimentos_teste/controller/controller_experimentos.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'consultaExperimentos',
                idTema: idTema
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    $(".containerExperimentos").html('');
                    $("div.containerExperimentos").html(retorno.mensagem);
                    var qtasDivsOcultas = ($(".abreDivNestExperimento:hidden").length);
                    if(qtasDivsOcultas == 0){
                        $(".botaoVerMaisExperimentos").fadeOut('fast');
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L172 - experimentos.js");
            }
        });
    }

    // Função ajax que pesquisa as notícias baseada nos termos digitados na barra de pesquisa
    function pesquisaExperimentos(textoDigitado){
        var caminhoController = 'https://cad.bb.com.br/lib/apps/experimentos_teste/controller/controller_experimentos.php';
        $.ajax({
            aSync: true,
            url: caminhoController,
            data: {
                request: 'pesquisaExperimentos',
                textoDigitado: textoDigitado
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                if (retorno.status == 1) {
                    $(".containerExperimentos").html('');
                    $('.botaoVerMaisExperimentos').attr('attr-sequencia', '1');
                    $("div.containerExperimentos").html(retorno.mensagem);
                    var qtasDivsOcultas = ($(".abreDivNestExperimento:hidden").length);
                    if(qtasDivsOcultas == 0){
                        $(".botaoVerMaisExperimentos").fadeOut('fast');
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
                alert("Não foi possível efetuar a operação, por favor tente novamente. L222 - experimentos.js");
            }
        });
    }
});