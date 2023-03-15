<?php /* |||   */ include_once("../html/../html/navbar.php");
$_SESSION["pag"] = array(1, 0);

$data = date('Y-m-d');

?>

<!-- Accordion -->
<div class="row">
  <?php if (isset($_GET['cod'])) {
    $codigo_op = $_GET['cod'];

    $query_op = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE cod = '$codigo_op' ");
    $query_op->execute();

    while ($linha = $query_op->fetch(PDO::FETCH_ASSOC)) {
      $tipo_produto = $linha['tipo_produto'];
      $cod_produto = $linha['cod_produto'];
      $orcamento_base = $linha['orcamento_base'];
      $status = $linha['status'];
      $cod_cliente = $linha['cod_cliente'];
      $tipo_cliente = $linha['tipo_cliente'];
    }

    if ($tipo_cliente == 1) {
      $query_cliente = $conexao->prepare("SELECT * FROM tabela_associacao_enderecos a INNER JOIN tabela_clientes_fisicos c ON a.cod_cliente = c.cod INNER JOIN tabela_enderecos e ON e.cod = a.cod_endereco WHERE a.tipo_cliente = 1 AND cod_cliente = '$cod_cliente' ");
      $query_cliente->execute();

      while ($linha = $query_cliente->fetch(PDO::FETCH_ASSOC)) {
        $nome = $linha['nome'];
        $cep = $linha['cep'];
        $logadouro = $linha['logadouro'];
        $uf = $linha['uf'];
        $cidade = $linha['cidade'];
      }
    }

    $query_produto = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento WHERE tipo_produto = $tipo_produto AND cod_produto = $cod_produto AND cod_orcamento = $orcamento_base");
    $query_produto->execute();

    while ($linha = $query_produto->fetch(PDO::FETCH_ASSOC)) {
      $quantidade = $linha['quantidade'];
      $descricao_produto = $linha['descricao_produto'];
      $preco_unitario = $linha['preco_unitario'];
      $valor_digital = $linha['valor_digital'];
    }

    if ($tipo_produto == 1) {
      $query_produto2 = $conexao->prepare("SELECT * FROM produtos WHERE CODIGO = '$cod_produto' ");
      $query_produto2->execute();

      while ($linha = $query_produto2->fetch(PDO::FETCH_ASSOC)) {
        $LARGURA = $linha['LARGURA'];
        $ALTURA = $linha['ALTURA'];
      }
    }
    if ($tipo_produto == 2) {
      $query_produto = $conexao->prepare("SELECT * FROM produtos_pr_ent WHERE CODIGO = '$cod_produto' ");
      $query_produto->execute();

      while ($linha = $query_produto->fetch(PDO::FETCH_ASSOC)) {

        $LARGURA = $linha['LARGURA'];
        $ALTURA = $linha['ALTURA'];
      }
    }
    $query_faturamento = $conexao->prepare("SELECT * FROM faturamentos WHERE CODIGO_OP = '$codigo_op'  ");
    $query_faturamento->execute();

    if ($linha = $query_faturamento->fetch(PDO::FETCH_ASSOC)) {
      $QTD_ENTREGUE = $linha['QTD_ENTREGUE'];
      $VLR_FAT = $linha['VLR_FAT'];
      $OBSERVACOES = $linha['OBSERVACOES'];
      $CODIGO = $linha['CODIGO'];
      $EMISSOR = $linha['EMISSOR'];
      $FATURAMENTO = true;

      $query_frete = $conexao->prepare("SELECT * FROM tabela_notas_transporte WHERE cod_nota = '$CODIGO'  ");
      $query_frete->execute();

      if ($linha = $query_frete->fetch(PDO::FETCH_ASSOC)) {
        $modalidade_frete = $linha['modalidade_frete'];
        $nome_transportador = $linha['nome_transportador'];
      }
    }



    if (!isset($QTD_ENTREGUE)) {
      $QTD_ENTREGUE = 0;
      $QTD_SER_ENTREGUE =  $quantidade;
    } else {
      $QTD_SER_ENTREGUE =  $quantidade - $QTD_ENTREGUE;
    }

    $VALOR_RESTANTE = $QTD_SER_ENTREGUE * $preco_unitario;

    if (isset($_SESSION['msg'])) {
      echo $_SESSION['msg'];
      unset($_SESSION['msg']);
    }
  ?>
    <div class="col-md mb-4 mb-md-0">
      <div class="accordion mt-3" id="accordionExample">
        <div class="card accordion-item active">
          <h2 class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
              Faturamento
            </button>
          </h2>
          <div class=" fatura-- "></div>
          <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="demo-inline-spacing mt-3">
                        <div class="list-group list-group-horizontal-md text-md-center">
                          <a class="list-group-item list-group-item-action active" id="home-list-item" data-bs-toggle="list" href="#horizontal-home">Produtos e Serviços</a>
                          <a class="list-group-item list-group-item-action" id="profile-list-item" data-bs-toggle="list" href="#horizontal-profile">Dados do Faturamento</a>
                          <a class="list-group-item list-group-item-action" id="messages-list-item" data-bs-toggle="list" href="#horizontal-messages">Transporte</a>
                          <a class="list-group-item list-group-item-action" id="settings-list-item" data-bs-toggle="list" href="#horizontal-campos">Observações</a>
                        </div>
                        <!--Produtos e Serviços-->
                        <form action="save_faturamento.php" method="POST">
                          <div class="tab-content px-0 mt-0">
                            <div class="tab-pane fade show active" id="horizontal-home">
                              <div class="mb-3">
                                <label for="origem" class="form-label">Origem</label>
                                <select class="form-select" name="origem" id="origem" aria-label="Default select example">
                                  <option value="1">1 - Ordem de Produção</option>

                                </select>
                              </div>

                              <div class="mb-3">
                                <label for="codigo" class="form-label">Código da OP</label>
                                <input class="form-control" type="text" name="codigo" value="<?= $codigo_op ?>" id="codigo" placeholder="Digite o codigo da Op" required />
                              </div>
                              <br>
                              <div class="mb-3">
                                <label for="orc" class="form-label">Código do Orçamento</label>
                                <input class="form-control" type="text" value="<?= $orcamento_base ?>" name="orc" id="orc" readonly />
                              </div>
                              <div class="mb-3">
                                <label for="desc" class="form-label">Descrição</label>
                                <input class="form-control" type="text" value="<?= $descricao_produto ?>" name="desc" id="desc" readonly />
                              </div>
                              <div class="mb-3">
                                <label for="qtd_solicitada" class="form-label">Quantidade Solicitada</label>
                                <input class="form-control" type="text" value="<?= $quantidade ?>" name="qtd_solicitada" id="qtd_solicitada" readonly />
                              </div>
                              <div class="mb-3">
                                <label for="valor_unitario" class="form-label">Valor Unitário</label>
                                <input class="form-control" type="text" value="<?= $preco_unitario ?>" name="valor_unitario" id="valor_unitario" readonly />
                              </div>
                              <div class="mb-3">
                                <label for="quantidade_entregue" class="form-label">Quantidade Entregue</label>
                                <input class="form-control" type="text" value="<?= $QTD_ENTREGUE ?>" name="quantidade_entregue" id="quantidade_entregue" readonly />
                              </div>
                              <input type="hidden" value="<?= $QTD_SER_ENTREGUE ?>" name="quantidade_restante">
                              <div class="mb-3 row">
                                <label for="quantidade" class="col-md-2 col-form-label">Quantidade a ser Entregue</label>
                                <div class="col-md-10">

                                  <input class="form-control" name="quantidade" type="number" placeholder="<?= $QTD_SER_ENTREGUE ?>" id="quantidade" max="<?= $QTD_SER_ENTREGUE ?>" onclick="calcular_faturado(this.value)" required />
                                </div>
                              </div>
                              <div class="card-body demo-vertical-spacing demo-only-element">
                                <label for="valor_faturado" class="form-label">Faturar Serviços do Orçamento</label>
                                <div class="input-group">
                                  <div class="input-group-text">
                                    <p>Valor a ser Faturado: </p>
                                  </div>
                                  <?php if (isset($FATURAMENTO)) { ?>
                                    <input type="number" placeholder="R$ <?= $VALOR_RESTANTE ?>0" name="valor_faturado" id="valor_faturado" step="0.01" class="form-control" aria-label="Text input with checkbox" />
                                  <?php } else { ?>
                                    <input type="number" placeholder="R$ <?= $VALOR_RESTANTE ?>.00" name="valor_faturado" id="valor_faturado" step="0.01" class="form-control" aria-label="Text input with checkbox" />
                                  <?php } ?>

                                </div>
                              </div>
                            </div>
                            <!--Dados do Pagamento-->
                            <div class="tab-pane fade" id="horizontal-profile">
                              <?php if (isset($FATURAMENTO)) { ?>

                                <div class="divider divider-dark">
                                  <div class="divider-text">Faturamento</div>
                                </div>
                                <div class="mb-3">
                                  <label for="serie" class="form-label">Série</label>
                                  <select class="form-select" name="serie" id="serie" aria-label="Default select example">
                                    <option value="1">1</option>
                                  </select>
                                </div>
                                <div class="mb-3">
                                  <label for="numero" class="form-label">Número</label>
                                  <input class="form-control" type="text" value="<?= $CODIGO ?>" name="numero" id="numero" placeholder="" readonly />
                                </div>
                                <div class="mb-3 row">
                                  <label for="data" class="col-md-2 col-form-label">Data de Entrega</label>
                                  <div class="col-md-10">
                                    <input class="form-control" name="data" type="date" value="<?= $data ?>" id="data" />
                                  </div>
                                </div>
                                <div class="divider divider-dark">
                                  <div class="divider-text">Tipo de Documento</div>
                                </div>
                                <div class="mb-3">
                                  <label for="descricao" class="form-label">Descrição</label>
                                  <select class="form-select" name="descricao" id="descricao" aria-label="Default select example">
                                    <option value="1">2 - Faturamento de Ordem de Produção</option>
                                  </select>
                                </div>
                                <div class="mb-3">
                                  <label for="finalidade" class="form-label">Finalidade da Emissão</label>
                                  <input class="form-control" type="text" value="NORMAL" name="finalidade" id="finalidade" placeholder="" readonly />
                                </div>
                                <div class="mb-3">
                                  <label for="emissor" class="form-label">Emissor</label>
                                  <input class="form-control" type="text" value="<?= $EMISSOR ?>" name="emissor" id="emissor" placeholder="" readonly />
                                </div>
                                <div class="divider divider-dark">
                                  <div class="divider-text">Cliente</div>
                                </div>
                                <div class="mb-3">
                                  <label for="codigo_faturamento" class="form-label">Dados: Nome: <?= $nome ?> Cep: <?= $cep ?> Logadouro: <?= $logadouro ?> Uf: <?= $uf ?> Cidade: <?= $cidade ?> </label>
                                  <input class="form-control" type="text" value="<?= $cod_cliente ?>" name="codigo_faturamento" id="codigo_faturamento" placeholder="" readonly />
                                </div>
                              <?php } else { ?>
                                <div class="divider divider-dark">
                                  <div class="divider-text">Faturamento</div>
                                </div>
                                <div class="mb-3">
                                  <label for="serie" class="form-label">Série</label>
                                  <select class="form-select" name="serie" id="serie" aria-label="Default select example">
                                    <option value="1">1</option>
                                  </select>
                                </div>
                                <div class="mb-3">
                                  <label for="numero" class="form-label">Número</label>

                                  <input class="form-control" type="text" value="NÃO FOI FATURADO AINDA" name="numero" id="numero" placeholder="" readonly />

                                </div>
                                <div class="mb-3 row">
                                  <label for="data" class="col-md-2 col-form-label">Data de Entrega</label>
                                  <div class="col-md-10">
                                    <input class="form-control" name="data" type="date" value="<?= $data ?>" id="data" />
                                  </div>
                                </div>
                                <div class="divider divider-dark">
                                  <div class="divider-text">Tipo de Documento</div>
                                </div>
                                <div class="mb-3">
                                  <label for="descricao" class="form-label">Descrição</label>
                                  <select class="form-select" name="descricao" id="descricao" aria-label="Default select example">
                                    <option value="1">2 - Faturamento de Ordem de Produção</option>
                                  </select>
                                </div>
                                <div class="mb-3">
                                  <label for="finalidade" class="form-label">Finalidade da Emissão</label>
                                  <input class="form-control" type="text" value="NORMAL" name="finalidade" id="finalidade" placeholder="" readonly />
                                </div>
                                <div class="mb-3">
                                  <label for="emissor" class="form-label">Emissor</label>
                                  <input class="form-control" type="text" value="<?= $cod_user ?>" name="emissor" id="emissor" placeholder="" readonly />
                                </div>
                                <div class="divider divider-dark">
                                  <div class="divider-text">Cliente</div>
                                </div>
                                <div class="mb-3">
                                  <label for="codigo_faturamento" class="form-label">Dados: Nome: <?= $nome ?> Cep: <?= $cep ?> Logadouro: <?= $logadouro ?> Uf: <?= $uf ?> Cidade: <?= $cidade ?> </label>
                                  <input class="form-control" type="text" value="<?= $cod_cliente ?>" name="codigo_faturamento" id="codigo_faturamento" placeholder="" readonly />
                                </div>
                              <?php   } ?>
                            </div>
                            <!--Transporte-->
                            <div class="tab-pane fade" id="horizontal-messages">
                              <div class="divider divider-dark">
                                <div class="divider-text">Modalidade do Frete</div>
                              </div>
                              <div class="mb-3">
                                <label for="frete" class="form-label">Modalidade</label>
                                <select class="form-select" name="frete" id="frete" aria-label="Default select example" required>
                                  <?php if (isset($FATURAMENTO)) {
                                    if ($modalidade_frete == 'EMC') {
                                      $modalidade_frete = 'EMC - Entregue em Mãos do Cliente';
                                      $VALL = 1;
                                    }
                                    if ($modalidade_frete == 'COR') {
                                      $modalidade_frete = 'COR - Correios';
                                      $VALL = 2;
                                    }
                                    echo '<option selected value="' . $VALL . '">' . $modalidade_frete . '</option>';
                                  } else { ?>
                                    <option selected>Selecione...</option>
                                  <?php } ?>
                                  <option value="1">EMC - Entregue em Mãos do Cliente</option>
                                  <option value="2">COR - Correios</option>
                                </select>
                              </div>
                              <div class="divider divider-dark">
                                <div class="divider-text">Transportador</div>
                              </div>
                              <div class="mb-3">
                                <label for="transportador" class="form-label">Nome do Transportador</label>
                                <?php if (isset($FATURAMENTO)) {
                                  echo '<input type="text" class="form-control" value="' . $nome_transportador . '" name="transportador" id="transportador" placeholder="Insira o nome" required />';
                                } else { ?>
                                  <input type="text" class="form-control" name="transportador" id="transportador" placeholder="Insira o nome" required />
                                <?php } ?>
                              </div>
                              <div class="divider divider-dark">
                                <div class="divider-text">Pesos e Medidas - Produto</div>
                              </div>
                              <div class="mb-3">
                                <label for="altura" class="form-label">Altura do Produto</label>
                                <input class="form-control" type="text" value="<?= $ALTURA ?>" name="altura" id="altura" placeholder="Em centímetros" readonly />
                              </div>
                              <div class="mb-3">
                                <label for="largura" class="form-label">Largura do Produto</label>
                                <input class="form-control" type="text" value="<?= $LARGURA ?>" name="largura" id="largura" placeholder="Em centímetros" readonly />
                              </div>


                            </div>
                            <!--Observações-->
                            <div class="tab-pane fade" id="horizontal-campos">
                              <div class="col-md">
                                <div>
                                  <label for="obs" class="form-label">Observação</label>
                                  <?php if (isset($FATURAMENTO)) { ?>
                                    <textarea class="form-control" name="obs" id="obs" rows="3"><?= $OBSERVACOES ?></textarea>
                                  <?php } else { ?>
                                    <textarea class="form-control" name="obs" id="obs" rows="3"></textarea>
                                  <?php } ?>
                                </div><br>
                                <div class="demo-inline-spacing">
                                  <?php if (isset($FATURAMENTO) && $status != '12') { ?>
                                    <input type="submit" class="form-control btn btn-danger" name="excluir" id="excluir" value="Excluir">
                                  <?php } else { ?>
                                    <input type="submit" class="form-control btn btn-warning" name="FATURAR" id="gravar" value="Faturar">
                                  <?php } ?>
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
    </div>


    <!--/ Custom content with heading -->
</div>
</div>
</div>
</div>
<?php  } else {
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
         Selecione uma Op nesse painel!    
    </div>
  </div>';
    echo "<script>window.location = '../html/painel.php?Exp=1'</script>";
  } ?>



<?php /* |||   */ include_once("../html/../html/navbar-dow.php"); ?>
<script src="../js/faturamento.js"></script>