$(document).ready(function() {
    $('.divFerramentasOnboarding a').click(function(e) {
        e.stopPropagation();
    });

    $('.divFerramenta').click(function(){
        var idFerramentaClicada = $(this).attr('id');
        var idFerramentaAberta = $('.divFerramenta').attr('attr-ferramentaAberta');
        
        if(idFerramentaClicada == idFerramentaAberta){

            $('.ferramentaConteudo').attr('attr-ferramentaAberta', '0');
            $('.divFerramenta').attr('attr-ferramentaAberta', '0');
            $('.ferramentaConteudo'+idFerramentaAberta).slideToggle(150);

            $('.iconeSetaFerramenta'+idFerramentaAberta).removeClass('fa-chevron-up');
            $('.iconeSetaFerramenta'+idFerramentaAberta).addClass('fa-chevron-down');
            
            $('.botaoSetaFerramenta'+idFerramentaAberta).removeClass('btn-dark');
            $('.botaoSetaFerramenta'+idFerramentaAberta).addClass('btn-outline-dark');
            
        } else {

            $('.ferramentaConteudo'+idFerramentaAberta).slideToggle(150);
            $('.ferramentaConteudo'+idFerramentaClicada).slideToggle(150);
            
            $('.ferramentaConteudo'+idFerramentaClicada).css('display', 'flex');
            $('.ferramentaConteudo').attr('attr-ferramentaAberta', idFerramentaClicada);
            $('.divFerramenta').attr('attr-ferramentaAberta', idFerramentaClicada);

            $('.iconeSetaFerramenta'+idFerramentaAberta).removeClass('fa-chevron-up');
            $('.iconeSetaFerramenta'+idFerramentaAberta).addClass('fa-chevron-down');

            $('.iconeSetaFerramenta'+idFerramentaClicada).removeClass('fa-chevron-down');
            $('.iconeSetaFerramenta'+idFerramentaClicada).addClass('fa-chevron-up');

            $('.botaoSetaFerramenta'+idFerramentaAberta).removeClass('btn-dark');
            $('.botaoSetaFerramenta'+idFerramentaAberta).addClass('btn-outline-dark');

            $('.botaoSetaFerramenta'+idFerramentaClicada).removeClass('btn-outline-dark');
            $('.botaoSetaFerramenta'+idFerramentaClicada).addClass('btn-dark');

        }
    });

    $('.abrePaginaInterna').on('click', function(){
        $('html,body').animate({
            scrollTop: 0
        }, 250);
        
        // Identifica as informações necessárias para abrir a página interna e prepara os atributos dos elementos para as próximas interações
        var linkInterno = $(this).attr('attr-linkinterno');
        
        // Chama a função Ajax que abre o submenu
        abrirPaginaInterna(linkInterno);
    });

    $('.imagemDivisaoCadOnboarding').on('click', function(){
             
        // Identifica as informações necessárias para abrir a página interna e prepara os atributos dos elementos para as próximas interações
        var linkInterno = $(this).attr('attr-linkinterno');
        // Chama a função Ajax que abre o submenu
        abrirPaginaInterna(linkInterno);
        $('html,body').animate({
            scrollTop: 1000
        }, 200);
    });

    // Abre o guia de linguagem dentro de um bootbox na página
    $('.linkGuiaDeLinguagem').click(function(){
        bootbox.alert({
            backdrop: true,
            onEscape: function() {},
            closeButton: true,
            size: 'extra-large',
            title: "Guia de Linguagem",
            className: 'modalGuiaLinguagem',
            message: "<div style='width: 100%;'> <style>.bootbox .modal-header .close { position: absolute;right: 15px; } .modal{ direction:rtl; overflow-y: auto; } .modal .modal-dialog{ direction:ltr; } .modal-open{ overflow:auto; }</style> <embed src='https://cad.bb.com.br/lib/apps/onboarding/docs/guiaLinguagem.pdf' style='width: 100%; height: 600px;'></div>",
        });
    });

    // Função Ajax para abrir a página interna selecionada
    function abrirPaginaInterna(linkInterno){
        var caminhoPages = 'https://cad.bb.com.br/lib/apps/'+linkInterno+'/app/'+linkInterno+'.php';
        $.ajax({
            aSync: true,
            url: caminhoPages,
            type: "POST",
            dataType: "HTML",
            dataSrc: "",
            success: function(data) {
                $("#container").html('');
                $("#container").html(data);
            }
        });
    };
});