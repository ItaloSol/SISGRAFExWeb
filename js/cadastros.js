


// Papel
function CadastraPapel() {
  const Nome_papel = document.getElementById('Nome_papel').value.toUpperCase();
  const Mediada_Papel = document.getElementById('Mediada_Papel').value.toUpperCase();
  const Gramatura_Papel = document.getElementById('Gramatura_Papel').value.toUpperCase();
  const Fomato_Papel = document.getElementById('Fomato_Papel').value.toUpperCase();
  const valor_Papel = document.getElementById('valor_Papel').value.toUpperCase();
  const umaface_Papel = document.getElementById('umaface_Papel');
  let face_papel = 0;
  if (umaface_Papel.checked == true) {
    face_papel = 1;
  }
  const mensagemPapel = document.getElementById('mensagemPapel');
  if (Nome_papel != '' && Mediada_Papel != '' && Gramatura_Papel != '' && Fomato_Papel != '' && valor_Papel != '') {
    return fetch('cadastro_apapel.php?N=' + Nome_papel + '&M=' + Mediada_Papel + '&G=' + Gramatura_Papel + '&F=' + Fomato_Papel + '&U=' + face_papel + '&V=' + valor_Papel).then(res => res.json()).then(result => {
      if (result['erro'] == false) {
        setTimeout(() => {
          abriPapels()
          mensagemPapel.innerHTML = '';
        }, 1000);
        return mensagemPapel.innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso. Papel Cadastrado!</div></div>';
      } else {
        setTimeout(() => {
          mensagemPapel.innerHTML = '';
        }, 1000);
        return mensagemPapel.innerHTML = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">Não foi possivel salvar o papel!</div></div>';
      }
    })
  } else {
    setTimeout(() => {
      mensagemPapel.innerHTML = '';
    }, 1000);
    return mensagemPapel.innerHTML = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">É necessario completar todos os campos!</div></div>';

  }
}
// Acabamento
function CadastraAcabamento() {
  const Nome_Acabamento = document.getElementById('Nome_Acabamento').value.toUpperCase();
  const valor_Acabamento = document.getElementById('valor_Acabamento').value.toUpperCase();

  const mensagemAcabamento = document.getElementById('mensagemAcabamento');
  if (Nome_Acabamento != '' && valor_Acabamento != '') {
    return fetch('cadastro_Acabamento.php?N=' + Nome_Acabamento + '&V=' + valor_Acabamento).then(res => res.json()).then(result => {
      if (result['erro'] == false) {
        setTimeout(() => {
          abriAcabamentos()
          mensagemAcabamento.innerHTML = '';
        }, 1000);
        return mensagemAcabamento.innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso. Acabamento Cadastrado!</div></div>';
      } else {
        setTimeout(() => {
          mensagemAcabamento.innerHTML = '';
        }, 1000);
        return mensagemAcabamento.innerHTML = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">Não foi possivel salvar o Acabamento!</div></div>';
      }
    })
  } else {
    setTimeout(() => {
      mensagemAcabamento.innerHTML = '';
    }, 1000);
    return mensagemAcabamento.innerHTML = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">É necessario completar todos os campos!</div></div>';

  }
}
// Servico
function CadastraServico() {
  const Nome_Servico = document.getElementById('Nome_Servico').value.toUpperCase();
  const valorUnitario = document.getElementById('valorUnitario').value.toUpperCase();
  const tipoServico = document.getElementById('tipoServico').value.toUpperCase();
  const valor_min = document.getElementById('valor_min').value.toUpperCase();
  const Servico_Geral = document.getElementById('Servico_Geral').value.toUpperCase();
  const mensagemServico = document.getElementById('mensagemServico');

  if (Nome_Servico != '' && valorUnitario != '') {

    return fetch('cadastro_Servico.php?N=' + Nome_Servico + '&V=' + valorUnitario + '&T=' + tipoServico + '&M=' + valor_min + '&G=' + Servico_Geral).then(res => res.json()).then(result => {
      if (result['erro'] == false) {
        setTimeout(() => {
          abriServicos()
          mensagemServico.innerHTML = '';
        }, 1000);
        return mensagemServico.innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso. Servico Cadastrado!</div></div>';
      } else {
        setTimeout(() => {
          mensagemServico.innerHTML = '';
        }, 1000);
        return mensagemServico.innerHTML = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">Não foi possivel salvar o Servico!</div></div>';
      }
    })
  } else {
    setTimeout(() => {
      mensagemServico.innerHTML = '';
    }, 1000);
    return mensagemServico.innerHTML = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">É necessario completar todos os campos!</div></div>';

  }
}
const freteObserva = document.getElementById('check_frete');
const arteObserva = document.getElementById('check_arte');
freteObserva.addEventListener('click', vlr => {
  if (freteObserva.checked) {
    document.getElementById('frete').disabled = false
  } else {
    document.getElementById('frete').disabled = true
  }
})
arteObserva.addEventListener('click', vlr => {
  if (arteObserva.checked) {
    document.getElementById('arte').disabled = false
  } else {
    document.getElementById('arte').disabled = true
  }
})

// CALCULO ORÇAMENTO
// Tabela Produto
function ObterTabelaProduto() {
  // PRODUTOS
  const tabelaProdutoSelecionado = document.getElementById('SelecionadoProudutosProduto');
  const Produtos = [];

  for (let i = 1; i < tabelaProdutoSelecionado.rows.length; i++) {
    const linha = tabelaProdutoSelecionado.rows[i];
    const celulas = linha.cells;
    const item = {
      código: celulas[0].textContent,
      descrição: celulas[1].textContent,
      largura: celulas[2].textContent,
      altura: celulas[3].textContent,
      "qtd. páginas": celulas[4].textContent
    };
    Produtos.push(item);
  }
  return JSON.stringify(Produtos);
  //(jsonProdutos);
}
//Tabela Tiragens
function obterTabelaTiragens() {
  const tabela = document.getElementById('ProdutoTIragens');
  const dados = [];

  // Verificar se a tabela possui dados
  if (tabela.rows.length > 1) {
    // Loop começa a partir de 1 para ignorar a primeira linha de cabeçalho
    for (let i = 1; i < tabela.rows.length; i++) {
      const linha = tabela.rows[i];
      const celulas = linha.cells;
      const item = {
        produto: celulas[0].textContent,
        quantidade: celulas[1].querySelector('input').value,
        digital: celulas[2].querySelector('input').checked,
        offset: celulas[3].querySelector('input').checked,
        valorImpressaoDigital: celulas[4].querySelector('input').value,
        valorUnidade: celulas[5].querySelector('input').value
      };
      dados.push(item);
    }
  } else {
    // A tabela não possui dados
    ('Nenhum produto selecionado.');
    return;
  }

  return JSON.stringify(dados);
  //(jsonData);
}

// Tabela Papeis
function ObsertPapelCorreto() {
  const tabela = document.getElementById('tabela_campos');
  const linhas = tabela.getElementsByTagName('tr');
  const tbodys = tabela.getElementsByTagName('tbody');
  // Passo 2: Iterar sobre as linhas e células da tabela
  let item = [];
  for (let i = 0; i < linhas.length; i++) {
    const celulas = linhas[i].getElementsByTagName('td');
    // Passo 3: Acessar e manipular os valores contidos em cada célula
    for (let j = 0; j < celulas.length; j++) {
      const valorCelula = celulas[j].innerText;
      item[i] = {
        produto: celulas[0].textContent,
        codigoPapel: celulas[1].textContent,
        descricao: celulas[2].textContent,
        tipo: celulas[3].textContent,
        cf: celulas[4].querySelector('input').value,
        cv: celulas[5].querySelector('input').value,
        formatoImpressao: celulas[6].querySelector('input').value,
        perca: celulas[7].querySelector('input').value,
        gastoFolha: celulas[8].querySelector('input').value,
        precoFolha: celulas[9].textContent,
        quantidadeChapas: celulas[10].querySelector('input').value,
        precoChapa: celulas[11].textContent
      };
    }
  }
  return item;
}

function obterTabelaPapeis() {
  // Selecionar o elemento pai (table) que contém o elemento a ser removido
  const tableElement = document.getElementById('tabela_campos');

  // Selecionar o elemento a ser removido (tbody)
  const tbodyElement = tableElement.querySelectorAll('tbody');
  if (tbodyElement.length == 2) {
    // Remover o elemento (tbody) do elemento pai (table)
    tableElement.removeChild(tbodyElement[0]);
  }
  const tabela = document.getElementById('tabela_campos');
  const dados = [];
  // Verificar se a tabela possui dados
  if (tabela.rows[1]) {
    // Loop começa a partir de 1 para ignorar a primeira linha de cabeçalho

    const linha = tabela.rows[1];
    const celulas = linha.cells;
    const item = {
      produto: celulas[0].textContent,
      codigoPapel: celulas[1].textContent,
      descricao: celulas[2].textContent,
      tipo: celulas[3].textContent,
      cf: celulas[4].querySelector('input').value,
      cv: celulas[5].querySelector('input').value,
      formatoImpressao: celulas[6].querySelector('input').value,
      perca: celulas[7].querySelector('input').value,
      gastoFolha: celulas[8].querySelector('input').value,
      precoFolha: celulas[9].textContent,
      quantidadeChapas: celulas[10].querySelector('input').value,
      precoChapa: celulas[11].textContent
    };
    dados.push(item);

  } else {
    // A tabela não possui dados
    ('Nenhum papel selecionado.');
    return;
  }

  return JSON.stringify(dados);
  //(jsonData);

}
// Tabela Acabamentos
function obterTabelaAcabamentos() {
  const tabela = document.getElementById('seleccionadoacabamentos');
  const dados = [];

  // Verificar se a tabela possui dados
  if (tabela.rows.length > 1) {
    // Loop começa a partir de 1 para ignorar a primeira linha de cabeçalho
    for (let i = 1; i < tabela.rows.length; i++) {
      const linha = tabela.rows[i];
      const celulas = linha.cells;
      const item = {
        codigoAcabamento: celulas[0].textContent,
        descricao: celulas[1].textContent,
        precoAcabamento: celulas[2].textContent
      };
      dados.push(item);
    }
  } else {
    // A tabela não possui dados
    ('Nenhum acabamento selecionado.');
    return;
  }

  return JSON.stringify(dados);
  //(jsonData);
}
// Tabela Serviços
function obterTabelaServicos() {
  const tabela = document.getElementById('tabelaAservicos');
  const dados = [];
  let TOTAL_valor = 0;
  // Verificar se a tabela possui dados
  if (tabela.rows.length > 1) {
    // Loop começa a partir de 1 para ignorar a primeira linha de cabeçalho
    for (let i = 1; i < tabela.rows.length; i++) {
      const linha = tabela.rows[i];
      const celulas = linha.cells;
      if (celulas[1] != undefined) {
        dados.push(celulas[2].textContent)
      }
    }
    dados.map(valor => {
      TOTAL_valor += +valor
    })
    return TOTAL_valor;
  }

  //(jsonData);
}
// Valor Observacao
function obterValorObservacao() {
  const textareaObservacao = document.getElementById('observacao_orc');
  return textareaObservacao.value;
  // (valorObservacao);
}

/**
 * FUNÇÕES PARA COMPLETAR OS CALCULOS
 */
function calcularCif() {
  const ValorCif = document.getElementById('cif').value;
  let CifConvertido = +ValorCif / 100;
  return CifConvertido;
}

function clacularArte() {
  let ValorArte = null;
  if (document.getElementById('check_arte').value) {
    ValorArte = Number(document.getElementById('arte').value);
  } else {
    ValorArte = 0;
  }
  return ValorArte;
}

function caluclarFrete() {
  let ValorFrete = null;
  if (document.getElementById('check_frete').value) {
    ValorFrete = Number(document.getElementById('frete').value);
  } else {
    ValorFrete = 0;
  }
  return ValorFrete;
}
function calcularDesconto() {
  const ValorDesconto = Number(document.getElementById('desconto').value);
  let DescontoConvertido = +ValorDesconto / 100;
  return DescontoConvertido;
}
function pegarQtdPaginas() {
  // Encontre a tabela pelo ID
  var tabela = document.getElementById("SelecionadoProudutosProduto");

  // Encontre todas as linhas da tabela
  var linhas = tabela.getElementsByTagName("tr");

  // Itere pelas linhas da tabela, excluindo o cabeçalho
  for (var i = 1; i < linhas.length; i++) {
    // Obtenha a célula correspondente à coluna "QUANTIDADE DE PÁGINAS" (índice 4)
    var celulaQuantidadePaginas = linhas[i].getElementsByTagName("td")[4];

    // Pegue o valor dentro da célula
    var valorQuantidadePaginas = celulaQuantidadePaginas.textContent;

    // Faça algo com o valor (por exemplo, exiba-o no console)
  }
  return valorQuantidadePaginas;
}
function pegarQtdTiragem() {
  // Encontre o elemento da tabela pelo ID
  var tabela = document.getElementById("ProdutoTIragens");

  // Encontre todas as linhas da tabela
  var linhas = tabela.getElementsByTagName("tr");

  // Itere pelas linhas da tabela, excluindo o cabeçalho
  for (var i = 1; i < linhas.length; i++) {
    // Obtenha a célula correspondente à coluna "QUANTIDADE" (índice 1)
    var celulaQuantidade = linhas[i].getElementsByTagName("td")[1];

    // Verifique se a célula contém um elemento <input> com o id "quantidade"
    var inputQuantidade = celulaQuantidade.querySelector("input#quantidade");

    // Se o elemento <input> for encontrado
    if (inputQuantidade) {
      // Pegue o valor do elemento <input>
      var valorQuantidade = inputQuantidade.value;

      // Faça algo com o valor (por exemplo, exiba-o no console)
    }
  }
  return valorQuantidade;
}
// CALCULO DE CLIQUE

function AdicionarCliqueAtbalea(quantiade, valor){ // , quantiade, valor
  var AdicionandoClique = document.getElementById('calculo_clique');
        AdicionandoClique.innerHTML += `
          <tr>
            <td>${quantiade}</td>
            <td>${valor}</td>
          </tr>`;
     
}

function retornarQuantidadedeClique(quantidade, codigo){
  var cf =  document.getElementById('GCF' + codigo);
  var cv =  document.getElementById('GCV' + codigo);
  console.log(quantidade)
  var PFolha = +cf.value + +cv.value;
  var Clique = quantidade;
  var valorP = 0.027;
  var valorC = 0.281;
  var valorT = 0;
  if(PFolha >= 4){
    Clique *= 4;
    valorT = Clique * valorC;
  }else{
    Clique *= 2;
    valorT = Clique * valorP;
  }
  AdicionarCliqueAtbalea(Clique, valorT.toFixed(2)); // , Clique, Valor
}

//CALCULO MASTER QUANTIDADE DE PAPEL E DE CHAPA UTILIZADA

function retornaQuantidadeFolhas(tipoProduto, tipoPapel, quantidadeFolhas, formatoImpressao, tiragem, numeroVias, perca) {
  let quantidadeFolhasF1 = 0;
  let CalculoF1 = 0;
  let Impar = formatoImpressao % 2;
  if (Impar == 1) {
    //  formatoImpressao++;
  }
  if (tipoProduto == 1) {
    quantidadeFolhasF1 = Math.ceil(tiragem / formatoImpressao);
    CalculoF1 = Math.floor((quantidadeFolhasF1 * perca) / 100);
    quantidadeFolhasF1 += CalculoF1;
  }
  if (tipoPapel == 2) {
    quantidadeFolhasF1 = Math.ceil(tiragem / formatoImpressao);
    quantidadeFolhasF1 += Math.floor((quantidadeFolhasF1 * perca) / 100);
  } else if (tipoPapel == 3) {
    quantidadeFolhasF1 = Math.ceil((quantidadeFolhas / formatoImpressao) * tiragem);
    ///  
    quantidadeFolhasF1 = Math.ceil(quantidadeFolhasF1 / 2);
    ///
    quantidadeFolhasF1 += Math.floor((quantidadeFolhasF1 * perca) / 100);
    ///

  }
  if (tipoProduto == 2) {
    if (tipoPapel == 1 || tipoPapel == 2) {
      quantidadeFolhasF1 = Math.ceil(tiragem / formatoImpressao);
      quantidadeFolhasF1 += Math.floor((quantidadeFolhasF1 * perca) / 100);
    } else if (tipoPapel == 3) {
      quantidadeFolhasF1 = Math.ceil((quantidadeFolhas / formatoImpressao) * tiragem);
      quantidadeFolhasF1 = Math.ceil(quantidadeFolhasF1 / 2);
      quantidadeFolhasF1 += Math.floor((quantidadeFolhasF1 * perca) / 100);
    }
  } else if (tipoProduto == 3) {
    if (tipoPapel == 2) {
      quantidadeFolhasF1 = Math.ceil(tiragem / formatoImpressao);
      quantidadeFolhasF1 += Math.floor((quantidadeFolhasF1 * perca) / 100);
    } else if (tipoPapel == 4 || tipoPapel == 5 || tipoPapel == 6) {
      quantidadeFolhas /= numeroVias;
      quantidadeFolhasF1 = Math.ceil((tiragem * quantidadeFolhas) / formatoImpressao);
      quantidadeFolhasF1 += Math.floor((quantidadeFolhasF1 * perca) / 100);
    }
  }

  return quantidadeFolhasF1; // Converte a string de volta para número
}
function retornaQuantidadeChapas(tipoProduto, tipoPapel, numeroCoresFrente, numeroCoresVerso, formatoImpressao, quantidadePaginas) {
  var quantidadeChapas = 0;
  var coresTotal = +numeroCoresFrente + +numeroCoresVerso;
  if (tipoProduto === 1) {
    quantidadeChapas = coresTotal;
  }

  if (tipoPapel === 2) {
    quantidadeChapas = coresTotal;
  } else if (tipoPapel === 3) {
    quantidadeChapas = Math.ceil(+quantidadePaginas / +formatoImpressao);
    quantidadeChapas = quantidadeChapas * +coresTotal;
  }

  if (tipoProduto === 3) {
    if (tipoPapel === 2 || tipoPapel === 4 || tipoPapel === 5 || tipoPapel === 6) {
      quantidadeChapas = coresTotal;
    }
  } else if (tipoProduto === 4 || tipoProduto === 5) {
    quantidadeChapas = 0;
  }

  return quantidadeChapas;
}

function SalvarPO() {
  document.getElementById('SalvarPO').style.display = 'block';
}

// FUNÇÃO DO CALCULO
function calcularValor() { 
  const JsProduto = ObterTabelaProduto();
  const JsTiragens = obterTabelaTiragens();
  const JsPapeis = JSON.stringify(ObsertPapelCorreto());
  const JsAcabamentos = obterTabelaAcabamentos();
  const JsServicos = obterTabelaServicos();
  const JsObservacao = obterValorObservacao();

  // CIF
  let CifConvertido = calcularCif();

  // Quantidade
  let Quantidade = document.getElementById('quantidade').value

  // Arte
  let ValorArte = clacularArte();

  // FRETE
  let ValorFrete = caluclarFrete();

  // DESCONTO
  let DescontoConvertido = calcularDesconto();

  // PRODUTO
  const Produto = JSON.parse(JsProduto)
  const resultadoProduto = Produto.map(item => {
    // Realize as manipulações desejadas no objeto item
  });

  // TIRAGENS
  const Tiragens = JSON.parse(JsTiragens)
  let ValorImpressao = 0
  let digital, offset, ValorUnitario = 0;
  Tiragens.map(item => {
    ValorImpressao += +item.valorImpressaoDigital * Quantidade;
    ValorUnitario = item.valorUnidade;
    digital = item.digital;
    offset = item.offset;
  });

    // Limpa os Cliques
    var AdicionandoClique = document.getElementById('calculo_clique');
    AdicionandoClique.innerHTML = ``;

  // PAPEIS

  const Papeis = JSON.parse(`[${JsPapeis}]`)
  let ValorPapel = 0;
  let ValorChapa = 0;
  let QtdChapa = 0;
  let PapelUnita = 0;
  let numeroVias, QuantidadeGastaChapa, QuantidadeGasta = 0;
  Papeis.map(item => {
    for (i = 0; i < item.length; i++) {
      if (item[i]) {
        let tipoProduto = document.getElementById('TIPO_PRODUTO').value;

        ValorChapa = item[i].precoChapa;
        let ValorFolha = item[i].precoFolha;
        let formatoImpressao = item[i].formatoImpressao;
        let quantidadePaginas = pegarQtdPaginas();
        let tiragem = pegarQtdTiragem();
        let perca = item[i].perca;
        let numeroCoresFrente = item[i].cf;
        let numeroCoresVerso = item[i].cv;
        let tipoProdutoString = item[i].tipo;
        if (tipoProdutoString === "FOLHA") {
          tipoProduto = 1;
        } else if (tipoProdutoString === "LIVRO") {
          tipoProduto = 2;
        } else if (tipoProdutoString === "BLOCO") {
          tipoProduto = 3;
        } else if (tipoProdutoString === "BANNER") {
          tipoProduto = 4;
        } else if (tipoProdutoString === "OUTROS") {
          tipoProduto = 5;
        } else if (tipoProduto != Number) {
          tipoProduto = 1;
        }

        let tipoPapel = 0;
        let tipoPapelAux = item[i].tipo;
        if (tipoPapelAux === "FOLHA") {
          tipoPapel = 1;
        } else if (tipoPapelAux === "CAPA") {
          tipoPapel = 2;
        } else if (tipoPapelAux === "MIOLO") {
          tipoPapel = 3;
        } else if (tipoPapelAux === "1ª VIA") {
          tipoPapel = 4;
        } else if (tipoPapelAux === "2ª VIA") {
          tipoPapel = 5;
        } else if (tipoPapelAux === "3ª VIA") {
          tipoPapel = 6;
        } else if (tipoPapel != Number) {
          tipoPapel = 1;
        }
        if (tipoProduto === 3) {
          for (let j = 0; j < tabelaPapeis.getRowCount(); j++) {
            let tipoPapelAux = item[i].tipo_papel;
            if (tipoPapelAux === "1ª VIA" || tipoPapelAux === "2ª VIA" || tipoPapelAux === "3ª VIA") {
              numeroVias += 1;
            }
          }
        }

        QuantidadeGasta = retornaQuantidadeFolhas(
          tipoProduto,
          tipoPapel,
          quantidadePaginas,
          formatoImpressao,
          tiragem,
          numeroVias,
          perca
        );
        PapelUnita += +ValorFolha;
        ValorPapel += +ValorFolha * +QuantidadeGasta;
        if (document.getElementById('Impre' + item[i].codigoPapel).value === '') {
          alert('FORMATO DE IMPRESSÃO NÃO FOI INSERIDO!')
          break;
        }
        document.getElementById('GFolha' + item[i].codigoPapel).value = QuantidadeGasta;
        retornarQuantidadedeClique(QuantidadeGasta, item[i].codigoPapel);
        QuantidadeGastaChapa = retornaQuantidadeChapas(tipoProduto, tipoPapel, numeroCoresFrente, numeroCoresVerso, formatoImpressao, quantidadePaginas)
        QtdChapa += QuantidadeGastaChapa;
        document.getElementById('GChapa' + item[i].codigoPapel).value = QuantidadeGastaChapa;

      }
    }
  });


  // ACABAMENTO
  const Acabamento = JSON.parse(JsAcabamentos)
  let ValorAcabamento = 0;
  let AcabamentoUnita = 0;
  Acabamento.map(item => {
    ValorAcabamento += Quantidade * +item.precoAcabamento;
    AcabamentoUnita += +item.precoAcabamento;
  });

  // SERVIÇOS
  ValorServico = JsServicos;

  // OBSERVAÇÃO
  const Observacao = JsObservacao;



  //CALCULO
  let Manual = document.getElementById('ValorManual').checked;
  let SomaValor = 0;
  let ValorUnitario_Final = 0;
  let Total = SomaValor;
  let UnitaTotais = Math.ceil(+PapelUnita) + Math.ceil(ValorImpressao);
  if (digital === false && offset === false || digital === true && offset === true) {
    alert('SELECIONE O TIPO DE IMPRESSÃO DIGITAL OU OFSSET!')
    Total = 'ERRO';
  } else {
    if (Manual == false) {
      if (digital === true) {
        SomaValor += ValorAcabamento;
        SomaValor += ValorPapel;
        SomaValor += ValorImpressao;
        SomaValor += (ValorPapel * 0.0102) / 100;
        Total = SomaValor;
        Total += (Total * CifConvertido) ;
        Total += ValorFrete;
        Total += ValorArte;
        Total -= (Total * DescontoConvertido) ;
        ValorUnitario_Final = parseFloat((Total / Quantidade).toFixed(2));
        Total = ValorUnitario_Final * Quantidade;
        document.getElementById('preco_unitario').value = ValorUnitario_Final
      }
      if (offset === true) {
        SomaValor += ValorAcabamento;
        SomaValor += ValorPapel;
        SomaValor += (QtdChapa * ValorChapa);
        Total = SomaValor;
        Total += (Total * CifConvertido) ;
        Total += ValorFrete;
        Total += ValorArte;
        Total -= (Total * DescontoConvertido) ;
        ValorUnitario_Final = parseFloat((Total / Quantidade).toFixed(2));
        Total = ValorUnitario_Final * Quantidade;
        document.getElementById('preco_unitario').value = ValorUnitario_Final
      }
    } else {
      Total = document.getElementById('preco_unitario').value * Quantidade;
    }

  }

  // ADICIONA VALOR AO CAMPO DE VALOR TOTAL
  if (Total.toFixed(2) != 'NaN') {
    document.getElementById('ValorTotalOrc').value = Total.toFixed(2);
    SalvarPO();
  }
}

// ENVIAR PARA O BANCO DE DADOS/SALVAR
function EnviaDados(){
  console.log('Entrou')
  
}