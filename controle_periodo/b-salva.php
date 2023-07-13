<?php /* SISTEMA DE ESCALA DE SERVIÇO CRIADO POR SD ÍTALO SOL SCLOCOO *DANTAS*  */ 
         session_start();
         $cod_user = $_SESSION["usuario"][2];
         include_once('../conexoes/conexao.php');
    if(isset($_POST['salvar'])){

        $qtd = $_POST['quantidade'];
        $a = 0;
        while($a < $qtd){
            $Sts_B[$a] = $_POST['b'. $a];
            $Sts_Y[$a] = $_POST['y'. $a];
            $Sts_R[$a] = $_POST['r'. $a];
            $Sts[$a] = $_POST['sts'. $a];

            $query_Sts = $conexao->prepare("UPDATE controle_tempo SET azul_controle = '$Sts_B[$a]' , amarelo_controle = '$Sts_Y[$a]' , vermelho_controle = '$Sts_R[$a]' WHERE fk_status = '$Sts[$a]' ");
            $query_Sts->execute();

            $a++;
        }
        date_default_timezone_set('America/Sao_Paulo');
        $dataHora = date('d/m/Y H:i:s');
        $Atividade_Supervisao = $conexao->prepare("INSERT INTO supervisao_atividade (alteracao_atividade , atendente_supervisao, data_supervisao) VALUES ('Alterado o Prazo de Produção/Espera.' , '$cod_user' , '$dataHora')");
        $Atividade_Supervisao->execute();
        $_SESSION['msg'] = ' <div id="alerta<?=$a?>"
        role="bs-toast"
        class=" bs-toast toast toast-placement-ex m-3 fade bg-success top-0 end-0 hide show "
        role="alert"
        aria-live="assertive"
        aria-atomic="true">
        <div class="toast-header">
          <i class="bx bx-bell me-2"></i>
          <div class="me-auto fw-semibold">Aviso!</div>
          <small>
            
            </small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        
        <div class="toast-body">
             Alteração feita com suscesso!     
        </div>
      </div>';
        header("Location: tl-controle.php");
        

    }
    header("Location: tl-controle.php");