<?php /* |-1---000!  !-! */ include_once("../html/../html/navbar.php");
$_SESSION["pag"] = array(1, 0); ?>
<div class=" relatorio-- "></div>

<div class="card mb-4">
  <h5 class="card-header">Relatórios - Papéis</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="demo-inline-spacing mt-3">
          <div class="list-group list-group-horizontal-md text-md-center">
            <a class="list-group-item list-group-item-action active" id="home-list-item" data-bs-toggle="list" href="#horizontal-home">Papel</a>
            <a class="list-group-item list-group-item-action" id="profile-list-item" data-bs-toggle="list" href="#horizontal-profile">Ordem de Produção</a>
            <a class="list-group-item list-group-item-action" id="messages-list-item" data-bs-toggle="list" href="#horizontal-messages">Período</a>
            <a class="list-group-item list-group-item-action" id="settings-list-item" data-bs-toggle="list" href="#horizontal-campos">Campos</a>
            <a class="list-group-item list-group-item-action" id="settings-list-item" data-bs-toggle="list" href="#horizontal-ordenar">Ordenar</a>
          </div>
          <!--Papel-->
          <form target="_blank" action="relatorio-quantidade-papel-gasta.php" method="POST">
            <div class="tab-content px-0 mt-0">
              <div class="tab-pane fade show active" id="horizontal-home">
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="tipopapel" value="codpapel" id="codpapel" />
                  <label class="form-check-label" for="codpapel"> Por Código do Papel </label>
                </div>
                <div class="mb-3">
                  <input id="defaultInput" class="form-control" name="papelcod" type="text" placeholder="Digite o código aqui" />
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="tipopapel" value="descpapel" id="descpapel" />
                  <label class="form-check-label" for="descpapel"> Por Descrição do Papel </label>
                </div>
                <div class="mb-3">
                  <input id="defaultInput" class="form-control" name="papeldesc" type="text" placeholder="Digite a descrição aqui" />
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="tipopapel" checked value="todostipo" id="todostipo" />
                  <label class="form-check-label" for="todostipo">Todos </label>
                </div>
              </div>
              <!--Ordem de Produção-->
              <div class="tab-pane fade" id="horizontal-profile">
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="orden" value="ordcod" id="ordcod" />
                  <label class="form-check-label" for="ordcod">Ordme de Produção (Código)</label>
                </div>
                <div class="mb-3">
                  <input id="defaultInput" class="form-control" name="numerocod" type="text" placeholder="Digite o código aqui" />
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" type="radio" name="orden" checked id="todosordcod" />
                  <label class="form-check-label" for="todosordcod"> Todos </label>
                </div>
              </div>
              <!--Período-->
              <div class="tab-pane fade" id="horizontal-messages">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="periodo" value="papelemiss" value="emiss" />
                  <label class="form-check-label" for="papelemiss">Por dia de Emissão</label>
                </div>
                <div class="mb-3 row">
                  <div class="col-md-12">
                    <input class="form-control" type="date" name="dateemiss" id="html5-date-input" />
                  </div>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="periodo" value="papelentrega" />
                  <label class="form-check-label" for="papelentrega">Por dia de Entrega</label>
                </div>
                <div class="mb-3 row">
                  <div class="col-md-12">
                    <input class="form-control" type="date" name="dataentrega" id="html5-date-input" />
                  </div>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="periodo" value="peridoemiss" value="peridoemiss" />
                  <label class="form-check-label" for="peridoemiss">Por Período de Data de Emissão</label>
                </div>
                <div class="mb-3 row">
                  <label for="html5-date-input" class="col-md-2 col-form-label">Início</label>
                  <div class="col-md-10">
                    <input class="form-control" type="date" name="periodoemiss" id="html5-date-input" />
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="html5-date-input" class="col-md-2 col-form-label">Fim</label>
                  <div class="col-md-10">
                    <input class="form-control" type="date" name="fimemiss" id="html5-date-input" />
                  </div>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="periodo" value="peridioentrega" value="peridioentrega" />
                  <label class="form-check-label" for="peridioentrega">Por Período de Data de Entrega</label>
                </div>
                <div class="mb-3 row">
                  <label for="html5-date-input" class="col-md-2 col-form-label">Início</label>
                  <div class="col-md-10">
                    <input class="form-control" type="date" name="dataentegaper" id="html5-date-input" />
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="html5-date-input" class="col-md-2 col-form-label">Fim</label>
                  <div class="col-md-10">
                    <input class="form-control" type="date" name="fimentrega" id="html5-date-input" />
                  </div>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="periodo" id="todosperidodo" checked value="todosperidodo" />
                  <label class="form-check-label" for="todosperidodo">Todos</label>
                </div>
              </div>
              <!--Campos-->
              <div class="tab-pane fade" id="horizontal-campos">
                <div class="col-md">
                  <small class="text-light fw-semibold d-block">Selecione os campos que deseja em seu relatório:</small>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="radio" name="campos1" id="Quantidade" name="Quantidade" value="Quantidade" checked />
                    <input class="form-check-input" type="hidden" name="campos1" id="Quantidade" name="Quantidade" value="Quantidade" />
                    <label class="form-check-label" for="Quantidade">Quantidade Gasta</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="campos2" id="Descrição" name="Descrição" value="Descricao" checked />
                    <label class="form-check-label" for="Descrição">Descrição do Papel</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="campos3" id="Codigo" name="Codigo" value="Codigo" />
                    <input class="form-check-input" type="hidden" name="campos3" id="Codigo" name="Codigo" value="Codigo" />
                    <label class="form-check-label" for="Codigo">Código do Papel</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="campos4" id="Preco" value="Preco" />
                    <label class="form-check-label" for="Preco">Preço Unitário</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="campos5" id="Gramatura" value="Gramatura" />
                    <label class="form-check-label" for="Gramatura">Gramatura</label>
                  </div>
                </div>
              </div>
              <!--Ordenar-->
              <div class="tab-pane fade" id="horizontal-ordenar">
                <div class="col-md">
                  <small class="text-light fw-semibold d-block">Ordenar por:</small>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="radio" id="Gasta" name="order" value=" ORDER BY tabela_calculos_op.qtd_folhas_total ASC" />
                    <label class="form-check-label" for="Gasta">Quantidade Gasta Crescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="Decrescente" name="order" value=" ORDER BY tabela_calculos_op.qtd_folhas_total DESC" />
                    <label class="form-check-label" for="Decrescente">Quantidade Gasta Decrescente</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="descricaoAsc" name="order" value=" ORDER BY tabela_papeis.descricao ASC" />
                    <label class="form-check-label" for="descricaoAsc">Descrição do Papel</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="codigoasc" name="order" value=" ORDER BY tabela_papeis.cod ASC" />
                    <label class="form-check-label" for="codigoasc">Código do Papel</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" checked id="semordem" name="order" value="semordem" />
                    <label class="form-check-label" for="semordem">Sem Ordenação</label>
                  </div><br></br>
                </div>
                <button type="submit" class="btn btn-info">Gerar Relatório</button>
              </div>
            </div>
        </div>

        <!--/ Custom content with heading -->
      </div>
    </div>
  </div>
</div>


<?php /* |-1---000!  !-! */ include_once("../html/../html/navbar-dow.php"); ?>