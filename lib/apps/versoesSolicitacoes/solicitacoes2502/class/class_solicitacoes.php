<?php

ini_set('display_startup_errors', 1);
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

$mat = $_SESSION['matricula'];

Class funcoes {
    
    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        global $mat;
        $mat = $_SESSION['matricula'];
        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
    }

    // Função que conta o total de novas solicitações, para que exiba o alerta no cabeçalho da tabela na visão CAD
    public function contaNovasSolicitacoes(){
        global $mat;
        $db = New Database('solicitacoes');
        $queryContaNovasSolicitacoes = "SELECT * FROM solicitacoes.solicitacoes WHERE status = 1;";
        $retorno = array();
        try {
            $execQueryContaNovasSolicitacoes = $db->DbGetAll($queryContaNovasSolicitacoes);
            if(sizeof($execQueryContaNovasSolicitacoes) > 0){
                $retorno["mensagem"] = sizeof($execQueryContaNovasSolicitacoes);
                $retorno["status"] = '1';
            } else if(sizeof($execQueryContaNovasSolicitacoes) == 0){
                $retorno["mensagem"] = sizeof($execQueryContaNovasSolicitacoes);
                $retorno["status"] = '1';
            }
        } catch(Exception $e) {
            $informacoesErro = "erro: " . $e . "\n\\n\$queryContaNovasSolicitacoes:" . $queryContaNovasSolicitacoes;
            $arquivoLog = $this->geraLogExcecao("solicitacoes", "contaNovasSolicitacoes", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível verificar se há novas solicitações. Log " . $arquivoLog;
            $retorno["status"] = '0';
        } finally {
            return $retorno;
        }
    }

    // Função que conta o total de solicitações que saíram do status "nova" para qualquer outro, para que exiba o alerta no cabeçalho da tabela na visão CAD
    public function contaNovasSolicitacoesVisaoGestor(){
        global $mat;
        $db = New Database('solicitacoes');
        $queryContaNovasSolicitacoes = "SELECT * FROM solicitacoes.solicitacoes WHERE status <> 1;";
        $retorno = array();
        try {
            $execQueryContaNovasSolicitacoes = $db->DbGetAll($queryContaNovasSolicitacoes);
            if(sizeof($execQueryContaNovasSolicitacoes) > 0){
                $retorno["mensagem"] = sizeof($execQueryContaNovasSolicitacoes);
                $retorno["status"] = '1';
            } else if(sizeof($execQueryContaNovasSolicitacoes) == 0){
                $retorno["mensagem"] = sizeof($execQueryContaNovasSolicitacoes);
                $retorno["status"] = '1';
            }
        } catch(Exception $e) {
            $informacoesErro = "erro: " . $e . "\n\\n\$queryContaNovasSolicitacoes:" . $queryContaNovasSolicitacoes;
            $arquivoLog = $this->geraLogExcecao("solicitacoes", "contaNovasSolicitacoes", $informacoesErro, $mat);
            $retorno["mensagem"] = "Não foi possível verificar se há novas solicitações. Log " . $arquivoLog;
            $retorno["status"] = '0';
        } finally {
            return $retorno;
        }
    }

    // Função que traz as informações de todas as solicitações gravadas
    public function consultaSolicitacoes(){
        global $mat;
        $db = New Database("solicitacoes");
        $queryConsultaSolicitacoes = "SELECT a.*, a.status as codStatus, b.status, ifnull(c.assuntoJornada, d.temaProduto) as tema from solicitacoes.solicitacoes a 
            LEFT JOIN solicitacoes.status b ON a.status = b.id
            LEFT JOIN solicitacoes.respostasJornadasInformacionais c ON a.idSolicitacao = c.idSolicitacao
            LEFT JOIN solicitacoes.respostasJornadasTransacionais d ON a.idSolicitacao = d.idSolicitacao
            ORDER BY a.idSolicitacao;";
        
        $retorno = array();
        try {
            $execQueryConsultaSolicitacoes = $db->DbGetAll($queryConsultaSolicitacoes); 

            if(sizeof($execQueryConsultaSolicitacoes) > 0){
                $dadosTabelaSolicitacoes = '';
                for($i = 0; $i < (sizeof($execQueryConsultaSolicitacoes)); $i++){
                    $dadosTabelaSolicitacoes = $dadosTabelaSolicitacoes.'
                    <tr>
                        <td>#'.$execQueryConsultaSolicitacoes[$i]['idSolicitacao'].'</td>
                        <td>'.$execQueryConsultaSolicitacoes[$i]['tema'].'</td>
                        <td>'.$execQueryConsultaSolicitacoes[$i]['prefixo'].'</td>
                        <td><div class="statusSolicitacao"><img src="https://cad.bb.com.br/lib/apps/solicitacoes/img/'.$execQueryConsultaSolicitacoes[$i]['codStatus'].'tagStatus.png"></div></td>
                        <td class="Clicar" >
                            <img src="https://cad.bb.com.br/lib/apps/solicitacoes/img/navegacaoBtn.png" attr-idSolicitacao="'.$execQueryConsultaSolicitacoes[$i]['id'].'" class="acessarSolicitacao">
                        </td>
                    </tr>';
                }
                $retorno['status'] = '1';
                $retorno['mensagem'] = $dadosTabelaSolicitacoes;
            }
        } catch(Exception $e) {
            $informacoesErro = "erro: " . $e . "\n\\n\$queryConsultaSolicitacoes:" . $queryConsultaSolicitacoes;
            $arquivoLog = $this->geraLogExcecao("solicitacoes", "contaNovasSolicitacoes", $informacoesErro, $mat);
            $retorno = "Não foi possível verificar se há novas solicitações. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return $retorno;
        }
    }

    public function filtrarSolicitacoes($camposSelecionados){
        global $mat;
        $retorno = array();
        $db = New Database("solicitacoes");

        $tamanhoArray = sizeof($camposSelecionados);
        $whereSolicitacoes = "WHERE ";
        $mensagemErro = '';

        for($i = 0; $i < $tamanhoArray; $i++){
            $indices = array_keys($camposSelecionados);
            $valores = array_values($camposSelecionados);
            $whereSolicitacoes = $whereSolicitacoes .$indices[$i] .' LIKE "%'.$valores[$i].'%" AND ';
            
            switch($indices[$i]){
                case "a.idSolicitacao":
                    $mensagemErro = $mensagemErro."-ID Solicitação: ".$valores[$i].'<br>';
                break; 
                
                case "a.tema":
                    $mensagemErro = $mensagemErro."-Tema/Produto: ".$valores[$i].'<br>';
                break;

                case "a.prefixo":
                    $mensagemErro = $mensagemErro."-Dependência: ".$valores[$i].'<br>';
                break;

                case "a.status":
                    $statusErro = $db->DbGetAll("select status from solicitacoes.status WHERE id = '".$valores[$i]."'; ");
                    // $mensagemErro = $mensagemErro."-Status: ".$valores[$i].'<br>';
                    $mensagemErro = $mensagemErro."-Status: ".$statusErro[0]['status'].'<br>';
                break;
            }
        }
        $whereSolicitacoes = rtrim($whereSolicitacoes, "' AND '");

        // $queryFiltraSolicitacoes = "SELECT a.*, b.status FROM solicitacoes.solicitacoes a LEFT JOIN solicitacoes.status b ON a.status = b.id ".$whereSolicitacoes." ORDER BY a.idSolicitacao;";
        
        $queryFiltraSolicitacoes = "SELECT a.*, a.status as codStatus, b.status, ifnull(c.assuntoJornada, d.temaProduto) as tema from solicitacoes.solicitacoes a 
            LEFT JOIN solicitacoes.status b ON a.status = b.id
            LEFT JOIN solicitacoes.respostasJornadasInformacionais c ON a.idSolicitacao = c.idSolicitacao
            LEFT JOIN solicitacoes.respostasJornadasTransacionais d ON a.idSolicitacao = d.idSolicitacao ".$whereSolicitacoes." ORDER BY a.idSolicitacao;";

        try {
            $execQueryFiltraSolicitacoes = $db->DbGetAll($queryFiltraSolicitacoes);
            if(sizeof($execQueryFiltraSolicitacoes) > 0){
                $dadosTabelaSolicitacoes = '';
                for($i = 0; $i < (sizeof($execQueryFiltraSolicitacoes)); $i++){
                    $dadosTabelaSolicitacoes = $dadosTabelaSolicitacoes.'
                    <tr>
                        <td>#'.$execQueryFiltraSolicitacoes[$i]['idSolicitacao'].'</td>
                        <td>'.$execQueryFiltraSolicitacoes[$i]['tema'].'</td>
                        <td>'.$execQueryFiltraSolicitacoes[$i]['prefixo'].'</td>
                        <td><div class="statusSolicitacao"><img src="https://cad.bb.com.br/lib/apps/solicitacoes/img/'.$execQueryFiltraSolicitacoes[$i]['codStatus'].'tagStatus.png"></div></td>
                        <td class="Clicar" >
                            <img src="https://cad.bb.com.br/lib/apps/solicitacoes/img/navegacaoBtn.png" attr-idSolicitacao="'.$execQueryFiltraSolicitacoes[$i]['id'].'" class="acessarSolicitacao">
                        </td>
                    </tr>';
                } 
                $retorno['status'] = '1';
                $retorno['mensagem'] = $dadosTabelaSolicitacoes;
            } else {
                $retorno['status'] = '0';
                $retorno['mensagem'] = "Não localizamos nenhuma solicitação com os termos digitados:<br><br>".$mensagemErro;
            }
        } catch(Exception $e) {
            $informacoesErro = "erro: " . $e . "\n\\n\$queryConsultaSolicitacoes:" . $queryFiltraSolicitacoes;
            $arquivoLog = $this->geraLogExcecao("solicitacoes", "contaNovasSolicitacoes", $informacoesErro, $mat);
            $retorno['status'] = '0';
            $retorno['mensagem'] = "Não foi possível verificar se há novas solicitações. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            
            return $retorno;
        }        
    }

    public function filtrarSolicitacoesVisaoGestor($camposSelecionados){
        global $mat;
        $retorno = array();
        $db = New Database("solicitacoes");

        $tamanhoArray = sizeof($camposSelecionados);
        $whereSolicitacoes = "WHERE prefixo = '".$_SESSION['dependencia']."' AND ";
        $mensagemErro = '';

        for($i = 0; $i < $tamanhoArray; $i++){
            $indices = array_keys($camposSelecionados);
            $valores = array_values($camposSelecionados);
            $whereSolicitacoes = $whereSolicitacoes .$indices[$i] .' LIKE "%'.$valores[$i].'%" AND ';
            
            switch($indices[$i]){
                case "a.idSolicitacao":
                    $mensagemErro = $mensagemErro."-ID Solicitação: ".$valores[$i].'<br>';
                break; 
                
                case "a.tema":
                    $mensagemErro = $mensagemErro."-Tema/Produto: ".$valores[$i].'<br>';
                break;

                case "a.prefixo":
                    $mensagemErro = $mensagemErro."-Dependência: ".$valores[$i].'<br>';
                break;

                case "a.status":
                    $statusErro = $db->DbGetAll("select status from solicitacoes.status WHERE id = '".$valores[$i]."'; ");
                    // $mensagemErro = $mensagemErro."-Status: ".$valores[$i].'<br>';
                    $mensagemErro = $mensagemErro."-Status: ".$statusErro[0]['status'].'<br>';
                break;
            }
        }
        $whereSolicitacoes = rtrim($whereSolicitacoes, "' AND '");

        // $queryFiltraSolicitacoes = "SELECT a.*, b.status FROM solicitacoes.solicitacoes a LEFT JOIN solicitacoes.status b ON a.status = b.id ".$whereSolicitacoes." ORDER BY a.idSolicitacao;";
        
        $queryFiltraSolicitacoes = "SELECT a.*, a.status as codStatus, b.status, ifnull(c.assuntoJornada, d.temaProduto) as tema, date_format(a.timestamp, '%d/%m/%Y') as dataFormatada FROM solicitacoes.solicitacoes a
            LEFT JOIN solicitacoes.status b ON a.status = b.id
            LEFT JOIN solicitacoes.respostasJornadasInformacionais c ON a.idSolicitacao = c.idSolicitacao
            LEFT JOIN solicitacoes.respostasJornadasTransacionais d ON a.idSolicitacao = d.idSolicitacao ".$whereSolicitacoes." ORDER BY a.idSolicitacao;";
        // echo $queryFiltraSolicitacoes;
        
        try {
            $execQueryFiltraSolicitacoes = $db->DbGetAll($queryFiltraSolicitacoes);
            if(sizeof($execQueryFiltraSolicitacoes) > 0){
                $dadosTabelaSolicitacoes = '';
                $iconeEditar='';
                    if($execQueryFiltraSolicitacoes[$i]['codStatus'] == '1'){
                        $iconeEditar = '
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M16.8177 10.5099L9.78741 17.5422L14.4586 22.212L21.4888 15.1797L16.8177 10.5099Z" fill="#AEAEAE"/>
                                <path d="M22.6494 14.0226L23.2402 13.4326C24.5276 12.1452 24.5276 10.0496 23.2402 8.76144C21.9528 7.47405 19.8564 7.47405 18.569 8.76144L17.9791 9.35221L22.6494 14.0226Z" fill="#AEAEAE"/>
                                <path d="M13.0462 23.1221L8.8156 24.1789C8.5358 24.2478 8.2396 24.1666 8.03611 23.9631C7.83262 23.7596 7.75057 23.4634 7.82031 23.1844L8.87795 18.9538L13.0462 23.1221Z" fill="#AEAEAE"/>
                                <path d="M28.4444 3.55556V28.4444H3.55556V3.55556H28.4444ZM28.4444 0H3.55556C1.6 0 0 1.6 0 3.55556V28.4444C0 30.4 1.6 32 3.55556 32H28.4444C30.4 32 32 30.4 32 28.4444V3.55556C32 1.6 30.4 0 28.4444 0Z" fill="#AEAEAE"/>
                            </svg>
                        ';
                    }
                for($i = 0; $i < (sizeof($execQueryFiltraSolicitacoes)); $i++){
                    $dadosTabelaSolicitacoes = $dadosTabelaSolicitacoes.'
                    <tr>
                        <td>#'.$execQueryFiltraSolicitacoes[$i]['idSolicitacao'].'</td>
                        <td>'.$execQueryFiltraSolicitacoes[$i]['tema'].'</td>
                        <td>'.$execQueryFiltraSolicitacoes[$i]['dataFormatada'].'</td>
                        <td><div class="statusSolicitacao"><img src="https://cad.bb.com.br/lib/apps/solicitacoes/img/'.$execQueryFiltraSolicitacoes[$i]['codStatus'].'tagStatus.png"></div></td>
                        <td id="iconeEditar" class="Clicar" attr-idSolicitacao="'.$execQueryFiltraSolicitacoes[$i]['idSolicitacao'].'">'.$iconeEditar.'</td>
                        <td id="iconeNavega" class="Clicar" attr-idSolicitacao="'.$execQueryFiltraSolicitacoes[$i]['idSolicitacao'].'">
                            <img src="https://cad.bb.com.br/lib/apps/solicitacoes/img/navegacaoBtn.png" attr-idSolicitacao="'.$execQueryFiltraSolicitacoes[$i]['idSolicitacao'].'" class="acessarSolicitacao">
                        </td>
                    </tr>';
                } 
                $retorno['status'] = '1';
                $retorno['mensagem'] = $dadosTabelaSolicitacoes;
            } else {
                $retorno['status'] = '0';
                $retorno['mensagem'] = "Não localizamos nenhuma solicitação com os termos digitados:<br><br>".$mensagemErro;
            }
        } catch(Exception $e) {
            $informacoesErro = "erro: " . $e . "\n\\n\$queryFiltraSolicitacoes: " . $queryFiltraSolicitacoes;
            $arquivoLog = $this->geraLogExcecao("solicitacoes", "filtrarSolicitacoesVisaoGestor", $informacoesErro, $mat);
            $retorno['status'] = '0';
            $retorno['mensagem'] = "Não foi possível verificar se há novas solicitações. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            
            return $retorno;
        }        
    }
    






    // Função que monta o formulário de acordo com a opção selecionada
    public function montaFormulario($opcaoSelecionada){
        $db = New Database("solicitacoes");
        $queryMontaFormulario = "SELECT *, b.id as idOpcao FROM solicitacoes.etapaFormularios a
            LEFT JOIN solicitacoes.opcoesFormularios b ON a.id = b.idFormulario
            WHERE a.id = '".$opcaoSelecionada."' ORDER BY b.ordem ASC;";
        
        $estiloDivsAbertas = 'style="display: none;"';
        
        if($opcaoSelecionada == 1){
            $estiloDivsAbertas = '';
        }

        $scriptTooltip = '';

        // if($opcaoSelecionada == '3' || $opcaoSelecionada == '4'){
        //     $scriptTooltip = '<img src="/lib/img/cabecalho/imgCabecalho.svg" style="display:none;" onload="tooltip();">';
        // }

        try {
            $execQueryMontaFormulario = $db->DbGetAll($queryMontaFormulario);
            if($execQueryMontaFormulario) {

                if($opcaoSelecionada < 100 && $opcaoSelecionada <> 99){
                    $status = '1';
                    $montaFormulario = '<form id="formFormularioId'.$opcaoSelecionada.'" class="formFormularioSolicitacoes" attr-formOrdemExibicao="'.$execQueryMontaFormulario[0]['ordemExibicao'].'" attr-chamadoPor="'.$execQueryMontaFormulario[0]['chamadoPor'].'" '.$estiloDivsAbertas.'><p>'.$execQueryMontaFormulario[0]['etapaFormulario'].'</p>';
                    
                    for($i = 0; $i < sizeof($execQueryMontaFormulario); $i++){
                        $montaFormulario = $montaFormulario.'
                            <div class="radio-container">
                                <label for="radio'.$execQueryMontaFormulario[$i]['idOpcao'].'">
                                    <div style="width: 100%; display: flex; align-items: center;">
                                        <input type="radio" id="radio'.$execQueryMontaFormulario[$i]['idOpcao'].'" name="radio"></input>
                                        <div class="custom-radio">
                                            <span class="radioSpan Clicar" id="radioSpan'.$execQueryMontaFormulario[$i]['idOpcao'].'" attr-ordemExibicao="'.$execQueryMontaFormulario[$i]['ordemExibicao'].'" attr-formularioAtual="'.$execQueryMontaFormulario[$i]['idFormulario'].'" attr-proximoFormulario="'.$execQueryMontaFormulario[$i]['proximaEtapaFormulario'].'"></span>
                                        </div>
                                        <span style="width: 75%; margin-left: 2%; font-color=#646464;">
                                            '.$execQueryMontaFormulario[$i]['textoOpcao'].'
                                        </span>
                                        <div style="display: inline-flex;">
                                            '.$execQueryMontaFormulario[$i]['textoDuvida'].'
                                            '.$execQueryMontaFormulario[$i]['campoDuvida'].'
                                        </div>
                                    </div>
                                </label>
                            </div>
                        ';
                    }
                } else if($opcaoSelecionada == 99){
                    $status = '1';
                    $montaFormulario = '<form id="formFormularioId'.$opcaoSelecionada.'" class="formFormularioSolicitacoes" attr-chamadoPor="'.$execQueryMontaFormulario[0]['chamadoPor'].'" '.$estiloDivsAbertas.'>'.$execQueryMontaFormulario[0]['etapaFormulario'];
                } else {
                    $status = '2';
                    $montaFormulario = '<form id="formFormularioId'.$opcaoSelecionada.'" class="formFormularioSolicitacoes" attr-chamadoPor="'.$execQueryMontaFormulario[0]['chamadoPor'].'" '.$estiloDivsAbertas.'>'.$execQueryMontaFormulario[0]['etapaFormulario'];
                }
            } 
            $retorno['status'] = $status;
            $retorno['mensagem'] = $montaFormulario.'</form>'.$scriptTooltip;
        } catch(Exception $e) {
            $status = '0';
            $informacoesErro = "erro: " . $e . "\n\\n\$queryMontaFormulario:" . $queryMontaFormulario;
            $arquivoLog = $this->geraLogExcecao("solicitacoes", "montaFormulario", $informacoesErro, $mat);
            $retorno['status'] = $status;
            $retorno['mensagem'] = "Não foi possível montar os formulários para preenchimento. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return $retorno;
        }
    }

    public function montaTabelaAcompanhamentoVisaoGestor($dependencia){
        $retorno = array();
        $db = New Database('solicitacoes');
        $queryMontaTabela = "
            SELECT a.*, a.status as codStatus, b.status, ifnull(c.assuntoJornada, d.temaProduto) as tema, date_format(a.timestamp, '%d/%m/%Y') as dataFormatada FROM solicitacoes.solicitacoes a
                LEFT JOIN solicitacoes.status b ON a.status = b.id
                LEFT JOIN solicitacoes.respostasJornadasInformacionais c ON a.idSolicitacao = c.idSolicitacao
                LEFT JOIN solicitacoes.respostasJornadasTransacionais d ON a.idSolicitacao = d.idSolicitacao
                WHERE prefixo = '".$dependencia."';";

        $retorno = array();
        try {
            $execQueryConsultaSolicitacoes = $db->DbGetAll($queryMontaTabela); 

            if(sizeof($execQueryConsultaSolicitacoes) > 0){
                $dadosTabelaAcompanhamento = '';
                for($i = 0; $i < (sizeof($execQueryConsultaSolicitacoes)); $i++){
                    $iconeEditar='';
                    if($execQueryConsultaSolicitacoes[$i]['codStatus'] == '1'){
                        $iconeEditar = '
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M16.8177 10.5099L9.78741 17.5422L14.4586 22.212L21.4888 15.1797L16.8177 10.5099Z" fill="#AEAEAE"/>
                                <path d="M22.6494 14.0226L23.2402 13.4326C24.5276 12.1452 24.5276 10.0496 23.2402 8.76144C21.9528 7.47405 19.8564 7.47405 18.569 8.76144L17.9791 9.35221L22.6494 14.0226Z" fill="#AEAEAE"/>
                                <path d="M13.0462 23.1221L8.8156 24.1789C8.5358 24.2478 8.2396 24.1666 8.03611 23.9631C7.83262 23.7596 7.75057 23.4634 7.82031 23.1844L8.87795 18.9538L13.0462 23.1221Z" fill="#AEAEAE"/>
                                <path d="M28.4444 3.55556V28.4444H3.55556V3.55556H28.4444ZM28.4444 0H3.55556C1.6 0 0 1.6 0 3.55556V28.4444C0 30.4 1.6 32 3.55556 32H28.4444C30.4 32 32 30.4 32 28.4444V3.55556C32 1.6 30.4 0 28.4444 0Z" fill="#AEAEAE"/>
                            </svg>
                        ';
                    }
                    $dadosTabelaAcompanhamento = $dadosTabelaAcompanhamento.'
                    <tr>
                        <td>#'.$execQueryConsultaSolicitacoes[$i]['idSolicitacao'].'</td>
                        <td>'.$execQueryConsultaSolicitacoes[$i]['tema'].'</td>
                        <td>'.$execQueryConsultaSolicitacoes[$i]['dataFormatada'].'</td>
                        <td><div class="statusSolicitacao"><img src="https://cad.bb.com.br/lib/apps/solicitacoes/img/'.$execQueryConsultaSolicitacoes[$i]['codStatus'].'tagStatus.png"></div></td>
                        <td id="iconeEditar" class="Clicar" attr-idSolicitacao="'.$execQueryConsultaSolicitacoes[$i]['idSolicitacao'].'">'.$iconeEditar.'</td>
                        <td id="iconeNavega" class="Clicar" attr-idSolicitacao="'.$execQueryConsultaSolicitacoes[$i]['idSolicitacao'].'">
                            <img src="https://cad.bb.com.br/lib/apps/solicitacoes/img/navegacaoBtn.png" attr-idSolicitacao="'.$execQueryConsultaSolicitacoes[$i]['idSolicitacao'].'" class="acessarSolicitacao">
                        </td>
                    </tr>';
                }
                $retorno['status'] = '1';
                $retorno['mensagem'] = $dadosTabelaAcompanhamento;
            }
        } catch(Exception $e) {
            $informacoesErro = "erro: " . $e . "\n\\n\$queryMontaTabela:" . $queryMontaTabela;
            $arquivoLog = $this->geraLogExcecao("solicitacoes", "contaNovasSolicitacoes", $informacoesErro, $mat);
            $retorno = "Não foi possível verificar se há novas solicitações. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally {
            return $retorno;
        }
    }

    public function gravaJornadaTranascional($tipoSolicitacao, $temaProduto, $canalTransacao, $assuntoTransacao, $objetivoTransacao, $canaisExistentes, $publicoAlvo, $metricaSucesso, $acompanhamentoMetrica, $resultadoProjetado, $estimuloConsumoTransacao, $raOuRegulatorio, $especificoWhatsapp){
        $db = New Database("solicitacoes");
        $retorno = array();
        
        $queryIncluiRegistroSolicitacao = "
            INSERT INTO `solicitacoes`.`solicitacoes` (
                `tipoSolicitacao`, 
                `matricula`, 
                `nome`, 
                `email`, 
                `dependencia`, 
                `prefixo`
            ) VALUES (
                '".$tipoSolicitacao."', 
                '".$_SESSION['matricula']."', 
                '".$_SESSION['nome']."', 
                '".$_SESSION['email']."', 
                NULL, 
                '".$_SESSION['dependencia']."'
            );
        ";

        try {
            $execQueryRegistraSolicitacao = $db->DbQuery($queryIncluiRegistroSolicitacao);
        
            if($execQueryRegistraSolicitacao){

                $queryConsultaUltimoId = "SELECT idSolicitacao FROM solicitacoes.solicitacoes ORDER BY idSolicitacao DESC LIMIT 1;";
                
                try {
                    if($especificoWhatsapp == 'undefined'){
                        $especificoWhatsapp = 'nao';
                    }
                    $execConsultaUltimoId = $db->DbGetAll($queryConsultaUltimoId);

                    if($execConsultaUltimoId){
                        $queryIncluiRespostas = "
                            INSERT INTO `solicitacoes`.`respostasJornadasTransacionais` (
                                `idSolicitacao`,
                                `temaProduto`, 
                                `canalTransacao`, 
                                `raOuRegulatorio`, 
                                `especificoWhatsapp`, 
                                `assuntoTransacao`, 
                                `objetivoTransacao`, 
                                `canaisTransacaoExiste`, 
                                `publicoAlvo`, 
                                `metricaSucesso`, 
                                `resultadoProjetado`, 
                                `acompanhamentoMetrica`, 
                                `estimuloConsumoTransacao`
                            ) VALUES (
                                '".$execConsultaUltimoId[0]['idSolicitacao']."',
                                '".$temaProduto."', 
                                '".$canalTransacao."',
                                '".$raOuRegulatorio."',
                                '".$especificoWhatsapp."',
                                '".$assuntoTransacao."',
                                '".$objetivoTransacao."',
                                '".$canaisExistentes."',
                                '".$publicoAlvo."',
                                '".$metricaSucesso."',
                                '".$resultadoProjetado."',
                                '".$acompanhamentoMetrica."',
                                '".$estimuloConsumoTransacao."'
                            );"
                        ;
                        try {
                            $execQueryIncluiRespostas = $db->DbQuery($queryIncluiRespostas);
            
                            if($execQueryIncluiRespostas){
                                $retorno['status'] = "1";
                                $retorno['mensagem'] = "Solicitação #".$execConsultaUltimoId[0]['idSolicitacao']." incluída com sucesso!";
                            }
                        } catch (Exception $e){
                            $status = '0';
                            $informacoesErro = "Erro: " . $e . "\n\\n\$queryConsultaUltimoId:" . $queryConsultaUltimoId;
                            $arquivoLog = $this->geraLogExcecao("solicitacoes", "gravaJornadaTranascional", $informacoesErro, $mat);
                            $retorno['status'] = $status;
                            $retorno['mensagem'] = "Não foi possível gravar sua solicitação. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
                        }
                    }
                    
                } catch (Exception $e){
                    $status = '0';
                    $informacoesErro = "Erro: " . $e . "\n\\n\$queryIncluiRespostas:" . $queryIncluiRespostas;
                    $arquivoLog = $this->geraLogExcecao("solicitacoes", "gravaJornadaTranascional", $informacoesErro, $mat);
                    $retorno['status'] = $status;
                    $retorno['mensagem'] = "Não foi possível gravar sua solicitação. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
                }
                
            }
        } catch (Exception $e){
            $status = '0';
            $informacoesErro = "Erro: " . $e . "\n\\n\$queryIncluiRegistroSolicitacao:" . $queryIncluiRegistroSolicitacao;
            $arquivoLog = $this->geraLogExcecao("solicitacoes", "gravaJornadaTranascional", $informacoesErro, $mat);
            $retorno['status'] = $status;
            $retorno['mensagem'] = "Não foi possível gravar sua solicitação. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally{
            return $retorno;
        }
    }

    public function gravaJornadaInformacional($canalTransacao, $atendeRa, $especificoWhatsapp, $assuntoJornada, $objetivoTransacao, $metricaSucesso, $resultadoProjetado, $acompanhamentoMetrica, $estimuloConsumoTransacao, $tipoSolicitacao){
        $db = New Database("solicitacoes");
        $retorno = array();
        
        $queryIncluiRegistroSolicitacao = "
            INSERT INTO `solicitacoes`.`solicitacoes` (
                `tipoSolicitacao`, 
                `matricula`, 
                `nome`, 
                `email`, 
                `dependencia`, 
                `prefixo`
            ) VALUES (
                '".$tipoSolicitacao."', 
                '".$_SESSION['matricula']."', 
                '".$_SESSION['nome']."', 
                '".$_SESSION['email']."', 
                NULL, 
                '".$_SESSION['dependencia']."'
            );
        ";

        try {
            $execQueryRegistraSolicitacao = $db->DbQuery($queryIncluiRegistroSolicitacao);
        
            if($execQueryRegistraSolicitacao){

                $queryConsultaUltimoId = "SELECT idSolicitacao FROM solicitacoes.solicitacoes ORDER BY idSolicitacao DESC LIMIT 1;";
                
                try {
                    if($especificoWhatsapp == 'undefined'){
                        $especificoWhatsapp = 'nao';
                    }
                    
                    $execConsultaUltimoId = $db->DbGetAll($queryConsultaUltimoId);

                    if($execConsultaUltimoId){
                        $queryIncluiRespostas = "
                            INSERT INTO `solicitacoes`.`respostasJornadasInformacionais` (
                                `idSolicitacao`, 
                                `assuntoJornada`, 
                                `atendeRa`, 
                                `especificoWhatsapp`, 
                                `objetivoJornada`, 
                                `metricaSucesso`, 
                                `resultadoProjetado`, 
                                `acompanhamentoMetrica`, 
                                `estimuloConsumoTransacao`
                            ) VALUES (
                                '".$execConsultaUltimoId[0]['idSolicitacao']."', 
                                '".$assuntoJornada."', 
                                '".$atendeRa."', 
                                '".$especificoWhatsapp."', 
                                '".$objetivoTransacao."', 
                                '".$metricaSucesso."', 
                                '".$resultadoProjetado."', 
                                '".$acompanhamentoMetrica."', 
                                '".$estimuloConsumoTransacao."'
                            );
                        ";
                        try {
                            $execQueryIncluiRespostas = $db->DbQuery($queryIncluiRespostas);
            
                            if($execQueryIncluiRespostas){
                                $retorno['status'] = "1";
                                $retorno['mensagem'] = "Solicitação #".$execConsultaUltimoId[0]['idSolicitacao']." incluída com sucesso!";
                            }
                        } catch (Exception $e){
                            $status = '0';
                            $informacoesErro = "Erro: " . $e . "\n\\n\$queryIncluiRespostas:" . $queryIncluiRespostas;
                            $arquivoLog = $this->geraLogExcecao("solicitacoes", "gravaJornadaInformacional", $informacoesErro, $mat);
                            $retorno['status'] = $status;
                            $retorno['mensagem'] = "Não foi possível gravar sua solicitação. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
                        }
                    }
                } catch (Exception $e){
                    $status = '0';
                    $informacoesErro = "Erro: " . $e . "\n\\n\$queryConsultaUltimoId:" . $queryConsultaUltimoId;
                    $arquivoLog = $this->geraLogExcecao("solicitacoes", "gravaJornadaInformacional", $informacoesErro, $mat);
                    $retorno['status'] = $status;
                    $retorno['mensagem'] = "Não foi possível gravar sua solicitação. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
                }
            }
        } catch (Exception $e){
            $status = '0';
            $informacoesErro = "Erro: " . $e . "\n\\n\$queryIncluiRegistroSolicitacao:" . $queryIncluiRegistroSolicitacao;
            $arquivoLog = $this->geraLogExcecao("solicitacoes", "gravaJornadaInformacional", $informacoesErro, $mat);
            $retorno['status'] = $status;
            $retorno['mensagem'] = "Não foi possível gravar sua solicitação. Informe à equipe responsável o caminho a seguir: " . $arquivoLog;
        } finally{
            return $retorno;
        }
    }

    // Função que grava eventuais logs de erro de banco de dados em formato texto
    public function geraLogExcecao($nomeApp, $nomeFuncao, $informacoesAdicionais, $mat){
        $dateTime = date("Y-m-d")."_". date("H.i.s");
        $nomeArquivo = $dateTime . "_" . $mat . "_" . $nomeApp . "_" . $nomeFuncao .".txt";
        $caminhoArquivo = $this->caminhoLogErro . "/" . $nomeArquivo;

        $strDataHora = print_r(new DateTime(), true);
        $strRequest = print_r($_REQUEST, true);
        $strSession = print_r($_SESSION, true);
        
        $strArquivo = "data:\n" . $strDataHora . "\n\$_REQUEST:\n" . $strRequest . "\n\$_SESSION:\n" . $strSession . "\n\$informacoesAdicionais:\n" . $informacoesAdicionais;

        file_put_contents($caminhoArquivo, $strArquivo);
        chmod($caminhoArquivo, 0777);

        return $caminhoArquivo;
    }
}