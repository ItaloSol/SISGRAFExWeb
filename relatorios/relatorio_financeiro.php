<!DOCTYPE html>
<p>Ainda não disponivel!</p>
<?php

include_once('../conexoes/conexao.php');
include_once('../conexoes/conn.php');
/////////////////////////////////////////////
// CODIGO VARIAVEL // $html => VARIAVEL OBRIGATORIA PARA CRIAÇÃO DO PDF, INTRUÇÕES EM HTML 
if (isset($_POST['submit'])) {
    $Data = $_POST['data_selecionada'];
    $Mes = date('m', strtotime($Data));
    $Ano = date('Y', strtotime($Data));
    if (isset($_POST['ANO'])) {
        $Periodo = date('Y', strtotime($Data));
        $Periodo_Inicio_Op_Orc_Fat = $Ano - 1;
        $Periodo_Final_Op_Orc_Fat = $Ano + 1;
        $Periodo_Total = ' data_emissao > "' . $Periodo_Inicio_Op_Orc_Fat . '-01-01" AND data_emissao < "' . $Periodo_Final_Op_Orc_Fat . '-12-31" ';
        $Periodo_Total_Fat = ' f.DT_FAT > "' . $Ano . '-01-01" AND f.DT_FAT < "' . $Ano . '-12-31" ';
        $Periodo_Total_Notas = ' data > "01/01/' . $Periodo_Inicio_Op_Orc_Fat . '" AND data < "31/12/' . $Periodo_Final_Op_Orc_Fat . '" ';
    } else {
        $Periodo = date('Y-m', strtotime($Data));
        $Periodo_Inicio_Op_Orc_Fat = $Ano - 1;
        $Periodo_Final_Op_Orc_Fat = $Ano + 1;
        $Periodo_Total = ' data_emissao > "' . $Ano . '-' . $Mes . '-01" AND data_emissao < "' . $Ano . '-' . $Mes . '-30" ';
        $Periodo_Total_Fat = " f.DT_FAT > '" . $Ano . "-" . $Mes . "-01' AND f.DT_FAT < '" . $Ano . "-" . $Mes . "-30' ";
        $Periodo_Total_Notas = ' data > "01/' . $Mes . '/' . $Ano . '" AND data < "31/' . $Mes . '/' . $Ano . '" ';
    }
    if (isset($_POST['ordenar'])) {
        if ($_POST['ordenar'] == 'Crescente') {
            $Order = ' n.valor ASC ';
        }
    } else {
        $Order = ' n.valor DESC ';
    }
    if (isset($_POST['tipocliente'])) {
        $tipo_cliente = $_POST['tipocliente'];
        if ($tipo_cliente == '1') {
            $Tipo_Pessoa_ = 'FÍSICAS';
        }
        if ($tipo_cliente == '2') {
            $Tipo_Pessoa_ = 'JURÍDICAS';
        }
    }
    if (isset($_POST['periodo'])) {
        if ($_POST['periodo'] == 'entreate') {
            $Where = 'n.valor > "' . $_POST['entre'] . '" AND n.valor < "' . $_POST['ate'] . '" ';
        }
        if ($_POST['periodo'] == 'maior') {
            $Where = 'n.valor > "' . $_POST['vlrmaior'] . '" ';
        }
        if ($_POST['periodo'] == 'menor') {
            $Where = 'n.valor > "' . $_POST['vlrmenor'] . '" ';
        }
        if ($_POST['periodo'] == 'igual') {
            $Where = 'n.valor = "' . $_POST['vlrigual'] . '" ';
        }
        if ($_POST['periodo'] == 'diferente') {
            $Where = 'n.valor != "' . $_POST['vlrdiferente'] . '" ';
        }
    } else {
        $Where = 'n.valor != "-99999" ';
    }
}
// echo 'WHERE => ' . $Where . '<br>';
// echo 'tipo_cliente => ' . $tipo_cliente . '<br>';
// echo 'Data => ' . $Data . '<br>';
// echo 'Periodo => ' . $Periodo . '<br>';
// echo 'Order => ' . $Order . '<br>';
// echo 'Mes => ' . $Mes . '<br>';
// echo 'Ano => ' . $Ano . '<br>';
$CLL = 10;
$LLC = -33;
$TTT = $CLL + $LLC;

// echo 'Periodo_Total_Fat => ' . $Periodo_Total_Fat . '<br>';
// echo 'Periodo_Total => ' . $Periodo_Total . '<br>';
// echo 'Periodo_Total_Notas => ' . $Periodo_Total_Notas . '<br>';
// echo 'Periodo_Inicio_Op_Orc_Fat => ' . $Periodo_Inicio_Op_Orc_Fat . '<br>';
// echo 'Periodo_Final_Op_Orc_Fat => ' . $Periodo_Final_Op_Orc_Fat . '<br>';
// echo 'Tipo = '. $_POST['relatorio'];
// echo $busca_por . ' - ' . $tablea_cliente[$Principal]['cod'] . ' - ' . $tipo_cliente;
$false = 't';
if ($false == 't') {
    /////////////////////////////////////////////
    /////// BUSCAR NO BANCO DE DADOS ////////////
    /////////////////////////////////////////////
    $a = 0;
    if ($tipo_cliente == '1') {


        $query_Clientes = $conexao->prepare("SELECT * FROM tabela_clientes ORDER BY cod ASC");
        $query_Clientes->execute();
    }

    if ($tipo_cliente == '2') {

        $query_Clientes = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos  ORDER BY cod ASC ");
        $query_Clientes->execute();
    }
    while ($linha = $query_Clientes->fetch(PDO::FETCH_ASSOC)) {
        $tablea_cliente[$a] = [
            'cod' => $linha['cod'],
            'nome' => $linha['nome'],
            'cnpj' => $linha['cnpj'],
            'atividade' => $linha['atividade'],
            'filial_coligada' => $linha['filial_coligada'],
            'cod_atendente' => $linha['cod_atendente'],
            'nome_atendente' => $linha['nome_atendente'],
            'observacao' => $linha['observacao'],
            'credito' => $linha['credito'],
            'senha' => $linha['senha'],
            'excluido' => $linha['excluido']
        ];
        $a++;
    }

    $Total_de_Clientes = count($tablea_cliente);
    $Principal = 0;
    while ($Total_de_Clientes > $Principal) {
        $Cliente = $tablea_cliente[$Principal]['cod'];
       // echo "SELECT * FROM tabela_notas n WHERE $Where AND n.tipo_pessoa = '$tipo_cliente' AND cod_cliente = '$Cliente' AND $Periodo_Total_Notas ORDER BY $Order ";
        /////////////////////////////////// NOTAS DE CREDITO //////////////////////////////////////////////////////
        $query_Notas = $conexao->prepare("SELECT * FROM tabela_notas n WHERE $Where AND n.tipo_pessoa = '$tipo_cliente' AND cod_cliente = '$Cliente' AND $Periodo_Total_Notas ORDER BY $Order ");
        $query_Notas->execute();
        $nt_total = 0;
        while ($linha = $query_Notas->fetch(PDO::FETCH_ASSOC)) {
            $Tabela_Notas[$nt_total] = [
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
            if (isset($Tabela_Notas[$nt_total]['valor'])) {
                if (isset($Total_Notas_Solo[$Principal])) {
                    $Total_Notas_Solo[$Principal] = $Total_Notas_Solo[$Principal] + $Tabela_Notas[$nt_total]['valor'];
                } else {
                    $Total_Notas_Solo[$Principal] = $Tabela_Notas[$nt_total]['valor'];
                }
            }
            $nt_total++;
        }
        if (!isset($Total_Notas_Solo[$Principal])) {
            $Total_Notas_Solo[$Principal] = 0;
        }
        $Total_Notas_Geral = array_sum($Total_Notas_Solo);
        if (isset($Tabela_Notas)) {
            $Total_Notas = count($Tabela_Notas);
        } else {
            $Total_Notas = 0;
        }
        $Percorrer_Notas = 0;
        $valor_total_Notas = 0;
        //  while($Total_Notas > $Percorrer_Notas){  
        /////////////////////////////////////// FIM NOTAS ///////////////////////////////////////////////////////////////

        /////////////////////////////////////// FATURAMENTOS ////////////////////////////////////////////////////////////
        //echo "SELECT * FROM faturamentos f INNER JOIN tabela_ordens_producao o  ON o.cod = f.CODIGO_OP WHERE o.cod_cliente = $Cliente AND o.tipo_cliente = '$tipo_cliente' AND $Periodo_Total_Fat ORDER BY o.cod_cliente ASC";
        $query_Ordens_Producao = $conexao->prepare("SELECT * FROM faturamentos f INNER JOIN tabela_ordens_producao o  ON o.cod = f.CODIGO_OP WHERE o.cod_cliente = $Cliente AND o.tipo_cliente = '$tipo_cliente' AND $Periodo_Total_Fat ORDER BY o.cod_cliente ASC");
        $query_Ordens_Producao->execute();
        $i = 0;
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
                'SERVICOS_FAT' => $linha['SERVICOS_FAT'],
                'OBSERVACOES' => $linha['OBSERVACOES'],
            ];
            $Pesquisa_Produto = $Tabela_Faturamentos[$i]['cod_produto'];
            $Tipo_Produto = $Tabela_Faturamentos[$i]['tipo_produto'];
            if ($Tipo_Produto == '2') {
                $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos_pr_ent  WHERE CODIGO = '$Pesquisa_Produto'");
                $query_PRODUTOS->execute();

                while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                    $Tabela_Produtos[$i] = [
                        'descricao' => $linha2['DESCRICAO']
                    ];
                }
            }
            if ($Tipo_Produto == '1') {
                $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_Produto'");
                $query_PRODUTOS->execute();

                while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                    $Tabela_Produtos[$i] = [
                        'descricao' => $linha2['DESCRICAO']
                    ];
                }
            }
            if (isset($Tabela_Faturamentos[$i]['VLR_FAT'])) {
                if (isset($Total_Faturamento_Solo[$Principal])) {
                    $Total_Faturamento_Solo[$Principal] = $Total_Faturamento_Solo[$Principal] + $Tabela_Faturamentos[$i]['VLR_FAT'];
                } else {
                    $Total_Faturamento_Solo[$Principal] = $Tabela_Faturamentos[$i]['VLR_FAT'];
                }
            }

            $i++;
        }
        if (!isset($Total_Faturamento_Solo[$Principal])) {
            $Total_Faturamento_Solo[$Principal] = 0;
        }
        $Total_Faturamento_Geral = array_sum($Total_Faturamento_Solo);
        if (isset($Tabela_Faturamentos)) {
            $Total_Faturamentos = count($Tabela_Faturamentos);
        } else {
            $Total_Faturamentos = 0;
        }

        $Percorrer_Faturamentos = 0;
        $valor_total_Faturamentos = 0;

        /////////////////////////////////////////FIM FATURAMENTOS ////////////////////////////////////////////////////////


        /////////////////////////////////// OP ABERTAS //////////////////////////////////////////////////////
        $query_ordens_Abertas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO WHERE o.cod_cliente = '$Cliente' AND o.status != '11' AND o.status != '13' AND $Periodo_Total ");
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
            $Pesquisa_Produto = $Ordens_Abertas[$i]['cod_produto'];
            $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_Produto'");
            $query_PRODUTOS->execute();

            while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                $Tabela_Produtos_Abertas[$i] = [
                    'descricao' => $linha2['DESCRICAO']
                ];
            }
            $Pesquisa_orcamento = $Ordens_Abertas[$i]['orcamento_base'];
            $query_orcamentoS = $conexao->prepare("SELECT * FROM tabela_orcamentos  WHERE cod = '$Pesquisa_orcamento' AND status != '9' AND status != '10' AND status != '12' AND status != '13' AND status != '14' AND status != '15' AND status != '6' AND status != '5' ");
            $query_orcamentoS->execute();

            if ($linha2 = $query_orcamentoS->fetch(PDO::FETCH_ASSOC)) {
                $Tabela_orcamentos_Abertas[$i] = [
                    'valor_total' => $linha2['valor_total']
                ];
            }
            $Pesquisa_Orc = $Ordens_Abertas[$i]['orcamento_base'];
            $Pesquisa_Tipo_prod = $Ordens_Abertas[$i]['tipo_produto'];
            $query_Pesquisa_Orc = $conexao->prepare("SELECT cod_orcamento, cod_produto, tipo_produto, (quantidade * preco_unitario) AS VLR_PARC FROM tabela_produtos_orcamento WHERE
     cod_orcamento = '$Pesquisa_Orc' AND cod_produto = '$Pesquisa_Produto' AND tipo_produto = '$Pesquisa_Tipo_prod' ");
            $query_Pesquisa_Orc->execute();

            while ($linha2 = $query_Pesquisa_Orc->fetch(PDO::FETCH_ASSOC)) {
                $Tabela_Orc_Abertas[$i] = [
                    'valor_total' => $linha2['VLR_PARC']
                ];
            }
            if (isset($Total_Op_Aberta_Solo[$Principal])) {
                $Total_Op_Aberta_Solo[$Principal] = $Total_Op_Aberta_Solo[$Principal] + $Tabela_orcamentos_Abertas[$i]['valor_total'];
            } else {
                $Total_Op_Aberta_Solo[$Principal] = $Tabela_orcamentos_Abertas[$i]['valor_total'];
            }
            $i++;
        }
        $Total_Op_Aberta_Geral = array_sum($Total_Op_Aberta_Solo);
        if (isset($Ordens_Abertas)) {
            $Total_Abertas = count($Ordens_Abertas);
        } else {
            $Total_Abertas = 0;
        }
        $Percorrer_Abertas = 0;
        $valor_total_Abertas = 0;
        /////////////////////////////////////// FIM OP ABERTAS ///////////////////////////////////////////////////////////////

        /////////////////////////////////////// PROPOSTAS DE ORÇAMENTO ////////////////////////////////////////////////////////////
        $EmAvaliacao = 0; // 1
        $EnviadoParaProducao = 0; // 2
        $EnviadoParaOd = 0; // 3
        $AutoriadoOd = 0; // 4
        $NaoAutorizadoOd = 0; // 5
        $NaoAutorizadoCliente = 0; // 6
        $ParaExpedicao = 0; // 7
        $Entregue = 0; // 9
        $EntregaCancelada = 0; // 10
        $AutorizadoOdCliente = 0; // 11
        $NaoAutorizadoOdCliente = 0; // 12
        $Cancelada = 0; // 13
        $CanceladaPrazo = 0; // 14
        $CanceladaParcial = 0; // 15
        $query_Orcamentos = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.status = s.CODIGO WHERE o.cod_cliente = '$Cliente' AND o.tipo_cliente = '$tipo_cliente' AND $Periodo_Total");
        $query_Orcamentos->execute();
        $i = 0;
        while ($linha = $query_Orcamentos->fetch(PDO::FETCH_ASSOC)) {

            $Tabela_Orcamentos[$i] = [
                'cod' => $linha['cod'],
                'data_validade' => $linha['data_validade'],
                'data_emissao' => $linha['data_emissao'],
                'status' => $linha['status'],
                'STS_DESCRICAO' => $linha['STS_DESCRICAO'],
                'valor_total' => $linha['valor_total']
            ];

            if ($Tabela_Orcamentos[$i]['status'] == '9') {
                if (isset($Total_Entregue_Solo[$Principal])) {
                    $Total_Entregue_Solo[$Principal] = $Total_Entregue_Solo[$Principal] + $Tabela_Orcamentos[$i]['valor_total'];
                } else {
                    $Total_Entregue_Solo[$Principal] = $Tabela_Orcamentos[$i]['valor_total'];
                }
            }


            $i++;
        }
        if (!isset($Total_Entregue_Solo[$Principal])) {
            $Total_Entregue_Solo[$Principal] = 0;
        }
        $Total_Entregue_Geral = array_sum($Total_Entregue_Solo);
        if (isset($Tabela_Orcamentos)) {
            $Total_Orcamentos = count($Tabela_Orcamentos);
        } else {
            $Total_Orcamentos = 0;
        }

        $Percorrer_Orcamentos = 0;
        $valor_total_Orcamentos = 0;
        if (isset($Total_Faturamento_Solo[$Principal])) {
            $Total_Geral_Solo[$Principal] = $Total_Faturamento_Solo[$Principal];
        } else {
            $Total_Faturamento_Solo[$Principal] = 0;
        }
        if (isset($Total_Notas_Solo[$Principal])) {
            if (isset($Total_Geral_Solo[$Principal])) {
                $Total_Geral_Solo[$Principal] = $Total_Geral_Solo[$Principal] + $Total_Notas_Solo[$Principal];
            } else {
                $Total_Geral_Solo[$Principal] = $Total_Notas_Solo[$Principal];
            }
        } else {
            $Total_Notas_Solo[$Principal] = 0;
        }
        if (isset($Total_Op_Aberta_Solo[$Principal])) {
            if (isset($Total_Geral_Solo[$Principal])) {
                $Total_Geral_Solo[$Principal] = $Total_Geral_Solo[$Principal] + $Total_Op_Aberta_Solo[$Principal];
            } else {
                $Total_Geral_Solo[$Principal] = $Total_Op_Aberta_Solo[$Principal];
            }
        } else {
            $Total_Op_Aberta_Solo[$Principal] = 0;
        }
        if (!isset($Total_Geral_Solo[$Principal])) {
            $Total_Geral_Solo[$Principal] = 0;
        }
        /////////////////////////////////////////FIM PROPOSTAS DE ORÇAMENTO ////////////////////////////////////////////////////////
        $Principal++;
    }
    /// FIM BANCO DE DADOS///
    date_default_timezone_set('America/Sao_Paulo');
    $data_hora   = date('d/m/Y H:i:s ', time());
    $data_horaa = (string) $data_hora;

    $titulo = "<h5>RELATÓRIO FINANCEIRO - DATA E HORA DE EMISSÃO: " . $data_horaa . " - SISGRAFEX</h5><br>";

?><title><?= $titulo ?></title><?php

                                $sub_titulo = "<h2>RELATÓRIO FINANCEIRO <br>." . $Mes . "/" . $Ano . " - PESSOAS " . $Tipo_Pessoa_ . "</h2><br>";

                                /////////////////////////////////////////// NOTAS //////////////////////

                                $Relatorio_Financeiro = "<table style=' solid black;  border-collapse:collapse; font-size: 10; 
                    text-align: center;
                    color: black;' border='1' class='table'>
        <tr>
        <th  style=' color:Black'>CÓDIGO</th>
        <th style=' color:Black'>NOME</th>
        <th  style=' color:Black'>SALDO ACUMULADO ANTERIOR</th>
        <th  style=' color:Black'>CRÉDITO</th>
        <th  style=' color:Black'>DÉBITO</th>
        <th  style=' color:Black'>EM ABERTO ABERTO ATÉ " . $Mes . "/" . $Ano . " </th>
        <th style=' color:Black'>SALDO ACUMULADO ATUAL</th>
        </tr>
        <tr>";
                            }
                            while ($Principal > $Percorrer_Notas) {
                                if ($Percorrer_Notas == 0) {
                                    $relatorio =  '<tr><td >' . $tablea_cliente[$Percorrer_Notas]["cod"] . ' </td>' .
                                        '<td >' . $tablea_cliente[$Percorrer_Notas]["nome"] . ' </td>' .
                                        '<td > R$ 0 </td>' .
                                        '<td > R$ ' . number_format($Total_Notas_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
                                        '<td > R$ ' . number_format($Total_Faturamento_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
                                        '<td > R$ ' . number_format($Total_Op_Aberta_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
                                        '<td > R$ ' . number_format($Total_Geral_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td></tr>';
                                } else {
                                    $relatorio = $relatorio .  '<tr><td colspan="1">' . $tablea_cliente[$Percorrer_Notas]["cod"] . ' </td>' .
                                        '<td >' . $tablea_cliente[$Percorrer_Notas]["nome"] . ' </td>' .
                                        '<td > R$ 0 </td>' .
                                        '<td > R$ ' . number_format($Total_Notas_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
                                        '<td > R$ ' . number_format($Total_Faturamento_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
                                        '<td > R$ ' . number_format($Total_Op_Aberta_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td>' .
                                        '<td > R$ ' . number_format($Total_Geral_Solo[$Percorrer_Notas], 2, ',', '.') . ' </td></tr>';
                                }
                                $Percorrer_Notas++;
                            }
                            echo $titulo . $sub_titulo . $Relatorio_Financeiro . $relatorio;
//print_r($Total_Notas_Solo). '<br>';