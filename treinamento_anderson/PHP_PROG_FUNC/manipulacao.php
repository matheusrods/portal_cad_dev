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



function somaMedalhas(int $medalhasAcumuladas, int $medalhas){
    return $medalhasAcumuladas + $medalhas;
};

$brasil = $dados[0];
$numeroDeMedalhas = array_reduce($brasil['medalhas'], function 'somaMedalhas', initial 0);
echo $numeroDeMedalhas;

exit();

function convertePaisParaLetramaiuscula(array $pais): array {
    $pais['pais'] = mb_convert_case($pais['pais'], mode: MB_CASE_UPPER);
    return $pais;
}

function verificaSePaisTemEspacoNoNome(array $pais): bool
{
    return str_contains(' ', $pais['pais']);
}

function medalhasAcumuladas (int $medalhasAcumuladas, array $pais): int {
    return $medalhasAcumuladas + array_reduce($pais['medalhas'], function 'somaMedalhas', initial 0);
}

$dados = arraymap(convertePaisParaLetramaiuscula, $dados);
$dados = array_filter($dados, verificaSePaisTemEspacoNoNome);

$medalhas = array_reduce(
    array_map(function (array $medalhas) {
        return array_reduce($medalhas, function: 'somaMedalhas', initial 0);
    }, array_column($dados, column: 'medalhas')),
    function: 'somaMedalhas',
    initial 0
);

var_dump($dados);

echo array_reduce($dados, 'medalhasAcumuladas', initial 0);