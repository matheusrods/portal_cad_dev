<?php

// Mostrar erros do PHP
// ini_set('display_startup_errors', 1);

// Força o início da sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Importação de arquivos de funções de banco de dados e de gravação de log
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

Class funcoes {

    public $mat;
    public $caminhoLogErro;

    // Função padrão do PHP para declaração de variáveis que serão utilizadas em outras funções
    public function __construct(){
        // if(!isset($_SESSION)){
        //     session_start();
        // }
        $mat = $_SESSION['matricula'];
        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
    }
    
    // Função que consulta as Squads
    public function consultaSquadsDesign(){
        $mat = $_SESSION['matricula'];

        $db = New Database('cad');
        $query = "SELECT * FROM cad.squads WHERE idSetor = 4 ORDER BY squad ASC;";

        $retorno = array();
        
        try{
            
            $execQuery   = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno['mensagem'] = $execQuery;
                $retorno['status'] = 1;    
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("onboarding", "consultaSquadsDesign", $informacoesErro, $mat);
            $retorno['mensagem'] = "<p style='font-size: 16px !important; font-weight: bold;'>Não foi possível consultar as Squads. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            $retorno['status'] = 0;
        } finally {
            return ($retorno);
        }
    }

    // Função que monta os elementos dos Canais atendidos pela CAD
    public function consultaCanais(){
        $mat = $_SESSION['matricula'];

        $db = New Database('cad');
        $query = "SELECT * FROM onboarding.canais WHERE ativo = 1 ORDER BY id ASC;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("onboarding", "consultaCanais", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 15px; font-weight: bold;'>Não foi possível consultar os Canais. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    // Função que monta os elementos das ferramentas utilizadas pela CAD
    public function consultaFerramentas(){
        $mat = $_SESSION['matricula'];

        $db = New Database('cad');
        $query = "SELECT * FROM onboarding.ferramentas WHERE ativo = 1 ORDER BY id ASC;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("onboarding", "consultaFerramentas", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 15px; font-weight: bold;'>Não foi possível consultar as Ferramentas. Informe à equipe responsável o caminho a seguir: " . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }


    // Função que monta os elementos do Dicionário
    public function consultaDicionario(){
        $mat = $_SESSION['matricula'];

        $db = New Database('cad');
        $query = "SELECT * FROM onboarding.dicionario WHERE ativo = 1 ORDER BY ordem;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("onboarding", "consultaDicionario", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 15px; font-weight: bold;'>Não foi possível consultar o Dicionário. Informe à equipe responsável o caminho a seguir: " . $arquivoLog.'</p>';
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
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
?>