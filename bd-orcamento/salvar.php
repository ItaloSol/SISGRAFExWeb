
<?php
session_start();
$cod_user = $_SESSION["usuario"][2]; // Obter o código do usuário logado
include_once('../conexoes/conexao.php'); // Conectar ao banco de dados
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$hoje = date('Y-m-d');
$valido = date('Y-m-d', strtotime('+' . 15 . 'day', strtotime($hoje)));

if (isset($_POST['contato'])) {
    // Código existente para cadastrar o contato do cliente
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

    if ($_POST['tipo_cliente'] == 2) {
        $tabela = 'tabela_clientes_juridicos';
    } else {
        $tabela = 'tabela_clientes_fisicos';
    }

    $stmt = $conexao->prepare("INSERT INTO tabela_contatos 
      (nome_contato, email, telefone, ramal, telefone2, departamento)
      VALUES 
      ('$nome_contato', '$email', '$telefone', '$ramal', '$telefone2', ' $departamento')");
    $stmt->execute();

    $Clientes_Contato = $conexao->prepare("SELECT * FROM tabela_contatos ORDER BY cod DESC limit 1");
    $Clientes_Contato->execute();
    if ($linha = $Clientes_Contato->fetch(PDO::FETCH_ASSOC)) {
        $cod_contato = $linha['cod'];
    }

    $stmt = $conexao->prepare("INSERT INTO tabela_associacao_contatos 
      (cod_contato, cod_cliente, tipo_cliente)
      VALUES 
      ('$cod_contato',' $id_cliente',' $tipo_cliente')");
    $stmt->execute();

    $SUPERVISAO = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade, atendente_supervisao, data_supervisao) VALUES ('Contato de cliente', '$cod_user', '$dataHora')");
    $SUPERVISAO->execute();


    $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade, atendente_supervisao, data_supervisao) VALUES ('Contato do cliente $id_cliente, $tipo_cliente', '$cod_user', '$dataHora')");
    $Atividade_Supervisao->execute();

    echo "Dados atualizados com sucesso!";

    ?> <script>
        setTimeout(function() {
            window.location.href = `../orcamentacao/tl-orcamento.php`;
        }, 1000);
    </script> <?php
}

if (isset($_POST['Endereco'])) {
    // Código para cadastrar o endereço
    $cep = $_POST['cep'];
    $tipo_endereco = $_POST['tipo_endereco'];
    $logadouro = $_POST['logadouro'];
    $bairro = $_POST['bairro'];
    $uf = $_POST['uf'];
    $cidade = $_POST['cidade'];
    $complemento = $_POST['complemento'] ?? ''; // Campo opcional de complemento
    $id_cliente = $_POST['id_cliente'];
    $tipo_cliente = $_POST['tipo_cliente'];

    try {
        // Inserir os dados na tabela_enderecos
        $stmt = $conexao->prepare("INSERT INTO tabela_enderecos 
            (cep, tipo_endereco, logadouro, bairro, uf, cidade, complemento) 
            VALUES (:cep, :tipo_endereco, :logadouro, :bairro, :uf, :cidade, :complemento)");
        
        $stmt->execute([
            ':cep' => $cep,
            ':tipo_endereco' => $tipo_endereco,
            ':logadouro' => $logadouro,
            ':bairro' => $bairro,
            ':uf' => $uf,
            ':cidade' => $cidade,
            ':complemento' => $complemento
        ]);

        // Obter o ID do último endereço inserido
        $lastEnderecoId = $conexao->lastInsertId();

        // Inserir dados na tabela_associacao_enderecos
        $stmt = $conexao->prepare("INSERT INTO tabela_associacao_enderecos 
            (cod_endereco, cod_cliente, tipo_cliente) 
            VALUES (:cod_endereco, :cod_cliente, :tipo_cliente)");
        
        $stmt->execute([
            ':cod_endereco' => $lastEnderecoId,
            ':cod_cliente' => $id_cliente, // Associar o endereço ao cliente logado
            ':tipo_cliente' => $tipo_cliente // Exemplo: 1 = cliente padrão (ajuste conforme sua lógica)
        ]);

        // Supervisão da atividade de alteração
        $SUPERVISAO = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade, atendente_supervisao, data_supervisao) VALUES ('Endereço cadastrado', '$cod_user', '$dataHora')");
        $SUPERVISAO->execute();

        echo "Endereço cadastrado com sucesso!";

        ?> <script>
            setTimeout(function() {
                window.location.href = `../orcamentacao/tl-orcamento.php`;
            }, 1000);
        </script> <?php
    } catch (PDOException $e) {
        echo "Erro ao salvar o endereço: " . $e->getMessage();
    }
}
?>


    $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Contato do cliente $id_cliente, $tipo_cliente' , '$cod_user' , '$dataHora')");
    $Atividade_Supervisao->execute();
    ?> <script> 
   setTimeout(function() {window.location.href = `../orcamentacao/tl-orcamento.php`;}, 1000);    </script> <?php
  }



