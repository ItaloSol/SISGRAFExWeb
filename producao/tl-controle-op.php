<link rel="icon" type="image/x-icon" href="../img/logo40px.ico" />
<?php
session_start();

  require("../conexoes/conexao.php");
$refresh = 0;
// if(isset($_SESSION['pag'])){ 
//   echo 'Potencial';
//      while($refresh < 1){
//        echo  '<meta http-equiv="refresh" content="0">'; break;         
//        $refresh++;
//      }
//      echo  '<meta  http-equiv="refresh" content="" />';    
//   } 
if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
}
?>

<style>
  .tira{
    display: none;
  }
</style>
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>SISGRAFEx</title>



  <!-- Favicon -->


  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />
  <link rel="stylesheet" href="../assets/css/principal.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="../assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="../assets/js/config.js"></script>

  <!--Import para descer barra de rolagem-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="../assets/js/vue.js"></script>
</head>
<?php /* |--  --| */// include_once("../html/navbar.php");.

$a = 0;
$hoje = date('Y-m-d');
$mes = date('Y-m');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
$CODIGO_OP = $_GET['cod'];
if (isset($_GET['obs'])) {
  if ($_GET['obs'] == '1') {
    $cod = $_GET['cod'];

    $obs = $_POST['Observacao_nova'];
    $query_sd_posto = $conexao->prepare("INSERT INTO obs_ordem_producao (CODIGO_OP , DATA, OBSERVACAO) VALUES ('$cod','$hoje','$obs')");
    $query_sd_posto->execute();
    $_SESSION['msg'] = ' <div style=";" id="alerta<?=$a?>"
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
         Observação Adicionada com suscesso!     
    </div>
    </div>';
    $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Adicionou uma Observação a OP: $cod' , '$cod_user' , '$dataHora')");
    $Atividade_Supervisao->execute();
    echo "<script>window.location = 'tl-controle-op.php?cod=" . $cod . "&Ob=S'</script>";
  }
}
if (isset($_GET['Ob'])) {
  if ($_GET['Ob'] == 'S') {
    $_SESSION['msg'] = ' <div style=";" id="alerta<?=$a?>"
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
         Observação Adicionada com suscesso!     
    </div>
    </div>';
  }
}
$query_sd_posto = $conexao->prepare("SELECT * FROM tabela_atendentes a INNER JOIN usuario_acessos u ON a.codigo_atendente = u.CODIGO_USR WHERE u.PROD = '1' ORDER BY a.nome_atendente ASC ");
$query_sd_posto->execute();
$Operadores = 0;
while ($linha = $query_sd_posto->fetch(PDO::FETCH_ASSOC)) {
  $Nome_Atendente = $linha['nome_atendente'];
  $codigo_aten = $linha['codigo_atendente'];

  $Nome_Atem[$Operadores] = $Nome_Atendente;
  $Codigo[$Operadores] = $codigo_aten;
  $Operadores++;
};

$i = 0;
$query_Sts_Pord = $conexao->prepare("SELECT * FROM sts_op WHERE CODIGO != '11' AND CODIGO != '12' AND CODIGO != '13'  ORDER BY CODIGO ASC ");
$query_Sts_Pord->execute();
$Sts = 0;
while ($STS = $query_Sts_Pord->fetch(PDO::FETCH_ASSOC)) {
  $Nome_Sts_ = $STS['STS_DESCRICAO'];
  $codigo_Sts_ = $STS['CODIGO'];

  $Nome_Sts_P[$Sts] = $Nome_Sts_;
  $Codigo_Sts_P[$Sts] = $codigo_Sts_;
  $Sts++;
};

?>
<?php /* |--  --| */ if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
}  ?>
<!-- Accordion -->
<div class=" ordemproducao-- "></div>
<div class="row">
  <div class="col-md mb-4 mb-md-0">
    <div class="accordion mt-3" id="accordionExample">
      <div class="card accordion-item active">
     
        <?php
        if (isset($_GET['cod'])) {
          echo '<div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">';
        } else {
          echo '<div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">';
        } ?>

       
  </div>
</div>
<?php
if (isset($_GET['cod'])) {
  $a = 0;
  $b = $_GET['cod'];
  $query_ordens_Selecionada = $conexao->prepare("SELECT  `cod`, prioridade_op ,`DT_ENTRADA_PLOTTER`, `orcamento_base`, `DT_ENVIADO_EXPEDICAO`, `tipo_produto`,  `cod_produto`,  `cod_cliente`,  `cod_contato`,  `cod_endereco`,  `cod_emissor`,  `tipo_cliente`,  `status`, descricao,  `data_emissao`, 
 `data_entrega`,  `data_1a_prova`,  `data_2a_prova`,  `data_3a_prova`,  `data_4a_prova`,  `data_5a_prova`,  `data_apr_cliente`,  `data_ent_final`,  `data_imp_dir`,  `data_ent_offset`,  `DT_ENT_DIGITAL`,  `data_ent_tipografia`,  `data_ent_acabamento`,  
 `data_envio_div_cmcl`,  `DT_CANCELAMENTO`,  `DT_ENTG_PROVA`,  `ind_ent_prazo`,  `ind_ent_erro`,`secao_op` , `tipo_trabalho`,  `COD_ATENDENTE`,  `op_secao`, LEFT(`OBS_FRETE`, 256),  `DT_SAIDA_EXPEDICAO`,  `DT_ENTRADA_PRE_IMP_PROVA`, STS_DESCRICAO, `DT_TIPOGRAFIA_PROVA`,  
 `DT_ACABAMENTO_PROVA`,  `DT_ENTRADA_PRE_IMP`,  `DT_ENTRADA_CTP`, `SAIDA_PRE`, `SAIDA_DIGITAL`, `SAIDA_OFFSET`, `SAIDA_CTP`, `SAIDA_TIPOGRAFIA`, `SAIDA_ACABAMENTO`, `SAIDA_PLOTTER` FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO 
 WHERE o.cod = '$b' ORDER BY o.data_entrega DESC ");
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
  };
  while ($linha = $query_ordens_Selecionada->fetch(PDO::FETCH_ASSOC)) {

    $Pesquisa_atendente = $linha['COD_ATENDENTE'];
    $Pesquisa_Produto = $linha['cod_produto'];
    $Tipo_Produto =  $linha['tipo_produto'];
    $Pesquisa_Cliente = $linha['cod_cliente'];
    $Tipo_Cliente =  $linha['tipo_cliente'];
    $Ordens_Selecionada = [
      'cod' => $linha['cod'],
      'orcamento_base' => $linha['orcamento_base'],
      'tipo_produto' => $linha['tipo_produto'],
      'prioridade_op' => $linha['prioridade_op'],
      'cod_produto' => $linha['cod_produto'],
      'cod_cliente' => $linha['cod_cliente'],
      'tipo_cliente' => $linha['tipo_cliente'],
      'descricao' => $linha['descricao'],
      'status' => $linha['status'],
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
      'data_ent_offset' => date($linha['data_ent_offset']),
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
    if ($Tipo_Produto == '2') {
      $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos_pr_ent  WHERE CODIGO = '$Pesquisa_Produto'");
      $query_PRODUTOS->execute();

      while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
        $Tabela_Produtos_Selecionada = [
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
      $Tabela_aTENDENTE_Selecionada = [
        'nome_atendente' => $linha2['nome_atendente'],
        'secao_atendente' => $linha2['secao_atendente']
      ];
    }
    if (!isset($Tabela_aTENDENTE_Selecionada)) {
      $Tabela_aTENDENTE_Selecionada = [
        'nome_atendente' => 'NÃO ENCONTRADO',
        'secao_atendente' => 'NÃO ENCONTRADO'
      ];
    }
    if ($Tipo_Produto == '1') {
      $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_Produto'");
      $query_PRODUTOS->execute();

      while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
        $Tabela_Produtos_Selecionada = [
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
        $Tabela_Clientes_Selecionada = [
          'nome' => $linha2['nome']
        ];
      }
    }
    $data_entregar = $Ordens_Selecionada['data_entrega'];
    $dataprevista = date('Y-m-d'); // DATA PREVISTA
    $data_inicio = new DateTime($data_entregar);
    $data_fim = new DateTime($dataprevista);
    $dateInterval = $data_inicio->diff($data_fim); //PEGA A DIFERENÇA
    $dias_falta = $dateInterval->d + ($dateInterval->m * 30);
    $Total_Selecionada++;
  }


?>

  <?php
  $a = 0;
  $query_sd_posto = $conexao->prepare("SELECT * FROM tabela_atendentes a INNER JOIN usuario_acessos u ON a.codigo_atendente = u.CODIGO_USR WHERE u.PROD = '1' ORDER BY a.nome_atendente ASC ");
  $query_sd_posto->execute();
  $Operadores = 0;
  while ($linha = $query_sd_posto->fetch(PDO::FETCH_ASSOC)) {
    $Nome_Atendente = $linha['nome_atendente'];
    $codigo_aten = $linha['codigo_atendente'];

    $Nome_Atem[$Operadores] = $Nome_Atendente;
    $Codigo[$Operadores] = $codigo_aten;
    $Operadores++;
  };



  ?>
  <!-- Accordion -->
  <div class="row">
    <div class="col-md mb-4 mb-md-0">
      <div class="accordion mt-3" id="accordionExample">


        <div class="col-md">
          <div id="accordionIcon" class="accordion mt-3 accordion-without-arrow">
            <div class="accordion-item card ">
              <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconOne">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionIcon-1" aria-controls="accordionIcon-1">
                  Revisão Geral da Op
                </button>
              </h2>

              <div id="accordionIcon-1" class="accordion-collapse collapse show" data-bs-parent="#accordionIcon">
                <div class="accordion-body">
                  <form method="POST" action="b-controle-save.php">
                    <button type="button" class="btn btn-primary botao" data-bs-toggle="modal" data-bs-target="#modalCenter">
                      OBSERVAÇÕES
                    </button>
                    
                 
                    <a href="../relatorios/relatorio-op-prod.php?cod=<?= $CODIGO_OP ?>" style="max-height: 38px; font-size: 15px" target="_blank" class=" text-align-center btn rounded-pill btn-danger">
                      <!-- <iconify-icon icon="mdi:form-outline" width="20" height="20"> </iconify-icon> -->RELATÓRIO
                    </a>
                    <div class="mb-3">
                      <label for="cod" class="form-label">Nº da OP</label>
                      <input id="cod" value="<?= $Ordens_Selecionada['cod'] ?>" class="form-control" type="text" placeholder="Código da OP" disabled />
                    </div>
                    <div class="mb-3">
                      <label for="orc" class="form-label">Nº do Orçamento</label>
                      <input id="orc" name="orc" value="<?= $Ordens_Selecionada['orcamento_base'] ?>" class="form-control" type="text" placeholder="Código do orçamento" disabled />
                    </div>
                    <div class="mb-3">
                      <label for="orc" class="form-label">Prioridade da Op</label>
                      <select class="form-select" id="prioridade" name="prioridade" aria-label="Default select example">
                        <option value="<?= $Ordens_Selecionada['prioridade_op'] ?>" selected><?= $Ordens_Selecionada['prioridade_op'] ?></option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="cliente" class="form-label">Nome do Cliente</label>
                      <input id="cliente" name="cliente" class="form-control" value="<?= $Tabela_Clientes_Selecionada['nome'] ?>" type="text" placeholder="Nome do cliente" disabled />
                    </div>
                    <div>
                      <label for="exampleFormControlTextarea1" class="form-label">Observações do Orçamento</label>
                      <textarea type="text" name="descricao" class="form-control" id="exampleFormControlTextarea1" rows="3"><?= $Ordens_Selecionada['descricao'] ?></textarea>
                    </div>
                    <div class="mb-3">
                      <label for="codprod" class="form-label">Cód Produto</label>
                      <input id="codprod" name="codprod" class="form-control" value="<?= $Ordens_Selecionada['cod_produto'] ?>" type="text" placeholder="Código do produto" disabled />
                    </div>
                    <div class="mb-3">
                      <label for="descprod" class="form-label">Descrição do Produto</label>
                      <input id="descprod" name="descprod" class="form-control" value="<?= $Tabela_Produtos_Selecionada['descricao'] ?>" type="text" placeholder="Descrição do produto" disabled />
                      <input type="hidden" name="cod" value="<?= $Ordens_Selecionada['cod'] ?>" />
                    </div>
                    <div class="mb-3">
                      <label for="operador" class="form-label">Seção da Op</label>
                      <select class="form-select" id="secao" name="secao" aria-label="Default select example" required>
                        <?php
                        if ($Ordens_Selecionada['secao_op'] != '') {
                          echo '<option value="' . $Ordens_Selecionada['secao_op'] . '" selected>' . $Ordens_Selecionada['secao_op'] . '</option>';
                        } else {
                          echo '<option value="' . $Tabela_aTENDENTE_Selecionada['secao_atendente'] . '" selected>' . $Tabela_aTENDENTE_Selecionada['secao_atendente'] . '</option>';
                        }

                        ?>
                       
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="operador" class="form-label">Operador</label>
                      <select class="form-select" id="operador" name="operador" aria-label="Default select example">
                        <option value="<?= $Pesquisa_atendente ?>" selected><?= $Tabela_aTENDENTE_Selecionada['nome_atendente'] ?></option>
                        
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="tipotrabalho" class="form-label">Tipo de Trabalho</label>
                      <select class="form-select" id="tipotrabalho" name="tipotrabalho" aria-label="Default select example">
                        <option value="<?= $Ordens_Selecionada['tipo_trabalho'] ?>" selected><?= $Ordens_Selecionada['tipo_trabalho'] ?></option>
                      
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="codSts" class="form-label">Status</label>
                      <select class="form-select" id="codSts" name="codSts" aria-label="Default select example">
                        <option value="<?= $Ordens_Selecionada['status'] ?>" selected><?= $Ordens_Selecionada['status'] ?> - <?= $Ordens_Selecionada['STS_DESCRICAO'] ?></option>
                       

                      </select>
                    </div>
                    <div>
                      <!-- <button type="submit" class="btn btn-primary">Observações</button>
                        <button type="submit" class="btn btn-dark">Imprimir</button> -->
                      <!-- Toggle Between Modals -->
                     
                     Você não tem permissão para alterar essa OP
                    
                      <br></br>
                    </div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
      <!-- Modal 1-->
     
      <!-- Datas -->
      <br>
      <div class="card accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="true" aria-controls="accordionTwo">
            Administração de Datas
          </button>
        </h2>
        <div id="accordionTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="row">
              <div class="col-md-6">
                <div class="card mb-4">
                  <h5 class="card-header">Seção Técnica</h5>
                  <div class="card-body">
                    <div>
                      <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Data de Entrada</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_emiss" type="date" value="<?= $Ordens_Selecionada['data_emissao'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Aprovação do Cliente</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_apr_cliente" type="date" value="<?= $Ordens_Selecionada['data_apr_cliente'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Imposta (Direção)</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_imposta_dir" type="date" value="<?= $Ordens_Selecionada['data_imp_dir'] ?>" id="html5-date-input" />
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card mb-6">
                    <h5 class="card-header">Seção de Expedição</h5>
                    <div class="card-body">
                      <div class="form-floating">
                        <div class="mb-6 row">
                          <label for="html5-date-input" class="col-md-6 col-form-label">Entrada Na Expedição</label>
                          <div class="col-md-10">
                            <input class="form-control" name="D_expedicao" type="date" value="<?= $Ordens_Selecionada['DT_ENVIADO_EXPEDICAO'] ?>" id="html5-date-input" />
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="html5-date-input" class="col-md-6 col-form-label">Saída da Expedição</label>
                          <div class="col-md-10">
                            <input class="form-control" name="D_saida_expedicao" type="date" value="<?= $Ordens_Selecionada['DT_SAIDA_EXPEDICAO'] ?>" id="html5-date-input" />
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="html5-date-input" class="col-md-6 col-form-label">Data Prevista para Entrega</label>
                          <div class="col-md-10">
                            <input class="form-control" name="D_data_entrega" type="date" value="<?= $Ordens_Selecionada['data_entrega'] ?>" id="html5-date-input" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card mb-4">
                  <h5 class="card-header">Geração de Provas</h5>
                  <div class="card-body">
                    <div class="form-floating">
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Prova Entrada Pré-Impressão</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_prova_pre" type="date" value="<?= $Ordens_Selecionada['DT_ENTRADA_PRE_IMP_PROVA'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Prova Entrada Tipografia</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_prova_tipo" type="date" value="<?= $Ordens_Selecionada['DT_TIPOGRAFIA_PROVA'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Prova Entrada Acabamento</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_prova_acabame" type="date" value="<?= $Ordens_Selecionada['DT_ACABAMENTO_PROVA'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">1º Prova</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_prova_1" type="date" value="<?= $Ordens_Selecionada['data_1a_prova'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">2º Prova</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_prova_2" type="date" value="<?= $Ordens_Selecionada['data_2a_prova'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">3º Prova</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_prova_3" type="date" value="<?= $Ordens_Selecionada['data_3a_prova'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">4º Prova</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_prova_4" type="date" value="<?= $Ordens_Selecionada['data_4a_prova'] ?>" id="html5-date-input" />
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="card mb-4">
                  <h5 class="card-header">Seção de Produção <br> Data de Entrada</h5>
                  <div class="card-body">
                    <div class="row">
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Entrada Pré-Imp</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_entrada_pre" type="date" value="<?= $Ordens_Selecionada['DT_ENTRADA_PRE_IMP'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Entrada na Digital</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_entrada_digital" type="date" value="<?= $Ordens_Selecionada['DT_ENT_DIGITAL'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Entrada na OffSet</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_entrada_off" type="date" value="<?= $Ordens_Selecionada['data_ent_offset'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Entrada na CTP</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_entradactp" type="date" value="<?= $Ordens_Selecionada['DT_ENTRADA_CTP'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Entrada na Tipografia</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_entrada_tipo" type="date" value="<?= $Ordens_Selecionada['data_ent_tipografia'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Entrada no Acabamento</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_entrada_acabamento" type="date" value="<?= $Ordens_Selecionada['data_ent_acabamento'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Entrada na Plotter</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_entrada_PLOTTER" type="date" value="<?= $Ordens_Selecionada['DT_ENTRADA_PLOTTER'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card mb-4">
                  <h5 class="card-header">Seção de Produção <br> Previsão de Saída</h5>
                  <div class="card-body">
                    <div class="row">
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na Pré-Imp</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_SAIDA_pre" type="date" value="<?= $Ordens_Selecionada['SAIDA_PRE'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na Digital</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_SAIDA_digital" type="date" value="<?= $Ordens_Selecionada['SAIDA_DIGITAL'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na OffSet</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_SAIDA_off" type="date" value="<?= $Ordens_Selecionada['SAIDA_OFFSET'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na CTP</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_SAIDActp" type="date" value="<?= $Ordens_Selecionada['SAIDA_CTP'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na Tipografia</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_SAIDA_tipo" type="date" value="<?= $Ordens_Selecionada['SAIDA_TIPOGRAFIA'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA no Acabamento</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_SAIDA_acabamento" type="date" value="<?= $Ordens_Selecionada['SAIDA_ACABAMENTO'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                      <div class="mb-3 ">
                        <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na Plotter</label>
                        <div class="col-md-10">
                          <input class="form-control" name="D_SAIDA_PLOTTER" type="date" value="<?= $Ordens_Selecionada['SAIDA_PLOTTER'] ?>" id="html5-date-input" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </form>
              <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalCenterTitle">Observações</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="container">
                      <div class="card col-12">
                        <div class="">
                          <table class="card-body table table-bordered">
                            <tr>
                              <th>Data</th>
                              <th>Observação</th>
                            </tr>
                            <?php
                            $percorrer = 0;
                            if($Obs_Qtd == 0){
                              echo '<tr><td>NÃO TEM OBSERVAÇÕES</td></tr>';
                            }else{
                            while ($Obs_Qtd > $percorrer) {
                              echo '<tr><td>' . date('d/m/y', strtotime($Tabela_Observacoes[$percorrer]['data'])) . '</td><td>' . $Tabela_Observacoes[$percorrer]['obs'] . '</td></tr>';
                              $percorrer++;
                            }
                          }
                            ?>
                          </table>
                        </div>
                      </div><br>
                      <div class="col-12">
                        <div class="col-xl">
                          <div class="card mb-4">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
    <?php
  } else {
    echo "</div>
            <br>";
  } ?>

   







    <?php /* |--  --| */ include_once("../html/navbar-dow.php"); ?>