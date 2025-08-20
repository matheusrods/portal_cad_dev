<?php
if(!$ignoreSession){
	if(!session_id()){
	    session_start();
	    if(isset($_SESSION['matricula'])){
	        $_SESSION['time']=time();
	    }
	}
}

// $server = 'localhost';
// $server = '10.2.97.185';
//$server = $_SERVER['DB_HOSTNAME'];
// $senha = 'cad@1901';
//$senha = $_SERVER['DB_PASSWORD'];

define('DB_HOSTNAME',$_SERVER['DB_HOSTNAME']);
define('DB_DATABASE',$_SERVER['DB_DATABASE']);
define('DB_USERNAME',$_SERVER['DB_USERNAME']);
define('DB_PASSWORD',$_SERVER['DB_PASSWORD']);
define('SITE_ROOT',$_SERVER['SITE_ROOT']);
define('CHARSET',$_SERVER['CHARSET']);

class Conexao{
    public $server=DB_HOSTNAME;
    public $user =DB_USERNAME;
    public $pass=DB_PASSWORD;
    public $database=DB_DATABASE;
    public $query="";
}
require_once $_SERVER["DOCUMENT_ROOT"].'/lib/class/database/class.database.php';
?>
