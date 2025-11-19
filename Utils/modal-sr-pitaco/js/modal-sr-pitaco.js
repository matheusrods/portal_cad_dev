function abrirModalSrPitaco() {
  const modal = document.getElementById("modal-sr-pitaco");
  modal.style.display = "flex";

  const etapa1 = modal.querySelector(".modal-sr-pitaco-etapa.etapa1");
  const etapa2 = modal.querySelector(".modal-sr-pitaco-etapa.etapa2");

  etapa1.classList.add("ativa");
  etapa2.classList.remove("ativa");
  atualizarTituloModalPitaco();
}

function atualizarTituloModalPitaco() {
  const telaAtual = window.PITACO_TELA_ATUAL || sessionStorage.getItem('PITACO_TELA_ATUAL') || 'Portal';
  const nomeFormatado = telaAtual.charAt(0).toUpperCase() + telaAtual.slice(1);

  document.querySelectorAll('.titulo-feedback').forEach(el => {
    el.textContent = `Como foi sua experiência na página ${nomeFormatado}?`;
  });
}

function fecharModalSrPitaco() {
  document.getElementById("modal-sr-pitaco").style.display = "none";
  resetarModalSrPitaco();
}

function resetarModalSrPitaco() {
  const modal = document.querySelector(".modal-sr-pitaco");
  const etapa1 = document.querySelector(".etapa1");
  const etapa2 = document.querySelector(".etapa2");

  modal.classList.remove("expandida");
  etapa1.style.display = "block";
  etapa2.style.display = "none";
  etapa1.classList.add("ativa");
  etapa2.classList.remove("ativa");
}

document.addEventListener("DOMContentLoaded", () => {
  const estrelas = document.querySelectorAll("#pitaco-estrelas-avaliacao span");
  estrelas.forEach(e => {
    e.addEventListener("click", () => {
      estrelas.forEach(s => s.classList.remove("selecionada"));
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
});

function mostrarEtapa2Pitaco(valor) {
  const modal = document.querySelector(".modal-sr-pitaco");
  const etapa1 = document.querySelector(".etapa1");
  const etapa2 = document.querySelector(".etapa2");

  // ativa transição da etapa
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

  // cria as 5 estrelas clicáveis
  for (let i = 1; i <= 5; i++) {
    const estrela = document.createElement("span");
    estrela.classList.add("estrela");
    if (i <= valor) estrela.classList.add("ativo");

    // adiciona evento de clique para mudar a nota
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
        tela: window.PITACO_TELA_ATUAL || sessionStorage.getItem('PITACO_TELA_ATUAL')
    };

    console.log("✅ Avaliação enviada:", avaliacao);

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
  if (e.target.classList.contains("motivo")) {
    e.target.classList.toggle("ativo");
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

document.addEventListener("DOMContentLoaded", () => {
  const botaoEnviar = document.querySelector(".btn-enviar");
  if (botaoEnviar) {
    botaoEnviar.disabled = true;
    botaoEnviar.classList.add("desabilitado");
  }
});
