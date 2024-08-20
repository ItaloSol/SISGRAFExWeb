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

try {
    // Conectar ao banco de dados
   

    // Receber os dados enviados via POST
    $data = json_decode(file_get_contents('php://input'), true);

    // Inserir dados na tabela_enderecos
    $stmt = $conexao->prepare("INSERT INTO tabela_enderecos 
        (cep, tipo_endereco, logadouro, bairro, uf, cidade, complemento) 
        VALUES (:cep, :tipo_endereco, :logadouro, :bairro, :uf, :cidade, :complemento)");

    $stmt->execute([
        ':cep' => $data['cep'],
        ':tipo_endereco' => $data['tipo_endereco'],
        ':logadouro' => $data['logadouro'],
        ':bairro' => $data['bairro'],
        ':uf' => $data['uf'],
        ':cidade' => $data['cidade'],
        ':complemento' => $data['complemento']
    ]);

    // Obter o ID do último endereço inserido
    $lastEnderecoId = $conexao->lastInsertId();

    // Inserir dados na tabela_associacao_enderecos
    $stmt = $conexao->prepare("INSERT INTO tabela_associacao_enderecos 
        (cod_endereco, cod_cliente, tipo_cliente) 
        VALUES (:cod_endereco, :cod_cliente, :tipo_cliente)");

    $stmt->execute([
        ':cod_endereco' => $lastEnderecoId,
        ':cod_cliente' => $data['cod_cliente'],
        ':tipo_cliente' => $data['tipo_cliente']
    ]);

    // Retornar uma resposta de sucesso
    echo json_encode(['success' => true, 'message' => 'Endereço salvo com sucesso!']);
} catch (PDOException $e) {
    // Retornar uma resposta de erro
    echo json_encode(['success' => false, 'message' => 'Erro ao salvar o endereço: ' . $e->getMessage()]);
}
?>