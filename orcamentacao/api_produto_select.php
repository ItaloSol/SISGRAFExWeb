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
if (empty($Solicitacao)) {

  $pesquisa = $_GET['id'];
  if ($_GET['tipo'] == 'PP') {
    $tabela = 'produtos';
  } else {
    $tabela = 'produtos_pr_ent';
  }

  $query_produtos = $conexao->prepare("
  SELECT c.cod AS cod_calculo, p.*, pp.*
  FROM tabela_calculos_op c 
  LEFT JOIN $tabela p ON c.cod_produto = p.CODIGO
  LEFT JOIN tabela_papeis pa ON pa.cod = c.cod_papel
  LEFT JOIN tabela_papeis_produto pap ON pap.cod_papel = pa.cod
  LEFT JOIN produtos_pr_ent pp ON pp.CODIGO = p.CODIGO
  WHERE c.cod = $pesquisa
");
  $query_produtos->execute();
  if ($linha = $query_produtos->fetch(PDO::FETCH_ASSOC)) {

    $VALOR = [
      // Campos restantes da tabela tabela_calculos_op
      "cod_op" => isset($linha['cod_op']) ? $linha['cod_op'] : null,
      "cod_proposta" => isset($linha['cod_proposta']) ? $linha['cod_proposta'] : null,
      "tipo_produto" => isset($linha['tipo_produto']) ? $linha['tipo_produto'] : null,
      "qtd_folhas" => isset($linha['qtd_folhas']) ? $linha['qtd_folhas'] : null,
      "qtd_folhas_total" => isset($linha['qtd_folhas_total']) ? $linha['qtd_folhas_total'] : null,
      "qtd_chapas" => isset($linha['qtd_chapas']) ? $linha['qtd_chapas'] : null,
      "montagem" => isset($linha['montagem']) ? $linha['montagem'] : null,
      "formato" => isset($linha['formato']) ? $linha['formato'] : null,
      "perca" => isset($linha['perca']) ? $linha['perca'] : null,

      // Campos restantes da tabela tabela_papeis
      "descricao_papel" => isset($linha['descricao']) ? $linha['descricao'] : null,
      "medida" => isset($linha['medida']) ? $linha['medida'] : null,
      "gramatura" => isset($linha['gramatura']) ? $linha['gramatura'] : null,
      "formato_papel" => isset($linha['formato']) ? $linha['formato'] : null,
      "uma_face" => isset($linha['uma_face']) ? $linha['uma_face'] : null,
      "unitario" => isset($linha['unitario']) ? $linha['unitario'] : null,

      // Campos restantes da tabela tabela_papeis_produto
      "tipo_produto_papel" => isset($linha['tipo_produto']) ? $linha['tipo_produto'] : null,
      "cod_produto_papel" => isset($linha['cod_produto']) ? $linha['cod_produto'] : null,
      "cod_papel" => isset($linha['cod_papel']) ? $linha['cod_papel'] : null,
      "tipo_papel" => isset($linha['tipo_papel']) ? $linha['tipo_papel'] : null,
      "cor_frente" => isset($linha['cor_frente']) ? $linha['cor_frente'] : null,
      "cor_verso" => isset($linha['cor_verso']) ? $linha['cor_verso'] : null,
      "descricao_papel_produto" => isset($linha['descricao']) ? $linha['descricao'] : null,
      "orelha" => isset($linha['orelha']) ? $linha['orelha'] : null,

      // Campos restantes da tabela produtos
      "CODIGO" => isset($linha['CODIGO']) ? $linha['CODIGO'] : null,
      "CODIGO_LI" => isset($linha['CODIGO_LI']) ? $linha['CODIGO_LI'] : null,
      "DESCRICAO" => isset($linha['DESCRICAO']) ? $linha['DESCRICAO'] : null,
      // ...
    ];
    if ($tabela == 'produtos') {
      $VALOR["cod_calculo"] = $linha['cod_calculo'];
      $VALOR["CODIGO"] = $linha['CODIGO'];
      $VALOR["CODIGO_LI"] = $linha['CODIGO_LI'];
      $VALOR["DESCRICAO"] = $linha['DESCRICAO'];
      $VALOR["LARGURA"] = $linha['LARGURA'];
      $VALOR["ALTURA"] = $linha['ALTURA'];
      $VALOR["ESPESSURA"] = $linha['ESPESSURA'];
      $VALOR["PESO"] = $linha['PESO'];
      $VALOR["QTD_PAGINAS"] = $linha['QTD_PAGINAS'];
      $VALOR["TIPO"] = $linha['TIPO'];
      $VALOR["VENDAS"] = $linha['VENDAS'];
      $VALOR["ATIVO"] = $linha['ATIVO'];
      $VALOR["USO_ECOMMERCE"] = $linha['USO_ECOMMERCE'];
      $VALOR["PRECO_CUSTO"] = $linha['PRECO_CUSTO'];
      $VALOR["PROMOCIONAL"] = $linha['PROMOCIONAL'];
      $VALOR["PRECO_PROMOCIONAL"] = $linha['PRECO_PROMOCIONAL'];
    }

    if ($tabela == 'produtos_pr_ent') {
      $VALOR["cod_calculo"] = $linha['cod_calculo'];
      $VALOR["ID_CATEGORIA"] = $linha['ID_CATEGORIA'];
      $VALOR["PRE_VENDA"] = $linha['PRE_VENDA'];
      $VALOR["PROM"] = $linha['PROM'];
      $VALOR["VLR_PROM"] = $linha['VLR_PROM'];
      $VALOR["INICIO_PROM"] = $linha['INICIO_PROM'];
      $VALOR["FIM_PROM"] = $linha['FIM_PROM'];
      $VALOR["ESTOQUE"] = $linha['ESTOQUE'];
      $VALOR["AVISO_ESTOQUE"] = $linha['AVISO_ESTOQUE'];
      $VALOR["AVISO_ESTOQUE_UN"] = $linha['AVISO_ESTOQUE_UN'];
      $VALOR["VLR_UNIT"] = $linha['VLR_UNIT'];
      $VALOR["ULT_MOV"] = $linha['ULT_MOV'];
      $VALOR["PD_QTD_MIN"] = $linha['PD_QTD_MIN'];
      $VALOR["PD_MAX"] = $linha['PD_MAX'];
      $VALOR["PD_QTD_MAX"] = $linha['PD_QTD_MAX'];
    }
  }

  echo json_encode($VALOR);
}
