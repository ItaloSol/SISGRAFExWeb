<?php

include_once "../conexoes/conn.php";

$codigo_usuario = filter_input(INPUT_GET, "codigo", FILTER_SANITIZE_STRING);

if(!empty($codigo_usuario)){
    
    $tipo_cliente = 2;

    $pesq_usuarios = "%" . $codigo_usuario . "%";

    $query_usuarios= "SELECT *
    FROM tabela_atendentes WHERE codigo_atendente LIKE :codigo LIMIT 20";
    $result_usuarios = $conn->prepare($query_usuarios);
    $result_usuarios->bindParam(':codigo', $pesq_usuarios);
    $result_usuarios->execute();

    if(($result_usuarios) and ($result_usuarios->rowCount() != 0)){
        while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){
          $dados[] = [
                'codigo' => $row_usuario['codigo_atendente'],
            ];
        }

        $retorna = ['erro' => false, 'dados' => $dados];
        //$retorna = ['erro' => true, 'msg' => "Erro: Nenhum usuário encontrado!"];
    }else{
        $retorna = ['erro' => true, 'msg' => "Disponivel: Código pode ser utilizado!"];
    }
  
    
}else{
    $retorna = ['erro' => true, 'msg' => "Disponivel: Código pode ser utilizado!"];
}

    
echo json_encode($retorna);

