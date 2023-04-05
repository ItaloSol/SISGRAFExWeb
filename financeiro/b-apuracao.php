<?php  
if(isset($_GET['tipo'])){
  if($_GET['tipo'] == 1){
    include_once('buscar_saldos_fisicos.php');
  }
  if($_GET['tipo'] == 2){
    include_once('buscar_saldos_juridico.php');
  }
}
        
         
         ?>

<h5 class="card-header">Clientes Com Saldo Possivelmente Incorreto!</h5>

<!-- Basic Pagination -->
<div class="card-body">
                    
            <div class="row">
              <div class="col">
            
                <small class="text-light fw-semibold">Página</small>
                <div class="demo-inline-spacing">
                <div class="navbar navbar navbar-left bg-left mb-5">
                  <?php if($_GET['tipo'] == 2){ ?>
                  <a href="tl-cadastro-notas.php?tp=4&tipo=2" class="btn btn-outline-primary active">Júridicos</a>
                  <a href="tl-cadastro-notas.php?tp=4&tipo=1" class="btn btn-outline-primary">Físicos</a>
                  <?php }else{?>
                  <a href="tl-cadastro-notas.php?tp=4&tipo=2" class="btn btn-outline-primary">Júridicos</a><a href="tl-cadastro-notas.php?tp=4&tipo=1" class="btn btn-outline-primary active">Físicos</a>
                  <?php }?>
              </div>
                      
                        



  
<div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Código</th>
                          <th>Nome</th>
                          
                          <th>Saldo Correto</th>
                          <th>Saldo Atual</th>
                          <th>Diferença de Saldo</th>
                          <th>Corrigir Saldo</th>
                          <th>Gerar Relaório</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php  
                        $Percorrer = 0;
                        $encontrados = 0;
                        while($Percorrer < $numero_clientes){ 
                                          if(number_format($Saldo_Correto[$Percorrer], 2, ',', '.') != number_format($Tabela_Clientes[$Percorrer]['credito'], 2, ',', '.')){        ?>
                        <tr>
                          <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $Tabela_Clientes[$Percorrer]['cod'] ?></strong>
                          </td>
                          <td><?= $Tabela_Clientes[$Percorrer]['nome'] ?> </td>
                          <td>
                          
                              <li>
                              <span class="badge bg-label-primary me-1"> <?= number_format($Saldo_Correto[$Percorrer], 2, ',', '.') ?></span>
                              </li>
                              
                          </td>
                          <td><?= number_format($Tabela_Clientes[$Percorrer]['credito'], 2, ',', '.') ?></td>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= number_format($Diferenca_Correcao[$Percorrer], 2, ',', '.') ?></strong></td>
                          <td>
                          <a class="btn rounded-pill btn-info" href="b-corrigir.php?cod=<?= $Tabela_Clientes[$Percorrer]['cod'] ?>&tipo=<?= $tipo_cliente ?>"><i class="bx bx-edit-alt me-1"></i> Corrigir</a>
                          </td>
                          <td>
                          <a  target="_blank" class="btn rounded-pill btn-info" href="../relatorios/detalhamento_resumido_clientes.php?cod=<?=$Tabela_Clientes[$Percorrer]['cod']?>&tipo=<?= $tipo_cliente ?>"><iconify-icon icon="mdi:form-outline" width="18" height="18"></iconify-icon> Relaório</a>
                          </td>
                        </tr>
                       <tr><td colspan="7">Apuração: CRÉDITO = <?= number_format($Valor_Notas_Totais[$Percorrer], 2, ',', '.') ?> DÉBITO = <?= number_format($Total_Faturamentos[$Percorrer], 2, ',', '.') ?> EM PRODUÇÃO = <?= number_format($Total_EmProducao[$Percorrer], 2, ',', '.') ?> TOTAL = <?= number_format($Saldo_Correto[$Percorrer], 2, ',', '.') ?> </td></tr>
                        <?php $encontrados++; } $Percorrer++; } ?>
                        <tr><td colspan="4" rowspan="4">TOTAL ENCONTRADOS: <?= $encontrados ?></td></tr>
                      </tbody>
                    </table>
                    <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>