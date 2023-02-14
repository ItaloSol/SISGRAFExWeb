<?php /* |-=!  !--! */ include_once("../html/../html/navbar.php");
$_SESSION["pag"] = array(1, 0);
$hoje = date('Y-m-d'); ?>
<div class=" relatorio-- "></div>
<div class="col-xxl">
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Relatórios - Financeiro</h5>
    </div>
    <form target="_blank" action="relatorio_financeiro.php" method="POST">
      <div class="card-body">
        <div class="mb-3 row">
        </div>
        <div class="form-check mt-3">
          <input class="form-check-input" type="radio" name="periodo" value="entreate" id="IncFimEmiss" />
          <label class="form-check-label" for="IncFimEmiss">Insira um Valor de Crédito</label>
        </div>
        <div class="mb-3 row">
          <label for="html5-date-input" class="col-md-2 col-form-label">Entre</label>
          <div class="col-md-10">
            <input class="form-control" name="entre" type="number" id="html5-date-input" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="html5-date-input" class="col-md-2 col-form-label">Até</label>
          <div class="col-md-10">
            <input class="form-control" name="ate" type="number" id="html5-date-input" />
          </div>
        </div>
        <hr>
        <div class="mb-3 row">
        </div>
        <div class="form-check mt-3">
          <input class="form-check-input" type="radio" name="periodo" value="maior" id="IncFimEmiss" />
          <label class="form-check-label" for="IncFimEmiss">Por Valor de Crédito Maior que</label>
        </div>
        <div class="mb-3 row">

          <div class="col-md-10">
            <input class="form-control" name="vlrmaior" type="number" id="html5-date-input" />
          </div>
        </div>
        <hr>
        <div class="mb-3 row">
        </div>
        <div class="form-check mt-3">
          <input class="form-check-input" type="radio" name="periodo" value="menor" id="IncFimEmiss" />
          <label class="form-check-label" for="IncFimEmiss"> Por Valor de Crédito Menor que</label>
        </div>
        <div class="mb-3 row">

          <div class="col-md-10">
            <input class="form-control" name="vlrmenor" type="number" id="html5-date-input" />
          </div>
        </div>
        <hr>
        <div class="mb-3 row">
        </div>
        <div class="form-check mt-3">
          <input class="form-check-input" type="radio" name="periodo" value="igual" id="IncFimEmiss" />
          <label class="form-check-label" for="IncFimEmiss">Por Valor de Crédito igual à</label>
        </div>
        <div class="col-md-10">
          <input class="form-control" name="vlrigual" type="number" id="html5-date-input" />
        </div>
        <hr>
        <div class="form-check mt-3">
          <input class="form-check-input" type="radio" name="periodo" value="diferente" id="IncFimEmiss" />
          <label class="form-check-label" for="IncFimEmiss">Por Valor de Crédito Diferente de</label>

        </div>

        <div class="col-md-10">
          <input class="form-control" name="vlrdiferente" type="number" id="html5-date-input" />
        </div>
        <hr>
        <div class="form-check mt-3">
          <input class="form-check-input" type="radio" name="periodo" value="entreate" id="IncFimEmiss" />
          <label class="form-check-label" for="IncFimEmiss">Por data</label>
        </div>
        <div class="mb-3 row">
          <label for="html5-date-input" class="col-md-2 col-form-label">Data</label>
          <div class="col-md-10">
            <input class="form-control" name="data_selecionada" type="date" value="<?= $hoje ?>" id="html5-date-input" required />
          </div>
        </div>
        <hr>
        <div class="form-check mt-3">
          <input class="form-check-input" name="ANO" type="radio" value="anointerio" id="Ano Inteiro" />
          <label class="form-check-label" for="Ano Inteiro">Ano Inteiro</label><br>
        </div>
        <div class="form-check mt-3">
          <input class="form-check-input" name="ordenar" type="radio" value="Crescente" id="Ordenar Por Saldo Crescente" />
          <label class="form-check-label" for="Ordenar Por Saldo Crescente">Ordenar Por Saldo Crescente</label>
        </div>
        <div class="form-check mt-3">
          <input class="form-check-input" name="orientacao" type="radio" value="paisagem" id="Orientação Paisagem" checked />
          <label class="form-check-label" for="Orientação Paisagem">Orientação Paisagem</label>
        </div>
        <div class="form-check mt-3">
          <input class="form-check-input" name="orientacao" type="radio" value="Retrato" id="Orientação Retrato" required />
          <label class="form-check-label" for="Orientação Retrato">Orientação Retrato</label>
        </div>
        <hr>
        <div class="form-check mt-3">
          <input class="form-check-input" name="tipo_cliente" type="radio" value="tipo_cliente" id="Tipo de Cliente" required />
          <label class="form-check-label" for="Tipo de Cliente">Tipo de Cliente</label>
        </div>
        <div class="mb-3">
          <select class="form-select" name="tipocliente">
            <option value="2">Selecione o tipo de cliente</option>
            <option value="1">Pessoa Física</option>
            <option value="2">Pessoa Júridica</option>
          </select><br>
          <hr>
          <!-- <button type="submit" name="submit" class="btn btn-info">Gerar Relatório</button> -->
        </div><br><br>
        <br>


      </div>

  </div>
  </form>
</div>
</div>
</div>


<?php /* |-=!  !--! */ include_once("../html/../html/navbar-dow.php"); ?>