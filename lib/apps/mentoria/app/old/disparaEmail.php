<?php
// ini_set("display_errors", E_ALL);
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/Conexao.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/database/class.database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/mentoria/class/class_mentoria.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/PHPMailer/PHPMailerAutoload.php";

print_r(date('Y-m-d H:i:s'));
// die;




class disparaEmail {

    // Função padrão do PHP para declaração de variáveis que serão utilizadas em outras funções
    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        $mat = $_SESSION['matricula'];
        $caminhoLogErro = $this->caminhoLogErro = $_SERVER["DOCUMENT_ROOT"] . "/log/log_erros";
    }
    
    public function consultaRegistro(){
        $mat = $_SESSION['matricula'];

        $db = new Database("mentoria");
        $query = "
            SELECT * FROM cad.solicitacao ORDER BY timestamp desc LIMIT 1;
        ";

        $result = $db->DbGetAll($query);
        $qtd = sizeof($result);

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
                    font-size: 18px;
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
                    font-size: 12px;
                    font-family: BancoDoBrasil Textos;
                    font-weight: 400;
                    word-wrap: break-word;
                    margin-left: 10%;
                }

            </style>

            <div style="width: 100%; height: auto; position: relative;">
                <div class="tituloPergunta">
                    Segue abaixo solicitação de imersão realizada por '.$result[0]['matricula'].' - '.$result[0]['nome'].'
                </div>
                <br>
                <br>
                <br>
                <div class="tituloPergunta">
                    Para qual dependência é a mentoria?
                </div>    
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$result[0]['dependencia'].'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    Qual necessidade pretende-se atender com o uso do assistente virtual?
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$result[0]['necessidade'].'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    Qual o público-alvo que irá utilizar o assistente virtual?
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$result[0]['publicoAlvo'].'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    Em quais canais o assistente virtual será disponibilizado?
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$result[0]['canais'].'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    Você já sabe quais os conteúdos mais importantes que incluirá no seu assistente virtual?
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$result[0]['conteudos'].'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    A equipe já possui alguma experiência com o desenvolvimento de assistentes virtuais?
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$result[0]['experienciaEquipe'].'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    A equipe que irá desenvolver o assistente virtual será composta por quantas pessoas?
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$result[0]['totalPessoas'].'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    Numa escala de 1 a 5, qual o nível de experiência da equipe
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$result[0]['escalaConhecimento'].'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    Em quais temas a mentoria deve ser focada?
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$result[0]['focoTemas'].'
                    </p>
                </div>
                <br>
                <div class="tituloPergunta">
                    Você prefere que a mentoria seja realizada em qual formato?
                </div>
                <div style="width: 100%; height: auto; position: relative">
                    <p class="respostas">
                        Resposta: '.$result[0]['formato'].'
                    </p>
                </div>
            </div>
        ';
        
        if($qtd > 0){
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
            $mail->FromName = 'Centro de Assistentes Digitais - CAD BB';
            
            // Define o(s) destinatário(s)
            $mail->AddAddress('albert.rosa@bb.com.br', 'Albert F Rosa');
            // $mail->AddAddress('F0285739@bb.com.br', ''.$nmFunci.'');
            // Opcional: mais de um destinatário
            // $mail->AddAddress('apiazza@bb.com.br', 'Piazza');
            // $mail->AddAddress('jvdcamargo@bb.com.br', 'João Victor');
            // Opcionais: CC e BCC
            $mail->AddCC(''.$result[0]['email']. ', '.$result[0]['nome'].'');
            // $mail->AddBCC('albert.rosa@bb.com.br', 'Albert Ferreira Rosa');
            
            // Definir se o e-mail é em formato HTML ou texto plano
            // Formato HTML . Use "false" para enviar em formato texto simples ou "true" para HTML.
            $mail->IsHTML(true);
            // Charset (opcional)
            $mail->CharSet = 'UTF-8';
            // Assunto da mensagem
            $mail->Subject = 'Solicitação de Imersão - Dependência '.$result[0]['dependencia'];
            // Corpo do email
            $mail->Body = $corpoEmail;
            
            // Opcional: Anexos
            // $mail->AddAttachment("/home/usuario/public_html/documento.pdf", "documento.pdf");
            // Envia o e-mail
            $enviado = $mail->Send();
            // Se enviado, grava log de envio
            if ($enviado){
                $classLog = new gravaLogAcesso();

                $gravaLogAcesso = $classLog->gravaDadosEmail(''.'Solicitação de Imersão - Dependência '.$result[0]['dependencia'].'', ''.$corpoEmail.'', ''.$result[0]['email'].'', 'cad@bb.com.br');
            }
        }
    }
    
}
$result = new disparaEmail();
$result->consultaRegistro();
// print_r($result());
die;
?>