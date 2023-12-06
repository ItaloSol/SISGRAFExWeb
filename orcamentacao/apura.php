<?php 
include_once('../conexoes/conexao.php');


$a = 0;
    $buscacliente = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN tabela_ordens_producao p ON o.cod = p.orcamento_base WHERE  p.status = '11' ");
            $buscacliente->execute();
            while($linha = $buscacliente->fetch(PDO::FETCH_ASSOC)) {
                $cod = $linha['cod'];
                $orc = $linha['orcamento_base'];
                $tipo = $linha['status'];
                  echo $cod .' '. $orc.' > '. $tipo . '<br>';     
                  $a++;
            $query_aceitalas = $conexao->prepare("UPDATE tabela_orcamentos SET status = '9'  WHERE cod = '$orc' ");
            $query_aceitalas->execute();
            }
            echo 'total: '. $a;