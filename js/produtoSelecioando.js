// PRODUTO PARA PRODUÇÃO = PP
if(localStorage.getItem('ProdutoSelecionadoPP') != null && localStorage.getItem('ProdutoSelecionadoPP') != '[]' || localStorage.getItem('ProdutoSelecionadoPE') != null && localStorage.getItem('ProdutoSelecionadoPE') != '[]'){
  RecuperaProdutoSelecionado();
}

async function waitForElementApagarPP(elementId, timeout = 1000) {
  return new Promise((resolve) => {
    const startTime = Date.now();

    const checkElement = () => {
      const element = document.getElementById(elementId);
      if (element) {
        resolve(element);
      } else {
        const elapsedTime = Date.now() - startTime;
        if (elapsedTime >= timeout) {
          resolve(null);
        } else {
          setTimeout(checkElement, 100);
        }
      }
    };

    checkElement();
  });
}

async function SelecionarSelecioandoApagarPP() {
  if (document.getElementById('produtosTableBody')) {
    if (localStorage.getItem('ProdutoSelecionadoPP') != '[]' && localStorage.getItem('ProdutoSelecionadoPP') != null) {
      const ArraySelecionadoPP = JSON.parse(localStorage.getItem('ProdutoSelecionadoPP'));

      for (const item of ArraySelecionadoPP) {
        const elemento = await waitForElementApagarPP(item);
        elemento.innerHTML = 'Selecionar Produto';
      }
    }
  }
}

async function waitForElement(elementId, timeout = 1000) {
  return new Promise((resolve) => {
    const startTime = Date.now();

    const checkElement = () => {
      const element = document.getElementById(elementId);
      if (element) {
        resolve(element);
        document.getElementById('ErroSelecionar').innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso, Produto foi Selecioando FOI RECUPERADO!<br> Verifique a aba "Novo Produto".</div></div>';
      } else {
        const elapsedTime = Date.now() - startTime;
        if (elapsedTime >= timeout) {
          resolve(null);
        } else {
          document.getElementById('ErroSelecionar').innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Você tem um produto Selecionado!</div></div>';
          setTimeout(checkElement, 100);
        }
      }
    };

    checkElement();
  });
}

async function waitForElementSelecionado(elementId, timeout = 1000) {
  return new Promise((resolve) => {
    const startTime = Date.now();

    const checkElement = () => {
      const element = document.getElementById(elementId);
      if (element) {
        resolve(element);
        document.getElementById('ErroSelecionar').innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso, Produto foi Selecioando FOI RECUPERADO!<br> Verifique a aba "Novo Produto".</div></div>';
      } else {
        const elapsedTime = Date.now() - startTime;
        if (elapsedTime >= timeout) {
          resolve(null);
        } else {
          document.getElementById('ErroSelecionar').innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">VOCÊ TEM UM PRODUTO Selecionado!<br> Verifique a aba "Novo Produto </div></div>';
          setTimeout(checkElement, 100);
        }
      }
    };

    checkElement();
  });
}

async function SelecionarProdutoSelecioando() {
  if (document.getElementById('produtosTableBody')) {
    setTimeout(function () {
      document.getElementById('ErroSelecionar').innerHTML = '';
    }, 5000);
    if (localStorage.getItem('ProdutoSelecionadoPP') != '[]' && localStorage.getItem('ProdutoSelecionadoPP') != null) {
      const ArraySelecionadoPP = JSON.parse(localStorage.getItem('ProdutoSelecionadoPP'));

      for (const item of ArraySelecionadoPP) {
        const elemento = await waitForElement(item);
        elemento.innerHTML = 'Selecioando';
      }
    }
  }
}

// PRODUTO A PRONTA ENTREGA = PE
async function waitForElementPE(elementId, timeout = 1000) {
  return new Promise((resolve) => {
    const startTime = Date.now();

    const checkElement = () => {
      const element = document.getElementById(elementId);
      if (element) {
        resolve(element);
        document.getElementById('ErroSelecionar').innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso, Produto foi Selecioando FOI RECUPERADO!<br> Verifique a aba "Novo Produto".</div></div>';
      } else {
        const elapsedTime = Date.now() - startTime;
        if (elapsedTime >= timeout) {
          resolve(null);
        } else {
          document.getElementById('ErroSelecionar').innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">VOCÊ TEM UM PRODUTO Selecioando!<br> Verifique a aba "Novo Produto </div></div>';
          setTimeout(checkElement, 100);
        }
      }
    };

    checkElement();
  });
}

async function SelecionarSelecioandoPE() {
  document.getElementById('load1').style.display = 'flex';
  if (document.getElementById('produtosTableBody')) {
    
    setTimeout(function () {
      document.getElementById('ErroSelecionar').innerHTML = '';
      document.getElementById('load1').style.display = 'none';
    }, 5000);
    if (localStorage.getItem('ProdutoSelecionadoPE') != null && localStorage.getItem('ProdutoSelecionadoPE') != '[]') {
      const ArraySelecionado = JSON.parse(localStorage.getItem('ProdutoSelecionadoPE'));

      for (const item of ArraySelecionado) {
        const elemento = await waitForElementPE(item);
        if(elemento){
          elemento.innerHTML = 'Selecioando';
        }
      }
      document.getElementById('load1').style.display = 'none';
    }
  }
}

// FUNÇÕES GERAIS QUE COMANDAM TODAS AS ACIMA
if(localStorage.getItem('ProdutoSelecionadoPE') != null && localStorage.getItem('ProdutoSelecionadoPE') != '[]'){
  SelecionarSelecioandoPE();
}

if (localStorage.getItem('ProdutoSelecionadoPP') != '[]' && localStorage.getItem('ProdutoSelecionadoPP') != null) {
  SelecionarSelecioando();
}

function ApagarProdutoSelecioando() {
  document.getElementById('load1').style.display = 'flex';
  // Defina o nome do item que você deseja remover
  SelecionarSelecioandoApagarPP();
  // Remova o item do localStorage
  localStorage.removeItem('ProdutoSelecionadoPP');
  localStorage.removeItem('ProdutoSelecionadoPE');
  document.getElementById('ApagarProdutoSelecioando').innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Seleção de produto Selecioando Limpa</div></div>';
  ApagarPapel('papelSelecionado');
  ApagarAcabamento('AcabamentoSelecionado');
  setTimeout(function () {
    document.getElementById('ApagarProdutoSelecioando').innerHTML = '';
    window.location.reload(true);
      document.getElementById('load1').style.display = 'none';
  }, 1000);
}

function SelecionarProduto(valor) {
  document.getElementById('load1').style.display = 'flex';
  const PP = document.getElementById('ppRadio');
   let ativo = PP.checked ? true : false;
  let selecionado = document.getElementById(valor);
  let ProdutoSelecionadoPE = localStorage.getItem('ProdutoSelecionadoPE');
  let arraySelecioandos = ProdutoSelecionadoPE ? JSON.parse(ProdutoSelecionadoPE) : [];
  let ProdutoSelecionadoPP = localStorage.getItem('ProdutoSelecionadoPP');
  let arraySelecioandosPP = ProdutoSelecionadoPP ? JSON.parse(ProdutoSelecionadoPP) : [];
  
  if (document.getElementById(valor).innerHTML == 'Selecioando') {
    document.getElementById('SelecioandoProduto').innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Desmarcado. Produto que estava Selecioando!</div></div>';
    if (ativo) {
      arraySelecioandosPP = arraySelecioandosPP.filter(id => id !== selecionado.id);
    }else{
      ProdutoSelecionadoPE = ProdutoSelecionadoPE.filter(id => id !== selecionado.id);
    }
    document.getElementById(valor).innerHTML = 'Selecionar Produto'
  } else {
    document.getElementById('SelecioandoProduto').innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso, Produto foi Selecioando!<br> Verifique a aba "Novo Produto".</div></div>';
    if (ativo) {
      arraySelecioandosPP.push(selecionado.id);
    } else {
      arraySelecioandos.push(selecionado.id);
    }
    // Usa o método scrollIntoView para rolar até o elemento
   
    document.getElementById(valor).innerHTML = 'Selecioando'
  }
  
  localStorage.setItem('ProdutoSelecionadoPE', JSON.stringify(arraySelecioandos));
  localStorage.setItem('ProdutoSelecionadoPP', JSON.stringify(arraySelecioandosPP));
  setTimeout(function () {
    document.getElementById('SelecioandoProduto').innerHTML = '';
    window.location.reload(true);
  }, 1500);
}

async function SelecionarSelecioando() {
  document.getElementById('load1').style.display = 'flex';
  if (document.getElementById('produtosTableBody')) {
    setTimeout(function () {
      document.getElementById('ErroSelecionar').innerHTML = '';
      document.getElementById('load1').style.display = 'none';
    }, 5000);
    if (localStorage.getItem('ProdutoSelecionadoPP') != '[]' && localStorage.getItem('ProdutoSelecionadoPP') != null ) {
      const ArraySelecionadoPP = JSON.parse(localStorage.getItem('ProdutoSelecionadoPP'));

      for (const item of ArraySelecionadoPP) {
        const elemento = await waitForElement(item);
          elemento.innerHTML = 'Selecioando';
      }
      document.getElementById('load1').style.display = 'none';
    }
  }
}

function RecuperaProdutoSelecionado() {
  let codigo_do_produto = [];
  let codigo_do_acabado = [];
  if (localStorage.getItem('AcabamentoSelecionado')) {
    ApagarAcabamento('AcabamentoSelecionado');
  }
  if (localStorage.getItem('papelSelecionado')) {
    
    ApagarPapel('papelSelecionado');
  }
  
  
     
      let produto = '';
      let tipo = '';
      if (localStorage.getItem('ProdutoSelecionadoPP') != '[]' && localStorage.getItem('ProdutoSelecionadoPP') != null) {
        produto = 'ProdutoSelecionadoPP';
        tipo = 'PP';
      } else {
        tipo = 'PE';
        produto = 'ProdutoSelecionadoPE';
      }
         tableBody = document.getElementById('tabela_campos');
         tableBody.innerHTML = '';
         tableBody.innerHTML += `
      <thead>
      <tr>
      <th>CÓDIGO PRODUTO</th>
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
    </thead>`;
   
    document.getElementById('load1').style.display = 'flex';
  
      let produtoSelecionado = localStorage.getItem(produto);
      let arraySelecionados = produtoSelecionado ? JSON.parse(produtoSelecionado) : [];
     
      let promises = arraySelecionados.map(id => {
        const ids = Number(id.replace('Produto', ''))
        console.log('api_produto_select.php?id=' + ids + '&tipo=' + tipo);
        return fetch('api_produto_select.php?id=' + ids + '&tipo=' + tipo)
          .then(response => response.json())
          .then(data => {

            if(data[1] == 'erro'){
             ApagarProdutoSelecioando();
            }
            let campo = {};
          
            if(data.TIPO){
              campo.TIPO_PRODUTO = `<input class="form-control2" type="hidden" id="TIPO_PRODUTO" name="${tipo}" value="${data.TIPO}">`;
            }
            if (data.CODIGO) {
              campo.CODIGO = data.CODIGO;
            }
            if (data.unitario) {
              campo.unitario = data.unitario;
            }
            
            if (data.DESCRICAO) {
              campo.DESCRICAO = data.DESCRICAO;
            }
            if (data.LARGURA) {
              campo.LARGURA = data.LARGURA;
              document.getElementById('NovoNovolargura').value = data.LARGURA;
            }
            if(data.tipo_papel){
              campo.tipo_papel = data.tipo_papel;
            }
            if (data.quantidade) {
              campo.quantidade = `<input class="form-control2" type="number" id="quantidade" name="quantidade" value="0">`;
            }
           
            if (data.CODIGO) {
              
              campo.cod_produto = `<input  class="form-control2 " readonly type="number" name="data.cod_produto" id="data.cod_produto${data.CODIGO}" value="${data.CODIGO}"></input>`;
            }
            if (data.observacao_produto) {
              campo.observacao_produto = data.observacao_produto;
            }
            if (data.preco_unitario) {
              campo.preco_unitario = `<input class="form-control2" type="number" name="preco_unitario" id="preco_unitario${data.CODIGO}" value="${data.preco_unitario}">`;
            }
            if (data.valor_digital) {
              campo.valor_digital = `<input class="form-control2" type="number" name="valor_digital" id="valor_digital${data.CODIGO}" value="${data.valor_digital}">`;
            }
            if (data.tipo_trabalho) {
              campo.tipo_trabalho = data.tipo_trabalho;
            }
            if (data.maquina) {
              if(data.maquina == 1){
                campo.digital = `<input class="form-check-input" id="campo${data.CODIGO}" type="checkbox" value="1" checked name="digital">`;
                campo.offset = `<input class="form-check-input" id="campo${data.CODIGO}" type="checkbox" value="2" name="offset">`;
              }else{
                campo.digital = `<input class="form-check-input" id="campo${data.CODIGO}" type="checkbox" value="1" name="digital">`;
                campo.offset = `<input class="form-check-input" id="campo${data.CODIGO}" type="checkbox" value="2" checked name="offset">`;
              }
              
            }
            if (data.ESPESSURA) {
              campo.ESPESSURA = data.ESPESSURA;
            }
            if (data.PESO) {
              campo.PESO = data.PESO;
            }
            if (data.QTD_PAGINAS) {
              campo.QTD_PAGINAS = data.QTD_PAGINAS;
            }
            if (data.TIPO) {
              campo.TIPO = data.TIPO;
            }
       
            if (data.ATIVO) {
              campo.ATIVO = data.ATIVO;
            }
           
            if (data.PRECO_CUSTO) {
              campo.PRECO_CUSTO = data.PRECO_CUSTO;
            }
         
            if (data.cod_acabamentos) {
              campo.cod_acabamentos = data.cod_acabamentos;
            }
            if (data.cod_acabamentos) {
              campo.cod_AC = {
                cod_acaba: data.cod_acabamentos,
                codigoPP: data.cod_produto
              };
            }
            if (data.cod_papels) {
              campo.cod_PP = {
                cod_PLS: data.cod_papels,
                codigoPP: data.cod_produto
              };
            }
            if (data.cod_papels) {
              campo.cod_papels = data.cod_papels;  
            }
          
            if (data.ALTURA) {
              campo.ALTURA = data.ALTURA;
            }
            if (data.cod_produto_papel) {
              campo.cod_produto_papel = data.cod_produto_papel;
            }
        

            if (data.cod_papels) {
              data.cod_papels.forEach(valor => {
              var inputElementPapel = document.createElement("input");
              // Definindo o ID, valor e tipo do input
              inputElementPapel.id = valor;
              inputElementPapel.value = valor;
              inputElementPapel.type = "hidden";
              // Adicionando o input ao corpo do documento (body)
              document.body.appendChild(inputElementPapel);
                // Acessando o elemento pelo ID após um pequeno atraso
              setTimeout(function () {
                var elemento = document.getElementById(valor);
                adicionarPapelDoClone(valor, ids);
              }, 100);
              })
            }
            if (data.cod_acabamentos) {
              data.cod_acabamentos.forEach(valor => {
                var inputElementAcabamento = document.createElement("input");
                inputElementAcabamento.id = valor;
                inputElementAcabamento.value = valor;
                inputElementAcabamento.type = "hidden";

                // Adicionando o input ao corpo do documento (body)
                document.body.appendChild(inputElementAcabamento);

                // Acessando o elemento pelo ID após um pequeno atraso
                setTimeout(function () {
                  var elemento = document.getElementById(valor);
                  adicionarAcabamentoDoClone(valor, ids);
                }, 100);

              })

            }
            return campo;
          });
          
      });
      Promise.all(promises).then(campos => {
        const tableProduto = document.getElementById('SelecionadoProudutosProduto');
        tableProduto.innerHTML = '';
        tableProduto.innerHTML += `
            <thead>
              <tr>
              <th>CÓDIGO PRODUTO</th>
              <th>DESCRIÇÃO</th>
              <th>LARGURA</th>
              <th>ALTURA</th>
              <th>QTD.PÁGINAS</th>
              </tr>
          </thead>`;
        if (!promises || promises.length === 0) {
          tableProduto.innerHTML += `
            <tr>
            <td align="center" colspan="5">
              NENHUM SELECIONADO
            </td>
          </tr>`;
        }
        const tableTiragens = document.getElementById('ProdutoTIragens');
        tableTiragens.innerHTML = '';
        tableTiragens.innerHTML += `
            <thead>
              <tr>
              <th>CÓDIGO PRODUTO</th>
                          <th>QUANTIDADE</th>
                          <th>DIGITAL</th>
                          <th>OFFSET</th>
                          <th>VALOR IMPRESSÃO DIGITAL</th>
                          <th>VALOR UNITÁRIO | INSERIR MANUALMENTE <input type="checkbox" id="ValorManual" class="form-check-input"></th>
              </tr>
          </thead>`;
        if (!promises || promises.length === 0) {
          tableTiragens.innerHTML += `
            <tr>
            <td align="center" colspan="7">
              NENHUM SELECIONADO
            </td>
          </tr>`;
        }
        
        campos.forEach(campo => {
          
            if(campo.cod_produto){
              codigo_do_produto.push(campo.cod_PP);   
              codigo_do_acabado.push(campo.cod_AC)
            }
          tableProduto.innerHTML += `
          <tr>
            <td>${campo.cod_produto}</td>
            <td>${campo.DESCRICAO}</td>
            <td>${campo.LARGURA}</td>
            <td>${campo.ALTURA}</td>
            <td>${campo.QTD_PAGINAS}</td>
          </tr>`;
          tableTiragens.innerHTML += `
          <tr>
            <td>${campo.cod_produto}</td>
            <td>${campo.quantidade}${campo.TIPO_PRODUTO}</td>
            <td>${campo.digital}</td>
            <td>${campo.offset}</td>
            <td>${campo.valor_digital}</td>
            <td>${campo.preco_unitario}</td>
          </tr>`;
        
        });
       
    
        setTimeout(function () {
          recuperarNomesPapel('tabela_campos', codigo_do_produto );
        recuperarNomesAcabamento('seleccionadoacabamentos', codigo_do_acabado);
        document.getElementById('load1').style.display = 'none';
        }, 1000);
        
        
      });
}

// Editar
function SelecionarProdutoParaEditar(valor, Tipo) {
  document.getElementById('load1').style.display = 'flex';
  
   let tipo = Tipo;
  let selecionado = 'Produto'+valor;
  let ProdutoSelecionadoPE = localStorage.getItem('ProdutoSelecionadoPE');
  let arraySelecioandos = ProdutoSelecionadoPE ? JSON.parse(ProdutoSelecionadoPE) : [];
  let ProdutoSelecionadoPP = localStorage.getItem('ProdutoSelecionadoPP');
  let arraySelecioandosPP = ProdutoSelecionadoPP ? JSON.parse(ProdutoSelecionadoPP) : [];
    
    if (tipo === 1) {
      arraySelecioandosPP.push(selecionado);
    } else {
      arraySelecioandos.push(selecionado);
    }
  
  localStorage.setItem('ProdutoSelecionadoPE', JSON.stringify(arraySelecioandos));
  localStorage.setItem('ProdutoSelecionadoPP', JSON.stringify(arraySelecioandosPP));
  setTimeout(function () {
    window.location.reload(true);
  }, 1500);
}
function ProdutosEditar(){
  let Produto = document.getElementById('ProdutosEditarem').value;
  let Produtos = Produto.split(',');
  Produtos.forEach(function(codigo, index) {
    let Tipo = document.getElementById('TipoProdutosEditarem').value;
    if(index === 1){
    //  SelecionarProdutoParaEditar(codigo, Tipo); 
    }
});
}

if(document.getElementById('ProdutosEditarem')){
  ProdutosEditar();
}