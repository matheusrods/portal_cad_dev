<?php

$dados = require 'dados.php';

//$contador = 0;
//foreach ($dados as $pais) {
//    $contador++;
//}

//echo "Número de países: $contador";

//$contador =0;
//array_walk($dados, function ($pais) use(&$contador){
//    $contador++;
//});

//echo "Número de países: $contador";

$contador = count($dados);

echo "Número de países: $contador";

$contador = count($dados);
echo "Número de países: $contador";


function convertePaisParaLetramaiuscula(array $pais): array {
    $pais['pais'] = mb_convert_case($pais['pais'], mode: MB_UPER_CASE);
    return $pais;
}

function verificaSePaisTemEspacoNoNome(array $pais): bool
{
    return str_contains(' ', $pais['pais']);
}
$dados = arraymap(convertePaisParaLetramaiuscula, $dados);
$dados = array_filter($dados, verificaSePaisTemEspacoNoNome);


var_dump($dados);