<?php /* SISTEMA DE ESCALA DE SERVIÇO CRIADO POR SD ÍTALO SOL SCLOCOO *DANTAS*  */ 
            if(isset($_SESSION['msg'])){
              echo $_SESSION['msg'];
              unset($_SESSION['msg']);
            }  
              ?>
<div class="card accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
            Prazo de produção/espera
            </button>
          </h2>
          <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <form method="POST" action="b-salva.php">
                <div class="row">
                
                  <div class="col-md-12">
                    <div class="card mb-4">
                      <h5 class="card-header">Gestão de aviso por prazo de produção/espera</h5>
                      <div class="card-body">
                        <form>
                        <div class="row">
                            <?php /* SISTEMA DE ESCALA DE SERVIÇO CRIADO POR SD ÍTALO SOL SCLOCOO *DANTAS*  */ 
                            $query_Sts = $conexao->prepare("SELECT * FROM sts_op s INNER JOIN controle_tempo t ON t.fk_status = s.CODIGO WHERE cor_ativa = 1 ORDER BY s.CODIGO ASC ");
                            $query_Sts->execute();
                            $gestao = 0;
                            while ($linha = $query_Sts->fetch(PDO::FETCH_ASSOC)) {
                            $Fk_status_controle = $linha['fk_status'];
                            $azul_controle = $linha['azul_controle'];
                            $amarelo_controle = $linha['amarelo_controle'];
                            $vermelho_controle = $linha['vermelho_controle'];
                            $status_controle = $linha['STS_DESCRICAO'];

                                $fk_status[$gestao] = $Fk_status_controle;
                                $azul[$gestao] = $azul_controle;
                                $amarelo[$gestao] = $amarelo_controle;
                                $vermelho[$gestao] = $vermelho_controle; 
                                $sts_status[$gestao] = $status_controle;
                                
                                $gestao++;
                            }
                            $a = 0;
                            while($a < $gestao){
                              echo ' <div class="mb-12 ">
                                <label for="html5-date-input" class="col-md-2 col-form-label"><b>'.$fk_status[$a].' - '.$sts_status[$a].'</b></label>
                                </div>
                                <div class="mb-12 ">
                                <label for="html5-date-input" class="col-md-2 col-form-label">DIAS PARA FICAR EM AZUL</label>
                                <div class="col-md-10">
                                  <input class="form-control" name="b'.$a.'" type="number" value="'.$azul[$a].'"  />
                                </div>
                              </div>
                              <div class="mb-3 ">
                                <label for="html5-date-input" class="col-md-2 col-form-label">DIAS PARA FICAR EM AMARELO</label>
                                <div class="col-md-10">
                                  <input class="form-control" name="y'.$a.'" type="number" value="'.$amarelo[$a].'"  />
                                </div>
                              </div>
                              <div class="mb-3 ">
                                <label for="html5-date-input" class="col-md-2 col-form-label">DIAS PARA FICAR EM VERMELHO</label>
                                <div class="col-md-10">
                                  <input class="form-control" name="r'.$a.'" type="number" value="'.$vermelho[$a].'"  />
                                </div>
                              </div><input type="hidden" value="'.$fk_status[$a].'" name="sts'.$a.'">';
                              
                                $a++;
                            }

                            ?>
                            <input type="hidden" value="<?= $gestao ?>" name="quantidade">
                        <button type="submit" class="btn btn-WARNING" name="salvar">Salvar</button>
                          </form>
                          
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>