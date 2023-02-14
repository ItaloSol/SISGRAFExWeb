<?php
include_once("../html/navbar.php");

$versao = $conexao->prepare("SELECT * FROM versao WHERE CODIGO != '2.7.4' ORDER BY CODIGO DESC ");
$versao->execute();
$i = 0;
while ($linha = $versao->fetch(PDO::FETCH_ASSOC)) {
  $codi = $linha['CODIGO'];
  $atualiz = $linha['ATUALIZACAO'];
  $dat = $linha['DATA'];
  $stss = $linha['STATUS'];
  $ssobre = $linha['SOBRE'];

  $Codigo_Versao[$i] = $codi;
  $Atualizacao_Versao[$i] = $atualiz;
  $Data_Versao[$i] = $dat;
  $Status_Versao[$i] = $stss;
  $Sobre[$i] = $ssobre;
  $i++;
}
$a = 0;
?> <div class="row card p-3">
  <div class="container">
    <div class="col-md-12"> <?php
                            while ($i > $a) {

                              echo '<a  class="list-group-item list-group-item-action"
                ><b>' . $Codigo_Versao[$a] . ' </b>' . $Atualizacao_Versao[$a] . ' <br> <b class="alert-warning" >' . $Status_Versao[$a] . '</b> ' . date('d/m/y', strtotime($Data_Versao[$a])) . '<br><b> SOBRE:</b> ' . $Sobre[$a] . '</a
              >';


                              $a++;
                            }
                            ?>
      <div class=" atualizacoes-- "></div>
    </div>
  </div>
</div> <?php /*   */

        include_once("../html/navbar-dow.php"); ?>