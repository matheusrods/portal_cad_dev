<div class="professoresMentoria">
    <div class="tituloProfessoresMentoria">
        Nossos professores
    </div>

    <?php if ($consultaProfessoresMentoria['status'] != 0): ?>
        <div class="quadrosBioMentoria">
            <?php foreach ($consultaProfessoresMentoria['mensagem'] as $prof): ?>
                <div
                        id="modalBioMentoria-<?= $prof['matricula'] ?>"
                        class="modalBiografiaMentoria <?= $prof['matricula'] ?>"
                >
                    <div class="modal-bio-professores">
                        <span
                                class="close"
                                attr-matriculaClose="<?= $prof['matricula'] ?>"
                        >&times;</span>

                        <div class="fotoTextoBiografiaMentoria">
                            <img
                                    class="imgQuadroBioMentoria"
                                    src="https://humanograma.intranet.bb.com.br/avatar/<?= $prof['matricula'] ?>"
                                    alt="<?= htmlspecialchars($prof['nome']) ?>"
                            />

                            <div class="textoBioProfessorMentoria">
                                <div class="nomeProfessorMentoria">
                                    <?= htmlspecialchars($prof['nome']) ?>
                                </div>

                                <div class="biografiaProfessorMentoria">
                                    <?= nl2br(htmlspecialchars($prof['bio'])) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="imagensProfessoresMentoria carrossel">
            <div class="carrossel-track">
                <?php foreach ($consultaProfessoresMentoria['mensagem'] as $prof): ?>
                    <div
                            class="abrirModalBioMentoria carrossel-item Clicar"
                            attr-matricula="<?= $prof['matricula'] ?>"
                    >
                        <img
                                class="imgProfessorMentoria"
                                src="https://humanograma.intranet.bb.com.br/avatar/<?= $prof['matricula'] ?>"
                                alt="<?= htmlspecialchars($prof['saudacao'] . ' ' . $prof['nome']) ?>"
                        >
                    </div>
                <?php endforeach; ?>

                <?php foreach ($consultaProfessoresMentoria['mensagem'] as $prof): ?>
                    <div
                            class="abrirModalBioMentoria carrossel-item Clicar"
                            attr-matricula="<?= $prof['matricula'] ?>"
                    >
                        <img
                                class="imgProfessorMentoria"
                                src="https://humanograma.intranet.bb.com.br/avatar/<?= $prof['matricula'] ?>"
                                alt="<?= htmlspecialchars($prof['saudacao'] . ' ' . $prof['nome']) ?>"
                        >
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    <?php else: ?>
        <?= $consultaProfessoresMentoria['mensagem'] ?>
    <?php endif; ?>
</div>

<div class="transicaoProfessoresRodapeMentoria"></div>