<?php
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$hoje = date('Y-m-d');
$hora = date('H:i:s');
$Solicitacao = json_decode(file_get_contents("php://input"), true);
// faça algo com os dados de Solicitacao aqui
if (!empty($Solicitacao)) {

  echo json_encode(["message" => "sucesso"]);
  $Tipo = $Solicitacao['tipo'];
  $Opcao = $Solicitacao['opcao'];
  // echo json_encode(["message" =>  $hoje .  $hora  .  $cod_user . $Tipo . $Opcao]);

  $Atividade_Supervisao = $conexao->prepare("INSERT INTO tabela_suporte (data , hora, cod_user,tipo,solicitacao) VALUES ('$hoje' , '$hora' , '$cod_user','$Tipo','$Opcao')");
  $Atividade_Supervisao->execute();
  $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Fez um Pedido de suporte para um(a): $Tipo' , '$cod_user' , '$dataHora')");
  $Atividade_Supervisao->execute();
} else {

  echo json_encode(["message" => "Nenhum feedback recebido"]);
}
