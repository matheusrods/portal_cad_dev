$(document).ready(function(){

    var historicoPesquisa = [];

    $('.botaoCampoPesquisa').on('click',function(){
        var textoPesquisa = $('.inputCampoPesquisa').val();        
        if(textoPesquisa.length == 0){
            bootbox.dialog({
                backdrop: true,
                onEscape: function() {},
                size: 'small',
                title: "Atenção",
                message: 'O campo pesquisa não pode estar vazio. Por favor, digite um texto válido.',
                buttons: {
                    confirm:{
                        label: 'OK',
                        className: 'btn-success',
                    }
                }
            });
            return false;
            }
            if (!historicoPesquisa.includes(textoPesquisa)) {
                historicoPesquisa.push(textoPesquisa); //Exibir histórico de pesquisas
                $('#historicoPesquisa').append('<li>' + textoPesquisa + '</li>');
            }
        $('.inputCampoPesquisa').val(''); // Limpa o campo de pesquisa após clicar no botão pesquisa  

        consultaTrends(textoPesquisa).always(function() {
            });
    });

    $('#historicoPesquisa').on('click', 'li', function() {
        $('.inputCampoPesquisa').val($(this).text());
        consultaTrends($(this).text());
    });

    
    /* codigo para criar histórico de pesquisa dentro do campo pesquisar
    $('.inputCampoPesquisa').on('click', function() {
        var historicoHtml = '';
        historicoPesquisa.forEach(function(item) {
            historicoHtml += '<li>' + item + '</li>';
        });
        $('#historicoPesquisa').html(historicoHtml);
        $('#historicoPesquisa').show(); // Mostra o histórico pesquisa
    });

    $('.inputCampoPesquisa').on('blur', function(){
        setTimeout(function() {
            $('#historicoPesquisa').hide(); // Esconde o histórico pesquisa
        }, 200);
    })
    */ 

    // Executa a pesquisar pressionando a tecla enter no teclado
    $('.inputCampoPesquisa').on('keypress', function(event) {
        if (event.which == 13) {
            var textoPesquisa = $(this).val(); // O 'this' se refere a .inputCampoPesquisa
            if (textoPesquisa.length == 0){
                bootbox.dialog({
                    backdrop: true,
                    onEscape: function() {},
                    size: 'small',
                    title: "Atenção",
                    message: "O campo pesquisa não pode estar vazio. Por favor, digite um texto válido.",
                    buttons: {
                        confirm: {
                            label: 'OK',
                            className: 'btn-success',
                        }
                    }
                });
                return false;
            }
            historicoPesquisa.push(textoPesquisa);
            //$('#historicoPesquisa').append('<li>' + textoPesquisa + '</li>');
            $('.inputCampoPesquisa').val(''); // Limpa o campo de pesquisa após o enter  
            //$('#loadingIndicator').show(); // Mostra o indicador de carregamento
            if ($('.botaoVerMaisTrends').is(':hidden')) {
                $('.botaoVerMaisTrends').fadeIn('fast');
            }
            consultaTrends(textoPesquisa).always(function() {
                //$('#loadingIndicator').hide(); //Esconde o indicador de carregamento                
            }, 200);

        }
    });
            
    // Limpeza dos campos de pesquisa e reset da página, ocultando eventuais notícias além da primeira linha que estejam aparecendo
    $('.botaoLimpaPesquisa').on('click',function(){
        if('.botaoVerMaisTrends:hidden'){
            $(".botaoVerMaisTrends").fadeIn('fast');
        }
        $('.botoesVerMaisTrends').attr('attr-sequencia', '1');
        $('.inputCampoPesquisa').val('');
        var limpaTrends = [];
        consultaTrends(limpaTrends);
    });

    // Funções ao clicar no botão "Ver Mais"

    $('.botaoVerMaisTrends').on('click', function (){
        var divsOcultas = ($(".abreDivTrends:hidden").length);
        if(divsOcultas == 1){
            $(".botaoVerMaisTrends").fadeOut('fast');
        }
        //Verifica o atributo "Número Sequencial" do botão, que é utilizado para mostrar a próxima linha de notícias
        var numeroSequencia = Number($(this).attr('attr-sequencia'));
        var novaSequencia = numeroSequencia + 1;

        $(this).attr('attr-sequencia', novaSequencia);
        $("div.abreDivTrends:hidden").slice(0, 1).show();
        $(".abreDivTrends[attr-sequencia="+novaSequencia+"]").css('display', 'inline-flex');
        
        target_offset = $(".abreDivTrends[attr-sequencia="+novaSequencia+"]").offset(),
        target_top = target_offset.top;

        $('html,body').animate({
            scrollTop: target_top-80
        }, 250);
    });

    // Função ajax que pesquisa as trends baseada nos termos digitados na barra de pesquisa
    function consultaTrends(textoPesquisa){
        var caminhoControllerTrends = 'https://cad.desenv.bb.com.br/lib/apps/trends/controller/controller_trends.php';
        $.ajax({
            async: true,
            url: caminhoControllerTrends,
            data: {
                request: 'consultaTrends',
                textoPesquisa: textoPesquisa
            },
            type: "POST",
            dataType: "JSON",
            dataSrc: "",
            success: function(retorno) {
                
                if(retorno.status == 1){
                    $(".containerDetrends").html('');
                    $(".botaoVerMaisTrends").attr('attr-sequencia', '1');
                    $("div.containerDeTrends").html(retorno.mensagem);
                    var divsOcultas = ($(".abreDivTrends:hidden").length);
                    if(divsOcultas == 0){
                        $(".botaoVerMaisTrends").fadeOut('fast');
                    }
                } else {
                    // Se não conseguir pesquisar, exibe a mensagem de erro
                    bootbox.dialog({
                        backdrop: true,
                        onEscape: function() {},
                        size: 'medium',
                        title: "Erro",
                        message: "<div>"+retorno.mensagem+"</div>",
                        buttons: {
                            confirm:{
                                label: 'fechar',
                                className: 'btn-danger',
                            }
                        }
                    });
                }
            },
            error: function(erro) {
                console.log(erro);
                alert("Não foi possível efetuar a operação, por favor tente novamente. L166 - trends.js");
            } 

        });
    }
    
});