             <?php
              if (isset($_SESSION['atualizacoes'])) {
                echo $_SESSION['atualizacoes'];
                unset($_SESSION['atualizacoes']);
                include_once('../notificacoes/mensagem.php');
              }
              if (isset($_SESSION['problema'])) {
                echo $_SESSION['problema'];
                unset($_SESSION['problema']);
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
                    $Where = 'orcamento_base = ' . $_GET['PS'];
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
                    $Where = 'data_enrega = ' . $_GET['PS'];
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
                  $query_sd_posto = $conexao->prepare("SELECT count(cod) as Pg FROM tabela_ordens_producao WHERE $Where ");
                } else {
                  $query_sd_posto = $conexao->prepare("SELECT count(cod) as Pg FROM tabela_ordens_producao ");
                }
              } else {
                $query_sd_posto = $conexao->prepare("SELECT count(cod) as Pg FROM tabela_ordens_producao ");
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
              $EmProducao = 0;
              $EmExpesicao = 0;
              $Na_Diagramacao = 0;
              $Aguardando_Ap_Cli = 0;
              $Entregue = 0;
              $Atrasada = 0;
              $Encaminhada_Exp = 0;
              $Aceitas_Exp = 0;
              $Na_Pre = 0;
              $Produzindo_Prova_att = 0;
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
              $No_Acabamento = 0;
              $Na_Gravacao = 0;
              $Fora = 0;
              $Na_PLOT = 0;
              $No_Expedicao_att = 0;
              $Na_Pre_ = 0;
              $Em_Diagramacao = 0;
              $Produzindo_Prova = 0;
              $Aguardando_Cliente = 0;
              $Na_Ofsset_ = 0;
              $Na_SecTec = 0;
              $Na_Digital = 0;
              $Na_Tipografia_ = 0;
              $No_Acabamento_ = 0;
              $Na_CTP_ = 0;
              $Na_PLOTTER_ = 0;
              $hoje = date('Y-m-d');
              $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao  ");
              $query_ordens_finalizadas->execute();
              $i = 0;
              while ($linha = $query_ordens_finalizadas->fetch(PDO::FETCH_ASSOC)) {

                if ($linha['status'] != 11  && $linha['status'] != 13 && $linha['status'] != 10 && $linha['status'] != 17 && $linha['status'] != 15 && $linha['status'] != 18) {
                  $EmProducao++;
                  if ($linha['status'] == 1) {
                    $Na_SecTec++;
                  }
                  if ($linha['status'] == 2) {
                    $Na_Pre_++;
                  }
                  if ($linha['status'] == 19) {
                    $Fora++;
                  }
                  if ($linha['status'] == 3) {
                    $Em_Diagramacao++;
                  }
                  if ($linha['status'] == 4) {
                    $Produzindo_Prova++;
                  }
                  if ($linha['status'] == 5) {
                    $Aguardando_Cliente++;
                  }
                  if ($linha['status'] == 6) {
                    $Na_Ofsset_++;
                  }
                  if ($linha['status'] == 7) {
                    $Na_Digital++;
                  }
                  if ($linha['status'] == 8) {
                    $Na_Tipografia_++;
                  }
                  if ($linha['status'] == 9) {
                    $No_Acabamento_++;
                  }
                  if ($linha['status'] == 14) {
                    $Na_CTP_++;
                  }
                  if ($linha['status'] == 16) {
                    $Na_PLOTTER_++;
                  }
                }
                if ($linha['status'] == 11) {
                  $Entregue++;
                }
                if ($linha['status'] == 10) {
                  $EmExpesicao++;
                }
                if ($linha['status'] == 10) {
                  $Aceitas_Exp++;
                }
                if ($linha['status'] == 17) {
                  $Encaminhada_Exp++;
                }
                if ($linha['data_entrega'] < $hoje && $linha['status'] >= 1  && $linha['status'] != 11 && $linha['status'] != 13 && $linha['status'] != 14 && $linha['status'] != 15 && $linha['status'] != 18) {



                  if ($linha['status'] == 1) {
                    $Atrasada++;
                    $AtrasadaProd++;
                    $Na_Tec++;
                  }
                  if ($linha['status'] == 2) {
                    $Atrasada++;
                    $AtrasadaProd++;
                    $Na_Pre++;
                  }
                  if ($linha['status'] == 3) {
                    $Atrasada++;
                    $AtrasadaProd++;
                    $Na_Diagramacao++;
                  }
                  if ($linha['status'] == 4) {
                    $Atrasada++;
                    $AtrasadaProd++;
                    $Produzindo_Prova_att++;
                  }

                  if ($linha['status'] == 8) {
                    $Atrasada++;
                    $AtrasadaProd++;
                    $Na_Tipografia++;
                  }
                  if ($linha['status'] == 6) {
                    $Atrasada++;
                    $AtrasadaProd++;
                    $Na_Ofsset++;
                  }
                  if ($linha['status'] == 7) {
                    $Atrasada++;
                    $AtrasadaProd++;
                    $Na_Dig++;
                  }
                  if ($linha['status'] == 9) {
                    $Atrasada++;
                    $AtrasadaProd++;
                    $No_Acabamento++;
                  }
                  if ($linha['status'] == 10) {
                    $Atrasada++;
                    $AtrasadaExpd++;
                    $No_Expedicao_att++;
                  }
                  if ($linha['status'] == 12) {
                    $Atrasada++;
                    $AtrasadaProd++;
                    $Entrega_parcial_Att++;
                  }
                  if ($linha['status'] == 14) {
                    $Atrasada++;
                    $AtrasadaProd++;
                    $Na_Gravacao++;
                  }
                  if ($linha['status'] == 16) {
                    $Atrasada++;
                    $AtrasadaProd++;
                    $Na_PLOT++;
                  }
                  if ($linha['status'] == 17) {
                    $Atrasada++;
                    $AtrasadaExpd++;
                    $Soliicitado_experd++;
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
                     <h5 class="card-title text-white"><span data-purecounter-start="0" data-purecounter-end="<?= $EmProducao ?>" class="purecounter" class="purecounter">0</span></h5>
                     <div class="btn-group">
                       <button class="btn btn-producao btn-xs dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                         <span style="font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size) ;">Em
                           Produção</span>
                       </button>
                       <ul class="dropdown-menu">
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as OPs que se encontram na Produção</span>" class="dropdown-item" href="painel.php?ProdT=1">Todos na Produção (<?= $EmProducao ?>)</a>
                         </li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as OPs que se encontram na Seção Técnica</span>" class="dropdown-item" href="painel.php?EmProD=1">Na Seç Técnica (<?= $Na_SecTec ?>)</a>
                         </li>

                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as OPs que se encontram na Pré Impressão</span>" class="dropdown-item" href="painel.php?EmProD=2">Na Pré-Impressão (<?= $Na_Pre_ ?>)</a>
                         </li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as OPs que se encontram em Diagramação</span>" class="dropdown-item" href="painel.php?EmProD=3">Em Diagramação (<?= $Em_Diagramacao ?>)
                           </a></li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as ops que estão Produzindo Provas</span>" class="dropdown-item" href="painel.php?EmProD=4">Produzindo Prova
                             (<?= $Produzindo_Prova ?>) </a></li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as OPs que se encontram na Tipografia</span>" class="dropdown-item" href="painel.php?EmProD=8">Na Tipografia (<?= $Na_Tipografia_ ?>)</a>
                         </li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as OPs que se encontram na OFFSET</span>" class="dropdown-item" href="painel.php?EmProD=6">Na Offset (<?= $Na_Ofsset_ ?>)</a></li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as OPs que se encontram na Impressão Digital</span>" class="dropdown-item" href="painel.php?EmProD=7">Na Digital (<?= $Na_Digital ?>)</a></li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as OPs que se encontram na Gravação de Chapas</span>" class="dropdown-item" href="painel.php?EmProD=14">Na Gravação de Chapas
                             (<?= $Na_CTP_ ?>)</a></li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as OPs que se encontram na Plotter</span>" class="dropdown-item" href="painel.php?EmProD=16">Na Plotter (<?= $Na_PLOTTER_ ?>)</a></li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as OPS que se encontram no Acabamento</span>" class="dropdown-item" href="painel.php?EmProD=9">No Acabamento (<?= $No_Acabamento_ ?>)
                           </a></li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as OPS que estão esperando aprovação do cliente</span>" class="dropdown-item" href="painel.php?EmProD=5">Aguardando Cliente
                             (<?= $Aguardando_Cliente ?>) </a></li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as OPS que estão em Produção Fora da Gráfica</span>" class="dropdown-item" href="painel.php?EmProD=19">Produzindo por Fora (<?= $Fora ?>) </a>
                         </li>


                       </ul>
                     </div>
                   </div>
                 </div>
               </div>

               <div class="font-format col-md-6 col-xl-3">
                 <div class="card bg-secondary text-white mb-3">
                   <div class="card-header"><i class='font-contadores bx bx-package bx-tada'></i></div>
                   <div class="card-body">

                     <h5 class="card-title text-white"> <span data-purecounter-start="0" data-purecounter-end="<?= $EmExpesicao ?>" class="purecounter" class="purecounter">0</span>
                     </h5>
                     <button class="btn btn-secondary btn-xs dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                       <span style="font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size) ;">Expedição</span>
                     </button>
                     <ul class="dropdown-menu">
                       <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as OPs que se encontram na Expedição</span>" class="dropdown-item" href="painel.php?Exp=1">Aceitas na Expedição (<?= $Aceitas_Exp ?>)</a>
                       </li>
                       <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as OPs que se encontram na Expedição</span>" class="dropdown-item" href="painel.php?Exp=2">Encaminhada a Expedição
                           (<?= $Encaminhada_Exp ?>)</a></li>
                     </ul>
                   </div>
                 </div>
               </div>
               <div class="font-format col-md-6 col-xl-3">
                 <div class="card bg-success text-white mb-3">
                   <div class="card-header"><i class='font-contadores bx bx-paper-plane bx-tada'></i></div>
                   <div class="card-body">
                     <h5 class="card-title text-white"><span data-purecounter-start="0" data-purecounter-end="<?= $Entregue ?>" class="purecounter" class="purecounter">0</span></h5>
                     <p data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<span>Clique para visualizar as OPs entregues</span>" class="card-text"><a style="color:white;" href="painel.php?Ent=1">Entregues</a></p>
                   </div>
                 </div>
               </div>
               <div class="font-format col-md-6 col-xl-3">
                 <div class="card bg-danger text-white mb-3">
                   <div class="card-header"><i class='font-contadores bx bx-error-alt bx-tada'></i></div>
                   <div class="card-body">
                     <div class="row">

                       <div class="col-12">Total: <h5 class="card-title text-white"><span data-purecounter-start="0" data-purecounter-end="<?= $Atrasada ?>" class="purecounter" class="purecounter">0</span>
                         </h5>
                       </div>
                       <div class="col-6">Produção: <h6 class="card-title text-white"><span data-purecounter-start="0" data-purecounter-end="<?= $AtrasadaProd ?>" class="purecounter" class="purecounter">0</span></h6>
                       </div>
                       <div class="col-6">Expedição:<h6 class="card-title text-white"><span data-purecounter-start="0" data-purecounter-end="<?= $AtrasadaExpd ?>" class="purecounter" class="purecounter">0</span></h6>
                       </div>
                     </div>
                     <div class="btn-group">
                       <button class="btn btn-atrasadas btn-xs dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                         <span style="font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size) ;">Atrasadas</span>
                       </button>
                       <ul class="dropdown-menu">

                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Clique para visualizar as OPs ATRASADAS na Seç Técnica</span>" class="dropdown-item" href="painel.php?Att=1">Seç Técnica (<?= $Na_Tec ?>)</a></li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Clique para visualizar as OPs ATRASADAS na Pré Impressão</span>" class="dropdown-item" href="painel.php?Att=2">Na Pré-Impressão (<?= $Na_Pre ?>)</a></li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Clique para visualizar as OPs ATRASADAS na Diagramação</span>" class="dropdown-item" href="painel.php?Att=3">Em Diagramação (<?= $Na_Diagramacao ?>) </a>
                         </li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Clique para visualizar as OPs ATRASADAS Produzindo Prova</span>" class="dropdown-item" href="painel.php?Att=4">Produzindo Prova
                             (<?= $Produzindo_Prova_att ?>) </a></li>

                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Clique para visualizar as OPs ATRASADAS na OFFSET</span>" class="dropdown-item" href="painel.php?Att=6">Na Offset (<?= $Na_Ofsset ?>)</a></li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Clique para visualizar fas OPs ATRASADAS na Digital</span>" class="dropdown-item" href="painel.php?Att=7">Na Digital (<?= $Na_Dig ?>) </a></li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Clique para visualizar as OPs ATRASADAS na Tipografia</span>" class="dropdown-item" href="painel.php?Att=8">Na Tipografia (<?= $Na_Tipografia ?>)</a>
                         </li>

                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Clique para visualizar as OPs ATRASADAS no Acabamento</span>" class="dropdown-item" href="painel.php?Att=9">No Acabamento (<?= $No_Acabamento ?>) </a>
                         </li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Clique para visualizar as OPs ATRASADAS Expedição</span>" class="dropdown-item" href="painel.php?Att=10">Expedição (<?= $No_Expedicao_att ?>) </a>
                         </li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Clique para visualizar as OPs ATRASADAS Entrega Parcial</span>" class="dropdown-item" href="painel.php?Att=12">Entregue parcialmente
                             (<?= $Entrega_parcial_Att ?>) </a></li>

                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Clique para visualizar as OPs ATRASADAS na Gravação de Chapas</span>" class="dropdown-item" href="painel.php?Att=14">Gravação de Chapas (<?= $Na_Gravacao ?>)
                           </a></li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Clique para visualizar as OPs ATRASADAS na Na Plotter</span>" class="dropdown-item" href="painel.php?Att=16">Na Polotter (<?= $Na_PLOT ?>)</a></li>
                         <li><a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="<span>Clique para visualizar as OPs que se encontram na Aguardando Expedição</span>" class="dropdown-item" href="painel.php?Att=17">Aguardando Expedição
                             (<?= $Soliicitado_experd ?>)</a></li>







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
               <!-- Tabela de Produção -->
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

                $tempoDeVidaMinutos = session_cache_expire();

                // Converte o tempo de vida em segundos
                $tempoDeVidaSegundos = $tempoDeVidaMinutos * 60;
                // echo ini_get('session.gc_maxlifetime');
                // echo "O tempo de vida da sessão é de " . $tempoDeVidaMinutos . " minutos.";
                ?>
               <div class=" mb-2 pesquisa-painel">
                 <form action="painel.php" method="GET">
                   <div class="row">
                     <?php if (isset($GET)) {

                        echo ' <input type="hidden" name="' . $key . '" value="' . $value . '"  >';
                      } ?>

                     <div class="col-3">
                       <label for="exampleFormControlSelect1" class="form-label">Pesquisar por</label>
                       <select class="form-select" name="Tp" id="exampleFormControlSelect1" aria-label="Default select example">
                         <option value="cod">Código Op</option>
                         <option value="orc">Orçamento Base</option>
                         <option value="pro">Produto</option>
                         <option value="nomepro">Nome Produto</option>
                         <option value="clinom">Nome Cliente</option>
                         <option value="cli">Cod Cliente</option>
                         <option value="oper">Nome Operador</option>
                         <!-- <option value="data">Data Emissão</option>
                     <option value="entre">PREVISÃO de Entrega</option> -->
                         <option value="sts">Status</option>
                       </select>
                     </div>

                     <div class="col-3">
                       <div class=" mb-6 pesquisa-painel">
                         <label class="form-label" for="basic-default-company">Digite sua Busca</label>
                         <input type="text" class="form-control" name="PS" id="basic-default-company" placeholder="Insira Somente o Código" />
                       </div>
                     </div>
                     <div style="width: 10%;" class="col-1">
                       <div class=" mb-2 pesquisa-painel espacamento-buttom"><br>
                         <div id="cores" class="tira">
                           <input type="hidden" name="cores">
                         </div>
                         <!-- -->
                         <div style="width: 10%;" class="form-check form-switch mb-2">
                           <input style="margin-left: -50px;" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                           <label style="margin-left: -9px;" class="form-check-label" id="texto" for="flexSwitchCheckChecked">DESLIGADO</label>
                         </div>

                         <div style="width: 150%; margin-left: -20px;">FILTRO DE CORES</div>
                       </div>
                     </div>
                     <div class="col-3">
                       <div class=" mb-6 pesquisa-painel"><br>
                         <button type="submit" class="btn btn-outline-primary">Pesquisar</button>
                       </div>
                     </div>
                     <script>
                       const checkd = document.getElementById('flexSwitchCheckChecked');
                       const cores = document.getElementById('cores');
                       const texto = document.getElementById('texto');
                       var urlAtual = window.location.href;
                       var urlClass = new URL(urlAtual);
                       var nome = urlClass.searchParams.get("cores");
                       if (nome === null) {
                         checkd.checked = false;
                         document.getElementById('texto').innerHTML = 'DESLIGADO';
                         document.getElementById('cores').classList.add('tira');
                         cores.setAttribute('type', 'reset');
                         texto.style["margin-left"] = "-9px";
                       } else {
                         checkd.checked = true;
                         document.getElementById('texto').innerHTML = 'LIGADO';
                         document.getElementById('cores').classList.remove('tira');
                         cores.setAttribute('type', 'hidden');
                         texto.style["margin-left"] = "0px";
                       }
                       checkd.addEventListener('click', vlr => {
                         if (checkd.checked === true) {
                           document.getElementById('texto').innerHTML = 'LIGADO';
                           document.getElementById('cores').classList.remove('tira');
                           cores.setAttribute('type', 'hidden');
                           texto.style["margin-left"] = "0px";
                         } else {
                           document.getElementById('texto').innerHTML = 'DESLIGADO';
                           document.getElementById('cores').classList.add('tira');
                           cores.setAttribute('type', 'reset');
                           texto.style["margin-left"] = "-9px";
                         }
                       })
                     </script>
                   </div>
                 </form>
                 <?php
                  if (!isset($_GET['Att'])) {  ?>
                   <nav style="margin-top: 10px; " aria-label="Page navigation">
                     <ul class="pagination">


                       <li class="page-item prev">
                         <?php $V = $a - 2;
                          if ($V < 0) {
                            $V = 0;
                          } ?>
                         <?php
                          if (isset($_GET['Pg']) || isset($_GET['p'])) {
                            if (!isset($_GET['b']) && !isset($_GET['Tp'])) {
                              echo '<a class="page-link" href="painel.php?Pg=' . $V . '"><i class="tf-icon bx bx-chevrons-left"></i></a>';
                            } // UMA <i class="tf-icon bx bx-chevron-left"> // duas <i class="tf-icon bx bx-chevrons-left">
                            if (isset($_GET['b'])) {
                              if (isset($_GET['Tp'])) {
                                echo '<a class="page-link" href="painel.php?Pg=' . $V . '&b=' . $_GET['b'] . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '"><i class="tf-icon bx bx-chevrons-left"></i></a>';
                              } else {
                                echo '<a class="page-link" href="painel.php?Pg=' . $V . '&b=' . $_GET['b'] . '"><i class="tf-icon bx bx-chevrons-left"></i></a>';
                              }
                            }
                            if (isset($_GET['Tp'])) {
                              if (isset($_GET['b'])) {
                                echo '<a class="page-link" href="painel.php?Pg=' . $V . '&b=' . $_GET['b'] . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '"><i class="tf-icon bx bx-chevrons-left"></i></a>';
                              } else {
                                echo '<a class="page-link" href="painel.php?Pg=' . $V . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '"><i class="tf-icon bx bx-chevrons-left"></i></a>';
                              }
                            }

                          ?>

                       </li>
                       <?php $Proximo = $Pg - 1;
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
                                  echo '<a class="page-link" href="painel.php?Pg=' . $a . '">' . $a . '</a>';
                                }
                                if (isset($_GET['b'])) {
                                  if (isset($_GET['Tp'])) {
                                    echo '<a class="page-link" href="painel.php?Pg=' . $V . '&b=' . $_GET['b'] . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '">' . $a . '</a>';
                                  } else {
                                    echo '<a class="page-link" href="painel.php?Pg=' . $V . '&b=' . $_GET['b'] . '">' . $a . '</a>';
                                  }
                                }
                                if (isset($_GET['Tp'])) {
                                  if (isset($_GET['b'])) {
                                    echo '<a class="page-link" href="painel.php?Pg=' . $V . '&b=' . $_GET['b'] . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '">' . $a . '</a>';
                                  } else {
                                    echo '<a class="page-link" href="painel.php?Pg=' . $V . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '">' . $a . '</a>';
                                  }
                                }
                              ?>

                             </li>
                         <?php   }
                            } ?>
                         </li>
                         <?php if (!isset($Pg)) {
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
                                echo '<a class="page-link" href="painel.php?Pg=' . $a . '">' . $a . '</a>';
                              }
                              if (isset($_GET['b'])) {
                                if (isset($_GET['Tp'])) {
                                  echo '<a class="page-link" href="painel.php?Pg=' . $a . '&b=' . $_GET['b'] . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '">' . $a . '</a>';
                                } else {
                                  echo '<a class="page-link" href="painel.php?Pg=' . $a . '&b=' . $_GET['b'] . '">' . $a . '</a>';
                                }
                              }
                              if (isset($_GET['Tp'])) {
                                if (isset($_GET['b'])) {
                                  echo '<a class="page-link" href="painel.php?Pg=' . $a . '&b=' . $_GET['b'] . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '">' . $a . '</a>';
                                } else {
                                  echo '<a class="page-link" href="painel.php?Pg=' . $a . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '">' . $a . '</a>';
                                }
                              }
                              ?>
                             <!-- <a class="page-link" href="painel.php?Pg=<?= $a ?>"><?= $a ?></a> -->
                             </li>
                           <?php   }  ?>

                           <li class="page-item last ">
                         <?php
                            if (!isset($_GET['b']) && !isset($_GET['Tp'])) {
                              echo '<a class="page-link" href="painel.php?Pg=' . $a . '"><i class="tf-icon bx bx-chevrons-right"></i></a>';
                            }
                            if (isset($_GET['b'])) {
                              if (isset($_GET['Tp'])) {
                                echo '<a class="page-link" href="painel.php?Pg=' . $a . '&b=' . $_GET['b'] . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '"><i class="tf-icon bx bx-chevrons-right"></i></a>';
                              } else {
                                echo '<a class="page-link" href="painel.php?Pg=' . $a . '&b=' . $_GET['b'] . '"><i class="tf-icon bx bx-chevrons-right"></i></a>';
                              }
                            }
                            if (isset($_GET['Tp'])) {
                              if (isset($_GET['b'])) {
                                echo '<a class="page-link" href="painel.php?Pg=' . $a . '&b=' . $_GET['b'] . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '"><i class="tf-icon bx bx-chevrons-right"></i></a>';
                              } else {
                                echo '<a class="page-link" href="painel.php?Pg=' . $a . '&Tp=' . $_GET['Tp'] . '&PS=' . $_GET['PS'] . '"><i class="tf-icon bx bx-chevrons-right"></i></a>';
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
                        echo '<h5 class="card-header">Tabela de Ordens Atrasadas</h5>';
                      } elseif (isset($_GET['Pro'])) {
                        echo '<h5 class="card-header">Tabela de Ordens em Produção</h5>';
                      } elseif (isset($_GET['Exp'])) {
                        echo '<h5 class="card-header">Tabela de Ordens na Expedição</h5>';
                      } elseif (isset($_GET['Ent'])) {
                        echo '<h5 class="card-header">Tabela de Ordens Entregues</h5>';
                      }
                      if (isset($_GET['Att'])) {
                        if ($_GET['Att'] == '6') {
                          echo '<h5 class="card-header">Tabela de Ordens Atrasadas na Offset</h5>';
                        } elseif ($_GET['Att'] == '8') {
                          echo '<h5 class="card-header">Tabela de Ordens Atrasadas na Tipografia </h5>';
                        } elseif ($_GET['Att'] == '9') {
                          echo '<h5 class="card-header">Tabela de Ordens Atrasadas no Acabamento </h5>';
                        } elseif ($_GET['Att'] == '14') {
                          echo '<h5 class="card-header">Tabela de Ordens Atrasadas na Gravação de Chapas </h5>';
                        } elseif ($_GET['Att'] == '2') {
                          echo '<h5 class="card-header">Tabela de Ordens Atrasadas na Pré-Impressão  </h5>';
                        } elseif ($_GET['Att'] == '16') {
                          echo '<h5 class="card-header">Tabela de Ordens Atrasadas na Plotter  </h5>';
                        } elseif ($_GET['Att'] == '2') {
                          echo '<h5 class="card-header">Tabela de Ordens Atrasadas na Aguardando Expedição  </h5>';
                        } elseif ($_GET['Att'] == '1') {
                          echo '<h5 class="card-header">Tabela de Ordens Atrasadas na Seç Técnica  </h5>';
                        }
                      }
                      if (!isset($_GET['Att']) && !isset($_GET['Ent']) && !isset($_GET['Pro']) && !isset($_GET['Exp'])) {
                        echo '<h5 class="card-header">Tabela de Ordens de Produção</h5>';
                      }

                      ?>

                     <div class="table-responsive text-nowrap">
                       <table class="table">
                         <thead>
                           <tr>
                             <?php
                              if (!isset($_GET['Tp']) & !isset($_GET['Att']) & !isset($_GET['Exp']) & !isset($_GET['Pro']) & !isset($_GET['Ent'])) {
                                if (isset($_GET['b'])) {
                                  if (isset($_GET['Pg'])) {
                                    if ($_GET['b'] == 'N') {
                                      echo '<th><a href="painel.php?b=N1&Pg=' . $Pg . '">Ordem de Produção <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                              </svg></a></th>';
                                      echo '<th><a href="painel.php?b=O&Pg=' . $Pg . '">Orçamento Base</a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D&Pg=' . $Pg . '">Data de Emissão</a></th>';
                                      echo '<th><a href="painel.php?b=DT&Pg=' . $Pg . '">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S&Pg=' . $Pg . '">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P&Pg=' . $Pg . '">Produto</a></th>';
                                      $Orderby = "cod DESC";
                                    }
                                    if ($_GET['b'] == 'N1') {
                                      echo '<th><a href="painel.php?b=N&Pg=' . $Pg . '">Ordem de Produção <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                                </svg></a></th>';
                                      echo '<th><a href="painel.php?b=O&Pg=' . $Pg . '">Orçamento Base</a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D&Pg=' . $Pg . '">Data de Emissão</a></th>';
                                      echo '<th><a href="painel.php?b=DT&Pg=' . $Pg . '">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S&Pg=' . $Pg . '">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P&Pg=' . $Pg . '">Produto</a></th>';
                                      $Orderby = "cod ASC";
                                    }
                                    if ($_GET['b'] == 'O') {
                                      echo '<th><a href="painel.php?b=N&Pg=' . $Pg . '">Ordem de Produção </a></th>';
                                      echo '<th><a href="painel.php?b=O1&Pg=' . $Pg . '">Orçamento Base <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                                </svg></a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D&Pg=' . $Pg . '">Data de Emissão</a></th>';
                                      echo '<th><a href="painel.php?b=DT&Pg=' . $Pg . '">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S&Pg=' . $Pg . '">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P&Pg=' . $Pg . '">Produto</a></th>';
                                      $Orderby = "orcamento_base ASC";
                                    }
                                    if ($_GET['b'] == 'O1') {
                                      echo '<th><a href="painel.php?b=N&Pg=' . $Pg . '">Ordem de Produção </a></th>';
                                      echo '<th><a href="painel.php?b=O&Pg=' . $Pg . '">Orçamento Base <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                              </svg></a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D&Pg=' . $Pg . '">Data de Emissão</a></th>';
                                      echo '<th><a href="painel.php?b=DT&Pg=' . $Pg . '">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S&Pg=' . $Pg . '">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P&Pg=' . $Pg . '">Produto</a></th>';
                                      $Orderby = "orcamento_base DESC";
                                    }
                                    if ($_GET['b'] == 'D') {
                                      echo '<th><a href="painel.php?b=N&Pg=' . $Pg . '">Ordem de Produção</a></th>';
                                      echo '<th><a href="painel.php?b=O1&Pg=' . $Pg . '">Orçamento Base</a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D1&Pg=' . $Pg . '">Data de Emissão <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                              </svg></a></th>';
                                      echo '<th><a href="painel.php?b=DT&Pg=' . $Pg . '">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S&Pg=' . $Pg . '">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P&Pg=' . $Pg . '">Produto</a></th>';
                                      $Orderby = "data_emissao DESC";
                                    }
                                    if ($_GET['b'] == 'D1') {
                                      echo '<th><a href="painel.php?b=N&Pg=' . $Pg . '">Ordem de Produção</a></th>';
                                      echo '<th><a href="painel.php?b=O&Pg=' . $Pg . '">Orçamento Base</a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D&Pg=' . $Pg . '">Data de Emissão <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                              </svg></a></th>';
                                      echo '<th><a href="painel.php?b=DT&Pg=' . $Pg . '">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S&Pg=' . $Pg . '">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P&Pg=' . $Pg . '">Produto</a></th>';
                                      $Orderby = "data_emissao ASC";
                                    }
                                    if ($_GET['b'] == 'DT') {
                                      echo '<th><a href="painel.php?b=N&Pg=' . $Pg . '">Ordem de Produção</a></th>';
                                      echo '<th><a href="painel.php?b=O&Pg=' . $Pg . '">Orçamento Base</a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D&Pg=' . $Pg . '">Data de Emissão</a></th>';
                                      echo '<th><a href="painel.php?b=DT1&Pg=' . $Pg . '">PREVISÃO de Entrega <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                              </svg></a></th>';
                                      echo '<th><a href="painel.php?b=S&Pg=' . $Pg . '">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P&Pg=' . $Pg . '">Produto</a></th>';
                                      $Orderby = "data_entrega DESC";
                                    }
                                    if ($_GET['b'] == 'DT1') {
                                      echo '<th><a href="painel.php?b=N&Pg=' . $Pg . '">Ordem de Produção</a></th>';
                                      echo '<th><a href="painel.php?b=O&Pg=' . $Pg . '">Orçamento Base</a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D&Pg=' . $Pg . '">Data de Emissão</a></th>';
                                      echo '<th><a href="painel.php?b=DT&Pg=' . $Pg . '">PREVISÃO de Entrega <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                              </svg></a></th>';
                                      echo '<th><a href="painel.php?b=S&Pg=' . $Pg . '">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P&Pg=' . $Pg . '">Produto</a></th>';
                                      $Orderby = "data_entrega ASC";
                                    }
                                    if ($_GET['b'] == 'S') {
                                      echo '<th><a href="painel.php?b=N&Pg=' . $Pg . '">Ordem de Produção</a></th>';
                                      echo '<th><a href="painel.php?b=O1&Pg=' . $Pg . '">Orçamento Base</a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D1&Pg=' . $Pg . '">Data de Emissão</a></th>';
                                      echo '<th><a href="painel.php?b=DT&Pg=' . $Pg . '">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S1&Pg=' . $Pg . '">Status <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                              </svg></a></th>';
                                      echo '<th><a href="painel.php?b=P&Pg=' . $Pg . '">Produto</a></th>';
                                      $Orderby = "status DESC";
                                    }
                                    if ($_GET['b'] == 'S1') {
                                      echo '<th><a href="painel.php?b=N&Pg=' . $Pg . '">Ordem de Produção</a></th>';
                                      echo '<th><a href="painel.php?b=O&Pg=' . $Pg . '">Orçamento Base</a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D&Pg=' . $Pg . '">Data de Emissão</a></th>';
                                      echo '<th><a href="painel.php?b=DT&Pg=' . $Pg . '">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S&Pg=' . $Pg . '">Status <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                              </svg></a></th>';
                                      echo '<th><a href="painel.php?b=P">Produto</a></th>';
                                      $Orderby = "status ASC";
                                    }
                                    if ($_GET['b'] == 'P') {
                                      echo '<th><a href="painel.php?b=N&Pg=' . $Pg . '">Ordem de Produção</a></th>';
                                      echo '<th><a href="painel.php?b=O1&Pg=' . $Pg . '">Orçamento Base</a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D1&Pg=' . $Pg . '">Data de Emissão</a></th>';
                                      echo '<th><a href="painel.php?b=DT&Pg=' . $Pg . '">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S&Pg=' . $Pg . '">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P1&Pg=' . $Pg . '">Produto <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                              </svg></a></th>';
                                      $Orderby = "cod_produto DESC";
                                    }
                                    if ($_GET['b'] == 'P1') {
                                      echo '<th><a href="painel.php?b=N&Pg=' . $Pg . '">Ordem de Produção</a></th>';
                                      echo '<th><a href="painel.php?b=O&Pg=' . $Pg . '">Orçamento Base</a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D&Pg=' . $Pg . '">Data de Emissão</a></th>';
                                      echo '<th><a href="painel.php?b=DT&Pg=' . $Pg . '">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S&Pg=' . $Pg . '">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P&Pg=' . $Pg . '">Produto <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                              </svg></a></th>';
                                      $Orderby = "cod_produto ASC";
                                    }
                                  } else {
                                    if ($_GET['b'] == 'N') {
                                      echo '<th><a href="painel.php?b=N1">Ordem de Produção <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                  </svg></a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D">Data de Emissão</a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=DT">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P">Produto</a></th>';
                                      $Orderby = "cod DESC";
                                    }
                                    if ($_GET['b'] == 'N1') {
                                      echo '<th><a href="painel.php?b=N">Ordem de Produção <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                  <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                                  </svg></a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D">Data de Emissão</a></th>';
                                      echo '<th><a href="painel.php?b=DT">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P">Produto</a></th>';
                                      $Orderby = "cod ASC";
                                    }
                                    if ($_GET['b'] == 'D') {
                                      echo '<th><a href="painel.php?b=N">Ordem de Produção</a></th>';
                                      echo '<th><a href="painel.php?b=O"1>Orçamento Base</a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D1">Data de Emissão <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                  </svg></a></th>';
                                      echo '<th><a href="painel.php?b=DT">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P">Produto</a></th>';
                                      $Orderby = "data_emissao DESC";
                                    }
                                    if ($_GET['b'] == 'D1') {
                                      echo '<th><a href="painel.php?b=N">Ordem de Produção</a></th>';
                                      echo '<th><a href="painel.php?b=O">Orçamento Base</a></th>';
                                      echo '<th><a href="painel.php?b=D">Data de Emissão <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                  <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                                  </svg></a></th>';
                                      echo '<th><a href="painel.php?b=DT">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P">Produto</a></th>';
                                      $Orderby = "data_emissao ASC";
                                    }
                                    if ($_GET['b'] == 'DT') {
                                      echo '<th><a href="painel.php?b=N">Ordem de Produção</a></th>';
                                      echo '<th><a href="painel.php?b=O">Orçamento Base</a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D">Data de Emissão</a></th>';
                                      echo '<th><a href="painel.php?b=DT1">PREVISÃO de Entrega <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                </svg></a></th>';
                                      echo '<th><a href="painel.php?b=S">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P">Produto</a></th>';
                                      $Orderby = "data_entrega DESC";
                                    }
                                    if ($_GET['b'] == 'DT1') {
                                      echo '<th><a href="painel.php?b=N">Ordem de Produção</a></th>';
                                      echo '<th><a href="painel.php?b=O">Orçamento Base</a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D">Data de Emissão</a></th>';
                                      echo '<th><a href="painel.php?b=DT">PREVISÃO de Entrega <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                  <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                                </svg></a></th>';
                                      echo '<th><a href="painel.php?b=S">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P">Produto</a></th>';
                                      $Orderby = "data_entrega ASC";
                                    }
                                    if ($_GET['b'] == 'S') {
                                      echo '<th><a href="painel.php?b=N">Ordem de Produção</a></th>';
                                      echo '<th><a href="painel.php?b=O"1>Orçamento Base</a></th>';
                                      echo '<th><a href="painel.php?b=D1">Data de Emissão</a></th>';
                                      echo '<th><a href="painel.php?b=DT">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S1">Status <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                </svg></a></th>';
                                      echo '<th><a href="painel.php?b=P">Produto</a></th>';
                                      $Orderby = "status DESC";
                                    }
                                    if ($_GET['b'] == 'S1') {
                                      echo '<th><a href="painel.php?b=N">Ordem de Produção</a></th>';
                                      echo '<th><a href="painel.php?b=O">Orçamento Base</a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D">Data de Emissão</a></th>';
                                      echo '<th><a href="painel.php?b=DT">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S">Status <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                  <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                                </svg></a></th>';
                                      echo '<th><a href="painel.php?b=P">Produto</a></th>';
                                      $Orderby = "status ASC";
                                    }
                                    if ($_GET['b'] == 'P') {
                                      echo '<th><a href="painel.php?b=N">Ordem de Produção</a></th>';
                                      echo '<th><a href="painel.php?b=O"1>Orçamento Base</a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D1">Data de Emissão</a></th>';
                                      echo '<th><a href="painel.php?b=DT">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P1">Produto <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                </svg></a></th>';
                                      $Orderby = "cod_produto DESC";
                                    }
                                    if ($_GET['b'] == 'P1') {
                                      echo '<th><a href="painel.php?b=N">Ordem de Produção</a></th>';
                                      echo '<th><a href="painel.php?b=O">Orçamento Base</a></th>';
                                      echo '<th>Quantidade</th>';
                                      echo '<th><a href="painel.php?b=D">Data de Emissão</a></th>';
                                      echo '<th><a href="painel.php?b=DT">PREVISÃO de Entrega</a></th>';
                                      echo '<th><a href="painel.php?b=S">Status</a></th>';
                                      echo '<th><a href="painel.php?b=P">Produto <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                  <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                                </svg></a></th>';
                                      $Orderby = "cod_produto ASC";
                                    }
                                  }
                                }

                                if (isset($_GET['b']) && isset($_GET['Pg'])) {
                                } else {
                                  echo '<th><a href="painel.php?b=N&Pg=' . $Pg . '">Ordem de Produção</a></th>';
                                  echo '<th><a href="painel.php?b=O&Pg=' . $Pg . '">Orçamento Base</a></th>';
                                  echo '<th>Quantidade</th>';
                                  echo '<th><a href="painel.php?b=D&Pg=' . $Pg . '">Data de Emissão</a></th>';
                                  echo '<th><a href="painel.php?b=DT&Pg=' . $Pg . '">PREVISÃO de Entrega</a></th>';
                                  echo '<th><a href="painel.php?b=S&Pg=' . $Pg . '">Status</a></th>';
                                  echo '<th><a href="painel.php?b=P&Pg=' . $Pg . '">Produto</a></th>';
                                  $Orderby = "data_emissao DESC ";
                                }
                              } else {

                                echo '<th>Ordem de Produção</th>';
                                echo '<th>Orçamento Base</th>';
                                echo '<th>Quantidade</th>';
                                echo '<th>Data de Emissão</th>';
                                echo '<th>PREVISÃO de Entrega</th>';
                                echo '<th>Status</th>';
                                echo '<th>Produto</th>';
                                $Orderby = "data_emissao DESC ";
                              }

                              ?>


                             <th data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="<span>Selecione a OP para visualizar todas informações</span>">
                               Selecionar</th>
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

                                $Where = 'DESCRICAO = ' . $_GET['PS'];
                              }
                              if ($_GET['Tp'] == 'oper') {

                                $Where = 'op_secao LIKE "%' . $_GET['PS'] . '%"';
                              }
                              if ($_GET['Tp'] == 'orc') {
                                if (!is_numeric($_GET['PS'])) {
                                  notificaerro();
                                } else {
                                  $Where = 'orcamento_base = ' . $_GET['PS'];
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
                                  $Where = 'data_enrega = ' . $_GET['PS'];
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
                              $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE $Where ORDER BY $Orderby LIMIT $Pg ,50");
                            } else {
                              $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE o.status != '11' ORDER BY $Orderby LIMIT $Pg ,50");
                            }

                            if (isset($_GET['Tp'])) {
                              if ($_GET['Tp'] == 'nomepro') {
                                $nome =  $_GET['PS'];
                                $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO INNER JOIN produtos p ON p.CODIGO = o.cod_produto  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE p.DESCRICAO like '%$nome%' ORDER BY $Orderby LIMIT $Pg ,50");
                              }
                            }
                            if (isset($_GET['Attr'])) {
                              $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE o.data_entrega < '$hoje' AND o.status NOT IN (1,3,4,5,10,11,12,13,15) ORDER BY  o.status ASC ");
                            } elseif (isset($_GET['Pro'])) {
                              $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE  o.status  IN (2,3,4,5,6,7,8,9) ORDER BY  o.data_entrega DESC ");
                            } elseif (isset($_GET['Exp'])) {
                              if ($_GET['Exp'] == '1') {
                                if (!isset($_GET['Tp'])) {
                                  $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE  o.status  = '10' ORDER BY  o.data_entrega DESC ");
                                }
                              }
                              if ($_GET['Exp'] == '2') {
                                if (!isset($_GET['Tp'])) {
                                  $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE  o.status  = '17' ORDER BY  o.data_entrega DESC ");
                                }
                              }
                            } elseif (isset($_GET['Ent'])) {
                              if (!isset($_GET['Tp'])) {
                                $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE  o.status  = '11' ORDER BY  o.data_entrega DESC LIMIT 100 ");
                              }
                            }
                            if (isset($_GET['EmProD'])) {
                              if (!isset($_GET['Tp'])) {
                                $Status_EmProD = $_GET['EmProD'];
                                $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE o.status = '$Status_EmProD' ORDER BY  o.data_entrega DESC ");
                              }
                            }
                            if (isset($_GET['ProdT'])) {
                              $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status
                                WHERE o.status != '13' AND o.status != '10' AND o.status != '17' AND o.status != '11' AND o.status != '15'
                                ORDER BY  o.data_entrega DESC ");
                            }

                            if (isset($_GET['Att'])) {
                              if (!isset($_GET['Tp'])) {
                                $Cod_Att = $_GET['Att'];
                                $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO  INNER JOIN controle_tempo c ON c.fk_status = o.status WHERE o.data_entrega < '$hoje' AND o.status = '$Cod_Att' ORDER BY  o.data_entrega DESC ");
                              }
                            }
                            if (isset($_GET['Res'])) {
                              $query_ordens_finalizadas = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO WHERE $Where ");
                            }
                            //  echo "SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO WHERE o.data_entrega < '$hoje' AND o.status = '7' ORDER BY  o.data_entrega DESC";
                            $query_ordens_finalizadas->execute();
                            $i = 0;
                            while ($linha = $query_ordens_finalizadas->fetch(PDO::FETCH_ASSOC)) {
                              if (isset($_GET['Res'])) {

                                $Ordens_Finalizadas[$i] = [
                                  'cod' => $linha['cod'],
                                  'orcamento_base' => $linha['orcamento_base'],
                                  'tipo_produto' => $linha['tipo_produto'],
                                  'cod_produto' => $linha['cod_produto'],
                                  'cod_cliente' => $linha['cod_cliente'],
                                  'tipo_cliente' => $linha['tipo_cliente'],
                                  'status' => $linha['status'],
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
                                  'DT_ENTG_PROVA' => date($linha['DT_ENTG_PROVA']),

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
                                  'orcamento_base' => $linha['orcamento_base'],
                                  'tipo_produto' => $linha['tipo_produto'],
                                  'cod_produto' => $linha['cod_produto'],
                                  'cod_cliente' => $linha['cod_cliente'],
                                  'tipo_cliente' => $linha['tipo_cliente'],
                                  'status' => $linha['status'],
                                  'op_secao' => $linha['op_secao'],
                                  'STS_DESCRICAO' => $linha['STS_DESCRICAO'],
                                  'data_entrega' => date($linha['data_entrega']),
                                  'data_emissao' => date($linha['data_emissao']),
                                  'azul_controle' => $linha['azul_controle'],
                                  'cor_ativa' => $linha['cor_ativa'],
                                  'amarelo_controle' => $linha['amarelo_controle'],
                                  'vermelho_controle' => $linha['vermelho_controle'],
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
                                  'DT_ENTG_PROVA' => date($linha['DT_ENTG_PROVA']),

                                ];
                                $Pesquisa_orcamento = $Ordens_Finalizadas[$i]['orcamento_base'];
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
                                $quantiadade = $conexao->prepare("SELECT * FROM tabela_produtos_orcamento  WHERE cod_produto = '$Pesquisa_Produto' AND cod_orcamento = '$Pesquisa_orcamento'");
                                $quantiadade->execute();

                                if ($linha2 = $quantiadade->fetch(PDO::FETCH_ASSOC)) {
                                  $Tabela_Quantidade[$i] = [
                                    'quantidade' => $linha2['quantidade']
                                  ];
                                }
                                if (!isset($Tabela_Quantidade[$i])) {
                                  $Tabela_Quantidade[$i] = [
                                    'quantidade' => 'Não Encontrada'
                                  ];
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
                                $cor_ativa = $Ordens_Finalizadas[$i]['cor_ativa'];
                                $a2_b = $Ordens_Finalizadas[$i]['azul_controle'];
                                $a2_y = $Ordens_Finalizadas[$i]['amarelo_controle'];
                                $a2_r = $Ordens_Finalizadas[$i]['vermelho_controle'];
                              }
                              if (isset($cor_ativa)) {
                                if ($cor_ativa == 1) {
                                  if ($linha['status'] == 1) {
                                    $s1 = $Ordens_Finalizadas[$i]['data_emissao'];
                                    if ($s1 != '') {
                                      $sts1_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s1)));
                                      $sts1_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s1)));
                                      $sts1_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s1)));
                                      if ($hoje > $sts1_b) {
                                        $Clor_Status = 'blue';
                                      }
                                      if ($hoje > $sts1_y) {
                                        $Clor_Status = 'yellow';
                                      }
                                      if ($hoje > $sts1_r) {
                                        $Clor_Status = 'red';
                                      }
                                    } else {
                                      $Clor_Status = 'green';
                                    }
                                  }
                                  //
                                  if ($linha['status'] == 2) {
                                    $s2 = $Ordens_Finalizadas[$i]['DT_ENTRADA_PRE_IMP'];
                                    if ($s2 != '') {
                                      $sts2_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s2)));
                                      $sts2_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s2)));
                                      $sts2_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s2)));
                                      if ($hoje > $sts2_b) {
                                        $Clor_Status = 'blue';
                                      }
                                      if ($hoje > $sts2_y) {
                                        $Clor_Status = 'yellow';
                                      }
                                      if ($hoje > $sts2_r) {
                                        $Clor_Status = 'red';
                                      }
                                    } else {
                                      $Clor_Status = 'green';
                                    }
                                  } //
                                  if ($linha['status'] == 3) {
                                    $s3 = $Ordens_Finalizadas[$i]['DT_ENTRADA_PRE_IMP_PROVA'];
                                    if ($s3 != '') {
                                      $sts3_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s3)));
                                      $sts3_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s3)));
                                      $sts3_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s3)));
                                      if ($hoje > $sts3_b) {
                                        $Clor_Status = 'blue';
                                      }
                                      if ($hoje > $sts3_y) {
                                        $Clor_Status = 'yellow';
                                      }
                                      if ($hoje > $sts3_r) {
                                        $Clor_Status = 'red';
                                      }
                                    } else {
                                      $Clor_Status = 'green';
                                    }
                                  } //
                                  if ($linha['status'] == 4) {
                                    $s4 = $Ordens_Finalizadas[$i]['DT_ENTRADA_PRE_IMP_PROVA'];
                                    if ($s4 != '') {
                                      $sts4_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s4)));
                                      $sts4_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s4)));
                                      $sts4_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s4)));
                                      if ($hoje > $sts4_b) {
                                        $Clor_Status = 'blue';
                                      }
                                      if ($hoje > $sts4_y) {
                                        $Clor_Status = 'yellow';
                                      }
                                      if ($hoje > $sts4_r) {
                                        $Clor_Status = 'red';
                                      }
                                    } else {
                                      $Clor_Status = 'green';
                                    }
                                  } //
                                  if ($linha['status'] == 5) {
                                    $s5 = $Ordens_Finalizadas[$i]['DT_ENTG_PROVA'];
                                    if ($s5 != '') {
                                      $sts5_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s5)));
                                      $sts5_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s5)));
                                      $sts5_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s5)));
                                      if ($hoje > $sts5_b) {
                                        $Clor_Status = 'blue';
                                      }
                                      if ($hoje > $sts5_y) {
                                        $Clor_Status = 'yellow';
                                      }
                                      if ($hoje > $sts5_r) {
                                        $Clor_Status = 'red';
                                      }
                                    } else {
                                      $Clor_Status = 'green';
                                    }
                                  } //
                                  if ($linha['status'] == 6) {
                                    $s6 = $Ordens_Finalizadas[$i]['data_ent_offset'];
                                    if ($s6 != '') {
                                      $sts6_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s6)));
                                      $sts6_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s6)));
                                      $sts6_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s6)));
                                      if ($hoje > $sts6_b) {
                                        $Clor_Status = 'blue';
                                      }
                                      if ($hoje > $sts6_y) {
                                        $Clor_Status = 'yellow';
                                      }
                                      if ($hoje > $sts6_r) {
                                        $Clor_Status = 'red';
                                      }
                                    } else {
                                      $Clor_Status = 'green';
                                    }
                                  } //
                                  if ($linha['status'] == 7) {
                                    $s7 = $Ordens_Finalizadas[$i]['DT_ENT_DIGITAL'];
                                    if ($s7 != '') {
                                      $sts7_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s7)));
                                      $sts7_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s7)));
                                      $sts7_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s7)));
                                      if ($hoje > $sts7_b) {
                                        $Clor_Status = 'blue';
                                      }
                                      if ($hoje > $sts7_y) {
                                        $Clor_Status = 'yellow';
                                      }
                                      if ($hoje > $sts7_r) {
                                        $Clor_Status = 'red';
                                      }
                                    } else {
                                      $Clor_Status = 'green';
                                    }
                                  } //
                                  if ($linha['status'] == 8) {
                                    $s8 = $Ordens_Finalizadas[$i]['data_ent_tipografia'];
                                    if ($s8 != '') {
                                      $sts8_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s8)));
                                      $sts8_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s8)));
                                      $sts8_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s8)));
                                      if ($hoje > $sts8_b) {
                                        $Clor_Status = 'blue';
                                      }
                                      if ($hoje > $sts8_y) {
                                        $Clor_Status = 'yellow';
                                      }
                                      if ($hoje > $sts8_r) {
                                        $Clor_Status = 'red';
                                      }
                                    } else {
                                      $Clor_Status = 'green';
                                    }
                                  } //
                                  if ($linha['status'] == 9) {
                                    $s9 = $Ordens_Finalizadas[$i]['data_ent_acabamento'];
                                    if ($s9 != '') {
                                      $sts9_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s9)));
                                      $sts9_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s9)));
                                      $sts9_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s9)));
                                      if ($hoje > $sts9_b) {
                                        $Clor_Status = 'blue';
                                      }
                                      if ($hoje > $sts9_y) {
                                        $Clor_Status = 'yellow';
                                      }
                                      if ($hoje > $sts9_r) {
                                        $Clor_Status = 'red';
                                      }
                                    } else {
                                      $Clor_Status = 'green';
                                    }
                                  } //
                                  if ($linha['status'] == 10) {
                                    $s10 = $Ordens_Finalizadas[$i]['DT_ENVIADO_EXPEDICAO'];
                                    if ($s10 != '') {
                                      $sts10_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s10)));
                                      $sts10_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s10)));
                                      $sts10_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s10)));
                                      if ($hoje > $sts10_b) {
                                        $Clor_Status = 'blue';
                                      }
                                      if ($hoje > $sts10_y) {
                                        $Clor_Status = 'yellow';
                                      }
                                      if ($hoje > $sts10_r) {
                                        $Clor_Status = 'orange';
                                      }
                                    } else {
                                      $Clor_Status = 'green';
                                    }
                                  } //

                                  if ($linha['status'] == 14) {
                                    $s14 = $Ordens_Finalizadas[$i]['DT_ENTRADA_CTP'];
                                    if ($s14 != '') {
                                      $sts14_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s14)));
                                      $sts14_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s14)));
                                      $sts14_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s14)));
                                      if ($hoje > $sts14_b) {
                                        $Clor_Status = 'blue';
                                      }
                                      if ($hoje > $sts14_y) {
                                        $Clor_Status = 'yellow';
                                      }
                                      if ($hoje > $sts14_r) {
                                        $Clor_Status = 'red';
                                      }
                                    } else {
                                      $Clor_Status = 'green';
                                    }
                                  } //
                                  if ($linha['status'] == 15) {
                                    $s15 = $Ordens_Finalizadas[$i]['DT_ENTG_PROVA'];
                                    if ($s15 != '') {
                                      $sts15_b =  date('Y-m-d', strtotime('+' . $a2_b . 'day', strtotime($s15)));
                                      $sts15_y = date('Y-m-d', strtotime('+' . $a2_y . 'day', strtotime($s15)));
                                      $sts15_r = date('Y-m-d', strtotime('+' . $a2_r . 'day', strtotime($s15)));
                                      //  echo $s15 .'<br>'. $sts15_b .'<br>';
                                      if ($hoje > $sts15_b) {
                                        //   echo 'maior';
                                        $Clor_Status = 'blue';
                                      }
                                      if ($hoje > $sts15_y) {
                                        $Clor_Status = 'yellow';
                                      }
                                      if ($hoje > $sts15_r) {
                                        $Clor_Status = 'red';
                                      }
                                    } else {
                                      $Clor_Status = 'green';
                                    }
                                  }
                                  if ($linha['status'] == 12) {
                                    $Clor_Status = 'White';
                                  }
                                  if ($linha['status'] == 13) {
                                    $Clor_Status = 'White';
                                  }
                                  if ($linha['status'] == 11) {
                                    $Clor_Status = 'White';
                                  }
                                }
                              } else {
                              }

                              if (isset($Clor_Status)) {
                                $colorido[$i] = [
                                  'cor' => $Clor_Status
                                ];
                              } else {
                                $colorido[$i] = [
                                  'cor' => 'White'
                                ];
                              }

                              $i++;
                            }
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
                              if ($_GET['Tp'] == 'oper') {
                                echo "<tr><td colspan='8'>Operador Encontrado: " . $Ordens_Finalizadas[0]['op_secao'] . " </td></tr>";
                              }
                            }

                            $tr = '<tr>';
                            while ($Total_Finalizadas > $Percorrer_Finalizadas) {
                              if ($Percorrer_Finalizadas == 0) {
                                if (isset($_GET['cores'])) {
                                  if ($colorido[$Percorrer_Finalizadas]['cor'] == 'White' || $colorido[$Percorrer_Finalizadas]['cor'] == 'yellow') {
                                    $tr = '<tr style="color: black;" bgcolor="' . $colorido[$Percorrer_Finalizadas]['cor'] . '">';
                                  } else {
                                    $tr = '<tr style="color: white;" bgcolor="' . $colorido[$Percorrer_Finalizadas]['cor'] . '">';
                                  }
                                }
                                $relatorio = $tr .
                                  '<td data-nome="codOpJs">' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['cod'] . '</td>' .
                                  '<td>' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['orcamento_base'] . '</td>' .
                                  '<td>' . $Tabela_Quantidade[$Percorrer_Finalizadas]['quantidade'] . '</td>' .
                                  '<td>' . date('d/m/Y', strtotime($Ordens_Finalizadas[$Percorrer_Finalizadas]['data_emissao'])) . '</td>' .
                                  '<td>' . date('d/m/Y', strtotime($Ordens_Finalizadas[$Percorrer_Finalizadas]['data_entrega'])) . '</td>' .
                                  '<td>' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['status'] . ' - ' . $Ordens_Finalizadas[$Percorrer_Finalizadas]["STS_DESCRICAO"] . ' </td>' .
                                  '<td>' . $Tabela_Produtos_Finalizados[$Percorrer_Finalizadas]['descricao'] . '</td>
                                  <td>
                                  <div class="">
                                  <a class="btn rounded-pill btn-info " id="pesquisarOp" href="../producao/tl-controle-op.php?cod=' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['cod'] . '"><i class="bx bx-edit-alt me-1"></i> Selecionar</a>
                              </div>
                                  </td>
                                  </tr>';
                              } else {
                                if (isset($_GET['cores'])) {
                                  if ($colorido[$Percorrer_Finalizadas]['cor'] == 'White' || $colorido[$Percorrer_Finalizadas]['cor'] == 'yellow') {
                                    $tr = '<tr style="color: black;" bgcolor="' . $colorido[$Percorrer_Finalizadas]['cor'] . '">';
                                  } else {
                                    $tr = '<tr style="color: white;" bgcolor="' . $colorido[$Percorrer_Finalizadas]['cor'] . '">';
                                  }
                                }
                                $relatorio = $relatorio . $tr .
                                  '<td data-nome="codOpJs">' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['cod'] . '</td>' .
                                  '<td>' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['orcamento_base'] . '</td>' .
                                  '<td>' . $Tabela_Quantidade[$Percorrer_Finalizadas]['quantidade'] . '</td>' .
                                  '<td>' . date('d/m/Y', strtotime($Ordens_Finalizadas[$Percorrer_Finalizadas]['data_emissao'])) . '</td>' .
                                  '<td>' . date('d/m/Y', strtotime($Ordens_Finalizadas[$Percorrer_Finalizadas]['data_entrega'])) . '</td>' .
                                  '<td>' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['status'] . ' - ' . $Ordens_Finalizadas[$Percorrer_Finalizadas]["STS_DESCRICAO"] . ' </td>' .
                                  '<td>' . $Tabela_Produtos_Finalizados[$Percorrer_Finalizadas]['descricao'] . '</td>
                                  <td>
                                    <div class="">
                                      <a class="btn rounded-pill btn-info" id="pesquisarOp" href="../producao/tl-controle-op.php?cod=' . $Ordens_Finalizadas[$Percorrer_Finalizadas]['cod'] . '"><i class="bx bx-edit-alt me-1"></i> Selecionar</a>
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
                   <!-- Final da Tabela de Produção -->
                   <!-- Import dos Contadores em JavaScript -->

                   <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>
                   <script>
                     new PureCounter();
                   </script>