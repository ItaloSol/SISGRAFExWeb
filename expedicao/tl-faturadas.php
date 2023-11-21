<?php include_once("../html/navbar.php"); ?>
<div class=" faturamento-- "></div>

<?php
if (isset($_GET['Tp'])) {
  if ($_GET['Tp'] == 'op') {
    $codi = $_GET['PS'];
    $query_faturamento = $conexao->prepare("SELECT * FROM faturamentos WHERE CODIGO_OP = :codi ORDER BY CODIGO DESC LIMIT 150 ");
    $query_faturamento->bindParam(':codi', $codi, PDO::PARAM_STR);
  } elseif ($_GET['Tp'] == 'cod') {
    $codi = $_GET['PS'];
    $query_faturamento = $conexao->prepare("SELECT * FROM faturamentos WHERE CODIGO = :codi ORDER BY CODIGO DESC LIMIT 150 ");
    $query_faturamento->bindParam(':codi', $codi, PDO::PARAM_STR);
  } elseif ($_GET['Tp'] == 'cli') {
    $codi = $_GET['PS'];
    // Supondo que cod_cliente seja o campo que representa o código do cliente em tabela_ordens_producao
    $query_faturamento = $conexao->prepare("SELECT * FROM faturamentos 
                                            WHERE CODIGO_OP IN (SELECT cod FROM tabela_ordens_producao WHERE cod_cliente = :codi) 
                                            ORDER BY CODIGO DESC LIMIT 150 ");
    $query_faturamento->bindParam(':codi', $codi, PDO::PARAM_STR);
  } elseif ($_GET['Tp'] == 'nomepro') {
    $codi = $_GET['PS'];
    $query_faturamento = $conexao->prepare("SELECT * FROM faturamentos 
                                            WHERE CODIGO_OP IN (SELECT cod FROM tabela_ordens_producao WHERE cod_produto IN (SELECT CODIGO FROM produtos WHERE DESCRICAO LIKE :codi)) 
                                            ORDER BY CODIGO DESC LIMIT 150 ");
    $codi = "%$codi%"; // Adicionando caracteres curinga para comparação LIKE
    $query_faturamento->bindParam(':codi', $codi, PDO::PARAM_STR);
  } else {
    $query_faturamento = $conexao->prepare("SELECT * FROM faturamentos ORDER BY CODIGO DESC LIMIT 150");
  }
} else {
  $query_faturamento = $conexao->prepare("SELECT * FROM faturamentos ORDER BY CODIGO DESC LIMIT 150");
}

$query_faturamento->execute();
$i = 0;
while ($linha = $query_faturamento->fetch(PDO::FETCH_ASSOC)) {
  $FATURAMENTOS[$i] = array(
    'CODIGO' => $linha['CODIGO'],
    'codigo_op' => $linha['CODIGO_OP'],
    'QTD_ENTREGUE' => $linha['QTD_ENTREGUE'],
    'VLR_FAT' => $linha['VLR_FAT'],
    'OBSERVACOES' => $linha['OBSERVACOES']
  );
  $codigo_op1[$i] = $linha['CODIGO_OP'];
  if ($FATURAMENTOS[$i]['OBSERVACOES'] == '') {
    $FATURAMENTOS[$i]['OBSERVACOES'] = 'SEM OBSERVAÇÕES';
  }
  $i++;
}
for ($a = 0; $a < $i; $a++) {
  $codigo_op = $codigo_op1[$a];
  if (isset($_GET['Tp'])) {
    if ($_GET['Tp'] == 'cli') {
      $codi = $_GET['PS'];
      $query_op = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE cod_cliente = :codi AND cod = $codigo_op");
      $query_op->bindParam(':codi', $codi, PDO::PARAM_STR);
    } elseif ($_GET['Tp'] == 'op') {
      $codi = $_GET['PS'];
      $query_op = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE cod = :codi");
      $query_op->bindParam(':codi', $codi, PDO::PARAM_STR);
    } else {
      $query_op = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE cod = :codigo_op");
      $query_op->bindParam(':codigo_op', $codigo_op, PDO::PARAM_STR);
    }
  } else {
    $query_op = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE cod = :codigo_op");
    $query_op->bindParam(':codigo_op', $codigo_op, PDO::PARAM_STR);
  }

  $query_op->execute();
  if ($linha3 = $query_op->fetch(PDO::FETCH_ASSOC)) {
    $PRODUCAO[$a] = [
      'codigo_orc' => $linha3['orcamento_base'],
      'tipo_produto' => $linha3['tipo_produto'],
      'cod_produto' => $linha3['cod_produto'],
      'data_prevista' => $linha3['data_entrega'],
      'tipo_cliente' => $linha3['tipo_cliente'],
      'cod_cliente' => $linha3['cod_cliente'],
      'cod_emissor' => $linha3['cod_emissor'],
      'obs_prod' => $linha3['descricao'],
      'data_1a_prova' => $linha3['data_1a_prova'],
      'data_2a_prova' => $linha3['data_2a_prova'],
      'data_3a_prova' => $linha3['data_3a_prova'],
      'data_4a_prova' => $linha3['data_4a_prova'],
      'data_5a_prova' => $linha3['data_5a_prova'],
      'data_prova' => $linha3['DT_ENTG_PROVA'],
    ];
    $tipo_produto = $linha3['tipo_produto'];
    $cod_produto = $linha3['cod_produto'];
    if (!isset($PRODUCAO[$a]['data_prova'])) {
      $PRODUCAO[$a]['data_prova'] = '--';
    }

    if ($tipo_produto == '1') {
      if (isset($_GET['Tp'])) {
        if ($_GET['Tp'] == 'nomepro') {
          $codi = $_GET['PS'];
          $query_produto = $conexao->prepare("SELECT * FROM produtos WHERE DESCRICAO like '%$codi%' ");
        } else {
          $query_produto = $conexao->prepare("SELECT * FROM produtos WHERE CODIGO = $cod_produto ");
        }
      } else {
        $query_produto = $conexao->prepare("SELECT * FROM produtos WHERE CODIGO = $cod_produto ");
      }
    }
    if ($tipo_produto == '2') {
      if (isset($_GET['Tp'])) {
        if ($_GET['Tp'] == 'nomepro') {
          $codi = $_GET['PS'];
          $query_produto = $conexao->prepare("SELECT * FROM produtos_pr_ent WHERE DESCRICAO like '%$codi%' ");
        } else {
          $query_produto = $conexao->prepare("SELECT * FROM produtos_pr_ent WHERE CODIGO = $cod_produto ");
        }
      } else {
        $query_produto = $conexao->prepare("SELECT * FROM produtos_pr_ent WHERE CODIGO = $cod_produto ");
      }
    }
    $query_produto->execute();
    if ($linha2 = $query_produto->fetch(PDO::FETCH_ASSOC)) {
      $PRODUTO[$a] = [
        'DESCRICAO' => $linha2['DESCRICAO'],
      ];
    }
    if (!isset($PRODUTO[$a]['DESCRICAO'])) {
      $PRODUTO[$a] = [
        'DESCRICAO' => 'NÃO ENCONTRADO',
      ];
    }
  }
}
?>
<form action="tl-faturadas.php" method="GET">
  <div class="row">
    <div class="col-3">
      <label for="exampleFormControlSelect1" class="form-label">Pesquisar por</label>
      <select class="form-select" name="Tp" id="exampleFormControlSelect1" aria-label="Default select example">
        <option value="0" selected>Selecione...</option>
        <option value="cod">Código Faturamento</option>
        <option value="op">Código OP</option>
        <option value="nomepro">Nome Produto</option>
        <option value="cli">Cod Cliente</option>
      </select>
    </div>

    <div class="col-3">
      <div class=" mb-6 pesquisa-painel">
        <label class="form-label" for="basic-default-company">Digite sua Busca</label>
        <input type="text" class="form-control" name="PS" id="basic-default-company" placeholder="Insira Somente o Código" />
      </div>
    </div>
    <div class="col-3">
      <div class=" mb-6 pesquisa-painel"><br>
        <button type="submit" class="btn btn-outline-primary">Pesquisar</button>
      </div>
    </div>
  </div>
</form> <br>
<div class="card">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <?php

          echo '<th>Codigo Faturamento</th>';
          echo '<th>Codigo Ordem de Produção</th>';
          echo '<th style="text-align: center;" >Produto</th>';
          echo '<th>Valor Faturado</th>';
          echo '<th>Quantidade Entregue</th>';
          ?>


          <th data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<span>Selecione o Faturamento para visualizar todas informações</span>">Selecionar</th>
        </tr>
      </thead>
      <?php

      $b = 0;
      while ($a > $b) {
        echo '<tr>
                  <td>
                  ' . $FATURAMENTOS[$b]['CODIGO'] . '
                  </td>
                  <td>
                  ' . $FATURAMENTOS[$b]['codigo_op'] . '
                  </td>
                  <td>
                  ' . $PRODUTO[$b]['DESCRICAO'] . '
                  </td>
                  <td>' . $FATURAMENTOS[$b]['VLR_FAT'] . '</td>
                  <td>' . $FATURAMENTOS[$b]['QTD_ENTREGUE'] . '</td>
                  <td><a class="btn rounded-pill btn-success" target="_blank" href="relatorio_faturamento.php?cod=' . $FATURAMENTOS[$b]['CODIGO'] . '"><iconify-icon icon="icon-park-outline:file-pdf-one"  width="30" height="30"></iconify-icon><br>DOCUMENTO</a></td>
                </tr>';
        $b++;
      }
      ?>


    </table>
  </div>
</div>
<?php /* |||   */ include_once("../html/navbar-dow.php"); ?>