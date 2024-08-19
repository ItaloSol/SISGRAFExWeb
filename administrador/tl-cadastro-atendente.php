<?php /*   */ include_once("../html/navbar.php");
$_SESSION["pag"] = array(1, 0);


$query_atendent = $conexao->prepare("SELECT * FROM usuario_acesso u INNER JOIN tabela_atendentes a ON a.codigo_atendente = u.CODIGO_USR ");
$query_atendent->execute();
$i = 0;
while ($linha = $query_atendent->fetch(PDO::FETCH_ASSOC)) {
  $A_nome_atendente = $linha['nome_atendente'];
  $A_login_atendente = $linha['login_atendente'];
  $A_tipo_atendente = $linha['tipo_atendente'];

  $u_cod = $linha['CODIGO_USR'];
  $u_ORC = $linha['ORC'];
  $u_ORC_ADM = $linha['ORC_ADM'];
  $u_PROD = $linha['PROD'];
  $u_PROD_ADM = $linha['PROD_ADM'];
  $u_EXP = $linha['EXP'];
  $u_EXP_ADM = $linha['EXP_ADM'];
  $u_FIN = $linha['FIN'];
  $u_FIN_ADM = $linha['FIN_ADM'];
  $u_EST = $linha['EST'];
  $u_ORD = $linha['ORD'];

  $nome_atendente[$i] = $A_nome_atendente;
  $login_atendente[$i] = $A_login_atendente;
  $tipo_atendente[$i] = $A_tipo_atendente;

  $cod[$i] = $u_cod;
  $ORC[$i] = $u_ORC;
  $ORC_ADM[$i] = $u_ORC_ADM;
  $PROD[$i] = $u_PROD;
  $PROD_ADM[$i] = $u_PROD_ADM;
  $EXP[$i] = $u_EXP;
  $EXP_ADM[$i] = $u_EXP_ADM;
  $FIN[$i] = $u_FIN;
  $FIN_ADM[$i] = $u_FIN_ADM;
  $EST[$i] = $u_EST;
  $ORD[$i] = $u_ORD;

  $i++;
}
$TT = $i;
if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
}
?>
<div class=" usuario-- "></div>
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="accordion mt-3" id="accordionExample">
      <div class="card accordion-item active">
        <h2 class="accordion-header" id="headingOne">
          <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
            Cadastro de Atendentes e Operadores
          </button>
        </h2>
        <form method="POST" action="b-cadastra_aten_atualiza.php">
          <?php /*   */
          if (isset($_GET['cod'])) {
            $cdo = $_GET['cod'];
            $query_atendent = $conexao->prepare("SELECT * FROM usuario_acesso u INNER JOIN tabela_atendentes a ON a.codigo_atendente = u.CODIGO_USR WHERE u.CODIGO_USR = '$cdo' ");
            $query_atendent->execute();
            $i = 0;
            if ($linha = $query_atendent->fetch(PDO::FETCH_ASSOC)) {
              $AA_nome_atendente = $linha['nome_atendente'];
              $AA_login_atendente = $linha['login_atendente'];
              $AA_tipo_atendente = $linha['tipo_atendente'];

              $Uu_cod = $linha['CODIGO_USR'];
              $Uu_ORC = $linha['ORC'];
              $Uu_ORC_ADM = $linha['ORC_ADM'];
              $Uu_PROD = $linha['PROD'];
              $Uu_PROD_ADM = $linha['PROD_ADM'];
              $Uu_EXP = $linha['EXP'];
              $Uu_EXP_ADM = $linha['EXP_ADM'];
              $Uu_FIN = $linha['FIN'];
              $Uu_FIN_ADM = $linha['FIN_ADM'];
              $Uu_EST = $linha['EST'];
              $Uu_ORD = $linha['ORD'];
            }
          } else {
            $AA_nome_atendente = NULL;
            $AA_login_atendente = NULL;
            $AA_tipo_atendente = NULL;

            $Uu_cod = null;
            $Uu_ORC = 3;
            $Uu_ORC_ADM = 3;
            $Uu_PROD = 3;
            $Uu_PROD_ADM = 3;
            $Uu_EXP = 3;
            $Uu_EXP_ADM = 3;
            $Uu_FIN = 3;
            $Uu_FIN_ADM = 3;
            $Uu_EST = 3;
            $Uu_ORD = 3;
          }
          ?>
          <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" value="<?= $AA_nome_atendente ?>" id="exampleFormControlInput1" placeholder="Insira o Nome do Usuário" required />
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Código</label>
                <input type="text" class="form-control" name="codigo" value="<?= $Uu_cod ?>" id="codigo" placeholder="Insira o Código" onkeyup="carregar_atendentes(this.value)" required />
                <span id="resultado"></span>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Login</label>
                <input type="text" class="form-control" name="login" value="<?= $AA_login_atendente ?>" id="exampleFormControlInput1" placeholder="Insira o login" required />

              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Senha</label>
                <input type="text" class="form-control" value="0" name="senha" id="exampleFormControlInput1" placeholder="Insira a senha" required />
              </div>
              <div class="mt-2 mb-3">
                        <label for="secao" class="form-label">Seção</label>
                        <select id="secao" name="secao" class="form-select form-select-lg">
                          <option>Selecione uma Seção</option>
                          <option value="1">ACABAMENTO</option>
                          <option value="2">BANNER</option>
                          <option value="3">COMERCIAL / ORÇAMENTAÇÃO</option>
                          <option value="4">EXPEDIÇÃO</option>
                          <option value="13">FINANCEIRO</option>
                          <option value="5">GRAVAÇÃO DE CHAPAS</option>
                          <option value="6">IMPRESSAO DIGITAL</option>
                          <option value="12">INFORMÁTICA</option>
                          <option value="7">OFFSET</option>
                          <option value="8">PLOTTER</option>
                          <option value="9">PRÉ-IMPRESSAO</option>
                          <option value="10">SEÇÃO TÉCNICA</option>
                          <option value="11">TIPOGRAFIA</option>
                        </select>
                      </div>
              <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">Tipo</label>
                <select class="form-select" name="tipo" id="exampleFormControlSelect1" aria-label="Default select example">
                  <option value="<?= $AA_tipo_atendente ?>" selected><?= $AA_tipo_atendente ?></option>
                  <option value="USUARIO">Usuário</option>
                  <option value="ADMINISTRADOR">Administrador</option>
                </select>
              </div>
            </div>

            <h5 class="card-header">Tipos de Acesso</h5>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table table-bordered acesso">
                  <thead>
                    <tr>
                      <th>Tipo de Acesso</th>
                      <th>Orçamento</th>
                      <th>Produção</th>
                      <th>Expedição</th>
                      <th>Financeiro</th>
                      <th>Estoque</th>
                      <th>ORD Despesas</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Usuário</strong>
                      </td>
                      <td>
                        <div class="form-check form-check-inline mt-3">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1" name="option1" <?php /*   */ echo ($Uu_ORC == '1') ? 'checked' : '' ?> />
                          <label class="form-check-label" for="inlineCheckbox1"></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-check-inline mt-3">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="1" name="option2" <?php /*   */ echo ($Uu_PROD == '1') ? 'checked' : '' ?> />
                          <label class="form-check-label" for="inlineCheckbox2"></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-check-inline mt-3">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="1" name="option3" <?php /*   */ echo ($Uu_EXP == '1') ? 'checked' : '' ?> />
                          <label class="form-check-label" for="inlineCheckbox3"></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-check-inline mt-3">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="1" name="option4" <?php /*   */ echo ($Uu_FIN == '1') ? 'checked' : '' ?> />
                          <label class="form-check-label" for="inlineCheckbox4"></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-check-inline mt-3">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox5" value="1" name="option5" <?php /*   */ echo ($Uu_EST == '1') ? 'checked' : '' ?> />
                          <label class="form-check-label" for="inlineCheckbox5"></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-check-inline mt-3">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox6" value="1" name="option6" <?php /*   */ echo ($Uu_ORD == '1') ? 'checked' : '' ?> />
                          <label class="form-check-label" for="inlineCheckbox6"></label>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Admin</strong>
                      </td>
                      <td>
                        <div class="form-check form-check-inline mt-3">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox7" value="1" name="option7" <?php /*   */ echo ($Uu_ORC_ADM == '1') ? 'checked' : '' ?> />
                          <label class="form-check-label" for="inlineCheckbox7"></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-check-inline mt-3">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox8" value="1" name="option8" <?php /*   */ echo ($Uu_PROD_ADM == '1') ? 'checked' : '' ?> />
                          <label class="form-check-label" for="inlineCheckbox8"></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-check-inline mt-3">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox9" value="1" name="option9" <?php /*   */ echo ($Uu_EXP_ADM == '1') ? 'checked' : '' ?> />
                          <label class="form-check-label" for="inlineCheckbox9"></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-check-inline mt-3">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox10" value="1" name="option10" <?php /*   */ echo ($Uu_FIN_ADM == '1') ? 'checked' : '' ?> />
                          <label class="form-check-label" for="inlineCheckbox10"></label>
                        </div>
                      </td>
                      <td>
                        <div class="form-check form-check-inline mt-3">

                        </div>
                      </td>
                      <td>
                        <div class="form-check form-check-inline mt-3">

                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div><br>
              <input class="btn btn-danger" type="submit" value="Cadastrar" name="submit">
              <input class="btn btn-warning" type="submit" value="Editar" name="submit">
              <input class="btn btn-primary" type="reset" value="Cancelar">
            </div>
          </div>
      </div>
      </form>
    </div><br>
    <div class="card">
      <h5 class="card-header">Controle de Usuário</h5>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Código</th>
                <th>Login</th>
                <th>Orçamento</th>
                <th>Produção</th>
                <th>Expedição</th>
                <th>Financeiro</th>
                <th>Estoque</th>
                <th>ORD Despesas</th>
                <th>Editar</th>
              </tr>
            </thead>
            <tbody>
              <?php /*   */
              $a = 0;
              while ($TT > $a) {
                echo "<tr>
                          
                          <td>" . $nome_atendente[$a] . "</td><td>" . $cod[$a] . "</td><td>" . $login_atendente[$a] . "</td><td>" . $ORC[$a] . "</td><td>" . $PROD[$a] . "</td><td>" . $EXP[$a] . "</td><td>" . $FIN[$a] . "</td><td>" . $EST[$a] . "</td><td>" . $ORD[$a] . "</td><td><a href='tl-cadastro-atendente.php?cod=" . $cod[$a] . "'>SELECIONAR</a></td>
                          </tr>";
                $a++;
              }
              ?>


            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>





  <script src="../js/custom.js"></script>

  <?php /*   */ include_once("../html/navbar-dow.php"); ?>