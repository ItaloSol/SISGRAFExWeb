<?php
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$hoje = date('Y-m-d');
if (isset($_POST['FATURAR']) || isset($_POST['excluir'])) {
    if (isset($_POST['FATURAR'])) {
        $cod = $_POST['codigo'];
        $quantidade = $_POST['quantidade'];
        $valor = $_POST['valor_faturado'];
        $data = $_POST['data'];
        $emissor = $_POST['emissor'];
        $modalidade = $_POST['frete'];

        if ($modalidade == '1') {
            $modalidade = 'EMC';
        }
        if ($modalidade == '2') {
            $modalidade = 'COR';
        }

        $transportador = $_POST['transportador'];
        $quantidade_restante = $_POST['quantidade_restante'];
        $obs = $_POST['obs'];
        $cod_orc = $_POST['orc'];
        if ($quantidade > $quantidade_restante) {
            //cancelar
            $_SESSION['msg'] = ' <div id="alerta"
            role="bs-toast"
            class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show "
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
                Não pode ser faturado quantidade maior que a restante!    
            </div>
        </div>';
              header('location: ../html/painel.php?p');
            echo 'cencelar';
        }
        if ($quantidade == 0) {
            // cancelar
            $_SESSION['msg'] = ' <div id="alerta"
            role="bs-toast"
            class=" bs-toast toast toast-placement-ex m-3 fade bg-danger top-0 end-0 hide show "
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
                Não é pode ser faturado a quantidade 0;  
            </div>
        </div>';
              header('location: ../html/painel.php?p');
        }




        //  echo $cod . '<br>'. $quantidade . '<br>'. $valor.'<br>'. $data.'<br>'.$emissor.'<br>'.$modalidade.'<br>'.$transportador.'<br>'.$quantidade_restante. '<br>'.$obs;

        if ($quantidade_restante > $quantidade) {
            // parcial
            $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Faturamento Parcial da Op $cod' , '$cod_user' , '$dataHora')");
            $Atividade_Supervisao->execute();
            $query_faturamento = $conexao->prepare("SELECT * FROM faturamentos ORDER BY CODIGO DESC");
            $query_faturamento->execute();

            if ($linha = $query_faturamento->fetch(PDO::FETCH_ASSOC)) {
                $CODIGO_ANTIGO = $linha['CODIGO'];
            }
            $NOVO_CODIGO_FATURAMENTO = $CODIGO_ANTIGO  + 1;
            $adicionar_faturamento = $conexao->prepare("INSERT INTO faturamentos (CODIGO,CODIGO_ORC , CODIGO_OP, EMISSOR, QTD_ENTREGUE, VLR_FAT, DT_FAT,FRETE_FAT, SERVICOS_FAT,OBSERVACOES) VALUES ($NOVO_CODIGO_FATURAMENTO,$cod_orc, $cod, '$emissor', $quantidade, $valor, '$data', 1,1,'$obs')");
            $adicionar_faturamento->execute();



            $adicionar_frete = $conexao->prepare("INSERT INTO tabela_notas_transporte (cod_nota , modalidade_frete, espessura_produto, peso_produto, nome_transportador) VALUES ('$NOVO_CODIGO_FATURAMENTO', '$modalidade', '1', '1', '$transportador')");
            $adicionar_frete->execute();
            $atualizar_op = $conexao->prepare("UPDATE tabela_ordens_producao SET status = '12' WHERE cod = $cod ");
            $atualizar_op->execute();
            $_SESSION['msg'] = ' <div id="alerta"
                role="bs-toast"
                class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show "
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
                    Faturamento Parcial Feito!    
                </div>
            </div>';
              header('location: ../html/painel.php?p');
        }

        if ($quantidade == $quantidade_restante) {
            // 100%
            $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Faturamento da Op $cod' , '$cod_user' , '$dataHora')");
            $Atividade_Supervisao->execute();
            $query_faturamento = $conexao->prepare("SELECT * FROM faturamentos ORDER BY CODIGO DESC");
            $query_faturamento->execute();

            if ($linha = $query_faturamento->fetch(PDO::FETCH_ASSOC)) {
                $CODIGO_ANTIGO = $linha['CODIGO'];
            }
            $NOVO_CODIGO_FATURAMENTO = $CODIGO_ANTIGO  + 1;
            $adicionar_faturamento = $conexao->prepare("INSERT INTO faturamentos (CODIGO,CODIGO_ORC , CODIGO_OP, EMISSOR, QTD_ENTREGUE, VLR_FAT, DT_FAT,FRETE_FAT, SERVICOS_FAT,OBSERVACOES) VALUES ($NOVO_CODIGO_FATURAMENTO,$cod_orc, $cod, '$emissor', $quantidade, $valor, '$data', 1,1,'$obs')");
            $adicionar_faturamento->execute();



            $adicionar_frete = $conexao->prepare("INSERT INTO tabela_notas_transporte (cod_nota , modalidade_frete, espessura_produto, peso_produto, nome_transportador) VALUES ('$NOVO_CODIGO_FATURAMENTO', '$modalidade', '1', '1', '$transportador')");
            $adicionar_frete->execute();
            $atualizar_op = $conexao->prepare("UPDATE tabela_ordens_producao SET status = '11' WHERE cod = $cod ");
            $atualizar_op->execute();

            $buscacliente = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE cod = $cod ");
            $buscacliente->execute();
            if ($linha = $buscacliente->fetch(PDO::FETCH_ASSOC)) {
                $cod = $_GET['cod'] = $linha['cod_cliente'];
                $tipo = $linha['tipo_cliente'];
            }
            ?>
        <input class="VALORES" type="text" id="<?= $cod ?>" name="<?= $tipo ?>" value="<?= $cod ?> <?= $tipo ?>"/>
<script>
    // Seleciona o elemento com a classe "VALORES"
    var elemento = document.querySelector('.VALORES');

    // Verifica se o elemento foi encontrado
    if (elemento) {
        // Constrói a URL para a API
        var url = '../financeiro/api_correcao_credito.php?cod=' + elemento.id + '&tipo=' + elemento.className;

        // Faz a requisição fetch
        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log('executou', data);
                // Faça algo com os dados recebidos da API
            })
            .catch(error => console.error('Erro:', error));
    } else {
        console.error('Elemento não encontrado.');
    }
  
            </script>
        <?php
            $_SESSION['msg'] = ' <div id="alerta"
            role="bs-toast"
            class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show "
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
                Faturamento Feito!    
            </div>
        </div>';
              header('location: ../html/painel.php?p');
        }
    }
    if (isset($_POST['excluir'])) {
        $codigo = $_POST['numero'];
        $orc = $_POST['orc'];
        $op = $_POST['codigo'];

        $excluir_faturamento = $conexao->prepare("DELETE FROM faturamentos WHERE CODIGO = '$codigo'");
        $excluir_faturamento->execute();
        $excluir_frete = $conexao->prepare("DELETE FROM tabela_notas_transporte WHERE cod_nota = '$codigo'");
        $excluir_frete->execute();
        $atualizar_op = $conexao->prepare("UPDATE tabela_ordens_producao SET status = '10' WHERE cod = $op ");
        $atualizar_op->execute();
        $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Deletou o Faturamento da Op $op' , '$cod_user' , '$dataHora')");
        $Atividade_Supervisao->execute();
        $buscacliente = $conexao->prepare("SELECT * FROM tabela_ordens_producao WHERE cod = $op ");
        $buscacliente->execute();
        if ($linha = $buscacliente->fetch(PDO::FETCH_ASSOC)) {
            $cod = $_GET['cod'] = $linha['cod_cliente'];
            $tipo = $linha['tipo_cliente'];
        }
        ?>
        <input class="VALORES" type="text" id="<?= $cod ?>" name="<?= $tipo ?>" value="<?= $cod ?> <?= $tipo ?>"/>
<script>
    // Seleciona o elemento com a classe "VALORES"
    var elemento = document.querySelector('.VALORES');

    // Verifica se o elemento foi encontrado
    if (elemento) {
        // Constrói a URL para a API
        var url = '../financeiro/api_correcao_credito.php?cod=' + elemento.id + '&tipo=' + elemento.className;

        // Faz a requisição fetch
        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log('executou', data);
                // Faça algo com os dados recebidos da API
            })
            .catch(error => console.error('Erro:', error));
    } else {
        console.error('Elemento não encontrado.');
    }
  
            </script>
        <?php
        
        $_SESSION['msg'] = ' <div id="alerta"
            role="bs-toast"
            class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show "
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
                Faturamento Deletado com Sucesso!    
            </div>
        </div>';
          header('location: ../html/painel.php?p');
    }
} else {
      header('location: ../html/painel.php?p');
}
