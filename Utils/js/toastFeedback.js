/**
 * Exibe o popup de feedback (toast) no canto inferior direito.
 * @param {string} titulo - Título principal do toast
 * @param {string} mensagem - Texto complementar
 * @param {boolean} comPitaco - (opcional) Se true, mostra o Sr Pitaco thumbs-up
 */
function mostrarToastFeedback(titulo, mensagem, comPitaco = false) {
    $('.feedback-toast').remove();

    const imagemPitaco = comPitaco
        ? `<img src="/Utils/feedback-float/img/sr_pitaco_like.png"
                 alt="Sr Pitaco"
                 style="width: 90px; height: auto; margin-right: 12px; flex-shrink: 0;">`
        : '';

    const toast = $(`
        <div class="feedback-toast"
            style="
                position: fixed;
                bottom: 20px;
                right: 100px;
                background: #e9f8ed;
                border: 1px solid #3cba54;
                color: #333;
                padding: 28px 20px;
                border-radius: 12px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                font-size: 14px;
                max-width: 440px;
                display: flex;
                align-items: center;
                z-index: 9999;
                animation: fadeInUp 0.35s ease;
            ">

            ${imagemPitaco}

            <div style="flex: 1;">
                <div style="display: flex; justify-content: space-between; align-items: start;">
                    <div style="display: flex; align-items: center;">
                        <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 6px;">
                            <path d="M8 0C3.5816 0 0 3.5816 0 8C0 12.4184 3.5816 16 8 16C12.4184 16 16 12.4184 16 8C16 3.5816 12.4176 0 8 0ZM7.4 12.6L3.4 9.6L4.6 8L7 9.8L11.2 4.2L12.8 5.4L7.4 12.6Z" fill="#0C8A00"/>
                        </svg>
                        <div style="font-weight: 600; font-size: 15px;">
                            ${titulo}
                        </div>
                    </div>
                    <button class="close-toast"
                        style="
                            background: none;
                            border: none;
                            font-size: 10px !important;
                            line-height: 1;
                            margin-left: 10px;
                            cursor: pointer;
                            color: #666;
                            margin-top: -18px;
                        ">✖</button>
                </div>
                <div style="font-size: 14px; margin-top: 6px; line-height: 1.4;">
                    ${mensagem}
                </div>
            </div>
        </div>
    `);

    $('body').append(toast);

    toast.find('.close-toast').on('click', function () {
        toast.fadeOut(200, () => toast.remove());
    });

    setTimeout(() => toast.fadeOut(500, () => toast.remove()), 6000);
}

if (!window.__toastFeedback__loaded) {
    window.__toastFeedback__loaded = true;

    let styleEl = document.querySelector('style[data-toast-style]');
    if (!styleEl) {
        styleEl = document.createElement('style');
        styleEl.setAttribute('data-toast-style', 'true');
        styleEl.textContent = `
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(10px); }
                to   { opacity: 1; transform: translateY(0); }
            }
        `;
        document.head.appendChild(styleEl);
    }

    window.mostrarToastFeedback = mostrarToastFeedback;
}