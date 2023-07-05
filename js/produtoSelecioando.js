function SelecionarProduto(valor) {
  const PP = document.getElementById('ppRadio');
  let ativo = PP.checked ? true : false;

  if (ativo) {
    const tipo = 'PP';
  } else {
    const tipo = 'PE';
      replace('Produto', '')
  }
  const SelecionadoProdutoEscolhido = document.getElementById(valor).id;
  
  let ProdutoSelecionado = localStorage.getItem('ProdutoSelecioando');
  let arraySelecioandos = ProdutoSelecionado ? JSON.parse(ProdutoSelecionado) : [];
  let arraySelecioandoPP = localStorage.getItem('ProdutoSelecioandopp');
  let arraySelecioandosPP = arraySelecioandoPP ? JSON.parse(arraySelecioandoPP) : [];
  

  console.log(document.getElementById(valor))
  if (document.getElementById(valor).innerHTML == 'SELECIONADO') {
    document.getElementById('SelecioandoProduto').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso. Produto Desmarcado!</div></div>';
    document.getElementById(valor).innerHTML = 'Selecionar Produto'
    if (ativo) {
      arraySelecioandosPP = arraySelecioandosPP.filter(id => id !== SelecionadoProdutoEscolhido);
    } else {
      arraySelecioando = arraySelecioandos.filter(id => id !== SelecionadoProdutoEscolhido);
    }
  } else {
    document.getElementById('SelecioandoProduto').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Selecionado, Produto foi Selecionado!<br> Verifique o item fora do modal.</div></div>';
    document.getElementById(valor).innerHTML = 'SELECIONADO'
    if (ativo) {
      arraySelecioandosPP.push(SelecionadoProdutoEscolhido);
    } else {
      arraySelecioando.push(SelecionadoProdutoEscolhido);
    }
  }
  setTimeout(function () {
    document.getElementById('SelecioandoProduto').innerHTML = '';
  }, 1000);
}

