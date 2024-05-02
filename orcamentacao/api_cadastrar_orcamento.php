<?php
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$hoje = date('Y-m-d');
$hora = date('H:i:s');
  // Receber dados enviados pela API
  
  $dados = $_GET;
  $linhas = json_decode($_GET['linhas'], true);
  $dados_servico = json_decode($_GET['DadosServico'], true);
  $dado_clique = json_decode($_GET['DadoClique'], true);
  echo "Linhas: <table border='1'>
  <tr>
  <th>CODIGO_PRODUTO</th>
  <th>VALOR_IMPRESSAO_DIGITAL</th>
  <th>PREÇO_CHAPA</th>
  <th>CUSTO</th>
  <th>QUANTIDADE</th>
  <th>DIGITAL</th>
  <th>CODIGO_PAPEL</th>
  <th>TIPO</th>
  <th>CODIGO</th>
  <th>DESCRIÇÃO</th>
  <th>LARGURA</th>
  <th>ALTURA</th>
  <th>QTD_PÁGINAS</th>
  <th>PRODUTO</th>
  <th>OFFSET</th>
  <th>VALOR_UNITARIO</th>
  <th>CF</th>
  <th>CV</th>
  <th>FORMATO_IMPRESSÃO</th>
  <th>PERCA</th>
  <th>GASTO_FOLHA</th>
  <th>PREÇO_FOLHA</th>
  <th>QUANTIDADE_DE_CHAPAS</th>
  <th>CODIGO_ACABAMENTO</th>
  <th>MÁQUINA</th>
  </tr>";
  foreach ($linhas as $linha) {
    echo "<tr>";
    echo "<td>" . $linha['CODIGO_PRODUTO'] . "</td>";
    echo "<td>" . $linha['VALOR_IMPRESSAO_DIGITAL'] . "</td>";
    echo "<td>" . $linha['PREÇO_CHAPA'] . "</td>";
    echo "<td>" . $linha['CUSTO'] . "</td>";
    echo "<td>" . $linha['QUANTIDADE'] . "</td>";
    echo "<td>" . $linha['DIGITAL'] . "</td>";
    echo "<td>" . $linha['CODIGO_PAPEL'] . "</td>";
    echo "<td>" . $linha['TIPO'] . "</td>";
    echo "<td>" . $linha['CODIGO'] . "</td>";
    echo "<td>" . $linha['DESCRIÇÃO'] . "</td>";
    echo "<td>" . $linha['LARGURA'] . "</td>";
    echo "<td>" . $linha['ALTURA'] . "</td>";
    echo "<td>" . $linha['QTD_PÁGINAS'] . "</td>";
    echo "<td>" . $linha['PRODUTO'] . "</td>";
    echo "<td>" . $linha['OFFSET'] . "</td>";
    echo "<td>" . $linha['VALOR_UNITARIO'] . "</td>";
    echo "<td>" . $linha['CF'] . "</td>";
    echo "<td>" . $linha['CV'] . "</td>";
    echo "<td>" . $linha['FORMATO_IMPRESSÃO'] . "</td>";
    echo "<td>" . $linha['PERCA'] . "</td>";
    echo "<td>" . $linha['GASTO_FOLHA'] . "</td>";
    echo "<td>" . $linha['PREÇO_FOLHA'] . "</td>";
    echo "<td>" . $linha['QUANTIDADE_DE_CHAPAS'] . "</td>";
    echo "<td>" . $linha['CODIGO_ACABAMENTO'] . "</td>";
    echo "<td>" . $linha['MÁQUINA'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
  echo "Dados Serviço: <table border='1'>
<tr>
<th>CODIGO_PRODUTO</th>
<th>DESCRIÇÃO_SERVICO</th>
<th>VALOR_SERVICO</th>
</tr>";
foreach ($dados_servico as $servico) {
  echo "<tr>";
  echo "<td>" . $servico['CODIGO_PRODUTO'] . "</td>";
  echo "<td>" . $servico['DESCRICAO_SERVICO'] . "</td>";
  echo "<td>" . $servico['VALOR_SERVICO'] . "</td>";
  echo "</tr>";
}
echo "</table>";

echo "Dado Clique: <table border='1'>
<tr>
<th>CLIQUE</th>
<th>VALOR</th>
</tr>";
foreach ($dado_clique as $clique) {
  echo "<tr>";
  echo "<td>" . $clique['CLIQUE'] . "</td>";
  echo "<td>" . $clique['VALOR'] . "</td>";
  echo "</tr>";
}
echo "</table>";