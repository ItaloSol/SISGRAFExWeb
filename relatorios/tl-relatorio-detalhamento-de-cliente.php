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

        <input class="form-check-input" name="codigo" type="hidden" value="cod" />
        <div>
                <div>
                  <div class="modal-content">
                   
                    <div class="modal-body">
                      <div class="row">
                        <div class="mb-3">
                           <label class="form-check-label" name="codigo" value="cod" for="defaultCheck1"> Tipo de Cliente </label>
                            <select class="form-select" name="tipo_cliente" id="cliente" aria-label="Default select example">
                              <option selected>Selecione o tipo de cliente</option>
                              <option value="1">Pessoa Física</option>
                              <option value="2">Pessoa Júridica</option>
                            </select>
                        </div>
                        <div class="mb-3">

                          <div id="juri" class="mb-3">
                            <input name="usuario0" id="usuario0" class="form-control" type="text" placeholder="Digite o NOME do cliente  juridico" onkeyup="carregar_usuarios(this.value)" />
                            <span id="resultado_pesquisa0"></span>
                            <br>
                            <input name="usuariosigla" id="usuariosigla" class="form-control" type="text" placeholder="Digite a SIGLA cliente  juridico" onkeyup="carregar_sigla(this.value)" />
                            <span id="resultado_sigla"></span>
                          </div>
                          <div id="dis" class="mb-3">
                            <input id="defaultInput" disabled class="form-control" type="text" placeholder="Selecione o tipo de cliente" />
                          </div>
                          <div id="fisc" class="mb-3">
                            <input name="usuario1" id="usuario1" class="form-control" type="text" placeholder="Digite o nome do cliente fisico" onkeyup="carregar_fisico(this.value)" />
                            <input id="codigo1" name="numero" class="form-control" type="text" style="display: none;" placeholder="Digite o código aqui" />
                            <span id="resultador_123"></span>
                          </div>
                          <input id="numerodocliente" name="numerodocliente" class="form-control" type="text"  placeholder="Digite o código aqui" />

                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <script>
        const selectir = document.getElementById('cliente');
        const juri = document.getElementById('juri');
        const dist = document.getElementById('dis');
        const fisc = document.getElementById('fisc');
        fisc.style.display = 'none';
        juri.style.display = 'none';
        selectir.addEventListener('click', vlr => {
          if (selectir.value == 1) {
            fisc.style.display = 'block';
            juri.style.display = 'none';
            dist.style.display = 'none';
          } else {
            fisc.style.display = 'none';
            juri.style.display = 'block';
            dist.style.display = 'none';
          }
        })
      </script>
        <!-- <label class="form-check-label" name="codigo" value="cod" for="defaultCheck1"> Tipo de Cliente </label>
        <div class="mb-3">
          <select class="form-select" name="tipo_cliente" id="cliente" aria-label="Default select example">
            <option selected>Selecione o tipo de cliente</option>
            <option value="1">Pessoa Física</option>
            <option value="2">Pessoa Júridica</option>
          </select>
        </div>
        <div class="form-check mt-3">
          <input class="form-check-input" name="codigo" type="radio" value="cod" id="12" />
          <label class="form-check-label" name="codigo" value="cod" for="12"> Por Código do Cliente </label>
        </div>

        <div class="mb-3">
          <input id="defaultInput" name="numero" class="form-control" type="text" placeholder="Digite o código aqui" />
        </div>
        <div class="form-check mt-3">
          <input class="form-check-input" name="codigo" type="radio" value="nom" id="23" />
          <label class="form-check-label" value="nom" for="23"> Por Nome </label>
        </div>
        <div id="juri" class="mb-3">
          <input name="usuario0" id="usuario0" class="form-control" type="text" placeholder="Digite o nome do cliente  juridico" onkeyup="carregar_usuarios(this.value)" />
          <input id="codigo" name="numero2" class="form-control" type="hidden" placeholder="Digite o código aqui" />
          <span id="resultado_pesquisa0"></span>
        </div>
        <div id="dis" class="mb-3">
          <input id="defaultInput" disabled class="form-control" type="text" placeholder="Selecione o tipo de cliente" />
        </div>
        <div id="fisc" class="mb-3">
        <input name="usuario1" id="usuario1" class="form-control" type="text" placeholder="Digite o nome do cliente fisico" onkeyup="carregar_fisico(this.value)" />
          <input id="codigo1" name="numero1" class="form-control" type="hidden" placeholder="Digite o código aqui" />
          <span id="resultador_123"></span>
        </div> -->
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
  const dis = document.getElementById('dis');
  const fisc = document.getElementById('fisc');
  fisc.style.display = 'none';
      juri.style.display = 'none';
  select.addEventListener('click', vlr => {
    if(select.value == 1){
      fisc.style.display = 'block';
      juri.style.display = 'none';
      dis.style.display = 'none';
    }else{
      fisc.style.display = 'none';
      juri.style.display = 'block';
      dis.style.display = 'none';
    }
  })
</script>
<script src="../js/custom.js"></script>
<?php /* |-!  !-| */ include_once("../html/../html/navbar-dow.php"); ?>