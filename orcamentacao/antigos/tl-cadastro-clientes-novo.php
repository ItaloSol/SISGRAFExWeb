<?php /* |||  ||| */ include_once("../html/navbar.php");?>


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
                
                
                            

<?php /* |||  ||| */ include_once("../html/navbar-dow.php"); ?>