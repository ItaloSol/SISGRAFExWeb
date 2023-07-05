async function waitForElement(elementId, timeout = 1000) {
  return new Promise((resolve) => {
    const startTime = Date.now();

    const checkElement = () => {
      const element = document.getElementById(elementId);
      if (element) {
        resolve(element);
        document.getElementById('ErroSelecionar').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso, Produto foi Selecioando FOI RECUPERADO!<br> Verifique a aba "Novo Produto".</div></div>';
      } else {
        const elapsedTime = Date.now() - startTime;
        if (elapsedTime >= timeout) {
          resolve(null);
        } else {
          document.getElementById('ErroSelecionar').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Você tem um produto Selecionado!</div></div>';
          setTimeout(checkElement, 100);
        }
      }
    };

    checkElement();
  });
}

async function SelecionarSelecioando() {
  if (document.getElementById('produtosTableBody')) {
    setTimeout(function () {
      document.getElementById('ErroSelecionar').innerHTML = '';
    }, 5000);
    if (localStorage.getItem('ProdutoSelecioandoPP')) {
      const ArraySelecionadoPP = JSON.parse(localStorage.getItem('ProdutoSelecioandoPP'));

      for (const item of ArraySelecionadoPP) {
        const elemento = await waitForElement(item);
        elemento.innerHTML = 'Selecioando';
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
        document.getElementById('ErroSelecionar').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso, Produto foi Selecioando FOI RECUPERADO!<br> Verifique a aba "Novo Produto".</div></div>';
      } else {
        const elapsedTime = Date.now() - startTime;
        if (elapsedTime >= timeout) {
          resolve(null);
        } else {
          document.getElementById('ErroSelecionar').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">VOCÊ TEM UM PRODUTO Selecionado!<br> Verifique a aba "Novo Produto </div></div>';
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
    if (localStorage.getItem('ProdutoSelecioandoPP')) {
      const ArraySelecionadoPP = JSON.parse(localStorage.getItem('ProdutoSelecioandoPP'));

      for (const item of ArraySelecionadoPP) {
        const elemento = await waitForElement(item);
        elemento.innerHTML = 'Selecioando';
      }
    }
  }
}
if (localStorage.getItem('ProdutoSelecioandoPP') != '[]') {
  SelecionarSelecioando();
}
async function waitForElementPE(elementId, timeout = 1000) {
  return new Promise((resolve) => {
    const startTime = Date.now();

    const checkElement = () => {
      const element = document.getElementById(elementId);
      if (element) {
        resolve(element);
        document.getElementById('ErroSelecionar').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso, Produto foi Selecioando FOI RECUPERADO!<br> Verifique a aba "Novo Produto".</div></div>';
      } else {
        const elapsedTime = Date.now() - startTime;
        if (elapsedTime >= timeout) {
          resolve(null);
        } else {
          document.getElementById('ErroSelecionar').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">VOCÊ TEM UM PRODUTO Selecioando!<br> Verifique a aba "Novo Produto </div></div>';
          setTimeout(checkElement, 100);
        }
      }
    };

    checkElement();
  });
}

async function SelecionarSelecioandoPE() {
  if (document.getElementById('produtosTableBody')) {
    
    setTimeout(function () {
      document.getElementById('ErroSelecionar').innerHTML = '';
    }, 5000);
    if (localStorage.getItem('ProdutoSelecioando')) {
      const ArraySelecionado = JSON.parse(localStorage.getItem('ProdutoSelecioando'));

      for (const item of ArraySelecionado) {
        const elemento = await waitForElementPE(item);
        elemento.innerHTML = 'Selecioando';
      }
    }
  }
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
    if (localStorage.getItem('ProdutoSelecioandoPP')) {
      const ArraySelecionadoPP = JSON.parse(localStorage.getItem('ProdutoSelecioandoPP'));

      for (const item of ArraySelecionadoPP) {
        const elemento = await waitForElementApagarPP(item);
        elemento.innerHTML = 'Selecionar Produto';
      }
    }
  }
}

function ApagarProdutoSelecioando() {
  // Defina o nome do item que você deseja remover
  SelecionarSelecioandoApagarPP();
  // Remova o item do localStorage
  localStorage.removeItem('ProdutoSelecioandoPP');
  localStorage.removeItem('ProdutoSelecioando');
  document.getElementById('ApagarProdutoSelecioando').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Seleção de produto Selecioando Limpa</div></div>';

  setTimeout(function () {
    document.getElementById('ApagarProdutoSelecioando').innerHTML = '';
  }, 1000);
}

function SelecionarProduto(valor) {
  const PP = document.getElementById('ppRadio');
  let ativo = PP.checked ? true : false;
  let selecionado = document.getElementById(valor);
  let ProdutoSelecioando = localStorage.getItem('ProdutoSelecioando');
  let arraySelecioandos = ProdutoSelecioando ? JSON.parse(ProdutoSelecioando) : [];
  let ProdutoSelecioandoPP = localStorage.getItem('ProdutoSelecioandoPP');
  let arraySelecioandosPP = ProdutoSelecioandoPP ? JSON.parse(ProdutoSelecioandoPP) : [];
  const SelecionadoProdutoSelecioando = Number(document.getElementById(valor).name.
    replace('Produto', ''))
  if (document.getElementById(valor).innerHTML == 'Selecioando') {
    document.getElementById('SelecioandoProduto').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Desmarcado. Produto que estava Selecioando!</div></div>';
    if (ativo) {
      arraySelecioandosPP = arraySelecioandos.filter(id => id !== selecionado.id);
    } else {
      arraySelecioandos = arraySelecioandosPP.filter(id => id !== selecionado.id);
    }
    document.getElementById(valor).innerHTML = 'Selecionar Produto'
  } else {
    document.getElementById('SelecioandoProduto').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso, Produto foi Selecioando!<br> Verifique a aba "Novo Produto".</div></div>';
    if (ativo) {
      arraySelecioandosPP.push(selecionado.id);
    } else {
      arraySelecioandos.push(selecionado.id);
    }
    // Usa o método scrollIntoView para rolar até o elemento
   
    document.getElementById(valor).innerHTML = 'Selecioando'
  }
  localStorage.setItem('ProdutoSelecioando', JSON.stringify(arraySelecioandos));
  localStorage.setItem('ProdutoSelecioandoPP', JSON.stringify(arraySelecioandosPP));
  setTimeout(function () {
    document.getElementById('SelecioandoProduto').innerHTML = '';
  }, 1500);
}
