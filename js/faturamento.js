  function calcular_faturado(valor){
        const preco = document.getElementById('valor_unitario');
        const total = valor * preco.value;
        return  document.getElementById('valor_faturado').value = total;

    }
    
    const quantidade = document.getElementById('quantidade');
    const preco = document.getElementById('valor_unitario');
    quantidade.addEventListener('keyup', value => {
        value.preventDefault()
        calcular_faturado(quantidade.value);
    })
   



    const modalidade = document.getElementById('frete');
    modalidade.addEventListener('click', valor => {
        valor.preventDefault()
        mudarFrete(modalidade.value);
    })
       
        function mudarFrete(valor){
            if(valor == '2'){
                return document.getElementById('transportador').value = 'EMPRESA BRASILEIRA DE CORREIOS E TELÉGRAFOS';
            }else{
                return document.getElementById('transportador').value = '';
            }
        }
    