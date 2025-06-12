<?php 

// ini_set("display_errors", E_ALL);

session_start();

if(!isset($_SESSION['matricula'])){
    session_start();
    include_once $_SERVER["DOCUMENT_ROOT"]."/lib/login/login.php";
    header('Location: https://login.intranet.bb.com.br/sso/XUI/?goto=https%3A%2F%2Fcad.bb.com.br%2Flib%2Fapps%2Fmentoria%2Fapp%2Fformulario.php#login/');
    die;
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/mentoria/class/class_mentoria.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/class/gravaLogAcesso.php";

$class = new gravaLogAcesso();
$gravaLogAcesso = $class->gravaLogAcesso($_SESSION['matricula'], $_SESSION['nome'], $_SESSION['cargo'], $_SESSION['MAIL'], $_SESSION['dependencia'], 'Formulário Mentoria', $_SESSION['ip']);
echo '<!-- CSS específico do app --><link href="/lib/apps/mentoria/css/mentoria_formulario.css" rel="stylesheet">';
echo '<!-- JS específico do app --><script type="text/javascript" src="/lib/apps/mentoria/js/mentoria.js"></script>';
?>

<div class="formularioSolicitacaoMentoria" style="background: url(https://cad.bb.com.br/lib/img/apps/mentoria/fundoMentoria.png); background-repeat: repeat;">
    <div class="formularioDiv01" style="display: inline-flex; flex-direction: row;">
        <div id="roboBarra" style="display: inline-flex;flex-direction: column;">
            <img style="width: 778px; height: 683px; position: relative;" src="/lib/img/apps/mentoria/roboFormularioSolicitarImersao.png">
            <img style="width: 372px;height: 64px;position: relative;align-content: center;" src="/lib/img/apps/mentoria/barraPorcentagem0.png">
        </div>
        <div class="perguntasFormulario01" style="display: inline-flex; flex-direction: column;">
            <div style="width: 926px;height: 123px;position: relative;text-align: center;color: #FCFC30;font-size: 96px;font-family: 'BancoDoBrasil Titulos';font-weight: 700;word-wrap: break-word;margin-top: 5%;">
                Vamos lá!
            </div>
            <div style="width: 100%;height: auto;position: relative;color: #FCFC30;font-size: 36px;font-family: 'BancoDoBrasil Textos';font-weight: 300;text-align: center;margin-top: 7%;">
                A mentoria é para qual dependência?
            </div>
            <div class="botoesForm01" style="display: inline-flex;flex-direction: row;gap: 5%;margin-top: 5%;">
                <div style="width: 45%;height: auto;position: relative;border: 1px #FCFC30 solid;border-radius: 14px;display: inline-flex;" attr-Dependencia="<?php echo $_SESSION['dependencia'] ?>">
                    <img style="width: 40%; height: auto; position: relative;" src="/lib/img/apps/mentoria/minhaDependencia.png">            
                    <div style="width: 60%; height: auto; align-content: center; position: relative; color: #FCFC30; font-size: 32px; font-family: 'BancoDoBrasil Textos'; font-weight: 700; word-wrap: break-word;">
                        Minha dependência
                    </div>
                </div>
                <div style="width: 45%;height: auto;position: relative;border-radius: 14px;border: 1px #FCFC30 solid;display: inline-flex;">
                    <img style="width: 169px; height: auto; position: relative;" src="/lib/img/apps/mentoria/outraDependencia.png">
                    <div style="width: 190px;height: auto;align-content: center;position: relative;color: #FCFC30;font-size: 32px;font-family: 'BancoDoBrasil Textos';font-weight: 700;">
                        Outra dependência
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>