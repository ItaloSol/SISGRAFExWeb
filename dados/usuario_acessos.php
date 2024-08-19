<?php //**   */ 
include_once('../conexoes/conexao.php');

$query_acesso = $conexao->prepare("SELECT * FROM usuario_acesso WHERE CODIGO_USR = '$cod_user'"); 
$query_acesso->execute(); 
$i = 0;
$Admin_User = 0;
 while($linha = $query_acesso->fetch(PDO::FETCH_ASSOC)) {
    $u_cod = $linha['CODIGO_USR'];
    $u_ORC = $linha['ORC'];
    $u_ORC_ADM = $linha['ORC_ADM'];
    $u_PROD = $linha['PROD'];
    $u_PROD_ADM = $linha['PROD_ADM'];
    $u_EXP = $linha['EXP'];
    $u_EXP_ADM = $linha['EXP_ADM'];
    $u_FIN = $linha['FIN'];
    $u_FIN_ADM = $linha['FIN_ADM'];
    $u_EST = $linha['EST'];
    $u_ORD = $linha['ORD'];

        $cod[$i] = $u_cod;
        $ORC[$i] = $u_ORC; 
        $ORC_ADM[$i] = $u_ORC_ADM;
        $PROD[$i] = $u_PROD;
        $PROD_ADM[$i] = $u_PROD_ADM;
        $EXP[$i] = $u_EXP;
        $EXP_ADM[$i] = $u_EXP_ADM;
        $FIN[$i] = $u_FIN;
        $FIN_ADM[$i] = $u_FIN_ADM;
        $EST[$i] = $u_EST;
        $ORD[$i] = $u_ORD;
        
    $i++;
 }
 $Total_Acessos = $i;

$a = 0;
while($a < $Total_Acessos){
  if($cod[$a] == $cod_user){
     $COD_I = $cod[$a]; 
     $ORC_I =     $ORC[$a]; 
     $ORC_ADM_I =       $ORC_ADM[$a]; 
     $PROD_I =       $PROD[$a]; 
     $PROD_ADM_I  =     $PROD_ADM[$a]; 
     $EXP_I =      $EXP[$a]; 
     $EXP_ADM_I =       $EXP_ADM[$a]; 
     $FIN_I  =     $FIN[$a]; 
     $FIN_ADM_I  =     $FIN_ADM[$a]; 
     $EST_I =       $EST[$a]; 
     $ORD_I =      $ORD[$a]; 
      if($ORC_ADM_I == '1' || $PROD_ADM_I == '1' ||$EXP_ADM_I == '1' ||$FIN_ADM_I == '1'){
         $Admin_User = 1;
      }
     $query_secao = $conexao->prepare("SELECT * FROM tabela_atendentes WHERE codigo_atendente = '$cod_user' "); 
$query_secao->execute(); 
$i = 0;
 if($linha2 = $query_secao->fetch(PDO::FETCH_ASSOC)) {
    $secao_user = $linha2['secao_atendente'];
 }

  }
  $a++;
}
if(!isset($PROD_I)){
   echo "<script>window.location = '../login/logout.php'</script>";
 }
   


 
   
 