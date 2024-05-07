<?php 
session_start();
$cod_user = $_SESSION["usuario"][2];
include_once('../conexoes/conexao.php');
$cod = $_GET['cod'];
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$hoje = date('Y-m-d');
?> <div id="load1" class="mb-5" style="position:absolute;background-color: #01010c; width: 100%; height: 100vh; z-index: 9999999999999; align-items: center; justify-content: center; display: flex; color: white; font-size: 40px;"> CARREGANDO<br> <div><br> <img style="position:absolute; margin-left: -220px;  justify-content: start; display: flex; color: white; font-size: 40px;" src="../img/preloader.svg"> </div> </div>
<?php
$cod = $_GET['cod'];
$tipo = 2;
if (isset($_GET['acao'])) {

  if ($_GET['acao'] == '6') {
    $query_aceitalas = $conexao->prepare("UPDATE tabela_orcamentos SET status = '6'  WHERE cod = '$cod' ");
    $query_aceitalas->execute();
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
                 Orçamento não aprovado pelo cliente!     
            </div>
          </div>';
    $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Orçamento $cod Não aprovado pelo cliente' , '$cod_user' , '$dataHora')");
    $Atividade_Supervisao->execute();
    $buscacliente = $conexao->prepare("SELECT * FROM tabela_orcamentos WHERE cod = $cod ");
            $buscacliente->execute();
            if ($linha = $buscacliente->fetch(PDO::FETCH_ASSOC)) {
                
                $tipo = $linha['tipo_cliente'];
            }
    ?>
         <input class="VALORES" type="text" id="<?= $cod ?>" name="<?= $tipo ?>" value="<?= $cod ?> <?= $tipo ?>"/>
         <input type="number" value="<?= $cod ?>" id="codigoOP">
      <script>
          // Seleciona o elemento com a classe "VALORES"
          var cod = document.getElementById('codigoOP').value;
          var elemento = document.querySelector('.VALORES');
            
          // Verifica se o elemento foi encontrado
          if (elemento) {
              // Constrói a URL para a API
              var url = '../financeiro/api_correcao_credito.php?cod=' + cod + '&tipo=' + elemento.name;
      
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
               ?><script> 
                var cod = document.getElementById('codigoOP').value;
               setTimeout(function() {window.location.href = `tl-orcamento.php?cod=${cod}&tipo=${elemento.name}`;}, 1000);    </script><?php
  }
  if ($_GET['acao'] == '13') {
    $query_aceitalas = $conexao->prepare("UPDATE tabela_orcamentos SET status = '13'  WHERE cod = '$cod' ");
    $query_aceitalas->execute();
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
                 Orçamento cancelado com sucesso!     
            </div>
          </div>';
    $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Orçamento $cod Cancelado' , '$cod_user' , '$dataHora')");
    $Atividade_Supervisao->execute();
    $buscacliente = $conexao->prepare("SELECT * FROM tabela_orcamentos WHERE cod = $cod ");
            $buscacliente->execute();
            if ($linha = $buscacliente->fetch(PDO::FETCH_ASSOC)) {
                
                $tipo = $linha['tipo_cliente'];
            }
    ?>
         <input class="VALORES" type="text" id="<?= $cod ?>" name="<?= $tipo ?>" value="<?= $cod ?> <?= $tipo ?>"/>
         <input type="number" value="<?= $cod ?>" id="codigoOP">
      <script>
          // Seleciona o elemento com a classe "VALORES"
          var cod = document.getElementById('codigoOP').value;
          // Seleciona o elemento com a classe "VALORES"
          var elemento = document.querySelector('.VALORES');
      
          // Verifica se o elemento foi encontrado
          if (elemento) {
              // Constrói a URL para a API
              var url = '../financeiro/api_correcao_credito.php?cod=' + cod + '&tipo=' + elemento.name;
      
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
                       ?><script> 
                        var cod = document.getElementById('codigoOP').value;
                       setTimeout(function() {window.location.href = `tl-orcamento.php?cod=${cod}&tipo=${elemento.name}`;}, 1000);    </script><?php
  }
  if ($_GET['acao'] == '2') {
    $query_aceitalas = $conexao->prepare("UPDATE tabela_orcamentos SET status = '2'  WHERE cod = '$cod' ");
    $query_aceitalas->execute();
    $query_aceitalas = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Orçamento $cod Enviado para produção' , '$cod_user' , '$dataHora')");
    $query_aceitalas->execute();
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
                 Orçamento enviado para produção!     
            </div>
          </div>';
    //  echo $_POST['data'] . ' ' . $_POST['obs'];
    $prova = $_POST['data'];
    $obs =  $_POST['obs'];
    $cliente = $_POST['cliente'];
    $tipocli = $_POST['tipocliente'];
    $endereco =  $_POST['endereco'];
    $contato = $_POST['contato'];
    $data_emiss = date('Y-m-d');
    $data_entrega = $_POST['data_entrega'];
    //  echo $data_emiss . ' ' . $data_entrega;
    $itens = 1;

    $query_orcamentos_calculo = $conexao->prepare("SELECT * FROM tabela_calculos_op WHERE cod_proposta = $cod ");
    $query_orcamentos_calculo->execute();
    while ($linha = $query_orcamentos_calculo->fetch(PDO::FETCH_ASSOC)) {
      $tipo_produto = $linha['tipo_produto'];
      $cod_produto = $linha['cod_produto'];
      $cod_calc = $linha['cod'];
      $cod_op = $cod . $itens;
      echo '<br>' . $cod_op;

      $criar_Op = $conexao->prepare("INSERT INTO tabela_ordens_producao(cod, orcamento_base, tipo_produto, cod_produto, prioridade_op, secao_op, cod_cliente, cod_contato, cod_endereco, cod_emissor, tipo_cliente, status, descricao, data_emissao, data_entrega, DT_ENTG_PROVA) VALUES ($cod_op,$cod,$tipo_produto,$cod_produto,'2 - Normal','SEÇÃO TÉCNICA',$cliente,$contato,$endereco,'$cod_user',$tipocli,1,'$obs','$data_emiss','$data_entrega','$prova')");
      $criar_Op->execute();
      $query_aceitalas = $conexao->prepare("UPDATE tabela_calculos_op SET cod_op = '$cod_op'  WHERE cod = '$cod_calc' ");
      $query_aceitalas->execute();
      $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Abriu a OP $cod_op, Cliente $cliente' , '$cod_user' , '$dataHora')");
      $Atividade_Supervisao->execute();
      $itens++;
    }

    echo $cod;
    ?>
         <input class="VALORES" type="text" id="<?= $cliente ?>" name="<?= $tipocli ?>" value="<?= $cliente ?> <?= $tipocli ?>"/>
         <input type="number" value="<?= $cod ?>" id="codigoOP">
      <script>
          // Seleciona o elemento com a classe "VALORES"
          var elemento = document.querySelector('.VALORES');
          var cod = document.getElementById('codigoOP').value;
          // Verifica se o elemento foi encontrado
          if (elemento) {
              // Constrói a URL para a API
              var url = '../financeiro/api_correcao_credito.php?cod=' + cod + '&tipo=' + elemento.name;
      
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
                       ?><script> 
                        var cod = document.getElementById('codigoOP').value;
                       setTimeout(function() {window.location.href = `tl-orcamento.php?cod=${cod}&tipo=${elemento.name}`;}, 1000);    </script><?php
  }
  if ($_GET['acao'] == '3') {
    $query_aceitalas = $conexao->prepare("UPDATE tabela_orcamentos SET status = '3'  WHERE cod = '$cod' ");
    $query_aceitalas->execute();
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
                 Orçamento enviado para o ordenador de despesa!     
            </div>
          </div>';
    $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Orçamento $cod Enviado para o ordenador de despesa' , '$cod_user' , '$dataHora')");
    $Atividade_Supervisao->execute();
    $buscacliente = $conexao->prepare("SELECT * FROM tabela_orcamentos WHERE cod = $cod ");
            $buscacliente->execute();
            if ($linha = $buscacliente->fetch(PDO::FETCH_ASSOC)) {
                
                $tipo = $linha['tipo_cliente'];
            }
    ?>
         <input class="VALORES" type="text" id="<?= $cod ?>" name="<?= $tipo ?>" value="<?= $cod ?> <?= $tipo ?>"/>
         <input type="number" value="<?= $cod ?>" id="codigoOP">
      <script>
          // Seleciona o elemento com a classe "VALORES"
          var cod = document.getElementById('codigoOP').value;
          // Seleciona o elemento com a classe "VALORES"
          var elemento = document.querySelector('.VALORES');
      
          // Verifica se o elemento foi encontrado
          if (elemento) {
              // Constrói a URL para a API
              var url = '../financeiro/api_correcao_credito.php?cod=' + cod + '&tipo=' + elemento.name;
      
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
         ?><script> 
          var cod = document.getElementById('codigoOP').value;
         setTimeout(function() {window.location.href = `tl-orcamento.php?cod=${cod}&tipo=${elemento.name}`;}, 1000);    </script><?php
  }
  if ($_GET['acao'] == '7') {
    $query_aceitalas = $conexao->prepare("UPDATE tabela_orcamentos SET status = '7'  WHERE cod = '$cod' ");
    $query_aceitalas->execute();
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
                 Orçamento enviado para expedição!     
            </div>
          </div>';
    $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Orçamento $cod enviado para expedição' , '$cod_user' , '$dataHora')");
    $Atividade_Supervisao->execute();
    $prova = $_POST['data'];
    $obs =  $_POST['obs'];
    $cliente = $_POST['cliente'];
    $tipocli = $_POST['tipocliente'];
    $endereco =  $_POST['endereco'];
    $contato = $_POST['contato'];
    $data_emiss = date('Y-m-d');
    $data_entrega = $prova;
    //  echo $data_emiss . ' ' . $data_entrega;
    $itens = 1;

    $query_orcamentos_calculo = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento WHERE cod_orcamento= $cod ");
    $query_orcamentos_calculo->execute();
    while ($linha = $query_orcamentos_calculo->fetch(PDO::FETCH_ASSOC)) {
      $tipo_produto = $linha['tipo_produto'];
      $cod_produto = $linha['cod_produto'];
      $cod_calc = $linha['cod'];
      $cod_op = $cod . $itens;
      echo '<br>' . $cod_op;

      $criar_Op = $conexao->prepare("INSERT INTO tabela_ordens_producao(cod, orcamento_base, tipo_produto, cod_produto, prioridade_op, secao_op, cod_cliente, cod_contato, cod_endereco, cod_emissor, tipo_cliente, status, descricao, data_emissao, data_entrega, DT_ENTG_PROVA) VALUES ($cod_op,$cod,$tipo_produto,$cod_produto,'2 - Normal','EXPEDIÇÃO',$cliente,$contato,$endereco,'$cod_user',$tipocli,10,'$obs','$data_emiss','$data_entrega','$prova')");
      $criar_Op->execute();
      $query_aceitalas = $conexao->prepare("UPDATE tabela_calculos_op SET cod_op = '$cod_op'  WHERE cod = '$cod_calc' ");
      $query_aceitalas->execute();
      $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Abriu a OP $cod_op, Cliente $cliente' , '$cod_user' , '$dataHora')");
      $Atividade_Supervisao->execute();
      $itens++;
    }
    ?>
         <input class="VALORES" type="text" id="<?= $cliente ?>" name="<?= $tipocli ?>" value="<?= $cliente ?> <?= $tipocli ?>"/>
         <input type="number" value="<?= $cod ?>" id="codigoOP">
      <script>
          // Seleciona o elemento com a classe "VALORES"
          var elemento = document.querySelector('.VALORES');
          var cod = document.getElementById('codigoOP').value;
          // Verifica se o elemento foi encontrado
          if (elemento) {
              // Constrói a URL para a API
              var url = '../financeiro/api_correcao_credito.php?cod=' + cod + '&tipo=' + elemento.name;
      
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
          ?><script> 
           var cod = document.getElementById('codigoOP').value;
          setTimeout(function() {window.location.href = `tl-orcamento.php?cod=${cod}&tipo=${elemento.name}`;}, 1000);    </script><?php
  }
  if ($_GET['acao'] == '4') {
    $query_aceitalas = $conexao->prepare("UPDATE tabela_orcamentos SET status = '4'  WHERE cod = '$cod' ");
    $query_aceitalas->execute();
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
                 Orçamento autorizado pelo Ordenador de despesa !     
            </div>
          </div>';
    $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Orçamento $cod autorizado pelo Ordenador de Despesa' , '$cod_user' , '$dataHora')");
    $Atividade_Supervisao->execute();
    $buscacliente = $conexao->prepare("SELECT * FROM tabela_orcamentos WHERE cod = $cod ");
            $buscacliente->execute();
            if ($linha = $buscacliente->fetch(PDO::FETCH_ASSOC)) {
                
                $tipo = $linha['tipo_cliente'];
            }
    ?>
         <input class="VALORES" type="text" id="<?= $cod ?>" name="<?= $tipo ?>" value="<?= $cod ?> <?= $tipo ?>"/>
         <input type="number" value="<?= $cod ?>" id="codigoOP">
      <script>
          // Seleciona o elemento com a classe "VALORES"
          var cod = document.getElementById('codigoOP').value;
          // Seleciona o elemento com a classe "VALORES"
          var elemento = document.querySelector('.VALORES');
      
          // Verifica se o elemento foi encontrado
          if (elemento) {
              // Constrói a URL para a API
              var url = '../financeiro/api_correcao_credito.php?cod=' + cod + '&tipo=' + elemento.name;
      
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
          ?><script> 
           var cod = document.getElementById('codigoOP').value;
          setTimeout(function() {window.location.href = `tl-orcamento.php?cod=${cod}&tipo=${elemento.name}`;}, 1000);    </script><?php
  }
  if ($_GET['acao'] == '5') {
    $query_aceitalas = $conexao->prepare("UPDATE tabela_orcamentos SET status = '5'  WHERE cod = '$cod' ");
    $query_aceitalas->execute();
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
                 Orçamento não autorizado pelo Ordenador de despesa!     
            </div>
          </div>';
    $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Orçamento $cod Não aprovado pelo ordenador de despesa ' , '$cod_user' , '$dataHora')");
    $Atividade_Supervisao->execute();
    $buscacliente = $conexao->prepare("SELECT * FROM tabela_orcamentos WHERE cod = $cod ");
            $buscacliente->execute();
            if ($linha = $buscacliente->fetch(PDO::FETCH_ASSOC)) {
                
                $tipo = $linha['tipo_cliente'];
            }
    ?>
         <input class="VALORES" type="text" id="<?= $cod ?>" name="<?= $tipo ?>" value="<?= $cod ?> <?= $tipo ?>"/>
         <input type="number" value="<?= $cod ?>" id="codigoOP">
      <script>
          // Seleciona o elemento com a classe "VALORES"
          var cod = document.getElementById('codigoOP').value;
          // Seleciona o elemento com a classe "VALORES"
          var elemento = document.querySelector('.VALORES');
      
          // Verifica se o elemento foi encontrado
          if (elemento) {
              // Constrói a URL para a API
              var url = '../financeiro/api_correcao_credito.php?cod=' + cod + '&tipo=' + elemento.name;
      
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
         ?><script> 
          var cod = document.getElementById('codigoOP').value;
         setTimeout(function() {window.location.href = `tl-orcamento.php?cod=${cod}&tipo=${elemento.name}`;}, 1000);    </script><?php
  }
  if ($_GET['acao'] == '9') {
    $query_aceitalas = $conexao->prepare("UPDATE tabela_orcamentos SET status = '1'  WHERE cod = '$cod' ");
    $query_aceitalas->execute();
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
                 Orçamento Voltou para em avaliação!    
            </div>
          </div>';
    $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Orçamento $cod Voltou para em Avaliação ' , '$cod_user' , '$dataHora')");
    $Atividade_Supervisao->execute();
    $buscacliente = $conexao->prepare("SELECT * FROM tabela_orcamentos WHERE cod = $cod ");
            $buscacliente->execute();
            if ($linha = $buscacliente->fetch(PDO::FETCH_ASSOC)) {
                
                $tipo = $linha['tipo_cliente'];
            }
    ?>
         <input class="VALORES" type="text" id="<?= $cod ?>" name="<?= $tipo ?>" value="<?= $cod ?> <?= $tipo ?>"/>
         <input type="number" value="<?= $cod ?>" id="codigoOP">
      <script>
          // Seleciona o elemento com a classe "VALORES"
          var cod = document.getElementById('codigoOP').value;
          // Seleciona o elemento com a classe "VALORES"
          var elemento = document.querySelector('.VALORES');
      
          // Verifica se o elemento foi encontrado
          if (elemento) {
              // Constrói a URL para a API
              var url = '../financeiro/api_correcao_credito.php?cod=' + cod + '&tipo=' + elemento.name;
      
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
         ?><script> 
          var cod = document.getElementById('codigoOP').value;
         setTimeout(function() {window.location.href = `tl-orcamento.php?cod=${cod}&tipo=${elemento.name}`;}, 1000);    </script><?php
  }
  if ($_GET['acao'] == '11') {
    $query_aceitalas = $conexao->prepare("UPDATE tabela_orcamentos SET status = '11'  WHERE cod = '$cod' ");
    $query_aceitalas->execute();
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
                 Orçamento autorizado pelo Ordenador de despesa cliente!     
            </div>
          </div>';
    $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Orçamento $cod autorizado pelo Ordenador de despesa cliente' , '$cod_user' , '$dataHora')");
    $Atividade_Supervisao->execute();
    $buscacliente = $conexao->prepare("SELECT * FROM tabela_orcamentos WHERE cod = $cod ");
            $buscacliente->execute();
            if ($linha = $buscacliente->fetch(PDO::FETCH_ASSOC)) {
                
                $tipo = $linha['tipo_cliente'];
            }
    ?>
         <input class="VALORES" type="text" id="<?= $cod ?>" name="<?= $tipo ?>" value="<?= $cod ?> <?= $tipo ?>"/>
         <input type="number" value="<?= $cod ?>" id="codigoOP">
      <script>
          // Seleciona o elemento com a classe "VALORES"
          var cod = document.getElementById('codigoOP').value;
          // Seleciona o elemento com a classe "VALORES"
          var elemento = document.querySelector('.VALORES');
      
          // Verifica se o elemento foi encontrado
          if (elemento) {
              // Constrói a URL para a API
              var url = '../financeiro/api_correcao_credito.php?cod=' + cod + '&tipo=' + elemento.name;
      
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
         ?><script> 
          var cod = document.getElementById('codigoOP').value;
         setTimeout(function() {window.location.href = `tl-orcamento.php?cod=${cod}&tipo=${elemento.name}`;}, 1000);    </script><?php
  }
  if ($_GET['acao'] == '12') {
    $query_aceitalas = $conexao->prepare("UPDATE tabela_orcamentos SET status = '12'  WHERE cod = '$cod' ");
    $query_aceitalas->execute();
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
                 Orçamento não autorizado pelo Ordenador de despesa cliente!     
            </div>
          </div>';
    $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Orçamento $cod não autorizado pelo Ordenador de despesa cliente' , '$cod_user' , '$dataHora')");
    $Atividade_Supervisao->execute();
    $buscacliente = $conexao->prepare("SELECT * FROM tabela_orcamentos WHERE cod = $cod ");
            $buscacliente->execute();
            if ($linha = $buscacliente->fetch(PDO::FETCH_ASSOC)) {
                
                $tipo = $linha['tipo_cliente'];
            }
    ?>
         <input class="VALORES" type="text" id="<?= $cod ?>" name="<?= $tipo ?>" value="<?= $cod ?> <?= $tipo ?>"/>
         <input type="number" value="<?= $cod ?>" id="codigoOP">
      <script>
          // Seleciona o elemento com a classe "VALORES"
          var cod = document.getElementById('codigoOP').value;
          // Seleciona o elemento com a classe "VALORES"
          var elemento = document.querySelector('.VALORES');
      
          // Verifica se o elemento foi encontrado
          if (elemento) {
              // Constrói a URL para a API
              var url = '../financeiro/api_correcao_credito.php?cod=' + cod + '&tipo=' + elemento.name;
      
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
         ?><script> 
          var cod = document.getElementById('codigoOP').value;
         setTimeout(function() {window.location.href = `tl-orcamento.php?cod=${cod}&tipo=${elemento.name}`;}, 1000);    </script><?php
  }
}
if (isset($_GET['data'])) {
  $data_validade = $_GET['data'];
  $cod = $_GET['cod'];
  $query_aceitalas = $conexao->prepare("UPDATE tabela_orcamentos SET data_validade = '$data_validade', status = '1'  WHERE cod = '$cod' ");
  $query_aceitalas->execute();
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
               Alterada a data de validade do Orçamento!     
          </div>
        </div>';
  $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Alterou a data de validade do Orçamento $cod e o status para 1 - EM AVALIAÇÃO' , '$cod_user' , '$dataHora')");
  $Atividade_Supervisao->execute();
  $buscacliente = $conexao->prepare("SELECT * FROM tabela_ororcamentosHERE cod = $cod ");
            $buscacliente->execute();
            if ($linha = $buscacliente->fetch(PDO::FETCH_ASSOC)) {
                
                $tipo = $linha['tipo_cliente'];
            }
  ?>
         <input class="VALORES" type="text" id="<?= $cod ?>" name="<?= $tipo ?>" value="<?= $cod ?> <?= $tipo ?>"/>
         <input type="number" value="<?= $cod ?>" id="codigoOP">
      <script>
          // Seleciona o elemento com a classe "VALORES"
          var cod = document.getElementById('codigoOP').value;
          // Seleciona o elemento com a classe "VALORES"
          var elemento = document.querySelector('.VALORES');
      
          // Verifica se o elemento foi encontrado
          if (elemento) {
              // Constrói a URL para a API
              var url = '../financeiro/api_correcao_credito.php?cod=' + cod + '&tipo=' + elemento.className;
      
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
         ?><script> 
          var cod = document.getElementById('codigoOP').value;
         setTimeout(function() {window.location.href = `tl-orcamento.php?cod=${cod}&tipo=${elemento.name}`;}, 1000);    </script><?php
}
