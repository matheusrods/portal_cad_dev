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


function envv($k, $fallback = null) {
    return $_SERVER[$k] ?? getenv($k) ?? $fallback;
}

// define('DB_HOSTNAME', envv('DB_HOST', envv('DB_HOSTNAME', 'db')));
// define('DB_DATABASE', envv('DB_DATABASE', 'cad'));
// define('DB_USERNAME', envv('DB_USERNAME', 'root'));
// define('DB_PASSWORD', envv('DB_PASSWORD', 'rootpassword'));
// define('SITE_ROOT',  envv('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] ?? '/var/www/html'));
// define('CHARSET',    envv('CHARSET', 'utf8mb4'));

define('DB_HOSTNAME', envv('DB_HOST', envv('DB_HOSTNAME', 'db')));
define('DB_DATABASE', envv('DB_DATABASE', 'cad'));
define('DB_USERNAME', envv('DB_USERNAME', 'root'));
define('DB_PASSWORD', envv('DB_PASSWORD', 'rootpassword'));
define('SITE_ROOT',  envv('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] ?? '/var/www/html'));
define('CHARSET',    envv('CHARSET', 'utf8mb4'));
class Conexao{
    public $server=DB_HOSTNAME;
    public $user =DB_USERNAME;
    public $pass=DB_PASSWORD;
    public $database=DB_DATABASE;
    public $query="";
}
require_once $_SERVER["DOCUMENT_ROOT"].'/lib/class/database/class.database.php';
?>
