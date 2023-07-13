<?php
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
if(isset($_POST['cod'])){
    $cod = $_POST['cod'];
    $operador = $_POST['operador'];
    $codSts = $_POST['codSts'];
    $tipotrabalho = $_POST['tipotrabalho'];
    $prioridade = $_POST['prioridade'];
   $data = date('Y-m-d');
  ///  $cod_user;
  $operador =  explode(',',$operador);
               

    date_default_timezone_set('America/Sao_Paulo');
    $dataHora = date('d/m/Y H:i:s');
    
    $Consulta_Status = $conexao->prepare("SELECT status FROM tabela_ordens_producao WHERE cod = $cod ");
    $Consulta_Status->execute();
    while ($linha = $Consulta_Status->fetch(PDO::FETCH_ASSOC)) { 
      $Status_Atual = $linha['status'];
      $descricao = $_POST['descricao'];
    }
     // echo $codSts . ' ' . $cod;
        $salvar_edit_op = $conexao->prepare("UPDATE tabela_ordens_producao SET status = '$codSts' WHERE cod = $cod  ");
        $salvar_edit_op->execute();
      $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Numero op: $cod | status: $codSts | tipo do trabalho: $tipotrabalho | prioridade op: $prioridade ' , '$cod_user' , '$dataHora')");
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
      header("Location: tl-controle-expedicao.php?cod=$cod");
    

 
 
}else{
  header("Location: tl-controle-expedicao.php");
}