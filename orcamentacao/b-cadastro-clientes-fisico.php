<?php  
include_once('../conexoes/conexao.php');
include_once('../conexoes/conn.php');
  include_once('../dados/endereco_juridico.php'); 
  
 


if(isset($_GET['Select'])){$Cod_Selecionado = $_GET['Select'];}else{ $Cod_Selecionado = Null;};
if(isset($_GET['Ty'])){if($_GET['Ty'] == 2){ $Tipo_Cliente = 2;};if($_GET['Ty'] == 1){ $Tipo_Cliente = 1;};}else{$Tipo_Cliente = 0;};


      $Clientes_Juridicos = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE cod = '$Cod_Selecionado' "); 
      $Clientes_Juridicos->execute(); 
      $i = 0;
      while($linha = $Clientes_Juridicos->fetch(PDO::FETCH_ASSOC)) {
         
          $Cliente_Puxado[] = [
           'cod' => $linha['cod'],
           'nome' => $linha['nome'], 
           'cpf' => $linha['cpf'],
           'atividade' => $linha['atividade'],
           'cod_atendente' => $linha['cod_atendente'],
           'cod_atendente' => $linha['cod_atendente'],
           'nome_atendente' => $linha['nome_atendente'],
           'observacao' => $linha['observacoes'],
           'credito' => $linha['credito'],
           'senha' => $linha['senha'],
           
          ];
      }
     
      if(isset($_GET['End'])){
        $id_endereco = $_GET['End'];
        $Clientes_Endereco_Juridicos = $conexao->prepare("SELECT * FROM tabela_associacao_enderecos a INNER JOIN tabela_enderecos e ON a.cod_endereco = e.cod WHERE a.cod_cliente = '$Cod_Selecionado' AND a.tipo_cliente = $Tipo_Cliente AND e.cod = $id_endereco "); 
        $Clientes_Endereco_Juridicos->execute(); 
        $i = 0;
        while($linha = $Clientes_Endereco_Juridicos->fetch(PDO::FETCH_ASSOC)) {
           
            $Cliente_Enderecos_Puxado[] = [
             'cod' => $linha['cod'],
             'cep' => $linha['cep'], 
             'tipo_endereco' => $linha['tipo_endereco'],
             'logadouro' => $linha['logadouro'],
             'bairro' => $linha['bairro'],
             'uf' => $linha['uf'],
             'cidade' => $linha['cidade'],
             'complemento' => $linha['complemento'],
             'excluido' => $linha['excluido'],
             'casa' => $linha['casa'],
            
            ];
        }
      }else{
        $Clientes_Endereco_Juridicos = $conexao->prepare("SELECT * FROM tabela_associacao_enderecos a INNER JOIN tabela_enderecos e ON a.cod_endereco = e.cod WHERE a.cod_cliente = '$Cod_Selecionado' AND a.tipo_cliente = $Tipo_Cliente "); 
        $Clientes_Endereco_Juridicos->execute(); 
        $i = 0;
        while($linha = $Clientes_Endereco_Juridicos->fetch(PDO::FETCH_ASSOC)) {
           
            $Cliente_Enderecos_Puxado[] = [
             'cod' => $linha['cod'],
             'cep' => $linha['cep'], 
             'tipo_endereco' => $linha['tipo_endereco'],
             'logadouro' => $linha['logadouro'],
             'bairro' => $linha['bairro'],
             'uf' => $linha['uf'],
             'cidade' => $linha['cidade'],
             'complemento' => $linha['complemento'],
             'excluido' => $linha['excluido'],
             'casa' => $linha['casa'],
            
            ];
        }
      }
     

      if(isset($_GET['Cnt'])){
        $id_contato = $_GET['Cnt'];
        $Clientes_Contato_Juridicos = $conexao->prepare("SELECT * FROM tabela_associacao_contatos a INNER JOIN tabela_contatos e ON a.cod_contato = e.cod WHERE a.cod_cliente = '$Cod_Selecionado' AND a.tipo_cliente = $Tipo_Cliente AND e.cod = $id_contato"); 
        $Clientes_Contato_Juridicos->execute(); 
        $i = 0;
        while($linha = $Clientes_Contato_Juridicos->fetch(PDO::FETCH_ASSOC)) {
           
            $Cliente_Contato_Puxado[] = [
             'cod' => $linha['cod'],
             'nome_contato' => $linha['nome_contato'], 
             'email' => $linha['email'],
             'telefone' => $linha['telefone'],
             'ramal' => $linha['ramal'],
             'telefone2' => $linha['telefone2'],
             'ramal2' => $linha['ramal2'],
             'departamento' => $linha['departamento'],
             'excluido' => $linha['excluido'],
            ];
        }
      }else{
        $Clientes_Contato_Juridicos = $conexao->prepare("SELECT * FROM tabela_associacao_contatos a INNER JOIN tabela_contatos e ON a.cod_contato = e.cod WHERE a.cod_cliente = '$Cod_Selecionado' AND a.tipo_cliente = $Tipo_Cliente "); 
        $Clientes_Contato_Juridicos->execute(); 
        $i = 0;
        while($linha = $Clientes_Contato_Juridicos->fetch(PDO::FETCH_ASSOC)) {
           
            $Cliente_Contato_Puxado[] = [
             'cod' => $linha['cod'],
             'nome_contato' => $linha['nome_contato'], 
             'email' => $linha['email'],
             'telefone' => $linha['telefone'],
             'ramal' => $linha['ramal'],
             'telefone2' => $linha['telefone2'],
             'ramal2' => $linha['ramal2'],
             'departamento' => $linha['departamento'],
             'excluido' => $linha['excluido'],
            ];
        }
      }
   
 



?>
<div class="row">
                  <!-- Drop -->   
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
                        >Cadastro de Cliente Jurídico
                        </button>
                      </h2>
                      <div
                        id="accordionOne"
                        class="accordion-collapse collapse show"
                        data-bs-parent="#accordionExample"
                      >
                        <div class="accordion-body">
                        <div class="card mb-4">
                <h5 class="card-header"></h5>
                <div class="card-body">
                  <div class="row">
                    <!-- Menus -->                   
                    <div class="col-lg-12">
                      <div class="demo-inline-spacing mt-3">
                        <div class="list-group list-group-horizontal-md text-md-center">
                          <a
                            class="list-group-item list-group-item-action active"
                            id="home-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-home"
                            >Cadastro de Clientes</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="profile-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-profile"
                            >Endereços</a
                          >
                          <a
                            class="list-group-item list-group-item-action"
                            id="messages-list-item"
                            data-bs-toggle="list"
                            href="#horizontal-messages"
                            >Contatos</a
                          >
                          
                        </div>
                        <div class="tab-content px-0 mt-0">
                          <div class="tab-pane fade show active" id="horizontal-home">
                          <form method="POST" action="../bd-orcamento/salvar.php">                    
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Nome do Cliente Jurídico</label>
                          <input type="text" style="text-transform:uppercase" name="usuario0" class="form-control" id="usuario0" value="<?= $Cliente_Puxado[0]["nome"] ?>" placeholder="Pesquisar usuário" onkeyup="carregar_usuarios(this.value)" />
                        <span id="resultado_pesquisa0"></span>
                          <!-- <input type="text" class="form-control" id="usuario0" name="usuario0" placeholder="Insira o nome do cliente" onkeyup="carregar_usuarios(this.value)" />
                          <span id="resultado_pesquisa0"></span> -->
                        </div>
                        
                        <div class="mb-3">
                          <label class="form-label" for="codigo">código</label>
                          <input type="text" class="form-control" id="codigo" value="<?= $Cliente_Puxado[0]["cod"] ?>" placeholder="Insira o cpf do cliente" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="credito">Crédito Disponível</label>
                          <input type="text" class="form-control" name="credito" value="<?= $Cliente_Puxado[0]["credito"] ?>" id="credito" placeholder="Crédito disponível" disabled />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="cnpj">Cpf</label>
                          <input type="text" class="form-control" id="cpf" value="<?= $Cliente_Puxado[0]["cpf"] ?>" placeholder="Insira o cpf do cliente" />
                        </div>    
                          <div class="mb-3">
                          <label class="form-label" for="atividade">Atividade</label>
                          <input type="text" class="form-control" id="atividade" value="<?= $Cliente_Puxado[0]["atividade"] ?>" placeholder="Insira a atividade" />
                        </div>  
                       
                        <div class="mb-3">
                          <label class="form-label" for="codigo_aten">Código do Atendente</label>
                          <input type="text" class="form-control" id="codigo_aten" value="<?= $cod_user ?>" placeholder="Código do Atendente" disabled/>
                        </div> 
                        <div class="mb-3">
                          <label class="form-label" for="nome_aten">Nome do Atendente</label>
                          <input type="text" class="form-control" id="nome_aten" value="<?= $nome_user ?>" placeholder="Nome do Atendente" disabled />
                        </div> 
                        <div>
                        <label for="obs" class="form-label">Observações do Cliente (Max 1000 Caracteres)</label>
                        <textarea class="form-control" value="<?= $Cliente_Puxado[0]["observacao"] ?>" id="obs" rows="3"></textarea>
                        </div><br></br>                              
                        <!-- <button type="submit" class="btn btn-success">Incluir</button>   
                        <button type="submit" class="btn btn-danger">Excluir</button>
                        <button type="submit"  class="btn btn-success">Salvar</button>
                        <button type="submit" class="btn btn-danger">Cancelar</button>     -->
                      </form>
                          </div>
                          <!-- Endereços -->
                          <div class="tab-pane fade" id="horizontal-profile">
                          <form method="POST" action="../bd-orcamento/salvar.php">
                      <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Tipo de Endereço</label>
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                        
                              <option value="2">Comercial</option>
                     
                          
                          <option value="1">Residencial</option>
                          <option value="2">Comercial</option>
                        </select>
                      </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">CEP</label>
                          <input type="text" class="form-control" value="<?= $Cliente_Enderecos_Puxado[0]['cep'] ?>" id="cep" placeholder="Insira o CEP do cleinte" />
                        </div> 
                          <div class="mb-3">
                           
                          <label class="form-label" for="basic-default-company">Bairro</label>
                          <input type="text" class="form-control" id="basic-default-company" value="<?= $Cliente_Enderecos_Puxado[0]['bairro'] ?>" name="bairro" id="bairro" placeholder="Insira o bairro do cliente" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Cidade</label>
                          <input type="text" class="form-control" id="basic-default-company" value="<?= $Cliente_Enderecos_Puxado[0]['cidade'] ?>" placeholder="Insira a cidade do cliente" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">UF</label>
                          <input type="text" class="form-control" id="basic-default-company" value="<?= $Cliente_Enderecos_Puxado[0]['uf'] ?>" placeholder="Insira a uf do cliente" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Logadouro</label>
                          <input type="text" class="form-control" id="basic-default-company"value="<?= $Cliente_Enderecos_Puxado[0]['logadouro'] ?>" placeholder="Insira o logadouro" />
                        </div>
                        
                          </form>  
                          <div class ="card">
                <h5 class="card-header">Endereços</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Código</th>
                          <th>Tipo de Endereço</th>
                          <th>CEP</th>
                          <th>Bairro</th>
                          <th>Cidade</th>
                          <th>Uf</th>
                          <th>Logadouro</th>
                          <th>Editar</th>
                        </tr>
                      </thead>
                      <tbody>
                       
                          <?php
                           $Clientes_Endereco_Juridicos = $conexao->prepare("SELECT * FROM tabela_associacao_enderecos a INNER JOIN tabela_enderecos e ON a.cod_endereco = e.cod WHERE a.cod_cliente = '$Cod_Selecionado' AND a.tipo_cliente = $Tipo_Cliente "); 
                           $Clientes_Endereco_Juridicos->execute(); 
                           $i = 0;
                           while($linha = $Clientes_Endereco_Juridicos->fetch(PDO::FETCH_ASSOC)) {
                              
                               $Cliente_Enderecos_Puxado[] = [
                                'cod' => $linha['cod'],
                                'cep' => $linha['cep'], 
                                'tipo_endereco' => $linha['tipo_endereco'],
                                'logadouro' => $linha['logadouro'],
                                'bairro' => $linha['bairro'],
                                'uf' => $linha['uf'],
                                'cidade' => $linha['cidade'],
                                'complemento' => $linha['complemento'],
                                'excluido' => $linha['excluido'],
                                'casa' => $linha['casa'],
                               
                               ];
                           }
                         
                        
                         $Total_Enderecos = count($Cliente_Enderecos_Puxado);
                         $Percorrer_Enderecos = 0;
                         
                          while($Total_Enderecos > $Percorrer_Enderecos){  ?>
                            <tr>
                          <td> <?= $Cliente_Enderecos_Puxado[$Percorrer_Enderecos]["cod"] ?> </td>
                          <td> <?= $Cliente_Enderecos_Puxado[$Percorrer_Enderecos]["tipo_endereco"] ?> </td>
                          <td> <?= $Cliente_Enderecos_Puxado[$Percorrer_Enderecos]["cep"] ?> </td>
                          <td> <?= $Cliente_Enderecos_Puxado[$Percorrer_Enderecos]["bairro"] ?> </td>
                          <td> <?= $Cliente_Enderecos_Puxado[$Percorrer_Enderecos]["cidade"] ?> </td>
                          <td> <?= $Cliente_Enderecos_Puxado[$Percorrer_Enderecos]["uf"] ?> </td>
                          <td> <?= $Cliente_Enderecos_Puxado[$Percorrer_Enderecos]["logadouro"] ?> </td>
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
                                <a class="dropdown-item" name='Cliente_Select' href="tl-cadastro-clientes.php?Select=<?= $Cliente_Puxado[0]["cod"] ?>&Ty=<?= $Tipo_Cliente ?>&End=<?= $Cliente_Enderecos_Puxado[$Percorrer_Enderecos]["cod"] ?>&Cnt=<?= $Cliente_Contato_Puxado[0]["cod"]  ?>"  
                                  ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                >
                                <a class="dropdown-item" href="javascript:void(0);"
                                  ><i class="bx bx-trash me-1"></i> Delete</a
                                >
                              </div>
                            </div>
                          </td>
                          </tr>
                       <?php } ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>   
                        </div>                          
                          
                          <!-- Contatos -->
                          <div class="tab-pane fade" id="horizontal-messages">
                          <form method="POST" action="../bd-orcamento/salvar.php">                      
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Nome Para Contato</label>
                          <input type="text" class="form-control" id="basic-default-fullname" value="<?=  $Cliente_Contato_Puxado[0]['nome_contato'] ?>" placeholder="Insira um nome para contato" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Email</label>
                          <input type="text" class="form-control" id="basic-default-company" value="<?=  $Cliente_Contato_Puxado[0]['email'] ?>" placeholder="Insira o email do cliente" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Departamento</label>
                          <input type="text" class="form-control" id="basic-default-company" value="<?=  $Cliente_Contato_Puxado[0]['departamento'] ?>" placeholder="Insira o departamento" />
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
                          <input type="text" class="form-control" id="basic-default-company" value="<?=  $Cliente_Contato_Puxado[0]['telefone'] ?>" placeholder="Insira o número principal" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Ramal</label>
                          <input type="text" class="form-control" id="basic-default-company" value="<?=  $Cliente_Contato_Puxado[0]['ramal'] ?>" placeholder="Insira o ramal principal" />
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
                          <label class="form-label" for="basic-default-company">Número 2</label>
                          <input type="text" class="form-control" id="basic-default-company" value="<?=  $Cliente_Contato_Puxado[0]['telefone2'] ?>" placeholder="Insira o número secundário" />
                        </div>  
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Ramal 2</label>
                          <input type="text" class="form-control" id="basic-default-company" value="<?=  $Cliente_Contato_Puxado[0]['ramal2'] ?>" placeholder="Insira o ramal secundário" />
                        </div>                       
                          
                      </form>   
                      <div class ="card">
                <h5 class="card-header">Contatos</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Código</th>
                          <th>Nome para contato</th>
                          <th>Email</th>
                          <th>Departamento</th>
                          <th>Telefone 1</th>
                          <th>Telefone 2</th>
                          <th>Ramal 1 </th>
                          <th>Ramal 2</th>
                          <th>Editar</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $Clientes_Contato_Juridicos = $conexao->prepare("SELECT * FROM tabela_associacao_contatos a INNER JOIN tabela_contatos e ON a.cod_contato = e.cod WHERE a.cod_cliente = '$Cod_Selecionado' AND a.tipo_cliente = $Tipo_Cliente "); 
                        $Clientes_Contato_Juridicos->execute(); 
                        $i = 0;
                        while($linha = $Clientes_Contato_Juridicos->fetch(PDO::FETCH_ASSOC)) {
                           
                            $Cliente_Contato_Puxado[] = [
                             'cod' => $linha['cod'],
                             'nome_contato' => $linha['nome_contato'], 
                             'email' => $linha['email'],
                             'telefone' => $linha['telefone'],
                             'ramal' => $linha['ramal'],
                             'telefone2' => $linha['telefone2'],
                             'ramal2' => $linha['ramal2'],
                             'departamento' => $linha['departamento'],
                             'excluido' => $linha['excluido'],
                            ];
                        }
                      
                     
                     $Total_Contato = count($Cliente_Contato_Puxado);
                     $Percorrer_Contato = 0;
                      while($Total_Contato > $Percorrer_Contato){  ?>
                            <tr>
                          <td> <?= $Cliente_Contato_Puxado[$Percorrer_Contato]["cod"] ?> </td>
                          <td> <?= $Cliente_Contato_Puxado[$Percorrer_Contato]["nome_contato"] ?> </td>
                          <td> <?= $Cliente_Contato_Puxado[$Percorrer_Contato]["email"] ?> </td>
                          <td> <?= $Cliente_Contato_Puxado[$Percorrer_Contato]["departamento"] ?> </td>
                          <td> <?= $Cliente_Contato_Puxado[$Percorrer_Contato]["telefone"] ?> </td>
                          <td> <?= $Cliente_Contato_Puxado[$Percorrer_Contato]["telefone2"] ?> </td>
                          <td> <?= $Cliente_Contato_Puxado[$Percorrer_Contato]["ramal"] ?> </td>
                          <td> <?= $Cliente_Contato_Puxado[$Percorrer_Contato]["ramal2"] ?> </td>
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
                                <a class="dropdown-item" name='Cliente_Select' href="tl-cadastro-clientes.php?Select=<?= $Cliente_Puxado[0]["cod"] ?>&Ty=<?= $Tipo_Cliente ?>&End=<?= $Cliente_Enderecos_Puxado[0]["cod"] ?>&Cnt=<?= $Cliente_Contato_Puxado[$Percorrer_Contato]["cod"]  ?>"  
                                  ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                >
                                <a class="dropdown-item" href="javascript:void(0);"
                                  ><i class="bx bx-trash me-1"></i> Delete</a
                                > 
                              </div>
                            </div>
                          </td>
                          </tr>
                          <?php } ?>
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
                     <!-- Tabela de consulta e edição--> 
                     
                  </div>
                </div>
              </div>

                        </div>
                      </div>
                      <script src="../js/custom.js"></script>