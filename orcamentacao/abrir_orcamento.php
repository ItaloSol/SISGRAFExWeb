<style>
  .tira {
    display: none;
  }
</style>
<?php include_once("../html/../html/navbar.php");
$_SESSION["pag"] = array(1, 0);



if (isset($_POST['numero1']) or isset($_POST['numero2'])) {
  $cod_orcamento = 000;
  if ($_POST['numero1'] != '') {
    $Pesquisa_Cliente = $_POST['numero1'];
  } else {
    $Pesquisa_Cliente = $_POST['numero2'];
  }

  $Tipo_Cliente = $_POST['tipo_cliente'];


  $tipo_papel_qtd_loop = 0;
  $qtd_acabamentos = 0;
  $papels = 0;
  $servicos = 0;

  $query_Sts = $conexao->prepare("SELECT * FROM sts_orcamento  ORDER BY CODIGO ASC ");
  $query_Sts->execute();
  $Sts = 0;
  while ($linha = $query_Sts->fetch(PDO::FETCH_ASSOC)) {
    $Nome_Sts = $linha['STS_DESCRICAO'];
    $codigo_Sts = $linha['CODIGO'];

    $Nome_Sts_P[$Sts] = $Nome_Sts;
    $Codigo_Sts_P[$Sts] = $codigo_Sts;
    $Sts++;
  }
  $configuracoes = $conexao->prepare("SELECT * FROM configuracoes WHERE configuracao = 'valor de chapa' ");
  $configuracoes->execute();
  $Sts = 0;
  while ($linha = $configuracoes->fetch(PDO::FETCH_ASSOC)) {
    $preco_chapa = $linha['parametro'];
  }

  if ($Tipo_Cliente == '1') {

    $cliente = 'Fisico';
    $query_PRODUTOS = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos  WHERE cod = '$Pesquisa_Cliente'");
  }
  if ($Tipo_Cliente == '2') {
    $cliente = 'Juridico';
    $query_PRODUTOS = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos  WHERE cod = '$Pesquisa_Cliente'");
  }
  $query_PRODUTOS->execute();

  while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
    $Tabela_Clientes = [
      'cod' => $linha2['cod'],
      'nome' => $linha2['nome'],
      'credito' => $linha2['credito']
    ];
    if ($Tipo_Cliente == '2') {
      $documento = $linha2['cnpj'];
    } else {
      $documento = $linha2['cpf'];
    }
  }


  $Clientes_Contato_Juridicos = $conexao->prepare("SELECT * FROM tabela_associacao_contatos a INNER JOIN tabela_contatos e ON a.cod_contato = e.cod WHERE a.cod_cliente = '$Pesquisa_Cliente' AND a.tipo_cliente = '$Tipo_Cliente' LIMIT 15");
  $Clientes_Contato_Juridicos->execute();
  $contato = 0;
  while ($linha = $Clientes_Contato_Juridicos->fetch(PDO::FETCH_ASSOC)) {

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
  $Clientes_Endereco_Juridicos = $conexao->prepare("SELECT * FROM tabela_associacao_enderecos a INNER JOIN tabela_enderecos e ON a.cod_endereco = e.cod WHERE a.cod_cliente = '$Pesquisa_Cliente' AND a.tipo_cliente = '$Tipo_Cliente' LIMIT 15 ");
  $Clientes_Endereco_Juridicos->execute();
  $i = 0;
  $endereco = 0;
  while ($linha = $Clientes_Endereco_Juridicos->fetch(PDO::FETCH_ASSOC)) {

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


  //////
  if (isset($Orcamento_pesquisa)) {
    $Total_Finalizadas = count($Orcamento_pesquisa);
  } else {
    $Total_Finalizadas = 0;
  }
  $Percorrer_Finalizadas = 0;
  $valor_total_Finalizadas = 0;
  $hoje = date('Y-m-d');
  $data30 = date('Y-m-d', strtotime('+' . 30 . 'day', strtotime($hoje)));


?>



  <div class=" orcamento-- "></div>

  <!-- Tela de Orçamento -->



  <!--  -->
  <div class="col-md mb-4 mb-md-0">
    <div class="accordion mt-3" id="accordionExample">
      <div class="card accordion-item active">
        <h2 class="accordion-header" id="headingOne">
          <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
            Orçamento
          </button>
        </h2>

        <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="col-xxl">
              <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                </div>
                <div class="card-body">

                  <div class="mb-3 row">


                    <label for="html5-date-input" class="col-md-2 col-form-label">Data de Validade</label>
                    <div class="col-md-10">
                      <div class="input-group">


                        <div class="row">
                          <div class="col-12">
                            <input class="form-control " type="date" name="data_validade" id="data_validade" value="<?= $data30 ?>" />
                          </div>

                        </div>
                        <!--  -->


                      </div>

                    </div>
                  </div>
                  <br>
                  <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Informações do Cliente</h5>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Tipo de Pessoa</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" disabled id="basic-default-name" value="<?= $cliente ?>" placeholder="Fisicou ou Juridica" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-company">Código do Cliente</label>
                        <div class="col-sm-10">
                          <input type="text" disabled value="<?= $Pesquisa_Cliente ?>" class="form-control" id="basic-default-company" placeholder="" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-company">Nome do Cliente</label>
                        <div class="col-sm-10">
                          <input type="text" disabled class="form-control" value="<?= $Tabela_Clientes['nome'] ?>" id="basic-default-company" placeholder="" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-company">CPF/CNPJ</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" disabled value="<?= $documento ?>" id="basic-default-company" placeholder="" />
                        </div>
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
                          while ($contato > $a) {
                            echo '<option value="' . $Cliente_Contato_Puxado[$a]['cod'] . '">' . $Cliente_Contato_Puxado[$a]['nome_contato'] . ' ' . $Cliente_Contato_Puxado[$a]['telefone'] . ' ' . $Cliente_Contato_Puxado[$a]['email'] . '</option>';
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
                          while ($endereco > $a) {
                            echo '<option value="' . $Cliente_Enderecos_Puxado[$a]['cod'] . '">Cep: ' . $Cliente_Enderecos_Puxado[$a]['cep'] . ' UF: ' . $Cliente_Enderecos_Puxado[$a]['uf'] . ' logadouro: ' . $Cliente_Enderecos_Puxado[$a]['logadouro'] . ' cidade: ' . $Cliente_Enderecos_Puxado[$a]['cidade'] . '</option>';
                            $a++;
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="divider divider-dark">
                      <div class="divider-text">CRÉDITO</div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-company">Crédito</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" disabled value="<?= number_format($Tabela_Clientes['credito'], 2, ',', '.') ?>" id="basic-default-company" placeholder="" />
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

  <!-- Informações Sobre o Orçamento (Segundo Drop) -->
  <div class="card accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="true" aria-controls="accordionTwo">
        Informações Sobre o Orçamento
      </button>
    </h2>
    <div id="accordionTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <div class="col-lg-12">
          <div class="demo-inline-spacing mt-3">
            <div class="list-group list-group-horizontal-md text-md-center">
              <a class="list-group-item list-group-item-action active" id="home-list-item" data-bs-toggle="list" href="#horizontal-prod">Produtos</a>
              <a class="list-group-item list-group-item-action" id="profile-list-item1" data-bs-toggle="list" href="#horizontal-tir">Tiragens</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item3" data-bs-toggle="list" href="#horizontal-pap">Papel</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item4" data-bs-toggle="list" href="#horizontal-aca">Acabamentos</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item5" data-bs-toggle="list" href="#horizontal-ser">Serviços</a>
              <a class="list-group-item list-group-item-action" id="settings-list-item6" data-bs-toggle="list" href="#horizontal-obs">Observações</a>
            </div>
            <div class="tab-content px-0 mt-0">
              <div class="tab-pane fade show active" id="horizontal-prod">
                <div class="card">
                  <h5 class="card-header">PRODUTOS <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal1">
                      Selecionar um Produto
                    </button> </h5>

                  <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>CÓDIGO</th>
                          <th>DESCRIÇÃO</th>
                          <th>LARGURA</th>
                          <th>ALTURA</th>
                          <th>QTD.PÁGINAS</th>
                          <th>OBSERVAÇÕES</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">

                        <tr>
                          <td align="center" colspan="12">NENHUM SELECIONADO</td>

                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="horizontal-tir">
                <div class="card">
                  <h5 class="card-header">TIRAGENS</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>PRODUTO</th>
                          <th>QUANTIDADE</th>
                          <th>DIGITAL</th>
                          <th>OFFSET</th>
                          <th>VALOR IMPRESSÃO DIGITAL</th>
                          <th>VALOR UNIDADE</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">

                        <tr>
                          <td align="center" colspan="12">NENHUM SELECIONADO</td>


                    </table>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="horizontal-pap">
                <div class="card">
                  <h5 class="card-header">PAPEL</h5>
                  <div class="table-responsive text-nowrap">
                    <table id="tabela_campos" class="table table-striped">
                      <thead>
                        <tr>
                          <th>PRODUTO</th>
                          <th>CÓDIGO PAPEL</th>
                          <th>DESCRIÇÃO</th>
                          <th>TIPO</th>
                          <th>CF</th>
                          <th>CV</th>
                          <th>FORMATO IMPRESSÃO</th>
                          <th>PERCA(%)</th>
                          <th>GASTO FOLHA</th>
                          <th>PREÇO FOLHA</th>
                          <th>QUANTIDADE DE CHAPAS</th>
                          <th>PREÇO CHAPA</th>

                        </tr>
                      </thead>
                      if (localStorage.getItem('papelSelecionado')) {
  recuperarNomesPapel();
}

function recuperarNomesPapel() {
  let papelSelecionado = localStorage.getItem('papelSelecionado');
  let arraySelecionados = papelSelecionado ? JSON.parse(papelSelecionado) : [];

  let promises = arraySelecionados.map(id => {
    return fetch('api_papel.php?id=' + id)
      .then(response => response.json())
      .then(data => {
        return {
          id: id,
          nomePapel: data.nome_do_papel,
          codPapel: data.cod_papel,
          corFrente: data.cor_frente,
          corVerso: data.cor_verso,
          descricao: data.descricao,
          orelha: data.orelha,
          codPapels: data.cod_papels,
          descricaoPapel: data.descricao_do_papel,
          medida: data.medida,
          gramatura: data.gramatura,
          formato: data.formato,
          umaFace: data.uma_face,
          unitario: data.unitario
        };
      });
  });

  Promise.all(promises)
    .then(results => {
      document.getElementById('nao_selecioando_appel').style.display = 'none';

      let nomePapel = results.map(result => result.nomePapel).join(', ');
      document.getElementById('nome_papel').value = nomePapel;

      let tabela = document.getElementById('tabela_campos');
      results.forEach(result => {
        let tr = document.createElement('tr');
        tabela.appendChild(tr);

        let td1 = document.createElement('td');
        td1.textContent = result.nomePapel;
        tr.appendChild(td1);

        let td2 = document.createElement('td');
        td2.textContent = result.codPapel;
        tr.appendChild(td2);

        let td3 = document.createElement('td');
        td3.textContent = result.descricao;
        tr.appendChild(td3);

        let td4 = document.createElement('td');
        td4.textContent = result.tipo_papel;
        tr.appendChild(td4);

        let td5 = document.createElement('td');
        td5.textContent = result.corFrente;
        tr.appendChild(td5);

        let td6 = document.createElement('td');
        td6.textContent = result.corVerso;
        tr.appendChild(td6);

        let td7 = document.createElement('td');
        td7.textContent = result.formato;
        tr.appendChild(td7);

        let td8 = document.createElement('td');
        td8.textContent = result.orelha;
        tr.appendChild(td8);

        let td9 = document.createElement('td');
        td9.textContent = result.gasto_folha;
        tr.appendChild(td9);

        let td10 = document.createElement('td');
        td10.textContent = result.preco_folha;
        tr.appendChild(td10);

        let td11 = document.createElement('td');
        td11.textContent = result.quantidade_chapas;
        tr.appendChild(td11);

        let td12 = document.createElement('td');
        td12.textContent = result.preco_chapa;
        tr.appendChild(td12);
      });
    })
    .catch(error => {
      document.getElementById('nao_selecioando_appel').style.display = 'block';
      console.error('Erro ao recuperar nomes do papel:', error);
    });
}
                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="horizontal-aca">
                <div class="card">
                  <h5 class="card-header">ACABAMENTOS</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>PRODUTO</th>
                          <th>CÓDIGO ACABAMENTO</th>
                          <th>DESCRIÇÃO</th>
                          <th>PREÇO ACABAMENTO</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">

                        <tr>
                          <td align="center" colspan="12">NENHUM SELECIONADO</td>


                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="horizontal-obs">
                <div class="card">
                  <h5 class="card-header">OBSERVAÇÕES</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <form method="POST" action="saveobs.php">
                            <textarea class="form-control" placeholder="Coloque uma Observação" name="observacao_orc" class="col-12"></textarea>
                            <input type="hidden" name="cod">
                        </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="horizontal-ser">
                <div class="card">
                  <h5 class="card-header">SERVIÇOS</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>CÓDIGO SERVIÇO</th>
                          <th>DESCRIÇÃO</th>
                          <th>VALOR SERVIÇO</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">

                        <tr>
                          <td colspan="3" align="center">NENHUM SELECIONADO</td>
                        </tr>

                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="container row ">
              <div class="col-3">
                <label class="form-label m-0 p-0">CIF (%)</label>
                <input type="text" class="form-control" id="defaultFormControlInput" placeholder="0%" aria-describedby="defaultFormControlHelp" />

              </div>
              <div class="col-3">
                <label for="valor" class="form-label p-0 m-0">Arte (R$)</label>

                <input class="form-check-input mt-0" id="arte" type="checkbox" aria-label="checkbox button for following text input" />

                <input type="text" class="form-control" id="check_arte" placeholder="R$ 00,00" aria-label="Text input with checkbox button" />

              </div>

              <div class="col-3">
                <label for="frete" class="form-label p-0 m-0">Frete (R$)</label>

                <input class="form-check-input mt-0" type="checkbox" id="frete" aria-label="checkbox button for following text input" />

                <input type="text" class="form-control" id="check_frete" placeholder="R$ 00,00" aria-label="Text input with radio button" />

              </div>



              <div class="col-3">
                <label class="form-label m-0 p-0">Desconto (%)</label>
                <input type="text" class="form-control" id="defaultFormControlInput" placeholder="0%" aria-describedby="defaultFormControlHelp" />

              </div>

            </div>
            <label for="defaultFormControlInput" class="form-label">Valor Total (R$)</label>
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Valor do orçamento final" aria-describedby="defaultFormControlHelp" /><br></br>
            <!-- <button type="button" class="btn btn-info">Tabela de Corte de Papel</button> -->
            <!-- <button type="submit" class="btn btn-success">Salvar</button> -->
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Botão para abrir o primeiro modal -->




  <!-- Primeiro modal PRODUTOS GERAL -->
  <div class="modal" id="modal1">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">PRODUTO</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <div class="demo-inline-spacing mt-3">
            <div class="list-group list-group-horizontal-md text-md-center">
              <a class="list-group-item list-group-item-action active" id="consulta-produto" data-bs-toggle="list" href="#consulta1-produto">Consulta Produto</a>
              <a class="list-group-item list-group-item-action" id="novo-produto" data-bs-toggle="list" href="#novo1-produto">Novo Produto</a>
            </div>

            <div class="tab-content px-0 mt-0">
              <div class="tab-pane fade show active" id="consulta1-produto">
                <div class="card">
                  <h5 class="card-header">Consulta Produto</h5>
                  <div class="table-responsive text-nowrap">
                    <div class="row mb-3">

                      <div class="col-sm-3">
                        <label for="pesquisarpor" class="form-label">PESQUISAR POR</label>
                        <select class="form-select" id="pesquisarpor" aria-label="Default select example">
                          <option value="descricao">DESCRIÇÃO</option>
                          <option value="codigo">CODIGO</option>
                        </select>
                        <div id="mensagemPesquisa"></div>
                      </div>

                      <!-- Adicione os botões de opção de rádio para selecionar o tipo de produto -->

                      <div class="form-check col-sm-3">

                        <input name="tipoProduto" class="form-check-input" type="radio" value="PP" id="ppRadio" checked />
                        <label class="form-check-label" for="ppRadio">PRODUÇÃO (PP)</label><br>
                        <input name="tipoProduto" class="form-check-input" type="radio" value="PE" id="peRadio" />
                        <label class="form-check-label" for="peRadio">PRONTA ENTREGA (PE)</label>
                      </div>
                      <div class="form-check col-sm-5">
                        <div id="mensagemBusca"></div>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="DIGITE A DESCIÇÃO DO PRODUTO QUE DESEJA" aria-label="DIGITE A SUA BUSCA" id="buscarP" aria-describedby="button-addon2" />
                          <button class="btn btn-outline-primary" type="button" id="pesquisar">PESQUISAR</button>
                        </div>
                        <br>
                        <button class="btn btn-outline-warning" type="button" id="clonar">CLONAR PRODUTO</button>
                        <button class="btn btn-outline-danger" type="button" id="selecionar">SELECIONAR</button>
                      </div>
                    </div>

                    <div style="height: 400px; width: 100%; overflow-y: scroll; ">
                      <table class="table table-hover table-sm table-bordered">
                        <thead>
                          <tr>
                            <th>CÓDIGO</th>
                            <th>TIPO</th>
                            <th>DESCRIÇÃO</th>
                            <th>VALOR UNITÁRIO</th>
                            <th>SELECIONAR</th>
                          </tr>
                        </thead>
                        <tbody id="produtosTableBody">
                          <!-- Os resultados da consulta serão adicionados aqui -->
                        </tbody>
                      </table>
                    </div>
                    <!-- AA -->
                  </div>
                </div>
              </div>
              <!-- novo produto -->
              <div class="tab-pane fade" id="novo1-produto">
                <div class="card">
                  <h5 class="card-header">Novo Produto</h5>
                  <div class="table-responsive text-nowrap">
                    <div class="card-body">
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">TIPO DE PRODUTO</label>
                        <div class="col-sm-10">
                          <input  name="TPP" class="form-check-input" type="radio" value="PP" id="PP" />
                          <label class="form-check-label" for="TipoPP"> PRODUÇÃO(PP) </label>
                          <input  name="TPP" class="form-check-input" type="radio" value="PE" id="PE" />
                          <label class="form-check-label" for="TipoPE"> PRONTA ENTREGA(PE) </label>
                          <input class="form-check-input"  name="TipoCommerce" type="checkbox" value="COMMERCE" id="TipoCommerce" />
                          <label class="form-check-label" for="TipoTipoCOMMERCE"> SERÁ ULTILIZADO NO E-COMMERCE </label>
                          <input class="form-check-input" name="Tipoativo" type="checkbox" value="ATIVO" id="Tipoativo" />
                          <label class="form-check-label" for="TipoATIVO"> ATIVO</label>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="descricao">DESCRIÇÃO DO PRODUTO</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="descricao" placeholder="DESCRIÇÃO" />
                          <div class="form-text">MÁXIMO 150 CARACTERES</div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="LARGURA">LARGURA</label>
                          <input type="number" id="largura" class="form-control phone-mask" placeholder="0,0" aria-label="0,0" />
                        </div>
                        <div class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="ALTURA">ALTURA</label>
                          <input type="number" id="altura" class="form-control phone-mask" placeholder="0,0" aria-label="0,0" />
                        </div>
                        <div class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="ESPESSURA">ESPESSURA</label>
                          <input type="number" id="espessura" class="form-control phone-mask" placeholder="0,0" aria-label="0,0" />
                        </div>
                        <div class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="PESO">PESO</label>
                          <input type="number" id="peso" class="form-control phone-mask" placeholder="0,0" aria-label="0,0" />
                        </div>
                        <div class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="qtdfolhas">QUANTIDADE FOLHAS</label>
                          <input type="number" value="1" id="qtdfolhas" class="form-control phone-mask" placeholder="1" aria-label="1" />
                        </div>
                        <div class="col-sm-3">
                          <label class="col-sm-2 col-form-label" for="LARGURA">TIPO</label>
                          <select class="form-select" id="tipoProduto" aria-label="Default select example">
                            <option desabled>SELECIONE</option>
                            <option value="FOLHA">FOLHA</option>
                            <option value="BLOCO">BLOCO</option>
                            <option value="LIVRO">LIVRO</option>
                          </select>
                        </div>
                      </div>
                      <div class="card">
                        <div class="list-group list-group-horizontal-md text-md-center">
                          <a class="list-group-item list-group-item-action active" id="papeis" data-bs-toggle="list" href="#papeis1">PAPÉIS</a>
                          <a class="list-group-item list-group-item-action" id="acabamentos" data-bs-toggle="list" href="#acabamentos1">ACABAMENTOS</a>
                          <a class="list-group-item list-group-item-action " id="valores" data-bs-toggle="list" href="#valores1">VALORES</a>
                          <a class="list-group-item list-group-item-action" id="estoque" data-bs-toggle="list" href="#estoque1">ESTOQUE</a>
                          <a class="list-group-item list-group-item-action " id="pedidos" data-bs-toggle="list" href="#pedidos1">PEDIDOS</a>
                        </div>
                        <div class="tab-content px-0 mt-0">
                          <div class="tab-pane fade show active" id="papeis1">

                            <h5 class="card-header">PAPÉIS</h5>

                            <!-- Botão para abrir o segundo modal -->
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal2">
                              SELECIONAR PAPEL
                            </button>
                            <div class="table-responsive text-nowrap">
                              <label class="form-label" for="basic-default-phone">TIPO</label>
                              <select class="form-select">
                                <option>SELECIONE</option>
                                <option>CAPA</option>
                                <option>MIOLO</option>
                                <option>FOLHA</option>
                                <option>1° VIA</option>
                                <option>2° VIA</option>
                                <option>3° VIA</option>
                              </select>
                              <label class="form-label" for="basic-default-phone">CORES FRENTE</label>
                              <input type="number" placeholder="0">
                              <label class="form-label" for="basic-default-phone">CORES VERSO</label>
                              <input type="number" placeholder="0">
                              <table class="table table-bordered table-hover">
                                <tr>
                                  <th>CÓDIGO</th>
                                  <th>DESCRIÇÃO</th>
                                  <th>TIPO</th>
                                  <th>ORELHA</th>
                                  <th>CORES FRENTE</th>
                                  <th>CORES VERSO</th>
                                </tr>
                                <tr>
                                  <td colspan='6'></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="acabamentos1">
                            <h5 class="card-header">ACABAMENTOS</h5>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal23">
                              SELECIONAR ACABAMENTO
                            </button>
                            <div class="table-responsive text-nowrap">

                              <table class="table table-bordered table-hover">
                                <tr>
                                  <th>CÓDIGO</th>
                                  <th>DESCRIÇÃO</th>
                                </tr>
                                <tr>
                                  <td>cod</td>
                                  <td>des</td>
                                </tr>
                              </table>

                            </div>
                          </div>
                          <div class="tab-pane fade" id="valores1">
                            <h5 class="card-header">VALORES</h5>
                            <div class="table-responsive text-nowrap">

                              <label class="form-check-label" for="prev"> PRODUTO PARA PRÉ-VENDA? </label>
                              <input class="form-check-input" name="prev" type="checkbox" value="prevendaS" id="prev" />
                              <div class="row mb-3">
                                <div class="col-sm-3">
                                  <label class="col-sm-2 col-form-label" for="valorunitario">VALOR
                                    UNITÁRIO(R$)</label>
                                  <input type="number" class="form-control" id="valorunitario" placeholder="0,00" />
                                </div>
                                <label class="col-sm-2 col-form-label" for="promo">VALOR PROMOCIONAL(R$)</label>
                                <div class="col-sm-3">
                                  <input class="form-check-input" name="promo" type="checkbox" value="promo" id="promo" />
                                  <input type="number" class="form-control" id="valorpromo" placeholder="0,00" />
                                </div>
                              </div>

                            </div>
                          </div>
                          <div class="tab-pane fade" id="estoque1">
                            <h5 class="card-header">ESTOQUE</h5>
                            <div class="table-responsive text-nowrap">

                              <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">QUANTIDADE NO ESTOQUE
                                  FÍSICO</label>
                                <input type="number" class="form-control" id="qtdestoque" placeholder="0" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label" for="avisoestoque">AVISO DE ESTOQUE?<input class="form-check-input" name="avisoestoque" type="checkbox" value="avisoestoque" id="avisoestoque" /> </label>
                                <input type="number" class="form-control" id="qtdaviso" placeholder="0" />
                              </div>

                            </div>
                          </div>
                          <div class="tab-pane fade" id="pedidos1">
                            <h5 class="card-header">PEDIDOS</h5>
                            <div class="table-responsive text-nowrap">

                              <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">QUANTIDADE MÍNIMA</label>
                                <input type="number" class="form-control" id="qtdmin" placeholder="0" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label" for="qtdmaxestoque">QUANTIDADE MÁXIMA<input class="form-check-input" name="qtdmaxestoque" type="checkbox" value="qtdmaxestoque" id="qtdmaxestoque" /> </label>
                                <input type="number" class="form-control" id="qtdmax" placeholder="0" />
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class=" text-end  row justify-content-end">
                        <div class="col-sm-10">
                          <button type="submit" class="btn btn-primary">SALVAR</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Segundo modal CONTEUDO PAPEL -->
              <div class="modal" id="modal2">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">PAPEL</h5>
                      <div id="mensagemPapel"></div>
                    </div>
                    <div class="modal-body">
                      <?php
                      $query_papel = $conexao->prepare("SELECT * FROM tabela_papeis ORDER BY cod DESC");
                      $query_papel->execute();
                      $p = 0;
                      while ($linha = $query_papel->fetch(PDO::FETCH_ASSOC)) {
                        $papel[$p] = [
                          'cod' => $linha['cod'],
                          'descricao' => $linha['descricao'],
                          'medida' => $linha['medida'],
                          'gramatura' => $linha['gramatura'],
                          'formato' => $linha['formato'],
                          'uma_face' => $linha['uma_face'],
                          'unitario' => $linha['unitario'],
                        ];
                        $p++;
                      }
                      ?>

                      <div class="row">
                        <div class="col-4">
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="Nome_papel">DESCRIÇÃO</label>
                            <input type="text" id="Nome_papel" class="form-control phone-mask" placeholder="NOME PAPEL" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="Largura">LARGURA</label>
                            <input type="number" id="Largura_Papel" class="form-control phone-mask" placeholder="0" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="Altura">ALTURA</label>
                            <input type="number" id="Altura_Papel" class="form-control phone-mask" placeholder="0" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="Gramatura">GRAMATURA</label>
                            <input type="number" id="Gramatura_Papel" class="form-control phone-mask" placeholder="0" />
                          </div>
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="Fomato_Papel">FORMATO</label>
                            <input type="text" id="Fomato_Papel" class="form-control phone-mask" placeholder="0" />
                          </div>
                          <div class="mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="umaface_Papel" />
                            <label class="form-check-label" for="umaface_Papel"> UMA FACE? </label>
                          </div>
                          <div class="mb-3">
                            <label class="form-label colorbranca" for="valor_Papel">VALOR UNITÁRIO</label>
                            <input type="number" id="valor_Papel" class="form-control phone-mask" placeholder="0" />
                          </div>
                          <div class="mb-3">
                            <button class="btn rounded-pill btn-success">CADASTRAR</button>
                          </div>
                        </div>
                        <div style="height: 700px; width: 66%; overflow-y: scroll; " class="m-0 p-0 col-6">
                          <table class="colorbranca table table-sm table-houver">
                            <tr>
                              <th>CODIGO</th>
                              <th>DESCRIÇÃO</th>
                              <th>MEDIDA</th>
                              <th>GRAMATURA</th>
                              <th>FORMATO</th>
                              <th>UMA FACE</th>
                              <th>VALOR</th>
                              <th>SELECIONAR</th>
                            </tr>
                            <?php for ($i = 0; $i < $p; $i++) {
                              echo '<tr>
          <td>' . $papel[$i]['cod'] . '</td>
          <td>' . $papel[$i]['descricao'] . '</td>
          <td>' . $papel[$i]['medida'] . '</td>
          <td>' . $papel[$i]['gramatura'] . '</td>
          <td>' . $papel[$i]['formato'] . '</td>
          <td>' . $papel[$i]['uma_face'] . '</td>
          <td>' . $papel[$i]['unitario'] . '</td>
          <td><input id="'.$papel[$i]['cod'].'"  type="checkbox" onclick="selecionarPapel(this.id)"></td>
        </tr>';
                            } ?>

                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- terceiro modal CONTEUDO ACABAMENTO -->
              <div class="modal" id="modal23">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">ACABAMENTO</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                      <?php
                      $query_acabamento = $conexao->prepare("SELECT * FROM acabamentos ORDER BY CODIGO DESC");
                      $query_acabamento->execute();
                      $a = 0;
                      while ($linha = $query_acabamento->fetch(PDO::FETCH_ASSOC)) {
                        $acabamento[$a] = [
                          'CODIGO' => $linha['CODIGO'],
                          'MAQUINA' => $linha['MAQUINA'],
                          'ATIVA' => $linha['ATIVA'],
                          'CUSTO_HORA' => $linha['CUSTO_HORA'],
                        ];
                        $a++;
                      }
                      ?>
                      <div class="teste">
                        <div class="row">
                          <div class="col-4">
                            <div class="mb-3">
                              <label class="form-label colorbranca" for="basic-default-phone">NOME DA MÁQUINA</label>
                              <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="NOME MÁQUINA" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label colorbranca" for="basic-default-phone">CUSTO HORA</label>
                              <input type="number" id="basic-default-phone" class="form-control phone-mask" placeholder="0" />
                            </div>

                            <div class="mb-3">
                              <button class="btn rounded-pill btn-success">CADASTRAR</button>
                            </div>
                          </div>
                          <div style="height: 700px; width: 66%; overflow-y: scroll; " class="m-0 p-0 col-6">
                            <table class="colorbranca table table-sm table-houver">
                              <tr>
                                <th>CODIGO</th>
                                <th>MÁQUINA</th>
                                <th>ATIVA</th>
                                <th>CUSTO HORA</th>
                                <th>SELECIONAR</th>
                              </tr>
                              <?php for ($i = 0; $i < $a; $i++) {
                                echo '<tr>
          <td>' . $acabamento[$i]['CODIGO'] . '</td>
          <td>' . $acabamento[$i]['MAQUINA'] . '</td>
          <td>' . $acabamento[$i]['ATIVA'] . '</td>
          <td>' . $acabamento[$i]['CUSTO_HORA'] . '</td>
          <td><input type="checkbox"></td>
        </tr>';
                              } ?>

                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <!-- Inicializa o Bootstrap -->
              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

              <script>
                // Obtém o elemento do segundo modal
                const modal2 = document.getElementById('modal2');
                if(modal2){
                // Adiciona o evento 'hidden.bs.modal' ao segundo modal
                modal2.addEventListener('hidden.bs.modal', function(event) {
                  // Obtém o elemento do primeiro modal
                  const modal1 = document.getElementById('modal1');

                  // Verifica se o elemento do primeiro modal existe antes de chamar o método 'show()'
                  if (modal1) {
                    modal1.show();
                  }
                });
              }
              </script>

              <script>
                const busca = document.getElementById('buscarP');
                const pesquisarpor = document.getElementById('pesquisarpor');
                const pesquisar = document.getElementById('pesquisar');
                const mensagemBusca = document.getElementById('mensagemBusca');
                const mensagemPesquisa = document.getElementById('mensagemPesquisa');
                let TipoProdutoSelect = 'PP';
                if(pesquisarpor){
                pesquisarpor.addEventListener('click', vlr => {
                  if (pesquisarpor.value === 'codigo') {
                    busca.type = 'number';
                    busca.placeholder = 'DIGITE O CÓDIGO DO PRODUTO';
                  } else {
                    busca.type = 'text';
                    busca.placeholder = 'DIGITE A DESCIÇÃO DO PRODUTO';
                  }
                });
              }
                function exibirBusca(dados) {
                  const tableBody = document.getElementById('produtosTableBody');
                  tableBody.innerHTML = '';
                  if (Array.isArray(dados)) {
                    dados.forEach(produto => {
                      tableBody.innerHTML += `
                    <tr>
                      <td>${produto.CODIGO}</td>
                      <td>${produto.TIPO}</td>
                      <td>${produto.DESCRICAO}</td>
                      <td>${produto.VALOR_UNITARIO}</td>
                      <td><input type="checkbox" value="${produto.CODIGO}" name="Produto${produto.CODIGO}"  ></td>
                    </tr>`;
                    });
                  } else {
                    tableBody.innerHTML += `
                    <tr>
                      <td>${dados[0].CODIGO}</td>
                      <td>${dados[0].TIPO}</td>
                      <td>${dados[0].DESCRICAO}</td>
                      <td>${dados[0].VALOR_UNITARIO}</td>
                      <td><input type="checkbox" value="${dados[0].CODIGO}" name="Produto${dados[0].CODIGO}"  ></td>
                    </tr>`;
                  }

                }

                function enviarBusca(consulta) {
                  const xhr = new XMLHttpRequest();
                  xhr.open('POST', 'api_produtos.php');
                  xhr.setRequestHeader('Content-Type', 'application/json');
                  xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                      const response = JSON.parse(xhr.responseText);
                      exibirBusca(response);
                    }
                  };
                  xhr.send(JSON.stringify(consulta));
                }
                if(pesquisarpor){
                pesquisar.addEventListener('click', vlr => {
                  if (busca.value === '') {
                    mensagemBusca.innerHTML = '<div id="alerta" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">Erro!</div><small></small><button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button> </div> <div class="toast-body">  POR FAVOR, DIGITE UMA DESCRIÇÃO NO CAMPO DE BUSCA! </div> </div>';
                  } else {
                    mensagemBusca.innerHTML = '';
                    const consulta = {
                      TipoProdutoSelect: TipoProdutoSelect,
                      pesquisa: pesquisarpor.value,
                      valor: busca.value,
                    };
                    enviarBusca(consulta);
                  }

                })
              }


                fetch('api_produtos.php')
                  .then(response => response.json())
                  .then(data => {
                    // processa os dados recebidos
                    const pp = data.pp;
                    const pe = data.pe;
                    let ativo_pp = 'Nao';

                    // obtém a referência à tabela onde os resultados serão exibidos
                    // obtém referência aos inputs de rádio
                    const ppRadio = document.getElementById('ppRadio');
                    const peRadio = document.getElementById('peRadio');
                    if(ppRadio){
                    // adiciona listener de eventos às mudanças nos inputs de rádio
                    ppRadio.addEventListener('change', function() {
                      // atualiza a tabela com os valores de pp
                      ativo_pp = 'Sim';
                      TipoProdutoSelect = 'PP';
                      const tableBody = document.getElementById('produtosTableBody');
                      tableBody.innerHTML = '';
                      pp.forEach(produto => {
                        tableBody.innerHTML += `
      <tr>
        <td>${produto.CODIGO}</td>
        <td>${produto.TIPO}</td>
        <td>${produto.DESCRICAO}</td>
        <td>${produto.VALOR_UNITARIO}</td>
        <td><input type="checkbox" value="${produto.CODIGO}" name="Produto${produto.CODIGO}"  ></td>
      </tr>
    `;
                      });
                    });
                  }
                  if(ppRadio){
                    peRadio.addEventListener('change', function() {
                      // atualiza a tabela com os valores de pe
                      TipoProdutoSelect = 'PE';
                      ativo_pp = 'Sim';
                      const tableBody = document.getElementById('produtosTableBody');
                      tableBody.innerHTML = '';
                      pe.forEach(produto => {
                        tableBody.innerHTML += `
      <tr>
        <td>${produto.CODIGO}</td>
        <td>${produto.TIPO}</td>
        <td>${produto.DESCRICAO}</td>
        <td>${produto.VALOR_UNITARIO}</td>
        <td><input type="checkbox" value="${produto.CODIGO}" name="Produto${produto.CODIGO}"  ></td>
      </tr>
    `;
                      });
                    });
                  }
                    if (ativo_pp === 'Nao') {
                      const tableBody = document.getElementById('produtosTableBody');
                      tableBody.innerHTML = '';
                      pp.forEach(produto => {
                        tableBody.innerHTML += `
      <tr>
        <td>${produto.CODIGO}</td>
        <td>${produto.TIPO}</td>
        <td>${produto.DESCRICAO}</td>
        <td>${produto.VALOR_UNITARIO}</td>
        <td><input type="checkbox" value="${produto.CODIGO}" name="Produto${produto.CODIGO}"  ></td>
      </tr>
    `;
                      });
                    }
                  })
                  .catch(error => console.error(error));
              </script>

              <script>
                // const orcamentoproduto = new Vue({
                //   el: "#orcamentacaoProduto",
                //   data: {
                //     produto: 'valor'
                //   },
                //   methods: {
                //     atualizarProduto: function (novoValor) {
                //       this.produto = novoValor;
                //       this.$emit('produto-atualizado', novoValor);
                //     }
                //   }
                // });

                // const orcamentoselecionado = new Vue({
                //   el: "#orcamentacaoselecionado",
                //   data: {
                //     produto: ''
                //   },
                //   created: function () {
                //     orcamentoproduto.$on('produto-atualizado', (novoValor) => {
                //       this.produto = novoValor;
                //     });
                //   }
                // });
              </script>

              <script>
                const frete = document.getElementById('frete');
                const arte = document.getElementById('arte');
                const check_frete = document.getElementById('check_frete');
                const check_arte = document.getElementById('check_arte');
                if(frete){
                frete.addEventListener('click', arr => {
                  if (check_frete.disabled === false) {
                    check_frete.disabled = true;
                  } else {
                    check_frete.disabled = false;
                  }
                })
              }
              if(arte){
                arte.addEventListener('click', arr => {
                  if (check_arte.disabled === false) {
                    check_arte.disabled = true;
                  } else {
                    check_arte.disabled = false;
                  }
                })
              }
              
                const selects = document.getElementById('selects');
                const simpleszao = document.getElementById('simpleszao');
                const detalhadao = document.getElementById('detalhadao');
                const SIMPLES = document.getElementById('SIMPLES');
                const DETALHADO = document.getElementById('DETALHADO');
                if(SIMPLES){
                SIMPLES.addEventListener('click', vlr => {
                  simpleszao.classList.remove('tira');
                  detalhadao.classList.add('tira');
                })
              }
                if(DETALHADO){
                DETALHADO.addEventListener('click', vlr => {
                  detalhadao.classList.remove('tira');
                  simpleszao.classList.add('tira');
                })
              }
              </script>




            <?php } else { ?>
              <!-- Segundo modal CONTEUDO PAPEL -->
              <div>
                <div>
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Selecione o CLIENTE</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="mb-3">
                          <form method="POST" action="abrir_orcamento.php">
                            <select class="form-select" name="tipo_cliente" id="cliente" aria-label="Default select example">
                              <option selected>Selecione o tipo de cliente</option>
                              <option value="1">Pessoa Física</option>
                              <option value="2">Pessoa Júridica</option>
                            </select>
                        </div>
                        <div class="mb-3">
                          <div id="juri" class="mb-3">
                            <input name="usuario0" id="usuario0" class="form-control" type="text" placeholder="Digite o NOME do cliente  juridico" onkeyup="carregar_usuarios(this.value)" />
                            <input id="codigo" name="numero1" class="form-control" type="text" style="display: none;" placeholder="Digite o código aqui" />
                            <span id="resultado_pesquisa0"></span>
                            <br>
                            <input name="usuariosigla" id="usuariosigla" class="form-control" type="text" placeholder="Digite a SIGLA cliente  juridico" onkeyup="carregar_sigla(this.value)" />
                            <span id="resultado_sigla"></span>
                          </div>
                          <div id="dis" class="mb-3">
                            <input id="defaultInput" disabled class="form-control" type="text" placeholder="Selecione o tipo de cliente" />
                          </div>
                          <div id="fisc" class="mb-3">
                            <input name="usuario1" id="usuario1" class="form-control" type="text" placeholder="Digite o nome do cliente fisico" onkeyup="carregar_fisico(this.value)" />
                            <input id="codigo1" name="numero2" class="form-control" type="text" style="display: none;" placeholder="Digite o código aqui" />
                            <span id="resultador_123"></span>
                          </div>

                          <button type="submit" name="submit" class="btn btn-info">Selecionar</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
        const select = document.getElementById('cliente');
        const juri = document.getElementById('juri');
        const dis = document.getElementById('dis');
        const fisc = document.getElementById('fisc');
        fisc.style.display = 'none';
        juri.style.display = 'none';
        if(select){
        select.addEventListener('click', vlr => {
          if (select.value == 1) {
            fisc.style.display = 'block';
            juri.style.display = 'none';
            dis.style.display = 'none';
          } else {
            fisc.style.display = 'none';
            juri.style.display = 'block';
            dis.style.display = 'none';
          }
        })
      }
      </script>
    <?php  } ?>


<script src="../js/orcamentacao.js"></script>
    <?php include_once("../html/../html/navbar-dow.php"); ?>