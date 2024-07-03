<?php
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
include_once('../conexoes/conn.php');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
?> <div id="load1" class="mb-5" style="position:absolute;background-color: #01010c;width: 100%;height: 100vh;z-index: 9999999999999;align-items: center;justify-content: center;display: flex;color: white;font-size: 40px;align-content: space-around;flex-wrap: wrap;flex-direction: row;"> CARREGANDO<br> <div><br> <img style="/* position:absolute; */margin-left: -220px;justify-content: start;display: flex;color: white;font-size: 40px;flex-wrap: nowrap;flex-direction: column;margin-top: -40;" src="../img/preloader.svg"> <br>
<div style="/* margin: -200px; */margin-left: -400px;font-size: 12px;"><p style="display: flex; justify-content: center; margin-bottom: -20px;">VOCÊ NÃO PODE ATUALIZAR ESSA PAGINA!</p><br> CASO CONGELE NESSA PAGINA ENTRE EM CONTATO COM A SEÇÃO DE INFORMÁTICA URGENTE!</div></div></div>
<?php
if (isset($_POST['excluir'])) {
    if (isset($_POST['valor']) && isset($_POST['forma_pagamento']) && isset($_POST['codigo_cliente'])) {
        $cod = $_POST['numero'];
        $endereco = $_POST['endereco'];
        $contato = $_POST['contato'];
        $data_lan = $_POST['data_lancamento'];
        $valorN = $_POST['valor'];
        $cod_cliente = $_POST['codigo_cliente'];
        $tipo_cliente = $_POST['tipo_cliente'];
        $forma_pagamento = $_POST['forma_pagamento'];
        $cpf = $_POST['cpf'];
        $nome_emiss = $_POST['nome_emissor'];
        $cod_recolhimento = $_POST['cod_recolhimete'];
        $siafi = $_POST['siafi'];
        $ug = $_POST['ug'];
        $horas = $_POST['data_horas'];
        $obs = $_POST['obs'];
        if ($cpf == '0' or $cpf == '') {
            $cpf = $_SESSION["usuario"][7];
        }
        if ($nome_emiss == '0' or $nome_emiss == '') {
            $nome_emiss = $_SESSION["usuario"][0];
        }
        $Todos_notas = $conexao->prepare("SELECT * FROM tabela_notas WHERE cod = $cod ");
        $Todos_notas->execute();
        if ($linha = $Todos_notas->fetch(PDO::FETCH_ASSOC)) {
            $valor = $linha['valor'];
            echo $valor;
        }
        if ($tipo_cliente == 1) {
            $calculo_credito = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE cod = $cod_cliente");
        }
        if ($tipo_cliente == 2) {
            $calculo_credito = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE cod = $cod_cliente");
        }

        $calculo_credito->execute();
        if ($linha = $calculo_credito->fetch(PDO::FETCH_ASSOC)) {
            $anterios = $linha['credito'];
        }


        $credito = $anterios - $valor;


        if ($forma_pagamento == '1') {
            $TABELA_SIAFI = $conexao->prepare("DELETE FROM nt_credito_lanc_siafi WHERE NT_CREDITO_CODIGO_SIAFI = '$siafi' ");
            $TABELA_SIAFI->execute();
            if ($tipo_cliente == '1') {
                echo 'atualizou saldo ';
                $query_aceitalas = $conexao->prepare("UPDATE tabela_clientes_fisicos SET credito = '$credito' WHERE cod = $cod_cliente ");
                $query_aceitalas->execute();
            }
            if ($tipo_cliente == '2') {
                $query_aceitalas = $conexao->prepare("UPDATE tabela_clientes_juridicos SET credito = '$credito' WHERE cod = $cod_cliente ");
                $query_aceitalas->execute();
            }
        }
        if ($forma_pagamento == '4') {
            $TABELA_gru = $conexao->prepare("DELETE FROM nt_credito_lanc_gru WHERE CODIGO_REC = '$cod_recolhimento' ");
            $TABELA_gru->execute();
            if ($tipo_cliente == '1') {
                $query_aceitalas = $conexao->prepare("UPDATE tabela_clientes_fisicos SET credito = '$credito' WHERE cod = $cod_cliente ");
                $query_aceitalas->execute();
            }
            if ($tipo_cliente == '2') {
                $query_aceitalas = $conexao->prepare("UPDATE tabela_clientes_juridicos SET credito = '$credito' WHERE cod = $cod_cliente ");
                $query_aceitalas->execute();
            }
        }



        $TABELA_notas = $conexao->prepare("DELETE FROM tabela_notas WHERE cod = $cod ");
        $TABELA_notas->execute();
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
                     Nota de Credito Excluida com Sucesso!    
                </div>
              </div>';

        $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Nota de Crédito excluida do cliente $cod_cliente Tipo: $tipo_cliente ' , '$cod_user' , '$dataHora')");
        $Atividade_Supervisao->execute();
        ?>
        <input class="<?= $cod_cliente ?>" type="text" id="VALORES" name="<?= $tipo_cliente ?>" value="<?= $cod_cliente ?>"/>
    <script>
    // Seleciona o elemento com a classe "VALORES"
 
    var elemento = document.getElementById('VALORES');
   
    // Verifica se o elemento foi encontrado
    if (elemento) {
        // Constrói a URL para a API
        var url = '../financeiro/api_correcao_credito.php?cod=' + elemento.value + '&tipo=' + elemento.name;
        
        // Faz a requisição fetch
        fetch(url)
    .then(response => response.json())
    .then(data => {
    });
        
    } else {
        console.error('Elemento não encontrado.');
    }
   
    setTimeout(function() {window.location.href = 'tl-cadastro-notas.php?tp=3';}, 1000);
    
            </script>
        <?php
   
    } else {
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
                 Erro é necessario selecionar os campos Obrigatórios!   
            </div>
          </div>';
          ?> <script>  setTimeout(function() {window.location.href = 'tl-cadastro-notas.php';}, 1000);    </script><?php
   
    }
}
if (isset($_POST['salvar'])) {
    if (isset($_POST['valor']) && isset($_POST['forma_pagamento']) && isset($_POST['codigo_cliente']) && $_POST['contato'] != 'Selecione um Endereço' && $_POST['endereco'] != 'Selecione um Endereço') {
        $endereco = $_POST['endereco'];
        $contato = $_POST['contato'];
        $valor = $_POST['valor'];
        $data_lan = $_POST['data_lancamento'];
        $datas = explode('-', $data_lan);
        $data_correta = date('d/m/Y', strtotime($datas[0] . $datas[1] . $datas[2]));
        $cod_cliente = $_POST['codigo_cliente'];
        $tipo_cliente = $_POST['tipo_cliente'];
        if ($_POST['forma_pagamento'] == 2) {
            $forma_pagamento = 4;
        } else {
            $forma_pagamento = 1;
        }


        $cpf = $_POST['cpf'];
        $nome_emiss = $_POST['nome_emissor'];
        $cod_recolhimento = $_POST['cod_recolhimete'];
        $siafi = $_POST['siafi'];
        $ug = $_POST['ug'];
        $horas = $_POST['data_horas'];
        $obs = $_POST['obs'];
        if ($cpf == '0' or $cpf == '') {
            $cpf = $_SESSION["usuario"][7];
        }
        if ($nome_emiss == '0' or $nome_emiss == '') {
            $nome_emiss = $_SESSION["usuario"][0];
        }
        $Todos_notas = $conexao->prepare("SELECT * FROM tabela_notas order by cod desc ");
        $Todos_notas->execute();
        if ($linha = $Todos_notas->fetch(PDO::FETCH_ASSOC)) {
            $cod_ult = $linha['cod'];
            $cod_prox = $cod_ult + 1;
        }
        if (!isset($cod_prox)) {
            $cod_prox = 0;
        }
        $TABELA_notas = $conexao->prepare("INSERT INTO tabela_notas (cod, serie, tipo, forma_pagamento, cod_emissor , cod_cliente, cod_endereco, cod_contato, tipo_pessoa,  valor, `data`, observacoes ) 
            VALUES ('$cod_prox','2', '1','$forma_pagamento','$cod_user','$cod_cliente', '$endereco', '$contato', '$tipo_cliente', '$valor', '$data_correta','$obs' )");
        $TABELA_notas->execute();

        $Todos_notas = $conexao->prepare("SELECT * FROM tabela_notas ORDER BY cod DESC ");
        $Todos_notas->execute();
        if ($linha = $Todos_notas->fetch(PDO::FETCH_ASSOC)) {
            $numero = $linha['cod'];
        }
        if ($tipo_cliente == 1) {
            $calculo_credito = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE cod = $cod_cliente");
        }
        if ($tipo_cliente == 2) {
            $calculo_credito = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE cod = $cod_cliente");
        }

        $calculo_credito->execute();
        if ($linha = $calculo_credito->fetch(PDO::FETCH_ASSOC)) {
            $anterios = $linha['credito'];
        }

        $credito = $anterios + $valor;
        // echo $credito;

        if ($_POST['forma_pagamento'] == '1') {

            if ($tipo_cliente == '1') {
                $TABELA_SIAFI = $conexao->prepare("INSERT INTO nt_credito_lanc_siafi (NT_CREDITO_CODIGO, NT_CREDITO_CODIGO_SIAFI, CPF_USR, NOME_USR, UG, DATA_HORA) VALUES ('$numero','$siafi', '$cpf','$nome_emiss','$ug','$horas')");
                $TABELA_SIAFI->execute();
                $query_aceitalas = $conexao->prepare("UPDATE tabela_clientes_fisicos SET credito = '$credito' WHERE cod = $cod_cliente ");
                $query_aceitalas->execute();
            }
            if ($tipo_cliente == '2') {
                $TABELA_SIAFI = $conexao->prepare("INSERT INTO nt_credito_lanc_siafi (NT_CREDITO_CODIGO, NT_CREDITO_CODIGO_SIAFI, CPF_USR, NOME_USR, UG, DATA_HORA) VALUES ('$numero','$siafi', '$cpf','$nome_emiss','$ug','$horas')");
                $TABELA_SIAFI->execute();
                $query_aceitalas = $conexao->prepare("UPDATE tabela_clientes_juridicos SET credito = '$credito' WHERE cod = $cod_cliente ");
                $query_aceitalas->execute();
            }
        }
        if ($_POST['forma_pagamento'] == '2') {

            if ($tipo_cliente == '1') {
                $TABELA_gru = $conexao->prepare("INSERT INTO nt_credito_lanc_gru (NT_CREDITO_CODIGO,CPF_USR, NOME_USR, CODIGO_REC, DATA_HORA) VALUES ('$numero','$cpf', '$nome_emiss','$cod_recolhimento','$horas')");
                $TABELA_gru->execute();
                $query_aceitalas = $conexao->prepare("UPDATE tabela_clientes_fisicos SET credito = '$credito' WHERE cod = $cod_cliente ");
                $query_aceitalas->execute();
            }
            if ($tipo_cliente == '2') {
                $TABELA_gru = $conexao->prepare("INSERT INTO nt_credito_lanc_gru (NT_CREDITO_CODIGO,CPF_USR, NOME_USR, CODIGO_REC, DATA_HORA) VALUES ('$numero','$cpf', '$nome_emiss','$cod_recolhimento','$horas')");
                $TABELA_gru->execute();
                $query_aceitalas = $conexao->prepare("UPDATE tabela_clientes_juridicos SET credito = '$credito' WHERE cod = $cod_cliente ");
                $query_aceitalas->execute();
            }
        }
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
                     Nota de Credito Adicionada com Sucesso!    
                </div>
              </div>';
              ?>
             <input class="<?= $cod_cliente ?>" type="text" id="VALORES" name="<?= $tipo_cliente ?>" value="<?= $cod_cliente ?>"/>
      <script>
          // Seleciona o elemento com a classe "VALORES"
          var elemento = document.getElementById('VALORES');
      
          // Verifica se o elemento foi encontrado
          if (elemento) {
              // Constrói a URL para a API
              var url = '../financeiro/api_correcao_credito.php?cod=' + elemento.value + '&tipo=' + elemento.name;
              
              // Faz a requisição fetch
              fetch(url)
    .then(response => response.json())
    .then(data => {
    });
          } else {
              console.error('Elemento não encontrado.');
          }
        
                  </script>
              <?php
        $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Adicionado nota de credito para o Cliente: $cod_cliente, Tipo: $tipo_cliente, Valor: $valor' , '$cod_user' , '$dataHora')");
        $Atividade_Supervisao->execute();
        if ($tipo_cliente == '1') {
            ?> <script>  setTimeout(function() {window.location.href = 'tl-cadastro-notas.php?tp=1';}, 1000);    </script><?php
        } else {
            ?> <script>  setTimeout(function() {window.location.href = 'tl-cadastro-notas.php?tp=2';}, 1000);    </script><?php
        }
    } else {
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
                 Erro é necessario selecionar os campos Obrigatórios! <br>
                 Confira o Contato e o Endereço!   
            </div>
          </div>';
          ?> <script>  setTimeout(function() {window.location.href = 'tl-cadastro-notas.php';}, 1000);    </script><?php
    }
}
if (isset($_POST['editar'])) {
    if (isset($_POST['valor']) && isset($_POST['forma_pagamento']) && isset($_POST['codigo_cliente'])) {
        $cod = $_POST['numero'];
        $endereco = $_POST['endereco'];
        $contato = $_POST['contato'];
        $data_lan = $_POST['data_lancamento'];
        $data_e_hora = $_POST['data_horas'];
        $dataHoraFormatada = date('Y-m-d H:i:s', strtotime(str_replace('T', ' ', $data_e_hora)));
        $dataFormatada2 = date('d/m/Y', strtotime($data_e_hora));
         echo $dataHoraFormatada . '<br>';
        $datas = explode('-', $data_e_hora);
        $data_correta = date('d/m/Y', strtotime($datas[0] . $datas[1] . $datas[2]));
        $valorN = $_POST['valor'];

        $cod_cliente = $_POST['codigo_cliente'];
        $tipo_cliente = $_POST['tipo_cliente'];
        // echo $_POST['tipo_cliente'];
        if ($_POST['forma_pagamento'] == 2) {
            $forma_pagamento = 4;
        } else {
            $forma_pagamento = 1;
        }


        $cpf = $_POST['cpf'];
        $nome_emiss = $_POST['nome_emissor'];
        $cod_recolhimento = $_POST['cod_recolhimete'];
        $siafi = $_POST['siafi'];
        $ug = $_POST['ug'];
        $horas = $_POST['data_horas'];
        $obs = $_POST['obs'];
        if ($cpf == '0' or $cpf == '') {
            $cpf = $_SESSION["usuario"][7];
        }
        if ($nome_emiss == '0' or $nome_emiss == '') {
            $nome_emiss = $_SESSION["usuario"][0];
        }
        $Todos_notas = $conexao->prepare("SELECT * FROM tabela_notas WHERE cod = $cod ");
        $Todos_notas->execute();
        if ($linha = $Todos_notas->fetch(PDO::FETCH_ASSOC)) {
            $valor = $linha['valor'];
        }
        if ($tipo_cliente == 1) {
            $calculo_credito = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE cod = $cod_cliente");
        }
        if ($tipo_cliente == 2) {
            $calculo_credito = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE cod = $cod_cliente");
        }

        $calculo_credito->execute();
        if ($linha = $calculo_credito->fetch(PDO::FETCH_ASSOC)) {
            $anterios = $linha['credito'];
        }

        if ($valor < $valorN) {
            $resto = $valorN - $valor;
            $credito = $anterios + $resto;
        } elseif ($valor > $valorN) {
            $resto = $valor - $valorN;
            $credito = $anterios - $resto;
        } elseif ($valor == $valorN) {
            $credito = $anterios;
        }
      //  echo 'Calculo: ' . $resto . '<br> Anteriores Z: ' . $anterios . '<br> novo X: ' . $valorN . '<br> valor anterior A:' . $valor . '<br>';
        echo $credito;
        echo "<br> UPDATE tabela_notas SET forma_pagamento = '$forma_pagamento', cod_endereco =  '$endereco', cod_contato = '$contato', observacoes = '$obs', valor = '$valorN', data = '$dataFormatada2' WHERE cod = $cod <br>";
        $TABELA_notas = $conexao->prepare("UPDATE tabela_notas SET forma_pagamento = '$forma_pagamento', cod_endereco =  '$endereco', cod_contato = '$contato', observacoes = '$obs', valor = '$valorN', data = '$dataFormatada2' WHERE cod = $cod ");
        $TABELA_notas->execute();

        if ($_POST['forma_pagamento'] == '1') {
            echo 'entrou1';
            echo "<br> UPDATE nt_credito_lanc_siafi SET NT_CREDITO_CODIGO_SIAFI = '$siafi', CPF_USR =  '$cpf', NOME_USR = '$nome_emiss', UG = '$ug', DATA_HORA = '$dataHoraFormatada' WHERE NT_CREDITO_CODIGO = $cod ";
            $TABELA_SIAFI = $conexao->prepare("UPDATE nt_credito_lanc_siafi SET NT_CREDITO_CODIGO_SIAFI = '$siafi', CPF_USR =  '$cpf', NOME_USR = '$nome_emiss', UG = '$ug', DATA_HORA = '$dataHoraFormatada' WHERE NT_CREDITO_CODIGO = $cod ");
            $TABELA_SIAFI->execute();
            if ($tipo_cliente == '1') {
                $query_aceitalas = $conexao->prepare("UPDATE tabela_clientes_fisicos SET credito = '$credito' WHERE cod = $cod_cliente ");
                $query_aceitalas->execute();
            }
            if ($tipo_cliente == '2') {
                $query_aceitalas = $conexao->prepare("UPDATE tabela_clientes_juridicos SET credito = '$credito' WHERE cod = $cod_cliente ");
                $query_aceitalas->execute();
            }
        }
        if ($_POST['forma_pagamento'] == '2') {
            $TABELA_gru = $conexao->prepare("UPDATE nt_credito_lanc_gru SET CPF_USR = '$cpf', NOME_USR = '$nome_emiss', CODIGO_REC = '$cod_recolhimento', DATA_HORA = '$dataHoraFormatada' WHERE NT_CREDITO_CODIGO = $cod");
            $TABELA_gru->execute();
            if ($tipo_cliente == '1') {
                $query_aceitalas = $conexao->prepare("UPDATE tabela_clientes_fisicos SET credito = '$credito' WHERE cod = $cod_cliente ");
                $query_aceitalas->execute();
            }
            if ($tipo_cliente == '2') {
                $query_aceitalas = $conexao->prepare("UPDATE tabela_clientes_juridicos SET credito = '$credito' WHERE cod = $cod_cliente ");
                $query_aceitalas->execute();
            }
        }
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
                     Nota de Credito Adicionada com Sucesso!    
                </div>
              </div>';
              ?>
         <input class="<?= $cod_cliente ?>" type="text" id="VALORES" name="<?= $tipo_cliente ?>" value="<?= $cod_cliente ?>"/>
      <script>
          // Seleciona o elemento com a classe "VALORES"
          var elemento = document.getElementById('VALORES');
      
          // Verifica se o elemento foi encontrado
          
          if (elemento) {
              // Constrói a URL para a API
              var url = '../financeiro/api_correcao_credito.php?cod=' + elemento.value + '&tipo=' + elemento.name;
      
              // Faz a requisição fetch
              fetch(url)
    .then(response => response.json())
    .then(data => {
        console.log('executou')
    });
          } else {
              console.error('Elemento não encontrado.');
          }
        
                  </script>
              <?php
        $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Nota de Crédito editada do Cliente $cod_cliente, Tipo: $tipo_cliente, Cod Nota: $cod ' , '$cod_user' , '$dataHora')");
        $Atividade_Supervisao->execute();
        ?> <script>  setTimeout(function() {window.location.href = 'tl-cadastro-notas.php?tp=3';}, 1000);    </script><?php
    } else {
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
                 Erro é necessario selecionar os campos Obrigatórios!   
            </div>
          </div>';
          ?> <script>  setTimeout(function() {window.location.href = 'tl-cadastro-notas.php';}, 1000);    </script><?php
    }
}