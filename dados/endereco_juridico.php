<?php //**   */ //**   */ //**   */ 

// if(isset($_SESSION['codOm'])){ 
//     $codOm = $_SESSION['codOm'];
//     $query_usuarios= "SELECT * FROM tabela_associacao_endereco a INNER JOIN tabela_enderecos e ON a.cod_endereco = e.cod WHERE a.tipo_cliente = '2' AND a.cod_cliente = $codOm LIMIT 20";
//     $result_usuarios = $conn->prepare($query_usuarios);

//     $result_usuarios->execute();

//     if(($result_usuarios) and ($result_usuarios->rowCount() != 0)){
//         while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){
//         $endereco[] = [
//                 'cep' => $row_usuario['cep'],
//                 'cod' => $row_usuario['cod'],
//                 'tipo_endereco' => $row_usuario['tipo_endereco'],
//                 'logadouro' => $row_usuario['logadouro'],
//                 'bairro' => $row_usuario['bairro'],
//                 'uf' => $row_usuario['uf'],
//                 'cidade' => $row_usuario['cidade'],
//                 'complemento' => $row_usuario['complemento'],
//                 'excluido' => $row_usuario['excluido'],
//                 'casa' => $row_usuario['casa']
            
//             ];
//         }
//     }
    
// }
