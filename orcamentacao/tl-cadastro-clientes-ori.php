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
                  </div>
                  <div class="tab-content px-0 mt-0">
                    <!-- Informações do Cliente -->
                    <div class="tab-pane fade show active" id="horizontal-home">
                      <div class="divider divider-dark">
                        <div class="divider-text">Tipo de Cliente</div>
                      </div>
                      <div class="mb-3">
                        <label for="TipoCliente" class="form-label">Selecione o Tipo do Cliente</label>
                        <select class="form-select" name="TipoCliente" id="TipoCliente" aria-label="Default select example">
                          <option value="2">Pessoa Júridica</option>
                          <option value="1">Pessoa Física</option>
                        </select>
                      </div>
                      <div class="divider divider-dark">
                        <div class="divider-text">Dados Pessoais</div>
                      </div>
                      <div>
                        <label for="NomeCliente" class="form-label">Nome do Cliente</label>
                        <input type="text" class="form-control" name="NomeCliente" id="NomeCliente" placeholder="Insira o nome do Cliente" aria-describedby="defaultFormControlHelp" />
                      </div>
                      <div id="Anomedantasia">
                        <label for="NomeFantasia" class="form-label">Nome Fantasia</label>
                        <input type="text" class="form-control" name="NomeFantasia" id="NomeFantasia" placeholder="Insira o nome do Fantasia do Cliente" aria-describedby="defaultFormControlHelp" />
                      </div>
                      <div id="Acpf">
                        <label for="CPF" class="form-label">CPF</label>
                        <input type="text" class="form-control" name="CPF" id="CPF" placeholder="Insira o cpf do cliente" aria-describedby="defaultFormControlHelp" />
                      </div>
                      <div id="Acnpj">
                        <label for="CNPJ" class="form-label">CNPJ</label>
                        <input type="text" class="form-control" name="CNPJ" id="CNPJ" placeholder="Insira o cpnj do Cliente" aria-describedby="defaultFormControlHelp" />
                      </div>
                      <br>
                      <div id="AtividadeFisico" class="mb-3">
                        <label for="Atividade" class="form-label">Selecione o Tipo de Cliente</label>
                        <select class="form-select" name="Atividade" id="Atividade" aria-label="Default select example">
                          <option value="Militar">Militar</option>
                          <option value="Fornecedor">Fornecedor</option>
                          <option value="Civil">Civil</option>
                        </select>
                      </div>
                      <div id="juridicoAtivi" class="mb-3">
                        <label for="Atividade" class="form-label">Selecione a atividade que o quartel exerce</label>
                        <select class="form-select" name="Atividade" id="Atividade" aria-label="Default select example">

                          <option value="quartel_administrativo">Quartel Administrativo</option>
                          <option value="quartel_de_tropa">Quartel de Tropa</option>
                          <option value="quartel_de_defesa_cibernetica">Quartel de Defesa Cibernética</option>
                          <option value="quartel_de_inteligencia">Quartel de Inteligência</option>
                          <option value="quartel_de_saude">Quartel de Saúde</option>
                          <option value="quartel_de_engenharia">Quartel de Engenharia</option>
                          <option value="quartel_de_treinamento">Quartel de Treinamento</option>
                          <option value="quartel_de_aviacao">Quartel de Aviação</option>
                          <option value="quartel_de_artilharia">Quartel de Artilharia</option>
                          <option value="quartel_de_operacoes_especiais">Quartel de Operações Especiais</option>
                          <option value="quartel_de_comunicacoes">Quartel de Comunicações</option>
                          <option value="quartel_de_logistica">Quartel de Logística</option>
                          <option value="quartel_de_operacoes_navais">Quartel de Operações Navais</option>
                          <option value="quartel_de_defesa_cbrn">Quartel de Defesa CBRN</option>
                          <option value="quartel_de_operacoes_de_paz">Quartel de Operações de Paz</option>
                          <option value="quartel_de_engajamento_com_a_comunidade">Quartel de Engajamento com a Comunidade</option>
                          <option value="quartel_de_defesa_costeira">Quartel de Defesa Costeira</option>
                          <option value="quartel_de_operacoes_de_resgate">Quartel de Operações de Resgate</option>
                          <option value="quartel_de_treinamento_de_seguranca">Quartel de Treinamento de Segurança</option>
                          <option value="quartel_de_operacoes_de_reconhecimento">Quartel de Operações de Reconhecimento</option>
                          <option value="quartel_de_operacoes_de_guerra_eletronica">Quartel de Operações de Guerra Eletrônica</option>
                          <option value="quartel_de_treinamento_de_defesa_cibernetica">Quartel de Treinamento de Operações de Defesa Cibernética</option>
                        </select>
                      </div>
                      <div>
                        <label for="Filial" class="form-label">Filial/Coligada/Relacionada</label>
                        <input type="text" class="form-control" name="Filial" id="Filial" placeholder="Insira a filiar/coligada" aria-describedby="defaultFormControlHelp" />
                      </div>
                      <div class="divider divider-dark">
                        <div class="divider-text">Atendente</div>
                      </div>
                      <div class="row">
                        <div class="col-3">
                          <label for="CodAtendente" class="form-label">Código do Atendente</label>
                          <input class="form-control" type="text" value="<?= $cod_user ?>" name="CodAtendente" id="CodAtendente" readonly />
                        </div>
                        <div class="col-3">
                          <label for="NomeAtendente" class="form-label">Nome do Atendente</label>
                          <input class="form-control" type="text" value="<?= $nome_user ?>" name="NomeAtendente" id="NomeAtendente" readonly />
                        </div>
                      </div>
                      <div>
                        <label for="ObsCliente" class="form-label">Observações do Cliente</label>
                        <textarea class="form-control" name="ObsCliente" id="ObsCliente" rows="3"></textarea>
                      </div>
                    </div>
                    <!-- Endereços -->
                    <div class="tab-pane fade" id="horizontal-profile">
                      <div class="divider divider-dark">
                        <div class="divider-text">Endereço</div>
                      </div>
                      <div class="mb-3">
                        <label for="TipoEndereco" class="form-label">Tipo de Endereço</label>
                        <select class="form-select" name="TipoEndereco" id="TipoEndereco" aria-label="Default select example">
                          <option selected>Selecione o tipo...</option>
                          <option value="1">Residencial</option>
                          <option value="2">Comercial</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="Cep" class="form-label">CEP</label>
                        <input class="form-control" type="number" name="Cep" id="Cep" placeholder="Insira o CEP do Cliente" />
                      </div>
                      <a class="btn btn-primary" id="buscarCep" onclick="BuscarCep(document.getElementById('Cep').value)">Buscar cep</a><br><br>
                      <div id="carregando"></div>
                      <div id="puxadoApi">
                        <div class="mb-3">
                          <label for="Bairro" class="form-label">Bairro</label>
                          <input class="form-control" type="text" name="Bairro" id="Bairro" placeholder="Insira o bairro do Cliente" />
                        </div>
                        <div class="mb-3">
                          <label for="cidade" class="form-label">Cidade</label>
                          <input class="form-control" type="text" name="cidade" id="cidade" placeholder="Insira a cidade do Cliente" />
                        </div>
                        <div class="mb-3">
                          <label for="uf" class="form-label">UF</label>
                          <input class="form-control" type="text" name="uf" id="uf" placeholder="Insira a UF do Cliente" />
                        </div>
                        <div class="mb-3">
                          <label for="logadouro" class="form-label">Logadouro</label>
                          <input class="form-control" type="text" name="logadouro" id="logadouro" placeholder="Insira o logadouro do Cliente" />
                        </div>
                        <div class="mb-3">
                          <label for="complemento" class="form-label">Complemento</label>
                          <input class="form-control" type="text" name="complemento" id="complemento" placeholder="Insira o complemento" />
                        </div>
                      </div>
                    </div>
                    <!-- Contatos -->
                    <div class="tab-pane fade" id="horizontal-messages">
                      <div div class="divider divider-dark">
                        <div class="divider-text">Contato</div>
                      </div>
                      <div class="mb-3">
                        <label for="NomeContato" class="form-label">Nome para Contato</label>
                        <input class="form-control" type="text" name="NomeContato" id="NomeContato" placeholder="Insira o nome para contato" />
                      </div>
                      <div class="mb-3">
                        <label for="Email" class="form-label">Email</label>
                        <input class="form-control" type="text" name="Email" id="Email" placeholder="Insira o email" />
                      </div>
                      <div class="mb-3">
                        <label for="Departamento" class="form-label">Departamento</label>
                        <input class="form-control" type="text" name="Departamento" id="Departamento" placeholder="Insira o departamento" />
                      </div>
                      <div class="mb-3">
                        <label for="Telefone" class="form-label">Telefone Principal</label>
                        <input class="form-control" type="text" name="Telefone" id="Telefone" placeholder="Insira o telefone principal" />
                      </div>
                      <div class="mb-3">
                        <label for="Telefone2" class="form-label">Telefone Secundário</label>
                        <input class="form-control" type="text" name="Telefone2" id="Telefone2" placeholder="Insira o telefone secundário" />
                      </div>
                      <input type="submit" class="btn btn-primary" value="Cadastrar" name="cadastrar">
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
</form>
</div><br>

<script>
const cpf = document.getElementById('Acpf');
const cnpj = document.getElementById('Acnpj');
const nomedantasia = document.getElementById('Anomedantasia');
const selecionado = document.getElementById('TipoCliente');
const AtividadeFisico = document.getElementById('AtividadeFisico');
const juridicoAtivi = document.getElementById('juridicoAtivi');
document.getElementById("puxadoApi").style.display = 'none';
const cep = document.getElementById('Cep');
cep.addEventListener('input', () => {
  cep.value = cep.value.replace(/[^\d]+/g, '');
  cep.value = formataCep(cep.value);
});


async function BuscarCep(val) {
  document.getElementById("puxadoApi").style.display = 'none';
  document.getElementById("carregando").innerHTML = '<p>CARREGANDO....</p>';
  const valor = fetch('https://viacep.com.br/ws/' + val + '/json/')
    .then(response => response.json())
    .then(data => {
      return {
        cep: data.cep,
        logradouro: data.logradouro,
        complemento: data.complemento,
        bairro: data.bairro,
        localidade: data.localidade,
        uf: data.uf,
        ibge: data.ibge,
        gia: data.gia,
        ddd: data.ddd,
        siafi: data.siafi
      }
    });
  await valor.then(result => {
    if (result.localidade == undefined) {
      document.getElementById("carregando").innerHTML = '<p>CEP NÃO ENCONTRADO</p>';
    } else {
      document.getElementById('Bairro').value = result.bairro
      document.getElementById('cidade').value = result.localidade
      document.getElementById('uf').value = result.uf
      document.getElementById('logadouro').value = result.logradouro
      document.getElementById('complemento').value = result.complemento
      document.getElementById("carregando").innerHTML = '';
      document.getElementById("puxadoApi").style.display = 'block';
    }
  });

}

function juridico() {
  nomedantasia.style.display = 'block';
  cnpj.style.display = 'block';
  cpf.style.display = 'none';
  juridicoAtivi.style.display = 'block';
  AtividadeFisico.style.display = 'none';
}

function fisico() {
  nomedantasia.style.display = 'none';
  cnpj.style.display = 'none';
  AtividadeFisico.style.display = 'block';
  juridicoAtivi.style.display = 'none';
  cpf.style.display = 'block';
}
selecionado.addEventListener('click', vlr => {
  console.log(selecionado.value)
  if (selecionado.value == 1) {
    fisico();
  } else {
    juridico();
  }
})
juridico();
</script>







<?php /* |||  ||| */ include_once("../html/navbar-dow.php"); ?>