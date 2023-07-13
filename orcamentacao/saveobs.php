<?php 
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
$cod = $_GET['cod'];
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$hoje = date('Y-m-d');

if(isset($_POST['observacao_orc'])){
    $obs = $_POST['observacao_orc'];
    $cod = $_POST['cod'];
    $query_aceitalas = $conexao->prepare("UPDATE tabela_orcamentos SET descricao = '$obs'  WHERE cod = '$cod' ");
    $query_aceitalas->execute();
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
                 Observação salva com sucesso!  
            </div>
          </div>';
    $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Atualizou a Observação do Orçamento $cod' , '$cod_user' , '$dataHora')");
    $Atividade_Supervisao->execute();
    header("Location: tl-orcamento.php?cod=$cod");
}