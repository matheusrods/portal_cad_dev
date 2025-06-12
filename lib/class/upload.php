<?php 
ini_set('display_startup_errors', 1);
/*  
*$dir é o caminho da pasta onde você deseja que os arquivos sejam salvos. 
*Neste exemplo, supondo que esta pagina esteja em public_html/upload/ 
*os arquivos serão salvos em public_html/upload/imagens/ 
*Obs.: Esta pasta de destino dos arquivos deve estar com as permissões de escrita habilitadas. 
*/ 

$dir = $_SERVER['DOCUMENT_ROOT']."/lib/apps/estudosPesquisas/arquivos/";
// recebendo o arquivo multipart
$file = $_FILES['arquivo'];


print_r($_FILES);
// $tamanhoArray = count($_FILES['userfile']['name']);

// $totalArquivos = 0;
// $extensaoArquivo = '';
// $extensoesValidas = array("pdf", "jpg", "jpeg", "png");
// $arquivoValido = 0;

// for($i=0; $i < $tamanhoArray; $i++){
//     $extensaoArquivo = $extensaoArquivo.strtolower(substr($_FILES['userfile']['name'][$i],-3));
//     echo $extensaoArquivo;
//     echo '<br><br>';
//     // if(in_array($extensaoArquivo, $extensoesValidas)){
//     //     $arquivoValido = $arquivoValido + 1;
//     // }
//     // if(!in_array($extensaoArquivo, $extensoesValidas)){
//     //     if($arquivoValido == 0){
//     //         $extensoesEscolhidas = $extensaoArquivo;
//     //     }
//     //     if($arquivoValido == 1){
//     //         $extensoesEscolhidas = $extensoesEscolhidas. ', '.$extensoesEscolhidas;
//     //     }

//     //     echo 'Selecione um arquivo no formato válido: PDF, PNG, JPG/JPEG. Formato selecionado: '.$extensoesEscolhidas;
//     //     return false;
//     // }
// }

// if($arquivoValido == 2) {
//     echo '<br><br>';
//     echo 'SUCESSO!';
//     $_FILES = '';
// }
// if($arquivoValido < 2){
//     echo '<br><br>';
//     echo 'Você não selecionou os dois arquivos';

//     $_FILES = '';
// }

// die;

// print_r($file);
// echo '<br><br>';
// echo 'count($file): '.count($file);
// echo '<br><br>';
// echo 'count($_FILES): '.count($_FILES['userfile']['name']);
// echo '<br><br>';
// print_r($_FILES);

// die;
// Move o arquivo da pasta temporaria de upload para a pasta de destino 
if (move_uploaded_file($file["tmp_name"], $dir.$file["name"])) { 
    echo "Arquivo enviado com sucesso!"; 
} else {
    // chmod($dir, 0755);
    print_r($_FILES);
}           
?>