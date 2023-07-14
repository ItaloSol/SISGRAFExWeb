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

  $query_do_acabamento = $conexao->prepare("SELECT * FROM acabamentos WHERE CODIGO = $pesquisa  ");
  $query_do_acabamento->execute();
  if ($linha = $query_do_acabamento->fetch(PDO::FETCH_ASSOC)) {
    $Do_Acabamento = [
        'CODIGO' => $linha['CODIGO'],
        'MAQUINA' => $linha['MAQUINA'],
        'ATIVA' => $linha['ATIVA'],
        'CUSTO_HORA' => $linha['CUSTO_HORA'],
      ];

   
  }else {
    $Do_Acabamento = [];
}



  echo json_encode($Do_Acabamento);
}else{
  if(isset($_GET['nome'])){
    $Nome = $_GET['nome'];
    $query_do_acabamento = $conexao->prepare("SELECT * FROM acabamentos WHERE maquina LIKE '%$Nome%' ORDER BY CODIGO DESC");
    $query_do_acabamento->execute();
    while ($linha = $query_do_acabamento->fetch(PDO::FETCH_ASSOC)) {
      $Do_Acabamento[] = [
          'CODIGO' => $linha['CODIGO'],
          'MAQUINA' => $linha['MAQUINA'],
          'ATIVA' => $linha['ATIVA'],
          'CUSTO_HORA' => $linha['CUSTO_HORA'],
        ];
    }
  }elseif(isset($_GET['cod'])){
    $cod = $_GET['cod'];
    $query_do_acabamento = $conexao->prepare("SELECT * FROM acabamentos WHERE CODIGO LIKE '%$cod%' ORDER BY CODIGO DESC");
    $query_do_acabamento->execute();
    while ($linha = $query_do_acabamento->fetch(PDO::FETCH_ASSOC)) {
      $Do_Acabamento[] = [
          'CODIGO' => $linha['CODIGO'],
          'MAQUINA' => $linha['MAQUINA'],
          'ATIVA' => $linha['ATIVA'],
          'CUSTO_HORA' => $linha['CUSTO_HORA'],
        ];
    }
  }else{
    $query_do_acabamento = $conexao->prepare("SELECT * FROM acabamentos ORDER BY CODIGO DESC");
    $query_do_acabamento->execute();
    while ($linha = $query_do_acabamento->fetch(PDO::FETCH_ASSOC)) {
      $Do_Acabamento[] = [
          'CODIGO' => $linha['CODIGO'],
          'MAQUINA' => $linha['MAQUINA'],
          'ATIVA' => $linha['ATIVA'],
          'CUSTO_HORA' => $linha['CUSTO_HORA'],
        ];
    }
  }
  
  echo json_encode($Do_Acabamento);
}
