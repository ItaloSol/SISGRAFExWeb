<?php  
session_start();
$cod_user = $_SESSION["usuario"][2];
date_default_timezone_set('America/Sao_Paulo');
  $dataHora = date('d/m/Y H:i:s');
include_once('../conexoes/conexao.php');

    $a = 0;
    $f = 0;
    if($_POST['numeros'] > 0){
      $quantiade = $_POST['numeros'];
      while($a < $quantiade){
        if(isset($_POST['Selecionado'.$a])){ 
        $op_selecionada[$f] = $_POST['Selecionado'.$a]; 
        $f++;
        }
        $a++;
      }
      if($f > 0){
          $campo = $_POST['campo'];
          if(isset($_POST['datain'])){
            $data = $_POST['datain'];
          }else{
            if(isset($_POST['datatn'])){
              $data = $_POST['datatn'];
            }else{
              $_SESSION['msg'] = ' <div id="alerta<?=$a?>"
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
                  Nenhuma data Selecioanda!
              </div>
            </div>';
              header("Location: tl-relatorio-diario.php");
            }
          }
          for($i = 0; $i < $f; $i++){
            $OP =  $op_selecionada[$i];
          $query_ordens_Selecionada = $conexao->prepare("UPDATE tabela_ordens_producao SET $campo = '$data'
          WHERE cod = $OP");
          $query_ordens_Selecionada->execute();
          }
          $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Alterado algumas datas de entrega de OP para $data' , '$cod_user' , '$dataHora')");
        $Atividade_Supervisao->execute();
        $_SESSION['msg'] = ' <div id="alerta<?=$a?>"
        role="bs-toast"
        class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show "
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
             Alteração feita com suscesso!     
        </div>
      </div>';
      header("Location: tl-relatorio-diario.php");
      }else{
        $_SESSION['msg'] = ' <div id="alerta<?=$a?>"
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
            Nenhuma Op Selecioanda!
        </div>
      </div>';
        header("Location: tl-relatorio-diario.php");
      }

    }

   