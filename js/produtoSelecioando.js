// PRODUTO PARA PRODUÇÃO = PP
if(localStorage.getItem('ProdutoSelecionadoPP') != null && localStorage.getItem('ProdutoSelecionadoPP') != '[]'){
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
    if (localStorage.getItem('ProdutoSelecioando') != null && localStorage.getItem('ProdutoSelecioando') != '[]') {
      const ArraySelecionado = JSON.parse(localStorage.getItem('ProdutoSelecioando'));

      for (const item of ArraySelecionado) {
        const elemento = await waitForElementPE(item);
        elemento.innerHTML = 'Selecioando';
      }
      document.getElementById('load1').style.display = 'none';
    }
  }
}

// FUNÇÕES GERAIS QUE COMANDAM TODAS AS ACIMA
if(localStorage.getItem('ProdutoSelecioando') != null && localStorage.getItem('ProdutoSelecioando') != '[]'){
  RecuperaProdutoSelecionado();
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
  localStorage.removeItem('ProdutoSelecioando');
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
  let ProdutoSelecioando = localStorage.getItem('ProdutoSelecioando');
  let arraySelecioandos = ProdutoSelecioando ? JSON.parse(ProdutoSelecioando) : [];
  let ProdutoSelecionadoPP = localStorage.getItem('ProdutoSelecionadoPP');
  let arraySelecioandosPP = ProdutoSelecionadoPP ? JSON.parse(ProdutoSelecionadoPP) : [];
  const SelecionadoProdutoSelecioando = Number(document.getElementById(valor).name.
    replace('Produto', ''))
  if (document.getElementById(valor).innerHTML == 'Selecioando') {
    document.getElementById('SelecioandoProduto').innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Desmarcado. Produto que estava Selecioando!</div></div>';
    if (ativo) {
      arraySelecioandosPP = arraySelecioandosPP.filter(id => id !== selecionado.id);
    }else{
      ProdutoSelecioando = ProdutoSelecioando.filter(id => id !== selecionado.id);
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
  
  localStorage.setItem('ProdutoSelecioando', JSON.stringify(arraySelecioandos));
  localStorage.setItem('ProdutoSelecionadoPP', JSON.stringify(arraySelecioandosPP));
  setTimeout(function () {
    document.getElementById('SelecioandoProduto').innerHTML = '';
    window.location.reload(true);
  }, 1500);
}

async function SelecionarSelecioando() {
  if (document.getElementById('produtosTableBody')) {
    setTimeout(function () {
      document.getElementById('ErroSelecionar').innerHTML = '';
      document.getElementById('load1').style.display = 'none';
    }, 5000);
    if (localStorage.getItem('ProdutoSelecionadoPP') != '[]' && localStorage.getItem('ProdutoSelecionadoPP') != null) {
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
        produto = 'ProdutoSelecioando';
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
        return fetch('api_produto_select.php?id=' + ids + '&tipo=' + tipo)
          .then(response => response.json())
          .then(data => {

            if(data[1] == 'erro'){
             ApagarProdutoSelecioando();
            }
            let campo = {};
            if (data.cod_calculo) {
              campo.cod_calculo = data.cod_calculo;
            }
            if(data.tipo_produto_papel){
              campo.TIPO_PRODUTO = `<input class="form-control" type="hidden" id="TIPO_PRODUTO" name="TIPO_PRODUTO" value="${data.tipo_produto_papel}">`;
            }
            if (data.CODIGO) {
              campo.CODIGO = data.CODIGO;
            }
            if (data.unitario) {
              campo.unitario = data.unitario;
            }
            if (data.CODIGO_LI) {
              campo.CODIGO_LI = data.CODIGO_LI;
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
              campo.quantidade = `<input class="form-control" type="number" id="quantidade" name="quantidade" value="${data.quantidade}">`;
            }
            if (data.descrisaozinha_prod) {
              campo.descrisaozinha_prod = data.descrisaozinha_prod;
            }
            if (data.cod_produto) {
              
              campo.cod_produto = data.cod_produto;
            }
            if (data.observacao_produto) {
              campo.observacao_produto = data.observacao_produto;
            }
            if (data.preco_unitario) {
              campo.preco_unitario = `<input class="form-control" type="number" name="preco_unitario" id="preco_unitario" value="${data.preco_unitario}">`;
            }
            if (data.valor_digital) {
              campo.valor_digital = `<input class="form-control" type="number" name="valor_digital" id="valor_digital" value="${data.valor_digital}">`;
            }
            if (data.tipo_trabalho) {
              campo.tipo_trabalho = data.tipo_trabalho;
            }
            if (data.maquina) {
              if(data.maquina == 1){
                campo.digital = `<input class="form-check-input" type="checkbox" value="1" checked name="digital">`;
                campo.offset = `<input class="form-check-input" type="checkbox" value="2" name="offset">`;
              }else{
                campo.digital = `<input class="form-check-input" type="checkbox" value="1" name="digital">`;
                campo.offset = `<input class="form-check-input" type="checkbox" value="2" checked name="offset">`;
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
            
            if (data.VENDAS) {
              campo.VENDAS = data.VENDAS;
            }
            if (data.ATIVO) {
              campo.ATIVO = data.ATIVO;
            }
            if (data.USO_ECOMMERCE) {
              campo.USO_ECOMMERCE = data.USO_ECOMMERCE;
            }
            if (data.PRECO_CUSTO) {
              campo.PRECO_CUSTO = data.PRECO_CUSTO;
            }
            if (data.PROMOCIONAL) {
              campo.PROMOCIONAL = data.PROMOCIONAL;
            }
            if (data.PRECO_PROMOCIONAL) {
              campo.PRECO_PROMOCIONAL = data.PRECO_PROMOCIONAL;
            }
            if (data.ID_CATEGORIA) {
              campo.ID_CATEGORIA = data.ID_CATEGORIA;
            }
            if (data.cod_acabamentos) {
              campo.cod_acabamentos = data.cod_acabamentos;
            }
            if (data.cod_papels) {
              campo.cod_papels = data.cod_papels;
            }
            if (data.PRE_VENDA) {
              campo.PRE_VENDA = data.PRE_VENDA;
            }
            if (data.ALTURA) {
              campo.ALTURA = data.ALTURA;
            }
            if (data.cod_produto_papel) {
              campo.cod_produto_papel = data.cod_produto_papel;
            }
            if (data.PROM) {
              campo.PROM = data.PROM;
            }
            if (data.VLR_PROM) {
              campo.VLR_PROM = data.VLR_PROM;
            }
            if (data.INICIO_PROM) {
              campo.INICIO_PROM = data.INICIO_PROM;
            }
            if (data.FIM_PROM) {
              campo.FIM_PROM = data.FIM_PROM;
            }
            if (data.ESTOQUE) {
              campo.ESTOQUE = data.ESTOQUE;
            }
            if (data.AVISO_ESTOQUE) {
              campo.AVISO_ESTOQUE = data.AVISO_ESTOQUE;
            }
            if (data.AVISO_ESTOQUE_UN) {
              campo.AVISO_ESTOQUE_UN = data.AVISO_ESTOQUE_UN;
            }
            if (data.VLR_UNIT) {
              campo.VLR_UNIT = data.VLR_UNIT;
            }
            if (data.ULT_MOV) {
              campo.ULT_MOV = data.ULT_MOV;
            }
            if (data.PD_QTD_MIN) {
              campo.PD_QTD_MIN = data.PD_QTD_MIN;
            }
            if (data.PD_MAX) {
              campo.PD_MAX = data.PD_MAX;
            }
            if (data.PD_QTD_MAX) {
              campo.PD_QTD_MAX = data.PD_QTD_MAX;
            }

            if (data.cod_papels) {
              data.cod_papels.forEach(valor => {
              var inputElementPapel = document.createElement("input");
              // Definindo o ID, valor e tipo do input
              inputElementPapel.id = valor;
              inputElementPapel.value = valor;
              // Adicionando o input ao corpo do documento (body)
              document.body.appendChild(inputElementPapel);
                // Acessando o elemento pelo ID após um pequeno atraso
              setTimeout(function () {
                var elemento = document.getElementById(valor);
                adicionarPapelDoClone(valor);
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
                  adicionarAcabamentoDoClone(valor);
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
              <th>CÓDIGO</th>
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
              <th>PRODUTO</th>
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
           codigo_do_produto.push(campo.cod_produto);
              
           
           
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
          recuperarNomesPapel('1', codigo_do_produto);
        recuperarNomesAcabamento('seleccionadoacabamentos');
        document.getElementById('load1').style.display = 'none';
        }, 1000);
        
        
      });
}

