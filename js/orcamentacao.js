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
//
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
          <th>CÓDIGO PRODUTO</th>
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
            <td>${Selecionados.nomePapel}</td>
            <td>${Selecionados.codPapel}</td>
            <td>${Selecionados.descricao}</td>
            <td>${Selecionados.tipo_papel}</td>
            <td>${Selecionados.corFrente}</td>
            <td>${Selecionados.corVerso}</td>
            <td><input class="form-control" value="${Selecionados.formato}" type="number"></td>
            <td><input class="form-control" value="${Selecionados.orelha}" type="number"></td>
            <td><input class="form-control" value="0" type="number"></td>
            <td>${Selecionados.preco_folha}</td>
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
const novoo = document.getElementById('novo-produto');
novoo.addEventListener('click', vle => {
  RecuperaPapapelClonado();
})
const PPCheck = document.getElementById('ppRadio');
PPCheck.addEventListener('click', vle => {
  SelecionarClonadoPE();
  SelecionarSelecioando();
})
//  SELECIONAR ACABAMENTO
function checkedAcabamento() {

  const ArrayAcabamentos = JSON.parse(localStorage.getItem('AcabamentoSelecionado'));
  if (document.getElementById('seleccionadoacabamentos')) {
    if (ArrayAcabamentos != []) {
      ArrayAcabamentos.map((item) => {
        if (document.getElementById('Acaba' + item.valor)) {
          recuperarNomesAcabamento('NovoAcabemtnoSe')
          document.getElementById('Acaba' + item.valor).checked = true;
        }
      })
    }
  }
}

function adicionarAcabamentoDoClone(valor, cod_produto) {
  let AcabamentoSelecionado = localStorage.getItem('AcabamentoSelecionado');
  let arraySelecionados = AcabamentoSelecionado ? JSON.parse(AcabamentoSelecionado) : [];
  let completo = {
    cod_produto,
    valor
  }
  arraySelecionados.push(completo);
  localStorage.setItem('AcabamentoSelecionado', JSON.stringify(arraySelecionados));
  recuperarNomesAcabamento('NovoAcabemtnoSe');
  checkedAcabamento();
}

function adicionarPapelDoClone(valor, cod_produto) {
  let PapelSelecionado = localStorage.getItem('papelSelecionado');
  let arraySelecionados = PapelSelecionado ? JSON.parse(PapelSelecionado) : [];
  let completo = {
    cod_produto,
    valor
  }
  arraySelecionados.push(completo);
  localStorage.setItem('papelSelecionado', JSON.stringify(arraySelecionados));
  recuperarNomesAcabamento('personalizaPapel');
  checkedPapel();
}

function recuperarNomesAcabamento(iddovalor) {
  const storedData = localStorage.getItem('AcabamentoSelecionado');

  let arraySelecionados = storedData ? JSON.parse(storedData) : [];
  const codProdutos = arraySelecionados.map(({ cod_produto }) => cod_produto);

  // Extract the 'cod_produto' property from each object in the array

  // Extract the 'valor' property from each object in the array
  arraySelecionados = arraySelecionados.map(({ valor }) => valor);
  let promises = arraySelecionados.map(id => {
    // Use the 'id' (which is the 'valor' now) in the fetch request
    return fetch(`api_acabamento.php?id=${id}`)
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
      // Extract unique cod_produto values
      // (This part is not necessary anymore since we already have the codProdutos array)
      // const uniqueCodProdutos = [...new Set(codProdutos)];

      const tableBody = document.getElementById(iddovalor);
      tableBody.innerHTML = '';
      if (iddovalor == 'seleccionadoacabamentos') {
        tableBody.innerHTML += `
      <thead>
      <tr>
      <th>CÓDIGO PRODUTO</th>
      <th>CÓDIGO ACABAMENTO</th>
      <th>MÁQUINA</th>
      <th>CUSTO</th>
      </tr>
    </thead>`;
      } else {
        tableBody.innerHTML += `
      <thead>
      <tr>
      <th>CÓDIGO ACABAMENTO</th>
      <th>MÁQUINA</th>
      <th>CUSTO</th>
      </tr>
    </thead>`;
      }
      if (!results || results.length === 0) {
        tableBody.innerHTML += `
    <tr>
    <td align="center" colspan="3">
      NENHUM SELECIONADO
    </td>
  </tr>`;
      }
      results.forEach((result, index) => {
        const inputId = `acabamento_${index}`;
        if (iddovalor == 'seleccionadoacabamentos') {
          tableBody.innerHTML += ` <tr>
          <td>${codProdutos[index]}</td>
          <td><input type="hidden" name="acabamentos[${index}][id]" value="${result.id}" id="${inputId}_id"> <input type="text" class="form-control" name="acabamentos[${index}][codigo_acabamento]" value="${result.id}" id="${inputId}_codigo_acabamento" readonly></td>
          <td><input type="text" class="form-control" name="acabamentos[${index}][maquina]" value="${result.MAQUINA}" id="${inputId}_maquina" readonly></td>
          <td><input type="text" class="form-control" name="acabamentos[${index}][custo_hora]" value="${result.CUSTO_HORA}" id="${inputId}_custo_hora" readonly></td>
        </tr>`;
        } else {
          tableBody.innerHTML += `
          <tr>
            <td><input type="hidden" name="acabamentos[${index}][id]" value="${result.id}" id="${inputId}_id"> <input type="text" class="form-control" name="acabamentos[${index}][codigo_acabamento]" value="${result.id}" id="${inputId}_codigo_acabamento" readonly></td>
            <td><input type="text" class="form-control" name="acabamentos[${index}][maquina]" value="${result.MAQUINA}" id="${inputId}_maquina" readonly></td>
            <td><input type="text" class="form-control" name="acabamentos[${index}][custo_hora]" value="${result.CUSTO_HORA}" id="${inputId}_custo_hora" readonly></td>
          </tr>`;
        }
      });
    })
    .catch(error => {
      console.error('Erro ao recuperar nomes do acabamento:', error);
    });
}

function ApagarAcabamento() {
  if (localStorage.getItem('AcabamentoSelecionado') != '[]' && localStorage.getItem('AcabamentoSelecionado') != null) {
    const ArrayAcabamentos = JSON.parse(localStorage.getItem('AcabamentoSelecionado'));
    if (document.getElementById('seleccionadoacabamentos')) {
      ArrayAcabamentos.map((item) => {
        if (document.getElementById('Acaba' + item.valor)) {
          document.getElementById('Acaba' + item.valor).checked = false;
        }
      });
    }
  }
  // Remova o item do localStorage
  localStorage.removeItem('AcabamentoSelecionado');
  document.getElementById('mensagemAcabamento').innerHTML = '<div  id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Seleção de acabamentos limpa com sucesso!</div></div>';

  recuperarNomesAcabamento('NovoAcabemtnoSe');
  setTimeout(function () {
    document.getElementById('mensagemAcabamento').innerHTML = '';
  }, 1000);
}
//}

// funcções do papel
function selecionarPapel(dado) {
  const selecionado = document.getElementById(dado);
  let valor = dado.replace(/\D/g, '');
  let cod_produto = 0;
  let completo = {
    cod_produto,
    valor
  }
  let papelSelecionado = localStorage.getItem('papelSelecionado');
  let arraySelecionados = papelSelecionado ? JSON.parse(papelSelecionado) : [];

  if (selecionado.checked) {
    document.getElementById('mensagemPapel').innerHTML = '<div  id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso. Papel Selecionado!</div></div>';

    // Adicionar o ID do item selecionado ao array de selecionados
    arraySelecionados.push(completo);
  } else {
    document.getElementById('mensagemPapel').innerHTML = '<div  id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Desmarcado. Papel Desmarcado!</div></div>';

    // Remover o ID do item desmarcado do array de selecionados
    arraySelecionados = arraySelecionados.filter(item => item.valor !== completo.valor);
  }

  // Salvar o array de selecionados no localStorage
  localStorage.setItem('papelSelecionado', JSON.stringify(arraySelecionados));

  setTimeout(function () {
    document.getElementById('mensagemPapel').innerHTML = '';
  }, 1000);
  recuperarNomesPapel('personalizaPapel')
}
//Editar papel
function AbrirEditarPapel(valor) {
  const select = document.getElementById(valor);
  const cadastrarPapel = document.getElementById('cadastrarPapel')
  const editarPapel = document.getElementById('EditarPapel')
  const papelEditado = document.getElementById('idpapeleditado');
  let numeros = valor.replace(/\D/g, ''); // Remove tudo que não for dígito
  if (select.checked == false) {
    cadastrarPapel.style.display = 'block';
    editarPapel.style.display = 'none';
    document.getElementById('Nome_papel').value = '';
    document.getElementById('Mediada_Papel').value = '';
    document.getElementById('Gramatura_Papel').value = '';
    document.getElementById('Fomato_Papel').value = '';
    document.getElementById('umaface_Papel').checked = '';
    document.getElementById('valor_Papel').value = '';
  } else {
    document.getElementById('mensagemPapel').innerHTML = '<div  id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Papel Selecionado!</div></div>';

    cadastrarPapel.style.display = 'none';
    editarPapel.style.display = 'block';
    papelEditado.name = numeros;
    fetch(`api_papel.php?cod=${numeros}`)
      .then(response => response.json())
      .then(data => {
        let valores = data.map(papel => ({
          cod: papel.cod,
          descricao: papel.descricao,
          medida: papel.medida,
          gramatura: papel.gramatura,
          formato: papel.formato,
          uma_face: papel.uma_face,
          unitario: papel.unitario,
        }));

        valores.forEach(result => {
          document.getElementById('Nome_papel').value = result.descricao;
          document.getElementById('Mediada_Papel').value = result.medida;
          document.getElementById('Gramatura_Papel').value = result.gramatura;
          document.getElementById('Fomato_Papel').value = result.formato;
          if (+result.uma_face >= 1) {
            document.getElementById('umaface_Papel').checked = result.uma_face;
          }
          document.getElementById('valor_Papel').value = result.unitario;
        });
      });
  }

  setTimeout(function () {
    document.getElementById('mensagemPapel').innerHTML = '';
  }, 1000);
}
//SALVAR EDIÇÃO
async function EditarPapel() {
  const idPapel = document.getElementById('idpapeleditado').name;
  const Nome_papel = document.getElementById('Nome_papel').value;
  const Mediada_Papel = document.getElementById('Mediada_Papel').value;
  const Gramatura_Papel = document.getElementById('Gramatura_Papel').value;
  const Fomato_Papel = document.getElementById('Fomato_Papel').value;
  const umaface_Papel = document.getElementById('umaface_Papel').checked;
  const valor_Papel = document.getElementById('valor_Papel').value;
  const response = await fetch('api_papel.php?atualiza=' + idPapel + '&nome=' + Nome_papel
    + '&Mediada_Papel=' + Mediada_Papel
    + '&Gramatura_Papel=' + Gramatura_Papel
    + '&Fomato_Papel=' + Fomato_Papel
    + '&umaface_Papel=' + umaface_Papel
    + '&valor_Papel=' + valor_Papel);
  const data = await response.json();
  if (data.Sucesso === true) {
    document.getElementById('mensagemPapel').innerHTML = '<div  id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso! Papel Editado!</div></div>';
  }
  const cadastrarPapel = document.getElementById('cadastrarPapel');
  const editarPapel = document.getElementById('EditarPapel');
  cadastrarPapel.style.display = 'block';
  editarPapel.style.display = 'none';
  document.getElementById('Nome_papel').value = '';
  document.getElementById('Mediada_Papel').value = '';
  document.getElementById('Gramatura_Papel').value = '';
  document.getElementById('Fomato_Papel').value = '';
  document.getElementById('umaface_Papel').checked = '';
  document.getElementById('valor_Papel').value = '';
  setTimeout(function () {
    document.getElementById('mensagemPapel').innerHTML = '';
    abriPapels();
  }, 1000);


}
function recuperarNomesPapel(valor, codigo_do_produto) {
  const storedData = localStorage.getItem('papelSelecionado');
  let arraySelecionados = storedData ? JSON.parse(storedData) : [];
  const codProdutos = arraySelecionados.map(({ cod_produto }) => cod_produto);
  // Extract the 'cod_produto' property from each object in the array

  // Extract the 'valor' property from each object in the array

  //arraySelecionados = arraySelecionados.map(({ valor }) => valor);
  let promises = arraySelecionados.map(id => {
    return fetch('api_papel.php?id=' + id.valor + '&codi=' + id.cod_produto)
      .then((response) => response.json())
      .then(data => {
        return {
          id,
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
    .then((results) => {
      const nomePapel = results.map((result) => result.nomePapel).join(', ');

      let tableBody = '';
      if (valor !== 'tabela_campos') {
        tableBody = document.getElementById('personalizaPapel');
        tableBody.innerHTML = '';
        if (valor == 'tabela_campos') {
          tableBody.insertAdjacentHTML(
            'beforeend',
            `
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
      </thead>`
          );
        } else {
          tableBody.insertAdjacentHTML(
            'beforeend',
            `
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
          <th>PREÇO FOLHA</th>
        </tr>
      </thead>`
          );
        }

      } else {
        tableBody = document.getElementById('tabela_campos');
      }

      if (!results || results.length === 0) {
        tableBody.insertAdjacentHTML(
          'beforeend',
          `
      <tr>
      <td align="center" colspan="12">
        NENHUM SELECIONADO
      </td>
    </tr>`
        );
      }

      let cont = 0;
      results.forEach((result) => {
        if (valor == 'tabela_campos') {
          tableBody.insertAdjacentHTML(
            'beforeend',
            `<tr>
               <td>${codigo_do_produto &&
              Array.isArray(codigo_do_produto) &&
              codigo_do_produto.find(
                (obj) => obj.cod_PLS.includes(result.codPapels)
              )
              ? codigo_do_produto.find(
                (obj) => obj.cod_PLS.includes(result.codPapels)
              ).codigoPP
              : result.codPapels
            }</td>
               <td>${result.codPapels}</td>
               <td>${result.nomePapel}</td>
               <td>${result.tipo_papel}</td>
               <td><input class="form-control" id="GCF${result.codPapels}" value="${result.corFrente}" type="number"></td>
               <td><input class="form-control" id="GCV${result.codPapels}" value="${result.corVerso}" type="number"></td>
               <td><input class="form-control formato-impressao" id="Impre${result.codPapels}"  type="number"></td>
               <td><input class="form-control" value="5" type="number"></td>
               <td><input class="form-control" id="GFolha${result.codPapels}" value="0" type="number"></td>
               <td>${result.preco_folha}</td>
               <td><input class="form-control" id="GChapa${result.codPapels}" value="0" type="number"></td>
               <td>${result.preco_chapa}</td>
             </tr>`
          );
        } else {
          tableBody.insertAdjacentHTML(
            'beforeend',
            `<tr>
             <td>${codigo_do_produto &&
              Array.isArray(codigo_do_produto) &&
              codigo_do_produto.find(
                (obj) => obj.cod_PLS.includes(result.codPapels)
              )
              ? codigo_do_produto.find(
                (obj) => obj.cod_PLS.includes(result.codPapels)
              ).codigoPP
              : result.codPapels
            }</td>
             <td>${result.codPapels}</td>
             <td>${result.nomePapel}</td>
             <td>
             <select class="form-select">
               <option>SELECIONE</option>
               <option>CAPA</option>
               <option>MIOLO</option>
               <option>FOLHA</option>
               <option>1° VIA</option>
               <option>2° VIA</option>
               <option>3° VIA</option>
             </select></td>
             <td><input class="form-control" id="GCF${result.codPapels}" value="${result.corFrente}" type="number"></td>
             <td><input class="form-control" id="GCV${result.codPapels}" value="${result.corVerso}" type="number"></td>
             <td><input class="form-control formato-impressao" id="Impre${result.codPapels}"  type="number"></td>
             <td><input class="form-control" value="5" type="number"></td>
            
             <td>${result.preco_folha}</td>
            
            
           </tr>`
          );
        }
        cont++;
      });
    })
    .catch((error) => {
      console.error('Erro ao recuperar nomes do papel:', error);
    });
}

function checkedPapel() {
  if (localStorage.getItem('papelSelecionado')) {
    recuperarNomesPapel('personalizaPapel');
    const ArrayPapels = JSON.parse(localStorage.getItem('papelSelecionado'));
    if (document.getElementById('PapelsSelecionado')) {
      ArrayPapels.map((item) => {
        document.getElementById('Papel' + item.valor).checked = true;
      })
    }
  }
}

function ApagarPapel(valor) {
  // Defina o nome do item que você deseja remover
  var itemKey = valor;
  if (localStorage.getItem('papelSelecionado') != '[]' && localStorage.getItem('papelSelecionado') != null) {
    const ArrayPapels = JSON.parse(localStorage.getItem('papelSelecionado'));
    if (document.getElementById('PapelsSelecionado')) {
      ArrayPapels.map((item) => {
        document.getElementById('Papel' + item.valor).checked = false;
      })
    }
    // Remova o item do localStorage
    localStorage.removeItem(itemKey);
    document.getElementById('mensagemPapelApagado').innerHTML = '<div  id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Seleção de papel limpa com sucesso!</div></div>';

    recuperarNomesPapel('personalizaPapel');
    setTimeout(function () {
      document.getElementById('mensagemPapelApagado').innerHTML = '';
    }, 1000);
  }
}

function abriPapels() {
  document.getElementById('load1').style.display = 'flex';
  fetch('api_papel.php')
    .then(response => response.json())
    .then(data => {
      let valores = data.map(papel => ({
        cod: papel.cod,
        descricao: papel.descricao,
        medida: papel.medida,
        gramatura: papel.gramatura,
        formato: papel.formato,
        uma_face: papel.uma_face,
        unitario: papel.unitario,
      }));

      var completaInsertePapel = document.getElementById('PapelsSelecionado');
      completaInsertePapel.innerHTML = '';
      completaInsertePapel.innerHTML += `
        <thead>
          <tr>
            <th>CODIGO</th>
            <th>DESCRIÇÃO</th>
            <th>MEDIDA</th>
            <th>GRAMA<br>TURA</th>
            <th>FORMATO</th>
            <th>UMA FACE</th>
            <th>VALOR</th>
            <th>SELECI<br>ONAR</th>
            <th>EDITAR</th>
          </tr>
        </thead>`;

      valores.forEach(result => {
        completaInsertePapel.innerHTML += `
          <tr>
            <td>${result.cod}</td>
            <td>${result.descricao}</td>
            <td>${result.medida}</td>
            <td>${result.gramatura}</td>
            <td>${result.formato}</td>
            <td>${result.uma_face}</td>
            <td>${result.unitario}</td>
            <td><input value="${result.cod}" class="form-check-input" id="Papel${result.cod}" onclick="selecionarPapel(this.id)" type="checkbox"> </td>
            <td> <input class="form-check-input" type="checkbox" id="Editar${result.cod}" value="EDITAR" onclick="AbrirEditarPapel(this.id);"/></td>
          </tr>`;
      });
    });
  setTimeout(() => {
    document.getElementById('load1').style.display = 'none';
    checkedPapel();
  }, 1000)

}

async function pesquisarpapel() {
  const pesquisa = document.getElementById('pesquiarpapelnome');
  await pesquisa.addEventListener('keyup', valor => {
    if (pesquisa.value.length >= 3) {
      fetch('api_papel.php?nome=' + pesquisa.value)
        .then(response => response.json())
        .then(data => {
          let valores = data.map(papel => ({
            cod: papel.cod,
            descricao: papel.descricao,
            medida: papel.medida,
            gramatura: papel.gramatura,
            formato: papel.formato,
            uma_face: papel.uma_face,
            unitario: papel.unitario,
          }));

          var completaInsertePapel = document.getElementById('PapelsSelecionado');
          completaInsertePapel.innerHTML = '';
          completaInsertePapel.innerHTML += `
        <thead>
          <tr>
            <th>CODIGO</th>
            <th>DESCRIÇÃO</th>
            <th>MEDIDA</th>
            <th>GRAMA<br>TURA</th>
            <th>FORMATO</th>
            <th>UMA FACE</th>
            <th>VALOR</th>
            <th>SELECI<br>ONAR</th>
            <th>EDITAR</th>
          </tr>
        </thead>`;

          valores.forEach(result => {
            completaInsertePapel.innerHTML += `
          <tr>
            <td>${result.cod}</td>
            <td>${result.descricao}</td>
            <td>${result.medida}</td>
            <td>${result.gramatura}</td>
            <td>${result.formato}</td>
            <td>${result.uma_face}</td>
            <td>${result.unitario}</td>
            <td><input value="${result.cod}" class="form-check-input" id="Papel${result.cod}" onclick="selecionarPapel(this.id)" type="checkbox"></td>
            <td> <input class="form-check-input" type="checkbox" id="Editar${result.cod}" value="EDITAR" onclick="AbrirEditarPapel(this.id);"/></td>
          </tr>`;
          });
        });
    } else {
      if (pesquisa.value.length < 1) {
        abriPapels();
      }
    }
  })
}

async function pesquisarpapelcode() {
  const pesquisa = document.getElementById('pesquiarpapelCodigo');
  await pesquisa.addEventListener('keyup', valor => {
    if (pesquisa.value.length >= 1) {
      fetch('api_papel.php?cod=' + pesquisa.value)
        .then(response => response.json())
        .then(data => {
          let valores = data.map(papel => ({
            cod: papel.cod,
            descricao: papel.descricao,
            medida: papel.medida,
            gramatura: papel.gramatura,
            formato: papel.formato,
            uma_face: papel.uma_face,
            unitario: papel.unitario,
          }));

          var completaInsertePapel = document.getElementById('PapelsSelecionado');
          completaInsertePapel.innerHTML = '';
          completaInsertePapel.innerHTML += `
        <thead>
          <tr>
            <th>CODIGO</th>
            <th>DESCRIÇÃO</th>
            <th>MEDIDA</th>
            <th>GRAMA<br>TURA</th>
            <th>FORMATO</th>
            <th>UMA FACE</th>
            <th>VALOR</th>
            <th>SELECI<br>ONAR</th>
            <th>EDITAR</th>
          </tr>
        </thead>`;

          valores.forEach(result => {
            completaInsertePapel.innerHTML += `
          <tr>
            <td>${result.cod}</td>
            <td>${result.descricao}</td>
            <td>${result.medida}</td>
            <td>${result.gramatura}</td>
            <td>${result.formato}</td>
            <td>${result.uma_face}</td>
            <td>${result.unitario}</td>
             <th>EDITAR</th>
            <td><input value="${result.cod}" class="form-check-input" id="Papel${result.cod}" onclick="selecionarPapel(this.id)" type="checkbox"></td>
            <td> <input class="form-check-input" type="checkbox" id="Editar${result.cod}" value="EDITAR" onclick="AbrirEditarPapel(this.id);"/></td>
          </tr>`;
          });
        });
    } else {
      if (pesquisa.value.length < 1) {
        abriPapels();
      }
    }
  })
}

// funções do acabamento
function abriAcabamentos() {
  document.getElementById('load1').style.display = 'flex';
  fetch('api_acabamento.php')
    .then(response => response.json())
    .then(data => {
      let valores = data.map(Acabamento => ({
        CODIGO: Acabamento.CODIGO,
        MAQUINA: Acabamento.MAQUINA,
        ATIVA: Acabamento.ATIVA,
        CUSTO_HORA: Acabamento.CUSTO_HORA,
      }));

      var completaInserteAcabamento = document.getElementById('selecionarAcabamentos');
      completaInserteAcabamento.innerHTML = '';
      completaInserteAcabamento.innerHTML += `
        <thead>
          <tr>
          <th>CODIGO</th>
          <th>MÁQUINA</th>
          <th>CUSTO HORA</th>
          <th>SELECIONAR</th>
          <th>EDITAR</th>
          </tr>
        </thead>`;
      valores.forEach(result => {
        completaInserteAcabamento.innerHTML += `
          <tr>
            <td>${result.CODIGO}</td>
            <td>${result.MAQUINA}</td>
            <td>${result.CUSTO_HORA}</td>
            <td><input type="checkbox" class="form-check-input" id="Acaba${result.CODIGO}" value="${result.CODIGO}" onclick="selecionarAcabamento(this.id)"></td>
            <td> <input class="form-check-input" type="checkbox" id="Editar${result.CODIGO}" value="EDITAR" onclick="AbrirEditarAcabamento(this.id);"/></td>
          </tr>`;
      });
    });
  setTimeout(() => {
    document.getElementById('load1').style.display = 'none';
    checkedAcabamento();
  }, 1000)

}
if (localStorage.getItem('AcabamentoSelecionado')) {
  recuperarNomesAcabamento('selecionarAcabamentos');
}
function selecionarAcabamento(dado) {
  const selecionado = document.getElementById(dado);
  let valor = dado.replace(/\D/g, '');
  let cod_produto = 0;
  let completo = {
    cod_produto,
    valor
  }

  let AcabamentoSelecionado = localStorage.getItem('AcabamentoSelecionado');
  let arraySelecionados = AcabamentoSelecionado ? JSON.parse(AcabamentoSelecionado) : [];

  if (selecionado.checked == true) {
    document.getElementById('mensagemAcabamento').innerHTML = '<div  id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso. Acabamento Selecionado!</div></div>';

    // Adicionar o ID do item selecionado ao array de selecionados
    arraySelecionados.push(completo);
  } else {
    document.getElementById('mensagemAcabamento').innerHTML = '<div  id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Desmarcado. Acabamento Desmarcado!</div></div>';

    // Remover o ID do item desmarcado do array de selecionados
    arraySelecionados = arraySelecionados.filter(item => item.valor !== completo.valor);
  }

  // Salvar o array de selecionados no localStorage
  localStorage.setItem('AcabamentoSelecionado', JSON.stringify(arraySelecionados));

  setTimeout(function () {
    document.getElementById('mensagemAcabamento').innerHTML = '';
  }, 1000);
  recuperarNomesAcabamento('NovoAcabemtnoSe')
}

function AbrirEditarAcabamento(valor) {
  const select = document.getElementById(valor);
  const cadastraracabamento = document.getElementById('cadastrarAcabamento')
  const editaracabamento = document.getElementById('editarAcabamento')
  const acabamentoEditado = document.getElementById('idAcabamentoeditado');
  let numeros = valor.replace(/\D/g, ''); // Remove tudo que não for dígito
  if (select.checked == false) {
    cadastraracabamento.style.display = 'block';
    editaracabamento.style.display = 'none';
    document.getElementById('Nome_Acabamento').value = '';
    document.getElementById('valor_Acabamento').value = '';

  } else {
    document.getElementById('mensagemAcabamento').innerHTML = '<div  id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Acabamento Selecionado!</div></div>';

    cadastraracabamento.style.display = 'none';
    editaracabamento.style.display = 'block';
    acabamentoEditado.name = numeros;
    fetch(`api_acabamento.php?cod=${numeros}`)
      .then(response => response.json())
      .then(data => {
        let valores = data.map(acabamento => ({
          MAQUINA: acabamento.MAQUINA,
          CUSTO_HORA: acabamento.CUSTO_HORA,

        }));

        valores.forEach(result => {
          document.getElementById('Nome_Acabamento').value = result.MAQUINA;
          document.getElementById('valor_Acabamento').value = result.CUSTO_HORA;
        });
      });
  }

  setTimeout(function () {
    document.getElementById('mensagemAcabamento').innerHTML = '';
  }, 1000);
}
//SALVAR EDIÇÃO
async function EditarAcabamento() {
  const idacabamento = document.getElementById('idAcabamentoeditado').name;
  const Nome_acabamento = document.getElementById('Nome_Acabamento').value;
  const valor_acabamento = document.getElementById('valor_Acabamento').value;

  const response = await fetch('api_acabamento.php?atualiza='
    + idacabamento
    + '&nome=' + Nome_acabamento
    + '&valor_acabamento=' + valor_acabamento);
  const data = await response.json();
  if (data.Sucesso === true) {
    document.getElementById('mensagemAcabamento').innerHTML = '<div  id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso! Acabamento Editado!</div></div>';
  }
  const cadastraracabamento = document.getElementById('cadastrarAcabamento')
  const editaracabamento = document.getElementById('editarAcabamento')
  cadastraracabamento.style.display = 'block';
  editaracabamento.style.display = 'none';
  document.getElementById('Nome_Acabamento').value = '';
  document.getElementById('valor_Acabamento').value = '';

  setTimeout(function () {
    document.getElementById('mensagemAcabamento').innerHTML = '';
    abriAcabamentos();
  }, 1000);


}

async function pesquisaracabamento() {
  const pesquisa = document.getElementById('pesquiaracabamentonome');
  await pesquisa.addEventListener('keyup', valor => {
    if (pesquisa.value.length >= 3) {
      fetch('api_acabamento.php?nome=' + pesquisa.value)
        .then(response => response.json())
        .then(data => {
          let valores = data.map(Acabamento => ({
            CODIGO: Acabamento.CODIGO,
            MAQUINA: Acabamento.MAQUINA,
            ATIVA: Acabamento.ATIVA,
            CUSTO_HORA: Acabamento.CUSTO_HORA,
          }));

          var completaInserteAcabamento = document.getElementById('selecionarAcabamentos');
          completaInserteAcabamento.innerHTML = '';
          completaInserteAcabamento.innerHTML += `
          <thead>
            <tr>
            <th>CODIGO</th>
            <th>MÁQUINA</th>
            <th>CUSTO HORA</th>
            <th>SELECIONAR</th>
            <th>EDITAR</th>
            </tr>
          </thead>`;

          valores.forEach(result => {
            completaInserteAcabamento.innerHTML += `
            <tr>
              <td>${result.CODIGO}</td>
              <td>${result.MAQUINA}</td>
              <td>${result.CUSTO_HORA}</td>
              <td><input type="checkbox" class="form-check-input" id="Acaba${result.CODIGO}" value="${result.CODIGO}" onclick="selecionarAcabamento(this.id)"></td>
              <td> <input class="form-check-input" type="checkbox" id="Editar${result.CODIGO}" value="EDITAR" onclick="AbrirEditarAcabamento(this.id);"/></td>
            </tr>`;
          });
        });
    } else {
      if (pesquisa.value.length <= 1) {
        abriAcabamentos();
      }
    }
  })
}

async function pesquisaracabamentocode() {
  const pesquisa = document.getElementById('pesquiaracabamentoCodigo');
  await pesquisa.addEventListener('keyup', valor => {
    if (pesquisa.value.length >= 1) {
      fetch('api_acabamento.php?cod=' + pesquisa.value)
        .then(response => response.json())
        .then(data => {
          let valores = data.map(Acabamento => ({
            CODIGO: Acabamento.CODIGO,
            MAQUINA: Acabamento.MAQUINA,
            ATIVA: Acabamento.ATIVA,
            CUSTO_HORA: Acabamento.CUSTO_HORA,
          }));

          var completaInserteAcabamento = document.getElementById('selecionarAcabamentos');
          completaInserteAcabamento.innerHTML = '';
          completaInserteAcabamento.innerHTML += `
          <thead>
            <tr>
            <th>CODIGO</th>
            <th>MÁQUINA</th>
            <th>CUSTO HORA</th>
            <th>SELECIONAR</th>
            <th>EDITAR</th>
            </tr>
          </thead>`;

          valores.forEach(result => {
            completaInserteAcabamento.innerHTML += `
            <tr>
              <td>${result.CODIGO}</td>
              <td>${result.MAQUINA}</td>
              <td>${result.ATIVA}</td>
              <td>${result.CUSTO_HORA}</td>
              <td><input type="checkbox" class="form-check-input" id="Acaba${result.CODIGO}" value="${result.CODIGO}" onclick="selecionarAcabamento(this.id)"></td>
              <td> <input class="form-check-input" type="checkbox" id="Editar${result.CODIGO}" value="EDITAR" onclick="AbrirEditarAcabamento(this.id);"/></td>
            </tr>`;
          });
        });
    } else {
      abriAcabamentos();
    }
  })
}

// funções do serviço
function checkedServico() {
  const ArrayServicos = JSON.parse(localStorage.getItem('ServicoSelecionado'));
  if (document.getElementById('selecionarServicos')) {
    ArrayServicos.map((item) => {
      document.getElementById('Servi' + item).checked = true;
    })
  }
}
// abrir editar serviço
function AbrirEditarServico(valor) {
  const select = document.getElementById(valor);
  const cadastrarServico = document.getElementById('cadastrarServico')
  const editarServico = document.getElementById('editarServico')
  const ServicoEditado = document.getElementById('idservico');
  let numeros = valor.replace(/\D/g, ''); // Remove tudo que não for dígito
  if (select.checked == false) {
    cadastrarServico.style.display = 'block';
    editarServico.style.display = 'none';
    document.getElementById('Nome_Servico').value = '';
  document.getElementById('valor_min').value = '';
  document.getElementById('tipoServico').value = '';
  document.getElementById('Servico_Geral').checked = '';
  document.getElementById('valorUnitario').value = '';
  } else {
    document.getElementById('mensagemServico').innerHTML = '<div  id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Servico Selecionado!</div></div>';

    cadastrarServico.style.display = 'none';
    editarServico.style.display = 'block';
    ServicoEditado.name = numeros;
    fetch(`api_Servico.php?cod=${numeros}`)
      .then(response => response.json())
      .then(data => {
        let valores = data.map(Servico => ({
          cod: Servico.cod,
          descricao: Servico.descricao,
          min: Servico.valor_minimo,
          tipo: Servico.tipo_servico,
          geral: Servico.servico_geral,
          unitario: Servico.valor_unitario,
        }));

        valores.forEach(result => {
          document.getElementById('Nome_Servico').value = result.descricao;
          document.getElementById('valor_min').value = result.min;
          document.getElementById('tipoServico').value = result.tipo;
          if (+result.geral >= 1) {
            document.getElementById('Servico_Geral').checked = result.geral;
          }
          document.getElementById('valorUnitario').value = result.unitario;
        });
      });
  }

  setTimeout(function () {
    document.getElementById('mensagemServico').innerHTML = '';
  }, 1000);
}

// salvar editar serviço
async function EditarServico() {
  const idservico = document.getElementById('idservico').name;
  const Nome_Servico = document.getElementById('Nome_Servico').value;
  const valor_min = document.getElementById('valor_min').value;
  const valorUnitario = document.getElementById('valorUnitario').value;
  const tipoServico = document.getElementById('tipoServico').value;
  const Servico_Geral = document.getElementById('Servico_Geral').checked;
  console.log('api_servico.php?atualiza=' + idservico + '&nome=' + Nome_Servico
  + '&valorUnitario=' + valorUnitario
  + '&tipoServico=' + tipoServico
  + '&valor_min=' + valor_min
  + '&Servico_Geral=' + Servico_Geral);
  const response = await fetch('api_servico.php?atualiza=' + idservico + '&nome=' + Nome_Servico
    + '&valorUnitario=' + valorUnitario
    + '&tipoServico=' + tipoServico
    + '&valor_min=' + valor_min
    + '&Servico_Geral=' + Servico_Geral);
  const data = await response.json();
  if (data.Sucesso === true) {
    document.getElementById('mensagemServico').innerHTML = '<div  id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso! Servico Editado!</div></div>';
  }
  const cadastrarServico = document.getElementById('cadastrarServico');
  const editarServico = document.getElementById('editarServico');
  cadastrarServico.style.display = 'block';
  editarServico.style.display = 'none';
  document.getElementById('Nome_Servico').value = '';
  document.getElementById('valor_min').value = '';
  document.getElementById('tipoServico').value = '';
  document.getElementById('Servico_Geral').checked = '';
  document.getElementById('valorUnitario').value = '';
  setTimeout(function () {
    document.getElementById('mensagemServico').innerHTML = '';
    abriServicos();
  }, 1000);


}
function ApagarServicoSelecioando(valor) {
  // Defina o nome do item que você deseja remover
  var itemKey = valor;
  if (localStorage.getItem('ServicoSelecionado') != '[]' && localStorage.getItem('ServicoSelecionado') != null) {
    const Arrayservico = JSON.parse(localStorage.getItem('ServicoSelecionado'));
    if (document.getElementById('selecionarServicos')) {
      Arrayservico.map((item) => {
        document.getElementById('Servi' + item).checked = false;
      });
    }
    // Remova o item do localStorage
    localStorage.removeItem(itemKey);
    document.getElementById('mensagemServico').innerHTML = '<div  id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Seleção de serviços limpa com sucesso!</div></div>';

    recuperarNomesServico('tabelaAservicos');
    setTimeout(function () {
      document.getElementById('mensagemServico').innerHTML = '';
    }, 1000);
  }
}

function recuperarNomesServico(iddovalor) {
  let ServicoSelecionado = localStorage.getItem('ServicoSelecionado');
  let arraySelecionados = ServicoSelecionado ? JSON.parse(ServicoSelecionado) : [];

  let promises = arraySelecionados.map(id => {
    return fetch('api_servico.php?id=' + id)
      .then(response => response.json())
      .then(data => {
        return {
          cod: data.cod,
          descricao: data.descricao,
          valor_minimo: data.valor_minimo,
          valor_unitario: data.valor_unitario,
          servico_geral: data.servico_geral,
          tipo_servico: data.tipo_servico,
        };
      });
  });
  Promise.all(promises)
    .then(results => {
      let nomePapel = results.map(result => result.nomePapel).join(', ');
      // console.log(nomePapel); // Movido para dentro do bloco `then`
      // document.getElementById('nome_papel').value = nomePapel;

      const tableBody = document.getElementById(iddovalor);
      tableBody.innerHTML = '';
      tableBody.innerHTML += `
    <thead>
    <tr>
    <th>CÓDIGO SERVIÇO</th>
    <th>DESCRIÇÃO</th>
    <th>VALOR SERVIÇO</th>
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
          <td>${result.cod}</td>
          <td>${result.descricao}</td>
          <td>${result.valor_unitario}</td>
        </tr>`;
      });
    })
    .catch(error => {
      console.error('Erro ao recuperar nomes do Servico:', error);
    });
}

function selecionarServico(valor) {

  const selecionado = document.getElementById(valor);

  let ServicoSelecionado = localStorage.getItem('ServicoSelecionado');
  let arraySelecionados = ServicoSelecionado ? JSON.parse(ServicoSelecionado) : [];

  if (selecionado.checked) {
    document.getElementById('mensagemServico').innerHTML = '<div  id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso. Servico Selecionado!</div></div>';

    // Adicionar o ID do item selecionado ao array de selecionados
    arraySelecionados.push(selecionado.value);
  } else {
    document.getElementById('mensagemServico').innerHTML = '<div  id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Desmarcado. Servico Desmarcado!</div></div>';

    // Remover o ID do item desmarcado do array de selecionados
    arraySelecionados = arraySelecionados.filter(id => id !== selecionado.value);
  }

  // Salvar o array de selecionados no localStorage
  localStorage.setItem('ServicoSelecionado', JSON.stringify(arraySelecionados));

  setTimeout(function () {
    document.getElementById('mensagemServico').innerHTML = '';
  }, 1000);
  recuperarNomesServico('tabelaAservicos')
}

if (localStorage.getItem('ServicoSelecionado')) {
  recuperarNomesServico('tabelaAservicos');
}


function abriServicos() {
  document.getElementById('load1').style.display = 'flex';
  fetch('api_servico.php')
    .then(response => response.json())
    .then(data => {
      let valores = data.map(Servico => ({
        cod: Servico.cod,
        descricao: Servico.descricao,
        valor_minimo: Servico.valor_minimo,
        valor_unitario: Servico.valor_unitario,
        servico_geral: Servico.servico_geral,
        tipo_servico: Servico.tipo_servico,
      }));

      var completaInserteServico = document.getElementById('selecionarServicos');
      completaInserteServico.innerHTML = '';
      completaInserteServico.innerHTML += `
        <thead>
          <tr>
          <th>CODIGO</th>
          <th>DESCRIÇÃO</th>
          <th>VALOR MINIMO</th>
          <th>VALOR UNITÁRIO</th>
          <th>TIPO DO SERVIÇO</th>
          <th>SELECIONAR</th>
          <th>EDITAR</th>
          </tr>
        </thead>`;

      valores.forEach(result => {
        completaInserteServico.innerHTML += `
          <tr>
          <td>${result.cod}</td>
          <td>${result.descricao}</td>
          <td>${result.valor_minimo}</td>
          <td>${result.valor_unitario}</td>
          <td>${result.tipo_servico}</td>
          <td><input type="checkbox"  class="form-check-input" id="Servi${result.cod}" value="${result.cod}" onclick="selecionarServico(this.id);"></td>
          <td> <input class="form-check-input" type="checkbox" id="Editar${result.cod}" value="EDITAR" onclick="AbrirEditarServico(this.id);"/></td>
        </tr>`;
      });
    });
  setTimeout(() => {
    document.getElementById('load1').style.display = 'none';
    checkedServico();
  }, 1000)

}

async function pesquisarservico() {
  const pesquisa = document.getElementById('pesquiarserviconome');
  await pesquisa.addEventListener('keyup', valor => {
    if (pesquisa.value.length >= 3) {
      fetch('api_servico.php?nome=' + pesquisa.value)
        .then(response => response.json())
        .then(data => {
          let valores = data.map(Servico => ({
            cod: Servico.cod,
            descricao: Servico.descricao,
            valor_minimo: Servico.valor_minimo,
            valor_unitario: Servico.valor_unitario,
            servico_geral: Servico.servico_geral,
            tipo_servico: Servico.tipo_servico,
          }));

          var completaInserteServico = document.getElementById('selecionarServicos');
          completaInserteServico.innerHTML = '';
          completaInserteServico.innerHTML += `
          <thead>
            <tr>
            <th>CODIGO</th>
            <th>DESCRIÇÃO</th>
            <th>VALOR MINIMO</th>
            <th>VALOR UNITÁRIO</th>
            <th>TIPO DO SERVIÇO</th>
            <th>SELECIONAR</th>
            <th>EDITAR</th>
            </tr>
          </thead>`;

          valores.forEach(result => {
            completaInserteServico.innerHTML += `
            <tr>
              <td>${result.cod}</td>
              <td>${result.descricao}</td>
              <td>${result.valor_minimo}</td>
              <td>${result.valor_unitario}</td>
              <td>${result.tipo_servico}</td>
              <td><input type="checkbox"  class="form-check-input" id="Servi${result.cod}" value="${result.cod}" onclick="selecionarServico(this.id);"></td>
              <td> <input class="form-check-input" type="checkbox" id="Editar${result.cod}" value="EDITAR" onclick="AbrirEditarServico(this.id);"/></td>
            </tr>`;
          });
        });
    } else {
      if (pesquisa.value.length <= 1) {
        abriServicos();
      }
    }
  })
}

async function pesquisarservicocode() {
  const pesquisa = document.getElementById('pesquiarservicoCodigo');
  await pesquisa.addEventListener('keyup', valor => {
    if (pesquisa.value.length >= 1) {
      fetch('api_servico.php?cod=' + pesquisa.value)
        .then(response => response.json())
        .then(data => {
          let valores = data.map(Servico => ({
            cod: Servico.cod,
            descricao: Servico.descricao,
            valor_minimo: Servico.valor_minimo,
            valor_unitario: Servico.valor_unitario,
            servico_geral: Servico.servico_geral,
            tipo_servico: Servico.tipo_servico,
          }));

          var completaInserteServico = document.getElementById('selecionarServicos');
          completaInserteServico.innerHTML = '';
          completaInserteServico.innerHTML += `
          <thead>
            <tr>
            <th>CODIGO</th>
            <th>DESCRIÇÃO</th>
            <th>VALOR MINIMO</th>
            <th>VALOR UNITÁRIO</th>
            <th>TIPO DO SERVIÇO</th>
            <th>SELECIONAR</th>
            <th>EDITAR</th>
            </tr>
          </thead>`;

          valores.forEach(result => {
            completaInserteServico.innerHTML += `
            <tr>
              <td>${result.cod}</td>
              <td>${result.descricao}</td>
              <td>${result.valor_minimo}</td>
              <td>${result.valor_unitario}</td>
              <td>${result.tipo_servico}</td>
              <td><input type="checkbox"  class="form-check-input" id="Servi${result.cod}" value="${result.cod}" onclick="selecionarServico(this.id)"></td>
              <td> <input class="form-check-input" type="checkbox" id="Editar${result.cod}" value="EDITAR" onclick="AbrirEditarServico(this.id);"/></td>
            </tr>`;
          });
        });
    } else {
      abriServicos();
    }
  })
}

// FUNÇÕES PARA VALIDADAR CALCULO
setTimeout(function () {
  const elementos = document.querySelectorAll('.formato-impressao');

  elementos.forEach(function (elemento) {
    elemento.addEventListener('keydown', function (event) {
      // Verifique se o código da tecla pressionada não está na faixa dos números (48-57)
      if (event.keyCode < 48 || event.keyCode > 57 || event.key === '0') {
        elemento.classList.add('formato-impressao');
      } else {
        elemento.classList.remove('formato-impressao');
      }
    });
  });
}, 3000); // Atraso
function createJSONGerais() {
  // Create an empty JSON object
  const jsonObj = {};

  // Gather all the input values
  if (document.getElementById('NovoPP').checked) {
    jsonObj.tpp = 'PP';
  } else if (document.getElementById('NovoPE').checked) {
    jsonObj.tpp = 'PE';
  } else {
    jsonObj.tpp = '';
  }
  jsonObj.tipoecommerce = document.getElementById('NovoTipoCommerce').checked;
  jsonObj.tipoativo = document.getElementById('NovoTipoativo').checked;
  jsonObj.descricao = document.getElementById('Novodescricao').value;
  jsonObj.largura = document.getElementById('NovoNovolargura').value;
  jsonObj.altura = document.getElementById('Novoaltura').value;
  jsonObj.espessura = document.getElementById('Novoespessura').value;
  jsonObj.peso = document.getElementById('Novopeso').value;
  jsonObj.qtdfolhas = document.getElementById('Novoqtdfolhas').value;
  jsonObj.tipoproduto = document.getElementById('NovotipoProduto').value;

  // Other input values can be gathered similarly

  // Log the JSON object
  return jsonObj;
}
function createJSONValores() {
  // Create an empty JSON object
  const jsonObj = {};

  // Gather all the input values
  jsonObj.prevenda = document.getElementById('prev').checked;
  jsonObj.valorunitario = document.getElementById('valorunitario').value;
  jsonObj.valorpromo = document.getElementById('promo').checked ? document.getElementById('valorpromo').value : null;

  // Log the JSON object
  return jsonObj;
}
function createJsonEstoque() {
  const jsonObj = {};
  jsonObj.estoque = document.getElementById('qtdestoque').value;
  jsonObj.avisa = document.getElementById('avisoestoque').checked;
  jsonObj.aviso = document.getElementById('qtdaviso').value;

  return jsonObj;
}
function createJsonPedidos() {
  const jsonObj = {};
  jsonObj.pedidoMin = document.getElementById('qtdmin').value;
  jsonObj.pedidoavisa = document.getElementById('qtdmaxestoque').checked;
  jsonObj.pedidoMax = document.getElementById('qtdmax').value;

  return jsonObj;
}
// Call the function when the submit button is clicked
function Dados_Novo_Produto() {
  var tabela = document.getElementById('personalizaPapel');
  var tbodies = tabela.getElementsByTagName('tbody');
  var dadosJson = [];
  // Itera sobre cada tbody
  for (var t = 0; t < tbodies.length; t++) {

    var linhas = tbodies[t].getElementsByTagName('tr');

    // Itera sobre cada linha do tbody
    for (var i = 0; i < linhas.length; i++) {
      var linha = linhas[i];

      // Obtém as células da linha
      var celulas = linha.getElementsByTagName('td');

      // Cria um objeto JSON para armazenar os valores da linha
      var objetoJson = {
        CODIGO_PAPEL: celulas[1].innerText,
        DESCRICAO: celulas[2].innerText,
        TIPO: celulas[3].querySelector('select').value,
        CF: celulas[4].getElementsByTagName('input')[0].value,
        CV: celulas[5].getElementsByTagName('input')[0].value,
        FORMATO_IMPRESSAO: celulas[6].getElementsByTagName('input')[0].value,
        PERCA: celulas[7].getElementsByTagName('input')[0].value,
      };

      // Adiciona o objeto ao array
      dadosJson.push(objetoJson);
    }

  }

  // Converte o array para uma string JSON
  var jsonPapel = JSON.stringify(dadosJson);
 
  var tabela = document.getElementById('NovoAcabemtnoSe');
  var tbodies = tabela.getElementsByTagName('tbody');
  var dadosJson = [];

  for (var i = 0; i < tbodies.length; i++) {
    var linhas = tbodies[i].getElementsByTagName('tr');
      for (var j = 0; j < linhas.length; j++) {
        var linha = linhas[j];
        var celulas = linha.getElementsByTagName('td');
        console.log(celulas[0].getElementsByTagName('input')[0])
        // Get the input elements and their values
        var inputCodigoAcabamento = celulas[0].getElementsByTagName('input')[1];
        var objetoJson = {
          CODIGO_ACABAMENTO: inputCodigoAcabamento.value,
        };

        dadosJson.push(objetoJson);
      }
  }

  var EM_BRANCO = 0;
  var jsonAcabamento = JSON.stringify(dadosJson);
  var JsonDadosGeral = createJSONGerais();
  var JsonValores = createJSONValores();
  var JsonEstoque = createJsonEstoque();
  var JsonPedidos = createJsonPedidos();
  
  if (JsonDadosGeral.tpp === '') {
    window.alert('TIPO DE PRODUÇÃO É OBRIGATÓRIO');
    document.getElementById('tipo_de_produto_div').classList.add('erro')
    EM_BRANCO++;
  } else {
    document.getElementById('tipo_de_produto_div').classList.remove('erro')
  }
  if (JsonDadosGeral.descricao === '') {
    window.alert('DESCRIÇÃO DO PRODUTO É OBRIGATÓRIO');
    document.getElementById('descricao_div').classList.add('erro')
    EM_BRANCO++;
  }
  else {
    document.getElementById('descricao_div').classList.remove('erro')
  }
  if (JsonDadosGeral.largura === '') {
    window.alert('LARGURA DO PRODUTO É OBRIGATÓRIO');
    document.getElementById('largura_div').classList.add('erro')
    EM_BRANCO++;
  } else {
    document.getElementById('largura_div').classList.remove('erro')
  }
  if (JsonDadosGeral.altura === '') {
    window.alert('ALTURA DO PRODUTO É OBRIGATÓRIO');
    document.getElementById('altura_div').classList.add('erro')
    EM_BRANCO++;
  } else {
    document.getElementById('altura_div').classList.remove('erro')
  }
  if (JsonDadosGeral.espessura === '') {
    window.alert('ESPESSURA DO PRODUTO É OBRIGATÓRIO');
    document.getElementById('espessura_div').classList.add('erro')
    EM_BRANCO++;
  } else {
    document.getElementById('espessura_div').classList.remove('erro')
  }
  if (JsonDadosGeral.peso === '') {
    window.alert('PESO DO PRODUTO É OBRIGATÓRIO');
    document.getElementById('peso_div').classList.add('erro')
    EM_BRANCO++;
  } else {
    document.getElementById('peso_div').classList.remove('erro')
  }
  if (JsonDadosGeral.qtdfolhas === '') {
    window.alert('QUANTIDADE DE FOLHAS É OBRIGATÓRIO');
    document.getElementById('folhas_div').classList.add('erro')
    EM_BRANCO++;
  } else {
    document.getElementById('folhas_div').classList.remove('erro')
  }
  if (JsonDadosGeral.tipoproduto === 'SELECIONE') {
    window.alert('TIPO DO PRODUTO É OBRIGATÓRIO');
    document.getElementById('tipo_div').classList.add('erro')
    EM_BRANCO++;
  } else {
    document.getElementById('tipo_div').classList.remove('erro')
  }
  // if(jsonPapel.tipo[0] === 'SELECIONE'){
  //   window.alert('TIPO DO PAPEL É OBRIGATÓRIO');
  // } 
  if (EM_BRANCO == 0) {
    if (window.confirm(`VOCÊ CONFIRMA A QUANTIDADE DE PAGINAS DE "${JsonDadosGeral.qtdfolhas}"? \n
    E VOCÊ CONFIRMA O TIPO DO PRODUTO DE "${JsonDadosGeral.tipoproduto}"?
    \n (ISSO AFETARÁ NO CALCÚLO DE FOLHAS A SEREM UTILIZADAS)`)) {
      console.log(jsonAcabamento)
      console.log(jsonPapel)
      console.log(JsonDadosGeral)
      console.log(JsonValores)
      console.log(JsonEstoque)
      console.log(JsonPedidos)
      // create a new FormData object
      const url = 'api_cadastra_produto.php';
      const queryParams = new URLSearchParams({
        acabamento:jsonAcabamento,
        papel:jsonPapel,
        dadosGerais: JSON.stringify(JsonDadosGeral),
        valores: JSON.stringify(JsonValores),
        estoque: JSON.stringify(JsonEstoque),
        pedidos: JSON.stringify(JsonPedidos)
      });
      window.open(`${url}?${queryParams}`, '_blank');
      fetch(`${url}?${queryParams}`, {
        method: 'GET'
      })
      .then(response => {
          return response.json();
        })
      .then(data => {
          // handle the response from the server
          if(data.sucesso == true){
            window.alert(`PRODUTO CADASTRADO COM SUCESSO CÓDIGO ${data.cod} `)
            ApagarProdutoCloando();
          }
        })
      .catch(error => {
          // handle any errors that occurred
          console.error(error);
        });
    } else {
    
    }
  }
}