<?php    include_once("../html/../html/navbar.php");$_SESSION["pag"] = array( 1,0) ;?>
            
            
              <div class="card mb-4">
                <h5 class="card-header">Relatórios - Papéis</h5>
                <div class="card-body">
                  <div class="row">                            
                    <div class="col-lg-12">
                      <div class="demo-inline-spacing mt-3">
                        <div class="list-group list-group-horizontal-md text-md-center">
                          <a
                            class="list-group-item list-group-item-action active"
                            id="home-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-home"
                            >Papel</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="profile-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-profile"
                            >Ordem de Produção</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="messages-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-messages"
                            >Período</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="settings-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-campos"
                            >Campos</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="settings-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-ordenar"
                            >Ordenar</a
                          >
                        </div>
                        <!--Papel-->
                        <div class="tab-content px-0 mt-0">
                          <div class="tab-pane fade show active" id="horizontal-home">
                          <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                            <label class="form-check-label" for="defaultCheck1"> Por Código do Papel </label>
                          </div>
                              <div class="mb-3">
                                <input id="defaultInput" class="form-control" type="text" placeholder="Digite o código aqui" />
                              </div>
                              <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Por Descrição do Papel </label>
                              </div>
                              <div class="mb-3">
                                <input id="defaultInput" class="form-control" type="text" placeholder="Digite a descrição aqui" />
                              </div>
                              <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1">Todos </label>
                              </div>
                          </div>
                          <!--Ordem de Produção-->
                          <div class="tab-pane fade" id="horizontal-profile">
                              <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1">Ordme de Produção (Código)</label>
                              </div>
                              <div class="mb-3">
                                <input id="defaultInput" class="form-control" type="text" placeholder="Digite o código aqui" />
                              </div>
                              <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Todos </label>
                              </div>                             
                          </div>
                          <!--Período-->
                          <div class="tab-pane fade" id="horizontal-messages">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                              <label class="form-check-label" for="inlineCheckbox2">Por dia de Emissão</label>
                            </div>
                            <div class="mb-3 row">
                                  <div class="col-md-12">
                                    <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                                  </div>
                                </div>
                                <div class="form-check form-check-inline">
                              <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                              <label class="form-check-label" for="inlineCheckbox2">Por dia de Entrega</label>
                            </div>
                            <div class="mb-3 row">
                                  <div class="col-md-12">
                                    <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                                  </div>
                            </div>
                             <div class="form-check form-check-inline">
                              <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                              <label class="form-check-label" for="inlineCheckbox2">Por Período de Data de Emissão</label>
                            </div>
                            <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-2 col-form-label">Início</label>
                                  <div class="col-md-10">
                                    <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                                  </div>
                            </div>
                            <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-2 col-form-label">Fim</label>
                                  <div class="col-md-10">
                                    <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                                  </div>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                              <label class="form-check-label" for="inlineCheckbox2">Por Período de Data de Entrega</label>
                            </div>
                            <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-2 col-form-label">Início</label>
                                  <div class="col-md-10">
                                    <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                                  </div>
                            </div>
                            <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-2 col-form-label">Fim</label>
                                  <div class="col-md-10">
                                    <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                                  </div>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                              <label class="form-check-label" for="inlineCheckbox2">Todos</label>
                            </div>
                          </div>
                          <!--Campos-->
                          <div class="tab-pane fade" id="horizontal-campos">
                          <div class="col-md">
                          <small class="text-light fw-semibold d-block">Selecione os campos que deseja em seu relatório:</small>
                          <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" />
                            <label class="form-check-label" for="inlineCheckbox1">Quantidade Gasta</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Descrição do Papel</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Código do Papel</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Preço Unitário</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Gramatura</label>
                          </div>                           
                        </div>
                          </div>
                           <!--Ordenar-->
                           <div class="tab-pane fade" id="horizontal-ordenar">
                          <div class="col-md">
                          <small class="text-light fw-semibold d-block">Ordenar por:</small>
                          <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" />
                            <label class="form-check-label" for="inlineCheckbox1">Quantidade Gasta Crescente</label>
                          </div>     
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Quantidade Gasta Decrescente</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Descrição do Papel</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Código do Papel</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Sem Ordenação</label>
                          </div><br></br>
                        </div> 
                        <button type="button" class="btn btn-info">Gerar Relatório</button>                      
                        </div>
                      </div>
                    </div>
                         
                    <!--/ Custom content with heading -->
                  </div>
                </div>
              </div>
            </div>
                     

<?php  include_once("../html/../html/navbar-dow.php"); ?>