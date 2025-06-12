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
<div class="conteudoSolicitacoes">
    <div class="divTabelaSolicitacoes" style="width: 75%; margin: -2% 0 0 12.5%; display: inline-flex; flex-direction: column; padding: 1rem 4rem; background: white; border-radius: 30px; justify-content: center; align-items: center;">
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
                            <input type="text" class="inputPesquisaNumeroSolicitacao itemPesquisaSolicitacao" attr-campoAlterado="0" attr-nomeCampoBd = "a.id" id="pesquisaNumeroSolicitacao" placeholder="ID Solicitação" style="flex: 1 1 0; background-color: #F0F2F4; font-size: 16px; font-weight: 400; line-height: 20px; letter-spacing: 0.08px; word-wrap: break-word; border: none;">
                        </div>
                    </div>

                    <div class="campoPesquisaSolicitacao">
                        <div style="position: relative">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </div>
                        <div class="divInputSolicitacoes">
                            <input type="text" class="inputPesquisaProdutoSolicitacao itemPesquisaSolicitacao" attr-campoAlterado="0" attr-nomeCampoBd = "a.tema" id="pesquisaProdutoSolicitacao" placeholder="Produto" style="flex: 1 1 0; background-color: #F0F2F4; font-size: 16px; font-weight: 400; line-height: 20px; letter-spacing: 0.08px; word-wrap: break-word; border: none;">
                        </div>
                    </div>

                    <div class="campoPesquisaSolicitacao">
                        <div style="position: relative">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </div>
                        <div class="divInputSolicitacoes">
                            <input type="text" class="inputPesquisaDependenciaSolicitacao itemPesquisaSolicitacao" attr-campoAlterado="0" attr-nomeCampoBd = "a.dependencia" id="pesquisaDependenciaSolicitacao" placeholder="Dependência" style="flex: 1 1 0; background-color: #F0F2F4; font-size: 16px; font-weight: 400; line-height: 20px; letter-spacing: 0.08px; word-wrap: break-word; border: none;">
                        </div>
                    </div>

                    <div class="campoPesquisaSolicitacao">
                        <select name="selectStatusSolicitacao" id="campoStatusSolicitacao" class="selectFiltroPesquisa itemPesquisaSolicitacao" attr-nomeCampoBd = "a.codStatus" attr-campoAlterado= "0" style="width: 100%; background-color: #F0F2F4; border: none; color: #6C7077;">
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
</div>