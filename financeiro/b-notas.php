<?php  $Notas = $conexao->prepare("SELECT * FROM tabela_notas ORDER BY cod DESC");
$Notas->execute();
$i = 0;
while ($linha = $Notas->fetch(PDO::FETCH_ASSOC)) {
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

<h5 class="card-header">Notas</h5>

<!-- Basic Pagination -->
<div class="card-body">

  <div class="row">
    <div class="col">

      <small class="text-light fw-semibold">Página</small>
      <div class="demo-inline-spacing">
        <div class="navbar navbar navbar-left bg-left mb-5">
          <form class="d-flex" method="POST" action="tl-cadastro-notas.php?tp=3">
            <input class="form-control me-2" type="text" name="pesquisa" placeholder="Pesquisar Código" aria-label="Pesquisar" />
            <!-- <imput class="btn btn-outline-primary" type="submit">Pesquisar -->
            <input class="btn btn-outline-primary" type="submit" name="submit" value="Pesquisar">
          </form>
        </div>
        <!-- Basic Pagination -->
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <li class="page-item first">
              <a class="page-link" href="tl-cadastro-notas.php?Pg=<?= 0 ?>&tp=3"><i class="tf-icon bx bx-chevrons-left"></i></a>

              <?php  while ($a < $total_paginas) {
                if ($a == $Pg) { ?>
            <li class="page-item active">
            <?php   } else { ?>
            <li class="page-item ">
            <?php     }
            ?>

            <a class="page-link" href="tl-cadastro-notas.php?Pg=<?= $a ?>&tp=3"><?= $a ?></a>
            </li>
          <?php  $a++;
              } ?>

          <li class="page-item last ">
            <a class="page-link " href="tl-cadastro-notas.php?Pg=<?= $a ?>&tp=3"><i class="tf-icon bx bx-chevrons-right"></i></a>
          </li>
          </ul>

        </nav>
        <!--/ Basic Pagination -->

        <?php 
        if (isset($_POST['pesquisa'])) {
          $Pesquisa = True;
          if (is_numeric($_POST['pesquisa'])) {
            $cod_Pesquisa = $_POST['pesquisa'];
            $Notas = $conexao->prepare("SELECT * FROM tabela_notas WHERE cod = $cod_Pesquisa ORDER BY cod desc ");
            $Notas->execute();
            $i = 0;
            while ($linha = $Notas->fetch(PDO::FETCH_ASSOC)) {
              $cod = $linha['cod'];
              $serie = $linha['serie'];
              $tipo = $linha['tipo'];
              $forma_pagamento = $linha['forma_pagamento'];
              $cod_emissor = $linha['cod_emissor'];
              $cod_cliente = $linha['cod_cliente'];
              $cod_endereco = $linha['cod_endereco'];
              $cod_contato = $linha['cod_contato'];
              $tipo_pessoa = $linha['tipo_pessoa'];
              $valor = $linha['valor'];
              $data = $linha['data'];
              $observacoes = $linha['observacoes'];


              $Cod[$i] = $cod;
              $Serie[$i] = $serie;
              $Tipo[$i] = $tipo;
              $Forma_pagamento[$i] = $forma_pagamento;
              $Cod_emissor[$i] =  $cod_emissor;
              $Cod_cliente[$i] = $cod_cliente;
              $Cod_endereco[$i] = $cod_endereco;
              $Cod_contato[$i] = $cod_contato;
              $Tipo_pessoa[$i] = $tipo_pessoa;
              $Valor[$i] =  $valor;
              $Data[$i] = $data;
              $Observacoes[$i] = $observacoes;

              if ($Tipo_pessoa[$i] == 1) {
                $clientes = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE cod = $cod_cliente ORDER BY cod desc ");
                $clientes->execute();
                while ($linha1 = $clientes->fetch(PDO::FETCH_ASSOC)) {
                  $nome_cliente = $linha1['nome'];
                  $Nome_cliente[$i] = $nome_cliente;
                }
              } else {
                $clientes = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE cod = $cod_cliente ORDER BY cod desc ");
                $clientes->execute();
                while ($linha1 = $clientes->fetch(PDO::FETCH_ASSOC)) {
                  $nome_cliente = $linha1['nome'];
                  $Nome_cliente[$i] = $nome_cliente;
                }
              }


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
            $Notas = $conexao->prepare("SELECT * FROM tabela_notas WHERE  nome_fantasia LIKE '%$nome_Pesquisa%'  ORDER BY cod DESC ");
            $Notas->execute();
            $i = 0;
            while ($linha = $Notas->fetch(PDO::FETCH_ASSOC)) {
              $cod = $linha['cod'];
              $serie = $linha['serie'];
              $tipo = $linha['tipo'];
              $forma_pagamento = $linha['forma_pagamento'];
              $cod_emissor = $linha['cod_emissor'];
              $cod_cliente = $linha['cod_cliente'];
              $cod_endereco = $linha['cod_endereco'];
              $cod_contato = $linha['cod_contato'];
              $tipo_pessoa = $linha['tipo_pessoa'];
              $valor = $linha['valor'];
              $data = $linha['data'];
              $observacoes = $linha['observacoes'];


              $Cod[$i] = $cod;
              $Serie[$i] = $serie;
              $Tipo[$i] = $tipo;
              $Forma_pagamento[$i] = $forma_pagamento;
              $Cod_emissor[$i] =  $cod_emissor;
              $Cod_cliente[$i] = $cod_cliente;
              $Cod_endereco[$i] = $cod_endereco;
              $Cod_contato[$i] = $cod_contato;
              $Tipo_pessoa[$i] = $tipo_pessoa;
              $Valor[$i] =  $valor;
              $Data[$i] = $data;
              $Observacoes[$i] = $observacoes;
              if ($Tipo_pessoa[$i] == 1) {
                $clientes = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE cod = $cod_cliente ORDER BY cod desc ");
                $clientes->execute();
                while ($linha1 = $clientes->fetch(PDO::FETCH_ASSOC)) {
                  $nome_cliente = $linha1['nome'];
                  $Nome_cliente[$i] = $nome_cliente;
                }
              } else {
                $clientes = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE cod = $cod_cliente ORDER BY cod desc ");
                $clientes->execute();
                while ($linha1 = $clientes->fetch(PDO::FETCH_ASSOC)) {
                  $nome_cliente = $linha1['nome'];
                  $Nome_cliente[$i] = $nome_cliente;
                }
              }
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
          $Notas = $conexao->prepare("SELECT * FROM tabela_notas ORDER BY cod DESC LIMIT $Pg , 50");
          $Notas->execute();
          $i = 0;
          while ($linha = $Notas->fetch(PDO::FETCH_ASSOC)) {
            $cod = $linha['cod'];
            $serie = $linha['serie'];
            $tipo = $linha['tipo'];
            $forma_pagamento = $linha['forma_pagamento'];
            $cod_emissor = $linha['cod_emissor'];
            $cod_cliente = $linha['cod_cliente'];
            $cod_endereco = $linha['cod_endereco'];
            $cod_contato = $linha['cod_contato'];
            $tipo_pessoa = $linha['tipo_pessoa'];
            $valor = $linha['valor'];
            $data = $linha['data'];
            $observacoes = $linha['observacoes'];


            $Cod[$i] = $cod;
            $Serie[$i] = $serie;
            $Tipo[$i] = $tipo;
            $Forma_pagamento[$i] = $forma_pagamento;
            $Cod_emissor[$i] =  $cod_emissor;
            $Cod_cliente[$i] = $cod_cliente;
            $Cod_endereco[$i] = $cod_endereco;
            $Cod_contato[$i] = $cod_contato;
            $Tipo_pessoa[$i] = $tipo_pessoa;
            $Valor[$i] =  $valor;
            $Data[$i] = $data;
            $Observacoes[$i] = $observacoes;
            if ($Tipo_pessoa[$i] == 1) {
              $clientes = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE cod = $cod_cliente ORDER BY cod desc ");
              $clientes->execute();
              while ($linha1 = $clientes->fetch(PDO::FETCH_ASSOC)) {
                $cod_cliente = $linha1['cod'];
                $cod_cliente_[$i] = $cod_cliente;
                $nome_cliente = $linha1['nome'];
                $Nome_cliente[$i] = $nome_cliente;
              }
            } else {
              $clientes = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE cod = $cod_cliente ORDER BY cod desc ");
              $clientes->execute();
              while ($linha1 = $clientes->fetch(PDO::FETCH_ASSOC)) {
                $cod_cliente = $linha1['cod'];
                $cod_cliente_[$i] = $cod_cliente;
                $nome_cliente = $linha1['nome'];
                $Nome_cliente[$i] = $nome_cliente;
              }
            }
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
                  <th>Nome Cliente</th>
                  <th>Data</th>
                  <th>Observação</th>
                  <th>Valor</th>
                  <th>Editar</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                if ($Cod == False) { ?>
                  <tr>
                    <td>
                      <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Nenhuma Nota Encontrada! Pesquise pelo Código Correto</strong>
                    </td>
                    <?php   } else {
                    while ($Percorrer < $Listagem) { ?>

                  <tr>
                    <td>
                      <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $Cod[$Percorrer] ?></strong>
                    </td>
                    <td><?= $Nome_cliente[$Percorrer] ?> </td>
                    <td>

                      <li>
                        <?= $Data[$Percorrer] ?>
                      </li>

                    </td>
                    <td><?php  echo $Observacoes[$Percorrer] ?></td>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $Valor[$Percorrer] ?></strong></td>
                    <td>
                      <a class="btn rounded-pill btn-info" href="tl-cadastro-notas.php?tp=3&id=<?= $Cod[$Percorrer] ?>"><i class="bx bx-edit-alt me-1"></i> Selecionar</a>
                    </td>
                    <td>
                      <a target="_blank" class="btn rounded-pill btn-info" href="../relatorios/detalhamento_resumido_clientes.php?cod=<?= $cod_cliente_[$Percorrer] ?>&tipo=<?= $Tipo_pessoa[$Percorrer] ?>"><iconify-icon icon="mdi:form-outline" width="18" height="18"></iconify-icon> Relaório</a>
                    </td>
                  </tr>

              <?php  $Percorrer++;
                    }
                  } ?>
              </tbody>
            </table>