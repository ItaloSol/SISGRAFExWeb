<?php /* |-=!  !-! */ include_once("../html/../html/navbar.php");
$_SESSION["pag"] = array(1, 0); ?>
<div class=" relatorio-- "></div>
<div class="card mb-4">
  <h5 class="card-header">Relatórios - Notas de Crédito</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="demo-inline-spacing mt-3">
          <div class="list-group list-group-horizontal-md text-md-center">
            <a class="list-group-item list-group-item-action active" id="home-list-item" data-bs-toggle="list" href="#horizontal-home">Cliente</a>
            <a class="list-group-item list-group-item-action" id="profile-list-item" data-bs-toggle="list" href="#horizontal-profile">Emissor</a>
            <a class="list-group-item list-group-item-action" id="messages-list-item" data-bs-toggle="list" href="#horizontal-messages">Período</a>
            <a class="list-group-item list-group-item-action" id="settings-list-item" data-bs-toggle="list" href="#horizontal-campos">Pagamentos</a>
            <a class="list-group-item list-group-item-action" id="settings-list-item" data-bs-toggle="list" href="#horizontal-ordenar">Campos</a>
            <a class="list-group-item list-group-item-action" id="settings-list-item" data-bs-toggle="list" href="#horizontal-gerar">Ordenar</a>
          </div>
          <!--Cliente-->
          <form target="_blank" action="relatorio-quantidade-papel-gasta.php" method="POST">
            <div class="tab-content px-0 mt-0">
              <div class="tab-pane fade show active" id="horizontal-home">
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="tipopapel" value="codpapel" id="codpapel" />
                  <label class="form-check-label" for="codpapel"> Por Código do Papel </label>
                </div>
                <div class="mb-3">

                  <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                    <option selected>Selecione o tipo de pessoa</option>
                    <option value="1">1 - Pessoa Física (PF)</option>
                    <option value="2">2 - PEssoa Júridica</option>
                  </select>
                </div>
                <div>
                  <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Insira o Código" aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="tipopapel" value="codpapel" id="codpapel" />
                  <label class="form-check-label" for="codpapel"> Por Nome </label>
                </div>
                <div>
                  <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Insira o Código" aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="tipopapel" value="codpapel" id="codpapel" />
                  <label class="form-check-label" for="codpapel"> Por Tipo de Pessoa</label>
                </div>
                <div class="mb-3">
                  <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                    <option selected>Selecione o Tipo de Pessoa</option>
                    <option value="1">Pessoa Física</option>
                    <option value="2">Pessoa Jurídica</option>
                  </select>
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="tipopapel" value="codpapel" id="codpapel" />
                  <label class="form-check-label" for="codpapel">Todos</label>
                </div>
              </div>
              <!--Emissor-->
              <div class="tab-pane fade" id="horizontal-profile">
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="tipopapel" value="codpapel" id="codpapel" />
                  <label class="form-check-label" for="codpapel">Por Emissor</label>
                </div>
                <div class="mb-3">
                  <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                    <option selected>Selecione o emissor</option>
                    <option value="1">Emissor 1</option>
                    <option value="2">Emissor 2</option>
                    <option value="3">Emissor 3</option>
                  </select>
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="tipopapel" value="codpapel" id="codpapel" />
                  <label class="form-check-label" for="codpapel">Todos</label>
                </div>
              </div>
              <!--Período-->
              <div class="tab-pane fade" id="horizontal-messages">
                <div class="mb-3 row">
                  <label for="html5-date-input" class="col-md-2 col-form-label">Por dia</label>
                  <div class="col-md-10">
                    <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="html5-date-input" class="col-md-2 col-form-label">Por Período</label>
                  <div class="col-md-10">
                    <label for="html5-date-input" class="col-md-2 col-form-label">Inicío</label>
                    <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                    <label for="html5-date-input" class="col-md-2 col-form-label">Fim</label>
                    <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                  </div>
                  <div class="form-check mt-3">
                    <input class="form-check-input" type="radio" name="tipopapel" value="codpapel" id="codpapel" />
                    <label class="form-check-label" for="codpapel">Todos</label>
                  </div>
                </div>
              </div>
              <!--Pagamentos-->
              <div class="tab-pane fade" id="horizontal-campos">
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="tipopapel" value="codpapel" id="codpapel" />
                  <label class="form-check-label" for="codpapel">Por Forma de Pagamento</label>
                  <div class="mb-3">
                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                      <option selected>Selecione a forma de pagamento</option>
                      <option value="1">1 - Pré-Empenho</option>
                      <option value="2">2 - Transferência entre contas</option>
                      <option value="3">3 - Nota de Crédito</option>
                      <option value="4">4 - GRU</option>
                    </select>
                  </div>
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="tipopapel" value="codpapel" id="codpapel" />
                  <label class="form-check-label" for="codpapel">Todos</label>
                </div>
              </div>
              <!--Campos-->
              <div class="tab-pane fade" id="horizontal-ordenar">
                <div class="col-md">
                  <small class="text-light fw-semibold d-block">Selecione os campos</small>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="radio" id="Gasta" name="order" value=" ORDER BY tabela_calculos_op.qtd_folhas_total ASC" />
                    <label class="form-check-label" for="Gasta">Código</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="Decrescente" name="order" value=" ORDER BY tabela_calculos_op.qtd_folhas_total DESC" />
                    <label class="form-check-label" for="Decrescente">Forma de Pagamento</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="descricaoAsc" name="order" value=" ORDER BY tabela_papeis.descricao ASC" />
                    <label class="form-check-label" for="descricaoAsc">Emissor</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="codigoasc" name="order" value=" ORDER BY tabela_papeis.cod ASC" />
                    <label class="form-check-label" for="codigoasc">Código do Cliente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" checked id="semordem" name="order" value="semordem" />
                    <label class="form-check-label" for="semordem">Nome do Cliente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="codigoasc" name="order" value=" ORDER BY tabela_papeis.cod ASC" />
                    <label class="form-check-label" for="codigoasc">Tipo de Pessoa</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="codigoasc" name="order" value=" ORDER BY tabela_papeis.cod ASC" />
                    <label class="form-check-label" for="codigoasc">Valor</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="codigoasc" name="order" value=" ORDER BY tabela_papeis.cod ASC" />
                    <label class="form-check-label" for="codigoasc">Data</label>
                  </div>
                  <br></br>
                </div>

              </div>
              <!--Pagamentos-->
              <div class="tab-pane fade" id="horizontal-gerar">
                <div class="col-md">
                  <small class="text-light fw-semibold d-block">Ordenar por:</small>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="radio" id="Gasta" name="order" value=" ORDER BY tabela_calculos_op.qtd_folhas_total ASC" />
                    <label class="form-check-label" for="Gasta">Por Códigp Crescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="Decrescente" name="order" value=" ORDER BY tabela_calculos_op.qtd_folhas_total DESC" />
                    <label class="form-check-label" for="Decrescente">Por Código Decrescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="descricaoAsc" name="order" value=" ORDER BY tabela_papeis.descricao ASC" />
                    <label class="form-check-label" for="descricaoAsc">Por Forma de Pagamento</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="codigoasc" name="order" value=" ORDER BY tabela_papeis.cod ASC" />
                    <label class="form-check-label" for="codigoasc">Por Emissor</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" checked id="semordem" name="order" value="semordem" />
                    <label class="form-check-label" for="semordem">Por Tipo de Pessoa</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="codigoasc" name="order" value=" ORDER BY tabela_papeis.cod ASC" />
                    <label class="form-check-label" for="codigoasc">Por Valor Crescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="codigoasc" name="order" value=" ORDER BY tabela_papeis.cod ASC" />
                    <label class="form-check-label" for="codigoasc">Por Valor Decrescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="codigoasc" name="order" value=" ORDER BY tabela_papeis.cod ASC" />
                    <label class="form-check-label" for="codigoasc">Por Data Mais Atual</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="codigoasc" name="order" value=" ORDER BY tabela_papeis.cod ASC" />
                    <label class="form-check-label" for="codigoasc">Por Data Mais Antiga</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="codigoasc" name="order" value=" ORDER BY tabela_papeis.cod ASC" />
                    <label class="form-check-label" for="codigoasc">Sem Ordenação</label>
                  </div>
                  <br></br>
                </div>
                <!-- <button type="submit" class="btn btn-info">Gerar Relatório</button> -->
              </div>
            </div>

            <!--/ Custom content with heading -->
        </div>
      </div>
    </div>
  </div>


  <?php /* |-=!  !-! */ include_once("../html/../html/navbar-dow.php"); ?>