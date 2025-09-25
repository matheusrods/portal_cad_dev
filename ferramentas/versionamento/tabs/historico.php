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
            <button id="btn-limpar" class="btn-limpar">
                <svg width="85" height="40" viewBox="0 0 85 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="85" height="40" rx="4" fill="#E0E9FF"/>
                    <path d="M23.8023 25H17.0823V15.256H19.1963V22.984H23.8023V25ZM27.4148 25H25.3008V15.256H27.4148V25ZM31.097 25H29.081L30.397 15.256H32.483L34.961 21.402L37.439 15.256H39.511L40.841 25H38.755L37.971 18.644L35.871 23.754H33.967L31.881 18.504L31.097 25ZM42.5036 25V15.256H46.2556C46.9929 15.256 47.6416 15.382 48.2016 15.634C48.7616 15.886 49.1956 16.2453 49.5036 16.712C49.8116 17.1787 49.9656 17.72 49.9656 18.336C49.9656 20.408 48.1643 21.7147 44.5616 22.256V25H42.5036ZM44.5616 20.45C45.7936 20.2727 46.6429 20.0113 47.1096 19.666C47.5856 19.3207 47.8236 18.9007 47.8236 18.406C47.8236 17.9767 47.6883 17.6453 47.4176 17.412C47.1469 17.1787 46.7409 17.062 46.1996 17.062H44.5616V20.45ZM51.8089 25H49.6389L53.2089 15.256H55.7569L59.3269 25H57.1149L56.3729 22.872H52.5229L51.8089 25ZM54.4129 17.174L53.0689 21.178H55.7989L54.4129 17.174ZM60.6631 25V15.256H64.3311C65.4605 15.256 66.3565 15.522 67.0191 16.054C67.6911 16.586 68.0271 17.314 68.0271 18.238C68.0271 19.386 67.4391 20.2867 66.2631 20.94L68.7271 25H66.4031L64.4291 21.696C63.9158 21.836 63.3278 21.962 62.6651 22.074V25H60.6631ZM62.6651 20.338C63.8785 20.1513 64.7185 19.8947 65.1851 19.568C65.6611 19.2413 65.8991 18.8307 65.8991 18.336C65.8991 17.9347 65.7591 17.6173 65.4791 17.384C65.2085 17.1507 64.8025 17.034 64.2611 17.034H62.6651V20.338Z"
                          fill="#465EFF"/>
                </svg>
            </button>
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
