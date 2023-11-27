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
if (isset($_GET['quantiade'])) {

  $pesquisa = $_GET['quantiade'];

  $query_Dados = $conexao->prepare("SELECT * FROM clique_dados");
  $query_Dados->execute();
   while($linha = $query_Dados->fetch(PDO::FETCH_ASSOC)) {
    $Do_Clique = [
      'contrato' => $linha['cod'],
      'valor_preto' => $linha['valor_preto'],
      'quatidade_preto' => $linha['quatidade_preto'],
      'valor_colorido' => $linha['valor_colorido'],
      'quantidade_colorido' => $linha['quantidade_colorido'],
    ];

    $query_Usado = $conexao->prepare("SELECT * FROM clique_utilizado c INNER JOIN tabela_ordens_producao o ON c.fk_orden_producao = o.cod WHERE o.status != '13'");
    $query_Usado->execute();
    while($linha = $query_Usado->fetch(PDO::FETCH_ASSOC)) {
      $Do_Clique_usado = [
        'contrato' => $linha['cod'],
        'valor_preto' => $linha['valor_preto'],
        'quatidade_preto' => $linha['quatidade_preto'],
        'valor_colorido' => $linha['valor_colorido'],
        'quantidade_colorido' => $linha['quantidade_colorido'],
      ];

    $query_papel = $conexao->prepare("SELECT * FROM tabela_papeis_produto WHERE  cod_papel = $pesquisa ");
    $query_papel->execute();

    if ($linha3 = $query_papel->fetch(PDO::FETCH_ASSOC)) {
      $Do_Papel['tipo_papel'] = $linha3['tipo_papel'];
      $Do_Papel['cod_papel'] = $linha3['cod_papel'];
      $Do_Papel['cor_frente'] = $linha3['cor_frente'];
      $Do_Papel['cor_verso'] = $linha3['cor_verso'];
      $Do_Papel['descricao'] = $linha3['descricao'];
      $Do_Papel['orelha'] = $linha3['orelha'];
    }
  }

  echo json_encode($Do_Papel);

 
} else {
  if(isset($_GET['nome'])){
    $nome = $_GET['nome'];
    $query_papel_todos = $conexao->prepare("SELECT * FROM tabela_papeis WHERE descricao LIKE '%$nome%' ORDER BY cod DESC");
    $query_papel_todos->execute();
    while ($linha = $query_papel_todos->fetch(PDO::FETCH_ASSOC)) {
      $Do_Papel[] = [
        'cod' => $linha['cod'],
        'descricao' => $linha['descricao'],
        'medida' => $linha['medida'],
        'gramatura' => $linha['gramatura'],
        'formato' => $linha['formato'],
        'uma_face' => $linha['uma_face'],
        'unitario' => $linha['unitario'],
      ];
    }
  }elseif(isset($_GET['cod'])){
    $cod = $_GET['cod'];
    $query_papel_todos = $conexao->prepare("SELECT * FROM tabela_papeis WHERE cod LIKE '%$cod%' ORDER BY cod DESC");
    $query_papel_todos->execute();
    while ($linha = $query_papel_todos->fetch(PDO::FETCH_ASSOC)) {
      $Do_Papel[] = [
        'cod' => $linha['cod'],
        'descricao' => $linha['descricao'],
        'medida' => $linha['medida'],
        'gramatura' => $linha['gramatura'],
        'formato' => $linha['formato'],
        'uma_face' => $linha['uma_face'],
        'unitario' => $linha['unitario'],
      ];
    }
  }else{
    $query_papel_todos = $conexao->prepare("SELECT * FROM tabela_papeis ORDER BY cod DESC");
    $query_papel_todos->execute();
    while ($linha = $query_papel_todos->fetch(PDO::FETCH_ASSOC)) {
      $Do_Papel[] = [
        'cod' => $linha['cod'],
        'descricao' => $linha['descricao'],
        'medida' => $linha['medida'],
        'gramatura' => $linha['gramatura'],
        'formato' => $linha['formato'],
        'uma_face' => $linha['uma_face'],
        'unitario' => $linha['unitario'],
      ];
    }
  }
  echo json_encode($Do_Papel);
}
