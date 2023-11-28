<?php
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$hoje = date('Y-m-d');
$hora = date('H:i:s');
$Solicitacao = json_decode(file_get_contents("php://input"), true);
$Resultado = [
  "Disponivel"=> true,
];

//DEFINE QUAL ENTRADA FOI USADO
if (isset($_GET['quantidade'])) {

  $pesquisa = $_GET['quantidade'];
  $tipo = $_GET['tipo'];
  $Quantidade_Disponivel = 0;
  $query_Dados = $conexao->prepare("SELECT 
  T1.quantidade_$tipo - COALESCE(SUM(T2.clique_utilizado), 0) AS Qtd_Disponivel
  FROM 
  clique_dados T1
  LEFT JOIN 
  clique_utilizado T2 ON 1=1;");
  $query_Dados->execute();
   if($linha = $query_Dados->fetch(PDO::FETCH_ASSOC)) {
    $Quantidade_Disponivel = $linha["Qtd_Disponivel"];
  }
  if($Quantidade_Disponivel < 0){
    $Resultado = [
      "Disponivel"=> false,
    ];
  }
  echo json_encode($Resultado);
} 
