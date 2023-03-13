<?php
 $Notas = $conexao->prepare("SELECT * FROM tabela_notas WHERE cod = $cod");
 $Notas->execute();
 while ($linha = $Notas->fetch(PDO::FETCH_ASSOC)) {
   $cod = $linha['cod'];
   $serie = $linha['serie'];
   $tipo = $linha['tipo'];
   $forma_pagamento = $linha['forma_pagamento'];
   $cod_emissor = $linha['cod_emissor'];
   $cod_cliente = $linha['cod_cliente'];
   $cod_endereco = $linha['cod_endereco'];
   $cod_contato = $linha['cod_contato'];
   $tipo_pessoa = $linha['tipo_pessoa'];
   $valor = $linha['valor'];
   $datalanca = $linha['data'];
 }
if ($forma_pagamento == '1') {
  $tabela_interana = $conexao->prepare("SELECT * FROM nt_credito_lanc_siafi WHERE NT_CREDITO_CODIGO = $cod");
} else {
  $tabela_interana = $conexao->prepare("SELECT * FROM nt_credito_lanc_gru WHERE NT_CREDITO_CODIGO = $cod");
}
$tabela_interana->execute();
$i = 0;
while ($linha3 = $tabela_interana->fetch(PDO::FETCH_ASSOC)) {
  $CPF_usr = $linha3['CPF_USR'];
  $nome_usr = $linha3['NOME_USR'];
  if ($forma_pagamento == 4) {
    $gru = $linha3['CODIGO_REC'];
  } elseif($forma_pagamento == 1) {
    $siafi = $linha3['NT_CREDITO_CODIGO_SIAFI'];
    $ug = $linha3['UG'];
  }

  $data_hora = $linha3['DATA_HORA'];
}
if(!isset($CPF_usr)){
  $CPF_usr = 'NÃO FOI CADASTRADO CORRETAMENTE, FAVOR INSIRA OS DADOS CORRETAMENTE E SALVE A ALTERAÇÃO';
}
if(!isset($nome_usr)){
  $nome_usr = 'NÃO FOI CADASTRADO CORRETAMENTE, FAVOR INSIRA OS DADOS CORRETAMENTE E SALVE A ALTERAÇÃO';
}
$tabela_atendentes = $conexao->prepare("SELECT * FROM tabela_atendentes WHERE codigo_atendente = '$cod_emissor'");
$tabela_atendentes->execute();
$i = 0;
if($linha4 = $tabela_atendentes->fetch(PDO::FETCH_ASSOC)) {
  $nome = $linha4['nome_atendente'];
}
$tabela_CONTATO = $conexao->prepare("SELECT * FROM tabela_contatos WHERE cod = $cod_contato");
$tabela_CONTATO->execute();
$i = 0;
while ($linha4 = $tabela_CONTATO->fetch(PDO::FETCH_ASSOC)) {
  $Cliente_Contato_Puxadu = [
    'cod' => $linha4['cod'],
    'nome_contato' => $linha4['nome_contato'],
    'email' => $linha4['email'],
    'telefone' => $linha4['telefone'],
    'ramal' => $linha4['ramal'],
    'telefone2' => $linha4['telefone2'],
    'ramal2' => $linha4['ramal2'],
    'departamento' => $linha4['departamento'],
    'excluido' => $linha4['excluido'],
  ];
}
$tabela_endereco = $conexao->prepare("SELECT * FROM tabela_enderecos WHERE cod = $cod_endereco");
$tabela_endereco->execute();
$i = 0;
while ($linha = $tabela_endereco->fetch(PDO::FETCH_ASSOC)) {
  $Cliente_Enderecos_Puxadu = [
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

?>
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
                <select class="form-select" name="serie" value="<?= $serie ?>" id="exampleFormControlSelect1" aria-label="Default select example">
                 
                  <option value="1" >2</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Número</label>
                <input class="form-control" name="numero" value="<?= $cod ?>" type="text" id="exampleFormControlReadOnlyInput1" placeholder="" readonly />
              </div>
              <div class="mb-3">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Modelo</label>
                <input class="form-control" name="modelo"  type="text" id="exampleFormControlReadOnlyInput1" placeholder="1 - Nota Fiscal, Modelo 1 ou 1-A" readonly />
              </div>
              <div class="mb-3 row">
                <label for="html5-date-input" class="col-md-2 col-form-label">Data de Lançamento</label>
                <div class="col-md-10">
                  <input class="form-control" name="data_lancamento" type="date" value="<?= $data_correta ?>" id="html5-date-input" readonly />
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
                <input class="form-control" value="<?php echo $cod_emissor .' - '. $nome ; ?>" type="text" id="exampleFormControlReadOnlyInput1" placeholder="" readonly />
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
                <input class="form-control" type="text" name="tipo_cliente" value="<?= $tipo_pessoa ?>" id="exampleFormControlReadOnlyInput1" placeholder="" readonly />
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
                    <option value="<?= $Cliente_Contato_Puxadu['cod']?>"><?php echo ''.$Cliente_Contato_Puxadu['nome_contato'].' '.$Cliente_Contato_Puxadu['telefone'].' '.$Cliente_Contato_Puxadu['email'].''; ?></option>
                          <?php /* |||   */ 
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
                        <select class="form-select" name="endereco" id="exampleFormControlSelect1" aria-label="Default select example">
                          <?php  echo '<option value="'.$Cliente_Enderecos_Puxadu['cod'].'">Cep: '.$Cliente_Enderecos_Puxadu['cep'].' UF: '.$Cliente_Enderecos_Puxadu['uf'].' logadouro: '.$Cliente_Enderecos_Puxadu['logadouro'].' cidade: '.$Cliente_Enderecos_Puxadu['cidade'].'</option>'; ?>
                          <?php /* |||   */ 
                          $a = 0;
                          while($endereco > $a){
                            echo '<option value="'.$Cliente_Enderecos_Puxado[$a]['cod'].'">Cep: '.$Cliente_Enderecos_Puxado[$a]['cep'].' UF: '.$Cliente_Enderecos_Puxado[$a]['uf'].' logadouro: '.$Cliente_Enderecos_Puxado[$a]['logadouro'].' cidade: '.$Cliente_Enderecos_Puxado[$a]['cidade'].'</option>';
                            $a++;
                          }
                          ?>
                        </select>
                      </div>
              <style>
                .tira{
                  display: none;
                }
              </style>
            </div>
            <!--Dados de Pagamento-->
            <div class="tab-pane fade" id="horizontal-profile">
              <div class="mb-3">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Forma de Pagamento</label>
                <select class="form-select" name="forma_pagamento" id="forma_pagamento" aria-label="Default select example" required>
                  <option value="<?= $forma_pagamento ?>" selected><?php /* |||   */ if($forma_pagamento == 1){echo 'SIGA/SIAFI';}else{echo 'GRU';} ?></option>
                  <option value="1">SIGA/SIAFI</option>
                  <option value="2">GRU</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Valor da Nota (R$)</label>
                <input class="form-control" name="valor" value="<?= $valor ?>" type="number" step="0.01" id="exampleFormControlReadOnlyInput1" placeholder="Digite o Valor da nota" required />
              </div>
             
              <div class="divider divider-dark ">
                <div class="divider-text">Informações de Pagamento</div>
              </div>
              <div id="informacoes" class="tira">
              <div class="mb-3 row">
                <label for="html5-text-input" class="col-md-2 col-form-label">CPF do Emissor</label>
                <div class="col-md-10">
                  <input class="form-control" id="cpf" name="cpf" value="<?= $CPF_usr ?>" type="text" id="html5-text-input" required/>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="html5-text-input" class="col-md-2 col-form-label">Nome do Emissor</label>
                <div class="col-md-10">
                  <input class="form-control" name="nome_emissor" value="<?= $nome_usr ?>" type="text" id="html5-text-input" required />
                </div>
              </div>
              <div id="recolimento" class="mb-3  row">
                <label for="html5-text-input" class="col-md-2 col-form-label">Código do Recolhimento</label>
                <div class="col-md-10">
                  <input class="form-control" name="cod_recolhimete" value="<?php /* |||   */ if(isset($gru)){echo $gru;} ?>" type="text" id="html5-text-input" />
                </div>
              </div>
              <div id="siafi" class="mb-3 row">
                <label for="html5-text-input" class="col-md-2 col-form-label">Código SIAFI</label>
                <div class="col-md-10">
                  <input class="form-control" name="siafi" value="<?php /* |||   */ if(isset($siafi)){echo $siafi;} ?>" type="text" id="html5-text-input" />
                </div>
              </div>
              <div id="ug" class="mb-3 row">
                <label for="html5-text-input" class="col-md-2 col-form-label">Código UG</label>
                <div class="col-md-10">
                  <input class="form-control" name="ug" value="<?php /* |||   */ if(isset($ug)){echo $ug;} ?>" type="text" id="html5-text-input" />
                </div>
              </div>
              <div class="mb-3 row">
                <label for="html5-date-input" class="col-md-2 col-form-label">Data e Hora do Lançamento</label>
                <div class="col-md-10">
                  <input class="form-control" name="data_horas" value="<?= $data_hora ?>" type="datetime-local" value="<?= $datetime ?>" id="html5-date-input" desa />
                </div>
              </div>
              </div>
            </div>

            <!--Observações-->
            <div class="tab-pane fade" id="horizontal-messages">
              <div>
                <label for="exampleFormControlTextarea1" class="form-label">Observações</label>
                <textarea class="form-control" name="obs" " id="exampleFormControlTextarea1" rows="3"><?= $observacoes ?></textarea>
              </div>
            </div>
            <!--/ Custom content with heading -->
          </div>
           <input type="submit" name="editar" class="btn btn-success" value="Salvar"/>
                        <input type="submit" name="excluir" value="excluir" class="btn btn-danger"/>
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