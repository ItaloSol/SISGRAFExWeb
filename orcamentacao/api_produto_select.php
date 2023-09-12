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
  $Do_papel_cod = '[';
  $qtd_papels = 0;
  $qtd_acabamentos = 0;
  $query_produtos = $conexao->prepare("
  SELECT c.cod AS cod_calculo, 
   p.DESCRICAO AS descricao_produto,
   p.LARGURA AS largurinha,
   p.ALTURA AS alturinha,
   p.PESO AS pesinho,
   p.ESPESSURA AS espessurinha,
   p.CODIGO AS CODIGOguinho,
   p.CODIGO_LI AS CODIGO_LIguinho,
   p.QTD_PAGINAS AS QTD_PAGINASguinho,
   p.TIPO AS TIPOguinho,
   p.VENDAS AS VENDASguinho,
   p.ATIVO AS ATIVOguinho,
   p.USO_ECOMMERCE AS USO_ECOMMERCEguinho,
   p.PRECO_CUSTO AS PRECO_CUSTOguinho,
   po.descricao_produto AS descrisaozinha_prod,
   pa.*,
   po.*,
     pp.*,
      c.*
  FROM tabela_calculos_op c 
  LEFT JOIN $tabela p ON c.cod_produto = p.CODIGO
  LEFT JOIN tabela_papeis pa ON pa.cod = c.cod_papel
  LEFT JOIN tabela_papeis_produto pap ON pap.cod_papel = pa.cod
  LEFT JOIN produtos_pr_ent pp ON pp.CODIGO = p.CODIGO
  LEFT JOIN tabela_produtos_orcamento po ON  po.cod_produto = c.cod_produto AND po.tipo_produto = c.tipo_produto
  WHERE c.cod = $pesquisa
");

  $query_produtos->execute();
  if ($linha = $query_produtos->fetch(PDO::FETCH_ASSOC)) {
    $VALOR = [];
      // Campos restantes da tabela tabela_calculos_op
      if (isset($linha['cod_op'])) {
        $VALOR["cod_op"] = $linha['cod_op'];
    } else {
        $VALOR["cod_op"] = null;
    }
    if (isset($linha['cod_proposta'])) {
        $VALOR["cod_proposta"] = $linha['cod_proposta'];
    } else {
        $VALOR["cod_proposta"] = null;
    }
    if (isset($linha['quantidade'])) {
        $VALOR["quantidade"] = $linha['quantidade'];
    } else {
        $VALOR["quantidade"] = null;
    }
    if (isset($linha['descrisaozinha_prod'])) {
        $VALOR["descrisaozinha_prod"] = $linha['descrisaozinha_prod'];
    } else {
        $VALOR["descrisaozinha_prod"] = null;
    }
    if (isset($linha['observacao_produto'])) {
        $VALOR["observacao_produto"] = $linha['observacao_produto'];
    } else {
        $VALOR["observacao_produto"] = null;
    }
    if (isset($linha['preco_unitario'])) {
        $VALOR["preco_unitario"] = $linha['preco_unitario'];
    } else {
        $VALOR["preco_unitario"] = null;
    }
    if (isset($linha['valor_digital'])) {
        $VALOR["valor_digital"] = $linha['valor_digital'];
    } else {
        $VALOR["valor_digital"] = null;
    }
    if (isset($linha['tipo_trabalho'])) {
        $VALOR["tipo_trabalho"] = $linha['tipo_trabalho'];
    } else {
        $VALOR["tipo_trabalho"] = null;
    }
     if (isset($linha['maquina'])) {
        $VALOR["maquina"] = $linha['maquina'];
    } else {
        $VALOR["maquina"] = null;
    }
    if (isset($linha['tipo_produto'])) {
        $VALOR["tipo_produto"] = $linha['tipo_produto'];
    } else {
        $VALOR["tipo_produto"] = null;
    }
    
    if (isset($linha['qtd_folhas'])) {
        $VALOR["qtd_folhas"] = $linha['qtd_folhas'];
    } else {
        $VALOR["qtd_folhas"] = null;
    }
    
    if (isset($linha['qtd_folhas_total'])) {
        $VALOR["qtd_folhas_total"] = $linha['qtd_folhas_total'];
    } else {
        $VALOR["qtd_folhas_total"] = null;
    }
    
    if (isset($linha['qtd_chapas'])) {
        $VALOR["qtd_chapas"] = $linha['qtd_chapas'];
    } else {
        $VALOR["qtd_chapas"] = null;
    }
    
    if (isset($linha['montagem'])) {
        $VALOR["montagem"] = $linha['montagem'];
    } else {
        $VALOR["montagem"] = null;
    }
    
    if (isset($linha['formato'])) {
        $VALOR["formato"] = $linha['formato'];
    } else {
        $VALOR["formato"] = null;
    }
    
    if (isset($linha['perca'])) {
        $VALOR["perca"] = $linha['perca'];
    } else {
        $VALOR["perca"] = null;
    }
    
    if (isset($linha['descricao'])) {
        $VALOR["descricao_papel"] = $linha['descricao'];
    } else {
        $VALOR["descricao_papel"] = null;
    }
    
    if (isset($linha['medida'])) {
        $VALOR["medida"] = $linha['medida'];
    } else {
        $VALOR["medida"] = null;
    }
    
    if (isset($linha['gramatura'])) {
        $VALOR["gramatura"] = $linha['gramatura'];
    } else {
        $VALOR["gramatura"] = null;
    }
    
    if (isset($linha['formato'])) {
        $VALOR["formato_papel"] = $linha['formato'];
    } else {
        $VALOR["formato_papel"] = null;
    }
    
    if (isset($linha['uma_face'])) {
        $VALOR["uma_face"] = $linha['uma_face'];
    } else {
        $VALOR["uma_face"] = null;
    }
    
    if (isset($linha['unitario'])) {
        $VALOR["unitario"] = $linha['unitario'];
    } else {
        $VALOR["unitario"] = null;
    }
    if (isset($linha['cod_produto'])) {
        $VALOR["cod_produto"] = $linha['cod_produto'];
    } else {
        $VALOR["cod_produto"] = null;
    }
    
    if (isset($linha['tipo_produto'])) {
        $VALOR["tipo_produto_papel"] = $linha['tipo_produto'];
    } else {
        $VALOR["tipo_produto_papel"] = null;
    }
   
    if (isset($linha['cod_produto'])) {
        $cod_produto = $linha['cod_produto'];
        $query_do_acabamento = $conexao->prepare("SELECT * FROM tabela_componentes_produto WHERE cod_produto = $cod_produto  ");
        $query_do_acabamento->execute();
        while($linha4 = $query_do_acabamento->fetch(PDO::FETCH_ASSOC)) {
            $cod_acabamento = $linha4['cod_acabamento'];
                $Do_Acabamento_cod[$qtd_acabamentos] = $cod_acabamento;
            $qtd_acabamentos++;
        }
        $VALOR["cod_acabamentos"] = $Do_Acabamento_cod;
        $VALOR["cod_produto_papel"] = $linha['cod_produto'];
    }else{
        $VALOR["cod_acabamentos"] = null;
        $VALOR["cod_produto_papel"] = null;
    }
    if (isset($linha['cod_papel'])) {
        $cod_papelb = $linha['cod_produto'];
        $query_do_acabamento = $conexao->prepare("SELECT * FROM tabela_papeis_produto WHERE cod_produto = $cod_papelb  ");
        $query_do_acabamento->execute();
        while($linha4 = $query_do_acabamento->fetch(PDO::FETCH_ASSOC)) {
            $cod_acabamento = $linha4['cod_papel'];
                $Do_Acabamento1_cod[$qtd_papels] = $cod_acabamento;
            $qtd_papels++;
        }
       
    $VALOR["cod_papels"] = $Do_Acabamento1_cod;
    }else{
        $VALOR["cod_papels"] = null;
    }
    if (isset($linha['cod_papel'])) {
        $VALOR["cod_papel"] = $linha['cod_papel'];
    } else {
        $VALOR["cod_papel"] = null;
    }
    if (isset($linha['cod_acabamento'])) {
        $VALOR["cod_acabamento"] = $linha['cod_acabamento'];
    } else {
        $VALOR["cod_acabamento"] = null;
    }
    if (isset($linha['tipo_papel'])) {
        $VALOR["tipo_papel"] = $linha['tipo_papel'];
    } else {
        $VALOR["tipo_papel"] = null;
    }
    
    if (isset($linha['cor_frente'])) {
        $VALOR["cor_frente"] = $linha['cor_frente'];
    } else {
        $VALOR["cor_frente"] = null;
    }
    
    if (isset($linha['cor_verso'])) {
        $VALOR["cor_verso"] = $linha['cor_verso'];
    } else {
        $VALOR["cor_verso"] = null;
    }
    
    if (isset($linha['descricao'])) {
        $VALOR["descricao_papel_produto"] = $linha['descricao'];
    } else {
        $VALOR["descricao_papel_produto"] = null;
    }
    
    if (isset($linha['orelha'])) {
        $VALOR["orelha"] = $linha['orelha'];
    } else {
        $VALOR["orelha"] = null;
    }
    
    if (isset($linha['CODIGO'])) {
        $VALOR["CODIGO"] = $linha['CODIGO'];
    } else {
        $VALOR["CODIGO"] = null;
    }
    
    if (isset($linha['CODIGO_LI'])) {
        $VALOR["CODIGO_LI"] = $linha['CODIGO_LI'];
    } else {
        $VALOR["CODIGO_LI"] = null;
    }
    
    if (isset($linha['DESCRICAO'])) {
        $VALOR["DESCRICAO_calculos"] = $linha['DESCRICAO'];
    } else {
        $VALOR["DESCRICAO_calculos"] = null;
    }
      // ...
    if ($tabela == 'produtos') {
      $VALOR["cod_calculo"] = $linha['cod_calculo'];
      $VALOR["CODIGO"] = $linha['CODIGOguinho'];
      $VALOR["CODIGO_LI"] = $linha['CODIGO_LIguinho'];
      $VALOR["DESCRICAO"] = $linha['descricao_produto'];
      $VALOR["LARGURA"] = $linha['largurinha'];
      $VALOR["ALTURA"] = $linha['alturinha'];
      $VALOR["ESPESSURA"] = $linha['espessurinha'];
      $VALOR["PESO"] = $linha['pesinho'];
      $VALOR["QTD_PAGINAS"] = $linha['QTD_PAGINASguinho'];
      $VALOR["TIPO"] = $linha['TIPOguinho'];
      $VALOR["VENDAS"] = $linha['VENDASguinho'];
      $VALOR["ATIVO"] = $linha['ATIVOguinho'];
      $VALOR["USO_ECOMMERCE"] = $linha['USO_ECOMMERCEguinho'];
      $VALOR["PRECO_CUSTO"] = $linha['PRECO_CUSTOguinho'];
     
    }

    if ($tabela == 'produtos_pr_ent') {
        $VALOR["cod_calculo"] = $linha['cod_calculo'];
        $VALOR["CODIGO"] = $linha['CODIGOguinho'];
        $VALOR["CODIGO_LI"] = $linha['CODIGO_LIguinho'];
        $VALOR["DESCRICAO"] = $linha['DESCRICAO'];
        $VALOR["LARGURA"] = $linha['largurinha'];
        $VALOR["ALTURA"] = $linha['ALTURA'];
        $VALOR["ESPESSURA"] = $linha['espessurinha'];
        $VALOR["PESO"] = $linha['pesinho'];
        $VALOR["QTD_PAGINAS"] = $linha['QTD_PAGINASguinho'];
        $VALOR["TIPO"] = $linha['TIPOguinho'];
        $VALOR["VENDAS"] = $linha['VENDASguinho'];
        $VALOR["ATIVO"] = $linha['ATIVOguinho'];
        $VALOR["USO_ECOMMERCE"] = $linha['USO_ECOMMERCEguinho'];
        $VALOR["PRECO_CUSTO"] = $linha['PRECO_CUSTOguinho'];
    }
  }else{
    $VALOR = [null, 'erro'];
  }

  echo json_encode($VALOR);
}
