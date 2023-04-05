<?php  $query_clientes_fisico = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos ORDER BY nome ASC");
$query_clientes_fisico->execute();
$i = 0;
while ($linha = $query_clientes_fisico->fetch(PDO::FETCH_ASSOC)) {
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
          <form class="d-flex" method="POST" action="tl-cadastro-notas.php?tp=1">
            <input class="form-control me-2" type="text" name="pesquisa" placeholder="Pesquisar Código ou Sigla" aria-label="Pesquisar" />
            <!-- <imput class="btn btn-outline-primary" type="submit">Pesquisar -->
            <input class="btn btn-outline-primary" type="submit" name="submit" value="Pesquisar">
          </form>
        </div>
        <!-- Basic Pagination -->
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <li class="page-item first">
              <a class="page-link" href="tl-cadastro-notas.php?Pg=<?= 0 ?>&tp=1"><i class="tf-icon bx bx-chevrons-left"></i></a>

              <?php  while ($a < $total_paginas) {
                if ($a == $Pg) { ?>
            <li class="page-item active">
            <?php   } else { ?>
            <li class="page-item ">
            <?php     }
            ?>

            <a class="page-link" href="tl-cadastro-notas.php?Pg=<?= $a ?>&tp=1"><?= $a ?></a>
            </li>
          <?php  $a++;
              } ?>

          <li class="page-item last ">
            <a class="page-link " href="tl-cadastro-notas.php?Pg=<?= $a ?>&tp=1"><i class="tf-icon bx bx-chevrons-right"></i></a>
          </li>
          </ul>

        </nav>
        <!--/ Basic Pagination -->

        <?php 
        if (isset($_POST['pesquisa'])) {
          $Pesquisa = True;
          if (is_numeric($_POST['pesquisa'])) {
            $cod_Pesquisa = $_POST['pesquisa'];
            $query_clientes_fisico = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE cod = $cod_Pesquisa ORDER BY nome ASC ");
            $query_clientes_fisico->execute();
            $i = 0;
            while ($linha = $query_clientes_fisico->fetch(PDO::FETCH_ASSOC)) {
              $cod = $linha['cod'];
              $nome = $linha['nome'];
              $cpf = $linha['cpf'];
              $atividade = $linha['atividade'];
              $cod_atendente = $linha['cod_atendente'];
              $nome_atendente = $linha['nome_atendente'];
              $observacoes = $linha['observacoes'];
              $credito = $linha['credito'];
              $senha = $linha['senha'];


              $Cod[$i] = $cod;
              $Nome[$i] = $nome;
              $Cpf[$i] = $cpf;
              $Atividade[$i] =  $atividade;
              $Cod_atendente[$i] = $cod_atendente;
              $Observacoes[$i] = $observacoes;
              $Credito[$i] = $credito;
              $Senha[$i] = $senha;
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
            $query_clientes_fisico = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE  nome LIKE '%$nome_Pesquisa%'  ORDER BY nome ASC ");
            $query_clientes_fisico->execute();
            $i = 0;
            while ($linha = $query_clientes_fisico->fetch(PDO::FETCH_ASSOC)) {
              $cod = $linha['cod'];
              $nome = $linha['nome'];
              $cpf = $linha['cpf'];
              $atividade = $linha['atividade'];
              $cod_atendente = $linha['cod_atendente'];
              $nome_atendente = $linha['nome_atendente'];
              $observacoes = $linha['observacoes'];
              $credito = $linha['credito'];
              $senha = $linha['senha'];


              $Cod[$i] = $cod;
              $Nome[$i] = $nome;
              $Cpf[$i] = $cpf;
              $Atividade[$i] =  $atividade;
              $Cod_atendente[$i] = $cod_atendente;
              $Observacoes[$i] = $observacoes;
              $Credito[$i] = $credito;
              $Senha[$i] = $senha;
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
          $query_clientes_fisico = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos ORDER BY nome ASC LIMIT $Pg , 50");
          $query_clientes_fisico->execute();
          $i = 0;
          while ($linha = $query_clientes_fisico->fetch(PDO::FETCH_ASSOC)) {
            $cod = $linha['cod'];
            $nome = $linha['nome'];
            $cpf = $linha['cpf'];
            $atividade = $linha['atividade'];
            $cod_atendente = $linha['cod_atendente'];
            $nome_atendente = $linha['nome_atendente'];
            $observacoes = $linha['observacoes'];
            $credito = $linha['credito'];
            $senha = $linha['senha'];


            $Cod[$i] = $cod;
            $Nome[$i] = $nome;
            $Cpf[$i] = $cpf;
            $Atividade[$i] =  $atividade;
            $Cod_atendente[$i] = $cod_atendente;
            $Observacoes[$i] = $observacoes;
            $Credito[$i] = $credito;
            $Senha[$i] = $senha;
            $i++;
          }

          if (isset($Cod)) {
            $Listagem = count($Cod);
          } else {
            $Cod = False;
          }

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
                  <th>Atividade</th>
                  <th>Cpf</th>
                  <th>Crédito</th>
                  <th>Editar</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                if ($Cod == False) { ?>
                  <tr>
                    <td>
                      <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Nenhum Cliente Encontrado! Pesquise pelo Código ou Pela Sigla Correta</strong>
                    </td>
                    <?php   } else {
                    while ($Percorrer < $Listagem) { ?>

                  <tr>
                    <td>
                      <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $Cod[$Percorrer] ?></strong>
                    </td>
                    <td><?= $Nome[$Percorrer] ?> </td>
                    <td>

                      <li>
                        <?= $Atividade[$Percorrer] ?>
                      </li>

                    </td>
                    <td><span class="badge bg-label-primary me-1"><?= $Cpf[$Percorrer] ?></span></td>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= number_format($Credito[$Percorrer], 2, ',', '.') ?></strong></td>
                    <td>
                      <a class="btn rounded-pill btn-info" href="tl-cadastro-notas.php?tp=1&id=<?= $Cod[$Percorrer] ?>"><i class="bx bx-edit-alt me-1"></i> Selecionar</a>
                    </td>
                    <td>
                      <a target="_blank" class="btn rounded-pill btn-info" href="../relatorios/detalhamento_resumido_clientes.php?cod=<?= $Cod[$Percorrer] ?>&tipo=1"><iconify-icon icon="mdi:form-outline" width="18" height="18"></iconify-icon> Relaório</a>
                    </td>
                  </tr>

              <?php  $Percorrer++;
                    }
                  } ?>
              </tbody>
            </table>