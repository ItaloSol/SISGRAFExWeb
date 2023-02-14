<?php
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
                 
                  <option value="1">2</option>
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
                  <input class="form-control" name="data_lancamento" type="date" value="<?= $data_correta ?>" id="html5-date-input" />
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
                          <option value="<?= $cod_contato ?>">Já selecionado!</option>
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
                          <option value="<?= $cod_endereco ?>">Já selecionado!</option>
                          <?php /* |||   */ 
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
                <select class="form-select" name="forma_pagamento" id="exampleFormControlSelect1" aria-label="Default select example" required>
                  <option value="<?= $forma_pagamento ?>" selected><?php /* |||   */ if($forma_pagamento == 1){echo 'SIGA/SIAFI';}else{echo 'GRU';} ?></option>
                  <option value="1">SIGA/SIAFI</option>
                  <option value="2">GRU</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlReadOnlyInput1" class="form-label">Valor da Nota (R$)</label>
                <input class="form-control" name="valor" value="<?= $valor ?>" type="number" step="0.01" id="exampleFormControlReadOnlyInput1" placeholder="Digite o Valor da nota" required />
              </div>
              <div class="divider divider-dark">
                <div class="divider-text">Informações de Pagamento</div>
              </div>
              <div class="mb-3 row">
                <label for="html5-text-input" class="col-md-2 col-form-label">CPF do Emissor</label>
                <div class="col-md-10">
                  <input class="form-control" name="cpf" value="<?= $CPF_usr ?>" type="text" id="html5-text-input" required/>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="html5-text-input" class="col-md-2 col-form-label">Nome do Emissor</label>
                <div class="col-md-10">
                  <input class="form-control" name="nome_emissor" value="<?= $nome_usr ?>" type="text" id="html5-text-input" required />
                </div>
              </div>
              <div class="mb-3 row">
                <label for="html5-text-input" class="col-md-2 col-form-label">Código do Recolhimento</label>
                <div class="col-md-10">
                  <input class="form-control" name="cod_recolhimete" value="<?php /* |||   */ if(isset($gru)){echo $gru;} ?>" type="text" id="html5-text-input" />
                </div>
              </div>
              <div class="mb-3 row">
                <label for="html5-text-input" class="col-md-2 col-form-label">Código SIAFI</label>
                <div class="col-md-10">
                  <input class="form-control" name="siafi" value="<?php /* |||   */ if(isset($siafi)){echo $siafi;} ?>" type="text" id="html5-text-input" />
                </div>
              </div>
              <div class="mb-3 row">
                <label for="html5-text-input" class="col-md-2 col-form-label">Código UG</label>
                <div class="col-md-10">
                  <input class="form-control" name="ug" value="<?php /* |||   */ if(isset($ug)){echo $ug;} ?>" type="text" id="html5-text-input" />
                </div>
              </div>
              <div class="mb-3 row">
                <label for="html5-date-input" class="col-md-2 col-form-label">Data e Hora do Lançamento</label>
                <div class="col-md-10">
                  <input class="form-control" name="data_horas" value="<?= $data_hora ?>" type="datetime-local" value="<?= $datetime ?>" id="html5-date-input" />
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