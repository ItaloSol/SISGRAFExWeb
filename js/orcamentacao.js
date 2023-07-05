function selecionarPapel(valor) {
  const selecionado = document.getElementById(valor);
  // console.log(selecionado.checked);

  let papelSelecionado = localStorage.getItem('papelSelecionado');
  let arraySelecionados = papelSelecionado ? JSON.parse(papelSelecionado) : [];

  if (selecionado.checked) {
    document.getElementById('mensagemPapel').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso. Papel Selecionado!</div></div>';

    // Adicionar o ID do item selecionado ao array de selecionados
    arraySelecionados.push(selecionado.value);
  } else {
    document.getElementById('mensagemPapel').innerHTML = '<div style=";" id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Desmarcado. Papel Desmarcado!</div></div>';

    // Remover o ID do item desmarcado do array de selecionados
    arraySelecionados = arraySelecionados.filter(id => id !== selecionado.value);
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
  const ArrayPapels = JSON.parse(localStorage.getItem('papelSelecionado'));
  if (document.getElementById('PapelsSelecionado')) {
    ArrayPapels.map((item) => {
      document.getElementById('Papel' + item).setAttribute('checked', 'checked');
    })
  }
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
          preco_chapa: data.valor_chapa,
          codPapels: data.cod_papels,
          descricaoPapel: data.descricao_do_papel,
          medida: data.medida,
          preco_folha: data.unitario,
          gramatura: data.gramatura,
          formato: data.formato,
          umaFace: data.uma_face,
        };
      });
  });
  Promise.all(promises)
    .then(results => {
      let nomePapel = results.map(result => result.nomePapel).join(', ');
      // console.log(nomePapel); // Movido para dentro do bloco `then`
      // document.getElementById('nome_papel').value = nomePapel;

      const tableBody = document.getElementById('personalizaPapel');
      tableBody.innerHTML = '';
      tableBody.innerHTML += `
      <thead>
      <tr>
        <th>PRODUTO</th>
        <th>CÓDIGO PAPEL</th>
        <th>DESCRIÇÃO</th>
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
      if (!results || results.length === 0) {
        tableBody.innerHTML += `
      <tr>
      <td align="center" colspan="12">
        NENHUM SELECIONADO
      </td>
    </tr>`;
      }
      results.forEach(result => {
        tableBody.innerHTML += `
        
          <tr>
            <td>${result.nomePapel}</td>
            <td>${result.codPapels}</td>
            <td>${result.nomePapel}</td>
            <td><input class="form-control" value="${result.corFrente}" type="number"></td>
            <td><input class="form-control" value="${result.corVerso}" type="number"></td>
            <td><input class="form-control" value="${result.formato}" type="number"></td>
            <td><input class="form-control" value="${result.orelha}" type="number"></td>
            <td><input class="form-control" value="0" type="number"></td>
            <td>${result.preco_folha}</td>
            <td><input class="form-control" value="0" type="number"></td>
            <td>${result.preco_chapa}</td>
          </tr>`;
      });
    })
    .catch(error => {
      console.error('Erro ao recuperar nomes do papel:', error);
    });
}

function ApagarPapel(valor) {
  // Defina o nome do item que você deseja remover
  var itemKey = valor;
  const ArrayPapels = JSON.parse(localStorage.getItem('papelSelecionado'));
  if (document.getElementById('PapelsSelecionado')) {
    ArrayPapels.map((item) => {
      document.getElementById('Papel' + item).checked = false;
    })
  }
  // Remova o item do localStorage
  localStorage.removeItem(itemKey);
  document.getElementById('mensagemPapelApagado').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Seleção de papel limpa com sucesso!</div></div>';

  recuperarNomesPapel();
  setTimeout(function () {
    document.getElementById('mensagemPapelApagado').innerHTML = '';
  }, 1000);
}
// Adicione event listeners aos elementos relevantes
if (document.getElementById('descricao')) {
  document.getElementById('descricao').addEventListener('change', NovoProduto);
}

if (document.getElementById('largura')) {
  document.getElementById('largura').addEventListener('change', NovoProduto);
}

if (document.getElementById('altura')) {
  document.getElementById('altura').addEventListener('change', NovoProduto);
}

if (document.getElementById('espessura')) {
  document.getElementById('espessura').addEventListener('change', NovoProduto);
}

if (document.getElementById('peso')) {
  document.getElementById('peso').addEventListener('change', NovoProduto);
}

if (document.getElementById('qtdfolhas')) {
  document.getElementById('qtdfolhas').addEventListener('change', NovoProduto);
}

if (document.getElementById('valor_Papel')) {
  document.getElementById('valor_Papel').addEventListener('change', NovoProduto);
}

if (document.getElementById('tipoProduto')) {
  document.getElementById('tipoProduto').addEventListener('change', NovoProduto);
}

if (document.getElementById('PP')) {
  document.getElementById('PP').addEventListener('change', NovoProduto);
}

if (document.getElementById('PE')) {
  document.getElementById('PE').addEventListener('change', NovoProduto);
}

if (document.getElementById('TipoCommerce')) {
  document.getElementById('TipoCommerce').addEventListener('change', NovoProduto);
}

if (document.getElementById('Tipoativo')) {
  document.getElementById('Tipoativo').addEventListener('change', NovoProduto);
}

async function NovoProduto() {
  let descricao = await document.getElementById('descricao').value;
  let largura = await document.getElementById('largura').value;
  let altura = await document.getElementById('altura').value;
  let espessura = await document.getElementById('espessura').value;
  let peso = await document.getElementById('peso').value;
  let qtdfolhas = await document.getElementById('qtdfolhas').value;
  let valor_Papel = await document.getElementById('valor_Papel').value;
  let tipoProduto = await document.getElementById('tipoProduto').value;
  let PP = await document.getElementById('PP').checked;
  let PE = await document.getElementById('PE').checked;
  let TipoCommerce = await document.getElementById('TipoCommerce').value;
  let Tipoativo = await document.getElementById('Tipoativo').checked;
  const Selecionados = {
    'descricao': descricao,
    'largura': largura,
    'altura': altura,
    'espessura': espessura,
    'peso': peso,
    'qtdfolhas': qtdfolhas,
    'valor_Papel': valor_Papel,
    'tipoProduto': tipoProduto,
    'PP': PP,
    'PP': PE,
    'TipoCommerce': TipoCommerce,
    'Tipoativo': Tipoativo,
  }

  const tableBody = document.getElementById('personalizaPapel');
  tableBody.innerHTML = '';
  tableBody.innerHTML += `
      <thead>
        <tr>
          <th>CÓDIGO</th>
          <th>DESCRIÇÃO</th>
          <th>TIPO</th>
          <th>ORELHA</th>
          <th>CORES FRENTE</th>
          <th>CORES VERSO</th>
        </tr>
    </thead>`;
  if (!results || results.length === 0) {
    tableBody.innerHTML += `
      <tr>
      <td align="center" colspan="6">
        NENHUM SELECIONADO
      </td>
    </tr>`;
  }
  results.forEach(result => {
    tableBody.innerHTML += `
        
          <tr>
            <td>${Selecionardos.nomePapel}</td>
            <td>${Selecionardos.codPapel}</td>
            <td>${Selecionardos.descricao}</td>
            <td>${Selecionardos.tipo_papel}</td>
            <td>${Selecionardos.corFrente}</td>
            <td>${Selecionardos.corVerso}</td>
            <td><input class="form-control" value="${Selecionardos.formato}" type="number"></td>
            <td><input class="form-control" value="${Selecionardos.orelha}" type="number"></td>
            <td><input class="form-control" value="0" type="number"></td>
            <td>${Selecionardos.preco_folha}</td>
            <td><input class="form-control" type="number" placeholder="0"></td>
             <td><input class="form-control" type="number" placeholder="0"></td>
          </tr>`;
  });

  localStorage.setItem('NovoProduto', JSON.stringify(Selecionados));
  // console.log(localStorage.getItem('NovoProduto'));
  if (localStorage.getItem('NovoProduto')) {
    // Obter os dados do localStorage
    const selecionadosString = localStorage.getItem('NovoProduto');
    const selecionados = JSON.parse(selecionadosString);

    // Iterar sobre os pares chave-valor do objeto
    Object.entries(selecionados).forEach(([chave, valor]) => {
      // Preencher os valores nos elementos HTML correspondentes
      document.getElementById(chave).value = valor;
    });
  }

}

const selecionar_um_produto = document.getElementById('selecionar_um_produto');
selecionar_um_produto.addEventListener('click', vle => {
   SelecionarClonadoPE();
  SelecionarSelecioando();
})
const PECheck = document.getElementById('peRadio');
PECheck.addEventListener('click', vle => {
   SelecionarClonadoPE();
   SelecionarSelecioandoPE();
})
const PPCheck = document.getElementById('ppRadio');
PPCheck.addEventListener('click', vle => {
   SelecionarClonadoPE();
  SelecionarSelecioando();
})
//  SELECIONAR ACABAMENTO

function selecionarAcabamento(valor) {
  const selecionado = document.getElementById(valor);

  // console.log(selecionado.value);
  let AcabamentoSelecionado = localStorage.getItem('AcabamentoSelecionado');
  let arraySelecionados = AcabamentoSelecionado ? JSON.parse(AcabamentoSelecionado) : [];

  if (selecionado.checked) {
    document.getElementById('mensagemAcabamento').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso. Acabamento Selecionado!</div></div>';

    // Adicionar o ID do item selecionado ao array de selecionados
    arraySelecionados.push(selecionado.value);
  } else {
    document.getElementById('mensagemAcabamento').innerHTML = '<div style=";" id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Desmarcado. Acabamento Desmarcado!</div></div>';

    // Remover o ID do item desmarcado do array de selecionados
    arraySelecionados = arraySelecionados.filter(id => id !== selecionado.value);
  }

  // Salvar o array de selecionados no localStorage
  localStorage.setItem('AcabamentoSelecionado', JSON.stringify(arraySelecionados));

  setTimeout(function () {
    document.getElementById('mensagemAcabamento').innerHTML = '';
  }, 1000);
  recuperarNomesAcabamento()
}
if (localStorage.getItem('AcabamentoSelecionado')) {
  recuperarNomesAcabamento();
  const ArrayAcabamentos = JSON.parse(localStorage.getItem('AcabamentoSelecionado'));
  if (document.getElementById('selecionarAcabamentos')) {
    ArrayAcabamentos.map((item) => {
      document.getElementById('Acaba' + item).setAttribute('checked', 'checked');
    })
  }
}


function recuperarNomesAcabamento() {
  let AcabamentoSelecionado = localStorage.getItem('AcabamentoSelecionado');
  let arraySelecionados = AcabamentoSelecionado ? JSON.parse(AcabamentoSelecionado) : [];

  let promises = arraySelecionados.map(id => {
    return fetch('api_acabamento.php?id=' + id)
      .then(response => response.json())
      .then(data => {
        return {
          id: id,
          MAQUINA: data.MAQUINA,
          ATIVA: data.ATIVA,
          CUSTO_HORA: data.CUSTO_HORA,
        };
      });
  });
  Promise.all(promises)
    .then(results => {
      let nomePapel = results.map(result => result.nomePapel).join(', ');
      // console.log(nomePapel); // Movido para dentro do bloco `then`
      // document.getElementById('nome_papel').value = nomePapel;

      const tableBody = document.getElementById('NovoAcabemtnoSe');
      tableBody.innerHTML = '';
      tableBody.innerHTML += `
    <thead>
    <tr>
    <th>CÓDIGO</th>
    <th>MÁQUINA</th>
    <th>CUSTO</th>
    </tr>
  </thead>`;
      if (!results || results.length === 0) {
        tableBody.innerHTML += `
    <tr>
    <td align="center" colspan="3">
      NENHUM SELECIONADO
    </td>
  </tr>`;
      }
      results.forEach(result => {
        tableBody.innerHTML += `
      
        <tr>
          <td>${result.id}</td>
          <td>${result.MAQUINA}</td>
          <td>${result.CUSTO_HORA}</td>
        </tr>`;
      });
    })
    .catch(error => {
      console.error('Erro ao recuperar nomes do acabamento:', error);
    });
}

function ApagarAcabamento(valor) {
  // Defina o nome do item que você deseja remover
  var itemKey = valor;
  const ArrayAcabamentos = JSON.parse(localStorage.getItem('AcabamentoSelecionado'));
  if (document.getElementById('selecionarAcabamentos')) {
    ArrayAcabamentos.map((item) => {
      document.getElementById('Acaba' + item).checked = false;
    });
  }
  // Remova o item do localStorage
  localStorage.removeItem(itemKey);
  document.getElementById('mensagemAcabamento').innerHTML = '<div style=";" id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Seleção de acabamentos limpa com sucesso!</div></div>';

  recuperarNomesAcabamento();
  setTimeout(function () {
    document.getElementById('mensagemAcabamento').innerHTML = '';
  }, 1000);
}