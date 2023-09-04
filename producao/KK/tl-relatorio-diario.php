<?php include_once("../html/navbar.php");
$hoje = date('Y-m-d');
$AMANHA = date('Y-m-d', strtotime('+'. 1 .'day',strtotime($hoje))); 
$cod_user = $_SESSION["usuario"][2];
$mes = date('Y-m');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');

$query_atendent = $conexao->prepare("SELECT * FROM relatorio_diario r INNER JOIN tabela_atendentes a ON a.codigo_atendente = r.atendente_relatorio ORDER BY r.data_relatorio DESC");
$query_atendent->execute();


if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
}

if(isset($_POST['Filtrar'])){
  $secaoo = $_POST['secao'];
  if($_POST['iniofim'] == 'Inicio'){
    if($_POST['secao'] == 'ACABAMENTO'){
    $campo = 'data_ent_acabamento';
    }
    if($_POST['secao'] == 'CPT'){
    $campo = 'DT_ENTRADA_CTP';
    }
    if($_POST['secao'] == 'DIGITAL'){
    $campo = 'DT_ENT_DIGITAL';
    }
    if($_POST['secao'] == 'OFFSET'){
    $campo = 'data_ent_offset';
    }
    if($_POST['secao'] == 'PLOTTER'){
    $campo = 'DT_ENTRADA_PLOTTER';
    }
    if($_POST['secao'] == 'PRE'){
    $campo = 'DT_ENTRADA_PRE_IMP';
    }
    if($_POST['secao'] == 'TIPOGRAFIA'){
    $campo = 'data_ent_tipografia';
    }
  }
  if($_POST['iniofim'] == 'Termino'){
    if($_POST['secao'] == 'ACABAMENTO'){
    $campo = 'SAIDA_ACABAMENTO';
    }
    if($_POST['secao'] == 'CPT'){
    $campo = 'SAIDA_CTP';
    }
    if($_POST['secao'] == 'DIGITAL'){
    $campo = 'SAIDA_DIGITAL';
    }
    if($_POST['secao'] == 'OFFSET'){
    $campo = 'SAIDA_OFFSET';
    }
    if($_POST['secao'] == 'PLOTTER'){
    $campo = 'SAIDA_PLOTTER';
    }
    if($_POST['secao'] == 'PRE'){
    $campo = 'SAIDA_PRE';
    }
    if($_POST['secao'] == 'TIPOGRAFIA'){
    $campo = 'SAIDA_TIPOGRAFIA';
    }
  }

  
  $data = $_POST['data'];
  $datar = date('d/m/Y', strtotime($data));

$query_ordens_Selecionada = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO 
WHERE $campo = '$data' ORDER BY o.cod ASC ");
 $query_ordens_Selecionada->execute();
 $i = 0;
 $Atrasada_Do_OP = 0;
 $Total_Selecionada = 0;
 $Em_Nome_Op = 0;
 $Obs_Qtd = 0;
 $Percorrer_Selecionada = 0;
 $hoje_Selecionada_Base = date('Y-m-d');
 $hoje_Selecionada_Inicio = date('Y-m-d', strtotime('-' . 1 . 'day', strtotime($hoje_Selecionada_Base)));
 $hoje_Selecionada_Final = date('Y-m-d', strtotime('+' . 2 . 'day', strtotime($hoje_Selecionada_Base)));
 $Entregues_Em_Op = 0;
 $i = 0;
 $query_Sts = $conexao->prepare("SELECT * FROM sts_op WHERE CODIGO != '11' AND CODIGO != '12' AND CODIGO != '13'  ORDER BY CODIGO ASC ");
 $query_Sts->execute();
 $Sts = 0;
 while ($linha = $query_Sts->fetch(PDO::FETCH_ASSOC)) {
   $Nome_Sts = $linha['STS_DESCRICAO'];
   $codigo_Sts = $linha['CODIGO'];

   $Nome_Sts_P[$Sts] = $Nome_Sts;
   $Codigo_Sts_P[$Sts] = $codigo_Sts;
   $Sts++;
 }
 ;
 while ($linha = $query_ordens_Selecionada->fetch(PDO::FETCH_ASSOC)) {

   $Pesquisa_atendente = $linha['COD_ATENDENTE'];
   $Pesquisa_Produto = $linha['cod_produto'];
   $Pesquisa_orcamento = $linha['orcamento_base'];
   $Tipo_Produto = $linha['tipo_produto'];
   $Pesquisa_Cliente = $linha['cod_cliente'];
   $Tipo_Cliente = $linha['tipo_cliente'];
   $b = $linha['cod'];
   
    if($_POST['secao'] == 'ACABAMENTO'){
    $inicio[$Total_Selecionada] = $linha['data_ent_acabamento'];
    }
    if($_POST['secao'] == 'CPT'){
    $inicio[$Total_Selecionada] = $linha['DT_ENTRADA_CTP'];
    }
    if($_POST['secao'] == 'DIGITAL'){
    $inicio[$Total_Selecionada] = $linha['DT_ENT_DIGITAL'];
    }
    if($_POST['secao'] == 'OFFSET'){
    $inicio[$Total_Selecionada] = $linha['data_ent_offset'];
    }
    if($_POST['secao'] == 'PLOTTER'){
    $inicio[$Total_Selecionada] = $linha['DT_ENTRADA_PLOTTER'];
    }
    if($_POST['secao'] == 'PRE'){
    $inicio[$Total_Selecionada] = $linha['DT_ENTRADA_PRE_IMP'];
    }
    if($_POST['secao'] == 'TIPOGRAFIA'){
    $inicio[$Total_Selecionada] = $linha['data_ent_tipografia'];
    }
 
  
    if($_POST['secao'] == 'ACABAMENTO'){
    $fim[$Total_Selecionada] = $linha['SAIDA_ACABAMENTO'];
    }
    if($_POST['secao'] == 'CPT'){
    $fim[$Total_Selecionada] = $linha['SAIDA_CTP'];
    }
    if($_POST['secao'] == 'DIGITAL'){
    $fim[$Total_Selecionada] = $linha['SAIDA_DIGITAL'];
    }
    if($_POST['secao'] == 'OFFSET'){
    $fim[$Total_Selecionada] = $linha['SAIDA_OFFSET'];
    }
    if($_POST['secao'] == 'PLOTTER'){
    $fim[$Total_Selecionada] = $linha['SAIDA_PLOTTER'];
    }
    if($_POST['secao'] == 'PRE'){
    $fim[$Total_Selecionada] = $linha['SAIDA_PRE'];
    }
    if($_POST['secao'] == 'TIPOGRAFIA'){
    $fim[$Total_Selecionada] = $linha['SAIDA_TIPOGRAFIA'];
    }
 

   $Ordens_Selecionada[$Total_Selecionada] = [
     'cod' => $linha['cod'],
     'orcamento_base' => $linha['orcamento_base'],
     'tipo_produto' => $linha['tipo_produto'],
     'prioridade_op' => $linha['prioridade_op'],
     'cod_produto' => $linha['cod_produto'],
     'cod_cliente' => $linha['cod_cliente'],
     'tipo_cliente' => $linha['tipo_cliente'],
     'descricao' => $linha['descricao'],
     'status' => $linha['status'],
     'data_entrega_prova' => $linha['data_entrega_prova'],
     'tipo_trabalho' => $linha['tipo_trabalho'],
     'secao_op' => $linha['secao_op'],
     'op_secao' => $linha['op_secao'],
     'STS_DESCRICAO' => $linha['STS_DESCRICAO'],
     'data_entrega' => date($linha['data_entrega']),
     'data_emissao' => date($linha['data_emissao']),
     'data_apr_cliente' => date($linha['data_apr_cliente']),
     'data_ent_tipografia' => date($linha['data_ent_tipografia']),
     'data_ent_acabamento' => date($linha['data_ent_acabamento']),
     'DT_ENTRADA_PRE_IMP_PROVA' => date($linha['DT_ENTRADA_PRE_IMP_PROVA']),
     'DT_ENTRADA_PRE_IMP' => date($linha['DT_ENTRADA_PRE_IMP']),
     'DT_ENTRADA_CTP' => date($linha['DT_ENTRADA_CTP']),
     'data_1a_prova' => date($linha['data_1a_prova']),
     'data_2a_prova' => date($linha['data_2a_prova']),
     'data_3a_prova' => date($linha['data_3a_prova']),
     'data_4a_prova' => date($linha['data_4a_prova']),
     'data_5a_prova' => date($linha['data_5a_prova']),
     'data_ent_final' => date($linha['data_ent_final']),
     'data_ent_offset' => date($linha['data_ent_offset']),
     'data_envio_div_cmcl' => date($linha['data_envio_div_cmcl']),
     'DT_ENT_DIGITAL' => date($linha['DT_ENT_DIGITAL']),
     'DT_TIPOGRAFIA_PROVA' => date($linha['DT_TIPOGRAFIA_PROVA']),
     'DT_ACABAMENTO_PROVA' => date($linha['DT_ACABAMENTO_PROVA']),
     'DT_SAIDA_EXPEDICAO' => date($linha['DT_SAIDA_EXPEDICAO']),
     'data_imp_dir' => date($linha['data_imp_dir']),
     'DT_ENTRADA_PLOTTER' => date($linha['DT_ENTRADA_PLOTTER']),
     'DT_ENVIADO_EXPEDICAO' => date($linha['DT_ENVIADO_EXPEDICAO']),
     'SAIDA_PRE' => date($linha['SAIDA_PRE']),
     'SAIDA_DIGITAL' => date($linha['SAIDA_DIGITAL']),
     'SAIDA_OFFSET' => date($linha['SAIDA_OFFSET']),
     'SAIDA_CTP' => date($linha['SAIDA_CTP']),
     'SAIDA_TIPOGRAFIA' => date($linha['SAIDA_TIPOGRAFIA']),
     'SAIDA_ACABAMENTO' => date($linha['SAIDA_ACABAMENTO']),
     'SAIDA_PLOTTER' => date($linha['SAIDA_PLOTTER']),
   ];

   if($Ordens_Selecionada[$Total_Selecionada]['op_secao'] == ''){
    $Ordens_Selecionada[$Total_Selecionada]['op_secao'] = 'OPERADOR NÃO SELECIONADO';
   }
   if ($Tipo_Produto == '2') {
     $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos_pr_ent  WHERE CODIGO = '$Pesquisa_Produto'");
     $query_PRODUTOS->execute();

     while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
       $Tabela_Produtos_Selecionada[$Total_Selecionada] = [
         'descricao' => $linha2['DESCRICAO']
       ];
     }
   }

   $Obss = $conexao->prepare("SELECT * FROM obs_ordem_producao  WHERE CODIGO_OP = '$b'");
   $Obss->execute();

   while ($linhaObs = $Obss->fetch(PDO::FETCH_ASSOC)) {
     $Tabela_Observacoes[$Obs_Qtd] = [
       'data' => $linhaObs['DATA'],
       'obs' => $linhaObs['OBSERVACAO']
     ];
     $Obs_Qtd++;
   }

   $query_aTENDENTE = $conexao->prepare("SELECT * FROM tabela_atendentes  WHERE codigo_atendente = '$Pesquisa_atendente'");
   $query_aTENDENTE->execute();

   while ($linha2 = $query_aTENDENTE->fetch(PDO::FETCH_ASSOC)) {
     $Tabela_aTENDENTE_Selecionada[$Total_Selecionada] = [
       'nome_atendente' => $linha2['nome_atendente'],
       'secao_atendente' => $linha2['secao_atendente']
     ];
   }
   if (!isset($Tabela_aTENDENTE_Selecionada)) {
     $Tabela_aTENDENTE_Selecionada[$Total_Selecionada] = [
       'nome_atendente' => 'NÃO ENCONTRADO',
       'secao_atendente' => 'NÃO ENCONTRADO'
     ];
   }
   if ($Tipo_Produto == '1') {
     $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_Produto'");
     $query_PRODUTOS->execute();

     while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
       $Tabela_Produtos_Selecionada[$Total_Selecionada] = [
         'descricao' => $linha2['DESCRICAO']
       ];
     }
   }
   if ($Tipo_Cliente == '2') {
     $query_PRODUTOS = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos  WHERE cod = '$Pesquisa_Cliente'");
     $query_PRODUTOS->execute();

     while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
       $Tabela_Clientes_Selecionada = [
         'nome' => $linha2['nome']
       ];
     }
   }
   if ($Tipo_Cliente == '1') {
     $query_PRODUTOS = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos  WHERE cod = '$Pesquisa_Cliente'");
     $query_PRODUTOS->execute();

     while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
       $Tabela_Clientes_Selecionada[$Total_Selecionada] = [
         'nome' => $linha2['nome']
       ];
     }
   }
   $quantiadade = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento  WHERE cod_produto = '$Pesquisa_Produto' AND cod_orcamento = '$Pesquisa_orcamento'");
   $quantiadade->execute();

   if ($linha2 = $quantiadade->fetch(PDO::FETCH_ASSOC)) {
     $Tabela_Quantidade[$Total_Selecionada] = [
       'quantidade' => $linha2['quantidade']
     ];
   }
   if (!isset($Tabela_Quantidade[$Total_Selecionada])) {
     $Tabela_Quantidade[$Total_Selecionada] = [
       'quantidade' => 'Não Encontrada'
     ];
   }
   $data_entregar = $Ordens_Selecionada[$Total_Selecionada]['data_entrega'];
   $dataprevista = date('Y-m-d'); // DATA PREVISTA
   $data_inicio = new DateTime($data_entregar);
   $data_fim = new DateTime($dataprevista);
   $dateInterval = $data_inicio->diff($data_fim); //PEGA A DIFERENÇA
   $dias_falta = $dateInterval->d + ($dateInterval->m * 30);
   $Total_Selecionada++;
 }
}

 ?>

<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="accordion mt-3" id="accordionExample">
      <div class="card accordion-item active">
        <h2 class="accordion-header" id="headingOne">
          <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne"
            aria-expanded="true" aria-controls="accordionOne">
            Filtrar O.P's DIARIAS 
          </button>
        </h2>
        <form method="POST" action="tl-relatorio-diario.php">

          <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <?php if(isset($_POST['Filtrar'])){ ?>
              <div class="mb-3">
                <label for="nome" class="form-label">FILTROS</label>
                <div class="row">
                  <div class="col-3">
                    <label for="defaultSelect" class="form-label">Periodo por Inicio ou Termino?</label>
                    <select id="iniofim" name="iniofim" class="form-select">
                    <option value="<?= $_POST['iniofim'] ?>"><?= $_POST['iniofim'] ?></option>
                      <option value="Termino">Termino</option>
                      <option value="Inicio">Inicio</option>
                    </select>
                  </div>
                  <div class="col-3">
                    <label for="defaultSelect" class="form-label">De qual seção?</label>
                    <select id="secao" name="secao" class="form-select">
                    <option value="<?= $_POST['secao'] ?>"><?= $_POST['secao'] ?></option>
                      <option value="ACABAMENTO">ACABAMENTO</option>
                      <!-- <option value="2">BANNER</option> -->
                      <option value="CPT">GRAVAÇÃO DE CHAPAS</option>
                      <option value="DIGITAL">IMPRESSAO DIGITAL</option>
                      <option value="OFFSET">OFFSET</option>
                      <option value="PLOTTER">PLOTTER</option>
                      <option value="PRE">PRÉ-IMPRESSAO</option>
                      <option value="TIPOGRAFIA">TIPOGRAFIA</option>
                    </select>
                  </div>
                  <div class="col-3">
                    <label for="defaultSelect" class="form-label">Data de Filtragem</label>
                    <input type="date" class="form-control" name="data" value="<?= $_POST['data'] ?>" id="data" />
                  </div>
                  <div class="col-3">
                    <label for="defaultSelect" class="form-label">Aplicar Filtragem</label> <br>
                    <input class="btn btn-primary" type="submit" name="Filtrar" value="Filtrar">
                  </div>
                </div>
              </div>
              <?php }else{ ?>
                <div class="mb-3">
                <label for="nome" class="form-label">FILTROS</label>
                <div class="row">
                  <div class="col-3">
                    <label for="defaultSelect" class="form-label">Periodo por Inicio ou Termino?</label>
                    <select id="iniofim" name="iniofim" class="form-select">
                      <option value="Termino">Termino</option>
                      <option value="Inicio">Inicio</option>
                    </select>
                  </div>
                  <div class="col-3">
                    <label for="defaultSelect" class="form-label">De qual seção?</label>
                    <select id="secao" name="secao" class="form-select">
                      <option value="ACABAMENTO">ACABAMENTO</option>
                      <!-- <option value="2">BANNER</option> -->
                      <option value="CPT">GRAVAÇÃO DE CHAPAS</option>
                      <option value="DIGITAL">IMPRESSAO DIGITAL</option>
                      <option value="OFFSET">OFFSET</option>
                      <option value="PLOTTER">PLOTTER</option>
                      <option value="PRE">PRÉ-IMPRESSAO</option>
                      <option value="TIPOGRAFIA">TIPOGRAFIA</option>
                    </select>
                  </div>
                  <div class="col-3">
                    <label for="defaultSelect" class="form-label">Data de Filtragem</label>
                    <input type="date" class="form-control" name="data" value="<?= $hoje ?>" id="data" />
                  </div>
                  <div class="col-3">
                    <label for="defaultSelect" class="form-label">Aplicar Filtragem</label> <br>
                    <input class="btn btn-primary" type="submit" name="Filtrar" value="Filtrar">
                  </div>
                </div>
              </div>
           <?php   } ?>
              </form>
              <form method="POST" action="b-diario.php">
              <div class="mb-3">
                <label for="relatorio" class="form-label">Relatório das diárias</label>
                <?php if(isset($_POST['Filtrar'])){ ?>
                <table class="table table-bordered table-hover">
                  <tr>
                    <th style="text-align: center;" align="center" colspan="6"><b>DATA <?= $datar ?> SEÇÃO <?= $secaoo ?> </b></th>
                  </tr>
                  <tr>
                    <th>OP</th>
                    <th>DESCRIÇÃO</th>
                    <th>QUANTIDAE</th>
                    <th>OPERADOR</th>
                    <th>DATA INICIO</th>
                    <th>DATA TERMINO</th>
                    <th>ABRIR NO PAINEL</th>
                    <?php if ($PROD_ADM_I == '1') { ?>
                    <th>SELECIONAR</th>
                    <?php  }  ?>
                  </tr>
                  <?php for($per = 0; $per < $Total_Selecionada; $per++){ ?>
                  <tr>
                    <td><?= $Ordens_Selecionada[$per]['cod'] ?></td>
                    <td><?= $Tabela_Produtos_Selecionada[$per]['descricao']?></td>
                    <td><?= $Tabela_Quantidade[$per]['quantidade'] ?></td>
                    <td><?= $Ordens_Selecionada[$per]['op_secao'] ?></td>
                    <td><input class="form-control" disabled value="<?= $inicio[$per] ?>" name="inic" type="date"></td>
                    <td><input class="form-control" disabled value="<?= $fim[$per] ?>" name="fim" type="date"></td>
                    <td>
                        <div class="">
                        <a class="btn rounded-pill btn-info" href="tl-controle-op.php?cod=<?= $Ordens_Selecionada[$per]['cod'] ?>"><i class="bx bx-edit-alt me-1"></i> Selecionar</a>
                    </div>
                        </td>
                    <?php if ($PROD_ADM_I == '1') { ?>
                    <td><input class="form-check-input" type="checkbox" value="<?= $Ordens_Selecionada[$per]['cod'] ?>" name="Selecionado<?= $per?>"  /></td>
                    <?php  }  ?>
                  </tr>
                  <?php } ?>
                </table>
              </div>
              <?php if ($PROD_ADM_I == '1') { ?>
              <div class="mb-3">
                <div class="card-body">
                <div class="row">
                <input type="hidden" class="form-control" name="campo" value="<?= $campo ?>"  />
                  <input type="hidden" class="form-control" name="numeros" value="<?= $per ?>"  />
                <?php if($_POST['iniofim'] == 'Inicio' ){?>
                  <div class="col-3">
                  <label for="defaultSelect" class="form-label">MUDAR DATA DE INICIO PARA</label>
                    <input type="date" class="form-control" name="datain" value="<?= $AMANHA ?>" id="datai" />
                  </div>
                  <?php } ?>
                  <?php if($_POST['iniofim'] == 'Termino' ){?>
                  <div class="col-3">
                  <label for="defaultSelect" class="form-label">MUDAR DATA DE TERMINO PARA</label>
                    <input type="date" class="form-control" name="datatn" value="<?= $AMANHA ?>" id="dataf" />
                  </div>
                  <?php } ?>
                  <div class="col-3">
                    <label for="defaultSelect" class="form-label">APLICAR MUDANÇAS</label> <br>
                    <input class="btn btn-primary" type="submit" value="ALTERAR DATA">
                  </div>
                </div>
                </div>
              </div>
              <?php  }  ?>
            </div>
          </div>
          </form>
          <?php }else{ ?>
            <table class="table table-bordered table-hover">
                  <tr>
                    <th style="text-align: center;" align="center" colspan="6"><b>NENHUM FILTRO SELECIONADO </b></th>
                  </tr>
            </table>
            <?php } ?>

      </div><br>
      <div class=" diario-- "></div>
     



    <?php include_once("../html/navbar-dow.php"); ?>