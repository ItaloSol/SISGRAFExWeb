<?php  include_once("../html/navbar.php"); ?>
<?php  if ($EXP_I == '1' || $EXP_ADM_I == '1') {  ?>

  <?php
  if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
  }
  ?>
  <div class=" aceita-- "></div>
  <div class="col-md mb-4 mb-md-0">
    <small class="text-light fw-semibold">Já aceitos</small>
    <div class="accordion mt-3" id="accordionExample">
      <div class="card accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne">
            Pedidos Já Aceitos
          </button>
        </h2>

        <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <table class="table table-bordered acesso">
              <thead>
                <tr>
                  <th>Id Solicitação</th>
                  <th>Data da solicitação</th>
                  <th>Código da Op</th>
                  <th>Produto</th>
                  <th>Data que foi Aceita</th>
                </tr>
              </thead>

              <?php
              $query_aceitalas = $conexao->prepare("SELECT * FROM aceita_op a INNER JOIN tabela_ordens_producao o ON a.codigo_op = o.cod WHERE aceitacao = 'SIM' ORDER BY a.id_espera DESC ");
              $query_aceitalas->execute();
              $gestao = 0;
              while ($linha = $query_aceitalas->fetch(PDO::FETCH_ASSOC)) {
                $codigo = $linha['cod'];
                $id = $linha['id_espera'];
                $cod_produto = $linha['cod_produto'];
                $Tipo_Produto = $linha['tipo_produto'];
                $data_solicitacao = $linha['data_solicitacao'];
                $data_aceita_solicitacao = $linha['data_aceitacao_negacao'];
                if ($Tipo_Produto == '2') {
                  $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos_pr_ent  WHERE CODIGO = '$cod_produto'");
                  $query_PRODUTOS->execute();

                  while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                    $descricao = $linha2['DESCRICAO'];
                  }
                }
                if ($Tipo_Produto == '1') {
                  $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$cod_produto'");
                  $query_PRODUTOS->execute();

                  while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                    $descricao = $linha2['DESCRICAO'];
                  }
                }
                $data_aceita_solicitacao_Aceitar[$gestao] = $data_aceita_solicitacao;
                $data_solicitacao_Aceitar[$gestao] = $data_solicitacao;
                $descricao_Aceitar[$gestao] = $descricao;
                $codigo_Aceitar[$gestao] = $codigo;
                $id_Aceitar[$gestao] = $id;
                $gestao++;
              }
              $a = 0;
              if ($gestao == 0) {
                echo ' <div class="mb-12 ">
                                <label for="html5-date-input" class="col-md-2 col-form-label"><b>Não existe solicitações para aceitar</b></label>
                                </div>';
              } else {
                while ($a < $gestao) {
                  echo '
                                     <tr>
                                     <td>
                                         <i class="fab fa-angular fa-lg text-danger me-3"></i> ' . $id_Aceitar[$a] . '
                                       </td>
                                       <td>
                                         <i class="fab fa-angular fa-lg text-danger me-3"></i> ' . $data_solicitacao_Aceitar[$a] . '
                                       </td>
                                       <td>
                                         <i class="fab fa-angular fa-lg text-danger me-3"></i> ' . $codigo_Aceitar[$a] . '
                                       </td>
                                       <td>
                                         <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>' . $descricao_Aceitar[$a] . '</strong>
                                       </td>
                                       <td>
                                       <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>' . $data_aceita_solicitacao_Aceitar[$a] . '</strong>
                                     </td>
                                      
                                       </tr>';
                  $a++;
                }
              }
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md mb-4 mb-md-0">

      <div class="accordion mt-3" id="accordionExample">
        <div class="card accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionOne3" aria-expanded="false" aria-controls="accordionOne3">
              Pedidos Negados
            </button>
          </h2>

          <div id="accordionOne3" class="accordion-collapse collapse" data-bs-parent="#accordionExample3">
            <div class="accordion-body">
              <table class="table table-bordered acesso">
                <thead>
                  <tr>
                    <th>Id Solicitação</th>
                    <th>Data da solicitação</th>
                    <th>Código da Op</th>
                    <th>Produto</th>
                    <th>Data que foi Negada</th>
                  </tr>
                </thead>

                <?php
                $query_aceitalas = $conexao->prepare("SELECT * FROM aceita_op a INNER JOIN tabela_ordens_producao o ON a.codigo_op = o.cod WHERE aceitacao = 'NAO' ORDER BY a.id_espera DESC ");
                $query_aceitalas->execute();
                $gestao = 0;
                while ($linha = $query_aceitalas->fetch(PDO::FETCH_ASSOC)) {
                  $codigo = $linha['cod'];
                  $id = $linha['id_espera'];
                  $cod_produto = $linha['cod_produto'];
                  $Tipo_Produto = $linha['tipo_produto'];
                  $data_solicitacao = $linha['data_solicitacao'];
                  $data_aceita_solicitacao = $linha['data_aceitacao_negacao'];
                  if ($Tipo_Produto == '2') {
                    $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos_pr_ent  WHERE CODIGO = '$cod_produto'");
                    $query_PRODUTOS->execute();

                    while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                      $descricao = $linha2['DESCRICAO'];
                    }
                  }
                  if ($Tipo_Produto == '1') {
                    $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$cod_produto'");
                    $query_PRODUTOS->execute();

                    while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                      $descricao = $linha2['DESCRICAO'];
                    }
                  }
                  $data_aceita_solicitacao_Aceitar[$gestao] = $data_aceita_solicitacao;
                  $data_solicitacao_Aceitar[$gestao] = $data_solicitacao;
                  $descricao_Aceitar[$gestao] = $descricao;
                  $codigo_Aceitar[$gestao] = $codigo;
                  $id_Aceitar[$gestao] = $id;
                  $gestao++;
                }
                $a = 0;
                if ($gestao == 0) {
                  echo ' <div class="mb-12 ">
                                <label for="html5-date-input" class="col-md-2 col-form-label"><b>Não existe solicitações para aceitar</b></label>
                                </div>';
                } else {
                  while ($a < $gestao) {
                    echo '
                                     <tr>
                                     <td>
                                         <i class="fab fa-angular fa-lg text-danger me-3"></i> ' . $id_Aceitar[$a] . '
                                       </td>
                                       <td>
                                         <i class="fab fa-angular fa-lg text-danger me-3"></i> ' . $data_solicitacao_Aceitar[$a] . '
                                       </td>
                                       <td>
                                         <i class="fab fa-angular fa-lg text-danger me-3"></i> ' . $codigo_Aceitar[$a] . '
                                       </td>
                                       <td>
                                         <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>' . $descricao_Aceitar[$a] . '</strong>
                                       </td>
                                       <td>
                                       <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>' . $data_aceita_solicitacao_Aceitar[$a] . '</strong>
                                     </td>
                                      
                                       </tr>';
                    $a++;
                  }
                }
                ?>
              </table>
            </div>
          </div>
        </div>
        <div class="card accordion-item active">
          <h2 class="accordion-header" id="headingTwo">
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="true" aria-controls="accordionTwo">
              Aceitar Op's
            </button>
          </h2>
          <div id="accordionTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">

              <div class="row">

                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Aceite as Op's</h5>
                    <div class="card-body">
                      <form>
                        <div class="row">
                          <div class="card-body">
                            <div class="table-responsive text-nowrap">
                              <table class="table table-bordered acesso">
                                <thead>
                                  <tr>
                                    <th>Id Solicitação</th>
                                    <th>Data da solicitação</th>
                                    <th>Código da Op</th>
                                    <th>Produto</th>
                                    <th>Aceitar</th>
                                    <th>Negar</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $query_aceitalas = $conexao->prepare("SELECT * FROM aceita_op a INNER JOIN tabela_ordens_producao o ON a.codigo_op = o.cod WHERE aceitacao != 'SIM' AND aceitacao != 'NAO' ORDER BY  aceitacao ASC ");
                                  $query_aceitalas->execute();
                                  $gestao = 0;
                                  while ($linha = $query_aceitalas->fetch(PDO::FETCH_ASSOC)) {
                                    $codigo = $linha['cod'];
                                    $id = $linha['id_espera'];
                                    $cod_produto = $linha['cod_produto'];
                                    $stsaceota = $linha['aceitacao'];
                                    $Tipo_Produto = $linha['tipo_produto'];
                                    $data_solicitacao = $linha['data_solicitacao'];
                                    $data_aceita_solicitacao = $linha['data_aceitacao_negacao'];
                                    $data_aceita_solicitacao_Aceitar[$gestao] = $data_aceita_solicitacao;


                                    if ($Tipo_Produto == '2') {
                                      $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos_pr_ent  WHERE CODIGO = '$cod_produto'");
                                      $query_PRODUTOS->execute();

                                      while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                                        $descricao = $linha2['DESCRICAO'];
                                      }
                                    }
                                    if ($Tipo_Produto == '1') {
                                      $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$cod_produto'");
                                      $query_PRODUTOS->execute();

                                      while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                                        $descricao = $linha2['DESCRICAO'];
                                      }
                                    }
                                    $Sts_Aceitar[$gestao] = $stsaceota;
                                    $data_solicitacao_Aceitar[$gestao] = $data_solicitacao;
                                    $descricao_Aceitar[$gestao] = $descricao;
                                    $codigo_Aceitar[$gestao] = $codigo;
                                    $id_Aceitar[$gestao] = $id;
                                    $gestao++;
                                  }
                                  $a = 0;
                                  if ($gestao == 0) {
                                    echo ' <div class="mb-12 ">
                                <label for="html5-date-input" class="col-md-2 col-form-label"><b>Não existe solicitações para aceitar</b></label>
                                </div>';
                                  } else {
                                    while ($a < $gestao) {
                                      echo '
                                     <tr>
                                     <td>
                                         <i class="fab fa-angular fa-lg text-danger me-3"></i> ' . $id_Aceitar[$a] . '
                                       </td>
                                       <td>
                                         <i class="fab fa-angular fa-lg text-danger me-3"></i> ' . $data_solicitacao_Aceitar[$a] . '
                                       </td>
                                       <td>
                                         <i class="fab fa-angular fa-lg text-danger me-3"></i> ' . $codigo_Aceitar[$a] . '
                                       </td>
                                       <td>
                                         <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>' . $descricao_Aceitar[$a] . '</strong>
                                       </td>
                                       
                                         ';
                                      if ($Sts_Aceitar[$a] == 'NAO') {
                                        echo '<td><label class="form-check-label"  for="inlineCheckbox1">Aguarde uma nova solicitação</label></td><td><div class="form-check form-check-inline mt-3">
                                            <label class="form-check-label"  for="inlineCheckbox1">Foi recusada dia ' . $data_aceita_solicitacao_Aceitar[$a] . '</label>
                                          </div></td>
                                        </tr>';
                                      } else {
                                        echo '<td><div class="form-check form-check-inline mt-3">
                                            <a class="btn rounded-pill btn-outline-warning" href="b-aceitar.php?s=ACEITAR&id=' . $id_Aceitar[$a] . '&c=' . $codigo_Aceitar[$a] . '">Aceitar</a>
                                             <label class="form-check-label"  for="inlineCheckbox1">Aceitar Op</label>
                                           </div></td>
                                            <td><div class="form-check form-check-inline mt-3">
                                            <a class="btn rounded-pill btn-outline-warning" href="b-aceitar.php?s=NEGAR&id=' . $id_Aceitar[$a] . '&c=' . $codigo_Aceitar[$a] . '" >Recusar</a>
                                            <label class="form-check-label"  for="inlineCheckbox1">Negar Op</label>
                                          </div></td>
                                        </tr>';
                                      }
                                      $a++;
                                    }
                                  }
                                  ?>

                              </table>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>



          <!--  -->
          <!--  -->

        <?php  } ?>
        <?php  include_once("../html/navbar-dow.php"); ?>