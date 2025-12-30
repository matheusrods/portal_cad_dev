$(document).ready(function () {
    const $btnFavoritos = $('#atalhoFavoritos');
    const $overlayFavoritos = $('#favoritos-overlay');
    const $btnFecharFavoritos = $('#btnFecharFavoritos');

    if ($btnFavoritos.length && $overlayFavoritos.length) {
        $btnFavoritos.on('click', function (e) {
            e.preventDefault();
            $overlayFavoritos.addClass('ativo');
            $('body').css('overflow', 'hidden');
        });
    }

    $btnFecharFavoritos.on('click', fecharFavoritos);

    $overlayFavoritos.on('click', function (e) {
        if (e.target === this) {
            fecharFavoritos();
        }
    });

    function fecharFavoritos() {
        $overlayFavoritos.removeClass('ativo');
        $('body').css('overflow', '');
    }

    const $btnAdicionar = $('.TextoAdicionarLink');
    const $overlayAdd = $('#adicionar-link-overlay');
    const $btnFecharAdd = $('#btnFecharAdicionarLink');
    const $btnCancelar = $('.btn-cancelar');

    $btnAdicionar.on('click', function () {
        resetarModalAdicionar();
        $overlayAdd.addClass('ativo');
        $('#favoritoTitulo').focus();
    });

    $btnFecharAdd.on('click', fecharAdd);
    $btnCancelar.on('click', fecharAdd);

    $overlayAdd.on('click', function (e) {
        if (e.target === this) {
            fecharAdd();
        }
    });

    function fecharAdd() {
        $overlayAdd.removeClass('ativo');
    }

    const $inputTitulo = $('#favoritoTitulo');
    const $inputUrl = $('#favoritoUrl');
    const $btnSalvar = $('.btn-salvar');
    $btnSalvar.prop('disabled', true);

    function validarCamposFavorito() {
        const tituloValido = $.trim($inputTitulo.val()).length > 0;
        const urlValida = $.trim($inputUrl.val()).length > 0;

        $btnSalvar.prop('disabled', !(tituloValido && urlValida));
    }

    $inputTitulo.on('input', validarCamposFavorito);
    $inputUrl.on('input', validarCamposFavorito);

    function resetarModalAdicionar() {
        $inputTitulo.val('');
        $inputUrl.val('');
        $btnSalvar.prop('disabled', true);
    }

    $btnSalvar.on('click', function () {
        salvarFavorito();
    });

    function salvarFavorito() {
        const titulo = $.trim($inputTitulo.val());
        const url = $.trim($inputUrl.val());

        if (!titulo || !url) {
            return;
        }

        $btnSalvar.prop('disabled', true).text('SALVANDO...');

        $.ajax({
            url: '/lib/ajax/favoritos.php',
            type: 'POST',
            dataType: 'json',
            data: {
                request: 'gravarFavorito',
                titulo: titulo,
                url: url
            },
            success: function (res) {
                if (res.status === 'sucesso') {
                    fecharAdd();
                    resetarModalAdicionar();

                    // aqui depois você pode chamar:
                    // carregarFavoritos();

                    alert('Link salvo com sucesso!');
                } else {
                    alert(res.mensagem || 'Erro ao salvar favorito');
                }
            },
            error: function () {
                alert('Erro de comunicação com o servidor');
            },
            complete: function () {
                $btnSalvar.prop('disabled', true).text('SALVAR');
            }
        });
    }


});