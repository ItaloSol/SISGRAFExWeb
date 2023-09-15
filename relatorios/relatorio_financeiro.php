<!DOCTYPE html>
<?php

include_once('../conexoes/conexao.php');
include_once('../conexoes/conn.php');
/////////////////////////////////////////////
// CODIGO VARIAVEL // $html => VARIAVEL OBRIGATORIA PARA CRIAÇÃO DO PDF, INTRUÇÕES EM HTML 
if (isset($_POST['submit'])) {
    if (isset($_POST['tipo_cliente'])) {
        $Tipo_cliente = $_POST['tipo_cliente'];
        if ($Tipo_cliente == '1') {
            $Cliente = 'fisicos';
        } else {
            $Cliente = 'juridicos';
        }
    }
    if (isset($_POST['diferente'])) {
        $Diferente = "tabela_clientes_" . $Cliente . ".credito != 0";
    } else {
        $Diferente = "";
    }
    if (isset($_POST['periodo'])) {
        $Creditos = ' WHERE ';
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
    } else {
        $Creditos = '';
    }
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
            $DATA = $DATA . " STR_TO_DATE(data, '%d/%m/%Y') BETWEEN STR_TO_DATE('" . $dia1 . '/' . $Valor1 . '/' . $Valor2 . "', '%d/%m/%Y') AND STR_TO_DATE('" . $dia2 . '/' . $Valor1 . '/' . $Valor2 . "', '%d/%m/%Y')";
        } else {
            $Valor = $_POST['ano'];
            $dia = '01';
            $mes = '01';
            $dia1 = '31';
            $mes1 = '12';
            $DATA = $DATA . " STR_TO_DATE(data, '%d/%m/%Y') BETWEEN STR_TO_DATE('" . $dia . '/' . $mes . '/' . $Valor . "', '%d/%m/%Y') AND STR_TO_DATE('" . $dia1 . '/' . $mes1 . '/' . $Valor . "', '%d/%m/%Y')";
        }
    }
    if (isset($_POST['ordenar'])) {
        $Ordernar = " ORDER BY tabela_clientes_" . $Cliente . ".credito DESC";
    } else {
        $Ordernar = '';
    }
    if (isset($_POST['orientacao'])) {
        $Orientacao = $_POST['orientacao'];
    }
}
$Principal = 0;
$numero_clientes = 0;
$Valor_Notas_Totais[$numero_clientes] = array();
//     /////////////////////////////////////////////
//     /////// BUSCAR NO BANCO DE DADOS ////////////
//     /////////////////////////////////////////////

$query_Clientes = $conexao->prepare("SELECT * FROM tabela_clientes_$Cliente $Creditos $Ordernar ");
$query_Clientes->execute();

$a = 0;
while ($linha = $query_Clientes->fetch(PDO::FETCH_ASSOC)) {
    $cod_cliente = $linha['cod'];
    $valor_todo = 0;
    $Tabela_Clientes[$numero_clientes] = [
        'cod' => $linha['cod'],
        'nome' => $linha['nome'],
        'atividade' => $linha['atividade'],
        'credito' => $linha['credito'],
    ];

    $cod = $Tabela_Clientes[$numero_clientes]['cod'];

    $query_Notas = $conexao->prepare("SELECT * FROM tabela_notas $DATA AND tipo_pessoa = '$Tipo_cliente' AND cod_cliente = $cod_cliente");
    $query_Notas->execute();
    $nt_total = 0;
    while ($linha = $query_Notas->fetch(PDO::FETCH_ASSOC)) {
        $Tabela_Notas[$i] = [
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
        $valor_ = $linha['valor'];
           
          $valor_todo = $valor_todo + $valor_;
        $i++;
    }
    $Valor_Notas_Totais[$numero_clientes] =  $valor_todo;
    $Percorrer_Notas = 0;
    $valor_total_Notas = 0;

    $query_Ordens_Producao = $conexao->prepare("SELECT * FROM faturamentos f INNER JOIN tabela_ordens_producao o  ON o.cod = f.CODIGO_OP WHERE o.cod_cliente = '$cod' AND o.tipo_cliente = '$Tipo_cliente'");
    $query_Ordens_Producao->execute();
    $i = 0;
    $valor_faturamento = 0;
    while ($linha = $query_Ordens_Producao->fetch(PDO::FETCH_ASSOC)) {

        $Tabela_Faturamentos[$numero_clientes] = [
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
            'SERVICOS_FAT' => $linha['SERVICOS_FAT'],
            'OBSERVACOES' => $linha['OBSERVACOES'],
        ];
        $Pesquisa_Produto = $Tabela_Faturamentos[$numero_clientes]['cod_produto'];
        $Tipo_Produto = $Tabela_Faturamentos[$numero_clientes]['tipo_produto'];
        if ($Tipo_Produto == '2') {
            $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos_pr_ent  WHERE CODIGO = '$Pesquisa_Produto'");
            $query_PRODUTOS->execute();

            while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                $Tabela_Produtos[$numero_clientes] = [
                    'descricao' => $linha2['DESCRICAO']
                ];
            }
        }
        if ($Tipo_Produto == '1') {
            $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_Produto'");
            $query_PRODUTOS->execute();

            while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                $Tabela_Produtos[$numero_clientes] = [
                    'descricao' => $linha2['DESCRICAO']
                ];
            }
        }
        $valor_faturamento = $valor_faturamento + $linha['VLR_FAT'];

        //echo $linha['cod'].' '.$linha['VLR_FAT'] .'<br>';
        $i++;
    }
    $Total_Faturamentos[$numero_clientes] = $valor_faturamento;



    // /////////////////////////////////////// FIM OP FINALZIADAS ///////////////////////////////////////////////////////////////

    // /////////////////////////////////// OP ABERTAS //////////////////////////////////////////////////////
    $query_ordens_Abertas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO WHERE o.cod_cliente = '$cod' AND o.status != '11' AND o.status != '13'");
    $query_ordens_Abertas->execute();
    $i = 0;
    $valor_emproducao = 0;
    while ($linha = $query_ordens_Abertas->fetch(PDO::FETCH_ASSOC)) {
        $Ordens_Abertas[$numero_clientes] = [
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
        if ($linha['status'] == '12') {
            $cod_produto_QQ = $linha['cod_produto'];
            $Cod_Op_QQ = $linha['cod'];
            $Pesquisa_Orc_QQ = $linha['orcamento_base'];

            $query_Pesquisa_Orc_QQ = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento  WHERE cod_produto = '$cod_produto_QQ' AND cod_orcamento = $Pesquisa_Orc_QQ ");
            $query_Pesquisa_Orc_QQ->execute();
            // echo "codigo op: ". $Cod_Op_QQ ."<br>";


            if ($linha_QQ2 = $query_Pesquisa_Orc_QQ->fetch(PDO::FETCH_ASSOC)) {
                $Valor_QQ = $linha_QQ2['quantidade'] * $linha_QQ2['preco_unitario'];

                //   echo "Valor Total: ". $Valor_QQ . "<br>";
                $QQvalor_total_Faturamentos = $conexao->prepare("SELECT * FROM faturamentos f WHERE  f.CODIGO_OP = '$Cod_Op_QQ'");
                $QQvalor_total_Faturamentos->execute();
                while ($linhaQQ = $QQvalor_total_Faturamentos->fetch(PDO::FETCH_ASSOC)) {
                    // echo "Valores de fatuamento: ". $linhaQQ['VLR_FAT']. "<br>";
                    //   echo 'CALCULO: '. $Valor_QQ .' - '. $linhaQQ['VLR_FAT'] ;
                    $Valor_QQ = $Valor_QQ - $linhaQQ['VLR_FAT'];
                }
            }
        }
        $Pesquisa_Produto = $Ordens_Abertas[$numero_clientes]['cod_produto'];
        $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_Produto'");
        $query_PRODUTOS->execute();

        while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
            $Tabela_Produtos_Abertas[$numero_clientes] = [
                'descricao' => $linha2['DESCRICAO']
            ];
        }
        $Pesquisa_Orc = $Ordens_Abertas[$numero_clientes]['orcamento_base'];
        $Pesquisa_Tipo_prod = $Ordens_Abertas[$numero_clientes]['tipo_produto'];
        $query_Pesquisa_Orc = $conexao->prepare("SELECT cod_orcamento, cod_produto, tipo_produto, (quantidade * preco_unitario) AS VLR_PARC FROM tabela_produtos_orcamento WHERE cod_orcamento = '$Pesquisa_Orc' AND cod_produto = '$Pesquisa_Produto' AND tipo_produto = '$Pesquisa_Tipo_prod' ");
        $query_Pesquisa_Orc->execute();

        while ($linha2 = $query_Pesquisa_Orc->fetch(PDO::FETCH_ASSOC)) {
            if ($linha['status'] == '12') {
                $valor =  $Valor_QQ;
            } else {
                $valor = $linha2['VLR_PARC'];
            }
            $valor_emproducao = $valor_emproducao + $valor;
        }
        $Total_EmProducao[$numero_clientes] = $valor_emproducao;
        $i++;
    }
    if (!isset($Total_EmProducao[$numero_clientes])) {
        $Total_EmProducao[$numero_clientes] = 0;
    }
    if (!isset($Tabela_Clientes[$numero_clientes])) {
        $Tabela_Clientes[$numero_clientes] = 0;
    }
    if (!isset($Valor_Notas_Totais[$numero_clientes])) {
        $Valor_Notas_Totais[$numero_clientes] = 0;
    }
    echo $cod_cliente.' - '. $Valor_Notas_Totais[$numero_clientes] .' - '. $Total_Faturamentos[$numero_clientes]. ' - ' . $Total_EmProducao[$numero_clientes]. '<br>';
    // $Saldo_Correto[$numero_clientes] = $Valor_Notas_Totais[$numero_clientes] - $Total_Faturamentos[$numero_clientes] - $Total_EmProducao[$numero_clientes];
    // $Diferenca_Correcao[$numero_clientes] = $Saldo_Correto[$numero_clientes] - $Tabela_Clientes[$numero_clientes]['credito'];

    $numero_clientes++;
}









//     /// FIM BANCO DE DADOS///
//     date_default_timezone_set('America/Sao_Paulo');
//     $data_hora   = date('d/m/Y H:i:s ', time());
//     $data_horaa = (string) $data_hora;

//     $titulo = "<h5>RELATÓRIO FINANCEIRO - DATA E HORA DE EMISSÃO: " . $data_horaa . " - SISGRAFEX</h5><br>";

// 
?><title><?= $titulo ?></title><?php

//                                 $sub_titulo = "<h2>RELATÓRIO FINANCEIRO <br>." . $Mes . "/" . $Ano . " - PESSOAS " . $Tipo_Pessoa_ . "</h2><br>";

//                                 /////////////////////////////////////////// NOTAS //////////////////////

//                                 $Relatorio_Financeiro = "<table style=' solid black;  border-collapse:collapse; font-size: 10; 
//                     text-align: center;
//                     color: black;' border='1' class='table'>
//         <tr>
//         <th  style=' color:Black'>CÓDIGO</th>
//         <th style=' color:Black'>NOME</th>
//         <th  style=' color:Black'>SALDO ACUMULADO ANTERIOR</th>
//         <th  style=' color:Black'>CRÉDITO</th>
//         <th  style=' color:Black'>DÉBITO</th>
//         <th  style=' color:Black'>EM ABERTO ABERTO ATÉ " . $Mes . "/" . $Ano . " </th>
//         <th style=' color:Black'>SALDO ACUMULADO ATUAL</th>
//         </tr>
//         <tr>";
//                             }
//                             while ($Principal > $Percorrer_Notas) {
//                                 if ($Percorrer_Notas == 0) {
//                                     $relatorio =  '<tr><td >' . $tablea_cliente[$Percorrer_Notas]["cod"] . ' </td>' .
//                                         '<td >' . $tablea_cliente[$Percorrer_Notas]["nome"] . ' </td>' .
//                                         '<td > R$ 0 </td>' .
//                                         '<td > R$ ' . number_format($Total_Notas_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
//                                         '<td > R$ ' . number_format($Total_Faturamento_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
//                                         '<td > R$ ' . number_format($Total_Op_Aberta_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
//                                         '<td > R$ ' . number_format($Total_Geral_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td></tr>';
//                                 } else {
//                                     $relatorio = $relatorio .  '<tr><td colspan="1">' . $tablea_cliente[$Percorrer_Notas]["cod"] . ' </td>' .
//                                         '<td >' . $tablea_cliente[$Percorrer_Notas]["nome"] . ' </td>' .
//                                         '<td > R$ 0 </td>' .
//                                         '<td > R$ ' . number_format($Total_Notas_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
//                                         '<td > R$ ' . number_format($Total_Faturamento_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
//                                         '<td > R$ ' . number_format($Total_Op_Aberta_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
//                                         '<td > R$ ' . number_format($Total_Geral_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td></tr>';
//                                 }
//                                 $Percorrer_Notas++;
//                             }
//                             echo $titulo . $sub_titulo . $Relatorio_Financeiro . $relatorio;
// //print_r($Total_Notas_Solo). '<br>';