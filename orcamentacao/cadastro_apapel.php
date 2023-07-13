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
if ($_GET['N'] != '' && $_GET['V'] != '') {

  $N = $_GET['N'];
  $M = $_GET['M'];
  $G = $_GET['G'];
  $F = $_GET['F'];
  $U = $_GET['U'];
  $V = $_GET['V'];


  $Insere_papel = $conexao->prepare("INSERT INTO bala_dev.tabela_papeis (descricao, medida, gramatura, formato, uma_face, unitario) VALUES (?, ?, ?, ?, ?, ?)");
$Insere_papel->bindParam(1, $N);
$Insere_papel->bindParam(2, $M);
$Insere_papel->bindParam(3, $G);
$Insere_papel->bindParam(4, $F);
$Insere_papel->bindParam(5, $U);
$Insere_papel->bindParam(6, $V);
$Insere_papel->execute();
  $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade, atendente_supervisao, data_supervisao) VALUES ('Adicionou um novo Papel $N valor $V', '$cod_user', '$dataHora')");
  $Atividade_Supervisao->execute();
if ($Insere_papel->rowCount() > 0) {
    $salvo = ['erro' => false];
} else {
    $salvo = ['erro' => true];
}
  echo json_encode($salvo);
}
