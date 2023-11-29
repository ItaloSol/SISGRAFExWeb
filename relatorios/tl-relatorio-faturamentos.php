<?php /* |-aaa!  !-! */ include_once("../html/../html/navbar.php");
$_SESSION["pag"] = array(1, 0);

$a = 0;
$Query_Atem = $conexao->prepare("SELECT * FROM tabela_atendentes a INNER JOIN usuario_acessos u ON a.codigo_atendente = u.CODIGO_USR WHERE u.PROD = '1' ORDER BY a.nome_atendente ASC ");
$Query_Atem->execute();
$Operadores = 0;
while ($linha = $Query_Atem->fetch(PDO::FETCH_ASSOC)) {
  $Nome_Atendente = $linha['nome_atendente'];
  $codigo_aten = $linha['codigo_atendente'];

  $Nome_Atem[$Operadores] = $Nome_Atendente;
  $Codigo[$Operadores] = $codigo_aten;
  $Operadores++;
};
$i = 0;
$query_Sts = $conexao->prepare("SELECT * FROM sts_op  ORDER BY CODIGO ASC ");
$query_Sts->execute();
$Sts = 0;
while ($linha = $query_Sts->fetch(PDO::FETCH_ASSOC)) {
  $Nome_Sts = $linha['STS_DESCRICAO'];
  $codigo_Sts = $linha['CODIGO'];

  $Nome_Sts_[$Sts] = $Nome_Sts;
  $Codigo_Sts_[$Sts] = $codigo_Sts;
  $Sts++;
};
$hoje = date('Y-m-d');

?>
<div class=" relatorio-- "></div>

<div class="card mb-4">
  <h5 class="card-header">Relatórios - Faturamentos</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-12">
        <small class="text-light fw-semibold">Horizontal</small>
        <div class="demo-inline-spacing mt-3">
          <div class="list-group list-group-horizontal-md text-md-center">
            <a class="list-group-item list-group-item-action active" id="home-list-item" data-bs-toggle="list" href="#horizontal-home">Cliente</a>
            <a class="list-group-item list-group-item-action" id="profile-list-item" data-bs-toggle="list" href="#horizontal-profile">OP/Orçamento</a>
            <a class="list-group-item list-group-item-action" id="messages-list-item" data-bs-toggle="list" href="#horizontal-messages">Transporte</a>
            <a class="list-group-item list-group-item-action" id="settings-list-item" data-bs-toggle="list" href="#horizontal-settings">Emissor</a>
            <a class="list-group-item list-group-item-action" id="settings-list-item" data-bs-toggle="list" href="#horizontal-periodo">Período</a>
            <a class="list-group-item list-group-item-action" id="settings-list-item" data-bs-toggle="list" href="#horizontal-campos">Campos</a>
            <a class="list-group-item list-group-item-action" id="settings-list-item" data-bs-toggle="list" href="#horizontal-ordenar">Ordenar</a>
          </div>
          <form target="_blank" action="relatorio-faturamentos.php" method="POST">
            <!--Clientes-->
            <div class="tab-content px-0 mt-0">
              <div class="tab-pane fade show active" id="horizontal-home">
                <div class="form-check mt-3">
                  <input class="form-check-input" name="cliente" type="radio" value="codigo" id="porCodiguinho" />
                  <label class="form-check-label" for="porCodiguinho"> Por Código </label>
                </div>
                <div class="mb-3">
                  <select class="form-select" name="clientetipocod">
                    <option>Selecione o tipo de cliente</option>
                    <option value="1">Pessoa Física</option>
                    <option value="2">Pessoa Júridica</option>
                  </select>
                </div>
                <div class="mb-3">
                  <input id="defaultInput" name="clientecod" class="form-control" type="number" placeholder="Digite o código aqui" />
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" name="cliente" value="nome" type="radio" id="porNome" />
                  <label class="form-check-label" for="porNome"> Por Nome </label>
                </div>
                <div class="mb-3">
                  <select class="form-select" name="clientetiponom">
                    <option>Selecione o tipo de cliente</option>
                    <option value="1">Pessoa Física</option>
                    <option value="2">Pessoa Júridica</option>
                  </select>
                </div>
                <div class="mb-3">
                  <input id="defaultInput" name="clientenome" class="form-control" type="text" placeholder="Digite o nome aqui" />
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" name="cliente" value="tipopessoa" type="radio" id="portipopessoa" />
                  <label class="form-check-label" for="portipopessoa"> Por Tipo de Pessoa </label>
                </div>
                <div class="mb-3">
                  <select class="form-select" name="clienteselecione">
                    <option>Selecione o tipo de cliente</option>
                    <option value="1">Pessoa Física</option>
                    <option value="2">Pessoa Júridica</option>
                  </select>
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="cliente" value="todos" id="cliente" checked />
                  <label class="form-check-label" for="cliente"> Todos </label>
                </div>
              </div>
              <!--OP/Orçamentos-->
              <div class="tab-pane fade" id="horizontal-profile">
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="OpOrc" value="OpCod" id="OpOrc" />
                  <label class="form-check-label" for="OpOrc"> Ordem de Produção (Código) </label>
                </div>
                <div class="mb-3">
                  <input id="defaultInput" class="form-control" name="OpOrcCod" type="number" placeholder="Digite o código aqui" />
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="OpOrc" value="OrcCod" id="OrcCod" />
                  <label class="form-check-label" for="OrcCod"> Orçamento Base (Código) </label>
                </div>
                <div class="mb-3">
                  <input id="defaultInput" class="form-control" name="CodOpOrc" type="number" placeholder="Digite o código aqui" />
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="OpOrc" value="todos" checked id="potodos" />
                  <label class="form-check-label" for="potodos"> Todos </label>
                </div>
              </div>
              <!--Produto-->
              <div class="tab-pane fade" id="horizontal-messages">
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="produto" value="CodPro" id="produtocod" />
                  <label class="form-check-label" for="produtocod"> Por Código </label>
                </div>
                <div class="mb-3">
                  <input id="defaultInput" class="form-control" name="produtoCod" type="number" placeholder="Digite o código aqui" />
                </div>
                <!-- <div class="form-check mt-3">
                               <input class="form-check-input" type="radio" name="produto" value="DesPro" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Por Descrição </label>
                              </div>
                              <div class="mb-3">
                                <input id="defaultInput" class="form-control" name="produto"  type="text" placeholder="Digite a descrição aqui" />
                              </div>
                              <div class="form-check mt-3">
                               <input class="form-check-input" type="radio" name="produto" value="TipoPro" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Por Tipo </label>
                              </div>
                              <div class="mb-3">
                                <select class="form-select" name="produtoTipo" >
                                  <option selected>Selecione o tipo de produto</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  
                                </select>
                              </div> -->
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="produto" value="todos" checked id="portodes" />
                  <label class="form-check-label" for="portodes"> Todos </label>
                </div>
              </div>
              <!--Emissor/OPERADOR-->
              <div class="tab-pane fade" id="horizontal-settings">
                <div class="form-check mt-3">
                  <input class="form-check-input" name="emissor" type="radio" value="PorEmiss" id="selecionePorEmiss" />
                  <label class="form-check-label" for="selecionePorEmiss"> Por Emissor </label>
                </div>
                <div class="mb-3">
                  <select class="form-select" name="emissorCod">
                    <option selected>Selecione o Emissor</option>
                    <?php
                    while ($a < $Operadores) {
                      echo '<option value="' . $Codigo[$a] . '">' . $Codigo[$a] . ' - ' . $Nome_Atem[$a] . '</option>';
                      $a++;
                    }
                    ?>
                  </select>
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="emissor" value="todos" checked id="emissortodos" />
                  <label class="form-check-label" for="emissortodos"> Todos </label>
                </div>
              </div>
              <!--Período-->

              <div class="tab-pane fade" id="horizontal-periodo">
                <div class="row">
                  <div class="col-6 card">
                    <div class="form-check mt-3">
                      <input class="form-check-input" type="radio" name="periodo" value="EmissPer" id="EmissPer" />
                      <label class="form-check-label" for="EmissPer"> Por dia de Emissão </label>
                    </div>
                    <div class="mb-3 row">
                      <div class="col-md-12">
                        <input class="form-control" type="date" name="periodoEmiss" value="<?= $hoje ?>" id="html5-date-input" />
                      </div>
                    </div>
                    <div class="form-check mt-3">
                      <input class="form-check-input" type="radio" name="periodo" value="EntrPer" id="EntrPer" />
                      <label class="form-check-label" for="EntrPer"> Por dia de Entrega </label>
                    </div>
                    <div class="mb-3 row">
                      <div class="col-md-12">
                        <input class="form-control" type="date" name="periodoEntr" value="<?= $hoje ?>" id="html5-date-input" />
                      </div>
                    </div>
                    <div class="form-check mt-3">
                      <input class="form-check-input" type="radio" name="periodo" value="IncFimEmiss" id="IncFimEmiss" />
                      <label class="form-check-label" for="IncFimEmiss"> Por Périodo - Data de Emissão </label>
                    </div>
                    <div class="mb-3 row">
                      <label for="html5-date-input" class="col-md-2 col-form-label">Início</label>
                      <div class="col-md-10">
                        <input class="form-control" name="periodoIncEmiss" type="date" value="<?= $hoje ?>" id="html5-date-input" />
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="html5-date-input" class="col-md-2 col-form-label">Fim</label>
                      <div class="col-md-10">
                        <input class="form-control" name="periodoFimEmiss" type="date" value="<?= $hoje ?>" id="html5-date-input" />
                      </div>
                    </div>
                    <div class="form-check mt-3">
                      <input class="form-check-input" type="radio" name="periodo" value="IncFimPer" id="IncFimPer" />
                      <label class="form-check-label" for="IncFimPer"> Por Périodo - Data de Entrega </label>
                    </div>
                    <div class="mb-3 row">
                      <label for="html5-date-input" class="col-md-2 col-form-label">Início</label>
                      <div class="col-md-10">
                        <input class="form-control" name="periodoIncPer" type="date" value="<?= $hoje ?>" id="html5-date-input" />
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="html5-date-input" class="col-md-2 col-form-label">Fim</label>
                      <div class="col-md-10">
                        <input class="form-control" name="periodoFimPer" type="date" value="<?= $hoje ?>" id="html5-date-input" />
                      </div>
                    </div>
                    <div class="form-check mt-3">
                      <input class="form-check-input" type="radio" name="periodo" value="todos" checked id="portodis" />
                      <label class="form-check-label" for="portodis"> Todos </label>
                    </div>
                  </div>
                  <!-- 
                      
                     -->
                  <div class="col-6 card">
                    <div class="form-check mt-3">
                      <input class="form-check-input" type="radio" name="periodoPrevisao" value="EmissPerPrevisao" id="EmissPer" />
                      <label class="form-check-label" for="EmissPer">Previsão Inicio dos Trabalhos</label>
                    </div>
                    <div class="mb-3 row">
                      <div class="col-md-12">
                        <input class="form-control" type="date" name="periodoEmissPrevisao" value="<?= $hoje ?>" id="html5-date-input" />
                      </div>
                    </div>
                    <div class="form-check mt-3">
                      <input class="form-check-input" type="radio" name="periodoPrevisao" value="EntrPerPrevisao" id="EntrPer" />
                      <label class="form-check-label" for="EntrPer"> Previsão Termino dos Trabalhos </label>
                    </div>
                    <div class="mb-3 row">
                      <div class="col-md-12">
                        <input class="form-control" type="date" name="periodoEntrPrevisao" value="<?= $hoje ?>" id="html5-date-input" />
                      </div>
                    </div>
                    <div class="form-check mt-3">
                      <input class="form-check-input" type="radio" name="periodoPrevisao" value="IncFimEmissPrevisao" id="IncFimEmiss" />
                      <label class="form-check-label" for="IncFimEmiss"> Por Périodo - Previsão Inicio dos Trabalhos
                      </label>
                    </div>
                    <div class="mb-3 row">
                      <label for="html5-date-input" class="col-md-2 col-form-label">Início</label>
                      <div class="col-md-10">
                        <input class="form-control" name="periodoIncEmissPrevisao" type="date" value="<?= $hoje ?>" id="html5-date-input" />
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="html5-date-input" class="col-md-2 col-form-label">Fim</label>
                      <div class="col-md-10">
                        <input class="form-control" name="periodoFimEmissPrevisao" type="date" value="<?= $hoje ?>" id="html5-date-input" />
                      </div>
                    </div>
                    <div class="form-check mt-3">
                      <input class="form-check-input" type="radio" name="periodoPrevisao" value="IncFimPerPrevisao" id="IncFimPer" />
                      <label class="form-check-label" for="IncFimPer"> Por Périodo - Previsão Termino dos Trabalhos </label>
                    </div>
                    <div class="mb-3 row">
                      <label for="html5-date-input" class="col-md-2 col-form-label">Início</label>
                      <div class="col-md-10">
                        <input class="form-control" name="periodoIncPerPrevisao" type="date" value="<?= $hoje ?>" id="html5-date-input" />
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="html5-date-input" class="col-md-2 col-form-label">Fim</label>
                      <div class="col-md-10">
                        <input class="form-control" name="periodoFimPerPrevisao" type="date" value="<?= $hoje ?>" id="html5-date-input" />
                      </div>
                    </div>

                  </div>
                </div>
                <!-- 

                      -->
              </div>
              <!--Status-->
              <div class="tab-pane fade" id="horizontal-status">
                <div class="form-check mt-3">
                  <input class="form-check-input" name="status" type="radio" value="status" id="status" />
                  <label class="form-check-label" for="status"> Por Status </label>
                </div>
                <div class="mb-3">
                  <select class="form-select" name="statusS">
                    <option selected>Selecione o status</option>
                    <option value="producao">0 - TODOS EM PRODUÇÃO</option>
                    <?php
                    $i = 0;
                    while ($i < $Sts) {
                      echo '<option value="' . $Codigo_Sts_[$i] . '">' . $Codigo_Sts_[$i] . ' - ' . $Nome_Sts_[$i] . '</option>';
                      $i++;
                    }
                    ?>
                  </select>
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="status" value="todos" checked id="portodus" />
                  <label class="form-check-label" for="portodus"> Todos </label>
                </div>
              </div>
              <!--Campos-->
              <div class="tab-pane fade" id="horizontal-campos">
                <div class="col-md">
                  <small class="text-light fw-semibold d-block">Selecione os campos que deseja em seu relatório:</small>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="checkbox" name="campos2" checked id="Código da OP" value="tabela_ordens_producao.cod" />
                    <label class="form-check-label" for="Código da OP">Código da OP</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="campos3" id="Código do Orçamento" value="orcamento_base" />
                    <label class="form-check-label" for="Código do Orçamento">Código do Orçamento</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="campos4" id="Emissor" value="cod_emissor" />
                    <label class="form-check-label" for="Emissor">Emissor</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="campos5" id="Código do Cliente" value="Código" />
                    <label class="form-check-label" for="Código do Cliente">Código do Cliente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="campos6" id="Nome do Cliente" value="nome" />
                    <label class="form-check-label" for="Nome do Cliente">Nome do Cliente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="campos7" id="Tipo de Pessoa" value="tipo_cliente" />
                    <label class="form-check-label" for="Tipo de Pessoa">Tipo de Pessoa</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="campos8" id="Quantidade Entregue" value="quantidade Entregue" />
                    <label class="form-check-label" for="Quantidade Entregue">Quantidade Entregue</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="campos9" id="Valor" value="(quantidade * preco_unitario) AS VLR_PARC" />
                    <label class="form-check-label" for="Valor">Valor</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="campos10" id="Data" value="data_emissao" />
                    <label class="form-check-label" for="Data">Data</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="campos11" id="Nome Transportador" value="tabela_ordens_producao.cod_produto" />
                    <label class="form-check-label" for="Nome Transportador">Nome Transportador</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="campos12" id="Modalidade do frete" value="descricao_produto" />
                    <label class="form-check-label" for="Modalidade do frete">Modalidade do frete</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="campos13" id="Descrição do Produto" value="descricao_produto" />
                    <label class="form-check-label" for="Descrição do Produto">Descrição do Produto</label>
                  </div>
                </div>
              </div>
              <!--Ordenar-->
              <div class="tab-pane fade" id="horizontal-ordenar">
                <div class="col-md">
                  <small class="text-light fw-semibold d-block">Ordenar por:</small>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Código OP Crescente" value=" tabela_ordens_producao.cod ASC" />
                    <label class="form-check-label" for="Por Código OP Crescente">Por Código OP Crescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Código OP Decrescente" value=" tabela_ordens_producao.cod DESC" />
                    <label class="form-check-label" for="Por Código OP Decrescente">Por Código OP Decrescente</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Emissor" value=" tabela_ordens_producao.cod_emissor ASC" />
                    <label class="form-check-label" for="Por Emissor">Por Emissor</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Tipo de Pessoa" value=" tabela_ordens_producao.tipo_cliente ASC" />
                    <label class="form-check-label" for="Por Tipo de Pessoa">Por Tipo de Pessoa</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Valor Crescente" value=" VLR_PARC ASC" />
                    <label class="form-check-label" for="Por Valor Crescente">Por Valor Crescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Valor Decrescente" value=" VLR_PARC DESC" />
                    <label class="form-check-label" for="Por Valor Decrescente">Por Valor Decrescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Data de Emissão Mais Atual" value=" tabela_ordens_producao.data_emissao DESC " />
                    <label class="form-check-label" for="Por Data de Emissão Mais Atual">Por Data de Emissão Mais
                      Atual</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Data de Emissão Mais Antiga" value=" tabela_ordens_producao.data_emissao ASC" />
                    <label class="form-check-label" for="Por Data de Emissão Mais Antiga">Por Data de Emissão Mais
                      Antiga</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Data Prevista  de Entrega Mais Atual" value=" tabela_ordens_producao.data_entrega DESC" />
                    <label class="form-check-label" for="Por Data de Entrega Mais Atual">Por Valor Decrescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Data Prevista de Entrega Mais Antiga" value=" tabela_ordens_producao.data_entrega ASC" />
                    <label class="form-check-label" for="Por Data de Entrega Mais Antiga">Por Por Valor Crescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ordenar" id="Sem Ordenação" checked value="SemOrdem" />
                    <label class="form-check-label" for="Sem Ordenação">Sem Ordenação</label>
                  </div><br></br>
                  <div class="col-md">
                    <small class="text-light fw-semibold d-block">Orientação:</small>
                    <div class="form-check form-check-inline mt-3">
                      <input class="form-check-input" type="radio" name="orientacao" checked id="inlineradio1" value="retarto" />
                      <label class="form-check-label" for="inlineradio1">Retrato</label>
                    </div>
                    <div class="form-check form-check-inline mt-3">
                      <input class="form-check-input" type="radio" name="orientacao" id="Paisagem" value="paisagem" />
                      <label class="form-check-label" for="Paisagem">Paisagem</label>
                    </div><br></br>
                  </div>
                  <input class="form-check-input" type="hidden" name="campos1" checked id="Código da OP" value="tabela_ordens_producao.cod">
                  <input class="form-check-input" type="hidden" name="campos19" checked id="Status" value="status" />
                  <button type="submit" class="btn btn-info">Gerar Relatório</button>
                </div>
          </form>
        </div>
      </div>
      <!--/ Custom content with heading -->
    </div>
  </div>
</div>
</div>


<?php include_once("../html/../html/navbar-dow.php"); ?>