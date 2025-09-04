<div class="divEstudo" data-data="<?= $execQuery[$j]['dtEstudoPesquisa'] ?>">
    <div class="fotoCapaEstudo" style="background-image: url(/lib/apps/estudosPesquisas/arquivos/<?= $idEstudo ?>.png);">
        <div class="tagEstudo">
            <div class="textoTagEstudo"><?= $execQuery[$j]['temas'] ?></div>
        </div>
    </div>
    <div class="textoEstudo">
        <span class="dataCardEstudo">
            <?= date('d/m/Y', strtotime($execQuery[$j]['dtEstudoPesquisa'])) ?>
        </span>
        <div class="tituloEstudo"><?= $execQuery[$j]['titulo'] ?></div>
        <div class="subtituloEstudo"><?= $execQuery[$j]['subtitulo'] ?></div>
        <div class="acoesCardEstudo">
            <a href="/lib/apps/estudosPesquisas/arquivos/<?= $idEstudo ?>.pdf" target="_blank" class="btnAcessarEstudo">ACESSAR</a>
            <div class="iconesAcoes">
                <a href="/lib/apps/estudosPesquisas/arquivos/<?= $idEstudo ?>.pdf" download title="Download">
                    <i class="fa fa-download"></i>
                </a>
                <a href="#" title="Compartilhar" onclick="compartilharLink('/lib/apps/estudosPesquisas/arquivos/<?= $idEstudo ?>.pdf');return false;">
                    <i class="fa fa-share"></i>
                </a>
            </div>
        </div>
    </div>
</div>
