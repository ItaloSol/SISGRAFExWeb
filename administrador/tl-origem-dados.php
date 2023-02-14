<?php /*   */ include_once("../html/navbar.php");
$_SESSION["pag"] = array(1, 0);
if (isset($_POST['submit'])) {

  $banco = $_POST['banco'];



  echo "Banco trocado com Sucesso!<br>";
  $_SESSION['bd'] = [$banco];
}
if (isset($_SESSION['bd'][0])) {
  if ($_SESSION['bd'][0] == 'bd1') {
    $bd = 'bd1';
  }
  if ($_SESSION['bd'][0] == 'bd2') {
    $bd = 'bd2';
  }
  if ($_SESSION['bd'][0] == 'bd3') {
    $bd = 'bd3';
  }
} else {
  $bd = 'bd1';
}
?>
<div class=" dados-- "></div>
<div class="row">
  <!-- Basic Layout -->
  <div class="accordion mt-3" id="accordionExample">
    <div class="card accordion-item active">
      <h2 class="accordion-header" id="headingOne">
        <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
          Seletor de Origem de Dados
        </button>
      </h2>

      <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <form method="POST" action="tl-origem-dados.php">
            <div class="form-check form-check-inline mt-3">
              <input class="form-check-input" type="radio" name="banco" id="inlineRadio1" value="bd1" <?php /*   */ echo ($bd == 'bd1') ? 'checked' : '' ?> />
              <label class="form-check-label" for="inlineRadio1">Produção</label>
            </div>
            <div class="form-check form-check-inline mt-3">
              <input class="form-check-input" type="radio" name="banco" id="inlineRadio2" value="bd2" <?php /*   */ echo ($bd == 'bd2') ? 'checked' : '' ?> />
              <label class="form-check-label" for="inlineRadio2">Desenvolvimento em Rede</label>
            </div>
            <div class="form-check form-check-inline mt-3">
              <input class="form-check-input" type="radio" name="banco" id="inlineRadio3" value="bd3" <?php /*   */ echo ($bd == 'bd3') ? 'checked' : '' ?> />
              <label class="form-check-label" for="inlineRadio3">Desenvolvimento Local</label>
            </div><br><br>
            <input type="submit" class="btn btn-primary" value="Trocar Banco" name="submit">
          </form>
        </div>
      </div>
    </div>
    <?php


    include_once("../html/navbar-dow.php"); ?>