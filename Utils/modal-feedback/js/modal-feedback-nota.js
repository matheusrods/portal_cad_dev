let rating = 0;

export function initFeedbackNota(
    modalSelector = '#modal-feedback-nota',
    btnTrigger = '#btnFeedback',
    nomeAssistente = 'Caramelo'
) {
    const $modal = $(modalSelector);

    $(document).on('click', btnTrigger, function () {
        $modal.removeClass('hidden');
        rating = 0;
        $modal.find('.stars i').removeClass('active').css('color', '#ddd');
        $modal.find('#feedback-text-nota').val('');
        $modal.find('.char-count-nota').text('500 caracteres restantes');
        $modal.find('.modal-title').text(`Avalie o Copiloto ${nomeAssistente}`);
    });

    $(document).on('click', '.close-modal, .btn-skip-nota', function () {
        $modal.addClass('hidden');
    });

    $(document).on('click', '.stars i', function () {
        rating = $(this).data('value');
        $modal.find('.stars i').removeClass('active');
        $modal.find('.stars i').each(function (index) {
            if (index < rating) $(this).addClass('active');
        });
    });

    $(document).on('mouseenter', '.stars i', function () {
        const hoverValue = $(this).data('value');
        $modal.find('.stars i').each(function (index) {
            $(this).css('color', index < hoverValue ? '#ffb800' : '#ddd');
        });
    });

    $(document).on('mouseleave', '.stars i', function () {
        $modal.find('.stars i').each(function (index) {
            $(this).css('color', index < rating ? '#ffb800' : '#ddd');
        });
    });

    $(document).on('input', '#feedback-text-nota', function () {
        const restante = 500 - $(this).val().length;
        $('.char-count-nota').text(`${restante} caracteres restantes`);
    });

    $(document).on('click', '.btn-send-nota', function () {
        const comentario = $('#feedback-text-nota').val().trim();
        $modal.addClass('hidden');

        mostrarToastFeedback(
            `Avaliação do ${nomeAssistente} enviada 😍`,
            `Seu feedback ajuda a melhorar sua experiência com o ${nomeAssistente}`
        );

        gravaFeedback('', comentario, '', rating);
    });
}