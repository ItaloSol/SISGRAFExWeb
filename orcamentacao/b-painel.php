<?php
if (isset($_SESSION['atualizacoes'])) {
  echo $_SESSION['atualizacoes'];
  unset($_SESSION['atualizacoes']);
  include_once('../notificacoes/mensagem.php');
}

function notificaerro()
{
  echo ' <div  id="alerta4"
              role="bs-toast"
              class=" bs-toast toast toast-placement-ex m-2 fade bg-danger top-0 start-50 translate-middle-x show "
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
                    No campo de busca deve ser inserido<br> apenas os Números!     
              </div>
            </div>';
}
if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
}
if (isset($_GET['PS'])) {
  if ($_GET['Tp'] == 'cod') {
    if (!is_numeric($_GET['PS'])) {
      notificaerro();
    } else {
      $Where = 'cod = ' . $_GET['PS'];
    }
  }
  if ($_GET['Tp'] == 'orc') {
    if (!is_numeric($_GET['PS'])) {
      notificaerro();
    } else {
      $Where = 'cod = ' . $_GET['PS'];
    }
  }
  if ($_GET['Tp'] == 'pro') {
    if (!is_numeric($_GET['PS'])) {
      notificaerro();
    } else {
      $Where = 'cod_produto = ' . $_GET['PS'];
    }
  }

  if ($_GET['Tp'] == 'cli') {
    if (!is_numeric($_GET['PS'])) {
      notificaerro();
    } else {
      $Where = 'cod_cliente = ' . $_GET['PS'];
    }
  }
  if ($_GET['Tp'] == 'data') {
    if (!is_numeric($_GET['PS'])) {
      notificaerro();
    } else {
      $Where = 'data_emissao = ' . $_GET['PS'];
    }
  }
  if ($_GET['Tp'] == 'entre') {
    if (!is_numeric($_GET['PS'])) {
      notificaerro();
    } else {
      $Where = 'data_validade = ' . $_GET['PS'];
    }
  }
  if ($_GET['Tp'] == 'sts') {
    if (!is_numeric($_GET['PS'])) {
      notificaerro();
    } else {
      $Where = 'status = ' . $_GET['PS'];
    }
  }
  if (isset($Where)) {
    $query_sd_posto = $conexao->prepare("SELECT count(cod) as Pg FROM tabela_orcamentos WHERE $Where ");
  } else {
    $query_sd_posto = $conexao->prepare("SELECT count(cod) as Pg FROM tabela_orcamentos ");
  }
} else {
  $query_sd_posto = $conexao->prepare("SELECT count(cod) as Pg FROM tabela_orcamentos ");
}

$query_sd_posto->execute();
$i = 0;
if ($linha = $query_sd_posto->fetch(PDO::FETCH_ASSOC)) {
  $i = $linha['Pg'];
};
$total_paginas = $i / 50;
$a = 0;

if (isset($_GET['Pg'])) {
  $Pg = $_GET['Pg'];
} else {
  $Pg = 0;
}
$EmAvaliacao = 0;
$EmORCAMENTO = 0;
$CANCELADO_PARCIAL15 = 0;
$Na_Diagramacao = 0;
$Aguardando_Ap_Cli = 0;
$Entregue = 0;
$Atrasada = 0;
$CANCELA_PARCIAL_15 = 0;
$CANCELA_PRAZO14 = 0;
$Na_Pre = 0;
$AUTORIDADO_OD_GRAF4_att = 0;
$Na_Tipo = 0;
$Na_Tec = 0;
$Na_Tipografia = 0;
$Na_Ofsset = 0;
$Na_Dig = 0;
$Entrega_parcial_Att = 0;
$Soliicitado_experd = 0;
$No_Banner = 0;
$AtrasadaProd = 0;
$AtrasadaExpd = 0;
$aTT_Na_avaliacao1 = 0;
$aTT_Enviado_para_producao2 = 0;
$aTT_ENVIADO_para_od3 = 0;
$aTT_AUTORIDADO_OD_GRAF4 = 0;
$No_Acabamento = 0;
$Na_Gravacao = 0;
$Fora = 0;
$Na_PLOT = 0;
$No_Expedicao_att = 0;
$Enviado_para_producao2 = 0;
$ENVIADO_para_od3 = 0;
$AUTORIDADO_OD_GRAF4 = 0;
$NAO_OD_GRAF5 = 0;
$NAO_CLI6 = 0;
$Na_avaliacao1 = 0;
$EXPEDICAO7 = 0;
$ENTREGUE_PARCIAL8 = 0;
$ENTREGUE9 = 0;
$AUTORIZADO_OD_CLI11 = 0;
$NAO_OD_CLI12 = 0;
$hoje = date('Y-m-d');
$limpa_vencidos = $conexao->prepare("UPDATE tabela_orcamentos SET STATUS = '14' WHERE STATUS = '1' AND data_validade < '$hoje'");
$limpa_vencidos->execute();
$vencendo = date('Y-m-d', strtotime('+' . 5 . 'day', strtotime($hoje)));
$query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_orcamentos  ");
$query_ordens_finalizadas->execute();
$i = 0;
while ($linha = $query_ordens_finalizadas->fetch(PDO::FETCH_ASSOC)) {

  if ($linha['status'] != 5  && $linha['status'] != 6 && $linha['status'] != 2 && $linha['status'] != 7  && $linha['status'] != 8  && $linha['status'] != 9  && $linha['status'] != 10  && $linha['status'] != 12  && $linha['status'] != 13  && $linha['status'] != 14  && $linha['status'] != 15) {

    if ($linha['status'] == 1) {
      $EmORCAMENTO++;
      $Na_avaliacao1++;
    }


    if ($linha['status'] == 3) {
      $EmORCAMENTO++;
      $ENVIADO_para_od3++;
    }
    if ($linha['status'] == 4) {
      $EmORCAMENTO++;
      $AUTORIDADO_OD_GRAF4++;
    }
  }
  if ($linha['status'] == 2) {
    $Enviado_para_producao2++;
  }
  if ($linha['status'] == 9) {
    $ENTREGUE9++;
  }
  if ($linha['status'] == 5) {
    $NAO_OD_GRAF5++;
  }
  if ($linha['status'] == 6) {
    $NAO_CLI6++;
  }
  if ($linha['status'] == 7) {
    $EXPEDICAO7++;
  }
  if ($linha['status'] == 8) {
    $ENTREGUE_PARCIAL8++;
  }
  if ($linha['status'] == 10) {
    $CANCELADO_PARCIAL15++;
  }
  if ($linha['status'] == 11) {
    $AUTORIZADO_OD_CLI11++;
  }
  if ($linha['status'] == 12) {
    $NAO_OD_CLI12++;
  }
  if ($linha['status'] == 14) {
    $CANCELA_PRAZO14++;
  }
  if ($linha['status'] == 15) {
    $CANCELA_PARCIAL_15++;
  }
  if ($linha['data_validade'] < $vencendo && $linha['data_validade'] > $hoje && $linha['status'] != 5   && $linha['status'] != 6  && $linha['status'] != 7  && $linha['status'] != 8  && $linha['status'] != 9  && $linha['status'] != 10  && $linha['status'] != 12  && $linha['status'] != 13  && $linha['status'] != 14  && $linha['status'] != 15) {

    if ($linha['status'] == 1) {
      $Atrasada++;
      $aTT_Na_avaliacao1++;
    }

    if ($linha['status'] == 3) {
      $Atrasada++;
      $aTT_ENVIADO_para_od3++;
    }
    if ($linha['status'] == 4) {
      $Atrasada++;
      $aTT_AUTORIDADO_OD_GRAF4++;
    }
  }
}


?>

<!-- Contadores -->
<div class="row">

  <div class="font-format col-md-6 col-xl-3">
    <div class="card bg-primary text-white mb-3">
      <div class="card-header"><i class='font-contadores bx bx-printer bx-flip-vertical bx-tada'></i></div>
      <div class="card-body">
        <h5 class="card-title text-white"><span data-purecounter-start="0" data-purecounter-end="<?= $EmORCAMENTO ?>" class="purecounter" class="purecounter">0</span></h5>
        <div class="btn-group">
          <button class="btn btn-producao btn-xs dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span style="font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size) ;">Na Orçamentação</span>
          </button>
          <ul class="dropdown-menu">
            <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as Orcs que se encontram na Orçamentação</span>" class="dropdown-item" href="tl-painel.php?ProdT=0">Todos na Orçamentação (<?= $EmORCAMENTO ?>)</a></li>
            <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as Orcs que se encontram na Em avalaiação</span>" class="dropdown-item" href="tl-painel.php?ProdT=1">Em Avaliação (<?= $Na_avaliacao1 ?>)</a></li>

            <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as Orcs que se Enviado para o OD</span>" class="dropdown-item" href="tl-painel.php?ProdT=3">Enviado para o Od (<?= $ENVIADO_para_od3 ?>) </a></li>
            <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as Orcs que estão Produzindo Provas</span>" class="dropdown-item" href="tl-painel.php?ProdT=4">Autorizado Pelo Od (<?= $AUTORIDADO_OD_GRAF4 ?>) </a></li>




          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="font-format col-md-6 col-xl-3">
    <div class="card bg-secondary text-white mb-3">
      <div class="card-header"><i class='font-contadores bx bx-package bx-tada'></i></div>
      <div class="card-body">

        <h5 class="card-title text-white"> <span data-purecounter-start="0" data-purecounter-end="<?= $Enviado_para_producao2 ?>" class="purecounter" class="purecounter">0</span></h5>
        <button class="btn btn-secondary btn-xs dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <span style="font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size) ;">Produção</span>
        </button>
        <ul class="dropdown-menu">
          <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as Orcs que se encontram na Produção</span>" class="dropdown-item" href="tl-painel.php?Exp=2">Em produção (<?= $Enviado_para_producao2 ?>)</a></li>

        </ul>
      </div>
    </div>
  </div>
  <div class="font-format col-md-6 col-xl-3">
    <div class="card bg-success text-white mb-3">
      <div class="card-header"><i class='font-contadores bx bx-paper-plane bx-tada'></i></div>
      <div class="card-body">
        <h5 class="card-title text-white"><span data-purecounter-start="0" data-purecounter-end="<?= $ENTREGUE9 ?>" class="purecounter" class="purecounter">0</span></h5>
        <p data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<span>Clique para visualizar as Orcs entregues</span>" class="card-text"><a style="color:white;" href="tl-painel.php?Ent=1">Entregues</a></p>
      </div>
    </div>
  </div>
  <div class="font-format col-md-6 col-xl-3">
    <div class="card bg-danger text-white mb-3">
      <div class="card-header"><i class='font-contadores bx bx-error-alt bx-tada'></i></div>
      <div class="card-body">
        <h5 class="card-title text-white"><span data-purecounter-start="0" data-purecounter-end="<?= $Atrasada ?>" class="purecounter" class="purecounter">0</span></h5>
        <div class="btn-group">
          <button class="btn btn-atrasadas btn-xs dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span style="font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size) ;">Perto do Vencimento</span>
          </button>
          <ul class="dropdown-menu">

            <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Clique para visualizar as Orcs ATRASADAS na Orçamentação</span>" class="dropdown-item" href="tl-painel.php?Att=1">Orçamentação (<?= $aTT_Na_avaliacao1 ?>)</a></li>
            <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Clique para visualizar as Orcs ATRASADAS com OD</span>" class="dropdown-item" href="tl-painel.php?Att=3">Enviado para o Od (<?= $aTT_ENVIADO_para_od3 ?>) </a></li>
            <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Clique para visualizar as Orcs ATRASADAS Autorizada pelo Od</span>" class="dropdown-item" href="tl-painel.php?Att=4">Autorizada pelo Od (<?= $aTT_AUTORIDADO_OD_GRAF4 ?>) </a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>
  <style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
    }
  </style>
  <!-- Fim dos Contadores -->
  <!-- Tabela de Orçamentação -->
  <?php  // print_r($_GET);
  $a = 0;
  foreach ($_GET as $key => $value) {
    $GET[$a] =  $key . '=' . $value;
    if (isset($get)) {
      $get =  $get . '&' . $key . '=' . $value;
    } else {
      $get =  $key . '=' . $value;
    }

    $a++;
  }
  //
  // print_r($GET);
  // echo $key;
  ?>
  <div class=" mb-6 pesquisa-painel">
    <form action="tl-painel.php" method="GET">
      <?php  if (isset($GET)) {



      ?> <script>
          // window.alert();
        </script> <?php
                  echo ' <input type="hidden" name="' . $key . '" value="' . $value . '"  >';
                } ?>
      <div class="row">
        <div class="col-3">
          <label for="exampleFormControlSelect1" class="form-label">Pesquisar por</label>
          <select class="form-select" name="Tp" id="exampleFormControlSelect1" aria-label="Default select example">
            <option value="orc">Código Orçamento</option>
            <option value="pro">Produto</option>
            <option value="nomepro">Nome Produto</option>
            <option value="clinom">Nome Cliente</option>
            <option value="cli">Cod Cliente</option>
            <!-- <option value="oper">Nome Emisor</option> -->
            <!-- <option value="data">Data Emissão</option> -->
            <!-- <option value="entre">Data de Validade</option> -->
            <option value="sts">Status</option>
          </select>
        </div>
        <div class="col-3">
          <div class=" mb-6 pesquisa-painel">
            <label class="form-label" for="basic-default-company">Digite sua Busca</label>
            <input type="text" class="form-control" name="PS" id="basic-default-company" placeholder="Insira Somente o Código" />
          </div>
        </div>
        <div class="col-3">
          <div class=" mb-6 pesquisa-painel"><br>
            <button type="submit" class="btn btn-outline-primary">Pesquisar</button>
          </div>
        </div>
        <div class="col-3">
          <div class=" mb-6 pesquisa-painel"><br>
            <a href="abrir_orcamento.php" class="btn btn-outline-primary">Abrir Orçamento</a>
          </div>
        </div>
      </div>
    </form>
    <?php  if (!isset($_GET['Att'])) {  ?>
      <nav style="margin-top: 10px; " aria-label="Page navigation">
        <ul class="pagination">


          <li class="page-item prev">
            <?php  $V = $a - 2;
            if ($V < 0) {
              $V = 0;
            } ?>
            <?php
            if (isset($_GET['Pg']) || isset($_GET['p'])) {
              if (!isset($_GET['b']) && !isset($_GET['Tp'])) {
                echo '<a class="page-link" href="tl-painel.php?Pg=' . $V . '"><i class="tf-icon bx bx-chevrons-left"></i></a>';
              } // UMA <i class="tf-icon bx bx-chevron-left"> // duas <i class="tf-icon bx bx-chevrons-left">
              if (isset($_GET['b'])) {
                if (isset($_GET['Tp'])) {
                  echo '<a class="page-link" href="tl-painel.php?Pg=' . $V . '&b=' . $_GET['b'] . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '"><i class="tf-icon bx bx-chevrons-left"></i></a>';
                } else {
                  echo '<a class="page-link" href="tl-painel.php?Pg=' . $V . '&b=' . $_GET['b'] . '"><i class="tf-icon bx bx-chevrons-left"></i></a>';
                }
              }
              if (isset($_GET['Tp'])) {
                if (isset($_GET['b'])) {
                  echo '<a class="page-link" href="tl-painel.php?Pg=' . $V . '&b=' . $_GET['b'] . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '"><i class="tf-icon bx bx-chevrons-left"></i></a>';
                } else {
                  echo '<a class="page-link" href="tl-painel.php?Pg=' . $V . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '"><i class="tf-icon bx bx-chevrons-left"></i></a>';
                }
              }

            ?>

          </li>
          <?php  $Proximo = $Pg - 1;
              if ($Proximo > $total_paginas) {
                $Proximo = 0;
              }
              $Anterior = $Proximo - 1;
              if ($Proximo < 0) {
                $Proximo = 0;
              }
              if ($Anterior < 0) {
              } else {
                for ($a = $Anterior; $a <= $Proximo; $a++) {
                  if ($a == $Pg) { ?>
                <li class="page-item active">
                <?php   } else { ?>
                <li class="page-item ">
                <?php    } ?>
                <?php
                  if (!isset($_GET['b']) && !isset($_GET['Tp'])) {
                    echo '<a class="page-link" href="tl-painel.php?Pg=' . $a . '">' . $a . '</a>';
                  }
                  if (isset($_GET['b'])) {
                    if (isset($_GET['Tp'])) {
                      echo '<a class="page-link" href="tl-painel.php?Pg=' . $V . '&b=' . $_GET['b'] . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '">' . $a . '</a>';
                    } else {
                      echo '<a class="page-link" href="tl-painel.php?Pg=' . $V . '&b=' . $_GET['b'] . '">' . $a . '</a>';
                    }
                  }
                  if (isset($_GET['Tp'])) {
                    if (isset($_GET['b'])) {
                      echo '<a class="page-link" href="tl-painel.php?Pg=' . $V . '&b=' . $_GET['b'] . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '">' . $a . '</a>';
                    } else {
                      echo '<a class="page-link" href="tl-painel.php?Pg=' . $V . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '">' . $a . '</a>';
                    }
                  }
                ?>

                </li>
            <?php   }
              } ?>
            </li>
            <?php  if (!isset($Pg)) {
                $Pg = 0;
              }
              $Proximo = $Pg + 5;
              if ($Proximo > $total_paginas) {
                $Proximo = 0;
              }
              for ($a = $Pg; $a < $Proximo; $a++) {
                if ($a == $Pg) { ?>
                <li class="page-item active">
                <?php   } else { ?>
                <li class="page-item ">
                <?php    } ?>
                <?php
                if (!isset($_GET['b']) && !isset($_GET['Tp'])) {
                  echo '<a class="page-link" href="tl-painel.php?Pg=' . $a . '">' . $a . '</a>';
                }
                if (isset($_GET['b'])) {
                  if (isset($_GET['Tp'])) {
                    echo '<a class="page-link" href="tl-painel.php?Pg=' . $a . '&b=' . $_GET['b'] . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '">' . $a . '</a>';
                  } else {
                    echo '<a class="page-link" href="tl-painel.php?Pg=' . $a . '&b=' . $_GET['b'] . '">' . $a . '</a>';
                  }
                }
                if (isset($_GET['Tp'])) {
                  if (isset($_GET['b'])) {
                    echo '<a class="page-link" href="tl-painel.php?Pg=' . $a . '&b=' . $_GET['b'] . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '">' . $a . '</a>';
                  } else {
                    echo '<a class="page-link" href="tl-painel.php?Pg=' . $a . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '">' . $a . '</a>';
                  }
                }
                ?>
                <!-- <a class="page-link" href="tl-painel.php?Pg=<?= $a ?>"><?= $a ?></a> -->
                </li>
              <?php   }  ?>

              <li class="page-item last ">
            <?php
              if (!isset($_GET['b']) && !isset($_GET['Tp'])) {
                echo '<a class="page-link" href="tl-painel.php?Pg=' . $a . '"><i class="tf-icon bx bx-chevrons-right"></i></a>';
              }
              if (isset($_GET['b'])) {
                if (isset($_GET['Tp'])) {
                  echo '<a class="page-link" href="tl-painel.php?Pg=' . $a . '&b=' . $_GET['b'] . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '"><i class="tf-icon bx bx-chevrons-right"></i></a>';
                } else {
                  echo '<a class="page-link" href="tl-painel.php?Pg=' . $a . '&b=' . $_GET['b'] . '"><i class="tf-icon bx bx-chevrons-right"></i></a>';
                }
              }
              if (isset($_GET['Tp'])) {
                if (isset($_GET['b'])) {
                  echo '<a class="page-link" href="tl-painel.php?Pg=' . $a . '&b=' . $_GET['b'] . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '"><i class="tf-icon bx bx-chevrons-right"></i></a>';
                } else {
                  echo '<a class="page-link" href="tl-painel.php?Pg=' . $a . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '"><i class="tf-icon bx bx-chevrons-right"></i></a>';
                }
              }
            }
          } ?>

              </li>
        </ul>
      </nav>

      <div class="card">
        <?php
        if (isset($_GET['cores'])) {
          echo '<small >Descrição das cores: <br><b class="exibir-cores" style=" background-color: blue; color: white; padding:3px;" >Azul: Atraso curto;</b> <b style="margin-left: 5px; padding:3px; border-radius: 0.5rem 0.5rem 0.5rem 0.5rem; background-color: yellow;color: white; "class="contorno">Amarelo: Atraso medio;</b> <b style="margin-left: 5px; padding:3px; border-radius: 0.5rem 0.5rem 0.5rem 0.5rem; background-color: red; color: white;">Vermelho: Atraso Longo;</b> <b style="margin-left: 5px; padding:3px; border-radius: 0.5rem 0.5rem 0.5rem 0.5rem; background-color: orange; color: white;">Laranja: Seção de expedição Atraso Longo</b> <b style="padding:3px; border-radius: 0.5rem 0.5rem 0.5rem 0.5rem; background-color: green; color: white;">Verde: Não Existe Data da OP no Sistema</b></small>';
        }
        if (isset($_GET['Atr'])) {
          echo '<h5 class="card-header">Tabela de Orçamentos Perto do Vencimento</h5>';
        } elseif (isset($_GET['Pro'])) {
          echo '<h5 class="card-header">Tabela de Orçamentos em Orçamentação</h5>';
        } elseif (isset($_GET['Exp'])) {
          echo '<h5 class="card-header">Tabela de Orçamentos na Produção</h5>';
        } elseif (isset($_GET['Ent'])) {
          echo '<h5 class="card-header">Tabela de Orçamentos Entregues</h5>';
        }
        if (isset($_GET['Att'])) {

          echo '<h5 class="card-header">Tabela de Orçamentos Perto do Vencimento na Orçamentação  </h5>';
        }
        if (!isset($_GET['Att']) && !isset($_GET['Ent']) && !isset($_GET['Pro']) && !isset($_GET['Exp'])) {
          echo '<h5 class="card-header">Tabela de Orçamentação</h5>';
        }

        ?>

        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr>
                <?php

                echo '<th>Orçamento</th>';
                echo '<th>Cliente</th>';
                echo '<th>Produto</th>';
                echo '<th>Valor Total</th>';
                echo '<th>Data de Validade</th>';
                echo '<th>Status</th>';

                $Orderby = "data_emissao DESC ";


                ?>


                <th data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<span>Selecione a OP para visualizar todas informações</span>">Selecionar</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">

              <?php
              if (isset($_GET['PS'])) {
                if ($_GET['Tp'] == 'cod') {
                  if (!is_numeric($_GET['PS'])) {
                    notificaerro();
                  } else {
                    $Where = 'cod = ' . $_GET['PS'];
                  }
                }
                if ($_GET['Tp'] == 'nomepro') {

                  $Where = 'DESCRICAO LIKE %' . $_GET['PS'] . '% ';
                }
                if ($_GET['Tp'] == 'oper') {

                  //  $Where = 'cod_emissor LIKE "%' . $_GET['PS'] . '%"';
                }
                if ($_GET['Tp'] == 'orc') {
                  if (!is_numeric($_GET['PS'])) {
                    notificaerro();
                  } else {
                    $Where = 'cod = ' . $_GET['PS'];
                  }
                }
                if ($_GET['Tp'] == 'pro') {
                  if (!is_numeric($_GET['PS'])) {
                    notificaerro();
                  } else {
                    $Where = 'cod_produto = ' . $_GET['PS'];
                  }
                }
                if ($_GET['Tp'] == 'cli') {
                  if (!is_numeric($_GET['PS'])) {
                    notificaerro();
                  } else {
                    $Where = 'cod_cliente = ' . $_GET['PS'];
                  }
                }
                if ($_GET['Tp'] == 'clinom') {

                  $i = 0;
                  $PqNome = $_GET['PS'];
                  $Nome_Clientes1 = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos WHERE nome LIKE '%$PqNome%' ");
                  $Nome_Clientes1->execute();

                  $Nome_Clientes2 = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos WHERE nome LIKE '%$PqNome%' ");


                  $Nome_Clientes2->execute();

                  while ($linha1 = $Nome_Clientes1->fetch(PDO::FETCH_ASSOC)) {
                    $Cod_Cliente_Buscado[$i] = $linha1['cod'];
                    $i++;
                  }
                  while ($linha2 = $Nome_Clientes2->fetch(PDO::FETCH_ASSOC)) {
                    $Cod_Cliente_Buscado[$i] = $linha2['cod'];
                    $i++;
                  }
                  $Pesquisa_Nome = '(' . implode(',', $Cod_Cliente_Buscado) . ')';
                  $Where = 'cod_cliente IN ' . $Pesquisa_Nome;
                }
                if ($_GET['Tp'] == 'data') {
                  if (!is_numeric($_GET['PS'])) {
                    notificaerro();
                  } else {
                    $Where = 'data_emissao = ' . $_GET['PS'];
                  }
                }
                if ($_GET['Tp'] == 'entre') {
                  if (!is_numeric($_GET['PS'])) {
                    notificaerro();
                  } else {
                    $Where = 'data_validade = ' . $_GET['PS'];
                  }
                }
                if ($_GET['Tp'] == 'sts') {
                  if (!is_numeric($_GET['PS'])) {
                    notificaerro();
                  } else {
                    $Where = 'status = ' . $_GET['PS'];
                  }
                }
              }
              // echo $Where;
              if (isset($Where)) {
                $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE $Where ORDER BY $Orderby LIMIT $Pg ,50");
              } else {
                $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE o.status != '11' ORDER BY $Orderby LIMIT $Pg ,50");
              }

              if (isset($_GET['Tp'])) {
                if ($_GET['Tp'] == 'nomepro') {
                  $nome =  $_GET['PS'];
                  $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.`status` = s.CODIGO INNER JOIN tabela_produtos_orcamento po ON o.cod = po.cod_orcamento INNER JOIN produtos p ON p.CODIGO = po.cod_produto  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE p.DESCRICAO like '%$nome%' ORDER BY $Orderby LIMIT $Pg ,50");
                }
              }
              if (isset($_GET['Attr'])) {
                $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE o.data_validade < '$hoje' AND o.status NOT IN (1,3,4,5,10,11,12,13,15) ORDER BY  o.status ASC ");
              } elseif (isset($_GET['Pro'])) {
                $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE  o.status  IN (2,3,4,5,6,7,8,9) ORDER BY  o.data_validade DESC ");
              } elseif (isset($_GET['Exp'])) {
                if ($_GET['Exp'] == '2') {
                  $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE  o.status  = '2' ORDER BY  o.data_validade DESC ");
                }
              } elseif (isset($_GET['Ent'])) {
                $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE  o.status  = '9' ORDER BY  o.data_validade DESC LIMIT 100 ");
              }
              if (isset($_GET['EmProD'])) {
                $Status_EmProD = $_GET['EmProD'];
                $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE o.status = '$Status_EmProD' ORDER BY  o.data_validade DESC ");
              }
              if (isset($_GET['ProdT'])) {
                $sts = $_GET['ProdT'];
                if ($sts == 0) {
                  $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status
                                WHERE o.status >= '1' AND o.status <= '4' AND o.status != '2'  ORDER BY  o.data_validade DESC ");
                } else {
                  $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status
                                WHERE o.status = '$sts' ORDER BY  o.data_validade DESC ");
                }
              }

              if (isset($_GET['Att'])) {
                $Cod_Att = $_GET['Att'];
                $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE o.data_validade < '$vencendo' AND o.data_validade > '$hoje' AND o.status = '$Cod_Att'  ORDER BY  o.data_validade DESC ");
              }
              if (isset($_GET['Res'])) {
                $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.`status` = s.CODIGO WHERE $Where ");
              }
              //  echo "SELECT * FROM tabela_orcamentos o INNER JOIN sts_orcamento s ON o.`status` = s.CODIGO WHERE o.data_validade < '$hoje' AND o.status = '7' ORDER BY  o.data_validade DESC";
              $query_ordens_finalizadas->execute();
              $i = 0;
              while ($linha = $query_ordens_finalizadas->fetch(PDO::FETCH_ASSOC)) {
                if (isset($_GET['Res'])) {

                  $Ordens_Finalizadas[$i] = [
                    'cod' => $linha['cod'],
                    'cod_cliente' => $linha['cod_cliente'],
                    'cod_contato' => $linha['cod_contato'],
                    'cod_endereco' => $linha['cod_endereco'],
                    'status' => $linha['status'],
                    'STS_DESCRICAO' => $linha['STS_DESCRICAO'],
                    'data_validade' => date($linha['data_validade']),
                    'data_emissao' => date($linha['data_emissao']),
                    'tipo_cliente' => $linha['tipo_cliente'],
                    'valor_unitario' => $linha['valor_unitario'],
                    'sif' => $linha['sif'],
                    'desconto' => $linha['desconto'],
                    'valor_total' => $linha['valor_total'],
                    'frete' => $linha['frete'],
                    'ARTE' => $linha['ARTE'],
                    'precos_manuais' => $linha['precos_manuais'],
                    'descricao' => $linha['descricao'],
                    'cod_emissor' => $linha['cod_emissor'],
                    'FAT_TOTALMENTE' => $linha['FAT_TOTALMENTE'],
                    'tipo_frete' => $linha['tipo_frete'],
                    'proposta_assinada' => $linha['proposta_assinada'],

                  ];

                  $Tabela_Produtos_Finalizados[$i] = [
                    'descricao' => 'N/C'
                  ];



                  $Tabela_Orc_Finalizados[$i] = [
                    'valor_total' => 'N/C'
                  ];

                  $a2_b = 10;
                  $a2_y = 20;
                  $a2_r = 30;
                } else {

                  $Ordens_Finalizadas[$i] = [
                    'cod' => $linha['cod'],
                    'cod_cliente' => $linha['cod_cliente'],
                    'cod_contato' => $linha['cod_contato'],
                    'cod_endereco' => $linha['cod_endereco'],
                    'status' => $linha['status'],
                    'STS_DESCRICAO' => $linha['STS_DESCRICAO'],
                    'data_validade' => date($linha['data_validade']),
                    'data_emissao' => date($linha['data_emissao']),
                    'tipo_cliente' => $linha['tipo_cliente'],
                    'valor_unitario' => $linha['valor_unitario'],
                    'sif' => $linha['sif'],
                    'desconto' => $linha['desconto'],
                    'valor_total' => $linha['valor_total'],
                    'frete' => $linha['frete'],
                    'ARTE' => $linha['ARTE'],
                    'precos_manuais' => $linha['precos_manuais'],
                    'descricao' => $linha['descricao'],
                    'cod_emissor' => $linha['cod_emissor'],
                    'FAT_TOTALMENTE' => $linha['FAT_TOTALMENTE'],
                    'tipo_frete' => $linha['tipo_frete'],
                    'proposta_assinada' => $linha['proposta_assinada'],
                  ];
                }
                $Pesquisa_orcamento = $Ordens_Finalizadas[$i]['cod'];
                $Pesquisa_Cliente = $Ordens_Finalizadas[$i]['cod_cliente'];
                $Tipo_Cliente = $Ordens_Finalizadas[$i]['tipo_cliente'];
                if (isset($_GET['Tp'])) {
                  if ($_GET['Tp'] == 'nomepro') {
                    $cod_produto = $linha['cod_produto'];
                    $tipo_produto = $linha['tipo_produto'];
                    $quantiadade = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento  WHERE cod_produto = '$cod_produto' AND tipo_produto = $tipo_produto ");
                  } else {
                    $quantiadade = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento  WHERE cod_orcamento = '$Pesquisa_orcamento'");
                  }
                } else {
                  $quantiadade = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento  WHERE cod_orcamento = '$Pesquisa_orcamento'");
                }



                $quantiadade->execute();

                if ($linha2 = $quantiadade->fetch(PDO::FETCH_ASSOC)) {
                  $Tabela_Produtos[$i] = [
                    'quantidade' => $linha2['quantidade'],
                    'descricao' => $linha2['descricao_produto']
                  ];
                }
                if (!isset($Tabela_Produtos[$i])) {
                  $Tabela_Produtos[$i] = [
                    'quantidade' => 'Não Encontrada',
                    'descricao' => 'Não Encontrada'
                  ];
                }
                if ($Tipo_Cliente == '1') {
                  $query_PRODUTOS = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos  WHERE cod = '$Pesquisa_Cliente'");
                }
                if ($Tipo_Cliente == '2') {
                  $query_PRODUTOS = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos  WHERE cod = '$Pesquisa_Cliente'");
                }
                $query_PRODUTOS->execute();

                while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
                  $Tabela_Clientes[$i] = [
                    'nome' => $linha2['nome']
                  ];
                }
                if (!isset($Tabela_Clientes[$i])) {
                  $Tabela_Clientes[$i] = [
                    'nome' => 'NÃO ENCONTRADO'
                  ];
                }

                $i++;
              }

              //////
              if (isset($Ordens_Finalizadas)) {
                $Total_Finalizadas = count($Ordens_Finalizadas);
              } else {
                $Total_Finalizadas = 0;
              }
              $Percorrer_Finalizadas = 0;
              $valor_total_Finalizadas = 0;

              ?>
              <?php
              if (isset($_GET['Tp'])) {
                // if ($_GET['Tp'] == 'oper') {
                //   echo "<tr><td colspan='8'>Operador Encontrado: " . $Ordens_Finalizadas[0]['cod_emissor'] . " </td></tr>";
                // }
              }

              $tr = '<tr>';
              while ($Total_Finalizadas > $Percorrer_Finalizadas) {
                if ($Percorrer_Finalizadas == 0) {

                  $relatorio = $tr .
                    '<td>' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['cod'] . '</td>' .
                    '<td>' . $Tabela_Clientes[$Percorrer_Finalizadas]['nome'] . '</td>' .
                    '<td>' . 'Qtd: ' . $Tabela_Produtos[$Percorrer_Finalizadas]['quantidade'] . ' | ' . $Tabela_Produtos[$Percorrer_Finalizadas]['descricao'] .  '</td>' .
                    '<td> R$ ' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['valor_total'] . '</td>' .
                    '<td>' . date('d/m/Y', strtotime($Ordens_Finalizadas[$Percorrer_Finalizadas]['data_validade'])) . '</td>' .
                    '<td>' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['status'] . ' - ' . $Ordens_Finalizadas[$Percorrer_Finalizadas]["STS_DESCRICAO"] . ' </td>' .
                    '
                                  <td>
                                  <div class="">
                                  <a class="btn rounded-pill btn-info" href="tl-orcamento.php?cod=' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['cod'] . '"' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['cod'] . '"><i class="bx bx-edit-alt me-1"></i> Selecionar</a>
                              </div>
                                  </td>
                                  </tr>';
                } else {

                  $relatorio = $relatorio . $tr .
                    '<td>' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['cod'] . '</td>' .
                    '<td>' . $Tabela_Clientes[$Percorrer_Finalizadas]['nome'] . '</td>' .
                    '<td>' . 'Qtd: ' . $Tabela_Produtos[$Percorrer_Finalizadas]['quantidade'] . ' | ' . $Tabela_Produtos[$Percorrer_Finalizadas]['descricao'] .  '</td>' .
                    '<td> R$ ' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['valor_total'] . '</td>' .
                    '<td>' . date('d/m/Y', strtotime($Ordens_Finalizadas[$Percorrer_Finalizadas]['data_validade'])) . '</td>' .
                    '<td>' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['status'] . ' - ' . $Ordens_Finalizadas[$Percorrer_Finalizadas]["STS_DESCRICAO"] . ' </td>' .
                    '
                                  <td>
                                  <div class="">
                                  <a class="btn rounded-pill btn-info" href="tl-orcamento.php?cod=' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['cod'] . '"' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['cod'] . '"><i class="bx bx-edit-alt me-1"></i> Selecionar</a>
                              </div>
                                  </td>
                                  </tr>';
                }
                // $valor_total_Finalizadas =  $valor_total_Finalizadas + $Tabela_Orc_Finalizados[$Percorrer_Finalizadas]["valor_total"] ;
                $Percorrer_Finalizadas++;
              }
              if (isset($relatorio)) {
                echo $relatorio;
              } else {
                if (isset($_GET['Res'])) {
                  if (isset($relatorio)) {
                    echo $relatorio;
                  } else {
                    $relatorio = '<td><b>Nenhum Resultado Encontrado!</b></td>' .
                      '<td></td>' .
                      '<td></td>' .
                      '<td></td>' .
                      '<td> </td>' .
                      '<td></td>
                                  <td>
                                  
                                </td>
                                          </tr>';
                    echo $relatorio;
                  }
                } else {
                  if (isset($_GET['Tp'])) {
                    $tp = $_GET['Tp'];
                    $nome =  $_GET['PS'];
                    $relatorio = '<td><b>AGUARDE PROCURANDO ALGUM RESULTADO DISPONIVEL!</b></td>' .
                      '<td></td>' .
                      '<td></td>' .
                      '<td></td>' .
                      '<td> </td>' .
                      '<td></td>
                                    <td>
                                    
                                  </td>
                                            </tr>';
                    echo $relatorio;
                    echo "<script>window.location = 'painel.php?Tp=" . $tp . "&PS=" . $nome . "&Res=um'</script>";
                  } else {
                    $relatorio = '<td><b>Nenhum Resultado Encontrado!</b></td>' .
                      '<td></td>' .
                      '<td></td>' .
                      '<td></td>' .
                      '<td> </td>' .
                      '<td></td>
                                  <td>
                                  
                                </td>
                                          </tr>';
                    echo $relatorio;
                  }
                }
              }

              ?>



            </tbody>
          </table>
        </div>

      </div>
      <!-- Final da Tabela de Orçamentação -->
      <!-- Import dos Contadores em JavaScript -->

      <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>
      <script>
        new PureCounter();
      </script>
      <script>
        //      import PureCounter from "@srexi/purecounterjs";
        const pure = new PureCounter();

        new PureCounter();

        // Or you can customize it for override the default config.
        // Here is the default configuration for all element with class 'filesizecount'
        new PureCounter({
          // Setting that can't' be overriden on pre-element
          selector: ".purecounter", // HTML query selector for spesific element

          // Settings that can be overridden on per-element basis, by `data-purecounter-*` attributes:
          start: 0, // Starting number [uint]
          end: 100, // End number [uint]
          duration: 2, // The time in seconds for the animation to complete [seconds]
          delay: 10, // The delay between each iteration (the default of 10 will produce 100 fps) [miliseconds]
          once: true, // Counting at once or recount when the element in view [boolean]
          pulse: false, // Repeat count for certain time [boolean:false|seconds]
          decimals: 0, // How many decimal places to show. [uint]
          legacy: true, // If this is true it will use the scroll event listener on browsers
          filesizing: false, // This will enable/disable File Size format [boolean]
          currency: false, // This will enable/disable Currency format. Use it for set the symbol too [boolean|char|string]
          formater: "us-US", // Number toLocaleString locale/formater, by default is "en-US" [string|boolean:false]
          separator: false, // This will enable/disable comma separator for thousands. Use it for set the symbol too [boolean|char|string]
        });
      </script>
      <!-- Final do Import dos Contadores em JavaScript -->