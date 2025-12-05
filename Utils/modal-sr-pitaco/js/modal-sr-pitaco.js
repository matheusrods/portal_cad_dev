let PITACO_ESTRELAS_ETAPA2_HTML = null;

document.addEventListener("DOMContentLoaded", () => {
    const estrelas2 = document.querySelector(".estrelas.selecionadas");
    if (estrelas2) {
        PITACO_ESTRELAS_ETAPA2_HTML = estrelas2.innerHTML;
    }
});

function aplicarComportamentoEstrelas(container, callbackClick = null, notaInicial = 0) {
    const estrelas = container.querySelectorAll("span");
    let notaSelecionada = notaInicial;
    let notaHover = 0;

    estrelas.forEach((s, i) => {
        s.classList.toggle("ativo", i + 1 <= notaSelecionada);
    });

    estrelas.forEach((estrela, idx) => {
        const valor = idx + 1;

        estrela.addEventListener("mouseenter", () => {
            notaHover = valor;
            estrelas.forEach((s, i) => s.classList.toggle("ativo", i + 1 <= notaHover));
        });

        estrela.addEventListener("mouseleave", () => {
            estrelas.forEach((s, i) => s.classList.toggle("ativo", i + 1 <= notaSelecionada));
        });

        estrela.addEventListener("click", () => {
            notaSelecionada = valor;
            estrelas.forEach((s, i) => s.classList.toggle("ativo", i + 1 <= notaSelecionada));

            if (callbackClick) callbackClick(valor);
        });
    });
}


function abrirModalSrPitaco(portal = false) {
    resetarModalSrPitaco();
    document.body.classList.add("modal-pitaco-open");
    const modal = document.getElementById("modal-sr-pitaco");
    modal.style.display = "flex";

    const etapa1 = modal.querySelector(".modal-sr-pitaco-etapa.etapa1");
    const etapa2 = modal.querySelector(".modal-sr-pitaco-etapa.etapa2");

    etapa1.classList.add("ativa");
    etapa2.classList.remove("ativa");
    atualizarTituloModalPitaco(portal);
    inicializarEstrelasPitaco();
    inicializarBotaoEnviar();
}

function atualizarTituloModalPitaco(portal = false) {
    const telaAtual = portal
        ? 'Portal'
        : (window.PITACO_TELA_ATUAL || sessionStorage.getItem('PITACO_TELA_ATUAL'));

    if (portal) {
        window.PITACO_PORTAL = telaAtual;

        document.querySelectorAll('.titulo-feedback').forEach(el => {
            el.textContent = `Como foi sua experiência navegando pelo Portal?`;
        });

        document.querySelectorAll('.modal-sr-pitaco-etapa.etapa1 .pitaco-balao').forEach(el => {
            el.textContent = `Olá! Eu sou o Sr. Pitaco. Estou curioso pra saber o que você achou do Portal! 😄`;
        });

        document.querySelectorAll('.pitaco-feedback-form textarea.comentario').forEach(el => {
            el.placeholder = "Conte aqui a sua experiência ao todo no Portal";
        });

        return;
    }

    window.PITACO_PORTAL = null;

    buscaNomePaginaAtual(telaAtual, function (nomePagina) {
        let nomeFormatado = nomePagina.charAt(0).toUpperCase() + nomePagina.slice(1);
        nomeFormatado = nomeFormatado.replace(/\?/g, '');

        document.querySelectorAll('.titulo-feedback').forEach(el => {
            el.textContent = `Como foi sua experiência na página ${nomeFormatado}?`;
        });

        document.querySelectorAll('.modal-sr-pitaco-etapa.etapa1 .pitaco-balao').forEach(el => {
            el.textContent = `Olá! Eu sou o Sr Pitaco, me conte como foi sua experiência hoje nessa página ? 😊`;
        });

        document.querySelectorAll('.pitaco-feedback-form textarea.comentario').forEach(el => {
            el.placeholder = "Conte aqui a sua experiência nessa página";
        });
    });
}


function fecharModalSrPitaco() {
    document.body.classList.remove("modal-pitaco-open");
    document.getElementById("modal-sr-pitaco").style.display = "none";
    resetarModalSrPitaco();
}

function resetarModalSrPitaco() {
    const overlay = document.getElementById("modal-sr-pitaco");
    if (!overlay) return;

    const modal = overlay.querySelector(".modal-sr-pitaco");

    modal.classList.remove("expandida");

    const etapa1 = overlay.querySelector(".etapa1");
    const etapa2 = overlay.querySelector(".etapa2");

    etapa1.style.display = "block";
    etapa2.style.display = "none";

    etapa1.classList.add("ativa");
    etapa2.classList.remove("ativa");

    overlay.querySelectorAll("#pitaco-estrelas-avaliacao span")
        .forEach(s => s.classList.remove("selecionada"));

    const estrelasDiv = overlay.querySelector(".estrelas.selecionadas");
    if (estrelasDiv && PITACO_ESTRELAS_ETAPA2_HTML) {
        estrelasDiv.innerHTML = PITACO_ESTRELAS_ETAPA2_HTML;
    }

    const textoNota = overlay.querySelector("#pitaco-texto-nota");
    if (textoNota) textoNota.textContent = "Neutro";

    overlay.querySelectorAll(".motivo.ativo")
        .forEach(m => m.classList.remove("ativo"));

    const comentario = overlay.querySelector(".comentario");
    if (comentario) comentario.value = "";

    const contador = overlay.querySelector(".contador-caracteres");
    if (contador) contador.textContent = "500 caracteres restantes";

    const botao = overlay.querySelector(".btn-enviar");
    if (botao) {
        botao.disabled = true;
        botao.classList.add("desabilitado");
    }
}

function inicializarEstrelasPitaco() {
    const container = document.querySelector("#pitaco-estrelas-avaliacao");

    if (!container) return;
    const estrelas = container.querySelectorAll("span");
    estrelas.forEach(e => {
        const clone = e.cloneNode(true);
        clone.dataset.valor = e.dataset.valor;
        e.replaceWith(clone);
    });

    aplicarComportamentoEstrelas(container, (valor) => {
        mostrarEtapa2Pitaco(valor);
    });

    const comentario = document.querySelector(".comentario");
    const contador = document.querySelector(".contador-caracteres");

    if (comentario && contador)
        comentario.addEventListener("input", () => {
            contador.textContent = `${500 - comentario.value.length} caracteres restantes`;
        });
}

function mostrarEtapa2Pitaco(valor) {
    const modal = document.querySelector(".modal-sr-pitaco");
    const etapa1 = document.querySelector(".etapa1");
    const etapa2 = document.querySelector(".etapa2");

    modal.classList.add("expandida");
    etapa1.classList.remove("ativa");

    setTimeout(() => {
        etapa1.style.display = "none";
        etapa2.style.display = "block";
        setTimeout(() => etapa2.classList.add("ativa"), 50);
    }, 300);

    const textoNota = document.getElementById("pitaco-texto-nota");
    const estrelasDiv = document.querySelector(".estrelas.selecionadas");
    estrelasDiv.innerHTML = "";

    for (let i = 1; i <= 5; i++) {
        const estrela = document.createElement("span");
        estrela.dataset.valor = i;
        estrela.classList.add("estrela");
        if (i <= valor) estrela.classList.add("ativo");
        estrelasDiv.appendChild(estrela);
    }

    aplicarComportamentoEstrelas(
        estrelasDiv,
        (val) => mostrarEtapa2Pitaco(val),
        valor
    );

    setTimeout(() => {
        carregarMotivosPorNota(valor).then(motivos => {
            renderizarMotivos(motivos);
        });
    }, 350);

    const textos = {
        1: "Muito Insatisfeito",
        2: "Insatisfeito",
        3: "Neutro",
        4: "Satisfeito",
        5: "Muito satisfeito"
    };
    textoNota.textContent = textos[valor] || "Neutro";
}


function enviarModalSrPitaco() {
    var caminhoController = `${BASE_URL}/Utils/modal-sr-pitaco/controller/controller.php`;

    const estrelasAtivas = document.querySelectorAll(".estrelas.selecionadas .estrela.ativo");
    const nota = estrelasAtivas.length;

    const motivosSelecionados = Array.from(document.querySelectorAll(".motivo.ativo")).map(
        el => el.dataset.id
    );
    const comentario = document.querySelector(".comentario").value.trim();

    const avaliacao = {
        request: 'gravaFeedbackSrPitaco',
        nota: nota,
        motivos: motivosSelecionados,
        comentario: comentario,
        tela: window.PITACO_PORTAL != null ? window.PITACO_PORTAL : window.PITACO_TELA_ATUAL || sessionStorage.getItem('PITACO_TELA_ATUAL')
    };

    $.ajax({
        async: true,
        url: caminhoController,
        type: "POST",
        dataType: "JSON",
        data: avaliacao,
        success: function (retorno) {
            fecharFeedbackFloat();
            fecharModalSrPitaco();

            if (window.PITACO_PORTAL === 'Portal') {
                mostrarToastFeedback(
                    "Avaliação do Portal enviada 😍",
                    "Seu feedback ajuda a melhorar <br> sua experiência com o Portal",
                    true
                );
            } else {
                mostrarToastFeedback(
                    "Avaliação da página enviada 😍",
                    "Seu feedback ajuda a melhorar <br> sua experiência com o Portal",
                    true
                );
            }
        },
        error: function (xhr, status, error) {
        }
    });
}

document.addEventListener("click", function (e) {
    const motivo = e.target.closest(".motivo");
    if (motivo) {
        motivo.classList.toggle("ativo");
        atualizarEstadoBotaoEnviar();
    }
});


function atualizarEstadoBotaoEnviar() {
    const motivosSelecionados = document.querySelectorAll(".motivo.ativo");
    const botaoEnviar = document.querySelector(".btn-enviar");

    if (motivosSelecionados.length > 0) {
        botaoEnviar.disabled = false;
        botaoEnviar.classList.remove("desabilitado");
    } else {
        botaoEnviar.disabled = true;
        botaoEnviar.classList.add("desabilitado");
    }
}

function inicializarBotaoEnviar() {
    const botaoEnviar = document.querySelector(".btn-enviar");
    if (botaoEnviar) {
        botaoEnviar.disabled = true;
        botaoEnviar.classList.add("desabilitado");
    }
}

function buscaNomePaginaAtual(telaAtual, callback) {
    var caminhoController = `${BASE_URL}/Utils/modal-sr-pitaco/controller/controller.php`;

    const payload = {
        request: 'getnomePaginaAtual',
        tela: telaAtual
    };

    $.ajax({
        async: true,
        url: caminhoController,
        type: "GET",
        dataType: "JSON",
        data: payload,
        success: function (retorno) {
            if (typeof callback === "function") {
                if (retorno.status === 1) {
                    console.log(retorno.nome);
                    callback(retorno.nome);
                } else {
                    callback('');
                }
            }
        },
        error: function () {
            if (typeof callback === "function") {
                callback('');
            }
        }
    });
}

function renderizarMotivos(motivos) {
    const container = document.getElementById("pitaco-motivos");
    container.innerHTML = "";

    motivos.forEach(m => {
        const button = document.createElement("button");
        button.classList.add("motivo");
        button.dataset.id = m.id;
        button.textContent = m.descricao;

        container.appendChild(button);
    });
}


function carregarMotivosPorNota(nota) {
    return new Promise((resolve) => {
        $.ajax({
            url: `${BASE_URL}/Utils/modal-sr-pitaco/controller/controller.php`,
            type: "GET",
            dataType: "JSON",
            data: {
                request: "getMotivosPorNota",
                nota: nota
            },
            success: (ret) => resolve(ret.motivos || []),
            error: () => resolve([])
        });
    });
}

