<?php
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$hoje = date('Y-m-d');
$hora = date('H:i:s');
$feedback = json_decode(file_get_contents("php://input"), true);
// faça algo com os dados de feedback aqui
if (!empty($feedback)) {

  echo json_encode(["message" => "sucesso"]);
  $nota = $feedback['nota'];
  $texto = $feedback['texto'];
  $Atividade_Satisfacao = $conexao->prepare("INSERT INTO tabela_satisfacao_justificativa (data , hora, cod_user,nota,feedback) VALUES ('$hoje' , '$hora' , '$cod_user','$nota','$texto')");
  $Atividade_Satisfacao->execute();
  $update_atendente = $conexao->prepare("UPDATE tabela_atendentes SET feedback = '4' WHERE codigo_atendente = '$cod_user'");
  $update_atendente->execute();
  $_SESSION["feedback"] = 'true';
  $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Feedback enviado' , '$cod_user' , '$dataHora')");
  $Atividade_Supervisao->execute();
} else {

  echo json_encode(["message" => "Nenhum feedback recebido"]);
}
