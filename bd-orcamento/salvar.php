<?php
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$hoje = date('Y-m-d');
$valido = date('Y-m-d', strtotime('+' . 15 . 'day', strtotime($hoje)));


if($_POST['contato']){
  // Recebe os dados do formulário
  $nome_contato = $_POST['nome_contato'];
  $email = $_POST['email'];
  $departamento = $_POST['departamento'];
  $tipo_telefone_principal = $_POST['tipo_telefone_principal'];
  $telefone = $_POST['telefone'];
  $ramal = $_POST['ramal'];
  $tipo_telefone_secundario = $_POST['tipo_telefone_secundario'];
  $telefone2 = $_POST['telefone2'];
  $ramal2 = $_POST['ramal2'];
  $id_cliente = $_POST['id_cliente'];
  $tipo_cliente = $_POST['tipo_cliente'];
  // Aqui você pode inserir o código para salvar esses dados no banco de dados.
  // Exemplo usando PDO para atualizar os dados:



    if ($_POST['tipo_cliente'] == 2) {
      $tabela = 'tabela_clientes_juridicos';
    } else {
      $tabela = 'tabela_clientes_fisicos';
    }


    $stmt = $conexao->prepare("INSERT INTO tabela_contatos 
(nome_contato, email, telefone, ramal, telefone2,  departamento)
VALUES 
('$nome_contato', '$email', '$telefone', '$ramal', '$telefone2', ' $departamento')");
    $stmt->execute();
    $Clientes_Contato = $conexao->prepare("SELECT * FROM tabela_contatos ORDER BY cod  DESC limit 1");
    $Clientes_Contato->execute();
    if ($linha = $Clientes_Contato->fetch(PDO::FETCH_ASSOC)) {
      $cod_contato = $linha['cod'];
    }


    $stmt = $conexao->prepare("INSERT INTO tabela_associacao_contatos 
(cod_contato, cod_cliente, tipo_cliente)
VALUES 
('$cod_contato',' $id_cliente',' $tipo_cliente')");
    $stmt->execute();
    $SUPERVISAO = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Contato de cliente ' , '$cod_user' , '$dataHora')");
    $SUPERVISAO->execute();
    echo "Dados atualizados com sucesso!";
 

    $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Contato do cliente $id_cliente, $tipo_cliente' , '$cod_user' , '$dataHora')");
    $Atividade_Supervisao->execute();
    ?> <script> 
   setTimeout(function() {window.location.href = `../orcamentacao/tl-orcamento.php`;}, 1000);    </script> <?php
  }
    ?>
