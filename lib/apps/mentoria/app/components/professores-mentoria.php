<div class="professoresMentoria">
    <div class="tituloProfessoresMentoria">
        Nossos professores
    </div>

    <div class="quadrosBioMentoria">
        <?php
            $bioProfessores = '';
            $totalBioProfessores = sizeof($consultaProfessoresMentoria['mensagem']);

            if($consultaProfessoresMentoria['status'] == 0){
                $bioProfessores = $consultaProfessoresMentoria['mensagem'];
            } else {
                // Laço que monta o conteúdo das biografias
                for($i = 0; $i < sizeof($consultaProfessoresMentoria['mensagem']); $i++){
                    $indiceArrayMaisUm = $i+1;
                    $bioProfessores = $bioProfessores.'
                        <div id="modalBioMentoria" class="modalBiografiaMentoria '.$consultaProfessoresMentoria['mensagem'][$i]['matricula'].'">
                            <div class="modal-bio-professores">
                                <span class="close" attr-matriculaClose="'.$consultaProfessoresMentoria['mensagem'][$i]['matricula'].'" >&times;</span>
                                <div class="fotoTextoBiografiaMentoria">
                                    <img class="imgQuadroBioMentoria" src="https://humanograma.intranet.bb.com.br/avatar/'.$consultaProfessoresMentoria['mensagem'][$i]['matricula'].'" style="align-self: flex-start;" />
                                    <div class="textoBioProfessorMentoria">
                                        <div class="nomeProfessorMentoria">'.$consultaProfessoresMentoria['mensagem'][$i]['nome'].'</div>
                                        <div class="biografiaProfessorMentoria">'.$consultaProfessoresMentoria['mensagem'][$i]['bio'].'</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                }
            }
            echo $bioProfessores;
        ?>
    </div>

    <div class="imagensProfessoresMentoria carrossel">
        <div class="carrossel-track">
            <?php 
                $professores = '';
                $totalProfessores = sizeof($consultaProfessoresMentoria['mensagem']);

                if($consultaProfessoresMentoria['status'] == 0){
                    $professores = $consultaProfessoresMentoria['mensagem'];
                } else {
                    // Laço que monta o conteúdo dos professores
                    for($i = 0; $i < sizeof($consultaProfessoresMentoria['mensagem']); $i++){
                        $indiceArrayMaisUm = $i+1;
                        $professores = $professores.'
                            <div class="abrirModalBioMentoria carrossel-item Clicar" attr-matricula="'.$consultaProfessoresMentoria['mensagem'][$i]['matricula'].'">
                                <img class="imgProfessorMentoria" style="width: 100%; height: 100%; border-radius: 999px;" src="https://humanograma.intranet.bb.com.br/avatar/'.$consultaProfessoresMentoria['mensagem'][$i]['matricula'].'" alt="'.$consultaProfessoresMentoria['mensagem'][$i]['saudacao'].' '.$consultaProfessoresMentoria['mensagem'][$i]['nome'].'">
                            </div>
                        ';
                    }
                }
                echo $professores.$professores;
            ?>
        </div>
    </div>
</div>

<div class="transicaoProfessoresRodapeMentoria"></div>