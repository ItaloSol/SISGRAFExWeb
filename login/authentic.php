<?php
$duracao = 28800 ; 
ini_set('session.cookie_lifetime', $duracao);
ini_set('session.gc_maxlifetime', $duracao);
session_set_cookie_params($duracao);
session_cache_expire(480);
session_start();
require("../conexoes/conexao.php");

if ($_POST["usuario"] != '' && $_POST["password"] != '' && $conexao != null) {
  $Senha_md5 = md5($_POST["password"]);
  $query = $conexao->prepare("SELECT * FROM tabela_atendentes WHERE login_atendente = ? AND senha_atendente = ? ");
  $query->execute(array($_POST["usuario"], $Senha_md5));

  if ($query->rowCount()) {
    $user = $query->fetchAll(PDO::FETCH_ASSOC)[0];


    $_SESSION["usuario"] = array($user["nome_atendente"], $user["tipo_atendente"], $user["codigo_atendente"], $user["login_atendente"], $user['ativo'], $user['validacao'], $user['secao_atendente'], $user['cpf']);
    $_SESSION["SISGRAFEX"] = 'LOGADO NO SISGRAFEX';
    $_SESSION['pag'] = array(0, 0);
    $cod = $user["codigo_atendente"];
    if ($user['ativo'] == '0') {
      header('location: logout.php?i=0');
    }
    if ($user['validacao'] == 0) {
      echo "<script>window.location = 'cpf.php?id=" . $user['codigo_atendente'] . "'</script>";
    }
    if ($user['secao_atendente'] == null) {
      echo "<script>window.location = 'secao.php?id=" . $user['codigo_atendente'] . "'</script>";
    }
    date_default_timezone_set('America/Sao_Paulo');
    $hoje = date('Y-m-d H:i:s');
    $_SESSION["feedback"] = 'false';
    
    if ($user['feedback'] == '2') {
      $_SESSION["feedback"] = 'true';
    }
    $LOGIN = $conexao->prepare("UPDATE tabela_atendentes SET DT_ULT_LOGIN = '$hoje' WHERE codigo_atendente = '$cod' ");
    $LOGIN->execute();
    $i = 0;
    $versao = $conexao->prepare("SELECT * FROM versao WHERE CODIGO != '2.7.4' ORDER BY CODIGO DESC ");
    $versao->execute();
    $i = 0;
  //   $_SESSION['problema'] = '<div  style="   overflow-y: scroll;" id="alerta4"
  //   role="bs-toast"
  //   class=" bs-toast toast toast-placement-ex m-2 fade bg-danger top-0 start-50 translate-middle-x show "
  //   role="alert"
  //   aria-live="assertive"
  //   aria-atomic="true">
  //   <div class="toast-header">
  //     <i class="bx bx-bell me-2"></i>
  //     <div  class="me-auto fw-semibold">PASSANDO POR PROBLEMAS!</div>
  //     <small>
        
  //       </small>
  //     <button type="button" style="position: relative;" class="btn-close d-md-block" data-bs-dismiss="toast" aria-label="Close"></button>
  //   </div>
    
  //   <div class="toast-body">
  //   <div class="demo-inline-spacing mt-3">
  //   <div class="list-group list-group-flush ">
  //   <p>Informo que o nosso sistema está enfrentando algumas dificuldades na geração de relatórios. No entanto, estamos trabalhando arduamente para resolver o mais rápido possível.</p>
  //    <br> <div class="allign-center">Para mais informações consulte o <br> menu de <a " href="../atualizacao/tl-atualizacao.php"><span class="btn btn-primary" style="background-color:blue; color:white padding: 2px;">ATUALIZAÇÕES</span></a></div>
  //   </div>
  // </div>
  //   </div>
  // </div>';
    while ($linha = $versao->fetch(PDO::FETCH_ASSOC)) {
      $codi = $linha['CODIGO'];
      $atualiz = $linha['ATUALIZACAO'];
      $dat = $linha['DATA'];
      $stss = $linha['STATUS'];

      $Codigo_Versao[$i] = $codi;
      $Atualizacao_Versao[$i] = $atualiz;
      $Data_Versao[$i] = $dat;
      $Status_Versao[$i] = $stss;
      $i++;
    }
    $a = 0;
    while ($i > $a) {
      if ($a == 0) {
        $versao_VERSAO = '<a style="color: white;" href="../atualizacao/tl-atualizacao.php" class="list-group-item list-group-item-action"
                ><b>' . $Codigo_Versao[$a] . ' </b>' . $Atualizacao_Versao[$a] . ' <br> <b class="alert-warning" >' . $Status_Versao[$a] . '</b> ' . date('d/m/y', strtotime($Data_Versao[$a])) . '</a
              >';
      } else {
        $versao_VERSAO = $versao_VERSAO . '<a style="color: white;" href="../atualizacao/tl-atualizacao.php" class="list-group-item list-group-item-action"
                    ><b>' . $Codigo_Versao[$a] . ' </b>' . $Atualizacao_Versao[$a] . '<br> <b class="alert-warning"> ' . $Status_Versao[$a] . '</b> ' . date('d/m/y', strtotime($Data_Versao[$a])) . '</a
                  >';
      }

      $a++;
    }



    $_SESSION['atualizacoes'] = '<div  style="height:50em;   overflow-y: scroll;" id="alerta4"
            role="bs-toast"
            class=" bs-toast toast toast-placement-ex m-2 fade bg-danger top-0 start-50 translate-middle-x show "
            role="alert"
            aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header">
              <i class="bx bx-bell me-2"></i>
              <div  class="me-auto fw-semibold">ATUALIZAÇÕES!</div>
              <small>
                
                </small>
              <button type="button" style="position: relative;" class="btn-close d-md-block" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            
            <div class="toast-body">
            <div class="demo-inline-spacing mt-3">
            <div class="list-group list-group-flush ">
              
              ' . $versao_VERSAO . '
              
              V.' . $Codigo_Versao[0] . ' <br> <div class="allign-center">Para mais informações consulte o <br> menu de <a " href="../atualizacao/tl-atualizacao.php"><span class="btn btn-primary" style="background-color:blue; color:white padding: 2px;">ATUALIZAÇÕES</span></a></div>
            </div>
          </div>
            </div>
          </div>';
    echo "<script>window.location = '../html/painel.php?p'</script>";
  } else {
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
                Senha ou Usuario estão incorretos!     
            </div>
          </div>';
    echo "<script>window.location = '../index.php'</script>";
  }
} else {
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
             Algum dos campos não foram selecionados!     
        </div>
      </div>';
  echo "<script>window.location = '../index.php'</script>";
}
