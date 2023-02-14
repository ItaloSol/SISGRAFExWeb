<?php /* |||  ||| */ include_once("../html/navbar.php");?>

  <!-- Menu da Esquerda Cadastro de Produtos (Produção - PP) -->
  <h5 class="mt-4">Cadastro de Produtos</h5>
              <div class="row">
                <div class="col-md mb-4 mb-md-0">
                  <div class="accordion mt-3" id="accordionExample">
                    <div class="card accordion-item active">
                      <h2 class="accordion-header" id="headingOne">
                        <button
                          type="button"
                          class="accordion-button"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionOne"
                          aria-expanded="true"
                          aria-controls="accordionOne"
                        >
                         Cadastro de Produtos (Produção - PP)
                        </button>
                      </h2>

                      <div
                        id="accordionOne"
                        class="accordion-collapse collapse show"
                        data-bs-parent="#accordionExample"
                      >
                        <div class="accordion-body">
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
                      <div class="col-lg-12">
                      <small class="text-light fw-semibold">Horizontal</small>
                      <div class="demo-inline-spacing mt-3">
                        <div class="list-group list-group-horizontal-md text-md-center">
                          <a
                            class="list-group-item list-group-item-action active"
                            id="home-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-home"
                            >Papéis</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="profile-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-profile"
                            >Acabamentos</a
                          >
                        </div>
                        <div class="tab-content px-0 mt-0">
                          <div class="tab-pane fade show active" id="horizontal-home">
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
                          </div>     
                        </div>
                      </div>
                      </div>
                      </div> 
                      </div>                
                    <div class="card accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button
                          type="button"
                          class="accordion-button collapsed"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionTwo"
                          aria-expanded="false"
                          aria-controls="accordionTwo"
                        >
                          Cadastro de Produtos (Pronta Entrega - PE)
                        </button>
                      </h2>
                      <div
                        id="accordionTwo"
                        class="accordion-collapse collapse"
                        aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample"
                      >
                        <div class="accordion-body">
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
                        </div>
                        <div class="col-lg-12">
                      <small class="text-light fw-semibold">Horizontal</small>
                      <div class="demo-inline-spacing mt-3">
                        <div class="list-group list-group-horizontal-md text-md-center">
                          <a
                            class="list-group-item list-group-item-action active"
                            id="home-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-home"
                            >Valores</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="profile-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-profile"
                            >Estoque</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="messages-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-messages"
                            >Pedidos</a
                          >
                        </div>
                        <div class="tab-content px-0 mt-0">
                          <div class="tab-pane fade show active" id="horizontal-home">
                            1
                          </div>
                          <div class="tab-pane fade" id="horizontal-profile">
                           2
                          </div>
                          <div class="tab-pane fade" id="horizontal-messages">
                            3
                          </div>                        
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>                
                    </div>
                  </div>
                </div>
              </div>
                   
         
               
              
           
                            

<?php /* |||  ||| */ include_once("../html/../html/navbar-dow.php"); ?>