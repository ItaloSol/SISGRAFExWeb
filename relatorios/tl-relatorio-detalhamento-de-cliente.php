<?php /* |-!  !-| */ include_once("../html/../html/navbar.php");
$_SESSION["pag"] = array(1, 0); ?>
<div class=" relatorio-- "></div>
<div class="col-xxl">
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Relatórios - Detalhamento de Clientes</h5>
    </div>
    <form target="_blank" action="../relatorios/detalhamento_resumido_clientes.php" method="POST">
      <div class="card-body">
        <small class="text-light fw-semibold d-block">Tipo de Relatório:</small>
        <?php /* |-!  !-| */ if ($FIN_I == '1' || $ORD_I == '1') {  ?>
          <div class="form-check form-check-inline mt-3">
            <input class="form-check-input" type="radio" name="relatorio" id="Resumido" value="Resumido" />
            <label class="form-check-label" for="Resumido">Resumido</label>
          </div>
          <div class="form-check form-check-inline mt-3">
            <input class="form-check-input" type="radio" name="relatorio" checked id="Completo" value="Completo" />
            <label class="form-check-label" for="Completo">Completo</label>
          </div>
        <?php /* |-!  !-| */ } else { ?>
          <div class="form-check form-check-inline mt-3">
            <input class="form-check-input" type="radio" name="relatorio" checked id="Resumido" value="Resumido" />
            <input class="form-check-input" type="hidden" name="relatorio" checked id="Resumido" value="Resumido" />
            <label class="form-check-label" for="Resumido">Resumido</label>
          </div>
        <?php /* |-!  !-| */  } ?>
        <br>
        <label class="form-check-label" name="codigo" value="cod" for="defaultCheck1"> Tipo de Cliente </label>
        <div class="mb-3">
          <select class="form-select" name="tipo_cliente" id="cliente" aria-label="Default select example">
            <option selected>Selecione o tipo de cliente</option>
            <option value="1">Pessoa Física</option>
            <option value="2">Pessoa Júridica</option>
          </select>
        </div>
        <div class="form-check mt-3">
          <input class="form-check-input" name="codigo" type="radio" value="cod" id="defaultCheck1" />
          <label class="form-check-label" name="codigo" value="cod" for="defaultCheck1"> Por Código do Cliente </label>
        </div>

        <div class="mb-3">
          <input id="defaultInput" name="numero" class="form-control" type="text" placeholder="Digite o código aqui" />
        </div>
        <div class="form-check mt-3">
          <input class="form-check-input" name="codigo" type="radio" value="nom" id="defaultCheck1" />
          <label class="form-check-label" value="nom" for="defaultCheck1"> Por Nome </label>
        </div>
        <div id="juri" class="mb-3">
          <input id="defaultInput" name="nome" class="form-control" type="text" placeholder="Digite o nome juridico" />
        </div>
        <div id="fisc" class="mb-3">
          <input id="defaultInput" name="nome" class="form-control" type="text" placeholder="Digite o nome fisico" />
        </div>
        <div class="form-check mt-3">
          <!-- <input class="form-check-input" name="orientacao" type="radio" value="retrato"  id="Retrato" />
                              <label class="form-check-label" value="nom"  for="Retrato"> Retrato </label><br> -->
          <div class="col-md">
            <small class="text-light fw-semibold d-block">Orientação:</small>
            <div class="form-check form-check-inline mt-3">
              <input class="form-check-input" type="radio" name="orientacao" checked id="Retrato" value="retarto" />
              <label class="form-check-label" for="Retrato">Retrato</label>
            </div>
            <div class="form-check form-check-inline mt-3">
              <input class="form-check-input" type="radio" name="orientacao" id="paisagem" value="paisagem" />
              <label class="form-check-label" for="paisagem">Paisagem</label>
            </div>

            <!-- <input class="form-check-input" name="orientacao" type="radio" value="paisagem"  id="Paisagem" />
                              <label class="form-check-label" value="nom"  for="Paisagem"> Paisagem </label> -->
          </div>

          <button type="submit" name="submit" class="btn btn-info">Gerar Relatório</button>
        </div>
    </form>
  </div>
</div>
</div>
<script>
  const select = document.getElementById('cliente');
  const juri = document.getElementById('juri');
  const fisc = document.getElementById('fisc');
  fisc.style.display = 'none';
      juri.style.display = 'none';
  select.addEventListener('click', vlr => {
    if(select.value == 1){
      fisc.style.display = 'block';
      juri.style.display = 'none';
    }else{
      fisc.style.display = 'none';
      juri.style.display = 'block';
    }
  })
</script>

<?php /* |-!  !-| */ include_once("../html/../html/navbar-dow.php"); ?>