/**
 * Exibe o popup de feedback (toast) no canto inferior direito.
 *
 * @param {string} titulo - Título principal do toast (ex: "Obrigado pelo seu feedback 😊")
 * @param {string} mensagem - Texto complementar (ex: "Vamos analisar para melhorar a sua experiência ao utilizar o Tom")
 */
function mostrarToastFeedback(titulo, mensagem) {
    // Remove qualquer toast anterior
    $('.feedback-toast').remove();

    const toast = $(`
        <div class="feedback-toast"
            style="
                position: fixed;
                bottom: 17px;
                right: 106px;
                background: #e6f4ea;
                border: 1px solid #3cba54;
                color: #333;
                padding: 23px 15px;
                border-radius: 10px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.15);
                font-size: 14px;
                max-width: 340px;
                z-index: 9999;
                animation: fadeIn 0.3s ease;
            ">
            <div style="display: flex; align-items: flex-start;">
                <div style="font-size: 18px; margin-right: 10px;"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 0C3.5816 0 0 3.5816 0 8C0 12.4184 3.5816 16 8 16C12.4184 16 16 12.4184 16 8C16 3.5816 12.4176 0 8 0ZM7.4 12.6L3.4 9.6L4.6 8L7 9.8L11.2 4.2L12.8 5.4L7.4 12.6Z" fill="#0C8A00"/>
                </svg></div>
                <div style="flex: 1;">
                    <strong>${titulo}</strong><br>
                    <span>${mensagem}</span>
                </div>
                <button class="close-toast"
                    style="
                        background: none;
                        border: none;
                        font-size: 16px;
                        margin-left: 10px;
                        cursor: pointer;
                        color: #666;
                    ">✖</button>
            </div>
        </div>
    `);

    $('body').append(toast);

    // Fecha ao clicar no X
    toast.find('.close-toast').on('click', function () {
        toast.fadeOut(200, () => toast.remove());
    });

    // Fecha automaticamente
    setTimeout(() => toast.fadeOut(500, () => toast.remove()), 6000);
}

// Exporta para uso global
window.mostrarToastFeedback = mostrarToastFeedback;
