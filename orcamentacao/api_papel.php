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
  $cod = $_GET['codi'];
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
    if($cod != 0){
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
  }

  echo json_encode($Do_Papel);

 
} 
if(isset($_GET['atualiza'])){
  $atualiza = $_GET['atualiza'];
  $nome = $_GET['nome']; 
  $Mediada_Papel = $_GET['Mediada_Papel'];
  $Gramatura_Papel = $_GET['Gramatura_Papel'];
  $Fomato_Papel = $_GET['Fomato_Papel'];
  $umaface_Papel = $_GET['umaface_Papel'];
  if($umaface_Papel == false){
    $umaface_Papel = 0;
  }else{
    $umaface_Papel = 1;
  }
  $valor_Papel = $_GET['valor_Papel'];
  $query_do_papel = $conexao->prepare("UPDATE tabela_papeis SET descricao = '$nome', medida = '$Mediada_Papel', gramatura = '$Gramatura_Papel', formato = '$Fomato_Papel', uma_face = '$umaface_Papel', unitario = '$valor_Papel' WHERE cod = $atualiza  ");
  $query_do_papel->execute();
  $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade, atendente_supervisao, data_supervisao) VALUES ('Editou o Papel $nome valor R$ $valor_Papel', '$cod_user', '$dataHora')");
  $Atividade_Supervisao->execute();
  $Resultado = [
    "Sucesso"=> true,
  ];
  echo json_encode($Resultado);
}
if(!isset($_GET['atualiza']) && !isset($_GET['id'])){
if(isset($_GET['nome']) || isset($_GET['cod']) ){
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
  }
  if(isset($_GET['cod'])){
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
  }
  echo json_encode($Do_Papel);
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
  echo json_encode($Do_Papel);
}
}
