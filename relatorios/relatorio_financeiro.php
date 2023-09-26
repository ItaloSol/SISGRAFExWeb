<!DOCTYPE html>
<?php

include_once('../conexoes/conexao.php');
include_once('../conexoes/conn.php');
/////////////////////////////////////////////
$Total_Anteriror = 0;
$Total_total_Notas = 0;
$Total_debito = 0;
$Total_total_Abertas = 0;
$Total_Calculo = 0;
// CODIGO VARIAVEL // $html => VARIAVEL OBRIGATORIA PARA CRIAÇÃO DO PDF, INTRUÇÕES EM HTML 
if (isset($_POST['submit'])) {
    if (isset($_POST['tipo_cliente'])) {
        $tipo_cliente = $_POST['tipo_cliente'];
        if ($tipo_cliente == '1') {
            $Cliente = 'fisicos';
            $Pessoa = 'FISICAS';
        } else {
            $Cliente = 'juridicos';
            $Pessoa = 'JURÍDICAS';
        }
    }
    if (isset($_POST['diferente'])) {
        if ($_POST['pordata'] != 'mes') {
        $Creditos = ' WHERE ';
        $Creditos = $Creditos . "credito != 0";
        }else{
            $Creditos = '';
        }
    } else {
        $Creditos = '';
    }
    if(isset($_POST['numerodocliente'])){
        if($_POST['numerodocliente'] != null && $_POST['numerodocliente'] != 0 ){
            $ccliente = $_POST['numerodocliente'];
            if($Creditos != ''){
                $Creditos = $Creditos . "cod = $ccliente";
            }else{
                $Creditos = ' WHERE ';
                $Creditos = $Creditos . "cod = $ccliente";
            }
        }
    }
    
    if (isset($_POST['periodo'])) {
        if ($Creditos == '') {
            $Creditos = ' WHERE ';
        } else {
            $Creditos = $Creditos . ' AND ';
        }
        if ($_POST['periodo'] == 'entreate') {
            $Valor1 = $_POST['entre'];
            $Valor2 = $_POST['ate'];
            $Creditos = $Creditos . "tabela_clientes_" . $Cliente . ".credito >= " . $Valor1 . " AND tabela_clientes_" . $Cliente . ".credito <= " . $Valor2;
        }
        if ($_POST['periodo'] == 'maior') {
            $Valor = $_POST['vlrmaior'];
            $Creditos = $Creditos . "tabela_clientes_" . $Cliente . ".credito >= " . $Valor;
        }
        if ($_POST['periodo'] == 'menor') {
            $Valor = $_POST['vlrmenor'];
            $Creditos = $Creditos . "tabela_clientes_" . $Cliente . ".credito <= " . $Valor;
        }
        if ($_POST['periodo'] == 'igual') {
            $Valor = $_POST['vlrigual'];
            $Creditos = $Creditos . "tabela_clientes_" . $Cliente . ".credito = " . $Valor;
        }
    }
    $Debitos_Att = '';
    $Debitos_Dp = '';
    if (isset($_POST['pordata'])) {
        if (isset($_POST['periodo'])) {
            $DATA = " AND ";
        } else {
            $DATA = " WHERE ";
        }
        if ($_POST['pordata'] == 'mes') {
            $Valor1 = $_POST['umadata'];
            $Valor2 = $_POST['ano/mes'];
            $dia1 = '01';
            $dia2 = '31';
            $Ano = $Valor2;
            $Ate = $Valor1 . '/' . $Ano;
            $Em_Abrido = "AND o.data_emissao <= '$Ano-$Valor1-01'";
            $Debitos_Att = " AND f.DT_FAT BETWEEN '$Ano-$Valor1-01' AND '$Ano-$Valor1-31'";
            $Debitos_Dp = " AND f.DT_FAT < '$Ano-$Valor1-01'";
            $Notas_Credito = " STR_TO_DATE(data, '%d/%m/%Y') BETWEEN STR_TO_DATE('" . $dia1 . '/' . $Valor1 . '/' . $Valor2 . "', '%d/%m/%Y') AND STR_TO_DATE('" . $dia2 . '/' . $Valor1 . '/' . $Valor2 . "', '%d/%m/%Y')";
            $DATA = $DATA . " STR_TO_DATE(data, '%d/%m/%Y') BETWEEN STR_TO_DATE('" . $dia1 . '/' . $Valor1 . '/' . $Valor2 . "', '%d/%m/%Y') AND STR_TO_DATE('" . $dia2 . '/' . $Valor1 . '/' . $Valor2 . "', '%d/%m/%Y')";
            $Notas_Credito2 = " AND STR_TO_DATE(data, '%d/%m/%Y') < STR_TO_DATE('" . $dia1 . '/' . $Valor1 . '/' . $Valor2 . "', '%d/%m/%Y')";
        } else {
            $Valor = $_POST['ano'];
            $dia = '01';
            $mes = '01';
            $dia1 = '31';
            $mes1 = '12';
            $Ano = $Valor;
            $Ate = $Ano;
            $Em_Abrido = "";
            $Debitos_Att = " AND f.DT_FAT >= '$Ano-$mes-01'";
            $Debitos_Dp = " AND f.DT_FAT < '$Ano-01-01'";
            $Notas_Credito = " STR_TO_DATE(data, '%d/%m/%Y') BETWEEN STR_TO_DATE('" . $dia . '/' . $mes . '/' . $Valor . "', '%d/%m/%Y') AND STR_TO_DATE('" . $dia1 . '/' . $mes1 . '/' . $Valor . "', '%d/%m/%Y')";
            $DATA = $DATA . " STR_TO_DATE(data, '%d/%m/%Y') BETWEEN STR_TO_DATE('" . $dia . '/' . $mes . '/' . $Valor . "', '%d/%m/%Y') AND STR_TO_DATE('" . $dia1 . '/' . $mes1 . '/' . $Valor . "', '%d/%m/%Y')";
            $Notas_Credito2 = "";
        }
    }
   
    if (isset($_POST['ordenar'])) {
        if($_POST['ordenar'] == 'Decescente'){
            $Ordernar = " ORDER BY tabela_clientes_" . $Cliente . ".credito DESC";
        }else{
            $Ordernar = " ORDER BY tabela_clientes_" . $Cliente . ".credito ASC";
        }
        
    } else {
        $Ordernar = '';
    }
   
}

//////// CRIAR TABELA /////////
$Corpo = '';
date_default_timezone_set('America/Sao_Paulo');
$data_hora   = date('d/m/Y H:i:s ', time());
$data_horaa = (string) $data_hora;
$titulo = "<h5>DETALHAMENTO DE CLIENTE - DATA E HORA DE EMISSÃO: " . $data_horaa . " - SISGRAFEX</h5><br>
<h1 style='text-transform: uppercase; text-align: center;' >RELATÓRIO FINANCEIRO <br>
$Ate - PESSOAS $Pessoa</h1>";
$Cabesalho = "<table style=' solid black;  border-collapse:collapse; font-size: 10; 
text-align: center;
color: black;' border='1' class='table'>
<tr>
<th style=' color:Black'>CÓDIGO</th>
<th style=' color:Black'>NOME</th>
<th style=' color:Black'>SALDO ACUMULADO ANTERIOR</th>
<th style=' color:Black'>CRÉDITO</th>
<th style=' color:Black'>DÉBITO</th>
<th style=' color:Black'>EM ABERTO ATÉ $Ate</th>
<th style=' color:Black'>SALDO ACUMULADO ATUAL</th>
</tr>
";

//     /////////////////////////////////////////////
//     /////// BUSCAR NO BANCO DE DADOS ////////////
//     /////////////////////////////////////////////
$Clientes_Busca = $conexao->prepare("SELECT * FROM tabela_clientes_$Cliente  $Creditos   $Ordernar");
$Clientes_Busca->execute();

while ($linha = $Clientes_Busca->fetch(PDO::FETCH_ASSOC)) {
    $Tabela_Notas = [];
    $Tabela_Faturamentos = [];
    $Tabela_Produtos = [];
    $Ordens_Finalizadas = [];
    $Tabela_Orc_Finalizados = [];
    $valor_fata = [];
    $Tabela_Produtos_Finalizados = [];
    $Ordens_Abertas = [];
    $Tabela_Produtos_Abertas = [];
    $Tabela_Orc_Abertas = [];

    $cod = $linha['cod'];
    $nome = $linha['nome'];
    $credito = $linha['credito'];







    /////////////////////////////////// NOTAS DE CREDITO //////////////////////////////////////////////////////

    $query_Notas = $conexao->prepare("SELECT * FROM tabela_notas WHERE cod_cliente = '$cod'  AND tipo_pessoa = '$tipo_cliente' AND $Notas_Credito ");
    $query_Notas->execute();
    $Tabela_Notas = [];

    while ($linha = $query_Notas->fetch(PDO::FETCH_ASSOC)) {
        $Tabela_Notas[] = [
            'cod' => $linha['cod'],
            'serie' => $linha['serie'],
            'tipo' => $linha['tipo'],
            'forma_pagamento' => $linha['forma_pagamento'],
            'cod_op' => $linha['cod_op'],
            'cod_orcamento' => $linha['cod_orcamento'],
            'COD_PRODUTO' => $linha['COD_PRODUTO'],
            'cod_emissor' => $linha['cod_emissor'],
            'cod_cliente' => $linha['cod_cliente'],
            'cod_endereco' => $linha['cod_endereco'],
            'cod_contato' => $linha['cod_contato'],
            'tipo_pessoa' => $linha['tipo_pessoa'],
            'quantidade_entregue' => $linha['quantidade_entregue'],
            'valor' => $linha['valor'],
            'data' => $linha['data'],
            'observacoes' => $linha['observacoes'],
            'FAT_FRETE' => $linha['FAT_FRETE'],
            'FAT_SERVICOS' => $linha['FAT_SERVICOS']
        ];
    }
    if (isset($Tabela_Notas)) {
        $Total_Notas = count($Tabela_Notas);
    } else {
        $Total_Notas = 0;
    }
    $Percorrer_Notas = 0;
    $valor_total_Notas = 0;
    /////////////////////////////////////// FIM NOTAS ///////////////////////////////////////////////////////////////
    /////////////////////////////////// 2 NOTAS DE CREDITO 2 //////////////////////////////////////////////////////
    $query_Notas2 = $conexao->prepare("SELECT * FROM tabela_notas WHERE cod_cliente = '$cod'  AND tipo_pessoa = '$tipo_cliente' $Notas_Credito2 ");
    $query_Notas2->execute();
    $Tabela_Notas2 = [];

    while ($linha2 = $query_Notas2->fetch(PDO::FETCH_ASSOC)) {
        $Tabela_Notas2[] = [
            'cod' => $linha2['cod'],
            'serie' => $linha2['serie'],
            'tipo' => $linha2['tipo'],
            'forma_pagamento' => $linha2['forma_pagamento'],
            'cod_op' => $linha2['cod_op'],
            'cod_orcamento' => $linha2['cod_orcamento'],
            'COD_PRODUTO' => $linha2['COD_PRODUTO'],
            'cod_emissor' => $linha2['cod_emissor'],
            'cod_cliente' => $linha2['cod_cliente'],
            'cod_endereco' => $linha2['cod_endereco'],
            'cod_contato' => $linha2['cod_contato'],
            'tipo_pessoa' => $linha2['tipo_pessoa'],
            'quantidade_entregue' => $linha2['quantidade_entregue'],
            'valor' => $linha2['valor'],
            'data' => $linha2['data'],
            'observacoes' => $linha2['observacoes'],
            'FAT_FRETE' => $linha2['FAT_FRETE'],
            'FAT_SERVICOS' => $linha2['FAT_SERVICOS']
        ];
    }
    if (isset($Tabela_Notas2)) {
        $Total_Notas2 = count($Tabela_Notas2);
    } else {
        $Total_Notas2 = 0;
    }
    $Percorrer_Notas2 = 0;
    $valor_total_Notas2 = 0;
    /////////////////////////////////////// FIM NOTAS ///////////////////////////////////////////////////////////////

    /////////////////////////////////////// FATURAMENTOS ////////////////////////////////////////////////////////////

    $query_Ordens_Producao = $conexao->prepare("SELECT * FROM faturamentos f INNER JOIN tabela_ordens_producao o  ON o.cod = f.CODIGO_OP WHERE o.cod_cliente = '$cod' AND o.tipo_cliente = '$tipo_cliente'  ");
    $query_Ordens_Producao->execute();
    $i = 0;
    $Tabela_Faturamentos = [];
    while ($linha = $query_Ordens_Producao->fetch(PDO::FETCH_ASSOC)) {

        $Tabela_Faturamentos[$i] = [
            'CODIGO' => $linha['CODIGO'],
            'CODIGO_ORC' => $linha['CODIGO_ORC'],
            'cod' => $linha['cod'],
            'cod_produto' => $linha['cod_produto'],
            'orcamento_base' => $linha['orcamento_base'],
            'CODIGO_OP' => $linha['CODIGO_OP'],
            'tipo_produto' => $linha['tipo_produto'],
            'EMISSOR' => $linha['EMISSOR'],
            'QTD_ENTREGUE' => $linha['QTD_ENTREGUE'],
            'VLR_FAT' => $linha['VLR_FAT'],
            'DT_FAT' => $linha['DT_FAT'],
            'FRETE_FAT' => $linha['FRETE_FAT'],
        ];

        $i++;
    }
    if (isset($Tabela_Faturamentos)) {
        $Total_Faturamentos = count($Tabela_Faturamentos);
    } else {
        $Total_Faturamentos = 0;
    }

    $Percorrer_Faturamentos = 0;
    $valor_total_Faturamentos = 0;

    /////////////////////////////////////////FIM FATURAMENTOS ////////////////////////////////////////////////////////
    /////////////////////////////////////// FATURAMENTOS 2 ////////////////////////////////////////////////////////////

    $query_Ordens_Producao2 = $conexao->prepare("SELECT * FROM faturamentos f INNER JOIN tabela_ordens_producao o  ON o.cod = f.CODIGO_OP WHERE o.cod_cliente = '$cod' AND o.tipo_cliente = '$tipo_cliente' $Debitos_Att ");
    $query_Ordens_Producao2->execute();
    $i = 0;
    $Tabela_Faturamentos2 = [];
    while ($linha2 = $query_Ordens_Producao2->fetch(PDO::FETCH_ASSOC)) {

        $Tabela_Faturamentos2[$i] = [
            'CODIGO' => $linha2['CODIGO'],
            'CODIGO_ORC' => $linha2['CODIGO_ORC'],
            'cod' => $linha2['cod'],
            'cod_produto' => $linha2['cod_produto'],
            'orcamento_base' => $linha2['orcamento_base'],
            'CODIGO_OP' => $linha2['CODIGO_OP'],
            'tipo_produto' => $linha2['tipo_produto'],
            'EMISSOR' => $linha2['EMISSOR'],
            'QTD_ENTREGUE' => $linha2['QTD_ENTREGUE'],
            'VLR_FAT' => $linha2['VLR_FAT'],
            'DT_FAT' => $linha2['DT_FAT'],
        ];

        $i++;
    }
    if (isset($Tabela_Faturamentos2)) {
        $Total_Faturamentos2 = count($Tabela_Faturamentos2);
    } else {
        $Total_Faturamentos2 = 0;
    }

    $Percorrer_Faturamentos2 = 0;
    $valor_total_Faturamentos2 = 0;

    /////////////////////////////////////////FIM FATURAMENTOS ////////////////////////////////////////////////////////
 /////////////////////////////////////// FATURAMENTOS 3 ////////////////////////////////////////////////////////////

 $query_Ordens_Producao3 = $conexao->prepare("SELECT * FROM faturamentos f INNER JOIN tabela_ordens_producao o  ON o.cod = f.CODIGO_OP WHERE o.cod_cliente = '$cod' AND o.tipo_cliente = '$tipo_cliente' $Debitos_Dp ");
 $query_Ordens_Producao3->execute();
 $i = 0;
 $Tabela_Faturamentos3 = [];
 while ($linha3 = $query_Ordens_Producao3->fetch(PDO::FETCH_ASSOC)) {

     $Tabela_Faturamentos3[$i] = [
         'CODIGO' => $linha3['CODIGO'],
         'CODIGO_ORC' => $linha3['CODIGO_ORC'],
         'cod' => $linha3['cod'],
         'cod_produto' => $linha3['cod_produto'],
         'orcamento_base' => $linha3['orcamento_base'],
         'CODIGO_OP' => $linha3['CODIGO_OP'],
         'tipo_produto' => $linha3['tipo_produto'],
         'EMISSOR' => $linha3['EMISSOR'],
         'QTD_ENTREGUE' => $linha3['QTD_ENTREGUE'],
         'VLR_FAT' => $linha3['VLR_FAT'],
         'DT_FAT' => $linha3['DT_FAT'],
     ];

     $i++;
 }
 if (isset($Tabela_Faturamentos3)) {
     $Total_Faturamentos3 = count($Tabela_Faturamentos3);
 } else {
     $Total_Faturamentos3 = 0;
 }

 $Percorrer_Faturamentos3 = 0;
 $valor_total_Faturamentos3 = 0;

 /////////////////////////////////////////FIM FATURAMENTOS ////////////////////////////////////////////////////////
    /////////////////////////////////// OP FINALIZADAS //////////////////////////////////////////////////////
    $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO WHERE o.cod_cliente = '$cod' AND o.tipo_cliente = '$tipo_cliente' AND o.status = '11'");
    $query_ordens_finalizadas->execute();
    $i = 0;
    $Ordens_Finalizadas = [];
    while ($linha = $query_ordens_finalizadas->fetch(PDO::FETCH_ASSOC)) {
        $Ordens_Finalizadas[$i] = [
            'cod' => $linha['cod'],
            'orcamento_base' => $linha['orcamento_base'],
            'tipo_produto' => $linha['tipo_produto'],
            'cod_produto' => $linha['cod_produto'],
            'cod_cliente' => $linha['cod_cliente'],
            'tipo_cliente' => $linha['tipo_cliente'],
            'status' => $linha['status'],
            'STS_DESCRICAO' => $linha['STS_DESCRICAO'],
            'data_entrega' => date($linha['data_entrega']),
            'data_emissao' => date($linha['data_emissao']),

        ];
        $Pesquisa_Produto = $Ordens_Finalizadas[$i]['cod_produto'];
        $Tipo_Produto = $Ordens_Finalizadas[$i]['tipo_produto'];
        if ($Tipo_Produto == '2') {
            $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos_pr_ent  WHERE CODIGO = '$Pesquisa_Produto'");
            $query_PRODUTOS->execute();

            while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                $Tabela_Produtos_Finalizados[$i] = [
                    'descricao' => $linha2['DESCRICAO']
                ];
            }
        }
        if ($Tipo_Produto == '1') {
            $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_Produto'");
            $query_PRODUTOS->execute();

            while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                $Tabela_Produtos_Finalizados[$i] = [
                    'descricao' => $linha2['DESCRICAO']
                ];
            }
        }
        $Cod_opr = $Ordens_Finalizadas[$i]['cod'];
        $Pesquisa_Orc = $Ordens_Finalizadas[$i]['orcamento_base'];
        $query_Pesquisa_Orc = $conexao->prepare("SELECT * FROM tabela_orcamentos  WHERE cod = '$Pesquisa_Orc'");
        $query_Pesquisa_Orc->execute();

        while ($linha2 = $query_Pesquisa_Orc->fetch(PDO::FETCH_ASSOC)) {
            $Tabela_Orc_Finalizados[$i] = [
                'valor_total' => $linha2['valor_total']
            ];
            $VVvalor_total_Faturamentos = $conexao->prepare("SELECT * FROM faturamentos f WHERE  f.CODIGO_OP = '$Cod_opr'");
            $VVvalor_total_Faturamentos->execute();
            while ($linha77 = $VVvalor_total_Faturamentos->fetch(PDO::FETCH_ASSOC)) {
                $valor_fata[$i] = [
                    'valor_total' => $linha77['VLR_FAT']
                ];
            }
        }
        if (!isset($valor_fata[$i]['valor_total'])) {
            $valor_fata[$i] = [
                'valor_total' => '0.00'
            ];
        }
        $ak = (int)$Tabela_Orc_Finalizados[$i]["valor_total"];
        $bk = (int)$valor_fata[$i]["valor_total"];
        $vkasd = $ak - $bk;
        if ($vkasd == 0) {
            $Relatorio_Faturada[$i] = '(TOTAL) R$ ' . $Tabela_Orc_Finalizados[$i]["valor_total"] . '<br>(FATURADA) R$ ' . $valor_fata[$i]["valor_total"];
        } else {
            $Relatorio_Faturada[$i] = '(TOTAL) R$ ' . $Tabela_Orc_Finalizados[$i]["valor_total"] . '<br>(FATURADA) R$ ' . $valor_fata[$i]["valor_total"] . ' <br>(PRODUÇÃO) R$ ' . number_format($vkasd, 2, ',', '.');
        }

        $i++;
    }

    if (isset($Ordens_Finalizadas)) {
        $Total_Finalizadas = count($Ordens_Finalizadas);
    } else {
        $Total_Finalizadas = 0;
    }
    $Percorrer_Finalizadas = 0;
    $valor_total_Finalizadas = 0;
    /////////////////////////////////////// FIM OP FINALZIADAS ///////////////////////////////////////////////////////////////

    /////////////////////////////////// OP ABERTAS //////////////////////////////////////////////////////
    $query_ordens_Abertas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO WHERE o.cod_cliente = '$cod' AND o.status != '11' AND o.status != '13' $Em_Abrido ");
    $query_ordens_Abertas->execute();
    $i = 0;
    while ($linha = $query_ordens_Abertas->fetch(PDO::FETCH_ASSOC)) {
        $Ordens_Abertas[$i] = [
            'cod' => $linha['cod'],
            'orcamento_base' => $linha['orcamento_base'],
            'tipo_produto' => $linha['tipo_produto'],
            'cod_produto' => $linha['cod_produto'],
            'cod_cliente' => $linha['cod_cliente'],
            'tipo_cliente' => $linha['tipo_cliente'],
            'status' => $linha['status'],
            'STS_DESCRICAO' => $linha['STS_DESCRICAO'],
            'data_entrega' => date($linha['data_entrega']),
            'data_emissao' => date($linha['data_emissao']),
        ];

        $Valor_QQ = 0; // Inicializa a variável $Valor_QQ

        if ($linha['status'] == '12') {
            $cod_produto_QQ = $linha['cod_produto'];
            $Cod_Op_QQ = $linha['cod'];
            $Pesquisa_Orc_QQ = $linha['orcamento_base'];

            $query_Pesquisa_Orc_QQ = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento  WHERE cod_produto = '$cod_produto_QQ' AND cod_orcamento = $Pesquisa_Orc_QQ ");
            $query_Pesquisa_Orc_QQ->execute();

            if ($linha_QQ2 = $query_Pesquisa_Orc_QQ->fetch(PDO::FETCH_ASSOC)) {
                $Valor_QQ = $linha_QQ2['quantidade'] * $linha_QQ2['preco_unitario'];

                $QQvalor_total_Faturamentos = $conexao->prepare("SELECT * FROM faturamentos f WHERE  f.CODIGO_OP = '$Cod_Op_QQ'");
                $QQvalor_total_Faturamentos->execute();
                while ($linhaQQ = $QQvalor_total_Faturamentos->fetch(PDO::FETCH_ASSOC)) {
                    $Valor_QQ = $Valor_QQ - $linhaQQ['VLR_FAT'];
                }
            }
        }
        // echo 'Valor Total do calculo = '. $Valor_QQ .'<br>';
        $Pesquisa_Produto = $Ordens_Abertas[$i]['cod_produto'];
        $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_Produto'");
        $query_PRODUTOS->execute();

        while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
            $Tabela_Produtos_Abertas[$i] = [
                'descricao' => $linha2['DESCRICAO']
            ];
        }
        $Pesquisa_Orc = $Ordens_Abertas[$i]['orcamento_base'];
        $Pesquisa_Tipo_prod = $Ordens_Abertas[$i]['tipo_produto'];
        $query_Pesquisa_Orc = $conexao->prepare("SELECT cod_orcamento, cod_produto, tipo_produto, (quantidade * preco_unitario) AS VLR_PARC FROM tabela_produtos_orcamento WHERE cod_orcamento = '$Pesquisa_Orc' AND cod_produto = '$Pesquisa_Produto' AND tipo_produto = '$Pesquisa_Tipo_prod' ");
        $query_Pesquisa_Orc->execute();

        while ($linha2 = $query_Pesquisa_Orc->fetch(PDO::FETCH_ASSOC)) {
            if ($linha['status'] == '12') {
                $Tabela_Orc_Abertas[$i] = [
                    'valor_total' => $Valor_QQ
                ];
            } else {
                $Tabela_Orc_Abertas[$i] = [
                    'valor_total' => $linha2['VLR_PARC']
                ];
            }
        }
        $i++;
    }
    if (isset($Ordens_Abertas)) {
        $Total_Abertas = count($Ordens_Abertas);
    } else {
        $Total_Abertas = 0;
    }
    $Percorrer_Notas = 0;
    $Percorrer_Faturamentos = 0;
    $Percorrer_Abertas = 0;
    $valor_total_Abertas = 0;
    $valor_total_Faturamentos = 0;
    $valor_total_Notas = 0;
    $Acumulado_Anterior = 0;
    /////////////////////////////////////// FIM OP ABERTAS ///////////////////////////////////////////////////////////////


    while ($Total_Notas > $Percorrer_Notas) {
        $valor_total_Notas =  $valor_total_Notas + $Tabela_Notas[$Percorrer_Notas]["valor"];
        $Percorrer_Notas++;
    }
    while ($Total_Notas2 > $Percorrer_Notas2) {
        $valor_total_Notas2 =  $valor_total_Notas2 + $Tabela_Notas2[$Percorrer_Notas2]["valor"];
        $Percorrer_Notas2++;
    }
    while ($Total_Faturamentos > $Percorrer_Faturamentos) {
        $valor_total_Faturamentos =  $valor_total_Faturamentos + $Tabela_Faturamentos[$Percorrer_Faturamentos]["VLR_FAT"];
        $Percorrer_Faturamentos++;
    }
    while ($Total_Faturamentos2 > $Percorrer_Faturamentos2) {
        $valor_total_Faturamentos2 =  $valor_total_Faturamentos2 + $Tabela_Faturamentos2[$Percorrer_Faturamentos2]["VLR_FAT"];
        $Percorrer_Faturamentos2++;
    }
    while ($Total_Faturamentos3 > $Percorrer_Faturamentos3) {
        $valor_total_Faturamentos3 =  $valor_total_Faturamentos3 + $Tabela_Faturamentos3[$Percorrer_Faturamentos3]["VLR_FAT"];
        $Percorrer_Faturamentos3++;
    }
    while ($Total_Abertas > $Percorrer_Abertas) {
        $valor_total_Abertas =  $valor_total_Abertas + $Tabela_Orc_Abertas[$Percorrer_Abertas]["valor_total"];
        $Percorrer_Abertas++;
    }
 //  echo 'Valor notas anterior = ' . $valor_total_Notas2 . '<br> valor de faturamentos anterior = '. $valor_total_Faturamentos2 . '<br> valor atual de notas = '. $valor_total_Notas . '<br> valor de faturamentos atual = '. $valor_total_Faturamentos;
   
    $Calculo_Total = 0;
    if ($_POST['pordata'] == 'mes') {
        $debito = $valor_total_Faturamentos2;
        $Acumulado_Anterior = $valor_total_Notas2 - $valor_total_Faturamentos3;
        $Calculo_Total =  $Acumulado_Anterior - $valor_total_Faturamentos2 - $valor_total_Abertas;
    } else {
         $debito = $valor_total_Faturamentos2;
         $Acumulado_Anterior = ($valor_total_Notas2 - $valor_total_Notas) - $valor_total_Faturamentos3;
        $Calculo_Total =  $valor_total_Notas2 - $valor_total_Faturamentos - $valor_total_Abertas;
    }
    $Corpo = $Corpo . '<tr>
        <td>' . $cod . '</td>
        <td>' . $nome . '</td>
        <td>R$ ' . number_format($Acumulado_Anterior, 2, ',', '.') . ' </td>
        <td>R$ ' . number_format($valor_total_Notas, 2, ',', '.') . ' </td>
        <td> R$ ' . number_format($debito, 2, ',', '.') . ' </td>
        <td> R$ ' . number_format($valor_total_Abertas, 2, ',', '.') . ' </td>
        <td> R$ ' . number_format($Calculo_Total, 2, ',', '.') . ' </td>
        </tr>
        ';
        $Total_Anteriror = $Total_Anteriror + $Acumulado_Anterior;
        $Total_total_Notas = $Total_total_Notas + $valor_total_Notas;
        $Total_debito = $Total_debito + $debito;
        $Total_total_Abertas = $Total_total_Abertas + $valor_total_Abertas;
        $Total_Calculo = $Total_Calculo + $Calculo_Total;
    $valor_total_Faturamentos = 0;
    $Calculo_Total = 0;
    $Calculo_Total = 0;
}
$TotalFinal = '<tr>
<td colspan="2" style="text-allign: center;"><b>TOTAL</b></td>
<td><b>R$ ' . number_format($Total_Anteriror, 2, ',', '.') . ' </b></td>
<td><b>R$ ' . number_format($Total_total_Notas, 2, ',', '.') . ' </b></td>
<td><b> R$ ' . number_format($Total_debito, 2, ',', '.') . ' </b></td>
<td><b> R$ ' . number_format($Total_total_Abertas, 2, ',', '.') . ' </b></td>
<td><b> R$ ' . number_format($Total_Calculo, 2, ',', '.') . ' </b></td>
</tr>
';
$html = $titulo .  $Cabesalho . $Corpo . $TotalFinal.  '</table>';

//echo $html;
/////////////////////////////////////////////
///////////////// CODIGO FIXO ///////////////
/////////////////////////////////////////////
require_once __DIR__ . '../../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \mPDF();

if ($_POST['orientacao']) {
    if ($_POST['orientacao'] == 'retrato') {
        // Write some HTML code:
        $mpdf = new mPDF('C', 'A4');
    }
}
if ($_POST['orientacao']) {
    if ($_POST['orientacao'] == 'paisagem') {
        // Write some HTML code:
        $mpdf = new mPDF('C', 'A4-L');
    }
}


$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first 
//level of a list

// LOAD a stylesheet

$mpdf->WriteHTML($html, 2);
$nome = 'Relatorio_fianceiro_de_'.$Ate .'pdf';
$mpdf->Output($nome, 'I');
exit;