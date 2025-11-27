<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/capacitacao_analytics/class/class_capacitacao.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/Utils/Ambiente.php";

    $class      = new funcoes();
    $respRaw    = $class->consultaResponsabilidades();
    $resp       = $respRaw['status']===1 ? $respRaw['mensagem'] : [];

    $cursosPy   = $class->consultaCursosPython()['mensagem'] ?? [];
    if (!is_array($cursosPy)) {
      $cursosPy = [];
    }
    $cursosSp   = $class->consultaCursosSpark()['mensagem'] ?? [];
    if (!is_array($cursosSp)) {
      $cursosSp = [];
    }
    $recRaw     = $class->consultaRecursos('engenharia_dados');
    $recursos   = $recRaw['mensagem'] ?? [];
    if (!is_array($recursos)) {
      $recursos = [];
    }

    $respWorkshops = $class->consultaWorkshops();
    $workshops = $respWorkshops['status']===1 ? $respWorkshops['mensagem'] : [];
?>
<section id="engenharia-dados" class="section engenharia-dados">
  <div class="container">

    <!-- Título e introdução -->
    <h2 class="section-title">Engenharia de Dados</h2>
    <p class="expl-text">
      Nessa seção você vai conhecer ferramentas aderentes ao Big Data, configuração,
      como usá-las e construção de ETLs em ambiente corporativo.
    </p>

    <!-- 1) O que é Engenharia de Dados? -->
    <div class="eng-data-card">
        <div class="eng-data-text">
            <h3>O que é Engenharia de Dados?</h3>
            <p>
            Engenharia de Dados é um campo da ciência da computação que se concentra 
            na coleta, transformação, armazenamento e distribuição de dados.
            </p>
            <p>
            Os engenheiros de dados constroem e mantêm infraestruturas de dados que 
            permitem o processamento eficiente de grandes volumes de dados e a 
            extração de informações úteis para empresas e organizações.
            </p>
        </div>
        <div class="eng-data-image">
            <img src="<?php echo getBaseUrl().'/lib/apps/capacitacao_analytics/';?>img/icone-eng-data.png" alt="Ilustração Engenharia de Dados">
        </div>
    </div>

    <!-- 2) Responsabilidades -->
    <h3 class="subsecao responsibilities-title">Principais responsabilidades</h3>
    <p class="responsibilities-intro">
    Aqui estão alguns dos principais aspectos e responsabilidades da Engenharia de Dados:
    </p>
    <table class="responsibilities">
    <?php foreach($resp as $item): ?>
        <tr>
            <td class="num"><?= str_pad($item['ordem'],2,'0',STR_PAD_LEFT) ?></td>
            <td style="width: 40%;"><?= htmlspecialchars($item['titulo']) ?></td>
            <td class="descricaoResponsabilidades" style="width: 50%;"><?= htmlspecialchars($item['descricao']) ?></td>
        </tr>
        <tr style="height: 1px;">
            <td class="linhaSeparadoraResponsabilidades" colspan="3">
                <div style="height: 1px; background-color: white; opacity: 0.4; width: 100%; height: 1px;"></div>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>

    <!-- 3) Cursos Sugeridos Alura -->
    <h3 class="subsecao">Cursos Sugeridos Alura</h3>
    <div class="grid-dual-courses">
      <!-- Python -->
      <div class="courses-list">
        <img class="course-icon" src="<?php echo getBaseUrl().'/lib/apps/capacitacao_analytics/';?>img/icon_python.png" alt="Python">
        <h4>Cursos Python</h4>
        <ul>
          <?php foreach($cursosPy as $c): ?>
            <li>
              <a href="<?= htmlspecialchars($c['url']) ?>" target="_blank">
                <?= htmlspecialchars($c['titulo']) ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <!-- Spark -->
      <div class="courses-list">
         <img class="course-icon" src="<?php echo getBaseUrl().'/lib/apps/capacitacao_analytics/';?>img/icon_spark.png" alt="Python">
        <h4>Cursos Spark</h4>
        <ul>
          <?php foreach($cursosSp as $c): ?>
            <li>
              <a href="<?= htmlspecialchars($c['url']) ?>" target="_blank">
                <?= htmlspecialchars($c['titulo']) ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <div class="card-painel pequena" style="height: 185px; margin-top: 2rem; width: 50%; left: 25%;" attr-link='<iframe src="https://banco365-my.sharepoint.com/personal/rgenuino_bb_com_br/_layouts/15/embed.aspx?UniqueId=d6a6d02e-17f9-48b7-be65-9361fd6ff182&embed=%7B%22ust%22%3Atrue%2C%22hv%22%3A%22CopyEmbedCode%22%7D&referrer=StreamWebApp&referrerScenario=EmbedDialog.Create" width="854" height="480" frameborder="0" scrolling="no" allowfullscreen title="tutorial_spark.mp4"></iframe>'>
      <div class="thumb-wrapper">
        <img src="<?php echo getBaseUrl().'/lib/apps/capacitacao_analytics/';?>img/jupyter-pyspark.png" alt="Realização de Consultas Hue/Hive">
          <div class="play-icon" style="top: 25% !important;">
              <svg viewBox="0 0 100 100">
                  <polygon points="40,30 70,50 40,70" fill="#fff"></polygon>
              </svg>
          </div>
      </div>
      <p class="card-title">
        Jupyter Notebook + Pyspark  configurando e usando
      </p>
    </div>

    <div class="visualizacao-resources-row">
      <div class="resource-box">
        <img src="<?php echo getBaseUrl().'/lib/apps/capacitacao_analytics/';?>img/icon_recursos.png" alt="">
        <h4>Documentação Spark</h4>
        <a href="https://readthedocs.big.intranet.bb.com.br/integracoes/spark/" class="btn-acessar" target="_blank">
          ACESSAR
        </a>
      </div>
      <div class="resource-box AQUI">
        <img src="<?php echo getBaseUrl().'/lib/apps/capacitacao_analytics/';?>img/icon-download.png" alt="">
        <h4>Consultas Spark + SQL</h4>
        <a href="<?= htmlspecialchars($cursosSp[3]['sql_url'] ?? 'https://banco365.sharepoint.com/:u:/s/CAD_DADOS/EVRXU-UcJORMmSkQx17muSQBsklpjlyXDxgs1Jcmd8Q_rg?e=bKaQ7p') ?>"
            class="btn-acessar" target="_blank"
        >BAIXAR</a>
      </div>
    </div>

    <h3 class="subsecao etl-title">
    Construção de ETLs em ambiente corporativo para Automação de Dados
    </h3>

    <div class="etl-box">
        <div class="etl-grid">
            <?php foreach($workshops as $w): ?>
                <a href="<?= htmlspecialchars($w['url'] ?? '#') ?>" target="_blank" class="etl-card" style="text-decoration: none;">
                    <div class="etl-header">
                        <img src="<?php echo getBaseUrl().'/lib/apps/capacitacao_analytics/';?>img/icon-cursos.png" alt="Workshop">
                        <span><?= htmlspecialchars($w['ordem']) ?>.</span>
                        <h4 class="workshop-title"><?= htmlspecialchars($w['titulo']) ?></h4>
                    </div>
                    <p class="etl-desc"><?= htmlspecialchars($w['descricao']) ?></p>
                </a>
            <?php endforeach; ?>

            <div class="etl-illustration">
                <img src="<?php echo getBaseUrl().'/lib/apps/capacitacao_analytics/';?>img/icone-etl.png" alt="Ilustração ETL">
            </div>
        </div>
    </div>




    <!-- 4) Recursos / Downloads Gerais -->
    <div class="visualizacao-resources-row">
      <?php foreach($recursos as $r): 
        $btn = stripos($r['name'],'Primeira') !== false ? 'BAIXAR' : 'ACESSAR';
        $img = stripos($r['name'],'Primeira') !== false ? 'icon-download.png' : 'icon_recursos.png';
      ?>
        <div class="resource-box">
          <img src="<?php echo getBaseUrl().'/lib/apps/capacitacao_analytics/';?>img/<?= $img ?>" alt="">
          <h4><?= htmlspecialchars($r['name']) ?></h4>
          <a href="<?= htmlspecialchars($r['url'] ?? '#') ?>"
             class="btn-acessar" target="_blank"
          ><?= $btn ?></a>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
