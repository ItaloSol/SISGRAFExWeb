<?php
$query_ordens_Semanal = $conexao->prepare("SELECT * FROM tabela_ordens_producao o INNER JOIN sts_op s ON o.`status` = s.CODIGO ORDER BY o.data_entrega DESC ");
$query_ordens_Semanal->execute();
$i = 0;
$Atrasada_Do_OP = 0;
$Total_Semanal = 0;
$Em_Nome_Op = 0;
$Percorrer_Semanal = 0;
$hoje_Semanal_Base = date('Y-m-d');
$hoje_Semanal_Inicio = date('Y-m-d', strtotime('-' . 1 . 'day', strtotime($hoje_Semanal_Base)));
$hoje_Semanal_Final = date('Y-m-d', strtotime('+' . 2 . 'day', strtotime($hoje_Semanal_Base)));
$Entregues_Em_Op = 0;
while ($linha = $query_ordens_Semanal->fetch(PDO::FETCH_ASSOC)) {

  if ($linha['data_entrega'] <= $hoje_Semanal_Final  && $linha['data_entrega'] >= $hoje_Semanal_Inicio) {
    $Pesquisa_Produto = $linha['cod_produto'];
    $Tipo_Produto =  $linha['tipo_produto'];
    $Pesquisa_Cliente = $linha['cod_cliente'];
    $Tipo_Cliente =  $linha['tipo_cliente'];
    $Ordens_Semanal[$Total_Semanal] = [
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
    if ($Tipo_Produto == '2') {
      $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos_pr_ent  WHERE CODIGO = '$Pesquisa_Produto'");
      $query_PRODUTOS->execute();

      while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
        $Tabela_Produtos_Semanal[$Total_Semanal] = [
          'descricao' => $linha2['DESCRICAO']
        ];
      }
    }
    if ($Tipo_Produto == '1') {
      $query_PRODUTOS = $conexao->prepare("SELECT * FROM produtos  WHERE CODIGO = '$Pesquisa_Produto'");
      $query_PRODUTOS->execute();

      while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
        $Tabela_Produtos_Semanal[$Total_Semanal] = [
          'descricao' => $linha2['DESCRICAO']
        ];
      }
    }
    if ($Tipo_Cliente == '2') {
      $query_PRODUTOS = $conexao->prepare("SELECT * FROM tabela_clientes_juridicos  WHERE cod = '$Pesquisa_Cliente'");
      $query_PRODUTOS->execute();

      while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
        $Tabela_Clientes_Semanal[$Total_Semanal] = [
          'nome' => $linha2['nome']
        ];
      }
    }
    if ($Tipo_Cliente == '1') {
      $query_PRODUTOS = $conexao->prepare("SELECT * FROM tabela_clientes_fisicos  WHERE cod = '$Pesquisa_Cliente'");
      $query_PRODUTOS->execute();

      while ($linha2 = $query_PRODUTOS->fetch(PDO::FETCH_ASSOC)) {
        $Tabela_Clientes_Semanal[$Total_Semanal] = [
          'nome' => $linha2['nome']
        ];
      }
    }

    $Total_Semanal++;
  }
}
?>
<!-- Carossel -->
<div class="row">

  <div class="col-md-8">
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
      <ol class="carousel-indicators">
        <li data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#carouselExample" data-bs-slide-to="1"></li>
        <li data-bs-target="#carouselExample" data-bs-slide-to="2"></li>
        <li data-bs-target="#carouselExample" data-bs-slide-to="3"></li>
        <li data-bs-target="#carouselExample" data-bs-slide-to="4"></li>
        <li data-bs-target="#carouselExample" data-bs-slide-to="5"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="../img/agenda.jpg" alt="First slide" />
          <div class="carousel-caption d-none d-md-block">
            <h3>Agenda Permanente</h3>
            <p></p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="../img/banner.jpg" alt="Second slide" />
          <div class="carousel-caption d-none d-md-block">
            <h3>Banner</h3>
            <p< /p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="../img/cartao.jpg" alt="Third slide" />
          <div class="carousel-caption d-none d-md-block">
            <h3>Cartão de Visita</h3>
            <p></p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="../img/pasta_alteracao.png" alt="Third slide" />
          <div class="carousel-caption d-none d-md-block">
            <h3>Pasta de Alteração</h3>
            <p></p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="../img/prisma_mesa.png" alt="Third slide" />
          <div class="carousel-caption d-none d-md-block">
            <h3>Prisma de Mesa</h3>
            <p></p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="../img/despacho.png" alt="Third slide" />
          <div class="carousel-caption d-none d-md-block">
            <h3>Pasta de Despacho</h3>
            <p></p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </a>

    </div>
  </div>
  <!-- Transactions -->
  <div class="col-md-6 col-lg-4 order-2 mb-4">
    <div id="corpo" class="dashboard" class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">OPs a serem entregues <span class="enfase-dashboard">Esta Semana!</span></h5>
        <div class="dropdown">
        </div>
      </div>
      <div class="card-body">
        <ul class="p-0 m-0">
          <hr class="linha-dashboard">
          <?php /* |||   */
          while ($Total_Semanal > $Percorrer_Semanal) {
            echo '<li class="d-flex mb-4 pb-1">
                       
                         <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                           <div class="me-2">
                           <h6 class="mb-0">' . $Tabela_Clientes_Semanal[$Percorrer_Semanal]['nome'] . '</h6>
                           <small class="text-muted d-block mb-1">Produto: ' . $Tabela_Produtos_Semanal[$Percorrer_Semanal]['descricao'] . '</small>
                             <h6 class="mb-0">Cod OP: ' . $Ordens_Semanal[$Percorrer_Semanal]['cod'] . '</h6>
                           </div>
                           <div class="user-progress d-flex align-items-center gap-1">
                           <span class="text-muted">Data de Entrega</span>
                             <h6 class="mb-0">' . date('d/m/Y', strtotime($Ordens_Semanal[$Percorrer_Semanal]['data_entrega'])) . '</span></h6>
                           </div>
                         </div>
                       </li>
                       <hr class="linha-dashboard"';
            $Percorrer_Semanal++;
          }
          ?>

        </ul>
      </div>
    </div>
  </div>
  <!--/ Order Statistics -->
</div>
</div>
<!-- Final da Tabela de Produção -->

<!-- Script de Scroll e Refresh de página -->
<script>
  $().ready(function() {
    $("#corpo").animate({
      scrollTop: 500
    }, 50000);
  });
  setTimeout(function() {
    window.location.reload(1);
  }, 35000); // 3 minutos
</script>

<!-- Import dos Contadores em JavaScript -->

<script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>
<script>
  new PureCounter();
</script>
<script>
  // import PureCounter from "@srexi/purecounterjs";
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