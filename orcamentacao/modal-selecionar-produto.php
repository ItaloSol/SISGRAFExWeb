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
                   <div class="row mb-3">
                     <div class="col-sm-3">
                       <label for="exampleFormControlSelect1" class="form-label">PESQUISAR POR</label>
                       <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                         <option selected>SELECIONE</option>
                         <option value="1">DESCRIÇÃO</option>
                         <option value="2">CODIGO</option>
                       </select>
                     </div>
                     <div class="form-check col-sm-3">
                       <input name="default-radio-1" class="form-check-input" type="radio" value="" id="defaultRadio1" />
                       <label class="form-check-label" for="defaultRadio1"> PRODUÇÃO(PP) </label> <BR>
                       <input name="default-radio-1" class="form-check-input" type="radio" value="" id="defaultRadio2" />
                       <label class="form-check-label" for="defaultRadio2"> PRONTA ENTREGA(PE) </label>
                     </div>
                     <div class="form-check col-sm-5">
                       <div class="input-group">
                         <input type="text" class="form-control" placeholder="DIGITE A SUA BUSCA" aria-label="DIGITE A SUA BUSCA" aria-describedby="button-addon2" />
                         <button class="btn btn-outline-primary" type="button" id="button-addon2">PESQUISAR</button>
                       </div>
                     </div>
                   </div>
                   <?php
                    $query_produtos = $conexao->prepare("SELECT * FROM produtos ORDER BY CODIGO DESC LIMIT 45");
                    $query_produtos->execute();
                    $pr = 0;
                    while ($linha = $query_produtos->fetch(PDO::FETCH_ASSOC)) {
                      $pp[$pr] = [
                        'CODIGO' => $linha['CODIGO'],
                        'DESCRICAO' => $linha['DESCRICAO'],
                      ];
                      $pr++;
                    }
                    ?>
                   <div style="height: 400px; width: 100%; overflow-y: scroll; ">
                     <table class="table table-hover table-sm table-bordered">
                       <tr>
                         <th>CÓDIGO</th>
                         <th>TIPO</th>
                         <th>DESCRIÇÃO</th>
                         <th>VALOR UNITÁRIO</th>
                         <th>ESTOQUE</th>
                         <th>PRÉ-VENDA</th>
                         <th>PROMOÇÃO</th>
                       </tr>
                       <?php
                        for ($i = 0; $i < $pr; $i++) {
                          echo '<tr>
                        <td><a href="#">' . $pp[$i]['CODIGO'] . '</a></td>
                        <td><a href="#">PP</a></td>
                        <td><a href="#">' . $pp[$i]['DESCRICAO'] . '</a></td>
                        </tr>';
                        }
                        ?>
                     </table>
                   </div>
                   <!-- AA -->
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
                       <?php include_once('modal-selecionar-papel.php'); ?>
                       <?php include_once('modal-seleiconar-acabamentos.php'); ?>
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
                           <label class="col-sm-2 col-form-label" for="ESPESSURA">ESPESSURA</label>
                           <input type="number" id="espessura" class="form-control phone-mask" placeholder="0,0" aria-label="0,0" />
                         </div>
                         <div class="col-sm-3">
                           <label class="col-sm-2 col-form-label" for="PESO">PESO</label>
                           <input type="number" id="peso" class="form-control phone-mask" placeholder="0,0" aria-label="0,0" />
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
                           <a class="list-group-item list-group-item-action active" id="papeis" data-bs-toggle="list" href="#papeis1">PAPÉIS</a>
                           <a class="list-group-item list-group-item-action" id="acabamentos" data-bs-toggle="list" href="#acabamentos1">ACABAMENTOS</a>
                           <a class="list-group-item list-group-item-action " id="valores" data-bs-toggle="list" href="#valores1">VALORES</a>
                           <a class="list-group-item list-group-item-action" id="estoque" data-bs-toggle="list" href="#estoque1">ESTOQUE</a>
                           <a class="list-group-item list-group-item-action " id="pedidos" data-bs-toggle="list" href="#pedidos1">PEDIDOS</a>
                         </div>
                         <div class="tab-content px-0 mt-0">
                           <div class="tab-pane fade show active" id="papeis1">

                             <h5 class="card-header">PAPÉIS</h5>



                             <div class="table-responsive text-nowrap">
                               <label class="form-label" for="basic-default-phone">TIPO</label>
                               <select class="form-select">
                                 <option>SELECIONE</option>
                                 <option>CAPA</option>
                                 <option>MIOLO</option>
                                 <option>FOLHA</option>
                                 <option>1° VIA</option>
                                 <option>2° VIA</option>
                                 <option>3° VIA</option>
                               </select>
                               <div class="row">
                                 <div class="col-3">
                                   <label class="form-label " for="basic-default-phone">CORES FRENTE</label>
                                   <input type="number" class="form-control" placeholder="0">
                                 </div>
                                 <div class="col-3">
                                   <label class="form-label" for="basic-default-phone">CORES VERSO</label>
                                   <input type="number" class="form-control" placeholder="0">
                                 </div>
                               </div>
                               <table class="table table-bordered table-hover">
                                 <tr>
                                   <th>CÓDIGO</th>
                                   <th>DESCRIÇÃO</th>
                                   <th>TIPO</th>
                                   <th>ORELHA</th>
                                   <th>CORES FRENTE</th>
                                   <th>CORES VERSO</th>
                                 </tr>
                                 <tr>
                                   <td>cod</td>
                                   <td>des</td>
                                   <td>tp</td>
                                   <td>or</td>
                                   <td>cor</td>
                                   <td>ver</td>
                                 </tr>
                               </table>
                             </div>
                           </div>
                           <div class="tab-pane fade" id="acabamentos1">
                             <h5 class="card-header">ACABAMENTOS</h5>

                             <div class="table-responsive text-nowrap">

                               <table class="table table-bordered table-hover">
                                 <tr>
                                   <th>CÓDIGO</th>
                                   <th>DESCRIÇÃO</th>
                                 </tr>
                                 <tr>
                                   <td>cod</td>
                                   <td>des</td>
                                 </tr>
                               </table>

                             </div>
                           </div>
                           <div class="tab-pane fade" id="valores1">
                             <h5 class="card-header">VALORES</h5>
                             <div class="table-responsive text-nowrap">

                               <label class="form-check-label" for="prev"> PRODUTO PARA PRÉ-VENDA? </label>
                               <input class="form-check-input" name="prev" type="checkbox" value="prevendaS" id="prev" />
                               <div class="row mb-3">
                                 <div class="col-sm-3">
                                   <label class="col-sm-2 col-form-label" for="valorunitario">VALOR UNITÁRIO(R$)</label>
                                   <input type="number" class="form-control" id="valorunitario" placeholder="0,00" />
                                 </div>
                                 <label class="col-sm-2 col-form-label" for="promo">VALOR PROMOCIONAL(R$)</label>
                                 <div class="col-sm-3">
                                   <input class="form-check-input" name="promo" type="checkbox" value="promo" id="promo" />
                                   <input type="number" class="form-control" id="valorpromo" placeholder="0,00" />
                                 </div>
                               </div>

                             </div>
                           </div>
                           <div class="tab-pane fade" id="estoque1">
                             <h5 class="card-header">ESTOQUE</h5>
                             <div class="table-responsive text-nowrap">

                               <div class="mb-3">
                                 <label class="form-label" for="basic-default-fullname">QUANTIDADE NO ESTOQUE FÍSICO</label>
                                 <input type="number" class="form-control" id="qtdestoque" placeholder="0" />
                               </div>
                               <div class="mb-3">
                                 <label class="form-label" for="avisoestoque">AVISO DE ESTOQUE?<input class="form-check-input" name="avisoestoque" type="checkbox" value="avisoestoque" id="avisoestoque" /> </label>
                                 <input type="number" class="form-control" id="qtdaviso" placeholder="0" />
                               </div>

                             </div>
                           </div>
                           <div class="tab-pane fade" id="pedidos1">
                             <h5 class="card-header">PEDIDOS</h5>
                             <div class="table-responsive text-nowrap">

                               <div class="mb-3">
                                 <label class="form-label" for="basic-default-fullname">QUANTIDADE MÍNIMA</label>
                                 <input type="number" class="form-control" id="qtdmin" placeholder="0" />
                               </div>
                               <div class="mb-3">
                                 <label class="form-label" for="qtdmaxestoque">QUANTIDADE MÁXIMA<input class="form-check-input" name="qtdmaxestoque" type="checkbox" value="qtdmaxestoque" id="qtdmaxestoque" /> </label>
                                 <input type="number" class="form-control" id="qtdmax" placeholder="0" />
                               </div>

                             </div>
                           </div>

                           <!-- aa -->
                         </div>
                       </div>
                       <br>
                       <div class=" text-end  row justify-content-end">
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