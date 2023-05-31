<!DOCTYPE html>

<?php
session_start();
include_once('../conexoes/conexao.php');
include_once('../conexoes/conn.php');
/////////////////////////////////////////////
// CODIGO VARIAVEL // $html => VARIAVEL OBRIGATORIA PARA CRIAÇÃO DO PDF, INTRUÇÕES EM HTML 
if (isset($_POST['submit'])) {
    $busca_por = $_POST['codigo'];

    $tipo_cliente = $_POST['tipo_cliente'];

    if ($busca_por == 'cod') {

        $seleciona_por = $_POST['numero'];
    }
    if ($busca_por == 'nom') {
        if($tipo_cliente == '1'){
                $seleciona_por = $_POST['usuario1'];
        }else{
                $seleciona_por = $_POST['usuario0'];
        }
    }
   
   
}
if (isset($_POST['relatorio'])) {
    if ($_POST['relatorio'] == 'Resumido') {
        $Detalhamento = 'Resumido';
    }
    if ($_POST['relatorio'] == 'Completo') {
        $Detalhamento = 'Completo';
    }
} else {
    $Detalhamento = 'Resumido';
}
if (isset($_POST['codigo']) && isset($_POST['tipo_cliente'])) {
} else {
    if (isset($_GET['cod']) && isset($_GET['tipo'])) {
        $busca_por = 'cod';
        $seleciona_por = $_GET['cod'];
        $tipo_cliente = $_GET['tipo'];
        $Detalhamento = 'Completo';
    } else {
        $_SESSION['msg'] = ' <div style=";" id="alerta"
        role="bs-toast"
        class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show "
        role="alert"
        aria-live="assertive"
        aria-atomic="true">
        <div class="toast-header">
          <i class="bx bx-bell me-2"></i>
          <div class="me-auto fw-semibold">Aviso!</div>
          <small>
            
            </small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        
        <div class="toast-body">
             É necessario adicionar o campo de Tipo de cliente e Código ou Nome!    
        </div>
      </div>';

        header("Location: tl-relatorio-detalhamento-de-cliente.php");
    }
}
// echo 'Tipo = '. $_POST['relatorio'];
// echo $busca_por . ' - ' . $seleciona_por . ' - ' . $tipo_cliente;

/////////////////////////////////////////////
/////// BUSCAR NO BANCO DE DADOS ////////////
/////////////////////////////////////////////

if ($tipo_cliente == '1') {
    if ($busca_por == "cod") {
        $Clientes_Juridicos = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE cod = '$seleciona_por' LIMIT 1");
        $Clientes_Juridicos->execute();

        while ($linha = $Clientes_Juridicos->fetch(PDO::FETCH_ASSOC)) {

            $cod = $linha['cod'];
            $nome = $linha['nome'];
            $cpf = $linha['cpf'];
            $atividade = $linha['atividade'];
            $cod_atendente = $linha['cod_atendente'];
            $nome_atendente = $linha['nome_atendente'];
            $observacoes = $linha['observacoes'];
            $credito = $linha['credito'];
            $senha = $linha['senha'];
        }
    }
    if ($busca_por == "nom") {
        if($_POST['numero1'] == ''){

        }
        $query_clientes_fisico = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE  nome LIKE '%$seleciona_por%'  LIMIT 1");
        $query_clientes_fisico->execute();

        while ($linha = $query_clientes_fisico->fetch(PDO::FETCH_ASSOC)) {
            $cod = $linha['cod'];
            $nome = $linha['nome'];
            $cpf = $linha['cpf'];
            $atividade = $linha['atividade'];
            $cod_atendente = $linha['cod_atendente'];
            $nome_atendente = $linha['nome_atendente'];
            $observacoes = $linha['observacoes'];
            $credito = $linha['credito'];
            $senha = $linha['senha'];
        }
    }
}

if ($tipo_cliente == '2') {
    if ($busca_por == "cod") {
        $query_Clientes_Juridicos = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE cod = $seleciona_por LIMIT 1  ");
        $query_Clientes_Juridicos->execute();

        while ($linha = $query_Clientes_Juridicos->fetch(PDO::FETCH_ASSOC)) {
            $cod = $linha['cod'];
            $nome = $linha['nome'];
            $nome_Fantasia = $linha['nome_fantasia'];
            $cnpj = $linha['cnpj'];
            $atividade = $linha['atividade'];
            $filial_coligada = $linha['filial_coligada'];
            $cod_atendente = $linha['cod_atendente'];
            $nome_atendente = $linha['nome_atendente'];
            $observacao = $linha['observacao'];
            $credito = $linha['credito'];
            $senha = $linha['senha'];
            $excluido = $linha['excluido'];
            $tOKEN = $linha['TOKEN'];
            $uLTIMO_ACESSO = $linha['ULTIMO_ACESSO'];
            $qTD_ACESSO = $linha['QTD_ACESSOS'];
        }
    }
    if ($busca_por == "nom") {
        $query_Clientes_Juridicos = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE  nome like '%$seleciona_por%' LIMIT 1  ");
        $query_Clientes_Juridicos->execute();

        while ($linha = $query_Clientes_Juridicos->fetch(PDO::FETCH_ASSOC)) {
            $cod = $linha['cod'];
            $nome = $linha['nome'];
            $nome_Fantasia = $linha['nome_fantasia'];
            $cnpj = $linha['cnpj'];
            $atividade = $linha['atividade'];
            $filial_coligada = $linha['filial_coligada'];
            $cod_atendente = $linha['cod_atendente'];
            $nome_atendente = $linha['nome_atendente'];
            $observacao = $linha['observacao'];
            $credito = $linha['credito'];
            $senha = $linha['senha'];
            $excluido = $linha['excluido'];
            $tOKEN = $linha['TOKEN'];
            $uLTIMO_ACESSO = $linha['ULTIMO_ACESSO'];
            $qTD_ACESSO = $linha['QTD_ACESSOS'];
        }
    }
}


/////////////////////////////////// NOTAS DE CREDITO //////////////////////////////////////////////////////
$query_Notas = $conexao->prepare("SELECT * FROM tabela_notas WHERE cod_cliente = '$cod'  AND tipo_pessoa = '$tipo_cliente'");
$query_Notas->execute();

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
//  while($Total_Notas > $Percorrer_Notas){  
/////////////////////////////////////// FIM NOTAS ///////////////////////////////////////////////////////////////

/////////////////////////////////////// FATURAMENTOS ////////////////////////////////////////////////////////////

$query_Ordens_Producao = $conexao->prepare("SELECT * FROM faturamentos f INNER JOIN tabela_ordens_producao o  ON o.cod = f.CODIGO_OP WHERE o.cod_cliente = '$cod' AND o.tipo_cliente = '$tipo_cliente'");
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

/////////////////////////////////// OP FINALIZADAS //////////////////////////////////////////////////////
$query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO WHERE o.cod_cliente = '$seleciona_por' AND o.status = '11'");
$query_ordens_finalizadas->execute();
$i = 0;
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
    } if(!isset($valor_fata[$i]['valor_total'])){
        $valor_fata[$i] = [
            'valor_total' => '0.00'
        ];
    }
    $ak = (int)$Tabela_Orc_Finalizados[$i]["valor_total"];
    $bk = (int)$valor_fata[$i]["valor_total"];
    $vkasd = $ak - $bk;
    if($vkasd == 0){
        $Relatorio_Faturada[$i] = '(TOTAL) R$ '. $Tabela_Orc_Finalizados[$i]["valor_total"] .'<br>(FATURADA) R$ '. $valor_fata[$i]["valor_total"] ;
    }else{
        $Relatorio_Faturada[$i] = '(TOTAL) R$ '. $Tabela_Orc_Finalizados[$i]["valor_total"] .'<br>(FATURADA) R$ '. $valor_fata[$i]["valor_total"] . ' <br>(PRODUÇÃO) R$ '. number_format($vkasd, 2, ',', '.');
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
$query_ordens_Abertas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO WHERE o.cod_cliente = '$seleciona_por' AND o.status != '11' AND o.status != '13'");
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
    $Pesquisa_Orc = $Ordens_Abertas[$i]['orcamento_base'];
    $Pesquisa_Tipo_prod = $Ordens_Abertas[$i]['tipo_produto'];
    $query_Pesquisa_Orc = $conexao->prepare("SELECT cod_orcamento, cod_produto, tipo_produto, (quantidade * preco_unitario) AS VLR_PARC FROM tabela_produtos_orcamento WHERE cod_orcamento = '$Pesquisa_Orc' AND cod_produto = '$Pesquisa_Produto' AND tipo_produto = '$Pesquisa_Tipo_prod' ");
    $query_Pesquisa_Orc->execute();

    while ($linha2 = $query_Pesquisa_Orc->fetch(PDO::FETCH_ASSOC)) {
        $Tabela_Orc_Abertas[$i] = [
            'valor_total' => $linha2['VLR_PARC']
        ];
    }
    $i++;
}
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
$query_Orcamentos = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.status = s.CODIGO WHERE o.cod_cliente = '$cod' AND o.tipo_cliente = '$tipo_cliente'");
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

    if ($Tabela_Orcamentos[$i]['status'] == '1') {
        $EmAvaliacao = $EmAvaliacao + $Tabela_Orcamentos[$i]['valor_total'];
    }
    if ($Tabela_Orcamentos[$i]['status'] == '2') {
        $EnviadoParaProducao = $EnviadoParaProducao + $Tabela_Orcamentos[$i]['valor_total'];
    }
    if ($Tabela_Orcamentos[$i]['status'] == '3') {
        $EnviadoParaOd = $EnviadoParaOd + $Tabela_Orcamentos[$i]['valor_total'];
    }
    if ($Tabela_Orcamentos[$i]['status'] == '4') {
        $AutoriadoOd = $AutoriadoOd + $Tabela_Orcamentos[$i]['valor_total'];
    }
    if ($Tabela_Orcamentos[$i]['status'] == '5') {
        $NaoAutorizadoOd = $NaoAutorizadoOd + $Tabela_Orcamentos[$i]['valor_total'];
    }
    if ($Tabela_Orcamentos[$i]['status'] == '6') {
        $NaoAutorizadoCliente = $NaoAutorizadoCliente + $Tabela_Orcamentos[$i]['valor_total'];
    }
    if ($Tabela_Orcamentos[$i]['status'] == '7') {
        $ParaExpedicao = $ParaExpedicao + $Tabela_Orcamentos[$i]['valor_total'];
    }

    if ($Tabela_Orcamentos[$i]['status'] == '9') {
        $Entregue = $Entregue + $Tabela_Orcamentos[$i]['valor_total'];
    }
    if ($Tabela_Orcamentos[$i]['status'] == '10') {
        $EntregaCancelada = $EntregaCancelada + $Tabela_Orcamentos[$i]['valor_total'];
    }
    if ($Tabela_Orcamentos[$i]['status'] == '11') {
        $AutorizadoOdCliente = $AutorizadoOdCliente + $Tabela_Orcamentos[$i]['valor_total'];
    }
    if ($Tabela_Orcamentos[$i]['status'] == '12') {
        $NaoAutorizadoOdCliente = $NaoAutorizadoOdCliente + $Tabela_Orcamentos[$i]['valor_total'];
    }
    if ($Tabela_Orcamentos[$i]['status'] == '13') {
        $Cancelada = $Cancelada + $Tabela_Orcamentos[$i]['valor_total'];
    }
    if ($Tabela_Orcamentos[$i]['status'] == '14') {
        $CanceladaPrazo = $CanceladaPrazo + $Tabela_Orcamentos[$i]['valor_total'];
    }
    if ($Tabela_Orcamentos[$i]['status'] == '15') {
        $CanceladaParcial = $CanceladaParcial + $Tabela_Orcamentos[$i]['valor_total'];
    }




    $Pesquisa_Produto = $Tabela_Orcamentos[$i]['cod'];
    $query_PRODUTOS = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento  WHERE cod_orcamento = '$Pesquisa_Produto'");
    $query_PRODUTOS->execute();

    while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
        $Tabela_Produtos_Orcamento[$i] = [
            'descricao_produto' => $linha2['descricao_produto'],
        ];
    }
    if (isset($Tabela_Produtos_Orcamento[$i]['descricao_produto'])) {
    } else {
        $Tabela_Produtos_Orcamento[$i]['descricao_produto'] = 'N/C';
    }
    $i++;
}
if (isset($Tabela_Orcamentos)) {
    $Total_Orcamentos = count($Tabela_Orcamentos);
} else {
    $Total_Orcamentos = 0;
}

$Percorrer_Orcamentos = 0;
$valor_total_Orcamentos = 0;

/////////////////////////////////////////FIM PROPOSTAS DE ORÇAMENTO ////////////////////////////////////////////////////////

/// FIM BANCO DE DADOS///
date_default_timezone_set('America/Sao_Paulo');
$data_hora   = date('d/m/Y H:i:s ', time());
$data_horaa = (string) $data_hora;
if ($Detalhamento == 'Completo') {
    $titulo = "<h5>DETALHAMENTO DE CLIENTE - DATA E HORA DE EMISSÃO: " . $data_horaa . " - SISGRAFEX</h5><br>";
} else {
    $titulo = "<h5>DETALHAMENTO RESUMIDO DE CLIENTE - DATA E HORA DE EMISSÃO: " . $data_horaa . " - SISGRAFEX</h5><br>";
}
?><title><?= $titulo ?></title><?php

                                $sub_titulo = "<h2>" . $cod . " - " . $nome . "</h2><br>";

                                /////////////////////////////////////////// NOTAS //////////////////////
                                ?>
<style>
    td {
        text-align: center;
    }

    table {
        text-align: center;
    }

    .valor {
        text-align: right;
    }
</style>
<?php
$notas_credito = "<table style=' solid black;  border-collapse:collapse; font-size: 10; 
                    text-align: center;
                    color: black;' border='1' class='table'>
        <tr >
        <th colspan='8' style='background-color:black; color:white'>
        NOTAS DE CRÉDITO NC
        </th>
        </tr>
        <tr>
        <th colspan='1' style=' color:Black'>NC SISGRAFEX</th>
        <th colspan='2' style=' color:Black'>NC DATA</th>
        <th colspan='5' style=' color:Black'>VALOR</th>
        </tr>
        <tr>";
if ($Total_Notas == 0) {
    $relatorio = '<tr><td>N/C</td><TD>N/C</TD><TD>N/C</TD>';
    $fecha_notas = '<tr><th colspan="3" style="text-align: right;">VALOR TOTAL: (+) R$ 0</th></tr>';
} else {


    while ($Total_Notas > $Percorrer_Notas) {
        if ($Percorrer_Notas == 0) {
            $relatorio =  '<tr><td colspan="1">' . $Tabela_Notas[$Percorrer_Notas]["cod"] . ' </td>' .
                '<td colspan="2">' . $Tabela_Notas[$Percorrer_Notas]["data"] . ' </td>' .
                '<td colspan="5">(+) R$ ' . number_format($Tabela_Notas[$Percorrer_Notas]["valor"], 2, ',', '.') . ' </td></tr>';
        } else {
            $relatorio = $relatorio . '<tr><td>' . $Tabela_Notas[$Percorrer_Notas]["cod"] . ' </td>' .
                '<td colspan="2">' . $Tabela_Notas[$Percorrer_Notas]["data"] . ' </td>' .
                '<td colspan="4">(+) R$ ' . number_format($Tabela_Notas[$Percorrer_Notas]["valor"], 2, ',', '.') . ' </td></tr>';
        }
        $valor_total_Notas =  $valor_total_Notas + $Tabela_Notas[$Percorrer_Notas]["valor"];
        $Percorrer_Notas++;
    }
    $valor_total_Notas_1 = number_format($valor_total_Notas, 2, ',', '.');
    $fecha_notas = "<tr><th style='text-align: right'; colspan='8'>VALOR TOTAL: (+) R$ " . $valor_total_Notas_1 . "</th></tr> ";
}
if ($Detalhamento == 'Resumido') {
    $Notas_Tabela = $notas_credito . $fecha_notas;
} else {
    $Notas_Tabela = $notas_credito . $relatorio . $fecha_notas;
}


//////////////////////////////////////////////////// FATURAMENTOS /////////////////

$Tabela_faturamento = "
        <tr>
        <th colspan='8' style='background-color:black; color:white'> FATURAMENTOS</th>
        </tr>
        <tr>
        <th>PROPOSTA DE ORÇAMENTO</th>
        <th>ORDEM DE PRODUÇÃO</th>
        <th>DATA</th>
        <th colspan='2'>PRODUTO</th>
        <th colspan='2'>VALOR</th>
        </tr>";
if ($Total_Faturamentos == 0) {
    $relatorio = '<tr><td>N/C</td><td>N/C</td><td>N/C</td><td>N/C</td>';
}
while ($Total_Faturamentos > $Percorrer_Faturamentos) {
    if ($Percorrer_Faturamentos == 0) {
        $relatorio = '<tr><td>' . $Tabela_Faturamentos[$Percorrer_Faturamentos]['orcamento_base'] . '</td>' .
            '<td>' . $Tabela_Faturamentos[$Percorrer_Faturamentos]['cod'] . '</td>' .
            '<td>' . date('d/m/Y', strtotime($Tabela_Faturamentos[$Percorrer_Faturamentos]['DT_FAT'])) . '</td>' .
            '<td colspan="2">' . $Tabela_Produtos[$Percorrer_Faturamentos]['descricao'] . '</td>' .
            '<td colspan="2">(-) R$ ' . number_format($Tabela_Faturamentos[$Percorrer_Faturamentos]["VLR_FAT"], 2, ',', '.') . ' </td></tr>';
    } else {
        $relatorio = $relatorio . '<tr><td>' . $Tabela_Faturamentos[$Percorrer_Faturamentos]['orcamento_base'] . '</td>' .
            '<td>' . $Tabela_Faturamentos[$Percorrer_Faturamentos]['cod'] . '</td>' .
            '<td>' . date('d/m/Y', strtotime($Tabela_Faturamentos[$Percorrer_Faturamentos]['DT_FAT'])) . '</td>' .
            '<td colspan="2">' . $Tabela_Produtos[$Percorrer_Faturamentos]['descricao'] . '</td>' .
            '<td colspan="2">(-) R$ ' . number_format($Tabela_Faturamentos[$Percorrer_Faturamentos]["VLR_FAT"], 2, ',', '.') . ' </td></tr>';
    }
    $valor_total_Faturamentos =  $valor_total_Faturamentos + $Tabela_Faturamentos[$Percorrer_Faturamentos]["VLR_FAT"];
    $Percorrer_Faturamentos++;
}
$valor_total_Faturamentos_1 = number_format($valor_total_Faturamentos, 2, ',', '.');
$fecha_faturamento = "<tr><th class='valor' colspan='8' style='text-align: right;'>VALOR TOTAL: (-) R$ " . $valor_total_Faturamentos_1 . "</th></tr> ";
$Faturamentos = $Tabela_faturamento . $relatorio . $fecha_faturamento;



//////////////////////////////////////////////////// EM PRODUÇÃO /////////////////
// 7 colunas
$Tabela_Ordem_De_Producao = "
        <tr>
        <th colspan='8' style='background-color:black; color:white' >ORDEM DE PRODUÇÃO</th>
        </tr>
        <tr>";
$Tabela_Proposta_Orcamento = "<th style=' color:black';>PROPOSTA DE
        ORÇAMENTO</th>
        <th style=' color:black;'>ORDEM DE PRODUÇÃO</th>
        <th style='color:black;'>EMISSÃO</th>
        <th style=' color:black;'>ENTREGA PREVISTA</th>
        <th style=' color:black;'>PRODUTO</th>
        <th style='color:black;'>STATUS</th>
        <th style='color:black;'>VALOR</th>
        </tr>
        <tr>
        <th colspan='7' style='background-color:black; color:white'>FINALIZADAS</th>
        </tr>
        
        
        ";
if ($Total_Finalizadas == 0) {
    $relatorio = '<tr><td>N/C</td><td>N/C</td><td>N/C</td><td>N/C</td><td>N/C</td>';
}
while ($Total_Finalizadas > $Percorrer_Finalizadas) {
    if ($Percorrer_Finalizadas == 0) {
        $relatorio = '<tr><td>' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['orcamento_base'] . '</td>' .
            '<td>' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['cod'] . '</td>' .
            '<td>' . date('d/m/Y', strtotime($Ordens_Finalizadas[$Percorrer_Finalizadas]['data_emissao'])) . '</td>' .
            '<td>' . date('d/m/Y', strtotime($Ordens_Finalizadas[$Percorrer_Finalizadas]['data_entrega'])) . '</td>' .
            '<td>' . $Tabela_Produtos_Finalizados[$Percorrer_Finalizadas]['descricao'] . '</td>' .
            '<td>' . $Ordens_Finalizadas[$Percorrer_Finalizadas]["STS_DESCRICAO"] . ' </td>' ;
           if(isset($Relatorio_Faturada[$Percorrer_Finalizadas])){
            $relatorio = $relatorio . '<td>'.$Relatorio_Faturada[$Percorrer_Finalizadas].' </td></tr>';
           } else{
            $relatorio = $relatorio . '<td>ERRO <br> '.$Tabela_Orc_Finalizados[$Percorrer_Finalizadas]["valor_total"].'</td></tr>';
           }
           
    } else {
        $relatorio = $relatorio . '<tr><td>' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['orcamento_base'] . '</td>' .
            '<td>' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['cod'] . '</td>' .
            '<td>' . date('d/m/Y', strtotime($Ordens_Finalizadas[$Percorrer_Finalizadas]['data_emissao'])) . '</td>' .
            '<td>' . date('d/m/Y', strtotime($Ordens_Finalizadas[$Percorrer_Finalizadas]['data_entrega'])) . '</td>' .
            '<td>' . $Tabela_Produtos_Finalizados[$Percorrer_Finalizadas]['descricao'] . '</td>' .
            '<td>' . $Ordens_Finalizadas[$Percorrer_Finalizadas]["STS_DESCRICAO"] . ' </td>';
            if(isset($Relatorio_Faturada[$Percorrer_Finalizadas])){
                $relatorio = $relatorio . '<td>'.$Relatorio_Faturada[$Percorrer_Finalizadas].' </td></tr>';
               } else{
                $relatorio = $relatorio . '<td>ERRO <br> '.$Tabela_Orc_Finalizados[$Percorrer_Finalizadas]["valor_total"].'</td></tr>';
               }
            
    }
    //' . $Tabela_Orc_Finalizados[$Percorrer_Finalizadas]["valor_total"] . '
    // $valor_total_Finalizadas =  $valor_total_Finalizadas + $Tabela_Orc_Finalizados[$Percorrer_Finalizadas]["valor_total"] ;
    $Percorrer_Finalizadas++;
}
// $valor_total_Finalizadas = number_format($valor_total_Finalizadas, 2, ',', '.');
//"<tr><th>colspan='5'VALOR TOTAL: (-) R$ ".$valor_total_Finalizadas.
$fecha_Finalizadas = "</th></tr><tr>";
$Inicia_Em_Producao = "<th colspan='8' style='background-color:black; color:white'>EM PRODUÇÃO</th>
        </tr>
         ";
if ($Total_Abertas == 0) {
    $relatorio_A = '<tr><td>N/C</td><td>N/C</td><td>N/C</td><td>N/C</td><td>N/C</td>';
}
while ($Total_Abertas > $Percorrer_Abertas) {
    if ($Percorrer_Abertas == 0) {
        $relatorio_A = '<tr><td>' . $Ordens_Abertas[$Percorrer_Abertas]['orcamento_base'] . '</td>' .
            '<td>' . $Ordens_Abertas[$Percorrer_Abertas]['cod'] . '</td>' .
            '<td>' . date('d/m/Y', strtotime($Ordens_Abertas[$Percorrer_Abertas]['data_emissao'])) . '</td>' .
            '<td>' . date('d/m/Y', strtotime($Ordens_Abertas[$Percorrer_Abertas]['data_entrega'])) . '</td>' .
            '<td>' . $Tabela_Produtos_Abertas[$Percorrer_Abertas]['descricao'] . '</td>' .
            '<td>' . $Ordens_Abertas[$Percorrer_Abertas]["STS_DESCRICAO"] . ' </td>' .
            '<td>' . $Tabela_Orc_Abertas[$Percorrer_Abertas]["valor_total"] . ' </td></tr>';
    } else {
        $relatorio_A = $relatorio_A . '<tr><td>' . $Ordens_Abertas[$Percorrer_Abertas]['orcamento_base'] . '</td>' .
            '<td>' . $Ordens_Abertas[$Percorrer_Abertas]['cod'] . '</td>' .
            '<td>' . date('d/m/Y', strtotime($Ordens_Abertas[$Percorrer_Abertas]['data_emissao'])) . '</td>' .
            '<td>' . date('d/m/Y', strtotime($Ordens_Abertas[$Percorrer_Abertas]['data_entrega'])) . '</td>' .
            '<td>' . $Tabela_Produtos_Abertas[$Percorrer_Abertas]['descricao'] . '</td>' .
            '<td>' . $Ordens_Abertas[$Percorrer_Abertas]["STS_DESCRICAO"] . ' </td>' .
            '<td>' . $Tabela_Orc_Abertas[$Percorrer_Abertas]["valor_total"] . ' </td></tr>';
    }
    $valor_total_Abertas =  $valor_total_Abertas + $Tabela_Orc_Abertas[$Percorrer_Abertas]["valor_total"];
    $Percorrer_Abertas++;
}
$valor_total_Abertas_1 = number_format($valor_total_Abertas, 2, ',', '.');
//"<tr><th>colspan='5'VALOR TOTAL: (-) R$ ".$valor_total_Abertas.
$fecha_Abertas = "<tr><th style='text-align: right;' colspan='7'>VALOR EM ABERTO TOTAL: (-) R$ " . $valor_total_Abertas_1 . "</th></tr><tr>";

if ($Detalhamento == 'Resumido') {
    $Finalizadas = $Tabela_Ordem_De_Producao . $Inicia_Em_Producao . $relatorio_A . $fecha_Abertas;
} else {
    $Finalizadas = $Tabela_Ordem_De_Producao . $Tabela_Proposta_Orcamento . $relatorio . $fecha_Finalizadas . $Inicia_Em_Producao . $relatorio_A . $fecha_Abertas;
}

/////////////////////////////////////// PROPOSTAS DE ORÇAMENTOS ///////////////////////////////////////////
$Tabela_Propostas = "<tr><td colspan='8' style='background-color:black; color:white'>PROPOSTAS DE ORÇAMENTO</td></tr><tr>
       <td style='color:white;'>N° DA PROPOSTA</td>
       <td style='color:white;'>DATA DE VALIDADE</td>
       <td style='color:white;'>DATA DE EMISSÃO</td>
       <td colspan='2' style='color:white;'>PRODUTOS</td>
       <td style='color:white;'>STATUS</td>
       <td style='color:white;'>VALOR</td>
       </tr> ";

if ($Total_Orcamentos == 0) {
    $relatorio = '<tr><td>N/C</td><td>N/C</td><td>N/C</td><td>N/C</td><td>N/C</td>';
}
while ($Total_Orcamentos > $Percorrer_Orcamentos) {
    if ($Percorrer_Orcamentos == 0) {
        $relatorio =
            '<tr><td>' . $Tabela_Orcamentos[$Percorrer_Orcamentos]['cod'] . '</td>' .
            '<td>' . date('d/m/Y', strtotime($Tabela_Orcamentos[$Percorrer_Orcamentos]['data_validade'])) . '</td>' .
            '<td>' . date('d/m/Y', strtotime($Tabela_Orcamentos[$Percorrer_Orcamentos]['data_emissao'])) . '</td>' .
            '<td colspan="2">' . $Tabela_Produtos_Orcamento[$Percorrer_Orcamentos]['descricao_produto'] . '</td>' .
            '<td>' . $Tabela_Orcamentos[$Percorrer_Orcamentos]['status'] . ' - ' . $Tabela_Orcamentos[$Percorrer_Orcamentos]['STS_DESCRICAO'] . ' </td>' .
            '<td> R$ ' . number_format($Tabela_Orcamentos[$Percorrer_Orcamentos]["valor_total"], 2, ',', '.') . ' </td></tr>';
    } else {
        $relatorio = $relatorio .
            '<tr><td>' . $Tabela_Orcamentos[$Percorrer_Orcamentos]['cod'] . '</td>' .
            '<td>' . date('d/m/Y', strtotime($Tabela_Orcamentos[$Percorrer_Orcamentos]['data_validade'])) . '</td>' .
            '<td>' . date('d/m/Y', strtotime($Tabela_Orcamentos[$Percorrer_Orcamentos]['data_emissao'])) . '</td>' .
            '<td colspan="2">' . $Tabela_Produtos_Orcamento[$Percorrer_Orcamentos]['descricao_produto'] . '</td>' .
            '<td>' . $Tabela_Orcamentos[$Percorrer_Orcamentos]['status'] . ' - ' . $Tabela_Orcamentos[$Percorrer_Orcamentos]['STS_DESCRICAO'] . ' </td>' .
            '<td> R$ ' . number_format($Tabela_Orcamentos[$Percorrer_Orcamentos]["valor_total"], 2, ',', '.') . ' </td></tr>';
    }
    $valor_total_Orcamentos =  $valor_total_Orcamentos + $Tabela_Orcamentos[$Percorrer_Orcamentos]["valor_total"];
    $Percorrer_Orcamentos++;
}
$valor_total_Orcamentos_1 = number_format($valor_total_Orcamentos, 2, ',', '.');

// <tr><th>colspan='5'VALOR TOTAL: (-) R$ ".$valor_total_Orcamentos."</th></tr> 
$fecha_Orcamentos = "<tr><th colspan='8' style='background-color:black; color:white;'>TOTAL DAS PROPOSTAS DE ORÇAMENTO</th></tr>
    <tr>
    <td colspan='4'>EM AVALIAÇÃO</td><td colspan='4'>R$ " . number_format($EmAvaliacao, 2, ',', '.') . "</td>
    </tr>
    <tr>
    <td colspan='4'>ENVIADO PARA PRODUÇÃO </td><td colspan='4'>" . number_format($EnviadoParaProducao, 2, ',', '.') . "</td>
    </tr>
    <tr>
    <td colspan='4'>ENVIADO PARA OD </td><td colspan='4'>" . number_format($EnviadoParaOd, 2, ',', '.') . "</td>
    </tr>
    <tr>
    <td colspan='4'>AUTORIZADO PELO OD (GRÁFICA) </td><td colspan='4'>" . number_format($AutoriadoOd, 2, ',', '.') . "</td>
    </tr>
    <tr>
    <td colspan='4'>NÃO AUTORIZADO PELO OD (GRÁFICA) </td><td colspan='4'>" . number_format($NaoAutorizadoOd, 2, ',', '.') . "</td>
    </tr>
    <tr>
    <td colspan='4'>NÃO AUTORIZADO PELO CLIENTE </td><td colspan='4'>" . number_format($NaoAutorizadoCliente, 2, ',', '.') . "</td>
    </tr>
    <tr>
    <td colspan='4'>ENVIADO PARA EXPEDIÇÃO </td><td colspan='4'>" . number_format($ParaExpedicao, 2, ',', '.') . "</td>
    </tr>
    <tr>
    <td colspan='4'>ENTREGUE </td><td colspan='4'>" . number_format($Entregue, 2, ',', '.') . "</td>
    </tr>
    <tr>
    <td colspan='4'>ENTREGA CANCELADA </td><td colspan='4'>" . number_format($EntregaCancelada, 2, ',', '.') . "</td>
    </tr>
    <tr>
    <td colspan='4'>AUTORIZADO PELO OD (CLIENTE) </td><td colspan='4'>" . number_format($AutorizadoOdCliente, 2, ',', '.') . "</td>
    </tr>
    <tr>
    <td colspan='4'>NÃO AUTORIZADO PELO OD (CLIENTE) </td><td colspan='4'>" . number_format($NaoAutorizadoOdCliente, 2, ',', '.') . "</td>
    </tr>
    <tr>
    <td colspan='4'>CANCELADA </td><td colspan='4'>" . number_format($Cancelada, 2, ',', '.') . "</td>
    </tr>
    <tr>
    <td colspan='4'>CANCELADA POR PRAZO </td><td colspan='4'>" . number_format($CanceladaPrazo, 2, ',', '.') . "</td>
    </tr>
    <tr>
    <td colspan='4'>CANCELADA PARCIALMENTE </td><td colspan='4'>" . number_format($CanceladaParcial, 2, ',', '.') . "</td>
    </tr>
    ";
$Orcamentos = $Tabela_Propostas . $relatorio . $fecha_Orcamentos;


///////////////////////////////////////// SALDO FINAL /////////////////////////////////////////////////////////

$Tabela_Total = "<tr>
    <th colspan='8' style='background-color:black; color:white;'>SALDO FINAL</th>
    </tr>
    <tr>
    <td colspan='2'><strong>CRÉDITO</strong></td>
    <td colspan='2'><strong>DÉBITO</strong></td>
    <td ><strong>EM PRODUÇÃO</strong></td>
    <td colspan='2'><strong>TOTAL</strong></td>
    </tr>";
$Calculo_Total = 0;
$Calculo_Total =   $valor_total_Notas - $valor_total_Faturamentos - $valor_total_Abertas;
$Valores_Total = "<tr><td colspan='2'>R$ (+) " . number_format($valor_total_Notas, 2, ',', '.') . "</td><td colspan='2'>R$ (-) " . number_format($valor_total_Faturamentos, 2, ',', '.') . "</td><td >R$ (-) " . number_format($valor_total_Abertas, 2, ',', '.') . "</td><td colspan='2'>R$ " . number_format($Calculo_Total, 2, ',', '.') . "</td></tr>";

$Fecha_Todas_Tabela = "</table>";

/////////////////////////////////// FIM DAS TABELAS //////////////////////////////////////////////////////////

if ($Detalhamento == 'Resumido') {
    $html = $titulo . $sub_titulo . $Notas_Tabela . $Faturamentos . $Finalizadas . $Tabela_Total . $Valores_Total . $Fecha_Todas_Tabela;
} else {
    $html = $titulo . $sub_titulo . $Notas_Tabela . $Faturamentos . $Finalizadas . $Orcamentos . $Tabela_Total . $Valores_Total . $Fecha_Todas_Tabela;
}


// echo $html;
/// FIM CODIGO VARIAVEL///
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
$nome = 'Detalhamento_De_Cliente_' . $cod . '_' . $nome . '.pdf';
$mpdf->Output($nome, 'I');
exit;
