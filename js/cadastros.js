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
    console.log(celulas[1].textContent)
    Produtos.push(item);
  }
  const jsonProdutos = JSON.stringify(Produtos);
  console.log(jsonProdutos);
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
        quantidade: celulas[1].textContent,
        digital: celulas[2].textContent,
        offset: celulas[3].textContent,
        valorImpressaoDigital: celulas[4].textContent,
        valorUnidade: celulas[5].textContent
      };
      dados.push(item);
    }
  } else {
    // A tabela não possui dados
    console.log('Nenhum produto selecionado.');
    return;
  }

  const jsonData = JSON.stringify(dados);
  console.log(jsonData);
}
  // Tabela Papeis
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
  
    const jsonData = JSON.stringify(dados);
    console.log(jsonData);
 
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

  const jsonData = JSON.stringify(dados);
  console.log(jsonData);
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

  const jsonData = JSON.stringify(dados);
  console.log(jsonData);
}
  // Valor Observacao
function obterValorObservacao() {
  const textareaObservacao = document.getElementById('observacao_orc');
  const valorObservacao = textareaObservacao.value;
  console.log(valorObservacao);
}
 // FUNÇÃO DO CALCULO
 function calcularValor(){
    ObterTabelaProduto();
    obterTabelaTiragens();
    obterTabelaPapeis();
    obterTabelaAcabamentos();
    obterTabelaServicos();
    obterValorObservacao();
 }
