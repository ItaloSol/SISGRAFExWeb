<?php //**   */ 
include_once('../conexoes/conexao.php');

$query_sd_posto = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos ORDER BY nome ASC "); 
$query_sd_posto->execute(); 
$i = 0;
 while($linha = $query_sd_posto->fetch(PDO::FETCH_ASSOC)) {
    $cod = $linha['cod'];
    $nome = $linha['nome']; 
    $nome_Fantasia = $linha['nome_fantasia'];
    $cnpj = $linha['cnpj'];
    $atividade = $linha['atividade'];
    $filial_coligada = $linha['filial_coligada'];
    $cod_atendente = $linha['cod_atendente'];
    $nome_atendente = $linha['nome_atendente'];
    $observacao = $linha['observacao'];
    $credito = $linha['credito'];
    $senha = $linha['senha'];
    $excluido = $linha['excluido'];
    $tOKEN = $linha['TOKEN'];
    $uLTIMO_ACESSO = $linha['ULTIMO_ACESSO'];
    $qTD_ACESSO = $linha['QTD_ACESSOS'];

    $Cod[$i] = $cod;
    $Nome[$i] = $nome;
    $Nome_Fantasia[$i] = $nome_Fantasia;
    $Cnpj[$i] = $cnpj;
    $Atividade[$i] =  $atividade;
    $Filial_Coligada[$i] = $filial_coligada;
    $Cod_Atendente[$i] = $cod_atendente;
    $Nome_Atendente[$i] = $nome_atendente;
    $Observacao[$i] = $observacao;
    $Credito[$i] = $credito;
    $Senha[$i] =  $senha;
    $Excluido[$i] = $excluido;
    $TOKEN[$i] = $tOKEN;
    $ULTIMO_ACESSO[$i] = $uLTIMO_ACESSO;
    $QTD_ACESSO[$i] = $qTD_ACESSO;
    $i++;
 }
$a = 0;
 
//    echo  '<table class="table table-hover">
//   <tr>
//     <th>Nome</th>
//     <th>Nome Fantasia</th>
//     <th>Cnpj</th>
//     <th>Atividade</th>
//     <th>Filial Coligada</th>
//     <th>Credito</th>
//     <th>Editar</th>
//   </tr>
//  ';
//   while($a < $i ){
//     echo ' <tr><td>'. $Nome[$a] . '</td><td>'. $Nome_Fantasia[$a] . '</td><td>'. $Cnpj[$a] . '</td><td>'. $Atividade[$a] . '</td><td>'. $Filial_Coligada[$a] . '</td>
//     <td>'. $Credito[$a] . '</td> <td><a href="editarcadastro.php?cod='.$Cod[$a].'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
//     <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
//     <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
//   </svg></a></td></tr>';
//     $a++;
// }
// echo '</table>';
   


 
   
 