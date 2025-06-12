<?php

echo "Bem-vindo(a) ao screen match!\n";

$nomeFilme = "Top Gun - Maverick";
$nomeFilme = "Thor: Ragnarock";
$nomeFilme = "American Pie";
$anoLancamento = $argv[1] ?? 2022;

$quantidadeDeNotas = $argc - 1;
$notas = [];

// argc é a quantidade de parametros que o programa recebe
// for tem 3 partes (inicialização; Condição da repetição; Incremento)
for ($contador = 1; $contador < $argc; $contador ++){
    $notas[] = (float) $argv[$contador];
}

$somaDeNotas = 0;
foreach($notas as $nota) {
    $somaDeNotas += $nota;
}

$notaFilme = array_sum($notas) / $quantidadeDeNotas;

//Fazendo no loop while
// como tem uma nota a mais sendo passada, que no caso é o 0 que encerra o while, a variavel $quantidadeDeNotas precisa ser -2
//$contador = 1;
//while ($argv[$contador] != 0) {
 //   $somaDeNotas += $argv[$contador++];
//}
//$notaFilme = $somaDeNotas / $quantidadeDeNotas;

$planoPrime = true;

$incluidoNoPlano = $planoprime || $anoLancamento < 2020;

echo "$nomeFilme:  \n $notaFilme $anoLancamento";

if ($anoLancamento > 2022) {
    echo "Esse filme é um lançamento\n";
} elseif ($anoLancamento > 2020 && $anoLancamento <= 2022){
    echo "Esse filma ainda é novo\n";
} else {
    echo "Esse filme não é um lançamento\n";
}

$genero = match ($nomeFilme) {
    "Top Gun - Maverick" => "Ação",
    "Thor: Ragnarock" => "Super-herói",
    "American Pie" => "Comédia",
    default => "Gênero desconhecido"
};

echo "O gênero do filme é: $genero\n";

$filme = [ 
    "Nome" => "Thor: Ragnarok",
    "Lancamento" => 2021,
    "Nota" => 7.8,
    "Genero" => "Super-heroi"
];

echo $filme["Nome"];