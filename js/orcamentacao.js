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
    console.log('achou');
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
            nomePapel: data.nome_do_papel,
            codPapel: data.cod_papel,
            corFrente: data.cor_frente,
            corVerso: data.cor_verso,
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
        document.getElementById('nome_papel').value = nomePapel;
  
        let tabela = document.getElementById('tabela_campos');
        results.forEach(result => {
          let tr = document.createElement('tr');
          tabela.appendChild(tr);
  
          let td1 = document.createElement('td');
          td1.textContent = result.nomePapel;
          tr.appendChild(td1);
  
          let td2 = document.createElement('td');
          td2.textContent = result.codPapel;
          tr.appendChild(td2);
  
          let td3 = document.createElement('td');
          td3.textContent = result.descricao;
          tr.appendChild(td3);
  
          let td4 = document.createElement('td');
          td4.textContent = result.tipo_papel;
          tr.appendChild(td4);
  
          let td5 = document.createElement('td');
          td5.textContent = result.corFrente;
          tr.appendChild(td5);
  
          let td6 = document.createElement('td');
          td6.textContent = result.corVerso;
          tr.appendChild(td6);
  
          let td7 = document.createElement('td');
          td7.textContent = result.formato;
          tr.appendChild(td7);
  
          let td8 = document.createElement('td');
          td8.textContent = result.orelha;
          tr.appendChild(td8);
  
          let td9 = document.createElement('td');
          td9.textContent = result.gasto_folha;
          tr.appendChild(td9);
  
          let td10 = document.createElement('td');
          td10.textContent = result.preco_folha;
          tr.appendChild(td10);
  
          let td11 = document.createElement('td');
          td11.textContent = result.quantidade_chapas;
          tr.appendChild(td11);
  
          let td12 = document.createElement('td');
          td12.textContent = result.preco_chapa;
          tr.appendChild(td12);
        });
      })
      .catch(error => {
        console.error('Erro ao recuperar nomes do papel:', error);
      });
  }