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

  while($linha_pp = $query_produtos_orcamentos->fetch(PDO::FETCH_ASSOC)) {


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

    $query_papel = $conexao->prepare("SELECT * FROM tabela_papeis_produto WHERE tipo_produto = $tipo_produto AND cod_produto = $cod_produtos AND cod_papel = $cod_papels AND tipo_papel = '$calculo_tipo_papel' ");
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
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne5"
              aria-expanded="true" aria-controls="accordionOne5">
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
                          <option>
                            <?= $Orcamento_pesquisa['status'] ?> -
                            <?= $Orcamento_pesquisa['STS_DESCRICAO'] ?>
                          </option>
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
                            <a href="b-update.php?acao=6&cod=<?= $cod_orcamento ?>" class="btn btn-danger">
                              <iconify-icon icon="mdi:close-circle-outline" width="24" height="24"></iconify-icon> <br>Não
                              aprovado pelo cliente
                            </a>
                          <?php } else { ?>
                            <a class="btn btn-danger">
                              <iconify-icon icon="mdi:close-circle-outline" width="24" height="24"></iconify-icon> <br>Não
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
                          <?php if ($Orcamento_pesquisa['status'] == 1 || $Orcamento_pesquisa['status'] == 3 || $Orcamento_pesquisa['status'] == 11 || $Orcamento_pesquisa['status'] == 4) {
                            if ($Orcamento_pesquisa['valor_total'] <= $Tabela_Clientes['credito']) { ?>
                              <a data-bs-toggle="modal" style="color: white;" data-bs-target="#paprod"
                                class="btn btn-warning">
                                <iconify-icon icon="fluent:production-20-regular" width="24" height="24"></iconify-icon><br>
                                Enviar para Produção
                              </a>
                            </div>
                            <div class=" mb-3">
                              <a data-bs-toggle="modal" style="color: white;" data-bs-target="#paraexp"
                                class="btn btn-warning">
                                <iconify-icon icon="fluent-mdl2:product" width="24" height="24"></iconify-icon><br> Enviar
                                para Expedição
                              </a>
                            </div>
                          <?php } else {
                              if ($Orcamento_pesquisa['status'] == '4' || $Orcamento_pesquisa['status'] == '11') { ?>
                              <a data-bs-toggle="modal" style="color: white;" data-bs-target="#paprod"
                                class="btn btn-warning">
                                <iconify-icon icon="fluent:production-20-regular" width="24" height="24"></iconify-icon><br>
                                Enviar para Produção
                              </a>
                            </div>
                            <div class=" mb-3">
                              <a data-bs-toggle="modal" style="color: white;" data-bs-target="#paraexp"
                                class="btn btn-warning">
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
                              echo ' </div>';
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
                        <input type="radio" name="tipo" id="cliente" value="2"> <label for="cliente">OD - Cliente</label>
                      </div>

                    <?php } ?>
                  </div>



                </div>
                <div class=" mb-3">
                  <div id="simpleszao" class="">
                    <a class="btn btn-warning" target="_blank"
                      href="../relatorios/relatorio-orcamento-unico.php?cod=<?= $cod_orcamento ?>&Tp=1"
                      style="color: white;">
                      <iconify-icon icon="codicon:file-pdf" width="24" height="24"></iconify-icon><br> GERAR RELATÓRIO
                      <br> SIMPLES
                    </a>
                  </div>
                  <div id="detalhadao" class="tira">
                    <a class="btn btn-warning" target="_blank"
                      href="../relatorios/relatorio-orcamento-unico.php?cod=<?= $cod_orcamento ?>&Tp=2"
                      style="color: white;">
                      <iconify-icon icon="codicon:file-pdf" width="24" height="24"></iconify-icon><br> GERAR RELATÓRIO
                      <br> DETALHADO
                    </a>
                  </div>
                  <div id="selects">
                    <div class="col-sm-6">
                      <input type="radio" name="detalhe" id="SIMPLES" value="1" checked> <label
                        for="SIMPLES">SIMPLES</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="radio" name="detalhe" id="DETALHADO" value="2"> <label
                        for="DETALHADO">DETALHADO</label>
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
<!--  -->
<div class="col-md mb-4 mb-md-0">
  <div class="accordion mt-3" id="accordionExample">
    <div class="card accordion-item active">
      <h2 class="accordion-header" id="headingOne">
        <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne"
          aria-expanded="true" aria-controls="accordionOne">
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
                      <input type="text" id="cod_orc_" class="cod_orc_ form-control" value="<?= $cod_orcamento ?>"
                        disabled />
                    </div>
                    <br>
                  </div>
                  <label for="html5-date-input" class="col-md-2 col-form-label">Data de Validade</label>
                  <div class="col-md-10">
                    <div class="input-group">
                      <form method="GET" action="b-update.php">
                        <input type="hidden" name="cod" value="<?= $cod_orcamento ?>">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                          data-bs-target="#smallModal">
                          Atualizar Data
                        </button>
                        <input class="form-control " type="date" name="data"
                          value="<?= $Orcamento_pesquisa['data_validade'] ?>" />
                        <!--  -->
                        <!-- Small Modal -->
                        <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                              <div class="modal-header  ">
                                <h5 class="modal-title align-items-center justify-content-center"
                                  id="exampleModalLabel2">Atualizar Data de validade do Orçamento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body align-items-center justify-content-center">

                                <h6 class="align-items-center justify-content-center align-text-center">Certeza que
                                  deseja atualizar a data de validade?</h6>

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
                        <input type="text" class="form-control" id="basic-default-name" value="<?= $cliente ?>"
                          placeholder="Fisicou ou Juridica" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">Código do Cliente</label>
                      <div class="col-sm-10">
                        <input type="text" value="<?= $Pesquisa_Cliente ?>" class="form-control"
                          id="basic-default-company" placeholder="" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">Nome do Cliente</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $Tabela_Clientes['nome'] ?>"
                          id="basic-default-company" placeholder="" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">CPF/CNPJ</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $documento ?>" id="basic-default-company"
                          placeholder="" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">Nome p/ Contato</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $Cliente_Contato_Puxado['nome_contato'] ?>"
                          id="basic-default-company" placeholder="" />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">

                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">Telefone Principal</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $Cliente_Contato_Puxado['telefone'] ?>"
                          id="basic-default-company" placeholder="" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">Cidade</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $Cliente_Enderecos_Puxado['cidade'] ?>"
                          id="basic-default-company" placeholder="" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">UF</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $Cliente_Enderecos_Puxado['uf'] ?>"
                          id="basic-default-company" placeholder="" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">Crédito</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control"
                          value="<?= number_format($Tabela_Clientes['credito'], 2, ',', '.') ?>"
                          id="basic-default-company" placeholder="" />
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
      <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionTwo"
        aria-expanded="true" aria-controls="accordionTwo">
        Informações Sobre o Orçamento
      </button>
    </h2>
    <div id="accordionTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"
      data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <div class="col-lg-12">
          <div class="demo-inline-spacing mt-3">
            <div class="list-group list-group-horizontal-md text-md-center">
              <a class="list-group-item list-group-item-action active" id="home-list-item" data-bs-toggle="list"
                href="#horizontal-prod">Produtos</a>
              <a class="list-group-item list-group-item-action" id="profile-list-item1" data-bs-toggle="list"
                href="#horizontal-tir">Tiragens</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item3" data-bs-toggle="list"
                href="#horizontal-pap">Papel</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item4" data-bs-toggle="list"
                href="#horizontal-aca">Acabamentos</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item5" data-bs-toggle="list"
                href="#horizontal-ser">Serviços</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item6" data-bs-toggle="list"
                href="#horizontal-obs">Observações</a>
            </div>
            <div class="tab-content px-0 mt-0">
              <div class="tab-pane fade show active" id="horizontal-prod">
                <div class="card">
                  <h5 class="card-header">PRODUTOS <button type="button" class="btn btn-outline-primary"
                      data-bs-toggle="modal" data-bs-target="#modal1">
                      Selecionar um Produto
                    </button> </h5>

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
                        <?php 
                        for ($a = 0; $a < $qtdX; $a++) { ?>
                          <tr>
                            <td>
                              <?= $Produtos_orcamento[$a]['cod'] ?>
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
                        <?php } ?>

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
                            <?= $Produtos_orcamento[$a]['cod'] ?>
                          </td>
                          <td>
                            <?= $Produtos_orcamento[$a]['quantidade'] ?>
                          </td>
                          <?php if($Produtos_orcamento[$a]['tipo_produto'] == '1'){ ?>
                          <td><input class="form-check-input" type="checkbox" value="" id="defaultCheck3" checked=""></td>
                          <?php }else{ ?>
                           <td><input class="form-check-input" type="checkbox"></td>
                          <?php } if($Produtos_orcamento[$a]['tipo_produto'] == '2'){ ?>
                          <td><input class="form-check-input" type="checkbox" value="" id="defaultCheck3" checked=""></td>
                          <?php }else{ ?>
                          <td><input class="form-check-input" type="checkbox"></td>
                          <?php } ?>
                         
                          <td><input class="form-control" value="<?= $Produtos_orcamento[$a]['valor_digital'] ?>"
                              type="number"></td>
                          <td><input class="form-control" value="<?= $Produtos_orcamento[$a]['preco_unitario'] ?>"
                              type="number"></td>
                        </tr>
                          <?php } ?>

                    </table>
                  </div>
                </div>
              </div>
              <!-- <div class="tab-pane fade" id="horizontal-impr">
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
              </div> -->
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
                          <td>'.$preco_chapa.'</td>
                        </tr>';
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
                            <textarea class="form-control" placeholder="Coloque uma Observação" name="observacao_orc"
                              class="col-12"><?= $Orcamento_pesquisa['descricao'] ?></textarea>
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
          <td> '.$Do_servico_vlr[$i].'</td>
          </tr>';
      }
      } else {
          echo '<tr><td rowspan="3" align="center">NENHUM SELECIONADO</td></tr>';
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
                <input type="text" class="form-control" id="defaultFormControlInput" value="<?= $Orcamento_pesquisa['sif'] ?>" placeholder="0%"
                  aria-describedby="defaultFormControlHelp" />

              </div>
              <div class="col-3">
                <label for="valor" class="form-label p-0 m-0">Arte (R$)</label>

                <input class="form-check-input mt-0" type="checkbox" id="valor"
                  aria-label="checkbox button for following text input" />

                <input type="text" class="form-control" placeholder="R$ 00,00"
                 value="<?= $Orcamento_pesquisa['ARTE'] ?>" aria-label="Text input with checkbox button" />

              </div>

              <div class="col-3">
                <label for="frete" class="form-label p-0 m-0">Frete (R$)</label>

                <input class="form-check-input mt-0" type="checkbox" id="frete" 
                  aria-label="checkbox button for following text input" />

                <input type="text" class="form-control" placeholder="R$ 00,00"
                  value="<?= $Orcamento_pesquisa['frete'] ?>" aria-label="Text input with radio button" />

              </div>

              <div class="col-3">
                <label class="form-label m-0 p-0">Desconto (%)</label>
                <input type="text" class="form-control" id="defaultFormControlInput" placeholder="0%"
                  value="<?= $Orcamento_pesquisa['desconto'] ?>" aria-describedby="defaultFormControlHelp" />

              </div>

            </div>
            <label for="defaultFormControlInput" class="form-label">Valor Total (R$)</label>
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Valor do orçamento final"
              value="<?= $Orcamento_pesquisa['valor_total'] ?>" aria-describedby="defaultFormControlHelp" /><br></br>
            <!-- <button type="button" class="btn btn-info">Tabela de Corte de Papel</button> -->
            <button type="submit" class="btn btn-success">Salvar</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Botão para abrir o primeiro modal -->


  <!-- Primeiro modal PRODUTOS GERAL -->
  <div class="modal" id="modal1">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">PRODUTO</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <div class="demo-inline-spacing mt-3">
            <div class="list-group list-group-horizontal-md text-md-center">
              <a class="list-group-item list-group-item-action active" id="consulta-produto" data-bs-toggle="list"
                href="#consulta1-produto">Consulta Produto</a>
              <a class="list-group-item list-group-item-action" id="novo-produto" data-bs-toggle="list"
                href="#novo1-produto">Novo Produto</a>
            </div>
            <div class="tab-content px-0 mt-0">
              <div class="tab-pane fade show active" id="consulta1-produto">
                <div class="card">
                  <h5 class="card-header">Consulta Produto</h5>
                  <div class="table-responsive text-nowrap">
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <label for="exampleFormControlSelect1" class="form-label">PESQUISAR POR</label>
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                          <option selected>SELECIONE</option>
                          <option value="1">DESCRIÇÃO</option>
                          <option value="2">CODIGO</option>
                        </select>
                      </div>
                      <div class="form-check col-sm-3">
                        <input name="default-radio-1" class="form-check-input" type="radio" value=""
                          id="defaultRadio1" />
                        <label class="form-check-label" for="defaultRadio1"> PRODUÇÃO(PP) </label> <BR>
                        <input name="default-radio-1" class="form-check-input" type="radio" value=""
                          id="defaultRadio2" />
                        <label class="form-check-label" for="defaultRadio2"> PRONTA ENTREGA(PE) </label>
                      </div>
                      <div class="form-check col-sm-5">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="DIGITE A SUA BUSCA"
                            aria-label="DIGITE A SUA BUSCA" aria-describedby="button-addon2" />
                          <button class="btn btn-outline-primary" type="button" id="button-addon2">PESQUISAR</button>
                        </div>
                      </div>
                    </div>
                    <?php
                    $query_produtos = $conexao->prepare("SELECT * FROM produtos ORDER BY CODIGO DESC LIMIT 45");
                    $query_produtos->execute();
                    $pr = 0;
                    while ($linha = $query_produtos->fetch(PDO::FETCH_ASSOC)) {
                      $pp[$pr] = [
                        'CODIGO' => $linha['CODIGO'],
                        'DESCRICAO' => $linha['DESCRICAO'],
                      ];
                      $pr++;
                    }
                    ?>
                    <div style="height: 400px; width: 100%; overflow-y: scroll; ">
                      <table class="table table-hover table-sm table-bordered">
                        <tr>
                          <th>CÓDIGO</th>
                          <th>TIPO</th>
                          <th>DESCRIÇÃO</th>
                          <th>VALOR UNITÁRIO</th>
                          <th>ESTOQUE</th>
                          <th>PRÉ-VENDA</th>
                          <th>PROMOÇÃO</th>
                        </tr>
                        <?php
                        for ($i = 0; $i < $pr; $i++) {
                          echo '<tr>
                        <td><a href="#">' . $pp[$i]['CODIGO'] . '</a></td>
                        <td><a href="#">PP</a></td>
                        <td><a href="#">' . $pp[$i]['DESCRICAO'] . '</a></td>
                        </tr>';
                        }
                        ?>
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
                  <div class="table-responsive text-nowrap">
                    <div class="card-body">
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">TIPO DE PRODUTO</label>
                        <div class="col-sm-10">
                          <input name="TPP" class="form-check-input" type="radio" value="PP" id="PP" />
                          <label class="form-check-label" for="PP"> PRODUÇÃO(PP) </label>
                          <input name="TPP" class="form-check-input" type="radio" value="PE" id="PE" />
                          <label class="form-check-label" for="PE"> PRONTA ENTREGA(PE) </label>
                          <input class="form-check-input" name="commerce" type="checkbox" value="COMMERCE"
                            id="COMMERCE" />
                          <label class="form-check-label" for="COMMERCE"> SERÁ ULTILIZADO NO E-COMMERCE </label>
                          <input class="form-check-input" name="ativo" type="checkbox" value="ATIVO" id="ATIVO" />
                          <label class="form-check-label" for="ATIVO"> ATIVO</label>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="descricao">DESCRIÇÃO DO PRODUTO</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="descricao" placeholder="DESCRIÇÃO" />
                          <div class="form-text">MÁXIMO 150 CARACTERES</div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="LARGURA">LARGURA</label>
                          <input type="number" id="largura" class="form-control phone-mask" placeholder="0,0"
                            aria-label="0,0" />
                        </div>
                        <div class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="ALTURA">ALTURA</label>
                          <input type="number" id="largura" class="form-control phone-mask" placeholder="0,0"
                            aria-label="0,0" />
                        </div>
                        <div class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="ESPESSURA">ESPESSURA</label>
                          <input type="number" id="espessura" class="form-control phone-mask" placeholder="0,0"
                            aria-label="0,0" />
                        </div>
                        <div class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="PESO">PESO</label>
                          <input type="number" id="peso" class="form-control phone-mask" placeholder="0,0"
                            aria-label="0,0" />
                        </div>
                        <div class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="LARGURA">QUANTIDADE FOLHAS</label>
                          <input type="number" value="1" id="largura" class="form-control phone-mask" placeholder="1"
                            aria-label="1" />
                        </div>
                        <div class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="LARGURA">TIPO</label>
                          <select class="form-select" id="exampleFormControlSelect1"
                            aria-label="Default select example">
                            <option desabled>SELECIONE</option>
                            <option value="1">FOLHA</option>
                            <option value="2">BLOCO</option>
                            <option value="3">LIVRO</option>
                          </select>
                        </div>
                      </div>
                      <div class="card">
                        <div class="list-group list-group-horizontal-md text-md-center">
                          <a class="list-group-item list-group-item-action active" id="papeis" data-bs-toggle="list"
                            href="#papeis1">PAPÉIS</a>
                          <a class="list-group-item list-group-item-action" id="acabamentos" data-bs-toggle="list"
                            href="#acabamentos1">ACABAMENTOS</a>
                          <a class="list-group-item list-group-item-action " id="valores" data-bs-toggle="list"
                            href="#valores1">VALORES</a>
                          <a class="list-group-item list-group-item-action" id="estoque" data-bs-toggle="list"
                            href="#estoque1">ESTOQUE</a>
                          <a class="list-group-item list-group-item-action " id="pedidos" data-bs-toggle="list"
                            href="#pedidos1">PEDIDOS</a>
                        </div>
                        <div class="tab-content px-0 mt-0">
                          <div class="tab-pane fade show active" id="papeis1">

                            <h5 class="card-header">PAPÉIS</h5>

                            <!-- Botão para abrir o segundo modal -->
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                              data-bs-target="#modal2">
                              SELECIONAR PAPEL
                            </button>
                            <div class="table-responsive text-nowrap">
                              <label class="form-label" for="basic-default-phone">TIPO</label>
                              <select class="form-select">
                                <option>SELECIONE</option>
                                <option>CAPA</option>
                                <option>MIOLO</option>
                                <option>FOLHA</option>
                                <option>1° VIA</option>
                                <option>2° VIA</option>
                                <option>3° VIA</option>
                              </select>
                              <label class="form-label" for="basic-default-phone">CORES FRENTE</label>
                              <input type="number" placeholder="0">
                              <label class="form-label" for="basic-default-phone">CORES VERSO</label>
                              <input type="number" placeholder="0">
                              <table class="table table-bordered table-hover">
                                <tr>
                                  <th>CÓDIGO</th>
                                  <th>DESCRIÇÃO</th>
                                  <th>TIPO</th>
                                  <th>ORELHA</th>
                                  <th>CORES FRENTE</th>
                                  <th>CORES VERSO</th>
                                </tr>
                                <tr>
                                  <td>cod</td>
                                  <td>des</td>
                                  <td>tp</td>
                                  <td>or</td>
                                  <td>cor</td>
                                  <td>ver</td>
                                </tr>
                              </table>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="acabamentos1">
                            <h5 class="card-header">ACABAMENTOS</h5>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                              data-bs-target="#modal23">
                              SELECIONAR ACABAMENTO
                            </button>
                            <div class="table-responsive text-nowrap">

                              <table class="table table-bordered table-hover">
                                <tr>
                                  <th>CÓDIGO</th>
                                  <th>DESCRIÇÃO</th>
                                </tr>
                                <tr>
                                  <td>cod</td>
                                  <td>des</td>
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
                                  <label class="col-sm-2 col-form-label" for="valorunitario">VALOR UNITÁRIO(R$)</label>
                                  <input type="number" class="form-control" id="valorunitario" placeholder="0,00" />
                                </div>
                                <label class="col-sm-2 col-form-label" for="promo">VALOR PROMOCIONAL(R$)</label>
                                <div class="col-sm-3">
                                  <input class="form-check-input" name="promo" type="checkbox" value="promo"
                                    id="promo" />
                                  <input type="number" class="form-control" id="valorpromo" placeholder="0,00" />
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
                                <input type="number" class="form-control" id="qtdestoque" placeholder="0" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label" for="avisoestoque">AVISO DE ESTOQUE?<input
                                    class="form-check-input" name="avisoestoque" type="checkbox" value="avisoestoque"
                                    id="avisoestoque" /> </label>
                                <input type="number" class="form-control" id="qtdaviso" placeholder="0" />
                              </div>

                            </div>
                          </div>
                          <div class="tab-pane fade" id="pedidos1">
                            <h5 class="card-header">PEDIDOS</h5>
                            <div class="table-responsive text-nowrap">

                              <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">QUANTIDADE MÍNIMA</label>
                                <input type="number" class="form-control" id="qtdmin" placeholder="0" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label" for="qtdmaxestoque">QUANTIDADE MÁXIMA<input
                                    class="form-check-input" name="qtdmaxestoque" type="checkbox" value="qtdmaxestoque"
                                    id="qtdmaxestoque" /> </label>
                                <input type="number" class="form-control" id="qtdmax" placeholder="0" />
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class=" text-end  row justify-content-end">
                        <div class="col-sm-10">
                          <button type="submit" class="btn btn-primary">SALVAR</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Segundo modal CONTEUDO PAPEL -->
              <div class="modal" id="modal2">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">PAPEL</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
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
                        <div class="col-4">
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="basic-default-phone">DESCRIÇÃO</label>
                            <input type="text" id="basic-default-phone" class="form-control phone-mask"
                              placeholder="NOME PAPEL" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="basic-default-phone">LARGURA</label>
                            <input type="number" id="basic-default-phone" class="form-control phone-mask"
                              placeholder="0" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="basic-default-phone">ALTURA</label>
                            <input type="number" id="basic-default-phone" class="form-control phone-mask"
                              placeholder="0" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="basic-default-phone">GRAMATURA</label>
                            <input type="number" id="basic-default-phone" class="form-control phone-mask"
                              placeholder="0" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="basic-default-phone">FORMATO</label>
                            <input type="text" id="basic-default-phone" class="form-control phone-mask"
                              placeholder="0" />
                          </div>
                          <div class="mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                            <label class="form-check-label" for="defaultCheck1"> UMA FACE? </label>
                          </div>
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="basic-default-phone">VALOR UNITÁRIO</label>
                            <input type="number" id="basic-default-phone" class="form-control phone-mask"
                              placeholder="0" />
                          </div>
                          <div class="mb-3">
                            <button class="btn rounded-pill btn-success">CADASTRAR</button>
                          </div>
                        </div>
                        <div style="height: 700px; width: 66%; overflow-y: scroll; " class="m-0 p-0 col-6">
                          <table class="colorbranca table table-sm table-houver">
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
          <td><input type="checkbox"></td>
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
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">ACABAMENTO</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                      <?php
                      $query_acabamento = $conexao->prepare("SELECT * FROM acabamentos ORDER BY CODIGO DESC");
                      $query_acabamento->execute();
                      $a = 0;
                      while ($linha = $query_acabamento->fetch(PDO::FETCH_ASSOC)) {
                        $acabamento[$a] = [
                          'CODIGO' => $linha['CODIGO'],
                          'MAQUINA' => $linha['MAQUINA'],
                          'ATIVA' => $linha['ATIVA'],
                          'CUSTO_HORA' => $linha['CUSTO_HORA'],
                        ];
                        $a++;
                      }
                      ?>
                      <div class="teste">
                        <div class="row">
                          <div class="col-4">
                            <div class="mb-3">
                              <label class="form-label colorbranca" for="basic-default-phone">NOME DA MÁQUINA</label>
                              <input type="text" id="basic-default-phone" class="form-control phone-mask"
                                placeholder="NOME MÁQUINA" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label colorbranca" for="basic-default-phone">CUSTO HORA</label>
                              <input type="number" id="basic-default-phone" class="form-control phone-mask"
                                placeholder="0" />
                            </div>

                            <div class="mb-3">
                              <button class="btn rounded-pill btn-success">CADASTRAR</button>
                            </div>
                          </div>
                          <div style="height: 700px; width: 66%; overflow-y: scroll; " class="m-0 p-0 col-6">
                            <table class="colorbranca table table-sm table-houver">
                              <tr>
                                <th>CODIGO</th>
                                <th>MÁQUINA</th>
                                <th>ATIVA</th>
                                <th>CUSTO HORA</th>
                                <th>SELECIONAR</th>
                              </tr>
                              <?php for ($i = 0; $i < $a; $i++) {
                                echo '<tr>
          <td>' . $acabamento[$i]['CODIGO'] . '</td>
          <td>' . $acabamento[$i]['MAQUINA'] . '</td>
          <td>' . $acabamento[$i]['ATIVA'] . '</td>
          <td>' . $acabamento[$i]['CUSTO_HORA'] . '</td>
          <td><input type="checkbox"></td>
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


              <!-- Inicializa o Bootstrap -->
              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

              <script>
                // Obtém o elemento do segundo modal
                const modal2 = document.getElementById('modal2');

                // Adiciona o evento 'hidden.bs.modal' ao segundo modal
                modal2.addEventListener('hidden.bs.modal', function (event) {
                  // Obtém o elemento do primeiro modal
                  const modal1 = document.getElementById('modal1');

                  // Verifica se o elemento do primeiro modal existe antes de chamar o método 'show()'
                  if (modal1) {
                    modal1.show();
                  }
                });
              </script>




              <?php include_once("../html/../html/navbar-dow.php"); ?>