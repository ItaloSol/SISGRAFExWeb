   <!-- Extra Large Modal -->
   <div class="modal fade" id="exLargeModalProdutos" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-xl" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel4">Selecione um produto</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <!--  aaaaa -->



         <div class="demo-inline-spacing mt-3">
           <div class="list-group list-group-horizontal-md text-md-center">
             <a class="list-group-item list-group-item-action active" id="consulta-produto" data-bs-toggle="list" href="#consulta1-produto">Consulta Produto</a>
             <a class="list-group-item list-group-item-action" id="novo-produto" data-bs-toggle="list" href="#novo1-produto">Novo Produto</a>
           </div>
           <div class="tab-content px-0 mt-0">
             <div class="tab-pane fade show active" id="consulta1-produto">
               <div class="card">
                 <h5 class="card-header">Consulta Produto</h5>
                 <div class="table-responsive text-nowrap">
                   CONSULTA PRODUTOS
                 </div>
               </div>
             </div>
             <!-- novo produto -->
             <div class="tab-pane fade" id="novo1-produto">
               <div class="card">
                 <h5 class="card-header">Novo Produto</h5>
                 <div class="table-responsive text-nowrap">
                   <div class="card-body">
                     <form>

                       <div class="row mb-3">
                         <label class="col-sm-2 col-form-label" for="basic-default-name">TIPO DE PRODUTO</label>
                         <div class="col-sm-10">
                           <input name="TPP" class="form-check-input" type="radio" value="PP" id="PP" />
                           <label class="form-check-label" for="PP"> PRODUÇÃO(PP) </label>
                           <input name="TPP" class="form-check-input" type="radio" value="PE" id="PE" />
                           <label class="form-check-label" for="PE"> PRONTA ENTREGA(PE) </label>
                           <input class="form-check-input" name="commerce" type="checkbox" value="COMMERCE" id="COMMERCE" />
                           <label class="form-check-label" for="COMMERCE"> SERÁ ULTILIZADO NO E-COMMERCE </label>
                           <input class="form-check-input" name="ativo" type="checkbox" value="ATIVO" id="ATIVO" />
                           <label class="form-check-label" for="ATIVO"> ATIVO</label>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <label class="col-sm-2 col-form-label" for="descricao">DESCRIÇÃO DO PRODUTO</label>
                         <div class="col-sm-10">
                           <input type="text" class="form-control" id="descricao" placeholder="DESCRIÇÃO" />
                           <div class="form-text">MÁXIMO 150 CARACTERES</div>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-sm-3">
                           <label class="col-sm-2 col-form-label" for="LARGURA">LARGURA</label>
                           <input type="number" id="largura" class="form-control phone-mask" placeholder="0,0" aria-label="0,0" />
                         </div>
                         <div class="col-sm-3">
                           <label class="col-sm-2 col-form-label" for="ALTURA">ALTURA</label>
                           <input type="number" id="largura" class="form-control phone-mask" placeholder="0,0" aria-label="0,0" />
                         </div>
                         <div class="col-sm-3">
                           <label class="col-sm-2 col-form-label" for="LARGURA">QUANTIDADE FOLHAS</label>
                           <input type="number" value="1" id="largura" class="form-control phone-mask" placeholder="1" aria-label="1" />
                         </div>
                         <div class="col-sm-3">
                           <label class="col-sm-2 col-form-label" for="LARGURA">TIPO</label>
                           <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                             <option desabled>SELECIONE</option>
                             <option value="1">FOLHA</option>
                             <option value="2">BLOCO</option>
                             <option value="3">LIVRO</option>
                           </select>
                         </div>
                       </div>
                       <div class="card">
                         <div class="list-group list-group-horizontal-md text-md-center">
                           <a class="list-group-item list-group-item-action active" id="papeis" data-bs-toggle="list" href="#papeis">PAPEIS</a>
                           <a class="list-group-item list-group-item-action" id="acabamentos" data-bs-toggle="list" href="#acabamentos">ACABAMENTOS</a>
                           <a class="list-group-item list-group-item-action active" id="consulta-produto" data-bs-toggle="list" href="#consulta1-produto">Consulta Produto</a>
                           <a class="list-group-item list-group-item-action" id="novo-produto" data-bs-toggle="list" href="#novo1-produto">Novo Produto</a>
                           <a class="list-group-item list-group-item-action active" id="consulta-produto" data-bs-toggle="list" href="#consulta1-produto">Consulta Produto</a>
                           <a class="list-group-item list-group-item-action" id="novo-produto" data-bs-toggle="list" href="#novo1-produto">Novo Produto</a>
                         </div>
                         <div>teste</div>
                       </div>
                       <br>
                       <div class="row justify-content-end">
                         <div class="col-sm-10">
                           <button type="submit" class="btn btn-primary">SALVAR</button>
                         </div>
                       </div>
                     </form>
                   </div>
                 </div>

                 <!-- Basic with Icons -->
               </div>

             </div>
           </div>
         </div>

         <!-- aaa -->
         <div class="modal-footer">
           <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
             Fechar
           </button>

         </div>
       </div>
     </div>
   </div>