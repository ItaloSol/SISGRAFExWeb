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
if($_GET['cif'] == ''){
  $_GET['cif'] = 0;
}
if($_GET['desconto'] == ''){
  $_GET['desconto'] = 0;
};
if($_GET['valorTotal'] == ''){
  $_GET['valorTotal'] = 0;
};
if($_GET['frete'] == ''){
  $_GET['frete'] = 0;
};
if($_GET['arte'] == ''){
  $_GET['arte'] = 0;
};
if($_GET['tipo_produto'] == 'PP'){
  $tipo_produto = '1';
}else{
  $tipo_produto = '2';
}

// tabela_orcamentos
$cod_cliente = $_GET['cod'];
$cod_contato = $_GET['contato'];
$cod_endereco = $_GET['endereco'];
$data_validade = $_GET['data'];
$data_emissao = $hoje;
$sif = $_GET['cif'];
$desconto = $_GET['desconto'];
$valor_total = $_GET['valorTotal'];
$frete = $_GET['frete'];
$ARTE = $_GET['arte'];
$precos_manuais = $_GET['manual'];
$status = 1;
$cod_emissor = $cod_user;
$FAT_TOTALMENTE = 0;
if($_GET['tipo'] == 'Fisico'){
  $tipo_cliente = '1';
}else{
  $tipo_cliente = '2';
}
$descricao = $_GET['obterValorObservacao'];
$Busca_orcamento = $conexao->prepare("SELECT * FROM tabela_orcamentos ORDER BY cod DESC LIMIT 1  ");
$Busca_orcamento->execute();
if ($linha = $Busca_orcamento->fetch(PDO::FETCH_ASSOC)) {
  $cod_orcamento = $linha['cod'];
}
$cod_orcamento = +$cod_orcamento + 1;
//echo $cod_orcamento;
$var = 0;
// tabela_produtos_orcamento

$Insere_Orcamento = $conexao->prepare("INSERT INTO tabela_orcamentos (cod_cliente, cod_contato, cod_endereco, tipo_cliente, data_validade, data_emissao, valor_unitario, sif, desconto, valor_total, frete, ARTE, precos_manuais, status, descricao, cod_emissor, FAT_TOTALMENTE, cod, COD_LI) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$Insere_Orcamento->bindParam(1, $cod_cliente, PDO::PARAM_INT);
$Insere_Orcamento->bindParam(2, $cod_contato, PDO::PARAM_INT);
$Insere_Orcamento->bindParam(3, $cod_endereco, PDO::PARAM_INT);
$Insere_Orcamento->bindParam(4, $tipo_cliente, PDO::PARAM_INT);
$Insere_Orcamento->bindParam(5, $data_validade);
$Insere_Orcamento->bindParam(6, $data_emissao);
$Insere_Orcamento->bindParam(7, $var);
$Insere_Orcamento->bindParam(8, $sif);
$Insere_Orcamento->bindParam(9, $desconto);
$Insere_Orcamento->bindParam(10, $valor_total);
$Insere_Orcamento->bindParam(11, $frete);
$Insere_Orcamento->bindParam(12, $ARTE);
$Insere_Orcamento->bindParam(13, $precos_manuais, PDO::PARAM_INT);
$Insere_Orcamento->bindParam(14, $status, PDO::PARAM_INT);
$Insere_Orcamento->bindParam(15, $descricao);
$Insere_Orcamento->bindParam(16, $cod_emissor);
$Insere_Orcamento->bindParam(17, $FAT_TOTALMENTE, PDO::PARAM_INT);
$Insere_Orcamento->bindParam(18, $cod_orcamento, PDO::PARAM_INT);
$Insere_Orcamento->bindParam(19, $var);
$Insere_Orcamento->execute(); 


foreach ($linhas as $linha) {
  
  // echo  $linha['CODIGO_PRODUTO'] . "<br>";
  // echo  $linha['VALOR_IMPRESSAO_DIGITAL'] . "<br>";
  // echo  $linha['PREÇO_CHAPA'] . "<br>";
  // echo  $linha['CUSTO'] . "<br>";
  // echo  $linha['QUANTIDADE'] . "<br>";
  // echo  $linha['DIGITAL'] . "<br>";
  // echo  $linha['CODIGO_PAPEL'] . "<br>";
  // echo  $linha['TIPO'] . "<br>";
  // echo  $linha['CODIGO'] . "<br>";
  // echo  $linha['DESCRICAO_PRODUTO'] . "<br>";
  // echo  $linha['DESCRICAO_PAPEL'] . "<br>";
  // echo  $linha['LARGURA'] . "<br>";
  // echo  $linha['ALTURA'] . "<br>";
  // echo  $linha['QTD_PÁGINAS'] . "<br>";
  // echo  $linha['PRODUTO'] . "<br>";
  // echo  $linha['OFFSET'] . "<br>";
  // echo  $linha['VALOR_UNITARIO'] . "<br>";
  // echo  $linha['CF'] . "<br>";
  // echo  $linha['CV'] . "<br>";
  // echo  $linha['FORMATO_IMPRESSÃO'] . "<br>";
  // echo  $linha['PERCA'] . "<br>";
  // echo  $linha['GASTO_FOLHA'] . "<br>";
  // echo  $linha['PREÇO_FOLHA'] . "<br>";
  // echo  $linha['QUANTIDADE_DE_CHAPAS'] . "<br>";
  // echo  $linha['CODIGO_ACABAMENTO'] . "<br>";
  // echo  $linha['MÁQUINA'] . "<br>";
  

  $cod_produto = $linha['CODIGO_PRODUTO'];
  $descricao_produto = $linha['DESCRICAO_PRODUTO'];
 
  $quantidade = $linha['QUANTIDADE'];
  $observacao_produto = '';
  $preco_unitario = $linha['VALOR_UNITARIO'];
  $valor_digital = $linha['VALOR_IMPRESSAO_DIGITAL'];
  $tipo_trabalho = '';
  if ($linha['DIGITAL'] == 1) {
    $maquina = 1;
  } else {
    $maquina = 2;
  }
  $caminho = null;

  $Insere_Produto_Orcamento = $conexao->prepare("INSERT INTO tabela_produtos_orcamento (cod_orcamento, tipo_produto, cod_produto, descricao_produto, quantidade, observacao_produto, preco_unitario, valor_digital, tipo_trabalho, maquina, caminho) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $Insere_Produto_Orcamento->bindParam(1, $cod_orcamento, PDO::PARAM_INT);
  $Insere_Produto_Orcamento->bindParam(2, $tipo_produto, PDO::PARAM_INT);
  $Insere_Produto_Orcamento->bindParam(3, $cod_produto, PDO::PARAM_INT);
  $Insere_Produto_Orcamento->bindParam(4, $descricao_produto);
  $Insere_Produto_Orcamento->bindParam(5, $quantidade, PDO::PARAM_INT);
  $Insere_Produto_Orcamento->bindParam(6, $observacao_produto);
  $Insere_Produto_Orcamento->bindParam(7, $preco_unitario);
  $Insere_Produto_Orcamento->bindParam(8, $valor_digital);
  $Insere_Produto_Orcamento->bindParam(9, $tipo_trabalho);
  $Insere_Produto_Orcamento->bindParam(10, $maquina, PDO::PARAM_INT);
  $Insere_Produto_Orcamento->bindParam(11, $caminho);
  $Insere_Produto_Orcamento->execute();

  $cod_op = 0;
  $cod_papel = $linha['CODIGO_PAPEL'];
  $tipo_papel = $linha['TIPO'];
  $qtd_folhas = $linha['GASTO_FOLHA'];
  $qtd_folhas_total = $linha['GASTO_FOLHA'];
  $qtd_chapas = $linha['QUANTIDADE_DE_CHAPAS'];
  $montagem = 0;
  $formato = $linha['FORMATO_IMPRESSÃO'];
  $perca = $linha['PERCA'];

  $Insere_Calculos_OP = $conexao->prepare("INSERT INTO tabela_calculos_op (cod_op, cod_proposta, tipo_produto, cod_produto, cod_papel, tipo_papel, qtd_folhas, qtd_folhas_total, qtd_chapas, montagem, formato, perca) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$Insere_Calculos_OP->bindParam(1, $cod_op, PDO::PARAM_INT);
$Insere_Calculos_OP->bindParam(2, $cod_orcamento, PDO::PARAM_INT);
$Insere_Calculos_OP->bindParam(3, $tipo_produto, PDO::PARAM_INT);
$Insere_Calculos_OP->bindParam(4, $cod_produto, PDO::PARAM_INT);
$Insere_Calculos_OP->bindParam(5, $cod_papel, PDO::PARAM_INT);
$Insere_Calculos_OP->bindParam(6, $tipo_papel);
$Insere_Calculos_OP->bindParam(7, $qtd_folhas, PDO::PARAM_INT);
$Insere_Calculos_OP->bindParam(8, $qtd_folhas_total, PDO::PARAM_INT);
$Insere_Calculos_OP->bindParam(9, $qtd_chapas, PDO::PARAM_INT);
$Insere_Calculos_OP->bindParam(10, $montagem, PDO::PARAM_INT);
$Insere_Calculos_OP->bindParam(11, $formato, PDO::PARAM_INT);
$Insere_Calculos_OP->bindParam(12, $perca);
$Insere_Calculos_OP->execute();
}

foreach ($dados_servico as $servico) {
  
  // echo  $servico['CODIGO_PRODUTO'] . "<br>";
  // echo  $servico['DESCRICAO_SERVICO'] . "<br>";
  // echo  $servico['VALOR_SERVICO'] . "<br>";
  
  $cod_componente_1 = $servico['CODIGO_PRODUTO'];
  $cod_componente = 2;
  $Insere_Componentes_Orcamentos = $conexao->prepare("INSERT INTO tabela_componentes_orcamentos (cod_orcamento, cod_componente, cod_componente_1) VALUES (?, ?, ?)");
$Insere_Componentes_Orcamentos->bindParam(1, $cod_orcamento, PDO::PARAM_INT);
$Insere_Componentes_Orcamentos->bindParam(2, $cod_componente, PDO::PARAM_INT);
$Insere_Componentes_Orcamentos->bindParam(3, $cod_componente_1, PDO::PARAM_INT);
$Insere_Componentes_Orcamentos->execute();
}
$Busca_clique_contrato = $conexao->prepare("SELECT * FROM clique_dados ORDER BY id DESC LIMIT 1  ");
$Busca_clique_contrato->execute();
if ($linha = $Busca_clique_contrato->fetch(PDO::FETCH_ASSOC)) {
  $ctr_clique = $linha['contrato_clique'];
}
// echo '<br>'. $ctr_clique . '<br>';
foreach ($dado_clique as $clique) {
  
  // echo  $clique['CLIQUE'] . "<br>";
  // echo  $clique['VALOR'] . "<br>";
  
  $clique_utilizado = $clique['CLIQUE'];
  $valor_calculado = $clique['VALOR'];
  $Insere_Clique_Utilizado = $conexao->prepare("INSERT INTO clique_utilizado (fk_orcamento, ctr_clique, clique_utilizado, valor_calculado, ativado) VALUES (?, ?, ?, ?, ?)");
$Insere_Clique_Utilizado->bindParam(1, $cod_orcamento, PDO::PARAM_INT);
$Insere_Clique_Utilizado->bindParam(2, $ctr_clique, PDO::PARAM_INT);
$Insere_Clique_Utilizado->bindParam(3, $clique_utilizado, PDO::PARAM_INT);
$Insere_Clique_Utilizado->bindParam(4, $valor_calculado, PDO::PARAM_INT);
$Insere_Clique_Utilizado->bindParam(5, $ativado, PDO::PARAM_INT);
$Insere_Clique_Utilizado->execute();
}

$Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade, atendente_supervisao, data_supervisao) VALUES ('Criado um novo orçamento $cod_orcamento', '$cod_user', '$dataHora')");
  $Atividade_Supervisao->execute();
// if ($Insere_Servico->rowCount() > 0) {
//   $salvo = ['erro' => false];
// } else {
//   $salvo = ['erro' => true];
// }
// echo json_encode($salvo);
$data = [
  'salvo' => true,
  'orcamento' => $cod_orcamento,
  'tipo' => $tipo_cliente
];

echo json_encode($data);