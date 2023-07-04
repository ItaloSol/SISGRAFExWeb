<?php
if($_GET['tp'] == 1){
  $tipo_pessoa = 1;
}
if($_GET['tp'] == 2){
  $tipo_pessoa = 2;
}
$Clientes_Contato_Juridicos = $conexao->prepare("SELECT * FROM tabela_associacao_contatos a INNER JOIN tabela_contatos e ON a.cod_contato = e.cod WHERE a.cod_cliente = '$codigoC' AND a.tipo_cliente = '$tipo_pessoa' LIMIT 15"); 
$Clientes_Contato_Juridicos->execute(); 
$contato = 0;
while($linha = $Clientes_Contato_Juridicos->fetch(PDO::FETCH_ASSOC)) {
   
    $Cliente_Contato_Puxado[$contato] = [
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
    $contato++;
}
$Clientes_Endereco_Juridicos = $conexao->prepare("SELECT * FROM tabela_associacao_enderecos a INNER JOIN tabela_enderecos e ON a.cod_endereco = e.cod WHERE a.cod_cliente = '$codigoC' AND a.tipo_cliente = '$tipo_pessoa' LIMIT 15 "); 
$Clientes_Endereco_Juridicos->execute(); 
$i = 0;
$endereco = 0;
while($linha = $Clientes_Endereco_Juridicos->fetch(PDO::FETCH_ASSOC)) {
   
    $Cliente_Enderecos_Puxado[$endereco] = [
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
    $endereco++;
}


?>
 <style>
                .tira{
                  display: none;
                }
              </style>
<div class="card mb-4">
  <h5 class="card-header">Nota de Crédito</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="demo-inline-spacing mt-3">
          <div class="list-group list-group-horizontal-md text-md-center">
            <a class="list-group-item list-group-item-action active" id="home-list-item" data-bs-toggle="list" href="#horizontal-home">Dados da Nota</a>
            <a class="list-group-item list-group-item-action" id="profile-list-item" data-bs-toggle="list" href="#horizontal-profile">Dados de Pagamento</a>
            <a class="list-group-item list-group-item-action" id="messages-list-item" data-bs-toggle="list" href="#horizontal-messages">Observações</a>
          </div>
          <!--Dados da Nota-->
          <form method="POST" action="cad_nota.php">
          <div class="tab-content px-0 mt-0">
         
            <div class="divider divider-dark">
              <div class="divider-text">NOTA</div>
            </div>
            <div class="tab-pane fade show active" id="horizontal-home">
              <div class="mb-3">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Série</label>
                <select class="form-select" name="serie" id="exampleFormControlSelect1" aria-label="Default select example">
                 
                  <option value="1">2</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Número</label>
                <input class="form-control" name="numero" type="text" id="exampleFormControlReadOnlyInput1" placeholder="" readonly />
              </div>
              <div class="mb-3">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Modelo</label>
                <input class="form-control" name="modelo" type="text" id="exampleFormControlReadOnlyInput1" placeholder="1 - Nota Fiscal, Modelo 1 ou 1-A" readonly />
              </div>
              <div class="mb-3 row">
                <label for="html5-date-input" class="col-md-2 col-form-label">Data de Lançamento</label>
                <div class="col-md-10">
                  <input class="form-control" name="data_lancamento" type="date" value="<?= $hoje ?>" id="html5-date-input" />
                </div>
              </div>
              <div class="divider divider-dark">
                <div class="divider-text">TIPO DE DOCUMENTO</div>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Descrição</label>
                <select class="form-select" name="descricao" id="exampleFormControlSelect1" aria-label="Default select example">
                 
                  <option value="1">1 - Nota Fiscal de Crédito com Operação de Entrada</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Finalidade da Emissão</label>
                <input class="form-control" value="NORMAL" type="text" id="exampleFormControlReadOnlyInput1" placeholder="" readonly />
              </div>
              <div class="mb-3">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Emissor</label>
                <input class="form-control" value="<?= $cod_user ?>" type="text" id="exampleFormControlReadOnlyInput1" placeholder="" readonly />
              </div>
              <div class="divider divider-dark">
                <div class="divider-text">CLIENTE</div>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Código</label>
                <input class="form-control" name="codigo_cliente" type="text" value="<?= $codigoC ?>" id="exampleFormControlReadOnlyInput1" placeholder="" readonly />
              </div>
              <div class="mb-3">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Tipo do Cliente</label>
                <input class="form-control" type="text" name="tipo_cliente" value="<?= $_GET['tp'] ?>" id="exampleFormControlReadOnlyInput1" placeholder="" readonly />
              </div>
              <div class="mb-3">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Nome</label>
                <input class="form-control" type="text" value="<?= $nome ?>" id="exampleFormControlReadOnlyInput1" placeholder="" readonly />
              </div>
              <div class="mb-3">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">CNPJ/CPF</label>
                <input class="form-control" type="text" value="<?= $cpf ?>" id="exampleFormControlReadOnlyInput1" placeholder="" readonly />
              </div>
              
              <div class="divider divider-dark">
                <div class="divider-text">CONTATO</div>
              </div>
              <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Contato:</label>
                        <select class="form-select" name="contato" id="exampleFormControlSelect1" aria-label="Default select example" required>
                          <option>Selecione um contato</option>
                          <?php  
                          $a = 0;
                          while($contato > $a){
                            echo '<option value="'.$Cliente_Contato_Puxado[$a]['cod'].'">'.$Cliente_Contato_Puxado[$a]['nome_contato'].' '.$Cliente_Contato_Puxado[$a]['telefone'].' '.$Cliente_Contato_Puxado[$a]['email'].'</option>';
                            $a++;
                          }
                          ?>
                          
                          
                        </select>
                      </div>
                      <div class="divider divider-dark">
                <div class="divider-text">ENDEREÇO</div>
              </div>
              <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Endereço:</label>
                        <select class="form-select" name="endereco" id="exampleFormControlSelect1" aria-label="Default select example" required>
                          <option>Selecione um Endereço</option>
                          <?php  
                          $a = 0;
                          while($endereco > $a){
                            echo '<option value="'.$Cliente_Enderecos_Puxado[$a]['cod'].'">Cep: '.$Cliente_Enderecos_Puxado[$a]['cep'].' UF: '.$Cliente_Enderecos_Puxado[$a]['uf'].' logadouro: '.$Cliente_Enderecos_Puxado[$a]['logadouro'].' cidade: '.$Cliente_Enderecos_Puxado[$a]['cidade'].'</option>';
                            $a++;
                          }
                          ?>
                        </select>
                      </div>
            </div>
            <!--Dados de Pagamento-->
            <div class="tab-pane fade" id="horizontal-profile">
              <div class="mb-3">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Forma de Pagamento</label>
                <select class="form-select" name="forma_pagamento"  id="forma_pagamento" aria-label="Default select example" required>
                  <option>Selecione...</option>
                  <option value="1">SIGA/SIAFI</option>
                  <option value="2">GRU</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Valor da Nota (R$)</label>
                <input class="form-control" name="valor" type="number" step="0.01" id="exampleFormControlReadOnlyInput1" placeholder="Digite o Valor da nota" required />
              </div>
              <div class="divider divider-dark">
                <div class="divider-text">Informações de Pagamento</div>
              </div>
              <div id="informacoes" class="tira">
              <div class="mb-3 row">
                <label for="html5-text-input" class="col-md-2 col-form-label">CPF do Emissor</label>
                <div class="col-md-10">
                  <input class="form-control" name="cpf" type="text" placeholder="Prenchimento automatico <?= $_SESSION['usuario'][7] ?>" id="cpf" />
                </div>
              </div>
              <div class="mb-3 row">
                <label for="html5-text-input" class="col-md-2 col-form-label">Nome do Emissor</label>
                <div class="col-md-10">
                  <input class="form-control" name="nome_emissor" type="text" placeholder="Prenchimento automatico <?= $_SESSION['usuario'][0] ?>" id="html5-text-input"  />
                </div>
              </div>
              <div id="recolimento" class="mb-3 row">
                <label for="html5-text-input" class="col-md-2 col-form-label">Código do Recolhimento</label>
                <div class="col-md-10">
                  <input class="form-control" name="cod_recolhimete" type="text" id="html5-text-input" />
                </div>
              </div>
              <div id="siafi" class="mb-3 row">
                <label for="html5-text-input" class="col-md-2 col-form-label">Código SIAFI</label>
                <div class="col-md-10">
                  <input class="form-control" name="siafi" value="<?= $ano ?>NC" type="text" id="html5-text-input" />
                </div>
              </div>
              <div id="ug"  class="mb-3 row">
                <label for="html5-text-input" class="col-md-2 col-form-label">Código UG</label>
                <div class="col-md-10">
                  <input class="form-control" name="ug" type="text" id="html5-text-input" />
                </div>
              </div>
              <div class="mb-3 row">
                <label for="data-hora" class="col-md-2 col-form-label">Data e Hora do Lançamento</label>
                <div class="col-md-10">
                <input type="datetime-local" id="data-hora" name="data_horas" value="<?= $datetime ?>" min="0000-01-01T00:00" max="9999-12-31T23:59">
                  <!-- <input class="form-control" name="data_horas" type="datetime-local" value="<?= $datetime ?>" id="html5-date-input" /> -->
                </div>
              </div>
              </div>
            </div>

            <!--Observações-->
            <div class="tab-pane fade" id="horizontal-messages">
              <div>
                <label for="exampleFormControlTextarea1" class="form-label">Observações</label>
                <textarea class="form-control" name="obs" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
            </div>
            <!--/ Custom content with heading -->
          </div>
           <input type="submit" name="salvar" class="btn btn-success" value="Salvar"/>
                        <button type="reset" name="cancelar" class="btn btn-danger">Cancelar</button>
        </div>
  </form>
      </div>
    </div>
    <script>
        const cpf = document.getElementById('cpf');
        cpf.addEventListener('keyup', vlw => {
          cpf.value =  cpf.value.replace(/[^\d]+/g,'');
         cpf.value =  formataCPF(cpf.value);
        })
    function formataCPF(cpf){
      //retira os caracteres indesejados...
      cpf = cpf.replace(/[^\d]+/g,'');
      //realizar a formatação...
      
      if(cpf.length < 10){
        return cpf.replace(/(\d{3})(\d{3})/, "$1.$2.");
      }else{
        return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
      }    
    }
                
      const pagamento = document.getElementById('forma_pagamento');
     pagamento.addEventListener('click', vlr => {
      vlr.preventDefault();
      document.getElementById('informacoes').classList.remove('tira');
      ocultarInput(pagamento.value);
     })
     function ocultarInput(Valor){
      if(Valor === '1'){
        document.getElementById('ug').classList.remove('tira');
        document.getElementById('siafi').classList.remove('tira');
        document.getElementById('recolimento').classList.add('tira');
      }else{
        document.getElementById('recolimento').classList.remove('tira');
        document.getElementById('ug').classList.add('tira');
        document.getElementById('siafi').classList.add('tira');
      }
     }
     
    </script>