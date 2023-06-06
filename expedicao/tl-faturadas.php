<?php include_once("../html/navbar.php"); ?>
<div class=" faturamento-- "></div>

<?php
if (isset($_GET['Tp'])) {
  if ($_GET['Tp'] == 'op') {
    $codi = $_GET['PS'];
    echo 'code';
    $query_faturamento = $conexao->prepare("SELECT * FROM faturamentos f inner join tabela_orcamentos o on f.CODIGO_ORC = o.cod WHERE o.cod_cliente = '14' ORDER BY f.CODIGO DESC ");
  }
  if ($_GET['Tp'] == 'cod') {
    $codi = $_GET['PS'];
    $query_faturamento = $conexao->prepare("SELECT * FROM faturamentos WHERE CODIGO = '$codi' ORDER BY CODIGO DESC LIMIT 150 ");
  }
  if ($_GET['Tp'] == 'cli') {
    $codi = $_GET['PS'];
    $query_faturamento = $conexao->prepare("SELECT * FROM faturamentos f inner join tabela_orcamentos o on f.CODIGO_ORC = o.cod WHERE o.cod_cliente = '$codi' ORDER BY f.CODIGO DESC   ");
  }
  if (!isset($codi)) {
    $query_faturamento = $conexao->prepare("SELECT * FROM faturamentos ORDER BY CODIGO DESC LIMIT 150");
  }
} else {
  $query_faturamento = $conexao->prepare("SELECT * FROM faturamentos ORDER BY CODIGO DESC LIMIT 150");
}

$query_faturamento->execute();
$a = 0;
while ($linha = $query_faturamento->fetch(PDO::FETCH_ASSOC)) {
  $FATURAMENTOS[$a] = array(
    'CODIGO' => $linha['CODIGO'],
    'CODIGO_ORC' => $linha['CODIGO_ORC'],
    'codigo_op' => $linha['CODIGO_OP'],
    'EMISSOR' => $linha['EMISSOR'],
    'QTD_ENTREGUE' => $linha['QTD_ENTREGUE'],
    'VLR_FAT' => $linha['VLR_FAT'],
    'DT_FAT' => $linha['DT_FAT'],
    'FRETE_FAT' => $linha['FRETE_FAT'],
    'SERVICOS_FAT' => $linha['SERVICOS_FAT'],
    'OBSERVACOES' => $linha['OBSERVACOES']
  );
  $vlr_fat_values = array_column($FATURAMENTOS, 'VLR_FAT');
  $total_vlr_fat = array_sum($vlr_fat_values);
  $codigo_op = $linha['CODIGO_OP'];
  if ($FATURAMENTOS[$a]['OBSERVACOES'] == '') {
    $FATURAMENTOS[$a]['OBSERVACOES'] = 'SEM OBSERVAÇÕES';
  }
  if (isset($_GET['Tp'])) {


    if ($_GET['Tp'] == 'cli') {
      $codi = $_GET['PS'];
      $query_op = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE cod_cliente = $codi ");
    } else {
      $query_op = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE cod = $codigo_op ");
    }
  } else {
    $query_op = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE cod = $codigo_op ");
  }
  $query_op = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE cod_cliente = '14' ");
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
        'largura' => $linha2['LARGURA'],
        'ALTURA' => $linha2['ALTURA'],
        'QTD_PAGINAS' => $linha2['QTD_PAGINAS'],
        'TIPO' => $linha2['TIPO'],
        'DESCRICAO' => $linha2['DESCRICAO'],
      ];
    }
  }
  $a++;
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
     
      echo '<tr ><td align="center" colspan="6">VALOR TOTAL = '.number_format($total_vlr_fat, 2, ',', '.').' </td></tr>';
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
<?php  include_once("../html/navbar-dow.php"); ?>