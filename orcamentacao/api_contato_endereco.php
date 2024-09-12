<?php
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$hoje = date('Y-m-d');
$hora = date('H:i:s');
$Solicitacao = json_decode(file_get_contents("php://input"), true);

header('Content-Type: application/json');
if(isset($_GET['Codigo_contato'])){
    $cod = $_GET['Codigo_contato'];
    $Deletar_Clientes_Contato = $conexao->prepare("DELETE FROM tabela_associacao_contatos WHERE  cod_contato = $cod");
    $Deletar_Clientes_Contato->execute();
    echo json_encode(['success' => true, 'message' => 'Sucesso: ']);
}else{


try {
  
    // Receber os dados enviados via POST
    $data = json_decode(file_get_contents('php://input'), true);

    // Inserir dados na tabela_contatos
    $stmt = $conexao->prepare("INSERT INTO tabela_contatos 
        (nome_contato, email, telefone, ramal, telefone2, ramal2, departamento) 
        VALUES (:nome_contato, :email, :telefone, :ramal, :telefone2, :ramal2, :departamento)");

    $stmt->execute([
        ':nome_contato' => $data['nome_contato'],
        ':email' => $data['email'],
        ':telefone' => $data['telefone'],
        ':ramal' => $data['ramal'],
        ':telefone2' => $data['telefone2'],
        ':ramal2' => $data['ramal2'],
        ':departamento' => $data['departamento']
    ]);

    // Obter o ID do último contato inserido
    $lastContactId = $conexao->lastInsertId();
    $Clientes_Contato = $conexao->prepare("SELECT * FROM tabela_contatos ORDER BY cod  DESC limit 1");
    $Clientes_Contato->execute();
    if ($linha = $Clientes_Contato->fetch(PDO::FETCH_ASSOC)) {
      $cod_contato = $linha['cod'];
    }
    // Inserir dados na tabela_associacao_contatos
    $stmt = $conexao->prepare("INSERT INTO tabela_associacao_contatos 
        (cod_contato, cod_cliente, tipo_cliente) 
        VALUES (:cod_contato, :cod_cliente, :tipo_cliente)");

    $stmt->execute([
        ':cod_contato' => $cod_contato,
        ':cod_cliente' => $data['id_cliente'],
        ':tipo_cliente' => $data['tipo_cliente']
    ]);

    // Retornar uma resposta de sucesso
    echo json_encode(['success' => true, 'message' => 'Contato salvo com sucesso!']);
} catch (PDOException $e) {
    // Retornar uma resposta de erro
    echo json_encode(['success' => false, 'message' => 'Erro ao salvar o contato: ' . $e->getMessage()]);
}
}
?>
