<?php

    session_start();
    if(isset($_GET['i'])){
      unset($_SESSION['usuario']);
        $_SESSION['msg'] = ' <div style=";" id="alerta<?=$a?>"
        role="bs-toast"
        class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show "
        role="alert"
        aria-live="assertive"
        aria-atomic="true">
        <div class="toast-header">
          <i class="bx bx-bell me-2"></i>
          <div class="me-auto fw-semibold">Aviso!</div>
          <small>
            
            </small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        
        <div class="toast-body">
            Conta esta Desativada, faça a solicitação de ativação na seç Informática!    
        </div>
      </div>';
    echo "<script>window.location = '../index.php?i=0'</script>";
    }else{
        session_destroy();

        echo "<script>window.location = '../index.php'</script>";
    }
    
?>