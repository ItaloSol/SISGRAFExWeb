<?php
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$hoje = date('Y-m-d');
$hora = date('H:i:s');

// Receber dados enviados pela API
$data = [
  'salvo' => false,
  'orcamento' => 0,
];

$dados = $_GET;
$linhas = json_decode($_GET['linhas'], true);
$dados_servico = json_decode($_GET['DadosServico'], true);
$dado_clique = json_decode($_GET['DadoClique'], true);

// Validação de dados
$cif = !empty($_GET['cif']) ? $_GET['cif'] : 0;
$desconto = !empty($_GET['desconto']) ? $_GET['desconto'] : 0;
$valorTotal = !empty($_GET['valorTotal']) ? $_GET['valorTotal'] : 0;
$frete = !empty($_GET['frete']) ? $_GET['frete'] : 0;
$arte = !empty($_GET['arte']) ? $_GET['arte'] : 0;
$tipo_produto = $_GET['tipo_produto'] == 'PP' ? '1' : '2';

$cod_orcamento = $_GET['cod_orcamento_edit'] ?? null;
if ($cod_orcamento != 'null') {
  // Modo de edição: apagar registros antigos
  $apagaProdutosOrcamento = $conexao->prepare("DELETE FROM tabela_produtos_orcamento WHERE cod_orcamento = ?");
  $apagaProdutosOrcamento->execute([$cod_orcamento]);

  $apagaCalculosOp = $conexao->prepare("DELETE FROM tabela_calculos_op WHERE cod_proposta = ?");
  $apagaCalculosOp->execute([$cod_orcamento]);

  $apagaComponentesOrcamento = $conexao->prepare("DELETE FROM tabela_componentes_orcamentos WHERE cod_orcamento = ?");
  $apagaComponentesOrcamento->execute([$cod_orcamento]);

  $apagaCliqueUtilizado = $conexao->prepare("DELETE FROM clique_utilizado WHERE fk_orcamento = ?");
  $apagaCliqueUtilizado->execute([$cod_orcamento]);
} else {
  // Modo de criação: gerar novo código de orçamento
  $Busca_orcamento = $conexao->prepare("SELECT * FROM tabela_orcamentos ORDER BY cod DESC LIMIT 1  ");
  $Busca_orcamento->execute();
  if ($linha = $Busca_orcamento->fetch(PDO::FETCH_ASSOC)) {
    $cod_orcamento = $linha['cod'];
  }
  $cod_orcamento = +$cod_orcamento + 1;
}

// Inserir ou atualizar orçamento na tabela_orcamentos
$Insere_Orcamento = $conexao->prepare("REPLACE INTO tabela_orcamentos (cod_cliente, cod_contato, cod_endereco, tipo_cliente, data_validade, data_emissao, valor_unitario, sif, desconto, valor_total, frete, ARTE, precos_manuais, status, descricao, cod_emissor, FAT_TOTALMENTE, cod, COD_LI) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$Insere_Orcamento->execute([
  $_GET['cod'],
  $_GET['contato'],
  $_GET['endereco'],
  $_GET['tipo'] == 'Fisico' ? 1 : 2,
  $_GET['data'],
  $hoje,
  0,
  $cif,
  $desconto,
  $valorTotal,
  $frete,
  $arte,
  $_GET['manual'],
  1,
  $_GET['obterValorObservacao'],
  $cod_user,
  0,
  $cod_orcamento,
  0
]);

// Inserir produtos do orçamento
foreach ($linhas as $linha) {
  $Insere_Produto_Orcamento = $conexao->prepare("INSERT INTO tabela_produtos_orcamento (cod_orcamento, tipo_produto, cod_produto, descricao_produto, quantidade, observacao_produto, preco_unitario, valor_digital, tipo_trabalho, maquina, caminho) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $Insere_Produto_Orcamento->execute([
    $cod_orcamento,
    $tipo_produto,
    $linha['CODIGO_PRODUTO'],
    $linha['DESCRICAO_PRODUTO'],
    $linha['QUANTIDADE'],
    '',
    $linha['VALOR_UNITARIO'],
    $linha['VALOR_IMPRESSAO_DIGITAL'],
    '',
    $linha['DIGITAL'] == 1 ? 1 : 2,
    null
  ]);

  // Inserir cálculos OP
  $Insere_Calculos_OP = $conexao->prepare("INSERT INTO tabela_calculos_op (cod_op, cod_proposta, tipo_produto, cod_produto, cod_papel, tipo_papel, qtd_folhas, qtd_folhas_total, qtd_chapas, montagem, formato, perca) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $Insere_Calculos_OP->execute([
    0,
    $cod_orcamento,
    $tipo_produto,
    $linha['CODIGO_PRODUTO'],
    $linha['CODIGO_PAPEL'],
    $linha['TIPO'],
    $linha['GASTO_FOLHA'],
    $linha['GASTO_FOLHA'],
    $linha['QUANTIDADE_DE_CHAPAS'],
    0,
    $linha['FORMATO_IMPRESSÃO'],
    $linha['PERCA']
  ]);
}

// Inserir serviços do orçamento
foreach ($dados_servico as $servico) {
  $Insere_Componentes_Orcamentos = $conexao->prepare("INSERT INTO tabela_componentes_orcamentos (cod_orcamento, cod_componente, cod_componente_1) VALUES (?, ?, ?)");
  $Insere_Componentes_Orcamentos->execute([
    $cod_orcamento,
    2,
    $servico['CODIGO_PRODUTO']
  ]);
}

// Inserir cliques utilizados
$Busca_orcamento = $conexao->prepare("SELECT * FROM clique_dados ORDER BY id DESC LIMIT 1  ");
  $Busca_orcamento->execute();
  if ($linha = $Busca_orcamento->fetch(PDO::FETCH_ASSOC)) {
    $ctr_clique = $linha['id'];
  }
 
foreach ($dado_clique as $clique) {
  $Insere_Clique_Utilizado = $conexao->prepare("INSERT INTO clique_utilizado (fk_orcamento, ctr_clique, clique_utilizado, valor_calculado, ativado) VALUES (?, ?, ?, ?, ?)");
  $Insere_Clique_Utilizado->execute([
    $cod_orcamento,
    $ctr_clique,
    $clique['CLIQUE'],
    $clique['VALOR'],
    1
  ]);
}

// Registro de atividade de supervisão
$Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade, atendente_supervisao, data_supervisao) VALUES (?, ?, ?)");
$Atividade_Supervisao->execute([
  "Orçamento $cod_orcamento " . ($cod_orcamento ? "atualizado" : "criado"),
  $cod_user,
  $dataHora
]);

$data = [
  'salvo' => true,
  'orcamento' => $cod_orcamento,
  'tipo' => $_GET['tipo'] == 'Fisico' ? 1 : 2
];

echo json_encode($data);
