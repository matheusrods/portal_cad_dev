<?php

// if(!isset($_SESSION)){
//     session_start();
// }

// ini_set("display_errors", E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/mentoria/class/class_mentoria.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Mentoria', $_SESSION['ip']);

$class = new funcoes();

$consultaProfessoresMentoria = $class->consultaProfessoresMentoria();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nossos Professores</title>

    <!-- JS específico do app -->
    <!-- <script type="text/javascript" src="/lib/apps/mentoria/js/mentoria.js"></script> -->
    <style>

    </style>
    <!-- CSS específico do app -->
    <link href="/lib/apps/mentoria/css/mentoria.css" rel="stylesheet">

    <!-- JS específico do app -->
    <script type="text/javascript" src="/lib/apps/mentoria/js/mentoria.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <!-- <div class="professoresMentoria">
        <div class="tituloProfessoresMentoria">
            Nossos professores
        </div>

        <div class="quadrosBioMentoria">
            <?php
                // $bioProfessores = '';
                // $totalBioProfessores = sizeof($consultaProfessoresMentoria['mensagem']);

                // if($consultaProfessoresMentoria['status'] == 0){
                //     $bioProfessores = $consultaProfessoresMentoria['mensagem'];
                // } else {
                //     // Laço que monta o conteúdo das biografias
                //     for($i = 0; $i < sizeof($consultaProfessoresMentoria['mensagem']); $i++){
                //         $indiceArrayMaisUm = $i+1;
                //         $bioProfessores = $bioProfessores.'
                //             <div id="modalBioMentoria" class="modal '.$consultaProfessoresMentoria['mensagem'][$i]['matricula'].'">
                //                 <div class="modal-content">
                //                     <span class="close" attr-matriculaClose="'.$consultaProfessoresMentoria['mensagem'][$i]['matricula'].'" >&times;</span>
                //                     <div style="width: 100%; height: 100%; padding-top: 64px; padding-bottom: 64px; background: linear-gradient(90deg, #525252 0%, black 100%); box-shadow: 0px 0px 1px rgba(24, 24, 27, 0.04); flex-direction: column; justify-content: flex-start; align-items: flex-start; display: inline-flex; border-radius: 8px;">
                //                         <div style="align-self: stretch; justify-content: center; align-items: flex-start; gap: 32px; display: flex;">
                //                             <img class="imgQuadroBioMentoria" src="https://humanograma.intranet.bb.com.br/avatar/'.$consultaProfessoresMentoria['mensagem'][$i]['matricula'].'" style="align-self: flex-start;" />
                //                             <div class="textoBioProfessorMentoria">
                //                                 <div style="width: 443px; color: #FCFC30; font-size: 36px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">'.$consultaProfessoresMentoria['mensagem'][$i]['nome'].'</div>
                //                                 <div style="width: 443px; color: white; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">'.$consultaProfessoresMentoria['mensagem'][$i]['bio'].'</div>
                //                             </div>
                //                         </div>
                //                     </div>
                //                 </div>
                //             </div>
                //         ';
                //     }
                // }
                // for($i = 0; $i < sizeof($consultaProfessoresMentoria['mensagem']); $i++){
                //     $professores = $professores.$professores;
                // }
                // echo $bioProfessores;
            ?>
        </div>

        <div class="imagensProfessoresMentoria carrossel">
            <div class="carrossel-track">
                <?php 
                    // $professores = '';
                    // $totalProfessores = sizeof($consultaProfessoresMentoria['mensagem']);

                    // if($consultaProfessoresMentoria['status'] == 0){
                    //     $professores = $consultaProfessoresMentoria['mensagem'];
                    // } else {
                    //     // Laço que monta o conteúdo dos professores
                    //     for($i = 0; $i < sizeof($consultaProfessoresMentoria['mensagem']); $i++){
                    //         $indiceArrayMaisUm = $i+1;
                    //         $professores = $professores.'
                    //             <div class="abrirModalBioMentoria carrossel-item Clicar" attr-matricula="'.$consultaProfessoresMentoria['mensagem'][$i]['matricula'].'">
                    //                 <img class="imgProfessorMentoria" style="width: 100%; height: 100%; border-radius: 33px;" src="https://humanograma.intranet.bb.com.br/avatar/'.$consultaProfessoresMentoria['mensagem'][$i]['matricula'].'" alt="'.$consultaProfessoresMentoria['mensagem'][$i]['saudacao'].' '.$consultaProfessoresMentoria['mensagem'][$i]['nome'].'">
                    //             </div>
                    //         ';
                    //     }
                    // }
                    // echo $professores;
                ?>
            </div>
        </div>
    </div> -->

    <div class="CallToAction" style="width: 1920px; height: auto; position: relative; background: url(/lib/img/apps/mentoria/fundoTemas.png), linear-gradient(90deg, #525252 0%, black 100%);">
        <div class="Group155" style="width: 1920px; height: auto; position: relative">
            <div class="Vector35" style="width: 1920px; height: auto; position: relative; background: linear-gradient(90deg, #525252 0%, black 100%); box-shadow: 1px -5px 30px rgba(0, 0, 0, 0.25)"></div>
            <div class="Vector36" style="width: 1920px; height: auto; position: relative; background: linear-gradient(90deg, #525252 0%, black 100%)"></div>
        </div>
        <img style="width: 724px; height: auto; position: relative" src="/lib/img/apps/mentoria/roboRodape.png" />
        <div class="NossaEquipeEstProntaPraTeAjudar" style="width: 926px; height: auto; position: relative; text-align: center; color: #FCFC30; font-size: 96px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Nossa equipe está pronta pra te ajudar</div>
        <div class="ComPessoasEspecialistasAltamenteQualificadasPodemosTeAjudarATrilharEntreOsMelhoresCaminhosParaSeusProjetosDeChatbotEVoicebot" style="width: 926px; height: auto; position: relative; text-align: center; color: #FCFC30; font-size: 36px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">Com pessoas especialistas altamente qualificadas podemos te ajudar a trilhar entre os melhores caminhos para seus projetos de chatbot e voicebot</div>
        <div class="Group149" style="width: 614px; height: auto; position: relative">
            <div class="Rectangle28" style="width: 614px; height: auto; position: relative; background: #FCFC30; border-radius: 14px"></div>
            <div class="SolicitarImersO" style="width: 408px; position: relative; text-align: center; color: #735CC6; font-size: 40px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">Solicitar Imersão</div>
        </div>
    </div>
</body>
</html>