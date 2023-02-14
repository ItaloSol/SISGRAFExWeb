             <!-- Div da Direita (Cadastro de Clientes) -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Cadastro de Clientes</h5>                    
                    </div>
                    <div class="card-body">
                      <form>
                      <div class="mb-3">
                        <label for="defaultSelect" class="form-label">Tipo de Cliente</label>
                        <select id="defaultSelect" class="form-select">
                          <option>Selecione...</option>
                          <option value="1">Pessoa Física</option>
                          <option value="2">Pessoa Jurídica</option>
                        </select>
                      </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Nome do Cliente</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="Insira o nome do cliente" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Nome Fantasia</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o nome fantasia" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Crédito Disponível</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o crédito disponível" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">CPF</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o cpf do cliente" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">CNPJ</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o cnpj do cliente" />
                        </div>    
                          <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Atividade</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira a atividade" />
                        </div>  
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Filial/Coligada/Relacionada</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira a filiar/coligada" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Código do Atendente</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Código do Atendente" />
                        </div> 
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Nome do Atendente</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Nome do Atendente" />
                        </div> 
                        <div>
                        <label for="exampleFormControlTextarea1" class="form-label">Observações do Cliente (Max 1000 Caracteres)</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div><br></br>                              
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                      </form>
                    </div>
                  </div>
                </div>  
                <!-- Menu Lateral Direita (Endereços)-->
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Endereços</h5>
                    </div>
                    <div class="card-body">
                      <form>
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Tipo de Endereço</label>
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                          <option selected>Selecione...</option>
                          <option value="1">Residencial</option>
                          <option value="2">Comercial</option>
                        </select>
                      </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">CEP</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="Insira o CEP do cleinte" />
                        </div> 
                        <button type="submit" class="btn btn-primary">Buscar</button><br></br>
                          <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Bairro</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o bairro do cliente" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Cidade</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira a cidade do cliente" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">UF</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira a uf do cliente" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Logadouro</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o logadouro" />
                        </div>
                          <button type="submit" class="btn btn-primary">Pesquisar Endereço</button>
                          <button type="submit" class="btn btn-primary">Incluir Endereço</button><br></br>
                          <button type="submit" class="btn btn-primary">Editar Endereço</button>
                          <button type="submit" class="btn btn-primary">Salvar Endereço</button>
                          <button type="submit" class="btn btn-primary">Cancelar</button><br></br>
                          <button type="submit" class="btn btn-primary">Retirar da Tabela</button>
                        </div>                      
                      </div>
                     </div>                      
                    </div>
                        <!-- Menu de Contatos -->
                        <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Contatos</h5>                    
                    </div>
                    <div class="card-body">
                      <form>                      
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Nome Para Contato</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="Insira um nome para contato" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Email</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o email do cliente" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Departamento</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o departamento" />
                        </div>
                        <div class="mb-3">
                        <label for="defaultSelect" class="form-label">Tipo de Telefone Principal</label>
                        <select id="defaultSelect" class="form-select">
                          <option>Selecione...</option>
                          <option value="1">Fixo</option>
                          <option value="2">Móvel</option>
                        </select>
                      </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Número</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o número principal" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Ramal</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o ramal principal" />
                        </div>
                        <div class="mb-3">
                        <label for="defaultSelect" class="form-label">Tipo de Telefone Secundário</label>
                        <select id="defaultSelect" class="form-select">
                          <option>Selecione...</option>
                          <option value="1">Fixo</option>
                          <option value="2">Móvel</option>
                        </select>
                      </div>    
                          <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Número</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o número secundário" />
                        </div>  
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Ramal</label>
                          <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o ramal secundário" />
                        </div>                       
                      </form>                     
                    </div>
                  </div>
                </div>   
                
                        <!-- Menu de Orçamentos -->
                        <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Orçamentos</h5>
                    </div>
                    <div class="card-body">
                      <form>
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Filtrar por</label>
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                          <option selected>Selecione...</option>
                          <option value="1">Mês/Ano</option>
                          <option value="2">Cód Emissor</option>
                          <option value="3">Ano</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Selecione o mês</label>
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                          <option selected>Selecione...</option>                       
                          <option value="1">Janeiro</option>
                          <option value="2">Fevereiro</option>
                          <option value="3">Março</option>n>
                          <option value="4">Abril</option>
                          <option value="5">Maio</option>
                          <option value="6">Junho</option>
                          <option value="7">Julho</option>
                          <option value="8">Agosto</option>
                          <option value="9">Setembro</option>
                          <option value="10">Outrubro</option>
                          <option value="11">Novembro</option>
                          <option value="12">Dezembro</option>
                        </select>
                      </div>
                      <div class="mb-3 row">
                        <label for="html5-number-input" class="col-md-2 col-form-label">Ano</label>
                        <div class="col-md-10">
                          <input class="form-control" type="number" value="2022" id="html5-number-input" />
                        </div>
                      </div>                                                                 
                          <button type="submit" class="btn btn-primary">Filtrar</button>
                          <button type="submit" class="btn btn-primary">Limpar Filtros</button>
                        </div>                      
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
                            

           