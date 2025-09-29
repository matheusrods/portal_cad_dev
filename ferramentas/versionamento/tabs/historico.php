<div id="historico-container">
    <!-- Filtros -->
    <div class="historico-filtros">
        <div class="filtro-item">
            <label for="filtro-versao">Pesquisar versão</label>
            <input type="text" id="filtro-versao" placeholder="Procure pelo número">
        </div>

        <div class="filtro-item">
            <label for="filtro-motivo">Selecionar o Motivo</label>
            <select id="filtro-motivo">
                <option value="">Todos</option>
                <option value="Programada">Programada</option>
                <option value="Excepcional">Excepcional</option>
            </select>
        </div>

        <div class="filtro-item">
            <label for="filtro-data">Selecionar data de registro</label>
            <input type="date" id="filtro-data" placeholder="DD/MM/AAAA">
        </div>

        <div class="filtro-item filtro-limpar">
            <button id="btn-limpar" class="btn-limpar">LIMPAR</button>
        </div>
    </div>

    <!-- Tabela -->
    <table id="historico-tabela">
        <thead>
        <tr>
            <th>VERSÃO <span class="sort-icon">⇅</span></th>
            <th>RESPONSÁVEL <span class="sort-icon">⇅</span></th>
            <th>DATA <span class="sort-icon">⇅</span></th>
            <th>HORA <span class="sort-icon">⇅</span></th>
            <th>MOTIVO <span class="sort-icon">⇅</span></th>
            <th>CORPUS <span class="sort-icon">⇅</span></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <!-- preenchido via JS -->
        </tbody>
    </table>

    <!-- Paginação -->
    <div class="historico-paginacao">
        <a href="#" id="mostrar-tudo">Mostrar tudo</a>
        <div style="margin-left: auto; display: flex; align-items: center; gap: 20px;">
            <span id="historico-info">Mostrando 0-0 de 0 itens</span>
            <div id="paginacao"></div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="./css/historico.css">
<script src="./js/historico.js"></script>
