<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/capacitacao_analytics/class/class_capacitacao.php";

    $class = new funcoes();
    $cursos = $class->consultaCursos();

    $rawRec     = $class->consultaRecursos('explorando_dados');
    $recursos   = [];
    if (!empty($rawRec['mensagem']) && $rawRec['status'] === 1) {
        $recursos = $rawRec['mensagem'];
    }

    $rawCard    = $class->consultaCards('explorando_dados');  // use o slug da sua rota
    $cards      = [];
    if (!empty($rawCard['mensagem']) && $rawCard['status'] === 1) {
        $cards = $rawCard['mensagem'];
    }
?>

<section id="explorando-dados" class="section explorando-dados">
    <div class="container">

        <!-- ícone planeta à direita -->
        <div class="decorative-planet">
            <img src="img/icone-planeta.png" alt="Planeta">
        </div>

        <!-- 1) SQL -->
        <h2 class="section-title">SQL</h2>
        <p class="expl-text">
        Nessa sessão você vai conhecer a Linguagem SQL.<br>
        As tabelas principais e suas derivadas já tratadas que são utilizadas nos painéis.
        </p>
        <div class="row explor-row">
        <div>
            <div class="sql-box">
            <h3>Com SQL, você pode realizar tarefas como:</h3>
            <ul>
                <li>Consultar dados específicos</li>
                <li>Inserir novos registros</li>
                <li>Atualizar registros existentes</li>
                <li>Excluir registros</li>
                <li>Criar e modificar a estrutura das tabelas e outros objetos do banco de dados</li>
            </ul>
            <p class="sql-summary">
                Resumindo, SQL é essencial para trabalhar com dados de forma eficiente e organizada em sistemas de gerenciamento de bancos de dados como MySQL, PostgreSQL, SQL Server, entre outros.
            </p>
            </div>
        </div>
        <div>
            <div class="courses-list">
                <h3>Cursos Recomendados Alura</h3>
                <ul>
                    <?php if (!empty($cursos['mensagem']) && $cursos['status'] == 1): ?>
                    <?php foreach ($cursos['mensagem'] as $curso): ?>
                        <li>
                        <?php if (!empty($curso['url'])): ?>
                            <a href="<?= htmlspecialchars($curso['url']) ?>" target="_blank">
                            <?= htmlspecialchars($curso['titulo']) ?>
                            </a>
                        <?php else: ?>
                            <?= htmlspecialchars($curso['titulo']) ?>
                        <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <li>Não há cursos para exibir.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        </div>
    
        <!-- Bases corporativa -->
        <h2 class="subsecao">Bases corporativa dos Bots do BB</h2>
        <p class="bases-text">
        Os dados das interações são manipulados em banco de dados MySQL, onde
        existe uma réplica no BigData no domínio <code>mygnia</code> e tabela
        <code>c4gscacud_log_nlia_infra</code>, que utilizamos para criar outras
        bases corporativas, com informações específicas para apresentar nos painéis.
        </p>

        <!-- envolvo apenas o card num wrapper de centro -->
        <div class="bases-wrapper">
        <div class="bigdata-box">
            <div class="bigdata-text">
            <h3>O que é BigData?</h3>
            <p>
                O termo Big Data refere-se a um grande volume de dados que são
                produzidos diariamente em várias fontes, como redes sociais, finanças
                e serviços de streaming.
            </p>
            </div>
            <div class="bigdata-illustration">
            <img src="img/icone-bigdata.png" alt="Ilustração BigData">
            </div>
        </div>
        </div>

        <!-- 3) Aplicações de Big Data -->
        <div class="aplicacoes-wrapper">
            <h2 class="aplicacoes-title">Aplicações de Big Data em um Banco:</h2>
            <div class="aplicacoes-bigdata">
                <div class="decorative-icon">
                <img src="img/icone-cpu.png" alt="Ícone CPU">
                </div>
                <div class="cards-app">
                <div class="card-app">
                    <img src="img/icon-analise-comportamento.png" class="card-app-icon" alt="">
                    <h4>Análise de Comportamento</h4>
                    <p>Coleta e análise de dados de transações, padrões de gasto, interações com o Bot, etc.
                    Criação de perfis de cliente para personalização de ofertas e serviços.</p>
                </div>
                <div class="card-app">
                    <img src="img/deteccao_fraudes.png" class="card-app-icon" alt="">
                    <h4>Detecção de Fraudes</h4>
                    <p>Monitoramento em tempo real de transações para identificar atividades suspeitas.
                    Uso de algoritmos de aprendizado de máquina para reconhecer padrões de fraude.</p>
                </div>
                <div class="card-app">
                    <img src="img/gestao_riscos.png" class="card-app-icon" alt="">
                    <h4>Gestão de Riscos</h4>
                    <p>Avaliação de riscos de crédito através da análise de dados financeiros históricos dos clientes.
                    Modelagem preditiva para prever inadimplência e outros riscos financeiros.</p>
                </div>
                <div class="card-app">
                    <img src="img/operacoes.png" class="card-app-icon" alt="">
                    <h4>Otimização de Operações</h4>
                    <p>Análise de dados operacionais para melhorar a eficiência e reduzir custos.
                    Previsão de demanda e otimização de recursos.</p>
                </div>
                </div>
            </div>
        </div>


        <!-- 4) Regulamentações -->
        <h2 class="subsecao">Cumprimento de Regulamentações</h2>
        <p class="expl-text">Análise de grande volume de dados para garantir conformidade com requisitos regulatórios. Relatórios são gerados para auditoria e órgãos reguladores.</p>

        <div class="grid-regulamentacoes">
            <?php if (count($cards) > 0): ?>
                <?php foreach ($cards as $c): ?>
                    <div class="card-painel pequena">
                        <div class="thumb-wrapper">
                            <img src="<?= htmlspecialchars($c['url_img'] ?? 'img/thumb_paineis.png') ?>" alt="<?= htmlspecialchars($c['name']) ?>">
                            <div class="play-icon">
                                <svg viewBox="0 0 100 100">
                                    <polygon points="40,30 70,50 40,70" fill="#fff"/>
                                </svg>
                            </div>
                        </div>
                        <?php if (!empty($c['url'])): ?>
                            <p class="card-title">
                                <a href="<?= htmlspecialchars($c['url']) ?>" target="_blank" style="color: inherit; text-decoration: none;">
                                    <?= htmlspecialchars($c['name']) ?>
                                </a>
                            </p>
                        <?php else: ?>
                            <p class="card-title"><?= htmlspecialchars($c['name']) ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="expl-text">Nenhum conteúdo disponível nesta seção.</p>
            <?php endif; ?>
        </div>

        


        <!-- 5) Recursos -->
        <h2 class="subsecao">Recursos</h2>
        <p class="expl-text">Aqui você vai encontrar todos os painéis vistos neste módulo.</p>

        <div class="grid-recursos explorando-dados">
        <?php if (count($recursos) > 0): ?>
            <?php foreach ($recursos as $r): ?>
            <div class="card-recurso">
                <div class="recurso-icon">
                <img src="img/icon_recursos.png" alt="Ícone painel">
                </div>
                <p class="recurso-title"><?= htmlspecialchars($r['name']) ?></p>
                <a href="<?= htmlspecialchars($r['url']) ?>" class="btn-acessar" target="_blank">ACESSAR</a>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="expl-text">Nenhum recurso cadastrado para este módulo.</p>
        <?php endif; ?>
        </div>


        <!-- 6) Próximo módulo -->
        <div class="proximo-modulo">
            <a href="#visualizacao-dados" class="btn-proximo">
                <div class="proximo-texto">
                <span class="linha1">Ir para o Próximo Módulo</span>
                <span class="linha2">Visualização de Dados</span>
                </div>
                <div class="proximo-icone">
                <svg viewBox="0 0 24 24" class="icon-arrow-next">
                    <path d="M8 5l7 7-7 7" stroke="#fff" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                </div>
            </a>
        </div>

    </div>
</section>
