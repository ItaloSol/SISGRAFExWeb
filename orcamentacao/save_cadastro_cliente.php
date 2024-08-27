<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
if (isset($_POST['NomeCliente']) && isset($_POST['Cep']) && isset($_POST['Email'])) {
  $NomeCliente = $_POST['NomeCliente'];
  $TipoCliente = $_POST['TipoCliente'];
  
  // Campos opcionais
  $NomeFantasia = isset($_POST['NomeFantasia']) ? $_POST['NomeFantasia'] : null;
  $CPF = isset($_POST['CPF']) ? $_POST['CPF'] : null;
  $CNPJ = isset($_POST['CNPJ']) ? $_POST['CNPJ'] : null;
  $Filial = isset($_POST['Filial']) ? $_POST['Filial'] : null;
  
  // Campos obrigatórios
  $Atividade = $_POST['Atividade'];
  $CodAtendente = $_POST['CodAtendente'];
  $NomeAtendente = $_POST['NomeAtendente'];
  $ObsCliente = $_POST['ObsCliente'];
  $TipoEndereco = $_POST['TipoEndereco'];
  $Cep = $_POST['Cep'];
  $Bairro = $_POST['Bairro'];
  $cidade = $_POST['cidade'];
  $uf = $_POST['uf'];
  $logadouro = $_POST['logadouro'];
  $complemento = $_POST['complemento'];
  $NomeContato = $_POST['NomeContato'];
  $Email = $_POST['Email'];
  $Departamento = $_POST['Departamento'];
  $Telefone = $_POST['Telefone'];
  $Telefone2 = $_POST['Celular'];
  
  // Insere atividade de supervisão
  $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Cadastrou um novo cliente: $NomeCliente', '$cod_user', '$dataHora')");
  $Atividade_Supervisao->execute();

  // Inserção baseada no tipo de cliente
  if ($TipoCliente == '1') { // Cliente físico
      $cliente = 'tabela_clientes_fisicos';
      $Cadastro_cliente = $conexao->prepare("INSERT INTO tabela_clientes_fisicos (nome, cpf, atividade, cod_atendente, nome_atendente, observacoes, credito) VALUES ('$NomeCliente', '$CPF', '$Atividade', '$CodAtendente', '$NomeAtendente', '$ObsCliente', 0.0)");
      $Cadastro_cliente->execute();
  } else { // Cliente jurídico
      $cliente = 'tabela_clientes_juridicos';
      $Cadastro_cliente = $conexao->prepare("INSERT INTO tabela_clientes_juridicos (nome, nome_fantasia, cnpj, atividade, filial_coligada, cod_atendente, nome_atendente, observacao, credito) VALUES ('$NomeCliente', '$NomeFantasia', '$CNPJ', '$Atividade', '$Filial', '$CodAtendente', '$NomeAtendente', '$ObsCliente', 0.0)");
      $Cadastro_cliente->execute();
  }
  
  // Inserir contato
  $Cadastro_contato = $conexao->prepare("INSERT INTO tabela_contatos (nome_contato, email, telefone, telefone2) VALUES ('$NomeContato', '$Email', '$Telefone', '$Telefone2')");
  $Cadastro_contato->execute();
  
  // Inserir endereço
  $Cadastro_endereco = $conexao->prepare("INSERT INTO tabela_enderecos (cep, tipo_endereco, logadouro, bairro, uf, cidade, complemento) VALUES ('$Cep', '$TipoEndereco', '$logadouro', '$Bairro', '$uf', '$cidade', '$complemento')");
  $Cadastro_endereco->execute();
  
  // Recuperar o ID do cliente recém-inserido
  $busca_cliente = $conexao->prepare("SELECT * FROM $cliente WHERE nome = '$NomeCliente' ORDER BY cod DESC");
  $busca_cliente->execute();
  if ($linha = $busca_cliente->fetch(PDO::FETCH_ASSOC)) {
      $Id_Cliente = $linha['cod'];
  }
  
  // Recuperar o ID do endereço recém-inserido
  $busca_endereco = $conexao->prepare("SELECT * FROM tabela_enderecos WHERE cep = '$Cep' ORDER BY cod DESC");
  $busca_endereco->execute();
  if ($linha = $busca_endereco->fetch(PDO::FETCH_ASSOC)) {
      $Cod_endereco = $linha['cod'];
  }
  
  // Recuperar o ID do contato recém-inserido
  $busca_contato = $conexao->prepare("SELECT * FROM tabela_contatos WHERE nome_contato = '$NomeContato' ORDER BY cod DESC");
  $busca_contato->execute();
  if ($linha = $busca_contato->fetch(PDO::FETCH_ASSOC)) {
      $Cod_contato = $linha['cod'];
  }
  
  // Associar endereço ao cliente
  $Cadastro_associacao_endereco = $conexao->prepare("INSERT INTO tabela_associacao_enderecos (cod_endereco, cod_cliente, tipo_cliente) VALUES ($Cod_endereco, $Id_Cliente, $TipoCliente)");
  $Cadastro_associacao_endereco->execute();
  
  // Associar contato ao cliente
  $Cadastro_associacao_contato = $conexao->prepare("INSERT INTO tabela_associacao_contatos (cod_contato, cod_cliente, tipo_cliente) VALUES ($Cod_contato, $Id_Cliente, $TipoCliente)");
  $Cadastro_associacao_contato->execute();
  
  echo "Cliente cadastrado com sucesso!";

  $_SESSION['msg'] = ' <div id="alerta<?=$a?>"
role="bs-toast"
class=" bs-toast toast toast-placement-ex m-3 fade bg-primary top-0 end-0 hide show "
role="alert"
aria-live="assertive"
aria-atomic="true">
<div class="toast-header">
  <i class="bx bx-bell me-2"></i>
  <div class="me-auto fw-semibold">Aviso!</div>
  <small>

  </small>
  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
</div>

<div class="toast-body">
  Cliente cadastrado com sucesso!
</div>
</div>';
  header("Location: tl-cadastro-clientes-ori.php");
} else {
  $_SESSION['msg'] = ' <div id="alerta<?=$a?>" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <i class="bx bx-bell me-2"></i>
    <div class="me-auto fw-semibold">Aviso!</div>
    <small>

    </small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>

  <div class="toast-body">
    Os campos Obrigatorios não foram preenchidos!
  </div>
</div>';
  header("Location: tl-cadastro-clientes-ori.php");
}
