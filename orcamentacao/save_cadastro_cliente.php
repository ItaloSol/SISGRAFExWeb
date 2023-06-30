<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
if (isset($_POST['NomeCliente']) && isset($_POST['Cep']) && isset($_POST['Email'])) {
  $NomeCliente = $_POST['NomeCliente'];
  $TipoCliente = $_POST['TipoCliente'];
  if (isset($_POST['NomeFantasia'])) {
    $NomeFantasia = $_POST['NomeFantasia'];
  }
  if (isset($_POST['CPF'])) {
    $CPF = $_POST['CPF'];
  }
  if (isset($_POST['CNPJ'])) {
    $CNPJ = $_POST['CNPJ'];
  }
  $Atividade = $_POST['Atividade'];
  if (isset($_POST['Filial'])) {
    $Filial = $_POST['Filial'];
  }
  // $ramal = $_POST['Ramal'];
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
  $Telefone2 = $_POST['Telefone2'];
  $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Cadastrou um novo cliente: $NomeCliente ' , '$cod_user' , '$dataHora')");
  $Atividade_Supervisao->execute();

  if ($TipoCliente == '1') {
    $cliente = 'tabela_clientes_fisicos';
    $Cadatro_cliente = $conexao->prepare("INSERT INTO tabela_clientes_fisicos (nome , cpf, atividade, cod_atendente, nome_atendente, observacoes, credito) VALUES ('$NomeCliente', '$CPF', '$Atividade', '$CodAtendente', '$NomeAtendente', '$ObsCliente', 0.0)");
    $Cadatro_cliente->execute();
  } else {
    $cliente = 'tabela_clientes_juridicos';
    $Cadatro_cliente = $conexao->prepare("INSERT INTO tabela_clientes_juridicos (nome , nome_fantasia, cnpj, atividade, filial_coligada, cod_atendente, nome_atendente, observacao, credito) VALUES ('$NomeCliente', '$NomeFantasia', '$CNPJ','$Atividade','$Filial','$CodAtendente', '$NomeAtendente', '$ObsCliente', 0.0 )");
    $Cadatro_cliente->execute();
  }
  $Cadatro_contato = $conexao->prepare("INSERT INTO tabela_contatos (nome_contato , email, telefone, telefone2) VALUES ('$NomeContato', '$Email', '$Telefone', '$Telefone2' )");
  $Cadatro_contato->execute();
  $Cadatro_endereco = $conexao->prepare("INSERT INTO tabela_enderecos (cep , tipo_endereco, logadouro, bairro, uf, cidade,complemento) VALUES ('$Cep', '$TipoEndereco', '$logadouro', '$Bairro', '$uf', '$cidade', '$complemento')");
  $Cadatro_endereco->execute();
  $busca_cliente = $conexao->prepare("SELECT * FROM $cliente WHERE nome = '$NomeCliente' ORDER BY cod DESC");
  $busca_cliente->execute();
  if ($linha = $busca_cliente->fetch(PDO::FETCH_ASSOC)) {
    $Id_Cliente = $linha['cod'];
  }
  $busca_endereco = $conexao->prepare("SELECT * FROM tabela_enderecos WHERE cep = '$Cep' ORDER BY cod DESC");
  $busca_endereco->execute();
  if ($linha = $busca_endereco->fetch(PDO::FETCH_ASSOC)) {
    $Cod_endereco = $linha['cod'];
  }
  $busca_contato = $conexao->prepare("SELECT * FROM tabela_contatos WHERE nome_contato = '$NomeContato' ORDER BY cod DESC");
  $busca_contato->execute();
  if ($linha = $busca_contato->fetch(PDO::FETCH_ASSOC)) {
    $Cod_contato = $linha['cod'];
  }
  $Cadatro_associacao_endereco = $conexao->prepare("INSERT INTO tabela_associacao_enderecos (cod_endereco , cod_cliente, tipo_cliente) VALUES ($Cod_endereco,$Id_Cliente, $TipoCliente)");
  $Cadatro_associacao_endereco->execute();

  $Cadatro_asociacao_contato = $conexao->prepare("INSERT INTO tabela_associacao_contatos (cod_contato , cod_cliente, tipo_cliente) VALUES ($Cod_contato, $Id_Cliente, $TipoCliente )");
  $Cadatro_asociacao_contato->execute();
  $_SESSION['msg'] = ' <div style=";" id="alerta<?=$a?>"
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
  $_SESSION['msg'] = ' <div style=";" id="alerta<?=$a?>" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true">
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
