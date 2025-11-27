$(document).ready(function () {
    
    const $tabs = $('.tabs .tab');
    const $content = $('#tab-content');

    
    $(document).on('click', '.proximo-modulo', function(event){
        const tabName = $(this).data('tab');
        activateTab(tabName);
        $('html, body').animate({
            scrollTop: 300
        }, 'fast');
    });

    $(document).on('click', '.card-painel', function(){
        var linkVideo = $(this).attr('attr-link');
        bootbox.dialog({
            // className: 'bootboxGrande',
            backdrop: true,
            onEscape: function() {},
            // closeButton: true,
            size: "xl",
            message: "<div style='text-align: center;'>"+linkVideo+"</div>",
        });
    });

    function activateTab(name) {
        // visual
        $tabs.each(function () {
            $(this).toggleClass('active', $(this).data('tab') === name);
        });

        // fetch da seção
        const url = `${BASE_URL}/lib/apps/capacitacao_analytics/sections/${name}.php`;
        $.get(url)
            .done(function (html) {
                $content.html(html);
            })
            .fail(function () {
                $content.html(`<p class="error">Falha ao carregar ${url}</p>`);
            });
    }

    // clique nas tabs originais
    $tabs.on('click', function () {
        const tabName = $(this).data('tab');
        activateTab(tabName);
        // sincroniza hash no URL
        // history.replaceState(null, '', `#${tabName}`);
    });

    // quando a hash muda (exemplo: clicou no link “Próximo Módulo”)
    $(window).on('hashchange', function () {
        const name = location.hash.slice(1);
        if (name) activateTab(name);
    });

    $(document).on('click', 'a .video-link', function(event) {
        event.preventDefault();
        alert('oi');
        var videoSrc = $(this).data('data-video-src');
        alert(videoSrc);
        $('#video-frame').attr('src', videoSrc).show();
    });

    // inicialização: se tiver hash use ela, senão use a aba que já vem com .active
    const initial = location.hash.slice(1) || $('.tabs .tab.active').data('tab');
    activateTab(initial);

});