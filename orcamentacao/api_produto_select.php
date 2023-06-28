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
  INNER JOIN $tabela p ON c.cod_produto = p.CODIGO
  INNER JOIN tabela_papeis pa ON pa.cod = c.cod_papel
  INNER JOIN tabela_papeis_produto pap ON pap.cod_papel = pa.cod
  INNER JOIN produtos_pr_ent pp ON pp.CODIGO = p.CODIGO
  WHERE c.cod = $pesquisa
");
  $query_produtos->execute();
  if ($linha = $query_produtos->fetch(PDO::FETCH_ASSOC)) {
    $VALOR = [
      "cod_calculo" => $linha['cod_calculo'],
      "CODIGO" => $linha['CODIGO'],
      "CODIGO_LI" => $linha['CODIGO_LI'],
      "DESCRICAO" => $linha['DESCRICAO'],
      "LARGURA" => $linha['LARGURA'],
      "ALTURA" => $linha['ALTURA'],
      "ESPESSURA" => $linha['ESPESSURA'],
      "PESO" => $linha['PESO'],
      "QTD_PAGINAS" => $linha['QTD_PAGINAS'],
      "TIPO" => $linha['TIPO'],
      "VENDAS" => $linha['VENDAS'],
      "ATIVO" => $linha['ATIVO'],
      "USO_ECOMMERCE" => $linha['USO_ECOMMERCE'],
      "PRECO_CUSTO" => $linha['PRECO_CUSTO'],
      "PROMOCIONAL" => $linha['PROMOCIONAL'],
      "PRECO_PROMOCIONAL" => $linha['PRECO_PROMOCIONAL'],
      // Campos restantes da tabela produtos_pr_ent
      "ID_CATEGORIA" => $linha['ID_CATEGORIA'],
      "PRE_VENDA" => $linha['PRE_VENDA'],
      "PROM" => $linha['PROM'],
      "VLR_PROM" => $linha['VLR_PROM'],
      "INICIO_PROM" => $linha['INICIO_PROM'],
      "FIM_PROM" => $linha['FIM_PROM'],
      "ESTOQUE" => $linha['ESTOQUE'],
      "AVISO_ESTOQUE" => $linha['AVISO_ESTOQUE'],
      "AVISO_ESTOQUE_UN" => $linha['AVISO_ESTOQUE_UN'],
      "VLR_UNIT" => $linha['VLR_UNIT'],
      "ULT_MOV" => $linha['ULT_MOV'],
      "PD_QTD_MIN" => $linha['PD_QTD_MIN'],
      "PD_MAX" => $linha['PD_MAX'],
      "PD_QTD_MAX" => $linha['PD_QTD_MAX'],
      // Campos restantes da tabela tabela_calculos_op
      "cod_op" => $linha['cod_op'],
      "cod_proposta" => $linha['cod_proposta'],
      "tipo_produto" => $linha['tipo_produto'],
      "qtd_folhas" => $linha['qtd_folhas'],
      "qtd_folhas_total" => $linha['qtd_folhas_total'],
      "qtd_chapas" => $linha['qtd_chapas'],
      "montagem" => $linha['montagem'],
      "formato" => $linha['formato'],
      "perca" => $linha['perca'],
      // Campos restantes da tabela tabela_papeis
      "descricao_papel" => $linha['descricao'],
      "medida" => $linha['medida'],
      "gramatura" => $linha['gramatura'],
      "formato_papel" => $linha['formato'],
      "uma_face" => $linha['uma_face'],
      "unitario" => $linha['unitario'],
      // Campos restantes da tabela tabela_papeis_produto
      "tipo_produto_papel" => $linha['tipo_produto'],
      "cod_produto_papel" => $linha['cod_produto'],
      "cod_papel" => $linha['cod_papel'],
      "tipo_papel" => $linha['tipo_papel'],
      "cor_frente" => $linha['cor_frente'],
      "cor_verso" => $linha['cor_verso'],
      "descricao_papel_produto" => $linha['descricao'],
      "orelha" => $linha['orelha']
    ];
  }

  echo json_encode($VALOR);
}
