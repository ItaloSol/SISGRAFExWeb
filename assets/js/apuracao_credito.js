function ApurarCredito(cod, tipo) {
  var elemento = document.getElementById(cod)
  fetch('../financeiro/api_correcao_credito.php?cod=' + cod + '&tipo=' + tipo)
  .then(response => response.json())
  .then(data => {
    console.log(data.erro)
    if (data.erro == false) {
      elemento.classList.remove('btn-info');
      elemento.classList.add('btn-success');
      elemento.innerHTML = 'Corrigido';
        const tableBody = document.getElementById('notifica_geral_todos');
        tableBody.innerHTML = '';
        tableBody.innerHTML += `<div id="alerta" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true">
           <div class="toast-header">
             <i class="bx bx-bell me-2"></i>
             <div class="me-auto fw-semibold">Aviso!</div>
             <small></small>
             <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
           </div>
           <div class="toast-body">
             Valor de Saldo do cliente corrigido com sucesso!
           </div>
         </div>`;
      } else {
        const tableBody = document.getElementById('notifica_geral_todos');
        tableBody.innerHTML = '';
        tableBody.innerHTML += `<div id="alerta" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true">
           <div class="toast-header">
             <i class="bx bx-bell me-2"></i>
             <div class="me-auto fw-semibold">Aviso!</div>
             <small></small>
             <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
           </div>
           <div class="toast-body">
             Não Foi possivel fazer a correção!
           </div>
         </div>`;
      }
    })
    .catch(error => {
      console.error('Erro ao apurar saldo clientes:', error);
    });
}
