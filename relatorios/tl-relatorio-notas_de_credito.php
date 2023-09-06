<?php /* |-1  !-1 */ include_once("../html/../html/navbar.php");
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
?>
<div class=" relatorio-- "></div>
<div class="card mb-4">
  <h5 class="card-header">Relatórios - notas de credito</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="demo-inline-spacing mt-3">
          <div class="list-group list-group-horizontal-md text-md-center">
            <a class="list-group-item list-group-item-action active" id="home-list-item" data-bs-toggle="list" href="#horizontal-home">Cliente</a>
            <a class="list-group-item list-group-item-action" id="messages-list-item" data-bs-toggle="list" href="#horizontal-profile">Emissor</a>
            <a class="list-group-item list-group-item-action" id="settings-list-item" data-bs-toggle="list" href="#horizontal-messages">Período</a>
            <a class="list-group-item list-group-item-action" id="settings-list-item" data-bs-toggle="list" href="#horizontal-pagamento">Forma de Pagamento</a>
            <a class="list-group-item list-group-item-action" id="settings-list-item" data-bs-toggle="list" href="#horizontal-ordenar">Campos</a>
            <a class="list-group-item list-group-item-action" id="settings-list-item" data-bs-toggle="list" href="#horizontal-gerar2">Ordenar</a>
          </div>
          <!--Cliente-->
          <form target="_blank" action="relatorio-notas_de_credito.php" method="POST">
            <div class="tab-content px-0 mt-0">
              <div class="tab-pane fade show active" id="horizontal-home">
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="tipo_cliente" value="por_cliente" id="por_cliente" />
                  <label class="form-check-label" for="por_cliente"> Por Cliente único </label>
                </div>
                <div class="mb-3">
                           <label class="form-check-label" name="codigo" value="cod" for="defaultCheck1"> Tipo de Cliente </label>
                            <select class="form-select" name="tipo_cliente_" id="cliente" aria-label="Default select example">
                              <option selected>Selecione o tipo de cliente</option>
                              <option value="1">Pessoa Física</option>
                              <option value="2">Pessoa Júridica</option>
                            </select>
                        </div>
                        <div class="mb-3">

                          <div id="juri" class="mb-3">
                            <input name="usuario0" id="usuario0" class="form-control" type="text" placeholder="Digite o NOME do cliente  juridico" onkeyup="carregar_usuarios(this.value)" />
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
                            <input id="codigo1" name="numero" class="form-control" type="text" style="display: none;" placeholder="Digite o código aqui" />
                            <span id="resultador_123"></span>
                          </div>
                          <input id="numerodocliente" name="numerodocliente" class="form-control" type="text"  placeholder="Digite o código aqui" />

                        </div>
                        <script>
        const selectir = document.getElementById('cliente');
        const juri = document.getElementById('juri');
        const dist = document.getElementById('dis');
        const fisc = document.getElementById('fisc');
        fisc.style.display = 'none';
        juri.style.display = 'none';
        selectir.addEventListener('click', vlr => {
          if (selectir.value == 1) {
            fisc.style.display = 'block';
            juri.style.display = 'none';
            dist.style.display = 'none';
          } else {
            fisc.style.display = 'none';
            juri.style.display = 'block';
            dist.style.display = 'none';
          }
        })
      </script>
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="tipo_cliente" value="tipo_pessoa" id="tipo_pessoa" />
                  <label class="form-check-label" for="tipo_pessoa"> Por Tipo de Pessoa</label>
                </div>
                <div class="mb-3">
                  <select class="form-select" name="tipo_cliente_cli" id="tipo_cliente_cli" aria-label="Default select example">
                    <option selected>Selecione o Tipo de Pessoa</option>
                    <option value="1">Pessoa Física</option>
                    <option value="2">Pessoa Jurídica</option>
                  </select>
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" checked type="radio" name="tipo_cliente" value="todos" id="todos" />
                  <label class="form-check-label"  for="todos">Todos</label>
                </div>
              </div>
              <!--Emissor-->
              <div class="tab-pane fade" id="horizontal-profile">
              <div class="form-check mt-3">
                  <input class="form-check-input" name="por_emissor" type="radio" value="por_operador" id="por_emissor" />
                  <label class="form-check-label" for="por_emissor"> Por Operador </label>
                </div>
                <div class="mb-3">
                  <select class="form-select" name="emissorCod">
                    <option selected>Selecione o Operador</option>
                    <?php 
                    $a = 0;
                    while ($a < $Operadores) {
                      echo '<option value="' . $Codigo[$a] . '">' . $Codigo[$a] . ' - ' . $Nome_Atem[$a] . '</option>';
                      $a++;
                    }
                    ?>
                  </select>
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" checked type="radio" name="por_emissor" value="todos" id="todos_emisro" />
                  <label class="form-check-label" for="todos_emisro">Todos</label>
                </div>
              </div>
              <!--Forma de pagamento-->
              <div class="tab-pane fade" id="horizontal-pagamento">
                <div class="form-check mt-3 ">
        
                  <input class="form-check-input" type="radio"  name="por_forma_pagamento" value="forma_pagamento" id="por_forma_pagamento" />
                  <label  for="por_forma_pagamento" class="col-md-2 col-form-label">Forma de pagamento</label>
                
                  <div class="mb-3">
                           <label class="form-check-label" name="forma_pagamento"  for="defaultCheck1">  </label>
                            <select class="form-select" name="Forma_pagamento_" id="cliente" aria-label="Default select example">
                              <option value="1">PRÉ-EMPENHO</option>
                              <option value="2">TRANSFERICIA ENTRE CONTAS</option>
                              <option value="3">NOTA DE CRÉDITO</option>
                              <option value="4">GRU</option>
                            </select>
                        </div>
                  <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" checked name="por_forma_pagamento" value="todos" id="todos_pagamento" />
                  <label class="form-check-label" for="todos_pagamento">Todos</label>
                </div>
                </div>
              </div>
              <!--Período-->
              <div class="tab-pane fade" id="horizontal-messages">
          
                   
                 
                <div class="form-check mt-3 ">
                <input class="form-check-input" type="radio"  name="periodo" value="por_dia" id="por_dia" />
                  <label  for="por_dia" class="col-md-2 col-form-label">Por dia</label>
                  </div>
                  <div class="col-md-10">
                    <input class="form-control" type="date" name="data_por_dia" value="<?= $hoje ?>" id="data_por_dia" />
              
                </div>
                <div class="form-check mt-3 ">
                <input class="form-check-input" type="radio"  name="periodo" value="por_periodo" id="por_periodo" />
                  <label  for="por_periodo" class="col-md-2 col-form-label">Por Período</label>
                </div>
                  <div class="col-md-10">
                    <label for="html5-date-input" class="col-md-2 col-form-label">Inicío</label>
                    <input class="form-control" type="date" name="data_por_inicio" value="<?= $hoje ?>" id="data_por_inicio" />
                    <label for="html5-date-input" class="col-md-2 col-form-label">Fim</label>
                    <input class="form-control" type="date" name="data_por_fim" value="<?= $hoje ?>" id="data_por_fim" />
                  </div>
                  <div class="form-check mt-3">
                    <input class="form-check-input" type="radio" checked name="periodo" value="todos" id="todos_periodo" />
                    <label class="form-check-label" for="todos_periodo">Todos</label>
                  </div>
                
              </div>
              <div class="tab-pane fade" id="horizontal-ordenar">
                <div class="col-md">
                  <small class="text-light fw-semibold d-block">Selecione os campos</small>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="checkbox" checked id="codigo" name="codigo" value="codigo" />
                    <label class="form-check-label" for="codigo">Código</label>
                  </div>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="checkbox" checked id="forma_de_pagamento" name="forma_de_pagamento" value="forma_de_pagamento" />
                    <label class="form-check-label" for="forma_de_pagamento">Forma de Pagamento</label>
                  </div>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="checkbox" checked id="emissor" name="emissor" value="emissor" />
                    <label class="form-check-label" for="emissor">Emissor</label>
                  </div>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="checkbox" checked id="codigo_do_cliente" name="codigo_do_cliente" value="codigo_do_cliente" />
                    <label class="form-check-label" for="codigo_do_cliente">Código do cliente</label>
                  </div>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="checkbox" checked id="nome_do_cliente" name="nome_do_cliente" value="nome_do_cliente" />
                    <label class="form-check-label" for="nome_do_cliente">Nome do cliente</label>
                  </div>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="checkbox" checked id="tipo_de_pessoa" name="tipo_de_pessoa" value="tipo_de_pessoa" />
                    <label class="form-check-label" for="tipo_de_pessoa">Tipo de Pessoa</label>
                  </div>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="checkbox" checked id="valor" name="valor" value="valor" />
                    <label class="form-check-label" for="valor">Valor</label>
                  </div>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="checkbox" checked id="data" name="data" value="data" />
                    <label class="form-check-label" for="data">Data</label>
                  </div>
                  <br></br>
                </div>

              </div>

              <!--Campos-->
              <div class="tab-pane fade" id="horizontal-gerar2">
                <div class="col-md">
                  <small class="text-light fw-semibold d-block">Ordenar por:</small>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="radio" id="Gasta" name="order" value=" tabela_notas.cod ASC  " />
                    <label class="form-check-label" for="Gasta">Por Código Crescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="Decrescente" name="order" value=" tabela_notas.cod DESC  " />
                    <label class="form-check-label" for="Decrescente">Por Código Decrescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="descricaoAsc" name="order" value=" tabela_notas.forma_pagamento ASC  " />
                    <label class="form-check-label" for="descricaoAsc">Por Forma de Pagamento</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="codigoasc" name="order" value=" tabela_notas.cod_emissor ASC  " />
                    <label class="form-check-label" for="codigoasc">Por Emissor</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"  id="semordem" name="order" value=" tabela_notas.tipo_pessoa DESC " />
                    <label class="form-check-label" for="semordem">Por Tipo de Pessoa</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="Crescente" name="order" value=" tabela_notas.valor ASC  " />
                    <label class="form-check-label" for="Crescente">Por Valor Crescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="Decrescente__" name="order" value=" tabela_notas.valor DESC " />
                    <label class="form-check-label" for="Decrescente__">Por Valor Decrescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="Atual" name="order" value=" tabela_notas.data DESC " />
                    <label class="form-check-label" for="Atual">Por Data Mais Atual</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="Antiga" name="order" value=" tabela_notas.data ASC " />
                    <label class="form-check-label" for="Antiga">Por Data Mais Antiga</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" checked id="Ordenação" name="order" value="null" />
                    <label class="form-check-label" for="Ordenação">Sem Ordenação</label>
                  </div>
                  <br></br>
                </div>
                <button type="submit" name="submit" class="btn btn-info">Gerar Relatório</button>
              </div>
            </div>

            <!--/ Custom content with heading -->
        </div>
      </div>
    </div>
  </div>


  <?php /* |-1  !-1 */ include_once("../html/../html/navbar-dow.php"); ?>