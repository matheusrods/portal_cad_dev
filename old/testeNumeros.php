<?php

$num='1500000000';
function formataExibicaoSemDecimal($n) {
    // tira qualquer formatação que eventualmente tenha o número
    $n = (0+str_replace(",", "", $n));
    
    // Verifica se é um número
    if (!is_numeric($n)) return false;
    
    // Filtra, altera o formato e coloca o texto do valor equivalente
    if ($n >= 1500000000) return round(($n/1000000000), 0).' bilhões';
    elseif ($n > 1000000000 and $n < 1500000000) return round(($n/1000000000), 0).' bilhão';
    elseif ($n >= 1995000) return round(($n/1000000), 0).' milhões';
    elseif ($n > 1000000 and $n < 1995000) return round(($n/1000000), 2).' milhão';
    elseif ($n > 1000) return floor(($n/1000)).' mil';

    return number_format($n);
    
}


function formataExibicao($n) {
    // tira qualquer formatação que eventualmente tenha o número
    $n = (0+str_replace(",", "", $n));
  
    // Verifica se é um número
    if (!is_numeric($n)) return false;
  
    // Filtra, altera o formato e coloca o texto do valor equivalente
    if ($n >= 2000000000) return round(($n/1000000000), 2).' bilhões';
    elseif ($n > 1000000000 and $n < 2000000000) return round(($n/1000000000), 2).' bilhão';
    elseif ($n >= 1995000) return round(($n/1000000), 2).' milhões';
    elseif ($n > 1000000 and $n < 1995000) return round(($n/1000000), 2).' milhão';
    elseif ($n > 1000) return floor(($n/1000)).' mil';

    return number_format($n);
}

echo round(($num/1000000), 2);
echo '<br><br><br>';
echo (formataExibicaoSemDecimal($num));
echo '<br><br><br>';
echo (formataExibicao($num));
?>