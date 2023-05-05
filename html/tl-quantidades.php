<?php $refresh = 0;
include_once("../html/navbar.php"); ?>
<div class=" quantidames-- "></div>
<?php
$QuantidadePO = $conexao->prepare("SELECT count(cod) AS QTD FROM tabela_orcamentos WHERE data_emissao >= '2019-01-01' AND data_emissao <= '2019-12-31'");
$QuantidadePO->execute();
$i = 0;
if ($linha = $QuantidadePO->fetch(PDO::FETCH_ASSOC)) {
    $QtdPo = $linha['QTD'];
}
$QuantidadePO = $conexao->prepare("SELECT count(cod) AS QTD FROM tabela_orcamentos WHERE data_emissao >= '2020-01-01' AND data_emissao <= '2020-12-31'");
$QuantidadePO->execute();
$i = 0;
if ($linha = $QuantidadePO->fetch(PDO::FETCH_ASSOC)) {
    $QtdPo1 = $linha['QTD'];
}
$QuantidadePO = $conexao->prepare("SELECT count(cod) AS QTD FROM tabela_orcamentos WHERE data_emissao >= '2021-01-01' AND data_emissao <= '2021-12-31'");
$QuantidadePO->execute();
$i = 0;
if ($linha = $QuantidadePO->fetch(PDO::FETCH_ASSOC)) {
    $QtdPo2 = $linha['QTD'];
}
$QuantidadePO = $conexao->prepare("SELECT count(cod) AS QTD FROM tabela_orcamentos WHERE data_emissao >= '2022-01-01' AND data_emissao <= '2022-12-31'");
$QuantidadePO->execute();
$i = 0;
if ($linha = $QuantidadePO->fetch(PDO::FETCH_ASSOC)) {
    $QtdPo3 = $linha['QTD'];
}
$QuantidadePO = $conexao->prepare("SELECT count(cod) AS QTD FROM tabela_orcamentos WHERE data_emissao >= '2023-01-01' AND data_emissao <= '2023-12-31'");
$QuantidadePO->execute();
$i = 0;
if ($linha = $QuantidadePO->fetch(PDO::FETCH_ASSOC)) {
    $QtdPo4 = $linha['QTD'];
}
$QuantidadePP = $conexao->prepare("SELECT count(cod) AS QTD FROM tabela_ordens_producao WHERE status != '13' AND data_emissao >= '2019-01-01' AND data_emissao <= '2019-12-31'");
$QuantidadePP->execute();
$i = 0;
if ($linha = $QuantidadePP->fetch(PDO::FETCH_ASSOC)) {
    $QtdPP = $linha['QTD'];
}
$QuantidadePP = $conexao->prepare("SELECT count(cod) AS QTD FROM tabela_ordens_producao  WHERE status != '13' AND data_emissao >= '2020-01-01' AND data_emissao <= '2020-12-31'");
$QuantidadePP->execute();
$i = 0;
if ($linha = $QuantidadePP->fetch(PDO::FETCH_ASSOC)) {
    $QtdPP1 = $linha['QTD'];
}
$QuantidadePP = $conexao->prepare("SELECT count(cod) AS QTD FROM tabela_ordens_producao  WHERE status != '13' AND data_emissao >= '2021-01-01' AND data_emissao <= '2021-12-31'");
$QuantidadePP->execute();
$i = 0;
if ($linha = $QuantidadePP->fetch(PDO::FETCH_ASSOC)) {
    $QtdPP2 = $linha['QTD'];
}
$QuantidadePP = $conexao->prepare("SELECT count(cod) AS QTD FROM tabela_ordens_producao WHERE status != '13' AND data_emissao >= '2022-01-01' AND data_emissao <= '2022-12-31'");
$QuantidadePP->execute();
$i = 0;
if ($linha = $QuantidadePP->fetch(PDO::FETCH_ASSOC)) {
    $QtdPP3 = $linha['QTD'];
}
$QuantidadePP = $conexao->prepare("SELECT count(cod) AS QTD FROM tabela_ordens_producao  WHERE status != '13' AND data_emissao >= '2023-01-01' AND data_emissao <= '2023-12-31'");
$QuantidadePP->execute();
$i = 0;
if ($linha = $QuantidadePP->fetch(PDO::FETCH_ASSOC)) {
    $QtdPP4 = $linha['QTD'];
}
?>
<div class="col-12">
    <div class="card">
        <h5 class="card-header">Dados Quantitativos dos Indicadores de Produção.</h5>
        <div class="card-body">
            <p class="demo-inline-spacing">
            </p>
            <div class="row">
                <div class="col-12 col-md-6 mb-2 mb-md-0">
                    <div class="multi-collapse" id="multiCollapseExample1">
                        <div class="d-grid d-sm-flex p-3 border">
                            <!-- <img src="../assets/img/elements/2.jpg" alt="collapse-image" height="125" class="me-4 mb-sm-0 mb-2" /> -->
                               
                            <span>
                                DIVISÃO COMERCIAL<br>Quantidade de Propostas de Orçamento
                                <br>
                                <div class="row">
                                    <div class="col-10">
                                        <div class="card">

                                            <div class="table-responsive text-nowrap">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>ANO</th>
                                                            <th>QUANTIDADE</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                        <tr>
                                                            <td><strong>2019</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= $QtdPo ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2020</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= $QtdPo1 ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2021</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= $QtdPo2 ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2022</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= $QtdPo3 ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2023</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= $QtdPo4 ?>
                                                                </span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-6">
                    <div class="multi-collapse" id="multiCollapseExample2">
                        <div class="d-grid d-sm-flex p-3 border">
                            <!-- <img src="../assets/img/elements/3.jpg" alt="collapse-image" height="125"class="me-4 mb-sm-0 mb-2" /> -->
                                
                            <span>
                            DIVISÃO PRODUÇÃO<br>Quantidade de Ordens de Produção 
                                <br>
                                <div class="row">
                                    <div class="col-10">
                                        <div class="card">

                                            <div class="table-responsive text-nowrap">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>ANO</th>
                                                            <th>QUANTIDADE</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                        <tr>
                                                            <td><strong>2019</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= $QtdPP ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2020</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= $QtdPP1 ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2021</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= $QtdPP2 ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2022</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= $QtdPP3 ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2023</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= $QtdPP4 ?>
                                                                </span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php include_once("../html/navbar-dow.php"); ?>