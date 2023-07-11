function RecuperaPapapelClonado() {
  if (localStorage.getItem('AcabamentoSelecionado')) {
    ApagarAcabamento('AcabamentoSelecionado');
  }
  if (localStorage.getItem('papelSelecionado')) {
    ApagarPapel('papelSelecionado');
  }
  if (localStorage.getItem('ProdutoClonadoPP') != '[]' || localStorage.getItem('ProdutoClonado') != '[]') {
    if (localStorage.getItem('ProdutoClonadoPP') != null || localStorage.getItem('ProdutoClonado') != null) {

      document.getElementById('load').style.display = 'flex';
      let produto = '';
      let tipo = '';
      if (localStorage.getItem('ProdutoClonadoPP') != '[]' && localStorage.getItem('ProdutoClonadoPP') != null) {
        produto = 'ProdutoClonadoPP';
        tipo = 'PP';
      } else {
        tipo = 'PE';
        produto = 'ProdutoClonado';
      }
      let produtoSelecionado = localStorage.getItem(produto);
      let arraySelecionados = produtoSelecionado ? JSON.parse(produtoSelecionado) : [];
      let promises = arraySelecionados.map(id => {
        const ids = Number(id.
          replace('ProdutoClone', ''))
        return fetch('api_produto_select.php?id=' + ids + '&tipo=' + tipo)
          .then(response => response.json())
          .then(data => {
            console.log(data);
            if(data[1] == 'erro'){
             ApagarProdutoCloando();
            }
            let campo = {};
            if (data.cod_calculo) {
              campo.cod_calculo = data.cod_calculo;
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
            if (data.ALTURA) {
              campo.ALTURA = data.ALTURA;
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
            if (data.cod_papel) {
              campo.cod_papel = data.cod_papel;
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
            if (data.PRE_VENDA) {
              campo.PRE_VENDA = data.PRE_VENDA;
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

            if (data.cod_papel != null) {

              var inputElementPapel = document.createElement("input");

              // Definindo o ID, valor e tipo do input
              inputElementPapel.id = data.cod_papel;
              inputElementPapel.type = "hidden";
              inputElementPapel.value = data.cod_papel;

              // Adicionando o input ao corpo do documento (body)
              document.body.appendChild(inputElementPapel);

              setTimeout(function () {
                var elemento = document.getElementById(data.cod_papel);
                adicionarPapelDoClone(data.cod_papel);
              }, 100);

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
        campos.forEach(campo => {
          if (campo.cod_calculo) {
            if (document.getElementById('Novocod_calculo')) {
              document.getElementById('Novocod_calculo').value = campo.cod_calculo;
            }
          }
          if(tipo == 'PP'){
            document.getElementById('NovoPP').checked = true;
          }else{
            document.getElementById('NovoPE').checked = true;
          }
          if (campo.CODIGO) {
            if (document.getElementById('NovoCODIGO')) {
              document.getElementById('NovoCODIGO').value = campo.CODIGO;
            }
          }
          if (campo.CODIGO_LI) {
            if (document.getElementById('NovoCODIGO_LI')) {
              document.getElementById('NovoCODIGO_LI').value = campo.CODIGO_LI;
            }
          }
          if (campo.DESCRICAO) {
            if (document.getElementById('Novodescricao')) {
              document.getElementById('Novodescricao').value = campo.DESCRICAO;
            }
          }
          if (campo.LARGURA) {
            if (document.getElementById('NovoNovolargura')) {
              document.getElementById('NovoNovolargura').value = campo.LARGURA;
            }
          }
          if (campo.unitario) {
            if (document.getElementById('valorunitario')) {
              document.getElementById('valorunitario').value = campo.unitario;
            }
          }
          if (campo.ALTURA) {
            if (document.getElementById('Novoaltura')) {
              document.getElementById('Novoaltura').value = campo.ALTURA;
            }
          }
          if (campo.ESPESSURA) {
            if (document.getElementById('Novoespessura')) {
              document.getElementById('Novoespessura').value = campo.ESPESSURA;
            }
          }
          if (campo.PESO) {
            if (document.getElementById('Novopeso')) {
              document.getElementById('Novopeso').value = campo.PESO;
            }
          }
          if (campo.QTD_PAGINAS) {
            if (document.getElementById('Novoqtdfolhas')) {
              document.getElementById('Novoqtdfolhas').value = campo.QTD_PAGINAS;
            }
          }
          if (campo.TIPO) {
            if (document.getElementById('NovotipoProduto')) {
              document.getElementById('NovotipoProduto').value = campo.TIPO;
            }
          }
          if (campo.VENDAS) {
            if (document.getElementById('Novovendas')) {
              document.getElementById('Novovendas').value = campo.VENDAS;
            }
          }
          if (campo.ATIVO) {
            if (document.getElementById('NovoTipoativo')) {
              document.getElementById('NovoTipoativo').checked = campo.ATIVO;
            }
          }
          if (campo.USO_ECOMMERCE) {
            if (document.getElementById('NovoTipoCommerce')) {
              document.getElementById('NovoTipoCommerce').checked = campo.USO_ECOMMERCE;
            }
          }
          if (campo.PRECO_CUSTO) {
            if (document.getElementById('NovoPrecoCusto')) {
              document.getElementById('NovoPrecoCusto').value = campo.PRECO_CUSTO;
            }
          }
          if (campo.PROMOCIONAL) {
            if (document.getElementById('valorpromo')) {
              document.getElementById('promo').checked = true;
              document.getElementById('valorpromo').value = campo.PROMOCIONAL;
            }
          }
          if (campo.PRECO_PROMOCIONAL) {
            if (document.getElementById('NovoPrecoPromocional')) {
              document.getElementById('NovoPrecoPromocional').value = campo.PRECO_PROMOCIONAL;
            }
          }
          if (campo.ID_CATEGORIA) {
            if (document.getElementById('NovoIdCategoria')) {
              document.getElementById('NovoIdCategoria').value = campo.ID_CATEGORIA;
            }
          }
          if (campo.PRE_VENDA) {
            if (document.getElementById('NovoTipoPreVenda')) {
              document.getElementById('NovoTipoPreVenda').checked = campo.PRE_VENDA;
            }
          }
          if (campo.PROM) {
            if (document.getElementById('NovoProm')) {
              document.getElementById('NovoProm').value = campo.PROM;
            }
          }
          if (campo.VLR_PROM) {
            if (document.getElementById('NovoVlrProm')) {
              document.getElementById('NovoVlrProm').value = campo.VLR_PROM;
            }
          }
          if (campo.INICIO_PROM) {
            if (document.getElementById('NovoInicioProm')) {
              document.getElementById('NovoInicioProm').value = campo.INICIO_PROM;
            }
          }
          if (campo.FIM_PROM) {
            if (document.getElementById('NovoFimProm')) {
              document.getElementById('NovoFimProm').value = campo.FIM_PROM;
            }
          }
          if (campo.ESTOQUE) {
            if (document.getElementById('NovoEstoque')) {
              document.getElementById('NovoEstoque').value = campo.ESTOQUE;
            }
          }
          if (campo.AVISO_ESTOQUE) {
            if (document.getElementById('NovoAvisoEstoque')) {
              document.getElementById('NovoAvisoEstoque').checked = campo.AVISO_ESTOQUE;
            }
          }
          if (campo.AVISO_ESTOQUE_UN) {
            if (document.getElementById('NovoAvisoEstoqueUn')) {
              document.getElementById('NovoAvisoEstoqueUn').value = campo.AVISO_ESTOQUE_UN;
            }
          }
          if (campo.VLR_UNIT) {
            if (document.getElementById('NovoVlrUnit')) {
              document.getElementById('NovoVlrUnit').value = campo.VLR_UNIT;
            }
          }
          if (campo.ULT_MOV) {
            if (document.getElementById('NovoUltMov')) {
              document.getElementById('NovoUltMov').value = campo.ULT_MOV;
            }
          }
          if (campo.PD_QTD_MIN) {
            if (document.getElementById('NovoPdQtdMin')) {
              document.getElementById('NovoPdQtdMin').value = campo.PD_QTD_MIN;
            }
          }
          if (campo.PD_MAX) {
            if (document.getElementById('NovoPdMax')) {
              document.getElementById('NovoPdMax').value = campo.PD_MAX;
            }
          }
          if (campo.PD_QTD_MAX) {
            if (document.getElementById('NovoPdQtdMax')) {
              document.getElementById('NovoPdQtdMax').value = campo.PD_QTD_MAX;
            }
          }
          document.getElementById('load').style.display = 'none';
        });
      });
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
          document.getElementById('ErroClonar').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso, Produto foi clonado FOI RECUPERADO!<br> Verifique a aba "Novo Produto".</div></div>';
        } else {
          const elapsedTime = Date.now() - startTime;
          if (elapsedTime >= timeout) {
            resolve(null);
          } else {
            document.getElementById('ErroClonar').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">VOCÊ TEM UM PRODUTO CLONADO!<br> Verifique a aba "Novo Produto </div></div>';
            setTimeout(checkElement, 100);
          }
        }
      };

      checkElement();
    });
  }

  async function SelecionarClonado() {
    if (document.getElementById('produtosTableBody')) {
      setTimeout(function () {
        document.getElementById('ErroClonar').innerHTML = '';
      }, 5000);
      if (localStorage.getItem('ProdutoClonadoPP') != '[]' && localStorage.getItem('ProdutoClonadoPP') != null) {
        const ArrayClonePP = JSON.parse(localStorage.getItem('ProdutoClonadoPP'));

        for (const item of ArrayClonePP) {
          const elemento = await waitForElement(item);
          elemento.innerHTML = 'CLONADO';
        }
        for (const item of ArrayClonePP) {
          const elemento = await waitCampos(item);

        }
      }
    }
  }
  async function waitForElementSelecionado(elementId, timeout = 1000) {
    return new Promise((resolve) => {
      const startTime = Date.now();

      const checkElement = () => {
        const element = document.getElementById(elementId);
        if (element) {
          resolve(element);
          document.getElementById('ErroClonar').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso, Produto foi clonado FOI RECUPERADO!<br> Verifique a aba "Novo Produto".</div></div>';
        } else {
          const elapsedTime = Date.now() - startTime;
          if (elapsedTime >= timeout) {
            resolve(null);
          } else {
            document.getElementById('ErroClonar').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">VOCÊ TEM UM PRODUTO CLONADO!<br> Verifique a aba "Novo Produto </div></div>';
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
        document.getElementById('ErroClonar').innerHTML = '';
      }, 5000);
      if (localStorage.getItem('ProdutoClonadoPP') != '[]' && localStorage.getItem('ProdutoClonadoPP') != null) {
        const ArrayClonePP = JSON.parse(localStorage.getItem('ProdutoClonadoPP'));

        for (const item of ArrayClonePP) {
          const elemento = await waitForElement(item);
          elemento.innerHTML = 'CLONADO';
        }
      }
    }
  }
  if (localStorage.getItem('ProdutoClonadoPP') != '[]' && localStorage.getItem('ProdutoClonadoPP') != null) {
    SelecionarClonado();
  }
  async function waitForElementPE(elementId, timeout = 1000) {
    return new Promise((resolve) => {
      const startTime = Date.now();

      const checkElement = () => {
        const element = document.getElementById(elementId);
        if (element) {
          resolve(element);
          document.getElementById('ErroClonar').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso, Produto foi clonado FOI RECUPERADO!<br> Verifique a aba "Novo Produto".</div></div>';
        } else {
          const elapsedTime = Date.now() - startTime;
          if (elapsedTime >= timeout) {
            resolve(null);
          } else {
            document.getElementById('ErroClonar').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">VOCÊ TEM UM PRODUTO CLONADO!<br> Verifique a aba "Novo Produto </div></div>';
            setTimeout(checkElement, 100);
          }
        }
      };

      checkElement();
    });
  }

  async function SelecionarClonadoPE() {
    if (document.getElementById('produtosTableBody')) {

      setTimeout(function () {
        document.getElementById('ErroClonar').innerHTML = '';
      }, 5000);
      if (localStorage.getItem('ProdutoClonado') != '[]' && localStorage.getItem('ProdutoClonado') != null) {
        const ArrayClone = JSON.parse(localStorage.getItem('ProdutoClonado'));


        for (const item of ArrayClone) {
          const elemento = await waitForElementPE(item);
          elemento.innerHTML = 'CLONADO';
        }
      }
    }
  }

  async function ativarRecuperacao() {

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

  async function SelecionarClonadoApagarPP() {
    if (document.getElementById('produtosTableBody')) {
      if (localStorage.getItem('ProdutoClonadoPP') != '[]' && localStorage.getItem('ProdutoClonadoPP') != null ) {
        const ArrayClonePP = JSON.parse(localStorage.getItem('ProdutoClonadoPP'));

        for (const item of ArrayClonePP) {
          const elemento = await waitForElementApagarPP(item);
          if(document.getElementById(elemento)){
            elemento.innerHTML = 'CLONAR PRODUTO';
          }
        }
      }
    }
  }

  function ApagarProdutoCloando() {
    document.getElementById('load').style.display = 'flex';
    // Defina o nome do item que você deseja remover
    SelecionarClonadoApagarPP();
    // Remova o item do localStorage
    localStorage.removeItem('ProdutoClonadoPP');
    localStorage.removeItem('ProdutoClonado');
    document.getElementById('ApagarProdutoCloando').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Seleção de produto Clonado Limpa</div></div>';

    
    ApagarPapel('papelSelecionado');
    ApagarAcabamento('AcabamentoSelecionado');
    
    setTimeout(function () {
      document.getElementById('ApagarProdutoCloando').innerHTML = '';
      window.location.reload(true);
      document.getElementById('load').style.display = 'none';
    }, 1000);
  }

  function ClonarProduto(valor) {
    document.getElementById('load').style.display = 'flex';
    if (localStorage.getItem('ProdutoClonadoPP') != '[]' && localStorage.getItem('ProdutoClonadoPP') != null) {
      SelecionarClonadoApagarPP();
    }
    if (localStorage.getItem('ProdutoClonado') != '[]' && localStorage.getItem('ProdutoClonado') != null) {
      ApagarProdutoCloando();
    }
    const PP = document.getElementById('ppRadio');
    let ativo = PP.checked ? true : false;
    let selecionado = document.getElementById(valor);
    let ProdutoClonado = localStorage.getItem('ProdutoClonado');
    let arrayClonados = ProdutoClonado ? JSON.parse(ProdutoClonado) : [];
    let ProdutoClonadoPP = localStorage.getItem('ProdutoClonadoPP');
    let arrayClonadosPP = ProdutoClonadoPP ? JSON.parse(ProdutoClonadoPP) : [];
    const SelecionadoProdutoClonado = Number(document.getElementById(valor).name.
      replace('ProdutoClone', ''))
    if (document.getElementById(valor).innerHTML == 'CLONADO') {
      document.getElementById('ClonadoProduto').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Desmarcado. Produto que estava clonado!</div></div>';
      if (ativo) {
        arrayClonadosPP = arrayClonados.filter(id => id !== selecionado.id);
      } else {
        arrayClonados = arrayClonadosPP.filter(id => id !== selecionado.id);
      }
      document.getElementById(valor).innerHTML = 'CLONAR PRODUTO'
    } else {
      document.getElementById('ClonadoProduto').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso, Produto foi clonado!<br> Verifique a aba "Novo Produto".</div></div>';
      if (ativo) {
        arrayClonadosPP.push(selecionado.id);
      } else {
        arrayClonados.push(selecionado.id);
      }
      // Usa o método scrollIntoView para rolar até o elemento
      const elemento = document.getElementById("novo-produto");

      if (elemento) {
        var tab = new bootstrap.Tab(elemento); // Cria uma nova instância do objeto Tab
        tab.show(); // Ativa a guia "Novo Produto"

      }
      document.getElementById(valor).innerHTML = 'CLONADO'
    }
    localStorage.setItem('ProdutoClonado', JSON.stringify(arrayClonados));
    localStorage.setItem('ProdutoClonadoPP', JSON.stringify(arrayClonadosPP));
    setTimeout(function () {
      document.getElementById('ClonadoProduto').innerHTML = '';
      RecuperaPapapelClonado();
    }, 1500);
  }
