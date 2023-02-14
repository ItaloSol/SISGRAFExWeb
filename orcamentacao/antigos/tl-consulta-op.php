<?php /* |||  ||| */ include_once("../html/navbar.php"); ?>


<!-- Div da Direita (Cadastro de Acabamentos) -->
<div class="row">
  <div class="accordion mt-3" id="accordionExample">
    <div class="card accordion-item active">
      <h2 class="accordion-header" id="headingOne">
        <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
          Consulta de Ordem de Produção
        </button>
      </h2>

      <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <div class="card-body">
            <form>
              <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">Pesquisar por</label>
                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                  <option selected>Selecione...</option>
                  <option value="1">Código</option>
                  <option value="2">Orçamento Base</option>
                  <option value="3">Produto</option>
                  <option value="4">Cliente</option>
                  <option value="5">Data Emissão</option>
                  <option value="6">Data de Entrega</option>
                  <option value="7">Status</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">Tipo de Cliente</label>
                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                  <option selected>Selecione o Tipo de Cliente</option>
                  <option value="1">Pessoa Física - Código</option>
                  <option value="2">Pessoa Física - Nome</option>
                  <option value="3">Pessoa Física - CPF (Somente Números)</option>
                  <option value="4">Pessoa Júridica - Código</option>
                  <option value="5">Pessoa Jurídica - Nome</option>
                  <option value="6">Pessoa Jurídica - Nome Fantasia</option>
                  <option value="7">Pessoa Jurídica - CNPJ (Somente Números)</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-default-company"></label>
                <input type="text" class="form-control" id="basic-default-company" placeholder="Insira o código/cpf/..." />
              </div>
              <div class="mb-3 row">
                <label for="html5-week-input" class="col-md-2 col-form-label">Data</label>
                <div class="col-md-10">
                  <input class="form-control" type="week" value="2021-W25" id="html5-week-input" />
                </div>
              </div>
              <button type="submit" class="btn btn-info">Consultar</button>
              <button type="submit" class="btn btn-dark">Mostrar Todos</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl">
    <div class="card mb-4">

    </div>

    <!-- Tabela de consulta e edição-->
    <div style="height: 500px; " class="card">
      <h5 class="card-header">Resultado</h5>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>OP</th>
                <th>Orçamento</th>
                <th>Produto</th>
                <th>Cliente</th>
                <th>Tipo de Cliente</th>
                <th>Data de Emissão</th>
                <th>Data de Entrega</th>
                <th>Status</th>
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
    </form>
    <!-- Botões de Edição -->
    <div class="card-body">
      <small class="text-light fw-semibold"></small>
      <div class="demo-inline-spacing">
        <div class="mb-3">
          <label for="formFile" class="btn btn-dark">Upload de Arquivos</label><br></br>
          <input class="form-control" type="file" id="formFile" />
        </div>
        <button type="button" class="btn btn-dark">Download de Arquivo</button>
        <button type="button" class="btn btn-primary">Gerar PDF</button>
        <button type="button" class="btn btn-success">Faturar</button>
        <button type="button" class="btn btn-danger">Cancelar</button>
      </div><br></br>
    </div>
  </div>
</div>
</div>
</div>


<?php /* |||  ||| */ include_once("../html/navbar-dow.php"); ?>