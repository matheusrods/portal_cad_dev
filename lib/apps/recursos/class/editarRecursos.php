<?php 

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

session_start();

ini_set('display_startup_errors', 1);
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

$geraLog = new geraLog();

$idRecurso = $_POST['idRecurso'];
$mat = $_SESSION['matricula'];

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$novoStatus = $_POST['novoStatus'];
$idTema = $_POST['idTema'];
$idTemaArray = explode(",", $idTema);
$qtdTemas = sizeof($idTemaArray);
$camposParaEditar = $_POST['camposParaEditar'];
$camposParaEditarArray = explode(",", $camposParaEditar);

$tipoArquivo = $_POST['tipoArquivo'];

$db = new Database('recursos');
$retorno = array();

$queryConsulta = "SELECT id, titulo, subtitulo, nomeArquivo, nomeCapa, b.idTema, a.ativo as statusRecurso FROM recursos.recursos a
                    LEFT JOIN recursos.recursosTemas b ON a.id = b.idRecurso
                    WHERE a.id = ".$idRecurso.";";
$execQueryConsulta = $db->DbGetAll($queryConsulta);

$queryUpdateRecurso = "";
$queryUpdateTema = "";
$validaEdicaoArquivoRecurso = 0;
$validaEdicaoArquivoCapa = 0;

$statusAnterior = $execQueryConsulta[0]['statusRecurso'];

if(in_array("titulo", $camposParaEditarArray)){
    $queryUpdateRecurso = $queryUpdateRecurso."`titulo` = '".$titulo."',";
    $indiceEdicaoTituloDescricao = 1;
}

if(in_array("descricao", $camposParaEditarArray)){
    $queryUpdateRecurso = $queryUpdateRecurso."`subtitulo` = '".$descricao."',";
    $indiceEdicaoTituloDescricao = 1;
}

if(in_array("status", $camposParaEditarArray)){
    $queryUpdateRecurso = $queryUpdateRecurso."`ativo` = '".$novoStatus."',";
    $indiceEdicaoTituloDescricao = 1;
}

if(in_array("nomeArquivo", $camposParaEditarArray)){
    if($tipoArquivo == 'arquivo') {
        $nomeArquivoRecursoRenomeado = date("Ymd")."_".date("Hi")."_".$execQueryConsulta[0]['nomeArquivo'];
    }

    if($tipoArquivo == 'linkExterno') {
        $nomeArquivoRecursoRenomeado = $execQueryConsulta[0]['nomeArquivo'];
        $queryUpdateLinkExterno = "UPDATE `recursos`.`recursos` SET `nomeArquivo` = '".$_POST['pdf']."' WHERE (`id` = '".$idRecurso."');";
    }

    $indiceEdicaoArquivo = 2;
}

if(in_array("nomeCapa", $camposParaEditarArray)){
    $novoNomeArquivoCapa = date("Ymd")."_".date("Hi")."_".$execQueryConsulta[0]['nomeCapa'];
    $editaArquivoCapa = 1;
    $indiceEdicaoCapa = 4;
    // rename(
    //     $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'], 
    //     $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$novoNomeArquivoCapa);
}

if(in_array("idTema", $camposParaEditarArray)){
    $queryUpdateTema = "UPDATE `recursos`.`recursosTemas` SET `idTema` = '$idTema' WHERE (`idTema` = '".$execQueryConsulta[0]['idTema']."') and (`idRecurso` = '".$idRecurso."');";
    $indiceEdicaoTema = 8;
}

$calculaCamposAEditar = $indiceEdicaoTituloDescricao+$indiceEdicaoArquivo+$indiceEdicaoCapa+$indiceEdicaoTema;

if($novoStatus == NULL || $novoStatus == ''){
    $novoStatus = $statusAnterior;
} else {
    $statusAnterior = $novoStatus == 0 ? 1 : 0;
}

switch($calculaCamposAEditar){
    // Edição apenas de título e/ou descrição
    case 1:
        // tira a última vírgula dos campos a serem editados para não dar erro na query
        $queryUpdateRecurso = rtrim($queryUpdateRecurso, ",");

        //concatena tudo para execução
        $queryUpdateRecurso = "UPDATE `recursos`.`recursos` SET ".$queryUpdateRecurso." WHERE (`id` = '".$idRecurso."');";

        try {
            // executa o update a tabela
            $execQueryUpdateRecurso = $db->DbQuery($queryUpdateRecurso);
            
            if($execQueryUpdateRecurso){
                $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                    `idRecurso`, `matAlteracao`, `tituloAnterior`, `tituloNovo`, `descricaoAnterior`, `descricaoNova`, `statusAnterior`, `novoStatus`, `tipoAlteracao`
                ) VALUES (
                    '".$idRecurso."', '".$mat."', '".$execQueryConsulta[0]['titulo']."', '".$titulo."', '".$execQueryConsulta[0]['subtitulo']."', '".$descricao."', '".$statusAnterior."', '".$novoStatus."', 'Alteração de Título/Descrição/Status');";

                try {
                    $execGravaLog = $db->DbQuery($queryGravaLog);
                    if($execGravaLog){
                        $mensagemSucesso = "Recurso alterado com sucesso!";
                        $retorno['status'] = 1;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                    } else {
                        $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nSintoma: Gravou a alteração de título/descrição mas não gravou o log. Verificar se não há erro de sintaxe na query e a mensagem de erro retornada.";
                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecurso", $informacoesErro, $mat);
                        $retorno['status'] = 0;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>Recurso alterado com sucesso, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                    }
                } catch(Exception $e){
                    $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nSintoma: Gravou a alteração de título/descrição mas não gravou o log. Verificar se não há erro de sintaxe na query e a mensagem de erro retornada.";
                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecurso", $informacoesErro, $mat);
                    $retorno['status'] = 0;
                    $retorno['mensagem'] = "<p style='font-size: 16px;'>Recurso alterado com sucesso, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                }
            } else {
                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryUpdateRecurso . "\n\nNão gravou a edição de título/descrição (linha 128 - else). Verificar se há erro de sintaxe na query.";
                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecurso", $informacoesErro, $mat);
                $retorno['status'] = 0;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>Tema do recurso alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            }
        } catch(Exception $e){
                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryUpdateRecurso . "\n\nNão gravou a edição de título/descrição/status (linha 134 - catch exception). Verificar se há erro de sintaxe na query.";
                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecurso", $informacoesErro, $mat);
                $retorno['status'] = 0;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível editar o recurso no momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            echo json_encode($retorno);
        }
        break;

    case 2:
        #caso seja apenas alteração de arquivo do recurso
        if($tipoArquivo == 'arquivo'){
            $renomearArquivo = rename(
                $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeArquivo'], 
                $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$nomeArquivoRecursoRenomeado);
            
            if($renomearArquivo == true){
                $pdfName = $_FILES['pdf']['name'];
                $pdfTmpName = $_FILES['pdf']['tmp_name'];
                $pdfDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeArquivo'];
                move_uploaded_file($pdfTmpName, $pdfDestination);
                if(file_exists($pdfDestination)){
                    chmod($pdfDestination, 0777);

                    $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                        `idRecurso`, `matAlteracao`, `nomeArquivoAnterior`, `nomeArquivoNovo`, `tipoAlteracao` 
                    ) VALUES (
                        '".$idRecurso."', '".$mat."', '".$nomeArquivoRecursoRenomeado."', '".$execQueryConsulta[0]['nomeArquivo']."', 'Alteração de arquivo do Recurso');";

                    try {
                        $execGravaLog = $db->DbQuery($queryGravaLog);
                        if($execGravaLog){
                            $mensagemSucesso = "Arquivo do recurso alterado com sucesso!";
                            $retorno['status'] = 1;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                        } else {
                            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo do recurso (else - L156). Verificar se há erro de sintaxe na query.";
                            $arquivoLog = $geraLog->geraLogExcecao("recursos", "gravaLogAposAlterarArquivo", $informacoesErro, $mat);
                            $retorno['status'] = 0;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>O arquivo do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                        }
                    } catch(Exception $e) {
                        $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo do recurso (catch exception - L162). Verificar se há erro de sintaxe na query.";
                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "gravaLogAposAlterarArquivo", $informacoesErro, $mat);
                        $retorno['status'] = 0;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>O arquivo do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                    }
                } else {
                    $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeArquivo'].". Informe à equipe responsável. (L168 - editarRecursos.php) ".error_get_last();
                    $retorno['status'] = 1;
                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                }
            } else {
                $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeArquivo'].". Informe à equipe responsável. (L173 - editarRecursos.php) ".error_get_last();
                $retorno['status'] = 1;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
            }
            echo json_encode($retorno);
        }

        # caso seja alteração de link externo
        if($tipoArquivo == 'linkExterno') {
            
            try {
                $execQueryUpdateLinkExterno = $db->DbQuery($queryUpdateLinkExterno);

                if($execQueryUpdateLinkExterno){
                    
                    $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                        `idRecurso`, `matAlteracao`, `nomeArquivoAnterior`, `nomeArquivoNovo`, `tipoAlteracao` 
                    ) VALUES (
                        '".$idRecurso."', '".$mat."', '".$nomeArquivoRecursoRenomeado."', '".$_POST['pdf']."', 'Alteração de link externo do Recurso');";

                    try {
                        $execGravaLog = $db->DbQuery($queryGravaLog);
                        if($execGravaLog){
                            $mensagemSucesso = "Link externo do recurso alterado com sucesso!";
                            $retorno['status'] = 1;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                        } else {
                            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de link externo do recurso (else - L212). Verificar se há erro de sintaxe na query.";
                            $arquivoLog = $geraLog->geraLogExcecao("recursos", "gravaLogAposAlterarLinkExterno", $informacoesErro, $mat);
                            $retorno['status'] = 0;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>O link externo do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                        }
                    } catch(Exception $e) {
                        $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de link externo do recurso (catch exception - L218). Verificar se há erro de sintaxe na query.";
                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "gravaLogAposAlterarArquivo", $informacoesErro, $mat);
                        $retorno['status'] = 0;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>O link externo do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                    }
                } else {
                    $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de link externo do recurso (catch exception - L218). Verificar se há erro de sintaxe na query.";
                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "gravaLogAposAlterarArquivo", $informacoesErro, $mat);
                    $retorno['status'] = 0;
                    $retorno['mensagem'] = "<p style='font-size: 16px;'>O link externo do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                }
            } catch (exception $e){
                $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateLinkExterno: " . $queryUpdateLinkExterno . "\n\nNão gravou a alteração de link externo do recurso (catch exception - L230). Verificar se há erro de sintaxe na query.";
                $arquivoLog = $geraLog->geraLogExcecao("recursos", "gravaLinkExternoRecurso", $informacoesErro, $mat);
                $retorno['status'] = 0;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível alterar o link externo do recurso. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            } finally {
                echo json_encode($retorno);
            }
        }
        break;

    case 3:
        # alteração de título/descrição e arquivo do recurso

        // tira a última vírgula dos campos a serem editados para não dar erro na query
        $queryUpdateRecurso = rtrim($queryUpdateRecurso, ",");

        //concatena tudo para execução
        $queryUpdateRecurso = "UPDATE `recursos`.`recursos` SET ".$queryUpdateRecurso." WHERE (`id` = '".$idRecurso."');";

        try {
            // executa o update a tabela
            $execQueryUpdateRecurso = $db->DbQuery($queryUpdateRecurso);
            
            if($execQueryUpdateRecurso){
                
                if($tipoArquivo == 'arquivo'){
                    $renomearArquivo = rename(
                        $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeArquivo'], 
                        $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$nomeArquivoRecursoRenomeado);
                    
                    if($renomearArquivo == true){
                        $pdfName = $_FILES['pdf']['name'];
                        $pdfTmpName = $_FILES['pdf']['tmp_name'];
                        $pdfDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeArquivo'];
                        move_uploaded_file($pdfTmpName, $pdfDestination);
                        if(file_exists($pdfDestination)){
                            chmod($pdfDestination, 0777);

                            $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                                `idRecurso`, `matAlteracao`, `tituloAnterior`, `tituloNovo`, `descricaoAnterior`, `descricaoNova`, `nomeArquivoAnterior`, `nomeArquivoNovo`, `tipoAlteracao`
                            ) VALUES (
                                '".$idRecurso."', '".$mat."', '".$execQueryConsulta[0]['titulo']."', '".$titulo."', '".$execQueryConsulta[0]['subtitulo']."', '".$descricao."', '".$nomeArquivoRecursoRenomeado."', '".$execQueryConsulta[0]['nomeArquivo']."', 'Alteração de título/descrição e arquivo do Recurso');";

                            try {
                                $execGravaLog = $db->DbQuery($queryGravaLog);
                                if($execGravaLog){
                                    $mensagemSucesso = "Título/descrição e arquivo do recurso alterados com sucesso!";
                                    $retorno['status'] = 1;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                } else {
                                    $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo do recurso (else - L156). Verificar se há erro de sintaxe na query.";
                                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "gravaLogAposAlterarArquivo", $informacoesErro, $mat);
                                    $retorno['status'] = 0;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>O arquivo do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                }
                            } catch(Exception $e) {
                                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo do recurso (catch exception - L162). Verificar se há erro de sintaxe na query.";
                                $arquivoLog = $geraLog->geraLogExcecao("recursos", "gravaLogAposAlterarArquivo", $informacoesErro, $mat);
                                $retorno['status'] = 0;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>O arquivo do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                            }
                        } else {
                            $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeArquivo'].". Informe à equipe responsável. (L230 - editarRecursos.php) ".error_get_last();
                            $retorno['status'] = 1;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                        }
                    } else {
                        $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeArquivo'].". Informe à equipe responsável. (L235 - editarRecursos.php) ".error_get_last();
                        $retorno['status'] = 1;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                    }
                }

                if($tipoArquivo == 'linkExterno'){

                    try {
                        $execQueryUpdateLinkExterno = $db->DbQuery($queryUpdateLinkExterno);

                        if($execQueryUpdateLinkExterno){
                            
                            $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                                `idRecurso`, `matAlteracao`, `nomeArquivoAnterior`, `nomeArquivoNovo`, `tipoAlteracao` 
                            ) VALUES (
                                '".$idRecurso."', '".$mat."', '".$nomeArquivoRecursoRenomeado."', '".$_POST['pdf']."', 'Alteração de link externo do Recurso');";

                            try {
                                $execGravaLog = $db->DbQuery($queryGravaLog);
                                if($execGravaLog){
                                    $mensagemSucesso = "Título/descrição e link externo do recurso alterados com sucesso!";
                                    $retorno['status'] = 1;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                } else {
                                    $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de link externo do recurso (else - L324). Verificar se há erro de sintaxe na query.";
                                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "gravaLogAposAlterarLinkExterno", $informacoesErro, $mat);
                                    $retorno['status'] = 0;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>O recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                }
                            } catch(Exception $e) {
                                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração do recurso (catch exception - L330). Verificar se há erro de sintaxe na query.";
                                $arquivoLog = $geraLog->geraLogExcecao("recursos", "gravaLogAposAlterarArquivo", $informacoesErro, $mat);
                                $retorno['status'] = 0;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>O link externo do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                            }
                        } else {
                            $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateLinkExterno: " . $queryUpdateLinkExterno . "\n\nNão gravou o log da alteração do recurso (catch exception - L336). Verificar se há erro de sintaxe na query.";
                            $arquivoLog = $geraLog->geraLogExcecao("recursos", "gravaLogAposAlterarArquivo", $informacoesErro, $mat);
                            $retorno['status'] = 0;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>O link externo do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                        }
                    } catch (exception $e){
                        $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateLinkExterno: " . $queryUpdateLinkExterno . "\n\nNão gravou a alteração de link externo do recurso (catch exception - L342). Verificar se há erro de sintaxe na query.";
                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "gravaLinkExternoRecurso", $informacoesErro, $mat);
                        $retorno['status'] = 0;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível alterar o link externo do recurso. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                    }
                }
            }
        } catch(Exception $e) {
            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryUpdateRecurso . "\n\nNão gravou a edição de título/descrição (linha L350 - catch exception). Verificar se há erro de sintaxe na query.";
            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecurso", $informacoesErro, $mat);
            $retorno['status'] = 0;
            $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível editar o recurso no momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            echo json_encode($retorno);
        }

        break;
    case 4:
        #caso seja apenas alteração de arquivo de capa
        $renomearCapa = rename(
            $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'], 
            $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$novoNomeArquivoCapa);
        
        if($renomearCapa == true){
            $pngName = $_FILES['png']['name'];
            $pngTmpName = $_FILES['png']['tmp_name'];
            $pngDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'];
            move_uploaded_file($pngTmpName, $pngDestination);
            if(file_exists($pngDestination)){
                chmod($pngDestination, 0777);
                
                $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                    `idRecurso`, `matAlteracao`, `nomeCapaAnterior`, `nomeCapaNovo`, `tipoAlteracao`
                ) VALUES (
                    '".$idRecurso."', '".$mat."', '".$novoNomeArquivoCapa."', '".$execQueryConsulta[0]['nomeCapa']."', 'Alteração de arquivo de Capa');";

                try {
                    $execGravaLog = $db->DbQuery($queryGravaLog);
                    if($execGravaLog){
                        $mensagemSucesso = "Capa do recurso alterada com sucesso!";
                        $retorno['status'] = 1;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                    } else {
                        $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo de capa (else - L276). Verificar se há erro de sintaxe na query.";
                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase4", $informacoesErro, $mat);
                        $retorno['status'] = 0;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>O arquivo de capa do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                    }
                } catch(Exception $e) {
                    $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo do recurso (catch exception - L282). Verificar se há erro de sintaxe na query.";
                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase4", $informacoesErro, $mat);
                    $retorno['status'] = 0;
                    $retorno['mensagem'] = "<p style='font-size: 16px;'>O arquivo de capa do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                }
            } else {
                $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa']." de capa do recurso. Informe à equipe responsável. (L288 - editarRecursos.php) ".print_r(error_get_last());
                $retorno['status'] = 1;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
            }
        } else {
            $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa'].". Informe à equipe responsável. (L293 - editarRecursos.php) ".print_r(error_get_last());
            $retorno['status'] = 1;
            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
        }
        echo json_encode($retorno);
        break;
        
    case 5:
        # alteração de título/descrição e capa do recurso

        // tira a última vírgula dos campos a serem editados para não dar erro na query
        $queryUpdateRecurso = rtrim($queryUpdateRecurso, ",");

        //concatena tudo para execução
        $queryUpdateRecurso = "UPDATE `recursos`.`recursos` SET ".$queryUpdateRecurso." WHERE (`id` = '".$idRecurso."');";

        try {
            // executa o update a tabela
            $execQueryUpdateRecurso = $db->DbQuery($queryUpdateRecurso);
            
            if($execQueryUpdateRecurso){
                $renomearCapa = rename(
                    $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'], 
                    $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$novoNomeArquivoCapa);
                
                if($renomearCapa == true){
                    $pngName = $_FILES['png']['name'];
                    $pngTmpName = $_FILES['png']['tmp_name'];
                    $pngDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'];
                    move_uploaded_file($pngTmpName, $pngDestination);
                    if(file_exists($pngDestination)){
                        chmod($pngDestination, 0777);
                        

                        $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                            `idRecurso`, `matAlteracao`, `tituloAnterior`, `tituloNovo`, `descricaoAnterior`, `descricaoNova`, `nomeCapaAnterior`, `nomeCapaNovo`, `tipoAlteracao`
                        ) VALUES (
                            '".$idRecurso."', '".$mat."', '".$execQueryConsulta[0]['titulo']."', '".$titulo."', '".$execQueryConsulta[0]['subtitulo']."', '".$descricao."', '".$novoNomeArquivoCapa."', '".$execQueryConsulta[0]['nomeCapa']."', 'Alteração de título/descrição e capa do Recurso');";

                        try {
                            $execGravaLog = $db->DbQuery($queryGravaLog);
                            if($execGravaLog){
                                $mensagemSucesso = "Título/descrição e capa do recurso alterados com sucesso!";
                                $retorno['status'] = 1;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                            } else {
                                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo de capa (else - L338). Verificar se há erro de sintaxe na query.";
                                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase5", $informacoesErro, $mat);
                                $retorno['status'] = 0;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>O arquivo de capa do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                            }
                        } catch(Exception $e) {
                            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo do recurso (catch exception - L344). Verificar se há erro de sintaxe na query.";
                            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase5", $informacoesErro, $mat);
                            $retorno['status'] = 0;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>O arquivo de capa do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                        }
                    } else {
                        $mensagemSucesso = "Não foi possível alterar o arquivo de capa do recurso. Informe à equipe responsável. (L351 - editarRecursos.php) ".print_r(error_get_last());
                        $retorno['status'] = 1;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                    }
                } else {
                    $mensagemSucesso = "Não foi possível alterar o arquivo de capa. Informe à equipe responsável. (L356 - editarRecursos.php) ".print_r(error_get_last());
                    $retorno['status'] = 1;
                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                }
            }
        } catch(Exception $e) {
            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryUpdateRecurso . "\n\nNão gravou a edição de título/descrição (L362 - catch exception). Verificar se há erro de sintaxe na query.";
            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecurso", $informacoesErro, $mat);
            $retorno['status'] = 0;
            $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível editar o recurso no momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            echo json_encode($retorno);
        }

        break;

    case 6:
        # alteração de arquivo e capa do recurso
        if($tipoArquivo == 'arquivo'){
            $renomearArquivo = rename(
                $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeArquivo'], 
                $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$nomeArquivoRecursoRenomeado);
            
            if($renomearArquivo == true){
                $pdfName = $_FILES['pdf']['name'];
                $pdfTmpName = $_FILES['pdf']['tmp_name'];
                $pdfDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeArquivo'];
                move_uploaded_file($pdfTmpName, $pdfDestination);

                if(file_exists($pdfDestination)){
                    chmod($pdfDestination, 0777);

                    $renomearCapa = rename(
                        $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'], 
                        $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$novoNomeArquivoCapa);
                    
                    if($renomearCapa == true){
                        $pngName = $_FILES['png']['name'];
                        $pngTmpName = $_FILES['png']['tmp_name'];
                        $pngDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'];
                        
                        move_uploaded_file($pngTmpName, $pngDestination);

                        if(file_exists($pngDestination)){
                            chmod($pngDestination, 0777);
                            
                            $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                                `idRecurso`, `matAlteracao`, `nomeArquivoAnterior`, `nomeArquivoNovo`, `nomeCapaAnterior`, `nomeCapaNovo`, `tipoAlteracao`
                            ) VALUES (
                                '".$idRecurso."', '".$mat."', '".$nomeArquivoRecursoRenomeado."', '".$execQueryConsulta[0]['nomeArquivo']."', '".$novoNomeArquivoCapa."', '".$execQueryConsulta[0]['nomeCapa']."', 'Alteração de arquivo do Recurso e arquivo de Capa');";

                            try {
                                $execGravaLog = $db->DbQuery($queryGravaLog);
                                if($execGravaLog){
                                    $mensagemSucesso = "Arquivos de Recurso e de Capa alterados com sucesso!";
                                    $retorno['status'] = 1;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                } else {
                                    $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo de recurso e de capa (else - L412). Verificar se há erro de sintaxe na query.";
                                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase6", $informacoesErro, $mat);
                                    $retorno['status'] = 0;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>Os arquivos de recurso e de capa foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                }
                            } catch(Exception $e) {
                                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo do recurso (catch exception - L418). Verificar se há erro de sintaxe na query.";
                                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase6", $informacoesErro, $mat);
                                $retorno['status'] = 0;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>Os arquivos de recurso e de capa foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                            }
                        } else {
                            $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa']." de capa do recurso. Informe à equipe responsável. (L425 - editarRecursos.php) ".print_r(error_get_last());
                            $retorno['status'] = 1;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                        }
                    } else {
                        $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa'].". Informe à equipe responsável. (L430 - editarRecursos.php) ".print_r(error_get_last());
                        $retorno['status'] = 1;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                    }
                } else {
                    $mensagemSucesso = "Não foi possível alterar os arquivos de Recurso e Capa. Informe à equipe responsável. (L435 - editarRecursos.php) ".error_get_last();
                    $retorno['status'] = 1;
                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                }
            } else {
                $mensagemSucesso = "Não foi possível alterar os arquivos de Recurso e Capa. Informe à equipe responsável. (L440 - editarRecursos.php) ".error_get_last();
                $retorno['status'] = 1;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
            }
        }

        if($tipoArquivo == 'linkExterno'){

            try {
                $execQueryUpdateLinkExterno = $db->DbQuery($queryUpdateLinkExterno);

                if($execQueryUpdateLinkExterno){
                    $pngName = $_FILES['png']['name'];
                    $pngTmpName = $_FILES['png']['tmp_name'];
                    $pngDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'];
                    
                    move_uploaded_file($pngTmpName, $pngDestination);

                    if(file_exists($pngDestination)){
                        chmod($pngDestination, 0777);
                        
                        $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                            `idRecurso`, `matAlteracao`, `nomeArquivoAnterior`, `nomeArquivoNovo`, `nomeCapaAnterior`, `nomeCapaNovo`, `tipoAlteracao`
                        ) VALUES (
                            '".$idRecurso."', '".$mat."', '".$nomeArquivoRecursoRenomeado."', '".$_POST['pdf']."', '".$novoNomeArquivoCapa."', '".$execQueryConsulta[0]['nomeCapa']."', 'Alteração de arquivo do Recurso e arquivo de Capa');";

                        try {
                            $execGravaLog = $db->DbQuery($queryGravaLog);
                            if($execGravaLog){
                                $mensagemSucesso = "Link externo de Recurso e arquivo de Capa alterados com sucesso!";
                                $retorno['status'] = 1;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                            } else {
                                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de recurso (else - L584). Verificar se há erro de sintaxe na query.";
                                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase6", $informacoesErro, $mat);
                                $retorno['status'] = 0;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>O recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                            }
                        } catch(Exception $e) {
                            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo do recurso (catch exception - L590). Verificar se há erro de sintaxe na query.";
                            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase6", $informacoesErro, $mat);
                            $retorno['status'] = 0;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>O recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                        }
                    } else {
                        $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo do recurso (catch exception - L590). Verificar se há erro de sintaxe na query.";
                        $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa']." de capa do recurso. Informe à equipe responsável. (L596 - editarRecursos.php) ".print_r(error_get_last());
                        $retorno['status'] = 1;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                    }
                }
            } catch(Exception $e){
                $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateLinkExterno: " . $queryUpdateLinkExterno . "\n\nNão foi possível editar o recurso (catch exception - L603). Verificar se há erro de sintaxe na query.";
                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase6", $informacoesErro, $mat);
                $retorno['status'] = 0;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível editar o recurso. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            }
        }
        echo json_encode($retorno);
        break;

    case 7:
        # alteração de título/descrição, arquivo e capa do recurso
        $queryUpdateRecurso = rtrim($queryUpdateRecurso, ",");

        //concatena tudo para execução
        $queryUpdateRecurso = "UPDATE `recursos`.`recursos` SET ".$queryUpdateRecurso." WHERE (`id` = '".$idRecurso."');";

        try {
            $execQueryUpdateRecurso = $db->DbQuery($queryUpdateRecurso);

            if($execQueryUpdateRecurso){
                if($tipoArquivo == 'arquivo'){
                    $renomearArquivo = rename(
                        $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeArquivo'], 
                        $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$nomeArquivoRecursoRenomeado);
                    
                    if($renomearArquivo == true){
                        $pdfName = $_FILES['pdf']['name'];
                        $pdfTmpName = $_FILES['pdf']['tmp_name'];
                        $pdfDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeArquivo'];
                        move_uploaded_file($pdfTmpName, $pdfDestination);

                        if(file_exists($pdfDestination)){
                            chmod($pdfDestination, 0777);

                            $renomearCapa = rename(
                                $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'], 
                                $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$novoNomeArquivoCapa);
                            
                            if($renomearCapa == true){
                                $pngName = $_FILES['png']['name'];
                                $pngTmpName = $_FILES['png']['tmp_name'];
                                $pngDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'];
                                
                                move_uploaded_file($pngTmpName, $pngDestination);

                                if(file_exists($pngDestination)){
                                    chmod($pngDestination, 0777);
                                    
                                    $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                                        `idRecurso`, `matAlteracao`, `tituloAnterior`, `tituloNovo`, `descricaoAnterior`, `descricaoNova`, `nomeArquivoAnterior`, `nomeArquivoNovo`, `nomeCapaAnterior`, `nomeCapaNovo`, `tipoAlteracao`
                                    ) VALUES (
                                        '".$idRecurso."', '".$mat."', '".$execQueryConsulta[0]['titulo']."', '".$titulo."', '".$execQueryConsulta[0]['subtitulo']."', '".$descricao."', '".$nomeArquivoRecursoRenomeado."', '".$execQueryConsulta[0]['nomeArquivo']."', '".$novoNomeArquivoCapa."', '".$execQueryConsulta[0]['nomeCapa']."', 'Alteração de título/descrição, arquivo do Recurso e arquivo de Capa');";
                    
                                    try {
                                        $execGravaLog = $db->DbQuery($queryGravaLog);
                                        if($execGravaLog){
                                            $mensagemSucesso = "Título/Descrição e arquivos de Recurso e de Capa alterados com sucesso!";
                                            $retorno['status'] = 1;
                                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                        } else {
                                            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de título/descrição, arquivo de recurso e de capa (else - L412). Verificar se há erro de sintaxe na query.";
                                            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase7", $informacoesErro, $mat);
                                            $retorno['status'] = 0;
                                            $retorno['mensagem'] = "<p style='font-size: 16px;'>O título/descrição e arquivos de recurso e de capa foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                        }
                                    } catch(Exception $e) {
                                        $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo do recurso (catch exception - L503). Verificar se há erro de sintaxe na query.";
                                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase7", $informacoesErro, $mat);
                                        $retorno['status'] = 0;
                                        $retorno['mensagem'] = "<p style='font-size: 16px;'>Os arquivos de recurso e de capa foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                    }
                                } else {
                                    $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa']." de capa do recurso. Informe à equipe responsável. (L509 - editarRecursos.php) ".print_r(error_get_last());
                                    $retorno['status'] = 1;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                }
                            } else {
                                $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa'].". Informe à equipe responsável. (L514 - editarRecursos.php) ".print_r(error_get_last());
                                $retorno['status'] = 1;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                            }
                        } else {
                            $mensagemSucesso = "O título/descrição foi alterado, porém não foi possível alterar os arquivos de Recurso e Capa. Informe à equipe responsável. (L519 - editarRecursos.php) ".error_get_last();
                            $retorno['status'] = 1;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                        }
                    } else {
                        $mensagemSucesso = "O título/descrição foi alterado, porém não foi possível alterar os arquivos de Recurso e Capa. Informe à equipe responsável. (L524 - editarRecursos.php) ".error_get_last();
                        $retorno['status'] = 1;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                    }
                } else if($tipoArquivo == 'linkExterno'){

                    try {
                        $execQueryUpdateLinkExterno = $db->DbQuery($queryUpdateLinkExterno);

                        if($execQueryUpdateLinkExterno){
                            $renomearCapa = rename(
                                $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'], 
                                $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$novoNomeArquivoCapa);
                            
                            if($renomearCapa == true){
                                $pngName = $_FILES['png']['name'];
                                $pngTmpName = $_FILES['png']['tmp_name'];
                                $pngDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'];
                                
                                move_uploaded_file($pngTmpName, $pngDestination);

                                if(file_exists($pngDestination)){
                                    chmod($pngDestination, 0777);
                                    
                                    $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                                        `idRecurso`, `matAlteracao`, `tituloAnterior`, `tituloNovo`, `descricaoAnterior`, `descricaoNova`, `nomeArquivoAnterior`, `nomeArquivoNovo`, `nomeCapaAnterior`, `nomeCapaNovo`, `tipoAlteracao`
                                    ) VALUES (
                                        '".$idRecurso."', '".$mat."', '".$execQueryConsulta[0]['titulo']."', '".$titulo."', '".$execQueryConsulta[0]['subtitulo']."', '".$descricao."', '".$nomeArquivoRecursoRenomeado."', '".$_POST['pdf']."', '".$novoNomeArquivoCapa."', '".$execQueryConsulta[0]['nomeCapa']."', 'Alteração de título/descrição, arquivo do Recurso e arquivo de Capa');";

                                    try {
                                        $execGravaLog = $db->DbQuery($queryGravaLog);
                                        if($execGravaLog){
                                            $mensagemSucesso = "Título/Descrição, link externo e arquivo de Capa alterados com sucesso!";
                                            $retorno['status'] = 1;
                                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                        } else {
                                            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de título/descrição, link externo recurso e arquivo de capa (else - L724). Verificar se há erro de sintaxe na query.";
                                            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase7", $informacoesErro, $mat);
                                            $retorno['status'] = 0;
                                            $retorno['mensagem'] = "<p style='font-size: 16px;'>O título/descrição, link externo de recurso e arquivo de capa foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                        }
                                    } catch(Exception $e) {
                                        $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo do recurso (catch exception - L730). Verificar se há erro de sintaxe na query.";
                                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase7", $informacoesErro, $mat);
                                        $retorno['status'] = 0;
                                        $retorno['mensagem'] = "<p style='font-size: 16px;'>Os arquivos de recurso e de capa foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                    }
                                } else {
                                    $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa']." de capa do recurso. Informe à equipe responsável. (L736 - editarRecursos.php) ".print_r(error_get_last());
                                    $retorno['status'] = 1;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                }
                            } else {
                                $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa'].". Informe à equipe responsável. (L514 - editarRecursos.php) ".print_r(error_get_last());
                                $retorno['status'] = 1;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                            }
                        }
                    } catch(Exception $e) {
                        $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateLinkExterno: " . $queryUpdateLinkExterno . "\n\Gravou a alteração de título/descrição, mas não gravou a alteração de link externo e arquivo de capa (catch exception - L747). Verificar se há erro de sintaxe na query.";
                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase7", $informacoesErro, $mat);
                        $retorno['status'] = 0;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>Os arquivos de recurso e de capa foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                    }
                }
            } else {
                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryUpdateRecurso . "\n\nNão gravou a edição de título/descrição nem alterou o arquivo/link de recurso e capa (L529 - editarRecursos.php - else). Verificar se há erro de sintaxe na query.";
                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecurso", $informacoesErro, $mat);
                $retorno['status'] = 0;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>Tema do recurso alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            }
        } catch(Exception $e){
                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryUpdateRecurso . "\n\nNão gravou a edição de título/descrição nem alterou o arquivo/link de recurso e capa (L549 - catch exception). Verificar se há erro de sintaxe na query.";
                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecurso", $informacoesErro, $mat);
                $retorno['status'] = 0;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível editar o recurso no momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            echo json_encode($retorno);
        }
        break;

    case 8:
        #caso seja apenas alteração de tema
        try{
            $execUpdateTema = $db->DbQuery($queryUpdateTema);
            if($execUpdateTema){
                $mensagemSucesso = "Tema do Recurso alterado com sucesso!";
                $retorno['status'] = 1;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
            } else {
                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryUpdateTema . "\n\nNão foi possível alterar o tema. Verificar a mensagem de erro e se há erro de sintaxe na query.";
                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecurso", $informacoesErro, $mat);
                $retorno['status'] = 0;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível alterar o tema do Recurso. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            }
        } catch(Exception $e){
            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryUpdateTema . "\n\nNão foi possível alterar o tema. Verificar a mensagem de erro e se há erro de sintaxe na query.";
            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecurso", $informacoesErro, $mat);
            $retorno['status'] = 0;
            $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível alterar o tema do Recurso. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            echo json_encode($retorno);
        }
        break;
    
    case 9:
        # alteração de título/descrição e tema do recurso
        
        #remove a vírgula do campo refente ao último item a ser editado
        $queryUpdateRecurso = rtrim($queryUpdateRecurso, ",");

        //concatena tudo para execução
        $queryUpdateRecurso = "UPDATE `recursos`.`recursos` SET ".$queryUpdateRecurso." WHERE (`id` = '".$idRecurso."');";

        try {
            $execQueryUpdateRecurso = $db->DbQuery($queryUpdateRecurso);
            if($execQueryUpdateRecurso){
                try{
                    $execUpdateTema = $db->DbQuery($queryUpdateTema);
                    if($execUpdateTema){

                        $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                            `idRecurso`, `matAlteracao`, `tituloAnterior`, `tituloNovo`, `descricaoAnterior`, `descricaoNova`, `temaAnterior`, `temaNovo`, `tipoAlteracao` 
                        ) VALUES (
                            '".$idRecurso."', '".$mat."', '".$execQueryConsulta[0]['titulo']."', '".$titulo."', '".$execQueryConsulta[0]['subtitulo']."', '".$descricao."', '".$execQueryConsulta[0]['idTema']."', '".$idTema."', 'Alteração de título/descrição e tema Recurso');";

                        try {
                            $execGravaLog = $db->DbQuery($queryGravaLog);
                            if($execGravaLog){
                                $mensagemSucesso = "Título/descrição e tema do Recurso alterados com sucesso!";
                                $retorno['status'] = 1;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                            } else {
                                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de título/descrição e tema do recurso (else - L598). Verificar se há erro de sintaxe na query.";
                                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase9", $informacoesErro, $mat);
                                $retorno['status'] = 0;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>O título/descrição do recurso e tema foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                            }
                        } catch(Exception $e) {
                            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de título/descrição e tema do recurso (catch exception - L604). Verificar se há erro de sintaxe na query.";
                            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase9", $informacoesErro, $mat);
                            $retorno['status'] = 0;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>O título/descrição do recurso e tema foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                        }
                    }
                } catch(Exception $e){
                    $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryUpdateTema . "\n\nO título/descrição foi alterado, porém não foi possível alterar o tema do Recurso. Verificar a mensagem de erro e se há erro de sintaxe na query.";
                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase9", $informacoesErro, $mat);
                    $retorno['status'] = 0;
                    $retorno['mensagem'] = "<p style='font-size: 16px;'>O título/descrição foi alterado, porém não foi possível alterar o tema do Recurso. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                }
            }
        } catch(Exception $e) {
            $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateRecurso: " . $queryUpdateRecurso . "\n\n\$queryUpdateTema: ".$queryUpdateTema." Não foi possível alterar o Recurso. Verificar a mensagem de erro e se há erro de sintaxe na query.";
            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase9", $informacoesErro, $mat);
            $retorno['status'] = 0;
            $retorno['mensagem'] = "<p style='font-size: 16px;'>Oão foi possível alterar o tema do Recurso. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            echo json_encode($retorno);
        }
        break;

    case 10:
        # alteração de arquivo e tema do recurso
        try{
            $execUpdateTema = $db->DbQuery($queryUpdateTema);
            if($execUpdateTema){
                if($tipoArquivo == 'arquivo') {
                    $renomearArquivo = rename(
                        $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeArquivo'], 
                        $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$nomeArquivoRecursoRenomeado);
                    
                    if($renomearArquivo == true){
                        $pdfName = $_FILES['pdf']['name'];
                        $pdfTmpName = $_FILES['pdf']['tmp_name'];
                        $pdfDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeArquivo'];
                        move_uploaded_file($pdfTmpName, $pdfDestination);

                        if(file_exists($pdfDestination)){
                            chmod($pdfDestination, 0777);
                            
                            $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                                `idRecurso`, `matAlteracao`, `nomeArquivoAnterior`, `nomeArquivoNovo`, `temaAnterior`, `temaNovo`, `tipoAlteracao` 
                            ) VALUES (
                                '".$idRecurso."', '".$mat."', '".$nomeArquivoRecursoRenomeado."', '".$execQueryConsulta[0]['nomeArquivo']."', '".$execQueryConsulta[0]['idTema']."', '".$idTema."', 'Alteração de Tema e arquivo do Recurso');";

                            try {
                                $execGravaLog = $db->DbQuery($queryGravaLog);
                                if($execGravaLog){
                                    $mensagemSucesso = "Arquivo e tema do recurso alterados com sucesso!";
                                    $retorno['status'] = 1;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                } else {
                                    $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo e tema do recurso (else - L641). Verificar se há erro de sintaxe na query.";
                                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase10", $informacoesErro, $mat);
                                    $retorno['status'] = 0;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>O arquivo do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                }
                            } catch(Exception $e) {
                                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo do recurso (catch exception - L647). Verificar se há erro de sintaxe na query.";
                                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase10", $informacoesErro, $mat);
                                $retorno['status'] = 0;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>O arquivo do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                            }
                        } else {
                            $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeArquivo'].". Informe à equipe responsável (else L653). ".error_get_last();
                            $retorno['status'] = 1;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                        }
                    } else {
                        $mensagemSucesso = "O tema foi alterado, porém não foi possível alterar o arquivo do Recurso. Informe à equipe responsável. L658 - editarRecursos.php. ".error_get_last();
                        $retorno['status'] = 1;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                    }
                }

                if($tipoArquivo == 'linkExterno'){
                    try {
                        $execQueryUpdateLinkExterno = $db->DbQuery($queryUpdateLinkExterno);

                        if($execQueryUpdateLinkExterno){
                            $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                                `idRecurso`, `matAlteracao`, `nomeArquivoAnterior`, `nomeArquivoNovo`, `temaAnterior`, `temaNovo`, `tipoAlteracao` 
                            ) VALUES (
                                '".$idRecurso."', '".$mat."', '".$nomeArquivoRecursoRenomeado."', '".$_POST['pdf']."', '".$execQueryConsulta[0]['idTema']."', '".$idTema."', 'Alteração de Tema e link externo do Recurso');";
                            
                            try {
                                $execGravaLog = $db->DbQuery($queryGravaLog);
                                if($execGravaLog){
                                    $mensagemSucesso = "Link externo e tema do recurso alterados com sucesso!";
                                    $retorno['status'] = 1;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                } else {
                                    $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo e tema do recurso (else - L922). Verificar se há erro de sintaxe na query.";
                                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase10", $informacoesErro, $mat);
                                    $retorno['status'] = 0;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>O arquivo do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                }
                            } catch(Exception $e) {
                                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo do recurso (catch exception - L928). Verificar se há erro de sintaxe na query.";
                                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase10", $informacoesErro, $mat);
                                $retorno['status'] = 0;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>O arquivo do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                            }
                        } else {
                            $mensagemSucesso = "Não foi possível alterar o link externo. Informe à equipe responsável (else L934). ".error_get_last();
                            $retorno['status'] = 1;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                        }
                    } catch(Exception $e) {
                        $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateLinkExterno: " . $queryUpdateLinkExterno . "\n\nO tema foi alterado, porém não foi possível alterar o link externo do Recurso. (L939 - else). Verificar se há erro de sintaxe na query.";
                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase10", $informacoesErro, $mat);
                        $retorno['status'] = 1;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>O tema foi alterado, porém não foi possível alterar o link externo do Recurso.Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                    }
                }
            } else {
                $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateTema: " . $queryUpdateTema . "\n\nNão gravou a edição de tema nem alterou o arquivos de recurso (L945 - else). Verificar se há erro de sintaxe na query.";
                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase10", $informacoesErro, $mat);
                $retorno['status'] = 0;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível editar o recurso no momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            }
        } catch (Exception $e){
            $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateTema: " . $queryUpdateTema . "\n\nNão gravou a edição de tema nem alterou o arquivos de recurso (L951 - catch exception). Verificar se há erro de sintaxe na query.";
            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase10", $informacoesErro, $mat);
            $retorno['status'] = 0;
            $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível editar o recurso no momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            echo json_encode($retorno);
        }

        break;

    case 11:
        # alteração de título/descricao, tema e arquivo do recurso
        $queryUpdateRecurso = rtrim($queryUpdateRecurso, ",");

        //concatena tudo para execução
        $queryUpdateRecurso = "UPDATE `recursos`.`recursos` SET ".$queryUpdateRecurso." WHERE (`id` = '".$idRecurso."');";

        try {
            $execQueryUpdateRecurso = $db->DbQuery($queryUpdateRecurso);

            if($execQueryUpdateRecurso){
                try{
                    $execUpdateTema = $db->DbQuery($queryUpdateTema);
                    if($execUpdateTema){
                        if($tipoArquivo == 'arquivo'){
                            $renomearArquivo = rename(
                                $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeArquivo'], 
                                $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$nomeArquivoRecursoRenomeado);
                            
                            if($renomearArquivo == true){
                                $pdfName = $_FILES['pdf']['name'];
                                $pdfTmpName = $_FILES['pdf']['tmp_name'];
                                $pdfDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeArquivo'];
                                move_uploaded_file($pdfTmpName, $pdfDestination);

                                if(file_exists($pdfDestination)){
                                    chmod($pdfDestination, 0777);

                                    $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                                        `idRecurso`, `matAlteracao`, `tituloAnterior`, `tituloNovo`, `descricaoAnterior`, `descricaoNova`, `nomeArquivoAnterior`, `nomeArquivoNovo`, `temaAnterior`, `temaNovo`, `tipoAlteracao`
                                    ) VALUES (
                                        '".$idRecurso."', '".$mat."', '".$execQueryConsulta[0]['titulo']."', '".$titulo."', '".$execQueryConsulta[0]['subtitulo']."', '".$descricao."', '".$nomeArquivoRecursoRenomeado."', '".$execQueryConsulta[0]['nomeArquivo']."', '".$execQueryConsulta[0]['idTema']."', '".$idTema."', 'Alteração de título/descrição, tema e arquivo do Recurso');";
                                    
                                    try {
                                        $execGravaLog = $db->DbQuery($queryGravaLog);
                                        if($execGravaLog){
                                            $mensagemSucesso = "Título/descrição, tema e arquivo de Recurso alterados com sucesso!";
                                            $retorno['status'] = 1;
                                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                        } else {
                                            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de título/descrição, tema e arquivo de recurso (L1002). Verificar se há erro de sintaxe na query.";
                                            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase11", $informacoesErro, $mat);
                                            $retorno['status'] = 0;
                                            $retorno['mensagem'] = "<p style='font-size: 16px;'>O título/descrição, tema e arquivo de recurso foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                        }
                                    } catch(Exception $e) {
                                        $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de título/descrição, tema e arquivo de recurso (catch exception - L1008). Verificar se há erro de sintaxe na query.";
                                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase11", $informacoesErro, $mat);
                                        $retorno['status'] = 0;
                                        $retorno['mensagem'] = "<p style='font-size: 16px;'>O título/descrição, tema e o arquivo de recurso foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                    }
                                } else {
                                    $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa']." do recurso. Informe à equipe responsável.  L1014 - editaRecursos.php ".print_r(error_get_last());
                                    $retorno['status'] = 1;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                }
                            } else {
                                $mensagemSucesso = "O título/descrição e tema foram alterados, porém não foi possível alterar o arquivo de Recurso. Informe à equipe responsável. L1019 - editarRecursos.php. ".error_get_last();
                                $retorno['status'] = 1;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                            }
                        }
                        if($tipoArquivo == 'linkExterno'){
                            try {
                                $execQueryUpdateLinkExterno = $db->DbQuery($queryUpdateLinkExterno);

                                if($execQueryUpdateLinkExterno){
                                    
                                    $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                                        `idRecurso`, `matAlteracao`, `tituloAnterior`, `tituloNovo`, `descricaoAnterior`, `descricaoNova`, `nomeArquivoAnterior`, `nomeArquivoNovo`, `temaAnterior`, `temaNovo`, `tipoAlteracao`
                                    ) VALUES (
                                        '".$idRecurso."', '".$mat."', '".$execQueryConsulta[0]['titulo']."', '".$titulo."', '".$execQueryConsulta[0]['subtitulo']."', '".$descricao."', '".$nomeArquivoRecursoRenomeado."', '".$_POST['pdf']."', '".$execQueryConsulta[0]['idTema']."', '".$idTema."', 'Alteração de título/descrição, tema e link externo do Recurso');";
                                    
                                    try {
                                        $execGravaLog = $db->DbQuery($queryGravaLog);
                                        if($execGravaLog){
                                            $mensagemSucesso = "Título/descrição/status, link externo e tema do recurso alterados com sucesso!";
                                            $retorno['status'] = 1;
                                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                        } else {
                                            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo e tema do recurso (else - L1042). Verificar se há erro de sintaxe na query.";
                                            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase11", $informacoesErro, $mat);
                                            $retorno['status'] = 0;
                                            $retorno['mensagem'] = "<p style='font-size: 16px;'>O arquivo do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                        }
                                    } catch(Exception $e) {
                                        $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo do recurso (catch exception - L1048). Verificar se há erro de sintaxe na query.";
                                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase11", $informacoesErro, $mat);
                                        $retorno['status'] = 0;
                                        $retorno['mensagem'] = "<p style='font-size: 16px;'>O arquivo do recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                    }
                                } else {
                                    $mensagemSucesso = "Não foi possível alterar o link externo. Informe à equipe responsável (else L1054). ".error_get_last();
                                    $retorno['status'] = 1;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                }

                            } catch(Exception $e) {
                                $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateLinkExterno: " . $queryUpdateLinkExterno . "\n\nO tema foi alterado, porém não foi possível alterar o link externo do Recurso. (L1060 - else). Verificar se há erro de sintaxe na query.";
                                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase11", $informacoesErro, $mat);
                                $retorno['status'] = 1;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>O tema foi alterado, porém não foi possível alterar o link externo do Recurso.Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                            }
                        }
                    } else {
                        $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateTema: " . $queryUpdateTema . "\n\nAlterou o título/descrição, porém não gravou a edição de tema nem alterou o arquivos de recurso (L1067 - else). Verificar se há erro de sintaxe na query.";
                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase11", $informacoesErro, $mat);
                        $retorno['status'] = 0;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível editar o recurso no momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                    }
                } catch(Exception $e) {
                    $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateTema: " . $queryUpdateTema . "\n\nAlterou o título/descrição, porém não gravou a edição de tema nem alterou o arquivos de recurso (L1073 - catch exception). Verificar se há erro de sintaxe na query.";
                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase11", $informacoesErro, $mat);
                    $retorno['status'] = 0;
                    $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível editar o recurso no momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                }

            } else {
                $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateRecurso: " . $queryUpdateRecurso . "\n\nNão realizou nenhuma alteração no recurso: título/descrição, tema e arquivo/link externo (L1080 - else). Verificar se há erro de sintaxe na query.";
                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase11", $informacoesErro, $mat);
                $retorno['status'] = 0;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível editar o recurso no momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            }
        } catch(Exception $e){
            $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateRecurso: " . $queryUpdateRecurso . "\n\nNão realizou nenhuma alteração no recurso: título/descrição, tema e arquivo/link externo  (L1086 - catch exception). Verificar se há erro de sintaxe na query.";
            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase11", $informacoesErro, $mat);
            $retorno['status'] = 0;
            $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível editar o recurso no momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            echo json_encode($retorno);
        }
        break;

    case 12:
        # alteração de tema e capa
        try{
            $execUpdateTema = $db->DbQuery($queryUpdateTema);
            if($execUpdateTema){
                $renomearCapa = rename(
                    $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'], 
                    $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$novoNomeArquivoCapa);
                
                if($renomearCapa == true){
                    $pngName = $_FILES['png']['name'];
                    $pngTmpName = $_FILES['png']['tmp_name'];
                    $pngDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'];
                    
                    move_uploaded_file($pngTmpName, $pngDestination);

                    if(file_exists($pngDestination)){
                        chmod($pngDestination, 0777);

                        $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                            `idRecurso`, `matAlteracao`, `nomeCapaAnterior`, `nomeCapaNovo`, `temaAnterior`, `temaNovo`, `tipoAlteracao`
                        ) VALUES (
                            '".$idRecurso."', '".$mat."', '".$novoNomeArquivoCapa."', '".$execQueryConsulta[0]['nomeCapa']."', '".$execQueryConsulta[0]['idTema']."', '".$idTema."', 'Alteração de tema e arquivo de Capa');";
                        
                        try {
                            $execGravaLog = $db->DbQuery($queryGravaLog);
                            if($execGravaLog){
                                $mensagemSucesso = "Tema e arquivo de Capa alterados com sucesso!";
                                $retorno['status'] = 1;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                            } else {
                                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de tema e arquivo de capa (L810 - else). Verificar se há erro de sintaxe na query.";
                                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase12", $informacoesErro, $mat);
                                $retorno['status'] = 0;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>O tema e arquivo de capa foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                            }
                        } catch(Exception $e) {
                            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de tema e arquivo de capa (L816 - catch exception). Verificar se há erro de sintaxe na query.";
                            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase12", $informacoesErro, $mat);
                            $retorno['status'] = 0;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>O tema e arquivo de capa foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                        }
                    } else {
                        $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa']." de capa do recurso. Informe à equipe responsável.  L822 - editaRecursos.php ".print_r(error_get_last());
                        $retorno['status'] = 1;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                    }
                } else {
                    $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa'].". Informe à equipe responsável. (L827 - editarRecursos.php) ".print_r(error_get_last());
                    $retorno['status'] = 1;
                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                }
            } else {
                $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateRecurso: " . $queryUpdateRecurso . "\n\nNão alterou título/descrição, tema nem arquivo de recurso (L773 - catch exception). Verificar se há erro de sintaxe na query.";
                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase12", $informacoesErro, $mat);
                $retorno['status'] = 0;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível editar o recurso no momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            }
        } catch(Exception $e) {
            $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateRecurso: " . $queryUpdateRecurso . "\n\nNão alterou título/descrição, tema nem arquivo de recurso (L773 - catch exception). Verificar se há erro de sintaxe na query.";
            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase12", $informacoesErro, $mat);
            $retorno['status'] = 0;
            $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível editar o recurso no momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            echo json_encode($retorno);
        }
        break;

    case 13:
        # alteração de título/descrição, capa e tema do recurso
        $queryUpdateRecurso = rtrim($queryUpdateRecurso, ",");

        //concatena tudo para execução do update de título/descrição
        $queryUpdateRecurso = "UPDATE `recursos`.`recursos` SET ".$queryUpdateRecurso." WHERE (`id` = '".$idRecurso."');";

        try {
            $execQueryUpdateRecurso = $db->DbQuery($queryUpdateRecurso);

            if($execQueryUpdateRecurso){
                try {
                    $execUpdateTema = $db->DbQuery($queryUpdateTema);
                
                    if($execUpdateTema){
                        $renomearCapa = rename(
                            $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'], 
                            $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$novoNomeArquivoCapa);
                        
                        if($renomearCapa == true){
                            $pngName = $_FILES['png']['name'];
                            $pngTmpName = $_FILES['png']['tmp_name'];
                            $pngDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'];
                           
                            move_uploaded_file($pngTmpName, $pngDestination);

                            if(file_exists($pngDestination)){
                                chmod($pngDestination, 0777);
                                
                                $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                                    `idRecurso`, `matAlteracao`, `tituloAnterior`, `tituloNovo`, `descricaoAnterior`, `descricaoNova`, `nomeCapaAnterior`, `nomeCapaNovo`, `temaAnterior`, `temaNovo`, `tipoAlteracao`
                                ) VALUES (
                                    '".$idRecurso."', '".$mat."', '".$execQueryConsulta[0]['titulo']."', '".$titulo."', '".$execQueryConsulta[0]['subtitulo']."', '".$descricao."', '".$novoNomeArquivoCapa."', '".$execQueryConsulta[0]['nomeCapa']."', '".$execQueryConsulta[0]['idTema']."', '".$idTema."', 'Alteração de título/descrição, tema e arquivo de Capa');";
                                
                                try {
                                    $execGravaLog = $db->DbQuery($queryGravaLog);
                                    if($execGravaLog){
                                        $mensagemSucesso = "Título/descrição, tema e arquivo de Capa alterados com sucesso!";
                                        $retorno['status'] = 1;
                                        $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                    } else {
                                        $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de título/descrição, tema e arquivo de capa (L884 - else). Verificar se há erro de sintaxe na query.";
                                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase13", $informacoesErro, $mat);
                                        $retorno['status'] = 0;
                                        $retorno['mensagem'] = "<p style='font-size: 16px;'>O tema e arquivo de capa foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                    }
                                } catch(Exception $e) {
                                    $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de tema e arquivo de capa (L890 - catch exception). Verificar se há erro de sintaxe na query.";
                                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase13", $informacoesErro, $mat);
                                    $retorno['status'] = 0;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>O tema e arquivo de capa foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                }
                            } else {
                                $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa']." de capa do recurso. Informe à equipe responsável.  (L896 - editaRecursos.php) ".print_r(error_get_last());
                                $retorno['status'] = 1;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                            }
                        } else {
                            $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa'].". Informe à equipe responsável. (L901 - editarRecursos.php) ".print_r(error_get_last());
                            $retorno['status'] = 1;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                        }
                    }
                } catch (Exception $e) {
                    $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateTema: " . $queryUpdateTema . "\n\nAlterou o título/descrição, porém não alterou o tema e arquivo de capa (L911 - catch exception). Verificar se há erro de sintaxe na query.";
                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase13", $informacoesErro, $mat);
                    $retorno['status'] = 0;
                    $retorno['mensagem'] = "<p style='font-size: 16px;'>O título/descrição, porém não foi possível alterar o tema e o arquivo de capa. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                }
            } else {
                $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateTema: " . $queryUpdateTema . "\n\nAlterou o título/descrição, porém não gravou a edição de tema nem alterou o arquivos de recurso (L767 - else). Verificar se há erro de sintaxe na query.";
                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase13", $informacoesErro, $mat);
                $retorno['status'] = 0;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível editar o recurso no momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            }
        } catch(Exception $e){
            $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateRecurso: " . $queryUpdateRecurso . "\n\nNão foi possível alterar o título/descrição, o tema e arquivo de recurso (L921 - catch exception). Verificar se há erro de sintaxe na query.";
            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase13", $informacoesErro, $mat);
            $retorno['status'] = 0;
            $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível editar o recurso no momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            echo json_encode($retorno);
        }
        break;

    case 14:
        # alteração de arquivo/link externo, capa e tema do recurso
        try{
            $execUpdateTema = $db->DbQuery($queryUpdateTema);
            if($execUpdateTema){
                if($tipoArquivo == 'arquivo'){
                    $renomearArquivo = rename(
                        $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeArquivo'], 
                        $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$nomeArquivoRecursoRenomeado);
                    
                    if($renomearArquivo == true){
                        $pdfName = $_FILES['pdf']['name'];
                        $pdfTmpName = $_FILES['pdf']['tmp_name'];
                        $pdfDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeArquivo'];
                        move_uploaded_file($pdfTmpName, $pdfDestination);

                        if(file_exists($pdfDestination)){
                            chmod($pdfDestination, 0777);

                            $renomearCapa = rename(
                                $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'], 
                                $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$novoNomeArquivoCapa);
                            
                            if($renomearCapa == true){
                                $pngName = $_FILES['png']['name'];
                                $pngTmpName = $_FILES['png']['tmp_name'];
                                $pngDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'];

                                move_uploaded_file($pngTmpName, $pngDestination);

                                if(file_exists($pngDestination)){
                                    chmod($pngDestination, 0777);
                                    
                                    $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                                        `idRecurso`, `matAlteracao`, `nomeArquivoAnterior`, `nomeArquivoNovo`, `nomeCapaAnterior`, `nomeCapaNovo`, `temaAnterior`, `temaNovo`, `tipoAlteracao`
                                    ) VALUES (
                                        '".$idRecurso."', '".$mat."', '".$nomeArquivoRecursoRenomeado."', '".$execQueryConsulta[0]['nomeArquivo']."', '".$novoNomeArquivoCapa."', '".$execQueryConsulta[0]['nomeCapa']."', '".$execQueryConsulta[0]['idTema']."', '".$idTema."', 'Alteração de tema e arquivos do Recurso e arquivo de Capa');";
                                    
                                    try {
                                        $execGravaLog = $db->DbQuery($queryGravaLog);
                                        if($execGravaLog){
                                            $mensagemSucesso = "Tema e arquivos de Recurso e de Capa alterados com sucesso!";
                                            $retorno['status'] = 1;
                                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                        } else {
                                            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de título/descrição, tema e arquivos de recurso e de capa (L653). Verificar se há erro de sintaxe na query.";
                                            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase14", $informacoesErro, $mat);
                                            $retorno['status'] = 0;
                                            $retorno['mensagem'] = "<p style='font-size: 16px;'>O título/descrição e arquivos de recurso e de capa foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                        }
                                    } catch(Exception $e) {
                                        $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo do recurso (catch exception - L734). Verificar se há erro de sintaxe na query.";
                                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase14", $informacoesErro, $mat);
                                        $retorno['status'] = 0;
                                        $retorno['mensagem'] = "<p style='font-size: 16px;'>O tema e os arquivos de recurso e de capa foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                    }
                                } else {
                                    $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa']." de capa do recurso. Informe à equipe responsável.  L924 - editaRecursos.php ".print_r(error_get_last());
                                    $retorno['status'] = 1;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                }
                            } else {
                                $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa'].". Informe à equipe responsável. L929 - editaRecursos.php ".print_r(error_get_last());
                                $retorno['status'] = 1;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                            }
                        } else {
                            $mensagemSucesso = "O título/descrição e o tema foram alterados, porém não foi possível alterar os arquivos de Recurso e Capa. Informe à equipe responsável. L661 - editarRecursos.php. ".error_get_last();
                            $retorno['status'] = 1;
                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                        }
                    } else {
                        $mensagemSucesso = "O tema foi alterado, porém não foi possível alterar os arquivos de Recurso e Capa. Informe à equipe responsável. L666 - editarRecursos.php. ".error_get_last();
                        $retorno['status'] = 1;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                    }
                }

                if($tipoArquivo == 'linkExterno'){
                    try {
                        $execQueryUpdateLinkExterno = $db->DbQuery($queryUpdateLinkExterno);

                        if($execQueryUpdateLinkExterno){
                            $renomearCapa = rename(
                                $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'], 
                                $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$novoNomeArquivoCapa);
                            
                            if($renomearCapa == true){
                                $pngName = $_FILES['png']['name'];
                                $pngTmpName = $_FILES['png']['tmp_name'];
                                $pngDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'];

                                move_uploaded_file($pngTmpName, $pngDestination);

                                if(file_exists($pngDestination)){
                                    chmod($pngDestination, 0777);

                                    $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                                        `idRecurso`, `matAlteracao`, `nomeArquivoAnterior`, `nomeArquivoNovo`, `nomeCapaAnterior`, `nomeCapaNovo`, `temaAnterior`, `temaNovo`, `tipoAlteracao`
                                    ) VALUES (
                                        '".$idRecurso."', '".$mat."', '".$nomeArquivoRecursoRenomeado."', '".$_POST['pdf']."', '".$novoNomeArquivoCapa."', '".$execQueryConsulta[0]['nomeCapa']."', '".$execQueryConsulta[0]['idTema']."', '".$idTema."', 'Alteração de tema, link externo e arquivo de Capa');";

                                    try {
                                        $execGravaLog = $db->DbQuery($queryGravaLog);
                                        if($execGravaLog){
                                            $mensagemSucesso = "Tema, link externo e Capa alterados com sucesso!";
                                            $retorno['status'] = 1;
                                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                        } else {
                                            $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de tema, link e capa (L1359). Verificar se há erro de sintaxe na query.";
                                            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase14", $informacoesErro, $mat);
                                            $retorno['status'] = 0;
                                            $retorno['mensagem'] = "<p style='font-size: 16px;'>O recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                        }
                                    } catch(Exception $e) {
                                        $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nO recurso foi alterado, porém podem ter ocorrido falhas na gravação do Log (catch exception - L1365). Verificar se há erro de sintaxe na query.";
                                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase14", $informacoesErro, $mat);
                                        $retorno['status'] = 0;
                                        $retorno['mensagem'] = "<p style='font-size: 16px;'>O recurso foi alterado porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                    }
                                } else {
                                    $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa']." de capa do recurso. Informe à equipe responsável.  L1371 - editaRecursos.php ".print_r(error_get_last());
                                    $retorno['status'] = 1;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                }
                            } else {
                                $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa'].". Informe à equipe responsável. L1376 - editaRecursos.php ".print_r(error_get_last());
                                $retorno['status'] = 1;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                            }
                        }
                    } catch(Exception $e) {
                        $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateLinkExterno: " . $queryUpdateLinkExterno . "\n\nAlterou o tema do recurso, porém não foi possível alterar o link externo e arquivo de capa. Verificar a mensagem de erro e se há erro de sintaxe na query.";
                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase14", $informacoesErro, $mat);
                        $retorno['status'] = 0;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>Alterou o tema do recurso, porém não foi possível alterar o link externo e arquivo de capa. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                    }
                }
            } else {
                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryUpdateTema . "\n\nNão foi possível alterar o tema e os arquivos do recurso e de capa. Verificar a mensagem de erro e se há erro de sintaxe na query.";
                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase14", $informacoesErro, $mat);
                $retorno['status'] = 0;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível alterar o tema do Recurso. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            }
        } catch(Exception $e){
            $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateTema: " . $queryUpdateTema . "\n\nNão foi possível alterar o tema e os arquivos do recurso e de capa. Verificar a mensagem de erro e se há erro de sintaxe na query.";
            $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase14", $informacoesErro, $mat);
            $retorno['status'] = 0;
            $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível alterar o tema e os arquivos do recurso e de capa. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            echo json_encode($retorno);
        }
        break;

    case 15:
        # alteração de tudo: título/descrição, arquivo, capa e tema do recurso
        $queryUpdateRecurso = rtrim($queryUpdateRecurso, ",");

        //concatena tudo para execução
        $queryUpdateRecurso = "UPDATE `recursos`.`recursos` SET ".$queryUpdateRecurso." WHERE (`id` = '".$idRecurso."');";

        try {
            $execQueryUpdateRecurso = $db->DbQuery($queryUpdateRecurso);

            if($execQueryUpdateRecurso){
                try{
                    $execUpdateTema = $db->DbQuery($queryUpdateTema);
                    if($execUpdateTema){
                        if($tipoArquivo == 'arquivo'){
                            $renomearArquivo = rename(
                                $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeArquivo'], 
                                $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$nomeArquivoRecursoRenomeado);

                            if($renomearArquivo == true){
                                $pdfName = $_FILES['pdf']['name'];
                                $pdfTmpName = $_FILES['pdf']['tmp_name'];
                                $pdfDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeArquivo'];
                                move_uploaded_file($pdfTmpName, $pdfDestination);

                                if(file_exists($pdfDestination)){
                                    chmod($pdfDestination, 0777);

                                    $renomearCapa = rename(
                                        $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'], 
                                        $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$novoNomeArquivoCapa);

                                    if($renomearCapa == true){
                                        $pngName = $_FILES['png']['name'];
                                        $pngTmpName = $_FILES['png']['tmp_name'];
                                        $pngDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'];
                                        
                                        move_uploaded_file($pngTmpName, $pngDestination);
                   
                                        if(file_exists($pngDestination)){
                                            chmod($pngDestination, 0777);
                                            
                                            $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                                                `idRecurso`, `matAlteracao`, `tituloAnterior`, `tituloNovo`, `descricaoAnterior`, `descricaoNova`, `nomeArquivoAnterior`, `nomeArquivoNovo`, `nomeCapaAnterior`, `nomeCapaNovo`, `temaAnterior`, `temaNovo`, `tipoAlteracao`
                                            ) VALUES (
                                                '".$idRecurso."', '".$mat."', '".$execQueryConsulta[0]['titulo']."', '".$titulo."', '".$execQueryConsulta[0]['subtitulo']."', '".$descricao."', '".$nomeArquivoRecursoRenomeado."', '".$execQueryConsulta[0]['nomeArquivo']."', '".$novoNomeArquivoCapa."', '".$execQueryConsulta[0]['nomeCapa']."', '".$execQueryConsulta[0]['idTema']."', '".$idTema."', 'Alteração de título/descrição, tema arquivo do Recurso e arquivo de Capa');";
                                            
                                            try {
                                                $execGravaLog = $db->DbQuery($queryGravaLog);
                                                if($execGravaLog){
                                                    $mensagemSucesso = "Título/Descrição/Status, Tema e arquivos de Recurso e de Capa alterados com sucesso!";
                                                    $retorno['status'] = 1;
                                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                                } else {
                                                    $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de título/descrição, tema e arquivos de recurso e de capa (L1458). Verificar se há erro de sintaxe na query.";
                                                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase15", $informacoesErro, $mat);
                                                    $retorno['status'] = 0;
                                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>O título/descrição e arquivos de recurso e de capa foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                                }
                                            } catch(Exception $e) {
                                                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo do recurso (catch exception - L1464). Verificar se há erro de sintaxe na query.";
                                                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase15", $informacoesErro, $mat);
                                                $retorno['status'] = 0;
                                                $retorno['mensagem'] = "<p style='font-size: 16px;'>Os arquivos de recurso e de capa foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                            }
                                        } else {
                                            $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa']." de capa do recurso. Informe à equipe responsável (L1470 - else) ".print_r(error_get_last());
                                            $retorno['status'] = 1;
                                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                        }
                                    } else {
                                        $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa'].". Informe à equipe responsável. (L1475 - editarRecursos) ".print_r(error_get_last());
                                        $retorno['status'] = 1;
                                        $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                    }
                                } else {
                                    $mensagemSucesso = "O título/descrição e o tema foram alterados, porém não foi possível alterar os arquivos de Recurso e Capa. Informe à equipe responsável. L1480 - editarRecursos.php. ".error_get_last();
                                    $retorno['status'] = 1;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                }
                            } else {
                                $mensagemSucesso = "O título/descrição foi alterado, porém não foi possível alterar os arquivos de Recurso e Capa. Informe à equipe responsável. L1485 - editarRecursos.php. ".error_get_last();
                                $retorno['status'] = 1;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                            }
                        }

                        if($tipoArquivo == 'linkExterno'){
                            
                            try {
                                $execQueryUpdateLinkExterno = $db->DbQuery($queryUpdateLinkExterno);
                
                                if($execQueryUpdateLinkExterno){
                                    $renomearCapa = rename(
                                        $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'], 
                                        $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$novoNomeArquivoCapa);
                                    
                                    if($renomearCapa == true){
                                        $pngName = $_FILES['png']['name'];
                                        $pngTmpName = $_FILES['png']['tmp_name'];
                                        $pngDestination = $_SERVER["DOCUMENT_ROOT"] .'/lib/apps/recursos/arquivos/'.$execQueryConsulta[0]['nomeCapa'];

                                        move_uploaded_file($pngTmpName, $pngDestination);

                                        if(file_exists($pngDestination)){
                                            chmod($pngDestination, 0777);
                                            
                                            $queryGravaLog = "INSERT INTO `recursos`.`logAlteracaoRecursos` (
                                                `idRecurso`, `matAlteracao`, `tituloAnterior`, `tituloNovo`, `descricaoAnterior`, `descricaoNova`, `nomeArquivoAnterior`, `nomeArquivoNovo`, `nomeCapaAnterior`, `nomeCapaNovo`, `temaAnterior`, `temaNovo`, `tipoAlteracao`
                                            ) VALUES (
                                                '".$idRecurso."', '".$mat."', '".$execQueryConsulta[0]['titulo']."', '".$titulo."', '".$execQueryConsulta[0]['subtitulo']."', '".$descricao."', '".$nomeArquivoRecursoRenomeado."', '".$_POST['pdf']."', '".$novoNomeArquivoCapa."', '".$execQueryConsulta[0]['nomeCapa']."', '".$execQueryConsulta[0]['idTema']."', '".$idTema."', 'Alteração de título/descrição/status, tema, link externo do Recurso e arquivo de capa');";
                                            
                                            try {
                                                $execGravaLog = $db->DbQuery($queryGravaLog);
                                                if($execGravaLog){
                                                    $mensagemSucesso = "Título/Descrição/Status, link externo, tema e capa do Recurso alterados com sucesso!";
                                                    $retorno['status'] = 1;
                                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                                } else {
                                                    $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de título/descrição, tema e arquivos de recurso e de capa (L1458). Verificar se há erro de sintaxe na query.";
                                                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase15", $informacoesErro, $mat);
                                                    $retorno['status'] = 0;
                                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>O título/descrição e arquivos de recurso e de capa foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                                }
                                            } catch(Exception $e) {
                                                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryGravaLog . "\n\nNão gravou o log da alteração de arquivo do recurso (catch exception - L1464). Verificar se há erro de sintaxe na query.";
                                                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase15", $informacoesErro, $mat);
                                                $retorno['status'] = 0;
                                                $retorno['mensagem'] = "<p style='font-size: 16px;'>Os arquivos de recurso e de capa foram alterados, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                            }
                                        } else {
                                            $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa']." de capa do recurso. Informe à equipe responsável (L1470 - else) ".print_r(error_get_last());
                                            $retorno['status'] = 1;
                                            $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                        }
                                    } else {
                                        $mensagemSucesso = "Não foi possível alterar o arquivo ".$execQueryConsulta[0]['nomeCapa'].". Informe à equipe responsável. (L1475 - editarRecursos) ".print_r(error_get_last());
                                        $retorno['status'] = 1;
                                        $retorno['mensagem'] = "<p style='font-size: 16px;'>".$mensagemSucesso."</p>";
                                    }
                                } else {
                                    $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateLinkExterno: " . $queryUpdateLinkExterno . "\n\nAlterou o título/descrição/status e o tema do recurso, porém não foi possível alterar o link externo e arquivo de capa. Verificar a mensagem de erro e se há erro de sintaxe na query.";
                                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase15", $informacoesErro, $mat);
                                    $retorno['status'] = 0;
                                    $retorno['mensagem'] = "<p style='font-size: 16px;'>Alterou o título/descrição/status e tema do recurso, porém não foi possível alterar o link externo e arquivo de capa. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                                }
                            } catch(Exception $e){
                                $informacoesErro = "Erro: " . $e . "\n\n\$queryUpdateLinkExterno: " . $queryUpdateLinkExterno . "\n\nAlterou o título/descrição/status e o tema do recurso, porém não foi possível alterar o link externo e arquivo de capa. Verificar a mensagem de erro e se há erro de sintaxe na query.";
                                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecursoCase15", $informacoesErro, $mat);
                                $retorno['status'] = 0;
                                $retorno['mensagem'] = "<p style='font-size: 16px;'>Alterou o título/descrição/status e tema do recurso, porém não foi possível alterar o link externo e arquivo de capa. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                            }
                        }
                    } else {
                        $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryUpdateTema . "\n\nHouve alteração do título/descrição, porém não foi possível alterar o tema e os arquivos de recurso e capa. Verificar a mensagem de erro e se há erro de sintaxe na query.";
                        $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecurso", $informacoesErro, $mat);
                        $retorno['status'] = 0;
                        $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível alterar o tema do Recurso. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                    }
                } catch(Exception $e){
                    $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryUpdateTema . "\n\nNão foi possível alterar o tema. Verificar a mensagem de erro e se há erro de sintaxe na query.";
                    $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecurso", $informacoesErro, $mat);
                    $retorno['status'] = 0;
                    $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível alterar o tema do Recurso. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
                }
            } else {
                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryUpdateRecurso . "\n\nNão gravou a edição de título/descrição e tema, nem alterou os arquivos de recurso e capa (L20241209_1506 - else). Verificar se há erro de sintaxe na query.";
                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecurso", $informacoesErro, $mat);
                $retorno['status'] = 0;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>Tema do recurso alterado, porém podem ter ocorrido falhas na gravação do Log. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            }
        } catch(Exception $e){
                $informacoesErro = "Erro: " . $e . "\n\n\$query: " . $queryUpdateRecurso . "\n\nNão gravou a edição de título/descrição nem alterou os arquivos de recurso e capa (L549 - catch exception). Verificar se há erro de sintaxe na query.";
                $arquivoLog = $geraLog->geraLogExcecao("recursos", "editaRecurso", $informacoesErro, $mat);
                $retorno['status'] = 0;
                $retorno['mensagem'] = "<p style='font-size: 16px;'>Não foi possível editar o recurso no momento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
        } finally {
            echo json_encode($retorno);
        }
        break;
}