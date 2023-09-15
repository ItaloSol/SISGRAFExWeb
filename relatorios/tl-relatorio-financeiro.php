<?php /* |-=!  !--! */ include_once("../html/../html/navbar.php");
$_SESSION["pag"] = array(1, 0);
$hoje = date('Y-m-d'); 
$ano = date('Y');
$mes = date('m');
?>
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
            <input class="form-control" name="entre" type="number" placeholder="10" id="html5-date-input" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="html5-date-input" class="col-md-2 col-form-label">Até</label>
          <div class="col-md-10">
            <input class="form-control" name="ate" type="number" placeholder="200" id="html5-date-input" />
          </div>
        </div>
        <hr>
        <div class="mb-3 row">
        </div>
        <div class="form-check mt-3">
          <input class="form-check-input" type="radio" name="periodo" value="maior" id="maior" />
          <label class="form-check-label" for="maior">Por Valor de Crédito Maior que</label>
        </div>
        <div class="mb-3 row">

          <div class="col-md-10">
            <input class="form-control" name="vlrmaior" placeholder="100" type="number" id="html5-date-input" />
          </div>
        </div>
        <hr>
        <div class="mb-3 row">
        </div>
        <div class="form-check mt-3">
          <input class="form-check-input" type="radio" name="periodo" value="menor" id="menor" />
          <label class="form-check-label" for="menor"> Por Valor de Crédito Menor que</label>
        </div>
        <div class="mb-3 row">

          <div class="col-md-10">
            <input class="form-control" name="vlrmenor" placeholder="500" type="number" id="html5-date-input" />
          </div>
        </div>
        <hr>
        <div class="mb-3 row">
        </div>
        <div class="form-check mt-3">
          <input class="form-check-input" type="radio" name="periodo" value="igual" id="igual" />
          <label class="form-check-label" for="igual">Por Valor de Crédito igual à</label>
        </div>
        <div class="col-md-10">
          <input class="form-control" name="vlrigual" placeholder="300" type="number" id="html5-date-input" />
        </div>
        <hr>
        <div class="form-check mt-3">
          <input class="form-check-input" type="checkbox" checked name="diferente" value="vlrdiferente" id="diferente" />
          <label class="form-check-label" for="diferente">Ocultar valor zero 0</label>
        </div>
        <hr>
        <div class="form-check mt-3">
        <input class="form-check-input" name="pordata" type="radio" value="mes" id="mes" />
          <label class="form-check-label"  for="mes">Selecione um mês e o ano:</label>
          <select class="form-control" id="umadata" name="umadata">
            <option value="1">Janeiro</option>
            <option value="2">Fevereiro</option>
            <option value="3">Março</option>
            <option value="4">Abril</option>
            <option value="5">Maio</option>
            <option value="6">Junho</option>
            <option value="7">Julho</option>
            <option value="8">Agosto</option>
            <option value="9">Setembro</option>
            <option value="10">Outubro</option>
            <option value="11">Novembro</option>
            <option value="12">Dezembro</option>
          </select>
          <input type="number" id="ano/mes" class="form-control col-1" name="ano/mes" value="<?= $ano ?>" min="2000" max="<?= $ano ?>" step="1" placeholder="Ano">
        </div>
        <hr>
        <div class="form-check mt-3">
          <input class="form-check-input" name="pordata" checked type="radio" value="anointerio" id="Ano Inteiro" />
          <label class="form-check-label" for="Ano Inteiro">Ano Inteiro</label><br>
          <input type="number" id="ano" class="form-control col-1" name="ano" value="<?= $ano ?>" min="2000" max="<?= $ano ?>" step="1" placeholder="Ano">
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
        <label class="form-check-label" for="Tipo de Cliente">Tipo de Cliente</label>
          
        </div>
        <div class="form-check mt-3">
        <input class="form-check-input" name="tipo_cliente" checked type="radio" value="2" id="Tipo de Cliente" required />
          <label class="form-check-label" for="Tipo de Cliente">Juridico</label>
          </div>
          <div class="form-check mt-3">
          <input class="form-check-input" name="tipo_cliente" type="radio" value="1" id="Tipo de Cliente" required />
          <label class="form-check-label" for="Tipo de Cliente">Fisico</label>
          </div>
        <div class="mb-3">
          <button type="submit" name="submit" class="btn btn-info">Gerar Relatório</button>
        </div><br><br>
        <br>


      </div>

  </div>
  </form>
</div>
</div>
</div>


<?php /* |-=!  !--! */ include_once("../html/../html/navbar-dow.php"); ?>