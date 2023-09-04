<?php
session_start();
include_once('../conexoes/conexao.php');
include_once('../conexoes/conn.php');

$tabela1 = '<table border="1" class="table table-bordered table-hover">';
$titulos = '';
$conteudos = '';
$loop = 0;
                      $conjanterior = 0;
                      $ordem = 0;
                      $conjunto = 0;
                      $anterior = 0;
                      $Codigos_op = array();

                      $query_resultado_geral = $conexao->prepare("SELECT * FROM relatorio_diario r INNER JOIN tabela_ordens_producao o ON o.cod = r.fk_op  ORDER BY r.fk_op DESC,r.data1 DESC");
                      $query_resultado_geral->execute();

                      $quantidade = $query_resultado_geral->rowCount();
                      do {
                        $linha = $query_resultado_geral->fetch(PDO::FETCH_ASSOC);
                        $montando = '';
                        $Pesquisa_Cliente = $linha['cod_cliente'];
                        $Tipo_Cliente = $linha['tipo_cliente'];
                        $Pesquisa_produto = $linha['cod_produto'];
                        $Tipo_produto = $linha['tipo_produto'];
                        if ($Tipo_produto == '2') {
                          $query_PRODUTOS = $conexao->prepare("SELECT * FROM produto_pr_ent  WHERE CODIGO = '$Pesquisa_produto'");
                          $query_PRODUTOS->execute();

                          while ($linha3 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                            $Tabela_Produtos_Selecionada =  $linha3['DESCRICAO'];
                          }
                        }
                        if ($Tipo_produto == '1') {
                          $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_produto'");
                          $query_PRODUTOS->execute();

                          while ($linha3 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                            $Tabela_Produtos_Selecionada = $linha3['DESCRICAO'];
                          }
                        }
                        if ($Tipo_Cliente == '2') {
                          $query_PRODUTOS = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos  WHERE cod = '$Pesquisa_Cliente'");
                          $query_PRODUTOS->execute();

                          while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                            $Tabela_Clientes_Selecionada =  $linha2['nome'];
                          }
                        }
                        if ($Tipo_Cliente == '1') {
                          $query_PRODUTOS = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos  WHERE cod = '$Pesquisa_Cliente'");
                          $query_PRODUTOS->execute();

                          while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                            $Tabela_Clientes_Selecionada = $linha2['nome'];
                          }
                        }
                        $cod_op = $linha['fk_op'];
                        $Codigos_op[$loop] = $cod_op;

                        $secao = $linha['secao'];
                        $descricao = $linha['descricao'];
                        $operador1 = $linha['operador1'];
                        $operador2 = $linha['operador2'];
                        $atividade = $linha['atividade'];
                        $OBSERVACAO = $linha['OBSERVACAO'];
                        $data1 = $linha['data1'];
                        $data2 = $linha['data2'];
                        $data3 = $linha['data3'];
                        if ($data2 == '') {
                          $data2 = null;
                        }
                        if ($data3 == '') {
                          $data3 = null;
                        }
                        $anterior = $loop - 1;
                        if ($anterior == -1) {
                          $anterior = 0;
                        }
                        $conjanterior = $conjanterior - 1;
                        if ($conjanterior == -1) {
                          $conjanterior = 0;
                        }
                        if ($cod_op != $Codigos_op[$anterior]) {
                          $conjunto++;
                        } else {
                          if ($loop < 1) {
                            $conteudos = $conteudos . '<tr><td><b style=" color: black;">'.$secao.'</b><br><b style=" color: black;">' . $cod_op . '</b> – <b>' . $Tabela_Produtos_Selecionada . '</b> ' . $Tabela_Clientes_Selecionada . ':<br>';
                          }
                        }
                        if ($cod_op != $Codigos_op[$anterior]) {
                          $conteudos = $conteudos . '<tr><td><b style=" color: black;">'.$secao.'</b><br><b style=" color: black;">' . $cod_op . '</b> – <b>' . $Tabela_Produtos_Selecionada . '</b> ' . $Tabela_Clientes_Selecionada . ':<br>';
                        }

                        $montando = '<b style=" color: red;">' . $operador1 . '</b>';
                        if ($operador2 != '') {
                          $montando = $montando . ' <b style=" color: red;">( ' . $operador2 . ' )</b> ';
                        }
                        if ($atividade != '') {
                          $montando = $montando . ' <b style=" color: blue;">' . $atividade . '</b> ';
                        }
                        if ($OBSERVACAO != '') {
                          $montando = $montando . ' <b style="background-color: yellow;">' . $OBSERVACAO . '</b> ';
                        }
                        if ($data1 != '' && $data2 == null && $data3 == null) {
                          $montando = $montando . ' <b style=" color: black;">' . $data1 . '</b> ';
                        } else {
                          $montando = $montando . ' <s><b style=" color: black;">' . $data1 . '</b></s> ';
                        }

                        if ($data2 == null && $data3 == null) {
                        } else {
                          if ($data2 != null && $data3 == null) {
                            $montando = $montando . ' --> <b style=" color: black;">' . $data2 . '</b> ';
                          } else {
                            $montando = $montando . ' --> <s><b style=" color: black;">' . $data2 . '</b></s> ';
                          }
                          if ($data3 != null) {
                            $montando = $montando . ' --> <b style=" color: black;">' . $data3 . '</b> ';
                          }
                        }
                        $conteudos = $conteudos . $montando;
                        


                        $loop++;
                      } while ($loop < $quantidade);

$Fim_Tabela = '</table>';
$Tabela_Completa = $tabela1 . $conteudos . $Fim_Tabela;

$titulo = "<h5>RELATÓRIO DE CONTROLE DAS ORDENS DE PRODUÇÃO - SISGRAFEX WEB</h5><br>";
$html = $titulo . $Tabela_Completa;


// echo $html;
/// FIM CODIGO VARIAVEL///
/////////////////////////////////////////////
///////////////// CODIGO FIXO ///////////////
/////////////////////////////////////////////
require_once __DIR__ . '../../vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \mPDF();

    if ($_POST['orientacao'] == 'retrato') {
        // Write some HTML code:
        $mpdf = new mPDF('C', 'A4');
    }
$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first 
//level of a list

// LOAD a stylesheet

$mpdf->WriteHTML($html, 2);
$nome = 'OrdemProducao' . $codigo_op;
$mpdf->Output($nome, 'I');
exit;

