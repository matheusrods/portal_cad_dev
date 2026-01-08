$(document).ready(function () {
    let favoritoEmEdicao = null;

    const $btnFavoritos = $('#atalhoFavoritos');
    const $overlayFavoritos = $('#favoritos-overlay');
    const $btnFecharFavoritos = $('#btnFecharFavoritos');

    if ($btnFavoritos.length && $overlayFavoritos.length) {
        $btnFavoritos.on('click', function (e) {
            e.preventDefault();
            $overlayFavoritos.addClass('ativo');
            $('body').css('overflow', 'hidden');
            $('.inputCampoPesquisaLink').val('');
            carregarFavoritos(1);
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
        const titulo = $.trim($inputTitulo.val());
        const url = $.trim($inputUrl.val());

        const tituloValido = titulo.length > 0;
        const urlPreenchida = url.length > 0;
        const urlValida = urlPreenchida && urlValidaFormato(url);

        if (urlPreenchida && !urlValida) {
            $('.erro-url').show();
        } else {
            $('.erro-url').hide();
        }

        $btnSalvar.prop('disabled', !(tituloValido && urlValida));
    }

    $inputTitulo.on('input', validarCamposFavorito);
    $inputUrl.on('input', validarCamposFavorito);

    function resetarModalAdicionar() {
        favoritoEmEdicao = null;
        $('#favoritoTitulo').val('');
        $('#favoritoUrl').val('');
        $('.btn-salvar').text('SALVAR').prop('disabled', true);
        $('.adicionar-link-modal h2').text('Adicionar Link');
    }


    $btnSalvar.on('click', function () {
        if (favoritoEmEdicao) {
            atualizarFavorito();
        } else {
            salvarFavorito();
        }
    });

    function salvarFavorito() {
        var caminhoController = `${BASE_URL}/Utils/favoritos/controller/controller.php`;
        const titulo = $.trim($inputTitulo.val());
        const url = $.trim($inputUrl.val());

        if (!titulo || !url) {
            return;
        }

        $btnSalvar.prop('disabled', true).text('SALVANDO...');

        $.ajax({
            url: caminhoController,
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

                    mostrarToastFeedback(
                        "Link adicionado com sucesso!",
                        "",
                    );

                    carregarFavoritos(1);
                } else {
                    mostrarToastFeedback(
                        'Erro ao salvar',
                        'Já existe um favorito com esse título',
                        false,
                        'erro'
                    );
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

    function urlValidaFormato(url) {
        return /^(https?:\/\/)/i.test(url);
    }

    $(document).on('click', '.botaoCampoPesquisa', function () {
        carregarFavoritos(1);
    });

    function carregarFavoritos(pagina = 1) {
        const busca = $('.inputCampoPesquisaLink').val().trim();

        $.ajax({
            url: `${BASE_URL}/Utils/favoritos/controller/controller.php`,
            type: 'POST',
            dataType: 'json',
            data: {
                request: 'listarFavoritos',
                pagina: pagina,
                limite: 10,
                busca: busca
            },
            success: function (res) {
                if (res.status === 'sucesso') {
                    renderizarFavoritos(res.dados);
                    renderPagination({
                        container: '.favoritos-paginacao',
                        total: res.total,
                        limite: res.limite,
                        paginaAtual: res.pagina,
                        onChange: (pagina) => {
                            carregarFavoritos(pagina);
                        }
                    });
                }
            }
        });
    }

    window.carregarFavoritos = carregarFavoritos;

    function renderizarFavoritos(dados) {
        const $grid = $('.favoritos-grid');
        const $vazio = $('.favoritos-vazio');
        $grid.empty();

        if (!dados || dados.length === 0) {
            $grid.hide();
            $vazio.show();
            return;
        }

        $vazio.hide();
        $grid.show();

        dados.forEach(item => {
            $grid.append(`
                <div class="favorito-card" data-id="${item.id}" data-url="${item.url}">
                
                    <div class="favorito-acoes">
                        <button class="acao-editar" title="Editar">
                            <!-- <i class="fa fa-pencil"></i> -->
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.9963 9.30917L8.42813 17.8797L14.1211 23.5711L22.6892 15.0005L16.9963 9.30917Z" fill="#AEAEAE"/>
                            <path d="M24.1037 13.5902L24.8237 12.8712C26.3927 11.3022 26.3927 8.74821 24.8237 7.17821C23.2547 5.60921 20.6997 5.60921 19.1307 7.17821L18.4117 7.89821L24.1037 13.5902Z" fill="#AEAEAE"/>
                            <path d="M12.3997 24.6802L7.24373 25.9682C6.90273 26.0522 6.54173 25.9532 6.29373 25.7052C6.04573 25.4572 5.94573 25.0962 6.03073 24.7562L7.31973 19.6002L12.3997 24.6802Z" fill="#AEAEAE"/>
                            </svg>
                        </button>
                        <button class="acao-excluir" title="Excluir">
                            <!-- <i class="fa fa-trash"></i> -->
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 8.49949V6.50049H13V8.49949H9V10.4995H23V8.49949H19ZM10 11.4995V23.4995C10 24.6015 10.897 25.4995 12 25.4995H20C21.103 25.4995 22 24.6015 22 23.4995V11.4995H10ZM15 21.5005H13V15.5005H15V21.5005ZM19 21.5005H17V15.5005H19V21.5005Z" fill="#AEAEAE"/>
                            </svg>
                        </button>
                    </div>

                    <div class="favorito-icone">
                        <a href="${item.url}"
                            target="_blank"
                            onclick="event.stopPropagation()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.15771 0C4.0977 0 0 4.10668 0 9.16667C0 14.2267 4.0977 18.3333 9.15771 18.3333H9.16667V16.4633C8.40576 15.3633 7.81002 14.1442 7.41569 12.8333H9.47953C9.72079 12.1502 10.0936 11.529 10.5672 11H7.02181C6.93901 10.395 6.875 9.78999 6.875 9.16667C6.875 8.54334 6.93901 7.92916 7.02181 7.33333H11.3115C11.3943 7.92916 11.4583 8.54334 11.4583 9.16667C11.4583 9.52938 11.4368 9.88592 11.4024 10.2399C11.9605 9.82767 12.5988 9.51847 13.2903 9.34033C13.2912 9.28259 13.2917 9.22471 13.2917 9.16667C13.2917 8.54334 13.2366 7.93834 13.1632 7.33333H16.2619C16.4082 7.92001 16.5 8.53416 16.5 9.16667H18.3333C18.3333 4.10668 14.2267 0 9.15771 0ZM15.5099 5.5H12.806C12.5124 4.35417 12.0908 3.25416 11.5407 2.23667C13.2277 2.81417 14.63 3.98751 15.5099 5.5ZM9.16667 1.87001C9.92757 2.96999 10.5233 4.18917 10.9176 5.5H7.41569C7.81002 4.18917 8.40576 2.96999 9.16667 1.87001ZM2.07168 11C1.92509 10.4133 1.83333 9.79917 1.83333 9.16667C1.83333 8.53416 1.92509 7.92001 2.07168 7.33333H5.17013C5.09672 7.93834 5.04167 8.54334 5.04167 9.16667C5.04167 9.78999 5.09672 10.395 5.17013 11H2.07168ZM2.82341 12.8333H5.5273C5.82092 13.9792 6.24255 15.0792 6.79264 16.0967C5.10567 15.5192 3.70337 14.355 2.82341 12.8333ZM5.5273 5.5H2.82341C3.70337 3.97833 5.10567 2.81417 6.79264 2.23667C6.24255 3.25416 5.82092 4.35417 5.5273 5.5Z" fill="#4668FF"/>
                                <path d="M11 14.6667L16.5 11L22 14.6667L15.4688 19.0781L14.3516 18.3333L19.6224 14.6667L16.5 12.5469L14.8385 13.5495L16.0417 14.3229L13.2917 16.1849L11 14.6667Z" fill="#4668FF"/>
                                <path d="M17.5313 13.9219L11 18.3333L16.5 22L22 18.3333L19.7083 16.8151L16.9583 18.6771L18.1615 19.4505L16.5 20.4531L13.3776 18.3333L18.6484 14.6667L17.5313 13.9219Z" fill="#4668FF"/>
                                <path d="M12.1458 19.7083L11 20.4818V22L13.2917 20.4818L12.1458 19.7083Z" fill="#4668FF"/>
                                <path d="M22 11L19.7083 12.5182L20.8542 13.2917L22 12.5182V11Z" fill="#4668FF"/>
                                </svg>
                        </a>
                    </div>
                    <div class="titulo">${item.titulo}</div>
                </div>
            `);
        });
    }

    $(document).on('click', '.acao-editar', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const $card = $(this).closest('.favorito-card');

        favoritoEmEdicao = {
            id: $card.data('id'),
            titulo: $card.find('.titulo').text(),
            url: $card.data('url')
        };

        abrirModalEditar(favoritoEmEdicao);
    });

    function abrirModalEditar(favorito) {
        $('#favoritoTitulo').val(favorito.titulo);
        $('#favoritoUrl').val(favorito.url);

        $('.adicionar-link-modal h2').text('Editar Link');
        $('.btn-salvar').text('ATUALIZAR').prop('disabled', false);

        $('#adicionar-link-overlay').addClass('ativo');
    }

    function atualizarFavorito() {
        const titulo = $.trim($('#favoritoTitulo').val());
        const url = $.trim($('#favoritoUrl').val());

        if (!titulo || !url) return;

        $btnSalvar.prop('disabled', true).text('SALVANDO...');

        $.ajax({
            url: `${BASE_URL}/Utils/favoritos/controller/controller.php`,
            type: 'POST',
            dataType: 'json',
            data: {
                request: 'editarFavorito',
                id: favoritoEmEdicao.id,
                titulo: titulo,
                url: url
            },
            success: function (res) {
                if (res.status === 'sucesso') {
                    fecharAdd();
                    resetarModalAdicionar();
                    favoritoEmEdicao = null;

                    mostrarToastFeedback('Link atualizado com sucesso!', '');
                    carregarFavoritos(1);
                } else {
                    mostrarToastFeedback(
                        'Erro ao salvar',
                        'Já existe um favorito com esse título',
                        false,
                        'erro'
                    );
                }
            },
            complete: function () {
                $btnSalvar.prop('disabled', false).text('ATUALIZAR');
            }
        });
    }

    $(document).on('click', '.acao-excluir', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const $card = $(this).closest('.favorito-card');
        const id = $card.data('id');
        const titulo = $card.find('.titulo').text();

        if (!id) return;

        if (!confirm(`Deseja realmente excluir o link "${titulo}"?`)) {
            return;
        }

        excluirFavorito(id);
    });

    function excluirFavorito(id) {
        $.ajax({
            url: `${BASE_URL}/Utils/favoritos/controller/controller.php`,
            type: 'POST',
            dataType: 'json',
            data: {
                request: 'excluirFavorito',
                id: id
            },
            success: function (res) {
                if (res.status === 'sucesso') {
                    mostrarToastFeedback('Link excluído com sucesso!', '');
                    carregarFavoritos(1);
                } else {
                    alert(res.mensagem || 'Erro ao excluir favorito');
                }
            },
            error: function () {
                alert('Erro de comunicação com o servidor');
            }
        });
    }

    $('.inputCampoPesquisaLink').on('input', function () {
        const valor = $(this).val().trim();

        if (valor === '') {
            carregarFavoritos(1);
        }
    });
});