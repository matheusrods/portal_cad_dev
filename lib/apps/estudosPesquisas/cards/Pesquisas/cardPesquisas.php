<div class="divPesquisa" data-data="<?= htmlspecialchars($execQuery[$j]['dtEstudoPesquisa']) ?>">
    <div class="fotoCapaPesquisa" style="background-image: url(/lib/apps/estudosPesquisas/arquivos/<?= $idPesquisa ?>.png);">
        <div class="tagPesquisa">
            <div class="textoTagPesquisa"><?= $execQuery[$j]['temas'] ?></div>
        </div>
    </div>
    <div class="textoPesquisa">
        <span class="dataCardPesquisa">
            <?= date('d/m/Y', strtotime($execQuery[$j]['dtEstudoPesquisa'])) ?>
        </span>
        <div class="tituloPesquisa"><?= $execQuery[$j]['titulo'] ?></div>
        <div class="subtituloPesquisa"><?= $execQuery[$j]['subtitulo'] ?></div>
        <div class="acoesCardPesquisa">
            <a href="/lib/apps/estudosPesquisas/arquivos/<?= $idPesquisa ?>.pdf" target="_blank" class="btnAcessarPesquisa">ACESSAR</a>
            <div class="iconesAcoes">
                <a href="/lib/apps/estudosPesquisas/arquivos/<?= $idPesquisa ?>.pdf" download title="Download">
                    <i class="fa fa-download"></i>
                </a>
                <a href="#" title="Compartilhar" onclick="compartilharLink('/lib/apps/estudosPesquisas/arquivos/<?= $idPesquisa ?>.pdf');return false;">
                    <i class="fa fa-share"></i>
                </a>
            </div>
        </div>
    </div>
</div>