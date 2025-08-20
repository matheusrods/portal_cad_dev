<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
// require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";

class gravaLogAcesso {

    public $mat;

    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        $mat = $_SESSION['matricula'];
    }

    // Grava log de acesso às páginas do Portal
    public function gravaLogAcesso($mat, $nomeFunci, $cargo, $email, $dependencia, $pagina, $ip){
        if(strtoupper($mat) <> 'F0285739'){
            $db = New Database('intranet');
            $query = "INSERT INTO `intranet`.`log_acesso` (`matricula`, `nomeFunci`, `cargo`, `email`, `dependencia`, `paginaAcessada`, `ip`) 
                        VALUES ('".$mat."', '".$nomeFunci."', '".$cargo."', '".$email."', '".$dependencia."', '".$pagina."', '".$ip."');";

            $execQuery = $db->DbQuery($query);

            return $execQuery;
        }
    }

    // Grava log de acesso às páginas do Portal
    public function gravaDadosEmail($tituloEmail, $conteudoEmail, $remetente, $destinatarios){
        $db = New Database('intranet');
        $query = "INSERT INTO `intranet`.`logEmailEnviado` (`tituloEmail`, `conteudoEmail`, `remetente`, `destinatarios`) 
                    VALUES ('".$tituloEmail."', '".$conteudoEmail."', '".$remetente."', '".$destinatarios."');";
        $execQuery = $db->DbQuery($query);
        return $execQuery;
    }
}