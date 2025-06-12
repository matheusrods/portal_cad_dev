<?php
session_start();

//se tiver parametro GET armazena os dados em um cookie para evitar que o redirecionamento limpe o valor das variaveis
if(!empty($_GET)){
    setcookie("params", serialize($_GET), time() + 600);
    $_SERVER["QUERY_STRING"] = "";
}

$retorno = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if (!isset($_SESSION["nome"]) || !isset($_SESSION["matricula"])){
    if (!$_COOKIE["BBSSOToken"]){
        header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=$retorno");
    die();
    }

    $cookie = $_COOKIE["BBSSOToken"];
    $json = json_decode(file_get_contents("https://sso.intranet.bb.com.br/sso/identity/json/attributes?subjectid=$cookie"));
    
    if(isset($json->exception)){
        header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=$retorno");
    die();
    }
    $dados=$json->attributes;
    for ($i = 0; $i < count($dados); $i++) {
        switch ($dados[$i]->name){
            case 'sn':
            case 'nm-idgl':
                $_SESSION['nome'] = $dados[$i]->values[0];
            break;
            case 'uid':
            case 'nativeid':
                $_SESSION['matricula'] = $dados[$i]->values[0];
            break;
            case 'cd-pref-depe':
            case 'prefixoDependencia':
                $_SESSION['dependencia'] = $dados[$i]->values[0];
            break;
            case 'cd-cmss-usu':
            case 'cd-cmss-fun':
                $_SESSION['cargo'] = $dados[$i]->values[0];
            break;
            case 'cd-eqp':
                $_SESSION['cod_uor'] = $dados[$i]->values[0];
            break;
            case 'cd-uor-dep':
                $_SESSION['uor_dep'] = $dados[$i]->values[0];
            break;
            case "displayname":
                $_SESSION['nome_guerra'] = $dados[$i]->values[0];
            break;
            case "mail":
                $_SESSION['email'] = $dados[$i]->values[0];
            break;
            case "criticidade":
                $_SESSION['ACSS'] = $dados[$i]->values[0];
            break;
            case "responsabilidadeFuncional":
                $_SESSION['RSPB_FUNL'] = $dados[$i]->values[0];
            break;
            case "telephonenumber":
                $_SESSION['TEL_NUM'] = $dados[$i]->values[0];
            break;
            case "mobile":
                $_SESSION['CELR'] = $dados[$i]->values[0];
            break;
            case "codigoComissao":
                if($dados[$i]->values[0]!=$_SESSION['cargo']){
                    $_SESSION['cargo_sbt'] = $dados[$i]->values[0];
                }
            break;
        }
    }

    $_SESSION['NM_FUN'] = $_SESSION['nome_guerra'];
    $_SESSION['FUC_FUN'] = $_SESSION['cargo'];
    $_SESSION['DEPE'] = $_SESSION['dependencia'];
    $_SESSION['MAIL'] = $_SESSION['email'];
    
    $_SESSION['funcao'] = $_SESSION['cargo'];
    $_SESSION['ip'] = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
    $_SESSION['matAssumida'] = "";
    
    $_SESSION['prefixo'] = $_SESSION['dependencia'];
    $_SESSION['dependenciaLog'] = $_SESSION['dependencia'];

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
}

//apos a validacao da intranet resgata o valor das variaveis GET do Cookie  
if(!empty($_COOKIE["params"]) && empty($_GET)){
    $paramsSig = unserialize($_COOKIE["params"]);
    foreach ($paramsSig as $indice => $valor) {
        $_GET[$indice] = $valor;
    }
    setcookie("params", "", time());
}
