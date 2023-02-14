<?php /* |--  --| */   include_once("../html/../html/navbar.php");$_SESSION["pag"] = array( 1,0) ;?>
            
            
              <div class="card mb-4">
                <h5 class="card-header">Relatórios - Orçamentos</h5>
                <div class="card-body">
                  <div class="row">                            
                    <div class="col-lg-12">
                      <small class="text-light fw-semibold">Horizontal</small>
                      <div class="demo-inline-spacing mt-3">
                        <div class="list-group list-group-horizontal-md text-md-center">
                          <a
                            class="list-group-item list-group-item-action active"
                            id="home-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-home"
                            >Cliente</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="profile-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-profile"
                            >Orçamento</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="messages-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-messages"
                            >Produto</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="settings-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-settings"
                            >Emissor</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="settings-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-periodo"
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
                        <!--Clientes-->
                        <div class="tab-content px-0 mt-0">
                          <div class="tab-pane fade show active" id="horizontal-home">
                          <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                            <label class="form-check-label" for="defaultCheck1"> Por Código </label>
                          </div>
                                <div class="mb-3">
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                                  <option selected>Selecione o tipo de cliente</option>
                                  <option value="1">Pessoa Física</option>
                                  <option value="2">Pessoa Júridica</option>
                                </select>
                              </div>
                              <div class="mb-3">
                                <input id="defaultInput" class="form-control" type="text" placeholder="Digite o código aqui" />
                              </div>
                              <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Por Nome </label>
                              </div>
                              <div class="mb-3">
                                <input id="defaultInput" class="form-control" type="text" placeholder="Digite o nome aqui" />
                              </div>
                              <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Por Tipo de Pessoa </label>
                              </div>
                              <div class="mb-3">
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                                  <option selected>Selecione o tipo de cliente</option>
                                  <option value="1">Pessoa Física</option>
                                  <option value="2">Pessoa Júridica</option>
                                </select>
                              </div>
                              <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Todos </label>
                              </div>
                          </div>
                          <!--OP/Orçamentos-->
                          <div class="tab-pane fade" id="horizontal-profile">
                              <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1">Por Código</label>
                              </div>
                              <div class="mb-3">
                                <input id="defaultInput" class="form-control" type="text" placeholder="Digite o código aqui" />
                              </div>
                              <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Por Status </label>
                              </div>
                              <div class="mb-3">
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                                  <option selected>Selecione...</option>
                                  <option value="1">1 - Em Avaliação</option>
                                  <option value="2">2 - Enviado para Produção</option>
                                  <option value="3">3 - Enviado para o OD</option>
                                  <option value="4">4 - Autorizado pelo OD (Gráfica)</option>
                                  <option value="5">5 - Não Autorizado pelo OD (Gráfica)</option>
                                  <option value="6">6 - Não Autorizado pelo Cliente</option>
                                  <option value="7">7 - Enviado para Expedição</option>
                                  <option value="8">8 - Entregue Parcialmente</option>
                                  <option value="9">9 - Entregue</option>
                                  <option value="10">10 - Entrega Cancelada</option>
                                  <option value="11">11 - Autorizado pelo OD (Cliente)</option>
                                  <option value="12">12 - Não Autorizado pelo OD (Cliente) </option>
                                  <option value="13">13 - Cancelada</option>
                                  <option value="14">14 - Canelada por Prazo</option>
                                  <option value="15">15 - Cancelada Parcialmente</option>
                                </select>
                              </div>
                              <div class="mb-3">
                                <input id="defaultInput" class="form-control" type="text" placeholder="Digite o código aqui" />
                              </div>
                              <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Por Valor Total Entre </label>
                              </div>
                                <div class="input-group input-group-merge">
                                  <span class="input-group-text">$</span>
                                  <input
                                    type="text"
                                    class="form-control"
                                    placeholder="100"
                                    aria-label="Amount (to the nearest dollar)"
                                  />
                                  <span class="input-group-text">.00</span>
                                </div>
                                <div class="input-group input-group-merge">
                                  <span class="input-group-text">$</span>
                                  <input
                                    type="text"
                                    class="form-control"
                                    placeholder="100"
                                    aria-label="Amount (to the nearest dollar)"
                                  />
                                  <span class="input-group-text">.00</span>
                                </div>
                                <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Todos </label>
                              </div>
                          </div>
                          <!--Produto-->
                          <div class="tab-pane fade" id="horizontal-messages">
                          <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Por Código </label>
                              </div>
                              <div class="mb-3">
                                <input id="defaultInput" class="form-control" type="text" placeholder="Digite o código aqui" />
                              </div>
                              <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Por Descrição </label>
                              </div>
                              <div class="mb-3">
                                <input id="defaultInput" class="form-control" type="text" placeholder="Digite a descrição aqui" />
                              </div>
                              <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Por Tipo </label>
                              </div>
                              <div class="mb-3">
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                                  <option selected>Selecione o tipo de produto</option>
                                  <option value="1">Folha</option>
                                  <option value="2">Bloco</option>
                                  <option value="3">Livro</option>
                                </select>
                              </div>
                              <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Todos </label>
                              </div>
                          </div>
                          <!--Emissor-->
                          <div class="tab-pane fade" id="horizontal-settings">
                          <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Por Emissor </label>
                              </div>
                              <div class="mb-3">
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                                  <option selected>Selecione o emissor</option>
                                  <option value="1">NAS - 1º Sgt COM Nascimento</option>
                                  <option value="2">DGO - 1º Sgt INT Domingos</option>
                                  <option value="3">MOR - SD NQR2C Morais</option>
                                  <option value="4">EDN - 3º Sgt Ednubia</option>
                                  <option value="5">GIR - 3º Sgt Stt Girlane</option>
                                  <option value="6">FIH - SD NQR2C Filho</option>
                                </select>
                              </div>
                              <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Todos </label>
                              </div>
                          </div>
                             <!--Período-->
                             <div class="tab-pane fade" id="horizontal-periodo">
                             <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Por dia de Emissão </label>
                              </div>
                                <div class="mb-3 row">
                                  <div class="col-md-12">
                                    <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                                  </div>
                                </div>
                                <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Por dia de Entrega </label>
                              </div>
                                <div class="mb-3 row">
                                  <div class="col-md-12">
                                    <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                                  </div>
                                </div>
                                <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Por Périodo - Data de Emissão </label>
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
                                  <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Por Périodo - Data de Entrega </label>
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
                                  <div class="form-check mt-3">
                               <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                                <label class="form-check-label" for="defaultCheck1"> Todos </label>
                                  </div>
                                    </div>                     
                          <!--Campos-->
                          <div class="tab-pane fade" id="horizontal-campos">
                          <div class="col-md">
                          <small class="text-light fw-semibold d-block">Selecione os campos que deseja em seu relatório:</small>
                          <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" />
                            <label class="form-check-label" for="inlineCheckbox1">Código da OP (Se Houver)</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Código do Orçamento</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Código do Cliente</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Código do Produto</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Descrição do Produto</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Tipo de Pessoa</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Quantidade</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Valor Unitário</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Valor Total</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">CIF</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Desconto</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Frete</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Data de Emissão</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Data de Validade</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Emissor</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Npme do Cliente</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Status</label>
                          </div>                                   
                        </div>
                          </div>
                          <!--Ordenar-->
                          <div class="tab-pane fade" id="horizontal-ordenar">
                          <div class="col-md">
                          <small class="text-light fw-semibold d-block">Ordenar por:</small>
                          <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" />
                            <label class="form-check-label" for="inlineCheckbox1">Por Código de Orçamento</label>
                          </div>     
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Por Quantitatidade Crescente</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Por Quantidade Decrescente</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Por Emissor</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Por Tipo de Pessoa</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Por Valor Total</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Por % do CIF</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Por % do Desconto</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Por Valor do Frete</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Por Data de Emissão</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Por Data de Validade</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" />
                            <label class="form-check-label" for="inlineCheckbox2">Sem Ordenação</label>
                          </div><br></br>
                          <div class="col-md">
                          <small class="text-light fw-semibold d-block">Orientação:</small>
                            <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" />
                            <label class="form-check-label" for="inlineCheckbox1">Retrato</label>
                          </div>
                          <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" />
                            <label class="form-check-label" for="inlineCheckbox1">Paisagem</label>
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
                     

<?php /* |--  --| */ include_once("../html/../html/navbar-dow.php"); ?>