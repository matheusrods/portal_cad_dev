<div class="oQueDizemSobreMentoria">
    <div class="tituloOQueDizemSobreMentoria">
        O que dizem sobre a imersão
    </div>

    <div class="depoimentos-carousel">
        <div class="depoimentos-track">
            <?php foreach ($consultaDepoimentosMentoria['mensagem'] as $dep): ?>
                <?php
                $foto = ($dep['fotoHumanograma'] == 1)
                        ? "https://humanograma.intranet.bb.com.br/avatar/" . $dep['matricula']
                        : getBaseUrl() . "/lib/apps/mentoria/img/" . $dep['matricula'] . ".png";
                ?>

                <div class="depoimento-card">
                    <div class="foto-dados">
                        <img src="<?= $foto ?>">
                        <div class="dados">
                            <div class="nome"><?= $dep['nome'] ?></div>
                            <div class="cargo"><?= $dep['cargo'] ?></div>
                            <div class="dependencia"><?= $dep['dependencia'] ?></div>
                        </div>
                    </div>

                    <div class="texto-depoimento">
                        <span class="aspas">“</span>
                        <?= $dep['depoimento'] ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>