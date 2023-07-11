<link rel="icon" type="image/x-icon" href="../img/logo40px.ico" />
<?php
session_start();
if (isset($_SESSION["usuario"]) && is_array($_SESSION["usuario"])) {
  require("../conexoes/conexao.php");
  $nome_user = $_SESSION["usuario"][0];
  $tipo_user = $_SESSION["usuario"][1];
  $cod_user = $_SESSION["usuario"][2];
  $validacao = $_SESSION["usuario"][5];
  $atividade = $_SESSION["usuario"][4];
  if ($atividade == '0') {
    header('location: ../login/logout.php?i=0');
  }
  if ($validacao == '0') {
    $_SESSION['msg'] = ' <div style=";" id="alerta<?=$a?>"
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
  É obrigatório o uso do CPF!
</div>
</div>';
    echo "<script>
window.location = '../login/cpf.php?id=" . $cod_user . "'
</script>";
  }
} else {
  echo "<script>
window.location = '../index.php'
</script>";
}
include_once('../notificacoes/relatorio_de_atraso.php');
include_once('../dados/usuario_acessos.php');
$refresh = 0;
// if(isset($_SESSION['pag'])){
// echo 'Potencial';
// while($refresh < 1){ // echo '<meta http-equiv="refresh" content="0">' ; break; // $refresh++; // } // echo '<meta  http-equiv="refresh" content="" />' ; // } if (isset($_SESSION['msg'])) { echo $_SESSION['msg']; unset($_SESSION['msg']); } 
?>

<style>
  .tira {
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

<body>
<div id="load1" class="mb-5" style="position:absolute;background-color: #0056; width: 100%; height: 200vh; z-index: 9999999999999; align-items: center; justify-content: center; display: none; color: white; font-size: 40px;"><img src="../img/preloader.svg"> </div>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="../html/painel.php?p" class="app-brand-link">
            <span class="app-brand-logo demo">
              <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                  <img class="brasao" src="http://www.graficadoexercito.eb.mil.br/images/grafex1.png">
                  <path d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z" id="path-1"></path>
                  <path d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z" id="path-3"></path>
                  <path d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z" id="path-4"></path>
                  <path d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z" id="path-5"></path>
                </defs>
                <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                    <g id="Icon" transform="translate(27.000000, 15.000000)">
                      <g id="Mask" transform="translate(0.000000, 8.000000)">
                        <mask id="mask-2" fill="white">
                          <use xlink:href="#path-1"></use>
                        </mask>
                        <use fill="#696cff" xlink:href="#path-1"></use>
                        <g id="Path-3" mask="url(#mask-2)">
                          <use fill="#696cff" xlink:href="#path-3"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                        </g>
                        <g id="Path-4" mask="url(#mask-2)">
                          <use fill="#696cff" xlink:href="#path-4"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                        </g>
                      </g>
                      <g id="Triangle" transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                        <use fill="#696cff" xlink:href="#path-5"></use>
                        <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </span>
            <span style="font-size: 24px;" class=" demo menu-text fw-bolder ms-2">SISGRAFEx</span>
          </a>
          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>


        <ul class="menu-inner py-1">
          <!-- Menu Lateral -->
          <li class=" painel menu-item ">
            <a href="../html/painel.php?p" class=" menu-link">
              <i class=" menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Página Inicial</div>
            </a>
          </li>


            <!-- Sub-Menu de Dashboard -->
            <li class=" dash-g menu-item">
              <a href="../html/dashboard.php" class="menu-link">
                <iconify-icon icon="mdi:monitor-dashboard" width="20" height="20"></iconify-icon>
                <div data-i18n="Basic">&nbsp &nbsp Dashboard</div>
              </a>
            </li>
            <li class=" quantidames menu-item">
              <a href="../html/tl-quantidades.php" class="menu-link">
                <iconify-icon icon="uil:panel-add" width="20" height="20"></iconify-icon>
                <div data-i18n="Basic">&nbsp &nbsp Quantitativos</div>
              </a>
            </li>
            <?php if ($COD_I == 'ADM') {  ?>


            <li class=" linha menu-item">
              <a href="../linhaproducao/tl-producao.php" class="menu-link">
                <iconify-icon icon="fluent-mdl2:production-floor-management" width="20" height="20"></iconify-icon>
                <div data-i18n="Basic">&nbsp &nbsp Linha de produção</div>
              </a>
            </li>
          <?php }  ?>
          <li class=" problemas menu-item">
            <a data-bs-toggle="tooltip" data-bs-placement="right" data-bs-html="true" title="<i class='bx bx-support'></i> <span>Problemas ou Ajuda?</span>" href="../html/problemas.php" class="menu-link">
              <iconify-icon icon="bx:support" width="20" height="20"></iconify-icon>
              <div data-i18n="Basic">&nbsp &nbsp Suporte</div>
            </a>
          </li>

          </li>
          <li class=" menu-item">
            <a href="../login/logout.php" class="menu-link">
              <iconify-icon icon="ic:baseline-power-settings-new" width="20" height="20"></iconify-icon>
              <div data-i18n="Basic">&nbsp &nbsp SAIR</div>
            </a>
          </li>

          <!-- Modúlo de ADMINISTRAÇÃO -->
          <?php if ($COD_I == 'ADM' || $PROD_ADM_I == '1' || $ORC_ADM_I == '1' || $EXP_ADM_I == '1' || $FIN_ADM_I == '1' || $PROD_ADM_I == '1') {  ?>

            <li class="menu-header small text-uppercase"><span class="menu-header-text">Administração</span></li>
            <!-- Sub-Menu de ADMINISTRAÇÃO -->
            <li class="ADMINISTRAÇÃO menu-item">
              <a href="../administrador/tl-supervisao.php" class="menu-link">
                <iconify-icon icon="mdi:database-eye" width="20" height="20"></iconify-icon>
                <div data-i18n="Basic">Supervisão de Atividades</div>
              </a>
            </li>

            <?php if ($COD_I == 'ADM') {  ?>
              <li class="usuario menu-item">
                <a href="../administrador/tl-cadastro-atendente.php" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-user-pin"></i>
                  <div data-i18n="Basic">Cadastro de Usuário</div>
                </a>
              </li>
              <li class="dados menu-item">
                <a href="../administrador/tl-origem-dados.php" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-cylinder"></i>
                  <div data-i18n="Basic">Origem de Dados</div>
                </a>
              </li>
            <?php  } ?>
            <!-- Sub-Menu de Relatório -->
            <li class="menu-item">

              <ul class="menu-sub">

            </li>
        </ul>
      <?php  }  ?>
      <?php $bloq = 0;
      if ($bloq == '0') {  ?>
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Relatórios</span></li>
        <!-- Sub-Menu de Relatórios -->

        <li class="relatorio menu-item">
          <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
            <div data-i18n="User interface">Relatórios</div>
          </a>
          <ul class="menu-sub">

            <li class="menu-item">
              <a href="../relatorios/tl-relatorio-op.php" class="menu-link">
                <div data-i18n="Accordion">Ordem de Produção</div>
              </a>
            </li>


            <?php if ($ORC_I == '1' || $ORD_I == '1') {  ?>
              <!-- <li class="menu-item">
                <a href="../relatorios/tl-relatorio-orcamento.php" class="menu-link">
                  <div data-i18n="Accordion">Orçamentos</div>
                </a>
              </li>
-->
              <!-- <li class="menu-item">
                <a href="../relatorios/tl-relatorio-papeis.php" class="menu-link">
                  <div data-i18n="Accordion">Consumo de Papéis</div>
                </a>
              </li> -->

            <?php  } ?>
            <?php if ($FIN_I == '1' || $ORD_I == '1') {  ?>
              <!-- <li class="menu-item">
                <a href="../relatorios/tl-relatorio-notas.php" class="menu-link">
                  <div data-i18n="Accordion">Notas de Crédito</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="../relatorios/tl-relatorio-faturamentos.php" class="menu-link">
                  <div data-i18n="Accordion">Faturamentos</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="../relatorios/tl-relatorio-financeiro.php" class="menu-link">
                  <div data-i18n="Accordion">Financeiro</div>
                </a>
              </li> -->
            <?php  } ?>
            <li class="menu-item">
              <a href="../relatorios/tl-relatorio-detalhamento-de-cliente.php" class="menu-link">
                <div data-i18n="Accordion">Detalhamento de Cliente</div>
              </a>
            </li>

          </ul>
          <!-- Modúlo de Orçamentação -->
          <!-- <?php if ($ORC_I == '1') {  ?> -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Orçamentação</span></li>

        <!-- Sub-Menu de Cadastro -->
        <li class=" cadastro menu-item">
          <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-notepad"></i>
            <div data-i18n="User interface">Cadastro e Consulta</div>
          </a>
          <ul class="menu-sub">
            <?php
                  echo  '<li class="menu-item">';
            ?>
            <a class="menu-link">
              <div data-i18n="Accordion">Clientes</div>
            </a>
            <ul>
              <li class="menu-item">
                <a href="../orcamentacao/tl-cadastro-clientes-ori.php" class="menu-link">
                  <div data-i18n="Alerts">Cadastro</div>
                </a>
                <a href="../orcamentacao/tl-clientes-fisico.php" class="menu-link">
                  <div data-i18n="Alerts">Consulta de Cliente Fisico</div>
                </a>
                <a href="../orcamentacao/tl-clientes-juridicos.php" class="menu-link">
                  <div data-i18n="Alerts">Consulta de Cliente Juridico</div>
                </a>
              </li>
            </ul>
            </a>
        </li>
        </ul>
        </li>
        <!-- Sub-Menu de Orçamento -->
        <li class=" painel-orc menu-item">
          <a href="../orcamentacao/tl-painel.php" class="menu-link">
            <iconify-icon icon="uil:panel-add" width="20" height="20"></iconify-icon>
            <div data-i18n="Basic">&nbsp &nbsp Painel Orçamentação</div>
          </a>
        </li>
        <li class=" orcamento menu-item">
          <a href="../orcamentacao/tl-orcamento.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-receipt"></i>
            <div data-i18n="Basic">Orçamento</div>
          </a>
        </li>
        <!-- Sub-Menu de Ordem de Produção -->
        <!-- <li class="menu-item">
          <a href="../producao/tl-controle-op.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-receipt"></i>
            <div data-i18n="Basic">Ordem de Produção</div>
          </a>
        </li> -->
        <!-- Sub-Menu de Consulta Simatex -->
        <!-- <li class="menu-item">
          <a href="tl-consulta-simatex.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-package"></i>
            <div data-i18n="Basic">Consulta Simatex</div>
          </a>
        </li> -->

      <?php  } ?>
      <!-- Modúlo de Produção -->
      <?php if ($PROD_I == '1') {  ?>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Produção</span></li>
        <!-- Sub-Menu de Ordem Produção -->
        <li class=" ordemproducao menu-item">
          <a href="../producao/tl-controle-op.php" class="menu-link">
            <iconify-icon icon="uil:panel-add" width="20" height="20"></iconify-icon>
            <div data-i18n="Basic">&nbsp &nbspOrdem de Produção</div>
          </a>
        </li>

        <li class=" diaria menu-item">
          <a href="../producao/tl-relatorio-diario.php" class="menu-link">
            <iconify-icon icon="material-symbols:fact-check" width="20" height="20"></iconify-icon>
            <div data-i18n="Basic">&nbsp &nbspO.P DIÁRIA</div>
          </a>
        </li>

        <!-- Sub-Menu de Relatório -->
        <li class="menu-item">

          <ul class="menu-sub">

        </li>
        </ul>
      <?php  } ?>
      <?php if ($EXP_I == '1') {  ?>
        <!-- Modúlo de Expedição -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Expedição</span></li>
        <!-- Sub-Menu de Cadastro de Clientes -->
        <li class=" aceita menu-item">
          <a href="../expedicao/aceitar.php" class="menu-link">
            <iconify-icon icon="material-symbols:fact-check" width="20" height="20"></iconify-icon>
            <div data-i18n="Basic">&nbsp &nbsp Aceitar Op's</div>
          </a>
        </li>
        <?php if ($EXP_ADM_I == '1') {  ?>
          <li class=" modifca menu-item">
            <a href="../expedicao/tl-controle-expedicao.php" class="menu-link">
              <i class="menu-icon tf-icons bx bx-notepad"></i>
              <div data-i18n="Basic">Modificação de Op</div>
            </a>
          </li>
        <?php  } ?>
        <li class=" faturamento menu-item">
          <a href="../expedicao/tl-faturadas.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-notepad"></i>
            <div data-i18n="Basic">Notas Faturamento</div>
          </a>
        </li>
        <li class=" fatura menu-item">
          <a href="../expedicao/faturamento.php" class="menu-link">
            <iconify-icon icon="fa6-solid:file-invoice-dollar" width="20" height="20"></iconify-icon>
            <div data-i18n="Basic">&nbsp &nbsp Faturamento</div>
          </a>
        </li>
        <!-- Sub-Menu de Relatório -->
        <li class="menu-item">

          <ul class="menu-sub">

            <li class="menu-item">

            </li>
        </li>
        </li>
        </ul>
      <?php  } ?>
      <!-- Modúlo de OD -->
      <?php if ($ORD_I == '1') {  ?>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Ordenador de Despesas</span></li>
        <!-- Sub-Menu de Ordem Ordenador de Despesas -->
        <!-- <li class="menu-item">
          <a href="../orcamentacao/tl-cadastro-clientes-ori.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-notepad"></i>
            <div data-i18n="Basic">Cadastro de Clientes</div>
          </a>
        </li> -->
        <li class="Od-orc menu-item">
          <a href="../orcamentacao/tl-painel.php?ProdT=3" class="menu-link">
            <i class="menu-icon tf-icons bx bx-receipt"></i>
            <div data-i18n="Basic">O.D. Orçamentos - Orçamentação</div>
          </a>
        </li>
        <!-- <li class="menu-item">
          <a href="../producao/tl-controle-op.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-receipt"></i>
            <div data-i18n="Basic">Ordens de Produção - Produção</div>
          </a>
        </li> -->
        <!-- <li class="menu-item">
          <a href="../expedicao/faturamento.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-notepad"></i>
            <div data-i18n="Basic">Faturamentos - Expedição</div>
          </a>
        </li> -->
        <!-- <li class="menu-item">
          <a href="../financeiro/tl-cadastro-notas.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-credit-card"></i>
            <div data-i18n="Basic">Notas de Crédito - Financeiro (Comercial)</div>
          </a>
        </li> -->
        <!--- <li class="menu-item">
          <a href="#" class="menu-link">
            <i class="menu-icon tf-icons bx bx-package"></i>
            <div data-i18n="Basic">Consulta de Material Simatex - Estoque</div>
          </a>
        </li> !-->
        <li class="controle menu-item">
          <a href="../producao/tl-controle-op.php" class="menu-link">
            <i class="menu-icon tf-icons bx bx-receipt"></i>
            <div data-i18n="Basic">Controle de OP</div>
          </a>
        </li>

      <?php  } ?>
      <?php if ($FIN_I == '1') {  ?>
        <!-- Modúlo de Financeiro -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Financeiro</span></li>
        <!-- Sub-Menu de Nota de Crédito e Cadastro de Cliente -->
        <li class=" cadastro menu-item">
          <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-notepad"></i>
            <div data-i18n="User interface">Cadastro e Consulta</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a class="menu-link">
                <div data-i18n="Accordion">Clientes</div>
              </a>
              <ul>
                <li class="menu-item">
                  <a href="../orcamentacao/tl-cadastro-clientes-ori.php" class="menu-link">
                    <div data-i18n="Alerts">Cadastro</div>
                  </a>
                  <a href="../orcamentacao/tl-clientes-fisico.php" class="menu-link">
                    <div data-i18n="Alerts">Consulta de Cliente Fisico</div>
                  </a>
                  <a href="../orcamentacao/tl-clientes-juridicos.php" class="menu-link">
                    <div data-i18n="Alerts">Consulta de Cliente Juridico</div>
                  </a>
                </li>
              </ul>
              </a>
            </li>
            </ul>
            <li class=" nota menu-item">
              <a href="../financeiro/tl-cadastro-notas.php?tp=3" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div data-i18n="Basic">Notas de Crédito</div>
              </a>
            </li>
            <!-- <li class="cadastro-cli menu-item">
              <a href="../orcamentacao/tl-cadastro-clientes-ori.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-notepad"></i>
                <div data-i18n="Basic">Cadastro de Clientes</div>
              </a>
            </li> -->
            <li class="control-op menu-item">
              <a href="../producao/tl-controle-op.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-receipt"></i>
                <div data-i18n="Basic">Controle de OP</div>
              </a>
            </li>

        </li>
        </li>
      <?php  } ?>
      <?php if ($ORC_ADM_I == '1' || $PROD_ADM_I == '1' || $EXP_ADM_I == '1' || $FIN_ADM_I == '1') {  ?>
        <!-- Modúlo de Controle Datas -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Controle Datas</span></li>
        <!-- Sub-Menu de Cadastro de Clientes -->
        <li class=" datas menu-item">
          <a href="../controle_periodo/tl-controle.php" class="menu-link">
            <iconify-icon icon="material-symbols:avg-time-outline-sharp" width="20" height="20"></iconify-icon>
            <div data-i18n="Basic">&nbsp Contadores de Período</div>
          </a>
        </li>
        <!-- Sub-Menu de Relatório -->
        <li class="menu-item">

          <ul class="menu-sub">

            <li class="menu-item">

            </li>
        </li>
        </li>
        </ul>
      <?php  } ?>
      <!-- Modúlo de Atualizações -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Atualizações</span></li>
      <li class="atualizacoes menu-item">
        <a href="../atualizacao/tl-atualizacao.php" class="menu-link">
          <iconify-icon icon="ic:outline-system-update-alt" width="20" height="20"></iconify-icon>
          <div data-i18n="Basic">&nbsp Sobre Atualizações</div>
        </a>
      </li>
      <!-- Sub-Menu de Relatório -->
      <li class="menu-item">

        <ul class="menu-sub">

          <li class="menu-item">

            <ul class="menu-sub">

              <li class="menu-item">

              </li>
          </li>

       </li>
      </li>
      </li>
      </ul>

    <?php  } ?>
      </aside>
      <!-- / Menu -->

      <!-- Layout container -->

      <div class="layout-page">
        <!-- Navbar -->
        <div style=" text-align:center;" class="alert alert-danger" role="alert">SISTEMA EM PROCESSO DE DESENVOLVIMENTO! <br> <span style="font-size: 13px;"> não é a versão final.</span></div>
        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>


          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav align-itens-center">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exLargeModal">
                <i data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<span>Clique para visualizar suas OPs <span class='enfase-dashboard'>PENDENTES</span>!</span>" class='bx bx-bell bx-tada'></i>
                <span><?= $Total_Notificacao ?></span>
              </button>
            </ul>
            <ul class="navbar-nav flex-row align-items-center ms-auto justify-content-between">
              <!-- Usuário -->

      </li>
      </li>
      </ul>

    <?php  } ?>
      </aside>
      <!-- / Menu -->

      <!-- Layout container -->

      <div class="layout-page" >
        <!-- Navbar -->
        <div style=" text-align:center;" class="alert alert-danger" role="alert">SISTEMA EM PROCESSO DE DESENVOLVIMENTO! <br> <span style="font-size: 13px;"> não é a versão final.</span></div>
        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>


          <?php  } ?>
        </aside>
        <!-- / Menu -->

              <!-- Notificações -->

              <div class="flex-grow-1 p-3">
                <span class="fw-semibold d-block"><?= $nome_user ?></span>
                <!-- <small class="text-muted"><?= $tipo_user . ' - ' . $cod_user ?></small> -->
              </div>
              <a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<span>Clique para sair de sua conta</span>" class="btn btn-outline-primary" href="../login/logout.php">
                <i class="bx bx-power-off me-2"></i>
                <span class="align-middle">Sair</span>
              </a>
              <!-- Final das notificações -->
              <!-- <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="../img/user.png" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="../img/user.png" alt class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block"><?= $nome_user ?></span>
                          <small class="text-muted"><?= $tipo_user . ' - ' . $cod_user ?></small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="bx bx-cog me-2"></i>
                      <span class="align-middle">Configurações</span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<span>Clique para sair de sua conta</span>" class="dropdown-item" href="../login/logout.php">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">Sair</span>
                    </a>
                  </li>
                </ul> -->
              </li>
              <!-- Final de usuários -->
            </ul>
          </div>

        </nav>
        <style>
          .contorno {
            text-shadow:
              -1px -1px 0px #000,
              -1px 1px 0px #000,
              1px -1px 0px #000,
              1px 0px 0px #000;
          }
        </style>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Modal -->
            <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Ordens de Produção <span class="enfase-navbar">PENDENTES</span>!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>


                    <div class="card">

                      <div class="card-body">
                        <div class="scroll-modal alt-modal" class="table-responsive text-nowrap">
                          <small>Descrição das cores: <br> <b style="background-color: blue; color: white; padding: 4px; border-radius:20px;">Azul: Atraso curto;</b> <b style="margin-left: 3px; background-color: yellow; color: white; padding: 4px; border-radius:20px; " class="contorno">Amarelo: Atraso medio;</b> <b style="margin-left: 3px; background-color: red; color: white; padding: 4px; border-radius:20px;">Vermelho: Atraso Longo;</b> <b style="margin-left: 3px; background-color: orange; color: white; padding: 4px; border-radius:20px;">Laranja: Seção de expedição Atraso Longo</b><b style="margin-left: 3px; background-color: green; color: white; padding: 4px; border-radius:20px;">Verde: Não Existe Data da OP no Sistema</b></small><br><br>
                          <table class="table table-bordered table-modal">
                            <thead>
                              <tr>
                                <th>Ordem de Produção</th>
                                <th>Orçamento Base</th>
                                <th>Data de Emissão</th>
                                <th>Data de Entrega</th>
                                <th>Status</th>
                                <th>Produto</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php


                            $Percorrer_Notificacao = 0;
                            while ($Total_Notificacao > $Percorrer_Notificacao) {

                              if ($Percorrer_Notificacao == 0) {
                                if ($cor[$Percorrer_Notificacao]['cor'] == 'White') {
                                  $tr = '<tr style="color: black;" bgcolor="' . $cor[$Percorrer_Notificacao]['cor'] . '">';
                                } else {
                                  $tr = '<tr style="color: white;" bgcolor="' . $cor[$Percorrer_Notificacao]['cor'] . '">';
                                }
                                $relatorio_Notificacao = $tr .
                                  '<td>' . $Ordens_Notificacao[$Percorrer_Notificacao]['cod'] . '</td>' .
                                  '<td>' . $Ordens_Notificacao[$Percorrer_Notificacao]['orcamento_base'] . '</td>' .
                                  '<td>' . date('d/m/Y', strtotime($Ordens_Notificacao[$Percorrer_Notificacao]['data_emissao'])) . '</td>' .
                                  '<td>' . date('d/m/Y', strtotime($Ordens_Notificacao[$Percorrer_Notificacao]['data_entrega'])) . '</td>' .
                                  '<td>' . $Ordens_Notificacao[$Percorrer_Notificacao]['status'] . ' - ' . $Ordens_Notificacao[$Percorrer_Notificacao]["STS_DESCRICAO"] . ' </td>' .
                                  '<td>' . $Tabela_Produtos_Notificacao[$Percorrer_Notificacao]['descricao'] . '</td></tr>';
                              } else {
                                if ($cor[$Percorrer_Notificacao]['cor'] == 'White') {
                                  $tr = '<tr style="color: black;" bgcolor="' . $cor[$Percorrer_Notificacao]['cor'] . '">';
                                } else {
                                  $tr = '<tr style="color: white;" bgcolor="' . $cor[$Percorrer_Notificacao]['cor'] . '">';
                                }
                                $relatorio_Notificacao = $relatorio_Notificacao . $tr .
                                  '<td>' . $Ordens_Notificacao[$Percorrer_Notificacao]['cod'] . '</td>' .
                                  '<td>' . $Ordens_Notificacao[$Percorrer_Notificacao]['orcamento_base'] . '</td>' .
                                  '<td>' . date('d/m/Y', strtotime($Ordens_Notificacao[$Percorrer_Notificacao]['data_emissao'])) . '</td>' .
                                  '<td>' . date('d/m/Y', strtotime($Ordens_Notificacao[$Percorrer_Notificacao]['data_entrega'])) . '</td>' .
                                  '<td>' . $Ordens_Notificacao[$Percorrer_Notificacao]['status'] . ' - ' . $Ordens_Notificacao[$Percorrer_Notificacao]["STS_DESCRICAO"] . ' </td>' .
                                  '<td>' . $Tabela_Produtos_Notificacao[$Percorrer_Notificacao]['descricao'] . '</td> </tr>';
                              }
                              // $valor_total_Notificacao =  $valor_total_Notificacao + $Tabela_Orc_Notificacao[$Percorrer_Notificacao]["valor_total"] ;
                              $Percorrer_Notificacao++;
                            }
                            if (isset($relatorio_Notificacao)) {
                              echo $relatorio_Notificacao;
                            } else {
                              $relatorio_Notificacao = '<tr>' .
                                '<td>Não há nenhuma pendência</td>';

                              echo $relatorio_Notificacao;
                            }

                            ?>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php if ($_SESSION['feedback'] == 'false') { ?>
              <div style="width: 600px;" id="feedback" class="bs-toast toast toast-placement-ex m-2 fade bg-dark bottom-0 start-50 translate-middle-x show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
                <div class="toast-header">
                  <i class="bx bx-bell me-2"></i>
                  <div class="me-auto fw-semibold">Pesquisa de Satisfação! <br> Tivemos Atualizações!</div>
                  <small>Deixe um <b>NOVO</b> feedback</small>
                  <button v-if="confirmado == true" type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div v-if="confirmado == false">
                  <div class="toast-body">Qual a satisfação quanto as funções e consultas do Sistema?</div>
                  <div style="padding-left: 20px;" v-if="respondido == false">É necessário enviar um feedback</div>
                  <div style="padding-left: 20px;" v-else>Clique em Enviar Feedback</div>
                  <div style="padding-left: 20px;" class="row ">
                    <div @click="valornota(20)" class=" p-2 m-2 btn btn-danger col-2 text-center">☹️<br>Muito Insatisfeito</div>
                    <div @click="valornota(40)" class=" p-2 m-2 btn btn-danger col-2 text-center">🙁<br>Insatisfeito</div>
                    <div @click="valornota(60)" class=" p-2 m-2 btn btn-warning col-2 text-center">😐<br>Neutro</div>
                    <div @click="valornota(80)" class=" p-2 m-2 btn btn-success col-2 text-center">🙂<br>Satisfeito</div>
                    <div @click="valornota(100)" class=" p-2 m-2 btn btn-success col-2 text-center">😃<br>Muito Satisfeito</div>
                  </div>
                  <div class="p-2">
                    <label>Deixe um feedback (opcional)</label>
                    <input class="form-control" v-model="feedback.texto" type="text" placeholder="Deixe aqui seu feedback" id="html5-text-input">
                    <br>
                    <div class="align-items-center justify-content-center text-center">
                      <button v-if="respondido == true" @click="enviarrelatorio()" class=" col-6  btn btn-outline-success">Enviar Feedback</button>
                    </div>
                  </div>
                </div>
                <div style="height: 300px; color: yellow;" v-else>

                  <div class="align-items-center justify-content-center text-center p-5">
                    <iconify-icon icon="raphael:checked" width="50" height="50"></iconify-icon> <br> Feedback enviado com sucesso! Obrigado.<br>
                    <button v-if="confirmado == true" type="button" class="btn btn-success" data-bs-dismiss="toast" aria-label="Close">FECHAR</button>
                  </div>
                </div>
              </div>

              <script>
                const app = new Vue({
                  el: "#feedback",

                  data: {
                    feedback: {
                      nota: null,
                      texto: '',
                    },
                    respondido: false,
                    confirmado: false,
                  },
                  methods: {
                    valornota(valor) {
                      this.feedback.nota = valor;
                      this.respondido = true;
                    },
                    textofeed(valor) {
                      this.feedback.texto = valor;
                    },
                    enviarrelatorio() {
                      if (!this.feedback.nota) {
                        console.log('nenhuma nota');
                      } else {
                        fetch("../html/enviar_relatorio.php", {
                            method: "post",
                            headers: {
                              "Content-Type": "application/json"
                            },
                            body: JSON.stringify(this.feedback)
                          })
                          .then(response => {
                            return response.json();
                          })
                          .then(data => {
                            if (data.message == 'sucesso') {
                              this.confirmado = true;
                            } else {
                              this.confirmado = false;
                            }
                          });
                      }
                    }
                  }
                });
              </script>

            <?php } ?>

