<?php

$saldo = 1000;
$titularConta = "Anderson Costa";

echo "**************** <br>";
echo "Titular: $titularConta <br>";
echo "Saldo Atual: R$ $saldo <br>";
echo "**************** <br>";

do {
    
    echo "1.  Consultar saldo atual <br>";
    echo "2.  Sacar valor <br>";
    echo "3.  Depositar <br>";
    echo "4.  Sair <br>";

    $opcao = (int) fgets(STDIN); // ler a opção do usuario

    switch ($opcao) {
        case 1:
            echo "**************** <br>";
            echo "Titular: $titularConta <br>";
            echo "Saldo Atual: R$ $saldo <br>";
            echo "**************** <br>";
            break;

        case 2:
            echo"Qual valor deseja sacar? <br>";
            $valorSacar = (float) fgets(STDIN);
            if ($valorSacar > $saldo) {
                echo "Saldo insuficiente <br>";
            }else {
                $saldo = $saldo - $valorSacar;
                echo "Saque Realizado com sucesso! <br>";
            }
                break;

        case 3:
            echo"Qual valor deseja depositar? <br>";
            $valorDepositar = (float) fgets(STDIN);
            if ($valorDepositar < 0) {
                echo "Não é possivel depositar valores negativos";
            } else {
                $saldo = $saldo + $valorDepositar;
                echo "Deposito realizado com sucesso! <br> Seu novo saldo é de: $saldo";
            }
                break;      
            
        case 4:
            echo "saindo!";
            break;
        
        default:
            echo "Opção invalida <br>";
            break;
    }
} while ($opcao != 4);