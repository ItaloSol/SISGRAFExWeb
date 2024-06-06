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
        $tipo_produto = 1;
        $tabela = 'produtos';
    } else {
        $tipo_produto = 2;
        $tabela = 'produtos_pr_ent';
    }
    $qtd_papels = 0;
    $qtd_acabamentos = 0;
    $query_produtos = $conexao->prepare("
    SELECT 
            p.*,
            pa.*,
            pap.*,
            po.*
        FROM 
            $tabela p
        LEFT JOIN 
            tabela_papeis_produto pap ON pap.cod_produto = p.CODIGO
        LEFT JOIN 
            tabela_papeis pa ON pa.cod = pap.cod_papel
        LEFT JOIN 
            tabela_produtos_orcamento po ON po.cod_produto = p.CODIGO
        WHERE 
            p.CODIGO = :pesquisa
    ");

    $query_produtos->bindParam(':pesquisa', $pesquisa);
    $query_produtos->execute();

    $VALOR = [];

    if ($linha = $query_produtos->fetch(PDO::FETCH_ASSOC)) {
        $cod_produto = $linha['CODIGO'];
        $VALOR = $linha;
        if (isset($linha['cod_produto'])) {
            $query_do_acabamento = $conexao->prepare("SELECT * FROM tabela_componentes_produto WHERE cod_produto = $cod_produto AND tipo_produto = '$tipo_produto'  ");
            $query_do_acabamento->execute();
            while($linha4 = $query_do_acabamento->fetch(PDO::FETCH_ASSOC)) {
                $cod_acabamento = $linha4['cod_acabamento'];
                    $Do_Acabamento_cod[$qtd_acabamentos] = $cod_acabamento;
                $qtd_acabamentos++;
            }
            if(isset($Do_Acabamento_cod)){
                $VALOR["cod_acabamentos"] = $Do_Acabamento_cod;
                $VALOR["cod_produto_papel"] = $linha['cod_produto'];
            }else{
                $VALOR["cod_acabamentos"] = null;
                $VALOR["cod_produto_papel"] = null;
            }
        }else{
            $VALOR["cod_acabamentos"] = null;
            $VALOR["cod_produto_papel"] = null;
        }
        if (isset($linha['cod_papel'])) {
            $query_do_papel = $conexao->prepare("SELECT * FROM tabela_papeis_produto WHERE cod_produto = $cod_produto AND tipo_produto = '$tipo_produto'  ");
            $query_do_papel->execute();
            while($linha4 = $query_do_papel->fetch(PDO::FETCH_ASSOC)) {
                $cod_papel = $linha4['cod_papel'];
                    $Do_papel1_cod[$qtd_papels] = $cod_papel;
                $qtd_papels++;
            }
           
        if(isset($Do_papel1_cod)){
        $VALOR["cod_papels"] = $Do_papel1_cod;

        }else{
            $VALOR["cod_papels"] = null;
        }
        }else{
            $VALOR["cod_papels"] = null;
        }
        // Verificando o tipo da tabela
        if ($tabela == 'produtos') {
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
        }

        if ($tabela == 'produtos_pr_ent') {
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
        }

        // Adicionando campos adicionais conforme necessário

    } else {
        $VALOR = [null, 'erro'];
    }

    echo json_encode($VALOR);
}


