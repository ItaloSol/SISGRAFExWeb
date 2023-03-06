<style>
  .teste {
    position: absolute;
    z-index: 99999;
    margin-left: 20px;
    top: -100px;
    /* display: flex; */
    /* display: none; */
    align-items: center;
    justify-content: center;
    text-align: center;
    height: 800px;
    width: 1050px;
    padding: 5px;
  }

  .botao {
    width: 100%;
  }

  .colorbranca {
    color: black;
  }
</style>
<?php
$query_papel = $conexao->prepare("SELECT * FROM tabela_papeis ORDER BY cod DESC");
$query_papel->execute();
$p = 0;
while ($linha = $query_papel->fetch(PDO::FETCH_ASSOC)) {
  $papel[$p] = [
    'cod' => $linha['cod'],
    'descricao' => $linha['descricao'],
    'medida' => $linha['medida'],
    'gramatura' => $linha['gramatura'],
    'formato' => $linha['formato'],
    'uma_face' => $linha['uma_face'],
    'unitario' => $linha['unitario'],
  ];
  $p++;
}
?>
<div id="selecionar-papel">
  <button @click.prevent="papel = !papel" type="button" class="btn botao btn-secondary">

    SELECIONAR PAPEL
  </button>

  <div :style="{display: papelMod}" class="card teste">
    <div class="row">
      <button class="btn btn-danger m-4" @click.prevent="papel = !papel">Fechar</button @cli>
      <div class="col-4">
        <div class="mb-3">
          <label class="form-label colorbranca" for="basic-default-phone">DESCRIÇÃO</label>
          <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="NOME PAPEL" />
        </div>
        <div class="mb-3">
          <label class="form-label colorbranca" for="basic-default-phone">LARGURA</label>
          <input type="number" id="basic-default-phone" class="form-control phone-mask" placeholder="0" />
        </div>
        <div class="mb-3">
          <label class="form-label colorbranca" for="basic-default-phone">ALTURA</label>
          <input type="number" id="basic-default-phone" class="form-control phone-mask" placeholder="0" />
        </div>
        <div class="mb-3">
          <label class="form-label colorbranca" for="basic-default-phone">GRAMATURA</label>
          <input type="number" id="basic-default-phone" class="form-control phone-mask" placeholder="0" />
        </div>
        <div class="mb-3">
          <label class="form-label colorbranca" for="basic-default-phone">FORMATO</label>
          <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="0" />
        </div>
        <div class="mb-3">
          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
          <label class="form-check-label" for="defaultCheck1"> UMA FACE? </label>
        </div>
        <div class="mb-3">
          <label class="form-label colorbranca" for="basic-default-phone">VALOR UNITÁRIO</label>
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
            <th>DESCRIÇÃO</th>
            <th>MEDIDA</th>
            <th>GRAMATURA</th>
            <th>FORMATO</th>
            <th>UMA FACE</th>
            <th>VALOR</th>
            <th>SELECIONAR</th>
          </tr>
          <?php for ($i = 0; $i < $p; $i++) {
            echo '<tr>
          <td>' . $papel[$i]['cod'] . '</td>
          <td>' . $papel[$i]['descricao'] . '</td>
          <td>' . $papel[$i]['medida'] . '</td>
          <td>' . $papel[$i]['gramatura'] . '</td>
          <td>' . $papel[$i]['formato'] . '</td>
          <td>' . $papel[$i]['uma_face'] . '</td>
          <td>' . $papel[$i]['unitario'] . '</td>
          <td><input type="checkbox"></td>
        </tr>';
          } ?>

        </table>
      </div>
    </div>
  </div>
</div>
<script>
  vue = new Vue({
    el: '#selecionar-papel',
    data: {
      papel: false,
      papelMod: 'none',
    },
    watch: {
      papel() {
        if (this.papel) {
          this.DesativarpapelMod()
        } else {
          this.AtivarpapelMod()
        }
      }
    },
    methods: {
      AtivarpapelMod() {
        this.papelMod = 'flex';
      },
      DesativarpapelMod() {
        this.papelMod = 'none';
      }
    },
    created() {
      this.papel = true;
    }
  })
</script>