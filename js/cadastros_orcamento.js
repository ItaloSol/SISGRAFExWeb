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

/// SALVAR NOVO PRODUTO
function SalvaProdutoNovo() {
  // OBTEM PAPEIS
  // console.log(jsonFinal2);
  // Obtém a tabela pelo ID
  var tabela = document.getElementById('personalizaPapel');
  var tbodies = tabela.getElementsByTagName('tbody');
  var dadosJson = [];
  // Itera sobre cada tbody
  for (var t = 0; t < tbodies.length; t++) {

    var linhas = tbodies[t].getElementsByTagName('tr');

    // Itera sobre cada linha do tbody
    for (var i = 0; i < linhas.length; i++) {
      var linha = linhas[i];

      // Obtém as células da linha
      var celulas = linha.getElementsByTagName('td');

      // Cria um objeto JSON para armazenar os valores da linha
      var objetoJson = {
        CODIGO_PRODUTO: celulas[0].innerText,
        CODIGO_PAPEL: celulas[1].innerText,
        DESCRICAO: celulas[2].innerText,
        TIPO: celulas[3].innerText,
        CF: celulas[4].getElementsByTagName('input')[0].value,
        CV: celulas[5].getElementsByTagName('input')[0].value,
        FORMATO_IMPRESSÃO: celulas[6].getElementsByTagName('input')[0].value,
        PERCA: celulas[7].getElementsByTagName('input')[0].value,
        GASTO_FOLHA: celulas[8].getElementsByTagName('input')[0].value,
        PREÇO_FOLHA: celulas[9].innerText,
        QUANTIDADE_DE_CHAPAS: celulas[10].getElementsByTagName('input')[0].value,
        PREÇO_CHAPA: celulas[11].innerText
      };

      // Adiciona o objeto ao array
      dadosJson.push(objetoJson);
    }

  }

  // Converte o array para uma string JSON
  var jsonFinal3 = JSON.stringify(dadosJson);

}


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
      descricao: celulas[1].textContent,
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
function ObterPapelCorreto() {
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
  const textareaObservacao = {
    OBSERVACAO: document.getElementById('observacao_orc').value
  }
  return textareaObservacao;
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

function pegarQtdPaginas(codProduto) {
  // Encontre a tabela pelo ID
  var tabela = document.getElementById("SelecionadoProudutosProduto");

  // Itere pelas linhas da tabela, excluindo o cabeçalho
  for (var i = 1; i < tabela.rows.length; i++) {
    // Obtenha a primeira célula correspondente à coluna "CODIGO DO PRODUTO" (índice 0)
    var celulaCodProduto = tabela.rows[i].getElementsByTagName("td")[0];

    // Pegue o valor dentro da célula
    var valorCodProduto = celulaCodProduto.querySelector('input').value;

    // Verifique se o código do produto corresponde
    if (valorCodProduto === codProduto) {
      // Obtenha a célula correspondente à coluna "QUANTIDADE DE PÁGINAS" (índice 4)
      var celulaQuantidadePaginas = tabela.rows[i].getElementsByTagName("td")[4];
      // Pegue o valor dentro da célula
      var valorQuantidadePaginas = celulaQuantidadePaginas.textContent;
      return parseInt(valorQuantidadePaginas, 10);
    }
  }

  // Retorne 0 ou algum valor padrão caso o produto não seja encontrado
  return 0;
}

function pegarQtdTiragem(codProduto) {
  // Encontre o elemento da tabela pelo ID
  var tabela = document.getElementById("ProdutoTIragens");

  // Itere pelas linhas da tabela, excluindo o cabeçalho
  for (var i = 1; i < tabela.rows.length; i++) {
    // Obtenha a primeira célula correspondente à coluna "CODIGO DO PRODUTO" (índice 0)
    var celulaCodProduto = tabela.rows[i].getElementsByTagName("td")[0];

    // Pegue o valor dentro da célula
    var valorCodProduto = celulaCodProduto.querySelector('input').value;

    // Verifique se o código do produto corresponde
    if (valorCodProduto === codProduto) {
      // Obtenha a célula correspondente à coluna "QUANTIDADE" (índice 1)
      var celulaQuantidade = tabela.rows[i].getElementsByTagName("td")[1];

      // Verifique se a célula contém um elemento <input> com o id "quantidade"
      var inputQuantidade = celulaQuantidade.querySelector("input#quantidade");

      // Se o elemento <input> for encontrado
      if (inputQuantidade) {
        // Pegue o valor do elemento <input>
        var valorQuantidade = parseInt(inputQuantidade.value, 10);

        // Retorne o valor da quantidade
        return valorQuantidade;
      }
    }
  }

  // Retorne 0 ou algum valor padrão caso o produto não seja encontrado
  return 0;
}
// CALCULO DE CLIQUE

function PuxaDisponibilidade(qtd, tipo) {
  var campo = document.getElementById('AlertaCampos1');
  fetch('api_clique.php?quantidade=' + qtd + '&tipo=' + tipo)
    .then(response => response.json())
    .then(data => {
      if (data.Disponivel === true) {
        campo.classList.remove('bg-danger')
        campo.classList.add('bg-success')
        campo.innerHTML = 'Quantidade de clique disponivel';
      } else {
        window.alert(`QUANTIDADE DE CLIQUE ${tipo} USADA PELA OP NÃO ESTÁ DISPONIVEL NO CONTRATO! \n NÃO É POSSIVEL REALIZAR A IMPRESSÃO USANDO A QUANTIDADE DE CLIQUE!`);
        campo.innerHTML = 'Quantidade de clique não está disponivel';
      }
    });
}

function AdicionarCliqueAtabela(quantiade, valor) { // , quantiade, valor
  var AdicionandoClique = document.getElementById('calculo_clique');
  AdicionandoClique.innerHTML += `
  
        <tr>
          <td>${quantiade}</td>
          <td>R$ ${valor}</td>
        </tr>`;
}

function retornarQuantidadedeClique(quantidade, codigo) {
  return new Promise((resolve, reject) => {
    var cf = document.getElementById('GCF' + codigo);
    var cv = document.getElementById('GCV' + codigo);
    var PFolha = +cf.value + +cv.value;
    var Clique = quantidade / 2;
    fetch('api_clique.php?valor=1')
      .then(response => response.json())
      .then(data => {
        const valorP = data.valorP;
        const valorC = data.valorC;
        var valorT = 0;
        var Tipo = 'preto';
        if (PFolha >= 4) {
          Clique *= 4;
          Tipo = 'colorido'
          valorT = Clique * +valorC;
        } else {
          Clique *= 2;
          valorT = Clique * +valorP;
        }
        AdicionarCliqueAtabela(Clique, valorT.toFixed(2));
        PuxaDisponibilidade(Clique, Tipo);
        var Retorna = {
          'valor': valorT,
          'quantidade': Clique
        };
        resolve(Retorna);
      })
      .catch(err => {
        console.error(err);
        reject(err);
      });
  });
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

// FUNCAO DO CALCULO

// ENVIAR PARA O BANCO DE DADOS/SALVAR
function calcularTotal(item) {
  console.log(`INICIO TOTAL -------------------------------`)
  const { QUANTIDADE, VALOR_UNITARIO } = item;
  // Calcule o valor do frete, arte e desconto
  // CIF
  let CifConvertido = calcularCif();

  // Arte
  let ValorArte = clacularArte();

  // FRETE
  let ValorFrete = caluclarFrete();

  // DESCONTO
  let DescontoConvertido = calcularDesconto();
  let total = QUANTIDADE * VALOR_UNITARIO;
  console.log(`QUANTIDADE * VALOR_UNITARIO = ${QUANTIDADE} ${VALOR_UNITARIO} = ${QUANTIDADE * VALOR_UNITARIO}`)

  total += (total * CifConvertido);
  total += ValorFrete;
  total += ValorArte;
  total -= (total * DescontoConvertido);

  console.log(`TOTAL APOS EXTRAS(CIF, ARTE, FRETE, DESCONTO) = ${total}`)
  console.log(`FIM TOTAL -------------------------------`)
  return total;

}

function calculateUnitario(item, clique, manual, servico) {
  console.log(`INICIO -------------------------------`)
  const { CODIGO_PRODUTO, QUANTIDADE, CUSTO, PREÇO_FOLHA, GASTO_FOLHA, DIGITAL, FORMATO_IMPRESSÃO, VALOR_IMPRESSAO_DIGITAL, OFFSET, PREÇO_CHAPA, PERCA, QUANTIDADE_DE_CHAPAS, VALOR_UNITARIO } = item;
  let total = 0;
  if (manual == true) {
    total = document.getElementById('preco_unitario' + CODIGO_PRODUTO).value;
  } else {
    if (OFFSET == 1) {
      if (PREÇO_CHAPA && QUANTIDADE_DE_CHAPAS) {
        total += PREÇO_CHAPA * QUANTIDADE_DE_CHAPAS;
        total /= FORMATO_IMPRESSÃO
        console.log('valor chapa =', PREÇO_CHAPA * QUANTIDADE_DE_CHAPAS);
      }
      if (QUANTIDADE && CUSTO) {
        total += CUSTO;
        console.log('valor acabamento =', CUSTO);
      }
      document.getElementById('preco_unitario' + CODIGO_PRODUTO).value = total;
    }
    if (DIGITAL == 1) {
      if (PREÇO_FOLHA && GASTO_FOLHA) {
        total += PREÇO_FOLHA * GASTO_FOLHA;
        total /= FORMATO_IMPRESSÃO
        total /= GASTO_FOLHA;
        console.log('valor papel =', PREÇO_FOLHA * GASTO_FOLHA, ' FInal ', total);
      }
      if (QUANTIDADE && CUSTO) {
        total += CUSTO;
        console.log('valor acabamento =', CUSTO);
      }
    }
    const clicado = clique / QUANTIDADE;

    console.log('Clique dividido por unidade = ' + clicado)
    // total /= QUANTIDADE;
    console.log('Valor unitario de papel = ' + total)
    total += clicado;
    if (DIGITAL === 1 && VALOR_IMPRESSAO_DIGITAL) {
      total += parseFloat(VALOR_IMPRESSAO_DIGITAL);
      console.log('valor impressao =', VALOR_IMPRESSAO_DIGITAL);
    }
  }
  console.log(' Adicioando valor de serviço a cada unidade ' + servico);
  total += servico;
  console.log('Valor unitario total = ' + total)
  document.getElementById('preco_unitario' + CODIGO_PRODUTO).value = total.toFixed(2);


  console.log(`FIM -------------------------------`)

  return total;
}

function mergeObjects(obj1, obj2) {
  const merged = Object.assign({}, obj1, obj2);

  // Trate os campos específicos aqui
  if (obj1.QTD_PÁGINAS) merged.QTD_PÁGINAS = obj1.QTD_PÁGINAS;
  if (obj1.QUANTIDADE) merged.QUANTIDADE = obj1.QUANTIDADE;
  if (obj1.DIGITAL !== undefined) merged.DIGITAL = obj1.DIGITAL;
  if (obj1.VALOR_IMPRESSAO_DIGITAL !== undefined)
    merged.VALOR_IMPRESSAO_DIGITAL = obj1.VALOR_IMPRESSAO_DIGITAL;
  if (obj1.CODIGO_PAPEL !== undefined) merged.CODIGO_PAPEL = obj1.CODIGO_PAPEL;
  if (obj1.TIPO !== undefined) merged.TIPO = obj1.TIPO;
  if (obj1.CF !== undefined) merged.CF = obj1.CF;
  if (obj1.CV !== undefined) merged.CV = obj1.CV;
  if (obj1.FORMATO_IMPRESSÃO !== undefined)
    merged.FORMATO_IMPRESSÃO = obj1.FORMATO_IMPRESSÃO;
  if (obj1.PERCA !== undefined) merged.PERCA = obj1.PERCA;
  if (obj1.GASTO_FOLHA !== undefined) merged.GASTO_FOLHA = obj1.GASTO_FOLHA;
  if (obj1.PREÇO_FOLHA !== undefined) merged.PREÇO_FOLHA = obj1.PREÇO_FOLHA;
  if (obj1.QUANTIDADE_DE_CHAPAS !== undefined)
    merged.QUANTIDADE_DE_CHAPAS = obj1.QUANTIDADE_DE_CHAPAS;
  if (obj1.PREÇO_CHAPA !== undefined) merged.PREÇO_CHAPA = obj1.PREÇO_CHAPA;
  if (obj1.CODIGO_ACABAMENTO !== undefined)
    merged.CODIGO_ACABAMENTO = obj1.CODIGO_ACABAMENTO;
  if (obj1.MÁQUINA !== undefined) merged.MÁQUINA = obj1.MÁQUINA;
  if (obj1.CUSTO !== undefined) merged.CUSTO = obj1.CUSTO;

  return merged;
}

function consolidateObjects(jsonArray1, jsonArray2, jsonArray3, jsonArray4) {
  const consolidatedObjects = {};

  // Merge all arrays into one
  const allJsonArrays = [...jsonArray1, ...jsonArray2, ...jsonArray3, ...jsonArray4];

  allJsonArrays.forEach((item) => {
    const key = item.CODIGO_PRODUTO || item.CODIGO || item.PRODUTO;

    if (key) {
      if (!consolidatedObjects[key]) {
        consolidatedObjects[key] = {
          CODIGO_PRODUTO: key,
          VALOR_IMPRESSAO_DIGITAL: 0,
          PREÇO_CHAPA: 0,
          CUSTO: 0,
          QUANTIDADE: 0,
          DIGITAL: undefined,
          VALOR_IMPRESSAO_DIGITAL: 0,
          CODIGO_PAPEL: undefined,
          TIPO: undefined,
          PREÇO_CHAPA: 0,
          CUSTO: 0,
        };
      }

      const normalizedItem = item;

      consolidatedObjects[key] = mergeObjects(
        consolidatedObjects[key],
        normalizedItem
      );

      consolidatedObjects[key].VALOR_IMPRESSAO_DIGITAL +=
        parseFloat(normalizedItem.VALOR_IMPRESSAO_DIGITAL || 0);
      consolidatedObjects[key].PREÇO_CHAPA += parseFloat(normalizedItem.PREÇO_CHAPA || 0);
      consolidatedObjects[key].CUSTO += parseFloat(normalizedItem.CUSTO || 0);

      // Atualize a quantidade independentemente do valor
      // if (item.QUANTIDADE >= consolidatedObjects[key].QUANTIDADE) {
      //   consolidatedObjects[key].QUANTIDADE = item.QUANTIDADE;
      // }

      // Copie os demais campos do item para o objeto consolidado
      Object.keys(normalizedItem).forEach((campo) => {
        if (!consolidatedObjects[key][campo] && campo !== 'CODIGO_PRODUTO' && campo !== 'QUANTIDADE') {
          consolidatedObjects[key][campo] = normalizedItem[campo];
        }
      });
    }
  });

  return Object.values(consolidatedObjects);
}

function BuscaDados() {
  // Obtém a tabela pelo ID
  var tabela = document.getElementById('SelecionadoProudutosProduto');

  // Obtém todas as linhas da tabela
  var tbodyList = tabela.getElementsByTagName('tbody');
  var dadosJson = [];

  // Itera sobre cada tbody
  for (var j = 0; j < tbodyList.length; j++) {
    var tbody = tbodyList[j];

    // Obtém todas as linhas do tbody atual
    var linhas = tbody.getElementsByTagName('tr');

    // Itera sobre cada linha do tbody
    for (var i = 0; i < linhas.length; i++) {
      var linha = linhas[i];

      // Obtém as células da linha
      var celulas = linha.getElementsByTagName('td');

      // Cria um objeto JSON para armazenar os valores da linha
      var objetoJson = {
        CODIGO: celulas[0].getElementsByTagName('input')[0].value,
        DESCRICAO_PRODUTO: celulas[1].innerText,
        LARGURA: celulas[2].innerText,
        ALTURA: celulas[3].innerText,
        QTD_PÁGINAS: celulas[4].innerText
      };

      // Adiciona o objeto ao array
      dadosJson.push(objetoJson);
    }
  }

  // Converte o array para uma string JSON
  var jsonFinal1 = JSON.stringify(dadosJson);
  //
  // Obtém a tabela pelo ID
  var tabela = document.getElementById('ProdutoTIragens');
  var tbodies = tabela.getElementsByTagName('tbody');
  var dadosJson = [];

  for (var i = 0; i < tbodies.length; i++) {
    var linhas = tbodies[i].getElementsByTagName('tr');

    for (var j = 0; j < linhas.length; j++) {
      var linha = linhas[j];
      var celulas = linha.getElementsByTagName('td');

      var objetoJson = {
        PRODUTO: celulas[0].getElementsByTagName('input')[0].value,
        QUANTIDADE: celulas[1].getElementsByTagName('input')[0].value,
        DIGITAL: celulas[2].getElementsByTagName('input')[0].checked ? 1 : 0,
        OFFSET: celulas[3].getElementsByTagName('input')[0].checked ? 1 : 0,
        VALOR_IMPRESSAO_DIGITAL: celulas[4].getElementsByTagName('input')[0].value,
        VALOR_UNITARIO: celulas[5].getElementsByTagName('input')[0].value
      };

      dadosJson.push(objetoJson);
    }
  }

  var jsonFinal2 = JSON.stringify(dadosJson);
  // console.log(jsonFinal2);
  // Obtém a tabela pelo ID
  var tabela = document.getElementById('tabela_campos');
  var tbodies = tabela.getElementsByTagName('tbody');
  var dadosJson = [];
  // Itera sobre cada tbody
  for (var t = 0; t < tbodies.length; t++) {

    var linhas = tbodies[t].getElementsByTagName('tr');

    // Itera sobre cada linha do tbody
    for (var i = 0; i < linhas.length; i++) {
      var linha = linhas[i];

      // Obtém as células da linha
      var celulas = linha.getElementsByTagName('td');

      // Cria um objeto JSON para armazenar os valores da linha
      var objetoJson = {
        CODIGO_PRODUTO: celulas[0].innerText,
        CODIGO_PAPEL: celulas[1].innerText,
        DESCRICAO_PAPEL: celulas[2].innerText,
        TIPO: celulas[3].innerText,
        CF: celulas[4].getElementsByTagName('input')[0].value,
        CV: celulas[5].getElementsByTagName('input')[0].value,
        FORMATO_IMPRESSÃO: celulas[6].getElementsByTagName('input')[0].value,
        PERCA: celulas[7].getElementsByTagName('input')[0].value,
        GASTO_FOLHA: celulas[8].getElementsByTagName('input')[0].value,
        PREÇO_FOLHA: celulas[9].innerText,
        QUANTIDADE_DE_CHAPAS: celulas[10].getElementsByTagName('input')[0].value,
        PREÇO_CHAPA: celulas[11].innerText
      };

      // Adiciona o objeto ao array
      dadosJson.push(objetoJson);
    }

  }

  // Converte o array para uma string JSON
  var jsonFinal3 = JSON.stringify(dadosJson);

  // Exibe o resultado no console (você pode enviar essa string JSON para onde for necessário)
  //
  // Obtém a tabela pelo ID
  var tabela = document.getElementById('seleccionadoacabamentos');
  var tbodies = tabela.getElementsByTagName('tbody');
  var dadosJson = [];

  for (var i = 0; i < tbodies.length; i++) {
    var linhas = tbodies[i].getElementsByTagName('tr');

    for (var j = 0; j < linhas.length; j++) {
      var linha = linhas[j];
      var celulas = linha.getElementsByTagName('td');

      // Get the input elements and their values
      var campo_cod_prod = celulas[0].innerText;
      var inputCodigoAcabamento = celulas[1].getElementsByTagName('input')[0];
      var inputMaquina = celulas[2].getElementsByTagName('input')[0];
      var inputCustoHora = celulas[3].getElementsByTagName('input')[0];

      var objetoJson = {
        CODIGO_PRODUTO: campo_cod_prod,
        CODIGO_ACABAMENTO: inputCodigoAcabamento.value,
        MÁQUINA: inputMaquina.value,
        CUSTO: inputCustoHora.value
      };

      dadosJson.push(objetoJson);
    }
  }


  var jsonFinal4 = JSON.stringify(dadosJson);
  // console.log(jsonFinal4);
  //

  jsonFinal1 = JSON.parse(jsonFinal1);  //  console.log(jsonFinal1);
  jsonFinal2 = JSON.parse(jsonFinal2);  //  console.log(jsonFinal2);
  jsonFinal3 = JSON.parse(jsonFinal3); //  console.log(jsonFinal3);
  jsonFinal4 = JSON.parse(jsonFinal4); //  console.log(jsonFinal4);
  return consolidateObjects(jsonFinal1, jsonFinal2, jsonFinal3, jsonFinal4)
}
function DadoClique() {
  // Obtém a tabela pelo ID
  var tabela = document.getElementById('calculo_clique');
  var tbodies = tabela.getElementsByTagName('tbody');
  var dadosJson = [];

  for (var i = 0; i < tbodies.length; i++) {
    var linhas = tbodies[i].getElementsByTagName('tr');

    for (var j = 0; j < linhas.length; j++) {
      var linha = linhas[j];
      var celulas = linha.getElementsByTagName('td');

      if (celulas.length >= 2) {
        var objetoJson = {
          CLIQUE: celulas[0].innerText,
          VALOR: celulas[1].innerText.replace('R$ ', '')
        };

        dadosJson.push(objetoJson);
      }
    }
  }

  var jsonFinal5 = JSON.stringify(dadosJson);
  // console.log(jsonFinal5);
  return jsonFinal5 = JSON.parse(jsonFinal5);
}
function DadosServico() {
  var tabela = document.getElementById('tabelaAservicos');
  var tbodies = tabela.getElementsByTagName('tbody');
  var dadosJson = [];

  for (var i = 0; i < tbodies.length; i++) {
    var linhas = tbodies[i].getElementsByTagName('tr');

    for (var j = 0; j < linhas.length; j++) {
      var linha = linhas[j];
      var celulas = linha.getElementsByTagName('td');

      if (celulas.length >= 2) {
        var objetoJson = {
          CODIGO_PRODUTO: celulas[0].innerText,
          DESCRICAO_SERVICO: celulas[1].innerText,
          VALOR_SERVICO: celulas[2].innerText.replace('R$ ', '')
        };

        dadosJson.push(objetoJson);
      }
    }
  }

  var jsonFinal6 = JSON.stringify(dadosJson);
  return jsonFinal6 = JSON.parse(jsonFinal6);
}

function calcularValor() {
  var AdicionandoClique = document.getElementById('calculo_clique');
  AdicionandoClique.innerHTML = '';
  const JsTiragens = obterTabelaTiragens();
  // TIRAGENS
  const Tiragens = JSON.parse(JsTiragens)
  let ValorImpressao = 0
  let digital, offset, ValorUnitario, cod_pProduto = 0;
  let Quantidade = 0;
  Tiragens.map(item => {
    // Quantidade
    cod_pProduto = item.produto;
    Quantidade = +document.getElementById('quantidade').value
    ValorImpressao += +item.valorImpressaoDigital * Quantidade;
    ValorUnitario = +item.valorUnidade;
    digital = item.digital;
    offset = item.offset;

  });

  // PAPEIS
  const JsPapeis = JSON.stringify(ObterPapelCorreto());
  const Papeis = JSON.parse(`[${JsPapeis}]`)
  let ValorPapel = 0;
  let ValorChapa = 0;
  let QtdChapa = 0;
  let PapelUnita = 0;
  let ValorClique = 0;
  let Qtd_ApuraClique = 0;
  let numeroVias = 0
  let QuantidadeGastaChapa, QuantidadeGasta = 0;
  Papeis.map(item => {
    for (i = 0; i < item.length; i++) {
      if (item[i]) {
        let tipoProduto = document.getElementById('TIPO_PRODUTO').value;
        ValorChapa = item[i].precoChapa;
        let ValorFolha = item[i].precoFolha;
        let formatoImpressao = item[i].formatoImpressao;
        let quantidadePaginas = pegarQtdPaginas(item[i].produto);
        let tiragem = pegarQtdTiragem(item[i].produto);
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
          +tipoProduto,
          +tipoPapel,
          +quantidadePaginas,
          +formatoImpressao,
          +tiragem,
          +numeroVias,
          +perca
        );
        PapelUnita += +ValorFolha;
        ValorPapel += +ValorFolha * +QuantidadeGasta;
        if (document.getElementById('Impre' + item[i].codigoPapel + item[i].produto).value === '') {
          var tab = new bootstrap.Tab(document.getElementById('settings-list-item3'));
          tab.show();
          alert('O FORMATO DO PAPEL NÃO FOI SELECIONADO!')
          break;
        } else {
          setTimeout(() => {
            document.getElementById('SalvarPO').style.display = 'block';
          }, 500);
        }
        document.getElementById('GFolha' + item[i].codigoPapel + item[i].produto).value = QuantidadeGasta;
        if (digital === true) {
          document.getElementById('settings-list-Clique').style.display = 'block';

          retornarQuantidadedeClique(QuantidadeGasta, item[i].codigoPapel + item[i].produto)
            .then(result => {
              ValorClique += +result.valor;
              Qtd_ApuraClique += result.quantidade;
              // Continue com outras operações aqui, se necessário
            })
            .catch(err => {
              console.error(err);
            });


          if (Qtd_ApuraClique >= 8000) {
            window.alert('ATENCAO!! \n A QUANTIDADE DE CLIQUE UTILIZADA NESSA OP PASSA DE 8 MIL CLIQUES. \n O VALOR DE CLIQUE UTILIZADO PELA OP ESTÁ MUITO ALTO! \n RECOMENDADO RODAR NA OFFSET.')
          }
        } else {
          console.log(tipoProduto + ' + ' + tipoPapel + ' + ' + numeroCoresFrente + ' + ' + numeroCoresVerso + ' + ' + formatoImpressao + ' + ' + quantidadePaginas)
          QuantidadeGastaChapa = retornaQuantidadeChapas(tipoProduto, tipoPapel, numeroCoresFrente, numeroCoresVerso, formatoImpressao, quantidadePaginas)
          console.log(QuantidadeGastaChapa)
          QtdChapa += QuantidadeGastaChapa;
          document.getElementById('GChapa' + item[i].codigoPapel + item[i].produto).value = QuantidadeGastaChapa;
        }
      }
    }
  });
  let organiza_campos = BuscaDados();


  //CALCULO
  let Total = 0;
  const manual = document.getElementById('ValorManual').checked;
  if (digital === false && offset === false || digital === true && offset === true) {
    alert('SELECIONE O TIPO DE IMPRESSÃO DIGITAL OU OFSSET!')
    Total = 'ERRO';
  } else {
    organiza_campos.forEach((item) => {
      const servico = obterTabelaServicos();
      setTimeout(() => {
        const unitario = calculateUnitario(item, ValorClique, manual, servico);
        console.log(`CODIGO_PRODUTO: ${item.CODIGO_PRODUTO}, Unitario: ${unitario}`);
      }, 200);

    });
    setTimeout(() => {
      organiza_campos = BuscaDados();
    }, 200);
    setTimeout(() => {
      organiza_campos.forEach((item) => {
        const total = calcularTotal(item);
        Total += total;
      });
    }, 500);

    setTimeout(() => {
      console.log(`+ VALOR DE CLIQUE TOTAL = ${ValorClique}`)
      document.getElementById('ValorTotalOrc').value = Total.toFixed(2);
      console.log(`TOTAL ORÇAMENTO: ${Total}`);
    }, 500);
    // ADICIONA VALOR AO CAMPO DE VALOR TOTAL

  }
}


function SalvarOrcamento() {
  const contato = document.getElementById('selecione_contato');
  const endereco = document.getElementById('selecione_endereco')
  const observacao = document.getElementById('observacao_orc').value;
  const codigoCliente =  document.getElementById('codigoCliente');
  const tipocliente =  document.getElementById('tipoCliente');
  const cif = document.getElementById('cif')
  const arte = document.getElementById('arte')
  const frete = document.getElementById('frete')
  const desconto = document.getElementById('desconto')
  const total = document.getElementById('ValorTotalOrc')
  const menu = document.getElementById('ValorManual')
  const tipo_produto = document.getElementById('TIPO_PRODUTO');
  const data_validade = document.getElementById('data_validade')
  var manual = 0;
  if(menu == true){
     manual = 1;
  }else{
     manual = 0;
  }
  if (contato.value == 'Selecione um contato' || endereco.value == 'Selecione um endereço') {
    window.location.href = '#selecione_contato';
    window.alert('O Contato do cliente ou o Endereço não foi selecionado!');
  } else {
    let SalvaDados = BuscaDados();
    console.log(SalvaDados)
    const dados = {
      cod: codigoCliente.value,
      tipo: tipocliente.value,
      contato: contato.value,
      endereco: endereco.value,
      cif: cif.value, 
      arte: arte.value,
      frete: frete.value,
      desconto: desconto.value,
      manual: manual,
      tipo_produto: tipo_produto.name,
      data: data_validade.value,
      linhas: JSON.stringify(SalvaDados),
      DadosServico: JSON.stringify(DadosServico()),
      DadoClique: JSON.stringify(DadoClique()),
      obterValorObservacao: observacao,
      valorTotal: total.value
    };

    const url = 'api_cadastrar_orcamento.php';
    const params = [];
    for (const key in dados) {
      params.push(`${key}=${encodeURIComponent(dados[key])}`);
    }
    const queryString = params.join('&');
    
    fetch(`${url}?${queryString}`)
      .then(response => {
        if (!response.ok) {
          throw new Error('Erro na solicitação!');
        }
        // Aqui você pode lidar com a resposta da solicitação se necessário
        return response.json(); // Ou outro método para obter o corpo da resposta
      })
      .then(data => {
        // Aqui você pode lidar com os dados da resposta, se necessário
        console.log(data)
        window.location.href = `tl-orcamento.php?cod=${data.orcamento}&tipo=${data.tipo}`;
      })
      .catch(error => {
        // Aqui você pode lidar com erros de solicitação
        console.error('Erro:', error);
      });
  }
}