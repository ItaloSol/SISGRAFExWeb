<?php include_once("../html/navbar.php");
require("../conexoes/conexao.php");
$a = 0;
$hoje = date('Y-m-d');
$mes = date('Y-m');
date_default_timezone_set('America/Sao_Paulo');
$dataHora = date('d/m/Y H:i:s');
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
    echo "<script>window.location = 'tl-controle-expedicao.php?cod=" . $cod . "&Ob=S'</script>";
  }
}
if (isset($_GET['Ob'])) {
  if ($_GET['Ob'] == 'S') {
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
  }
}
$query_sd_posto = $conexao->prepare("SELECT * FROM tabela_atendentes a INNER JOIN usuario_acesso u ON a.codigo_atendente = u.CODIGO_USR WHERE u.PROD = '1' ORDER BY a.nome_atendente ASC ");
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
<?php
if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
}  ?>
<!-- Accordion -->

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
          <div class=" modifca-- "></div>
          <form action="tl-controle-expedicao.php" method="POST">
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
                <input class="form-control" type="date" name="entrega" value="<?= $hoje ?>" id="html5-date-input" />
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
  $query_ordens_Selecionada = $conexao->prepare("SELECT  `cod`, prioridade_op ,`DT_ENTRADA_PLOTTER`, `orcamento_base`, `DT_ENVIADO_EXPEDICAO`, `tipo_produto`,  `cod_produto`,  `cod_cliente`,  `cod_contato`,  `cod_endereco`,  `cod_emissor`,  `tipo_cliente`,  `status`, descricao,  `data_emissao`, 
 `data_entrega`,  `data_1a_prova`,  `data_2a_prova`,  `data_3a_prova`,  `data_4a_prova`,  `data_5a_prova`,  `data_apr_cliente`,  `data_ent_final`,  `data_imp_dir`,  `data_ent_offset`,  `DT_ENT_DIGITAL`,  `data_ent_tipografia`,  `data_ent_acabamento`,  
 `data_envio_div_cmcl`,  `DT_CANCELAMENTO`,  `DT_ENTG_PROVA`,  `ind_ent_prazo`,  `ind_ent_erro`,  `tipo_trabalho`,  `COD_ATENDENTE`,  `op_secao`, LEFT(`OBS_FRETE`, 256),  `DT_SAIDA_EXPEDICAO`,  `DT_ENTRADA_PRE_IMP_PROVA`, STS_DESCRICAO, `DT_TIPOGRAFIA_PROVA`,  
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
  $query_Sts = $conexao->prepare("SELECT * FROM sts_op ORDER BY CODIGO ASC ");
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
      'tipo_trabalho' => $linha['tipo_trabalho'],
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
        'nome_atendente' => $linha2['nome_atendente']
      ];
    }
    if (!isset($Tabela_aTENDENTE_Selecionada)) {
      $Tabela_aTENDENTE_Selecionada = [
        'nome_atendente' => 'NÃO ENCONTRADO'
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
  $query_sd_posto = $conexao->prepare("SELECT * FROM tabela_atendentes a INNER JOIN usuario_acesso u ON a.codigo_atendente = u.CODIGO_USR WHERE u.PROD = '1' ORDER BY a.nome_atendente ASC ");
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
                    <button type="button" class="btn btn-primary botao-op" data-bs-toggle="modal" data-bs-target="#modalCenter">
                      OBSERVAÇÕES
                    </button>


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
                      <label for="operador" class="form-label">Operador/Seção</label>
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
                        <option value="<?= $Ordens_Selecionada['status'] ?>" selected><?= $Ordens_Selecionada['status'] ?> - <?= $Ordens_Selecionada['STS_DESCRICAO'] ?></option>
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
                      <button type="submit" class="btn btn-success">Salvar</button>

                      <br></br>
                    </div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
      <!-- Modal 1-->

      <div class="modal fade" id="modalToggle" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">Salvar Alterações</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Todas atualizações serão salvas! <br>
              <b>Tem certeza que deseja salvar?</b>

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

      <!-- Datas -->
      <br>

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
                echo "SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  WHERE o.orcamento_base = '$cod' ORDER BY  o.data_entrega DESC";
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
                        <a class="btn rounded-pill btn-info" href="tl-controle-expedicao.php?cod=' . $Ordens_Finalizadas[$i]['cod'] . '"><i class="bx bx-edit-alt me-1"></i> Selecionar</a>
                    </div>
                        </td>
                      </tr>';


                $i++;
              }

              if (!isset($Ordens_Finalizadas[0]['cod'])) {
                echo '<tr>
                        <td>
                          <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Nenhum Resultado Encontrado, Confira o código ou se já está em produção.</strong>
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
    <?php  include_once("../html/navbar-dow.php"); ?>