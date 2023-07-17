function CadastraPapel() {
  const Nome_papel = document.getElementById('Nome_papel').value.toUpperCase();
   const Mediada_Papel = document.getElementById('Mediada_Papel').value.toUpperCase();
     const Gramatura_Papel = document.getElementById('Gramatura_Papel').value.toUpperCase();
      const Fomato_Papel = document.getElementById('Fomato_Papel').value.toUpperCase();
      const valor_Papel = document.getElementById('valor_Papel').value.toUpperCase();
       const umaface_Papel = document.getElementById('umaface_Papel');
       let face_papel = 0;
       if(umaface_Papel.checked == true){
        face_papel = 1;
    }
    const mensagemPapel = document.getElementById('mensagemPapel');
      if(Nome_papel != '' && Mediada_Papel != '' && Gramatura_Papel != '' && Fomato_Papel != '' && valor_Papel != ''){
        console.log('cadastro_apapel.php?N='+ Nome_papel +'&M='+Mediada_Papel+'&G='+Gramatura_Papel+'&F='+Fomato_Papel+'&U='+face_papel+'&V='+valor_Papel)
      return fetch('cadastro_apapel.php?N='+ Nome_papel +'&M='+Mediada_Papel+'&G='+Gramatura_Papel+'&F='+Fomato_Papel+'&U='+face_papel+'&V='+valor_Papel).then(res => res.json()).then(result => {
        if(result['erro'] == false){
          setTimeout(() => {
            abriPapels()
            mensagemPapel.innerHTML = '';
          }, 1000);
          return mensagemPapel.innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso. Papel Cadastrado!</div></div>';
        }else{
          setTimeout(() => {
            mensagemPapel.innerHTML = '';
          }, 1000);
          return mensagemPapel.innerHTML = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">Não foi possivel salvar o papel!</div></div>';
        }
      })
    }else{
      setTimeout(() => {
        mensagemPapel.innerHTML = '';
      }, 1000);
      return mensagemPapel.innerHTML = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">É necessario completar todos os campos!</div></div>';
      
    }
}

function CadastraAcabamento() {
  const Nome_Acabamento = document.getElementById('Nome_Acabamento').value.toUpperCase();
      const valor_Acabamento = document.getElementById('valor_Acabamento').value.toUpperCase();
      
    const mensagemAcabamento = document.getElementById('mensagemAcabamento');
      if(Nome_Acabamento != '' && valor_Acabamento != ''){
      return fetch('cadastro_Acabamento.php?N='+ Nome_Acabamento +'&V='+valor_Acabamento).then(res => res.json()).then(result => {
        if(result['erro'] == false){
          setTimeout(() => {
            abriAcabamentos()
            mensagemAcabamento.innerHTML = '';
          }, 1000);
          return mensagemAcabamento.innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso. Acabamento Cadastrado!</div></div>';
        }else{
          setTimeout(() => {
            mensagemAcabamento.innerHTML = '';
          }, 1000);
          return mensagemAcabamento.innerHTML = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">Não foi possivel salvar o Acabamento!</div></div>';
        }
      })
    }else{
      setTimeout(() => {
        mensagemAcabamento.innerHTML = '';
      }, 1000);
      return mensagemAcabamento.innerHTML = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">É necessario completar todos os campos!</div></div>';
      
    }
}

function CadastraServico() {
  const Nome_Servico = document.getElementById('Nome_Servico').value.toUpperCase();
      const valorUnitario = document.getElementById('valorUnitario').value.toUpperCase();
      const tipoServico = document.getElementById('tipoServico').value.toUpperCase();
      const valor_min = document.getElementById('valor_min').value.toUpperCase();
      const Servico_Geral = document.getElementById('Servico_Geral').value.toUpperCase();
    const mensagemServico = document.getElementById('mensagemServico');
    console.log('cadastro_Servico.php?N='+ Nome_Servico +'&V='+valorUnitario+'&T='+tipoServico + '&M='+valor_min+'&G='+Servico_Geral)
      if(Nome_Servico != '' && valorUnitario != ''){
        
      return fetch('cadastro_Servico.php?N='+ Nome_Servico +'&V='+valorUnitario+'&T='+tipoServico + '&M='+valor_min+'&G='+Servico_Geral).then(res => res.json()).then(result => {
        if(result['erro'] == false){
          setTimeout(() => {
            abriServicos()
            mensagemServico.innerHTML = '';
          }, 1000);
          return mensagemServico.innerHTML = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso. Servico Cadastrado!</div></div>';
        }else{
          setTimeout(() => {
            mensagemServico.innerHTML = '';
          }, 1000);
          return mensagemServico.innerHTML = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">Não foi possivel salvar o Servico!</div></div>';
        }
      })
    }else{
      setTimeout(() => {
        mensagemServico.innerHTML = '';
      }, 1000);
      return mensagemServico.innerHTML = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">É necessario completar todos os campos!</div></div>';
      
    }
}