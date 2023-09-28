<?php /*   */ include_once("../html/navbar.php");
$query_atendent = $conexao->prepare("SELECT * FROM supervisao_atividade s INNER JOIN tabela_atendentes a ON a.codigo_atendente = s.atendente_supervisao WHERE a.secao_atendente = '$secao_user' ORDER BY s.id_supervisao   DESC LIMIT 1000");
$query_atendent->execute();


$query_alteracao = $conexao->prepare("SELECT * FROM alteracoes_ordem_producao s INNER JOIN tabela_atendentes a ON a.codigo_atendente = s.USUARIO ORDER BY s.ALTERACAO DESC LIMIT 1000");
$query_alteracao->execute();
?>
<div class=" SECOES-- "></div>
<div class="accordion mt-3" id="accordionExample">
  <div class="card accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne">
        ATIVIDADES DA SUA SEÇÃO NO SISGRAFEX WEB (<?= $secao_user ?>)
      </button>
    </h2>

    <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <div class="table-responsive text-nowrap">
          <table class="table table-bordered">
            <thead>
              <th>Id</th>
              <th>Nome Usuario</th>
              <th>Data da Alteração</th>
              <th>Descrição da Alteração</th>
            </thead>
            <tbody>
              <?php
              while ($linha = $query_atendent->fetch(PDO::FETCH_ASSOC)) {
                $NAM = $linha['nome_atendente'];
                $DATA = $linha['data_supervisao'];
                $ID = $linha['id_supervisao'];
                $DESCRICAO = $linha['alteracao_atividade'];
                $ATN = $linha['atendente_supervisao'];
                echo "<tr>
            <td>" . $ID . "</td><td>" . $ATN . " - " . $NAM . "</td><td>" . $DATA . "</td><td>" . $DESCRICAO . "</td>
            </tr>";
              }
              $a = 0;

              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="card accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
        ORDENS DE PRODUÇÃO NA SUA SEÇÃO (<?= $secao_user ?>)
      </button>
    </h2>
    <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <table class="table">
                         <thead>
                           <tr>
                             <?php
                                echo '<th>Ordem de Produção</th>';
                                echo '<th>Orçamento Base</th>';
                                echo '<th>Quantidade</th>';
                                echo '<th>Data de Emissão</th>';
                                echo '<th>PREVISÃO de Entrega</th>';
                                echo '<th>Status</th>';
                                echo '<th>Produto</th>';
                              ?>


                             <th data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<span>Selecione a OP para visualizar todas informações</span>">
                               Selecionar</th>
                           </tr>
                         </thead>
                         <tbody class="table-border-bottom-0">

                           <?php
                           
                              $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE o.status != '11' AND o.status != '13' AND secao_op = '$secao_user' ORDER BY o.data_emissao DESC");
                          
                            $query_ordens_finalizadas->execute();
                            $i = 0;
                            while ($linha = $query_ordens_finalizadas->fetch(PDO::FETCH_ASSOC)) {
                                $Ordens_Finalizadas[$i] = [
                                  'cod' => $linha['cod'],
                                  'orcamento_base' => $linha['orcamento_base'],
                                  'tipo_produto' => $linha['tipo_produto'],
                                  'cod_produto' => $linha['cod_produto'],
                                  'cod_cliente' => $linha['cod_cliente'],
                                  'tipo_cliente' => $linha['tipo_cliente'],
                                  'status' => $linha['status'],
                                  'op_secao' => $linha['op_secao'],
                                  'STS_DESCRICAO' => $linha['STS_DESCRICAO'],
                                  'data_entrega' => date($linha['data_entrega']),
                                  'data_emissao' => date($linha['data_emissao']),
                                  'data_apr_cliente' => date($linha['data_apr_cliente']),
                                  'data_ent_tipografia' => date($linha['data_ent_tipografia']),
                                  'data_ent_acabamento' => date($linha['data_ent_acabamento']),
                                  'DT_ENTRADA_PRE_IMP_PROVA' => date($linha['DT_ENTRADA_PRE_IMP_PROVA']),
                                  'DT_ENTRADA_PRE_IMP' => date($linha['DT_ENTRADA_PRE_IMP']),
                                  'DT_ENTRADA_CTP' => date($linha['DT_ENTRADA_CTP']),
                                  'data_1a_prova' => date($linha['data_1a_prova']),
                                  'data_2a_prova' => date($linha['data_2a_prova']),
                                  'data_3a_prova' => date($linha['data_3a_prova']),
                                  'data_4a_prova' => date($linha['data_4a_prova']),
                                  'data_5a_prova' => date($linha['data_5a_prova']),
                                  'data_ent_final' => date($linha['data_ent_final']),
                                  'data_ent_offset' => date($linha['data_ent_offset']),
                                  'data_envio_div_cmcl' => date($linha['data_envio_div_cmcl']),
                                  'DT_ENT_DIGITAL' => date($linha['DT_ENT_DIGITAL']),
                                  'DT_TIPOGRAFIA_PROVA' => date($linha['DT_TIPOGRAFIA_PROVA']),
                                  'DT_ACABAMENTO_PROVA' => date($linha['DT_ACABAMENTO_PROVA']),
                                  'DT_SAIDA_EXPEDICAO' => date($linha['DT_SAIDA_EXPEDICAO']),
                                  'data_imp_dir' => date($linha['data_imp_dir']),
                                  'tipo_trabalho' => $linha['tipo_trabalho'],
                                  'DT_ENTRADA_PLOTTER' => date($linha['DT_ENTRADA_PLOTTER']),
                                  'DT_ENVIADO_EXPEDICAO' => date($linha['DT_ENVIADO_EXPEDICAO']),
                                  'SAIDA_PRE' => date($linha['SAIDA_PRE']),
                                  'SAIDA_DIGITAL' => date($linha['SAIDA_DIGITAL']),
                                  'SAIDA_OFFSET' => date($linha['SAIDA_OFFSET']),
                                  'SAIDA_CTP' => date($linha['SAIDA_CTP']),
                                  'SAIDA_TIPOGRAFIA' => date($linha['SAIDA_TIPOGRAFIA']),
                                  'SAIDA_ACABAMENTO' => date($linha['SAIDA_ACABAMENTO']),
                                  'SAIDA_PLOTTER' => date($linha['SAIDA_PLOTTER']),
                                  'DT_ENTG_PROVA' => date($linha['DT_ENTG_PROVA']),

                                ];
                                $Tabela_Produtos_Finalizados[$i] = [
                                  'descricao' => 'N/C'
                                ];
                                $Tabela_Orc_Finalizados[$i] = [
                                  'valor_total' => 'N/C'
                                ];
                                $Pesquisa_orcamento = $Ordens_Finalizadas[$i]['orcamento_base'];
                                $Pesquisa_Produto = $Ordens_Finalizadas[$i]['cod_produto'];
                                $Tipo_Produto = $Ordens_Finalizadas[$i]['tipo_produto'];
                                if ($Tipo_Produto == '2') {
                                  $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos_pr_ent  WHERE CODIGO = '$Pesquisa_Produto'");
                                  $query_PRODUTOS->execute();

                                  while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                                    $Tabela_Produtos_Finalizados[$i] = [
                                      'descricao' => $linha2['DESCRICAO']
                                    ];
                                  }
                                }
                                $quantiadade = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento  WHERE cod_produto = '$Pesquisa_Produto' AND cod_orcamento = '$Pesquisa_orcamento'");
                                $quantiadade->execute();

                                if ($linha2 = $quantiadade->fetch(PDO::FETCH_ASSOC)) {
                                  $Tabela_Quantidade[$i] = [
                                    'quantidade' => $linha2['quantidade']
                                  ];
                                }
                                if (!isset($Tabela_Quantidade[$i])) {
                                  $Tabela_Quantidade[$i] = [
                                    'quantidade' => 'Não Encontrada'
                                  ];
                                }
                                if ($Tipo_Produto == '1') {
                                  $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_Produto'");
                                  $query_PRODUTOS->execute();

                                  while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                                    $Tabela_Produtos_Finalizados[$i] = [
                                      'descricao' => $linha2['DESCRICAO']
                                    ];
                                  }
                                }

                                $Pesquisa_Orc = $Ordens_Finalizadas[$i]['orcamento_base'];
                                $query_Pesquisa_Orc = $conexao->prepare("SELECT * FROM tabela_orcamentos  WHERE cod = '$Pesquisa_Orc'");
                                $query_Pesquisa_Orc->execute();

                                while ($linha2 = $query_Pesquisa_Orc->fetch(PDO::FETCH_ASSOC)) {
                                  $Tabela_Orc_Finalizados[$i] = [
                                    'valor_total' => $linha2['valor_total']
                                  ];
                                }
                              $i++;
                            }
                            if (isset($Ordens_Finalizadas)) {
                              $Total_Finalizadas = count($Ordens_Finalizadas);
                            } else {
                              $Total_Finalizadas = 0;
                            }
                            $Percorrer_Finalizadas = 0;
                            $valor_total_Finalizadas = 0;
                             ?>
                            <?php
                             $relatorio = '<tr align="center"><td colspan="9"><b>TOTAL: '.$Total_Finalizadas.' O.P</b></td></tr>';
                            while ($Total_Finalizadas > $Percorrer_Finalizadas) {
                                $relatorio = $relatorio .
                                  '<tr><td data-nome="codOpJs">' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['cod'] . '</td>' .
                                  '<td>' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['orcamento_base'] . '</td>' .
                                  '<td>' . $Tabela_Quantidade[$Percorrer_Finalizadas]['quantidade'] . '</td>' .
                                  '<td>' . date('d/m/Y', strtotime($Ordens_Finalizadas[$Percorrer_Finalizadas]['data_emissao'])) . '</td>' .
                                  '<td>' . date('d/m/Y', strtotime($Ordens_Finalizadas[$Percorrer_Finalizadas]['data_entrega'])) . '</td>' .
                                  '<td>' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['status'] . ' - ' . $Ordens_Finalizadas[$Percorrer_Finalizadas]["STS_DESCRICAO"] . ' </td>' .
                                  '<td>' . $Tabela_Produtos_Finalizados[$Percorrer_Finalizadas]['descricao'] . '</td>
                                  <td>
                                  <div class="">
                                  <a class="btn rounded-pill btn-info " id="pesquisarOp" href="../producao/tl-controle-op.php?cod=' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['cod'] . '"><i class="bx bx-edit-alt me-1"></i> Selecionar</a>
                              </div>
                                  </td>
                                  </tr>';
                                  $Percorrer_Finalizadas++;
                            
                              }
                              
                            if (isset($relatorio)) {
                              echo $relatorio;
                            } else {
                              
                                  $relatorio = '<td><b>Nenhum Resultado Encontrado!</b></td>' .
                                    '<td></td>' .
                                    '<td></td>' .
                                    '<td></td>' .
                                    '<td> </td>' .
                                    '<td></td>
                                  <td>
                                  
                                </td>
                                          </tr>';
                                  echo $relatorio;
                                }
                              

                            ?>



                         </tbody>
                       </table>
      </div>
    </div>
  </div>
  <div class="card accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree">
        SUAS ORDENS DE PRODUÇÃO (<?= $nome_user ?>)
      </button>
    </h2>
    <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <table class="table">
                         <thead>
                           <tr>
                             <?php
                                echo '<th>Ordem de Produção</th>';
                                echo '<th>Orçamento Base</th>';
                                echo '<th>Quantidade</th>';
                                echo '<th>Data de Emissão</th>';
                                echo '<th>PREVISÃO de Entrega</th>';
                                echo '<th>Status</th>';
                                echo '<th>Produto</th>';
                              ?>


                             <th data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<span>Selecione a OP para visualizar todas informações</span>">
                               Selecionar</th>
                           </tr>
                         </thead>
                         <tbody class="table-border-bottom-0">

                           <?php
                           
                              $query_ordens_finalizadas2 = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE o.status != '11' AND o.status != '13' AND o.COD_ATENDENTE = '$cod_user' ORDER BY o.data_emissao DESC");
                          
                            $query_ordens_finalizadas2->execute();
                            $i = 0;
                            while ($linha = $query_ordens_finalizadas2->fetch(PDO::FETCH_ASSOC)) {
                                $Ordens_Finalizadas1[$i] = [
                                  'cod' => $linha['cod'],
                                  'orcamento_base' => $linha['orcamento_base'],
                                  'tipo_produto' => $linha['tipo_produto'],
                                  'cod_produto' => $linha['cod_produto'],
                                  'cod_cliente' => $linha['cod_cliente'],
                                  'tipo_cliente' => $linha['tipo_cliente'],
                                  'status' => $linha['status'],
                                  'op_secao' => $linha['op_secao'],
                                  'STS_DESCRICAO' => $linha['STS_DESCRICAO'],
                                  'data_entrega' => date($linha['data_entrega']),
                                  'data_emissao' => date($linha['data_emissao']),
                                  'data_apr_cliente' => date($linha['data_apr_cliente']),
                                  'data_ent_tipografia' => date($linha['data_ent_tipografia']),
                                  'data_ent_acabamento' => date($linha['data_ent_acabamento']),
                                  'DT_ENTRADA_PRE_IMP_PROVA' => date($linha['DT_ENTRADA_PRE_IMP_PROVA']),
                                  'DT_ENTRADA_PRE_IMP' => date($linha['DT_ENTRADA_PRE_IMP']),
                                  'DT_ENTRADA_CTP' => date($linha['DT_ENTRADA_CTP']),
                                  'data_1a_prova' => date($linha['data_1a_prova']),
                                  'data_2a_prova' => date($linha['data_2a_prova']),
                                  'data_3a_prova' => date($linha['data_3a_prova']),
                                  'data_4a_prova' => date($linha['data_4a_prova']),
                                  'data_5a_prova' => date($linha['data_5a_prova']),
                                  'data_ent_final' => date($linha['data_ent_final']),
                                  'data_ent_offset' => date($linha['data_ent_offset']),
                                  'data_envio_div_cmcl' => date($linha['data_envio_div_cmcl']),
                                  'DT_ENT_DIGITAL' => date($linha['DT_ENT_DIGITAL']),
                                  'DT_TIPOGRAFIA_PROVA' => date($linha['DT_TIPOGRAFIA_PROVA']),
                                  'DT_ACABAMENTO_PROVA' => date($linha['DT_ACABAMENTO_PROVA']),
                                  'DT_SAIDA_EXPEDICAO' => date($linha['DT_SAIDA_EXPEDICAO']),
                                  'data_imp_dir' => date($linha['data_imp_dir']),
                                  'tipo_trabalho' => $linha['tipo_trabalho'],
                                  'DT_ENTRADA_PLOTTER' => date($linha['DT_ENTRADA_PLOTTER']),
                                  'DT_ENVIADO_EXPEDICAO' => date($linha['DT_ENVIADO_EXPEDICAO']),
                                  'SAIDA_PRE' => date($linha['SAIDA_PRE']),
                                  'SAIDA_DIGITAL' => date($linha['SAIDA_DIGITAL']),
                                  'SAIDA_OFFSET' => date($linha['SAIDA_OFFSET']),
                                  'SAIDA_CTP' => date($linha['SAIDA_CTP']),
                                  'SAIDA_TIPOGRAFIA' => date($linha['SAIDA_TIPOGRAFIA']),
                                  'SAIDA_ACABAMENTO' => date($linha['SAIDA_ACABAMENTO']),
                                  'SAIDA_PLOTTER' => date($linha['SAIDA_PLOTTER']),
                                  'DT_ENTG_PROVA' => date($linha['DT_ENTG_PROVA']),

                                ];
                                $Tabela_Produtos_Finalizados[$i] = [
                                  'descricao' => 'N/C'
                                ];
                                $Tabela_Orc_Finalizados[$i] = [
                                  'valor_total' => 'N/C'
                                ];
                                $Pesquisa_orcamento = $Ordens_Finalizadas1[$i]['orcamento_base'];
                                $Pesquisa_Produto = $Ordens_Finalizadas1[$i]['cod_produto'];
                                $Tipo_Produto = $Ordens_Finalizadas1[$i]['tipo_produto'];
                                if ($Tipo_Produto == '2') {
                                  $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos_pr_ent  WHERE CODIGO = '$Pesquisa_Produto'");
                                  $query_PRODUTOS->execute();

                                  while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                                    $Tabela_Produtos_Finalizados[$i] = [
                                      'descricao' => $linha2['DESCRICAO']
                                    ];
                                  }
                                }
                                $quantiadade = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento  WHERE cod_produto = '$Pesquisa_Produto' AND cod_orcamento = '$Pesquisa_orcamento'");
                                $quantiadade->execute();

                                if ($linha2 = $quantiadade->fetch(PDO::FETCH_ASSOC)) {
                                  $Tabela_Quantidade[$i] = [
                                    'quantidade' => $linha2['quantidade']
                                  ];
                                }
                                if (!isset($Tabela_Quantidade[$i])) {
                                  $Tabela_Quantidade[$i] = [
                                    'quantidade' => 'Não Encontrada'
                                  ];
                                }
                                if ($Tipo_Produto == '1') {
                                  $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_Produto'");
                                  $query_PRODUTOS->execute();

                                  while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                                    $Tabela_Produtos_Finalizados[$i] = [
                                      'descricao' => $linha2['DESCRICAO']
                                    ];
                                  }
                                }

                                $Pesquisa_Orc = $Ordens_Finalizadas1[$i]['orcamento_base'];
                                $query_Pesquisa_Orc = $conexao->prepare("SELECT * FROM tabela_orcamentos  WHERE cod = '$Pesquisa_Orc'");
                                $query_Pesquisa_Orc->execute();

                                while ($linha2 = $query_Pesquisa_Orc->fetch(PDO::FETCH_ASSOC)) {
                                  $Tabela_Orc_Finalizados[$i] = [
                                    'valor_total' => $linha2['valor_total']
                                  ];
                                }
                              $i++;
                            }
                            if (isset($Ordens_Finalizadas1)) {
                              $Total_Finalizadas2 = count($Ordens_Finalizadas1);
                            } else {
                              $Total_Finalizadas2 = 0;
                            }
                            $Percorrer_Finalizadas = 0;
                            $valor_total_Finalizadas = 0;
                             ?>
                            <?php
                             $relatorio3 = '<tr align="center"><td colspan="9"><b>TOTAL: '.$Total_Finalizadas2.' O.P</b></td></tr>';
                            while ($Total_Finalizadas2 > $Percorrer_Finalizadas) {
                                $relatorio3 = $relatorio3 .
                                  '<tr><td data-nome="codOpJs">' . $Ordens_Finalizadas1[$Percorrer_Finalizadas]['cod'] . '</td>' .
                                  '<td>' . $Ordens_Finalizadas1[$Percorrer_Finalizadas]['orcamento_base'] . '</td>' .
                                  '<td>' . $Tabela_Quantidade[$Percorrer_Finalizadas]['quantidade'] . '</td>' .
                                  '<td>' . date('d/m/Y', strtotime($Ordens_Finalizadas1[$Percorrer_Finalizadas]['data_emissao'])) . '</td>' .
                                  '<td>' . date('d/m/Y', strtotime($Ordens_Finalizadas1[$Percorrer_Finalizadas]['data_entrega'])) . '</td>' .
                                  '<td>' . $Ordens_Finalizadas1[$Percorrer_Finalizadas]['status'] . ' - ' . $Ordens_Finalizadas1[$Percorrer_Finalizadas]["STS_DESCRICAO"] . ' </td>' .
                                  '<td>' . $Tabela_Produtos_Finalizados[$Percorrer_Finalizadas]['descricao'] . '</td>
                                  <td>
                                  <div class="">
                                  <a class="btn rounded-pill btn-info " id="pesquisarOp" href="../producao/tl-controle-op.php?cod=' . $Ordens_Finalizadas1[$Percorrer_Finalizadas]['cod'] . '"><i class="bx bx-edit-alt me-1"></i> Selecionar</a>
                              </div>
                                  </td>
                                  </tr>';
                                  $Percorrer_Finalizadas++;
                            
                              }
                              
                            if (isset($relatorio3)) {
                              echo $relatorio3;
                            } else {
                              
                                  $relatorio3 = '<td><b>Nenhum Resultado Encontrado!</b></td>' .
                                    '<td></td>' .
                                    '<td></td>' .
                                    '<td></td>' .
                                    '<td> </td>' .
                                    '<td></td>
                                  <td>
                                  
                                </td>
                                          </tr>';
                                  echo $relatorio3;
                                }
                              

                            ?>



                         </tbody>
                       </table>
      </div>
    </div>
  </div>
</div>
</div>
<?php /*   */ include_once("../html/navbar-dow.php"); ?>