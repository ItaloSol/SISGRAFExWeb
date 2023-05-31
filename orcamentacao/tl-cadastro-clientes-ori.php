<?php /* |||  ||| */ include_once("../html/navbar.php");
$_SESSION["pag"] = array(1, 0); ?>
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="accordion mt-3" id="accordionExample">
      <div class="card accordion-item active">
        <h2 class="accordion-header" id="headingOne">
          <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
            Cadastro de Atendentes e Operadores
          </button>
        </h2>
        <form>
          <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <div class="col-lg-12">
                <div class="demo-inline-spacing mt-3">
                  <div class="list-group list-group-horizontal-md text-md-center">
                    <a class="list-group-item list-group-item-action active" id="home-list-item" data-bs-toggle="list" href="#horizontal-home">Informações do Cliente</a>
                    <a class="list-group-item list-group-item-action" id="profile-list-item" data-bs-toggle="list" href="#horizontal-profile">Endereços</a>
                    <a class="list-group-item list-group-item-action" id="messages-list-item" data-bs-toggle="list" href="#horizontal-messages">Contatos</a>
                    <a class="list-group-item list-group-item-action" id="settings-list-item" data-bs-toggle="list" href="#horizontal-settings">Orçamentos</a>
                  </div>
                  <div class="tab-content px-0 mt-0">
                    <!-- Informações do Cliente -->
                    <div class="tab-pane fade show active" id="horizontal-home">
                      <div class="divider divider-dark">
                        <div class="divider-text">Tipo de Cliente</div>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Selecione o Tipo do Cliente</label>
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                          <option selected>Selecione o tipo de cliente...</option>
                          <option value="1">Pessoa Física</option>
                          <option value="2">Pessoa Júridica</option>
                        </select>
                      </div>
                      <div class="divider divider-dark">
                        <div class="divider-text">Dados Pessoais</div>
                      </div>
                      <div>
                        <label for="defaultFormControlInput" class="form-label">Nome do Cliente</label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Insira o nome do Cliente" aria-describedby="defaultFormControlHelp" />
                      </div>
                      <div>
                        <label for="defaultFormControlInput" class="form-label">Nome Fantasia</label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Insira o nome do Fantasia do Cliente" aria-describedby="defaultFormControlHelp" />
                      </div>
                      <div>
                        <label for="defaultFormControlInput" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Insira o cpf do cliente" aria-describedby="defaultFormControlHelp" />
                      </div>
                      <div>
                        <label for="defaultFormControlInput" class="form-label">CNPJ</label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Insira o cpnj do Cliente" aria-describedby="defaultFormControlHelp" />
                      </div>
                      <div>
                        <label for="defaultFormControlInput" class="form-label">Atividade</label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Insira a atividade do cliente" aria-describedby="defaultFormControlHelp" />
                      </div>
                      <div>
                        <label for="defaultFormControlInput" class="form-label">Filial/Coligada/Relacionada</label>
                        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Insira a filiar/coligada" aria-describedby="defaultFormControlHelp" />
                      </div>
                      <div class="divider divider-dark">
                        <div class="divider-text">Atendente</div>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">Código do Atendente</label>
                        <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="" readonly />
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">Nome do Atendente</label>
                        <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="" readonly />
                      </div>
                      <div>
                        <label for="exampleFormControlTextarea1" class="form-label">Observações do Cliente</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                      </div>
                    </div>
                    <!-- Endereços -->
                    <div class="tab-pane fade" id="horizontal-profile">
                      <div class="divider divider-dark">
                        <div class="divider-text">Endereço</div>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Tipo de Endereço</label>
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                          <option selected>Selecione o tipo...</option>
                          <option value="1">Residencial</option>
                          <option value="2">Comercial</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">CEP</label>
                        <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="Insira o CEP do Cliente" />
                      </div>
                      <input type="submit" class="btn btn-primary" value="consultar" name"cep"><br><br>
                      <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">Bairro</label>
                        <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="Insira o bairro do Cliente" />
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">Cidade</label>
                        <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="Insira a cidade do Cliente" />
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">UF</label>
                        <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="Insira a UF do Cliente" />
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">Logadouro</label>
                        <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="Insira o logadouro do Cliente" />
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">Complemento</label>
                        <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="Insira o complemento" />
                      </div>
                    </div>
                    <!-- Contatos -->
                    <div class="tab-pane fade" id="horizontal-messages">
                      <div div class="divider divider-dark">
                        <div class="divider-text">Contato</div>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">Nome para Contato</label>
                        <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="Insira o nome para contato" />
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">Email</label>
                        <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="Insira o email" />
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">Departamento</label>
                        <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="Insira o departamento" />
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">Telefone Principal</label>
                        <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="Insira o telefone principal" />
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlReadOnlyInput1" class="form-label">Telefone Secundário</label>
                        <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="Insira o telefone secundário" />
                      </div>
                      <input type="submit" class="btn btn-primary" value="Cadastrar" name="cadastrar">
                    </div>

                    <!-- Orçamentos -->
                    <div class="tab-pane fade" id="horizontal-settings">
                      <div class="card">
                        <h5 class="card-header">Bordered Table</h5>
                        <div class="card-body">
                          <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>Código</th>
                                  <th>Data de Emissão</th>
                                  <th>Data de Validade</th>
                                  <th>Valor Total</th>
                                  <th>Status</th>
                                  <th>Emissor</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>

                                  </td>
                                  <td>

                                  </td>
                                  <td>

                                  </td>
                                  <td>

                                  </td>
                                  <td>

                                  </td>
                                  <td>

                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div><br>
    </div>







    <?php /* |||  ||| */ include_once("../html/navbar-dow.php"); ?>