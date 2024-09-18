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
        <form method="POST" action="save_cadastro_cliente.php">
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
                  <option value="2">Pessoa Jurídica</option>
                  <option value="1">Pessoa Física</option>
                </select>
              </div>
              <div class="divider divider-dark">
                <div class="divider-text">Dados Pessoais</div>
              </div>
              <div class="mb-3">
                <label for="NomeCliente" class="form-label">Nome do Cliente</label>
                <input type="text" class="form-control" name="NomeCliente" id="NomeCliente" placeholder="Insira o nome do Cliente" required />
              </div>
              <div class="mb-3" id="Anomedantasia">
                <label for="NomeFantasia" class="form-label">Nome Fantasia</label>
                <input type="text" class="form-control" name="NomeFantasia" id="NomeFantasia" placeholder="Insira o nome Fantasia do Cliente" />
              </div>
              <div class="mb-3" id="Acpf">
                <label for="CPF" class="form-label">CPF</label>
                <input type="text" class="form-control" name="CPF" id="CPF" placeholder="Insira o CPF do Cliente"  />
              </div>
              <div class="mb-3" id="Acnpj">
                <label for="CNPJ" class="form-label">CNPJ</label>
                <input type="text" class="form-control" name="CNPJ" id="CNPJ" placeholder="Insira o CNPJ do Cliente"  />
              </div>
              <div class="mb-3" id="AtividadeFisico">
                <label for="Atividade" class="form-label">Selecione o Tipo de Cliente</label>
                <select class="form-select" name="Atividade" id="Atividade" aria-label="Default select example">
                  <option value="Militar">Militar</option>
                  <option value="Fornecedor">Fornecedor</option>
                  <option value="Civil">Civil</option>
                </select>
              </div>
              <div class="mb-3" id="juridicoAtivi">
                <label for="Atividade" class="form-label">Selecione a Atividade que o Quartel Exerce</label>
                <select class="form-select" name="Atividade" id="Atividade" aria-label="Default select example">
                  <option value="quartel administrativo">Quartel Administrativo</option>
                  <!-- outras opções -->
                  <option value="quartel de treinamento de defesa cibernetica">Quartel de Treinamento de Operações de Defesa Cibernética</option>
                </select>
              </div>
              <div class="mb-3" id="filialcoligada">
                <label for="Filial" class="form-label">Filial/Coligada/Relacionada</label>
                <input type="text" class="form-control" name="Filial" id="Filial" placeholder="Insira a filial/coligada" />
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
              <div class="mb-3">
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
                <select class="form-select" name="TipoEndereco" id="TipoEndereco" aria-label="Default select example" required>
                  <option selected>Selecione o tipo...</option>
                  <option value="1">Residencial</option>
                  <option value="2">Comercial</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="Cep" class="form-label">CEP</label>
                <input class="form-control" type="text" name="Cep" id="Cep" placeholder="Insira o CEP do Cliente" required />
              </div>
              <button type="button" class="btn btn-primary" id="buscarCep" onclick="BuscarCep(document.getElementById('Cep').value)">Buscar CEP (OPCIONAL)</button><br><br>
              <div id="carregando"></div>
              <div id="puxadoApi">
                <div class="mb-3">
                  <label for="Bairro" class="form-label">Bairro</label>
                  <input class="form-control" type="text" name="Bairro" id="Bairro" placeholder="Insira o bairro do Cliente" />
                </div>
                <div class="mb-3">
                  <label for="cidade" class="form-label">Cidade</label>
                  <input class="form-control" type="text" name="cidade" id="cidade" placeholder="Insira a cidade do Cliente" required />
                </div>
                <div class="mb-3">
                  <label for="uf" class="form-label">UF</label>
                  <input class="form-control" type="text" name="uf" id="uf" placeholder="Insira a UF do Cliente" />
                </div>
                <div class="mb-3">
                  <label for="logadouro" class="form-label">Logradouro</label>
                  <input class="form-control" type="text" name="logadouro" id="logadouro" placeholder="Insira o logradouro do Cliente" />
                </div>
                <div class="mb-3">
                  <label for="complemento" class="form-label">Complemento</label>
                  <input class="form-control" type="text" name="complemento" id="complemento" placeholder="Insira o complemento" />
                </div>
              </div>
            </div>
            <!-- Contatos -->
            <div class="tab-pane fade" id="horizontal-messages">
              <div class="divider divider-dark">
                <div class="divider-text">Contato</div>
              </div>
              <div class="mb-3">
                <label for="NomeContato" class="form-label">Nome para Contato</label>
                <input class="form-control" type="text" name="NomeContato" id="NomeContato" placeholder="Insira o nome para contato" required />
              </div>
              <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input class="form-control" type="email" name="Email" id="Email" placeholder="Insira o email" required />
              </div>
              <div class="mb-3">
                <label for="Departamento" class="form-label">Departamento</label>
                <input class="form-control" type="text" name="Departamento" id="Departamento" placeholder="Insira o departamento" />
              </div>
              <div class="mb-3">
                <label for="Telefone" class="form-label">Telefone</label>
                <input class="form-control" type="text" name="Telefone" id="Telefone" placeholder="Insira o telefone" />
              </div>
              <div class="mb-3">
                <label for="Celular" class="form-label">Celular</label>
                <input class="form-control" type="text" name="Celular" id="Celular" placeholder="Insira o celular" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <br />
      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
  </div>
</form>

</div><br>

<script>
const Acpf = document.getElementById('Acpf');
const Acnpj = document.getElementById('Acnpj');
const nomedantasia = document.getElementById('Anomedantasia');
const selecionado = document.getElementById('TipoCliente');
const AtividadeFisico = document.getElementById('AtividadeFisico');
const juridicoAtivi = document.getElementById('juridicoAtivi');
const filialcoligada = document.getElementById('filialcoligada');
document.getElementById("puxadoApi").style.display = 'block';



async function BuscarCep(val) {
  document.getElementById("puxadoApi").style.display = 'block';
  document.getElementById("carregando").innerHTML = '<p>CARREGANDO....</p>';
  
  try {
    const response = await fetch('https://viacep.com.br/ws/' + val + '/json/');
    const data = await response.json();

    if (!data.localidade) {
      document.getElementById("carregando").innerHTML = '<p>CEP NÃO ENCONTRADO</p>';
    } else {
      document.getElementById('Bairro').value = data.bairro || '';
      document.getElementById('cidade').value = data.localidade || '';
      document.getElementById('uf').value = data.uf || '';
      document.getElementById('logadouro').value = data.logradouro || '';
      document.getElementById('complemento').value = data.complemento || '';
      document.getElementById("carregando").innerHTML = '';
      document.getElementById("puxadoApi").style.display = 'block';
    }
  } catch (error) {
    document.getElementById("carregando").innerHTML = '<p>Erro ao buscar o CEP</p>';
  }
}

function juridico() {
  nomedantasia.style.display = 'block';
  Acnpj.style.display = 'block';
  Acpf.style.display = 'none';
  juridicoAtivi.style.display = 'block';
  filialcoligada.style.display = 'block';
  AtividadeFisico.style.display = 'none';
}

function fisico() {
  nomedantasia.style.display = 'none';
  Acnpj.style.display = 'none';
  filialcoligada.style.display = 'none';
  AtividadeFisico.style.display = 'block';
  juridicoAtivi.style.display = 'none';
  Acpf.style.display = 'block';
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

const cep = document.getElementById('Cep');
cep.addEventListener('input', () => {
  cep.value = cep.value.replace(/\D/g, '');
  cep.value = formataCEP(cep.value);
});

function formataCEP(cep) {
  //retira os caracteres indesejados...
  return cep = cep.replace(/\D/g, '');
  //realiza a formatação...
}

const cpf = document.getElementById('CPF');
cpf.addEventListener('keyup', vlw => {
  cpf.value = cpf.value.replace(/[^\d]+/g, '');
  cpf.value = formataCPF(cpf.value);
})

function formataCPF(cpf) {
  //retira os caracteres indesejados...
  cpf = cpf.replace(/[^\d]+/g, '');
  //realizar a formatação...

  if (cpf.length < 10) {
    return cpf.replace(/(\d{3})(\d{3})/, "$1.$2.");
  } else {
    return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
  }
}
const cnpj = document.getElementById('CNPJ');
cnpj.addEventListener('keyup', vlw => {
  cnpj.value = cnpj.value.replace(/[^\d]+/g, '');
  cnpj.value = formataCNPJ(cnpj.value);
})

function formataCNPJ(cnpj) {
  //retira os caracteres indesejados...
  cnpj = cnpj.replace(/[^\d]+/g, '');
  //realizar a formatação...

  if (cnpj.length < 14) {
    return cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})/, "$1.$2.$3/$4");
  } else {
    return cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
  }
}
</script>







<?php /* |||  ||| */ include_once("../html/navbar-dow.php"); ?>