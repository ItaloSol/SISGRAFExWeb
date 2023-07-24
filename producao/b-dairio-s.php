<?php  
session_start();
$cod_user = $_SESSION["usuario"][2];
date_default_timezone_set('America/Sao_Paulo');
  $dataHora = date('d/m/Y H:i:s');
include_once('../conexoes/conexao.php');

// FAZER UM INSERT
if(isset($_GET['novo'])){
  $cod_op = $_GET['novo'];
  $secao = $_POST['secao'];
  $operador1 = $_POST['operador1'];
  $operador2 = $_POST['operador2'];
  $atividade = $_POST['atividade'];
  $OBSERVACAO = $_POST['OBSERVACAO'];
  $data1 = $_POST['data1'];
  $data2 = $_POST['data2'];
  $data3 = $_POST['data3'];
  $query_resultado_geral = $conexao->prepare("INSERT INTO relatorio_diario (fk_op, secao, operador1, operador2, atividade, OBSERVACAO, data1, data2, data3) VALUES ($cod_op, '$secao', '$operador1', '$operador2', '$atividade', '$OBSERVACAO', '$data1', '$data2', '$data3')");
                        $query_resultado_geral->execute();
                        $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Acrescentou um controle de OP para $atividade' , '$cod_user' , '$dataHora')");
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
             Iserido com suscesso!     
        </div>
      </div>';
      header("Location: tl-relatorio-diario.php");
}

// CADASTRAR NOVO
if(isset($_GET['novoOP'])){
  $cod = $_POST['cod_op'];
  $buscar_igual = $conexao->prepare("SELECT * FROM relatorio_diario r INNER JOIN tabela_ordens_producao o ON o.cod = r.fk_op WHERE r.fk_op = $cod  ORDER BY r.fk_op DESC,r.data1 DESC");
  $buscar_igual->execute();
  $quantidade = $buscar_igual->rowCount();
  if($quantidade == 0){ 
  $cod_op = $_POST['cod_op'];
  $secao = $_POST['secao'];
  $operador1 = $_POST['operador1'];
  $operador2 = $_POST['operador2'];
  $atividade = $_POST['atividade'];
  $OBSERVACAO = $_POST['OBSERVACAO'];
  $data1 = $_POST['data1'];
  $data2 = $_POST['data2'];
  $data3 = $_POST['data3'];
  $query_resultado_geral = $conexao->prepare("INSERT INTO relatorio_diario (fk_op, secao, operador1, operador2, atividade, OBSERVACAO, data1, data2, data3) VALUES ($cod_op, '$secao', '$operador1', '$operador2', '$atividade', '$OBSERVACAO', '$data1', '$data2', '$data3')");
                        $query_resultado_geral->execute();
                        $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Iniciou um controle para OP $cod_op' , '$cod_user' , '$dataHora')");
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
            Cadastrado com suscesso!     
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
       JÁ EXISTE OP CADASTRADA
    </div>
  </div>';
    header("Location: tl-relatorio-diario.php");
  }
}

// EDITAR
if(isset($_GET['cod'])){
  $id_relatorio = $_GET['cod'];
  $operador1 = $_POST['operador1'];
  $operador2 = $_POST['operador2'];
  $atividade = $_POST['atividade'];
  $OBSERVACAO = $_POST['OBSERVACAO'];
  $data1 = $_POST['data1'];
  $data2 = $_POST['data2'];
  $data3 = $_POST['data3'];
  $query_resultado_geral = $conexao->prepare("UPDATE relatorio_diario SET operador1='$operador1', operador2='$operador2', atividade='$atividade', OBSERVACAO='$OBSERVACAO', data1='$data1', data2='$data2', data3='$data3' WHERE  id_relatorio= $id_relatorio;
  ");
                        $query_resultado_geral->execute();
                        $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Atualizou o diário de op para $atividade .' , '$cod_user' , '$dataHora')");
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
             Editada com suscesso!     
        </div>
      </div>';
      header("Location: tl-relatorio-diario.php");
}