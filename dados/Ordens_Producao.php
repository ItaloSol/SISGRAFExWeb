<?php //**   */ //**   */ 
include_once('../conexoes/conexao.php');
/////////////////////////////////// OP FINALIZADAS //////////////////////////////////////////////////////
$query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO ORDER BY ");
$query_ordens_finalizadas->execute();
$i = 0;
while ($linha = $query_ordens_finalizadas->fetch(PDO::FETCH_ASSOC)) {
    $Ordens_Finalizadas[$i] = [
        'cod' => $linha['cod'],
        'orcamento_base' => $linha['orcamento_base'],
        'tipo_produto' => $linha['tipo_produto'],
        'cod_produto' => $linha['cod_produto'],
        'cod_cliente' => $linha['cod_cliente'],
        'tipo_cliente' => $linha['tipo_cliente'],
        'status' => $linha['status'],
        'STS_DESCRICAO' => $linha['STS_DESCRICAO'],
        'data_entrega' => date($linha['data_entrega']),
        'data_emissao' => date($linha['data_emissao']),

    ];
    $Pesquisa_Produto = $Ordens_Finalizadas[$i]['cod_produto'];
    $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_Produto'");
    $query_PRODUTOS->execute();

    while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
        $Tabela_Produtos_Finalizados[$i] = [
            'descricao' => $linha2['DESCRICAO']
        ];
    }
    $Pesquisa_Orc = $Ordens_Finalizadas[$i]['orcamento_base'];
    $query_Pesquisa_Orc = $conexao->prepare("SELECT * FROM tabela_orcamentos  WHERE cod = '$Pesquisa_Orc'");
    $query_Pesquisa_Orc->execute();

    while ($linha2 = $query_Pesquisa_Orc->fetch(PDO::FETCH_ASSOC)) {
        $Tabela_Orc_Finalizados[$i] = [
            'valor_total' => $linha2['valor_total']
        ];
    }
    $i++;
}
if (isset($Ordens_Finalizadas)) {
    $Total_Finalizadas = count($Ordens_Finalizadas);
} else {
    $Total_Finalizadas = 0;
}
$Percorrer_Finalizadas = 0;
$valor_total_Finalizadas = 0;
/////////////////////////////////////// FIM OP FINALZIADAS ///////////////////////////////////////////////////////////////