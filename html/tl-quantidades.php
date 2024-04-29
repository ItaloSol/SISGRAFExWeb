<?php $refresh = 0;
include_once("../html/navbar.php"); ?>
<div class="quantidamess"></div>
<?php
$Ano = date('Y');
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
$QuantidadePO = $conexao->prepare("SELECT count(cod) AS QTD FROM tabela_orcamentos WHERE data_emissao >= '2024-01-01' AND data_emissao <= '2024-12-31'");
$QuantidadePO->execute();
$i = 0;
if ($linha = $QuantidadePO->fetch(PDO::FETCH_ASSOC)) {
    $QtdPo5 = $linha['QTD'];
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
$QuantidadePP = $conexao->prepare("SELECT count(cod) AS QTD FROM tabela_ordens_producao  WHERE status != '13' AND data_emissao >= '2024-01-01' AND data_emissao <= '2024-12-31'");
$QuantidadePP->execute();
$i = 0;
if ($linha = $QuantidadePP->fetch(PDO::FETCH_ASSOC)) {
    $QtdPP5 = $linha['QTD'];
}
$QuantidadeBLOCO = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  (  top.data_entrega >= '2020-01-01' AND top.data_entrega <= '2020-12-31') AND  p.TIPO = 'BLOCO';");
$QuantidadeBLOCO->execute();
$i = 0;
if ($linha = $QuantidadeBLOCO->fetch(PDO::FETCH_ASSOC)) {
    $Qtdbloo4 = $linha['QTD'];
}
$QuantidadeBLOCO = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  ( top.data_entrega >= '2019-01-01' AND top.data_entrega <= '2019-12-31' ) AND  p.TIPO = 'BLOCO';");
$QuantidadeBLOCO->execute();
$i = 0;
if ($linha = $QuantidadeBLOCO->fetch(PDO::FETCH_ASSOC)) {
    $Qtdbloo1 = $linha['QTD'];
}
$QuantidadeBLOCO = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  ( top.data_entrega >= '2021-01-01' AND top.data_entrega <= '2021-12-31' ) AND  p.TIPO = 'BLOCO';");
$QuantidadeBLOCO->execute();
$i = 0;
if ($linha = $QuantidadeBLOCO->fetch(PDO::FETCH_ASSOC)) {
    $Qtdbloo2 = $linha['QTD'];
}
$QuantidadeBLOCO = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  ( top.data_entrega >= '2022-01-01' AND top.data_entrega <= '2022-12-31' ) AND  p.TIPO = 'BLOCO';");
$QuantidadeBLOCO->execute();
$i = 0;
if ($linha = $QuantidadeBLOCO->fetch(PDO::FETCH_ASSOC)) {
    $Qtdbloo3 = $linha['QTD'];
}
$QuantidadeBLOCO = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  ( top.data_entrega >= '2023-01-01' AND top.data_entrega <= '2023-12-31') AND   p.TIPO = 'BLOCO';");
$QuantidadeBLOCO->execute();
$i = 0;
if ($linha = $QuantidadeBLOCO->fetch(PDO::FETCH_ASSOC)) {
    $Qtdbloo5 = $linha['QTD'];
}
$QuantidadeBLOCO = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  ( top.data_entrega >= '2024-01-01' AND top.data_entrega <= '2024-12-31') AND   p.TIPO = 'BLOCO';");
$QuantidadeBLOCO->execute();
$i = 0;
if ($linha = $QuantidadeBLOCO->fetch(PDO::FETCH_ASSOC)) {
    $Qtdbloo6 = $linha['QTD'];
}
/// LIVRO

$QuantidadeBLOCO = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  (  top.data_entrega >= '2020-01-01' AND top.data_entrega <= '2020-12-31') AND  p.TIPO = 'LIVRO';");
$QuantidadeBLOCO->execute();
$i = 0;
if ($linha = $QuantidadeBLOCO->fetch(PDO::FETCH_ASSOC)) {
    $QtdLIVRO4 = $linha['QTD'];
}
$QuantidadeLIVRO = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  ( top.data_entrega >= '2019-01-01' AND top.data_entrega <= '2019-12-31' ) AND  p.TIPO = 'LIVRO';");
$QuantidadeLIVRO->execute();
$i = 0;
if ($linha = $QuantidadeLIVRO->fetch(PDO::FETCH_ASSOC)) {
    $QtdLIVRO1 = $linha['QTD'];
}
$QuantidadeLIVRO = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  ( top.data_entrega >= '2021-01-01' AND top.data_entrega <= '2021-12-31' ) AND  p.TIPO = 'LIVRO';");
$QuantidadeLIVRO->execute();
$i = 0;
if ($linha = $QuantidadeLIVRO->fetch(PDO::FETCH_ASSOC)) {
    $QtdLIVRO2 = $linha['QTD'];
}
$QuantidadeLIVRO = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  ( top.data_entrega >= '2022-01-01' AND top.data_entrega <= '2022-12-31' ) AND  p.TIPO = 'LIVRO';");
$QuantidadeLIVRO->execute();
$i = 0;
if ($linha = $QuantidadeLIVRO->fetch(PDO::FETCH_ASSOC)) {
    $QtdLIVRO3 = $linha['QTD'];
}
$QuantidadeLIVRO = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  ( top.data_entrega >= '2023-01-01' AND top.data_entrega <= '2023-12-31') AND   p.TIPO = 'LIVRO';");
$QuantidadeLIVRO->execute();
$i = 0;
if ($linha = $QuantidadeLIVRO->fetch(PDO::FETCH_ASSOC)) {
    $QtdLIVRO5 = $linha['QTD'];
}
$QuantidadeLIVRO = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  ( top.data_entrega >= '2024-01-01' AND top.data_entrega <= '2024-12-31') AND   p.TIPO = 'LIVRO';");
$QuantidadeLIVRO->execute();
$i = 0;
if ($linha = $QuantidadeLIVRO->fetch(PDO::FETCH_ASSOC)) {
    $QtdLIVRO6 = $linha['QTD'];
}

///

/// FOLHA

$QuantidadeBLOCO = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  (  top.data_entrega >= '2020-01-01' AND top.data_entrega <= '2020-12-31') AND  p.TIPO = 'FOLHA';");
$QuantidadeBLOCO->execute();
$i = 0;
if ($linha = $QuantidadeBLOCO->fetch(PDO::FETCH_ASSOC)) {
    $QtdFOLHA4 = $linha['QTD'];
}
$QuantidadeFOLHA = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  ( top.data_entrega >= '2019-01-01' AND top.data_entrega <= '2019-12-31' ) AND  p.TIPO = 'FOLHA';");
$QuantidadeFOLHA->execute();
$i = 0;
if ($linha = $QuantidadeFOLHA->fetch(PDO::FETCH_ASSOC)) {
    $QtdFOLHA1 = $linha['QTD'];
}
$QuantidadeFOLHA = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  ( top.data_entrega >= '2021-01-01' AND top.data_entrega <= '2021-12-31' ) AND  p.TIPO = 'FOLHA';");
$QuantidadeFOLHA->execute();
$i = 0;
if ($linha = $QuantidadeFOLHA->fetch(PDO::FETCH_ASSOC)) {
    $QtdFOLHA2 = $linha['QTD'];
}
$QuantidadeFOLHA = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  ( top.data_entrega >= '2022-01-01' AND top.data_entrega <= '2022-12-31' ) AND  p.TIPO = 'FOLHA';");
$QuantidadeFOLHA->execute();
$i = 0;
if ($linha = $QuantidadeFOLHA->fetch(PDO::FETCH_ASSOC)) {
    $QtdFOLHA3 = $linha['QTD'];
}
$QuantidadeFOLHA = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  ( top.data_entrega >= '2023-01-01' AND top.data_entrega <= '2023-12-31') AND   p.TIPO = 'FOLHA';");
$QuantidadeFOLHA->execute();
$i = 0;
if ($linha = $QuantidadeFOLHA->fetch(PDO::FETCH_ASSOC)) {
    $QtdFOLHA5 = $linha['QTD'];
}
$QuantidadeFOLHA = $conexao->prepare("SELECT SUM(tpo.QUANTIDADE) AS QTD FROM tabela_ordens_producao top
INNER JOIN tabela_orcamentos tbo
ON tbo.cod = top.orcamento_base
INNER JOIN tabela_produtos_orcamento tpo
ON tbo.cod = tpo.cod_orcamento
INNER JOIN produtos p
ON p.CODIGO = tpo.cod_produto
WHERE top.status != '13' AND  ( top.data_entrega >= '2024-01-01' AND top.data_entrega <= '2024-12-31') AND   p.TIPO = 'FOLHA';");
$QuantidadeFOLHA->execute();
$i = 0;
if ($linha = $QuantidadeFOLHA->fetch(PDO::FETCH_ASSOC)) {
    $QtdFOLHA6 = $linha['QTD'];
}

///
//// CALCULOS
$Aumento_Orcamento = ceil((($QtdPo5 - $QtdPo4) / $QtdPo4) * 100);
$Aumento_Op = ceil((($QtdPP5 - $QtdPP4) / $QtdPP4) * 100);
$Aumento_Blocos = ceil((($Qtdbloo6 - $Qtdbloo4) / $Qtdbloo4) * 100);
$Aumento_Livros = ceil((($QtdLIVRO6 - $QtdLIVRO4) / $QtdLIVRO4) * 100);
$Aumento_MANUAL = ceil((($QtdFOLHA6 - $QtdFOLHA4) / $QtdFOLHA4) * 100);
///
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
                        <div class="justify-content-end d-grid d-sm-flex p-3 border">
                            <!-- <img src="../assets/img/elements/orc.jpg" alt="collapse-image" height="125" class="me-4 mb-sm-0 mb-2" /> -->

                            <span>
                                DIVISÃO COMERCIAL<br>Quantidade de Propostas de Orçamento
                                <br>
                                <div class="row ">
                                    <div class="col-12 ">
                                        <div class="card">
                                            <div class="col-12 mb-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                                                <div class="card-title">
                                                                    <h5 class="text-nowrap mb-2">Quantidade de Propostas de Orçamento</h5>
                                                                    <span class="badge bg-label-warning rounded-pill">Ano <?= $Ano ?></span>
                                                                </div>
                                                                <div class="mt-sm-auto">
                                                                    <small class="text-danger text-nowrap fw-semibold"><i class="bx bx-chevron-down"></i> <?= $Aumento_Orcamento ?>%</small>
                                                                    <h3 class="mb-0"><?= number_format($QtdPo5, 0, ".", "."); ?> P.O</h3>
                                                                </div>

                                                            </div>

                                                            <div id="Qtd_PO"></div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive text-nowrap justify-content-end">
                                                <table align="center" style="text-align: center;" class="table table-hover">
                                                    <thead align="center" style="text-align: center;">
                                                        <tr align="center" style="text-align: center;">
                                                            <th colspan="2" rowspan="2" align="center" style="text-align: center;">ORÇAMENTOS</th>

                                                        </tr>
                                                    </thead>
                                                    <tr>
                                                        <th>ANO</th>
                                                        <th>QUANTIDADE</th>
                                                    </tr>
                                                    <tbody class="table-border-bottom-0">
                                                        <tr>
                                                            <td><strong>2019</strong></td>
                                                            <td><span id="QtdP0" class="badge bg-label-primary me-1">
                                                                    <?= number_format($QtdPo, 0, ".", ".");  ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2020</strong></td>
                                                            <td><span id="QtdPo1" class="badge bg-label-primary me-1">
                                                                    <?= number_format($QtdPo1, 0, ".", ".");  ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2021</strong></td>
                                                            <td><span id="QtdPo2" class="badge bg-label-primary me-1">
                                                                    <?= number_format($QtdPo2, 0, ".", "."); ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2022</strong></td>
                                                            <td><span id="QtdPo3" class="badge bg-label-primary me-1">
                                                                    <?= number_format($QtdPo3, 0, ".", ".");  ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2023</strong></td>
                                                            <td><span id="QtdPo4" class="badge bg-label-primary me-1">
                                                                    <?= number_format($QtdPo4, 0, ".", ".");  ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2024</strong></td>
                                                            <td><span id="QtdPo5" class="badge bg-label-primary me-1">
                                                                    <?= number_format($QtdPo5, 0, ".", ".");  ?>
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
                            <!-- <img src="../assets/img/elements/pro.jpg"  height="125"class="me-4 mb-sm-0 mb-2" /> -->

                            <span>
                                DIVISÃO PRODUÇÃO<br>Quantidade de Ordens de Produção
                                <br>
                                <div class="row ">
                                    <div class="col-12 ">
                                        <div class="card">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                                        <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                                            <div class="card-title">
                                                                <h5 class="text-nowrap mb-2">Quantidade de Ordens de Produção</h5>
                                                                <span class="badge bg-label-warning rounded-pill">Ano <?= $Ano ?></span>
                                                            </div>
                                                            <div class="mt-sm-auto">
                                                                <small class="text-danger text-nowrap fw-semibold"><i class="bx bx-chevron-down"></i> <?= $Aumento_Op ?>%</small>
                                                                <h3 class="mb-0"><?= number_format($QtdPP5, 0, ".", ".");  ?> O.P</h3>
                                                            </div>

                                                        </div>

                                                        <div id="Qtd_Op"></div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-hover">
                                                <thead align="center" style="text-align: center;">
                                                    <tr align="center" style="text-align: center;">
                                                        <th colspan="2" rowspan="2" align="center" style="text-align: center;">ORDENS DE PRODUÇÃO</th>

                                                    </tr>
                                                </thead>

                                                <tr>
                                                    <th>ANO</th>
                                                    <th>QUANTIDADE</th>
                                                </tr>

                                                <tbody class="table-border-bottom-0">
                                                    <tr>
                                                        <td><strong>2019</strong></td>
                                                        <td><span id="QtdPP" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdPP, 0, ".", "."); ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2020</strong></td>
                                                        <td><span id="QtdPP1" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdPP1, 0, ".", "."); ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2021</strong></td>
                                                        <td><span id="QtdPP2" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdPP2, 0, ".", "."); ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2022</strong></td>
                                                        <td><span id="QtdPP3" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdPP3, 0, ".", "."); ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2023</strong></td>
                                                        <td><span id="QtdPP4" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdPP4, 0, ".", "."); ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2024</strong></td>
                                                        <td><span id="QtdPP5" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdPP5, 0, ".", "."); ?>
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
            <div class="col-12 col-md-12">
                <div class="multi-collapse" id="multiCollapseExample2">
                    <div class="d-grid flex p-12 border" align="center" style="text-align: center;">
                        <!-- <img src="../assets/img/elements/pro.jpg"  height="125"class="me-4 mb-sm-0 mb-2" /> -->

                        <span>
                            DIVISÃO PRODUÇÃO<br>Unidades de Materiais Produzidos
                            <br>
                            <div class="row d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                                    <div class="card-title">
                                                        <h5 class="text-nowrap mb-2">Quantidade de BLOCOS</h5>
                                                        <span class="badge bg-label-warning rounded-pill">Ano <?= $Ano ?></span>
                                                    </div>
                                                    <div class="mt-sm-auto">
                                                        <small class="text-danger text-nowrap fw-semibold"><i class="bx bx-chevron-down"></i> <?= $Aumento_Blocos ?>%</small>
                                                        <h3 class="mb-0"><?= number_format($Qtdbloo6, 0, ".", "."); ?> Blocos</h3>
                                                    </div>

                                                </div>

                                                <div id="Qtd_Blocs"></div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                                    <div class="card-title">
                                                        <h5 class="text-nowrap mb-2">Quantidade de LIVROS</h5>
                                                        <span class="badge bg-label-warning rounded-pill">Ano <?= $Ano ?></span>
                                                    </div>
                                                    <div class="mt-sm-auto">
                                                        <small class="text-danger text-nowrap fw-semibold"><i class="bx bx-chevron-down"></i> <?= $Aumento_Livros ?>%</small>
                                                        <h3 class="mb-0"><?= number_format($QtdLIVRO6, 0, ".", "."); ?> Livros</h3>
                                                    </div>

                                                </div>

                                                <div id="Qtd_livors"></div>

                                            </div>
                                        </div>
                                    </div>
                                <div class="col-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                                <div class="card-title">
                                                    <h5 class="text-nowrap mb-2">Quantidade de FOLHAS</h5>
                                                    <span class="badge bg-label-warning rounded-pill">Ano <?= $Ano ?></span>
                                                </div>
                                                <div class="mt-sm-auto">
                                                    <small class="text-danger text-nowrap fw-semibold"><i class="bx bx-chevron-down"></i> <?= $Aumento_MANUAL ?>%</small>
                                                    <h3 class="mb-0"><?= number_format($QtdFOLHA6, 0, ".", "."); ?> FOLHAS</h3>
                                                </div>

                                            </div>

                                            <div id="Qtd_folhas"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="card">

                                        <div class="table-responsive text-nowrap">
                                            <table align="center" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;" rolspan="2" colspan="2" align="center">BLOCOS</th>
                                                    </tr>
                                                </thead>
                                                <tr>
                                                    <th>ANO</th>
                                                    <th>QUANTIDADE</th>
                                                </tr>

                                                <tbody class="table-border-bottom-0">
                                                    <tr>
                                                        <td><strong>2019</strong></td>
                                                        <td><span id="Qtdbloo1" class="badge bg-label-primary me-1">
                                                                <?= number_format($Qtdbloo1, 0, ".", ".");   ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2020</strong></td>
                                                        <td><span id="Qtdbloo4" class="badge bg-label-primary me-1">
                                                                <?= number_format($Qtdbloo4, 0, ".", ".");   ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2021</strong></td>
                                                        <td><span id="Qtdbloo2" class="badge bg-label-primary me-1">
                                                                <?= number_format($Qtdbloo2, 0, ".", ".");   ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2022</strong></td>
                                                        <td><span id="Qtdbloo3" class="badge bg-label-primary me-1">
                                                                <?= number_format($Qtdbloo3, 0, ".", ".");   ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2023</strong></td>
                                                        <td><span id="Qtdbloo5" class="badge bg-label-primary me-1">
                                                                <?= number_format($Qtdbloo5, 0, ".", ".");   ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2024</strong></td>
                                                        <td><span id="Qtdbloo6" class="badge bg-label-primary me-1">
                                                                <?= number_format($Qtdbloo6, 0, ".", ".");   ?>
                                                            </span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card">
                                        <div class="table-responsive text-nowrap">
                                            <table align="center" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;" rolspan="2" colspan="2" align="center">LIVRO</th>
                                                    </tr>
                                                </thead>
                                                <tr>
                                                    <th>ANO</th>
                                                    <th>QUANTIDADE</th>
                                                </tr>

                                                <tbody class="table-border-bottom-0">
                                                    <tr>
                                                        <td><strong>2019</strong></td>
                                                        <td><span id="QtdLIVRO1" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdLIVRO1, 0, ".", ".");  ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2020</strong></td>
                                                        <td><span id="QtdLIVRO4" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdLIVRO4, 0, ".", ".");  ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2021</strong></td>
                                                        <td><span id="QtdLIVRO2" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdLIVRO2, 0, ".", ".");  ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2022</strong></td>
                                                        <td><span id="QtdLIVRO3" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdLIVRO3, 0, ".", ".");  ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2023</strong></td>
                                                        <td><span id="QtdLIVRO5" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdLIVRO5, 0, ".", ".");  ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2024</strong></td>
                                                        <td><span id="QtdLIVRO6" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdLIVRO6, 0, ".", ".");  ?>
                                                            </span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card">
                                        <div class="table-responsive text-nowrap">
                                            <table align="center" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;" rolspan="2" colspan="2" align="center">REVISTA/LIVRETO/MANUAL</th>
                                                    </tr>
                                                </thead>
                                                <tr>
                                                    <th>ANO</th>
                                                    <th>QUANTIDADE</th>
                                                </tr>

                                                <tbody class="table-border-bottom-0">
                                                    <tr>
                                                        <td><strong>2019</strong></td>
                                                        <td><span id="QtdFOLHA1" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdFOLHA1, 0, ".", ".");  ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2020</strong></td>
                                                        <td><span id="QtdFOLHA4" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdFOLHA4, 0, ".", ".");  ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2021</strong></td>
                                                        <td><span id="QtdFOLHA2" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdFOLHA2, 0, ".", ".");  ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2022</strong></td>
                                                        <td><span id="QtdFOLHA3" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdFOLHA3, 0, ".", ".");  ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2023</strong></td>
                                                        <td><span id="QtdFOLHA5" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdFOLHA5, 0, ".", ".");  ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>2024</strong></td>
                                                        <td><span id="QtdFOLHA6" class="badge bg-label-primary me-1">
                                                                <?= number_format($QtdFOLHA6, 0, ".", ".");  ?>
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
    <script src="../assets/js/quantitativos.js"></script>

    <?php include_once("../html/navbar-dow.php"); ?>