<?php /* |||   */ $query_sd_posto = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos ORDER BY nome ASC");
$query_sd_posto->execute();
$i = 0;
while ($linha = $query_sd_posto->fetch(PDO::FETCH_ASSOC)) {
  $i++;
};
$total_paginas = $i / 50;
$a = 0;

if (isset($_GET['Pg'])) {
  $Pg = $_GET['Pg'];
} else {
  $Pg = 0;
}
?>

<h5 class="card-header">Clientes Jurídicos</h5>

<!-- Basic Pagination -->
<div class="card-body">

  <div class="row">
    <div class="col">

      <small class="text-light fw-semibold">Página</small>
      <div class="demo-inline-spacing">
        <div class="navbar navbar navbar-left bg-left mb-5">
          <form class="d-flex" method="POST" action="tl-cadastro-notas.php?tp=2">
            <input class="form-control me-2" type="text" name="pesquisa" placeholder="Pesquisar Código ou Sigla" aria-label="Pesquisar" />
            <!-- <imput class="btn btn-outline-primary" type="submit">Pesquisar -->
            <input class="btn btn-outline-primary" type="submit" name="submit" value="Pesquisar">
          </form>
        </div>
        <!-- Basic Pagination -->
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <li class="page-item first">
              <a class="page-link" href="tl-cadastro-notas.php?Pg=<?= 0 ?>&tp=2"><i class="tf-icon bx bx-chevrons-left"></i></a>

              <?php /* |||   */ while ($a < $total_paginas) {
                if ($a == $Pg) { ?>
            <li class="page-item active">
            <?php /* |||   */  } else { ?>
            <li class="page-item ">
            <?php /* |||   */    }
            ?>

            <a class="page-link" href="tl-cadastro-notas.php?Pg=<?= $a ?>&tp=2"><?= $a ?></a>
            </li>
          <?php /* |||   */ $a++;
              } ?>

          <li class="page-item last ">
            <a class="page-link " href="tl-cadastro-notas.php?Pg=<?= $a ?>&tp=2"><i class="tf-icon bx bx-chevrons-right"></i></a>
          </li>
          </ul>

        </nav>
        <!--/ Basic Pagination -->

        <?php /* |||   */
        if (isset($_POST['pesquisa'])) {
          $Pesquisa = True;
          if (is_numeric($_POST['pesquisa'])) {
            $cod_Pesquisa = $_POST['pesquisa'];
            $query_sd_posto = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE cod = $cod_Pesquisa ORDER BY nome ASC ");
            $query_sd_posto->execute();
            $i = 0;
            while ($linha = $query_sd_posto->fetch(PDO::FETCH_ASSOC)) {
              $cod = $linha['cod'];
              $nome = $linha['nome'];
              $nome_Fantasia = $linha['nome_fantasia'];
              $cnpj = $linha['cnpj'];
              $atividade = $linha['atividade'];
              $filial_coligada = $linha['filial_coligada'];
              $cod_atendente = $linha['cod_atendente'];
              $nome_atendente = $linha['nome_atendente'];
              $observacao = $linha['observacao'];
              $credito = $linha['credito'];
              $senha = $linha['senha'];
              $excluido = $linha['excluido'];
              $tOKEN = $linha['TOKEN'];
              $uLTIMO_ACESSO = $linha['ULTIMO_ACESSO'];
              $qTD_ACESSO = $linha['QTD_ACESSOS'];

              $Cod[$i] = $cod;
              $Nome[$i] = $nome;
              $Nome_Fantasia[$i] = $nome_Fantasia;
              $Cnpj[$i] = $cnpj;
              $Atividade[$i] =  $atividade;
              $Filial_Coligada[$i] = $filial_coligada;
              $Cod_Atendente[$i] = $cod_atendente;
              $Nome_Atendente[$i] = $nome_atendente;
              $Observacao[$i] = $observacao;
              $Credito[$i] = $credito;
              $Senha[$i] =  $senha;
              $Excluido[$i] = $excluido;
              $TOKEN[$i] = $tOKEN;
              $ULTIMO_ACESSO[$i] = $uLTIMO_ACESSO;
              $QTD_ACESSO[$i] = $qTD_ACESSO;
              $i++;
            }
            if (isset($Cod)) {
              $Listagem = count($Cod);
            } else {
              $Cod = False;
            }

            $Percorrer = 0;
          } else {
            $nome_Pesquisa = $_POST['pesquisa'];
            $query_sd_posto = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE  nome_fantasia LIKE '%$nome_Pesquisa%'  ORDER BY nome ASC ");
            $query_sd_posto->execute();
            $i = 0;
            while ($linha = $query_sd_posto->fetch(PDO::FETCH_ASSOC)) {
              $cod = $linha['cod'];
              $nome = $linha['nome'];
              $nome_Fantasia = $linha['nome_fantasia'];
              $cnpj = $linha['cnpj'];
              $atividade = $linha['atividade'];
              $filial_coligada = $linha['filial_coligada'];
              $cod_atendente = $linha['cod_atendente'];
              $nome_atendente = $linha['nome_atendente'];
              $observacao = $linha['observacao'];
              $credito = $linha['credito'];
              $senha = $linha['senha'];
              $excluido = $linha['excluido'];
              $tOKEN = $linha['TOKEN'];
              $uLTIMO_ACESSO = $linha['ULTIMO_ACESSO'];
              $qTD_ACESSO = $linha['QTD_ACESSOS'];

              $Cod[$i] = $cod;
              $Nome[$i] = $nome;
              $Nome_Fantasia[$i] = $nome_Fantasia;
              $Cnpj[$i] = $cnpj;
              $Atividade[$i] =  $atividade;
              $Filial_Coligada[$i] = $filial_coligada;
              $Cod_Atendente[$i] = $cod_atendente;
              $Nome_Atendente[$i] = $nome_atendente;
              $Observacao[$i] = $observacao;
              $Credito[$i] = $credito;
              $Senha[$i] =  $senha;
              $Excluido[$i] = $excluido;
              $TOKEN[$i] = $tOKEN;
              $ULTIMO_ACESSO[$i] = $uLTIMO_ACESSO;
              $QTD_ACESSO[$i] = $qTD_ACESSO;
              $i++;
            }

            if (isset($Cod)) {
              $Listagem = count($Cod);
            } else {
              $Cod = False;
            };

            $Percorrer = 0;
          }
        } else {
          $Pesquisa = False;
        }

        if ($Pesquisa == False) {
          $query_sd_posto = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos ORDER BY nome ASC LIMIT $Pg , 50");
          $query_sd_posto->execute();
          $i = 0;
          while ($linha = $query_sd_posto->fetch(PDO::FETCH_ASSOC)) {
            $cod = $linha['cod'];
            $nome = $linha['nome'];
            $nome_Fantasia = $linha['nome_fantasia'];
            $cnpj = $linha['cnpj'];
            $atividade = $linha['atividade'];
            $filial_coligada = $linha['filial_coligada'];
            $cod_atendente = $linha['cod_atendente'];
            $nome_atendente = $linha['nome_atendente'];
            $observacao = $linha['observacao'];
            $credito = $linha['credito'];
            $senha = $linha['senha'];
            $excluido = $linha['excluido'];
            $tOKEN = $linha['TOKEN'];
            $uLTIMO_ACESSO = $linha['ULTIMO_ACESSO'];
            $qTD_ACESSO = $linha['QTD_ACESSOS'];

            $Cod[$i] = $cod;
            $Nome[$i] = $nome;
            $Nome_Fantasia[$i] = $nome_Fantasia;
            $Cnpj[$i] = $cnpj;
            $Atividade[$i] =  $atividade;
            $Filial_Coligada[$i] = $filial_coligada;
            $Cod_Atendente[$i] = $cod_atendente;
            $Nome_Atendente[$i] = $nome_atendente;
            $Observacao[$i] = $observacao;
            $Credito[$i] = $credito;
            $Senha[$i] =  $senha;
            $Excluido[$i] = $excluido;
            $TOKEN[$i] = $tOKEN;
            $ULTIMO_ACESSO[$i] = $uLTIMO_ACESSO;
            $QTD_ACESSO[$i] = $qTD_ACESSO;
            $i++;
          }

          if (isset($Cod)) {
          } else {
            $Cod = False;
          }
          $Listagem = count($Cod);
          $Percorrer = 0;
        }


        ?>




        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Nome</th>
                  <th>Sigla</th>
                  <th>Cnpj</th>
                  <th>Crédito</th>
                  <th>Editar</th>
                </tr>
              </thead>
              <tbody>
                <?php /* |||   */
                if ($Cod == False) { ?>
                  <tr>
                    <td>
                      <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Nenhum Cliente Encontrado! Pesquise pelo Código ou Pela Sigla Correta</strong>
                    </td>
                    <?php /* |||   */  } else {
                    while ($Percorrer < $Listagem) { ?>

                  <tr>
                    <td>
                      <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $Cod[$Percorrer] ?></strong>
                    </td>
                    <td><?= $Nome[$Percorrer] ?> </td>
                    <td>

                      <li>
                        <?= $Nome_Fantasia[$Percorrer] ?>
                      </li>

                    </td>
                    <td><span class="badge bg-label-primary me-1"><?= $Cnpj[$Percorrer] ?></span></td>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= number_format($Credito[$Percorrer], 2, ',', '.') ?></strong></td>
                    <td>
                      <a class="btn rounded-pill btn-info" href="tl-cadastro-notas.php?tp=2&id=<?= $Cod[$Percorrer] ?>"><i class="bx bx-edit-alt me-1"></i> Selecionar</a>
                    </td>
                    <td>
                      <a target="_blank" class="btn rounded-pill btn-info" href="../relatorios/detalhamento_resumido_clientes.php?cod=<?= $Cod[$Percorrer] ?>&tipo=2"><iconify-icon icon="mdi:form-outline" width="18" height="18"></iconify-icon> Relaório</a>
                    </td>
                  </tr>

              <?php /* |||   */ $Percorrer++;
                    }
                  } ?>
              </tbody>
            </table>