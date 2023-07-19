<?php  
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
        date_default_timezone_set('America/Sao_Paulo');
            $dataHora = date('d/m/Y H:i:s');
            $hoje = date('Y-m-d');
        if(isset($_GET['cod'])){
          $cod = $_GET['cod'];
           
            $_SESSION['msg'] = ' <div id="alerta"
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
                 Op cancelada com suscesso!     
            </div>
          </div>';
           
            $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Cancelou a OP $cod para solucuinar problemas' , '$cod_user' , '$dataHora')");
            $Atividade_Supervisao->execute();
           
            $atualizar_op = $conexao->prepare("UPDATE tabela_ordens_producao SET status = '13' WHERE cod = $cod ");
            $atualizar_op->execute();
            header("Location: resolver_expedicao.php");
        }else{
          header("Location: resolver_expedicao.php");
      }
        
    