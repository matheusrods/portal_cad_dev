/**
 * Exibe o popup de feedback (toast) no canto inferior direito.
 * @param {string} titulo - Título principal do toast
 * @param {string} mensagem - Texto complementar
 * @param {boolean} comPitaco - (opcional) Se true, mostra o Sr Pitaco
 * @param {string} tipo - (opcional) 'sucesso' | 'erro'
 */
function mostrarToastFeedback(titulo, mensagem, comPitaco = false, tipo = 'sucesso') {
    $('.feedback-toast').remove();

    const isErro = tipo === 'erro';

    const cores = isErro
        ? {
            bg: '#fdecea',
            border: '#e53935',
            icon: '#c62828'
        }
        : {
            bg: '#e9f8ed',
            border: '#3cba54',
            icon: '#0C8A00'
        };

    const imagemPitaco = (!isErro && comPitaco)
        ? `<img src="/Utils/feedback-float/img/sr_pitaco_like.png"
                 alt="Sr Pitaco"
                 style="width: 90px; height: auto; margin-right: 12px; flex-shrink: 0;">`
        : '';

    const icone = isErro
        ? `
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 
                         10-4.48 10-10S17.52 2 12 2Zm1 15h-2v-2h2v2Zm0-4h-2V7h2v6Z"
                      fill="${cores.icon}"/>
            </svg>
        `
        : `
            <svg width="18" height="18" viewBox="0 0 16 16" fill="none">
                <path d="M8 0C3.5816 0 0 3.5816 0 8C0 12.4184 
                         3.5816 16 8 16C12.4184 16 
                         16 12.4184 16 8C16 3.5816 
                         12.4176 0 8 0ZM7.4 12.6L3.4 
                         9.6L4.6 8L7 9.8L11.2 4.2L12.8 
                         5.4L7.4 12.6Z"
                      fill="${cores.icon}"/>
            </svg>
        `;

    const toast = $(`
        <div class="feedback-toast"
            style="
                position: fixed;
                bottom: 20px;
                right: 100px;
                background: ${cores.bg};
                border: 1px solid ${cores.border};
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
                    <div style="display: flex; align-items: center; gap: 6px;">
                        ${icone}
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