<?php
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
if (isset($_POST['sim'])) {
  $cod = $_POST['cod'];
  $operador = $_POST['operador'];
  $codSts = $_POST['codSts'];
  $tipotrabalho = $_POST['tipotrabalho'];
  $prioridade = $_POST['prioridade'];
  $data = date('Y-m-d');
  $secao = $_POST['secao'];
  ///  $cod_user;
  $operador =  explode(',', $operador);


  $Todos_Staus = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE cod = '$cod' ");
  $Todos_Staus->execute();
  if ($linha = $Todos_Staus->fetch(PDO::FETCH_ASSOC)) {
    $stsOPPR = $linha['status'];
  }
  if ($codSts == '1') {
    // sec tec
    $staDe = "data_apr_cliente = '" . $data . "' ";
  }
  if ($codSts == '2') {
    // pre imp
    $staDe = "DT_ENTRADA_PRE_IMP = '" . $data . "' ";
  }
  if ($codSts == '3') {
    // diagramacao
    $staDe = "data_ent_tipografia = '" . $data . "' ";
  }
  if ($stsOPPR == '4') {
    // prova
    $staDe = "data_apr_cliente = '" . $data . "' ";
  }
  if ($codSts == '4') {
    // prova
    $staDe = "DT_ENTG_PROVA = '" . $data . "' ";
  }
  if ($codSts == '5') {
    // aprovacao cliente
    $staDe = "data_envio_div_cmcl = '" . $data . "' ";
  }
  if ($codSts == '6') {
    // offset
    $staDe = "data_ent_offset = '" . $data . "' ";
  }
  if ($codSts == '7') {
    // digital
    $staDe = "DT_ENT_DIGITAL = '" . $data . "' ";
  }
  if ($codSts == '8') {
    // tipografia
    $staDe = "data_ent_tipografia = '" . $data . "' ";
  }
  if ($codSts == '9') {
    // acabamamento
    $staDe = "data_ent_acabamento = '" . $data . "' ";
  }
   if($codSts == '10'){
  //     // expedicao
   $staDe = "DT_ENVIADO_EXPEDICAO = '".$data."' , secao_op = 'EXPEDIÇÃO'  ";
   }
   if ($codSts == '13') {
    // CTP
    $staDe = "DT_CANCELAMENTO = '" . $data . "' ";
  }
   if($codSts == '17'){
    //     // expedicao
     $staDe = "DT_ENVIADO_EXPEDICAO = '".$data."' , secao_op = 'EXPEDIÇÃO' ";
     }
  if ($codSts == '14') {
    // CTP
    $staDe = "DT_ENTRADA_CTP = '" . $data . "' ";
  }
  if ($codSts == '15') {
    // esperando arquivo
    $staDe = "data_envio_div_cmcl = '" . $data . "' ";
  }
  if ($codSts == '16') {
    // plotter
    $staDe = "DT_ENTRADA_PLOTTER = '" . $data . "' ";
  }
  if ($codSts == '18') {
    // plotter
    $staDe = "DT_SUSPENDIDA = '" . $data . "' ";
  }
  if ($codSts == '19') {
    // plotter
    $staDe = "DT_ENCAMINHADO_FORA = '" . $data . "' ";
  }

  if (isset($_POST['D_emiss'])) {
    if ($_POST['D_emiss'] != '') {
    // echo $_POST['D_emiss'];
    if (isset($Where)) {
      $Where = $Where . " , " . "data_emissao = '" . $_POST['D_emiss'] . "'";
    } else {
      $Where = "data_emissao = '" . $_POST['D_emiss'] . "'";
    }
    $Where = "data_emissao = '" . $_POST['D_emiss'] . "'";
  }
  }
  if (isset($_POST['D_apr_cliente'])) {
    if ($_POST['D_apr_cliente'] != '') {
    if (isset($Where)) {
      $Where = $Where . " , " . "data_apr_cliente = '" . $_POST['D_apr_cliente'] . "'";
    } else {
      $Where = "data_apr_cliente = '" . $_POST['D_apr_cliente'] . "'";
    }
    // echo $_POST['D_apr_cliente']."'";
  }
  }
  if (isset($_POST['D_imposta_dir'])) {
    if ($_POST['D_imposta_dir'] != '') {
    // echo $_POST['D_imposta_dir']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "data_imp_dir = '" . $_POST['D_imposta_dir'] . "'";
    } else {
      $Where = "data_imp_dir = '" . $_POST['D_imposta_dir'] . "'";
    }
  }
  }
  if (isset($_POST['D_expedicao'])) {
    if ($_POST['D_expedicao'] != '') {
    // echo $_POST['D_expedicao']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "DT_ENVIADO_EXPEDICAO = '" . $_POST['D_expedicao'] . "'";
    } else {
      $Where = "DT_ENVIADO_EXPEDICAO = '" . $_POST['D_expedicao'] . "'";
    }
  }
  }
  if (isset($_POST['D_prova_pre'])) {
    if ($_POST['D_prova_pre'] != '') {
    if (isset($Where)) {
      $Where = $Where . " , " . "DT_ENTRADA_PRE_IMP_PROVA = '" . $_POST['D_prova_pre'] . "'";
    } else {
      $Where = "DT_ENTRADA_PRE_IMP_PROVA = '" . $_POST['D_prova_pre'] . "'";
    }
    }
  }
  if (isset($_POST['D_prova_tipo'])) {
    if ($_POST['D_prova_tipo'] != '') {
    // echo $_POST['D_prova_tipo']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "DT_TIPOGRAFIA_PROVA = '" . $_POST['D_prova_tipo'] . "'";
    } else {
      $Where = "DT_TIPOGRAFIA_PROVA = '" . $_POST['D_prova_tipo'] . "'";
    }
  }
  }
  if (isset($_POST['D_prova_acabame'])) {
    if ($_POST['D_prova_acabame'] != '') {
    // echo $_POST['D_prova_acabame']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "DT_ACABAMENTO_PROVA = '" . $_POST['D_prova_acabame'] . "'";
    } else {
      $Where = "DT_ACABAMENTO_PROVA = '" . $_POST['D_prova_acabame'] . "'";
    }
  }
  }
  if (isset($_POST['D_prova_1'])) {
    if ($_POST['D_prova_1'] != '') {
    // echo $_POST['D_prova_1']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "data_1a_prova = '" . $_POST['D_prova_1'] . "'";
    } else {
      $Where = "data_1a_prova = '" . $_POST['D_prova_1'] . "'";
    }
  }
  }
  if (isset($_POST['D_prova_2'])) {
    if ($_POST['D_prova_2'] != '') {
    // echo $_POST['D_prova_2']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "data_2a_prova = '" . $_POST['D_prova_2'] . "'";
    } else {
      $Where = "data_2a_prova = '" . $_POST['D_prova_2'] . "'";
    }
  }
  }
  if (isset($_POST['D_prova_3'])) {
    if ($_POST['D_prova_3'] != '') {
    // echo $_POST['D_prova_3']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "data_3a_prova = '" . $_POST['D_prova_3'] . "'";
    } else {
      $Where = "data_3a_prova = '" . $_POST['D_prova_3'] . "'";
    }
  }
  }
  if (isset($_POST['D_prova_4'])) {
    if ($_POST['D_prova_4'] != '') {
    // echo $_POST['D_prova_4']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "data_4a_prova = '" . $_POST['D_prova_4'] . "'";
    } else {
      $Where = "data_4a_prova = '" . $_POST['D_prova_4'] . "'";
    }
  }
  }
  if (isset($_POST['D_entrada_pre'])) {
    if ($_POST['D_entrada_pre'] != '') {
    // echo $_POST['D_entrada_pre']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "DT_ENTRADA_PRE_IMP = '" . $_POST['D_entrada_pre'] . "'";
    } else {
      $Where = "DT_ENTRADA_PRE_IMP = '" . $_POST['D_entrada_pre'] . "'";
    }
  }
  }
  if (isset($_POST['D_entrada_digital'])) {
    if ($_POST['D_entrada_digital'] != '') {
    // echo $_POST['D_entrada_digital']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "DT_ENT_DIGITAL = '" . $_POST['D_entrada_digital'] . "'";
    } else {
      $Where = "DT_ENT_DIGITAL = '" . $_POST['D_entrada_digital'] . "'";
    }
  }
  }
  if (isset($_POST['D_entrada_off'])) {
    if ($_POST['D_entrada_off'] != '') {
    // echo $_POST['D_entrada_off']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "data_ent_offset = '" . $_POST['D_entrada_off'] . "'";
    } else {
      $Where = "data_ent_offset = '" . $_POST['D_entrada_off'] . "'";
    }
  }
  }
  if (isset($_POST['D_entradactp'])) {
    if ($_POST['D_entradactp'] != '') {
    // echo $_POST['D_entradactp']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "DT_ENTRADA_CTP = '" . $_POST['D_entradactp'] . "'";
    } else {
      $Where = "DT_ENTRADA_CTP = '" . $_POST['D_entradactp'] . "'";
    }
  }
  }
  if (isset($_POST['D_entrada_tipo'])) {
    if ($_POST['D_entrada_tipo'] != '') {
    // echo $_POST['D_entrada_tipo']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "data_ent_tipografia = '" . $_POST['D_entrada_tipo'] . "'";
    } else {
      $Where = "data_ent_tipografia = '" . $_POST['D_entrada_tipo'] . "'";
    }
  }
  }
  if (isset($_POST['D_entrada_acabamento'])) {
    if ($_POST['D_entrada_acabamento'] != '') {
    // echo $_POST['D_entrada_acabamento']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "data_ent_acabamento = '" . $_POST['D_entrada_acabamento'] . "'";
    } else {
      $Where = "data_ent_acabamento = '" . $_POST['D_entrada_acabamento'] . "'";
    }
  }
  }
  if (isset($_POST['D_entrada_PLOTTER'])) {
    if ($_POST['D_entrada_PLOTTER'] != '') {
    // echo $_POST['D_entrada_PLOTTER']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "DT_ENTRADA_PLOTTER = '" . $_POST['D_entrada_PLOTTER'] . "'";
    } else {
      $Where = "DT_ENTRADA_PLOTTER = '" . $_POST['D_entrada_PLOTTER'] . "'";
    }
  }
  }

  if (isset($_POST['D_SAIDA_pre'])) {
    if ($_POST['D_SAIDA_pre'] != '') {
    // echo $_POST['D_SAIDA_pre']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "SAIDA_PRE = '" . $_POST['D_SAIDA_pre'] . "'";
    } else {
      $Where = "SAIDA_PRE = '" . $_POST['D_SAIDA_pre'] . "'";
    }
  }
  }
  if (isset($_POST['D_SAIDA_digital'])) {
    if ($_POST['D_SAIDA_digital'] != '') {
    // echo $_POST['D_SAIDA_digital']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "SAIDA_DIGITAL = '" . $_POST['D_SAIDA_digital'] . "'";
    } else {
      $Where = "SAIDA_DIGITAL = '" . $_POST['D_SAIDA_digital'] . "'";
    }
  }
  }
  if (isset($_POST['D_SAIDA_off'])) {
    if ($_POST['D_SAIDA_off'] != '') {
    // echo $_POST['D_SAIDA_off']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "SAIDA_OFFSET = '" . $_POST['D_SAIDA_off'] . "'";
    } else {
      $Where = "SAIDA_OFFSET = '" . $_POST['D_SAIDA_off'] . "'";
    }
  }
  }
  if (isset($_POST['D_SAIDActp'])) {
    if ($_POST['D_SAIDActp'] != '') {
    // echo $_POST['D_SAIDActp']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "SAIDA_CTP = '" . $_POST['D_SAIDActp'] . "'";
    } else {
      $Where = "SAIDA_CTP = '" . $_POST['D_SAIDActp'] . "'";
    }
  }
  }
  if (isset($_POST['D_SAIDA_tipo'])) {
    if ($_POST['D_SAIDA_tipo'] != '') {
    // echo $_POST['D_SAIDA_tipo']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "SAIDA_TIPOGRAFIA = '" . $_POST['D_SAIDA_tipo'] . "'";
    } else {
      $Where = "SAIDA_TIPOGRAFIA = '" . $_POST['D_SAIDA_tipo'] . "'";
    }
  }
  }
  if (isset($_POST['D_SAIDA_acabamento'])) {
    if ($_POST['D_SAIDA_acabamento'] != '') {
    // echo $_POST['D_SAIDA_acabamento']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "SAIDA_ACABAMENTO = '" . $_POST['D_SAIDA_acabamento'] . "'";
    } else {
      $Where = "SAIDA_ACABAMENTO = '" . $_POST['D_SAIDA_acabamento'] . "'";
    }
  }
  }
  if (isset($_POST['D_SAIDA_PLOTTER'])) {
    if ($_POST['D_SAIDA_PLOTTER'] != '') {
    // echo $_POST['D_SAIDA_PLOTTER']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "SAIDA_PLOTTER = '" . $_POST['D_SAIDA_PLOTTER'] . "'";
    } else {
      $Where = "SAIDA_PLOTTER = '" . $_POST['D_SAIDA_PLOTTER'] . "'";
    }
  }
  }

  if (isset($_POST['D_saida_expedicao'])) {
    if ($_POST['D_saida_expedicao'] != '') {
    // echo $_POST['D_saida_expedicao']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "DT_SAIDA_EXPEDICAO = '" . $_POST['D_saida_expedicao'] . "'";
    } else {
      $Where = "DT_SAIDA_EXPEDICAO = '" . $_POST['D_saida_expedicao'] . "'";
    }
  }
  }
  if (isset($_POST['D_data_entrega'])) {
    if ($_POST['D_data_entrega'] != '') {
    // echo $_POST['D_data_entrega']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "data_entrega = '" . $_POST['D_data_entrega'] . "'";
    } else {
      $Where = "data_entrega = '" . $_POST['D_data_entrega'] . "'";
    }
  }
  }
  if (isset($_POST['data_entrega_prova'])) {
    if ($_POST['data_entrega_prova'] != '') {
    // echo $_POST['D_data_entrega']."'";
    if (isset($Where)) {
      $Where = $Where . " , " . "data_entrega_prova = '" . $_POST['data_entrega_prova'] . "'";
    } else {
      $Where = "data_entrega_prova = '" . $_POST['data_entrega_prova'] . "'";
    }
  }
  }
 
  date_default_timezone_set('America/Sao_Paulo');
  $dataHora = date('d/m/Y H:i:s');
  $Todos_Staus = $conexao->prepare("SELECT * FROM sts_op WHERE CODIGO = '$codSts' ");
  $Todos_Staus->execute();
  while ($linha = $Todos_Staus->fetch(PDO::FETCH_ASSOC)) {
    $NOVOS_Sts = $linha['STS_DESCRICAO'];
  }

  $Consulta_Status = $conexao->prepare("SELECT status FROM tabela_ordens_producao WHERE cod = $cod ");
  $Consulta_Status->execute();
  while ($linha = $Consulta_Status->fetch(PDO::FETCH_ASSOC)) {
    $Status_Atual = $linha['status'];
  }


  $descricao = $_POST['descricao'];

  if ($codSts == '10' || $codSts == '17') {
    $Consulta_Solicitacao = $conexao->prepare("SELECT * FROM aceita_op WHERE codigo_op = $cod AND aceitacao != 'NAO'");
    $Consulta_Solicitacao->execute();
    while ($linha = $Consulta_Solicitacao->fetch(PDO::FETCH_ASSOC)) {
      $existe = $linha['codigo_op'];
    }
    if (isset($existe)) {
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
          Jé existe uma Solicitação de Movimentação da Op feita! <br> Confira com a expedição!     
        </div>
      </div>';
      header("Location: tl-controle-op.php?cod=$cod");
    }

    $salvar_edit_op = $conexao->prepare("INSERT INTO aceita_op (codigo_op, data_solicitacao, status_op, encaminhado_op, aceitacao) VALUES ('$cod', '$dataHora','$Status_Atual','$codSts','ESPERANDO')");
    $salvar_edit_op->execute();
    $atualizar_op = $conexao->prepare("UPDATE tabela_ordens_producao SET status = '17' WHERE cod = $cod ");
    $atualizar_op->execute();
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
           Solicitação de Movimentação da Op feita com suscesso!     
      </div>
    </div>';
    $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Solicitou o Envio para expedição a Op | Numero op: $cod  | tipo do trabalho: $tipotrabalho' , '$cod_user' , '$dataHora')");
    $Atividade_Supervisao->execute();
    header("Location: tl-controle-op.php?cod=$cod");
  } else {
    if (!isset($staDe)) {
      $staDe = '';
    }


    if (isset($operador[1])) {
      $op = $operador[1];
      $op_ = $operador[0];
      if(!isset($Where)){
        $salvar_edit_op = $conexao->prepare("UPDATE tabela_ordens_producao SET status = '$codSts'  , op_secao = '$op', secao_op = '$secao' , prioridade_op = '$prioridade' , descricao = '$descricao' , COD_ATENDENTE = '$op_' , tipo_trabalho = '$tipotrabalho' , $staDe WHERE cod = $cod  ");
      }else{
      $salvar_edit_op = $conexao->prepare("UPDATE tabela_ordens_producao SET status = '$codSts'  , op_secao = '$op', secao_op = '$secao' , prioridade_op = '$prioridade' , descricao = '$descricao' , COD_ATENDENTE = '$op_' , tipo_trabalho = '$tipotrabalho' , $Where , $staDe WHERE cod = $cod  ");

      }
    } else {
      if(!isset($Where)){
        $salvar_edit_op = $conexao->prepare("UPDATE tabela_ordens_producao SET status='$codSts', tipo_trabalho='$tipotrabalho' , secao_op = '$secao' , prioridade_op = '$prioridade' , descricao = '$descricao' , $staDe WHERE  cod=$cod");
      }else{
      $salvar_edit_op = $conexao->prepare("UPDATE tabela_ordens_producao SET status='$codSts', tipo_trabalho='$tipotrabalho' , secao_op = '$secao' , prioridade_op = '$prioridade' , descricao = '$descricao', $Where , $staDe WHERE  cod=$cod");
      }
    }
    //  echo "INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Numero op: $cod | status: $codSts - $NOVOS_Sts  | tipo do trabalho: $tipotrabalho | prioridade op: $prioridade ' , '$cod_user' , '$dataHora'";
    $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Numero op: $cod | status: $codSts - $NOVOS_Sts  | tipo do trabalho: $tipotrabalho | prioridade op: $prioridade ' , '$cod_user' , '$dataHora')");
    $Atividade_Supervisao->execute();
    $salvar_edit_op->execute();
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
    header("Location: tl-controle-op.php?cod=$cod");
  }
} else {
  header("Location: tl-controle-op.php");
}
