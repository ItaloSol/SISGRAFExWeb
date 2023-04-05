<?php
$query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE cod_emissor = '$cod_user' OR COD_ATENDENTE = '$cod_user' ");
$query_ordens_finalizadas->execute();
$i = 0;
$Atrasada_Do_OP = 0;
$Em_Nome_Op = 0;
$Entregues_Em_Op = 0;
$hoje_Notificacao = date('Y-m-d');
while ($linha = $query_ordens_finalizadas->fetch(PDO::FETCH_ASSOC)) {
  if ($linha['data_entrega'] < $hoje_Notificacao && $linha['status'] != 13 && $linha['status'] != 11 && $linha['status'] != 12 && $linha['status'] != 1 && $linha['status'] != 5 && $linha['status'] != 15 && $linha['status'] != 10 && $linha['status'] != 3 && $linha['status'] != 4 && $linha['status'] != 14) {
    $Atrasada_Do_OP++;
  }
  if ($linha['status'] == 11) {
    $Entregues_Em_Op++;
  }
  $Em_Nome_Op++;
}
$Metade = $Em_Nome_Op / 2;

if ($Entregues_Em_Op > $Metade) {
  $Resultado_Em_op = ' Entregues. Ótimo!';
} else {
  $Resultado_Em_op = ' Entregues. Você pode melhorar os resultados!';
}
$Anotacao = array();
if($Atrasada_Do_OP > 0){
  $Anotacao[0] = [
    'Mensagem' => $nome_user . ' Você possui o total de ' . $Atrasada_Do_OP . ' Op ATRASADAS',
    'cor' => 'primary',
  ];
}
if($Em_Nome_Op > 0){
  if(isset($Anotacao[0])){
    $Anotacao[1] = [
      'Mensagem' => ' Você Possui ' . $Em_Nome_Op . ' Op em seu nome <br> Entregues você possui ' . $Entregues_Em_Op . ' ' . $Resultado_Em_op . ' <br> Vá em "Notificações"!',
      'cor' => 'primary',
    ];
  }else{
    $Anotacao[0] = [
      'Mensagem' => ' Você Possui ' . $Em_Nome_Op . ' Op em seu nome <br> Entregues você possui ' . $Entregues_Em_Op . ' ' . $Resultado_Em_op . ' <br> Vá em "Notificações"!',
      'cor' => 'primary',
    ];
  }
  
}

// $Anotacao[2] = [
//   'cor' => 'primary',
//   'Mensagem' => ' Você Possui ' . $Em_Nome_Op . ' Op em seu nome <br> Entregues você possui ' . $Entregues_Em_Op . ' ' . $Resultado_Em_op . ' <br> Vá em "Notificações"!',
// ];
// $Anotacao[3] = [
//   'cor' => 'primary',
//   'Mensagem' => ' Você Possui ' . $Em_Nome_Op . ' Op em seu nome <br> Entregues você possui ' . $Entregues_Em_Op . ' ' . $Resultado_Em_op . ' <br> Vá em "Notificações"!',
// ];
//   $Anotacao[2] = [
//     'cor' => 'warnign',
//     'Mensagem' => 'Compo "data de entrega" foi alterado para o correto DATA DE <b>PREVISÃO</b> DE ENTREGA',
// ];


$not = count($Anotacao);
$a = 0;
while ($a < $not) { ?>
  <div id="alerta<?= $a ?>" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-info top-<?= $a ?> end-0 hide show bg-<?= $Anotacao[$a]['cor'] ?>" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <i class="bx bx-bell me-2"></i>
      <div class="me-auto fw-semibold">Aviso!</div>
      <small><?php
              $hoje_Anotacao = date('d/m/Y');
              echo $hoje_Anotacao; ?></small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <?=
      $Anotacao[$a]['Mensagem'];
      ?>
    </div>
  </div>
<?php $a++;
}

?>

<!-- Função para sumir avisos -->

<script>
  setTimeout(function() {
    document.getElementById("alerta0").style.display = "none";
  }, 9000);

  function hide() {
    document.getElementById("alerta0").style.display = "none";
  }
  setTimeout(function() {
    document.getElementById("alerta1").style.display = "none";
  }, 9000);

  function hide() {
    document.getElementById("alerta1").style.display = "none";
  }
</script>

<!-- Fim da Função de sumir avisos -->