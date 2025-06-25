<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/capacitacao_analytics/class/class_capacitacao.php";
    $class     = new funcoes();
    $rawRec    = $class->consultaRecursos('painel_metricas');  // use o slug da sua rota
    $recursos      = [];
    if (!empty($rawRec['mensagem']) && $rawRec['status'] === 1) {
        $recursos = $rawRec['mensagem'];
    }

    $rawCard    = $class->consultaCards('painel_metricas');  // use o slug da sua rota
    $cards      = [];
    if (!empty($rawCard['mensagem']) && $rawCard['status'] === 1) {
        $cards = $rawCard['mensagem'];
    }
?>


<!-- SESSÃO: CONCEITOS BÁSICOS -->
<section class="section conceitos">
    <!-- Tornamos todo o “container” relativo para posicionar elementos absolutos dentro dele -->
    <div class="container conceitos-wrapper">
        <!-- Título e texto -->
        <h2>Conceitos Básicos</h2>
        <p>
        Nessa sessão você vai encontrar conceitos básicos sobre canais de atendimento,
        usuário, input, interação, conversa, nó/hash, feedback e timeout/abandono e
        os painéis mais usados na Análise dos dados
        </p>

        <!-- IMAGEM 3D: Gráfico (à esquerda do vídeo) -->
        <div class="icon-chart">
        <img src="img/grafico.png" alt="Ícone Gráfico 3D">
        </div>

        <!-- IMAGEM 3D: Foguete (à direita do vídeo) -->
        <div class="icon-rocket">
        <img src="img/icone-rocket.png" alt="Ícone Foguete">
        </div>

        <!-- VÍDEO -->
        <div class="video-card">
        <div class="video-wrapper">
            <video controls poster="img/thumbnail-padrao.png">
            <source src="" type="video/mp4">
            Seu navegador não suporta a tag de vídeo.
            </video>
            <div class="play-overlay">
            <svg viewBox="0 0 100 100">
                <polygon points="40,30 70,50 40,70" fill="#fff"/>
            </svg>
            </div>
        </div>
        </div>

        <!-- ======================================
        GLOSSÁRIO – HTML ATUALIZADO
        ====================================== -->
        <div class="glossario-box glossario-basico">
            <input type="checkbox" id="toggle-glossario-basico" hidden checked>
            <label for="toggle-glossario-basico" class="glossario-header">
                <span>Glossário</span>
                <svg class="toggle-icon" viewBox="0 0 24 24" width="24" height="24">
                    <circle cx="12" cy="12" r="11" fill="#0BABFB"/>
                    <!-- barra horizontal -->
                    <rect class="bar-horizontal" x="6" y="11" width="12" height="2" fill="#2643C6"/>
                    <!-- barra vertical -->
                    <rect class="bar-vertical"   x="11" y="6"  width="2"  height="12" fill="#2643C6"/>
                </svg>
            </label>

            <!-- conteúdo -->
            <div class="glossario-content">
                <dl class="col-esquerda">
                <dt>jornada:</dt>
                <dd>um fluxo de interações esperadas onde tem um princípio, meio e fim.</dd>
                <dt>feedback:</dt>
                <dd>coleta de nota dada pelo usuário, normalmente após finalizar uma jornada.</dd>
                <dt>transbordo:</dt>
                <dd>quando o usuário procura o atendimento humano.</dd>
                <dt>timeout/abandono:</dt>
                <dd>quando uma interação ou jornada não tem continuidade e é acionado o timeout, limpando o contexto aplicado nas interações anteriores.</dd>
                </dl>
                <dl class="col-direita">
                <dt>usuário:</dt>
                <dd>identificado pelo número de telefone…</dd>
                <dt>input:</dt>
                <dd>termo usado para cada texto enviado pelo cliente.</dd>
                <dt>interação:</dt>
                <dd>cada mensagem trocada entre cliente e Bot BB.</dd>
                <dt>conversa:</dt>
                <dd>conjunto de mensagens trocadas entre cliente e Bot BB.</dd>
                <dt>nó/hash:</dt>
                <dd>Cada interação… identificados por uma hash única.</dd>
                </dl>
            </div>
        </div>
    </div>
</section>


<!-- SESSÃO: PRINCIPAIS MÉTRICAS -->
<section class="section metricas">
    <div class="container">
        <h2>Principais Métricas</h2>
        <p class="metricas-p">É muito importante entender os dados e transformá-los em informação, para isso nosso equipe de dados utiliza o Power BI e o Spotfire para criar os painéis. Vamos encontrar painéis para custos, qualidade, evolução do Chat, acompanhamento de acesso, panel de finanças, etc. para negociação e muito mais.</p>

        <div class="glossario-box glossario-metricas">
            <input type="checkbox" id="toggle-glossario-metricas" hidden>
            <label for="toggle-glossario-metricas" class="glossario-header">
                <span>Glossário</span>
                <svg class="toggle-icon" viewBox="0 0 24 24" width="24" height="24">
                <circle cx="12" cy="12" r="11" fill="#0BABFB"/>
                <rect class="bar-horizontal" x="6" y="11" width="12" height="2"  fill="#2643C6"/>
                <rect class="bar-vertical"   x="11" y="6"  width="2"  height="12" fill="#2643C6"/>
                </svg>
            </label>
            <div class="glossario-content">
                <dl class="col-esquerda">
                <dt>usuários:</dt>
                <dd>quantidade de usuários que tiveram contato com o Bot</dd>
                <dt>conversa:</dt>
                <dd>quantidade de grupos de interações</dd>
                <dt>interações:</dt>
                <dd>quantidade de interações</dd>
                </dl>
                <dl class="col-direita">
                <dt>nota de satisfação:</dt>
                <dd>média das notas dadas pelos usuários</dd>
                <dt>transbordo:</dt>
                <dd>quantidade de solicitações de atendimento humano</dd>
                <dt>volume de negócios:</dt>
                <dd>quantidade de identificação de sucesso em jornadas negociais</dd>
                </dl>
            </div>
            </div>


        <p class="subtitulo-grid">Abaixo vamos conhecer os painéis e suas métricas:</p>

        <!-- GRID DE THUMBNAILS COM PLAY -->

        <div class="grid-cards">
            <?php if (count($cards) > 0): ?>
                <?php foreach ($cards as $c): ?>
                <div class="card-painel">
                    <div class="thumb-wrapper">
                        <img src="<?= htmlspecialchars($c['url_img'] ?? 'img/thumb_paineis.png') ?>" alt="<?= htmlspecialchars($c['name']) ?>">
                        <div class="play-icon">
                            <svg viewBox="0 0 100 100">
                                <polygon points="40,30 70,50 40,70" fill="#fff"/>
                            </svg>
                        </div>
                    </div>
                    <?php if (!empty($c['url'])): ?>
                        <a href="<?= htmlspecialchars($c['url']) ?>" class="card-title" target="_blank">
                            <?= htmlspecialchars($c['name']) ?>
                        </a>
                    <?php else: ?>
                        <p class="card-title"><?= htmlspecialchars($c['name']) ?></p>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="expl-text">Nenhum card encontrado para este módulo.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- SESSÃO: RECURSOS -->
<section class="section recursos">
    <div class="container">
        <h2>Recursos</h2>
        <p>Aqui você vai encontrar todos os painéis vistos nesse módulo.</p>

        <div class="grid-recursos">
            <?php if (count($recursos) > 0): ?>
                <?php foreach ($recursos as $r): ?>
                <div class="card-recurso">
                    <div class="recurso-icon">
                    <img src="img/icon_recursos.png" alt="Ícone painel">
                    </div>

                    <!-- ícone de “+” no recurso específico -->
                    <?php if ($r['name'] === 'Todos os Painéis'): ?>
                    <img src="img/+.png" alt="Mais painéis" class="plus-icon">
                    <?php endif; ?>

                    <p class="recurso-title"><?= htmlspecialchars($r['name']) ?></p>
                    
                    <!-- se tiver URL, abre em nova aba -->
                    <?php if (!empty($r['url'])): ?>
                    <a href="<?= htmlspecialchars($r['url']) ?>" class="btn-acessar" target="_blank">
                        ACESSAR
                    </a>
                    <?php else: ?>
                        <a href="#" class="btn-acessar">ACESSAR</a>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="expl-text">Nenhum recurso cadastrado para este módulo.</p>
            <?php endif; ?>
        </div>

        <!-- BOTÃO PARA O PRÓXIMO MÓDULO -->
        <div class="proximo-modulo">
            <a href="#explorando-dados" class="btn-proximo">
                <div class="proximo-texto">
                <span class="linha1">Ir para o Próximo Módulo</span>
                <span class="linha2">Explorando Dados</span>
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