<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recupera os valores dos campos do formulário
    $tipo = $_POST["tipo"];
    $prevenda = isset($_POST["prev"]) ? $_POST["prev"] : "";
    $valorUnitario = isset($_POST["valorunitario"]) ? $_POST["valorunitario"] : 0;
    $valorPromocional = isset($_POST["valorpromo"]) ? $_POST["valorpromo"] : 0;
    $qtdeEstoque = isset($_POST["qtdestoque"]) ? $_POST["qtdestoque"] : 0;
    $avisoEstoque = isset($_POST["avisoestoque"]) ? $_POST["avisoestoque"] : "";
    $qtdeAviso = isset($_POST["qtdaviso"]) ? $_POST["qtdaviso"] : 0;
    $qtdeMinima = isset($_POST["qtdmin"]) ? $_POST["qtdmin"] : 0;
    $qtdeMaxima = isset($_POST["qtdmax"]) ? $_POST["qtdmax"] : 0;

    // Agora você pode utilizar esses valores como desejar, por exemplo, inseri-los em um banco de dados ou realizar outras operações.

    // Exemplo de inserção no banco de dados usando PDO
    try {
        $conexao = new PDO("mysql:host=seu_host;dbname=sua_base_de_dados", "seu_usuario", "sua_senha");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Substitua os nomes das colunas e a tabela abaixo pelos reais do seu banco de dados
        $sql = "INSERT INTO sua_tabela (tipo, prevenda, valor_unitario, valor_promocional, qtde_estoque, aviso_estoque, qtde_aviso, qtde_minima, qtde_maxima)
                VALUES (:tipo, :prevenda, :valorUnitario, :valorPromocional, :qtdeEstoque, :avisoEstoque, :qtdeAviso, :qtdeMinima, :qtdeMaxima)";

        $stmt = $conexao->prepare($sql);

        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':prevenda', $prevenda);
        $stmt->bindParam(':valorUnitario', $valorUnitario);
        $stmt->bindParam(':valorPromocional', $valorPromocional);
        $stmt->bindParam(':qtdeEstoque', $qtdeEstoque);
        $stmt->bindParam(':avisoEstoque', $avisoEstoque);
        $stmt->bindParam(':qtdeAviso', $qtdeAviso);
        $stmt->bindParam(':qtdeMinima', $qtdeMinima);
        $stmt->bindParam(':qtdeMaxima', $qtdeMaxima);

        $stmt->execute();

        echo "Dados inseridos com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao inserir dados: " . $e->getMessage();
    }
} else {
    echo "Formulário não foi enviado.";
}
?>