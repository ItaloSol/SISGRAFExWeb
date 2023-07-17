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
  $T = $_GET['T'];
  $V = $_GET['V'];

  $Insere_Servico = $conexao->prepare("INSERT INTO tabela_servicos_orcamento (descricao, valor_minimo, valor_unitario, servico_geral, tipo_servico, excluido) VALUES (?, ?, ?, ?, ?, 0)");
$Insere_Servico->bindParam(1, $N);
$Insere_Servico->bindParam(2, $M, PDO::PARAM_INT);
$Insere_Servico->bindParam(3, $V, PDO::PARAM_INT);
$Insere_Servico->bindParam(4, $G, PDO::PARAM_INT);
$Insere_Servico->bindParam(5, $T);
$Insere_Servico->execute();
  $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade, atendente_supervisao, data_supervisao) VALUES ('Adicionou um novo Serviço $N valor R$ $V', '$cod_user', '$dataHora')");
  $Atividade_Supervisao->execute();
if ($Insere_Servico->rowCount() > 0) {
    $salvo = ['erro' => false];
} else {
    $salvo = ['erro' => true];
}
  echo json_encode($salvo);
}
