<?php

// Mostrar erros do PHP
// ini_set('display_startup_errors', 1);

// Força o início da sessão
session_start();

// Importação de arquivos de funções de banco de dados e de gravação de log
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/geraLog.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/PHPMailer/PHPMailerAutoload.php";

Class funcoes {

    public $mat;
    public $caminhoLogErro;

    // Função padrão do PHP para declaração de variáveis que serão utilizadas em outras funções
    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        $mat = $_SESSION['matricula'];
        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
    }
    public function consultaDepoimentosMentoria(){
        $mat = $_SESSION['matricula'];

        $db = new Database('cad');
        $query = "SELECT * FROM cad.depoimentos WHERE ativo = 1;";
                
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("mentoria", "consultaDepoimentosMentoria", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 15px; font-weight: bold;'>Não foi possível consultar os depoimentos do Programa de Imersão. Informe à equipe responsável o caminho a seguir: " . $arquivoLog.'</p>';
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    public function consultaProfessoresMentoria(){
        $mat = $_SESSION['matricula'];

        $db = new Database('cad');
        $query = "SELECT * FROM cad.professoes WHERE ativo = 1 ORDER BY RAND();";
                
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = $execQuery;
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("mentoria", "consultaProfessoresMentoria", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 15px; font-weight: bold;'>Não foi possível consultar os professores do Programa de Imersão. Informe à equipe responsável o caminho a seguir: " . $arquivoLog.'</p>';
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    public function consultaBio($matricula){
        $mat = $_SESSION['matricula'];

        $db = new Database('cad');
        $query = "SELECT matricula, nome, bio FROM cad.professoes WHERE matricula = '".$matricula."';";
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $retorno = array();
                // $retorno["mensagem"] = $execQuery;
                $retorno = '<div id="modalBioMentoria" class="modal">
                        <div class="modal-bio-professores">
                            <span class="close">&times;</span>
                            <div style="width: 100%; height: 100%; padding-top: 64px; padding-bottom: 64px; background: linear-gradient(90deg, #525252 0%, black 100%); box-shadow: 0px 0px 1px rgba(24, 24, 27, 0.04); flex-direction: column; justify-content: flex-start; align-items: flex-start; display: inline-flex; border-radius: 8px;">
                                <div style="align-self: stretch; justify-content: center; align-items: flex-start; gap: 32px; display: inline-flex;">
                                    <img style="width: 350px; height: 350px; border-radius: 33px" src="https://humanograma.intranet.bb.com.br/avatar/'.$execQuery[0]['matricula'].'" />
                                    <div style="flex-direction: column; justify-content: center; align-items: flex-start; gap: 10px; display: inline-flex">
                                        <div style="width: 443px; color: #FCFC30; font-size: 36px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word;">'.$execQuery[0]['nome'].'</div>
                                        <div style="width: 443px; color: white; font-size: 24px; font-family: BancoDoBrasil Textos; font-weight: 300; word-wrap: break-word">'.$execQuery[0]['bio'].'</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("mentoria", "consultaBio", $informacoesErro, $mat);
            $retorno["mensagem"] = "<p style='font-size: 15px; font-weight: bold;'>Não foi possível consultar a biografia do professor desejado. Informe à equipe responsável o caminho a seguir: " . $arquivoLog.'</p>';
            $retorno["status"] = 0;
        } finally {
            return (json_encode($retorno));
        }
    }

    public function gravaSolicitacao($matricula, $nome, $email, $dependencia, $necessidade, $publicoAlvo, $canais, $conteudos, $experienciaEquipe, $totalPessoas, $escalaConhecimento, $focoTemas, $formato){
        $db = new Database('cad');
        $query = "
            INSERT INTO `mentoria`.`solicitacao` (`dependencia`, `matricula`, `nome`, `email`, `necessidade`, `publicoAlvo`, `canais`, `conteudos`, `experienciaEquipe`, `totalPessoas`, `escalaConhecimento`, `focoTemas`, `formato`) 
                VALUES ('".$dependencia."', '".$matricula."', '".$nome."', '".$email."', '".$necessidade."', '".$publicoAlvo."', '".$canais."', '".$conteudos."', '".$experienciaEquipe."', '".$totalPessoas."', '".$escalaConhecimento."', '".$focoTemas."', '".$formato."');";

        try{
            $execQuery = $db->DbQuery($query);
            
            if($execQuery){
                $retorno = array();
                $retorno["mensagem"] = "Sucesso!";
                $retorno["status"] = 1;
            }
        } catch(Exception $e){
            $informacoesErro = "erro: " . $e . "\n \n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("mentoria", "gravaSolicitacao", $informacoesErro, $matricula);
            $retorno["mensagem"] = "<p style='font-size: 15px; font-weight: bold;'>Não foi possível gravar sua solicitação no Programa de Imersão. Informe à equipe responsável o caminho a seguir: " . $arquivoLog.'</p>';
            $retorno["status"] = 0;
        } finally {
            return (json_encode($retorno));
        }
    }

    public function consultaRegistro($matricula){
        $db = New Database('cad');
        $query = "SELECT * FROM cad.solicitacao ORDER BY timestamp DESC LIMIT 1;";
        try{
            $execQuery = $db->DbGetAll($query);
            
            if($execQuery){
                $matriculaNome = $execQuery[0]['matricula'].' - '.$execQuery[0]['nome'];
                $email = $execQuery[0]['email'];
                $dependencia = $execQuery[0]['dependencia'];
                $necessidade = $execQuery[0]['necessidade'];
                $publicoAlvo = $execQuery[0]['publicoAlvo'];
                $canais = $execQuery[0]['canais'];
                $conteudos = $execQuery[0]['conteudos'];
                $experienciaEquipe = $execQuery[0]['experienciaEquipe'];
                $totalPessoas = $execQuery[0]['totalPessoas'];
                $escalaConhecimento = $execQuery[0]['escalaConhecimento'];
                $focoTemas = $execQuery[0]['focoTemas'];
                $formato = $execQuery[0]['formato'];
                
                $retorno = $this->enviarEmail($matriculaNome, $email, $dependencia, $necessidade, $publicoAlvo, $canais, $conteudos, $experienciaEquipe, $totalPessoas, $escalaConhecimento, $focoTemas, $formato);
            }
        } catch(Exception $e){
            echo '<br>';
            echo "Exception";
            $informacoesErro = "erro: " . $e . "\n \n\$query:" . $query;
            $arquivoLog = $this->geraLogExcecao("mentoria", "consultaRegistro", $informacoesErro, $matricula);
            $retorno["mensagem"] = "<p style='font-size: 15px; font-weight: bold;'>Não foi possível efetuar o envio do email de notificação aso responsáveis pelo Programa de Imersão. Informe à equipe responsável o caminho a seguir: " . $arquivoLog.'</p>';
            $retorno["status"] = 0;
        } finally {
            return ($retorno);
        }
    }

    public function enviarEmail($matriculaNome, $email, $dependencia, $necessidade, $publicoAlvo, $canais, $conteudos, $experienciaEquipe, $totalPessoas, $escalaConhecimento, $focoTemas, $formato){
        $corpoEmail = '
            <style>
                body {
                    overflow-x: hidden;
                }
                .tituloPergunta{
                    width: 100%;
                    height: auto;
                    position: relative;
                    color: #000;
                    font-size: 14px;
                    font-family: BancoDoBrasil Textos;
                    font-weight: 700;
                    word-wrap: break-word;
                    white-space: pre-wrap;
                    margin: 0% 5% 0% 5%;
                }

                .respostas {
                    width: 100%;
                    position: relative;
                    color: #000;
                    font-size: 14px;
                    font-family: BancoDoBrasil Textos;
                    font-weight: 400;
                    word-wrap: break-word;
                    margin-left: 10%;
                }

            </style>

            <div style="width: 100%; height: auto; position: relative;">
                <div class="tituloPergunta">
                    Segue abaixo solicitação de imersão realizada por '.$matriculaNome.', e-mail '.$email.'
                </div>
                <br>
                <br>
                <br>
                <div class="tituloPergunta">
                    Para qual dependência é a mentoria?
                </div>    
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$dependencia.'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    Qual necessidade pretende-se atender com o uso do assistente virtual?
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$necessidade.'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    Qual o público-alvo que irá utilizar o assistente virtual?
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$publicoAlvo.'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    Em quais canais o assistente virtual será disponibilizado?
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$canais.'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    Você já sabe quais os conteúdos mais importantes que incluirá no seu assistente virtual?
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$conteudos.'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    A equipe já possui alguma experiência com o desenvolvimento de assistentes virtuais?
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$experienciaEquipe.'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    A equipe que irá desenvolver o assistente virtual será composta por quantas pessoas?
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$totalPessoas.'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    Numa escala de 1 a 5, qual o nível de experiência da equipe
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$escalaConhecimento.'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    Em quais temas a mentoria deve ser focada?
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$focoTemas.'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    Você prefere que a mentoria seja realizada em qual formato?
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$formato.'
                    </p>
                </div>
            </div>
        ';
        
        // Inicia a classe PHPMailer
        $mail = new PHPMailer();
        // Método de envio
        $mail->IsSMTP();
        // Enviar por SMTP
        $mail->Host = 'smtp.bb.com.br';
        // Você pode alterar este parametro para o endereço de SMTP do seu provedor
        $mail->Port = 25;
        // Usar autenticação SMTP (obrigatório)
        $mail->SMTPAuth = false;
        // Usuário do servidor SMTP (endereço de email)
        // obs: Use a mesma senha da sua conta de email
        $mail->Username = 'cad@bb.com.br';
        // $mail->Password = '12345678';
        // Configurações de compatibilidade para autenticação em TLS
        $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));
        // Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro.
        // $mail->SMTPDebug = 2;
        // Define o remetente
        // Seu e-mail
        $mail->From = 'cad@bb.com.br';
        // Seu nome
        $mail->FromName = 'Central de Atendimento Digital - CAD BB';
        
        // Define o(s) destinatário(s)
        // $mail->AddAddress('cad@bb.com.br', 'Central de Atendimento Digital - CAD BB');

        $mail->AddAddress('cad@bb.com.br', 'Central de Atendimento Digital - CAD BB');
        //$mail->AddAddress('yasmin.leopoldino@bb.com.br', 'Yasmin Leopoldino Silva');
        // $mail->AddAddress('jvdcamargo@bb.com.br', 'João Victor D R Camargo');
        //$mail->AddAddress('apiazza@bb.com.br', 'Augusto Piazza');
        // Opcional: mais de um destinatário
        // $mail->AddAddress('apiazza@bb.com.br', 'Piazza');
        // $mail->AddAddress('jvdcamargo@bb.com.br', 'João Victor');
        // Opcionais: CC e BCC
        // $mail->AddCC(''.$result[0]['email']., ''.$result[0]['nome'].'');
        $mail->AddBCC('apiazza@bb.com.br', 'Augusto Piazza Marassa Roza');
        //$mail->AddBCC('albert.rosa@bb.com.br', 'Albert Ferreira Rosa');
        $mail->AddBCC('yasmin.leopoldino@bb.com.br', 'Yasmin Leopoldino Silva');

        
        // Definir se o e-mail é em formato HTML ou texto plano
        // Formato HTML . Use "false" para enviar em formato texto simples ou "true" para HTML.
        $mail->IsHTML(true);
        // Charset (opcional)
        $mail->CharSet = 'UTF-8';
        // Assunto da mensagem
        $mail->Subject = 'Solicitação de Imersão - Dependência '.$dependencia;
        // Corpo do email
        $mail->Body = $corpoEmail;
        
        // Opcional: Anexos
        // $mail->AddAttachment("/home/usuario/public_html/documento.pdf", "documento.pdf");
        // Envia o e-mail
        $enviado = $mail->Send();

        // Se enviado, grava log de envio
        if ($enviado){
            // $classLog = new gravaLogAcesso();
            // $gravaLogAcesso = $classLog->gravaDadosEmail('Solicitação de Imersão - Dependência '.$dependencia.'', ''.$corpoEmail.'', ''.$email.'', 'cad@bb.com.br');
            $retorno['status'] = 1;
            $retorno['mensagem'] = "Sucesso";
            return (json_encode($retorno));
        } else {
            $retorno['status'] = 0;
            $retorno["mensagem"] = "<p style='font-size: 15px; font-weight: bold;'>Houve uma falha no registro do seu pedido. Informe à equipe responsável o caminho a seguir: " . $arquivoLog.'</p>';
            return (json_encode($retorno));
        }
    }

    public function geraLogExcecao($nomeApp, $nomeFuncao, $informacoesAdicionais, $mat){
        $dateTime = date("Y-m-d")."_". date("H.i.s");
        $nomeArquivo = $dateTime . "_" . $mat . "_" . $nomeApp . "_" . $nomeFuncao .".txt";
        $caminhoArquivo = $this->caminhoLogErro . "/" . $nomeArquivo;

        $strDataHora = print_r(new DateTime(), true);
        $strRequest = print_r($_REQUEST, true);
        $strSession = print_r($_SESSION, true);
        
        $strArquivo = "data:\n" . $strDataHora . "\n\$_REQUEST:\n" . $strRequest . "\n\$_SESSION:\n" . $strSession . "\n\$informacoesAdicionais:\n" . $informacoesAdicionais;

        file_put_contents($caminhoArquivo, $strArquivo);
        chmod($caminhoArquivo, 0777);

        return $caminhoArquivo;
    }

}
?>