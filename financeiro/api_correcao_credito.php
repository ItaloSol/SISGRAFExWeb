<?php
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$hoje = date('Y-m-d');
$hora = date('H:i:s');
$Solicitacao = json_decode(file_get_contents("php://input"), true);
$Sucesso = [
  'erro' => false,
];
//DEFINE QUAL ENTRADA FOI USADO
if (isset($_GET['cod']) && isset($_GET['tipo'])) {
  $cod = $_GET['cod'];
  $tipo_cliente = $_GET['tipo'];


  $numero_clientes = 0;
  $Valor_Notas_Totais = array();
  if ($_GET['tipo'] == 2) {
    $query_Clientes_Juridicos = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE cod = $cod ");
  } else {
    $query_Clientes_Juridicos = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE cod = $cod ");
  }

  $query_Clientes_Juridicos->execute();

  if ($linha = $query_Clientes_Juridicos->fetch(PDO::FETCH_ASSOC)) {
    $valor_todo = 0;
    if ($_GET['tipo'] == 2) {
      $Tabela_Clientes = [
        'cod' => $linha['cod'],
        'nome' => $linha['nome'],
        'nome_Fantasia' => $linha['nome_fantasia'],
        'cnpj' => $linha['cnpj'],
        'atividade' => $linha['atividade'],
        'filial_coligada' => $linha['filial_coligada'],
        'cod_atendente' => $linha['cod_atendente'],
        'nome_atendente' => $linha['nome_atendente'],
        'observacao' => $linha['observacao'],
        'credito' => $linha['credito'],
        'senha' => $linha['senha'],
        'excluido' => $linha['excluido'],
        'tOKEN' => $linha['TOKEN'],
        'uLTIMO_ACESSO' => $linha['ULTIMO_ACESSO'],
        'qTD_ACESSO' => $linha['QTD_ACESSOS'],
      ];

      $cod = $Tabela_Clientes['cod'];
    } else {
      $Tabela_Clientes = [
        'cod' => $linha['cod'],
        'nome' => $linha['nome'],
        'cpf' => $linha['cpf'],
        'atividade' => $linha['atividade'],
        'cod_atendente' => $linha['cod_atendente'],
        'nome_atendente' => $linha['nome_atendente'],
        'credito' => $linha['credito'],
        'senha' => $linha['senha'],
        'excluido' => $linha['excluido'],
        'tOKEN' => $linha['TOKEN'],
      ];

      $cod = $Tabela_Clientes['cod'];
    }




    /////////////////////////////////// NOTAS DE CREDITO //////////////////////////////////////////////////////
    $query_Notas = $conexao->prepare("SELECT * FROM tabela_notas WHERE cod_cliente = '$cod'  AND tipo_pessoa = '$tipo_cliente'");
    $query_Notas->execute();
    $i = 0;

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
    $Valor_Notas_Totais =  $valor_todo;
    $Percorrer_Notas = 0;
    $valor_total_Notas = 0;
    //  while($Total_Notas > $Percorrer_Notas){  
    /////////////////////////////////////// FIM NOTAS ///////////////////////////////////////////////////////////////

    /////////////////////////////////////// FATURAMENTOS ////////////////////////////////////////////////////////////

    $query_Ordens_Producao = $conexao->prepare("SELECT * FROM faturamentos f INNER JOIN tabela_ordens_producao o  ON o.cod = f.CODIGO_OP WHERE o.cod_cliente = '$cod' AND o.tipo_cliente = '$tipo_cliente'");
    $query_Ordens_Producao->execute();
    $i = 0;
    $valor_faturamento = 0;
    while ($linha = $query_Ordens_Producao->fetch(PDO::FETCH_ASSOC)) {

      $Tabela_Faturamentos = [
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
      $Pesquisa_Produto = $Tabela_Faturamentos['cod_produto'];
      $Tipo_Produto = $Tabela_Faturamentos['tipo_produto'];
      if ($Tipo_Produto == '2') {
        $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos_pr_ent  WHERE CODIGO = '$Pesquisa_Produto'");
        $query_PRODUTOS->execute();

        while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
          $Tabela_Produtos = [
            'descricao' => $linha2['DESCRICAO']
          ];
        }
      }
      if ($Tipo_Produto == '1') {
        $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_Produto'");
        $query_PRODUTOS->execute();

        while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
          $Tabela_Produtos = [
            'descricao' => $linha2['DESCRICAO']
          ];
        }
      }
      $valor_faturamento = $valor_faturamento + $linha['VLR_FAT'];

      // echo $linha['cod'].' '.$linha['VLR_FAT'] .'<br>';
      $i++;
    }
    $Total_Faturamentos = $valor_faturamento;



    // /////////////////////////////////////// FIM OP FINALZIADAS ///////////////////////////////////////////////////////////////

    // /////////////////////////////////// OP ABERTAS //////////////////////////////////////////////////////
    $query_ordens_Abertas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO WHERE o.cod_cliente = '$cod' AND o.tipo_cliente = '$tipo_cliente' AND o.status != '11' AND o.status != '13'");
    $query_ordens_Abertas->execute();
    $i = 0;
    $valor_emproducao = 0;
    while ($linha = $query_ordens_Abertas->fetch(PDO::FETCH_ASSOC)) {
      $Ordens_Abertas = [
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
        //  echo "codigo op: ". $Cod_Op_QQ ."<br>";


        if ($linha_QQ2 = $query_Pesquisa_Orc_QQ->fetch(PDO::FETCH_ASSOC)) {
          $Valor_QQ = $linha_QQ2['quantidade'] * $linha_QQ2['preco_unitario'];

            //  echo "Valor Total: ". $Valor_QQ . "<br>";
          $QQvalor_total_Faturamentos = $conexao->prepare("SELECT * FROM faturamentos f WHERE  f.CODIGO_OP = '$Cod_Op_QQ'");
          $QQvalor_total_Faturamentos->execute();
          while ($linhaQQ = $QQvalor_total_Faturamentos->fetch(PDO::FETCH_ASSOC)) {
            //  echo "Valores de fatuamento: ". $linhaQQ['VLR_FAT']. "<br>";
              //  echo 'CALCULO: '. $Valor_QQ .' - '. $linhaQQ['VLR_FAT'] ;
            $Valor_QQ = $Valor_QQ - $linhaQQ['VLR_FAT'];
          }
        }
      }
      $Pesquisa_Produto = $Ordens_Abertas['cod_produto'];
      $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_Produto'");
      $query_PRODUTOS->execute();

      while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
        $Tabela_Produtos_Abertas = [
          'descricao' => $linha2['DESCRICAO']
        ];
      }
      $Pesquisa_Orc = $Ordens_Abertas['orcamento_base'];
      $Pesquisa_Tipo_prod = $Ordens_Abertas['tipo_produto'];
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
      $Total_EmProducao = $valor_emproducao;
      $i++;
    }
    if (!isset($Total_EmProducao)) {
      $Total_EmProducao = 0;
    }
    if (!isset($Tabela_Clientes)) {
      $Tabela_Clientes = 0;
    }
    if (!isset($Valor_Notas_Totais)) {
      $Valor_Notas_Totais = 0;
    }

    $Saldo_Correto = $Valor_Notas_Totais - $Total_Faturamentos - $Total_EmProducao;
    $Diferenca_Correcao = $Saldo_Correto - $Tabela_Clientes['credito'];
    //  echo $Tabela_Clientes['nome'] . ' Credito: ' . $Valor_Notas_Totais . ' Fatruamento: ' . $Total_Faturamentos . ' Valor Em produção: ' . $Total_EmProducao . ' Soldo Correto = ' .  $Saldo_Correto . ' Saldo Atual: ' . $Tabela_Clientes['credito'] .  '<br>';

    $credito = $Saldo_Correto;
    $credito = round($credito, 2);
    $cod_cliente = $Tabela_Clientes['cod'];
    $credito_anterior = $Tabela_Clientes['credito'];
   
    if ($tipo_cliente == 2) {
      $query_aceitalas = $conexao->prepare("UPDATE tabela_clientes_juridicos SET credito = '$credito' WHERE cod = $cod_cliente ");
      $query_aceitalas->execute();
      $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Sincronia de Saldo automática: Cliente $cod_cliente Tipo $tipo_cliente de $credito_anterior para $credito' , '$cod_user' , '$dataHora')");
      $Atividade_Supervisao->execute();
      echo json_encode($Sucesso);
    } else {
      $query_aceitalas = $conexao->prepare("UPDATE tabela_clientes_fisicos SET credito = '$credito' WHERE cod = $cod_cliente ");
      $query_aceitalas->execute();
      $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Sincronia de Saldo automática: Cliente $cod_cliente Tipo $tipo_cliente de $credito_anterior para $credito' , '$cod_user' , '$dataHora')");
      $Atividade_Supervisao->execute();
      echo json_encode($Sucesso);
    }
  }
}else{
  $Sucesso = [
    'erro' => true,
];

// Codificando o array em JSON
$jsonData = json_encode($Sucesso);

// Configurando o cabeçalho HTTP para indicar que o conteúdo é JSON
header('Content-Type: application/json');

// Enviando o JSON para o JavaScript
echo $jsonData;
}
