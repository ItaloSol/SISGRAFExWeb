<?php
include_once("../html/navbar.php"); ?>
<div class=" problemas-- "></div>
<div class="row">
  <div id="ajuda" class="card text-center p-5">
    <div v-if="confirmado == true">
      <div @clicck="Limpa">
        <h1>Suporte Enviado com sucesso!</h1><a href="problemas.php" class="btn btn-warning">Enviar outro chamado!</a>
      </div>
    </div>
    <div v-else>
      <div v-if="selecionado == false">
        <br>
        <div @click="Problema">
          <h4>Encontrou algum problema ou falha nas funções já feitas no sistema?</h4> <button class="btn btn-warning">Um Problema/Defeito!</button>
        </div>
        <br>
        <div @click="Dificuldade">
          <h4>Teve alguma dificuldade em executar uma ação?</h4><button class="btn btn-warning">Uma Dificuldade!</button>
        </div>
        <br>
        <div @click="Suporte">
          <h4>Precisa de suporte?</h4><button class="btn btn-warning">Uma Ajuda!</button>
        </div>
      </div>
      <div v-if="selecionado == true">
        <div v-if="problema == true">
          <br>
          <h4>Onde foi o problema que você encontrou?</h4>
          <div class="row justify-content-center">
            <div class="col-3"><select v-model="opcao" class="form-select">
                <option>Menu</option>
                <option>Relatório</option>
                <option>Cadastro</option>
                <option>Pesquisa</option>
                <option>Op</option>
                <option>Crédito</option>
                <option>Cliente</option>
                <option>Usuario</option>
                <option>Navegação</option>
                <option>Outros</option>

              </select></div>
            <div class="col-12"><br>
              <div v-if="opcao != 'Selecione'">
                <button @click="Enviar" class="btn btn-warning">Enviar Solicitação</button>
              </div>
            </div>
          </div>
        </div>
        <div v-if="dificuldade == true">
          <br>
          <h4>Onde Teve Dificuldade?</h4>
          <div class="row justify-content-center">
            <div class="col-3"><select v-model="opcao" class="form-select">
                <option>Menu</option>
                <option>Relatório</option>
                <option>Cadastro</option>
                <option>Pesquisa</option>
                <option>Op</option>
                <option>Crédito</option>
                <option>Cliente</option>
                <option>Usuario</option>
                <option>Navegação</option>
                <option>Outros</option>

              </select></div>
            <div class="col-12"><br>
              <div v-if="opcao != 'Selecione'">
                <button @click="Enviar" class="btn btn-warning">Enviar Solicitação</button>
              </div>
            </div>
          </div>
        </div>
        <div v-if="suporte == true">
          <br>
          <h4>Onde precisa de Ajuda?</h4>
          <div class="row justify-content-center">
            <div class="col-3"><select v-model="opcao" class="form-select">
                <option>Menu</option>
                <option>Relatório</option>
                <option>Cadastro</option>
                <option>Pesquisa</option>
                <option>Op</option>
                <option>Crédito</option>
                <option>Cliente</option>
                <option>Usuario</option>
                <option>Navegação</option>
                <option>Outros</option>

              </select>
            </div>
            <div class="col-12"><br>
              <div v-if="opcao != 'Selecione'">
                <button @click="Enviar" class="btn btn-warning">Enviar Solicitação</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>




    <?php if ($COD_I == 'ADM') {
      $dataHora1 = date('Y-m-d H:i:s');
      $dataHora = date('d/m/Y H:i:s');
      if (isset($_GET['cod'])) {
        $cod = $_GET['cod'];
        $Atividade_Supervisao = $conexao->prepare("UPDATE tabela_suporte SET atendimento = '1' , hora_atendimento = '$dataHora1' WHERE id_suporte = $cod ");
        $Atividade_Supervisao->execute();
        $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Atendeu a solicitação Cod: $cod' , '$cod_user' , '$dataHora')");
        $Atividade_Supervisao->execute();
        echo "<script>window.location = 'problemas.php'</script>";
      }
    ?>
      <div>&nbsp;</div>
      <div class="row">
        <div id="ajuda" class="card text-center p-5">
          <table class="table table-hover table-bordered">
            <tr>
              <th>Código</th>
              <th>Solicitante</th>
              <th>Seção</th>
              <th>Data e Hora</th>
              <th>Tipo</th>
              <th>Sobre</th>
              <th>Atender</th>
            </tr>
            <tr>
              <?php
              $query_atendimentos = $conexao->prepare("SELECT * FROM tabela_suporte s INNER JOIN tabela_atendentes a on s.cod_user = a.codigo_atendente WHERE s.atendimento != '1' ORDER BY s.id_suporte DESC");
              $query_atendimentos->execute();
              $a = 0;
              while ($linha = $query_atendimentos->fetch(PDO::FETCH_ASSOC)) {

                $Solicitacoes[$a] = [
                  'cod_user' => $linha['cod_user'],
                  'nome_atendente' => $linha['nome_atendente'],
                  'secao_atendente' => $linha['secao_atendente'],
                  'data' => $linha['data'],
                  'hora' => $linha['hora'],
                  'tipo' => $linha['tipo'],
                  'solicitacao' => $linha['solicitacao'],
                  'id_suporte' => $linha['id_suporte'],
                ];
                $a++;
              }
              if ($a == 0) {
                echo '<tr><td colspan="7">Nenhum chamado em aberto</td></tr>';
              }
              for ($i = 0; $i < $a; $i++) {
                echo '
              <tr>
              <td>' . $Solicitacoes[$i]['id_suporte'] . '</td>
              <td>' . $Solicitacoes[$i]['nome_atendente'] . '</td>
              <td>' . $Solicitacoes[$i]['secao_atendente'] . '</td>
              <td>' . date('d/m/Y', strtotime($Solicitacoes[$i]['data'])) . ' ' . date('H:i:s', strtotime($Solicitacoes[$i]['hora'])) . '</td>
              <td>' . $Solicitacoes[$i]['tipo'] . '</td>
              <td>' . $Solicitacoes[$i]['solicitacao'] . '</td>
              <td> <a class="btn btn-primary" href="problemas.php?cod=' . $Solicitacoes[$i]['id_suporte'] . '">Atender</a></td>
              </tr>
              ';
              }
              ?>
            </tr>
          </table>
        </div>
      </div>
      <div>&nbsp;</div>
      <div class="row">
        <div id="ajuda" class="card text-center p-5">
          <table class="table table-hover table-bordered">
            <tr>
              <th>Código</th>
              <th>Solicitante</th>
              <th>Seção</th>
              <th>Data e Hora</th>
              <th>Tipo</th>
              <th>Sobre</th>
              <th>Atender</th>
            </tr>
            <tr>
              <?php
              $query_atendimentos = $conexao->prepare("SELECT * FROM tabela_suporte s INNER JOIN tabela_atendentes a on s.cod_user = a.codigo_atendente WHERE s.atendimento = '1' ORDER BY s.id_suporte DESC");
              $query_atendimentos->execute();
              $a = 0;
              while ($linha = $query_atendimentos->fetch(PDO::FETCH_ASSOC)) {

                $Solicitacoes[$a] = [
                  'cod_user' => $linha['cod_user'],
                  'nome_atendente' => $linha['nome_atendente'],
                  'secao_atendente' => $linha['secao_atendente'],
                  'data' => $linha['data'],
                  'hora' => $linha['hora'],
                  'tipo' => $linha['tipo'],
                  'solicitacao' => $linha['solicitacao'],
                  'id_suporte' => $linha['id_suporte'],
                ];
                $a++;
              }
              if ($a == 0) {
                echo '<tr><td colspan="7">Nenhum chamado em aberto</td></tr>';
              }
              for ($i = 0; $i < $a; $i++) {
                echo '
              <tr>
              <td>' . $Solicitacoes[$i]['id_suporte'] . '</td>
              <td>' . $Solicitacoes[$i]['nome_atendente'] . '</td>
              <td>' . $Solicitacoes[$i]['secao_atendente'] . '</td>
              <td>' . date('d/m/Y', strtotime($Solicitacoes[$i]['data'])) . ' ' . date('H:i:s', strtotime($Solicitacoes[$i]['hora'])) . '</td>
              <td>' . $Solicitacoes[$i]['tipo'] . '</td>
              <td>' . $Solicitacoes[$i]['solicitacao'] . '</td>
              <td> Atendido</td>
              </tr>
              ';
              }
              ?>
            </tr>
          </table>
        </div>
      </div>
    <?php } else {   ?>
      <div>&nbsp;</div>
      <div v-if="selecionado == false">
        <div class="row">
          <div id="ajuda" class="card text-center p-5">
            <table class="table table-hover table-bordered">
              <tr>
                <th>Código</th>
                <th>Solicitante</th>
                <th>Seção</th>
                <th>Data e Hora</th>
                <th>Tipo</th>
                <th>Sobre</th>
                <th>Status</th>
              </tr>
              <tr>
                <?php
                $query_atendimentos = $conexao->prepare("SELECT * FROM tabela_suporte s INNER JOIN tabela_atendentes a on s.cod_user = a.codigo_atendente WHERE cod_user = '$cod_user' ORDER BY s.id_suporte DESC");
                $query_atendimentos->execute();
                $a = 0;
                while ($linha = $query_atendimentos->fetch(PDO::FETCH_ASSOC)) {

                  $Solicitacoes[$a] = [
                    'cod_user' => $linha['cod_user'],
                    'nome_atendente' => $linha['nome_atendente'],
                    'atendimento' => $linha['atendimento'],
                    'secao_atendente' => $linha['secao_atendente'],
                    'data' => $linha['data'],
                    'hora' => $linha['hora'],
                    'tipo' => $linha['tipo'],
                    'solicitacao' => $linha['solicitacao'],
                    'id_suporte' => $linha['id_suporte'],
                  ];
                  $a++;
                }
                if ($a == 0) {
                  echo '<tr><td colspan="7">Nenhum chamado em aberto</td></tr>';
                }
                for ($i = 0; $i < $a; $i++) {
                  if ($Solicitacoes[$i]['atendimento'] == '0') {
                    $Staus = 'Aguardando';
                  } else {
                    $Staus = 'Atendido';
                  }
                  echo '
              <tr>
              <td>' . $Solicitacoes[$i]['id_suporte'] . '</td>
              <td>' . $Solicitacoes[$i]['nome_atendente'] . '</td>
              <td>' . $Solicitacoes[$i]['secao_atendente'] . '</td>
              <td>' . date('d/m/Y', strtotime($Solicitacoes[$i]['data'])) . date('H:i:s', strtotime($Solicitacoes[$i]['hora'])) . '</td>
              <td>' . $Solicitacoes[$i]['tipo'] . '</td>
              <td>' . $Solicitacoes[$i]['solicitacao'] . '</td>
              <td>' . $Staus . '</td>
              </tr>
              ';
                }
                ?>
              </tr>
            </table>
          </div>
        </div>

      <?php } ?>
      </div>
  </div>
  <script>
    const vue = new Vue({
      el: '#ajuda',
      data: {
        problema: false,
        dificuldade: false,
        suporte: false,
        selecionado: false,
        confirmado: false,
        opcao: 'Selecione',
        formulario: {
          tipo: '',
          opcao: '',
        }
      },
      methods: {
        Problema() {
          this.problema = true;
          this.formulario.tipo = 'Problema';
          this.selecionado = true;
        },
        Dificuldade() {
          this.dificuldade = true;
          this.formulario.tipo = 'Dificuldade';
          this.selecionado = true;
        },
        Suporte() {
          this.suporte = true;
          this.formulario.tipo = 'Ajuda';
          this.selecionado = true;
        },

        Enviar() {
          if (this.opcao == 'Selecione') {

          } else {
            this.formulario.opcao = this.opcao;
            fetch("./enviar_solicitacao.php", {
                method: "post",
                headers: {
                  "Content-Type": "application/json"
                },
                body: JSON.stringify(this.formulario)
              })
              .then(response => {
                return response.json();
              })
              .then(data => {
                if (data.message == 'sucesso') {
                  this.confirmado = true;
                } else {
                  this.confirmado = false;
                }
              });
          }

        },
      }
    });
  </script>
  <?php  include_once("../html/navbar-dow.php"); ?>