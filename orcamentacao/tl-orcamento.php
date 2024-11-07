<style>
  .tira {
    display: none;
  }
</style>

<?php include_once("../html/../html/navbar.php");
$_SESSION["pag"] = array(1, 0);


if (isset($_GET['cod'])) {
  $cod_orcamento = $_GET['cod'];
} else {
  $_SESSION['msg'] = ' <div id="alerta"
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

while ($linha = $configuracoes->fetch(PDO::FETCH_ASSOC)) {
  $preco_chapa = $linha['parametro'];
}
$query_orcamentos = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.`status` = s.CODIGO WHERE cod = $cod_orcamento ");
$query_orcamentos->execute();
$qtdX = 0;
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

  $query_produtos_orcamentos = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento WHERE cod_orcamento = $cod_orcamento ");
  $query_produtos_orcamentos->execute();

  while ($linha_pp = $query_produtos_orcamentos->fetch(PDO::FETCH_ASSOC)) {

    $Produtos_orcamento[$qtdX] = [
      'cod' => $linha_pp['cod'],
      'cod_orcamento' => $linha_pp['cod_orcamento'],
      'tipo_produto' => $linha_pp['tipo_produto'],
      'cod_produto' => $linha_pp['cod_produto'],
      'descricao_produto' => $linha_pp['descricao_produto'],
      'quantidade' => $linha_pp['quantidade'],
      'observacao_produto' => $linha_pp['observacao_produto'],
      'preco_unitario' => $linha_pp['preco_unitario'],
      'valor_digital' => $linha_pp['valor_digital'],
      'tipo_trabalho' => $linha_pp['tipo_trabalho'],
      'maquina' => $linha_pp['maquina'],
      'caminho' => $linha_pp['caminho'],

    ];

    $tipo_produto = $linha_pp['tipo_produto'];
    $cod_produto = $linha_pp['cod_produto'];

    if ($tipo_produto == '1') {
      $query_produto = $conexao->prepare("SELECT * FROM produtos WHERE CODIGO = $cod_produto ");
    }
    if ($tipo_produto == '2') {
      $query_produto = $conexao->prepare("SELECT * FROM produtos_pr_ent WHERE CODIGO = $cod_produto ");
    }
    $query_produto->execute();
    if ($linha_pn = $query_produto->fetch(PDO::FETCH_ASSOC)) {
      $produto_diametro[$qtdX] = [
        'largura' => $linha_pn['LARGURA'],
        'ALTURA' => $linha_pn['ALTURA'],
        'QTD_PAGINAS' => $linha_pn['QTD_PAGINAS'],
        'TIPO' => $linha_pn['TIPO'],
        'DESCRICAO' => $linha_pn['DESCRICAO']
      ];
    }
    $quantiadade = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento  WHERE cod_orcamento = '$cod_orcamento'");
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
    $qtdX++;
  }
  $query_seexistecalculo = $conexao->prepare("SELECT * FROM tabela_calculos_op WHERE cod_proposta = $cod_orcamento AND tipo_produto = $tipo_produto");
  $query_seexistecalculo->execute();
  if ($linhaAA = $query_seexistecalculo->fetch(PDO::FETCH_ASSOC)) {
    $existe_dados = 1;
  }
  if (isset($existe_dados)) {
    $query_calculos_op = $conexao->prepare("SELECT * FROM tabela_calculos_op WHERE cod_proposta = $cod_orcamento AND tipo_produto = $tipo_produto");
  } else {
    $query_calculos_op = $conexao->prepare("SELECT * FROM tabela_calculos_op WHERE cod_proposta = $cod_orcamento AND tipo_produto = $tipo_produto");
  }


  $query_calculos_op->execute();
  while ($linha5 = $query_calculos_op->fetch(PDO::FETCH_ASSOC)) {
    $cod_papels = $linha5['cod_papel'];
    $cod_produtos = $linha5['cod_produto'];

    $calculo_tipo_papel = $linha5['tipo_papel'];
    $qtd_folhas = $linha5['qtd_folhas'];
    $qtd_folhas_total = $linha5['qtd_folhas_total'];
    $qtd_chapas = $linha5['qtd_chapas'];
    $montagem = $linha5['montagem'];
    $formato = $linha5['formato'];
    $perca = $linha5['perca'];
    $Calculo_cod_produtos[$papels] = $cod_produtos;
    $Calculo_calculo_tipo_papel[$papels] = $calculo_tipo_papel;
    $Calculo_qtd_folhas[$papels] = $qtd_folhas;
    $Calculo_qtd_folhas_total[$papels] = $qtd_folhas_total;
    $Calculo_qtd_chapas[$papels] = $qtd_chapas;
    $Calculo_montagem[$papels] = $montagem;
    $Calculo_formato[$papels] = $formato;
    $Calculo_perca[$papels] = $perca;

    $query_orid_orc = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento WHERE tipo_produto = $tipo_produto AND cod_produto = $cod_produtos AND cod_orcamento = $cod_orcamento");
    $query_orid_orc->execute();

    if ($linha14 = $query_orid_orc->fetch(PDO::FETCH_ASSOC)) {
      $quantidade = $linha14['quantidade'];
      $preco_unitario = $linha14['preco_unitario'];
      $total = $quantidade * $preco_unitario;
      $Total_De_cada[$tipo_papel_qtd_loop] = $total;
    }

    $query_papel = $conexao->prepare("SELECT * FROM tabela_papeis_produto WHERE tipo_produto = $tipo_produto AND cod_produto = $cod_produtos AND cod_papel = $cod_papels");
    $query_papel->execute();

    if ($linha3 = $query_papel->fetch(PDO::FETCH_ASSOC)) {
      $tipo_papel = $linha3['tipo_papel'];
      $cod_papel = $linha3['cod_papel'];
      $cor_frente = $linha3['cor_frente'];
      $cor_verso = $linha3['cor_verso'];
      $descricao = $linha3['descricao'];
      $orelha = $linha3['orelha'];
      //     echo 'cor_frente '. $cor_frente . ' cor_verso '. $cor_verso . '<br>';

      $Papel_tipo_papel[$papels] = $calculo_tipo_papel;
      $Papel_cod_papel[$papels] = $cod_papel;
      $Papel_cor_frente[$papels] = $cor_frente;
      $Papel_cor_verso[$papels] = $cor_verso;
      $Papel_descricao[$papels] = $descricao;
      $Papel_orelha[$papels] = $orelha;

      $query_do_papel = $conexao->prepare("SELECT * FROM tabela_papeis WHERE cod = $cod_papels  ");
      $query_do_papel->execute();
      if ($linha4 = $query_do_papel->fetch(PDO::FETCH_ASSOC)) {
        $cod_papels = $linha4['cod'];
        $descricao_do_papel = $linha4['descricao'];
        $medida = $linha4['medida'];
        $gramatura = $linha4['gramatura'];
        $formato = $linha4['formato'];
        $uma_face = $linha4['uma_face'];
        $unitario = $linha4['unitario'];
        //    echo 'cod_papels '. $cod_papels . ' - '. $calculo_tipo_papel . '<br>';
        $Do_Papel_cod[$tipo_papel_qtd_loop] = $cod_papels;
        $Do_Papel_descricao_do_papel[$tipo_papel_qtd_loop] = $descricao_do_papel;
        $Do_Papel_midida[$tipo_papel_qtd_loop] = $medida;
        $Do_Papel_gramatura[$tipo_papel_qtd_loop] = $gramatura;
        $Do_Papel_formato[$tipo_papel_qtd_loop] = $formato;
        $Do_Papel_uma_face[$tipo_papel_qtd_loop] = $uma_face;
        $Do_Papel_unitario[$tipo_papel_qtd_loop] = $unitario;
        $tipo_papel_qtd_loop++;
      }
    }
    $query_componente = $conexao->prepare("SELECT * FROM tabela_componentes_produto WHERE tipo_produto = $tipo_produto AND cod_produto = $cod_produtos  ");
    $query_componente->execute();
    while ($linha12 = $query_componente->fetch(PDO::FETCH_ASSOC)) {
      $cod_acabamento = $linha12['cod_acabamento'];

      $query_acabamento = $conexao->prepare("SELECT * FROM acabamentos WHERE CODIGO = $cod_acabamento  ");
      $query_acabamento->execute();
      if ($linha13 = $query_acabamento->fetch(PDO::FETCH_ASSOC)) {

        $cod_acb = $linha13['CODIGO'];
        $Maquina = $linha13['MAQUINA'];
        $ATIVA = $linha13['ATIVA'];
        $CUSTO_HORA = $linha13['CUSTO_HORA'];
        $Do_Acabamento_cod_produtos[$qtd_acabamentos] = $cod_produtos;
        $Do_Acabamento_cod[$qtd_acabamentos] = $cod_acb;
        $Do_Acabamento_Maquina[$qtd_acabamentos] = $Maquina;
        $Do_Acabamento_midida[$qtd_acabamentos] = $ATIVA;
        $Do_Acabamento_CUSTO_HORA[$qtd_acabamentos] = $CUSTO_HORA;
        $qtd_acabamentos++;
      }
    }
    $papels++;
  }
  $query_componente_orc = $conexao->prepare("SELECT * FROM tabela_componentes_orcamentos WHERE cod_orcamento = $cod_orcamento   ");
  $query_componente_orc->execute();
  $Servico_N = true;
  while ($linha88 = $query_componente_orc->fetch(PDO::FETCH_ASSOC)) {
    $cod_componente_1 = $linha88['cod_componente_1'];
    $query_servicos = $conexao->prepare("SELECT * FROM tabela_servicos_orcamento WHERE cod = $cod_componente_1  ");
    $query_servicos->execute();
    if ($linha89 = $query_servicos->fetch(PDO::FETCH_ASSOC)) {
      $cod_servicoes = $linha89['cod'];
      $descricao_servicoes = $linha89['descricao'];
      $vlr_unitar = $linha89['valor_unitario'];
      $Do_servico_cod[$servicos] = $cod_servicoes;
      $Do_servico_vlr[$servicos] = $vlr_unitar;
      $Do_servico_descricao[$servicos] = $descricao_servicoes;
      $servicos++;
    }
    if (!isset($Do_servico_cod[0])) {
      $Servico_N = 'NENHUM SELECIONADO';
    }
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
                    <?php if (isset($_SESSION['msg'])) {
                      echo $_SESSION['msg'];
                      unset($_SESSION['msg']);
                    } ?>
                    <div class="mb-3 row">
                      <label for="html5-date-input" class="col-md-2 col-form-label">Status</label>

                      <div class="col-md-10">
                        <?php if ($ORC_ADM_I == '1') {  ?> <form method="POST" action="saveobs.php"> <?php } ?>
                          <input type="hidden" name="cod" value="<?= $cod_orcamento ?>">
                          <select name="Status_selecionado" class="form-select">
                            <option>
                              <?= $Orcamento_pesquisa['status'] ?> -
                              <?= $Orcamento_pesquisa['STS_DESCRICAO'] ?>
                            </option>
                            <?php for ($i = 0; $i < $Sts; $i++) {
                              echo '<option value="' . $Codigo_Sts_P[$i] . '" >' . $Codigo_Sts_P[$i] . ' - ' . $Nome_Sts_P[$i] . '</option>';
                            } ?>

                          </select>
                          <?php if ($ORC_ADM_I == '1') { ?> <button type="submit" name="alterar_status" style="color: aliceblue;" class="btn rounded-pill btn-warning">ALTERAR</button>
                          </form>
                        <?php } ?>
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
                            <a href="b-update.php?acao=6&cod=<?= $cod_orcamento ?>" class="btn btn-danger">
                              <iconify-icon icon="mdi:close-circle-outline" width="24" height="24"></iconify-icon>
                              <br>Não
                              aprovado pelo cliente
                            </a>
                          <?php } else { ?>
                            <a class="btn btn-danger">
                              <iconify-icon icon="mdi:close-circle-outline" width="24" height="24"></iconify-icon>
                              <br>Não
                              aprovado pelo cliente
                            </a>
                          <?php } ?>
                        </div>
                        <div class="row mb-3  ">
                          <?php if ($Orcamento_pesquisa['status'] == 1 || $Orcamento_pesquisa['status'] == 2 || $Orcamento_pesquisa['status'] == 3) { ?>
                            <a href="b-update.php?acao=13&cod=<?= $cod_orcamento ?>" class="btn btn-danger">
                              <iconify-icon icon="material-symbols:delete-outline-sharp" width="24" height="24">
                              </iconify-icon><br> Excluir
                            </a>
                          <?php } else { ?>
                            <a class="btn btn-danger">
                              <iconify-icon icon="material-symbols:delete-outline-sharp" width="24" height="24">
                              </iconify-icon><br> Excluir
                            </a>
                          <?php } ?>
                        </div>
                        <!-- <div class="row mb-3">
                            <a class="btn btn-warning"><iconify-icon icon="material-symbols:edit-outline-rounded" width="24" height="24"></iconify-icon><br>Editar</a>
                          </div> -->

                      </div>
                      <div class="col-3  ">
                        <div class=" mb-3 ">
                        <a class="btn btn-warning">
                          <iconify-icon icon="fluent:production-20-regular" width="24" height="24"></iconify-icon><br>
                          Enviar para Produção
                        </a>
                      </div>
                      <div class=" mb-3 ">
                          <?php if ($Orcamento_pesquisa['status'] == 1 || $Orcamento_pesquisa['status'] == 3 || $Orcamento_pesquisa['status'] == 11 || $Orcamento_pesquisa['status'] == 4) {
                            if ($Orcamento_pesquisa['valor_total'] <= $Tabela_Clientes['credito']) { ?>
                              <a data-bs-toggle="modal" style="color: white;" data-bs-target="#paprod" class="btn btn-warning">
                                <iconify-icon icon="fluent:production-20-regular" width="24" height="24"></iconify-icon><br>
                                Enviar para Produção
                              </a>
                        </div>
                        <div class=" mb-3">
                          <a data-bs-toggle="modal" style="color: white;" data-bs-target="#paraexp" class="btn btn-warning">
                            <iconify-icon icon="fluent-mdl2:product" width="24" height="24"></iconify-icon><br> Enviar
                            para Expedição
                          </a>
                        </div>
                        <?php } else {
                              if ($Orcamento_pesquisa['status'] == '4' || $Orcamento_pesquisa['status'] == '11') { ?>
                          <a data-bs-toggle="modal" style="color: white;" data-bs-target="#paprod" class="btn btn-warning">
                            <iconify-icon icon="fluent:production-20-regular" width="24" height="24"></iconify-icon><br>
                            Enviar para Produção
                          </a>
                      </div>
                      <div class=" mb-3">
                        <a data-bs-toggle="modal" style="color: white;" data-bs-target="#paraexp" class="btn btn-warning">
                          <iconify-icon icon="fluent-mdl2:product" width="24" height="24"></iconify-icon><br> Enviar
                          para Expedição
                        </a>
                      </div>
                      <?php } else {
                                if ($Orcamento_pesquisa['status'] == '3') {
                                  echo '</div>';
                                } else { ?>

                        <a href="b-update.php?acao=3&cod=<?= $cod_orcamento ?>" class="btn btn-warning">
                          <iconify-icon icon="mdi:file-send-outline" width="24" height="24"></iconify-icon><br>
                          <span>Saldo insuficiente!</span><br> Enviar o ordenador de despesa
                        </a>
                    </div>

                <?php }
                              }
                            }
                          } else {
                            if ($Orcamento_pesquisa['status'] == '5' || $Orcamento_pesquisa['status'] == '6' || $Orcamento_pesquisa['status'] == '12' || $Orcamento_pesquisa['status'] == '13' || $Orcamento_pesquisa['status'] == '14' || $Orcamento_pesquisa['status'] == '15') {
                              if ($ORC_ADM_I == '1') {
                                echo '<a id="resetar" style="color: white;"
                              class="btn btn-warning">
                              <iconify-icon icon="carbon:reset" width="24" height="24"></iconify-icon><br> Voltar para em Avaliação!
                            </a> </div>';
                              }
                            } else { ?>
                <a class="btn btn-warning">
                  <iconify-icon icon="fluent:production-20-regular" width="24" height="24"></iconify-icon><br>
                  Enviar para Produção
                </a>
                  </div>
                  <div class=" mb-3">
                    <a class="btn btn-warning">
                      <iconify-icon icon="fluent-mdl2:product" width="24" height="24"></iconify-icon><br> Enviar para
                      Expedição
                    </a>
                  </div>
              <?php }
                          } ?>

                </div>

                <?php if ($ORD_I == 1) { ?>
                  <div class="col-3" id="<?= $od ?>">

                    <div class="row mb-3 ">
                      <a id="odA" class="btn btn-danger ">
                        <iconify-icon icon="material-symbols:check-circle-outline-rounded" width="24" height="24">
                        </iconify-icon><br> (OD) AUTORIZAR PRODUÇÃO
                      </a>
                    </div>

                    <div class="row mb-3">
                      <a id="odN" class="btn btn-danger ">
                        <iconify-icon icon="mdi:close-circle-outline" width="24" height="24"></iconify-icon><br> (OD)
                        NEGAR PRODUÇÃO
                      </a>
                    </div>
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <input type="radio" name="tipo" id="grafica" value="1"> <label for="grafica">OD- Grafica</label>

                      </div>

                      <div class="col-sm-6">
                        <input type="radio" name="tipo" id="cliente" value="2"> <label for="cliente">OD -
                          Cliente</label>
                      </div>

                    <?php } ?>
                    </div>



                  </div>
                  <div class=" mb-3">
                    <div id="simpleszao" class="">
                      <a class="btn btn-warning" target="_blank" href="../relatorios/relatorio-orcamento-unico.php?cod=<?= $cod_orcamento ?>&Tp=1" style="color: white;">
                        <iconify-icon icon="codicon:file-pdf" width="24" height="24"></iconify-icon><br> GERAR RELATÓRIO
                        <br> SIMPLES
                      </a>
                    </div>
                    <div id="detalhadao" class="tira">
                      <a class="btn btn-warning" target="_blank" href="../relatorios/relatorio-orcamento-unico.php?cod=<?= $cod_orcamento ?>&Tp=2" style="color: white;">
                        <iconify-icon icon="codicon:file-pdf" width="24" height="24"></iconify-icon><br> GERAR RELATÓRIO
                        <br> DETALHADO
                      </a>
                    </div>
                    <div id="selects">
                      <div class="col-sm-6">
                        <input type="radio" name="detalhe" id="SIMPLES" value="1" checked> <label for="SIMPLES">SIMPLES</label>
                      </div>
                      <div class="col-sm-6">
                        <input type="radio" name="detalhe" id="DETALHADO" value="2"> <label for="DETALHADO">DETALHADO</label>
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
<?php include_once('modal-enviarop.php'); ?>

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
                        <div class="row">
                          <div class="col-6">
                            <input class="form-control " type="date" name="data" value="<?= $Orcamento_pesquisa['data_validade'] ?>" />
                          </div>
                          <div class="col-6">
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#smallModal">
                              Atualizar Data
                            </button>
                          </div>
                        </div>
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

                                <h6 class="align-items-center justify-content-center align-text-center">Certeza que
                                  deseja atualizar a data de validade? <br><br> <b>O Staus da Op mudara para 1 - EM AVALIAÇÃO</b></h6>

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
              <a class="list-group-item list-group-item-action" id="settings-list-item3" data-bs-toggle="list" href="#horizontal-pap">Papel</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item4" data-bs-toggle="list" href="#horizontal-aca">Acabamentos</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item5" data-bs-toggle="list" href="#horizontal-ser">Serviços</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item6" data-bs-toggle="list" href="#horizontal-obs">Observações</a>
            </div>
            <div class="tab-content px-0 mt-0">
              <div class="tab-pane fade show active" id="horizontal-prod">
                <div class="card">
                  <!-- <h5 class="card-header">PRODUTOS <button type="button" class="btn btn-outline-primary"
                      data-bs-toggle="modal" data-bs-target="#modal1">
                      Selecionar um Produto
                    </button> </h5> -->

                  <div class="table-responsive text-nowrap">
                    <table id="TabelaProdutosOrcamento" class="table table-striped">
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
                      <?php $_SESSION['processed'] = false; ?>
                          <form method="POST" action="abrir_orcamento.php">
                            <input type="hidden" value="<?= $cod_orcamento ?>" name="Cod_Orcamento">
                            <input type="hidden" id="produtos_orc_edit" name="produtos">
                            <input type="hidden" id="ttipo_produto" value="<?=  $tipo_produto ?>" name="ttipo_produto">
                            <button class="btn btn-outline-success" type="submit" onclick="coletarCodigos()">Editar</button>
                          </form>
                        <tbody class="table-border-bottom-0">
                        <?php
                        for ($a = 0; $a < $qtdX; $a++) { ?>
                          <tr>
                            <td>
                              <?= $Produtos_orcamento[$a]['cod_produto'] ?>
                            </td>
                            <td>
                              <?= $produto_diametro[$a]['DESCRICAO'] ?>
                            </td>
                            <td>
                              <?= $produto_diametro[$a]['largura'] ?>
                            </td>
                            <td>
                              <?= $produto_diametro[$a]['ALTURA'] ?>
                            </td>
                            <td>
                              <?= $produto_diametro[$a]['QTD_PAGINAS'] ?>
                            </td>
                            <td>
                              <?= $Produtos_orcamento[$a]['observacao_produto'] ?>
                            </td>
                          </tr>
                        <?php }
                        if ($qtdX == 0) {
                          echo '
                        <tr> 
                          <td align="center" colspan="12">NENHUM SELECIONADO</td>';
                        } ?>

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
                        <?php
                        for ($a = 0; $a < $qtdX; $a++) { ?>
                          <tr>
                            <td>
                              <?= $Produtos_orcamento[$a]['cod_produto'] ?>
                            </td>
                            <td>
                              <?= $Produtos_orcamento[$a]['quantidade'] ?>
                            </td>
                            <?php if ($Produtos_orcamento[$a]['tipo_produto'] == '1') { ?>
                              <td><input class="form-check-input" type="checkbox" value="" id="defaultCheck3" checked="">
                              </td>
                            <?php } else { ?>
                              <td><input class="form-check-input" type="checkbox"></td>
                            <?php }
                            if ($Produtos_orcamento[$a]['tipo_produto'] == '2') { ?>
                              <td><input class="form-check-input" type="checkbox" value="" id="defaultCheck3" checked="">
                              </td>
                            <?php } else { ?>
                              <td><input class="form-check-input" type="checkbox"></td>
                            <?php } ?>

                            <td><input class="form-control" value="<?= $Produtos_orcamento[$a]['valor_digital'] ?>" type="number"></td>
                            <td><input class="form-control" value="<?= $Produtos_orcamento[$a]['preco_unitario'] ?>" type="number"></td>
                          </tr>
                        <?php }
                        if ($qtdX == 0) {
                          echo '
                        <tr> 
                          <td align="center" colspan="12">NENHUM SELECIONADO</td>';
                        } ?>

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
                        <?php for ($a = 0; $a < $tipo_papel_qtd_loop; $a++) {
                          echo '
                        <tr> 
                          <td>' . $Calculo_cod_produtos[$a] . '</td>
                          <td>' . $Papel_cod_papel[$a] . '</td>
                          <td>' . $Papel_descricao[$a] . '</td>
                          <td>' . $Calculo_calculo_tipo_papel[$a] . '</td>
                          <td>' . $Papel_cor_frente[$a] . '</td>
                          <td>' . $Papel_cor_verso[$a] . '</td>
                          <td><input class="form-control" value="' . $Calculo_formato[$a] . '" type="number"></td>
                          <td><input class="form-control" value="' . $Calculo_perca[$a] . '" type="number"></td>
                          <td><input class="form-control" value="' . $Calculo_qtd_folhas_total[$a] . '" type="number"></td>
                          <td>' . $Do_Papel_unitario[$a] . '</td>
                          <td><input class="form-control" value="' . $Calculo_qtd_chapas[$a] . '" type="number"></td>
                          <td>' . $preco_chapa . '</td>
                        </tr>';
                        }
                        if ($tipo_papel_qtd_loop == 0) {
                          echo '
                        <tr> 
                          <td align="center" colspan="12">NENHUM SELECIONADO</td>';
                        }
                        ?>

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
                        <?php $exibidos = [];

                        for ($i = 0; $i < $qtd_acabamentos; $i++) {
                          // Verifica se o valor já foi exibido anteriormente
                          $valor_exibido = implode('-', [$Do_Acabamento_cod_produtos[$i], $Do_Acabamento_cod[$i]]);
                          if (in_array($valor_exibido, $exibidos)) {
                            continue;
                          }

                          // Adiciona o valor ao array de valores exibidos
                          $exibidos[] = $valor_exibido;

                          // Exibe o valor
                          echo '
                              <tr>
                                  <td>' . $Do_Acabamento_cod_produtos[$i] . '</td>
                                  <td>' . $Do_Acabamento_cod[$i] . '</td>
                                  <td>' . $Do_Acabamento_Maquina[$i] . '</td>
                                  <td>' . $Do_Acabamento_CUSTO_HORA[$i] . '</td>
                              </tr>
                          ';
                        }
                        if ($qtd_acabamentos == 0) {
                          echo '
                        <tr> 
                          <td align="center" colspan="12">NENHUM SELECIONADO</td>';
                        }
                        ?>


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
                          <form method="POST" action="saveobs.php">
                            <textarea class="form-control" placeholder="Coloque uma Observação" name="observacao_orc" class="col-12"><?= $Orcamento_pesquisa['descricao'] ?></textarea>
                            <input type="hidden" name="cod" value="<?= $cod_orcamento ?>">
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
                        <?php
                        if ($servicos > 0) {
                          for ($i = 0; $i < $servicos; $i++) {
                            echo '<tr>
          <td>' . $Do_servico_cod[$i] . '</td>
          <td> ' . $Do_servico_descricao[$i] . '</td>
          <td> ' . $Do_servico_vlr[$i] . '</td>
          </tr>';
                          }
                        } else {
                          echo '<tr><td colspan="3" align="center">NENHUM SELECIONADO</td></tr>';
                        }
                        ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="container row ">
              <div class="col-3">
                <label class="form-label m-0 p-0">CIF (%)</label>
                <input type="text" class="form-control" id="defaultFormControlInput" value="<?= $Orcamento_pesquisa['sif'] ?>" placeholder="0%" aria-describedby="defaultFormControlHelp" />

              </div>
              <div class="col-3">
                <label for="valor" class="form-label p-0 m-0">Arte (R$)</label>

                <input class="form-check-input mt-0" id="arte" type="checkbox" aria-label="checkbox button for following text input" />

                <input type="text" class="form-control" id="check_arte" placeholder="R$ 00,00" value="<?= $Orcamento_pesquisa['ARTE'] ?>" disabled aria-label="Text input with checkbox button" />

              </div>

              <div class="col-3">
                <label for="frete" class="form-label p-0 m-0">Frete (R$)</label>

                <input class="form-check-input mt-0" type="checkbox" id="frete" aria-label="checkbox button for following text input" />

                <input type="text" class="form-control" id="check_frete" placeholder="R$ 00,00" value="<?= $Orcamento_pesquisa['frete'] ?>" disabled aria-label="Text input with radio button" />

              </div>



              <div class="col-3">
                <label class="form-label m-0 p-0">Desconto (%)</label>
                <input type="text" class="form-control" id="defaultFormControlInput" placeholder="0%" value="<?= $Orcamento_pesquisa['desconto'] ?>" aria-describedby="defaultFormControlHelp" />

              </div>

            </div>
            <label for="defaultFormControlInput" class="form-label">Valor Total (R$)</label>
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Valor do orçamento final" value="<?= $Orcamento_pesquisa['valor_total'] ?>" aria-describedby="defaultFormControlHelp" /><br></br>
            <!-- <button type="button" class="btn btn-info">Tabela de Corte de Papel</button> -->
            <button type="submit" class="btn btn-success">Salvar</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>





  <!-- Inicializa o Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


  <script>
    const busca = document.getElementById('buscarP');
    const pesquisarpor = document.getElementById('pesquisarpor');
    const pesquisar = document.getElementById('pesquisar');
    const mensagemBusca = document.getElementById('mensagemBusca');
    const mensagemPesquisa = document.getElementById('mensagemPesquisa');
    let TipoProdutoSelect = 'PP';

    pesquisarpor.addEventListener('click', vlr => {
      if (pesquisarpor.value === 'codigo') {
        busca.type = 'number';
        busca.placeholder = 'DIGITE O CÓDIGO DO PRODUTO';
      } else {
        busca.type = 'text';
        busca.placeholder = 'DIGITE A DESCIÇÃO DO PRODUTO';
      }
    });

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
                      <td><input type="checkbox" value="${produto.CODIGO}" name="Produto${produto.CODIGO}"  ></td>
                    </tr>`;
        });
      } else {
        tableBody.innerHTML += `
                    <tr>
                      <td>${dados[0].CODIGO}</td>
                      <td>${dados[0].TIPO}</td>
                      <td>${dados[0].DESCRICAO}</td>
                      <td>${dados[0].VALOR_UNITARIO}</td>
                      <td><input type="checkbox" value="${dados[0].CODIGO}" name="Produto${dados[0].CODIGO}"  ></td>
                    </tr>`;
      }

    }

    // editar 
    function coletarCodigos() {
  // Seleciona a tabela
  var tabela = document.getElementById("TabelaProdutosOrcamento");
  
  // Seleciona todas as linhas do corpo da tabela
  var linhas = tabela.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
  
  // Array para armazenar os códigos
  var codigos = [];
  
  // Itera por todas as linhas
  for (var i = 0; i < linhas.length; i++) {
    // Seleciona a primeira célula (primeiro <td>) de cada linha
    var primeiraCelula = linhas[i].getElementsByTagName("td")[0];
    
    // Adiciona o texto da célula ao array de códigos
    codigos.push(primeiraCelula.textContent.trim());
  }
  
  // Junta os códigos em uma string separada por vírgulas
  var codigosString = codigos.join(',');
  console.log(codigosString)
  // Coloca a string de códigos no valor do input com id="produtos_orc_edit"
  document.getElementById("produtos_orc_edit").value = codigosString;
}

// Chama a função para executar a coleta dos códigos



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

        // adiciona listener de eventos às mudanças nos inputs de rádio
        ppRadio.addEventListener('change', function() {
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
        <td><input type="checkbox" value="${produto.CODIGO}" name="Produto${produto.CODIGO}"  ></td>
      </tr>
    `;
          });
        });

        peRadio.addEventListener('change', function() {
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
        <td><input type="checkbox" value="${produto.CODIGO}" name="Produto${produto.CODIGO}"  ></td>
      </tr>
    `;
          });
        });
        if (ativo_pp === 'Nao') {
          const tableBody = document.getElementById('produtosTableBody');
          tableBody.innerHTML = '';
          pp.forEach(produto => {
            tableBody.innerHTML += `
      <tr>
        <td>${produto.CODIGO}</td>
        <td>${produto.TIPO}</td>
        <td>${produto.DESCRICAO}</td>
        <td>${produto.VALOR_UNITARIO}</td>
        <td><input type="checkbox" value="${produto.CODIGO}" name="Produto${produto.CODIGO}"  ></td>
      </tr>
    `;
          });
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
    frete.addEventListener('click', arr => {
      if (check_frete.disabled === false) {
        check_frete.disabled = true;
      } else {
        check_frete.disabled = false;
      }
    })
    arte.addEventListener('click', arr => {
      if (check_arte.disabled === false) {
        check_arte.disabled = true;
      } else {
        check_arte.disabled = false;
      }
    })
  </script>

  <script>
    const cod_orc = document.getElementById('cod_orc_')
    const grafica = document.getElementById("grafica");
    const cliente = document.getElementById("cliente");
    const grafica1 = document.getElementById("odN");
    const cliente1 = document.getElementById("odA");
    const od = document.getElementById('off');
    if (document.getElementById('resetar')) {
      const resatura = document.getElementById('resetar');
      resatura.href = 'b-update.php?acao=9&cod=' + cod_orc.value + '';
    }
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

  <script>
    const selects = document.getElementById('selects');
    const simpleszao = document.getElementById('simpleszao');
    const detalhadao = document.getElementById('detalhadao');
    const SIMPLES = document.getElementById('SIMPLES');
    const DETALHADO = document.getElementById('DETALHADO');

    SIMPLES.addEventListener('click', vlr => {
      simpleszao.classList.remove('tira');
      detalhadao.classList.add('tira');
    })
    DETALHADO.addEventListener('click', vlr => {
      detalhadao.classList.remove('tira');
      simpleszao.classList.add('tira');
    })

    
  </script>








  <?php include_once("../html/../html/navbar-dow.php"); ?>