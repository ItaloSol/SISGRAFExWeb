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
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= number_format($QtdPo,0,".",".");  ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2020</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= number_format($QtdPo1,0,".",".");  ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2021</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= number_format( $QtdPo2,0,".","."); ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2022</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= number_format($QtdPo3,0,".",".");  ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2023</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= number_format($QtdPo4,0,".",".");  ?>
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
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= number_format($QtdPP,0,".","."); ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2020</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= number_format($QtdPP1,0,".","."); ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2021</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= number_format($QtdPP2,0,".","."); ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2022</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= number_format($QtdPP3,0,".","."); ?>
                                                                </span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>2023</strong></td>
                                                            <td><span class="badge bg-label-primary me-1">
                                                                    <?= number_format($QtdPP4,0,".","."); ?>
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
                                <div  class="row d-flex justify-content-center">
                                <div  class="col-3">
                                <div  class="card">
                                            <div class="table-responsive text-nowrap">
                                                    <table align="center" class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center;" rolspan="2" colspan="2"
                                                                    align="center">BLOCOS</th>
                                                            </tr>
                                                        </thead>
                                                        <tr>
                                                            <th>ANO</th>
                                                            <th>QUANTIDADE</th>
                                                        </tr>

                                                        <tbody class="table-border-bottom-0">
                                                            <tr>
                                                                <td><strong>2019</strong></td>
                                                                <td><span class="badge bg-label-primary me-1">
                                                                        <?=number_format($Qtdbloo1,0,".",".");   ?>
                                                                    </span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>2020</strong></td>
                                                                <td><span class="badge bg-label-primary me-1">
                                                                        <?=number_format($Qtdbloo4,0,".",".");   ?>
                                                                    </span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>2021</strong></td>
                                                                <td><span class="badge bg-label-primary me-1">
                                                                        <?=number_format($Qtdbloo2,0,".",".");   ?>
                                                                    </span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>2022</strong></td>
                                                                <td><span class="badge bg-label-primary me-1">
                                                                        <?=number_format($Qtdbloo3,0,".",".");   ?>
                                                                    </span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>2023</strong></td>
                                                                <td><span class="badge bg-label-primary me-1">
                                                                        <?=number_format($Qtdbloo5,0,".",".");   ?>
                                                                    </span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-3">
                                    <div class="card">
                                            <div class="table-responsive text-nowrap">
                                                    <table align="center" class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center;" rolspan="2" colspan="2"
                                                                    align="center">LIVRO</th>
                                                            </tr>
                                                        </thead>
                                                        <tr>
                                                            <th>ANO</th>
                                                            <th>QUANTIDADE</th>
                                                        </tr>

                                                        <tbody class="table-border-bottom-0">
                                                            <tr>
                                                                <td><strong>2019</strong></td>
                                                                <td><span class="badge bg-label-primary me-1">
                                                                        <?= number_format($QtdLIVRO1,0,".",".");  ?>
                                                                    </span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>2020</strong></td>
                                                                <td><span class="badge bg-label-primary me-1">
                                                                        <?= number_format($QtdLIVRO4,0,".",".");  ?>
                                                                    </span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>2021</strong></td>
                                                                <td><span class="badge bg-label-primary me-1">
                                                                        <?= number_format($QtdLIVRO2,0,".",".");  ?>
                                                                    </span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>2022</strong></td>
                                                                <td><span class="badge bg-label-primary me-1">
                                                                        <?= number_format($QtdLIVRO3,0,".",".");  ?>
                                                                    </span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>2023</strong></td>
                                                                <td><span class="badge bg-label-primary me-1">
                                                                        <?= number_format($QtdLIVRO5,0,".",".");  ?>
                                                                    </span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="card">
                                            <div class="table-responsive text-nowrap">
                                                    <table align="center" class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center;" rolspan="2" colspan="2"
                                                                    align="center">REVISTA/LIVRETO/MANUAL</th>
                                                            </tr>
                                                        </thead>
                                                        <tr>
                                                            <th>ANO</th>
                                                            <th>QUANTIDADE</th>
                                                        </tr>

                                                        <tbody class="table-border-bottom-0">
                                                            <tr>
                                                                <td><strong>2019</strong></td>
                                                                <td><span class="badge bg-label-primary me-1">
                                                                        <?=  number_format($QtdFOLHA1,0,".",".");  ?>
                                                                    </span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>2020</strong></td>
                                                                <td><span class="badge bg-label-primary me-1">
                                                                        <?=  number_format($QtdFOLHA4,0,".",".");  ?>
                                                                    </span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>2021</strong></td>
                                                                <td><span class="badge bg-label-primary me-1">
                                                                        <?=  number_format($QtdFOLHA2,0,".",".");  ?>
                                                                    </span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>2022</strong></td>
                                                                <td><span class="badge bg-label-primary me-1">
                                                                        <?=  number_format($QtdFOLHA3,0,".",".");  ?>
                                                                    </span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>2023</strong></td>
                                                                <td><span class="badge bg-label-primary me-1">
                                                                        <?=  number_format($QtdFOLHA5,0,".",".");  ?>
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
        <?php include_once("../html/navbar-dow.php"); ?>