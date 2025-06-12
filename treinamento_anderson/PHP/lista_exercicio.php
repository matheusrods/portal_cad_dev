<?php

echo "Anderson <br>";

$primeiraNota = 8;
$segundaNota = 7.5;
$terceiraNota = 5;

$mediaNota = ($primeiraNota + $segundaNota + $terceiraNota) / 3;

echo "A média das notas é: " . $mediaNota . "<br>";


$metros = 8;
$centimetros = $metros * 100;
echo "$metros metros equivalem a $centimetros centimetros <br>";

$ano = 2024;

if(($ano % 4 == 0 && $ano % 100 != 0) || $ano % 400 == 0) {
    echo "$ano é bissexto. <br>";
} else {
    echo "$ano não é bissexto <br>";
}

$celsius = 30;
$fahrenheit = $celsius * 1.8 + 32;

$total = "A temperatura de $celsius Celsius é equivalente a $fahrenheit Fahrenheit";

echo $total;

// 1 - Escreva um programa que exiba, na tela do usuário, todos os números ímpares de 0 à 100.
for ($contador = 1; $contador < 100; $contador++) {
    if ($contador % 2 !== 0) {
        echo $contador . "<br>";
    }
}

//2 - Crie um programa que, a partir de altura e peso, calcule o IMC e exiba a classificação do IMC.

$altura = 1.75;
$peso = 85;
$imc = $peso / $altura ** 2;

if ($imc < 18.5) {
    echo "Abaixo do peso";
} elseif ($imc >= 18.5 && $imc <25) {
    echo "Peso normal";
} elseif ($imc >= 25 && $imc <30) {
    echo "Excesso de peso";
} else {
    echo "Obesidade";
}

// 3 - Desenvolva um programa que exiba na tela uma saudação (bom dia, boa tarde ou boa noite) dependendo do horário encontrado em uma variável (inteiro representando as horas).
$hora = 10;

if ($hora > 6 && $hora < 12) {
    echo "Bom dia";
} elseif ($hora >= 12 && $hora < 18) {
    echo "Boa tarde";
} else {
    echo "Boa noite";
}

