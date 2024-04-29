<?php
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$hoje = date('Y-m-d');
$hora = date('H:i:s');
$Solicitacao = json_decode(file_get_contents("php://input"), true);
//DEFINE QUAL ENTRADA FOI USADO
if (isset($_GET['id'])) {

  $pesquisa = $_GET['id'];

  $query_do_acabamento = $conexao->prepare("SELECT * FROM tabela_servicos_orcamento WHERE cod = $pesquisa  ");
  $query_do_acabamento->execute();
  if ($linha = $query_do_acabamento->fetch(PDO::FETCH_ASSOC)) {
    $servico = [
      'cod' => $linha['cod'],
      'descricao' => $linha['descricao'],
      'valor_minimo' => $linha['valor_minimo'],
      'valor_unitario' => $linha['valor_unitario'],
      'servico_geral' => $linha['servico_geral'],
      'tipo_servico' => $linha['tipo_servico'],
    ];
  } else {
    $servico = [];
  }
  echo json_encode($servico);
}
  if (isset($_GET['atualiza'])) {
    $atualiza = $_GET['atualiza'];
    $nome = $_GET['nome'];
    $valorUnitario = $_GET['valorUnitario'];
    $tipoServico = $_GET['tipoServico'];
    $valor_min = $_GET['valor_min'];
    $Servico_Geral = $_GET['Servico_Geral'];
    if ($Servico_Geral == false) {
      $Servico_Geral = 0;
    } else {
      $Servico_Geral = 1;
    }
    $query_do_papel = $conexao->prepare("UPDATE tabela_servicos_orcamento SET descricao = '$nome', valor_unitario = '$valorUnitario', tipo_servico = '$tipoServico', valor_minimo = '$valor_min', servico_geral = '$Servico_Geral' WHERE cod = $atualiza  ");
    $query_do_papel->execute();
    $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade, atendente_supervisao, data_supervisao) VALUES ('Editou o Serviço $nome valor R$ $valorUnitario', '$cod_user', '$dataHora')");
    $Atividade_Supervisao->execute();
    $Resultado = [
      "Sucesso" => true,
    ];
    echo json_encode($Resultado);
  }
  if (!isset($_GET['atualiza']) && !isset($_GET['id'])) {
    if (isset($_GET['nome'])) {
      $Nome = $_GET['nome'];
      $query_do_acabamento = $conexao->prepare("SELECT * FROM tabela_servicos_orcamento WHERE descricao LIKE '%$Nome%' ORDER BY cod DESC");
      $query_do_acabamento->execute();
      while ($linha = $query_do_acabamento->fetch(PDO::FETCH_ASSOC)) {
        $servico[] = [
          'cod' => $linha['cod'],
          'descricao' => $linha['descricao'],
          'valor_minimo' => $linha['valor_minimo'],
          'valor_unitario' => $linha['valor_unitario'],
          'servico_geral' => $linha['servico_geral'],
          'tipo_servico' => $linha['tipo_servico'],
        ];
      }
    } elseif (isset($_GET['cod'])) {
      $cod = $_GET['cod'];
      $query_do_acabamento = $conexao->prepare("SELECT * FROM tabela_servicos_orcamento WHERE cod LIKE '%$cod%' ORDER BY cod DESC");
      $query_do_acabamento->execute();
      while ($linha = $query_do_acabamento->fetch(PDO::FETCH_ASSOC)) {
        $servico[] = [
          'cod' => $linha['cod'],
          'descricao' => $linha['descricao'],
          'valor_minimo' => $linha['valor_minimo'],
          'valor_unitario' => $linha['valor_unitario'],
          'servico_geral' => $linha['servico_geral'],
          'tipo_servico' => $linha['tipo_servico'],
        ];
      }
    } else {
      $query_do_acabamento = $conexao->prepare("SELECT * FROM tabela_servicos_orcamento ORDER BY cod DESC");
      $query_do_acabamento->execute();
      while ($linha = $query_do_acabamento->fetch(PDO::FETCH_ASSOC)) {
        $servico[] = [
          'cod' => $linha['cod'],
          'descricao' => $linha['descricao'],
          'valor_minimo' => $linha['valor_minimo'],
          'valor_unitario' => $linha['valor_unitario'],
          'servico_geral' => $linha['servico_geral'],
          'tipo_servico' => $linha['tipo_servico'],
        ];
      }
    }
    echo json_encode($servico);
  }

