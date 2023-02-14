<!-- Modal -->
<div class="modal fade" id="paprod" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Enviar para produção</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <form action="b-update.php?acao=2&cod=<?= $cod_orcamento ?>" method="POST">
              <label for="nameBasic" class="form-label">Descrição</label>
              <textarea name="obs" class="form-control" placeholder="Adicione uma Descrição Principal"></textarea>
          </div>
        </div>
        <input type="hidden" name="cliente" value="<?= $Orcamento_pesquisa['cod_cliente'] ?>">
        <input type="hidden" name="tipocliente" value="<?= $Orcamento_pesquisa['tipo_cliente'] ?>">
        <input type="hidden" name="endereco" value="<?= $Orcamento_pesquisa['cod_endereco'] ?>">
        <input type="hidden" name="contato" value="<?= $Orcamento_pesquisa['cod_contato'] ?>">
        <div class="row g-2">
          <div class="col mb-0">
            <label for="data" class="form-label">Data de Prova</label>
            <input type="date" id="data" name="data" class="form-control" required />
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Sair
        </button>
        <button type="submit" class="btn btn-primary">Enviar para produção</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="paraexp" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Enviar para expedição</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <form action="b-update.php?acao=7&cod=<?= $cod_orcamento ?>" method="POST">
              <label for="nameBasic" class="form-label">Descrição</label>
              <textarea name="obs" class="form-control" placeholder="Adicione uma Descrição Principal"></textarea>
          </div>
        </div>
        <input type="hidden" name="cliente" value="<?= $Orcamento_pesquisa['cod_cliente'] ?>">
        <input type="hidden" name="tipocliente" value="<?= $Orcamento_pesquisa['tipo_cliente'] ?>">
        <input type="hidden" name="endereco" value="<?= $Orcamento_pesquisa['cod_endereco'] ?>">
        <input type="hidden" name="contato" value="<?= $Orcamento_pesquisa['cod_contato'] ?>">
        <div class="row g-2">
          <div class="col mb-0">
            <label for="data" class="form-label">Data de Entrega</label>
            <input type="date" id="data" name="data" class="form-control" required />
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Sair
        </button>
        <button type="submit" class="btn btn-primary">Enviar para expedição</button>
        </form>
      </div>
    </div>
  </div>
</div>