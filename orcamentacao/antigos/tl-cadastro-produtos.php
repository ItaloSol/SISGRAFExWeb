<?php /* |||  ||| */ include_once("../html/navbar.php"); $_SESSION["pag"] = array( 6,0);?>


              <!-- Menu da Esquerda Cadastro de Produtos (Produção - PP) -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Cadastro de Produtos (Produção - PP)</h5>                    
                    </div>
                    <div class="card-body">
                      <form>                      
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Largura</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="Insira a largura do produto" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Altura</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira a altura do produto" />
                        </div>
                        <div class="mb-3 row">
                        <label for="html5-number-input" class="col-md-2 col-form-label">Qtd de Folhas</label>
                        <div class="col-md-10">
                          <input class="form-control" type="number" value="1" id="html5-number-input" />
                        </div>
                      </div>  
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Tipo</label>
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                          <option selected>Selecione...</option>                       
                          <option value="1">Folha</option>
                          <option value="2">Bloco</option>
                          <option value="3">Licro</option>n>
                        </select>
                      </div>                                                 
                      </form> 
                      <div class="divider divider-primary">
                        <div class="divider-text">Papéis</div>
                      </div>
                      <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Código</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="Código do Cliente" />
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Tipo</label>
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">                   
                          <option selected>Selecione...</option>
                          <option value="1">Capa</option>
                          <option value="2">1ª Via</option>
                          <option value="3">2ª Via</option>n>
                          <option value="4">3ª Via</option>
                        </select>
                      </div>                        
                      <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Orelha</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="Insira o tamanho da orelha" />
                      </div> 
                      <div class="mb-3 row">
                        <label for="html5-number-input" class="col-md-2 col-form-label">Cores Frente e Verso</label>
                        <div class="col-md-10">
                          <input class="form-control" type="number" value="1" id="html5-number-input" />
                          <input class="form-control" type="number" value="1" id="html5-number-input" /><br></br>                          
                        </div>
                        <button type="button" class="btn btn-primary">Concluir</button>                                                                                  
                    </div>
                    <div class="divider divider-primary">
                        <div class="divider-text">Acabamentos</div>
                      </div>
                  </div>
                </div>
              </div>  
                <!-- Menu Lateral Direita Cadastro de (Pronta Entrega - PE)-->
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Cadastro de Produtos (Pronta Entrega - PE)</h5>
                    </div>
                    <div class="card-body">
                      <form>                     
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Largura</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="Insira a largura" />
                        </div> 
                          <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Altura</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira a altura" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Espessura</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira a espessura" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Peso</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o peso" />
                        </div>
                        <div class="mb-3 row">
                        <label for="html5-number-input" class="col-md-2 col-form-label">Qtd de Folhas</label>
                        <div class="col-md-10">
                          <input class="form-control" type="number" value="1" id="html5-number-input" />
                        </div>
                        <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Tipo</label>
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                          <option selected>Selecione...</option>
                          <option value="1">Bloco</option>
                          <option value="2">Folha</option>
                          <option value="3">Livro</option>
                        </select>
                        <div class="divider divider-primary">
                        <div class="divider-text">Valores</div>
                      </div>
                      <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" checked />
                            <label class="form-check-label" for="defaultCheck2"> Produto para Pré-venda? </label>
                          </div>
                      <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Valor Unitário (R$)</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o valor" />
                        </div> 
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" checked />
                            <label class="form-check-label" for="defaultCheck2"> Produto Promocional? </label>
                          </div>
                      <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Valor Unitário (R$)</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o peso" />
                        </div>  
                        <div class="mb-3 row">
                        <label for="html5-week-input" class="col-md-2 col-form-label">Início</label>
                        <div class="col-md-10">
                          <input class="form-control" type="week" value="2021-W25" id="html5-week-input" />
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="html5-week-input" class="col-md-2 col-form-label">Fim</label>
                        <div class="col-md-10">
                          <input class="form-control" type="week" value="2021-W25" id="html5-week-input" />
                        </div>
                      </div>                   
                      </div>
                      <div class="divider divider-primary">
                        <div class="divider-text">Estoque</div>
                      </div>
                      <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Estoque Físico</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o valor" />
                        </div> 
                        <div class="divider divider-primary">
                        <div class="divider-text">Pedidos</div>
                      </div>
                      <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Quantidade Mínima</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o valor" />
                        </div> 
                      </div> 
                        <button type="button" class="btn btn-primary">Salvar</button>
                        <button type="button" class="btn btn-danger">Limpar</button>                       
                      </div>
                     </div>                      
                    </div>                      
                        <!-- Botões de Edição -->
                        <div class="card-body">
                      <small class="text-light fw-semibold"></small>
                      <div class="demo-inline-spacing">
                       
                           
                        
                        <button type="button" class="btn btn-danger">Excluir</button>
                        <button type="button" class="btn btn-primary">Salvar</button>
                        <button type="button" class="btn btn-primary">Cancelar</button>      
                             
                        </div><br></br>
                        <!-- Tabela de consulta e edição--> 
                        <div style = "height: 500px; " class ="card">
                <h5 class="card-header">Resultado</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Código</th>
                          <th>Descrição</th>
                          <th>Largura</th>
                          <th>Altura</th>
                          <th>Durabilidade</th>
                          <th>Tipo</th>
                          <th>Valor Unitário</th>
                          <th>Editar</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Angular Project</strong>
                          </td>
                          <td>Albert Cook</td>
                          <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                              <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                title="Lilian Fuller"
                              >
                                <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                              </li>
                              <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                title="Sophia Wilkerson"
                              >
                                <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                              </li>
                              <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                title="Christina Parker"
                              >
                                <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                              </li>
                            </ul>
                          </td>
                          <td><span class="badge bg-label-primary me-1">Active</span></td>
                          <td>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"
                                  ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                >
                                <a class="dropdown-item" href="javascript:void(0);"
                                  ><i class="bx bx-trash me-1"></i> Delete</a
                                >
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong>React Project</strong></td>
                          <td>Barry Hunter</td>
                          <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                              <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                title="Lilian Fuller"
                              >
                                <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                              </li>
                              <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                title="Sophia Wilkerson"
                              >
                                <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                              </li>
                              <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                title="Christina Parker"
                              >
                                <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                              </li>
                            </ul>
                          </td>
                          <td><span class="badge bg-label-success me-1">Completed</span></td>
                          <td>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"
                                  ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                >
                                <a class="dropdown-item" href="javascript:void(0);"
                                  ><i class="bx bx-trash me-1"></i> Delete</a
                                >
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td><i class="fab fa-vuejs fa-lg text-success me-3"></i> <strong>VueJs Project</strong></td>
                          <td>Trevor Baker</td>
                          <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                              <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                title="Lilian Fuller"
                              >
                                <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                              </li>
                              <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                title="Sophia Wilkerson"
                              >
                                <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                              </li>
                              <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                title="Christina Parker"
                              >
                                <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                              </li>
                            </ul>
                          </td>
                          <td><span class="badge bg-label-info me-1">Scheduled</span></td>
                          <td>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"
                                  ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                >
                                <a class="dropdown-item" href="javascript:void(0);"
                                  ><i class="bx bx-trash me-1"></i> Delete</a
                                >
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>Bootstrap Project</strong>
                          </td>
                          <td>Jerry Milton</td>
                          <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                              <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                title="Lilian Fuller"
                              >
                                <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                              </li>
                              <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                title="Sophia Wilkerson"
                              >
                                <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                              </li>
                              <li
                                data-bs-toggle="tooltip"
                                data-popup="tooltip-custom"
                                data-bs-placement="top"
                                class="avatar avatar-xs pull-up"
                                title="Christina Parker"
                              >
                                <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                              </li>
                            </ul>
                          </td>
                          <td><span class="badge bg-label-warning me-1">Pending</span></td>
                          <td>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"
                                  ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                >
                                <a class="dropdown-item" href="javascript:void(0);"
                                  ><i class="bx bx-trash me-1"></i> Delete</a
                                >
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                            

<?php /* |||  ||| */ include_once("../html/navbar-dow.php"); ?>