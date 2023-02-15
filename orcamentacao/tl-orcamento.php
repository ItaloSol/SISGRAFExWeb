<?php /* |--  --| */ include_once("../html/../html/navbar.php");
$_SESSION["pag"] = array(1, 0);



if (isset($_GET['cod'])) {
  $cod_orcamento = $_GET['cod'];
} else {
  $_SESSION['msg'] = ' <div style=";" id="alerta"
  role="bs-toast"
  class=" bs-toast toast toast-placement-ex m-3 fade bg-warning top-0 end-0 hide show "
  role="alert"
  aria-live="assertive"
  aria-atomic="true">
  <div class="toast-header">
    <i class="bx bx-bell me-2"></i>
    <div class="me-auto fw-semibold">Aviso!</div>
    <small>
      
      </small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  
  <div class="toast-body">
       Selecione um Orçamento nesse painel!    
  </div>
</div>';
  echo "<script>window.location = 'tl-painel.php'</script>";
}




$query_Sts = $conexao->prepare("SELECT * FROM sts_orcamento  ORDER BY CODIGO ASC ");
$query_Sts->execute();
$Sts = 0;
while ($linha = $query_Sts->fetch(PDO::FETCH_ASSOC)) {
  $Nome_Sts = $linha['STS_DESCRICAO'];
  $codigo_Sts = $linha['CODIGO'];

  $Nome_Sts_P[$Sts] = $Nome_Sts;
  $Codigo_Sts_P[$Sts] = $codigo_Sts;
  $Sts++;
};
$query_orcamentos = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.`status` = s.CODIGO WHERE cod = $cod_orcamento ");
$query_orcamentos->execute();
$i = 0;
if ($linha = $query_orcamentos->fetch(PDO::FETCH_ASSOC)) {


  $Orcamento_pesquisa = [
    'cod' => $linha['cod'],
    'cod_cliente' => $linha['cod_cliente'],
    'cod_contato' => $linha['cod_contato'],
    'cod_endereco' => $linha['cod_endereco'],
    'status' => $linha['status'],
    'STS_DESCRICAO' => $linha['STS_DESCRICAO'],
    'data_validade' => date($linha['data_validade']),
    'data_emissao' => date($linha['data_emissao']),
    'tipo_cliente' => $linha['tipo_cliente'],
    'valor_unitario' => $linha['valor_unitario'],
    'sif' => $linha['sif'],
    'desconto' => $linha['desconto'],
    'valor_total' => $linha['valor_total'],
    'frete' => $linha['frete'],
    'ARTE' => $linha['ARTE'],
    'precos_manuais' => $linha['precos_manuais'],
    'descricao' => $linha['descricao'],
    'cod_emissor' => $linha['cod_emissor'],
    'FAT_TOTALMENTE' => $linha['FAT_TOTALMENTE'],
    'tipo_frete' => $linha['tipo_frete'],
    'proposta_assinada' => $linha['proposta_assinada'],
  ];

  $Pesquisa_orcamento = $Orcamento_pesquisa['cod'];
  $Pesquisa_Cliente = $Orcamento_pesquisa['cod_cliente'];
  $Tipo_Cliente = $Orcamento_pesquisa['tipo_cliente'];

  $quantiadade = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento  WHERE cod_orcamento = '$Pesquisa_orcamento'");
  $quantiadade->execute();

  if ($linha2 = $quantiadade->fetch(PDO::FETCH_ASSOC)) {
    $Tabela_Produtos = [
      'quantidade' => $linha2['quantidade'],
      'descricao' => $linha2['descricao_produto']
    ];
  }
  if (!isset($Tabela_Produtos)) {
    $Tabela_Produtos = [
      'quantidade' => 'Não Encontrada',
      'descricao' => 'Não Encontrada'
    ];
  }
  if ($Tipo_Cliente == '1') {

    $cliente = 'Fisico';
    $query_PRODUTOS = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos  WHERE cod = '$Pesquisa_Cliente'");
  }
  if ($Tipo_Cliente == '2') {
    $cliente = 'Juridico';
    $query_PRODUTOS = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos  WHERE cod = '$Pesquisa_Cliente'");
  }
  $query_PRODUTOS->execute();

  while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
    $Tabela_Clientes = [
      'cod' => $linha2['cod'],
      'nome' => $linha2['nome'],
      'credito' => $linha2['credito']
    ];
    if ($Tipo_Cliente == '2') {
      $documento = $linha2['cnpj'];
    } else {
      $documento = $linha2['cpf'];
    }
  }
  $cod_contato = $Orcamento_pesquisa['cod_contato'];
  $cod_endereco = $Orcamento_pesquisa['cod_endereco'];
  $cod_cliente = $Orcamento_pesquisa['cod_cliente'];
  $Clientes_Contato_Juridicos = $conexao->prepare("SELECT * FROM tabela_associacao_contatos a INNER JOIN tabela_contatos e ON a.cod_contato = e.cod WHERE a.cod_contato = $cod_contato AND a.cod_cliente = '$Pesquisa_Cliente' AND a.tipo_cliente = '$Tipo_Cliente' LIMIT 15");
  $Clientes_Contato_Juridicos->execute();
  $contato = 0;
  while ($linha = $Clientes_Contato_Juridicos->fetch(PDO::FETCH_ASSOC)) {

    $Cliente_Contato_Puxado = [
      'cod' => $linha['cod'],
      'nome_contato' => $linha['nome_contato'],
      'email' => $linha['email'],
      'telefone' => $linha['telefone'],
      'ramal' => $linha['ramal'],
      'telefone2' => $linha['telefone2'],
      'ramal2' => $linha['ramal2'],
      'departamento' => $linha['departamento'],
      'excluido' => $linha['excluido'],
    ];
    $contato++;
  }
  $Clientes_Endereco_Juridicos = $conexao->prepare("SELECT * FROM tabela_associacao_enderecos a INNER JOIN tabela_enderecos e ON a.cod_endereco = e.cod WHERE a.cod_endereco = $cod_endereco AND a.cod_cliente = '$Pesquisa_Cliente' AND a.tipo_cliente = '$Tipo_Cliente' LIMIT 15 ");
  $Clientes_Endereco_Juridicos->execute();
  $i = 0;
  $endereco = 0;
  while ($linha = $Clientes_Endereco_Juridicos->fetch(PDO::FETCH_ASSOC)) {

    $Cliente_Enderecos_Puxado = [
      'cod' => $linha['cod'],
      'cep' => $linha['cep'],
      'tipo_endereco' => $linha['tipo_endereco'],
      'logadouro' => $linha['logadouro'],
      'bairro' => $linha['bairro'],
      'uf' => $linha['uf'],
      'cidade' => $linha['cidade'],
      'complemento' => $linha['complemento'],
      'excluido' => $linha['excluido'],
      'casa' => $linha['casa'],

    ];
    $endereco++;
  }

  $i++;
}

//////
if (isset($Orcamento_pesquisa)) {
  $Total_Finalizadas = count($Orcamento_pesquisa);
} else {
  $Total_Finalizadas = 0;
}
$Percorrer_Finalizadas = 0;
$valor_total_Finalizadas = 0;

?>



<div class=" orcamento-- "></div>
<div class="row">
  <!-- Tela de Orçamento -->

  <div class="row">
    <div class="col-md mb-4 mb-md-0">
      <div class="accordion mt-3" id="accordionExample5">
        <div class="card accordion-item active">
          <h2 class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne5" aria-expanded="true" aria-controls="accordionOne5">
              Ações
            </button>
          </h2>

          <div id="accordionOne5" class="accordion-collapse collapse show" data-bs-parent="#accordionExample5">
            <div class="accordion-body">
              <div class="col-xxl">
                <div class="card mb-4">
                  <div class="card-header d-flex align-items-center justify-content-between">
                  </div>
                  <div class="card-body">

                    <div class="mb-3 row">
                      <label for="html5-date-input" class="col-md-2 col-form-label">Status</label>
                      <div class="col-md-10">
                        <select>
                          <option><?= $Orcamento_pesquisa['status'] ?> - <?= $Orcamento_pesquisa['STS_DESCRICAO'] ?></option>
                          <?php for ($i = 0; $i < $Sts; $i++) {
                            echo '<option>' . $Codigo_Sts_P[$i] . ' - ' . $Nome_Sts_P[$i] . '</option>';
                          } ?>

                        </select>
                      </div>
                    </div>

                    <?php

                    if ($Orcamento_pesquisa['status'] == 3 && $ORD_I == '1') {
                      $od = 'ativo';
                    } else {
                      $od = 'off';
                    }
                    if ($Orcamento_pesquisa['status'] == 4 || $Orcamento_pesquisa['status'] == 11) {
                      $producao = 'href';
                    } else {
                      $producao = 'off';
                    }
                    if ($Orcamento_pesquisa['status'] == 2) {
                      $expedicao = 'href';
                    } else {
                      $expedicao = 'off';
                    }

                    //  $od = 'ativo';

                    // $producao = 'href';
                    // $expedicao = 'href';
                    ?>

                    <div class="row  ">


                      <div class="col-3 ">

                        <div class="row mb-3 ">
                          <?php if ($Orcamento_pesquisa['status'] == 1 || $Orcamento_pesquisa['status'] == 2 || $Orcamento_pesquisa['status'] == 3) { ?>
                            <a href="b-update.php?acao=6&cod=<?= $cod_orcamento ?>" class="btn btn-danger"><iconify-icon icon="mdi:close-circle-outline" width="24" height="24"></iconify-icon> <br>Não aprovado pelo cliente</a>
                          <?php } else { ?>
                            <a class="btn btn-danger"><iconify-icon icon="mdi:close-circle-outline" width="24" height="24"></iconify-icon> <br>Não aprovado pelo cliente</a>
                          <?php } ?>
                        </div>
                        <div class="row mb-3  ">
                          <?php if ($Orcamento_pesquisa['status'] == 1 || $Orcamento_pesquisa['status'] == 2 || $Orcamento_pesquisa['status'] == 3) { ?>
                            <a href="b-update.php?acao=13&cod=<?= $cod_orcamento ?>" class="btn btn-danger"><iconify-icon icon="material-symbols:delete-outline-sharp" width="24" height="24"></iconify-icon><br> Excluir</a>
                          <?php } else { ?>
                            <a class="btn btn-danger"><iconify-icon icon="material-symbols:delete-outline-sharp" width="24" height="24"></iconify-icon><br> Excluir</a>
                          <?php } ?>
                        </div>
                        <!-- <div class="row mb-3">
                            <a class="btn btn-warning"><iconify-icon icon="material-symbols:edit-outline-rounded" width="24" height="24"></iconify-icon><br>Editar</a>
                          </div> -->

                      </div>
                      <div class="col-3  ">
                        <div class=" mb-3 ">
                          <?php if ($Orcamento_pesquisa['status'] == 1 ||  $Orcamento_pesquisa['status'] == 3 || $Orcamento_pesquisa['status'] == 11 || $Orcamento_pesquisa['status'] == 4) {
                            if ($Orcamento_pesquisa['valor_total'] < $Tabela_Clientes['credito']) { ?>
                              <a data-bs-toggle="modal" style="color: white;" data-bs-target="#paprod" class="btn btn-warning"><iconify-icon icon="fluent:production-20-regular" width="24" height="24"></iconify-icon><br> Enviar para Produção</a>
                        </div>
                        <div class=" mb-3">
                          <a data-bs-toggle="modal" style="color: white;" data-bs-target="#paraexp" class="btn btn-warning"><iconify-icon icon="fluent-mdl2:product" width="24" height="24"></iconify-icon><br> Enviar para Expedição</a>
                        </div>
                        <?php } else {
                              if ($Orcamento_pesquisa['status'] == '4' || $Orcamento_pesquisa['status'] == '11') { ?>
                          <a data-bs-toggle="modal" style="color: white;" data-bs-target="#paprod" class="btn btn-warning"><iconify-icon icon="fluent:production-20-regular" width="24" height="24"></iconify-icon><br> Enviar para Produção</a>
                      </div>
                      <div class=" mb-3">
                        <a data-bs-toggle="modal" style="color: white;" data-bs-target="#paraexp" class="btn btn-warning"><iconify-icon icon="fluent-mdl2:product" width="24" height="24"></iconify-icon><br> Enviar para Expedição</a>
                      </div>
                      <?php  } else {
                                if ($Orcamento_pesquisa['status'] == '3') {
                                  echo '</div>';
                                } else { ?>

                        <a href="b-update.php?acao=3&cod=<?= $cod_orcamento ?>" class="btn btn-warning"><iconify-icon icon="mdi:file-send-outline" width="24" height="24"></iconify-icon><br> <span>Saldo insuficiente!</span><br> Enviar o ordenador de despesa</a>
                    </div>

                <?php }
                              }
                            }
                          } else {
                            if ($Orcamento_pesquisa['status'] == '5' || $Orcamento_pesquisa['status'] == '6' || $Orcamento_pesquisa['status'] == '12' || $Orcamento_pesquisa['status'] == '13' || $Orcamento_pesquisa['status'] == '14' || $Orcamento_pesquisa['status'] == '15') {
                              echo ' </div>';
                            } else {  ?>
                <a class="btn btn-warning"><iconify-icon icon="fluent:production-20-regular" width="24" height="24"></iconify-icon><br> Enviar para Produção</a>
                  </div>
                  <div class=" mb-3">
                    <a class="btn btn-warning"><iconify-icon icon="fluent-mdl2:product" width="24" height="24"></iconify-icon><br> Enviar para Expedição</a>
                  </div>
              <?php }
                          } ?>

                </div> <?php include_once('modal-enviarop.php'); ?>
                <?php if ($ORD_I == 1) { ?>
                  <div class="col-3" id="<?= $od ?>">

                    <div class="row mb-3 ">
                      <a id="odA" class="btn btn-danger "><iconify-icon icon="material-symbols:check-circle-outline-rounded" width="24" height="24"></iconify-icon><br> (OD) AUTORIZAR PRODUÇÃO</a>
                    </div>

                    <div class="row mb-3">
                      <a id="odN" class="btn btn-danger "><iconify-icon icon="mdi:close-circle-outline" width="24" height="24"></iconify-icon><br> (OD) NEGAR PRODUÇÃO</a>
                    </div>
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <input type="radio" name="tipo" id="grafica" value="1"> <label for="grafica">OD- Grafica</label>

                      </div>

                      <div class="col-sm-6">
                        <input type="radio" name="tipo" id="cliente" value="2"> <label for="cliente">OD - Cliente</label>
                      </div>

                    <?php } ?>
                    </div>



                  </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>

</script>
<!--  -->
<div class="col-md mb-4 mb-md-0">
  <div class="accordion mt-3" id="accordionExample">
    <div class="card accordion-item active">
      <h2 class="accordion-header" id="headingOne">
        <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
          Orçamento
        </button>
      </h2>

      <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <div class="col-xxl">
            <div class="card mb-4">
              <div class="card-header d-flex align-items-center justify-content-between">
              </div>
              <div class="card-body">

                <div class="mb-3 row">
                  <label for="html5-date-input" class="col-md-2 col-form-label">Codigo Orçamento</label>
                  <div class="col-md-10">
                    <div class="input-group">
                      <input type="text" id="cod_orc_" class="cod_orc_ form-control" value="<?= $cod_orcamento ?>" disabled />
                    </div>
                    <br>
                  </div>
                  <label for="html5-date-input" class="col-md-2 col-form-label">Data de Validade</label>
                  <div class="col-md-10">
                    <div class="input-group">
                      <form method="GET" action="b-update.php">
                        <input type="hidden" name="cod" value="<?= $cod_orcamento ?>">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#smallModal">
                          Atualizar Data
                        </button>
                        <input class="form-control " type="date" name="data" value="<?= $Orcamento_pesquisa['data_validade'] ?>" />
                        <!--  -->
                        <!-- Small Modal -->
                        <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                              <div class="modal-header  ">
                                <h5 class="modal-title align-items-center justify-content-center" id="exampleModalLabel2">Atualizar Data de validade do Orçamento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body align-items-center justify-content-center">

                                <h6 class="align-items-center justify-content-center align-text-center">Certeza que deseja atualizar a data de validade?</h6>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Não
                                </button>
                                <button type="submit" class="btn btn-primary">Sim Atualizar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--  -->
                      </form>
                    </div>
                    <script>
                      const cod_orc = document.getElementById('cod_orc_')
                      const grafica = document.getElementById("grafica");
                      const cliente = document.getElementById("cliente");
                      const grafica1 = document.getElementById("odN");
                      const cliente1 = document.getElementById("odA");
                      const od = document.getElementById('off');
                      if (od) {

                      } else {
                        cliente.addEventListener('click', vm => {
                          cliente.checked = true;
                          cliente1.href = 'b-update.php?acao=11&cod=' + cod_orc.value + '';
                          grafica1.href = 'b-update.php?acao=12&cod=' + cod_orc.value + '';
                        })
                        grafica.addEventListener('click', vm => {
                          grafica.checked = true;
                          cliente1.href = 'b-update.php?acao=4&cod=' + cod_orc.value + '';
                          grafica1.href = 'b-update.php?acao=5&cod=' + cod_orc.value + '';
                        })
                        if (cliente.checked) {
                          cliente.checked = true;
                          cliente1.href = 'b-update.php?acao=11&cod=' + cod_orc.value + '';
                          grafica1.href = 'b-update.php?acao=12&cod=' + cod_orc.value + '';
                        } else {
                          grafica.checked = true;
                          cliente1.href = 'b-update.php?acao=4&cod=' + cod_orc.value + '';
                          grafica1.href = 'b-update.php?acao=5&cod=' + cod_orc.value + '';
                        }
                        if (document.querySelector('off')) {
                          cliente1.href = '#';
                          grafica1.href = '#';
                        }
                      }
                    </script>
                  </div>
                </div>
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h5 class="mb-0">Informações do Cliente</h5>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-name">Tipo de Pessoa</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" value="<?= $cliente ?>" placeholder="Fisicou ou Juridica" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">Código do Cliente</label>
                      <div class="col-sm-10">
                        <input type="text" value="<?= $Pesquisa_Cliente ?>" class="form-control" id="basic-default-company" placeholder="" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">Nome do Cliente</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $Tabela_Clientes['nome'] ?>" id="basic-default-company" placeholder="" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">CPF/CNPJ</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $documento ?>" id="basic-default-company" placeholder="" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">Nome p/ Contato</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $Cliente_Contato_Puxado['nome_contato'] ?>" id="basic-default-company" placeholder="" />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">

                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">Telefone Principal</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $Cliente_Contato_Puxado['telefone'] ?>" id="basic-default-company" placeholder="" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">Cidade</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $Cliente_Enderecos_Puxado['cidade'] ?>" id="basic-default-company" placeholder="" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">UF</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $Cliente_Enderecos_Puxado['uf'] ?>" id="basic-default-company" placeholder="" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">Crédito</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= number_format($Tabela_Clientes['credito'], 2, ',', '.') ?>" id="basic-default-company" placeholder="" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Informações Sobre o Orçamento (Segundo Drop) -->
  <div class="card accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="true" aria-controls="accordionTwo">
        Informações Sobre o Orçamento
      </button>
    </h2>
    <div id="accordionTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <div class="col-lg-12">
          <div class="demo-inline-spacing mt-3">
            <div class="list-group list-group-horizontal-md text-md-center">
              <a class="list-group-item list-group-item-action active" id="home-list-item" data-bs-toggle="list" href="#horizontal-prod">Produtos</a>
              <a class="list-group-item list-group-item-action" id="profile-list-item1" data-bs-toggle="list" href="#horizontal-tir">Tiragens</a>
              <a class="list-group-item list-group-item-action" id="messages-list-item2" data-bs-toggle="list" href="#horizontal-impr">Impressão</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item3" data-bs-toggle="list" href="#horizontal-pap">Papel</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item4" data-bs-toggle="list" href="#horizontal-aca">Acabamentos</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item5" data-bs-toggle="list" href="#horizontal-ser">Serviços</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item6" data-bs-toggle="list" href="#horizontal-obs">Observações</a>
            </div>
            <div class="tab-content px-0 mt-0">
              <div class="tab-pane fade show active" id="horizontal-prod">
                <div class="card">
                  <h5 class="card-header">PRODUTOS <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exLargeModalProdutos">
                      Selecionar um Produto
                    </button></h5>
                  <?php include_once('modal-selecionar-produto.php') ?>
                  <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>CÓDIGO</th>
                          <th>DESCRIÇÃO</th>
                          <th>LARGURA</th>
                          <th>ALTURA</th>
                          <th>QTD.PÁGINAS</th>
                          <th>OBSERVAÇÕES</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <tr>
                          <td>0000</td>
                          <td>NOME PRODUTO</td>
                          <td>00.0</td>
                          <td>00.0</td>
                          <td>0</td>
                          <td>---</td>
                        </tr>


                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="horizontal-tir">
                <div class="card">
                  <h5 class="card-header">TIRAGENS</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>PRODUTO</th>
                          <th>QUANTIDADE</th>
                          <th>DIGITAL</th>
                          <th>OFFSET</th>
                          <th>VALOR IMPRESSÃO DIGITAL</th>
                          <th>VALOR UNIDADE</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <tr>
                          <td>0000</td>
                          <td>0</td>
                          <td><input type="checkbox"></td>
                          <td><input type="checkbox"></td>
                          <td><input type="number"></td>
                          <td><input type="number"></td>
                        </tr>


                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="horizontal-impr">
                <div class="card">
                  <h5 class="card-header">IMPRESSÃO</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Project</th>
                          <th>Client</th>
                          <th>Users</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>


                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="horizontal-pap">
                <div class="card">
                  <h5 class="card-header">PAPEL</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>PRODUTO</th>
                          <th>CÓDIGO PAPEL</th>
                          <th>DESCRIÇÃO</th>
                          <th>TIPO</th>
                          <th>CF</th>
                          <th>CV</th>
                          <th>FORMATO IMPRESSÃO</th>
                          <th>PERCA(%)</th>
                          <th>GASTO FOLHA</th>
                          <th>PREÇO FOLHA</th>
                          <th>QUANTIDADE DE CHAPAS</th>
                          <th>PREÇO CHAPA</th>

                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <tr>
                          <td>0000</td>
                          <td>000</td>
                          <td>NOME PAPEL</td>
                          <td>TIPO</td>
                          <td>0</td>
                          <td>0</td>
                          <td><input type="number"></td>
                          <td><input type="number"></td>
                          <td><input type="number"></td>
                          <td>0</td>
                          <td><input type="number"></td>
                          <td>0</td>
                        </tr>


                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="horizontal-aca">
                <div class="card">
                  <h5 class="card-header">ACABAMENTOS</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>PRODUTO</th>
                          <th>CÓDIGO ACABAMENTO</th>
                          <th>DESCRIÇÃO</th>
                          <th>PREÇO ACABAMENTO</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <tr>
                          <td>0000</td>
                          <td>00</td>
                          <td>TIPO</td>
                          <td>00.0</td>
                        </tr>


                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="horizontal-obs">
                <div class="card">
                  <h5 class="card-header">OBSERVAÇÕES</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <textarea placeholder="Coloque uma Observação" class="col-12"></textarea>
                        </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="horizontal-ser">
                <div class="card">
                  <h5 class="card-header">SERVIÇOS</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>CÓDIGO SERVIÇO</th>
                          <th>DESCRIÇÃO</th>
                          <th>VALOR SERVIÇO</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="container row ">
              <div class="col-3">
                <label class="form-label m-0 p-0">CIF (%)</label>
                <input type="text" class="form-control" id="defaultFormControlInput" placeholder="0%" aria-describedby="defaultFormControlHelp" />

              </div>
              <div class="col-3">
                <label for="valor" class="form-label p-0 m-0">Arte (R$)</label>

                <input class="form-check-input mt-0" type="checkbox" id="valor" value="" aria-label="checkbox button for following text input" />

                <input type="text" class="form-control" placeholder="R$ 00,00" aria-label="Text input with checkbox button" />

              </div>

              <div class="col-3">
                <label for="frete" class="form-label p-0 m-0">Frete (R$)</label>

                <input class="form-check-input mt-0" type="checkbox" id="frete" value="" aria-label="checkbox button for following text input" />

                <input type="text" class="form-control" placeholder="R$ 00,00" aria-label="Text input with radio button" />

              </div>

              <div class="col-3">
                <label class="form-label m-0 p-0">Desconto (%)</label>
                <input type="text" class="form-control" id="defaultFormControlInput" placeholder="0%" aria-describedby="defaultFormControlHelp" />

              </div>

            </div>
            <label for="defaultFormControlInput" class="form-label">Valor Total (R$)</label>
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Valor do orçamento final" value="<?= $Orcamento_pesquisa['valor_total'] ?>" aria-describedby="defaultFormControlHelp" /><br></br>
            <!-- <button type="button" class="btn btn-info">Tabela de Corte de Papel</button> -->
            <?php include_once('moda-cortes.php'); ?>
            <button type="button" class="btn btn-success">Salvar</button>
          </div>
        </div>
      </div>
    </div>
  </div>






  <?php /* |--  --| */ include_once("../html/../html/navbar-dow.php"); ?>