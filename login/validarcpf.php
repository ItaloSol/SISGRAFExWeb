<?php

if(isset($_POST['id'])){
    session_start();
   
  include_once('../conexoes/conexao.php');
  include_once('../conexoes/conn.php');
    $cpf = $_POST['cpf'];
    $id_usuario = $_POST['id'];


function validaCPF($cpf = null) {

// Verifica se um número foi informado
if(empty($cpf)) {
    return false;
}

// Elimina possivel mascara
$cpf = preg_replace("/[^0-9]/", "", $cpf);
$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

// Verifica se o numero de digitos informados é igual a 11 
if (strlen($cpf) != 11) {
    return false;
}
// Verifica se nenhuma das sequências invalidas abaixo 
// foi digitada. Caso afirmativo, retorna falso
else if ($cpf == '00000000000' || 
    $cpf == '11111111111' || 
    $cpf == '22222222222' || 
    $cpf == '33333333333' || 
    $cpf == '44444444444' || 
    $cpf == '55555555555' || 
    $cpf == '66666666666' || 
    $cpf == '77777777777' || 
    $cpf == '88888888888' || 
    $cpf == '99999999999') {
    return false;
 // Calcula os digitos verificadores para verificar se o
 // CPF é válido
 } else {   
    
    for ($t = 9; $t < 11; $t++) {
        
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }

    return true;
}
}
 if(validaCPF($cpf) == 1){
    $query = $conexao->prepare("UPDATE tabela_atendentes SET cpf='$cpf' , validacao = '1'
  WHERE codigo_atendente = '$id_usuario' ");
  $query->execute();
    echo 'valido';
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
       CPF cadastrado com suscesso!     
  </div>
</div>';
$_SESSION["usuario"][5] = '1';
    header("Location: ../html/painel.php?p");
 }else{
    echo 'invalido';
  $_SESSION['erro'] = ' <div id="alerta<?=$a?>"
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
       CPF cadastrado é INVALIDO!     
  </div>
</div>';
				header("Location: cpf.php?id=$id_usuario");
 }
}
//// formatar CPFS errados no banco de dados
// $cpfs = $conexao->prepare("SELECT * FROM tabela_atendentes WHERE validacao = 1");
//  $cpfs->execute();
//  while ($linha = $cpfs->fetch(PDO::FETCH_ASSOC)) {
//   $B = $linha['codigo_atendente'];
//  // echo 'Nome: '. $linha['nome_atendente']. ' Cpf: '. $linha['cpf']. '<br>';
//   $cpf = $linha['cpf'];
//   $A = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cpf);
// //  echo '----------> '. $A . '<-------------------<br>';
//   $update_cpf = $conexao->prepare("UPDATE tabela_atendentes SET cpf = '$A' Where codigo_atendente = '$B'");
//  $update_cpf->execute();
//  }
