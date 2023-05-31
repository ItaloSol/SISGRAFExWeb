<?php

include_once "../conexoes/conn.php";

$nome_usuario = filter_input(INPUT_GET, "nome", FILTER_SANITIZE_STRING);

if(!empty($nome_usuario)){
    
    $tipo_cliente = 2;

    $pesq_usuarios = "%" . $nome_usuario . "%";

    $query_usuarios= "SELECT *
    FROM tabela_clientes_fisicos WHERE nome LIKE :nome LIMIT 20";
    $result_usuarios = $conn->prepare($query_usuarios);
    $result_usuarios->bindParam(':nome', $pesq_usuarios);
    $result_usuarios->execute();

    if(($result_usuarios) and ($result_usuarios->rowCount() != 0)){
        while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){
          $dados[] = [
                'nome' => $row_usuario['nome'],
                'cod' => $row_usuario['cod'],
                'nome_fantasia' => $row_usuario['nome'],
                'cnpj' => $row_usuario['cpf'],
                'atividade' => $row_usuario['atividade'],
                'cod_atendente' => $row_usuario['cod_atendente'],
                'nome_atendente' => $row_usuario['nome_atendente'],
                'credito' => $row_usuario['credito']
              
            ];
        }

        $retorna = ['erro' => false, 'dados' => $dados];
        //$retorna = ['erro' => true, 'msg' => "Erro: Nenhum usuário encontrado!"];
    }else{
        $retorna = ['erro' => true, 'msg' => "Erro: Nenhum cliente encontrado!"];
    }
  
    
}else{
    $retorna = ['erro' => true, 'msg' => "Erro: Nenhum cliente encontrado!"];
}
    
echo json_encode($retorna);

