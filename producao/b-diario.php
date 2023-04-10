<?php  
session_start();
include_once('../conexoes/conexao.php');
    if(isset($_POST['nome']) && isset($_POST['relatorio'])){

      
             
        $data = $_POST['data']; $op = $_POST['op']; $cliente = $_POST['cliente']; $servico = $_POST['servico']; $qtd = $_POST['qtd']; $material = $_POST['material']; 


        $autor = $_POST['nome'];
        $relatorio = $_POST['relatorio'];
        date_default_timezone_set('America/Sao_Paulo');
        $dataHora = date('d/m/Y H:i:s');
    echo "INSERT INTO relatorio_diario (atendente_relatorio , data_relatorio, desc_relatorio, op_rel, cliente_rel, servico_rel, qtd_rel,material_rel ) VALUES
    ( '$autor' , '$dataHora' , '$relatorio' , '$op', '$cliente', '$servico', '$qtd', '$material' )<br>";
        $Atividade_Supervisao = $conexao->prepare("INSERT INTO relatorio_diario (atendente_relatorio , data_relatorio, desc_relatorio, op_rel, cliente_rel, servico_rel, qtd_rel,material_rel ) VALUES
         ( '$autor' , '$dataHora' , '$relatorio' , '$op', '$cliente', '$servico', '$qtd', '$material' )");
       // $Atividade_Supervisao->execute();
    
        $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Adicionado Um Relatório' , '$autor' , '$dataHora')");
        $Atividade_Supervisao->execute();
        $_SESSION['msg'] = ' <div style=";" id="alerta<?=$a?>"
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
            Não foram Inseriodos os campos necessarios!   
        </div>
      </div>';
        header("Location: tl-relatorio-diario.php");
    }
    