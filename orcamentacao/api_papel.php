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
if ($_GET['id']) {
 
    $pesquisa = $_GET['id'];
    
  $query_papel = $conexao->prepare("SELECT * FROM tabela_papeis_produto WHERE  cod_papel = $pesquisa ");
  $query_papel->execute();

  if ($linha3 = $query_papel->fetch(PDO::FETCH_ASSOC)) {
       $Do_Papel = [
       'tipo_papel' => $linha3['tipo_papel'],
       'cod_papel' => $linha3['cod_papel'],
       'cor_frente' => $linha3['cor_frente'],
       'cor_verso' => $linha3['cor_verso'],
       'descricao' => $linha3['descricao'],
       'orelha' => $linha3['orelha'],
       ];
       
$query_do_papel = $conexao->prepare("SELECT * FROM tabela_papeis WHERE cod = $pesquisa  ");
$query_do_papel->execute();
    if ($linha4 = $query_do_papel->fetch(PDO::FETCH_ASSOC)) {
        $Do_Papel['cod_papels'] = $linha4['cod'];
    $Do_Papel['descricao_do_papel'] = $linha4['descricao'];
    $Do_Papel['medida'] = $linha4['medida'];
    $Do_Papel['gramatura'] = $linha4['gramatura'];
    $Do_Papel['formato'] = $linha4['formato'];
    $Do_Papel['uma_face'] = $linha4['uma_face'];
    $Do_Papel['unitario'] = $linha4['unitario'];
    }
  }
 
    echo json_encode($Do_Papel);
}