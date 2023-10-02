<?php /*   */ include_once("../html/navbar.php");
if($Admin_User != 1){
  ?> <script>window.location = '../html/painel.php'</script> <?php
}
$query_atendent = $conexao->prepare("SELECT * FROM supervisao_atividade s INNER JOIN tabela_atendentes a ON a.codigo_atendente = s.atendente_supervisao ORDER BY s.id_supervisao DESC LIMIT 1000");
$query_atendent->execute();

$query_log = $conexao->prepare("SELECT * FROM log_op s INNER JOIN tabela_atendentes a ON a.codigo_atendente = s.USUARIO ORDER BY s.DATA_HORA DESC LIMIT 1000");
$query_log->execute();

$query_alteracao = $conexao->prepare("SELECT * FROM alteracoes_ordem_producao s INNER JOIN tabela_atendentes a ON a.codigo_atendente = s.USUARIO ORDER BY s.ALTERACAO DESC LIMIT 1000");
$query_alteracao->execute();
?>
<div class=" ADMINISTRAÇÃO-- "></div>
<div class="accordion mt-3" id="accordionExample">
  <div class="card accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne">
        ATIVIDADES SISGRAFEX WEB
      </button>
    </h2>

    <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <div class="table-responsive text-nowrap">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nome Usuario</th>
                <th>Data da Alteração</th>
                <th>Descrição da Alteração</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($linha = $query_atendent->fetch(PDO::FETCH_ASSOC)) {
                $NAM = $linha['nome_atendente'];
                $DATA = $linha['data_supervisao'];
                $ID = $linha['id_supervisao'];
                $DESCRICAO = $linha['alteracao_atividade'];
                $ATN = $linha['atendente_supervisao'];
                echo "<tr>
            <td>" . $ID . "</td><td>" . $ATN . " - " . $NAM . "</td><td>" . $DATA . "</td><td>" . $DESCRICAO . "</td>
            </tr>";
              }
              $a = 0;

              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="card accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
        LOG SISGRAFEX JAVA
      </button>
    </h2>
    <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nome Usuario</th>
              <th>Data da Alteração</th>
              <th>Descrição da Alteração</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($linha = $query_log->fetch(PDO::FETCH_ASSOC)) {
              $NAM = $linha['nome_atendente'];
              $DATA = $linha['DATA_HORA'];
              $ID = $linha['ID'];
              $OP = $linha['OP'];
              $DESCRICAO = $linha['ALTERACAO_DESC'];
              $ATN = $linha['USUARIO'];
              echo "<tr>
            <td>" . $ID . "</td><td>" . $ATN . " - " . $NAM . "</td><td>" . $DATA . "</td><td> OP: " . $OP . " " . $DESCRICAO . "</td>
            </tr>";
            }
            $a = 0;

            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="card accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree">
        ALTERAÇÕES EM OP SISGRAFEX JAVA
      </button>
    </h2>
    <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nome Usuario</th>
              <th>Data da Alteração</th>
              <th>Descrição da Alteração</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($linha = $query_alteracao->fetch(PDO::FETCH_ASSOC)) {
              $NAM = $linha['nome_atendente'];
              $DATA = $linha['ALTERACAO'];
              $ID = $linha['CODIGO'];
              $DESCRICAO = $linha['MOTIVO'];
              $Op = $linha['OP'];
              $ATN = $linha['USUARIO'];
              echo "<tr>
            <td>" . $ID . "</td><td>" . $ATN . " - " . $NAM . "</td><td>" . $DATA . "</td><td>" . $DESCRICAO . " NA OP: " . $Op . "</td>
            </tr>";
            }
            $a = 0;

            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
<?php /*   */ include_once("../html/navbar-dow.php"); ?>