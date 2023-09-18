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
      if(celulas[1] != undefined){
        dados.push(celulas[2].textContent)
      }
    }
    dados.map( valor => {
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
  let CifConvertido = +ValorCif / 100;
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
  let DescontoConvertido = +ValorDesconto / 100;
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
    let digital = 0;
    let offset = 0;
    let ValorUnitario = 0;
    Tiragens.map(item => {
      Quantidade +=  +item.quantidade;
      ValorImpressao += +item.valorImpressaoDigital;
      ValorUnitario = item.valorUnidade;
      digital = item.digital;
      offset = item.offset;
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
   
    console.log('digital = ' + digital + ' offset = ' + offset)
    // PAPEIS
    const Papeis = JSON.parse(`[${JsPapeis}]`)
    let ValorPapel = 0;
    let novoItem = [];
    let ValorChapa = 0;
   
    console.log('------------------------------PAPEL------------------------------')
    Papeis.map(item => {
      for(i = 0; i < item.length; i++){ 
      if(item[i]){
        let pr = item[i].preco;
        let gt = item[i].valo_chapa;
        ValorPapel =  +ValorPapel + +pr;
        console.log('Valores a calcular: Preço do papel * quantidade gasta ' + pr + ' = ' + ValorPapel );
        ValorChapa = +item[i].valo_chapa;
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
      return ValorPapel;
    });
    console.log('-- TOTAL PAPEL = ' + ValorPapel);
    console.log('------------------------------FIM PAPEL------------------------------')
    console.log('------------------------------------------------------------')
    // ACABAMENTO
    const Acabamento = JSON.parse(JsAcabamentos)
    let ValorAcabamento = 0;
    console.log('------------------------------ACABAMENTO------------------------------')
    Acabamento.map(item => {
      ValorAcabamento += +item.precoAcabamento ;
      console.log('Valores a calcular: Preço do acabamento * Quantidade ' + item.precoAcabamento + ' * ' + Quantidade + ' = ' + ValorAcabamento );
      const novoItem = {
        codigoAcabamento: item.codigoAcabamento,
        descricao: item.descricao,
        precoAcabamento: item.precoAcabamento
      };
      return novoItem;
    });
    console.log('-- TOTAL ACABAMENTO = ' + ValorAcabamento);
    console.log('------------------------------FIM ACABAMENTO------------------------------')
    console.log('------------------------------------------------------------')
    // SERVIÇOS
    
    ValorServico =  JsServicos;
    
    
    // OBSERVAÇÃO
    const Observacao = JsObservacao;
    console.log(' --- QUANTIDADE ---');
    console.log(Quantidade);
    console.log(' ------');
    console.log(' --- CHAPA ---');
    console.log(ValorChapa);
    console.log(' ------');
    //CALCULO
    let SomaValor = 0;
    let Total = SomaValor;
    if(digital === false && offset === false){
      alert('SELECIONE O TIPO DE IMPRESSÃO DIGITAL OU OFSSET!')
      Total = 'ERRO';
    }else{
      if(digital === true){
        SomaValor += ValorAcabamento ;
        console.log(' + acabamento  ' + ValorAcabamento + ' = ' + SomaValor)
        SomaValor += ValorPapel;
        console.log(' + valor do apapel = ' + SomaValor);
        SomaValor += ValorImpressao;
        console.log(' + Valor de impressao ' + ValorImpressao + ' = ' + SomaValor)
        SomaValor += (ValorPapel * 0.0102) / 100;
        console.log(' + Valor de impressao ' + ValorPapel + ' = ' + (ValorPapel * 0.0102) / 100 + ' = ' + SomaValor)
        Total = SomaValor;
      }
      if(offset === true){
        SomaValor += ValorAcabamento * Quantidade;
        console.log('acabamento * quantidade ' + ValorAcabamento + ' * ' + Quantidade + ' = ' + SomaValor)
        
        SomaValor += ValorPapel;
        console.log(' + valor do apapel = ' + SomaValor);
        SomaValor += ValorChapa;
        console.log(' + valor da Chapa = ' + SomaValor);
        SomaValor /= Quantidade;
        console.log(' Valor dividido pela quantidade '+Quantidade+' = ' + SomaValor)
        SomaValor += ValorImpressao;
        console.log(' + Valor de impressao ' + ValorImpressao + ' = ' + SomaValor)
         SomaValor += (SomaValor * +CifConvertido) / 100;
        console.log("SomaValor += (SomaValor * +CifConvertido "+CifConvertido+") / 100;"+ SomaValor)
         SomaValor -= (SomaValor * DescontoConvertido) / 100;
        console.log("SomaValor -= (SomaValor * DescontoConvertido"+DescontoConvertido+") / 100;"+ SomaValor)
        
         Total = SomaValor;
      }
    }

    console.log('---------------------------------------------');
    // ADICIONA VALOR AO CAMPO DE VALOR TOTAL
    document.getElementById('ValorTotalOrc').value = Total.toFixed(2);
}
