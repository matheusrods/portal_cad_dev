const dadosHistorico = [
    {versao: 3741, responsavel: "F8527673", data: "2025-09-04", hora: "11:00", motivo: "Programada", corpus: "PF"},
    {versao: 3740, responsavel: "F8527672", data: "2025-09-03", hora: "11:00", motivo: "Programada", corpus: "PF"},
    {versao: 3739, responsavel: "F8527673", data: "2025-09-02", hora: "11:00", motivo: "Programada", corpus: "PF"},
    {versao: 3738, responsavel: "F8527671", data: "2025-09-01", hora: "15:00", motivo: "Excepcional", corpus: "PF"},
    {versao: 3737, responsavel: "F8527670", data: "2025-08-29", hora: "11:00", motivo: "Programada", corpus: "PF"},
    {versao: 3736, responsavel: "F8527670", data: "2025-08-28", hora: "11:00", motivo: "Programada", corpus: "PF"},
    {versao: 3735, responsavel: "F8527600", data: "2025-08-27", hora: "11:00", motivo: "Programada", corpus: "PF"},
    {versao: 3734, responsavel: "F8527600", data: "2025-08-26", hora: "14:00", motivo: "Excepcional", corpus: "PF"},
    {versao: 3733, responsavel: "F8527600", data: "2025-08-25", hora: "11:00", motivo: "Programada", corpus: "PF"},
    {versao: 3732, responsavel: "F8527600", data: "2025-08-24", hora: "11:00", motivo: "Programada", corpus: "PF"},
];

let paginaAtual = 1;
let itensPorPagina = 5;
let sortConfig = {coluna: null, ordem: 'asc'}; // controle da ordenação

function filtrarDados() {
    const versao = document.getElementById("filtro-versao").value;
    const motivo = document.getElementById("filtro-motivo").value;
    const data = document.getElementById("filtro-data").value;

    let dados = dadosHistorico.filter(item =>
        (!versao || item.versao.toString().includes(versao)) &&
        (!motivo || item.motivo === motivo) &&
        (!data || item.data === data)
    );

    // aplicar ordenação
    if (sortConfig.coluna) {
        dados = dados.sort((a, b) => {
            let valA = a[sortConfig.coluna];
            let valB = b[sortConfig.coluna];

            // se for número
            if (!isNaN(valA) && !isNaN(valB)) {
                valA = Number(valA);
                valB = Number(valB);
            }

            // se for data
            if (sortConfig.coluna === "data") {
                valA = new Date(valA);
                valB = new Date(valB);
            }

            if (valA < valB) return sortConfig.ordem === "asc" ? -1 : 1;
            if (valA > valB) return sortConfig.ordem === "asc" ? 1 : -1;
            return 0;
        });
    }

    return dados;
}

function atualizarInfo(total) {
    if (total === 0) {
        document.getElementById("historico-info").textContent = "Nenhum item encontrado";
        return;
    }
    const inicio = (paginaAtual - 1) * itensPorPagina + 1;
    const fim = Math.min(inicio + itensPorPagina - 1, total);
    document.getElementById("historico-info").textContent =
        `Mostrando ${inicio}-${fim} de ${total} itens`;
}

function renderTabela() {
    const tbody = document.querySelector("#historico-tabela tbody");
    tbody.innerHTML = "";

    const dados = filtrarDados();
    const inicio = (paginaAtual - 1) * itensPorPagina;
    const fim = inicio + itensPorPagina;
    const paginaDados = dados.slice(inicio, fim);

    paginaDados.forEach(item => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
          <td>${item.versao}</td>
          <td>${item.responsavel}</td>
          <td>${formatarData(item.data)}</td>
          <td>${item.hora}</td>
          <td>${item.motivo}</td>
          <td>${item.corpus}</td>
          <td class="icone-seta">
            <svg class="btn-detalhe" data-versao="${item.versao}" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 4 12 10 6 16"></polyline>
            </svg>
          </td>
        `;

        // clique na linha inteira
        tr.addEventListener("click", (e) => {
            // evita duplicar caso o clique seja na seta
            if (e.target.closest(".btn-detalhe")) return;
            abrirDetalhes(item.versao);
        });

        tbody.appendChild(tr);
    });

    renderPaginacao(dados.length);
    atualizarInfo(dados.length);

    // clique na seta (continua funcionando normalmente)
    document.querySelectorAll(".btn-detalhe").forEach(btn => {
        btn.addEventListener("click", e => {
            e.stopPropagation(); // impede de acionar o clique do <tr>
            const versao = e.currentTarget.dataset.versao;
            abrirDetalhes(versao);
        });
    });
}


function formatarData(isoDate) {
    if (!isoDate) return "";
    const [ano, mes, dia] = isoDate.split("-");
    return `${dia}/${mes}/${ano}`;
}

function abrirDetalhes(versao) {
    const dados = dadosHistorico.find(item => item.versao == versao);
    if (!dados) return;

    // troca para a aba de detalhes
    document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
    document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
    document.getElementById('detalhes').classList.add('active');
    document.body.classList.add("detalhes-ativo");

    // preenche os campos
    document.getElementById('detalhe-versao').textContent = dados.versao;
    document.getElementById('detalhe-responsavel').textContent = dados.responsavel;
    document.getElementById('detalhe-data').textContent = formatarData(dados.data);
    ;
    document.getElementById('detalhe-hora').textContent = dados.hora;
    document.getElementById('detalhe-motivo').textContent = dados.motivo;
    document.getElementById('detalhe-corpus').textContent = dados.corpus;
    document.getElementById('detalhe-versao-breadcrumb').textContent = dados.versao;

    // exemplo de observação
    document.getElementById('detalhe-obs').textContent =
        "Visualização clara e intuitiva de dados importantes, permitindo decisões mais assertivas e reduzindo tempo de análise manual.";

    // mock de tarefas só para teste (pode vir do backend depois)
    const tarefasContainer = document.getElementById('detalhe-tarefas');
    tarefasContainer.innerHTML = `
    <div class="tarefa-card">
      <p><a href="#">Tarefa 2138098</a></p>
      <p>[CONSULTORIA] [DEV] [SEGURIDADE] [TRN] Contratação Seguro Itens Pessoais Não Correntista</p>
      <p><span class="status status-pronta">Pronta</span></p>
    </div>
    <div class="tarefa-card">
      <p><a href="#">Tarefa 2138099</a></p>
      <p>[CONSULTORIA] [DEV] [SEGURIDADE] [TRN] Contratação Seguro Itens Pessoais Não Correntista</p>
      <p><span class="status status-andamento">Em andamento</span></p>
    </div>
  `;
}

function fecharDetalhes() {
    selectTab('historico');
    document.body.classList.remove("detalhes-ativo");
}


function renderPaginacao(total) {
    const paginacao = document.getElementById("paginacao");
    paginacao.innerHTML = "";

    const totalPaginas = Math.ceil(total / itensPorPagina);

    for (let i = 1; i <= totalPaginas; i++) {
        const btn = document.createElement("button");
        btn.textContent = i;
        btn.classList.toggle("active", i === paginaAtual);
        btn.addEventListener("click", () => {
            paginaAtual = i;
            renderTabela();
        });
        paginacao.appendChild(btn);
    }
}

/* ----------------- ORDENAR COLUNAS ----------------- */
function configurarOrdenacao() {
    const headers = document.querySelectorAll("#historico-tabela thead th");

    headers.forEach((th, index) => {
        const chave = ["versao", "responsavel", "data", "hora", "motivo", "corpus"][index];
        if (!chave) return; // última coluna não tem ordenação

        th.style.cursor = "pointer";
        th.addEventListener("click", () => {
            if (sortConfig.coluna === chave) {
                sortConfig.ordem = sortConfig.ordem === "asc" ? "desc" : "asc";
            } else {
                sortConfig.coluna = chave;
                sortConfig.ordem = "asc";
            }
            atualizarIconesOrdenacao();
            renderTabela();
        });
    });
}

function atualizarIconesOrdenacao() {
    const headers = document.querySelectorAll("#historico-tabela thead th .sort-icon");

    headers.forEach((icon, index) => {
        const chave = ["versao", "responsavel", "data", "hora", "motivo", "corpus"][index];
        if (sortConfig.coluna === chave) {
            icon.textContent = sortConfig.ordem === "asc" ? "↑" : "↓";
        } else {
            icon.textContent = "⇅";
        }
    });
}

function selectDetalhesTab(tabId, el) {
    document.querySelectorAll('.detalhes-tab-button').forEach(btn => {
        btn.classList.remove('active');
    });

    document.querySelectorAll('.detalhes-tab-content').forEach(content => {
        content.classList.remove('active');
    });

    el.classList.add('active');

    document.getElementById('tab-' + tabId).classList.add('active');
}


/* ----------------- EVENTOS ----------------- */
document.getElementById("filtro-versao").addEventListener("input", () => {
    paginaAtual = 1;
    renderTabela();
});
document.getElementById("filtro-motivo").addEventListener("change", () => {
    paginaAtual = 1;
    renderTabela();
});
document.getElementById("filtro-data").addEventListener("change", () => {
    paginaAtual = 1;
    renderTabela();
});

document.getElementById("btn-limpar").addEventListener("click", () => {
    document.getElementById("filtro-versao").value = "";
    document.getElementById("filtro-motivo").value = "";
    document.getElementById("filtro-data").value = "";
    paginaAtual = 1;
    renderTabela();
});

document.getElementById("mostrar-tudo").addEventListener("click", e => {
    e.preventDefault();
    itensPorPagina = filtrarDados().length;
    renderTabela();
});

/* ----------------- INICIALIZAÇÃO ----------------- */
configurarOrdenacao();
renderTabela();
atualizarIconesOrdenacao();