<?php /* |-aaa!  !-! */ include_once("../html/../html/navbar.php");
$_SESSION["pag"] = array(1, 0);

$a = 0;
$Query_Atem = $conexao->prepare("SELECT * FROM tabela_atendentes a INNER JOIN usuario_acesso u ON a.codigo_atendente = u.CODIGO_USR WHERE u.EXP = '1' ORDER BY a.nome_atendente ASC ");
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
                  <input class="form-check-input" type="radio" name="OpOrc" value="CodOpOrc" id="OrcCod" />
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
                  <input class="form-check-input" type="radio" name="produto" value="transporte" id="transporte" />
                  <label class="form-check-label" for="transporte"> Por Modalidade do Frete </label>
                </div>
                <div class="mb-3">
                  <select class="form-select" name="transportetipo">
                    <option>Selecione o tipo de cliente</option>
                    <option value="COR">CORREIOS</option>
                    <option value="EMC">RETIRADA</option>
                  </select>
                </div>
               
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
                  <div class="col-12 card">
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
                      <input class="form-check-input" type="radio" name="periodo" value="todos" checked id="portodis" />
                      <label class="form-check-label" for="portodis"> Todos </label>
                    </div>
                  </div>
                  </div>
              </div>
              <!--Campos-->
              <div class="tab-pane fade" id="horizontal-campos">
                <div class="col-md">
                  <small class="text-light fw-semibold d-block">Selecione os campos que deseja em seu relatório:</small>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="checkbox" name="campos1" checked id="Código" value="tabela_ordens_producao.cod" />
                    <label class="form-check-label" for="Código">Código</label>
                  </div>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="checkbox" name="campos2"  id="Código da OP" value="tabela_ordens_producao.cod" />
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
                    <input class="form-check-input" type="checkbox" name="campos13" id="Descrição do Produto" value="descricao_produto" checked/>
                    <label class="form-check-label" for="Descrição do Produto">Descrição do Produto</label>
                  </div>
                </div>
              </div>
              <!--Ordenar-->
              <div class="tab-pane fade" id="horizontal-ordenar">
                <div class="col-md">
                  <small class="text-light fw-semibold d-block">Ordenar por:</small>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Código OP Crescente" value="f.CODIGO_OP ASC" />
                    <label class="form-check-label" for="Por Código OP Crescente">Por Código OP Crescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Código OP Decrescente" value="f.CODIGO_OP DESC" />
                    <label class="form-check-label" for="Por Código OP Decrescente">Por Código OP Decrescente</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Emissor" value="f.EMISSOR DESC" />
                    <label class="form-check-label" for="Por Emissor">Por Emissor</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Tipo de Pessoa" value="o.tipo_cliente DESC" />
                    <label class="form-check-label" for="Por Tipo de Pessoa">Por Tipo de Pessoa</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Valor Crescente" value="f.VLR_FAT ASC" />
                    <label class="form-check-label" for="Por Valor Crescente">Por Valor Crescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Valor Decrescente" value="f.VLR_FAT DESC" />
                    <label class="form-check-label" for="Por Valor Decrescente">Por Valor Decrescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Data de Emissão Mais Atual" value="f.DT_FAT DESC" />
                    <label class="form-check-label" for="Por Data de Emissão Mais Atual">Por Data de Emissão Mais
                      Atual</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ordenar" id="Por Data de Emissão Mais Antiga" value="f.DT_FAT ASC" />
                    <label class="form-check-label" for="Por Data de Emissão Mais Antiga">Por Data de Emissão Mais
                      Antiga</label>
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
                  <input class="form-check-input" type="hidden" name="campos1" checked id="Código" value="tabela_ordens_producao.cod">
                  <input class="form-check-input" type="hidden" name="campos13" checked id="Status" value="status" />
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