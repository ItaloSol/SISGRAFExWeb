<?php include_once("../html/navbar.php");
require("../conexoes/conexao.php");
$a = 0;
$hoje = date('Y-m-d');
$mes = date('Y-m');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');

$query_sd_posto = $conexao->prepare("SELECT * FROM tabela_atendentes a INNER JOIN usuario_acessos u ON a.codigo_atendente = u.CODIGO_USR WHERE u.PROD = '1' ORDER BY a.nome_atendente ASC ");
$query_sd_posto->execute();
$Operadores = 0;
while ($linha = $query_sd_posto->fetch(PDO::FETCH_ASSOC)) {
  $Nome_Atendente = $linha['nome_atendente'];
  $codigo_aten = $linha['codigo_atendente'];

  $Nome_Atem[$Operadores] = $Nome_Atendente;
  $Codigo[$Operadores] = $codigo_aten;
  $Operadores++;
};

$i = 0;
$query_Sts_Pord = $conexao->prepare("SELECT * FROM sts_op ORDER BY CODIGO ASC ");
$query_Sts_Pord->execute();
$Sts = 0;
while ($STS = $query_Sts_Pord->fetch(PDO::FETCH_ASSOC)) {
  $Nome_Sts_ = $STS['STS_DESCRICAO'];
  $codigo_Sts_ = $STS['CODIGO'];

  $Nome_Sts_P[$Sts] = $Nome_Sts_;
  $Codigo_Sts_P[$Sts] = $codigo_Sts_;
  $Sts++;
};

?>
<?php
if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
}  ?>
<!-- Accordion -->

<div class="row">
 

    <div class="card">
      <?php
      if (isset($_POST['pesquisar'])) {
        echo ' <h5 class="card-header">Resultados</h5>';
      } else {
        echo ' <h5 class="card-header">Tempo Real (Ultimas 45)</h5>';
      }
      ?>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
          <?php
         
            $query_ordens_finalizadas = $conexao->prepare("SELECT *
            FROM tabela_ordens_producao o INNER JOIN sts_op s on s.CODIGO = o.status
            WHERE o.status = 11
              AND NOT EXISTS (
                SELECT 1
                FROM faturamentos f
                WHERE f.CODIGO_OP = o.cod
              );");
        


          if (isset($query_ordens_finalizadas)) {
            $query_ordens_finalizadas->execute();

            $i = 0;

          ?>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Nº da OP</th>
                  <th>Data de Emissão</th>
                  <th>Data de Entrega</th>
                  <th>Status</th>
                  <th>Produtos</th>
                  <th>Expandir</th>
                  <th>Faturar</th>
                  <th>Cancelar</th>
                </tr>
              </thead>
              <tbody>
              <?php
               $numeroResultados = $query_ordens_finalizadas->rowCount();
               echo '<tr ><td align="center" colspan="8"> TOTAL DE OP PARA ANALISAR: <br><b>' . $numeroResultados . '</b></td></tr>';
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
                $Tipo_Produto = $Ordens_Finalizadas[$i]['tipo_produto'];
                if ($Tipo_Produto == '2') {
                  $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos_pr_ent  WHERE CODIGO = '$Pesquisa_Produto'");
                  $query_PRODUTOS->execute();

                  while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                    $Tabela_Produtos_Finalizados[$i] = [
                      'descricao' => $linha2['DESCRICAO']
                    ];
                  }
                }
                if ($Tipo_Produto == '1') {
                  $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_Produto'");
                  $query_PRODUTOS->execute();

                  while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                    $Tabela_Produtos_Finalizados[$i] = [
                      'descricao' => $linha2['DESCRICAO']
                    ];
                  }
                }

                $Pesquisa_Orc = $Ordens_Finalizadas[$i]['orcamento_base'];
                $query_Pesquisa_Orc = $conexao->prepare("SELECT * FROM tabela_orcamentos  WHERE cod = '$Pesquisa_Orc'");
                $query_Pesquisa_Orc->execute();
               
                while ($linha2 = $query_Pesquisa_Orc->fetch(PDO::FETCH_ASSOC)) {
                  $Tabela_Orc_Finalizados[$i] = [
                    'valor_total' => $linha2['valor_total']
                  ];
                }

                echo '<tr>
                        <td>
                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>' . $Ordens_Finalizadas[$i]['cod'] . '</strong>
                        </td>
                        <td>' . date('d/m/Y', strtotime($Ordens_Finalizadas[$i]['data_emissao'])) . '</td>
                        <td>
                             ' . date('d/m/Y', strtotime($Ordens_Finalizadas[$i]['data_entrega'])) . '
                        </td>
                        
                        <td><span class="badge bg-label-primary me-1">' . $Ordens_Finalizadas[$i]['status'] . ' - ' . $Ordens_Finalizadas[$i]["STS_DESCRICAO"] . '</span></td>
                        <td>
                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>' . $Tabela_Produtos_Finalizados[$i]['descricao'] . '</strong>
                        </td>
                        <td>
                        <div class="">
                        <a target="_blank" class="btn rounded-pill btn-info" href="../producao/tl-controle-op.php?cod=' . $Ordens_Finalizadas[$i]['cod'] . '"><i class="bx bx-edit-alt me-1"></i> VIZUALIZAR</a>
                    </div>
                        </td>
                        <td>
                        <div class="">
                        <a target="_blank" class="btn rounded-pill btn-warning" href="faturamento.php?cod=' . $Ordens_Finalizadas[$i]['cod'] . '"><i class="bx bx-edit-alt me-1"></i> FATURAR</a>
                    </div>
                        </td>
                        <td>
                        <div class="">
                        <a class="btn rounded-pill btn-danger" href="cancelar_op.php?cod=' . $Ordens_Finalizadas[$i]['cod'] . '"><i class="bx bx-edit-alt me-1"></i> CANCELAR</a>
                    </div>
                        </td>
                      </tr>';


                $i++;
              }

              if (!isset($Ordens_Finalizadas[0]['cod'])) {
                echo '<tr>
                        <td>
                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Nenhum Resultado Encontrado, Confira o código ou se já está em produção.</strong>
                        </td>
                        <td></td>
                        <td>
                            
                        </td>
                        <td><span class="badge bg-label-primary me-1"></span></td>
                        <td>
                          
                        </td>
                      </tr>';
              }
            } else {
              echo '<tr>
                      <td>
                        <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>É necessário  ativar um filtro antes de consultar!</strong>
                      </td>
                      <td></td>
                      <td>
                          
                      </td>
                      <td><span class="badge bg-label-primary me-1"></span></td>
                      <td>
                        
                      </td>
                    </tr>';
            }
              ?>


              </tbody>
            </table>
        </div>
      </div>
    </div>
    <?php  include_once("../html/navbar-dow.php"); ?>