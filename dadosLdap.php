


<?php
// ini_set('display_errors', 1);
session_start();

if($_SESSION["nome"] == ""){
    header("Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https://cad.bb.com.br/dadosLdap.php/#login/");
}

include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";

//se tiver parametro GET armazena os dados em um cookie para evitar que o redirecionamento limpe o valor das variaveis
if(!empty($_GET)){
    setcookie("params", serialize($_GET), time() + 600);
    $_SERVER["QUERY_STRING"] = "";
}

$cookie = $_COOKIE["BBSSOToken"];
$json = json_decode(file_get_contents("https://sso.intranet.bb.com.br/sso/identity/json/attributes?subjectid=$cookie"));

echo 'Dados de login: <br><br>';
echo '<pre>';
print_r($json->attributes);
echo '</pre><br><br>';

echo 'Dados de sessão: <br><br>';
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

$date = new DateTime();
$result = $date->format('Ymd_His');

$caminhoArquivo = $_SERVER["DOCUMENT_ROOT"]."/log/ldap/".$_SESSION['matricula'].'_'.$result.".txt";

$conteudo = var_export($json->attributes, true);
$conteudo = $conteudo."\n\n\n".var_export($_SESSION, true);

file_put_contents($caminhoArquivo, $conteudo);
chmod($caminhoArquivo, 0777);


// $dados=$json->attributes;

// foreach ($dados as $obj) {
//     if ($obj->name === 'uid' || $obj->name === 'ibm-nativeuid') {
//         $uidValue = $obj->values[0];
//         $tipoChave = substr($uidValue, 0, 1);
//         $tipoChave = strtolower($tipoChave);
//         break;
//     }
// }

// if ($uidValue !== null) {
//     echo "O valor de uid é: " . $uidValue."<br>";
//     echo "A chave é do tipo: ".$tipoChave;
// } else {
//     echo "uid não encontrado.";
// }