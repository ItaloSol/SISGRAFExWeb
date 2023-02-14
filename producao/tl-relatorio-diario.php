<?php /* |--  --| */ include_once("../html/navbar.php"); 
$query_atendent = $conexao->prepare("SELECT * FROM relatorio_diario r INNER JOIN tabela_atendentes a ON a.codigo_atendente = r.atendente_relatorio ORDER BY r.data_relatorio DESC"); 
$query_atendent->execute(); 


if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
  }  
  ?>
  <div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
      <div class="accordion mt-3" id="accordionExample">
        <div class="card accordion-item active">
          <h2 class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
              Adicionar Novo Relatório
            </button>
          </h2>
          <form method="POST" action="b-diario.php">
           
            <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <div class="mb-3">
                  <label for="nome" class="form-label">Autor do Relatório</label>
                  <input type="text" class="form-control" name="nome" disabled value="<?= $nome_user ?>" id="nome" placeholder="Insira o Nome do Usuário" />
                  <input type="hidden" class="form-control" name="nome"  value="<?= $cod_user ?>" id="nome" placeholder="Insira o Nome do Usuário" />
                </div>
                <div class="mb-3">
                  <label for="relatorio" class="form-label">Relatório</label>
                  <table class="table table-bordered"><tr><th>Data</th><th>OP</th><th>CLIENTE</th><th>SERVIÇO</th><th>QNT EXECUTADA</th><th>MATERIAL DESCARTADO</th><th>OBSERVAÇÃO</th></tr><tr><td><input class="form-control" name="data" value="<?= $hoje ?>" type="date"></td><td><input class="form-control" name="op" type="number"></td><td><input class="form-control" name="cliente" type="text"></td><td><input class="form-control" name="servico" type="text"></td><td><input class="form-control" name="qtd" type="text"></td><td><input class="form-control" name="material" type="text"></td><td><input class="form-control" name="relatorio" type="text"></td></tr></table>
                </div>
                <div class="mb-3">
              <div class="card-body">
                <input class="btn btn-primary" type="submit" value="Salvar" >
              </div>
            </div>
        </div>
        </div>
        </form>
      </div><br>

<div class="card">
<h5 class="card-header">Controle de Usuário</h5>
<div class="card-body">
  <div class="table-responsive text-nowrap">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Id Relatório</th>
          <th>Autor do Relatório</th>
          <th>Data</th><th>OP</th><th>CLIENTE</th><th>SERVIÇO</th><th>QNT EXECUTADA</th><th>MATERIAL DESCARTADO</th><th>OBSERVAÇÃO</th>
        </tr>
      </thead>
      <tbody>
        <?php /* |--  --| */ 
         while($linha = $query_atendent->fetch(PDO::FETCH_ASSOC)) {
            $NAM = $linha['nome_atendente'];
            $DATA = $linha['data_relatorio'];
            $ID = $linha['id_relatorio'];
            $OP = $linha['op_rel'];
            $CLIEN = $linha['cliente_rel'];
            $SERV = $linha['servico_rel'];
            $QTD = $linha['qtd_rel'];
            $MATE = $linha['material_rel'];
            $DESCRICAO = $linha['desc_relatorio'];
            $ATN = $linha['atendente_relatorio'];
            echo "<tr>
            <td>".$ID."</td><td>".$ATN." - ".$NAM."</td><td>".$DATA."</td><td>".$OP."</td><td>".$CLIEN."</td><td>".$SERV."</td><td>".$QTD."</td><td>".$MATE."</td><td>".$DESCRICAO."</td>
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

    
    
 <?php /* |--  --| */   include_once("../html/navbar-dow.php"); ?>