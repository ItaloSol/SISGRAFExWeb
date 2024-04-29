<?php
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$hoje = date('Y-m-d');
$hora = date('H:i:s');
$Solicitacao = json_decode(file_get_contents("php://input"), true);
$query_produtosa = $conexao->prepare("SELECT DISTINCT * FROM produtos p

ORDER BY p.CODIGO DESC LIMIT 45");
$query_produtosa->execute();
$pp = [];
while ($linha = $query_produtosa->fetch(PDO::FETCH_ASSOC)) {
    $pp[] = [
        'CODIGO' => $linha['CODIGO'], // Ajuste para $linha['id']
        'TIPO_PRODUTO' => $linha['TIPO'],
        'CODPRODUTO' => $linha['CODIGO'], // Ajuste para $linha['cod_produto']
        'DESCRICAO' => $linha['DESCRICAO'],
        'TIPO' => 'PP',
        'VALOR_UNITARIO' => $linha['PRECO_CUSTO'],
    ];
}

$query_produtos = $conexao->prepare("SELECT DISTINCT * FROM produtos_pr_ent p ORDER BY p.CODIGO DESC LIMIT 45");
$query_produtos->execute();
$pe = [];
while ($linha = $query_produtos->fetch(PDO::FETCH_ASSOC)) {
    $pe[] = [
        'CODIGO' => $linha['CODIGO'], // Ajuste para $linha['id']
        'TIPO_PRODUTO' => $linha['TIPO'],
        'CODPRODUTO' => $linha['CODIGO'], // Ajuste para $linha['cod_produto']
        'DESCRICAO' => $linha['DESCRICAO'],
        'TIPO' => 'PE',
        'VALOR_UNITARIO' => $linha['VLR_UNIT'],
    ];
}

//DEFINE QUAL ENTRADA FOI USADO
if (!empty($Solicitacao)) {
    if ($Solicitacao['pesquisa'] == 'descricao') {
        $Tipo_Consulta = 'DESCRICAO';
    } else {
        $Tipo_Consulta = 'CODIGO';
    };
    $pesquisa = $Solicitacao['valor'];
    if ($Solicitacao['TipoProdutoSelect'] == 'PP') {
        $query_produtos = $conexao->prepare("SELECT * FROM produtos p  WHERE p.$Tipo_Consulta LIKE '%$pesquisa%' ORDER BY p.CODIGO DESC LIMIT 45");
        $query_produtos->execute();
        $VALOR = [];
        while ($linha = $query_produtos->fetch(PDO::FETCH_ASSOC)) {
            $VALOR[] = [
                'CODIGO' => $linha['CODIGO'],
                'TIPO_PRODUTO' => $linha['TIPO'],
                'CODPRODUTO' => $linha['CODIGO'],
                'DESCRICAO' => $linha['DESCRICAO'],
                'TIPO' => 'PP',
                'VALOR_UNITARIO' => $linha['PRECO_CUSTO'],
            ];
        }
    } else {
        $query_produtos = $conexao->prepare("SELECT * FROM produtos_pr_ent p   WHERE p.$Tipo_Consulta LIKE '%$pesquisa%' ORDER BY p.CODIGO DESC LIMIT 45");
        $query_produtos->execute();
        $VALOR = [];
        while ($linha = $query_produtos->fetch(PDO::FETCH_ASSOC)) {
            $VALOR[] = [
                'CODIGO' => $linha['CODIGO'],
                'TIPO_PRODUTO' => $linha['TIPO'],
                'CODPRODUTO' => $linha['CODIGO'],
                'DESCRICAO' => $linha['DESCRICAO'],
                'TIPO' => 'PE',
                'VALOR_UNITARIO' => $linha['VLR_UNIT'],
            ];
        }
    }
    echo json_encode($VALOR);
} else {
    // retorna os resultados em formato JSON
    echo json_encode(['pp' => $pp, 'pe' => $pe]);
}
