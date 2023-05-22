<?php

if(isset($_POST['id'])){
    session_start();
   
  include_once('../conexoes/conexao.php');
  include_once('../conexoes/conn.php');
  $id_usuario = $_POST['id'];
    $secao = $_POST['secao'];
    if($secao == 1){
        $atual = 'ACABAMENTO';
    }elseif($secao == 2){
        $atual = 'BANNER';
    }elseif($secao == 3){
        $atual = 'COMERCIAL / ORÇAMENTAÇÃO';
    }elseif($secao == 4){
        $atual = 'EXPEDIÇÃO';
    }elseif($secao == 5){
        $atual = 'GRAVAÇÃO DE CHAPAS';
    }elseif($secao == 6){
        $atual = 'IMPRESSAO DIGITAL';
    }elseif($secao == 12){
        $atual = 'INFORMÁTICA';
    }elseif($secao == 7){
        $atual = 'OFFSET';
    }elseif($secao == 8){
        $atual = 'PLOTTER';
    }elseif($secao == 9){
        $atual = 'PRÉ-IMPRESSAO';
    }elseif($secao == 10){
        $atual = 'SEÇÃO TÉCNICA';
    }elseif($secao == 11){
        $atual = 'TIPOGRAFIA';
    }elseif($secao == 13){
      $atual = 'FINANCEIRO';
  }

        $query = $conexao->prepare("UPDATE tabela_atendentes SET secao_atendente='$atual' 
      WHERE codigo_atendente = '$id_usuario' ");
      $query->execute();
        // echo "UPDATE tabela_atendentes SET secao_atendente='$atual' 
        // WHERE codigo_atendente = '$id_usuario'";
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
           Seção Cadastrada com Sucesso!    
      </div>
    </div>';
        header("Location: ../html/painel.php?p");
     
}else{
    echo 'invalido';
  $_SESSION['erro'] = ' <div style=";" id="alerta<?=$a?>"
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
       É necessario Selecionar uma Seção!     
  </div>
</div>';
                header("Location: secao.php?id=$id_usuario");
 }
