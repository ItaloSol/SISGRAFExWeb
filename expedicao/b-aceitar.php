<?php  
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
    if(isset($_GET['s'])){
        $id = $_GET['id'];
        $cod = $_GET['c'];
        date_default_timezone_set('America/Sao_Paulo');
            $dataHora = date('d/m/Y H:i:s');
            $hoje = date('Y-m-d');
        if($_GET['s'] == 'ACEITAR'){
            $query_aceitalas = $conexao->prepare("UPDATE aceita_op SET data_aceitacao_negacao = '$dataHora' , aceitacao = 'SIM' WHERE id_espera = '$id' ");
            $query_aceitalas->execute();

            $atualizar_op = $conexao->prepare("UPDATE tabela_ordens_producao SET status = '10' , DT_ENVIADO_EXPEDICAO = '$hoje' WHERE cod = $cod ");
            $atualizar_op->execute();
            $_SESSION['msg'] = ' <div style=";" id="alerta"
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
                 Op aceita com suscesso!     
            </div>
          </div>';
          $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Aceitou a Op $cod na expedição' , '$cod_user' , '$dataHora')");
        $Atividade_Supervisao->execute();
            header("Location: aceitar.php");
        }
        if($_GET['s'] == 'NEGAR'){
            $query_aceitalas = $conexao->prepare("UPDATE aceita_op SET data_aceitacao_negacao = '$dataHora' , aceitacao = 'NAO' WHERE id_espera = '$id' ");
            $query_aceitalas->execute();
            $_SESSION['msg'] = ' <div style=";" id="alerta"
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
                 Op recusada com suscesso!     
            </div>
          </div>';
            header("Location: aceitar.php");
            $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Negou a Op $cod na expedição' , '$cod_user' , '$dataHora')");
            $Atividade_Supervisao->execute();
            $query_negar = $conexao->prepare("SELECT * FROM aceita_op a INNER JOIN tabela_ordens_producao o ON a.codigo_op = o.cod WHERE aceitacao != 'NAI' AND cod = '$cod' ");
                            $query_negar->execute();
                            while ($linha = $query_negar->fetch(PDO::FETCH_ASSOC)) {
                              $status = $linha['status_op']; 
                            }
            $atualizar_op = $conexao->prepare("UPDATE tabela_ordens_producao SET status = '$status' , secao_op = 'SEÇÃO TÉCNICA' WHERE cod = $cod ");
            $atualizar_op->execute();
        }
        
    }else{
        header("Location: aceitar.php");
    }