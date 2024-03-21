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
  $cod = $_GET['cod'];
  $query_do_papel = $conexao->prepare("SELECT * FROM tabela_papeis WHERE cod = $pesquisa  ");
  $query_do_papel->execute();
  if ($linha4 = $query_do_papel->fetch(PDO::FETCH_ASSOC)) {
    $Do_Papel = [
      'cod_papels' => $linha4['cod'],
      'descricao_do_papel' => $linha4['descricao'],
      'medida' => $linha4['medida'],
      'gramatura' => $linha4['gramatura'],
      'formato' => $linha4['formato'],
      'uma_face' => $linha4['uma_face'],
      'unitario' => $linha4['unitario']
    ];

    $query_chapa = $conexao->prepare("SELECT * FROM configuracoes WHERE  configuracao = 'valor de chapa' ");
    $query_chapa->execute();

    if ($linha5 = $query_chapa->fetch(PDO::FETCH_ASSOC)) {
      $Do_Papel['valor_chapa'] = $linha5['parametro'];
    }

    $query_papel = $conexao->prepare("SELECT * FROM tabela_papeis_produto WHERE  cod_papel = $pesquisa AND cod_produto = $cod ");
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
