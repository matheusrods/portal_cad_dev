<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

Class funcoes {

    public $mat;

    // Função padrão do PHP para declaração de variáveis que serão utilizadas em outras funções
    public function __construct(){
        $mat = $_SESSION['matricula'];
        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
    }

    public function consultaCursos(){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        
        $mat = $_SESSION['matricula'];

        $db = New Database('capacitacao_analytics');
        $query = "SELECT id, titulo, url, ordem FROM capacitacao_analytics.cursos_alura;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("capacitacao_analytics","consultaCursos", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    public function consultaPowerBi(){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        
        $mat = $_SESSION['matricula'];

        $db = New Database('capacitacao_analytics');
        $query = "SELECT id, titulo, url, ordem, criado_em FROM capacitacao_analytics.cursos_powerbi;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("capacitacao_analytics","consultaPowerBi", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    public function consultaCursosSpotfire(){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        
        $mat = $_SESSION['matricula'];

        $db = New Database('capacitacao_analytics');
        $query = "SELECT id, titulo, url, ordem, criado_em FROM capacitacao_analytics.cursos_spotfire;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("capacitacao_analytics", "consultaPowerBi", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    public function consultaRecursos(string $panelSlug){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        $mat = $_SESSION['matricula'];

        $db = New Database('capacitacao_analytics');
        $query = "SELECT r.name, r.id, r.url
                FROM recursos r
                JOIN painel_recursos pr ON pr.recurso_id = r.id
                JOIN painel p          ON p.id = pr.painel_id
                WHERE p.slug = '".$panelSlug."'
                ORDER BY pr.recurso_id;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("capacitacao_analytics", "consultaRecursos", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    public function ConsultaCursosPython(){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        
        $mat = $_SESSION['matricula'];

        $db = New Database('capacitacao_analytics');
        $query = "SELECT id, titulo, url, ordem FROM capacitacao_analytics.cursos_python;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("capacitacao_analytics", "ConsultaCursosPython", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    public function ConsultaCursosSpark(){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        
        $mat = $_SESSION['matricula'];

        $db = New Database('capacitacao_analytics');
        $query = "SELECT id, titulo, url, ordem FROM capacitacao_analytics.cursos_spark;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("capacitacao_analytics", "ConsultaCursosSpark", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    public function consultaResponsabilidades(){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        
        $mat = $_SESSION['matricula'];

        $db = New Database('capacitacao_analytics');
        $query = "SELECT id, ordem, titulo, descricao FROM capacitacao_analytics.responsabilidades_eng_dados;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("capacitacao_analytics", "consultaResponsabilidades", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    public function consultaWorkshops(){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        
        $mat = $_SESSION['matricula'];

        $db = New Database('capacitacao_analytics');
        $query = "SELECT id, ordem, titulo, descricao, created_at, updated_at, url FROM capacitacao_analytics.workshops;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("capacitacao_analytics", "consultaWorkshops", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

     public function consultaCards(string $panelSlug){

        $retorno = [
            'mensagem' => '', 
            'status'   => 0,
        ];
        $mat = $_SESSION['matricula'];

        $db = New Database('capacitacao_analytics');
        $query = "SELECT c.name, c.id, c.url, c.url_img, c.url_iframe
                FROM cards c
                JOIN painel p          ON p.id = c.painel_id
                WHERE p.slug = '".$panelSlug."' AND c.ativo = 1
                ORDER BY c.id;";
        
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query: " . $query;
            $arquivoLog = $this->geraLogExcecao("capacitacao_analytics", "consultaCards", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 20px; font-weight: bold;'>Não foi possível consultar os Setores para exibição da página Quem Somos.<br>Informe à equipe responsável o caminho a seguir:<br>" . $arquivoLog."</p>";
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