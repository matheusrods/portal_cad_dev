<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/capacitacao_analytics/class/class_capacitacao.php";
$class = new funcoes();
$cursosBI = $class->consultaPowerBi();
$cursosSpotfire = $class->consultaCursosSpotfire();
$raw = $class->consultaRecursos('visualizacao_dados');

$visRecursos = [];
  if (!empty($raw['mensagem']) && $raw['status'] === 1) {
    $visRecursos = $raw['mensagem'];
  }

  // mapeamentos para ícones e descrições
  $icons = [
    'Power BI'                     => 'icon_powerbi_odbc.png',
    'Spotfire'                     => 'icon_spotfire_odbc.png',
    'Template de estrutura do CAD' => 'icon-download.png',
  ];
  $descs = [
    'Power BI'                     => 'Instalação do ODBC Hive',
    'Spotfire'                     => 'Instalação do ODBC Hive',
    'Template de estrutura do CAD' => 'Download do template',
  ];

   $rawCard    = $class->consultaCards('visualizacao_dados');  // use o slug da sua rota
    $cards      = [];
    if (!empty($rawCard['mensagem']) && $rawCard['status'] === 1) {
        $cards = $rawCard['mensagem'];
    }
?>


<section id="explorando-dados" class="section visualizacao-dados">
    <div class="container">

        <!-- 1) Título da seção -->
        <h2 class="visualizacao-title">Power BI e Spotfire</h2>
        <p class="visualizacao-subtitle">Ferramentas de visualização de dados: Power BI e Spotfire</p>

        <!-- 2) Cards de cursos lado a lado -->
        <div class="visualizacao-tools-row">
        <!-- Power BI -->
        <div class="tool-box">
            <div class="tool-header">
            <img class="tool-icon" src="img/icon-powerbi.png" alt="Power BI">
            <h3>Power BI</h3>
            </div>
            <ul>
            <?php if (!empty($cursosBI) && $cursosBI['status'] == 1): ?>
                <?php foreach($cursosBI['mensagem'] as $curso): ?>
                <li><a href="<?= htmlspecialchars($curso['url']) ?>" target="_blank"><?= htmlspecialchars($curso['titulo']) ?></a></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Não há cursos para exibir.</li>
            <?php endif; ?>
            </ul>
        </div>

        <!-- Spotfire -->
        <div class="tool-box">
            <div class="tool-header">
            <img class="tool-icon" src="img/icon-spotfire.png" alt="Spotfire">
            <h3>Spotfire</h3>
            </div>
            <ul>
            <?php if (!empty($cursosSpotfire) && $cursosSpotfire['status'] == 1): ?>
                <?php foreach($cursosSpotfire['mensagem'] as $curso): ?>
                <li><a href="<?= htmlspecialchars($curso['url']) ?>" target="_blank"><?= htmlspecialchars($curso['titulo']) ?></a></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Não há cursos para exibir.</li>
            <?php endif; ?>
            </ul>
        </div>
        </div>

        <!-- 3) Link adicional -->
        <p class="visualizacao-note">Outros painéis estão disponíveis no portal DS: <a href="https://ds.intranet.bb.com.br/" target="_blank">https://ds.intranet.bb.com.br/</a></p>
        <h2 class="visualizacao-title">Conectando bases de dados com Power BI e Spotfire</h2>
        <div class="grid-regulamentacoes">
            <?php if (count($cards) > 0): ?>
                <?php foreach ($cards as $c): ?>
                    <div class="card-painel pequena">
                        <div class="thumb-wrapper">
                            <img src="<?= htmlspecialchars($c['url_img'] ?? 'img/thumb_paineis.png') ?>" alt="Thumb do Card">
                            <div class="play-icon">
                                <svg viewBox="0 0 100 100">
                                    <polygon points="40,30 70,50 40,70" fill="#fff"/>
                                </svg>
                            </div>
                        </div>

                        <?php if (!empty($c['url'])): ?>
                            <p class="card-title">
                                <a href="<?= htmlspecialchars($c['url']) ?>" target="_blank" style="color: inherit; text-decoration: none;">
                                    <?= $c['name'] ?>
                                </a>
                            </p>
                        <?php else: ?>
                            <p class="card-title"><?= $c['name'] ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="expl-text">Nenhum conteúdo disponível nesta seção.</p>
            <?php endif; ?>
        </div>


        <div class="visualizacao-resources-row">
            <?php if (count($visRecursos) > 0): ?>
                <?php foreach ($visRecursos as $r): 
                $name    = $r['name'];
                $icon    = $icons[$name]  ?? 'icon_recursos.png';
                $desc    = $descs[$name]  ?? '';
                $btnText = strpos($name, 'Template') !== false ? 'BAIXAR' : 'ACESSAR';
                $url     = !empty($r['url']) ? $r['url'] : '#';
                ?>
                <div class="resource-box">
                    <img src="img/<?= $icon ?>" alt="<?= htmlspecialchars($name) ?>">
                    <h4><?= htmlspecialchars($name) ?></h4>
                    <?php if ($desc): ?>
                    <p><?= $desc ?></p>
                    <?php endif; ?>
                    <a href="<?= htmlspecialchars($url) ?>"
                    class="btn-acessar"
                    target="_blank"
                    >
                    <?= $btnText ?>
                    </a>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="expl-text">Nenhum recurso cadastrado para este módulo.</p>
            <?php endif; ?>
        </div>

        <div class="proximo-modulo">
            <a href="#engenharia-dados" class="btn-proximo">
                <div class="proximo-texto">
                <span class="linha1">Ir para o Próximo Módulo</span>
                <span class="linha2">Engenharia de Dados</span>
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