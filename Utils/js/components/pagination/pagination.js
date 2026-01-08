(function (window, $) {

    window.renderPagination = function ({
        container,
        total,
        limite,
        paginaAtual,
        onChange,
        alignEnd = true
    }) {
        const totalPaginas = Math.ceil(total / limite);
        const $container = $(container);

        $container
            .empty()
            .addClass('pagination');

        if (alignEnd) {
            $container.addClass('pagination--end');
        }

        if (totalPaginas <= 1) return;

        if (paginaAtual > 1) {
            const $prev = $('<button class="pagination__arrow pagination__arrow--prev" aria-label="Anterior"></button>');
            $prev.on('click', () => onChange(paginaAtual - 1));
            $container.append($prev);
        }

        for (let i = 1; i <= totalPaginas; i++) {
            const $page = $(`
                <button class="pagination__page ${i === paginaAtual ? 'is-active' : ''}">
                    ${i}
                </button>
            `);

            if (i !== paginaAtual) {
                $page.on('click', () => onChange(i));
            }

            $container.append($page);
        }

        if (paginaAtual < totalPaginas) {
            const $next = $('<button class="pagination__arrow" aria-label="Próxima"></button>');
            $next.on('click', () => onChange(paginaAtual + 1));
            $container.append($next);
        }
    };

})(window, jQuery);