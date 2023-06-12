function selecionarPapel(valor) {
    const selecionado = document.getElementById(valor);
    console.log(selecionado.checked);
  
    let papelSelecionado = localStorage.getItem('papelSelecionado');
    let arraySelecionados = papelSelecionado ? JSON.parse(papelSelecionado) : [];
  
    if (selecionado.checked) {
      document.getElementById('mensagemPapel').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small> <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button> </div> <div class="toast-body">Sucesso. Papel Selecionado!</div></div>';
  
      // Adicionar o ID do item selecionado ao array de selecionados
      arraySelecionados.push(selecionado.id);
    } else {
      document.getElementById('mensagemPapel').innerHTML = '<div style=";" id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small> <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button> </div> <div class="toast-body">Desmarcado. Papel Desmarcado!</div></div>';
  
      // Remover o ID do item desmarcado do array de selecionados
      arraySelecionados = arraySelecionados.filter(id => id !== selecionado.id);
    }
  
    // Salvar o array de selecionados no localStorage
    localStorage.setItem('papelSelecionado', JSON.stringify(arraySelecionados));
  
    setTimeout(function () {
      document.getElementById('mensagemPapel').innerHTML = '';
    }, 1000);
    recuperarNomesPapel()
  }


  if (localStorage.getItem('papelSelecionado')) {
    recuperarNomesPapel();
  }
  
  function recuperarNomesPapel() {
    let papelSelecionado = localStorage.getItem('papelSelecionado');
    let arraySelecionados = papelSelecionado ? JSON.parse(papelSelecionado) : [];
  
    let promises = arraySelecionados.map(id => {
      return fetch('api_papel.php?id=' + id)
        .then(response => response.json())
        .then(data => {
          return {
            id: id,
            nomePapel: data.descricao_do_papel,
            codPapel: data.cod_papel,
            corFrente: data.cor_frente,
            corVerso: data.cor_verso,
            tipo_papel: data.tipo_papel,
            descricao: data.descricao,
            orelha: data.orelha,
            codPapels: data.cod_papels,
            descricaoPapel: data.descricao_do_papel,
            medida: data.medida,
            gramatura: data.gramatura,
            formato: data.formato,
            umaFace: data.uma_face,
            unitario: data.unitario
          };
        });
    });
    Promise.all(promises)
    .then(results => {
      let nomePapel = results.map(result => result.nomePapel).join(', ');
      console.log(nomePapel); // Movido para dentro do bloco `then`
     // document.getElementById('nome_papel').value = nomePapel;
  
      const tableBody = document.getElementById('tabela_campos');
      tableBody.innerHTML = '';
      tableBody.innerHTML += `
      <thead>
      <tr>
        <th>PRODUTO</th>
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
      results.forEach(result => {
        tableBody.innerHTML += `
        
          <tr>
            <td>${result.nomePapel}</td>
            <td>${result.codPapel}</td>
            <td>${result.descricao}</td>
            <td>${result.tipo_papel}</td>
            <td>${result.corFrente}</td>
            <td>${result.corVerso}</td>
            <td>${result.formato}</td>
            <td>${result.orelha}</td>
            <td>${result.gasto_folha}</td>
            <td>${result.preco_folha}</td>
            <td>${result.quantidade_chapas}</td>
            <td>${result.preco_chapa}</td>
          </tr>`;
      });
    })
    .catch(error => {
      console.error('Erro ao recuperar nomes do papel:', error);
    });
  }