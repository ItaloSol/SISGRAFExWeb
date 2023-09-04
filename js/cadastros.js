// Papel
function CadastraPapel() {
  const Nome_papel = document.getElementById('Nome_papel').value.toUpperCase();
   const Mediada_Papel = document.getElementById('Mediada_Papel').value.toUpperCase();
     const Gramatura_Papel = document.getElementById('Gramatura_Papel').value.toUpperCase();
      const Fomato_Papel = document.getElementById('Fomato_Papel').value.toUpperCase();
      const valor_Papel = document.getElementById('valor_Papel').value.toUpperCase();
       const umaface_Papel = document.getElementById('umaface_Papel');
       let face_papel = 0;
       if(umaface_Papel.checked == true){
        face_papel = 1;
    }
    const mensagemPapel = document.getElementById('mensagemPapel');
      if(Nome_papel != '' && Mediada_Papel != '' && Gramatura_Papel != '' && Fomato_Papel != '' && valor_Papel != ''){
        console.log('cadastro_apapel.php?N='+ Nome_papel +'&M='+Mediada_Papel+'&G='+Gramatura_Papel+'&F='+Fomato_Papel+'&U='+face_papel+'&V='+valor_Papel)
      return fetch('cadastro_apapel.php?N='+ Nome_papel +'&M='+Mediada_Papel+'&G='+Gramatura_Papel+'&F='+Fomato_Papel+'&U='+face_papel+'&V='+valor_Papel).then(res => res.json()).then(result => {
        if(result['erro'] == false){
          setTimeout(() => {
            abriPapels()
            mensagemPapel.innerHTML = '';
          }, 1000);
          return mensagemPapel.innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso. Papel Cadastrado!</div></div>';
        }else{
          setTimeout(() => {
            mensagemPapel.innerHTML = '';
          }, 1000);
          return mensagemPapel.innerHTML = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">Não foi possivel salvar o papel!</div></div>';
        }
      })
    }else{
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
      if(Nome_Acabamento != '' && valor_Acabamento != ''){
      return fetch('cadastro_Acabamento.php?N='+ Nome_Acabamento +'&V='+valor_Acabamento).then(res => res.json()).then(result => {
        if(result['erro'] == false){
          setTimeout(() => {
            abriAcabamentos()
            mensagemAcabamento.innerHTML = '';
          }, 1000);
          return mensagemAcabamento.innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso. Acabamento Cadastrado!</div></div>';
        }else{
          setTimeout(() => {
            mensagemAcabamento.innerHTML = '';
          }, 1000);
          return mensagemAcabamento.innerHTML = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">Não foi possivel salvar o Acabamento!</div></div>';
        }
      })
    }else{
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
    console.log('cadastro_Servico.php?N='+ Nome_Servico +'&V='+valorUnitario+'&T='+tipoServico + '&M='+valor_min+'&G='+Servico_Geral)
      if(Nome_Servico != '' && valorUnitario != ''){
        
      return fetch('cadastro_Servico.php?N='+ Nome_Servico +'&V='+valorUnitario+'&T='+tipoServico + '&M='+valor_min+'&G='+Servico_Geral).then(res => res.json()).then(result => {
        if(result['erro'] == false){
          setTimeout(() => {
            abriServicos()
            mensagemServico.innerHTML = '';
          }, 1000);
          return mensagemServico.innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso. Servico Cadastrado!</div></div>';
        }else{
          setTimeout(() => {
            mensagemServico.innerHTML = '';
          }, 1000);
          return mensagemServico.innerHTML = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">Não foi possivel salvar o Servico!</div></div>';
        }
      })
    }else{
      setTimeout(() => {
        mensagemServico.innerHTML = '';
      }, 1000);
      return mensagemServico.innerHTML = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">É necessario completar todos os campos!</div></div>';
      
    }
}
const freteObserva = document.getElementById('check_frete');
const arteObserva = document.getElementById('check_arte');
freteObserva.addEventListener('click', vlr => {
  if(freteObserva.checked){
    document.getElementById('frete').disabled = false
  }else{
    document.getElementById('frete').disabled = true
  }
})
arteObserva.addEventListener('click', vlr => {
  if(arteObserva.checked){
    document.getElementById('arte').disabled = false
  }else{
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
  //console.log(jsonProdutos);
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
        digital: celulas[2].querySelector('input').value,
        offset: celulas[3].querySelector('input').value,
        valorImpressaoDigital: celulas[4].querySelector('input').value,
        valorUnidade: celulas[5].querySelector('input').value
      };
      dados.push(item);
    }
  } else {
    // A tabela não possui dados
    console.log('Nenhum produto selecionado.');
    return;
  }

  return JSON.stringify(dados);
  //console.log(jsonData);
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
          cod: celulas[1].textContent,
          descricao: celulas[2].textContent,
          cf: celulas[3].querySelector('input').value,
          cv: celulas[4].querySelector('input').value,
          for_impres: celulas[5].querySelector('input').value,
          perca: celulas[6].querySelector('input').value,
          gasto: celulas[7].querySelector('input').value,
          preco: celulas[8].textContent,
          qtd_chapa: celulas[9].querySelector('input').value,
          valo_chapa: celulas[10].textContent,
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
    if(tbodyElement.length == 2){
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
          cf: celulas[3].querySelector('input').value,
          cv: celulas[4].querySelector('input').value,
          formatoImpressao: celulas[5].querySelector('input').value,
          perca: celulas[6].querySelector('input').value,
          gastoFolha: celulas[7].querySelector('input').value,
          precoFolha: celulas[8].textContent,
          quantidadeChapas: celulas[9].querySelector('input').value,
          precoChapa: celulas[10].textContent
        };
        dados.push(item);
      
    } else {
      // A tabela não possui dados
      console.log('Nenhum papel selecionado.');
      return;
    }
  
    return JSON.stringify(dados);
    //console.log(jsonData);
 
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
    console.log('Nenhum acabamento selecionado.');
    return;
  }

  return JSON.stringify(dados);
  //console.log(jsonData);
}
 // Tabela Serviços
function obterTabelaServicos() {
  const tabela = document.getElementById('tabelaAservicos');
  const dados = [];

  // Verificar se a tabela possui dados
  if (tabela.rows.length > 1) {
    // Loop começa a partir de 1 para ignorar a primeira linha de cabeçalho
    for (let i = 1; i < tabela.rows.length; i++) {
      const linha = tabela.rows[i];
      const celulas = linha.cells;

      if (celulas[0].textContent === '') {
        console.log('Nenhum serviço selecionado.');
        return;
      }
      
      const item = {
        codigoServico: celulas[0].textContent,
        descricao: celulas[1].textContent,
        valorServico: celulas[2].textContent
      };
      dados.push(item);
    }
  } else {
    // A tabela não possui dados
    console.log('Nenhum serviço selecionado.');
    return;
  }

  return JSON.stringify(dados);
  //console.log(jsonData);
}
  // Valor Observacao
function obterValorObservacao() {
  const textareaObservacao = document.getElementById('observacao_orc');
  return textareaObservacao.value;
 // console.log(valorObservacao);
}
 // FUNÇÃO DO CALCULO
 function calcularValor(){
  const JsProduto = ObterTabelaProduto();
  const JsTiragens =  obterTabelaTiragens();
  const JsPapeis =  JSON.stringify(ObsertPapelCorreto());
  const JsAcabamentos =  obterTabelaAcabamentos();
  const JsServicos =  obterTabelaServicos();
  const JsObservacao =  obterValorObservacao();
 
    // CIF
  const ValorCif = document.getElementById('cif').value;
    // Arte
    let ValorArte = null;
  if(document.getElementById('check_arte').value){
     ValorArte = Number(document.getElementById('arte').value);
  }else{
     ValorArte = 0;
  }
    // FRETE
    let ValorFrete = null;
  if(document.getElementById('check_frete').value){
     ValorFrete = Number(document.getElementById('frete').value);
  }else{
     ValorFrete = 0;
  }
    // DESCONTO
  const ValorDesconto = Number(document.getElementById('desconto').value);
    // PRODUTO
    const Produto = JSON.parse(JsProduto)
    const resultadoProduto = Produto.map(item => {
      // Realize as manipulações desejadas no objeto item
      const novoItem = {
        codigo: item["código"],
        descricao: item["descrição"],
        largura: item["largura"],
        altura: item["altura"],
        qtdPaginas: item["qtd. páginas"]
      };
      
      // Retorne o novo objeto manipulado
      return novoItem;
    });
    // TIRAGENS
    const Tiragens = JSON.parse(JsTiragens)
    let ValorImpressao = 0;
    let Quantidade = 0;
    let ValorUnitario = 0;
    Tiragens.map(item => {
      Quantidade +=  +item.quantidade;
      ValorImpressao += +item.valorImpressaoDigital;
      ValorUnitario = item.valorUnidade;
        const novoItem = {
          produto: item.produto,
          quantidade: item.quantidade,
          digital: item.digital,
          offset: item.offset,
          valorImpressaoDigital: item.valorImpressaoDigital,
          valorUnidade: item.valorUnidade
        };
        return novoItem;
    });
    // PAPEIS
    const Papeis = JSON.parse(`[${JsPapeis}]`)
    let ValorPapel = 0;
    let novoItem = [];
    let ValorChapa = 0;
    Papeis.map(item => {
      for(i = 0; i < item.length; i++){ 
      if(item[i]){
        ValorPapel += +item[i].preco;
        ValorChapa += +item[i].valo_chapa;
      }
      
      novoItem = {
        produto: item.produto,
        codigoPapel: item.cod,
        descricao: item.descricao,
        cf: item.cf,
        cv: item.cv,
        formatoImpressao: item.for_impres,
        perca: item.perca,
        gastoFolha: item.gasto,
        precoFolha: item.preco,
        quantidadeChapas: item.qtd_chapa,
        precoChapa: item.valo_chapa
      };
    }
      return novoItem;
    });

    // ACABAMENTO
    const Acabamento = JSON.parse(JsAcabamentos)
    let ValorAcabamento = 0;
    Acabamento.map(item => {
      ValorAcabamento += +item.precoAcabamento;
      const novoItem = {
        codigoAcabamento: item.codigoAcabamento,
        descricao: item.descricao,
        precoAcabamento: item.precoAcabamento
      };
      return novoItem;
    });
    // SERVIÇOS
    const Servicos = JSON.parse(JsServicos)
    Servicos.map(item => {
      const novoItem = {
        codigoServico: item.codigoServico,
        descricao: item.descricao,
        valorServico: item.valorServico
      };
      return novoItem;
    })
    // OBSERVAÇÃO
    const Observacao = JsObservacao;
    let SomaValor = 0;
    // console.log('Valor acabamento R$ ' + ValorAcabamento);
    // FORMULA PARA O VALOR
    // console.log('Quantidade de tiragens '+Quantidade);
    // console.log('Valor arte R$ ' + ValorArte);
    // console.log('Valor frete R$ ' + ValorFrete);
    // console.log('Valor desconto R$ ' + ValorDesconto);
    // console.log('Valor acabamento R$ ' + ValorAcabamento);
    // console.log('Valor Impressão R$ '+ ValorImpressao);
    // console.log('Valor ValorChapa R$ '+ ValorChapa);
    // ValorPapel += (ValorPapel * 5) / 100;
    // console.log('Valor Papel R$ '+ ValorPapel);
    // let SomaValor = ValorAcabamento * Quantidade;
    // console.log('ValorAcabamento * Quantidade '+ SomaValor)
    // SomaValor += ValorPapel;
    // console.log(' + ValorPapel '+ SomaValor)
    // SomaValor += ValorChapa;
    // console.log(' + ValorChapa '+ SomaValor)
    // SomaValor /= Quantidade;
    // console.log('SomaValor / Quantidade '+ SomaValor)
    // SomaValor += ValorImpressao;
    // console.log(' + ValorImpressao '+ SomaValor)
    // SomaValor += (SomaValor * +ValorCif) / 100;
    // console.log('(SomaValor * +ValorCif) / 100 R$ '+ SomaValor)

    // SomaValor -= (SomaValor * +ValorDesconto) / 100;
    // console.log('- (SomaValor * +ValorDesconto) R$ '+ SomaValor)
    SomaValor += (ValorUnitario * +ValorCif) / 100;
    SomaValor += ValorArte;
    SomaValor += ValorFrete;
    console.log('SomaValor R$ '+ SomaValor)
    SomaValor -= (ValorUnitario * +ValorDesconto) / 100;
    console.log('SomaValor R$ '+ SomaValor)
    SomaValor += ValorUnitario * Quantidade;
    console.log('SomaValor R$ '+ SomaValor)
    let Total = SomaValor;
    
    // console.log('Desconto Bruto' + DescontoBruto);
    // console.log('Valor Conversão do cif R$ '+ ConversaoCif);
    // console.log('Valor do cif R$ '+ CifBruto);
    // console.log('Soma Valor R$ '+ SomaValor)
    // console.log('Valor Total R$ '+ Total.toFixed(2));
    
    // ADICIONA VALOR AO CAMPO DE VALOR TOTAL
    document.getElementById('ValorTotalOrc').value = Total.toFixed(2);
}
