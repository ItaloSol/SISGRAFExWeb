<?php 
include_once('../conexoes/conexao.php');


$Dados[0] = [ 'clique' => 2,  'papel' => 234,];
$Dados[1] = [ 'clique' => 4,  'papel' => 5600,];
$Dados[2] = [ 'clique' => 2,  'papel' => 525,];
$Dados[3] = [ 'clique' => 4,  'papel' => 3150,];
$Dados[4] = [ 'clique' => 2,  'papel' => 525,];
$Dados[5] = [ 'clique' => 4,  'papel' => 3150,];


$clique = 0;
$clique_total = 0;
for($i = 0; $i <= 5; $i++){
  $clique = $Dados[$i]['papel'] *  $Dados[$i]['clique'];
  echo 'Clique = ' . $clique . '<br>';
  $clique_total += $clique;
}
 echo '<b>Clique TOTAL</b>= ' . $clique_total . '<br>';
 echo 'Media = ' . $clique_total / $i;