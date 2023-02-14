<?php //**   */ 
include_once('../conexoes/conexao.php');

$query_sd_posto = $conexao->prepare("SELECT * FROM usuario_acessos u INNER JOIN tabela_atendentes a ON a.codigo_atendente = u.CODIGO_USR "); 
$query_sd_posto->execute(); 
$i = 0;
 while($linha = $query_sd_posto->fetch(PDO::FETCH_ASSOC)) {
    $Usuarios_Relacao[$i] = [
        'nome_atendente' => $linha['nome_atendente'],
        'DT_ULT_LOGIN' => $linha['DT_ULT_LOGIN'],
        'tipo_atendente' => $linha['tipo_atendente'],
        'ORC' => $linha['ORC'],
        'ORC_ADM' => $linha['ORC_ADM'],
        'PROD' => $linha['PROD'],
        'PROD_ADM' => $linha['PROD_ADM'],
        'EXP' => $linha['EXP'],
        'EXP_ADM' => $linha['EXP_ADM'],
        'FIN' => $linha['FIN'],
        'FIN_ADM' => $linha['FIN_ADM'],
        'EST' => $linha['EST'],
        'ORD' => $linha['ORD'],
    ];
    $i++;
 }
$a = 0;
echo ' <table border="2">
<tr>
    <th>Nome Atentende</th>
    <th>Tipo de<br> Atendente</th>
    <th>Nivel de Acesso</th>
    <th>Data do Ultimo Login</th>
    <th allign="center">&nbsp&nbsp&nbsp&nbsp&nbsp <br>Função &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>
</tr>';
while($i > $a){ 
 echo '
   
        <tr>
            <td>'.$Usuarios_Relacao[$a]['nome_atendente'].'</td>';
                if($Usuarios_Relacao[$a]['tipo_atendente'] == 'ADMINISTRADOR'){
                    echo '<td>ADMIN</td><td>';
                }else{
                    echo '<td>'.$Usuarios_Relacao[$a]['tipo_atendente'].'</td><td>';
                }
          
           
            if($Usuarios_Relacao[$a]['ORC'] == 1 || $Usuarios_Relacao[$a]['ORC_ADM'] == 1){
                echo 'Orçamentação / ';
            }
            if($Usuarios_Relacao[$a]['PROD'] == 1 || $Usuarios_Relacao[$a]['PROD_ADM'] == 1){
                echo 'Produção / ';
            }
            if($Usuarios_Relacao[$a]['EXP'] == 1 || $Usuarios_Relacao[$a]['EXP_ADM'] == 1){
                echo 'Expedição / <br>';
            }
            if($Usuarios_Relacao[$a]['FIN'] == 1 || $Usuarios_Relacao[$a]['FIN_ADM'] == 1){
                echo 'Financeiro / ';
            }
            if($Usuarios_Relacao[$a]['EST'] == 1 ){
                echo 'Estoque / ';
            }
            if($Usuarios_Relacao[$a]['ORD'] == 1 ){
                echo 'Ordenaça / ';
            }
            

echo '</td><td>'.$Usuarios_Relacao[$a]['DT_ULT_LOGIN'].'</td><td>                 </td></tr>
    
 ';
$a++;        
}
echo '</table>';