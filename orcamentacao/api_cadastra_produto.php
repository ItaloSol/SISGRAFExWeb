<?php
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$dataHoraBd = date('Y-m-d H:i:s');
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
if($tipoecommerce != '0' || $tipoecommerce != '1'){
  $tipoecommerce = 0;
}
if($tipoativo != '0' || $tipoativo != '1'){
  $tipoativo = 0;
}
if ($tpp == 'PP') {
  $tipo_produto = 1;
  $query_produtos = $conexao->prepare("SELECT * FROM produtos p  ORDER BY p.CODIGO DESC LIMIT 1");
   $query_produtos->execute();
  if ($linha = $query_produtos->fetch(PDO::FETCH_ASSOC)) {
    $cod_produto = $linha['CODIGO'];
     $cod_produto =  $cod_produto + 1;
  }
  $query_cadastra_produto = $conexao->prepare("INSERT INTO `produtos`( CODIGO, DESCRICAO, LARGURA, ALTURA, ESPESSURA, PESO, QTD_PAGINAS, TIPO, ATIVO, USO_ECOMMERCE, PRECO_CUSTO) VALUES ($cod_produto,'$descricao','$largura','$altura','$espessura','$peso','$qtdfolhas','$tipoproduto',$tipoativo,$tipoecommerce, 0)");
    $query_cadastra_produto->execute();
} else {
  $tipo_produto = 2;
  $query_produtos = $conexao->prepare("SELECT * FROM produtos_pr_ent p ORDER BY p.CODIGO DESC LIMIT 1");
    $query_produtos->execute();
  $VALOR = [];
  if ($linha = $query_produtos->fetch(PDO::FETCH_ASSOC)) {
    $cod_produto = $linha['CODIGO'];
     $cod_produto =  $cod_produto + 1;
  }
  $query_cadastra_produto = $conexao->prepare("INSERT INTO produtos_pr_ent(CODIGO, ID_CATEGORIA, DESCRICAO, LARGURA, ALTURA, ESPESSURA, PESO, VENDAS, PRE_VENDA, PROM, VLR_PROM, QTD_PAGINAS, ESTOQUE, AVISO_ESTOQUE, AVISO_ESTOQUE_UN, TIPO, VLR_UNIT, ULT_MOV, PD_QTD_MIN, PD_MAX, PD_QTD_MAX, ATIVO, USO_ECOMMERCE ) VALUES ($cod_produto,0,'$descricao',$largura,$altura,$espessura,$peso,0,$prevenda,0,0,$qtdfolhas,$estoque1,$avisa,$aviso,'$tipoproduto',$valorunitario,'$dataHoraBd',$pedidoMin,$pedidoavisa,$pedidoMax,1,$tipoecommerce)");
    $query_cadastra_produto->execute();
}



/// papel
for ($i = 0; $i < count($papel); $i++) {
  $CODIGO_PAPEL = $papel[$i]['CODIGO_PAPEL'];
  $DESCRICAO = $papel[$i]['DESCRICAO'];
  $TIPO = $papel[$i]['TIPO'];
  $CF = $papel[$i]['CF'];
  $CV = $papel[$i]['CV'];

  // Verifica se o registro já existe
  $query_verifica_existencia = $conexao->prepare("
    SELECT COUNT(*) 
    FROM `tabela_papeis_produto` 
    WHERE `tipo_produto` = :tipo_produto 
      AND `cod_produto` = :cod_produto 
      AND `cod_papel` = :cod_papel
  ");
  
  $query_verifica_existencia->bindParam(':tipo_produto', $tipo_produto);
  $query_verifica_existencia->bindParam(':cod_produto', $cod_produto);
  $query_verifica_existencia->bindParam(':cod_papel', $CODIGO_PAPEL);
  $query_verifica_existencia->execute();
  
  $registro_existe = $query_verifica_existencia->fetchColumn();

  // Se o registro não existir, insere
  if ($registro_existe == 0) {
    $query_cadastra_prod_papel = $conexao->prepare("
      INSERT INTO `tabela_papeis_produto` (
        `tipo_produto`, `cod_produto`, `cod_papel`, `tipo_papel`, `cor_frente`, `cor_verso`, `descricao`, `orelha`
      ) VALUES (
        :tipo_produto, :cod_produto, :cod_papel, :tipo_papel, :cor_frente, :cor_verso, :descricao, '0'
      )
    ");

    $query_cadastra_prod_papel->bindParam(':tipo_produto', $tipo_produto);
    $query_cadastra_prod_papel->bindParam(':cod_produto', $cod_produto);
    $query_cadastra_prod_papel->bindParam(':cod_papel', $CODIGO_PAPEL);
    $query_cadastra_prod_papel->bindParam(':tipo_papel', $TIPO);
    $query_cadastra_prod_papel->bindParam(':cor_frente', $CF);
    $query_cadastra_prod_papel->bindParam(':cor_verso', $CV);
    $query_cadastra_prod_papel->bindParam(':descricao', $DESCRICAO);

    $query_cadastra_prod_papel->execute();
  }
}



/// acabamento

for ($i = 0; $i < count($acabamento); $i++) {
  $CODIGO_ACABAMENTO = $acabamento[$i]['CODIGO_ACABAMENTO'];
  // Verifica se o registro já existe
  $query_verifica_existencia = $conexao->prepare("SELECT COUNT(*) FROM `tabela_componentes_produto` WHERE `tipo_produto` = :tipo_produto AND `cod_produto` = :cod_produto AND `cod_acabamento` = :cod_acabamento");
  $query_verifica_existencia->bindParam(':tipo_produto', $tipo_produto);
  $query_verifica_existencia->bindParam(':cod_produto', $cod_produto);
  $query_verifica_existencia->bindParam(':cod_acabamento', $CODIGO_ACABAMENTO);
  $query_verifica_existencia->execute();
  $registro_existe = $query_verifica_existencia->fetchColumn();

  // Se o registro não existir, insere
  if ($registro_existe == 0) {
   
    $query_cadastra_prod_acabamento = $conexao->prepare("INSERT INTO `tabela_componentes_produto` (`tipo_produto`, `cod_produto`, `cod_acabamento`) VALUES (:tipo_produto, :cod_produto, :cod_acabamento)");
    $query_cadastra_prod_acabamento->bindParam(':tipo_produto', $tipo_produto);
    $query_cadastra_prod_acabamento->bindParam(':cod_produto', $cod_produto);
    $query_cadastra_prod_acabamento->bindParam(':cod_acabamento', $CODIGO_ACABAMENTO);
    $query_cadastra_prod_acabamento->execute();
  }
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
