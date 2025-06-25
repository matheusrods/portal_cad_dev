<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/capacitacao_analytics/class/class_capacitacao.php";
    $class      = new funcoes();
    $respRaw    = $class->consultaResponsabilidades();
    $resp       = $respRaw['status']===1 ? $respRaw['mensagem'] : [];

    $cursosPy   = $class->consultaCursosPython()['mensagem'] ?? [];
    $cursosSp   = $class->consultaCursosSpark()['mensagem'] ?? [];

    $recRaw     = $class->consultaRecursos('engenharia_dados');
    $recursos   = $recRaw['mensagem'] ?? [];

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
            <img src="img/icone-eng-data.png" alt="Ilustração Engenharia de Dados">
        </div>
    </div>

    <!-- 2) Responsabilidades -->
    <h3 class="subsecao responsibilities-title">Principais responsabilidades</h3>
    <p class="responsibilities-intro">
    Aqui estão alguns dos principais aspectos e responsabilidades da Engenharia de Dados:
    </p>
    <dl class="responsibilities">
    <?php foreach($resp as $item): ?>
        <dt>
        <span class="num"><?= str_pad($item['ordem'],2,'0',STR_PAD_LEFT) ?></span>
        <?= htmlspecialchars($item['titulo']) ?>
        </dt>
        <dd><?= htmlspecialchars($item['descricao']) ?></dd>
    <?php endforeach; ?>
    </dl>

    <!-- 3) Cursos Sugeridos Alura -->
    <h3 class="subsecao">Cursos Sugeridos Alura</h3>
    <div class="grid-dual-courses">
      <!-- Python -->
      <div class="courses-list">
        <img class="course-icon" src="img/icon_python.png" alt="Python">
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
         <img class="course-icon" src="img/icon_spark.png" alt="Python">
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

        <div class="visualizacao-resources-row">
          <div class="resource-box">
            <img src="img/icon_recursos.png" alt="">
            <h4>Documentação Spark</h4>
            <a href="https://readthedocs.big.intranet.bb.com.br/integracoes/spark/"
               class="btn-acessar" target="_blank"
            >ACESSAR</a>
          </div>
          <div class="resource-box">
            <img src="img/icon-download.png" alt="">
            <h4>Consultas Spark + SQL</h4>
            <a href="<?= htmlspecialchars($cursosSp[3]['sql_url'] ?? '#') ?>"
               class="btn-acessar" target="_blank"
            >BAIXAR</a>
          </div>
        </div>
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
                        <img src="img/icon-cursos.png" alt="Workshop">
                        <span><?= htmlspecialchars($w['ordem']) ?>.</span>
                        <h4 class="workshop-title"><?= htmlspecialchars($w['titulo']) ?></h4>
                    </div>
                    <p class="etl-desc"><?= htmlspecialchars($w['descricao']) ?></p>
                </a>
            <?php endforeach; ?>

            <div class="etl-illustration">
                <img src="img/icone-etl.png" alt="Ilustração ETL">
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
          <img src="img/<?= $img ?>" alt="">
          <h4><?= htmlspecialchars($r['name']) ?></h4>
          <a href="<?= htmlspecialchars($r['url'] ?? '#') ?>"
             class="btn-acessar" target="_blank"
          ><?= $btn ?></a>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
