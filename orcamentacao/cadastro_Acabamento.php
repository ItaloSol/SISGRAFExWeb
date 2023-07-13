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
  $V = $_GET['V'];
  $P = 1;
  $Insere_acabamento = $conexao->prepare("INSERT INTO bala_dev.acabamentos (MAQUINA, ATIVA, CUSTO_HORA) VALUES (?, ?, ?)");
$Insere_acabamento->bindParam(1, $N);
$Insere_acabamento->bindParam(2, $P, PDO::PARAM_INT);
$Insere_acabamento->bindParam(3, $V, PDO::PARAM_INT);
$Insere_acabamento->execute();
$Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Adicionou um novo Acabamento $N valor R$ $V' , '$cod_user' , '$dataHora')");
    $Atividade_Supervisao->execute();
if ($Insere_acabamento->rowCount() > 0) {
    $salvo = ['erro' => false];
} else {
    $salvo = ['erro' => true];
}
  echo json_encode($salvo);
}
