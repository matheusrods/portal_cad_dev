<?php

$ignoreSession= true;
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

define('DB_HOSTNAME', getenv('DB_HOST')       ?: 'db');
define('DB_DATABASE', getenv('DB_DATABASE')   ?: 'cad');
define('DB_USERNAME', getenv('DB_USERNAME')   ?: 'cad_user');
define('DB_PASSWORD', getenv('DB_PASSWORD')   ?: '12345');
define('DB_PORT',     getenv('DB_PORT')       ?: 3306);
define('CHARSET',     getenv('CHARSET')       ?: 'utf8mb4');
define('SITE_ROOT',   getenv('SITE_ROOT')     ?: '/var/www/html');

class Conexao{
   public $server   = DB_HOSTNAME;
    public $user     = DB_USERNAME;
    public $pass     = DB_PASSWORD;
    public $database = DB_DATABASE;
    public $port     = DB_PORT;
}
require_once $_SERVER["DOCUMENT_ROOT"].'/lib/class/database/class.database.php';
?>
