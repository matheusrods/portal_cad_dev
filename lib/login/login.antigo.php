<?php
session_start();

session_destroy();

//se tiver parametro GET armazena os dados em um cookie para evitar que o redirecionamento limpe o valor das variaveis
if(!empty($_GET)){
    setcookie("params", serialize($_GET), time() + 600);
    $_SERVER["QUERY_STRING"] = "";
}

require_once  $_SERVER["DOCUMENT_ROOT"]."/lib/login/openam.class.php";
$openam = new Openam();
$openam->setUrlOpenam( 'https://sso.intranet.bb.com.br/sso/' );
$openam->setUrlDistAuth('https://login.intranet.bb.com.br/distAuth/UI');
// $openam->setUrlDistAuth('https://login.intranet.bb.com.br/sso/XUI/#login');
$openam->setUrlIdentity('https://sso.intranet.bb.com.br/sso/identity');
// $openam->setUrlIdentity('https://sso.intranet.bb.com.br/sso/identity/attributes');
$openam->setCookieName('BBSSOToken');
$openam->setGroupsName('ibm-allgroups');

$ldapEntries = $openam->getLdapEntries();

if (!isset($_SESSION['matricula'])) {
    session_regenerate_id();
    session_start();

    //chama a classe de login "/login"
    //verifica se há chave do funci em algum lugar do cookie e guarda.
    try {
        if (isset($ldapEntries[0]['chaveFuncionario'][0])) {
            $_SESSION['matricula'] = $ldapEntries[0]['chaveFuncionario'][0];
        } else if (isset($ldapEntries[0]['uid'][0])) {
            $_SESSION['matricula'] = $ldapEntries[0]['uid'][0];
        } else if (isset($ldapEntries[0]['ibm-nativeid'][0])) {
            $_SESSION['matricula'] = $ldapEntries[0]['ibm-nativeid'][0];
        } else if (isset($ldapEntries[0]['cd-idgl-usu'][0])) {
            $_SESSION['matricula'] = $ldapEntries[0]['cd-idgl-usu'][0];
        } else if (isset($_SESSION['MTC_FUN'])) {
            //alteração feita para evitar o loop da falta de matrícula na notificação
            $_SESSION['matricula'] = $_SESSION['MTC_FUN'];
        }
    } catch (Exception $e) {
        $_SESSION['matricula'] = '';
    }
    //fim da verificação
    
    //transposição das variaveis do cookie para a session
    $_SESSION['ACSS'] = $ldapEntries[0]['criticidade'][0];
    $_SESSION['NM_FUN'] = $ldapEntries[0]['nomeGuerra'][0];
    $_SESSION['FUC_FUN'] = $ldapEntries[0]['codigoComissao'][0];
    $_SESSION['DEPE'] = $ldapEntries[0]['cd-pref-depe'][0];
    $_SESSION['RSPB_FUNL'] = $ldapEntries[0]['responsabilidadeFuncional'][0];
    $_SESSION['TEL_NUM'] = $ldapEntries[0]['telephonenumber'][0];
    $_SESSION['CELR'] = $ldapEntries[0]['mobile'][0];
    $_SESSION['MAIL'] = $ldapEntries[0]['mail'][0];

    //$_SESSION['matricula'] = $_SESSION['MTC_FUN'];
    $_SESSION['nome'] = $ldapEntries[0]['nomeFuncionario'][0];
    $_SESSION['dependencia'] = ($ldapEntries[0]['cd-pref-depe'][0]);
    $_SESSION['cargo'] = !empty($ldapEntries[0]['codigoComissao'][0]) ? $ldapEntries[0]['codigoComissao'][0] : $ldapEntries[0]["cd-cmss-usu"][0];
    $_SESSION['funcao'] = !empty($ldapEntries[0]['codigoComissao'][0]) ? $ldapEntries[0]['codigoComissao'][0] : $ldapEntries[0]["cd-cmss-usu"][0];
    $_SESSION['ip'] = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
    $_SESSION['matAssumida'] = "";
    // add pra funcionar tanto em Capiva quanto logado
    $_SESSION['prefixo'] = ($ldapEntries[0]['cd-pref-depe'][0]);
    $_SESSION['dependenciaLog'] = ($ldapEntries[0]['cd-pref-depe'][0]);

    //fim da transposição das variaveis do cookie para a session
    //variaveis do log de acesso
    $mat = $_SESSION['matricula'];
    $nom = $_SESSION['nome'];
    if ($nom == '' || $nom == null) {
        $nom = 'nao identificado';
    }
    $dep = $_SESSION['dependencia'];
    if ($dep == '' || $dep == null) {
        $dep = 0;
    }
    $com = $_SESSION['funcao'];
    if ($com == '' || $com == null) {
        $com = 0;
    }
    $ip = $_SESSION['ip'];
    $GLOBALS['ip'] =  $ip;

    //    $htt = $_SESSION['SERVER_NAME'];
    if (isset($_SESSION['REQUEST_URI'])) {
        $uri = $_SESSION['REQUEST_URI'];
    } else {
        $uri = "";
    };
    $tok = $_COOKIE['BBSSOToken'];
    $nav = $_SERVER['HTTP_USER_AGENT'];
    
    if (isset($_COOKIE['resolucao'])) {
        $mon = $_COOKIE['resolucao'];
    } else {
        $mon = "";
    };

    //Fim variaveis log de acesso
    //Log de acesso
    
}

//apos a validacao da intranet resgata o valor das variaveis GET do Cookie  
if(!empty($_COOKIE["params"]) && empty($_GET)){
    $paramsSig = unserialize($_COOKIE["params"]);
    foreach ($paramsSig as $indice => $valor) {
        $_GET[$indice] = $valor;
    }
    setcookie("params", "", time());
}

?>