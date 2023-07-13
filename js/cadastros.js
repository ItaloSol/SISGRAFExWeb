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
      if(Nome_papel.value != '' && Mediada_Papel.value != '' && Gramatura_Papel.value != '' && Fomato_Papel.value != '' && valor_Papel.value != ''){
        console.log('cadastro_apapel.php?N='+ Nome_papel +'&M='+Mediada_Papel+'&G='+Gramatura_Papel+'&F='+Fomato_Papel+'&U='+face_papel+'&V='+valor_Papel)
      return fetch('cadastro_apapel.php?N='+ Nome_papel +'&M='+Mediada_Papel+'&G='+Gramatura_Papel+'&F='+Fomato_Papel+'&U='+face_papel+'&V='+valor_Papel).then(res => res.json()).then(result => {
        console.log(result['erro']);
        if(result['erro'] == false){
          mensagemPapel.innerText = '<div id="alerta1" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Aviso!</div> <small> </small>  </div> <div class="toast-body">Sucesso. Papel Cadastrado!</div></div>';
        }else{
          return mensagemPapel.innerText = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">Não foi possivel salvar o papel!</div></div>';
        }
      })
    }else{
      return mensagemPapel.innerText = '<div id="alerta2" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true"> <div class="toast-header"> <i class="bx bx-bell me-2"></i> <div class="me-auto fw-semibold">Erro!</div> <small> </small>  </div> <div class="toast-body">É necessario completar todos os campos!</div></div>';
    }
}