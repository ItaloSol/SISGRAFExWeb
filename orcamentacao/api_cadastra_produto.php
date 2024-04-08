<?php
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$hoje = date('Y-m-d');
$hora = date('H:i:s');

$Resultado = [
  "cod" => 0,
  "sucesso" => false,
];

// get the query parameters
// get the query parameters
$acabamento = json_decode($_GET['acabamento'], true);
$papel = json_decode($_GET['papel'], true);
$dadosGerais = get_object_vars(json_decode($_GET['dadosGerais']));
$valores = get_object_vars(json_decode($_GET['valores']));
$estoque = get_object_vars(json_decode($_GET['estoque']));
$pedidos = get_object_vars(json_decode($_GET['pedidos']));

if ($valores['prevenda'] == false) {
  $valores['prevenda'] = 0;
}
if ($estoque['avisa'] == false) {
  $estoque['avisa'] = 0;
}
if ($pedidos['pedidoavisa'] == false) {
  $pedidos['pedidoavisa'] = 0;
}

$tpp = $dadosGerais['tpp'];
$tipoecommerce = $dadosGerais['tipoecommerce'];
$tipoativo = $dadosGerais['tipoativo'];
$descricao = $dadosGerais['descricao'];
$largura = $dadosGerais['largura'];
$altura = $dadosGerais['altura'];
$espessura = $dadosGerais['espessura'];
$peso = $dadosGerais['peso'];
$qtdfolhas = $dadosGerais['qtdfolhas'];
$tipoproduto = $dadosGerais['tipoproduto'];

$prevenda = $valores['prevenda'];
$valorunitario = $valores['valorunitario'];
$valorpromo = $valores['valorpromo'];

$estoque1 = $estoque['estoque'];
$avisa = $estoque['avisa'];
$aviso = $estoque['aviso'];

$pedidoMin = $pedidos['pedidoMin'];
$pedidoavisa = $pedidos['pedidoavisa'];
$pedidoMax = $pedidos['pedidoMax'];

if ($tpp == 'PP') {
  $query_cadastra_produto = $conexao->prepare("INSERT INTO `produtos`(  `DESCRICAO`, `LARGURA`, `ALTURA`, `ESPESSURA`, `PESO`, `QTD_PAGINAS`, `TIPO`, `ATIVO`, `USO_ECOMMERCE`, `PRECO_CUSTO`) VALUES ('$descricao','$largura','$altura','$espessura','$peso','$qtdfolhas','$tipoproduto',$tipoativo,$tipoecommerce, 0)");
    $query_cadastra_produto->execute();
  $query_produtos = $conexao->prepare("SELECT * FROM produtos p  WHERE DESCRICAO = '$descricao' ORDER BY p.CODIGO DESC LIMIT 1");
   $query_produtos->execute();
  if ($linha = $query_produtos->fetch(PDO::FETCH_ASSOC)) {
    $cod_produto = $linha['CODIGO'];
  }
} else {
  $query_cadastra_produto = $conexao->prepare("INSERT INTO `produtos_pr_ent`(`ID_CATEGORIA`, `DESCRICAO`, `LARGURA`, `ALTURA`, `ESPESSURA`, `PESO`, `VENDAS`, `PRE_VENDA`, `PROM`, `VLR_PROM`, `QTD_PAGINAS`, `ESTOQUE`, `AVISO_ESTOQUE`, `AVISO_ESTOQUE_UN`, `TIPO`, `VLR_UNIT`, `ULT_MOV`, `PD_QTD_MIN`, `PD_MAX`, `PD_QTD_MAX`, `ATIVO`, `USO_ECOMMERCE`, ) VALUES ('0','$descricao','$largura','$altura','$espessura','$peso','0','$prevenda','0','0','$qtdfolhas','$estoque','$avisa','$aviso','$tipoproduto','$valorunitario','$dataHora','$pedidoMin','$pedidoavisa','$pedidoMax','1','$tipoecommerce')");
    $query_cadastra_produto->execute();
  $query_produtos = $conexao->prepare("SELECT * FROM produtos_pr_ent p INNER JOIN tabela_calculos_op c ON c.cod_produto = p.CODIGO  WHERE DESCRICAO = '$descricao' ORDER BY p.CODIGO DESC LIMIT 1");
    $query_produtos->execute();
  $VALOR = [];
  if ($linha = $query_produtos->fetch(PDO::FETCH_ASSOC)) {
    $cod_produto = $linha['CODIGO'];
  }
}




/// papel
for ($i = 0; $i < count($papel); $i++) {
  $CODIGO_PAPEL = $papel[$i]['CODIGO_PAPEL'];
  $DESCRICAO = $papel[$i]['DESCRICAO'];
  $TIPO = $papel[$i]['TIPO'];
  $CF = $papel[$i]['CF'];
  $CV = $papel[$i]['CV'];
  $query_cadastra_prod_papel = $conexao->prepare("INSERT INTO `tabela_papeis_produto`(`tipo_produto`, `cod_produto`, `cod_papel`, `tipo_papel`, `cor_frente`, `cor_verso`, `descricao`, `orelha`) VALUES ('1','$cod_produto','$CODIGO_PAPEL','$TIPO','$CF','$CV','$DESCRICAO','0')");
   $query_cadastra_prod_papel->execute();
}



/// acabamento
for ($i = 0; $i < count($acabamento); $i++) {
  $CODIGO_ACABAMENTO = $acabamento[$i]['CODIGO_ACABAMENTO'];
  $query_cadastra_prod_acabamento = $conexao->prepare("INSERT INTO `tabela_componentes_produto`( `tipo_produto`, `cod_produto`, `cod_acabamento`) VALUES ('1','$cod_produto','$CODIGO_ACABAMENTO')");
  //$query_cadastra_prod_acabamento->execute();
}
// handle the request
//...
$Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade, atendente_supervisao, data_supervisao) VALUES ('Cadastrou um novo produto $descricao código $cod_produto ', '$cod_user', '$dataHora')");
$Atividade_Supervisao->execute();
$Resultado = [
  "cod" => $cod_produto,
  "sucesso" => true,
];

echo json_encode($Resultado);
