<style>
  .tira {
    display: none;
  }
</style>
<?php include_once("../html/navbar.php");
?>

<?php
if (isset($_POST['numero1']) || isset($_POST['numero2']) || isset($_POST['Cod_Orcamento'])) {
  if (isset($_POST['Cod_Orcamento'])) {
    $cod_orcamento = $_POST['Cod_Orcamento'];
    $query_orcamentos = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.`status` = s.CODIGO WHERE cod = $cod_orcamento ");
    $query_orcamentos->execute();
    $qtdX = 0;
    if ($linha = $query_orcamentos->fetch(PDO::FETCH_ASSOC)) {
      $Pesquisa_Cliente = $linha['cod_cliente'];
      $Tipo_Cliente = $linha['tipo_cliente'];
    }
    $_POST['numero1'] =  $Pesquisa_Cliente;
    $_POST['numero2'] = $Pesquisa_Cliente;
    $_POST['tipo_cliente'] = $Tipo_Cliente;
    $Produtos = $_POST['produtos'];
    if ($_POST['ttipo_produto'] == 1) {
      $tipo_produtoEditar = true;
    } else {
      $tipo_produtoEditar = false;
    }
?>


  <?php
  }

  if ($_POST['numero1'] != '') {
    $Pesquisa_Cliente = $_POST['numero1'];
  } else {
    $Pesquisa_Cliente = $_POST['numero2'];
  }

  $Tipo_Cliente = $_POST['tipo_cliente'];


  $tipo_papel_qtd_loop = 0;
  $qtd_acabamentos = 0;
  $papels = 0;
  $servicos = 0;

  $query_Sts = $conexao->prepare("SELECT * FROM sts_orcamento  ORDER BY CODIGO ASC ");
  $query_Sts->execute();
  $Sts = 0;
  while ($linha = $query_Sts->fetch(PDO::FETCH_ASSOC)) {
    $Nome_Sts = $linha['STS_DESCRICAO'];
    $codigo_Sts = $linha['CODIGO'];

    $Nome_Sts_P[$Sts] = $Nome_Sts;
    $Codigo_Sts_P[$Sts] = $codigo_Sts;
    $Sts++;
  }
  $configuracoes = $conexao->prepare("SELECT * FROM configuracoes WHERE configuracao = 'valor de chapa' ");
  $configuracoes->execute();
  $Sts = 0;
  while ($linha = $configuracoes->fetch(PDO::FETCH_ASSOC)) {
    $preco_chapa = $linha['parametro'];
  }

  if ($Tipo_Cliente == '1') {

    $cliente = 'Fisico';
    $query_clientes = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos  WHERE cod = '$Pesquisa_Cliente'");
  }
  if ($Tipo_Cliente == '2') {
    $cliente = 'Juridico';
    $query_clientes = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos  WHERE cod = '$Pesquisa_Cliente'");
  }
  $query_clientes->execute();

  while ($linha2 = $query_clientes->fetch(PDO::FETCH_ASSOC)) {
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


  $Clientes_Contato_Juridicos = $conexao->prepare("SELECT * FROM tabela_associacao_contatos a INNER JOIN tabela_contatos e ON a.cod_contato = e.cod WHERE a.cod_cliente = '$Pesquisa_Cliente' AND a.tipo_cliente = '$Tipo_Cliente' ");
  $Clientes_Contato_Juridicos->execute();
  $contato = 0;
  while ($linha = $Clientes_Contato_Juridicos->fetch(PDO::FETCH_ASSOC)) {

    $Cliente_Contato_Puxado[$contato] = [
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
  $Clientes_Endereco_Juridicos = $conexao->prepare("SELECT * FROM tabela_associacao_enderecos a INNER JOIN tabela_enderecos e ON a.cod_endereco = e.cod WHERE a.cod_cliente = '$Pesquisa_Cliente' AND a.tipo_cliente = '$Tipo_Cliente' ");
  $Clientes_Endereco_Juridicos->execute();
  $i = 0;
  $endereco = 0;
  while ($linha = $Clientes_Endereco_Juridicos->fetch(PDO::FETCH_ASSOC)) {

    $Cliente_Enderecos_Puxado[$endereco] = [
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


  //////
  if (isset($Orcamento_pesquisa)) {
    $Total_Finalizadas = count($Orcamento_pesquisa);
  } else {
    $Total_Finalizadas = 0;
  }
  $Percorrer_Finalizadas = 0;
  $valor_total_Finalizadas = 0;
  $hoje = date('Y-m-d');
  $data30 = date('Y-m-d', strtotime('+' . 30 . 'day', strtotime($hoje)));


  ?>
  <?php

  ?>
  <div class=" orcamento-- "></div>
  <!-- Tela de Orçamento -->
  <!-- INFORMAÇÃO DO CLIENTE  -->
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
                  <?php if (isset($cod_orcamento)) {
                    echo '
                    <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Informações do Oçamento Sendo editado </h5><h1 id="orcamentoEdit">' . $cod_orcamento . '</h1>
                  </div>';
                  };
                  ?>

                  <br>
                  <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Informações do Cliente</h5>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Tipo de Pessoa</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="tipoCliente" disabled id="basic-default-name" value="<?= $cliente ?>" placeholder="Fisica ou Juridica" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-company">Código do Cliente</label>
                        <div class="col-sm-10">
                          <input type="text" id="codigoCliente" disabled value="<?= $Pesquisa_Cliente ?>" class="form-control" id="basic-default-company" placeholder="" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-company">Nome do Cliente</label>
                        <div class="col-sm-10">
                          <input type="text" disabled class="form-control" value="<?= $Tabela_Clientes['nome'] ?>" id="basic-default-company" placeholder="" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-company">CPF/CNPJ</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" disabled value="<?= $documento ?>" id="basic-default-company" placeholder="" />
                        </div>
                      </div>
                      <div class="divider divider-dark">
                        <div class="divider-text">CONTATO</div>
                      </div>
                      <div class="mb-3">
                        <label for="selecione_contato" class="form-label">Contato:</label>
                        <select class="form-select" name="contato" id="selecione_contato" aria-label="Default select example" required>
                          <option>Selecione um contato</option>
                          <?php
                          $a = 0;
                          while ($contato > $a) {
                            echo '<option value="' . $Cliente_Contato_Puxado[$a]['cod'] . '">' . $Cliente_Contato_Puxado[$a]['nome_contato'] . ' ' . $Cliente_Contato_Puxado[$a]['telefone'] . ' ' . $Cliente_Contato_Puxado[$a]['email'] . '</option>';
                            $a++;
                          }
                          ?>


                        </select>
                      </div>
                      <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalContato">Adicionar um Novo Contato</button>
                      <div class="divider divider-dark">
                      
                      </div>
                      <div class="mb-3">
                        <label for="selecione_endereco" class="form-label">Endereço:</label>
                        <select class="form-select" name="endereco" id="selecione_endereco" aria-label="Default select example" required>
                          <option>Selecione um endereço</option>
                          <?php
                          $a = 0;
                          while ($endereco > $a) {
                            echo '<option value="' . $Cliente_Enderecos_Puxado[$a]['cod'] . '">Cep: ' . $Cliente_Enderecos_Puxado[$a]['cep'] . ' UF: ' . $Cliente_Enderecos_Puxado[$a]['uf'] . ' logadouro: ' . $Cliente_Enderecos_Puxado[$a]['logadouro'] . ' cidade: ' . $Cliente_Enderecos_Puxado[$a]['cidade'] . '</option>';
                            $a++;
                          }
                          ?>
                        </select>
                      </div>
                      <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalEndereco">Adicionar um Novo Endereço</button>
                    </div>

                    <div class="divider divider-dark">
                      <div class="divider-text">CRÉDITO</div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">Crédito</label>
                      <div class="col-sm-10">
                        <?php
                        if ($Tabela_Clientes['credito'] < 0) {
                          echo ' <div id="alertaSaldo"
                          role="bs-toast"
                          class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show "
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
                            O SALDO DO CLIENTE ESTÁ NEGATIVO! 
                          </div>
                          </div>';
                        }
                        ?>
                        <input type="text" class="form-control" disabled value="<?= number_format($Tabela_Clientes['credito'], 2, ',', '.') ?>" id="basic-default-company" placeholder="" />
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
  <script>
    setTimeout(() => {
      if (document.getElementById('alertaSaldo')) {
        document.getElementById('alertaSaldo').style.display = 'none';
      }
    }, 4500);
  </script>
  <!-- Informações Sobre o Orçamento (Segundo Drop) -->
  <div class="card accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="true" aria-controls="accordionTwo">
        Informações Sobre o Orçamento
      </button>
    </h2>
    <div id="accordionTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <div class="mb-3 row">
          <label for="html5-date-input" class="col-md-2 col-form-label">Data de Validade</label>
          <div class="col-md-10">
            <div class="input-group">
              <div class="row">
                <div class="col-12">
                  <input class="form-control " type="date" name="data_validade" id="data_validade" value="<?= $data30 ?>" />
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="col-lg-12">
          <div class="demo-inline-spacing mt-3">
            <div class="list-group list-group-horizontal-md text-md-center">
              <a class="list-group-item list-group-item-action active" id="home-list-item" data-bs-toggle="list" href="#horizontal-prod">Produtos</a>
              <a class="list-group-item list-group-item-action" id="profile-list-item1" data-bs-toggle="list" href="#horizontal-tir">Tiragens</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item3" data-bs-toggle="list" href="#horizontal-pap">Papel</a>
              <a style="display: none;" class="list-group-item list-group-item-action" id="settings-list-Clique" data-bs-toggle="list" href="#horizontal-cliq">Clique</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item4" data-bs-toggle="list" href="#horizontal-aca">Acabamentos</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item5" data-bs-toggle="list" href="#horizontal-ser">Serviços</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item6" data-bs-toggle="list" href="#horizontal-obs">Observações</a>
            </div>
            <div class="tab-content px-0 mt-0">
              <div class="tab-pane fade show active" id="horizontal-prod">
                <?php
                if (isset($_POST['produtos'])) {
                  $Produtos = $_POST['produtos'];
                  $TipoProdutoEditar = $_POST['ttipo_produto'];
                  echo '<input type="hidden" value="' . $TipoProdutoEditar . '" id="TipoProdutosEditarem">';
                  echo '<input type="hidden" value="' . $Produtos . '" id="ProdutosEditarem">';
                }
                ?>
                <div class="card">
                  <div id="SelecioandoProduto"></div>
                  <h5 class="card-header">PRODUTOS
                    <div class="row">
                      <div class="col-3">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" id="selecionar_um_produto" data-bs-target="#modal1">
                          Selecionar um Produto
                        </button>
                      </div>
                      <div class="col-3">
                        <button style="display: block; margin-left: 5px;" class="btn btn-outline-primary" onclick="ApagarProdutoSelecioando()">
                          Limpar produtos selecioandos
                        </button>
                      </div>
                    </div>

                  </h5>

                  <div class="table-responsive text-nowrap">
                    <table id="SelecionadoProudutosProduto" class="table table-striped">
                      <thead>
                        <tr>
                          <th>CÓDIGO</th>
                          <th>DESCRIÇÃO</th>
                          <th>LARGURA</th>
                          <th>ALTURA</th>
                          <th>QTD.PÁGINAS</th>
                        </tr>
                      </thead>

                      <tr>
                        <td align="center" colspan="5">NENHUM SELECIONADO</td>

                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="horizontal-tir">
                <div class="card">
                  <h5 class="card-header">TIRAGENS</h5>
                  <div class="table-responsive text-nowrap">
                    <table id="ProdutoTIragens" class="table table-striped">
                      <thead>
                        <tr>
                          <th>PRODUTO</th>
                          <th>QUANTIDADE</th>
                          <th>DIGITAL</th>
                          <th>OFFSET</th>
                          <th>VALOR IMPRESSÃO DIGITAL</th>
                          <th>VALOR UNITÁRIO</th>
                        </tr>
                      </thead>

                      <tr>
                        <td align="center" colspan="7">NENHUM SELECIONADO</td>
                      </tr>

                    </table>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="horizontal-pap">
                <div class="card">
                  <div id="mensagemPapelApagado"></div>
                  <h5 style="display: flex; align-items: center;" class="card-header">PAPEL
                  </h5>
                  <div class="col-3"><a class="btn btn-outline-primary" href="corte-papeis.pdf" target=”_blank”><iconify-icon icon="uil:table"></iconify-icon>&nbsp;TABELA<br>CORTES DE PAPEL</a></div>
                  <span id="AlertaCampos" class="badge bg-danger">Preencha todos os campos em vermelho para calcular o valor do orçamento.</span>
                  <div class="table-responsive text-nowrap">
                    <table id="tabela_campos" class="table table-striped">
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
                      <tr>
                        <td align="center" colspan="12">
                          NENHUM SELECIONADO
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="horizontal-cliq">
                <div class="card">
                  <h5 style="display: flex; align-items: center;" class="card-header">CLIQUES
                  </h5>
                  <span id="AlertaCampos1" class="badge bg-danger">Preencha todos os campos em vermelho para calcular a quantidade de clique.</span>
                  <div class="table-responsive text-nowrap">
                    <table id="calculo_clique" class="table table-striped">
                      <thead>
                        <tr>
                          <th>Quantidade Gasta</th>
                          <th>Valor total</th>
                        </tr>
                      </thead>

                    </table>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="horizontal-aca">
                <div class="card">
                  <h5 class="card-header">ACABAMENTOS</h5>
                  <div class="table-responsive text-nowrap">
                    <table id="seleccionadoacabamentos" class="table table-striped">
                      <thead>
                        <tr>
                          <th>CÓDIGO ACABAMENTO</th>
                          <th>DESCRIÇÃO</th>
                          <th>PREÇO ACABAMENTO</th>
                        </tr>
                      </thead>

                      <tr>
                        <td align="center" colspan="12">NENHUM SELECIONADO</td>
                      <tr>
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
                          <textarea class="form-control" placeholder="Coloque uma Observação" name="observacao_orc" id="observacao_orc" class="col-12"></textarea>
                          <input type="hidden" name="cod">
                        </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="horizontal-ser">
                <div class="card">
                  <h5 class="card-header">SERVIÇOS</h5>
                  <div class="table-responsive text-nowrap">
                    <div class="row">
                      <div class="col-3">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" id="selecionar_um_servico" data-bs-target="#modalServico" onclick="abriServicos()">
                          Selecionar um Serviço
                        </button>
                      </div>
                      <div class="col-3">
                        <a style="display: block; margin-left: 5px;" class="btn btn-outline-primary" onclick="ApagarServicoSelecioando('ServicoSelecionado')">
                          Limpar servicos selecioandos
                        </a>
                      </div>
                    </div>
                    <table id="tabelaAservicos" class="table table-striped">
                      <thead>
                        <tr>
                          <th>CÓDIGO SERVIÇO</th>
                          <th>DESCRIÇÃO</th>
                          <th>VALOR SERVIÇO</th>
                        </tr>
                      </thead>
                      <tr>
                        <td colspan="3" align="center">NENHUM SELECIONADO</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- MODAL SELEÇÃO DE SERVIÇO -->

            <div class="modal" id="modalServico">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1>SERVIÇOS</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                  </div>
                  <div class="modal-body">
                    <?php
                    $query_servicos = $conexao->prepare("SELECT * FROM tabela_servicos_orcamento ORDER BY cod DESC");
                    $query_servicos->execute();
                    $a = 0;
                    while ($linha = $query_servicos->fetch(PDO::FETCH_ASSOC)) {
                      $servico[$a] = [
                        'cod' => $linha['cod'],
                        'descricao' => $linha['descricao'],
                        'valor_minimo' => $linha['valor_minimo'],
                        'valor_unitario' => $linha['valor_unitario'],
                        'servico_geral' => $linha['servico_geral'],
                        'tipo_servico' => $linha['tipo_servico'],
                      ];
                      $a++;
                    }
                    ?>
                    <div class="row">
                      <div id="mensagemServico"></div>
                      <div class="col-4">
                        <div class="mb-3">
                          <label class="form-label colorbranca" for="Nome_Servico">NOME DO SERVIÇO</label>
                          <input type="text" id="Nome_Servico" class="form-control phone-mask" placeholder="Nome do serviço" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label colorbranca" for="Servico_Geral">SERVIÇO GERAL</label>
                          <input type="checkbox" id="Servico_Geral" class="form-check-input" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label colorbranca" for="valor_min">Valor Minimo</label>
                          <input type="number" id="valor_min" class="form-control phone-mask" placeholder="Valor minimo do serviço" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label colorbranca" for="valorUnitario">VALOR UNITÁRIO DO SERVIÇO</label>
                          <input type="number" id="valorUnitario" class="form-control phone-mask" placeholder="Valor unitário do Serviço" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label colorbranca" for="tipoServico">TIPO DO SERVIÇO</label>
                          <select class="form-select" id="tipoServico" name="tipoServico" aria-label="Default select example">
                            <option value="Serviço Interno">Serviço Interno</option>
                            <option value="Serviço Externo">Serviço Externo</option>
                          </select>
                        </div>

                        <div class="mb-3" id="cadastrarServico">
                          <a class="btn rounded-pill btn-success" onclick="CadastraServico()">CADASTRAR</a>
                        </div>
                        <div class="mb-3" style="display: none;" id="editarServico">
                          <input type="submit" class="btn rounded-pill btn-success" id="idservico" value="EDITAR" onclick="EditarServico()">
                        </div>
                      </div>

                      <div style="height: 700px; width: 66%; overflow-y: scroll; " class="m-0 p-0 col-6">
                        <div class="row">
                          <b>Pesquisar:</b>
                          <div class="col-6"><input type="text" class="form-control" id="pesquiarserviconome" placeholder="Nome do servico" onkeyup="pesquisarservico()"></div>
                          <div class="col-6"><input type="number" class="form-control" id="pesquiarservicoCodigo" placeholder="Código do servico" onkeyup="pesquisarservicocode()"></div>
                        </div>
                        <table id="selecionarServicos" class="colorbranca table table-sm table-houver">
                          <tr>
                            <th>CODIGO</th>
                            <th>DESCRIÇÃO</th>
                            <th>VALOR MINIMO</th>
                            <th>VALOR UNITÁRIO</th>
                            <th>TIPO DO SERVIÇO</th>
                            <th>SELECIONAR</th>
                          </tr>
                          <?php for ($i = 0; $i < $a; $i++) {
                            echo '<tr>
                                <td>' . $servico[$i]['cod'] . '</td>
                                <td>' . $servico[$i]['descricao'] . '</td>
                                <td>' . $servico[$i]['valor_minimo'] . '</td>
                                <td>' . $servico[$i]['valor_unitario'] . '</td>
                                <td>' . $servico[$i]['tipo_servico'] . '</td>
                                <td><input type="checkbox"  class="form-check-input" id="Servi' . $servico[$i]['cod'] . '" value="' . $servico[$i]['cod'] . '" onclick="selecionarServico(this.id)"></td>
                              </tr>';
                          } ?>

                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ENDEREÇO -->

          <div class="modal fade" id="modalEndereco" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel4">ENDEREÇO</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                      <label for="exampleFormControlSelect1" class="form-label">Tipo de Endereço</label>
                      <select class="form-select" id="tipo_endereco" name="tipo_endereco" aria-label="Default select example">
                        <option value="1">Residencial</option>
                        <option value="2">Comercial</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="cep">CEP</label>
                      <input type="text" class="form-control" id="cep" name="cep" placeholder="Insira o CEP do cliente" />
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="bairro">Bairro</label>
                      <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Insira o bairro do cliente" />
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="cidade">Cidade</label>
                      <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Insira a cidade do cliente" />
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="uf">UF</label>
                      <input type="text" class="form-control" id="uf" name="uf" placeholder="Insira a UF do cliente" />
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="logadouro">Logradouro</label>
                      <input type="text" class="form-control" id="logadouro" name="logadouro" placeholder="Insira o logradouro" />
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="complemento">Complemento</label>
                      <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Insira o complemento (opcional)" />
                    </div>
                    <div class="mb-1">
                    <input type="hidden" disabled class="form-control form-control-sm" name="id_cliente" id="id_cliente"  value="<?= $Pesquisa_Cliente ?>">
                    <input type="hidden" disabled class="form-control form-control-sm" name="tipo_cliente"  id="tipo_cliente" value="<?= $Tipo_Cliente  ?>">
                    </div>
                    <button type="submit" class="btn btn-success" onclick="EnviarCadastroEnderecoNovo()">Salvar Endereço</button>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                      Fechar
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- CONTATO -->
          <div class="modal fade" id="modalContato" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel4">CONTATO</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nome Para Contato</label>
                    <input type="text" class="form-control" id="basic-default-fullname" name="nome_contato" value="" placeholder="Insira um nome para contato" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Email</label>
                    <input type="text" class="form-control" id="basic-default-email" name="email" value="" placeholder="Insira o email do cliente" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-department">Departamento</label>
                    <input type="text" class="form-control" id="basic-default-department" name="departamento" value="" placeholder="Insira o departamento" />
                  </div>
                  <div class="mb-3">
                    <label for="tipo_telefone_principal" class="form-label">Tipo de Telefone Principal</label>
                    <select id="tipo_telefone_principal" class="form-select" name="tipo_telefone_principal">
                      <option>Selecione...</option>
                      <option value="1">Fixo</option>
                      <option value="2">Móvel</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-telefone">Número</label>
                    <input type="text" class="form-control" id="basic-default-telefone" name="telefone" value="<?= $Cliente_Contato_Puxado[0]['telefone'] ?>" placeholder="Insira o número principal" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-ramal">Ramal</label>
                    <input type="text" class="form-control" id="basic-default-ramal" name="ramal" value="<?= $Cliente_Contato_Puxado[0]['ramal'] ?>" placeholder="Insira o ramal principal" />
                  </div>
                  <div class="mb-3">
                    <label for="tipo_telefone_secundario" class="form-label">Tipo de Telefone Secundário</label>
                    <select id="tipo_telefone_secundario" class="form-select" name="tipo_telefone_secundario">
                      <option>Selecione...</option>
                      <option value="1">Fixo</option>
                      <option value="2">Móvel</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-telefone2">Número 2</label>
                    <input type="text" class="form-control" id="basic-default-telefone2" name="telefone2" value="<?= $Cliente_Contato_Puxado[0]['telefone2'] ?>" placeholder="Insira o número secundário" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-ramal2">Ramal 2</label>
                    <input type="text" class="form-control" id="basic-default-ramal2" name="ramal2" value="<?= $Cliente_Contato_Puxado[0]['ramal2'] ?>" placeholder="Insira o ramal secundário" />
                  </div>
                  <input type="hidden" name="id_cliente" value="<?= $Pesquisa_Cliente ?>">
                  <input type="hidden" name="tipo_cliente" value="<?= $Tipo_Cliente  ?>">
                  <button type="submit" class="btn btn-success" onclick="EnviarCadastroContatoNovo()">Salvar Contato</button>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                      Fechar
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- CIF -->
          <div class="container row ">

            <div class="col-3">
              <label class="form-label m-0 p-0">CIF (%)</label>
              <input type="number" class="form-control" id="cif" placeholder="0%" aria-describedby="defaultFormControlHelp" />
            </div>
            <div class="col-3">
              <label for="valor" class="form-label p-0 m-0">Arte (R$)</label>
              <input class="form-check-input mt-0" id="check_arte" type="checkbox" aria-label="checkbox button for following text input" />
              <input type="number" class="form-control" disabled id="arte" placeholder="R$ 00,00" aria-label="Text input with checkbox button" />
            </div>
            <div class="col-3">
              <label for="frete" class="form-label p-0 m-0">Frete (R$)</label>
              <input class="form-check-input mt-0" type="checkbox" id="check_frete" aria-label="checkbox button for following text input" />
              <input type="number" class="form-control" disabled id="frete" placeholder="R$ 00,00" aria-label="Text input with radio button" />
            </div>
            <div class="col-3">
              <label class="form-label m-0 p-0">Desconto (%)</label>
              <input type="number" class="form-control" id="desconto" placeholder="0%" aria-describedby="defaultFormControlHelp" />
            </div>
            <div>
              <br>
              <br>

              <button style="margin-bottom: 20px; display: block" type="button" class="btn btn-warning" id="calcularValor" onclick="calcularValor()">
                CALCULAR VALOR DO ORÇAMENTO
              </button><br>
            </div>

          </div>
          <label for="defaultFormControlInput" class="form-label">Valor Total (R$)</label>
          <input type="text" class="form-control" id="ValorTotalOrc" placeholder="Valor do orçamento final" aria-describedby="defaultFormControlHelp" /><br></br>
          <button style="margin-bottom: 20px; display: none" type="submit" class="btn btn-success" onclick="SalvarOrcamento()" id="SalvarPO">
            Salvar orçamento
          </button>
          <!-- <button type="button" class="btn btn-info">Tabela de Corte de Papel</button> -->
          <!-- <button type="submit" class="btn btn-success">Salvar</button> -->
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Botão para abrir o primeiro modal -->
  <!-- Primeiro modal PRODUTOS GERAL -->

  <div class="modal" id="modal1">
    <div id="load" style="position:absolute;background-color: #0056; width: 100%; height: 100%; z-index: 1; align-items: center; justify-content: center; display: none; color: white; font-size: 40px;"><img src="../img/preloader.svg"></div>
    <div class="modal-dialog modal-fullscreen" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title">PRODUTO</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <div class="demo-inline-spacing mt-3">
            <div class="list-group list-group-horizontal-md text-md-center">
              <a class="list-group-item list-group-item-action active" id="consulta-produto" data-bs-toggle="list" href="#consulta1-produto">Consultar Produto</a>
              <a class="list-group-item list-group-item-action" id="novo-produto" data-bs-toggle="list" href="#novo1-produto">Novo Produto</a>
            </div>

            <div class="tab-content px-0 mt-0">
              <div class="tab-pane fade show active" id="consulta1-produto">
                <div class="card">
                  <h5 class="card-header">Consulta Produto</h5>
                  <div class="table-responsive text-nowrap">
                    <div class="row mb-3">

                      <div class="col-sm-3">
                        <label for="pesquisarpor" class="form-label">PESQUISAR POR</label>
                        <select class="form-select" id="pesquisarpor" aria-label="Default select example">
                          <option value="descricao">DESCRIÇÃO</option>
                          <option value="codigo">CODIGO</option>
                        </select>
                        <div id="mensagemPesquisa"></div>
                      </div>

                      <!-- Adicione os botões de opção de rádio para selecionar o tipo de produto -->

                      <div class="form-check col-sm-3">

                        <input name="tipoProduto" class="form-check-input" type="radio" value="PP" id="ppRadio" checked />
                        <label class="form-check-label" for="ppRadio">PRODUÇÃO (PP)</label><br>
                        <input name="tipoProduto" class="form-check-input" type="radio" value="PE" id="peRadio" />
                        <label class="form-check-label" for="peRadio">PRONTA ENTREGA (PE)</label>
                      </div>
                      <div class="form-check col-sm-5">
                        <div id="mensagemBusca"></div>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="DIGITE A DESCIÇÃO DO PRODUTO QUE DESEJA" aria-label="DIGITE A SUA BUSCA" id="buscarP" aria-describedby="button-addon2" />
                          <button class="btn btn-outline-primary" type="button" id="pesquisar">PESQUISAR</button>
                        </div>
                        <br>
                      </div>
                    </div>
                    <div id="SelecaoProdutoss"></div>
                    <div style="height: 400px; width: 100%; overflow-y: scroll; ">
                      <div id="ClonadoProduto"></div>
                      <div id="ClonadoProduto"></div>
                      <div id="ErroClonar"></div>
                      <div id="ErroSelecionar"></div>
                      <table class="table table-hover table-sm table-bordered">
                        <thead>
                          <tr>
                            <th>CÓDIGO</th>
                            <th>TIPO</th>
                            <th>DESCRIÇÃO</th>
                            <th>VALOR UNITÁRIO</th>
                            <th>CLONAR</th>
                            <th>SELECIONAR</th>
                          </tr>
                        </thead>
                        <tbody id="produtosTableBody">
                          <!-- Os resultados da consulta serão adicionados aqui -->
                        </tbody>
                      </table>
                    </div>
                    <!-- AA -->
                  </div>
                </div>
              </div>
              <!-- novo produto -->

              <div class="tab-pane fade" id="novo1-produto">
                <div class="card">
                  <h5 class="card-header">Novo Produto</h5>
                  <div id="ApagarProdutoCloando"></div>
                  <div id="ApagarProdutoSelecioando"></div>
                  <button style="display: block; margin-left: 5px;" class="btn btn-primary" onclick="ApagarProdutoCloando()">
                    Limpar seleção de produto
                  </button>
                  <div class="table-responsive text-nowrap">
                    <div class="card-body">
                      <div id="tipo_de_produto_div" class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">TIPO DE PRODUTO</label>
                        <div class="col-sm-10">
                          <input name="TPP" class="form-check-input" type="radio" value="PP" id="NovoPP" required />
                          <label class="form-check-label" for="NovoPP"> PRODUÇÃO(PP) </label>
                          <input name="TPP" class="form-check-input" type="radio" value="PE" id="NovoPE" required />
                          <label class="form-check-label" for="NovoPE"> PRONTA ENTREGA(PE) </label>
                          <input class="form-check-input" name="TipoCommerce" type="checkbox" value="COMMERCE" id="NovoTipoCommerce" />
                          <label class="form-check-label" for="NovoTipoCommerce"> SERÁ ULTILIZADO NO E-COMMERCE </label>
                          <input class="form-check-input" name="Tipoativo" type="checkbox" value="ATIVO" id="NovoTipoativo" />
                          <label class="form-check-label" for="NovoTipoativo"> ATIVO</label>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="Novodescricao">DESCRIÇÃO DO PRODUTO</label>
                        <div id="descricao_div" class="col-sm-10">
                          <input type="text" class="form-control" id="Novodescricao" placeholder="DESCRIÇÃO" />
                          <div class="form-text">MÁXIMO 150 CARACTERES</div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div id="largura_div" class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="NovoLARGURA">LARGURA</label>
                          <input type="number" id="NovoNovolargura" class="form-control phone-mask" placeholder="0,0" aria-label="0,0" />
                        </div>
                        <div id="altura_div" class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="NovoALTURA">ALTURA</label>
                          <input type="number" id="Novoaltura" class="form-control phone-mask" placeholder="0,0" aria-label="0,0" />
                        </div>
                        <div id="espessura_div" class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="Novoespessura">ESPESSURA</label>
                          <input type="number" id="Novoespessura" class="form-control phone-mask" placeholder="0,0" aria-label="0,0" />
                        </div>
                        <div id="peso_div" class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="NovoPESO">PESO</label>
                          <input type="number" id="Novopeso" class="form-control phone-mask" placeholder="0,0" aria-label="0,0" />
                        </div>
                        <div id="folhas_div" class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="Novoqtdfolhas">QUANTIDADE FOLHAS</label>
                          <input type="number" value="1" id="Novoqtdfolhas" class="form-control phone-mask" min="1" placeholder="1" aria-label="1" />
                        </div>
                        <div id="tipo_div" class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="NovoLARGURA">TIPO</label>
                          <select class="form-select" id="NovotipoProduto" aria-label="Default select example">
                            <option desabled>SELECIONE</option>
                            <option value="FOLHA">FOLHA</option>
                            <option value="BLOCO">BLOCO</option>
                            <option value="LIVRO">LIVRO</option>
                          </select>
                        </div>
                      </div>
                      <div class="card">
                        <div class="list-group list-group-horizontal-md text-md-center">
                          <a class="list-group-item list-group-item-action active" id="papeis" data-bs-toggle="list" href="#papeis1">PAPÉIS</a>
                          <a class="list-group-item list-group-item-action" id="acabamentos" data-bs-toggle="list" href="#acabamentos1">ACABAMENTOS</a>
                          <a class="list-group-item list-group-item-action " id="valores" data-bs-toggle="list" href="#valores1">VALORES</a>
                          <a class="list-group-item list-group-item-action" id="estoque" data-bs-toggle="list" href="#estoque1">ESTOQUE</a>
                          <a class="list-group-item list-group-item-action " id="pedidos" data-bs-toggle="list" href="#pedidos1">PEDIDOS</a>
                        </div>

                        <div class="tab-content px-0 mt-0">
                          <div class="tab-pane fade show active" id="papeis1">

                            <h5 class="card-header">PAPÉIS</h5>

                            <!-- Botão para abrir o segundo modal -->
                            <div class="row">
                              <div class="col-3">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal2" onclick="abriPapels()">
                                  SELECIONAR PAPEL
                                </button>
                              </div>
                              <div class="col-3">
                                <button style="display: block; margin-left: 5px;" class="btn btn-outline-primary" onclick="ApagarPapel('papelSelecionado')">
                                  Remover Todos Papeis
                                </button>
                              </div>
                            </div>
                            <div class="table-responsive text-nowrap">


                              <table id="personalizaPapel" class="table table-bordered table-hover">
                                <tr>
                                  <th>CÓDIGO</th>
                                  <th>DESCRIÇÃO</th>
                                  <th>TIPO</th>
                                  <th>ORELHA</th>
                                  <th>CORES FRENTE</th>
                                  <th>CORES VERSO</th>
                                </tr>
                                <tr>
                                  <td align="center" colspan="6">NENHUM SELECIONADO</td>
                                </tr>
                              </table>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="acabamentos1">
                            <h5 class="card-header">ACABAMENTOS</h5>

                            <div class="row">
                              <div class="col-3">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal23" onclick="abriAcabamentos()">
                                  SELECIONAR ACABAMENTO
                                </button>
                              </div>
                              <div class="col-3">
                                <button style="display: block; margin-left: 5px;" class="btn btn-outline-primary" onclick="ApagarAcabamento('AcabamentoSelecionado')">
                                  Remover Todos Acabamentos
                                </button>
                              </div>
                            </div>
                            <br>
                            <div class="table-responsive text-nowrap">

                              <table id="NovoAcabemtnoSe" class="table table-bordered table-hover">
                                <tr>
                                  <th>CÓDIGO</th>
                                  <th>MÁQUINA</th>
                                  <th>CUSTO</th>
                                </tr>
                                <tr>
                                  <td align="center" colspan="3">
                                    NENHUM SELECIONADO
                                  </td>
                                </tr>
                              </table>

                            </div>
                          </div>
                          <div class="tab-pane fade" id="valores1">
                            <h5 class="card-header">VALORES</h5>
                            <div class="table-responsive text-nowrap">

                              <label class="form-check-label" for="prev"> PRODUTO PARA PRÉ-VENDA? </label>
                              <input class="form-check-input" name="prev" type="checkbox" value="prevendaS" id="prev" />
                              <div class="row mb-3">
                                <div class="col-sm-3">
                                  <label class="col-sm-2 col-form-label" for="valorunitario">VALOR
                                    UNITÁRIO(R$)</label>
                                  <input type="number" value="0" class="form-control" id="valorunitario" placeholder="0,00" />
                                </div>
                                <label class="col-sm-2 col-form-label" for="promo">VALOR PROMOCIONAL(R$)</label>
                                <div class="col-sm-3">
                                  <input class="form-check-input" name="promo" type="checkbox" value="promo" id="promo" />
                                  <input type="number" value="0" class="form-control" id="valorpromo" placeholder="0,00" />
                                </div>
                              </div>

                            </div>
                          </div>
                          <div class="tab-pane fade" id="estoque1">
                            <h5 class="card-header">ESTOQUE</h5>
                            <div class="table-responsive text-nowrap">

                              <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">QUANTIDADE NO ESTOQUE
                                  FÍSICO</label>
                                <input type="number" class="form-control" value="0" id="qtdestoque" placeholder="0" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label" for="avisoestoque">AVISO DE ESTOQUE?<input class="form-check-input" name="avisoestoque" type="checkbox" value="avisoestoque" id="avisoestoque" /> </label>
                                <input type="number" value="0" class="form-control" id="qtdaviso" placeholder="0" />
                              </div>

                            </div>
                          </div>
                          <div class="tab-pane fade" id="pedidos1">
                            <h5 class="card-header">PEDIDOS</h5>
                            <div class="table-responsive text-nowrap">

                              <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">QUANTIDADE MÍNIMA</label>
                                <input type="number" value="0" class="form-control" id="qtdmin" placeholder="0" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label" for="qtdmaxestoque">QUANTIDADE MÁXIMA
                                </label>
                                <input class="form-check-input" name="qtdmaxestoque" type="checkbox" value="qtdmaxestoque" id="qtdmaxestoque" />

                                <input type="number" value="0" class="form-control" id="qtdmax" placeholder="0" />
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class=" text-end  row justify-content-end">
                        <div class="col-sm-10">
                          <input type="submit" class="btn btn-primary" value="SALVAR" onclick="Dados_Novo_Produto()" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Segundo modal CONTEUDO PAPEL -->
              <div class="modal" id="modal2">
                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">PAPEL</h5>
                      <div id="mensagemPapel"></div>
                    </div>
                    <div class="modal-body">


                      <div class="row">
                        <div class="col-4">
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="Nome_papel">DESCRIÇÃO</label>
                            <input type="text" id="Nome_papel" class="form-control phone-mask" placeholder="NOME PAPEL" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="Mediada_Papel">Mediada</label>
                            <input type="text" id="Mediada_Papel" class="form-control phone-mask" placeholder="66 x 69" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="Gramatura">GRAMATURA</label>
                            <input type="number" id="Gramatura_Papel" class="form-control phone-mask" placeholder="0" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="Fomato_Papel">FORMATO</label>
                            <input type="text" id="Fomato_Papel" class="form-control phone-mask" placeholder="O Formato" />
                          </div>
                          <div class="mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="umaface_Papel" />
                            <label class="form-check-label" for="umaface_Papel"> UMA FACE? </label>
                          </div>
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="valor_Papel">VALOR UNITÁRIO</label>
                            <input type="number" id="valor_Papel" class="form-control phone-mask" placeholder="0" />
                          </div>
                          <div id="cadastrarPapel" class="mb-3">
                            <button class="btn rounded-pill btn-success" onclick="CadastraPapel();">CADASTRAR</button>
                          </div>
                          <div id="EditarPapel" style="display: none;" class="mb-3">
                            <input class="btn rounded-pill btn-success" id="idpapeleditado" name="" value="EDITAR" onclick="EditarPapel()" />
                          </div>
                        </div>
                        <div style="height: 700px; width: 66%; overflow-y: scroll; " class="m-0 p-0 col-6">
                          <?php
                          $query_papel = $conexao->prepare("SELECT * FROM tabela_papeis ORDER BY cod DESC");
                          $query_papel->execute();
                          $p = 0;
                          while ($linha = $query_papel->fetch(PDO::FETCH_ASSOC)) {
                            $papel[$p] = [
                              'cod' => $linha['cod'],
                              'descricao' => $linha['descricao'],
                              'medida' => $linha['medida'],
                              'gramatura' => $linha['gramatura'],
                              'formato' => $linha['formato'],
                              'uma_face' => $linha['uma_face'],
                              'unitario' => $linha['unitario'],
                            ];
                            $p++;
                          }
                          ?>
                          <div class="row">
                            <b>Pesquisar:</b>
                            <div class="col-6"><input type="text" class="form-control" id="pesquiarpapelnome" placeholder="Nome do papel" onkeyup="pesquisarpapel()"></div>
                            <div class="col-6"><input type="number" class="form-control" id="pesquiarpapelCodigo" placeholder="Código do papel" onkeyup="pesquisarpapelcode()"></div>
                          </div>


                          <table id="PapelsSelecionado" class="colorbranca table table-sm table-houver">
                            <tr>
                              <th>CODIGO</th>
                              <th>DESCRIÇÃO</th>
                              <th>MEDIDA</th>
                              <th>GRAMATURA</th>
                              <th>FORMATO</th>
                              <th>UMA FACE</th>
                              <th>VALOR</th>
                              <th>SELECIONAR</th>
                            </tr>
                            <?php for ($i = 0; $i < $p; $i++) {
                              echo '<tr>
                              <td>' . $papel[$i]['cod'] . '</td>
                              <td>' . $papel[$i]['descricao'] . '</td>
                              <td>' . $papel[$i]['medida'] . '</td>
                              <td>' . $papel[$i]['gramatura'] . '</td>
                              <td>' . $papel[$i]['formato'] . '</td>
                              <td>' . $papel[$i]['uma_face'] . '</td>
                              <td>' . $papel[$i]['unitario'] . '</td>
                              <td><input class="form-check-input" value="' . $papel[$i]['cod'] . '" id="Papel' . $papel[$i]['cod'] . '" onclick="selecionarPapel(this.id)"  type="checkbox" ></td>
                            </tr>';
                            } ?>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



              <!-- terceiro modal CONTEUDO ACABAMENTO -->
              <div class="modal" id="modal23">
                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">ACABAMENTO</h5>
                    </div>
                    <div class="modal-body">

                      <div class="row">
                        <div id="mensagemAcabamento"></div>
                        <div class="col-4">
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="Nome_Acabamento">NOME DA MÁQUINA</label>
                            <input type="text" id="Nome_Acabamento" class="form-control phone-mask" placeholder="NOME MÁQUINA" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="valor_Acabamento">CUSTO HORA</label>
                            <input type="number" id="valor_Acabamento" class="form-control phone-mask" placeholder="0" />
                          </div>
                          <div id="cadastrarAcabamento" class="mb-3">
                            <button class="btn rounded-pill btn-success" onclick="CadastraAcabamento()">CADASTRAR</button>
                          </div>
                          <div id="editarAcabamento" style="display: none;" class="mb-3">
                            <input class="btn rounded-pill btn-success" id="idAcabamentoeditado" name="" value="EDITAR" onclick="EditarAcabamento();" />
                          </div>
                        </div>

                        <div style="height: 700px; width: 66%; overflow-y: scroll; " class="m-0 p-0 col-6">
                          <div class="row">
                            <b>Pesquisar:</b>
                            <div class="col-6"><input type="text" class="form-control" id="pesquiaracabamentonome" placeholder="Nome do acabamento" onkeyup="pesquisaracabamento()"></div>
                            <div class="col-6"><input type="number" class="form-control" id="pesquiaracabamentoCodigo" placeholder="Código do acabamento" onkeyup="pesquisaracabamentocode()"></div>
                          </div>
                          <table id="selecionarAcabamentos" class="colorbranca table table-sm table-houver">
                            <tr>
                              <th>CODIGO</th>
                              <th>MÁQUINA</th>
                              <th>CUSTO HORA</th>
                              <th>SELECIONAR</th>
                            </tr>
                            <tr>
                              <td align="center" colspan="4">NENHUM SELECIONADO</td>
                            </tr>

                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal Cadastrar contato -->
              <!-- Extra Large Modal -->
              <!-- Extra Large Modal -->






              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
              <script>
                // Obtém o elemento do segundo modal
                const modal2 = document.getElementById('modal2');
                if (modal2) {
                  // Adiciona o evento 'hidden.bs.modal' ao segundo modal
                  modal2.addEventListener('hidden.bs.modal', function(event) {
                    // Obtém o elemento do primeiro modal
                    const modal1 = document.getElementById('modal1');

                    // Verifica se o elemento do primeiro modal existe antes de chamar o método 'show()'
                    if (modal1) {
                      modal1.show();
                    }
                  });
                }
              </script>

              <script>
                const busca = document.getElementById('buscarP');
                const pesquisarpor = document.getElementById('pesquisarpor');
                const pesquisar = document.getElementById('pesquisar');
                const mensagemBusca = document.getElementById('mensagemBusca');
                const mensagemPesquisa = document.getElementById('mensagemPesquisa');
                let TipoProdutoSelect = 'PP';
                if (pesquisarpor) {
                  pesquisarpor.addEventListener('click', vlr => {
                    if (pesquisarpor.value === 'codigo') {
                      busca.type = 'number';
                      busca.placeholder = 'DIGITE O CÓDIGO DO PRODUTO';
                    } else {
                      busca.type = 'text';
                      busca.placeholder = 'DIGITE A DESCIÇÃO DO PRODUTO';
                    }
                  });
                }

                function exibirBusca(dados) {
                  const tableBody = document.getElementById('produtosTableBody');
                  tableBody.innerHTML = '';
                  if (Array.isArray(dados)) {
                    dados.forEach(produto => {
                      tableBody.innerHTML += `
                      <tr>
                        <td>${produto.CODIGO}</td>
                        <td>${produto.TIPO}</td>
                        <td>${produto.DESCRICAO}</td>
                        <td>${produto.VALOR_UNITARIO}</td>
                        <td><button class="btn btn-outline-warning" type="button" name="ProdutoClone${produto.CODIGO}"  id="ProdutoClone${produto.CODPRODUTO}" onclick="ClonarProduto(this.id)" >CLONAR PRODUTO</button></td>
                        <td><button  class="btn btn-outline-danger" name="Produto${produto.CODIGO}"  id="Produto${produto.CODPRODUTO}" onclick="SelecionarProduto(this.id)" data-bs-dismiss="modal" aria-label="Fechar" >Selecionar Produto</button></td>
                      </tr>`;
                    });
                  } else {
                    tableBody.innerHTML += `
                      <tr>
                        <td>${dados.CODIGO}</td>
                        <td>${dados.TIPO}</td>
                        <td>${dados.DESCRICAO}</td>
                        <td>${dados.VALOR_UNITARIO}</td>
                        <td><button class="btn btn-outline-warning" type="button" name="ProdutoClone${produto.CODIGO}"  id="ProdutoClone${produto.CODPRODUTO}" onclick="ClonarProduto(this.id)" >CLONAR PRODUTO</button></td>
                        <td><button  class="btn btn-outline-danger" id="Produto${produto.CODPRODUTO}" onclick="SelecionarProduto(this.id)" data-bs-dismiss="modal" aria-label="Fechar"   name="Produto${dados.CODIGO}"  >Selecionar Produto </button></td>
                      </tr>`;
                  }

                }

                function enviarBusca(consulta) {
                  const xhr = new XMLHttpRequest();
                  xhr.open('POST', 'api_produtos.php');
                  xhr.setRequestHeader('Content-Type', 'application/json');
                  xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                      const response = JSON.parse(xhr.responseText);
                      exibirBusca(response);
                    }
                  };
                  xhr.send(JSON.stringify(consulta));
                }
                if (pesquisarpor) {
                  pesquisar.addEventListener('click', vlr => {
                    if (busca.value === '') {
                      mensagemBusca.innerHTML = '<div id="alerta" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Erro!</div><small></small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button> </div> <div class="toast-body">  POR FAVOR, DIGITE UMA DESCRIÇÃO NO CAMPO DE BUSCA! </div> </div>';
                    } else {
                      mensagemBusca.innerHTML = '';
                      const consulta = {
                        TipoProdutoSelect: TipoProdutoSelect,
                        pesquisa: pesquisarpor.value,
                        valor: busca.value,
                      };
                      enviarBusca(consulta);
                    }

                  })
                }


                fetch('api_produtos.php')
                  .then(response => response.json())
                  .then(data => {
                    // processa os dados recebidos
                    const pp = data.pp;
                    const pe = data.pe;
                    let ativo_pp = 'Nao';

                    // obtém a referência à tabela onde os resultados serão exibidos
                    // obtém referência aos inputs de rádio
                    const ppRadio = document.getElementById('ppRadio');
                    const peRadio = document.getElementById('peRadio');
                    if (ppRadio) {
                      // adiciona listener de eventos às mudanças nos inputs de rádio
                      ppRadio.addEventListener('change', function() {
                        SelecionarClonado();
                        // atualiza a tabela com os valores de pp
                        ativo_pp = 'Sim';
                        TipoProdutoSelect = 'PP';
                        const tableBody = document.getElementById('produtosTableBody');
                        tableBody.innerHTML = '';
                        pp.forEach(produto => {
                          tableBody.innerHTML += `
                            <tr>
                              <td>${produto.CODIGO}</td>
                              <td>${produto.TIPO}</td>
                              <td>${produto.DESCRICAO}</td>
                              <td>${produto.VALOR_UNITARIO}</td>
                              <td><button class="btn btn-outline-warning" type="button" name="ProdutoClone${produto.CODIGO}"  id="ProdutoClone${produto.CODPRODUTO}" onclick="ClonarProduto(this.id)" >CLONAR PRODUTO</button></td>
                              <td><button  class="btn btn-outline-danger"  name="Produto${produto.CODIGO}" id="Produto${produto.CODPRODUTO}" onclick="SelecionarProduto(this.id)" data-bs-dismiss="modal" aria-label="Fechar"  >Selecionar Produto</button></td>
                            </tr>`;
                        });
                      });
                    }
                    if (ppRadio) {
                      peRadio.addEventListener('change', function() {
                        SelecionarClonadoPE();
                        // atualiza a tabela com os valores de pe
                        TipoProdutoSelect = 'PE';
                        ativo_pp = 'Sim';
                        const tableBody = document.getElementById('produtosTableBody');
                        tableBody.innerHTML = '';
                        pe.forEach(produto => {
                          tableBody.innerHTML += `
                              <tr>
                                <td>${produto.CODIGO}</td>
                                <td>${produto.TIPO}</td>
                                <td>${produto.DESCRICAO}</td>
                                <td>${produto.VALOR_UNITARIO}</td>
                                <td><button class="btn btn-outline-warning" type="button" name="ProdutoClone${produto.CODIGO}"  id="ProdutoClone${produto.CODPRODUTO}" onclick="ClonarProduto(this.id)" >CLONAR PRODUTO</button></td>
                                <td><button class="btn btn-outline-danger"name="Produto${produto.CODIGO}" id="Produto${produto.CODPRODUTO}"onclick="SelecionarProduto(this.id)" data-bs-dismiss="modal" aria-label="Fechar" >Selecionar Produto</button></td>
                              </tr> `;

                        });
                      });
                    }
                    if (ativo_pp === 'Nao') {
                      const tableBody = document.getElementById('produtosTableBody');
                      tableBody.innerHTML = '';

                      let html = '';

                      pp.forEach(produto => {
                        html += `
                        <tr>
                          <td>${produto.CODIGO}</td>
                          <td>${produto.TIPO}</td>
                          <td>${produto.DESCRICAO}</td>
                          <td>${produto.VALOR_UNITARIO}</td>
                          <td><button class="btn btn-outline-warning" type="button" name="ProdutoClone${produto.CODIGO}"  id="ProdutoClone${produto.CODPRODUTO}" onclick="ClonarProduto(this.id)">CLONAR PRODUTO</button></td>
                          <td><button class="btn btn-outline-danger" name="Produto${produto.CODIGO}" id="Produto${produto.CODPRODUTO}" onclick="SelecionarProduto(this.id)" data-bs-dismiss="modal" aria-label="Fechar">Selecionar Produto</button></td>
                        </tr>`;
                      });

                      tableBody.innerHTML = html;
                    }
                  })
                  .catch(error => console.error(error));
              </script>

              <script>
                // const orcamentoproduto = new Vue({
                //   el: "#orcamentacaoProduto",
                //   data: {
                //     produto: 'valor'
                //   },
                //   methods: {
                //     atualizarProduto: function (novoValor) {
                //       this.produto = novoValor;
                //       this.$emit('produto-atualizado', novoValor);
                //     }
                //   }
                // });

                // const orcamentoselecionado = new Vue({
                //   el: "#orcamentacaoselecionado",
                //   data: {
                //     produto: ''
                //   },
                //   created: function () {
                //     orcamentoproduto.$on('produto-atualizado', (novoValor) => {
                //       this.produto = novoValor;
                //     });
                //   }
                // });
              </script>

              <script>
                const frete = document.getElementById('frete');
                const arte = document.getElementById('arte');
                const check_frete = document.getElementById('check_frete');
                const check_arte = document.getElementById('check_arte');
                if (frete) {
                  frete.addEventListener('click', arr => {
                    if (check_frete.disabled === false) {
                      check_frete.disabled = true;
                    } else {
                      check_frete.disabled = false;
                    }
                  })
                }
                if (arte) {
                  arte.addEventListener('click', arr => {
                    if (check_arte.disabled === false) {
                      check_arte.disabled = true;
                    } else {
                      check_arte.disabled = false;
                    }
                  })
                }

                const selects = document.getElementById('selects');
                const simpleszao = document.getElementById('simpleszao');
                const detalhadao = document.getElementById('detalhadao');
                const SIMPLES = document.getElementById('SIMPLES');
                const DETALHADO = document.getElementById('DETALHADO');
                if (SIMPLES) {
                  SIMPLES.addEventListener('click', vlr => {
                    simpleszao.classList.remove('tira');
                    detalhadao.classList.add('tira');
                  })
                }
                if (DETALHADO) {
                  DETALHADO.addEventListener('click', vlr => {
                    detalhadao.classList.remove('tira');
                    simpleszao.classList.add('tira');
                  })
                }
              </script>




              <?php
            } else {
              if (!isset($_POST['numero1']) || !isset($_POST['numero2'])) {  ?>
                <div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header"> <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Aviso!</div> <small> </small>
                  </div>
                  <div class="toast-body">Você não selecionou o cliente da forma correta!</div>
                </div>
              <?php
              } ?>

              <!-- Segundo modal CONTEUDO PAPEL -->
              <div>
                <div>
                  <div class="modal-content">
                    <div class="modal-header">
                      <div id='selecioneCerto'></div>
                      <h5 class="modal-title">Selecione o CLIENTE</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="mb-3">
                          <form method="POST" action="abrir_orcamento.php">
                            <select class="form-select" name="tipo_cliente" id="cliente" aria-label="Default select example">
                              <option selected>Selecione o tipo de cliente</option>
                              <option value="1">Pessoa Física</option>
                              <option value="2">Pessoa Júridica</option>
                            </select>
                        </div>
                        <div class="mb-3">
                          <div id="juri" class="mb-3">
                            <input name="usuario0" id="usuario0" class="form-control" type="text" placeholder="Digite o NOME do cliente  juridico" onkeyup="carregar_usuarios(this.value)" />
                            <input id="codigo" name="numero1" class="form-control" type="text" style="display: none;" placeholder="Digite o código aqui" />
                            <span id="resultado_pesquisa0"></span>
                            <br>
                            <input name="usuariosigla" id="usuariosigla" class="form-control" type="text" placeholder="Digite a SIGLA cliente  juridico" onkeyup="carregar_sigla(this.value)" />
                            <span id="resultado_sigla"></span>
                          </div>
                          <div id="dis" class="mb-3">
                            <input id="defaultInput" disabled class="form-control" type="text" placeholder="Selecione o tipo de cliente" />
                          </div>
                          <div id="fisc" class="mb-3">
                            <input name="usuario1" id="usuario1" class="form-control" type="text" placeholder="Digite o nome do cliente fisico" onkeyup="carregar_fisico(this.value)" />
                            <input id="codigo1" name="numero2" class="form-control" type="text" style="display: none;" placeholder="Digite o código aqui" />
                            <span id="resultador_123"></span>
                          </div>

                          <button type="submit" name="submit" class="btn btn-info">Selecionar</button>
                        </div>
                        </form>
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
        const select = document.getElementById('cliente');
        const juri = document.getElementById('juri');
        const dis = document.getElementById('dis');
        const fisc = document.getElementById('fisc');
        fisc.style.display = 'none';
        juri.style.display = 'none';
        if (select) {
          select.addEventListener('click', vlr => {
            if (select.value == 1) {
              fisc.style.display = 'block';
              juri.style.display = 'none';
              dis.style.display = 'none';
            } else {
              fisc.style.display = 'none';
              juri.style.display = 'block';
              dis.style.display = 'none';
            }
          })
        }
      </script>
    <?php } ?>
    <script src="../node_modules/bignumber.js/bignumber.js"></script>
    <script src="../js/orcamentacao.js"></script>
    <script src="../js/cadastros_orcamento.js"></script>
    <script src="../js/produtoClonado.js"></script>
    <script src="../js/produtoSelecioando.js"></script>
    <?php
    if (!isset($_SESSION['processed']) || $_SESSION['processed'] !== true) {
    ?>
      <script>
        // Obtendo a string de números separados por vírgulas do PHP
        let produtos = "<?php echo $Produtos; ?>";
        let TipoEditar = "<?php echo $tipo_produtoEditar; ?>";
        // Dividindo a string em um array de números

        SelecionarProdutoEditando(produtos, TipoEditar);


        // Definição da função SelecionarProdutoEditando
      </script>
    <?php $_SESSION['processed'] = true;
    } ?>
    <?php include_once("../html/navbar-dow.php"); ?>