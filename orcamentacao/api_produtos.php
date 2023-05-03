<?php
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$hoje = date('Y-m-d');
$hora = date('H:i:s');

$query_produtos = $conexao->prepare("SELECT * FROM produtos ORDER BY CODIGO DESC LIMIT 45");
$query_produtos->execute();
$pp = [];
while ($linha = $query_produtos->fetch(PDO::FETCH_ASSOC)) {
  $pp[] = [
    'CODIGO' => $linha['CODIGO'],
    'DESCRICAO' => $linha['DESCRICAO'],
    'TIPO' => 'PP',
    'VALOR_UNITARIO' => $linha['PRECO_CUSTO'],
  ];
}

$query_produtos = $conexao->prepare("SELECT * FROM produtos_pr_ent ORDER BY CODIGO DESC LIMIT 45");
$query_produtos->execute();
$pe = [];
while ($linha = $query_produtos->fetch(PDO::FETCH_ASSOC)) {
  $pe[] = [
    'CODIGO' => $linha['CODIGO'],
    'DESCRICAO' => $linha['DESCRICAO'],
    'TIPO' => 'PE',
    'VALOR_UNITARIO' => $linha['VLR_UNIT'],
  ];
}

// retorna os resultados em formato JSON
echo json_encode(['pp' => $pp, 'pe' => $pe]);