<?php include_once("../html/navbar.php");
$a = 0;
$hoje = date('Y-m-d');
$cod_user = $_SESSION["usuario"][2];
$mes = date('Y-m');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
if (isset($_GET['cod'])) {
  $CODIGO_OP = $_GET['cod'];
}
if (isset($_GET['obs'])) {
  if ($_GET['obs'] == '1') {
    $cod = $_GET['cod'];

    $obs = $_POST['Observacao_nova'];
    $query_sd_posto = $conexao->prepare("INSERT INTO obs_ordem_producao (CODIGO_OP , DATA, OBSERVACAO) VALUES ('$cod','$hoje','$obs')");
    $query_sd_posto->execute();
    $_SESSION['msg'] = ' <div id="alerta<?=$a?>"
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
    echo "<script>
window.location = 'tl-controle-op.php?cod=" . $cod . "&Ob=S'
</script>";
  }
}
if (isset($_GET['Ob'])) {
  if ($_GET['Ob'] == 'S') {
    $_SESSION['msg'] = ' <div id="alerta<?=$a?>" role="bs-toast" class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show " role="alert" aria-live="assertive" aria-atomic="true">
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
$query_sd_posto = $conexao->prepare("SELECT * FROM tabela_atendentes a INNER JOIN usuario_acesso u ON a.codigo_atendente = u.CODIGO_USR WHERE u.PROD = '1' AND ativo = 1 ORDER BY a.nome_atendente ASC ");
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
$query_Sts_Pord = $conexao->prepare("SELECT * FROM sts_op WHERE CODIGO != '11' AND CODIGO != '12'  ORDER BY CODIGO ASC ");
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
<?php if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
} ?>
<!-- Accordion -->
<div class=" ordemproducao-- "></div>
<div class="row">
  <div class="col-md mb-4 mb-md-0">
    <div class="accordion mt-3" id="accordionExample">
      <div class="card accordion-item active">
        <h2 class="accordion-header" id="headingOne">
          <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
            Filtros
          </button>
        </h2>
        <?php
        if (isset($_GET['cod'])) {
          echo '<div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">';
        } else {
          echo '<div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">';
        } ?>

        <div class="accordion-body">
          <form action="tl-controle-op.php" method="POST">
            <div class="form-check form-switch mb-2">
              <input class="form-check-input" name="codOpS" type="checkbox" id="flexSwitchCheckDefault" />
              <label class="form-check-label" for="flexSwitchCheckDefault">Código da OP</label>
            </div>
            <div class="mb-3">
              <label class="form-label" for="basic-default-fullname"></label>
              <input type="text" class="form-control" name="codOp" id="basic-default-fullname" placeholder="Insira o código da ordem de produção" />
            </div>
            <div class="form-check form-switch mb-2">
              <input class="form-check-input" name="codOrcS" type="checkbox" id="flexSwitchCheckDefault" />
              <label class="form-check-label" for="flexSwitchCheckDefault">Código do Orçamento</label>
            </div>
            <div class="mb-3">
              <label class="form-label" for="basic-default-fullname"></label>
              <input type="text" class="form-control" name="codOrc" id="basic-default-fullname" placeholder="Insira o código dor orçamento" />
            </div><br></br>
            <div class="form-check form-switch mb-2">
              <input class="form-check-input" name="entregaS" type="checkbox" id="flexSwitchCheckDefault" />
              <label class="form-check-label" for="flexSwitchCheckDefault">Data de Entrega</label>
            </div>
            <div class="mb-3 row">
              <label for="html5-date-input" class="col-md-2 col-form-label"></label>
              <div class="col-md-10">
                <input class="form-control" type="date" name="entrega" value="<?= $hoje ?>"  />
              </div>
            </div>
            <div class="form-check form-switch mb-2">
              <input class="form-check-input" name="mesES" type="checkbox" id="flexSwitchCheckDefault" />
              <label class="form-check-label" for="flexSwitchCheckDefault">Mês de Emissão</label>
            </div>
            <div class="mb-3 row">
              <label for="html5-month-input" class="col-md-2 col-form-label"></label>
              <div class="col-md-10">
                <input class="form-control" type="month" name="mesE" value="<?= $mes ?>" id="html5-month-input" />
              </div>
            </div>
            <div class="form-check form-switch mb-2">
              <input class="form-check-input" name="mesEnS" type="checkbox" id="flexSwitchCheckDefault" />
              <label class="form-check-label" for="flexSwitchCheckDefault">Mês de Entrega</label>
            </div>
            <div class="mb-3 row">
              <label for="html5-month-input" class="col-md-2 col-form-label"></label>
              <div class="col-md-10">
                <input class="form-control" type="month" name="mesEn" value="<?= $mes ?>" id="html5-month-input" />
              </div>
            </div>
            <div class="form-check form-switch mb-2">
              <input class="form-check-input" name="statusS" type="checkbox" id="flexSwitchCheckDefault" />
              <label class="form-check-label" for="flexSwitchCheckDefault">Status</label>
            </div>
            <div class="mb-3">
              <label for="defaultSelect" class="form-label"></label>
              <select id="defaultSelect" name="status" class="form-select">
                <option>Selecione...</option>
                <?php
                $i = 0;
                while ($i < $Sts) {
                  echo '<option value="' . $Codigo_Sts_P[$i] . '">' . $Codigo_Sts_P[$i] . ' - ' . $Nome_Sts_P[$i] . '</option>';
                  $i++;
                }
                ?>
              </select>
            </div>
            <button type="submit" name="pesquisar" class="btn btn-primary">Aplicar</button>
          </form>
        </div>
      </div>
    </div>


  </div>
</div>
<?php
if (isset($_GET['cod'])) {
  $a = 0;
  $b = $_GET['cod'];
  $query_ordens_Selecionada = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO 
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
  $query_Sts = $conexao->prepare("SELECT * FROM sts_op WHERE CODIGO != '11' AND CODIGO != '12'   ORDER BY CODIGO ASC ");
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
    $Tipo_Produto = $linha['tipo_produto'];
    $Pesquisa_Cliente = $linha['cod_cliente'];
    $Tipo_Cliente = $linha['tipo_cliente'];
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
      'data_previa_prova' => date($linha['data_previa_prova']),
      'data_previa_impressao' => date($linha['data_previa_impressao']),
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
  $query_sd_posto = $conexao->prepare("SELECT * FROM tabela_atendentes a INNER JOIN usuario_acesso u ON a.codigo_atendente = u.CODIGO_USR WHERE u.PROD = '1' AND ativo = 1 ORDER BY a.nome_atendente ASC ");
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
                    <?php if ($EXP_I == '1') {
                      if ($Ordens_Selecionada['status'] == '10' || $Ordens_Selecionada['status'] == '13' || $Ordens_Selecionada['status'] == '11' || $Ordens_Selecionada['status'] == '12') { ?>
                        <a href="../expedicao/faturamento.php?cod=<?= $b ?>" class=" btn btn-warning botao">
                          FATURAR
                        </a>
                    <?php }
                    } ?>
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
                        <option value="1 - Alta">1 - Alta</option>';
                        <option value="2 - Normal">2 - Normal</option>';
                        <option value="3 - Média">3 - Média</option>';
                        <option value="4 - Baixa">4 - Baixa</option>';
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
                        <option>Selecione uma Seção</option>
                        <option value="ACABAMENTO">ACABAMENTO</option>
                        <option value="BANNER">BANNER</option>
                        <option value="COMERCIAL / ORÇAMENTAÇÃO">COMERCIAL / ORÇAMENTAÇÃO</option>
                        <option value="EXPEDIÇÃO">EXPEDIÇÃO</option>
                        <option value="FINANCEIRO">FINANCEIRO</option>
                        <option value="GRAVAÇÃO DE CHAPAS">GRAVAÇÃO DE CHAPAS</option>
                        <option value="IMPRESSÃO DIGITAL">IMPRESSÃO DIGITAL</option>
                        <option value="INFORMÁTICA">INFORMÁTICA</option>
                        <option value="OFFSET">OFFSET</option>
                        <option value="PLOTTER">PLOTTER</option>
                        <option value="PRÉ-IMPRESSÃO">PRÉ-IMPRESSÃO</option>
                        <option value="SEÇÃO TÉCNICA">SEÇÃO TÉCNICA</option>
                        <option value="TIPOGRAFIA">TIPOGRAFIA</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="operador" class="form-label">Operador</label>
                      <select class="form-select" id="operador" name="operador" aria-label="Default select example">
                        <option value="<?= $Pesquisa_atendente ?>" selected><?= $Tabela_aTENDENTE_Selecionada['nome_atendente'] ?></option>
                        <?php
                        while ($a < $Operadores) {
                          echo '<option value="' . $Codigo[$a] . ',' . $Codigo[$a] . ' - ' . $Nome_Atem[$a] . '">' . $Codigo[$a] . ' - ' . $Nome_Atem[$a] . '</option>';
                          $a++;
                          //' . $Codigo[$a] . ','. $Codigo[$a] . ' - ' . $Nome_Atem[$a] .'
                        }
                        ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="tipotrabalho" class="form-label">Tipo de Trabalho</label>
                      <select class="form-select" id="tipotrabalho" name="tipotrabalho" aria-label="Default select example">
                        <option value="<?= $Ordens_Selecionada['tipo_trabalho'] ?>" selected><?= $Ordens_Selecionada['tipo_trabalho'] ?></option>
                        <option value="OFFSET">OFFSET</option>
                        <option value="PLOTTER">PLOTTER</option>
                        <option value="DIGITAL">DIGITAL</option>
                        <option value="TIPOGRAFIA">TIPOGRAFIA</option>
                        <option value="ACABAMENTO">ACABAMENTO</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="codSts" class="form-label">Status</label>
                      <select class="form-select" id="codSts" name="codSts" aria-label="Default select example">
                        <option value="<?= $Ordens_Selecionada['status'] ?>" selected><?= $Ordens_Selecionada['status'] ?>
                          - <?= $Ordens_Selecionada['STS_DESCRICAO'] ?></option>
                        <?php
                        $St = 0;
                        while ($St < $Sts) {
                          echo '<option value="' . $Codigo_Sts_P[$St] . '">' . $Codigo_Sts_P[$St] . ' - ' . $Nome_Sts_P[$St] . '</option>';
                          $St++;
                        }

                        ?>

                      </select>
                    </div>
                    <div>
                      <!-- <button type="submit" class="btn btn-primary">Observações</button>
                        <button type="submit" class="btn btn-dark">Imprimir</button> -->
                      <!-- Toggle Between Modals -->
                      <?php if ($PROD_I == '1'  && $Ordens_Selecionada['status'] != '10' && $Ordens_Selecionada['status'] != '17') { ?>
                        <button type="button" class="btn btn-WARNING" data-bs-toggle="modal" data-bs-target="#modalToggle">
                          Salvar
                        </button>
                      <?php } elseif ($Ordens_Selecionada['status'] == '10' || $Ordens_Selecionada['status'] == '17' && $EXP_ADM_I == '1') { ?>
                        <input type="submit" name="dataEXP" class="btn btn-WARNING" data-bs-toggle="modal" data-bs-target="#modalToggle" value="Salvar gerenciamento da EXP" />

                      <?php } else {
                        echo 'Você não tem permissão para alterar essa OP';
                      } ?>
                      <br></br>
                    </div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
      <!-- Modal 1-->
      <?php if ($PROD_I == '1') { ?>
        <div class="modal fade" id="modalToggle" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalToggleLabel">Salvar Alterações</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">Todas atualizações serão salvas! <br>
                <b>Tem certeza que deseja salvar?</b>
                <hr>
                <b>Op que está sendo transeferida para a 10 - EXPEDIÇÃO tera que ser aceita por algum atendente para efetuar
                  a movimentação da op!</b>
                <br>
              </div>
              <div class="modal-footer">
                <button type="submit" name="sim" class="btn btn-primary" data-bs-target="#modalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">
                  Sim
                </button>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
      <!-- Datas -->
      <br>
      <div class="card accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="true" aria-controls="accordionTwo">
            Administração de Datas
          </button>
        </h2>
        <!-- arrumar alteraçãos -->
        <!-- <input class="form-control" name="D_emiss" type="date"
                              value="<?= $Ordens_Selecionada['data_emissao'] ?>"  />
                              <input class="form-control" name="D_apr_cliente" type="date"
                              value="<?= $Ordens_Selecionada['data_apr_cliente'] ?>"  />
                              <input class="form-control" name="D_imposta_dir" type="date"
                              value="<?= $Ordens_Selecionada['data_imp_dir'] ?>"  />
                              <input class="form-control" name="D_expedicao" type="date"
                                value="<?= $Ordens_Selecionada['DT_ENVIADO_EXPEDICAO'] ?>"  />
                           <input class="form-control" name="D_prova_tipo" type="date"
                          value="<?= $Ordens_Selecionada['DT_TIPOGRAFIA_PROVA'] ?>"  />
                          <input class="form-control" name="D_prova_acabame" type="date"
                          value="<?= $Ordens_Selecionada['DT_ACABAMENTO_PROVA'] ?>"  />
                          <input class="form-control" name="D_entrada_pre" type="date"
                        value="<?= $Ordens_Selecionada['DT_ENTRADA_PRE_IMP'] ?>"  />
                        <input class="form-control" name="D_entrada_digital" type="date"
                        value="<?= $Ordens_Selecionada['DT_ENT_DIGITAL'] ?>"  />
                        <input class="form-control" name="D_entrada_off" type="date"
                        value="<?= $Ordens_Selecionada['data_ent_offset'] ?>"  />
                        <input class="form-control" name="D_entradactp" type="date"
                        value="<?= $Ordens_Selecionada['DT_ENTRADA_CTP'] ?>"  />
                        <input class="form-control" name="D_entrada_tipo" type="date"
                        value="<?= $Ordens_Selecionada['data_ent_tipografia'] ?>"  />
                        <input class="form-control" name="D_entrada_acabamento" type="date"
                        value="<?= $Ordens_Selecionada['data_ent_acabamento'] ?>"  /> -->


        <!--  -->
        <div id="accordionTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="row">
              <?php if ($secao_user == 'SEÇÃO TÉCNICA' or $secao_user == 'INFORMÁTICA') { ?>
                <div class="col-md-6">
                  <div class="card mb-4">
                    <h5 class="card-header">Seção Técnica</h5>
                    <div class="card-body">
                      <div>
                        <div class="mb-3 row">
                          <label for="html5-date-input" class="col-md-2 col-form-label">Data de Entrada</label>
                          <div class="col-md-10">
                            <input class="form-control" name="D_emiss" type="date" value="<?= $Ordens_Selecionada['data_emissao'] ?>"  />
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="html5-date-input" class="col-md-2 col-form-label">Aprovação do Cliente</label>
                          <div class="col-md-10">
                            <input class="form-control" name="D_apr_cliente" type="date" value="<?= $Ordens_Selecionada['data_apr_cliente'] ?>"  />
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="html5-date-input" class="col-md-2 col-form-label">Imposta (Direção)</label>
                          <div class="col-md-10">
                            <input class="form-control" name="D_imposta_dir" type="date" value="<?= $Ordens_Selecionada['data_imp_dir'] ?>"  />
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                <?php } else { ?>
                  <div class="col-md-6">
                  <div class="card mb-4">
                  <h5 class="card-header">Previa da data de <b>Prova / Impressão</b></h5>
                <div class="card-body">
                  <div class="form-floating">
                    <div class="mb-3 row">
                      <label for="html5-date-input" class="col-md-6 col-form-label">Previa da data de Prova</label>
                      <div class="col-md-10">
                        <input  disabled class="form-control" name="data_previa_prova" type="date" value="<?= $Ordens_Selecionada['data_previa_prova'] ?>"  />
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="html5-date-input" class="col-md-6 col-form-label">Previa da data de Impressão</label>
                      <div class="col-md-10">
                        <input disabled class="form-control" name="data_previa_impressao" type="date" value="<?= $Ordens_Selecionada['data_previa_impressao'] ?>"  />
                      </div>
                    </div>
                  </div>
                  </div>
                  </div>
                    <div class="card mb-4">
                      <h5 class="card-header">Você não é da Seção Técnica</h5>
                      <div class="card-body">
                        <div class="mb-3 row">
                          <label for="html5-date-input" class="col-md-2 col-form-label">Aprovação do Cliente</label>
                          <div class="col-md-10">
                            <input class="form-control" name="D_apr_cliente" disabled type="date" value="<?= $Ordens_Selecionada['data_apr_cliente'] ?>"  />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>

                <?php if ($secao_user == 'EXPEDIÇÃO' or $secao_user == 'INFORMÁTICA') { ?>
                  <div class="col-md-6">
                    <div class="card mb-6">
                      <h5 class="card-header">Seção de Expedição</h5>
                      <div class="card-body">
                        <div class="form-floating">
                          <div class="mb-6 row">
                            <label for="html5-date-input" class="col-md-6 col-form-label">Entrada Na Expedição</label>
                            <div class="col-md-10">
                              <input class="form-control" name="D_expedicao" type="date" value="<?= $Ordens_Selecionada['DT_ENVIADO_EXPEDICAO'] ?>"  />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-6 col-form-label">Saída da Expedição</label>
                            <div class="col-md-10">
                              <input class="form-control" name="D_saida_expedicao" type="date" value="<?= $Ordens_Selecionada['DT_SAIDA_EXPEDICAO'] ?>"  />
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-6 col-form-label">Data Prevista para Entrega</label>
                            <div class="col-md-10">
                              <input class="form-control" name="D_data_entrega" type="date" value="<?= $Ordens_Selecionada['data_entrega'] ?>"  />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } else { ?>
                <div class="col-md-6">
                  <div class="card mb-6">
                    <h5 class="card-header">Você não é da Seção de Expedição</h5>
                    <div class="card-body">
                      <?php if ($secao_user == 'SEÇÃO TÉCNICA' or $secao_user == 'INFORMÁTICA' || $cod_user == 'CHE') { ?>
                        <div class="form-floating">
                          <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-6 col-form-label">Data Prevista para Entrega</label>
                            <div class="col-md-10">
                              <input class="form-control" name="D_data_entrega" type="date" value="<?= $Ordens_Selecionada['data_entrega'] ?>"  />
                            </div>
                          </div>
                        </div>
                      <?php } else { ?>
                        <div class="form-floating">
                          <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-6 col-form-label">Data Prevista para Entrega</label>
                            <div class="col-md-10">
                              <input class="form-control" disabled type="date" value="<?= $Ordens_Selecionada['data_entrega'] ?>"  />
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
            </div>
          <?php } ?>

          <?php if ($secao_user == 'SEÇÃO TÉCNICA' or $secao_user == 'INFORMÁTICA') { ?>

            <div class="col-md-6">
              <div class="card mb-4">
                <h5 class="card-header">Geração de Provas</h5>
                <div class="card-body">
                  <u>Você consegue vizualizar somente o que tem acesso pela seção.</u>
                  <div class="form-floating">
                    <div class="mb-3 ">
                      <label for="html5-date-input" class="col-md-2 col-form-label">Prova Entrada Pré-Impressão</label>
                      <div class="col-md-10">
                        <input class="form-control" name="D_prova_pre" type="date" value="<?= $Ordens_Selecionada['DT_ENTRADA_PRE_IMP_PROVA'] ?>"  />
                      </div>
                    </div>
                    <div class="mb-3 ">
                      <label for="html5-date-input" class="col-md-2 col-form-label">Prova Entrada Tipografia</label>
                      <div class="col-md-10">
                        <input class="form-control" name="D_prova_tipo" type="date" value="<?= $Ordens_Selecionada['DT_TIPOGRAFIA_PROVA'] ?>"  />
                      </div>
                    </div>
                    <div class="mb-3 ">
                      <label for="html5-date-input" class="col-md-2 col-form-label">Prova Entrada Acabamento</label>
                      <div class="col-md-10">
                        <input class="form-control" name="D_prova_acabame" type="date" value="<?= $Ordens_Selecionada['DT_ACABAMENTO_PROVA'] ?>"  />
                      </div>
                    </div>
                    <div class="mb-3 ">
                      <label for="html5-date-input" class="col-md-2 col-form-label">1º Prova</label>
                      <div class="col-md-10">
                        <input class="form-control" name="D_prova_1" type="date" value="<?= $Ordens_Selecionada['data_1a_prova'] ?>"  />
                      </div>
                    </div>
                    <div class="mb-3 ">
                      <label for="html5-date-input" class="col-md-2 col-form-label">2º Prova</label>
                      <div class="col-md-10">
                        <input class="form-control" name="D_prova_2" type="date" value="<?= $Ordens_Selecionada['data_2a_prova'] ?>"  />
                      </div>
                    </div>
                    <div class="mb-3 ">
                      <label for="html5-date-input" class="col-md-2 col-form-label">3º Prova</label>
                      <div class="col-md-10">
                        <input class="form-control" name="D_prova_3" type="date" value="<?= $Ordens_Selecionada['data_3a_prova'] ?>"  />
                      </div>
                    </div>
                    <div class="mb-3 ">
                      <label for="html5-date-input" class="col-md-2 col-form-label">4º Prova</label>
                      <div class="col-md-10">
                        <input class="form-control" name="D_prova_4" type="date" value="<?= $Ordens_Selecionada['data_4a_prova'] ?>"  />
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row col-md-6">

              <div class="card mb-6">
                <h5 class="card-header">Previa da data de <b>Prova / Impressão</b></h5>
                <div class="card-body">
                  <div class="form-floating">
                    <div class="mb-3 row">
                      <label for="html5-date-input" class="col-md-6 col-form-label">Previa da data de Prova</label>
                      <div class="col-md-10">
                        <input class="form-control" name="data_previa_prova" type="date" value="<?= $Ordens_Selecionada['data_previa_prova'] ?>"  />
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="html5-date-input" class="col-md-6 col-form-label">Previa da data de Impressão</label>
                      <div class="col-md-10">
                        <input class="form-control" name="data_previa_impressao" type="date" value="<?= $Ordens_Selecionada['data_previa_impressao'] ?>"  />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mb-6">
                <h5 class="card-header">Prazo de <b>entrega</b> da <b>PROVA PRONTA</b> </h5>
                <div class="card-body">
                  <div class="form-floating">
                    <div class="mb-3 row">
                      <label for="html5-date-input" class="col-md-6 col-form-label">Prazo de <b>entrega</b> da <b>PROVA
                          PRONTA</b></label>
                      <div class="col-md-10">
                        <input class="form-control" name="data_entrega_prova" type="date" value="<?= $Ordens_Selecionada['data_entrega_prova'] ?>"  />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } else { ?>

        <?php if ($PROD_I == '1') { ?>
          <div class="row col-md-6">
            <div class="card mb-6">
              <h5 class="card-header">Prazo de <b>entrega</b> da <b>PROVA PRONTA</b> </h5>
              <div class="card-body">
                <div class="form-floating">
                  <div class="mb-3 row">
                    <label for="html5-date-input" class="col-md-6 col-form-label">Prazo de <b>entrega</b> da <b>PROVA
                        PRONTA</b></label>
                    <div class="col-md-10">
                      <input class="form-control" disabled name="data_entrega_prova" type="date" value="<?= $Ordens_Selecionada['data_entrega_prova'] ?>"  />
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
            <u>Você consegue vizualizar somente o que tem acesso pela seção.</u>
            <div class="form-floating">
              <?php if ($secao_user == 'PRÉ-IMPRESSAO') { ?>
                <div class="mb-3 ">
                  <label for="html5-date-input" class="col-md-2 col-form-label">Prova Entrada Pré-Impressão</label>
                  <div class="col-md-10">
                    <input class="form-control" name="D_prova_pre" type="date" value="<?= $Ordens_Selecionada['DT_ENTRADA_PRE_IMP_PROVA'] ?>"  />
                  </div>
                </div>
              <?php } ?>
              <?php if ($secao_user == 'TIPOGRAFIA') { ?>
                <div class="mb-3 ">
                  <label for="html5-date-input" class="col-md-2 col-form-label">Prova Entrada Tipografia</label>
                  <div class="col-md-10">
                    <input class="form-control" name="D_prova_tipo" type="date" value="<?= $Ordens_Selecionada['DT_TIPOGRAFIA_PROVA'] ?>"  />
                  </div>
                </div>
              <?php } ?>
              <?php if ($secao_user == 'ACABAMENTO') { ?>
                <div class="mb-3 ">
                  <label for="html5-date-input" class="col-md-2 col-form-label">Prova Entrada Acabamento</label>
                  <div class="col-md-10">
                    <input class="form-control" name="D_prova_acabame" type="date" value="<?= $Ordens_Selecionada['DT_ACABAMENTO_PROVA'] ?>"  />
                  </div>
                </div>
              <?php } ?>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">1º Prova</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_prova_1" type="date" value="<?= $Ordens_Selecionada['data_1a_prova'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">2º Prova</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_prova_2" type="date" value="<?= $Ordens_Selecionada['data_2a_prova'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">3º Prova</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_prova_3" type="date" value="<?= $Ordens_Selecionada['data_3a_prova'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">4º Prova</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_prova_4" type="date" value="<?= $Ordens_Selecionada['data_4a_prova'] ?>"  />
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } ?>

<?php if ($PROD_I == '1') { ?>
  <div class="row">
    <div class="col-md-6">
      <div class="card mb-4">
        <h5 class="card-header">Seção de Produção <br> Data de Entrada</h5>
        <div class="card-body">
          <?php if ($PROD_ADM_I == '1') { ?>
            <div class="row">
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">Entrada Pré-Imp</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_entrada_pre" type="date" value="<?= $Ordens_Selecionada['DT_ENTRADA_PRE_IMP'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">Entrada na Digital</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_entrada_digital" type="date" value="<?= $Ordens_Selecionada['DT_ENT_DIGITAL'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">Entrada na OffSet</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_entrada_off" type="date" value="<?= $Ordens_Selecionada['data_ent_offset'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">Entrada na CTP</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_entradactp" type="date" value="<?= $Ordens_Selecionada['DT_ENTRADA_CTP'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">Entrada na Tipografia</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_entrada_tipo" type="date" value="<?= $Ordens_Selecionada['data_ent_tipografia'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">Entrada no Acabamento</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_entrada_acabamento" type="date" value="<?= $Ordens_Selecionada['data_ent_acabamento'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">Entrada na Plotter</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_entrada_PLOTTER" type="date" value="<?= $Ordens_Selecionada['DT_ENTRADA_PLOTTER'] ?>"  />
                </div>
              </div>
            </div>
          <?php } else { ?>
            <div class="row">
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">Entrada Pré-Imp</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_entrada_pre" disabled type="date" value="<?= $Ordens_Selecionada['DT_ENTRADA_PRE_IMP'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">Entrada na Digital</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_entrada_digital" disabled type="date" value="<?= $Ordens_Selecionada['DT_ENT_DIGITAL'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">Entrada na OffSet</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_entrada_off" disabled type="date" value="<?= $Ordens_Selecionada['data_ent_offset'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">Entrada na CTP</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_entradactp" disabled type="date" value="<?= $Ordens_Selecionada['DT_ENTRADA_CTP'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">Entrada na Tipografia</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_entrada_tipo" disabled type="date" value="<?= $Ordens_Selecionada['data_ent_tipografia'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">Entrada no Acabamento</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_entrada_acabamento" disabled type="date" value="<?= $Ordens_Selecionada['data_ent_acabamento'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">Entrada na Plotter</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_entrada_PLOTTER" disabled type="date" value="<?= $Ordens_Selecionada['DT_ENTRADA_PLOTTER'] ?>"  />
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card mb-4">
        <h5 class="card-header">Seção de Produção <br> Previsão de Saída</h5>
        <div class="card-body">
          <?php if ($PROD_ADM_I == '1') { ?>
            <div class="row">
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na Pré-Imp</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_SAIDA_pre" type="date" value="<?= $Ordens_Selecionada['SAIDA_PRE'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na Digital</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_SAIDA_digital" type="date" value="<?= $Ordens_Selecionada['SAIDA_DIGITAL'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na OffSet</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_SAIDA_off" type="date" value="<?= $Ordens_Selecionada['SAIDA_OFFSET'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na CTP</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_SAIDActp" type="date" value="<?= $Ordens_Selecionada['SAIDA_CTP'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na Tipografia</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_SAIDA_tipo" type="date" value="<?= $Ordens_Selecionada['SAIDA_TIPOGRAFIA'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA no Acabamento</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_SAIDA_acabamento" type="date" value="<?= $Ordens_Selecionada['SAIDA_ACABAMENTO'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na Plotter</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_SAIDA_PLOTTER" type="date" value="<?= $Ordens_Selecionada['SAIDA_PLOTTER'] ?>"  />
                </div>
              </div>
            </div>
          <?php } else { ?>
            <div class="row">
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na Pré-Imp</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_SAIDA_pre" disabled type="date" value="<?= $Ordens_Selecionada['SAIDA_PRE'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na Digital</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_SAIDA_digital" disabled type="date" value="<?= $Ordens_Selecionada['SAIDA_DIGITAL'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na OffSet</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_SAIDA_off" disabled type="date" value="<?= $Ordens_Selecionada['SAIDA_OFFSET'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na CTP</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_SAIDActp" disabled type="date" value="<?= $Ordens_Selecionada['SAIDA_CTP'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na Tipografia</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_SAIDA_tipo" disabled type="date" value="<?= $Ordens_Selecionada['SAIDA_TIPOGRAFIA'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA no Acabamento</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_SAIDA_acabamento" disabled type="date" value="<?= $Ordens_Selecionada['SAIDA_ACABAMENTO'] ?>"  />
                </div>
              </div>
              <div class="mb-3 ">
                <label for="html5-date-input" class="col-md-2 col-form-label">SAIDA na Plotter</label>
                <div class="col-md-10">
                  <input class="form-control" name="D_SAIDA_PLOTTER" disabled type="date" value="<?= $Ordens_Selecionada['SAIDA_PLOTTER'] ?>"  />
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>
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
                while ($Obs_Qtd > $percorrer) {
                  echo '<tr><td>' . date('d/m/y', strtotime($Tabela_Observacoes[$percorrer]['data'])) . '</td><td>' . $Tabela_Observacoes[$percorrer]['obs'] . '</td></tr>';
                  $percorrer++;
                }
                ?>
              </table>
            </div>
          </div><br>
          <div class="col-12">
            <div class="col-xl">
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <small class="text-muted float-end">Adicionar nova Observação</small>
                </div>
                <div class="card-body">
                  <form method="POST" action="tl-controle-op.php?cod=<?= $Ordens_Selecionada['cod'] ?>&obs=1">
                    <div class="mb-3">
                      <label class="form-label" for="Observacao_nova">Observação</label>
                      <textarea name="Observacao_nova" id="Observacao_nova" class="form-control" placeholder="Qual a Anotação para esta OP?" rows="10" cols="50"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Observação</button>
                  </form>
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
  </div>
  <br>
<?php
} else {
  echo "</div>
            <br>";
} ?>

<div class="card">
  <?php
  if (isset($_POST['pesquisar'])) {
    echo ' <h5 class="card-header">Resultados</h5>';
  } else {
    echo ' <h5 class="card-header">Tempo Real (Ultimas 45)</h5>';
  }
  ?>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <?php
      if (isset($_POST['pesquisar'])) {
        if (isset($_POST['codOpS'])) {
          if ($_POST['codOp']) {
            $cod = $_POST["codOp"];
            $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  WHERE o.cod LIKE '%$cod' ORDER BY  o.data_entrega DESC ");
          }
        }
        if (isset($_POST['codOrcS'])) {
          if ($_POST['codOrc']) {
            $cod = $_POST["codOrc"];
            $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  WHERE o.orcamento_base = '$cod' ORDER BY  o.data_entrega DESC ");
          }
        }
        if (isset($_POST['entregaS'])) {
          if ($_POST['entrega']) {
            $cod = $_POST["entrega"];
            $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  WHERE o.data_entrega LIKE '%$cod%' ORDER BY  o.data_entrega DESC ");
          }
        }
        if (isset($_POST['mesES'])) {
          if ($_POST['mesE']) {
            $cod = $_POST["mesE"];
            $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  WHERE o.data_emissao LIKE '%$cod%' ORDER BY  o.data_entrega DESC ");
          }
        }
        if (isset($_POST['mesEnS'])) {
          if ($_POST['mesEn']) {
            $cod = $_POST["mesEn"];
            $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  WHERE o.data_entrega LIKE '%$cod%' ORDER BY  o.data_entrega DESC ");
          }
        }
        if (isset($_POST['statusS'])) {
          if ($_POST['status']) {
            $cod = $_POST["status"];
            $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  WHERE o.status = '$cod' ORDER BY  o.data_entrega DESC ");
          }
        }
      } else {
        $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO WHERE o.status != '11' AND o.status != '12' AND o.status != '13' ORDER BY  o.data_entrega DESC LIMIT 45");
      }

      if (isset($query_ordens_finalizadas)) {
        $query_ordens_finalizadas->execute();

        $i = 0;

      ?>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Nº da OP</th>
              <th>Data de Emissão</th>
              <th>Data de Entrega</th>
              <th>Status</th>
              <th>Produtos</th>
              <th>Selecionar</th>
            </tr>
          </thead>
          <tbody>
          <?php
          while ($linha = $query_ordens_finalizadas->fetch(PDO::FETCH_ASSOC)) {
            $Ordens_Finalizadas[$i] = [
              'cod' => $linha['cod'],
              'orcamento_base' => $linha['orcamento_base'],
              'tipo_produto' => $linha['tipo_produto'],
              'cod_produto' => $linha['cod_produto'],
              'cod_cliente' => $linha['cod_cliente'],
              'tipo_cliente' => $linha['tipo_cliente'],
              'status' => $linha['status'],
              'STS_DESCRICAO' => $linha['STS_DESCRICAO'],
              'data_entrega' => date($linha['data_entrega']),
              'data_emissao' => date($linha['data_emissao']),

            ];
            $Pesquisa_Produto = $Ordens_Finalizadas[$i]['cod_produto'];
            $Tipo_Produto = $Ordens_Finalizadas[$i]['tipo_produto'];
            if ($Tipo_Produto == '2') {
              $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos_pr_ent  WHERE CODIGO = '$Pesquisa_Produto'");
              $query_PRODUTOS->execute();

              while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                $Tabela_Produtos_Finalizados[$i] = [
                  'descricao' => $linha2['DESCRICAO']
                ];
              }
            }
            if ($Tipo_Produto == '1') {
              $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_Produto'");
              $query_PRODUTOS->execute();

              while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                $Tabela_Produtos_Finalizados[$i] = [
                  'descricao' => $linha2['DESCRICAO']
                ];
              }
            }

            $Pesquisa_Orc = $Ordens_Finalizadas[$i]['orcamento_base'];
            $query_Pesquisa_Orc = $conexao->prepare("SELECT * FROM tabela_orcamentos  WHERE cod = '$Pesquisa_Orc'");
            $query_Pesquisa_Orc->execute();

            while ($linha2 = $query_Pesquisa_Orc->fetch(PDO::FETCH_ASSOC)) {
              $Tabela_Orc_Finalizados[$i] = [
                'valor_total' => $linha2['valor_total']
              ];
            }

            echo '<tr>
                        <td>
                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>' . $Ordens_Finalizadas[$i]['cod'] . '</strong>
                        </td>
                        <td>' . date('d/m/Y', strtotime($Ordens_Finalizadas[$i]['data_emissao'])) . '</td>
                        <td>
                             ' . date('d/m/Y', strtotime($Ordens_Finalizadas[$i]['data_entrega'])) . '
                        </td>
                        
                        <td><span class="badge bg-label-primary me-1">' . $Ordens_Finalizadas[$i]['status'] . ' - ' . $Ordens_Finalizadas[$i]["STS_DESCRICAO"] . '</span></td>
                        <td>
                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>' . $Tabela_Produtos_Finalizados[$i]['descricao'] . '</strong>
                        </td>
                        <td>
                        <div class="">
                        <a class="btn rounded-pill btn-info" href="tl-controle-op.php?cod=' . $Ordens_Finalizadas[$i]['cod'] . '"><i class="bx bx-edit-alt me-1"></i> Selecionar</a>
                    </div>
                        </td>
                      </tr>';


            $i++;
          }

          if (!isset($Ordens_Finalizadas[0]['cod'])) {
            echo '<tr>
                        <td>
                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Nenhum Resultado Encontrado, ainda não possui ordem de produção ou confira o código ou.</strong>
                        </td>
                        <td></td>
                        <td>
                            
                        </td>
                        <td><span class="badge bg-label-primary me-1"></span></td>
                        <td>
                          
                        </td>
                      </tr>';
          }
        } else {
          echo '<tr>
                      <td>
                        <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>É necessário  ativar um filtro antes de consultar!</strong>
                      </td>
                      <td></td>
                      <td>
                          
                      </td>
                      <td><span class="badge bg-label-primary me-1"></span></td>
                      <td>
                        
                      </td>
                    </tr>';
        }
          ?>


          </tbody>
        </table>
    </div>
  </div>
</div>








<?php include_once("../html/navbar-dow.php"); ?>