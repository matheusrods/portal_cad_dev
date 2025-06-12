$(document).ready(function() {
    window.onload = function() {
        window.onbeforeunload = function () {
            window.scrollTo(0, 0);
        }
    }

    // Interações com o cabeçaho da página
    $('.divCabecalho').click(function(){
        
        // Identifica o elemento que foi clicado no cabeçalho
        var idElementoClicado = $(this).attr('id');
        var idMenuAberto = $('#submenuCabecalho').attr('attr-id');

        // Verifica se o submenu do cabeçalho está aberto
        if($('#submenuCabecalho').css('display') == 'block'){
            var subMenuAberto = 1;    
        }
        
        // Verifica se o submenu do cabeçalho está fechado
        if($('#submenuCabecalho').css('display') == 'none'){
            var subMenuAberto = 0;    
        }
        
        // Verifica se o item clicado é página interna
        if($(this).hasClass('linkInterno')){
            // Se clicar num item do cabeçalho que abra diretamente uma nova página (ex: quem somos, notícias), faz o scroll da tela para o topo
            $('html,body').animate({
                scrollTop: 0
            }, 250);
            
            // Identifica as informações necessárias para abrir a página interna e prepara os atributos dos elementos para as próximas interações
            var linkInterno = $(this).attr('attr-linkinterno');
            var idElementoClicado = $(this).attr('id');
            var idMenuAberto = $('#submenuCabecalho').attr('attr-id');

            // Verifica se o submenu está aberto e, em caso positivo, fecha e remove os estilos do cabeçalho
            if(subMenuAberto == 1){
                $('#submenuCabecalho').slideUp(150);
                $('.divCabecalho').css('border-bottom', '');
                $('.divCabecalho span').css('margin-top', '');
                // $('.divCabecalho').css('font-weight', 'normal');
                $('.divCabecalho').removeAttr('style');
                $('#item'+idMenuAberto).css('display','none');
            }

            // Chama a função Ajax que abre o submenu
            abrirPaginaInterna(linkInterno,idElementoClicado);
        
        // Opções e tratamentos para o caso de não ser link interno
        } else {
            // Se o submenu estiver fechado, abre o mesmo baseado no item clicado e prepara os atributos HTML para a continuidade da navegação
            if(subMenuAberto == 0){
                $('#submenuCabecalho').slideToggle(150);
                $('#submenuCabecalho').attr('attr-id', idElementoClicado);
                $('#'+idElementoClicado).css('font-weight', 'bold');
                $('#item'+idElementoClicado).css('display', 'block');
                // $('#'+idElementoClicado).css('border-bottom', '8px solid #FDF429');
                // $('#'+idElementoClicado+' span').css('margin-top', '8px');
            }

            // Verifica se o elemento está aberto
            if(subMenuAberto == 1){
                // Verifica se o submenu que está aberto é o mesmo que foi clicado e, em caso positivo, fecha o submenu, remove os estilos do cabeçalho e prepara os atributos para navegação
                if(idElementoClicado == idMenuAberto){
                    $('#submenuCabecalho').slideUp(150);
                    setTimeout(function(){
                        $('#submenuCabecalho').attr('attr-id', '0');
                        $('#'+idElementoClicado).css('border-bottom', '');
                        $('#'+idElementoClicado+' span').css('margin-top', '');
                        $('#'+idElementoClicado).removeAttr('style');
                        $('#submenuCabecalho').css('display', 'none');
                        $('#item'+idElementoClicado).css('display', 'none');
                        $('#submenuCabecalho').attr('attr-id', '0');
                    },200);
                }

                // Verifica se o submenu que está aberto é o mesmo que foi clicado e, em caso negativo, altera o conteúdo do submenu aberto, altera os estilos do cabeçalho e prepara os atributos para navegação
                if(idElementoClicado != idMenuAberto){
                    $('#'+idMenuAberto).removeAttr('style');
                    $('#'+idElementoClicado).css('font-weight', 'bold');
                    $('#'+idMenuAberto).css('border-bottom', '');
                    $('#'+idMenuAberto+' span').css('margin-top', '');
                    // $('#'+idElementoClicado).css('border-bottom', '8px solid #FDF429');
                    // $('#item'+idMenuAberto).css('display', 'none');
                    // $('#item'+idElementoClicado).css('display', 'block');
                    setTimeout(function(){
                        $('#item'+idMenuAberto).fadeOut(50);
                    },100);
                    setTimeout(function(){
                        $('#item'+idElementoClicado).fadeIn(150);
                    },200);
                    $('#submenuCabecalho').attr('attr-id', idElementoClicado);
                }
            }
        }
    });

    // Ao clicar em qualquer lugar da tela, se estiver com o submenu do cabeçalho aberto, irá fechá-lo e tirar os estilos do item selecionado do cabeçalho
    $('#container').click(function(e){
        if($('#submenuCabecalho').css('display') == 'block'){
            var idMenuAberto = $('#submenuCabecalho').attr('attr-id');
            $('#submenuCabecalho').slideToggle(150);
            setTimeout(function(){
                $('#item'+idMenuAberto).css('display', 'none');
                $('.divCabecalho').css('border-bottom', '');
                $('.divCabecalho span').css('margin-top', '');
                $('.divCabecalho').removeAttr('style');
                $('#submenuCabecalho').attr('attr-id', '0');
            },200);
        }
    });

    // Evento de abertura de subitem (ex: abrindo capacitação > onboarding) e tira os estilos do item selecionado do cabeçalho
    $('.subItem').click(function(){
        var linkInterno = $(this).attr('attr-linkinterno');
        var idMenuAberto = $('#submenuCabecalho').attr('attr-id');
        
        $('#submenuCabecalho').slideToggle(150);
        $('#item'+idMenuAberto).css('display', 'none');
        // $('.divCabecalho').css('border-bottom', '');
        $('.divCabecalho').removeAttr('style');
        $('.divCabecalho span').css('margin-top', '');
        $('#submenuCabecalho').attr('attr-id', '0');
        $('html,body').animate({
            scrollTop: 0
        }, 250);
        abrirPaginaInterna(linkInterno);
    });

  //Ao clicar na imagem do organograma do CAD a página interna "Quem Somos é aberta"
    // $('.imagemDivisaoCadOnboarding').click(function(){
    //     var linkInterno = $(this).attr('attr-linkinterno');
    //     var idMenuAberto = '0';
    //     $('#submenuCabecalho').attr('attr-id', '0');
    //     // if($('#submenuCabecalho').css('display') == 'block'){
    //     //     var idMenuAberto = $('#submenuCabecalho').attr('attr-id');
    //     //     $('#submenuCabecalho').slideToggle(150);
    //     //     setTimeout(function(){
    //     //         $('#item'+idMenuAberto).css('display', 'none');
    //     //         $('.divCabecalho').css('border-bottom', '');
    //     //         $('.divCabecalho span').css('margin-top', '');
    //     //         $('.divCabecalho').removeAttr('style');
    //     //         $('#submenuCabecalho').attr('attr-id', '0');
    //     //     },200);
    //     // }
    //     $('#submenuCabecalho').slideUp(150);
    //     $('.divCabecalho').removeAttr('style');
    //     $('.divCabecalho span').css('margin-top', '');
    //     $('html,body').animate({
    //         scrollTop: 1000
    //     }, 200);
    //     abrirPaginaInterna(linkInterno);
    // });
    
    // Função Ajax para abrir a página interna selecionada
    function abrirPaginaInterna(linkInterno){
        var caminhoPages = 'https://cad.bb.com.br/lib/apps/'+linkInterno+'/app/'+linkInterno+'.php';
        var decoracaoNatal = '';

        if(queDiaEhHoje() <= "2024-12-31") {
            decoracaoNatal = '<div class="natal" style="background-image: url(https://cad.bb.com.br/lib/img/cabecalho/natal2.gif); background-repeat: repeat-x; width: 140%; height: 10vh; background-size: 500px; position: absolute; margin: -0.5rem -5rem; z-index: 3;"></div>';
        }

        // $.ajax({
        //     url: 'https://cad.bb.com.br/lib/class/validaSessao.php?request=validaSessao',
        //     method: 'GET',
        //     dataType: 'json',
        //     success: function(dadosSessao) {
        //         if (!dadosSessao.session_valid) {
        //             window.location.href = 'https://cad.bb.com.br/';
        //             return false;
        //         }
        //     },
        //     error: function(jqXHR, textStatus, errorThrown) {
        //         console.error('Erro:', textStatus, errorThrown);
        //     }
        // });

        $.ajax({
            aSync: true,
            url: caminhoPages,
            type: "POST",
            dataType: "HTML",
            dataSrc: "",
            success: function(data) {
                $("#container").html('');
                $("#container").html(decoracaoNatal+data);
            }
        });
    };

    function queDiaEhHoje(){
        var hoje = new Date();
        var dd = String(hoje.getDate()).padStart(2, '0');
        var mm = String(hoje.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = hoje.getFullYear();

        // hoje = mm + '/' + dd + '/' + yyyy;
        hoje = yyyy+'-'+mm+'-'+dd;
        return(hoje);
    }
});