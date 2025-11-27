let PITACO_ESTRELAS_ETAPA2_HTML = null;

document.addEventListener("DOMContentLoaded", () => {
    const estrelas2 = document.querySelector(".estrelas.selecionadas");
    if (estrelas2) {
        PITACO_ESTRELAS_ETAPA2_HTML = estrelas2.innerHTML;
    }
});

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
    console.log(window.PITACO_TELA_ATUAL);
    const telaAtual = portal 
        ? 'Portal' 
        : (window.PITACO_TELA_ATUAL || sessionStorage.getItem('PITACO_TELA_ATUAL'));

    if (portal) {
        window.PITACO_PORTAL = telaAtual;

        document.querySelectorAll('.titulo-feedback').forEach(el => {
            el.textContent = `Como foi sua experiência no Portal?`;
        });

        return;
    }

    window.PITACO_PORTAL = null;

    console.log(telaAtual);

    buscaNomePaginaAtual(telaAtual, function(nomePagina) {
        console.log(nomePagina);
        const nomeFormatado = nomePagina.charAt(0).toUpperCase() + nomePagina.slice(1);

        document.querySelectorAll('.titulo-feedback').forEach(el => {
            el.textContent = `Como foi sua experiência na página ${nomeFormatado}?`;
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
    const estrelas = document.querySelectorAll("#pitaco-estrelas-avaliacao span");

    if (!estrelas.length) return;

    estrelas.forEach(e => {
        const clone = e.cloneNode(true);
        e.replaceWith(clone);
    });

    const novasEstrelas = document.querySelectorAll("#pitaco-estrelas-avaliacao span");

    novasEstrelas.forEach(e => {
        e.addEventListener("click", () => {
            novasEstrelas.forEach(s => s.classList.remove("selecionada"));
            e.classList.add("selecionada");
            mostrarEtapa2Pitaco(e.dataset.valor);
        });
    });

    const comentario = document.querySelector(".comentario");
    const contador = document.querySelector(".contador-caracteres");

    if (comentario)
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
        estrela.classList.add("estrela");
        if (i <= valor) estrela.classList.add("ativo");

        estrela.addEventListener("click", () => {
            mostrarEtapa2Pitaco(i);
        });

        estrelasDiv.appendChild(estrela);
    }

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
            mostrarToastFeedback(
                "Avaliação da página enviada 😍",
                "Seu feedback ajuda a melhorar <br> sua experiência com o Portal",
                true
            );
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
