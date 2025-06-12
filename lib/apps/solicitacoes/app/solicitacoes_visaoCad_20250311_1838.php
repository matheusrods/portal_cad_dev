<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/lib/apps/solicitacoes/class/class_solicitacoes.php";

$class = new funcoes();
// $contaNovasSolicitacoes = $class->contaNovasSolicitacoes();

$notificacoesNovasSolicitacoes = '';

$contaNovasSolicitacoes = $class->contaNovasSolicitacoes();
$consultaSolicitacoes = $class->consultaSolicitacoes();

if($contaNovasSolicitacoes['status'] == 1 && $contaNovasSolicitacoes['mensagem'] > '0'){
    $notificacoesNovasSolicitacoes = '<div class="notificacoesInteracoesSolicitacoes" style="flex-direction: column; justify-content: flex-start; align-items: flex-start; display: inline-flex">
                    <div style="width: 36px; height: 36px; background: #FBD40B; border-radius: 999px; flex-direction: column; justify-content: center; align-items: center; display: flex">
                        <div style="text-align: center; color: #111214; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 700; line-height: 18px; word-wrap: break-word">'.$contaNovasSolicitacoes['mensagem'].'</div>
                    </div>
                </div>';
} else if($contaNovasSolicitacoes['status'] == 0) {
    $notificacoesNovasSolicitacoes = '<div class="notificacoesInteracoesSolicitacoesErro" style="flex-direction: column; justify-content: flex-start; align-items: flex-start; display: inline-flex">
                    <div style="width: 36px; height: 36px; background: #FBD40B; border-radius: 999px; flex-direction: column; justify-content: center; align-items: center; display: flex">
                        <div style="text-align: center; color: #111214; font-size: 16px; font-family: BancoDoBrasil Textos; font-weight: 700; line-height: 18px; word-wrap: break-word">?</div>
                        <span class="tooltipErroConsultaNovasSolicitacoes">'.$contaNovasSolicitacoes['mensagem'].'</span>
                    </div>
                </div>';
} else if($contaNovasSolicitacoes['status'] == 1 && $contaNovasSolicitacoes['mensagem'] == '0'){
    $notificacoesNovasSolicitacoes = '';
}

?>

<div class="cabecalhoSolicitacoes" style="width: 100%; height: auto; background-color: #735CC6; display: inline-flex; flex-direction: row;">
    <div class="textoCabecalhoSolicitacoes" style="width: 50%; align-content: center; margin-left: 10%;">
        <div class="tituloTextoCabecalhoSolicitacoes" style="position: relative; width: 769px; height: 218px; font-family:Bancodobrasil titulos; font-weight: 700; color: #ffffff; font-size: 96px; letter-spacing: -9.60px; line-height: normal;">
            Acompanhe<br>Solicitações
        </div>
        <div class="subtituloTextoCabecalhoSolicitacoes">
            <p class="text-wrapper" style="position: relative; width: 80%; height: 90px; font-family: Bancodobrasil textos; font-weight: 300; color: #ffffff; font-size: 32px;">
                Faça o acompanhamento de solicitações de demandas para o CAD aqui👇
            </p>
        </div>
    </div>
    <div class="imagemCabecalhoSolicitacoes" style="width: 40%; align-content: center; margin-right: 10%;">
        <img src="/lib/img/apps/solicitacoes/capaSolicitacoesBot.png" style="width: 100%;">
    </div>
</div>
<div class= "conteudoSolicitacoes">
    <div class="divTabelaSolicitacoes">
        <div class="tituloNotificacaoTabelaSolicitacoes">
            <div class="tituloTabelasolicitacoes" style="position: relative; width: 100%; height: auto; background: white; border-top-left-radius: 36px; justify-content: center; align-items: center; gap: 10px; display: inline-flex">
                <div style="width: 550px; text-align: center; color: #2C3FBF; font-size: 40px; font-family: BancoDoBrasil Titulos; font-weight: 700; word-wrap: break-word">
                    Solicitações cadastradas
                </div>
                <?php echo $notificacoesNovasSolicitacoes; ?>
            </div>
        </div>
        <div class="filtroTabelaSolicitacoes" style="width: 100%;">
            <div class="divFiltrosPrimeiraLinha">
                <div class="divFiltrosSolicitacoes">
                    <div class="campoPesquisaSolicitacao">
                        <div style="position: relative">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </div>
                        <div class="divInputSolicitacoes">
                            <input type="text" class="inputPesquisaNumeroSolicitacao itemPesquisaSolicitacao" attr-campoAlterado="0" attr-nomeCampoBd = "a.idSolicitacao" id="pesquisaNumeroSolicitacao" placeholder="ID Solicitação" style="flex: 1 1 0; background-color: #F0F2F4; font-size: 16px; font-weight: 400; line-height: 20px; letter-spacing: 0.08px; word-wrap: break-word; border: none;">
                        </div>
                    </div>

                    <div class="campoPesquisaSolicitacao">
                        <div style="position: relative">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </div>
                        <div class="divInputSolicitacoes">
                        <input type="text" class="inputPesquisaProdutoSolicitacao itemPesquisaSolicitacao" attr-campoAlterado="0" attr-nomeCampoBd = "ifnull(c.assuntoJornada, d.temaProduto)" id="pesquisaProdutoSolicitacao" placeholder="Produto" style="flex: 1 1 0; background-color: #F0F2F4; font-size: 16px; font-weight: 400; line-height: 20px; letter-spacing: 0.08px; word-wrap: break-word; border: none;">
                        <!-- <input type="text" class="inputPesquisaProdutoSolicitacao itemPesquisaSolicitacao" attr-campoAlterado="0" attr-nomeCampoBd = "a.tema" id="pesquisaProdutoSolicitacao" placeholder="Produto" style="flex: 1 1 0; background-color: #F0F2F4; font-size: 16px; font-weight: 400; line-height: 20px; letter-spacing: 0.08px; word-wrap: break-word; border: none;"> -->
                        </div>
                    </div>

                    <div class="campoPesquisaSolicitacao">
                        <div style="position: relative">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </div>
                        <div class="divInputSolicitacoes">
                            <input type="text" class="inputPesquisaDependenciaSolicitacao itemPesquisaSolicitacao" attr-campoAlterado="0" attr-nomeCampoBd = "a.prefixo" id="pesquisaDependenciaSolicitacao" placeholder="Dependência" style="flex: 1 1 0; background-color: #F0F2F4; font-size: 16px; font-weight: 400; line-height: 20px; letter-spacing: 0.08px; word-wrap: break-word; border: none;">
                        </div>
                    </div>

                    <div class="campoPesquisaSolicitacao">
                        <select name="selectStatusSolicitacao" id="campoStatusSolicitacao" class="selectFiltroPesquisa itemPesquisaSolicitacao" attr-nomeCampoBd = "a.status" attr-campoAlterado= "0" style="width: 100%; background-color: #F0F2F4; border: none; color: #6C7077;">
                            <option value="0">Status</option>
                            <option value="1">Nova</option>
                            <option value="2">Em análise</option>
                            <option value="3">Aprovada</option>
                            <option value="4">Encerrada</option>
                        </select>
                    </div>
                    
                    <div style="margin: 2% 0.75%;">
                        <div class="divBtnPesquisaSolicitacoes divBtnLimparFiltrosSolicitacoes" style="width: 20%; float: right;">
                            <input type="button" class="btnPersonalizar limparFiltrosSolicitacoes" value="Limpar Filtros"> 
                        </div>
                    </div>
                </div>
                
                <div class="divTabelaDadosSolicitacoes">
                    <table id="tabelaDadosSolicitacoes">
                        <thead style="background-color: #F0F2F4; line-height: 3rem;">
                            <tr>
                                <th>ID Solicitação</th>
                                <th>Tema/Produto</th>
                                <th>Dependência</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="bodyTabelaSolicitacoes" style="line-height: 3rem;">
                            <?php echo $consultaSolicitacoes['mensagem']; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="divConsultaDetalheSolicitacao">
        <div class= "cabecalhoAbaConsultaSolicitacao">
            <div class="voltaIDCabecalho">
                <svg class = "btnVoltaParaTabelaSolicitacoesCad Clicar" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M8.707 7.29309L4 12.0001L8.707 16.7071L10.121 15.2931L7.828 13.0001H19.414V11.0001L7.828 11.0001L10.121 8.70709L8.707 7.29309Z" fill="#2D37F5"/>
                </svg>
                <span class = "textoVoltarDetalheSolicitacao  btnVoltaParaTabelaSolicitacoesCad Clicar">Voltar</span> <span class ="idCabecalhoDetalheSolicitacao"> / #ID01 </span >
            </div>
            <span class="temaProdutoDetalheSolicitacao">PIX</span>
            <!--Encerrada-->
            <div class="detalheStatusConsultaSolicitacao">
                <svg xmlns="http://www.w3.org/2000/svg" width="98" height="25" viewBox="0 0 98 25" fill="none">
                    <rect x="0.5" y="1" width="97" height="23" rx="11.5" fill="#F0F2F4"/>
                    <rect x="0.5" y="1" width="97" height="23" rx="11.5" stroke="#D4D8DD"/>
                    <circle cx="12.0002" cy="12.5" r="2.66667" fill="#E3111F"/>
                    <path d="M29.798 17.5H23.05V7.756H29.658V9.296H24.646V11.774H28.958V13.3H24.646V15.96H29.798V17.5ZM31.3352 17.5V10.122H32.8192V11.298C33.0245 10.906 33.3232 10.5933 33.7152 10.36C34.1072 10.1173 34.5738 9.996 35.1152 9.996C36.0485 9.996 36.7625 10.3273 37.2572 10.99C37.7612 11.6527 38.0132 12.5253 38.0132 13.608V17.5H36.4032V13.664C36.4032 12.9547 36.2632 12.418 35.9832 12.054C35.7125 11.6807 35.3065 11.494 34.7652 11.494C34.2145 11.494 33.7712 11.6807 33.4352 12.054C33.1085 12.4273 32.9452 12.922 32.9452 13.538V17.5H31.3352ZM43.1431 17.612C42.4617 17.612 41.8457 17.4487 41.2951 17.122C40.7444 16.7953 40.3057 16.3427 39.9791 15.764C39.6617 15.1853 39.5031 14.5273 39.5031 13.79C39.5031 13.0807 39.6711 12.4367 40.0071 11.858C40.3431 11.2793 40.7911 10.8267 41.3511 10.5C41.9204 10.164 42.5411 9.996 43.2131 9.996C43.6144 9.996 43.9737 10.0427 44.2911 10.136C44.6177 10.22 44.9397 10.36 45.2571 10.556L44.8651 11.9C44.3891 11.62 43.8617 11.48 43.2831 11.48C42.6577 11.48 42.1444 11.69 41.7431 12.11C41.3417 12.53 41.1411 13.09 41.1411 13.79C41.1411 14.4993 41.3417 15.0687 41.7431 15.498C42.1444 15.9273 42.6484 16.142 43.2551 16.142C43.5817 16.142 43.8711 16.1 44.1231 16.016C44.3844 15.932 44.6504 15.8153 44.9211 15.666L45.3271 17.01C45.0004 17.2153 44.6644 17.3693 44.3191 17.472C43.9831 17.5653 43.5911 17.612 43.1431 17.612ZM49.9286 17.612C49.2006 17.612 48.5519 17.4487 47.9826 17.122C47.4132 16.786 46.9699 16.3287 46.6526 15.75C46.3352 15.1713 46.1766 14.518 46.1766 13.79C46.1766 13.09 46.3259 12.4507 46.6246 11.872C46.9232 11.2933 47.3339 10.836 47.8566 10.5C48.3886 10.164 48.9859 9.996 49.6486 9.996C50.6752 9.996 51.4779 10.3273 52.0566 10.99C52.6446 11.6433 52.9386 12.558 52.9386 13.734V14.322H47.7866C47.8892 14.882 48.1412 15.3347 48.5426 15.68C48.9439 16.016 49.4386 16.184 50.0266 16.184C50.8012 16.184 51.4872 16.016 52.0846 15.68L52.4066 16.982C51.7252 17.402 50.8992 17.612 49.9286 17.612ZM51.3426 13.09C51.3146 12.5393 51.1559 12.11 50.8666 11.802C50.5772 11.4847 50.1712 11.326 49.6486 11.326C49.1259 11.326 48.7012 11.4847 48.3746 11.802C48.0479 12.1193 47.8472 12.5487 47.7726 13.09H51.3426ZM54.5002 17.5V10.122H55.9842V11.298C56.1896 10.9247 56.4929 10.6213 56.8942 10.388C57.2956 10.1547 57.7716 10.038 58.3222 10.038C58.4436 10.038 58.5789 10.0473 58.7282 10.066C58.8869 10.0753 59.0036 10.094 59.0782 10.122L58.8262 11.648C58.5649 11.5827 58.3036 11.55 58.0422 11.55C57.5102 11.55 57.0529 11.7273 56.6702 12.082C56.2969 12.4367 56.1102 12.9313 56.1102 13.566V17.5H54.5002ZM60.5175 17.5V10.122H62.0015V11.298C62.2068 10.9247 62.5102 10.6213 62.9115 10.388C63.3128 10.1547 63.7888 10.038 64.3395 10.038C64.4608 10.038 64.5962 10.0473 64.7455 10.066C64.9042 10.0753 65.0208 10.094 65.0955 10.122L64.8435 11.648C64.5822 11.5827 64.3208 11.55 64.0595 11.55C63.5275 11.55 63.0702 11.7273 62.6875 12.082C62.3142 12.4367 62.1275 12.9313 62.1275 13.566V17.5H60.5175ZM68.8106 9.996C69.772 9.996 70.5186 10.262 71.0506 10.794C71.592 11.3167 71.8626 12.0633 71.8626 13.034V17.5H70.4066V16.366C70.1826 16.73 69.8606 17.0287 69.4406 17.262C69.03 17.4953 68.5446 17.612 67.9846 17.612C67.3313 17.612 66.804 17.4347 66.4026 17.08C66.0013 16.7253 65.8006 16.2493 65.8006 15.652C65.8006 15.092 65.9546 14.63 66.2626 14.266C66.5706 13.8927 67.0513 13.5987 67.7046 13.384C68.3673 13.1693 69.2446 13.0107 70.3366 12.908V12.838C70.3366 12.39 70.206 12.0447 69.9446 11.802C69.6926 11.55 69.296 11.424 68.7546 11.424C67.98 11.424 67.2053 11.6433 66.4306 12.082L66.0806 10.738C66.9673 10.2433 67.8773 9.996 68.8106 9.996ZM68.2926 16.352C68.6473 16.352 68.9833 16.2633 69.3006 16.086C69.618 15.9087 69.87 15.666 70.0566 15.358C70.2433 15.05 70.3366 14.7093 70.3366 14.336V14.056C69.31 14.14 68.5493 14.294 68.0546 14.518C67.5693 14.7327 67.3266 15.0453 67.3266 15.456C67.3266 15.736 67.4106 15.9553 67.5786 16.114C67.7466 16.2727 67.9846 16.352 68.2926 16.352ZM76.7508 17.612C76.1068 17.612 75.5235 17.458 75.0008 17.15C74.4875 16.8327 74.0862 16.3893 73.7968 15.82C73.5075 15.2507 73.3628 14.5973 73.3628 13.86C73.3628 13.1227 73.5075 12.46 73.7968 11.872C74.0955 11.284 74.5062 10.8267 75.0288 10.5C75.5515 10.1733 76.1348 10.01 76.7788 10.01C77.2735 10.01 77.7215 10.108 78.1228 10.304C78.5242 10.5 78.8508 10.7567 79.1028 11.074V7H80.6988V17.5H79.2148V16.268C78.9908 16.66 78.6642 16.982 78.2348 17.234C77.8055 17.486 77.3108 17.612 76.7508 17.612ZM76.9888 16.156C77.6048 16.156 78.1088 15.96 78.5008 15.568C78.9022 15.176 79.1028 14.6347 79.1028 13.944V13.706C79.1028 13.0153 78.9022 12.4693 78.5008 12.068C78.0995 11.6667 77.5955 11.466 76.9888 11.466C76.6342 11.466 76.3028 11.5593 75.9948 11.746C75.6962 11.9233 75.4535 12.1893 75.2668 12.544C75.0895 12.8987 75.0008 13.328 75.0008 13.832C75.0008 14.5693 75.1922 15.1433 75.5748 15.554C75.9575 15.9553 76.4288 16.156 76.9888 16.156ZM85.3295 9.996C86.2909 9.996 87.0375 10.262 87.5695 10.794C88.1109 11.3167 88.3815 12.0633 88.3815 13.034V17.5H86.9255V16.366C86.7015 16.73 86.3795 17.0287 85.9595 17.262C85.5489 17.4953 85.0635 17.612 84.5035 17.612C83.8502 17.612 83.3229 17.4347 82.9215 17.08C82.5202 16.7253 82.3195 16.2493 82.3195 15.652C82.3195 15.092 82.4735 14.63 82.7815 14.266C83.0895 13.8927 83.5702 13.5987 84.2235 13.384C84.8862 13.1693 85.7635 13.0107 86.8555 12.908V12.838C86.8555 12.39 86.7249 12.0447 86.4635 11.802C86.2115 11.55 85.8149 11.424 85.2735 11.424C84.4989 11.424 83.7242 11.6433 82.9495 12.082L82.5995 10.738C83.4862 10.2433 84.3962 9.996 85.3295 9.996ZM84.8115 16.352C85.1662 16.352 85.5022 16.2633 85.8195 16.086C86.1369 15.9087 86.3889 15.666 86.5755 15.358C86.7622 15.05 86.8555 14.7093 86.8555 14.336V14.056C85.8289 14.14 85.0682 14.294 84.5735 14.518C84.0882 14.7327 83.8455 15.0453 83.8455 15.456C83.8455 15.736 83.9295 15.9553 84.0975 16.114C84.2655 16.2727 84.5035 16.352 84.8115 16.352Z" fill="#E3111F"/>
                </svg>
                <span class="mensagemStatusEncerrada"> Essa demanda encontra-se Encerrada pelo CAD</span>
            </div>
            <!--Aprovada-->
            <div class="detalheStatusConsultaSolicitacao">
                <svg xmlns="http://www.w3.org/2000/svg" width="95" height="25" viewBox="0 0 95 25" fill="none">
                    <rect x="0.5" y="1" width="94" height="23" rx="11.5" fill="#F0F2F4"/>
                    <rect x="0.5" y="1" width="94" height="23" rx="11.5" stroke="#D4D8DD"/>
                    <circle cx="12.0002" cy="12.5" r="2.66667" fill="#0C8A00"/>
                    <path d="M24.03 17.5H22.322L26.018 7.756H27.908L31.604 17.5H29.84L28.972 15.12H24.884L24.03 17.5ZM26.914 9.394L25.36 13.762H28.496L26.914 9.394ZM32.9621 20.202V10.122H34.4461V11.326C34.6608 10.9527 34.9828 10.64 35.4121 10.388C35.8508 10.1267 36.3501 9.996 36.9101 9.996C37.5541 9.996 38.1328 10.1547 38.6461 10.472C39.1594 10.78 39.5608 11.2187 39.8501 11.788C40.1488 12.3573 40.2981 13.0107 40.2981 13.748C40.2981 14.4947 40.1488 15.1573 39.8501 15.736C39.5514 16.3147 39.1408 16.7673 38.6181 17.094C38.0954 17.4207 37.5121 17.584 36.8681 17.584C36.3734 17.584 35.9254 17.4907 35.5241 17.304C35.1321 17.108 34.8148 16.856 34.5721 16.548V20.202H32.9621ZM36.6721 16.128C37.0268 16.128 37.3534 16.0393 37.6521 15.862C37.9601 15.6847 38.2028 15.4187 38.3801 15.064C38.5668 14.7093 38.6601 14.2847 38.6601 13.79C38.6601 13.2953 38.5668 12.8753 38.3801 12.53C38.2028 12.1753 37.9648 11.9093 37.6661 11.732C37.3674 11.5547 37.0408 11.466 36.6861 11.466C36.0608 11.466 35.5521 11.662 35.1601 12.054C34.7681 12.446 34.5721 12.9873 34.5721 13.678V13.902C34.5721 14.602 34.7681 15.148 35.1601 15.54C35.5521 15.932 36.0561 16.128 36.6721 16.128ZM41.9188 17.5V10.122H43.4028V11.298C43.6082 10.9247 43.9115 10.6213 44.3128 10.388C44.7142 10.1547 45.1902 10.038 45.7408 10.038C45.8622 10.038 45.9975 10.0473 46.1468 10.066C46.3055 10.0753 46.4222 10.094 46.4968 10.122L46.2448 11.648C45.9835 11.5827 45.7222 11.55 45.4608 11.55C44.9288 11.55 44.4715 11.7273 44.0888 12.082C43.7155 12.4367 43.5288 12.9313 43.5288 13.566V17.5H41.9188ZM50.7626 17.612C50.0719 17.612 49.4372 17.444 48.8586 17.108C48.2892 16.772 47.8366 16.3147 47.5006 15.736C47.1739 15.148 47.0106 14.504 47.0106 13.804C47.0106 13.104 47.1739 12.4647 47.5006 11.886C47.8366 11.298 48.2892 10.836 48.8586 10.5C49.4372 10.164 50.0719 9.996 50.7626 9.996C51.4532 9.996 52.0832 10.164 52.6526 10.5C53.2312 10.836 53.6839 11.298 54.0106 11.886C54.3466 12.4647 54.5146 13.104 54.5146 13.804C54.5146 14.504 54.3466 15.148 54.0106 15.736C53.6839 16.3147 53.2312 16.772 52.6526 17.108C52.0832 17.444 51.4532 17.612 50.7626 17.612ZM50.7626 16.142C51.1639 16.142 51.5232 16.044 51.8406 15.848C52.1672 15.6427 52.4192 15.3627 52.5966 15.008C52.7832 14.644 52.8766 14.2427 52.8766 13.804C52.8766 13.3653 52.7832 12.9687 52.5966 12.614C52.4192 12.2593 52.1672 11.984 51.8406 11.788C51.5232 11.5827 51.1639 11.48 50.7626 11.48C50.1466 11.48 49.6379 11.6993 49.2366 12.138C48.8446 12.5767 48.6486 13.132 48.6486 13.804C48.6486 14.476 48.8446 15.036 49.2366 15.484C49.6379 15.9227 50.1466 16.142 50.7626 16.142ZM59.6667 17.5H57.7907L54.8507 10.122H56.6707L58.7707 15.834L60.8427 10.122H62.6067L59.6667 17.5ZM66.225 9.996C67.1863 9.996 67.933 10.262 68.465 10.794C69.0063 11.3167 69.277 12.0633 69.277 13.034V17.5H67.821V16.366C67.597 16.73 67.275 17.0287 66.855 17.262C66.4443 17.4953 65.959 17.612 65.399 17.612C64.7457 17.612 64.2183 17.4347 63.817 17.08C63.4157 16.7253 63.215 16.2493 63.215 15.652C63.215 15.092 63.369 14.63 63.677 14.266C63.985 13.8927 64.4657 13.5987 65.119 13.384C65.7817 13.1693 66.659 13.0107 67.751 12.908V12.838C67.751 12.39 67.6203 12.0447 67.359 11.802C67.107 11.55 66.7103 11.424 66.169 11.424C65.3943 11.424 64.6197 11.6433 63.845 12.082L63.495 10.738C64.3817 10.2433 65.2917 9.996 66.225 9.996ZM65.707 16.352C66.0617 16.352 66.3977 16.2633 66.715 16.086C67.0323 15.9087 67.2843 15.666 67.471 15.358C67.6577 15.05 67.751 14.7093 67.751 14.336V14.056C66.7243 14.14 65.9637 14.294 65.469 14.518C64.9837 14.7327 64.741 15.0453 64.741 15.456C64.741 15.736 64.825 15.9553 64.993 16.114C65.161 16.2727 65.399 16.352 65.707 16.352ZM74.1652 17.612C73.5212 17.612 72.9379 17.458 72.4152 17.15C71.9019 16.8327 71.5005 16.3893 71.2112 15.82C70.9219 15.2507 70.7772 14.5973 70.7772 13.86C70.7772 13.1227 70.9219 12.46 71.2112 11.872C71.5099 11.284 71.9205 10.8267 72.4432 10.5C72.9659 10.1733 73.5492 10.01 74.1932 10.01C74.6879 10.01 75.1359 10.108 75.5372 10.304C75.9385 10.5 76.2652 10.7567 76.5172 11.074V7H78.1132V17.5H76.6292V16.268C76.4052 16.66 76.0785 16.982 75.6492 17.234C75.2199 17.486 74.7252 17.612 74.1652 17.612ZM74.4032 16.156C75.0192 16.156 75.5232 15.96 75.9152 15.568C76.3165 15.176 76.5172 14.6347 76.5172 13.944V13.706C76.5172 13.0153 76.3165 12.4693 75.9152 12.068C75.5139 11.6667 75.0099 11.466 74.4032 11.466C74.0485 11.466 73.7172 11.5593 73.4092 11.746C73.1105 11.9233 72.8679 12.1893 72.6812 12.544C72.5039 12.8987 72.4152 13.328 72.4152 13.832C72.4152 14.5693 72.6065 15.1433 72.9892 15.554C73.3719 15.9553 73.8432 16.156 74.4032 16.156ZM82.7439 9.996C83.7053 9.996 84.4519 10.262 84.9839 10.794C85.5253 11.3167 85.7959 12.0633 85.7959 13.034V17.5H84.3399V16.366C84.1159 16.73 83.7939 17.0287 83.3739 17.262C82.9633 17.4953 82.4779 17.612 81.9179 17.612C81.2646 17.612 80.7373 17.4347 80.3359 17.08C79.9346 16.7253 79.7339 16.2493 79.7339 15.652C79.7339 15.092 79.8879 14.63 80.1959 14.266C80.5039 13.8927 80.9846 13.5987 81.6379 13.384C82.3006 13.1693 83.1779 13.0107 84.2699 12.908V12.838C84.2699 12.39 84.1393 12.0447 83.8779 11.802C83.6259 11.55 83.2293 11.424 82.6879 11.424C81.9133 11.424 81.1386 11.6433 80.3639 12.082L80.0139 10.738C80.9006 10.2433 81.8106 9.996 82.7439 9.996ZM82.2259 16.352C82.5806 16.352 82.9166 16.2633 83.2339 16.086C83.5513 15.9087 83.8033 15.666 83.9899 15.358C84.1766 15.05 84.2699 14.7093 84.2699 14.336V14.056C83.2433 14.14 82.4826 14.294 81.9879 14.518C81.5026 14.7327 81.2599 15.0453 81.2599 15.456C81.2599 15.736 81.3439 15.9553 81.5119 16.114C81.6799 16.2727 81.9179 16.352 82.2259 16.352Z" fill="#0C8A00"/>
                </svg>
                <span class="mensagemStatusAprovada"> Sua solicitação foi aprovada</span>
            </div>
            <!--Nova-->
            <div class="detalheStatusConsultaSolicitacao">
                <svg xmlns="http://www.w3.org/2000/svg" width="104" height="25" viewBox="0 0 104 25" fill="none">
                    <rect x="0.5" y="1" width="103" height="23" rx="11.5" fill="#F0F2F4"/>
                    <rect x="0.5" y="1" width="103" height="23" rx="11.5" stroke="#D4D8DD"/>
                    <circle cx="31.9997" cy="12.5" r="2.66667" fill="#4668FF"/>
                    <path d="M44.66 17.5H43.05V7.756H44.562L49.476 14.7V7.756H51.086V17.5H49.56L44.66 10.542V17.5ZM56.5269 17.612C55.8362 17.612 55.2015 17.444 54.6229 17.108C54.0535 16.772 53.6009 16.3147 53.2649 15.736C52.9382 15.148 52.7749 14.504 52.7749 13.804C52.7749 13.104 52.9382 12.4647 53.2649 11.886C53.6009 11.298 54.0535 10.836 54.6229 10.5C55.2015 10.164 55.8362 9.996 56.5269 9.996C57.2175 9.996 57.8475 10.164 58.4169 10.5C58.9955 10.836 59.4482 11.298 59.7749 11.886C60.1109 12.4647 60.2789 13.104 60.2789 13.804C60.2789 14.504 60.1109 15.148 59.7749 15.736C59.4482 16.3147 58.9955 16.772 58.4169 17.108C57.8475 17.444 57.2175 17.612 56.5269 17.612ZM56.5269 16.142C56.9282 16.142 57.2875 16.044 57.6049 15.848C57.9315 15.6427 58.1835 15.3627 58.3609 15.008C58.5475 14.644 58.6409 14.2427 58.6409 13.804C58.6409 13.3653 58.5475 12.9687 58.3609 12.614C58.1835 12.2593 57.9315 11.984 57.6049 11.788C57.2875 11.5827 56.9282 11.48 56.5269 11.48C55.9109 11.48 55.4022 11.6993 55.0009 12.138C54.6089 12.5767 54.4129 13.132 54.4129 13.804C54.4129 14.476 54.6089 15.036 55.0009 15.484C55.4022 15.9227 55.9109 16.142 56.5269 16.142ZM65.431 17.5H63.555L60.615 10.122H62.435L64.535 15.834L66.607 10.122H68.371L65.431 17.5ZM71.9893 9.996C72.9506 9.996 73.6973 10.262 74.2293 10.794C74.7706 11.3167 75.0413 12.0633 75.0413 13.034V17.5H73.5853V16.366C73.3613 16.73 73.0393 17.0287 72.6193 17.262C72.2086 17.4953 71.7233 17.612 71.1633 17.612C70.51 17.612 69.9826 17.4347 69.5813 17.08C69.18 16.7253 68.9793 16.2493 68.9793 15.652C68.9793 15.092 69.1333 14.63 69.4413 14.266C69.7493 13.8927 70.23 13.5987 70.8833 13.384C71.546 13.1693 72.4233 13.0107 73.5153 12.908V12.838C73.5153 12.39 73.3846 12.0447 73.1233 11.802C72.8713 11.55 72.4746 11.424 71.9333 11.424C71.1586 11.424 70.384 11.6433 69.6093 12.082L69.2593 10.738C70.146 10.2433 71.056 9.996 71.9893 9.996ZM71.4713 16.352C71.826 16.352 72.162 16.2633 72.4793 16.086C72.7966 15.9087 73.0486 15.666 73.2353 15.358C73.422 15.05 73.5153 14.7093 73.5153 14.336V14.056C72.4886 14.14 71.728 14.294 71.2333 14.518C70.748 14.7327 70.5053 15.0453 70.5053 15.456C70.5053 15.736 70.5893 15.9553 70.7573 16.114C70.9253 16.2727 71.1633 16.352 71.4713 16.352Z" fill="#4668FF"/>
                </svg>
                <span class="mensagemStatusNova"> Nova demanda, mude o Status para prosseguir com a avaliação</span>
            </div>
            <!--Em Análise-->
            <div class="detalheStatusConsultaSolicitacao">
                <svg xmlns="http://www.w3.org/2000/svg" width="104" height="25" viewBox="0 0 104 25" fill="none">
                    <rect x="0.5" y="1" width="103" height="23" rx="11.5" fill="#F0F2F4"/>
                    <rect x="0.5" y="1" width="103" height="23" rx="11.5" stroke="#D4D8DD"/>
                    <circle cx="11.9997" cy="12.5002" r="2.66667" fill="#FFB31A"/>
                    <path d="M29.798 17.5H23.05V7.756H29.658V9.296H24.646V11.774H28.958V13.3H24.646V15.96H29.798V17.5ZM31.3352 17.5V10.122H32.8192V11.298C33.0245 10.906 33.3138 10.5933 33.6872 10.36C34.0605 10.1173 34.4805 9.996 34.9472 9.996C35.4885 9.996 35.9458 10.1127 36.3192 10.346C36.7018 10.57 36.9912 10.8967 37.1872 11.326C37.7472 10.4393 38.5498 9.996 39.5952 9.996C40.4912 9.996 41.1632 10.3087 41.6112 10.934C42.0592 11.5593 42.2832 12.418 42.2832 13.51V17.5H40.6872V13.524C40.6872 12.8893 40.5892 12.3947 40.3932 12.04C40.1972 11.676 39.8285 11.494 39.2872 11.494C38.7925 11.494 38.3865 11.6573 38.0692 11.984C37.7612 12.3013 37.6072 12.7493 37.6072 13.328V17.5H36.0112V13.538C36.0112 12.9127 35.9132 12.418 35.7172 12.054C35.5212 11.6807 35.1572 11.494 34.6252 11.494C34.1305 11.494 33.7245 11.6853 33.4072 12.068C33.0992 12.4413 32.9452 12.9313 32.9452 13.538V17.5H31.3352ZM48.4802 17.5H46.7722L50.4682 7.756H52.3582L56.0542 17.5H54.2902L53.4222 15.12H49.3342L48.4802 17.5ZM51.3642 9.394L49.8102 13.762H52.9462L51.3642 9.394ZM57.4123 17.5V10.122H58.8963V11.298C59.1017 10.906 59.4003 10.5933 59.7923 10.36C60.1843 10.1173 60.651 9.996 61.1923 9.996C62.1257 9.996 62.8397 10.3273 63.3343 10.99C63.8383 11.6527 64.0903 12.5253 64.0903 13.608V17.5H62.4803V13.664C62.4803 12.9547 62.3403 12.418 62.0603 12.054C61.7897 11.6807 61.3837 11.494 60.8423 11.494C60.2917 11.494 59.8483 11.6807 59.5123 12.054C59.1857 12.4273 59.0223 12.922 59.0223 13.538V17.5H57.4123ZM68.5902 9.996C69.5516 9.996 70.2982 10.262 70.8302 10.794C71.3716 11.3167 71.6422 12.0633 71.6422 13.034V17.5H70.1862V16.366C69.9622 16.73 69.6402 17.0287 69.2202 17.262C68.8096 17.4953 68.3242 17.612 67.7642 17.612C67.1109 17.612 66.5836 17.4347 66.1822 17.08C65.7809 16.7253 65.5802 16.2493 65.5802 15.652C65.5802 15.092 65.7342 14.63 66.0422 14.266C66.3502 13.8927 66.8309 13.5987 67.4842 13.384C68.1469 13.1693 69.0242 13.0107 70.1162 12.908V12.838C70.1162 12.39 69.9856 12.0447 69.7242 11.802C69.4722 11.55 69.0756 11.424 68.5342 11.424C67.7596 11.424 66.9849 11.6433 66.2102 12.082L65.8602 10.738C66.7469 10.2433 67.6569 9.996 68.5902 9.996ZM68.0722 16.352C68.4269 16.352 68.7629 16.2633 69.0802 16.086C69.3976 15.9087 69.6496 15.666 69.8362 15.358C70.0229 15.05 70.1162 14.7093 70.1162 14.336V14.056C69.0896 14.14 68.3289 14.294 67.8342 14.518C67.3489 14.7327 67.1062 15.0453 67.1062 15.456C67.1062 15.736 67.1902 15.9553 67.3582 16.114C67.5262 16.2727 67.7642 16.352 68.0722 16.352ZM69.2342 9.058H67.7362L69.5842 6.762H71.5722L69.2342 9.058ZM75.8864 17.612C75.1304 17.612 74.5471 17.374 74.1364 16.898C73.7351 16.422 73.5344 15.7267 73.5344 14.812V7H75.1304V14.84C75.1304 15.26 75.2098 15.582 75.3684 15.806C75.5271 16.0207 75.7511 16.128 76.0404 16.128C76.2084 16.128 76.3531 16.114 76.4744 16.086C76.5958 16.0487 76.7264 15.9927 76.8664 15.918L77.2724 17.22C76.8711 17.4813 76.4091 17.612 75.8864 17.612ZM80.0956 17.5H78.4856V10.122H80.0956V17.5ZM79.2976 9.058C79.0083 9.058 78.7656 8.96467 78.5696 8.778C78.3736 8.582 78.2756 8.33933 78.2756 8.05C78.2756 7.77 78.3736 7.532 78.5696 7.336C78.7656 7.13067 79.0083 7.028 79.2976 7.028C79.5963 7.028 79.839 7.126 80.0256 7.322C80.2216 7.50867 80.3196 7.742 80.3196 8.022C80.3196 8.32067 80.2216 8.568 80.0256 8.764C79.839 8.96 79.5963 9.058 79.2976 9.058ZM84.3083 17.612C83.8416 17.612 83.3563 17.542 82.8523 17.402C82.3483 17.2527 81.947 17.0847 81.6483 16.898L82.0543 15.596C82.353 15.764 82.7123 15.9087 83.1323 16.03C83.5523 16.1513 83.9723 16.212 84.3923 16.212C84.747 16.212 85.0223 16.156 85.2183 16.044C85.4236 15.9227 85.5263 15.7407 85.5263 15.498C85.5263 15.246 85.4096 15.05 85.1763 14.91C84.9523 14.7607 84.5556 14.588 83.9863 14.392C83.2956 14.1493 82.7823 13.86 82.4463 13.524C82.1196 13.188 81.9563 12.7353 81.9563 12.166C81.9563 11.718 82.073 11.3307 82.3063 11.004C82.549 10.6773 82.871 10.43 83.2723 10.262C83.683 10.0847 84.131 9.996 84.6163 9.996C85.0176 9.996 85.419 10.0567 85.8203 10.178C86.2216 10.2993 86.5716 10.458 86.8703 10.654L86.4643 11.9C85.8576 11.564 85.251 11.396 84.6443 11.396C84.3083 11.396 84.033 11.4567 83.8183 11.578C83.6036 11.69 83.4963 11.872 83.4963 12.124C83.4963 12.3387 83.5943 12.5113 83.7903 12.642C83.9956 12.7727 84.313 12.9173 84.7423 13.076C85.5823 13.3933 86.1843 13.72 86.5483 14.056C86.9123 14.392 87.0943 14.8587 87.0943 15.456C87.0943 16.1373 86.8376 16.6693 86.3243 17.052C85.8203 17.4253 85.1483 17.612 84.3083 17.612ZM91.9794 17.612C91.2514 17.612 90.6028 17.4487 90.0334 17.122C89.4641 16.786 89.0208 16.3287 88.7034 15.75C88.3861 15.1713 88.2274 14.518 88.2274 13.79C88.2274 13.09 88.3768 12.4507 88.6754 11.872C88.9741 11.2933 89.3848 10.836 89.9074 10.5C90.4394 10.164 91.0368 9.996 91.6994 9.996C92.7261 9.996 93.5288 10.3273 94.1074 10.99C94.6954 11.6433 94.9894 12.558 94.9894 13.734V14.322H89.8374C89.9401 14.882 90.1921 15.3347 90.5934 15.68C90.9948 16.016 91.4894 16.184 92.0774 16.184C92.8521 16.184 93.5381 16.016 94.1354 15.68L94.4574 16.982C93.7761 17.402 92.9501 17.612 91.9794 17.612ZM93.3934 13.09C93.3654 12.5393 93.2068 12.11 92.9174 11.802C92.6281 11.4847 92.2221 11.326 91.6994 11.326C91.1768 11.326 90.7521 11.4847 90.4254 11.802C90.0988 12.1193 89.8981 12.5487 89.8234 13.09H93.3934Z" fill="#AD5F00"/>
                </svg>
                <span class="mensagemStatusAnalise"> Essa demanda está sendo avaliada, mude o Status para prosseguir</span>
            </div>


        </div>
        <div class= "linhaDivisoria" style = "margin-top:5%;"></div>
        <div class="selecaoStatus">
            <div>
                <span class= "itemFormulario">Status</span>
                <select class="selectStatusVisaoCad" id="statusSolicitacao">
					<option value="0">Selecione</option>
    				<option value="nova">Nova</option>
				    <option value="emAnalise">Em análise</option>
    				<option value="aprovada">Aprovada</option>
    				<option value="encerrada">Encerrada</option>
                </select>
            </div>
        </div>
        <div class="areaResumoDemanda">
            <span class="itemFormulario">Resumo da demanda</span><br><br>
            <div class=textoResumoDemanda>
                Lorem ipsum dolor sit amet consectetur. Scelerisque nisl sit volutpat nunc ipsum bibendum ultricies. Ut morbi pellentesque urna scelerisque non. Tempus suspendisse euismod ullamcorper congue et vitae id ultrices viverra. Ornare sit congue at lorem ut sit urna duis vestibulum. Semper sagittis phasellus aliquam enim magna tincidunt. Lectus elementum tortor et auctor. Tincidunt molestie ullamcorper dui at egestas tellus nascetur pellentesque fames. Vestibulum nunc enim amet nam porttitor elit eget. Elementum nunc neque mauris massa ut. 
            </div>    

        </div>
        <div class="divComentarioCadSolicitacaoEncerrada">
                                <div class="iconeComentarioCAD">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="26" viewBox="0 0 25 26" fill="none">
                                    <path d="M20.3128 10.0209H21.9611V12.007H20.6308L17.0663 14.7875C16.8973 14.9186 16.6958 14.9862 16.4934 14.9862C16.2401 14.9862 15.9973 14.8815 15.8182 14.6953C15.6391 14.5091 15.5385 14.2565 15.5385 13.9931V12.007H14.5837V10.0209H16.4934C16.7466 10.0209 16.9895 10.1255 17.1686 10.3117C17.3476 10.498 17.4482 10.7506 17.4482 11.0139V12.007L19.7399 10.2195C19.9052 10.0906 20.1062 10.0209 20.3128 10.0209Z" fill="#646464"></path>
                                    <path d="M20.8337 10.0209H22.05V3.06949H12.5014V6.04865H10.5916V3.06949C10.5916 1.97414 11.4482 1.08337 12.5014 1.08337H22.05C23.1032 1.08337 23.9597 1.97414 23.9597 3.06949V10.0209C23.9597 11.1152 23.1032 12.007 22.05 12.007H20.8337V10.0209Z" fill="#646464"></path>
                                    <path d="M10.5941 6.6445V5.52504H12.5038V6.6445H10.5941Z" fill="#646464"></path>
                                    <path d="M9.37533 16.25C11.6722 16.25 13.542 14.3055 13.542 11.9167C13.542 9.52796 11.6722 7.58337 9.37533 7.58337C7.07845 7.58337 5.20866 9.52796 5.20866 11.9167C5.20866 14.3055 7.07845 16.25 9.37533 16.25Z" fill="#646464"></path>
                                    <path d="M9.37533 17.3334C4.46803 17.3334 1.04199 20.006 1.04199 23.8334V24.9167H17.7087V23.8334C17.7087 20.006 14.2826 17.3334 9.37533 17.3334Z" fill="#646464"></path>
                                </svg>
                                </div>
                                <div class="textoComentarioCAD">
                                    <span class="tituloComentarioCAD">Comentário do CAD: </span><br>
                                    <span class="textoComentarioCAD"> A transação já está disponível nos canais tradicionais de internet  banking, aplicativo móvel do Banco do Brasil, e nos terminais de  autoatendimento</span>
                                </div>
                            </div>
        <div class="nestComentariosVisaoCad">
            <div class="divTituloSecaoDadosDaSolicitacao iconeSetaComentariosVisaoCad">
                Histórico de comentários
                <!--Icon chevron up-->
                <i class="fa fa-chevron-down iconeSetaSquad22" aria-hidden="true"></i>
            </div>   
            <div class="divAreaComentariosVisaoCad">
                <div class= "comentarioVisaoCad">
                    <div class="barraTopoComentarioCad">
                        <span class="autorComentarioVisaoCad">F0000000 Primeiro comentário</span> 
                        <span class= "dataHoraComentarioVisaoCad">17/01/2025 14:05</span>    
                    </div>
                    <div class="textoComentarioVisaoCad">Semper sagittis phasellus aliquam enim magna tincidunt. Lectus elementum tortor et auctor. Tincidunt molestie ullamcorper dui at egestas tellus nascetur pellentesque fames. Vestibulum nunc enim amet nam porttitor elit eget. Elementum nunc neque mauris massa ut. 
                    Semper sagittis phasellus aliquam enim magna tincidunt. Lectus elementum tortor et auctor. Tincidunt molestie ullamcorper dui at egestas tellus nascetur pellentesque fames. Vestibulum nunc enim amet nam porttitor elit eget. Elementum nunc neque mauris massa ut. 
                    Semper sagittis phasellus aliquam enim magna tincidunt. Lectus elementum tortor et auctor. Tincidunt molestie ullamcorper dui at egestas tellus nascetur pellentesque fames. Vestibulum nunc enim amet nam porttitor elit eget. Elementum nunc neque mauris massa ut.     
                    </div>
                </div>
                <div class= "comentarioVisaoCad">
                    <div class="barraTopoComentarioCad">
                        <span class="autorComentarioVisaoCad">F0000000 Segundo comentário</span> 
                        <span class= "dataHoraComentarioVisaoCad">17/01/2025 14:05</span>    
                    </div>
                    <div class="textoComentarioVisaoCad">Semper sagittis phasellus aliquam enim magna tincidunt. Lectus elementum tortor et auctor. Tincidunt molestie ullamcorper dui at egestas tellus nascetur pellentesque fames. Vestibulum nunc enim amet nam porttitor elit eget. Elementum nunc neque mauris massa ut. 
                    Semper sagittis phasellus aliquam enim magna tincidunt. Lectus elementum tortor et auctor. Tincidunt molestie ullamcorper dui at egestas tellus nascetur pellentesque fames. Vestibulum nunc enim amet nam porttitor elit eget. Elementum nunc neque mauris massa ut. 
                    Semper sagittis phasellus aliquam enim magna tincidunt. Lectus elementum tortor et auctor. Tincidunt molestie ullamcorper dui at egestas tellus nascetur pellentesque fames. Vestibulum nunc enim amet nam porttitor elit eget. Elementum nunc neque mauris massa ut.     
                    </div>
                </div>
            </div> 
        </div>
        <div class="nestDadosSolicitacaoVisaoCad">   
            <div class="divTituloSecaoDadosDaSolicitacao" id="iconeSetaDadosSolicitacaoVisaoCad">
                Dados da solicitação
                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                <!--<i class="fa fa-chevron-up" aria-hidden="true" ></i>-->
            </div> 
            
            <div class="divDadosdaSolicitacao" id = "divDadosdaSolicitacaoVisaoCad">  

            </div>
        </div>

    </div>
</div>
