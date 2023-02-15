<style>
  .teste {
    position: absolute;
    z-index: 99999;
    margin-left: 20px;
    top: -100px;
    /* display: flex; */
    display: none;
    align-items: center;
    justify-content: center;
    text-align: center;
    height: 800px;
    width: 1050px;
    background-color: blue;
    padding: 5px;
  }

  .colorbranca {
    color: white;
  }
</style>
<?php
$query_acabamento = $conexao->prepare("SELECT * FROM acabamentos ORDER BY CODIGO DESC");
$query_acabamento->execute();
$a = 0;
while ($linha = $query_acabamento->fetch(PDO::FETCH_ASSOC)) {
  $acabamento[$a] = [
    'CODIGO' => $linha['CODIGO'],
    'MAQUINA' => $linha['MAQUINA'],
    'ATIVA' => $linha['ATIVA'],
    'CUSTO_HORA' => $linha['CUSTO_HORA'],
  ];
  $a++;
}
?>
<div class="teste">
  <div class="row">
    <div class="col-4">
      <div class="mb-3">
        <label class="form-label colorbranca" for="basic-default-phone">NOME DA MÁQUINA</label>
        <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="NOME MÁQUINA" />
      </div>
      <div class="mb-3">
        <label class="form-label colorbranca" for="basic-default-phone">CUSTO HORA</label>
        <input type="number" id="basic-default-phone" class="form-control phone-mask" placeholder="0" />
      </div>

      <div class="mb-3">
        <button class="btn rounded-pill btn-success">CADASTRAR</button>
      </div>
    </div>
    <div style="height: 700px; width: 66%; overflow-y: scroll; " class="m-0 p-0 col-6">
      <table class="colorbranca table table-sm table-houver">
        <tr>
          <th>CODIGO</th>
          <th>MÁQUINA</th>
          <th>ATIVA</th>
          <th>CUSTO HORA</th>
          <th>SELECIONAR</th>
        </tr>
        <?php for ($i = 0; $i < $a; $i++) {
          echo '<tr>
          <td>' . $acabamento[$i]['CODIGO'] . '</td>
          <td>' . $acabamento[$i]['MAQUINA'] . '</td>
          <td>' . $acabamento[$i]['ATIVA'] . '</td>
          <td>' . $acabamento[$i]['CUSTO_HORA'] . '</td>
          <td><input type="checkbox"></td>
        </tr>';
        } ?>

      </table>
    </div>
  </div>
</div>